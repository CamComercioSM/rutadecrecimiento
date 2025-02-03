<?php

namespace App\Nova\Resources\Diagnosticos;

use App\Nova\Actions\ExportarDiagnosticoResultado;
use App\Nova\Actions\ExportarDiagnosticoResultadoRespuestas;
use App\Nova\Resources\Resource;
use App\Nova\Resources\Empresarios\UnidadProductiva;
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
        return 'Diagnósticos resultados';
    }

    public static function singularLabel(){
        return 'Diagnóstico resultado';
    }

    public function fields(Request $request) {
        return [
            ID::make('ID', 'resultado_id')->sortable(),
            
            Date::make('Fecha Creación', 'fecha_creacion')
            ->format('YYYY-MM-DD') // Formato deseado
            ->sortable(),
            
            Text::make('NIT', function () {
                return $this->unidadproductiva->nit ?? '';
            })->sortable(),

            BelongsTo::make('Unidad Productiva', 'unidadproductiva', UnidadProductiva::class)->sortable(),
            
            Text::make('Puntaje', 'resultado_puntaje')->sortable(),
            
            Text::make('Etapa', function () {
                return $this->etapa->name ?? 'Sin etapa';
            })->sortable(),

            HasMany::make('Respuestas', 'respuestas', DiagnosticoRespuesta::class),
        ];
    }

    public function actions(Request $request) {
        return [ 
            new ExportarDiagnosticoResultadoRespuestas(),
            new ExportarDiagnosticoResultado(), 
        ];
    } 

    public static function uriKey()
    {
        return 'diagnosticos-resultados';
    }
}
