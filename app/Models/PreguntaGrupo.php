<?php

namespace App\Models;

use App\Models\Traits\DatosAuditoriaTrait;
use App\Models\Traits\UsuarioTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PreguntaGrupo extends Model
{
    use SoftDeletes, DatosAuditoriaTrait, UsuarioTrait;
    protected $table = 'preguntas_grupos';

    protected $primaryKey = 'preguntagrupo_id';

    protected $fillable = [
        'preguntagrupo_nombre'
    ];

    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';
    const DELETED_AT = 'fecha_eliminacion';
}
