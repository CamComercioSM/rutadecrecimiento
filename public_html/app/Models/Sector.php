<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $table = 'ciiu_macrosectores';

    protected $primaryKey = 'sector_id';

    protected $fillable = [
        'sectorCODIGO',
        'sectorNombre'
    ];
}
