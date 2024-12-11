<?php

namespace App\Http\Controllers;

use App\Http\Services\CommonService;
use App\Http\Services\UnidadProductivaService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {

            /** @var User $user */
            $user = Auth::user();

            if ($user->hasAnyRole('superadmin'))
                return redirect()->route('nova.login');

            return redirect()->route('company.select');
        }

        $data = [
            'footer'=> CommonService::footer(),
            'links'=> CommonService::links(),
        ];

        return view('website.company.login', $data);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email o contraseña incorrecta. Valide e intente nuevamente');
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Email o contraseña incorrecta. Valide e intente nuevamente');
        }

        Auth::login($user);
        UnidadProductivaService::setUnidadProductiva(null);

        return redirect()->route('company.select');
    }

    public function logout() 
    {
        Auth::logout();
        UnidadProductivaService::setUnidadProductiva(null);
        return redirect()->route('home');
    }
}
