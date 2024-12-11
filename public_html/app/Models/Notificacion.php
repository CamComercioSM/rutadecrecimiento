<?php

namespace App\Models;

use App\Models\Traits\DatosAuditoriaTrait;
use App\Models\Traits\UsuarioTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notificacion extends Model
{
    use SoftDeletes, DatosAuditoriaTrait, UsuarioTrait;

    protected $table = 'notificaciones';
    protected $primaryKey = 'notificacion_id';

    // Campos asignables en masa
    protected $fillable = [
        'titulo',
        'descripcion',
        'url',
        'orden'
    ];

    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';
    const DELETED_AT = 'fecha_eliminacion';
}
