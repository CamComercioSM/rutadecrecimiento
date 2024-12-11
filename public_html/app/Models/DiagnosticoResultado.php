<?php

namespace App\Models;

use App\Models\Traits\DatosAuditoriaTrait;
use App\Models\Traits\UsuarioTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class DiagnosticoResultado extends Model
{
    use SoftDeletes, DatosAuditoriaTrait, UsuarioTrait;
    protected $table = 'diagnosticos_resultados (diagnostics)';

    protected $primaryKey = 'resultado_id';

    protected $fillable = [
        'unidadproductiva_id',
        'etapa_id',
        'resultado_puntaje',
    ];

    // Relaciones

    public function unidadproductiva()
    {
        return $this->belongsTo(UnidadProductiva::class, 'unidadproductiva_id', 'unidadproductiva_id');
    }

    public function etapa()
    {
        return $this->belongsTo(Etapa::class, 'etapa_id', 'etapa_id');
    }

    public function respuestas()
    {
        return $this->HasMany(DiagnosticoRespuesta::class, 'resultado_id', 'resultado_id');
    }

    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';
    const DELETED_AT = 'fecha_eliminacion';
}
