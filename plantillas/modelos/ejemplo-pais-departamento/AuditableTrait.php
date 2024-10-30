<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait AuditableTrait
{
    public static function bootAuditableTrait()
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
                $model->save(); // Guardamos el registro antes de eliminarlo
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
