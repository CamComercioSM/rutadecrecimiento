<?php

namespace App\Nova\Resources\Programas;

use App\Nova\Resources\Resource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class InscripcionesRequisitos extends Resource
{
    public static $model = \App\Models\InscripcionesRequisitos::class;
    public static $title = 'requisito_titulo';
    public static $search = [
        'requisito_id', 'requisito_titulo'
    ];

    public static function label() {
        return 'Banco de requisitos convocatorias';
    }

    public static function singularLabel(){
        return 'Requisito convocatoria';
    }
    
    public function fields(Request $request) {
        return [
            ID::make('requisito_id'),

            Text::make('Nombre', 'requisito_titulo')
                ->rules('required'),

            Select::make('Tipo', 'preguntatipo_id')
                ->hideFromIndex()
                ->options(\App\Models\PreguntaTipo::pluck('preguntatipo_nombre', 'preguntatipo_id')->toArray())
                ->displayUsingLabels()
                ->rules('required'),

            HasMany::make('Opciones', 'opciones', RequisitosOpciones::class)
                ->canSee(function () {return $this->tipo && $this->tipo->preguntatipo_opciones; }),
        ];
    }

    public static function indexQuery(Request $request, $query)
    {
        return $query->whereNull('indicador_id'); 
    }

    public static function uriKey()
    {
        return 'requisitos-convocatorias';
    }
}
