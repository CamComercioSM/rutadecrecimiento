<?php

namespace App\Nova\Resources\Diagnosticos;

use App\Nova\Actions\ExportarDiagnosticoRespuesta;
use App\Nova\Resources\Resource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class DiagnosticoRespuesta extends Resource
{
    public static $model = \App\Models\DiagnosticoRespuesta::class;

    public static $title = 'resultado_id';
    public static $search = [ 'resultado_id' ];

    public static function label() {
        return 'Respuestas de diagnósticos';
    }

    public static function singularLabel(){
        return 'Respuesta de diagnóstico';
    }

    public function fields(Request $request) {
        return [
            ID::make('ID', 'diagnosticorespuesta_id')->sortable(),

            BelongsTo::make('Pregunta', 'pregunta', DiagnosticoPregunta::class),

            Text::make('Respuesta', 'diagnosticorespuesta_valor'),

            Text::make('Porcentaje', 'diagnosticorespuesta_porcentaje'),
           
        ];
    }

    public function actions(Request $request) {
        return [ new ExportarDiagnosticoRespuesta() ];
    }

    public static function uriKey()
    {
        return 'diagnosticos-resultados-preguntas';
    }
}
