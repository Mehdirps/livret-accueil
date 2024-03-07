<?php

namespace App\Http\Controllers;

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
}
