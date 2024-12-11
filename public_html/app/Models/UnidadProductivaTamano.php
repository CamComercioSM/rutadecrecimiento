<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadProductivaTamano extends Model
{
    protected $table = 'unidadesproductivas_tamanos';
    protected $primaryKey = 'tamano_id';

    protected $fillable = [
        'tamanoCODIGO',
        'tamanoNOMBRE',
    ];
}
