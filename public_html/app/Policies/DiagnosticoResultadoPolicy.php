<?php

namespace App\Policies;

use App\Models\DiagnosticoResultado;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiagnosticoResultadoPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user){
        return $user->hasAnyRole(['superadmin', 'cordinator', 'adviser']);
    }

    public function view(User $user, DiagnosticoResultado $answer){
        return $user->hasAnyRole(['superadmin', 'cordinator', 'adviser']);
    }

    public function create(User $user){
        return $user->hasAnyRole(['superadmin', 'cordinator', 'adviser']);
    }

    public function update(User $user, DiagnosticoResultado $answer){
        return $user->hasAnyRole(['superadmin']);
    }

    public function delete(User $user, DiagnosticoResultado $answer){
        return $user->hasAnyRole(['superadmin']);
    }

    public function restore(User $user, DiagnosticoResultado $answer){
        //
    }

    public function forceDelete(User $user, DiagnosticoResultado $answer){
        //
    }
}
