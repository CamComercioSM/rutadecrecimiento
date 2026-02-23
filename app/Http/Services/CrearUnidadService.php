<?php

namespace App\Http\Services;

use App\helpers;
use App\Models\CiiuActividad;
use App\Models\Municipio;
use App\Models\UnidadProductiva;
use App\Models\UnidadProductivaPersona;

class CrearUnidadService {
    public static function datosApi($values) {
        $comercial_activity = substr($values->ciiu1, 1);
        $activity = CiiuActividad::where('ciiuActividadCODIGO', $comercial_activity)->first();

        //dd($values);

        $data = [
            'business_name' => $values->nombre,
            'razon_social' => $values->nombre,
            'nit_registrado' => (($values->organizacion ?? null) === '02'
                ? uniqid()
                : ($values->nit ?? null)),
            'registration_number' => $values->matricula,
            'registration_date' => date("Y-m-d", strtotime($values->fechamatricula)),
            'registration_email' => $values->emailcom ?? null,

            'address' => $values->dircom,
            'mobile' => helpers::firstNotEmpty(
                $values->telcom1 ?? null,
                $values->telcom2 ?? null,
                $values->telcom3 ?? null
            ),
            'telephone' => helpers::firstNotEmpty(
                $values->telcom3 ?? null,
                $values->telcom2 ?? null,
                $values->telcom1 ?? null
            ),
            'comercial_activity' => $comercial_activity,
            'tamano_id' => $values->tamanoempresa,
            'camara_comercio' => 32,

            'sector_id' => "{$activity->macroSectorID}",
            'ciiuactividad_id' => "{$activity->ciiuactividad_id}",
            'seccion' => "{$activity->ciiuSeccionID}"

        ];

        $tipoPersona = match ($values->organizacion) {
            '01' => UnidadProductivaPersona::where('tipopersona_id', 1)->first(),
            '02' => UnidadProductivaPersona::where('tipopersona_id', 2)->first(),
            default => UnidadProductivaPersona::where('tipopersona_id', 3)->first(),
        };


        // -------------------------------------------------------------------------
        // 3. Datos de identificación y representante legal
        // -------------------------------------------------------------------------
        // REGLA CLAVE:
        //   - organización = '01'  -> se usan los datos de la misma persona (expediente PN)
        //   - organización = '02'  -> se usan los datos del PROPIETARIO (representante legal principal):
        //        idclasepro, identificacionpro, nombrepro
        //   - organización ≠ 01/02 -> se usan los datos del representante legal normal del SII (idclaserl, identificacionrl, nombrerl)
        if ($values->organizacion === '01') {
            // Persona natural: el comerciante es su propio representante
            $idClaseIdentificacion = $values->idclase;
            $identificacion        = $values->identificacion;
            $nombreRepresentante   = $values->nombre;
        } elseif ($values->organizacion === '02') {
            // Establecimientos: los datos del representante se toman del propietario principal
            $idClaseIdentificacion = $values->idclasepro;      // Tipo de identificación del propietario
            $identificacion        = $values->identificacionpro;
            $nombreRepresentante   = $values->nombrepro;
            // Nota: $values->matriculapro queda disponible si en el futuro se requiere almacenar
            // la matrícula propia del representante, pero aquí se mantiene registration_number
            // con la matrícula del expediente principal.
        } else {
            // Juridicas y Otras organizaciones: se usan los datos de representante legal estándar del SII
            $idClaseIdentificacion = $values->idclaserl;
            $identificacion        = $values->identificacionrl;
            $nombreRepresentante   = $values->nombrerl;
        }
        // Tipo de identificación interno SICAM según clase SII
        $data['tipo_identificacion']       = SICAM32::codigoTIpoIdentificon($idClaseIdentificacion);
        $data['identificacion']            = $identificacion;
        $data['name_legal_representative'] = $nombreRepresentante;

        // Datos de tipo de persona interna
        $data['tipopersona_id'] = $tipoPersona->tipopersona_id;
        $data['type_person'] = $tipoPersona->tipoPersonaCODIGO;

        $municipio = Municipio::where('municipioCODIGODANE', $values->muncom)->first();
        $data['department_id'] = "{$municipio->departamentoID}";
        $data['municipality_id'] = "{$municipio->municipio_id}";

        $data['contact_person'] = $data['name_legal_representative'];
        $data['contact_email'] = $data['registration_email'];
        $data['contact_phone'] = $data['mobile'];

        return $data;
    }

    public static function crear($request, $tipoPersona, $tipoRegistro): UnidadProductiva {
        $company = new UnidadProductiva();

        $company->fill([
            'camara_comercio' => $request->camara_comercio,
            'nit' => $request->nit_registrado ?? "-",
            'business_name' => $request->business_name,
            'description' => $request->description,
            'registration_number' => $request->registration_number,
            'registration_date' => $request->registration_date,
            'registration_email' => $request->registration_email ?? $request->contact_email,
            'address' => $request->address,
            'telephone' => $request->telephone,
            'mobile' => $request->mobile,

            'sector_id' => $request->sector_id,
            'ciiuactividad_id' => $request->ciiuactividad_id,

            'municipality_id' => $request->municipality_id,
            'municipality_viejo' => $request->municipality_id,
            'department_id' => $request->department_id,
            'department_viejo' => $request->department_id,

            'geolocation' => UnidadProductivaService::localizacion($request->department_id, $request->municipality_id, $request->address),

            'name_legal_representative' => $request->name_legal_representative ?? $request->contact_person,
            'affiliated' => 0,
            'user_id' => $request->user_id,

            'tipo_identificacion' => $request->tipo_identificacion,
            'identificacion' => $request->identificacion,

            'unidadtipo_id' => $tipoRegistro->unidadtipo_id,
            'tipo_registro_rutac' => $tipoRegistro->unidadtipo_nombre,
            'tipopersona_id' => $tipoPersona->tipopersona_id,
            'type_person' => $tipoPersona->tipoPersonaCODIGO,
            'logo' => UnidadProductiva::getLogo($tipoRegistro->unidadtipo_id),

            'contact_person' => $request->contact_person,
            'contact_position' => $request->contact_position,
            'contact_sexo' => $request->contact_sexo,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,

            'website' => $request->website,
            'social_instagram' => $request->social_instagram,
            'social_facebook' => $request->social_facebook,
            'social_linkedin' => $request->social_linkedin,
        ]);

        if ($request->tipo_registro_rutac == 1) {
            $company->anual_sales = 0;
        }

        $company->update_info = 1;

        $company->save();

        // Enviar correo de unidad productiva creada
        if ($company->user_id) {
            $user = \App\Models\User::find($company->user_id);
            if ($user) {
                $nombreUsuario = $user->name . ' ' . $user->lastname;
                \App\Http\Services\EmailService::enviarCorreoUnidadProductiva($company->registration_email, $nombreUsuario, $company->business_name);
            }
        }

        return $company;
    }

    public static function datosRegistroRutaC($company): array {
        $municipio = Municipio::where('municipio_id', $company->municipality_id)->first();
        $tipoPersona = UnidadProductivaPersona::where('tipopersona_id', $company->tipopersona_id)->first();

        return [
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
            'unidadProductivaFCHINICIO' => $company->registration_date->format('Y-m-d'),
            'unidadProductivaTITULO' => $company->business_name,
            'unidadProductivaDESCRIPCION' => $company->description,
            'unidadProductivaEMAIL' => $company->registration_email,
            'unidadProductivaENLACE' => $company->address,
            'unidadProductivaTELEFONO' => $company->mobile,
            'municipioCODIGODANE' => $municipio->municipioCODIGODANE,
            'unidadProductivaDIRECCION' => $company->address,

            'unidadProductivaCONTACTONOMBRE' => $company->contact_person,
            'unidadProductivaCONTACTOEMAIL' => $company->contact_email,
            'unidadProductivaCONTACTOTELEFONO' => $company->contact_phone,

            'unidadProductivaCAMARADECOMERCIO' => $company->camara_comercio,
            'unidadProductivaMATRICULA' => $company->registration_number,
            'unidadProductivaFCHMATRICULA' => $company->registration_date->format('Y-m-d'),
            'unidadProductivaNIT' => $company->nit,
            'unidadProductivaREPRESENTANTELEGAL' => $company->name_legal_representative,
            'REQUEST1' => $company->toArray(),
        ];
    }
}
