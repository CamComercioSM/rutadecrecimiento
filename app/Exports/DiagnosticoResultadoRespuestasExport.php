<?php

namespace App\Exports;

use App\Models\DiagnosticoRespuesta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DiagnosticoResultadoRespuestasExport implements FromCollection, WithHeadings
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
        
        DiagnosticoRespuesta::whereIn('resultado_id', $this->modelIds)
            ->with(['pregunta', 'resultado.unidadproductiva'])
            ->chunk(1000, function ($respuestas) use (&$resultados) {
                foreach ($respuestas as $respuesta) {
                    $resultados[] = [
                        $respuesta->fecha_creacion,
                        $respuesta->resultado->unidadproductiva->nit ?? '',
                        $respuesta->resultado->unidadproductiva->business_name ?? '',                        
                        $respuesta->pregunta->pregunta_titulo ?? '',
                        $respuesta->diagnosticorespuesta_valor,
                        $respuesta->diagnosticorespuesta_porcentaje,
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
            'Respuesta',
            'Porcentaje',
        ];
    }
}
