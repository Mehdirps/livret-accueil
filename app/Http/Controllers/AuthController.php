<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function doLogin(LoginRequest $request)
    {

    }

    public function doRegister(RegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->last_name . ' ' . $request->first_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->etablissement_type = $request->establishment_type;
        $user->save();

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Bienvenue '. $user->name .', votre compte a été créé avec succès. Veuillez vérifier votre adresse e-mail pour activer votre compte.');
    }
}
