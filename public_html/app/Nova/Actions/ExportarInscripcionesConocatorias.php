<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class ExportarInscripcionesConocatorias extends DownloadExcel
{
    use InteractsWithQueue, Queueable;

    public function name(){
        return 'Exportar inscripciones';
    }

    public function headings(): array {
        return [
            'Convocatoria',
            'Unidad Productiva',
            'Estado',
            'Fecha de inscripción',
            'Comentarios'
        ];
    }
    public function map($row): array {
        return [
            $row->convocatoria->nombre ?? null,
            $row->unidadproductiva->business_name ?? null,
            $row->Estado->inscripcionEstadoNOMBRE ?? null,
            $row->fecha_creacion,
            $row->comentarios
        ];
    }
}
