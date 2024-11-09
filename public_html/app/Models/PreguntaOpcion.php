<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreguntaOpcion extends Model
{
    use HasFactory;

    protected $table = 'preguntas_opciones';

    protected $primaryKey = 'opcion_id';

    protected $fillable = [
        'pregunta_id',
        'opcion_layout',
        'opcion_key',
        'opcion_attributes',
        'opcion_variable_response',
        'opcion_percentage',
    ];

    public $timestamps = false;

    // Relación con Pregunta
    public function pregunta()
    {
        return $this->belongsTo(DiagnosticoPregunta::class, 'pregunta_id', 'pregunta_id');
    }
}
