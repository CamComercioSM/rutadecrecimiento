<?php

namespace App\Nova\Resources\Diagnosticos;

use App\Nova\Actions\ExportarDiagnosticoResultado;
use App\Nova\Resource;
use App\Nova\UnidadProductiva;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class DiagnosticoResultado extends Resource
{
    public static $model = \App\Models\DiagnosticoResultado::class;

    public static $title = 'resultado_id';
    public static $search = [ 'resultado_id' ];

    public static function label() {
        return 'Diagnosticos resultados';
    }

    public function fields(Request $request) {
        return [
            ID::make('ID', 'resultado_id')->sortable(),
            
            Date::make('Fecha Creación', 'fecha_creacion')
            ->format('YYYY-MM-DD') // Formato deseado
            ->sortable(),
            
            BelongsTo::make('Unidad Productiva', 'unidadproductiva', UnidadProductiva::class)->sortable(),
            
            Text::make('Puntaje', 'resultado_puntaje')->sortable(),
            
            Text::make('Etapa', function () {
                return $this->etapa->name ?? 'Sin etapa';
            })->sortable(),

            HasMany::make('Respuestas', 'respuestas', DiagnosticoRespuesta::class),
        ];
    }

    public function actions(Request $request) {
        return [ new ExportarDiagnosticoResultado() ];
    }

    public static function authorizedToCreate(Request $request)
    {
        return false; // Deshabilita la creación
    }

    public function authorizedToUpdate(Request $request)
    {
        return false; // Deshabilita la edición
    }

    public function authorizedToDelete(Request $request)
    {
        return false; // Deshabilita la eliminación
    }

    public static function uriKey()
    {
        return 'diagnosticos-resultados';
    }
}
