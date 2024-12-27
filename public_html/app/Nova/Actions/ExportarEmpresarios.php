<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class ExportarEmpresarios extends DownloadExcel
{
    use InteractsWithQueue, Queueable;

    public function name(){
        return 'Exportar empresarios';
    }

    public function headings(): array {
        return [
            'No documento',
            'Nombre (s)',
            'Apellido (s)',
            'Email',
        ];
    }
    public function map($row): array {
        return [
            $row->identification,
            $row->name,
            $row->lastname,
            $row->email,
        ];
    }
}
