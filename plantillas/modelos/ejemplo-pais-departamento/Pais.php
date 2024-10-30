<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\AuditableTrait;
use App\Traits\CustomTimestampsTrait;

class Pais extends Model
{
    use SoftDeletes, AuditableTrait, CustomTimestampsTrait;

    protected $table = 'paises'; // Nombre de la tabla en plural
    protected $primaryKey = 'pais_id'; // ID personalizado
    public $incrementing = false; // Si el ID no es auto incremental
    protected $keyType = 'string'; // Tipo del ID, si es un string

    protected $fillable = [
        'pais_id', 'nombre', 'usuario_creo', 'usuario_actualizo', 'usuario_elimino',
        'fecha_creacion', 'fecha_actualizacion', 'fecha_eliminacion'
    ];

    protected $dates = ['fecha_creacion', 'fecha_actualizacion', 'fecha_eliminacion'];
}
