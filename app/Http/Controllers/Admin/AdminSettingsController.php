<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class AdminSettingsController extends Controller
{
    /**
     * AdSense credentials live in .env (see config/adsense.php). They are
     * deliberately NOT editable from the admin panel - only the developer,
     * with access to the environment file, can change them. The admin gets a
     * masked, read-only view of the current state.
     */
    public function show()
    {
        $adsense = [
            'enabled' => (bool) config('adsense.enabled'),
            'publisher_id' => (string) config('adsense.publisher_id'),
            'slots' => [
                'header' => (string) config('adsense.slots.header'),
                'sidebar' => (string) config('adsense.slots.sidebar'),
                'footer' => (string) config('adsense.slots.footer'),
            ],
        ];

        return view('admin.settings', compact('adsense'));
    }

    public function updatePassword(Request $request)
    {
        $admin = $request->user();

        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ]);

        // Re-authenticate before letting the account's credentials change:
        // an admin session alone must not be enough to take the account over.
        if (! Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors([
                'current_password' => 'Current password is incorrect.',
            ])->withInput($request->except('current_password', 'password', 'password_confirmation'));
        }

        if (Hash::check($request->password, $admin->password)) {
            return back()->withErrors([
                'password' => 'Please choose a password different from your current one.',
            ])->withInput($request->except('current_password', 'password', 'password_confirmation'));
        }

        // The password is hashed by the model's 'hashed' cast on save. The
        // remember token is rotated in the same write, because the old token
        // was issued against the previous credentials and must not survive.
        $admin->forceFill([
            'password' => $request->password,
            'remember_token' => Str::random(60),
        ])->save();

        return redirect()
            ->route('admin.settings')
            ->with('success', 'Your password has been changed successfully.');
    }
}