<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

/**
 * Covers the account-link expiry windows and the branded mail design.
 */
class AccountLinksTest extends TestCase
{
    use RefreshDatabase;

    // ---------------------------------------------------------------------
    // Verification link window
    // ---------------------------------------------------------------------

    public function test_verification_link_expires_after_five_minutes(): void
    {
        $this->assertSame(
            5,
            (int) config('auth.verification.expire'),
            'the verification window must match the password reset window'
        );
    }

    public function test_verification_link_is_signed_with_the_configured_window(): void
    {
        $user = User::factory()->unverified()->create();

        $url = (new VerifyEmail)->toMail($user)->actionUrl;
        parse_str((string) parse_url($url, PHP_URL_QUERY), $query);

        $minutes = ($query['expires'] - time()) / 60;

        $this->assertGreaterThan(4.5, $minutes);
        $this->assertLessThanOrEqual(5, $minutes);
    }

    public function test_expired_verification_link_does_not_verify_the_account(): void
    {
        Notification::fake();

        $user = User::factory()->unverified()->create();
        $url = (new VerifyEmail)->toMail($user)->actionUrl;

        $this->travel(6)->minutes();

        $this->actingAs($user)->get($url)->assertForbidden();

        $this->assertFalse(
            $user->fresh()->hasVerifiedEmail(),
            'a link past its window must not confirm the email address'
        );
    }

    public function test_verification_link_inside_the_window_still_works(): void
    {
        Notification::fake();

        $user = User::factory()->unverified()->create();
        $url = (new VerifyEmail)->toMail($user)->actionUrl;

        $this->travel(4)->minutes();

        $this->actingAs($user)->get($url)->assertRedirect('/dashboard');

        $this->assertTrue($user->fresh()->hasVerifiedEmail());
    }

    public function test_verify_page_states_the_real_window(): void
    {
        $user = User::factory()->unverified()->create();

        $html = $this->actingAs($user)->get('/email/verify')->assertOk()->getContent();

        $this->assertStringContainsString(
            'Link 5 minutes tak valid hai',
            $html,
            'the notice must not hardcode a window that config can change'
        );
    }

    // ---------------------------------------------------------------------
    // Mail branding
    // ---------------------------------------------------------------------

    public function test_mail_uses_the_branded_markdown_theme(): void
    {
        $this->assertSame('meearning', config('mail.markdown.theme'));

        $this->assertFileExists(
            resource_path('views/vendor/mail/html/themes/meearning.css'),
            'the theme named in config must exist, or mail silently falls back to grey'
        );
    }

    public function test_mail_sends_as_the_branded_no_reply_address(): void
    {
        // A blank APP_NAME leaves the From header empty, which fails SPF/DMARC
        // and drops verification links into spam.
        $this->assertSame('Me Earning Platform', config('app.name'));
        $this->assertSame('Me Earning Platform', config('mail.from.name'));
        $this->assertSame('no-reply@meearningplatform.com', config('mail.from.address'));
    }

    public function test_sites_root_url_points_at_the_live_domain(): void
    {
        // Signed verification links are built from this. If it is still the
        // local placeholder, every emailed link 404s in production.
        $this->assertSame('https://www.meearningplatform.com', rtrim(config('app.url'), '/'));
    }

    public function test_verification_mail_subject_is_branded(): void
    {
        $user = User::factory()->unverified()->create();

        $message = (new VerifyEmail)->toMail($user);

        $this->assertStringContainsString(config('app.name'), $message->subject);
        $this->assertStringNotContainsString('Laravel', $message->subject);
    }

    public function test_verification_mail_carries_the_brand_and_the_expiry_notice(): void
    {
        $user = User::factory()->unverified()->create(['name' => 'Ali Khan']);

        $html = (new VerifyEmail)->toMail($user)->render();

        $this->assertStringContainsString('#4caf2f', $html, 'the CTA must use the brand green');
        $this->assertStringContainsString('Referral Earning Platform', $html);
        $this->assertStringContainsString('Welcome to '.config('app.name').', Ali Khan!', $html);
        $this->assertStringContainsString('This link expires in 5 minutes', $html);
        $this->assertStringNotContainsString('#18181b', $html, 'the stock dark button must be gone');
    }

    public function test_reset_mail_carries_the_brand_and_the_expiry_notice(): void
    {
        $user = User::factory()->create();

        $message = (new ResetPassword('a-token'))->toMail($user);

        $this->assertStringContainsString(
            'a-token',
            $message->actionUrl,
            'the branded callback must still produce a usable reset link'
        );

        $html = $message->render();

        $this->assertStringContainsString('#4caf2f', $html);
        $this->assertStringContainsString('This link expires in 5 minutes', $html);
    }

    public function test_verification_mail_still_reaches_the_signed_route(): void
    {
        $user = User::factory()->unverified()->create();

        $url = (new VerifyEmail)->toMail($user)->actionUrl;

        $this->assertStringContainsString(
            route('verification.verify', ['id' => $user->id, 'hash' => sha1($user->email)], absolute: false),
            str_replace(urlencode('&'), '&', $url),
            'the branded mail must not lose the signature the route checks'
        );
    }

    public function test_contact_mail_is_rendered_through_the_brand_template(): void
    {
        $html = (new \App\Mail\ContactFormMessage(
            'Ali <script>alert(1)</script>',
            'ali@example.com',
            'Order #1',
            'Please help <b>me</b>.',
        ))->render();

        $this->assertStringContainsString('#4caf2f', $html);
        $this->assertStringNotContainsString(
            '<script>alert(1)</script>',
            $html,
            'a contact form field must not land in the mail as live markup'
        );
    }
}
