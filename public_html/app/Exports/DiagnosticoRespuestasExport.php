<?php

namespace App\Exports;

use App\Models\DiagnosticoRespuesta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DiagnosticoRespuestasExport implements FromCollection, WithMapping, WithHeadings
{
    protected $resultado_id;

    
    public function __construct($resultado_id)
    {
        $this->resultado_id = $resultado_id;
    }

    
    public function collection()
    {
        return DiagnosticoRespuesta::with('pregunta')
            ->where('resultado_id', $this->resultado_id)
            ->get();
    }

    public function map($row): array
    {
        return [
           
            $row->pregunta->pregunta_titulo ?? 'N/A',
            $row->diagnosticorespuesta_valor
        ];
    }

    public function headings(): array
    {
        return [
         
            'Pregunta',
            'Respuesta'
        ];
    }

}
