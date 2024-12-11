<?php

namespace App\Nova\Metrics;

use App\Models\UnidadProductiva;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;
use SaintSystems\Nova\LinkableMetrics\LinkableValue;

class TotalUnidadesProductivas extends Value
{
    use LinkableValue;

    public function calculate(NovaRequest $request)
    {
        $count = UnidadProductiva::count();

        return $this->result($count);
    }
    
    public function name()
    {
        return 'Total Unidades productivas';
    }

    public function uriKey()
    {
        return 'unidades-productivas-total';
    }

    public function icon()
    {
        return 'office-building'; 
    }
}
