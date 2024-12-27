<?php

namespace App\Nova\Resources\Generales;

use App\Nova\Resources\Resource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class PreguntaDimension extends Resource
{
    public static $model = \App\Models\PreguntaDimension::class;
    public static $title = 'preguntadimension_nombre';
    public static $search = ['preguntadimension_id', 'preguntadimension_nombre'];

    public static function label() {
        return 'Dimensiones de preguntas';
    }

    public function fields(Request $request) {
        return [
            ID::make('preguntadimension_id'),

            Text::make('Nombre', 'preguntadimension_nombre')
                ->rules('required'),
        ];
    }
}
