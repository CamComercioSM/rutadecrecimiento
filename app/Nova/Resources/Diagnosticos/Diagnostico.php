<?php

namespace App\Nova\Resources\Diagnosticos;

use App\Nova\Resources\Resource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class Diagnostico extends Resource
{
    public static $model = \App\Models\Diagnostico::class;
    public static $title = 'diagnostico_nombre';
    public static $search = [
        'diagnostico_id', 'diagnostico_nombre'
    ];

    public static function label() {
        return 'Diagnósticos';
    }

    public static function singularLabel(){
        return 'Diagnóstico';
    }


    public function fields(Request $request) {
        return [
            ID::make('diagnostico_id'),

            Text::make('Nombre', 'diagnostico_nombre')
                ->rules('required'),
            
            Select::make('Etapa', 'diagnostico_etapa_id')
                ->options(\App\Models\Etapa::pluck('name', 'etapa_id')->toArray())
                ->displayUsingLabels(),

            Boolean::make('Con ventas', 'diagnostico_conventas')
                ->rules('required')
                ->trueValue(1)
                ->falseValue(0) 
                ->sortable(), 

            HasMany::make('Preguntas', 'preguntas', DiagnosticoPregunta::class),
        ];
    }

    public static function uriKey()
    {
        return 'diagnosticos';
    }
}
