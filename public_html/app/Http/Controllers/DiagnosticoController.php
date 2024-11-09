<?php

namespace App\Http\Controllers;

use App\Http\Services\CommonService;
use App\Http\Services\UnidadProductivaService;
use App\Models\DiagnosticoPregunta;
use App\Models\DiagnosticoRespuesta;
use App\Models\DiagnosticoResultado;
use App\Models\VentasAnuales;
use Illuminate\Http\Request;

class DiagnosticoController extends Controller
{
   
    public function index(Request $request)
    {
        $unidadProductiva = UnidadProductivaService::getUnidadProductiva();
        
        if($request->sells)
        {
            $es_ventas = $request->sells == 'ventas';
            $preguntas = DiagnosticoPregunta::where('pregunta_sobreventas', $es_ventas)
                ->where('pregunta_opcionesJSON', '!=', null)->get();
            $ventas = VentasAnuales::where('sectorCODIGO',  $unidadProductiva->sector->sector_id ?? 0)->get();
        }
        
        $data = [
            'footer'=> CommonService::footer(),
            'links'=> CommonService::links(),
            'company'=> $unidadProductiva,
            'preguntas'=> $preguntas ?? null,
            'arranquePOR'=> UnidadProductivaService::validarDiagnostico($unidadProductiva),
            'ventas'=> $ventas ?? null,
            'sells'=> $request->sells,
        ];

        return view('website.company.diagnostic', $data);
    }

    public function store(Request $request)
    {
        $unidadProductiva = UnidadProductivaService::getUnidadProductiva();
        $tipo_diagnostico = $request->sells;

        $diagnostico = New DiagnosticoResultado();
        $diagnostico->unidadproductiva_id = $unidadProductiva->unidadproductiva_id;
        $diagnostico->resultado_puntaje = 0;
        $diagnostico->save();

        $unidadProductiva->etapa_id = 1;

        if ($tipo_diagnostico == 'ventas') 
        {
            $unidadProductiva->anual_sales = $request->anual_sales;

            $diagnostico->resultado_puntaje = UnidadProductivaService::getPuntajeDiagnostico($unidadProductiva);
            $unidadProductiva->etapa_id = UnidadProductivaService::getEtapa($diagnostico->resultado_puntaje);
        } 

        foreach ($request->all() as $key => $value) 
        {
            if( $key != 'anual_sales' && $key != '_token' && $key != 'sells')
            {
                $pregunta_id = str_replace('variable-', '', $key);

                $respuesta = New DiagnosticoRespuesta();
                $respuesta->resultado_id = $diagnostico->resultado_id;
                $respuesta->pregunta_id = $pregunta_id;
                $respuesta->diagnosticorespuesta_valor = $value;
                $respuesta->save();

                if ($tipo_diagnostico == 'ventas') {
                    // Si el crecimiento de la empresa ha sido mayor al 10%
                    if ($pregunta_id == 3 && $value == 3)
                        UnidadProductivaService::crearAlerta(1, $unidadProductiva->unidadproductiva_id);
                }
            }
        }

        $diagnostico->etapa_id = $unidadProductiva->etapa_id;
        $diagnostico->save();

        $unidadProductiva->complete_diagnostic = 1;
        $unidadProductiva->save();

        return redirect()->route('company.dashboard');
    }
    
}
