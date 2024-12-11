<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class ProgramaConvocatoria extends Model
{
    use SoftDeletes;

    protected $table = 'programas_convocatorias';
    protected $primaryKey = 'convocatoria_id';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'programa_id',
        'nombre',
        'descripcion',
        'logo',
        'beneficios',
        'requisitos',
        'duracion',
        'dirigido_a',
        'objetivo',
        'determinantes',
        'procedimiento_imagen',
        'herramientas_requeridas',
        'es_virtual',
        'persona_encargada',
        'correo_contacto',
        'telefono',
        'informacion_adicional',
        'sitio_web',
        'fecha_creacion',
        'fecha_actualizacion',
        'fecha_eliminacion',
        'titulo_programa',
        'fecha_apertura_convocatoria',
        'fecha_cierre_convocatoria',
        'tiempo_actividad_convocatoria',
        'con_matricula'
    ];

    // Definición de constantes para los timestamps personalizados
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';
    const DELETED_AT = 'fecha_eliminacion';

    /**
     * Relación con el modelo Programa.
     */
    public function programa(): BelongsTo
    {
        return $this->belongsTo(Programa::class, 'programa_id');
    }

    /**
     * Relación con el modelo Etapa a través de convocatorias_etapas.
     */
    public function etapas(): HasManyThrough
    {
        return $this->hasManyThrough(
            Etapa::class,                 
            ConvocatoriaEtapa::class,     
            'convocatoria_id',            
            'etapa_id',                   
            'convocatoria_id',            
            'etapa_id'                    
        );
    }
    public function inscripciones(): HasMany {
        return $this->hasMany(ConvocatoriaInscripcion::class, 'programa_id');
    }

    public static $es_virtual = [
        '0' => 'Presencial',
        '1' => 'Virtual',
        '2' => 'Presencial y virtual'
    ];

    /**
     * Relación con el modelo Requisito a través de convocatorias_requisitos.
     */
    public function requisitos(): HasMany
    {
        return $this->hasManyThrough(
            Requisito::class,
            ConvocatoriaRequisito::class,
            'convocatoria_id',
            'requisito_id'
        );
    }
}
