<?php

namespace App\Http\Controllers;

use App\Http\Services\CommonService;
use App\Http\Services\reCAPTCHAv3;
use App\Http\Services\SICAM32;
use App\Http\Services\UnidadProductivaService;
use App\Http\Services\UsuarioService;
use App\Models\Municipio;
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


        //Creamos el usuario y contraseña para acceder al sistema
        if( $values->organizacion == '01' ){    
            $user = UsuarioService::crearUsuario2($values->identificacion, $values->nombre, '', $request->email, $request->password);
        }else{
            $user = UsuarioService::crearUsuario2($values->identificacionrl, $values->nombrerl, '', $request->email, $request->password);
        }

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
        $company->affiliated = $values->afiliado;
        $company->comercial_activity = $comercial_activity;
        $company->user_id = $user->id;

        $company->tamano_id = $values->tamanoempresa;
        $company->camara_comercio = 32;

        /* FORMAL DEL MAGDALENA */
        $tipoRegistro = UnidadProductivaTipo::where('unidadtipo_id', 4)->first();
        $company->unidadtipo_id = $tipoRegistro->unidadtipo_id;
        $company->tipo_registro_rutac = $tipoRegistro->unidadtipo_nombre;

        /* EMPRESA FORMAL */
        $tipoPersona = UnidadProductivaPersona::where('tipopersona_id', 2)->first();
        $company->tipopersona_id = $tipoPersona->tipopersona_id;
        $company->type_person = $tipoPersona->tipoPersonaCODIGO;

        if( $values->organizacion == '01' ){
            $company->tipo_identificacion = $this->TraeCodigoTIpoIdentificon($values->idclase);
            $company->identificacion = $values->identificacion;
            $company->name_legal_representative = $values->nombre;
        }else{
            $company->tipo_identificacion = $this->TraeCodigoTIpoIdentificon($values->idclaserl);
            $company->identificacion = $values->identificacionrl;
            $company->name_legal_representative = $values->nombrerl;
        }

        $company->logo = $this->getLogo($company->unidadtipo_id);

        $municipio = Municipio::where('municipioCODIGODANE', $values->muncom )->first();
        $company->department_id  = $municipio->departamentoID;
        $company->municipality_id = $municipio->municipio_id;

        $company->contact_person = $company->name_legal_representative;
        $company->contact_email = $company->registration_email;
        $company->contact_phone = $company->mobile;

        $company->save();

        UnidadProductivaService::validarRenovacion($values->fecharenovacion, $company->unidadproductiva_id);
        UnidadProductivaService::validarSiguienteRenovacion($values->fechamatricula, $values->fecharenovacion, $company->unidadproductiva_id);

        if(!Auth::check())
            Auth::login($user);

        $this->registarUnidadProductivaRutaC($company, $values);
        UnidadProductivaService::setUnidadProductiva($company->unidadproductiva_id);
       
        return redirect()->route('company.complete_info');
    }

    private function registarUnidadProductivaRutaC($company, $api)
    {
        $tipoPersona = UnidadProductivaPersona::where('tipoPersonaCODIGO', $company->tipopersona_id)->first();

        $datos = [
            'personaNIT' => $company->nit,
            'tipoPersonaRUTAC' => $tipoPersona->tipopersona_id,
            'tipoPersonaCODIGO' => $tipoPersona->tipoPersonaNOMBRE,
            'tipoIdentificacionCODIGO' => $company->tipo_identificacion,
            'personaIDENTIFICACION' => $company->identificacion,
            'personaRAZONSOCIAL' => $company->business_name,
            'personaNOMBRES' => $company->name_legal_representative,
            'personaAPELLIDOS' => '',
            'correoDIRECCION' => $company->registration_email,
            'telefonoNUMEROCELULAR' => $company->mobile,
            'direccionCOMERCIAL' => $company->address,
            'unidadProductivaTIPOREGISTRORUTAC' => $company->tipo_registro_rutac,
            'unidadProductivaTIPOREGISTRORUTACID' => $company->unidadtipo_id,
            'unidadProductivaFCHINICIO' => $company->registration_date,
            'unidadProductivaTITULO' => $company->business_name,
            'unidadProductivaDESCRIPCION' => $company->description,
            'unidadProductivaEMAIL' => $company->registration_email,
            'unidadProductivaENLACE' => $company->address,
            'unidadProductivaTELEFONO' => $company->mobile,
            'municipioCODIGODANE' => $api->muncom,
            'unidadProductivaDIRECCION' => $company->address,
            'unidadProductivaCONTACTONOMBRE' => $company->name_legal_representative,
            'unidadProductivaCONTACTOEMAIL' => $company->registration_email,
            'unidadProductivaCONTACTOTELEFONO' => $company->mobile,
            'unidadProductivaCAMARADECOMERCIO' => $company->camara_comercio,
            'unidadProductivaMATRICULA' => $company->registration_number,
            'unidadProductivaFCHMATRICULA' => $company->registration_date,
            'unidadProductivaNIT' => $company->nit,
            'unidadProductivaREPRESENTANTELEGAL' => $company->name_legal_representative,
            'REQUEST1' => $company->toArray(),
        ];
        
        $UnidadProductiva = SICAM32::registarNuevaUnidadProductiva($datos);
        SICAM32::actualizarIdRelacionadoUnidadProductiva($UnidadProductiva->unidadProductivaID, $company->unidadproductiva_id);
    }

    private function TraeCodigoTIpoIdentificon($idBuscar){

        $lista = SICAM32::listadoTiposIdentificacion();
        
        foreach ($lista as $item) {
            if($item->tipoIdentificacionID == $idBuscar){
                return $item->tipoIdentificacionCODIGO;
            }
        }

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
        $tipoIdentificacionCODIGO = $this->TraeCodigoTIpoIdentificon($request->tipo_identificacion);
        $municipio = Municipio::where('municipio_id', $request->municipality)->first();

        $datos = [
            'tipoPersonaRUTAC' => $tipoPersona->tipopersona_id,
            'tipoPersonaCODIGO' => $tipoPersona->tipoPersonaNOMBRE,
            'tipoIdentificacionCODIGO' => $tipoIdentificacionCODIGO,
            'personaIDENTIFICACION' => $request->document,
            'personaRAZONSOCIAL' => $request->personaRAZONSOCIAL,
            'personaNOMBRES' => $request->personaNOMBRES,
            'personaAPELLIDOS' => $request->personaAPELLIDOS,
            'correoDIRECCION' => $request->email,
            'telefonoNUMEROCELULAR' => $request->phone,
            'direccionCOMERCIAL' => $request->address,
            'unidadProductivaTIPOREGISTRORUTAC' => $tipoRegistro->unidadtipo_nombre,
            'unidadProductivaTIPOREGISTRORUTACID' => $tipoRegistro->unidadtipo_id,
            'unidadProductivaFCHINICIO' => $request->registration_date,
            'unidadProductivaTITULO' => $request->business_name,
            'unidadProductivaDESCRIPCION' => $request->description,
            'unidadProductivaEMAIL' => $request->email,
            'unidadProductivaENLACE' => $request->address,
            'unidadProductivaTELEFONO' => $request->phone,            
            'municipioCODIGODANE' => $municipio->municipioCODIGODANE,
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

        $company->logo = $this->getLogo($company->unidadtipo_id);
       
        $company->save();

        SICAM32::actualizarIdRelacionadoUnidadProductiva($UnidadProductiva->unidadProductivaID, $company->unidadproductiva_id);
        
        UnidadProductivaService::setUnidadProductiva($company->unidadproductiva_id);

        if(!Auth::check())
            Auth::login($user);
        
        return redirect()->route('company.complete_info');
    }
    
    private function getLogo($tipo)
    {
        $logo = '';

        switch($tipo)
        {
            case 1: $logo = 'idea_negocio'; break;
            case 2: $logo = 'informal_negocio_en_casa'; break;
            case 3: $logo = 'registrado_fuera_ccsm'; break;
            case 4: $logo = 'registrado_ccsm'; break;
        }

        return "img/registro/$logo.png";
    }
}
