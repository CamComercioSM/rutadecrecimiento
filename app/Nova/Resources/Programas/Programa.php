<?php

namespace App\Nova\Resources\Programas;

use App\Nova\Resources\Generales\Etapa;
use App\Nova\Resources\Resource;
use Benjacho\BelongsToManyField\BelongsToManyField;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class Programa extends Resource
{
    public static $model = \App\Models\Programa::class;
    public static $title = 'nombre';
    public static $search = ['programa_id', 'nombre'];

    public static function label() {
        return 'Programas';
    }

    public static function singularLabel(){
        return 'Programa';
    }

    public function fields(Request $request) {
        return [
            Text::make('Nombre', 'nombre')
                ->rules('required'),

            Textarea::make('Descripción', 'descripcion')
                ->rules('required'),

            Image::make('Logotipo', 'logo')
                ->disk('public')->path('programas'),

            Textarea::make('Beneficios', 'beneficios'),

            Textarea::make('Requisitos', 'requisitos'),

            Text::make('Duración', 'duracion'),

            Textarea::make('Dirigido A', 'dirigido_a'),

            Textarea::make('Objetivo', 'objetivo'),

            Textarea::make('Determinantes', 'determinantes'),

            Textarea::make('Aporte', 'informacion_adicional')
                ->hideFromIndex(),

            Image::make('Imagen del Procedimiento', 'procedimiento_imagen')
                ->disk('public')->path('programas'),

            Textarea::make('Herramientas Requeridas', 'herramientas_requeridas'),

            Select::make('Modalidad', 'es_virtual')
                ->options(\App\Models\ProgramaConvocatoria::$es_virtual)->rules('required'),

            Text::make('Sitio Web', 'sitio_web')
                ->hideFromIndex(),

            BelongsToManyField::make('Etapas', 'etapas', Etapa::class)
                ->options(function () {
                    return \App\Models\Etapa::all()->map(function ($etapa) {
                        return [
                            'id' => $etapa->etapa_id,
                            'value' => $etapa->etapa_id,
                            'name' => $etapa->name,
                        ];
                    });
                }),

            HasMany::make('Convocatorias', 'convocatorias', ProgramaConvocatoria::class),
        ];
    }

    public static function uriKey()
    {
        return 'programas';
    }
}
