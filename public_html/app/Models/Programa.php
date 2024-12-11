<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\DatosAuditoriaTrait;
use App\Models\Traits\UsuarioTrait;
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
        'sitio_web',
        'titulo_programa',
        'fecha_apertura_convocatoria',
        'fecha_cierre_convocatoria',
        'tiempo_actividad_convocatoria',
        'con_matricula',
    ];

    protected $dates = ['fecha_apertura_convocatoria', 'fecha_cierre_convocatoria'];
    
    public function inscripciones(): HasMany {
        return $this->hasMany(ConvocatoriaInscripcion::class, 'programa_id');
    }
    
    public static $es_virtual = [
        '0' => 'Presencial',
        '1' => 'Virtual',
        '2' => 'Presencial y virtual'
    ];

    public function etapas()
    {
        return $this->belongsToMany(
            Etapa::class,                    
            'convocatorias_etapas',          
            'convocatoria_id',               
            'etapa_id'                       
        );
    }

    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';
    const DELETED_AT = 'fecha_eliminacion';
}
