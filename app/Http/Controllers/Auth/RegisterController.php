<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function show(Request $request)
    {
        $ref = $request->query('ref');
        $refInvalid = false;

        if ($ref) {
            $refInvalid = ! User::where('referral_code', $ref)->where('is_active', true)->where('is_admin', false)->exists();
        }

        return view('auth.register', compact('ref', 'refInvalid'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            // Accounts here can hold real money, so require more than a
            // 6-character lowercase password.
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
            'referral_code' => 'nullable|string|max:10',
        ]);

        $referrer = null;
        if ($request->filled('referral_code')) {
            // Referrers must have an activated (paid) account; admins cannot be referrers
            $referrer = User::where('referral_code', $request->referral_code)
                ->where('is_active', true)
                ->where('is_admin', false)
                ->first();

            if (! $referrer) {
                return back()
                    ->withInput()
                    ->withErrors(['referral_code' => 'This referral code is invalid or the referrer has not activated their account yet.']);
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'referred_by' => $referrer?->id,
        ]);

        event(new Registered($user));
        auth()->login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard')->with('success', 'Welcome to Me Earning! Please activate your account by selecting a plan.');
    }
}
