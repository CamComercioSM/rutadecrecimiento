<?php

namespace App\Models\Traits;

use App\Models\User;

trait UsuarioTrait
{
    
    public function usuarioCreo()
    {
        return $this->belongsTo(User::class, 'usuario_creo');
    }

    public function usuarioActualizo()
    {
        return $this->belongsTo(User::class, 'usuario_actualizo');
    }

    public function usuarioElimino()
    {
        return $this->belongsTo(User::class, 'usuario_elimino');
    }
}
