<?php

namespace App\Exports;

use App\Models\ConvocatoriaRespuesta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InscripcionesConocatoriasRequisitosExport implements FromCollection, WithHeadings
{
    protected $modelIds;

    // Constructor que solo recibe las respuestas filtradas
    public function __construct($modelIds)
    {
        $this->modelIds = $modelIds;
    }

    // Método que retorna la colección de respuestas
    public function collection()
    {
        $resultados = [];
        
        ConvocatoriaRespuesta::whereIn('inscripcion_id', $this->modelIds)
            ->with(['inscripcion.unidadProductiva', 'requisito'])
            ->chunk(1000, function ($respuestas) use (&$resultados) {
                foreach ($respuestas as $respuesta) {
                    $resultados[] = [
                        $respuesta->fecha_creacion,
                        $respuesta->inscripcion->unidadproductiva->nit ?? '',
                        $respuesta->inscripcion->unidadproductiva->business_name ?? '',                        
                        $respuesta->requisito->requisito_titulo ?? '',
                        $respuesta->value
                    ];
                }
        });

        return collect($resultados);
    }

    // Método para definir los encabezados de la exportación
    public function headings(): array
    {
        return [
            'Fecha',
            'NIT',
            'Unidad Productiva',
            'Pregunta',
            'Respuesta'
        ];
    }
}
