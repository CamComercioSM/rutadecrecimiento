<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InscripcionEstado extends Model
{
    use HasFactory;

    protected $table = 'inscripciones_estados';
    protected $primaryKey = 'inscripcionestado_id';

    protected $fillable = [
        'inscripcionEstadoCODIGO',
        'inscripcionEstadoNOMBRE',
        'inscripcionEstadoCOLOR'
    ];
}
