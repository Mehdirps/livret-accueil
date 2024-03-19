<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivretRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Background;
use App\Models\BackgroundGroup;
use App\Models\Livret;
use App\Models\ModuleDigicode;
use App\Models\ModuleWifi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        if ($request->hasFile('avatar')) {
            $request->validate([
                'avatar' => 'mimes:png,jpg,jpeg,webp',
            ]);
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();

            if ($user->avatar && file_exists(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }

            $avatar->move(public_path('assets/uploads/avatars'), $filename);
            $user->avatar = 'assets/uploads/avatars/' . $filename;
        }

        $user->save();

        return redirect()->route('dashboard.profile')->with('success', 'Vos informations ont été mise à jour avec succès');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->route('dashboard.profile')->with('error', 'Votre ancien mot de passe est incorrect');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('dashboard.profile')->with('success', 'Votre mot de passe a été mis à jour avec succès');
    }

    public function updateLivret(LivretRequest $request)
    {
        $livret = Livret::where('user_id', auth()->id())->first();

        $livret->livret_name = $request->livret_name;
        $livret->slug = \Str::slug($request->livret_name);
        $livret->description = $request->description;
        $livret->establishment_type = $request->establishment_type;
        $livret->establishment_name = $request->establishment_name;
        $livret->establishment_address = $request->establishment_address;
        $livret->establishment_phone = $request->establishment_phone;
        $livret->establishment_email = $request->establishment_email;
        $livret->establishment_website = $request->establishment_website;
        $livret->facebook = $request->facebook;
        $livret->twitter = $request->twitter;
        $livret->instagram = $request->instagram;
        $livret->linkedin = $request->linkedin;
        $livret->tripadvisor = $request->tripadvisor;

        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'mimes:png,jpg,jpeg,webp',
            ]);

            $logo = $request->file('logo');
            $filename = time() . '.' . $logo->getClientOriginalExtension();

            if ($livret->logo && file_exists(public_path($livret->logo))) {
                unlink(public_path($livret->logo));
            }

            $logo->move(public_path('assets/uploads/logos'), $filename);
            $livret->logo = 'assets/uploads/logos/' . $filename;
        }

        $livret->save();

        return redirect()->route('dashboard.profile')->with('success', 'Votre livret a été mis à jour avec succès');
    }

    public function background()
    {
        $livret = auth()->user()->livret;
        $background_group = BackgroundGroup::all();

        return view('dashboard.background', [
            'livret' => $livret,
            'background_group' => $background_group,
        ]);
    }

    public function updateBackground($id)
    {
        $background = Background::find($id);

        $livret = auth()->user()->livret;
        $livret->background = $background->path;
        $livret->save();

        return redirect()->route('dashboard.background')->with('success', 'Votre arrière-plan a été mis à jour avec succès');
    }

    public function editLivret()
    {
        $livret = auth()->user()->livret;

        return view('dashboard.edit_livret', [
            'livret' => $livret,
        ]);
    }

    public function addModuleWifi(Request $request)
    {
        $livret = auth()->user()->livret;

        $wifi = new ModuleWifi();
        $wifi->ssid = $request->wifiName;
        $wifi->password = $request->wifiPassword;
        $wifi->livret = $livret->id;
        $wifi->save();

        return redirect()->route('dashboard.edit_livret')->with('success', 'Votre réseau wifi a été mis à jour avec succès');
    }

    public function deleteModuleWifi($id)
    {
        $wifi = ModuleWifi::find($id);
        $wifi->delete();

        return redirect()->route('dashboard.edit_livret')->with('success', 'Votre réseau wifi a été supprimé avec succès');
    }

    public function addModuleDigicode(Request $request)
    {
        $livret = auth()->user()->livret;

        $digicode = new ModuleDigicode();
        $digicode->name = $request->name;
        $digicode->code = $request->code;
        $digicode->livret = $livret->id;
        $digicode->save();

        return redirect()->route('dashboard.edit_livret')->with('success', 'Votre digicode a été mis à jour avec succès');
    }

    public function deleteModuleDigicode($id)
    {
        $digicode = ModuleDigicode::find($id);
        $digicode->delete();

        return redirect()->route('dashboard.edit_livret')->with('success', 'Votre digicode a été supprimé avec succès');
    }
}
