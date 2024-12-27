<?php

namespace App\Nova\Resources\Programas;

use App\Nova\Resources\Resource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

class RequisitosOpciones extends Resource
{
    public static $model = \App\Models\RequisitosOpciones::class;
    public static $title = 'opcion_variable_response';
    public static $search = [
        'opcionrequisito_id', 'opcion_variable_response'
    ];

    public static function label() {
        return 'Opciones de requisitos';
    }

    public function fields(Request $request)
    {
        return [
            ID::make('opcionrequisito_id'),
            
            BelongsTo::make('Requisito', 'requisito', InscripcionesRequisitos::class)
            ->displayUsing(function ($q) { return $q->requisito_titulo; })
            ->rules('required'),

            Text::make('Respuesta', 'opcion_variable_response')->rules('required'),
            Number::make('Porcentaje', 'opcion_percentage')->min(0)->max(100)->rules('required'),
        ];
    }

    public static function uriKey()
    {
        return 'requisitos-opciones';
    }
}
