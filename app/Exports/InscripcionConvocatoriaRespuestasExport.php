<?php

namespace App\Exports;

use App\Models\ConvocatoriaRespuesta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InscripcionConvocatoriaRespuestasExport implements FromCollection, WithMapping, WithHeadings
{
    protected $inscripcion_id;

    
    public function __construct($inscripcion_id)
    {
        $this->inscripcion_id = $inscripcion_id;
    }

    
    public function collection()
    {
        return ConvocatoriaRespuesta::with('requisito')
            ->where('inscripcion_id', $this->inscripcion_id)
            ->get();
    }

    public function map($row): array
    {
        return [
           
            $row->requisito->requisito_titulo ?? 'N/A',
            $row->value
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
