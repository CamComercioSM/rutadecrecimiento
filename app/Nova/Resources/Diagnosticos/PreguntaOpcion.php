<?php

namespace App\Nova\Resources\Diagnosticos;

use App\Nova\Resources\Resource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

class PreguntaOpcion extends Resource
{
    public static $model = \App\Models\PreguntaOpcion::class;
    public static $title = 'opcion_variable_response';
    public static $search = [
        'opcion_id', 'opcion_variable_response'
    ];

    public static function label() {
        return 'Opciones de pregunta diagnóstico';
    }

    public static function singularLabel(){
        return 'Opción de pregunta diagnóstico';
    }

    public function fields(Request $request)
    {
        return [
            ID::make('opcion_id'),
            
            BelongsTo::make('Pregunta', 'pregunta', DiagnosticoPregunta::class)
            ->displayUsing(function ($q) { return $q->pregunta_titulo; })
            ->rules('required'),

            Text::make('Respuesta', 'opcion_variable_response')->rules('required'),
            Number::make('Porcentaje', 'opcion_percentage')->min(0)->max(100)->rules('required')
        ];
    }

    public static function uriKey()
    {
        return 'diagnostico-pregunta-opciones';
    }
}
