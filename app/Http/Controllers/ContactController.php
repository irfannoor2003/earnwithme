<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        Mail::to(config('mail.contact_address'))->send(new ContactFormMessage(
            $request->name,
            $request->email,
            $request->subject,
            $request->message,
        ));

        return redirect()->route('contact')->with('success', 'Your message has been sent! We will get back to you soon.');
    }
}
