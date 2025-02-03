<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class ExportarDiagnosticoResultado extends DownloadExcel
{
    use InteractsWithQueue, Queueable;

    public function name(){
        return 'Exportar diagnosticos resultados';
    }

    public function headings(): array {
        return [
            'Fecha',
            'NIT',
            'Unidad productiva',
            'Puntaje',
            'Etapa',
        ];
    }
    public function map($row): array {
        return [
            $row->fecha_creacion,
            $row->unidadproductiva->nit ?? null,
            $row->unidadproductiva->business_name ?? null,
            $row->resultado_puntaje,
            $row->etapa->name ?? null,
        ];
    }
}
