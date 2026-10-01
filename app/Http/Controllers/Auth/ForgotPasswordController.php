<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function show()
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        Password::sendResetLink($request->only('email'));

        // The same message is shown whether or not the address is registered.
        // Telling the visitor which emails exist would leak the member list.
        return back()->with(
            'status',
            'If that email address belongs to an account, a password reset link is on its way. The link expires in '
            .config('auth.passwords.users.expire').' minutes.'
        );
    }
}
