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
            
            BelongsTo::make('Requisito', 'requisito', InscripcionesRequisitos::class)->sortable(),
            
            Text::make('Referencia', function () {

                $convocatoria_id = $this->inscripcion->convocatoria_id ?? null;

                if (!$convocatoria_id) {
                    return null;
                }

                $requisitoConvocatoria = $this->requisito->requisitosConvocatoria($convocatoria_id)->first();

                return $requisitoConvocatoria->pivot->referencia ?? null;
            }),
                        
            Text::make('Respuesta', 'value'),

            Text::make('Fecha respuesta', 'fecha_respuesta'),
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
