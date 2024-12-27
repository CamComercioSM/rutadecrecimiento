<?php

namespace App\Nova\Resources\Generales;

use App\Nova\Resources\Resource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class Notificacion extends Resource {
    use HasSortableRows;

    public static $model = \App\Models\Notificacion::class;
    public static $title = 'notificacion_id';
    public static $search = ['notificacion_id', 'titulo'];

    public static function label() {
        return 'Notificaciones';
    }

    public static function singularLabel(){
        return 'Notificación';
    }

    public function fields(Request $request) {
        return [
            Text::make('Titulo', 'titulo')
                ->rules('required'),

            Textarea::make('Descripción', 'descripcion')
                ->rules('required'),

            Text::make('URL de enlace', 'url'),
        ];
    }
}
