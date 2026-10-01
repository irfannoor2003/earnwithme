<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    private function member(array $attrs = []): User
    {
        return User::factory()->create(array_merge([
            'is_active' => true,
            'is_admin' => false,
            'email_verified_at' => now(),
            'password' => 'oldpass123',
        ], $attrs));
    }

    /**
     * Pull the real single-use token out of the notification.
     *
     * The database only ever holds a bcrypt hash of it, and a bcrypt hash
     * contains slashes, so it cannot be used as a URL segment.
     */
    private function tokenFor(User $user): string
    {
        Notification::fake();

        $this->post('/forgot-password', ['email' => $user->email]);

        $token = null;

        Notification::assertSentTo($user, ResetPassword::class, function (ResetPassword $notification) use (&$token) {
            $token = $notification->token;

            return true;
        });

        $this->assertNotNull($token, 'no reset token was issued');

        return $token;
    }

    public function test_forgot_password_page_renders(): void
    {
        $this->get('/forgot-password')->assertOk()->assertSee('Reset Password');
    }

    public function test_login_page_links_to_forgot_password(): void
    {
        $html = $this->get('/login')->assertOk()->getContent();

        $this->assertStringContainsString(
            route('password.request'),
            $html,
            'the "Forgot password?" link must point at the reset page, not back at login'
        );
    }

    public function test_reset_link_is_emailed(): void
    {
        Notification::fake();
        $user = $this->member();

        $this->post('/forgot-password', ['email' => $user->email])
            ->assertSessionHas('status')
            ->assertRedirect();

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
            $url = $notification->toMail($user)->actionUrl;

            return str_contains($url, route('password.reset', ['token' => 'PLACEHOLDER'], absolute: false))
                || str_contains($url, '/reset-password/');
        });

        $this->assertNotNull(
            DB::table('password_reset_tokens')->where('email', $user->email)->first(),
            'a reset token must be stored'
        );
    }

    public function test_password_can_be_reset_with_the_token(): void
    {
        Notification::fake();
        $user = $this->member();
        $token = $this->tokenFor($user);

        $this->get("/reset-password/{$token}?email=".$user->email)
            ->assertOk()
            ->assertSee('Choose a New Password');

        $this->post('/reset-password', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'brandnew123',
            'password_confirmation' => 'brandnew123',
        ])->assertRedirect('/login')->assertSessionHas('status');

        $this->assertTrue(Hash::check('brandnew123', $user->fresh()->password));
        $this->assertFalse(Hash::check('oldpass123', $user->fresh()->password));

        // Token must be single use.
        $this->assertNull(DB::table('password_reset_tokens')->where('email', $user->email)->first());
    }

    public function test_new_password_must_meet_the_same_policy_as_registration(): void
    {
        Notification::fake();
        $user = $this->member();
        $token = $this->tokenFor($user);

        foreach (['short', '12345678', 'abcdefgh'] as $weak) {
            $this->post('/reset-password', [
                'token' => $token,
                'email' => $user->email,
                'password' => $weak,
                'password_confirmation' => $weak,
            ])->assertSessionHasErrors('password');
        }

        $this->assertTrue(Hash::check('oldpass123', $user->fresh()->password), 'password must not change');
    }

    public function test_token_expires_after_the_configured_minutes(): void
    {
        Notification::fake();

        $this->assertSame(5, (int) config('auth.passwords.users.expire'));

        $user = $this->member();
        $token = $this->tokenFor($user);

        // Just inside the window: still works.
        $this->travel(4)->minutes();

        $this->post('/reset-password', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'brandnew123',
            'password_confirmation' => 'brandnew123',
        ])->assertRedirect('/login');

        $this->assertTrue(Hash::check('brandnew123', $user->fresh()->password));
    }

    public function test_token_is_rejected_once_expired(): void
    {
        Notification::fake();
        $user = $this->member();
        $token = $this->tokenFor($user);

        $this->travel(6)->minutes();

        $this->post('/reset-password', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'brandnew123',
            'password_confirmation' => 'brandnew123',
        ])->assertSessionHasErrors('email');

        $this->assertTrue(
            Hash::check('oldpass123', $user->fresh()->password),
            'an expired link must not change the password'
        );
    }

    public function test_expired_link_page_still_renders_but_will_not_save(): void
    {
        Notification::fake();
        $user = $this->member();
        $token = $this->tokenFor($user);

        $this->travel(6)->minutes();

        // The form is reachable; the save is what must fail.
        $this->get("/reset-password/{$token}?email=".$user->email)->assertOk();
    }

    public function test_garbled_token_is_rejected(): void
    {
        $user = $this->member();

        $this->post('/reset-password', [
            'token' => 'not-a-real-token',
            'email' => $user->email,
            'password' => 'brandnew123',
            'password_confirmation' => 'brandnew123',
        ])->assertSessionHasErrors('email');

        $this->assertTrue(Hash::check('oldpass123', $user->fresh()->password));
    }

    public function test_response_does_not_reveal_whether_an_email_exists(): void
    {
        Notification::fake();
        $this->member(['email' => 'known@example.com']);

        $this->post('/forgot-password', ['email' => 'known@example.com']);
        $known = session('status');

        $this->post('/forgot-password', ['email' => 'nobody@example.com']);
        $unknown = session('status');

        $this->assertNotNull($known);
        $this->assertEquals(
            $known,
            $unknown,
            'identical wording prevents member-list enumeration'
        );
    }

    public function test_reset_signs_out_other_sessions(): void
    {
        // The suite runs on the array session driver, but production uses the
        // database driver, so force it to exercise the real code path.
        config(['session.driver' => 'database']);

        Notification::fake();
        $user = $this->member();
        $token = $this->tokenFor($user);

        DB::table('sessions')->insert([
            'id' => 'stolen-session-id',
            'user_id' => $user->id,
            'ip_address' => '203.0.113.1',
            'user_agent' => 'other-device',
            'payload' => 'x',
            'last_activity' => time(),
        ]);

        $this->assertSame(1, DB::table('sessions')->where('user_id', $user->id)->count());

        $this->post('/reset-password', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'brandnew123',
            'password_confirmation' => 'brandnew123',
        ])->assertRedirect('/login');

        $this->assertSame(
            0,
            DB::table('sessions')->where('user_id', $user->id)->count(),
            'a session cookie stolen before the reset must not survive it'
        );
    }

    public function test_forgot_password_is_rate_limited(): void
    {
        Notification::fake();
        $user = $this->member();

        $blocked = false;
        for ($i = 0; $i < 8; $i++) {
            if ($this->post('/forgot-password', ['email' => $user->email])->status() === 429) {
                $blocked = true;
                break;
            }
        }

        $this->assertTrue($blocked, 'reset requests must be throttled to prevent mailbox flooding');
    }

    public function test_signed_in_members_are_sent_to_their_profile_instead(): void
    {
        $user = $this->member();

        $this->actingAs($user)->get('/forgot-password')->assertRedirect();
    }
}
