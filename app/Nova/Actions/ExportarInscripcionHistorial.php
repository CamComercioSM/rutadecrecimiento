<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class ExportarInscripcionHistorial extends DownloadExcel
{
    use InteractsWithQueue, Queueable;

    public function name(){
        return 'Exportar historial';
    }

    public function headings(): array {
        return [
            'Fecha',
            'Estado',
            'Comentarios',
        ];
    }
    
    public function map($row): array {
        return [
            $row->fecha_creacion,
            $row->estado->inscripcionEstadoNOMBRE ?? null,
            $row->comentarios
        ];
    }
}
