<?php

namespace App\Policies;

use App\Models\DiagnosticoRespuesta;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiagnosticoRespuestaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user){
        return $user->hasAnyRole(['superadmin', 'cordinator', 'adviser']);
    }

    public function view(User $user, DiagnosticoRespuesta $answer){
        return $user->hasAnyRole(['superadmin', 'cordinator', 'adviser']);
    }

    public function create(User $user){
        return $user->hasAnyRole(['superadmin', 'cordinator', 'adviser']);
    }

    public function update(User $user, DiagnosticoRespuesta $answer){
        return $user->hasAnyRole(['superadmin']);
    }

    public function delete(User $user, DiagnosticoRespuesta $answer){
        return $user->hasAnyRole(['superadmin']);
    }

    public function restore(User $user, DiagnosticoRespuesta $answer){
        //
    }

    public function forceDelete(User $user, DiagnosticoRespuesta $answer){
        //
    }
}
