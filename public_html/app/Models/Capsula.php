<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Capsula extends Model
{
    use HasFactory, SoftDeletes;

    // Tabla asociada al modelo
    protected $table = 'capsulas';

    // Clave primaria personalizada
    protected $primaryKey = 'capsula_id';

    // Los atributos que se pueden asignar de manera masiva
    protected $fillable = [
        'nombre',
        'descripcion',
        'url_video',
        'imagen',
    ];

    // Indica que estas columnas son fechas y deben ser tratadas como tales
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
