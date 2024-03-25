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
        $users = User::where('role', 'user')->paginate(1);;

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

    public function searchUsers(Request $request)
    {
        $search = $request->get('search');
        $users = User::where('role', 'user')
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%');
            })
            ->paginate(1);
        return view('admin.users', [
            'users' => $users
        ]);
    }
}
