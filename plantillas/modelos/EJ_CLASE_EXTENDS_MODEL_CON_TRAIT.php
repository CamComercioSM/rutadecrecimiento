<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\DatosAuditoriaTrait;
use App\Traits\TiemposAuditoriaTrait;

class EjemploModelTrait extends Model
{
    use SoftDeletes, DatosAuditoriaTrait, TiemposAuditoriaTrait;
        
    protected $table = 'TablaEjemplo'; // Nombre de la tabla en plural
    protected $primaryKey = 'ejemplo_id'; // ID personalizado
    public $incrementing = true; // Si el ID no es auto incremental
    protected $keyType = 'int'; // Tipo del ID, si es un string

    protected $fillable = [
        'ejemplo_id', 'nombre', 
        'usuario_creo', 'usuario_actualizo', 'usuario_elimino',
        'fecha_creacion', 'fecha_actualizacion', 'fecha_eliminacion'
    ];
    
    // Si necesitas timestamps automáticos
    public $timestamps = true;

    protected $dates = ['fecha_creacion', 'fecha_actualizacion', 'fecha_eliminacion'];
        
    
}

?>
