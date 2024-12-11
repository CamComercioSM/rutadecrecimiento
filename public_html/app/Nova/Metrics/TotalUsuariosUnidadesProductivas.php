<?php

namespace App\Nova\Metrics;

use App\Models\User;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;
use SaintSystems\Nova\LinkableMetrics\LinkableValue;

class TotalUsuariosUnidadesProductivas extends Value
{
    use LinkableValue;

    public function calculate(NovaRequest $request)
    {
        $count = User::has('unidadesProductivas')->count();

        return $this->result($count);
    }
    
    public function name()
    {
        return 'Usuarios registrados';
    }

    public function uriKey()
    {
        return 'unidades-productivas-usuarios';
    }
}