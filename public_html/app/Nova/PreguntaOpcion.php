<?php

namespace App\Nova;

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
        return 'Opciones de pregunta diagnostico';
    }

    public function fields(Request $request)
    {
        return [
            ID::make('opcion_id'),
            
            BelongsTo::make('Pregunta', 'pregunta', DiagnosticoPregunta::class)
            ->displayUsing(function ($q) { return $q->pregunta_titulo; })
            ->rules('required'),

            Text::make('Respuesta', 'opcion_variable_response')->rules('required'),
            Number::make('Porcentaje', 'opcion_percentage')->min(0)->max(100)->rules('required'),

            Text::make('Layout', 'opcion_layout')->rules('required'),
            Text::make('Key', 'opcion_key')->rules('required'),
            Text::make('Attributes', 'opcion_attributes')->rules('required'),
        ];
    }

    public static function uriKey()
    {
        return 'diagnostico-pregunta-opciones';
    }
}
