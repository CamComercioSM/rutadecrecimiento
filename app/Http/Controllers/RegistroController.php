<?php

namespace App\Http\Controllers;

use App\Http\Services\CommonService;
use App\Http\Services\reCAPTCHAv3;
use App\Http\Services\SICAM32;
use App\Http\Services\UnidadProductivaService;
use App\Http\Services\UsuarioService;
use App\Models\UnidadProductiva;
use App\Models\UnidadProductivaPersona;
use App\Models\UnidadProductivaTipo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistroController extends Controller
{
    public function index()
    {
        $data = [
            'section'=> CommonService::section(),
            'footer'=> CommonService::footer(),
            'links'=> CommonService::links(),
            'camaras'=> SICAM32::listadoCamarasComercio(),
            'tiposIdentificacion'=> SICAM32::listadoTiposIdentificacion()
        ];

        if(Auth::check())
        {
            return view('website.register.create_company', $data);
        }

        $data['departamentos'] = CommonService::departamentos();
        $data['municipios'] = CommonService::municipios();

        return view('website.register.index', $data);
    }

    public function search(Request $request)
    {
        $api = SICAM32::buscarRegistroMercantil($request->search_type, $request->name);
 
        if (!empty($api)) 
        {
            if ($api->RESPUESTA != 'EXITO' || count($api->DATOS->expedientes) == 0)
                return redirect()->back()->with('error', 'No se encontraron empresas según el tipo de búsqueda. Valide los datos e intente nuevamente.');

            $resultado = $api->DATOS->expedientes[0];

            $data = [
                'section'=> CommonService::section(),
                'footer'=> CommonService::footer(),
                'links'=> CommonService::links(),
                'kind'=>  $request->criterio,
                'value'=>  $request->nombre,
                'result'=>  $resultado,
            ];

            return view('website.register.results', $data);
        } 
        else {
            return redirect()->back()->with('error', 'No se encontraron empresas según el tipo de búsqueda. Valide los datos e intente nuevamente.');
        }
    }

    public function store(Request $request) 
    {
        
        $api = SICAM32::consultarExpedienteMercantilporIdentificacion($request->value);
        
        // Validamos que la API haya respondido de manera correcta
        if ($api->RESPUESTA != 'EXITO')
            return redirect()->route('home')->with('error', 'No pudimos validar su empresa. Intente nuevamente');

        //Guardamos los valores en la variable values
        $values = $api->DATOS;

        // Validamos si ya existe la empresa en el registro

        if(!Auth::check())
        {
            $user = User::where('email', $request->email)->first();
            if ($user)
                return redirect()->route('home')->with('error', 'El correo electronico ya se encuentra registrado. Utilice la opción de iniciar sesión');
        }
        
        $query = UnidadProductiva::where('nit', 'like', '%' . $values->nit . '%')->first();
        if ($query)
            return redirect()->route('home')->with('error', 'La empresa ya se encuentra registrada. Utilice la opción de iniciar sesión');

        $idRepre = $values->identificacionrl ?? $values->identificacion;
        $nombreRepre = $values->nombrerl ?? $values->nombre;

        //Creamos el usuario y contraseña para acceder al sistema
        $user = UsuarioService::crearUsuario2($idRepre, $nombreRepre, '', $request->email, $request->password);

        //Convierto la actividad comercial a numero
        $comercial_activity = substr($values->ciiu1, 1);

        // Creamos la empresa con los datos temporales
        $company = New UnidadProductiva();
        $company->business_name = $values->nombre;
        $company->nit = $values->nit;
        $company->registration_number = $values->matricula;
        $company->registration_date = date("Y-m-d", strtotime($values->fechamatricula));
        $company->registration_email = $values->emailcom;
        $company->address = $values->dircom;
        $company->mobile = $values->telcom1;
        $company->name_legal_representative = $values->nombrerl;
        $company->affiliated = $values->afiliado;
        $company->comercial_activity = $comercial_activity;
        $company->user_id = $user->id;

        $company->tamano_id = $values->tamanoempresa;

        //UnidadProductivaService::setSector($company);
        //UnidadProductivaService::setTamano($company, $values->ingresostamanoempresarial);

        /* FROMAL DEL MAGDALENA */
        $tipoRegistro = UnidadProductivaTipo::where('unidadtipo_id', 4)->first();
        $company->unidadtipo_id = $tipoRegistro->unidadtipo_id;
        $company->tipo_registro_rutac = $tipoRegistro->unidadtipo_nombre;

        /* EMPRESA FORMAL */
        $tipoPersona = UnidadProductivaPersona::where('tipopersona_id', 2)->first();
        $company->tipopersona_id = $tipoPersona->tipopersona_id;
        $company->type_person = $tipoPersona->tipoPersonaCODIGO;

        $company->tipo_identificacion = 'NIT';
        $company->identificacion = $request->password;

        $company->save();

        /* TODO: validar que no llega el  unidadProductivaID*/
        //SICAM32::actualizarIdRelacionadoUnidadProductiva($values->unidadProductivaID, $company->unidadproductiva_id);

        UnidadProductivaService::validarRenovacion($values->fecharenovacion, $company->unidadproductiva_id);
        UnidadProductivaService::validarSiguienteRenovacion($values->fechamatricula, $values->fecharenovacion, $company->unidadproductiva_id);

        if(!Auth::check())
            Auth::login($user);

        UnidadProductivaService::setUnidadProductiva($company->unidadproductiva_id);
       
        return redirect()->route('company.complete_info');
    }

    public function storeLead(Request $request) 
    {
        /*
        if (!reCAPTCHAv3::validar($request->token))
            return redirect()->back()
                    ->with('error', 'No PASATE EL FILTRO DE SEGURIDAD ANTIROBOTS. Intentalo nuevamente');
        */

        if(Auth::check())
        {
             /** @var User $user */
            $user = Auth::user();
          
            $unidad = $user->unidadesProductivas()->first();
            dd($unidad);
            $request->merge([
                'tipoPersonaID' => $unidad->identificacion ? 0 : 1,
                'tipo_identificacion' => $unidad->identificacion ? 1 : 2,
                'document' => $unidad->identificacion ?? $unidad->nit,
                'personaRAZONSOCIAL' => $unidad->name_legal_representative,
                'personaNOMBRES' => $unidad->name_legal_representative,
                'personaAPELLIDOS' => '',
                'email' => $unidad->registration_email,
                'phone' => $unidad->mobile,
                'department' => $unidad->department_id,
                'municipality' => $unidad->municipality_id,
                'address' => $unidad->address,
            ]);

        }

        $tipoPersona = UnidadProductivaPersona::where('tipoPersonaCODIGO', $request->tipoPersonaID)->first();
        $tipoRegistro = UnidadProductivaTipo::where('unidadtipo_id', $request->tipo_registro_rutac)->first();
 
        $datos = [
            'tipoPersonaRUTAC' => $tipoPersona->tipopersona_id,
            'tipoPersonaCODIGO' => $tipoPersona->tipoPersonaNOMBRE,
            'tipoIdentificacionID' => $request->tipo_identificacion,
            'personaIDENTIFICACION' => $request->document,
            'personaRAZONSOCIAL' => $request->personaRAZONSOCIAL,
            'personaNOMBRES' => $request->personaNOMBRES,
            'personaAPELLIDOS' => $request->personaAPELLIDOS,
            'correoDIRECCION' => $request->email,
            'telefonoNUMEROCELULAR' => $request->phone,
            'direccionCOMERCIALDEPARTAMENTO' => $request->department,
            'direccionCOMERCIALMUNICIPIO' => $request->municipality,
            'direccionCOMERCIAL' => $request->address,
            'unidadProductivaTIPOREGISTRORUTAC' => $tipoRegistro->unidadtipo_nombre,
            'unidadProductivaTIPOREGISTRORUTACID' => $tipoRegistro->unidadtipo_id,
            'unidadProductivaFCHINICIO' => $request->registration_date,
            'unidadProductivaTITULO' => $request->business_name,
            'unidadProductivaDESCRIPCION' => $request->description,
            'unidadProductivaEMAIL' => $request->email,
            'unidadProductivaENLACE' => $request->address,
            'unidadProductivaTELEFONO' => $request->phone,
            'departamentoID' => $request->department,
            'municipioID' => $request->municipality,
            'unidadProductivaDIRECCION' => $request->address,
            'unidadProductivaCONTACTONOMBRE' => ($request->personaNOMBRES . " " . $request->personaAPELLIDOS),
            'unidadProductivaCONTACTOEMAIL' => $request->email,
            'unidadProductivaCONTACTOTELEFONO' => $request->phone,
            'unidadProductivaCAMARADECOMERCIO' => $request->camara_comercio,
            'unidadProductivaMATRICULA' => $request->registration_number,
            'unidadProductivaFCHMATRICULA' => $request->registration_date,
            'unidadProductivaNIT' => $request->nit_registrado,
            'unidadProductivaREPRESENTANTELEGAL' => $request->name_legal_representative,
            'REQUEST1' => $request->toArray(),
        ];
        
        $UnidadProductiva = SICAM32::registarNuevaUnidadProductiva($datos);

        if(!Auth::check())
        {
            $user = User::where('email', $request->email)->first();
            if ($user)
                return redirect()->route('home')->with('error', 'El correo electronico ya se encuentra registrado. Utilice la opción de iniciar sesión');
        }
        
        if ($request->tipo_registro_rutac == 3) {
            $query = UnidadProductiva::where('nit', 'like', '%' . $UnidadProductiva->unidadProductivaNIT . '%')->first();
        } 
        else {
            $query = UnidadProductiva::where('nit', 'like', '%' . $UnidadProductiva->unidadProductivaCODIGO . '%')->first();
        }

        // Validamos si ya existe la empresa en el registro
        if ($query)
            return redirect()->route('home')->with('error', 'La empresa ya se encuentra registrada. Utilice la opción de iniciar sesión');

        $user = UsuarioService::crearUsuario($UnidadProductiva->Persona);

        // Creamos la empresa con los datos temporales
        $company = New UnidadProductiva();
        $company->business_name = $UnidadProductiva->unidadProductivaTITULO;
        $company->description = $UnidadProductiva->unidadProductivaDESCRIPCION;
        
        if ($request->tipo_registro_rutac == 4) {
            $company->nit = $UnidadProductiva->unidadProductivaNIT;
            $company->registration_date = date("Y-m-d", strtotime($UnidadProductiva->unidadProductivaFCHMATRICULA));
        } else {
            $company->nit = $UnidadProductiva->unidadProductivaCODIGO;
            $company->registration_date = date("Y-m-d", strtotime($UnidadProductiva->unidadProductivaFCHINICIO));
        }

        if ($request->tipo_registro_rutac == 1) {
            $company->anual_sales = 0;
        } 

        $company->registration_number = $UnidadProductiva->unidadProductivaMATRICULA;
        $company->registration_email = $UnidadProductiva->unidadProductivaEMAIL;
        $company->address = $UnidadProductiva->unidadProductivaDIRECCION;
        $company->municipality_id = $UnidadProductiva->municipioID;
        $company->municipality_viejo = $UnidadProductiva->municipioID;
        $company->department_id = $UnidadProductiva->departamentoID;
        $company->department_viejo = $UnidadProductiva->departamentoID;
        $company->mobile = $UnidadProductiva->unidadProductivaTELEFONO;
        $company->name_legal_representative = $UnidadProductiva->unidadProductivaCONTACTONOMBRE;
        
        $company->affiliated = 0;
        $company->user_id = $user->id;
        $company->tipo_identificacion = $UnidadProductiva->Persona->tipoIdentificacionCODIGO;
        $company->identificacion = $UnidadProductiva->Persona->personaIDENTIFICACION;

        $company->unidadtipo_id = $tipoRegistro->unidadtipo_id;
        $company->tipo_registro_rutac = $tipoRegistro->unidadtipo_nombre;

        $company->tipopersona_id = $tipoPersona->tipopersona_id;
        $company->type_person = $tipoPersona->tipoPersonaCODIGO;
       
        $company->save();

        SICAM32::actualizarIdRelacionadoUnidadProductiva($UnidadProductiva->unidadProductivaID, $company->unidadproductiva_id);
        
        UnidadProductivaService::setUnidadProductiva($company->unidadproductiva_id);

        if(!Auth::check())
            Auth::login($user);
        
        return redirect()->route('company.complete_info');
    }
    
}
