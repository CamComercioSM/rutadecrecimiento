<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadProductivaTipo extends Model
{
    protected $table = 'unidadesproductivas_tipos';
    protected $primaryKey = 'unidadtipo_id';

    protected $fillable = [
        'unidadtipo_nombre',
    ];
}
