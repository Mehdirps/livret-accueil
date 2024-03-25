<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class AuthController extends Controller
{
    public function doLogin(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if($user->role == 'admin'){
                return redirect()->route('admin.index');
            }

            if (!$user->email_verified_at) {
                /* Auth::logout();*/
                return redirect()->route('home')->with('error', 'Veuillez vérifier votre adresse e-mail avant d\'accéder à votre espace, vérifier dans votre boite e-mail ou dans les spams.');
            }

            if ($user->first_login) {
                return redirect()->route('dashboard.first_login');
            } else {
                return redirect()->route('dashboard.index');
            }
        } else {
            return back()->withErrors([
                'email' => 'E-mail invalide'
            ])->onlyInput('email');
        }
    }

    public function doRegister(RegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->last_name . ' ' . $request->first_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->etablissement_type = $request->establishment_type;
        $user->save();

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
            $mail->Subject = 'Merci pour votre inscription !';
            $mail->Body = '
            <h1>Bienvenue sur notre site web</h1>
           <p>Merci de vous être inscrit sur notre site web. Veuillez cliquer sur le lien ci-dessous pour vérifier votre adresse e-mail et compléter votre inscription :</p>
           <p>
              <a href="' . url('/auth/verify_email/' . $user->email) . '">Vérifier l\'Email</a>
           </p>
           <p>Si vous ne vous êtes pas inscrit sur notre site web, veuillez ignorer cet email.</p>
           <p>Meilleures salutations,</p>
           <p>L\'équipe de votre site web</p>';
            $mail->AddAddress($user->email);

            $mail->send();

            echo 'Message has been sent';

        } catch (Exception $e) {

            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;

        }

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Bienvenue ' . $user->name . ', votre compte a été créé avec succès. Veuillez vérifier votre adresse e-mail pour activer votre compte.');
    }

    public function verify($email)
    {
        $user = User::where('email', $email)->first();
        if ($user) {
            $user->email_verified_at = now();
            $user->save();
            return redirect()->route('home')->with('success', 'Votre compte a été activé avec succès. Vous pouvez maintenant vous connecter.');
        }
        return redirect()->route('home')->with('error', 'Lien de vérification invalide.');
    }

    public function doLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
