<?php

namespace App\Http\Controllers;
use App\Http\Services\CommonService;
use App\Http\Services\SICAM32;
use App\Http\Services\UnidadProductivaService;
use App\Models\ProgramaConvocatoria;
use App\Models\Etapa;
use Illuminate\Http\Request;
use App\Models\ConvocatoriaInscripcion;
use App\Models\ConvocatoriaRespuesta;
use App\Models\InscripcionesRequisitos;
use App\Models\Programa;
use App\Models\RequisitosOpciones;

class ProgramaController extends Controller
{
    public function index()
    {
        $unidadProductiva = UnidadProductivaService::getUnidadProductiva();
        $fechaActual = date('Y-m-d');
        
        $programas_inscrito = ProgramaConvocatoria::whereHas('inscripciones', function ($query) use ($unidadProductiva) {
            $query->where('unidadproductiva_id', $unidadProductiva->unidadproductiva_id);
        })->where('fecha_apertura_convocatoria', '<=', $fechaActual)->get();
    
        $programs_recommend = ProgramaConvocatoria::whereHas('etapas', function ($query) use ($unidadProductiva) {
            $query->where('convocatorias_etapas.etapa_id', $unidadProductiva->etapa_id);
        })->where('fecha_apertura_convocatoria', '<=', $fechaActual)
          ->where('fecha_cierre_convocatoria', '>=', $fechaActual)->get();
          
        $programas_otros = ProgramaConvocatoria::whereDoesntHave('etapas', function ($query) use ($unidadProductiva) {
            $query->where('convocatorias_etapas.etapa_id', $unidadProductiva->etapa_id);
        })->where('fecha_apertura_convocatoria', '<=', $fechaActual)
          ->where('fecha_cierre_convocatoria', '>=', $fechaActual)->get();
    
        $programas_cerrados = ProgramaConvocatoria::whereDoesntHave('etapas', function ($query) use ($unidadProductiva) {
            $query->where('convocatorias_etapas.etapa_id', $unidadProductiva->etapa_id);
        })->where('fecha_cierre_convocatoria', '<=', $fechaActual)->get();
    
        $programas_cerrados_recomendados = ProgramaConvocatoria::whereHas('etapas', function ($query) use ($unidadProductiva) {
            $query->where('convocatorias_etapas.etapa_id', $unidadProductiva->etapa_id);
        })->where('fecha_cierre_convocatoria', '<=', $fechaActual)->get();
      
        $helper_default = [
            'title' => 'Bienvenido',
            'message' => 'Te invitamos a seleccionar una opción del panel lateral izquierdo. En el menú principal, puedes seleccionar entre visualizar perfil, programas, cápsulas o cerrar sesión.',
        ];
       
        $data = [
            'footer' => CommonService::footer(),
            'links' => CommonService::links(),
            'helper_notifications' => CommonService::notificaciones($helper_default),
            'programas_inscrito' => $programas_inscrito,
            'programas_otros' => $programas_otros,
            'programs_recommend' => $programs_recommend,
            'programas_cerrados' => $programas_cerrados,
            'programas_cerrados_recomendados' => $programas_cerrados_recomendados,
            'unidadProductiva' => $unidadProductiva,
            'nombreEtapa' => $unidadProductiva->etapa->name, 
        ];
        
        return view('website.program.index', $data);
    }

    public function programShow(Request $request)
    {
        $unidadProductiva = UnidadProductivaService::getUnidadProductiva();        
        $program = ProgramaConvocatoria::where('convocatoria_id', $request->id)->first();
    
        if (!$program) {
            return redirect()->route('programas.index')
                ->withErrors(['error' => 'El programa no fue encontrado.']);
        }
    
        // Variable de si la empresa puede aplicar al programa
        if ($program->con_matricula == "1" && empty($unidadProductiva->registration_number)) {
            $can_apply = false;
            $already_subscribed = false;
            $inscripcion = null;
        } else {
            $program_validation = ProgramaConvocatoria::where('convocatoria_id', $program->convocatoria_id)
                ->whereHas('etapas', function ($query) use ($unidadProductiva) {
                    $query->where('convocatorias_etapas.etapa_id', $unidadProductiva->etapa_id);
                })->get();
    
            $can_apply = count($program_validation) > 0;
    
            $inscripcion = ConvocatoriaInscripcion::where('convocatoria_id', $program->convocatoria_id)
                ->where('unidadproductiva_id', $unidadProductiva->unidadproductiva_id)
                ->latest()
                ->first();
            
            $already_subscribed = false;
            $states = [0, 1, 2, 4, 5]; // Estados en los cuales no puede volver a inscribirse en un programa
            
            if ($inscripcion && in_array($inscripcion->inscripcionestado_id, $states)) {
                $already_subscribed = true;
            }
            
        }

        $data = [
            'footer'=> CommonService::footer(),
            'links'=> CommonService::links(),
            'unidadProductiva'=> $unidadProductiva,
            'program'=> $program,
            'helper_notifications'=> CommonService::notificaciones(),
            'already_subscribed'=> $already_subscribed,
            'inscripcion'=> $inscripcion,
            'can_apply'=> $can_apply,
        ];

        return view('website.program.show', $data);
    }

    public function programRegister(Request $request)
    {
        $company =  UnidadProductivaService::getUnidadProductiva();
        $program = Programa::find($request->id);
        
        //
        $inscrito = $company->inscripciones->where('convocatoria_id', $program->id);
        if (count($inscrito) ) {
            return redirect()->back()->with('error', 'Ya estas INSCRITO para este programa.');
        }

        //valide si la empresa ya se encuentra inscrita en alguno de los estados donde ya no puede volverse a inscribir en un programa
        // Deshabilitado temporalmente
        $exists = $company->inscripciones->whereIn('inscripcionestado_id', [1, 2,4]);
        if (count($exists) > 2) {
            return redirect()->back()->with('error', 'Ya hay dos solicitudes activas para diferentes programas. No puede inscribirse en más de dos programas');
        }

        
        if ($program->convocatoriaCONMATRICULA == "1") 
        {
            $api = SICAM32::consultarExpedienteMercantilporIdentificacion($company->nit);
            $values = $api->DATOS;

            UnidadProductivaService::validarRenovacion($values->fecharenovacion, $company->unidadproductiva_id);
            UnidadProductivaService::validarSiguienteRenovacion($values->fechamatricula, $values->fecharenovacion, $company->unidadproductiva_id);

            //Validamos que la API haya respondido de manera correcta
            if ($api->RESPUESTA != 'EXITO')
                return redirect()->back()->with('error', 'No se pudo validar en este momento. Espere unos minutos e intente nuevamente');

            if ($values->estado != 'MA') {
                // Si la empresa no tiene el estado MA, quiere decir que no ha renovado su matricula. Y debe crearse una alerta.
                UnidadProductivaService::crearAlerta(0, $company->unidadproductiva_id);
                return redirect()->back()->with('error', 'No se puede inscribir en este programa. La matrícula de su empresa no lo permite');
            }
        }

        $variables = $program->requisitos();

        if (count($variables) == 0) {
            return redirect()->back()->with('error', 'No hay variables vinculadas al programa');
        }

        /*
         * Recorremos las variables para saber si ya han sido respondidas anteriormente
         * Si encontramos que el usuario ha respondido esa misma variable, validamos el tiempo de respuesta.
         * Si es menor a 30 dias, eliminamos esa variable de la collection
        */

        // Variable para llevar el registro de las preguntas que ya completo anteriormente.
        // TODO: Tenerlas en cuenta luego para indicar que no se respondieron?

        $fecha = now()->subMonth();

        foreach ($variables as $key => $variable) {
            $answer = ConvocatoriaRespuesta::
                whereHas('inscripcion', function ($q) use($company){
                    $q->where('unidadproductiva_id', $company->unidadproductiva_id);
                })
                ->where('requisito_id', $variable->requisito_id)
                ->where('fecha_creacion', '>=', $fecha)
                ->get()->last();

            if ($answer == null)
                continue;

            //Agrego el id de la variable ya respondida al array y remuevo variable de la collection
            $variables->forget($key);
        }

        $data = [
            'footer'=> CommonService::footer(),
            'links'=> CommonService::links(),
            'program'=> $program,
            'variables'=> $variables,
        ];
        
        return view('website.company.program_questions', $data);
    }

    public function applicationSave(Request $request) {

        $company =  UnidadProductivaService::getUnidadProductiva();
        $convocatoria_id = $request->program;
        
        $fecha = now();
        $inscripcion = New ConvocatoriaInscripcion();
        $inscripcion->unidadproductiva_id = $company->unidadproductiva_id;
        $inscripcion->convocatoria_id = $convocatoria_id;
        $inscripcion->inscripcionestado_id = 1;
        $inscripcion->comentarios = "Solicitud de registro enviada";
        $inscripcion->save();

        foreach ($request->all() as $key => $value) 
        {
            if( str_starts_with($key, 'variable-') )
            {
                $pregunta_id = str_replace('variable-', '', $key);

                $pregunta = InscripcionesRequisitos::find($pregunta_id);
                $opcion = RequisitosOpciones::find($value);

                $respuesta = New ConvocatoriaRespuesta();
                $respuesta->inscripcion_id = $inscripcion->inscripcion_id;
                $respuesta->requisito_id = $pregunta->requisito_id;
                $respuesta->value = $opcion->opcion_variable_response ?? $value;
                $respuesta->fecha_respuesta = $fecha;
                $respuesta->save();
            }
        }
        
        return redirect()->route('company.program.show', ['id' => $convocatoria_id])
            ->with('success', 'Su solicitud se ha enviado correctamente');
    }
    
    public function capsulas() {
        
        $unidadProductiva = UnidadProductivaService::getUnidadProductiva();
    
        // Get the current stage of the unit and its name
        $etapa = Etapa::find($unidadProductiva->etapa_id);
        $nombreEtapa = $etapa ? $etapa->name : 'Etapa no encontrada';
        
        $helper_default = [
            'title' => 'Recomendación para la sección de cápsulas',
            'message' => 'Visualiza las cápsulas que sean de mayor interés para tu empresa. Nuestras cápsulas te ayudarán a mejorar tu desempeño en el proceso de crecimiento',
        ];
    
        $data = [
            'company' => $unidadProductiva,
            'capsules' => CommonService::capsulas(),
            'helper_notifications' => CommonService::notificaciones($helper_default),
            'nombreEtapa' => $nombreEtapa, // Pass the stage name to the view
        ];
    
        return view('website.capsule.index', $data);
    }
   
}
