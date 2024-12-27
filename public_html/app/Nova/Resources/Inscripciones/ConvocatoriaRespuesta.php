<?php

namespace App\Nova\Resources\Inscripciones;

use App\Nova\Actions\ExportarInscripcionesRequisitos;
use App\Nova\Resources\Programas\InscripcionesRequisitos;
use App\Nova\Resources\Resource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class ConvocatoriaRespuesta extends Resource
{
    public static $model = \App\Models\ConvocatoriaRespuesta::class;

    public static $title = 'convocatoriarespuesta_id';
    public static $search = [ 'convocatoriarespuesta_id' ];

    public static function label() {
        return 'Respuestas';
    }

    public static function singularLabel(){
        return 'Respuesta';
    }

    public function fields(Request $request) {
        return 
        [
            ID::make('ID', 'convocatoriarespuesta_id')->sortable(),

            BelongsTo::make('Inscripción', 'inscripcion', ConvocatoriaInscripcion::class)->sortable(),
            
            BelongsTo::make('Requisito', 'inscripcion', InscripcionesRequisitos::class)->sortable(),
                        
            Text::make('Respuesta', 'value'),
        ];
    }

    public function actions(Request $request) {
        return [ 
            new ExportarInscripcionesRequisitos(),
        ];
    } 

    public static function uriKey()
    {
        return 'inscripcion-convocatoria-respuestas';
    }
}
