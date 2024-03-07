<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivretRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Livret;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $user = auth()->user();
        if ($user->first_login) {
            return redirect()->route('dashboard.first_login');
        }

        $livret = $user->livret;

        return view('dashboard.index', [
            'livret' => $livret,
        ]);
    }

    public function seeFirstLogin()
    {
        if (!auth()->user()->first_login && auth()->user()->livret) {
            return redirect()->route('dashboard.index');
        }

        return view('dashboard.first_login');
    }

    public function profile()
    {
        $user = auth()->user();
        $livret = $user->livret;

        return view('dashboard.profile', [
            'livret' => $livret,
            'user' => $user,
        ]);
    }

    public function updateUser(UpdateUserRequest $request)
    {
        $user = auth()->user();
        $user->civility = $request->civility;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->birth_date = $request->birth_date;
        $user->address = $request->address;
        $user->save();

        return redirect()->route('dashboard.profile')->with('success', 'Vos informations ont été mise à jour avec succès');
    }

    public function updateLivret(LivretRequest $request)
    {
        $livret = Livret::where('user_id', auth()->id())->first();

        $livret->livret_name = $request->livret_name;
        $livret->establishment_type = $request->establishment_type;
        $livret->establishment_name = $request->establishment_name;
        $livret->establishment_address = $request->establishment_address;
        $livret->establishment_phone = $request->establishment_phone;
        $livret->establishment_email = $request->establishment_email;
        $livret->establishment_website = $request->establishment_website;

        $livret->save();

        return redirect()->route('dashboard.profile')->with('success', 'Votre livret a été mis à jour avec succès');
    }
}
