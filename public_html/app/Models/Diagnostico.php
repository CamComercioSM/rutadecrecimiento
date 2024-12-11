<?php

namespace App\Models;

use App\Models\Traits\DatosAuditoriaTrait;
use App\Models\Traits\TiemposAuditoriaTrait;
use App\Models\Traits\UsuarioTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diagnostico extends Model
{
    use SoftDeletes, DatosAuditoriaTrait, TiemposAuditoriaTrait, UsuarioTrait;

    // Nombre de la tabla
    protected $table = 'diagnosticos';

    // Clave primaria personalizada
    protected $primaryKey = 'diagnostico_id';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'diagnostico_nombre'        
    ];
}
