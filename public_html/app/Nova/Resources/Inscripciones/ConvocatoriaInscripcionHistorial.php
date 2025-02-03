<?php

namespace App\Nova\Resources\Inscripciones;

use App\Nova\Actions\ExportarInscripcionHistorial;
use App\Nova\Resources\Resource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class ConvocatoriaInscripcionHistorial extends Resource
{
    public static $model = \App\Models\ConvocatoriaInscripcionHistorial::class;

    public static $title = 'historial_id';
    public static $search = [ 'historial_id' ];

    public static function label() {
        return 'Historial  inscripción';
    }

    public static function singularLabel() {
        return 'Historial  inscripción';
    }

    public function fields(Request $request) {
        return 
        [
            ID::make('ID', 'historial_id')->sortable(),
            
            DateTime::make('Fecha de inscripción', 'fecha_creacion')
            ->hideWhenUpdating()->hideWhenCreating(),
            
            Text::make('Estado', function () {
                return $this->estado->inscripcionEstadoNOMBRE ?? '';
            })->sortable(),
            
            Text::make('Comentarios', 'comentarios'),

            File::make('Archivo', 'archivo')
                    ->disk('public')
                    ->path('aplications'),
        ];
    }

    public function actions(Request $request) {
        return [ 
            new ExportarInscripcionHistorial(),
        ];
    } 

    public static function uriKey()
    {
        return 'inscripciones-convocatoria-historial';
    }
}
