<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsuarioService
{

    public static function crearUsuario($persona): User
    {
        return self::crearUsuario2(
            $persona->personaIDENTIFICACION, 
            $persona->personaNOMBRES,
            $persona->personaAPELLIDOS, 
            $persona->correoPRINCIPAL->correoDIRECCION,
            $persona->personaIDENTIFICACION);
    }

    public static function crearUsuario2($personaIDENTIFICACION, $personaNOMBRES, 
        $personaAPELLIDOS, $correoDIRECCION, $password): User
    {
        if(Auth::check())
            return Auth::user();
        
        $user = new User();
        $user->identification = $personaIDENTIFICACION;
        $user->name = $personaNOMBRES;
        $user->lastname = $personaAPELLIDOS;
        $user->email = $correoDIRECCION;
        $user->password = bcrypt($password);
        $user->save();

        return $user;
    }
}