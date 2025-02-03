<?php

namespace App\Http\Controllers;

use App\Http\Services\CommonService;
use App\Http\Services\UnidadProductivaService;
use App\Models\Diagnostico;
use App\Models\DiagnosticoPregunta;
use App\Models\DiagnosticoRespuesta;
use App\Models\DiagnosticoResultado;
use App\Models\PreguntaOpcion;
use App\Models\VentasAnuales;
use Illuminate\Http\Request;

class DiagnosticoController extends Controller
{

    public function index(Request $request)
    {
        $unidadProductiva = UnidadProductivaService::getUnidadProductiva();

        if( !($unidadProductiva->sector_id > 0) ){
            return redirect()->route('company.complete_info');
        }

        if($request->anual_sales != null)
        {
            $unidadProductiva->anual_sales = $request->anual_sales;
            $unidadProductiva->save();
        }
        
        $data = [
            'footer'=> CommonService::footer(),
            'links'=> CommonService::links(),
            'company'=> $unidadProductiva,
            'arranquePOR'=> UnidadProductivaService::validarDiagnostico($unidadProductiva),
        ];

        if($unidadProductiva->anual_sales != null)
        {
            $diagnostico = Diagnostico::where([ 
                ['diagnostico_etapa_id', $unidadProductiva->etapa_id], 
                ['diagnostico_conventas', $unidadProductiva->anual_sales] 
            ])->first();
            
            if($diagnostico == null)
            {
                $diagnostico = Diagnostico::where([ 
                    ['diagnostico_etapa_id', null], 
                    ['diagnostico_conventas', $unidadProductiva->anual_sales == 1] 
                ])->first();
            }   

            $data['preguntas'] = DiagnosticoPregunta::whereNull('diagnostico_id')
                    ->union(
                        DiagnosticoPregunta::where('diagnostico_id', $diagnostico->diagnostico_id)
                    )
                    ->get();

            $data['preguntas']->load('opciones');

            $data['diagnosticoId'] = $diagnostico->diagnostico_id;
         
            if($unidadProductiva->anual_sales)
            {
                $sector = $unidadProductiva->sector()->first();

                $data['ventas'] = VentasAnuales::where('sectorCODIGO',  $sector->sectorCODIGO )->get();
            }
        }

        return view('website.company.diagnostic', $data);
    }

    public function store(Request $request)
    {
        $unidadProductiva = UnidadProductivaService::getUnidadProductiva();

        $diagnostico = New DiagnosticoResultado();
        $diagnostico->unidadproductiva_id = $unidadProductiva->unidadproductiva_id;
        $diagnostico->resultado_puntaje = 0;
        $diagnostico->save();

        $unidadProductiva->etapa_id = 1;
        $resultado_puntaje = 0;

        foreach ($request->all() as $key => $value) 
        {
            if( str_starts_with($key, 'variable-') )
            {
                $pregunta_id = str_replace('variable-', '', $key);

                $pregunta = DiagnosticoPregunta::find($pregunta_id);
                $opcion = PreguntaOpcion::find($value);

                $respuesta = New DiagnosticoRespuesta();
                $respuesta->resultado_id = $diagnostico->resultado_id;
                $respuesta->pregunta_id = $pregunta->pregunta_id;
                $respuesta->diagnosticorespuesta_valor = $opcion->opcion_variable_response;

                $respuesta->diagnosticorespuesta_porcentaje = 
                    ($pregunta->pregunta_porcentaje/100) * ($opcion->opcion_percentage);

                $respuesta->save();

                $resultado_puntaje += $respuesta->diagnosticorespuesta_porcentaje;
            }
        }

        if ($unidadProductiva->anual_sales == 1) 
        {
            $unidadProductiva->ventaanual_id = $request->anual_sales;
            $unidadProductiva->etapa_id = UnidadProductivaService::getEtapa($resultado_puntaje);
        } 

        $diagnostico->resultado_puntaje = $resultado_puntaje;
        $diagnostico->etapa_id = $unidadProductiva->etapa_id;
        $diagnostico->save();

        $unidadProductiva->complete_diagnostic = 1;
        $unidadProductiva->save();

        return redirect()->route('company.dashboard');
    }
    
}
