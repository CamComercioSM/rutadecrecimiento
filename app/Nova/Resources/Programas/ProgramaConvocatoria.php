<?php

namespace App\Nova\Resources\Programas;

use App\Nova\Resources\Resource;
use App\Nova\Resources\Inscripciones\ConvocatoriaInscripcion;
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
        return 'Convocatorias';
    }

    public static function singularLabel(){
        return 'Convocatoria';
    }

    public function fields(Request $request) {
        
        return [
            Text::make('Nombre', 'nombre')
                ->rules('required'),

            Textarea::make('Requisitos', 'requisitos'),

            
            Text::make('Persona a Cargo', 'persona_encargada')->rules('required'),

            Text::make('Correo de Contacto', 'correo_contacto')
                ->rules('required')->hideFromIndex(),

            Text::make('Teléfono', 'telefono')
                ->hideFromIndex(),

            
            Date::make('Fecha de inicio', 'fecha_apertura_convocatoria')
                ->rules('required')->hideFromIndex(),
            
            Date::make('Fecha de finalización', 'fecha_cierre_convocatoria')
                ->rules('required')->hideFromIndex(),

            Boolean::make('Con matricula', 'con_matricula')
                ->hideFromIndex(),

            Select::make('Sector', 'sector_id')
                ->options(\App\Models\Sector::pluck('sectorNOMBRE', 'sector_id'))
                ->nullable()->displayUsingLabels()->hideFromIndex(),

            BelongsToMany::make('Requisitos - indicadores', 'requisitosIndicadores', InscripcionesRequisitosIndicadores::class)
            ->fields(function () {
                return [
                    Number::make('Valor de referencia', 'referencia')
                    ->sortable(),
                ];
            }),
            
            BelongsToMany::make('Requisitos', 'requisitos', InscripcionesRequisitos::class),

            HasMany::make('Solicitudes de Inscripción', 'inscripciones', ConvocatoriaInscripcion::class),
            
        ];
    }

    public static function uriKey()
    {
        return 'programa-convocatorias';
    }
}
