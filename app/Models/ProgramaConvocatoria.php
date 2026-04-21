<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgramaConvocatoria extends Model {
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
        'fecha_apertura_convocatoria',
        'fecha_cierre_convocatoria',
        'con_matricula',
        'sector_id',
    ];
    protected $casts = [
        'fecha_apertura_convocatoria' => 'date',
        'fecha_cierre_convocatoria' => 'date',
    ];

    // Definición de constantes para los timestamps personalizados
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';
    const DELETED_AT = 'fecha_eliminacion';

    /**
     * Relación con el modelo Programa.
     */
    public function programa(): BelongsTo {
        return $this->belongsTo(Programa::class, 'programa_id', 'programa_id');
    }

    public function sector(): BelongsTo {
        return $this->belongsTo(Sector::class, 'sector_id', 'sector_id');
    }

    public function inscripciones(): HasMany {
        return $this->hasMany(ConvocatoriaInscripcion::class, 'convocatoria_id', 'convocatoria_id');
    }

    public function requisitos() {
        return $this->belongsToMany(
            InscripcionesRequisitos::class,
            'convocatorias_requisitos',
            'convocatoria_id',
            'requisito_id'
        )
            ->withPivot('orden')
            ->whereNull('inscripciones_requisitos.indicador_id')
            ->orderByPivot('convocatorias_requisitos.orden', 'ASC');
    }

    public function requisitosIndicadores() {
        return $this->belongsToMany(
            InscripcionesRequisitos::class,
            'convocatorias_requisitos',
            'convocatoria_id',
            'requisito_id'
        )
            ->withPivot('referencia', 'orden')
            ->whereNotNull('inscripciones_requisitos.indicador_id')
            ->orderByPivot('orden');
    }

    public static $es_virtual = [
        '0' => 'Presencial',
        '1' => 'Virtual',
        '2' => 'Presencial y virtual'
    ];




    // ================================
    // 🔹 PROGRAMAS INSCRITOS
    // ================================
    public static function inscritos($unidadProductiva, $fechaActual) {
        return self::with('programa')
            ->whereHas('inscripciones', function ($query) use ($unidadProductiva) {
                $query->where('unidadproductiva_id', $unidadProductiva->unidadproductiva_id);
            })
            ->where('fecha_apertura_convocatoria', '<=', $fechaActual)
            ->get();
    }

    // ================================
    // 🔹 PROGRAMAS RECOMENDADOS
    // ================================
    public static function recomendados($unidadProductiva, $fechaActual) {
        return self::query()
            ->where('fecha_apertura_convocatoria', '<=', $fechaActual)
            ->where('fecha_cierre_convocatoria', '>=', $fechaActual)
            ->where(function ($query) use ($unidadProductiva) {

                // Sector
                $query->where(function ($q) use ($unidadProductiva) {
                    $q->where('programas_convocatorias.sector_id', $unidadProductiva->sector_id)
                        ->orWhereNull('programas_convocatorias.sector_id');
                });

                // Etapas
                $query->whereHas('programa.etapas', function ($subQuery) use ($unidadProductiva) {
                    $subQuery->where('etapas.etapa_id', $unidadProductiva->etapa_id);
                });
            })
            ->with('programa')
            ->get();
    }

    // ================================
    // 🔹 PROGRAMAS OTROS (NO APLICAN)
    // ================================
    public static function otros($unidadProductiva, $fechaActual) {
        return self::with('programa')
            ->whereHas('programa', function ($query) use ($unidadProductiva) {
                $query->where('visibilidad', 'PUBLICO')
                    ->whereDoesntHave('etapas', function ($q) use ($unidadProductiva) {
                        $q->where('etapas.etapa_id', $unidadProductiva->etapa_id);
                    });
            })
            ->where('fecha_apertura_convocatoria', '<=', $fechaActual)
            ->where('fecha_cierre_convocatoria', '>=', $fechaActual)
            ->get();
    }

    // ================================
    // 🔹 TODOS LOS PROGRAMAS ACTIVOS
    // ================================
    public static function activos($fechaActual) {
        return self::query()
            ->join('programas', 'programas.programa_id', '=', 'programas_convocatorias.programa_id')
            ->where('fecha_apertura_convocatoria', '<=', $fechaActual)
            ->where('fecha_cierre_convocatoria', '>=', $fechaActual)
            ->get();
    }
    public static function activosPublicos($fechaActual) {
        return self::query()
            ->join('programas', 'programas.programa_id', '=', 'programas_convocatorias.programa_id')
            ->where('programas.visibilidad', 'PUBLICO')
            ->where('fecha_apertura_convocatoria', '<=', $fechaActual)
            ->where('fecha_cierre_convocatoria', '>=', $fechaActual)
            ->get();
    }
}
