<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;

class ResetPasswordController extends Controller
{
    public function show(Request $request, string $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'email' => 'required|email',
            // Same policy as registration, so a reset cannot be used to
            // downgrade an account to something weaker.
            'password' => ['required', 'confirmed', PasswordRule::min(8)->letters()->numbers()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                // forceFill: password is not mass assignable, and the new
                // remember_token invalidates any "remember me" cookie.
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));

                // Sign the member out everywhere. Without this, a stolen
                // session cookie would survive the password change.
                $this->flushOtherSessions($user);
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with(
                'status',
                'Your password has been reset. Please sign in with your new password.'
            );
        }

        if ($status === Password::INVALID_TOKEN) {
            return redirect()->route('password.request')->withErrors([
                'email' => 'This reset link is invalid or has expired. Please request a new one.',
            ]);
        }

        return back()->withErrors(['email' => __($status)]);
    }

    /**
     * Delete this member's other database sessions so every signed-in device
     * is signed out. Only meaningful for the database session driver.
     */
    private function flushOtherSessions(User $user): void
    {
        if (config('session.driver') !== 'database') {
            return;
        }

        DB::table(config('session.table', 'sessions'))
            ->where('user_id', $user->getAuthIdentifier())
            ->delete();
    }
}
