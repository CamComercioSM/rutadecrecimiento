<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConvocatoriaInscripcion extends Model
{
    use HasFactory, SoftDeletes;

    // Nombre de la tabla
    protected $table = 'convocatorias_inscripciones';

    // Clave primaria personalizada
    protected $primaryKey = 'inscripcion_id';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'convocatoria_id',
        'unidadproductiva_id',
        'inscripcionestado_id',
        'comentarios',
        'archivo',
        'activarPreguntas',
    ];


    protected static function booted()
    {
        static::saved(function ($model) {
            if ($model->isDirty(['inscripcionestado_id', 'comentarios', 'archivo'])) 
            {
                ConvocatoriaInscripcionHistorial::create([
                    'inscripcion_id' => $model->inscripcion_id,
                    'inscripcionestado_id' => $model->inscripcionestado_id,
                    'comentarios' => $model->comentarios,
                    'archivo' => $model->archivo
                ]);
            }
        });      
    }


    // Definición de constantes para los timestamps personalizados
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';
    const DELETED_AT = 'fecha_eliminacion';

    // Define relaciones con otros modelos (si es necesario)
    public function convocatoria()
    {
        return $this->belongsTo(ProgramaConvocatoria::class, 'convocatoria_id', 'convocatoria_id');
    }

    public function unidadProductiva()
    {
        return $this->belongsTo(UnidadProductiva::class, 'unidadproductiva_id', 'unidadproductiva_id');
    }

    public function estado()
    {
        return $this->belongsTo(InscripcionEstado::class, 'inscripcionestado_id', 'inscripcionestado_id');
    }

    public function respuestas()
    {
        return $this->HasMany(ConvocatoriaRespuesta::class, 'inscripcion_id', 'inscripcion_id');
    }

    public function historial()
    {
        return $this->HasMany(ConvocatoriaInscripcionHistorial::class, 'inscripcion_id', 'inscripcion_id');
    }

}
