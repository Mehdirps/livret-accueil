<?php

namespace App\Http\Controllers;

use App\Models\Suggest;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class SuggestionController extends Controller
{
    public function store(Request $request)
    {
        if ($request->rgpd == null) {
            return redirect()->back()->with('error_suggest', 'Vous devez accepter les conditions d\'utilisation pour envoyer une suggestion !');
        } else {

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'title' => 'required|string|max:255',
                'message' => 'required|string',
            ]);

            $suggestion = new Suggest();
            $suggestion->livret_id = $request->livret_id;
            $suggestion->name = $request->name;
            $suggestion->email = $request->email;
            $suggestion->title = $request->title;
            $suggestion->message = $request->message;
            $suggestion->status = 'pending';
            $suggestion->save();

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
                $mail->Subject = 'Nouvelle suggestion pour votre livret';
                $mail->Body    = '<h1>Nouvelle suggestion de ' . $request->name . '</h1>
                              <p>Titre: ' . $request->title . '</p>
                              <p>Message: ' . $request->message . '</p>';

                $mail->send();
                $mail->AddAddress('mehdi.raposo77@gmail.com');

                $mail->send();

                return redirect()->back()->with('success_suggest', 'Votre suggestion a bien été envoyée !');
            } catch (Exception $e) {
                return redirect()->back()->with('error_suggest', 'Une erreur est survenue lors de l\'envoi de votre suggestion !');
            }

        }
    }
}
