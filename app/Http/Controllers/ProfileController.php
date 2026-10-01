<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();

        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:15',
            'current_password' => ['nullable', 'required_with:password'],
            'password' => ['nullable', 'confirmed', Password::min(8)->letters()->numbers()],
        ]);

        // Changing the address on a money-bearing account is a sensitive
        // action, so it needs the password like a password change does.
        $emailChanged = strcasecmp($request->email, $user->email) !== 0;

        if ($request->filled('password') || $emailChanged) {
            if (! Hash::check($request->current_password ?? '', $user->password)) {
                return back()->withErrors([
                    'current_password' => 'Current password is incorrect.',
                ])->withInput();
            }
        }

        $data = $request->only(['name', 'email', 'phone']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($emailChanged) {
            // The verified flag described the OLD address. Carrying it over
            // would let anyone point the account at an address they do not
            // control and keep full access to the member area.
            $data['email_verified_at'] = null;
        }

        // forceFill: the user-controlled part is already narrowed to name,
        // email and phone by ->only(), but email_verified_at is deliberately
        // not mass assignable, and it has to be cleared here.
        $user->forceFill($data);
        $user->save();

        if ($emailChanged) {
            $user->sendEmailVerificationNotification();

            return redirect()->route('profile')->with(
                'success',
                'Profile updated. We sent a verification link to your new email address - please confirm it to continue using your account.'
            );
        }

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
}
