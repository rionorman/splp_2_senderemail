<?php

namespace App\Http\Controllers;

use App\Mail\MailSender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailAPI extends Controller
{
    public function formEmail()
    {
        return view('email.formemail');
    }

    public function sendEmail(Request $request)
    {
        $emails = explode(";", $request->email);
        foreach ($emails as $email) {
            Mail::to($email)->send(
                new MailSender($request->subject, nl2br($request->content))
            );
        }
        return response()->json([
            'success' => 1,
            'message' => "Email berhasil terkirim ke " . $request->email,
        ]);
    }
}
