<?php

namespace App\Nova\Metrics;

use App\Models\UnidadProductiva;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;
use SaintSystems\Nova\LinkableMetrics\LinkableValue;

class UnidadesProductivasEtapas extends Value
{
    use LinkableValue;
    
    private $etapas = [
        1=> 'Descubrimiento',
        2=> 'Nacimiento',
        3=> 'Despegue',
        4=> 'Crecimiento',
        5=> 'Madurez'
    ];
    
    public function calculate(NovaRequest $request)
    {
        $etapa = $request->get('range');
        $count = UnidadProductiva::where('etapa_id', $etapa)->count();
        
        return $this->result($count);;
    }

    public function ranges()
    {
        return $this->etapas;
    }

    public function name()
    {
        return 'Unidades productivas - Etapa';
    }
    
    public function uriKey()
    {
        return 'unidades-productivas-etapa';
    }
}
