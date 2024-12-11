<?php

namespace App\Http\Controllers;

use App\Http\Services\EmailService;
use App\Http\Services\CommonService;
use App\Http\Services\SICAM32;
use App\Http\Services\UnidadProductivaService;
use App\Models\DiagnosticoPregunta;
use App\Models\DiagnosticoRespuesta;
use App\Models\Programa;
use App\Models\UnidadProductiva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            $etapas = CommonService::etapas()->keyBy('etapa_id');
            $historialDiagnosticos = $unidadProductiva->diagnosticos->map(function ($diag) use ($etapas) {
                $etapa = $etapas->get($diag->etapa_id);
                $diag->etapa_nombre = $etapa ? $etapa->name : 'Etapa no definida';
                return $diag;
            });
                        
            $resultados = [];

            $dimensiones = CommonService::dimensiones();
            $resultados = $this->calcular($unidadProductiva, $diagnostico, $dimensiones);
            
            $dimensiones = $dimensiones->pluck('preguntadimension_nombre')->toArray();
            $dimensiones = json_encode($dimensiones);

            $data = [
                'footer'=> CommonService::footer(),
                'links'=> CommonService::links(),
                'stages'=> CommonService::etapas(),
                'company'=> $unidadProductiva,
                'etapa_id'=> $unidadProductiva,
                'helper_notifications'=> CommonService::notifacaciones(),
                'dimensions'=> $dimensiones,
                'results'=> json_encode($resultados),
                'activarDIAGVOLUNTARIO'=> $activarDIAGVOLUNTARIO,
            ];
            
            return view('website.company.dashboard', $data);
        }
        
        return redirect()->route('home')->with('error', 'No se pudo obtener la información de la empresa');
    }

    public function historialDiagnosticos(){
        $unidadProductiva = UnidadProductivaService::getUnidadProductiva();
    
        if ($unidadProductiva) {
            
            $etapas = CommonService::etapas()->keyBy('etapa_id');
    
            $historialDiagnosticos = $unidadProductiva->diagnosticos->map(function ($diagnostico) use ($etapas) {
                $etapa = $etapas->get($diagnostico->etapa_id);
                $diagnostico->etapa_nombre = $etapa ? $etapa->name : 'Etapa no definida';
                return $diagnostico;
            });
    
            $data = [
                'footer' => CommonService::footer(),
                'links' => CommonService::links(),
                'company' => $unidadProductiva,
                'historialDiagnosticos' => $historialDiagnosticos, // Pasando el historial con los nombres de las etapas
            ];
    
            return view('website.company.historial_diagnosticos', $data);
        }
    
        return redirect()->route('home')->with('error', 'No se pudo obtener la información de la empresa');
    }
    
    public function historialDiagnosticoDetalle($id)
    {
        $unidadProductiva = UnidadProductivaService::getUnidadProductiva();
    
        if ($unidadProductiva) {
            $diagnostico = $unidadProductiva->diagnosticos()->find($id);
           
            if ($diagnostico) {
                
                $etapas = CommonService::etapas()->keyBy('etapa_id');
                $etapa = $etapas->get($diagnostico->etapa_id);
                $diagnostico->etapa_nombre = $etapa ? $etapa->name : 'Etapa no definida';
    
                $dimensiones = CommonService::dimensiones();
                $resultados = $this->calcular($unidadProductiva, $diagnostico, $dimensiones);
    
                $dimensiones = $dimensiones->pluck('preguntadimension_nombre')->toArray();
                $dimensiones = json_encode($dimensiones);
    
                $data = [
                    'footer' => CommonService::footer(),
                    'links' => CommonService::links(),
                    'company' => $unidadProductiva,
                    'diagnostico' => $diagnostico,
                    'dimensions' => $dimensiones,
                    'results' => json_encode($resultados),
                ];
    
                return view('website.company.historial_diagnostico_detalle', $data);
            }
        }
    
        return redirect()->route('company.historialDiagnosticos');
    }
    
    
    public function completarInformacion() 
    {
        $data = [
            'footer'=> CommonService::footer(),
            'links'=> CommonService::links(),
            'departments'=> CommonService::departamentos(),
            'municipalities'=> CommonService::municipios(),
            'company'=> UnidadProductivaService::getUnidadProductiva(),
            'listaCargos'=> SICAM32::listadoViculosCargos(),
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

        $unidad->update_info = 1;
        $unidad->save();

        // Enviamos notificacion de email al correo corporativo
        EmailService::send($unidad->registration_email, 'Solicitud de registro', 'website.mail.company_register', $unidad);

        return redirect()->route('company.diagnostic');
    }

    public function perfil() 
    {
        $unidadProductiva = UnidadProductivaService::getUnidadProductiva();
        $user = Auth::user();

        $programas_inscrito = [];
        /*Programa::whereHas('applications', function ($query) use ($unidadProductiva) {
              $query->where('company_id', $unidadProductiva->unidadproductiva_id);
          })->get();*/

        $data = [
            'footer'=> CommonService::footer(),
            'links'=> CommonService::links(),
            'helper_notifications'=> CommonService::notifacaciones(),
            'programas_inscrito'=> $programas_inscrito,
            'company'=> $unidadProductiva,
            'user'=> $user,
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
            'municipalities'=> CommonService::municipios(),
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
           
            $dimensiones = CommonService::dimensiones();
            $resultados = $this->calcular($unidadProductiva, $diagnostico, $dimensiones);

            $dimensiones = $dimensiones->pluck('preguntadimension_nombre')->toArray();
            $dimensiones = json_encode($dimensiones);

            $data = [
                'company'=> CommonService::links(),
                'dimensions'=> CommonService::dimensiones(),
                'results'=> $resultados,
            ];
    
            return view('website.company.radial_graphic', $data);
        }

    }


    private function calcular($unidadProductiva, $diagnostico, $dimensiones)
    {
        $resultados = [];

        foreach ($dimensiones as $dimension) 
        {
            $preguntas = DiagnosticoPregunta::where('preguntadimension_id', $dimension->preguntadimension_id)->get();
            $preguntas_contador = count($preguntas);
            $int = 0;

            // Si estamos en la dimension comercial
            if ($dimension->preguntadimension_id == 1) {
                // Cargamos la primera respuesta de la cantidad de ventas
                if ($unidadProductiva->anual_sales == 0)
                    $int += 2;
                elseif ($unidadProductiva->anual_sales == 1)
                    $int += 3;
                elseif ($unidadProductiva->anual_sales == 2)
                    $int += 4;
                else
                    $int += 5;
            }

            foreach ($preguntas as $pregunta) 
            {
                //TODO hay que analizar variables que no estan unidas a la dimension
                if ($pregunta->pregunta_id == 2)
                    continue;

                $respuesta = DiagnosticoRespuesta::where('pregunta_id', $pregunta->pregunta_id)->where('resultado_id', $diagnostico->resultado_id)->first();
                
                if($respuesta != null)
                {
                    $valor = UnidadProductivaService::ajustarValorRespuesta($respuesta->diagnosticorespuesta_valor, $pregunta->pregunta_opcionesJSON);
                    $int += $valor;
                }
            }

            // Se suma 1 a la cantidad de variables, ya que son el total + la pregunta inicial de ventas
            $resultados[] = $int / ($preguntas_contador > 0 ? $preguntas_contador : 1 );
        }
        
        return $resultados;
    }

}
