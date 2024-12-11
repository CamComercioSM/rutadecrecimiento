<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentasAnuales extends Model
{
    protected $table = 'ventasanuales';
    protected $primaryKey = 'ventasAnualesID';

    protected $fillable = [
        'sectorCODIGO',
        'ventasAnualesCODIGO',
        'ventasAnualesNOMBRE',
        'ventasAnualesINICIO',
        'ventasAnualesFINAL',
    ];
}
