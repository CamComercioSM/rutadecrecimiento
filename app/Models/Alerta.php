<?php

namespace App\Models;

use App\Models\Traits\DatosAuditoriaTrait;
use App\Models\Traits\UsuarioTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alerta extends Model
{
    use SoftDeletes, DatosAuditoriaTrait, UsuarioTrait;

    // Clave primaria personalizada
    protected $primaryKey = 'alerta_id';

    public static $kind = [
        0 => 'Camara de comercio sin renovar',
        1 => 'Tasa de crecimiento de mas del 10%',
        2 => 'Mas 2 dos años de constitución',
    ];
    protected $fillable = [
        'unidadproductiva_id',
        'tipo',
        'comentarios'
    ];

    // Relación
    public function unidad_productiva()
    {
        return $this->belongsTo(UnidadProductiva::class, 'unidadproductiva_id', 'unidadproductiva_id');
    }

    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';
    const DELETED_AT = 'fecha_eliminacion';
}
