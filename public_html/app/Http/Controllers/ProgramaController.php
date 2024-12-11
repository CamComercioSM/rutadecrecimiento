<?php

namespace App\Http\Controllers;
use App\Http\Services\CommonService;
use App\Http\Services\UnidadProductivaService;
use App\Models\ProgramaConvocatoria;
use App\Models\Etapa;
use Illuminate\Http\Request;
use App\Models\ConvocatoriaInscripcion;
use App\Models\Section;

use App\Models\Link;


class ProgramaController extends Controller
{

    public function testProgramas()
    {
        $inscripciones = ConvocatoriaInscripcion::with('programa')->limit(10)->get();     
        
        foreach ($inscripciones as $inscripcion) {
            $programaNombre = $inscripcion->programa ? $inscripcion->programa->nombre : 'No asignado';
            echo 'Programa: ' . $programaNombre . ' - Unidad Productiva ID: ' . $inscripcion->unidadproductiva_id . '<br>';
        }
    
        return;
    }
    
    public function index(){
        $unidadProductiva = UnidadProductivaService::getUnidadProductiva();
        
        $programas_inscrito = ProgramaConvocatoria::whereHas('inscripciones', function ($query) use ($unidadProductiva) {
            $query->where('unidadproductiva_id', $unidadProductiva->unidadproductiva_id);
        })->where('fecha_apertura_convocatoria', '<=', date('Y-m-d'))->get();
        
        $programs_recommend = ProgramaConvocatoria::whereHas('etapas', function ($query) use ($unidadProductiva) {
            $query->where('convocatorias_etapas.etapa_id', $unidadProductiva->etapa_id);
        })->where('fecha_apertura_convocatoria', '<=', date('Y-m-d'))
          ->where('fecha_cierre_convocatoria', '>=', date('Y-m-d'))->get();
    
        $programas_otros = ProgramaConvocatoria::whereDoesntHave('etapas', function ($query) use ($unidadProductiva) {
            $query->where('convocatorias_etapas.etapa_id', $unidadProductiva->etapa_id);
        })->where('fecha_apertura_convocatoria', '<=', date('Y-m-d'))
          ->where('fecha_cierre_convocatoria', '>=', date('Y-m-d'))->get();
    
        $programas_cerrados = ProgramaConvocatoria::whereDoesntHave('etapas', function ($query) use ($unidadProductiva) {
            $query->where('convocatorias_etapas.etapa_id', $unidadProductiva->etapa_id);
        })->where('fecha_cierre_convocatoria', '<=', date('Y-m-d'))->get();
    
        $programas_cerrados_recomendados = ProgramaConvocatoria::whereHas('etapas', function ($query) use ($unidadProductiva) {
            $query->where('convocatorias_etapas.etapa_id', $unidadProductiva->etapa_id);
        })->where('fecha_cierre_convocatoria', '<=', date('Y-m-d'))->get();
    
        $etapa = Etapa::find($unidadProductiva->etapa_id);
        $nombreEtapa = $etapa ? $etapa->name : 'Etapa no encontrada';
    
        $helper_default = [
            'title' => 'Bienvenido',
            'message' => 'Te invitamos a seleccionar una opción del panel lateral izquierdo. En el menú principal, puedes seleccionar entre visualizar perfil, programas, cápsulas o cerrar sesión.',
        ];
    
        $data = [
            'footer' => CommonService::footer(),
            'links' => CommonService::links(),
            'helper_notifications' => CommonService::notifacaciones($helper_default),
            'programas_inscrito' => $programas_inscrito,
            'programas_otros' => $programas_otros,
            'programs_recommend' => $programs_recommend,
            'programas_cerrados' => $programas_cerrados,
            'programas_cerrados_recomendados' => $programas_cerrados_recomendados,
            'unidadProductiva' => $unidadProductiva,
            'nombreEtapa' => $nombreEtapa, 
        ];
    
        return view('website.program.index', $data);
    }

    public function programShow(Request $request) {
        $unidadProductiva = UnidadProductivaService::getUnidadProductiva();
        
        $program = ProgramaConvocatoria::where('convocatoria_id', $request->id)->first();
    
        // Verificar si el programa existe
        if (!$program) {
            return redirect()->route('programas.index')->withErrors(['error' => 'El programa no fue encontrado.']);
        }
    
        $section = Section::find(1);
        $json_data = json_decode($section->data);
        $footer = $json_data[1]->attributes;
        $links = Link::all();
    
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
    
            $inscripcion = ConvocatoriaInscripcion::where('programa_id', $program->convocatoria_id)
                ->where('unidadproductiva_id', $unidadProductiva->unidadproductiva_id)
                ->latest()
                ->first();
            
            $already_subscribed = false;
            $states = [0, 1, 2, 4, 5]; // Estados en los cuales no puede volver a inscribirse en un programa
            
            if ($inscripcion && in_array($inscripcion->inscripcionestado_id, $states)) {
                $already_subscribed = true;
            }
            
        }
        

        return view('website.program.show', compact('unidadProductiva', 'program', 'already_subscribed', 'inscripcion', 'can_apply', 'footer', 'links'));
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
            'helper_notifications' => CommonService::notifacaciones($helper_default),
            'nombreEtapa' => $nombreEtapa, // Pass the stage name to the view
        ];
    
        return view('website.capsule.index', $data);
    }
   
}
