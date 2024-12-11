<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class ExportarDiagnosticoRespuesta extends DownloadExcel
{
    use InteractsWithQueue, Queueable;

    public function name(){
        return 'Exportar diagnosticos respuestas';
    }

    public function headings(): array {
        return [
            'Fecha',
            'Pregunta',
            'Respuesta',
            'Porcentaje',
        ];
    }
    
    public function map($row): array {
        return [
            $row->fecha_creacion,
            $row->pregunta->pregunta_titulo ?? null,            
            $row->diagnosticorespuesta_valor,
            $row->diagnosticorespuesta_porcentaje,
        ];
    }
}
