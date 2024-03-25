<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function users()
    {
        $users = User::where('role', 'user')->get();

        return view('admin.users', [
            'users' => $users
        ]);

    }

    public function enableUser($id)
    {
        $user = User::find($id);
        $user->active = !$user->active;
        $user->save();

        return redirect()->back()->with('success', $user->active ? 'Utilisateur activé' : 'Utilisateur désactivé');
    }
}
