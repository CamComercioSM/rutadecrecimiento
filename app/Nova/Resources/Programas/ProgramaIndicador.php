<?php

namespace App\Nova\Resources\Programas;

use App\Nova\Resources\Resource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;

class ProgramaIndicador extends Resource
{
    public static $model = \App\Models\ProgramaIndicador::class;
    public static $title = 'indicador_nombre';
    public static $search = ['indicador_id', 'indicador_nombre'];

    public static function label() {
        return 'Indicadores de programas';
    }

    public static function singularLabel(){
        return 'Indicador de programa';
    }

    public function fields(Request $request) {
        return [
            Text::make('Nombre', 'indicador_nombre')
                ->rules('required')
        ];
    }

    public static function uriKey()
    {
        return 'programas-indicadores';
    }
}
