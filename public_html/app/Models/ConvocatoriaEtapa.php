<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConvocatoriaEtapa extends Model
{
    // Define el nombre de la tabla
    protected $table = 'convocatorias_etapas';

    // Define los campos que se pueden asignar masivamente
    protected $fillable = [
        'etapa_id',
        'convocatoria_id',
        'created_at'
    ];

    /**
     * Relación con el modelo Etapa.
     */
    public function etapa(): BelongsTo
    {
        return $this->belongsTo(Etapa::class, 'etapa_id');
    }

    /**
     * Relación con el modelo ProgramaConvocatoria.
     */
    public function programaConvocatoria(): BelongsTo
    {
        return $this->belongsTo(ProgramaConvocatoria::class, 'convocatoria_id');
    }
}
