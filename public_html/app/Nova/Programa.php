<?php

namespace App\Nova;

use Benjacho\BelongsToManyField\BelongsToManyField;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class Programa extends Resource {
    public static $model = \App\Models\ProgramaConvocatoria::class;
    public static $title = 'nombre';
    public static $search = ['programa_id', 'nombre'];

    public static function label() {
        return 'Programas';
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

            Textarea::make('Fechas de Convocatoria', 'dirigido_a'),

            Textarea::make('Objetivo', 'objetivo'),

            Textarea::make('Determinantes', 'determinantes'),

            Textarea::make('Aporte', 'informacion_adicional')
                ->hideFromIndex(),

            Image::make('Imagen del Procedimiento', 'procedimiento_imagen')
                ->disk('public')->path('programas'),

            Textarea::make('Herramientas Requeridas', 'herramientas_requeridas'),

            Select::make('Modalidad', 'es_virtual')
                ->options(\App\Models\ProgramaConvocatoria::$es_virtual)->rules('required'),

            Text::make('Persona a Cargo', 'persona_encargada')->rules('required'),

            Text::make('Correo de Contacto', 'correo_contacto')
                ->rules('required')->hideFromIndex(),

            Text::make('Teléfono', 'telefono')
                ->hideFromIndex(),

            Text::make('Sitio Web', 'sitio_web')
                ->hideFromIndex(),

            HasMany::make('Solicitudes de Inscripción', 'inscripciones', Aplication::class),

            BelongsToManyField::make('Etapas', 'etapas', Stage::class),
        ];
    }
}
