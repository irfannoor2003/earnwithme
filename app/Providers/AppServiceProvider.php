<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * Both auth emails are rebuilt here rather than subclassed: Laravel keys
     * faked/sent notifications by their exact class name, so a subclass would
     * break existing assertions. The callbacks keep
     * Illuminate\Auth\Notifications\{VerifyEmail,ResetPassword} as the sent
     * class while letting us control the copy and pass the expiry minutes
     * through to the branded markdown template.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function ($notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verify your email address - '.config('app.name'))
                ->greeting('Welcome to '.config('app.name').', '.$notifiable->name.'!')
                ->line('Thanks for signing up. Confirm your email address to activate your account and start earning commission from your referrals.')
                ->action('Verify My Email', $url)
                ->line('If you did not create a '.config('app.name').' account, no further action is required.')
                // markdown() carries the TTL through to the template's expiry
                // panel. with() would not: on a MailMessage it appends a body
                // line rather than setting a view variable.
                ->markdown('notifications::email', [
                    'expiresInMinutes' => (int) config('auth.verification.expire'),
                ]);
        });

        ResetPassword::toMailUsing(function ($notifiable, string $token) {
            $minutes = (int) config('auth.passwords.'.config('auth.defaults.passwords').'.expire');

            return (new MailMessage)
                ->subject('Reset your password - '.config('app.name'))
                ->greeting('Password reset request')
                ->line('We received a request to reset the password for your '.config('app.name').' account.')
                ->action('Reset My Password', $this->resetPasswordUrl($notifiable, $token))
                ->line('If you did not request this, no further action is required and your password stays unchanged.')
                ->markdown('notifications::email', [
                    'expiresInMinutes' => $minutes,
                ]);
        });
    }

    /**
     * Mirrors the framework's reset URL so the link still matches
     * route('password.reset') after this callback replaces the default mail.
     */
    private function resetPasswordUrl($notifiable, string $token): string
    {
        return url(route('password.reset', [
            'token' => $token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], absolute: false));
    }
}
