<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivretRequest;
use App\Models\Livret;
use App\Models\User;
use Illuminate\Http\Request;

class LivretController extends Controller
{
    public function store(LivretRequest $request)
    {
        $livret = new Livret();
        $livret->user_id = auth()->id();
        $livret->livret_name = $request->livret_name;
        $livret->establishment_type = $request->establishment_type;
        $livret->establishment_name = $request->establishment_name;
        $livret->establishment_address = $request->establishment_address;
        $livret->establishment_phone = $request->establishment_phone;
        $livret->establishment_email = $request->establishment_email;
        $livret->establishment_website = $request->establishment_website;

        $livret->save();

        $user = User::find(auth()->id());
        $user->first_login = 0;
        $user->save();

        return redirect()->route('dashboard.index')->with('success', 'Votre livret "'. $livret->livret_name .'" créé avec succès !');
    }
}
