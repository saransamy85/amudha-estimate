<?php

namespace App\Http\Controllers;

use App\Mail\GreetingMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class greetingcontroller extends Controller
{
    //

    public function sendGreeting(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required',
            'attachments.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $htmlContent = $request->message;
        $files = $request->file('attachments', []);

        Mail::to($request->email)->send(
            new GreetingMail($htmlContent, $files)
        );

        return back()->with('success', 'Greeting email sent successfully!');
    }

    public function sendmail()
    {
        return view('Mails/greetings');
    }
}
