<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactEmail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendEmail(Request $request)
    {
        // Validate the form data here if needed
        $name = $request->input('name');
        $email = $request->input('email');
        $subject = $request->input('sub');
        $messages = $request->input('messages');

        // Send the email using the ContactEmail Mailable
        Mail::to('contact@hammamboulaaba.com')->queue(new ContactEmail($name, $email, $subject, $messages));

        // Return a JSON response
        return response()->json(['message' => 'E-mail de contact envoyé avec succès']);
    }
}
