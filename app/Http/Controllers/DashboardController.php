<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivretRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Background;
use App\Models\BackgroundGroup;
use App\Models\Inventory;
use App\Models\Livret;
use App\Models\LivretView;
use App\Models\ModuleDigicode;
use App\Models\ModuleEndInfos;
use App\Models\ModuleHome;
use App\Models\ModuleStartInfos;
use App\Models\ModuleUtilsInfos;
use App\Models\ModuleUtilsPhone;
use App\Models\ModuleWifi;
use App\Models\NearbyPlace;
use App\Models\PlaceGroup;
use App\Models\Suggest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use App\Models\User;

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
        if ($request->admin_update) {
            $user = User::find($request->admin_update);
        } else {
            $user = auth()->user();
        }

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

        if ($request->admin_update) {
            return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès');
        } else {
            return redirect()->route('dashboard.profile')->with('success', 'Vos informations ont été mise à jour avec succès');
        }
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
        if ($request->livret_id) {
            $livret = Livret::find($request->livret_id);
        } else {
            $livret = Livret::where('user_id', auth()->id())->first();
        }

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
        if ($request->livret_id) {
            return redirect()->route('admin.livrets.index')->with('success', 'Votre livret a été mis à jour avec succès');
        } else {
            return redirect()->route('dashboard.profile')->with('success', 'Votre livret a été mis à jour avec succès');
        }
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

        if(auth()->user()->role == 'admin'){
            return redirect()->route('admin.livrets.index')->with('success', 'Votre réseau wifi a été supprimé avec succès');
        }

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

        if(auth()->user()->role == 'admin'){
            return redirect()->route('admin.livrets.index')->with('success', 'Votre digicode a été supprimé avec succès');
        }

        return redirect()->route('dashboard.edit_livret')->with('success', 'Votre digicode a été supprimé avec succès');
    }

    public function addModuleUtilsPhone(Request $request)
    {
        $livret = auth()->user()->livret;

        $utilsPhone = new ModuleUtilsPhone();
        $utilsPhone->name = $request->name;
        $utilsPhone->number = $request->number;
        $utilsPhone->livret = $livret->id;
        $utilsPhone->save();

        return redirect()->route('dashboard.edit_livret')->with('success', 'Votre numéro de téléphone a été mis à jour avec succès');
    }

    public function deleteModuleUtilsPhone($id)
    {
        $utilsPhone = ModuleUtilsPhone::find($id);
        $utilsPhone->delete();

        if(auth()->user()->role == 'admin'){
            return redirect()->route('admin.livrets.index')->with('success', 'Votre numéro utile a été supprimé avec succès');
        }

        return redirect()->route('dashboard.edit_livret')->with('success', 'Votre numéro de téléphone a été supprimé avec succès');
    }

    public function addModuleUtilsInfos(Request $request)
    {
        $livret = auth()->user()->livret;

        $utilsInfos = new ModuleUtilsInfos();
        $utilsInfos->name = 'Infos pratiques';
        $utilsInfos->sub_name = $request->sub_name;
        $utilsInfos->text = $request->text;
        $utilsInfos->livret = $livret->id;
        $utilsInfos->save();

        return redirect()->route('dashboard.edit_livret')->with('success', 'Votre information pratique a été mis à jour avec succès');
    }

    public function deleteModuleUtilsInfos($id)
    {
        $utilsInfos = ModuleUtilsInfos::find($id);
        $utilsInfos->delete();

        if(auth()->user()->role == 'admin'){
            return redirect()->route('admin.livrets.index')->with('success', 'Votre info utile a été supprimé avec succès');
        }

        return redirect()->route('dashboard.edit_livret')->with('success', 'Votre information pratique a été supprimé avec succès');
    }

    public function addModuleStartInfo(Request $request)
    {
        $livret = auth()->user()->livret;

        $startInfo = new ModuleStartInfos();
        $startInfo->name = $request->name;
        $startInfo->text = $request->text;
        $startInfo->livret = $livret->id;
        $startInfo->save();

        return redirect()->route('dashboard.edit_livret')->with('success', 'Votre information d\'arrivée a été mis à jour avec succès');
    }

    public function deleteModuleStartInfo($id)
    {
        $startInfo = ModuleStartInfos::find($id);
        $startInfo->delete();

        if(auth()->user()->role == 'admin'){
            return redirect()->route('admin.livrets.index')->with('success', 'Votre info d\'arrivé a été supprimé avec succès');
        }

        return redirect()->route('dashboard.edit_livret')->with('success', 'Votre information d\'arrivée a été supprimé avec succès');
    }

    public function addModuleEndInfo(Request $request)
    {
        $livret = auth()->user()->livret;

        $startInfo = new ModuleEndInfos();
        $startInfo->name = $request->name;
        $startInfo->text = $request->text;
        $startInfo->livret = $livret->id;
        $startInfo->save();

        return redirect()->route('dashboard.edit_livret')->with('success', 'Votre information de départ a été mis à jour avec succès');
    }

    public function deleteModuleEndInfo($id)
    {
        $startInfo = ModuleEndInfos::find($id);
        $startInfo->delete();

        if(auth()->user()->role == 'admin'){
            return redirect()->route('admin.livrets.index')->with('success', 'Votre info de départ a été supprimé avec succès');
        }

        return redirect()->route('dashboard.edit_livret')->with('success', 'Votre de départ information a été supprimé avec succès');
    }

    public function addModuleHomeInfos(Request $request)
    {
        $livret = auth()->user()->livret;
        if ($livret->homeInfos) {
            $homeInfos = $livret->homeInfos;
            $homeInfos->name = $request->name;
            $homeInfos->text = $request->text;
            $homeInfos->save();
        } else {
            $homeInfos = new ModuleHome();
            $homeInfos->name = $request->name;
            $homeInfos->text = $request->text;
            $homeInfos->livret = $livret->id;
            $homeInfos->save();
        }

        return redirect()->route('dashboard.edit_livret')->with('success', 'Votre information de départ a été mis à jour avec succès');
    }

 /*   public function deleteModuleHomeInfos($id)
    {
        $homeInfos = ModuleHome::find($id);
        $homeInfos->delete();

        if(auth()->user()->role == 'admin'){
            return redirect()->route('admin.livrets.index')->with('success', 'Votre réseau wifi a été supprimé avec succès');
        }

        return redirect()->route('dashboard.edit_livret')->with('success', 'Votre de départ information a été supprimé avec succès');
    }*/

    public function stats(Request $request)
    {
        $livret = auth()->user()->livret;

        $totalViews = LivretView::where('livret_id', $livret->id)->count();

        $viewsThisWeek = LivretView::where('livret_id', $livret->id)
            ->whereBetween('viewed_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();

        $viewsToday = LivretView::where('livret_id', $livret->id)
            ->whereDate('viewed_at', today())
            ->count();

        $viewsThisMonth = LivretView::where('livret_id', $livret->id)
            ->whereBetween('viewed_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->count();

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $viewsBetweenDates = null;
        if ($startDate && $endDate) {
            $endDate = $endDate . ' 23:59:59';
            $viewsBetweenDates = LivretView::where('livret_id', $livret->id)
                ->whereBetween('viewed_at', [$startDate, $endDate])
                ->count();
        }

        return view('dashboard.stats', [
            'livret' => $livret,
            'totalViews' => $totalViews,
            'viewsThisWeek' => $viewsThisWeek,
            'viewsToday' => $viewsToday,
            'viewsThisMonth' => $viewsThisMonth,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'viewsBetweenDates' => $viewsBetweenDates,
        ]);
    }

    public function addModulePlacesGroups(Request $request)
    {
        $livret = auth()->user()->livret;
        $placeGroup = new PlaceGroup();
        $placeGroup->name = $request->groupName;
        $placeGroup->livret_id = $livret->id;
        $placeGroup->save();

        return redirect()->route('dashboard.edit_livret')->with('success', 'Votre groupe a été ajouté avec succès');
    }

    public function deleteModulePlacesGroups($id)
    {
        $placeGroup = PlaceGroup::find($id);
        $placeGroup->delete();

        if(auth()->user()->role == 'admin'){
            return redirect()->route('admin.livrets.index')->with('success', 'Votre groupe de lieu a été supprimé avec succès');
        }

        return redirect()->route('dashboard.edit_livret')->with('success', 'Votre groupe a été supprimé avec succès');
    }

    public function addModuleNearbyPlaces(Request $request)
    {
        $livret = auth()->user()->livret;
        $nearbyPlace = new NearbyPlace();
        $nearbyPlace->name = $request->placeName;
        $nearbyPlace->address = $request->placeAddress;
        $nearbyPlace->phone = $request->placePhone;
        $nearbyPlace->description = $request->placeDescription;
        $nearbyPlace->place_group_id = $request->placeGroup;
        $nearbyPlace->travel_time = $request->travelTime;
        $nearbyPlace->livret_id = $livret->id;
        $nearbyPlace->save();

        return redirect()->route('dashboard.edit_livret')->with('success', 'Votre groupe a été ajouté avec succès');
    }

    public function deleteModuleNearbyPlaces($id)
    {
        $nearbyPlace = NearbyPlace::find($id);
        $nearbyPlace->delete();

        if(auth()->user()->role == 'admin'){
            return redirect()->route('admin.livrets.index')->with('success', 'Votre lieu a été supprimé avec succès');
        }

        return redirect()->route('dashboard.edit_livret')->with('success', 'Votre groupe a été supprimé avec succès');
    }

    public function contactSupport(Request $request)
    {
        if ($request->rgpd !== 'on') {
            return redirect()->route('dashboard.index')->with('error', 'Vous devez accepter les conditions d\'utilisation pour pouvoir envoyer un message');
        }

        $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        $user = auth()->user();

        try {

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'ssl0.ovh.net';
            $mail->Port = '465';
            $mail->isHTML(true);
            $mail->Username = "contact@maplaque-nfc.fr";
            $mail->Password = "3v;jcPFeUPMBCP9";
            $mail->SetFrom("contact@maplaque-nfc.fr", "Livret d'accueil");
            $mail->Subject = 'Nouveau support - Livret d\'accueil';
            $mail->Body = '
                <html>
                <body>
                  <h1>Demande de support</h1>
                   <p>De : ' . $user->name . '</p>
                   <p>Email : ' . $user->email . '</p>
                   <p>Sujet : ' . $request->subject . '</p>
                   <p>' . $request->message . '</p>
                </body>
                </html>
            ';
            $mail->AddAddress('mehdi.raposo77@gmail.com');

            $mail->send();

            return redirect()->route('dashboard.index')->with('success', 'Votre demande de support a été envoyée avec succès');
        } catch (Exception $e) {
            return redirect()->route('dashboard.index')->with('error', 'Une erreur est survenue lors de l\'envoi de votre demande de support');
        }

    }

    public function inventories()
    {
        $livret = auth()->user()->livret;
        $inventories = Inventory::where('livret_id', $livret->id)->paginate(15);

        return view('dashboard.inventories', [
            'livret' => $livret,
            'inventories' => $inventories,
        ]);
    }

    public function addInventory(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'client_name' => 'required|string',
            'status' => 'required|string',
            'client_comment' => 'nullable|string',
            'attachment_names.*' => 'nullable|file|mimes:pdf,png,jpeg,webp,jpg',
        ]);

        $inventory = new Inventory;
        $inventory->livret_id = auth()->user()->livret->id;
        $inventory->start_date = $request->start_date;
        $inventory->end_date = $request->end_date;
        $inventory->client_name = $request->client_name;
        $inventory->status = $request->status;
        $inventory->client_comment = $request->client_comment;

        if ($request->hasFile('attachment_names')) {
            $attachments = [];
            $i = 0;
            foreach ($request->file('attachment_names') as $attachment) {
                $filename = $i . time() . '.' . $attachment->getClientOriginalExtension();
                $attachment->move(public_path('assets/uploads/inventory_attachments'), $filename);
                $attachments[] = 'assets/uploads/inventory_attachments/' . $filename;
                $i++;
            }
            $inventory->attachment_names = json_encode($attachments);
        }

        $inventory->save();

        return redirect()->route('dashboard.inventories')->with('success', 'Etat des lieux ajouté avec succès');
    }

    public function statusInventory(Request $request)
    {
        $request->validate([
            'status' => 'required|string',
            'inventory_id' => 'required|integer',
        ]);

        $inventory = Inventory::find($request->inventory_id);
        $inventory->status = $request->status;
        $inventory->save();

        return redirect()->route('dashboard.inventories')->with('success', 'Le status de l\'état des lieux a été mis à jour avec succès');
    }

    public function deleteInventory($id)
    {
        $inventory = Inventory::find($id);

        $attachments = json_decode($inventory->attachment_names);

        if ($attachments) {
            foreach ($attachments as $attachment) {
                if (file_exists(public_path($attachment))) {
                    unlink(public_path($attachment));
                }
            }
        }

        $inventory->delete();

        return redirect()->route('dashboard.inventories')->with('success', 'L\'état des lieux a été supprimé avec succès');
    }

    public function suggestions()
    {
        $livret = auth()->user()->livret;
        $suggestions = $livret->suggestions()->paginate(15);

        return view('dashboard.suggestions', [
            'livret' => $livret,
            'suggestions' => $suggestions,
        ]);
    }

    public function enableSuggestion($id)
    {
        $livret = Livret::find($id);
        $livret->suggest = !$livret->suggest;
        $livret->save();

        return redirect()->route('dashboard.suggestions')->with('success', 'La suggestion a été mise à jour avec succès');
    }

    public function statusSuggestion(Request $request)
    {
        /*$request->validate([
            'status' => 'required|string',
            'suggestion_id' => 'required|integer',
        ]);*/

        $suggestion = Suggest::find($request->suggestion_id);
        $suggestion->status = $request->status_suggest;
        $suggestion->save();

        return redirect()->route('dashboard.suggestions')->with('success', 'Le status de la suggestion a été mis à jour avec succès');
    }

}
