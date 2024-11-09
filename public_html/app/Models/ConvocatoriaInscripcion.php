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
        'programa_id',
        'unidadproductiva_id',
        'inscripcionestado_id',
        'comments',
        'file',
    ];

    public static $states = [
        0 => 'Solicitud de registro',
        1 => 'En proceso de vinculación',
        2 => 'Admitido',
        3 => 'No Admitido',
        4 => 'En proceso de intervención',
        5 => 'En espera',
        6 => 'Finalizado',
        7 => 'Retirado',
    ];
    
    // Si tienes campos de fechas adicionales
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // Define relaciones con otros modelos (si es necesario)
    public function programa()
    {
        return $this->belongsTo(Programa::class, 'programa_id');
    }

    public function unidadProductiva()
    {
        return $this->belongsTo(UnidadProductiva::class, 'unidadproductiva_id');
    }

    public function estado()
    {
        return $this->belongsTo(InscripcionEstado::class, 'inscripcionestado_id');
    }
}
