<?php
use Illuminate\Database\Eloquent\Model;

class EjemploModel extends Model
{
    protected $table = 'ejemplo'; // Nombre de la tabla
    protected $primaryKey = 'ejemplo_id'; // Nombre personalizado del campo ID
    public $incrementing = false; // Desactivar auto-incremento si no se está utilizando
    protected $keyType = 'unsignedBigInteger'; // Tipo de clave

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($modelo) {
            $modelo->usuario_creado = auth()->id(); // Asigna el ID del usuario actual
            $modelo->fecha_creacion = now(); // Asigna la fecha y hora actual
        });

        static::updating(function ($modelo) {
            $modelo->usuario_actualizado = auth()->id(); // Asigna el ID del usuario actual
            $modelo->fecha_actualizacion = now(); // Asigna la fecha y hora actual
        });

        static::deleting(function ($modelo) {
            $modelo->usuario_eliminado = auth()->id(); // Asigna el ID del usuario actual
            $modelo->fecha_eliminacion = now(); // Asigna la fecha y hora actual
            $modelo->save(); // Guarda el registro para que se mantenga la información
        });
    }
        
    public function tablaHijos(){
        return $this->hasMany(TablaHijos::class, 'padre_id', 'padre_id');
    }
    
    public function tablaPadre(){
        return $this->belongsTo(TablaPadre::class, 'padre_id', 'padre_id');
    }
    
}

?>
