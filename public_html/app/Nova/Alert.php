<?php

namespace App\Nova;

use App\Nova\Actions\ImportPayments;
use App\Nova\Actions\LoanChangeState;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class Alert extends Resource {
    public static $model = \App\Models\Alerta::class;
    public static $title = 'id';
    public static $search = ['id'];

    public static function label() {
        return 'Alertas';
    }

    public static $searchRelations = [
        'company' => ['name'],
    ];

    public function fields(Request $request) {
        return [
           

            BelongsTo::make('Empresa', 'unidad_productiva', UnidadProductiva::class)
                ->viewable(false)->withoutTrashed(),

            Select::make('Tipo', 'kind')
                ->options(\App\Models\Alerta::$kind)
                ->displayUsingLabels(),

            Textarea::make('Comentarios', 'comments'),
        ];
    }

    public function actions(Request $request) {
        return [
            (new DownloadExcel())
                ->withName('Exportar seleccionados')
                ->withFilename('alertas.xlsx')
                ->withHeadings(),
        ];
    }
}
