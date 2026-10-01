<?php

namespace Tests\Feature;

use App\Models\Deposit;
use App\Models\Plan;
use App\Models\Reward;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SmokeRoutesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The Urdu copy lives in blade files. Any tool that rewrites them with the
     * wrong encoding silently double-encodes it, which renders as garbage for
     * every member. This fails loudly instead.
     */
    public function test_blade_files_are_valid_utf8_without_mojabake(): void
    {
        // Typographic characters that are legitimately encoded and must not be
        // mistaken for damage.
        $legitimate = ['·', '©', '®', '°', '€', '£'];

        $bad = [];

        foreach (glob(resource_path('views/**/*.blade.php')) ?: [] as $file) {
            $bytes = file_get_contents($file);
            $name = basename($file);

            if (substr($bytes, 0, 3) === "\xEF\xBB\xBF") {
                $bad[] = "{$name}: has a UTF-8 BOM";
            }

            if (! mb_check_encoding($bytes, 'UTF-8')) {
                $bad[] = "{$name}: not valid UTF-8";

                continue;
            }

            // Mojibake turns Arabic (U+0600-U+06FF) into Latin-1 characters
            // (U+0080-U+00FF). Any such character outside the legitimate set
            // above means the file was re-encoded with the wrong codepage.
            $flagged = [];

            foreach (preg_split('//u', $bytes, -1, PREG_SPLIT_NO_EMPTY) as $ch) {
                $cp = mb_ord($ch, 'UTF-8');

                if ($cp >= 0x80 && $cp <= 0xFF && ! in_array($ch, $legitimate, true)) {
                    $flagged[] = sprintf('U+%04X (%s)', $cp, $ch);
                }
            }

            if ($flagged !== []) {
                $bad[] = sprintf(
                    '%s: %d double-encoded character(s), first %s',
                    $name,
                    count($flagged),
                    $flagged[0]
                );
            }
        }

        $this->assertSame([], $bad, implode("\n", $bad));
    }

    public function test_every_route_renders(): void
    {
        $plan = Plan::create(['name' => 'Premium', 'price' => 350, 'is_active' => true]);

        $admin = User::factory()->create(['is_admin' => true, 'is_active' => true, 'email_verified_at' => now()]);
        $member = User::factory()->create(['is_active' => true, 'balance' => 5000, 'email_verified_at' => now()]);
        $other = User::factory()->create(['is_active' => true, 'email_verified_at' => now()]);

        $dep = Deposit::create(['user_id' => $member->id, 'plan_id' => $plan->id, 'amount' => 350,
            'method' => 'jazzcash', 'transaction_id' => 'S1', 'status' => 'approved']);
        $wd = Withdrawal::create(['user_id' => $member->id, 'amount' => 200, 'fee' => 2,
            'method' => 'easypaisa', 'account_number' => '03', 'status' => 'approved']);
        $rw = Reward::create(['user_id' => $member->id, 'issued_by' => $admin->id, 'amount' => 50, 'reason' => 'x']);

        $fail = [];

        foreach (['/', '/plans', '/earning-details', '/about', '/contact', '/business-plan',
            '/register', '/login', '/email/verify'] as $u) {
            $s = $this->get($u)->status();
            if ($s >= 500) {
                $fail[] = "PUB $u => $s";
            }
        }

        $this->actingAs($member);
        foreach (['/dashboard', '/deposit', '/withdraw', '/referrals', '/earnings', '/profile',
            "/deposits/{$dep->id}/receipt", "/withdrawals/{$wd->id}/receipt"] as $u) {
            $s = $this->get($u)->status();
            if ($s >= 500) {
                $fail[] = "MEM $u => $s";
            }
        }

        $this->actingAs($admin);
        foreach (['/admin', '/admin/deposits', '/admin/withdrawals', '/admin/users',
            "/admin/users/{$member->id}/referrals", '/admin/rewards',
            "/admin/rewards/{$rw->id}/receipt", '/admin/settings', '/dashboard'] as $u) {
            $s = $this->get($u)->status();
            if ($s >= 500) {
                $fail[] = "ADM $u => $s";
            }
        }

        // Cross-user access must be denied, not error.
        $this->actingAs($other);
        $s = $this->get("/deposits/{$dep->id}/receipt")->status();
        if ($s !== 403) {
            $fail[] = "ownership guard returned $s not 403";
        }

        $this->assertSame([], $fail, implode("\n", $fail));
    }
}
