<?php

namespace App\Nova\Resources\Inscripciones;

use App\Nova\Actions\ExportarInscripcionesConocatorias;
use App\Nova\Actions\ExportarInscripcionesConocatoriasRequisitos;
use App\Nova\Resources\Resource;
use App\Nova\Resources\Empresarios\UnidadProductiva;
use App\Nova\Resources\Programas\ProgramaConvocatoria;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;

class ConvocatoriaInscripcion extends Resource
{
    public static $model = \App\Models\ConvocatoriaInscripcion::class;

    public static $title = 'inscripcion_id';
    public static $search = [ 'inscripcion_id' ];

    public static function label() {
        return 'Inscripciones';
    }

    public static function singularLabel(){
        return 'Inscripción';
    }

    public function fields(Request $request) {
        return 
        [
            BelongsTo::make('Convocatoria', 'convocatoria', ProgramaConvocatoria::class)
            ->viewable(false)->withoutTrashed()->hideWhenUpdating(),

            BelongsTo::make('Unidad Productiva', 'unidadproductiva', UnidadProductiva::class)
            ->viewable(false)->withoutTrashed()->hideWhenUpdating(),
                        
            Select::make('Estado', 'inscripcionestado_id')
                ->options(\App\Models\InscripcionEstado::pluck('inscripcionEstadoNOMBRE', 'inscripcionestado_id')->toArray())
                ->displayUsingLabels(),

            DateTime::make('Fecha de inscripción', 'fecha_creacion')
                ->hideWhenUpdating()->hideWhenCreating(),
            
            Textarea::make('Comentarios', 'comentarios'),

            File::make('Archivo', 'archivo')
                    ->disk('public')
                    ->path('aplications'),

            HasMany::make('Respuestas', 'respuestas', ConvocatoriaRespuesta::class),

            HasMany::make('Historial', 'historial', ConvocatoriaInscripcionHistorial::class),
        ];
    }

    public function actions(Request $request) {
        return [ 
            new ExportarInscripcionesConocatorias(),
            new ExportarInscripcionesConocatoriasRequisitos(),
        ];
    } 

    public static function uriKey()
    {
        return 'inscripciones-convocatorias';
    }
}
