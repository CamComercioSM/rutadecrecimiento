<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait DatosAuditoriaTrait
{
    // Nombres personalizados para los campos de timestamps
    public static function bootDatosAuditoriaTrait()
    {
        // Evento al crear un registro
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->usuario_creo = Auth::id();
            }
        });

        // Evento al actualizar un registro
        static::updating(function ($model) {
            if (Auth::check()) {
                $model->usuario_actualizo = Auth::id();
            }
        });

        // Evento al eliminar un registro
        static::deleting(function ($model) {
            if (Auth::check()) {
                $model->usuario_elimino = Auth::id();
                $model->fecha_eliminacion = now();
                $model->save(); // Guardamos el registro con la info del usuario que lo eliminó
            }
        });

        // Evento al restaurar un registro (Soft Delete)
        static::restoring(function ($model) {
            if (Auth::check()) {
                $model->usuario_elimino = null;
                $model->fecha_eliminacion = null;
            }
        });
    }
}


?>
