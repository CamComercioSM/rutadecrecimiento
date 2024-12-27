<?php

namespace App\Nova\Resources\Generales;

use App\Nova\Resources\Resource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class PreguntaGrupo extends Resource
{
    public static $model = \App\Models\PreguntaGrupo::class;
    public static $title = 'preguntagrupo_nombre';
    public static $search = ['preguntagrupo_id', 'preguntagrupo_nombre'];

    public static function label() {
        return 'Grupos de preguntas';
    }

    public function fields(Request $request) {
        return [
            ID::make('preguntagrupo_id'),

            Text::make('Nombre', 'preguntagrupo_nombre')
                ->rules('required'),
        ];
    }
}
