<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class PreguntaTipo extends Resource
{
    public static $model = \App\Models\PreguntaTipo::class;
    public static $title = 'preguntatipo_nombre';
    public static $search = ['preguntatipo_id', 'preguntatipo_nombre'];

    public static function label() {
        return 'Tipos de preguntas';
    }

    public function fields(Request $request) {
        return [
            ID::make('preguntatipo_id'),

            Text::make('Nombre', 'preguntatipo_nombre')
                ->rules('required'),
        ];
    }
}
