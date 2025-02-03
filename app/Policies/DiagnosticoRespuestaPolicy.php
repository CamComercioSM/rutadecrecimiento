<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiagnosticoRespuestaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user){
        return $user->hasAnyRole(['superadmin', 'cordinator', 'adviser']);
    }

    public function view(User $user){
        return $user->hasAnyRole(['superadmin', 'cordinator', 'adviser']);
    }

    public function create(User $user){
        return false;
    }

    public function update(User $user){
        return false;
    }

    public function delete(User $user){
        return false;
    }

    public function handleAction(User $user)
    {
        return $user->hasAnyRole(['superadmin', 'cordinator', 'adviser']);
    }

    public function restore(User $user){
        return false;
    }

    public function forceDelete(User $user){
        return false;
    }

}
