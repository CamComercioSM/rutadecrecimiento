<?php

namespace App\Http\Controllers;

use App\Exports\DiagnosticoRespuestasExport;
use App\Http\Services\EmailService;
use App\Http\Services\CommonService;
use App\Http\Services\SICAM32;
use App\Http\Services\UnidadProductivaService;
use App\Models\ResultadosDiagnostico;
use App\Models\Sector;
use App\Models\SectorSecciones;
use App\Models\UnidadProductiva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class PerfilController extends Controller
{
    public function SeleccionarUnidadProductiva(Request $request) 
    {
        if($request->unidadproductiva && $request->unidadproductiva > 0)
        {
            UnidadProductivaService::setUnidadProductiva($request->unidadproductiva);

            return redirect()->route('company.dashboard');    
        }

        $user = Auth::user()->id;

        $data = [
            'footer'=> CommonService::footer(),
            'links'=> CommonService::links(),
            'companies'=> UnidadProductiva::where('user_id', $user)->get(),
        ];
     

        return view('website.company.select_company', $data);
    }

    public function dashboard() 
    {
        $unidadProductiva = UnidadProductivaService::getUnidadProductiva();

        if ($unidadProductiva == null) 
        {
            return redirect()->route('company.select');
        }

        $unidadProductiva = UnidadProductivaService::getUnidadProductiva();
        
        if ($unidadProductiva != null)
        {
            if ($unidadProductiva->update_info == 0)
                return redirect()->route('company.complete_info');

            if ($unidadProductiva->complete_diagnostic == 0 || 
                UnidadProductivaService::validarTiempoDiagnostico($unidadProductiva))
                    return redirect()->route('company.diagnostic');

            $activarDIAGVOLUNTARIO = UnidadProductivaService::validarTiempoDiagnostico($unidadProductiva, 30);
            
            $diagnostico = $unidadProductiva->diagnosticos->last();
            $resultados = ResultadosDiagnostico::where('resultado_id', $diagnostico->resultado_id)->get();

            $dimensiones = $resultados->pluck('dimension')->toArray();
            $resultados = $resultados->pluck('valor')->toArray();

            $data = [
                'footer'=> CommonService::footer(),
                'links'=> CommonService::links(),
                'stages'=> CommonService::etapas(),
                'company'=> $unidadProductiva,
                'helper_notifications'=> CommonService::notificaciones(),
                'dimensions'=> json_encode($dimensiones),
                'results'=> $resultados,
                'activarDIAGVOLUNTARIO'=> $activarDIAGVOLUNTARIO,
            ];
            
            return view('website.company.dashboard', $data);
        }
        
        return redirect()->route('home')->with('error', 'No se pudo obtener la información de la empresa');
    }

    public function historialDiagnosticos(){
        $unidadProductiva = UnidadProductivaService::getUnidadProductiva();
    
        if ($unidadProductiva) 
        {
            $data = [
                'company' => $unidadProductiva,
            ];
    
            return view('website.company.historial_diagnosticos', $data);
        }
    
        return redirect()->route('home')->with('error', 'No se pudo obtener la información de la empresa');
    }
    
    public function historialDiagnosticoDetalle($id)
    {
        $unidadProductiva = UnidadProductivaService::getUnidadProductiva();
    
        if ($unidadProductiva) 
        {
            $diagnostico = $unidadProductiva->diagnosticos()->find($id);
                
            if ($diagnostico) 
            {        
                $resultados = ResultadosDiagnostico::where('resultado_id', $diagnostico->resultado_id)->get();
                
                $dimensiones = $resultados->pluck('dimension')->toArray();
                $resultados = $resultados->pluck('valor')->toArray();
    
                $data = [
                    'company' => $unidadProductiva,
                    'diagnostico' => $diagnostico,
                    'dimensions' => json_encode($dimensiones),
                    'results' => $resultados,
                ];
    
                return view('website.company.historial_diagnostico_detalle', $data);
            }
        }
    
        return redirect()->route('company.historialDiagnosticos');
    }
    
    public function exportarPreguntasDiagnostico($id)
    {
        return Excel::download(new DiagnosticoRespuestasExport($id), 'diagnostico-respuestas.xlsx');
    }
    
    public function completarInformacion() 
    {
        $data = [
            'footer'=> CommonService::footer(),
            'links'=> CommonService::links(),
            'departments'=> CommonService::departamentos(),
            'company'=> UnidadProductivaService::getUnidadProductiva(),
            'listaCargos'=> SICAM32::listadoViculosCargos(),
            'sectores'=> Sector::get(),
        ];

        return view('website.company.complete_info', $data);
    }

    public function completarInformacionGuardar(Request $request) 
    {
        $unidad = UnidadProductivaService::getUnidadProductiva();

        $unidad->department_id = $request->department;
        $unidad->municipality_id = $request->municipality;
        $unidad->address = $request->address;
        $unidad->telephone = $request->telephone;
        $unidad->mobile = $request->mobile;

        $unidad->contact_person = $request->contact_person;
        $unidad->contact_position = $request->contact_position;
        $unidad->contact_email = $request->contact_email;
        $unidad->contact_phone = $request->contact_phone;

        $unidad->website = $request->website;
        $unidad->social_instagram = $request->social_instagram;
        $unidad->social_facebook = $request->social_facebook;
        $unidad->social_linkedin = $request->social_linkedin;

        $unidad->geolocation = UnidadProductivaService::localizacion($request->department, $request->municipality, $request->address);

        $unidad->sector_id = $request->sector_id;
        $unidad->ciiuactividad_id = $request->ciiuactividad_id;

        $unidad->update_info = 1;
        $unidad->save();


        // Enviamos notificacion de email al correo corporativo
        $unidad->usuario = $unidad->usuario()->first();
        EmailService::send($unidad->registration_email, 'Solicitud de registro', 'website.mail.company_register', $unidad);

        return redirect()->route('company.diagnostic');
    }

    public function perfil() 
    {
        $unidadProductiva = UnidadProductivaService::getUnidadProductiva();
        
        if (!$unidadProductiva) {
            abort(404, 'Unidad productiva no encontrada o no asociada al usuario.');
        }
     
        $programas_inscrito = []; 
    
        $data = [
            'footer' => CommonService::footer(),
            'links' => CommonService::links(),
            'helper_notifications' => CommonService::notificaciones(),
            'departments' => CommonService::departamentos(), 
            'municipalities' => CommonService::municipios(), 
            'programas_inscrito' => $programas_inscrito,
            'company' => $unidadProductiva,
            'user' => Auth::user(),
        ];
    
        return view('website.company.profile', $data);
    }
    

    public function actualizarPerfil() 
    {
        $unidadProductiva = UnidadProductivaService::getUnidadProductiva();
        $listaCargos = SICAM32::listadoViculosCargos();
      
        $data = [
            'footer'=> CommonService::footer(),
            'links'=> CommonService::links(),
            'departments'=> CommonService::departamentos(),
            'company'=> $unidadProductiva,
            'listaCargos'=> $listaCargos,
        ];

        return view('website.company.profile_update', $data);
    }

    public function actualizarPerfilGuardar(Request $request) 
    {
        $unidad = UnidadProductivaService::getUnidadProductiva();

        $unidad->description = $request->description;

        $unidad->department_id = $request->department;
        $unidad->municipality_id = $request->municipality;
        $unidad->address = $request->address;
        $unidad->telephone = $request->telephone;
        $unidad->mobile = $request->mobile;

        $unidad->contact_person = $request->contact_person;
        $unidad->contact_position = $request->contact_position;
        $unidad->contact_email = $request->contact_email;
        $unidad->contact_phone = $request->contact_phone;

        $unidad->website = $request->website;
        $unidad->social_instagram = $request->social_instagram;
        $unidad->social_facebook = $request->social_facebook;
        $unidad->social_linkedin = $request->social_linkedin;

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $name = time() . '-' . $file->getClientOriginalName();
            $file->move(storage_path() . '/app/public/logos/', $name);
            $unidad->logo = $name;
        }

        $unidad->save();

        return redirect()->route('company.profile')->with('success', 'Información actualizada correctamente');
    }

    public function actualizarPassword() 
    {
        return view('website.company.password_update');
    }

    public function actualizarPasswordGuardar(Request $request) 
    {    
        /** @var User $user */
        $user = Auth::user();

        if (!Hash::check($request->password_old, $user->password))
            return redirect()->back()->with('error', 'La contraseña actual no es correcta');

        if ($request->password != $request->password_confirm)
            return redirect()->back()->with('error', "El campo de contraseña y confirmar contraseña, deben ser iguales");

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect(route('company.profile'))->with('success', "Contraseña actualizada correctamente");
    }


    public function grafico() 
    {
        $unidadProductiva = UnidadProductivaService::getUnidadProductiva();

        if ($unidadProductiva != null)
        {
            $diagnostico = $unidadProductiva->diagnosticos->last();
           
            $resultados = ResultadosDiagnostico::where('resultado_id', $diagnostico->resultado_id)->get();

            $dimensiones = $resultados->pluck('dimension')->toArray();
            $resultados = $resultados->pluck('valor')->toArray();
            
            $data = [
                'company'=> $unidadProductiva,
                'dimensions'=> json_encode($dimensiones),
                'results'=> json_encode($resultados),
            ];
    
            return view('website.company.radial_graphic', $data);
        }
    }

}
