<?php

namespace App\Http\Controllers;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // In production, send email or store in DB
        return redirect()->route('contact')->with('success', 'Your message has been sent! We will get back to you soon.');
    }
}
