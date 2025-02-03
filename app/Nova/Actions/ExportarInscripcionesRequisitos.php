<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class ExportarInscripcionesRequisitos extends DownloadExcel
{
    use InteractsWithQueue, Queueable;

    public function name(){
        return 'Exportar respuestas';
    }

    public function headings(): array {
        return [
            'Fecha',
            'Pregunta',
            'Respuesta',
        ];
    }
    
    public function map($row): array {
        return [
            $row->fecha_respuesta,
            $row->requisito->requisito_titulo ?? null,
            $row->value
        ];
    }
}
