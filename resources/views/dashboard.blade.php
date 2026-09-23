<x-layouts.dashboard title="Dashboard">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Welcome back, {{ $user->name }}!</h1>
        <p class="text-gray-500 text-sm mt-2">Yahan aapka dashboard hai. <span class="font-urdu text-xs">خوش آمدید</span></p>
    </div>

    <div class="mb-8 rounded-2xl p-6 relative overflow-hidden bg-white border border-gray-100 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 relative">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-gray-400">Current Plan</p>
                @if($user->plan)
                    <p class="text-gray-900 text-2xl font-bold mt-2">{{ $user->plan->name }}</p>
                @else
                    <p class="text-gray-400 text-2xl font-bold mt-2">No Plan</p>
                @endif
            </div>
            <div class="flex items-center gap-3">
                @if($user->plan)
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-semibold bg-gray-50 text-gray-500 border border-gray-100">
                        <span class="w-2 h-2 rounded-full animate-pulse bg-[#4caf2f]"></span>
                        Active
                    </span>
                @else
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-semibold bg-gray-50 text-gray-400 border border-gray-100">
                        Inactive
                    </span>
                    <a href="{{ route('deposit') }}" class="btn-primary text-xs py-2.5 px-5">
                        Get Started
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]">
            <div class="flex items-center justify-between">
                <p class="text-xs font-medium text-gray-400">Balance</p>
                <div class="w-9 h-9 rounded-lg flex items-center justify-center bg-[#e8f5e1]">
                    <svg class="w-4 h-4 text-[#4caf2f]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659 1.171-1.016 1.028.684a3 3 0 0 0 3.235-.563l.242-.407m-3.235 5.035-.242-.407a3 3 0 0 0-3.235-.563l-.242.407m3.235 5.035-.879.659-1.028-.684a3 3 0 0 0-3.235.563l-.242.407m3.235-5.035.242.407a3 3 0 0 0 3.235.563l.242-.407m-6.47-2.818.879.659 1.028-.684a3 3 0 0 0 3.235.563l.242-.407" /></svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-900 mt-4">Rs {{ number_format($user->balance, 2) }}</p>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]">
            <div class="flex items-center justify-between">
                <p class="text-xs font-medium text-gray-400">Total Earned</p>
                <div class="w-9 h-9 rounded-lg flex items-center justify-center bg-[#e8f5e1]">
                    <svg class="w-4 h-4 text-[#4caf2f]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 5.523-5.523L21.75 9 15 2.25l-2.25 6.75-4.306 4.306a11.95 11.95 0 0 1-5.523-5.523L2.25 18Z" /></svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-900 mt-4">Rs {{ number_format($totalCommissions, 2) }}</p>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]">
            <div class="flex items-center justify-between">
                <p class="text-xs font-medium text-gray-400">Active Referrals</p>
                <div class="w-9 h-9 rounded-lg flex items-center justify-center bg-violet-50">
                    <svg class="w-4 h-4 text-violet-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-900 mt-4">{{ $activeReferrals }}</p>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]">
            <div class="flex items-center justify-between">
                <p class="text-xs font-medium text-gray-400">Pending Deposits</p>
                <div class="w-9 h-9 rounded-lg flex items-center justify-center bg-amber-50">
                    <svg class="w-4 h-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-900 mt-4">{{ $pendingDeposits }}</p>
        </div>
    </div>

    <div class="mb-10">
        <h2 class="text-base font-semibold text-gray-900 mb-1">Commission Levels</h2>
        <p class="text-xs text-gray-400 mb-5">7-Level Referral System</p>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-7 gap-3">
            @foreach([1, 2, 3, 4, 5, 6, 7] as $lvl)
                @php
                    $colors = [
                        1 => ['bg' => 'bg-[#e8f5e1]', 'text' => 'text-[#43a027]', 'border' => 'border-[#c8e6b8]', 'pct' => 'Rs 110'],
                        2 => ['bg' => 'bg-[#e8f5e1]', 'text' => 'text-[#388e3c]', 'border' => 'border-[#c8e6b8]', 'pct' => 'Rs 50'],
                        3 => ['bg' => 'bg-amber-50', 'text' => 'text-amber-600', 'border' => 'border-amber-200', 'pct' => 'Rs 30'],
                        4 => ['bg' => 'bg-violet-50', 'text' => 'text-violet-600', 'border' => 'border-violet-200', 'pct' => 'Rs 20'],
                        5 => ['bg' => 'bg-[#e8f5e1]', 'text' => 'text-[#43a027]', 'border' => 'border-[#c8e6b8]', 'pct' => 'Rs 10'],
                        6 => ['bg' => 'bg-amber-50', 'text' => 'text-amber-600', 'border' => 'border-amber-200', 'pct' => 'Rs 10'],
                        7 => ['bg' => 'bg-violet-50', 'text' => 'text-violet-600', 'border' => 'border-violet-200', 'pct' => 'Rs 10'],
                    ];
                    $c = $colors[$lvl];
                @endphp
                <div class="rounded-xl p-4 bg-white border border-gray-100 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center text-[11px] font-bold {{ $c['bg'] }} {{ $c['text'] }} border {{ $c['border'] }}">L{{ $lvl }}</div>
                        <span class="text-[10px] font-bold {{ $c['text'] }}">{{ $c['pct'] }}</span>
                    </div>
                    <p class="text-lg font-bold text-gray-900">Rs {{ number_format($levelCommissions[$lvl] ?? 0, 2) }}</p>
                    <p class="text-[10px] mt-1 font-medium text-gray-400">Level {{ $lvl }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mb-10">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-lg font-bold text-gray-900 tracking-tight">Recent Commissions</h2>
            <a href="{{ route('earnings') }}" class="text-sm font-semibold transition-colors duration-200 text-[#43a027]">View All</a>
        </div>
        <div class="rounded-2xl overflow-hidden bg-white border border-gray-100 shadow-sm">
            @if($recentCommissions->isEmpty())
                <div class="p-12 text-center">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4 bg-gray-50 border border-gray-100">
                        <svg class="w-7 h-7 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" /></svg>
                    </div>
                    <p class="text-sm font-semibold text-gray-500">No commissions yet</p>
                    <p class="text-xs mt-1.5 text-gray-400">Start referring to earn commissions</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="text-left px-6 py-4 text-[10px] font-bold uppercase tracking-[0.15em] text-gray-500">From User</th>
                                <th class="text-left px-6 py-4 text-[10px] font-bold uppercase tracking-[0.15em] text-gray-500">Level</th>
                                <th class="text-left px-6 py-4 text-[10px] font-bold uppercase tracking-[0.15em] text-gray-500">Amount</th>
                                <th class="text-right px-6 py-4 text-[10px] font-bold uppercase tracking-[0.15em] text-gray-500">Date</th>
                            </tr>
                        </thead>
                        <tbody class="border-t border-gray-100">
                            @foreach($recentCommissions as $commission)
                                @php
                                    $levelColors = [
                                        1 => ['bg' => 'bg-[#f0faf0]', 'text' => 'text-[#388e3c]', 'border' => 'border-[#b0e0a0]'],
                                        2 => ['bg' => 'bg-[#f0faf0]', 'text' => 'text-[#43a027]', 'border' => 'border-[#d7f0d0]'],
                                        3 => ['bg' => 'bg-amber-50', 'text' => 'text-amber-700', 'border' => 'border-amber-200'],
                                        4 => ['bg' => 'bg-violet-50', 'text' => 'text-violet-700', 'border' => 'border-violet-200'],
                                        5 => ['bg' => 'bg-blue-50', 'text' => 'text-blue-700', 'border' => 'border-blue-200'],
                                    ];
                                    $lc = $levelColors[$commission->level] ?? ['bg' => 'bg-gray-50', 'text' => 'text-gray-500', 'border' => 'border-gray-200'];
                                @endphp
                                <tr class="transition-colors duration-200 border-t border-gray-50 hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full flex items-center justify-center text-white text-xs font-bold bg-[#43a027] shrink-0">{{ strtoupper(substr($commission->fromUser->name ?? 'U', 0, 1)) }}</div>
                                            <span class="text-sm font-medium text-gray-900">{{ $commission->fromUser->name ?? 'Unknown' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold {{ $c['bg'] }} {{ $c['text'] }} border {{ $c['border'] }}">L{{ $commission->level }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm font-bold text-gray-900">Rs {{ number_format($commission->amount, 2) }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="text-xs font-medium text-gray-500">{{ $commission->created_at->format('M d, Y') }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <div class="mb-10">
        <h2 class="text-lg font-bold text-gray-900 mb-5 tracking-tight">Quick Actions</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <a href="{{ route('deposit') }}" class="group relative rounded-2xl p-5 transition-all duration-300 hover:-translate-y-0.5 overflow-hidden bg-white border border-gray-100 shadow-sm">
                <div class="relative">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-4 bg-[#f0faf0] border border-[#d7f0d0]">
                        <svg class="w-5 h-5 text-[#43a027]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" /></svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900">Deposit</h3>
                    <p class="text-xs mt-1 text-gray-500">Add funds to your account</p>
                </div>
            </a>

            <a href="{{ route('withdraw') }}" class="group relative rounded-2xl p-5 transition-all duration-300 hover:-translate-y-0.5 overflow-hidden bg-white border border-gray-100 shadow-sm">
                <div class="relative">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-4 bg-violet-50 border border-violet-100">
                        <svg class="w-5 h-5 text-violet-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900">Withdraw</h3>
                    <p class="text-xs mt-1 text-gray-500">Cash out your earnings</p>
                </div>
            </a>

            @if(!$user->is_admin)
            <div class="group relative rounded-2xl p-5 overflow-hidden bg-white border border-gray-100 shadow-sm">
                <div class="relative">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-4 bg-[#f0faf0] border border-[#d7f0d0]">
                        <svg class="w-5 h-5 text-[#43a027]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" /></svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-3">Referral Link</h3>
                    <div class="flex items-center gap-2">
                        <input type="text" readonly value="{{ url('/register?ref=' . $user->referral_code) }}" class="flex-1 min-w-0 px-3 py-2 rounded-xl text-xs truncate focus:outline-none transition-colors bg-gray-50 border border-gray-200 text-gray-500" id="referral-link" />
                        <button onclick="copyReferralLink()" class="shrink-0 p-2 rounded-xl transition-all duration-300 bg-[#f0faf0] border border-[#b0e0a0] text-[#43a027] hover:bg-[#d7f0d0]" id="copy-btn">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9.75a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184" /></svg>
                        </button>
                    </div>
                    <p class="text-[11px] mt-2.5 font-medium text-gray-500">Code: <span class="font-mono font-bold text-gray-700">{{ $user->referral_code }}</span></p>
                </div>
            </div>
            @endif
        </div>
    </div>

    <script>
        function copyReferralLink() {
            var linkInput = document.getElementById('referral-link');
            navigator.clipboard.writeText(linkInput.value).then(function() {
                var btn = document.getElementById('copy-btn');
                btn.innerHTML = '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>';
                setTimeout(function() {
                    btn.innerHTML = '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9.75a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184" /></svg>';
                }, 2000);
            });
        }
    </script>
</x-layouts.dashboard>
