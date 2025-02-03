<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class ExportarUsuariosAdministradores extends DownloadExcel
{
    use InteractsWithQueue, Queueable;

    public function name(){
        return 'Exportar usuarios';
    }

    public function headings(): array {
        return [
            'No documento',
            'Nombre (s)',
            'Apellido (s)',            
            'Cargo',
            'Email',
        ];
    }
    public function map($row): array {
        return [
            $row->identification,
            $row->name,
            $row->lastname,
            $row->position,
            $row->email,
        ];
    }
}
