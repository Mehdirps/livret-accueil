<?php

namespace App\Http\Controllers;

use App\Models\BackgroundGroup;
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
        $users = User::where('role', 'user')->paginate(15);

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
            ->paginate(15);
        return view('admin.users', [
            'users' => $users
        ]);
    }

    public function backgrounds()
    {
        $background_group = BackgroundGroup::all();

        return view('admin.backgrounds',[
            'background_group' => $background_group
        ]);
    }

    public function addBackgroundGroup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $background = new BackgroundGroup();
        $background->name = $request->name;
        $background->description = $request->description;

        $background->save();

        return redirect()->back()->with('success', 'Background ajouté');
    }

    public function deleteBackgroundGroup($id)
    {
        $backgroundGroup = BackgroundGroup::find($id);

        foreach ($backgroundGroup->backgrounds as $background) {
            $file_path = public_path($background->path);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $background->delete();
        }

        $backgroundGroup->delete();

        return redirect()->back()->with('success', 'Background supprimé');
    }
}
