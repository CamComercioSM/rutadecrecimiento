<?php

namespace App\Nova\Resources\Programas;

use App\Models\Sector;
use App\Nova\Resources\Resource;
use App\Nova\Resources\Generales\Etapa;
use App\Nova\Resources\Inscripciones\ConvocatoriaInscripcion;
use Benjacho\BelongsToManyField\BelongsToManyField;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class ProgramaConvocatoria extends Resource
{
    public static $model = \App\Models\ProgramaConvocatoria::class;
    public static $title = 'nombre';
    public static $search = ['convocatoria_id', 'nombre'];

    public static function label() {
        return 'Convocatoria';
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

            Text::make('Persona a Cargo', 'persona_encargada')->rules('required'),

            Text::make('Correo de Contacto', 'correo_contacto')
                ->rules('required')->hideFromIndex(),

            Text::make('Teléfono', 'telefono')
                ->hideFromIndex(),

            Text::make('Sitio Web', 'sitio_web')
                ->hideFromIndex(),

            Date::make('Fecha de inicio', 'fecha_apertura_convocatoria')
                ->rules('required')->hideFromIndex(),
            
            Date::make('Fecha de finalización', 'fecha_cierre_convocatoria')
                ->rules('required')->hideFromIndex(),

            Number::make('Tiempo en actividad economica', 'tiempo_actividad_convocatoria')
                ->hideFromIndex(),

            Boolean::make('Con matricula', 'con_matricula')
                ->hideFromIndex(),

            Number::make('Ventas anuales', 'ventas_anuales')
                ->hideFromIndex(),

            Number::make('Años en operación', 'anios_operacion')
                ->hideFromIndex(),

            Number::make('Número de empleados', 'numero_empleados')
                ->hideFromIndex(),

            Select::make('Sector', 'sector')
                ->options(Sector::pluck('sectorNOMBRE', 'sector_id'))
                ->displayUsingLabels()->hideFromIndex(),

            Number::make('Total de activos', 'activos_totales')
                ->hideFromIndex(),

            BelongsToManyField::make('Etapas', 'etapas', Etapa::class),

            BelongsToMany::make('Requisitos', 'requisitos', InscripcionesRequisitos::class)
            ->fields(function () {
                return [
                    Number::make('Valor de referencia', 'ferencia')
                        ->sortable(),
                ];
            }),

            HasMany::make('Solicitudes de Inscripción', 'inscripciones', ConvocatoriaInscripcion::class),
            
        ];
    }

    public static function uriKey()
    {
        return 'programa-convocatorias';
    }
}
