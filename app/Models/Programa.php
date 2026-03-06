<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\DatosAuditoriaTrait;
use App\Models\Traits\UsuarioTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Programa extends Model
{
    use SoftDeletes, DatosAuditoriaTrait, UsuarioTrait;

    protected $table = 'programas';
    protected $primaryKey = 'programa_id';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
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
        'sitio_web'
    ];
    
    public function inscripciones(): HasMany {
        return $this->hasMany(ConvocatoriaInscripcion::class, 'programa_id', 'programa_id');
    }

    public function convocatorias()
    {
        return $this->hasMany(ProgramaConvocatoria::class, 'programa_id', 'programa_id');
    }

    public function etapas(): BelongsToMany {
        return $this->belongsToMany(Etapa::class, 'programas_etapas', 'programa_id', 'etapa_id');
    }

    /**
     * Requisitos (preguntas) del programa (aplican a todas sus convocatorias).
     * Pivot: programas_requisitos (programa_id, requisito_id, orden).
     */
    public function requisitos(): BelongsToMany
    {
        return $this->belongsToMany(
            InscripcionesRequisitos::class,
            'programas_requisitos',
            'programa_id',
            'requisito_id'
        )
            ->whereNull('inscripciones_requisitos.indicador_id')
            ->withPivot('orden')
            ->orderByPivot('orden');
    }

    /**
     * Requisitos-indicadores del programa (aplican a todas sus convocatorias).
     */
    public function requisitosIndicadores(): BelongsToMany
    {
        return $this->belongsToMany(
            InscripcionesRequisitos::class,
            'programas_requisitos',
            'programa_id',
            'requisito_id'
        )
            ->whereNotNull('inscripciones_requisitos.indicador_id')
            ->withPivot('orden')
            ->orderByPivot('orden');
    }

    public static $es_virtual = [
        '0' => 'Presencial',
        '1' => 'Virtual',
        '2' => 'Presencial y virtual'
    ];

    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';
    const DELETED_AT = 'fecha_eliminacion';
}
