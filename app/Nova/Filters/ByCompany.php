<?php

namespace App\Nova\Filters;

use App\Models\UnidadProductiva;
use App\Models\Programa;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class ByCompany extends Filter {
    public $component = 'select-filter';
    public $name = 'Empresa';

    public function apply(Request $request, $query, $value) {
        return $query->whereHas('resultado', function ($q) use ($value) {
            $q->where('unidadproductiva_id', $value);
        });
    }

    /**
     * Get the filter's available options.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function options(Request $request) {
        return UnidadProductiva::all()->pluck('unidadproductiva_id', 'business_name')->toArray();
    }
}
