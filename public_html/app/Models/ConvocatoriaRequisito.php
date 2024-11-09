<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConvocatoriaRequisito extends Model
{
    // Define el nombre de la tabla
    protected $table = 'convocatorias_requisitos';

    // Define los campos que se pueden asignar masivamente
    protected $fillable = [
        'convocatoria_id',
        'requisito_id',
        'created_at'
    ];

    /**
     * Relación con el modelo Convocatoria.
     */
    public function convocatoria(): BelongsTo
    {
        return $this->belongsTo(ProgramaConvocatoria::class, 'convocatoria_id');
    }

    /**
     * Relación con el modelo Requisito.
     */
    public function requisito(): BelongsTo
    {
        return $this->belongsTo(Requisito::class, 'requisito_id');
    }
}
