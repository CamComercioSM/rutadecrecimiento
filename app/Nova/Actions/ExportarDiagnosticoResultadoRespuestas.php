<?php

namespace App\Nova\Actions;

use App\Exports\DiagnosticoResultadoRespuestasExport;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class ExportarDiagnosticoResultadoRespuestas extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Exportar Respuestas de Diagnosticos';

    public function handle(ActionFields $fields, $models)
    {        
        $modelIds = $models->pluck('resultado_id');
        $export = new DiagnosticoResultadoRespuestasExport($modelIds);

        $filePath = 'respuestas_diagnostico.xlsx';
        $tempFile = Excel::raw($export, \Maatwebsite\Excel\Excel::XLSX);

        $url = 'data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,' . base64_encode($tempFile);

        return Action::download($url, $filePath);
    }
}
