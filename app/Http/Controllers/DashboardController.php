<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
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
        $user->name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->birth_date = $request->birth_date;
        $user->address = $request->address;
        $user->save();

        return redirect()->route('dashboard.profile')->with('success', 'Vos informations ont été mise à jour avec succès');
    }
}
