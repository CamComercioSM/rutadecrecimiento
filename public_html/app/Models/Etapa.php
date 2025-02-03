<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\DatosAuditoriaTrait;
use App\Models\Traits\UsuarioTrait;

class Etapa extends Model
{
    use SoftDeletes, DatosAuditoriaTrait, UsuarioTrait;

    protected $table = 'etapas';
    protected $primaryKey = 'etapa_id';

    protected $fillable = [
        'name',
        'imagen',
        'descripcion',
        'etapa_anterior_id',
        'etapa_siguiente_id',
        'score_inicial',
        'score_final'
    ];

    // Relaciones
    public function etapaAnterior()
    {
        return $this->belongsTo(Etapa::class, 'etapa_anterior_id');
    }

    public function etapaSiguiente()
    {
        return $this->belongsTo(Etapa::class, 'etapa_siguiente_id');
    }

    public function programas()
    {
        return $this->belongsToMany(Programa::class, 'programas_etapas', 'etapa_id', 'programa_id');
    }


    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';
    const DELETED_AT = 'fecha_eliminacion';
}
