<x-layouts.dashboard>
    <x-slot:title>My Referral Team</x-slot:title>

    <div class="space-y-8">

        @if(session('success'))
            <div class="rounded-2xl px-5 py-4 text-sm font-medium bg-[#f0faf0] border border-[#d7f0d0] text-[#43a027]">
                {{ session('success') }}
            </div>
        @endif

        <!-- Referral Link -->
        @if(!$user->is_active)
        <div class="rounded-2xl p-8 bg-amber-50 border border-amber-200 text-center">
            <svg class="w-16 h-16 mx-auto mb-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Referral Team Locked</h3>
            <p class="text-sm text-gray-600 mb-4">Aapka referral team unlock karne ke liye pehle apna plan activate karein.</p>
            <p class="urdu-text text-xs text-gray-500 mb-4">Apna plan activate karne ke baad aapki team dikhayi degi.</p>
            <a href="{{ route('deposit') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-[#4caf2f] hover:bg-[#43a027] text-white font-bold rounded-xl transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Activate Plan
            </a>
        </div>
        @else
        <div class="rounded-2xl p-6 relative overflow-hidden" style="background: linear-gradient(135deg, rgba(200,169,81,0.08), rgba(200,169,81,0.03)); border: 1px solid rgba(200,169,81,0.12);">
            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-3">
                <span class="w-8 h-8 rounded-lg flex items-center justify-center" style="background: rgba(200,169,81,0.15);">
                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                </span>
                Aapka Referral Link <span class="font-urdu text-sm">آپ کا ریفرل لنک</span>
            </h3>
            <div class="flex items-center gap-3">
                <div class="flex-1 rounded-xl px-4 py-3 flex items-center overflow-hidden bg-gray-50 border border-gray-200">
                    <span id="referralLink" class="text-sm font-mono truncate text-gray-600">{{ url('/register?ref=' . $user->referral_code) }}</span>
                </div>
                <button onclick="copyReferralLink()" class="flex-shrink-0 bg-[#4caf2f] hover:bg-[#43a027] text-white font-bold px-5 py-3 rounded-xl transition-all duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    Copy
                </button>
            </div>
            <p id="copySuccess" class="text-xs mt-2 hidden text-[#43a027]">Link clipboard mein copy ho gaya!</p>

            <div class="flex items-center gap-3 mt-4">
                <span class="text-sm text-gray-500">Share:</span>
                <a href="https://wa.me/?text={{ urlencode('Join Me Earning and start earning! Use my referral link: ' . url('/register?ref=' . $user->referral_code)) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition-colors" style="background: rgba(37,211,102,0.1); color: #25D366; border: 1px solid rgba(37,211,102,0.1);">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    WhatsApp
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url('/register?ref=' . $user->referral_code)) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition-colors" style="background: rgba(24,119,242,0.1); color: #1877F2; border: 1px solid rgba(24,119,242,0.1);">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    Facebook
                </a>
            </div>
        </div>
        @endif

        <!-- Stats Cards -->
        @if($user->is_active)
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-7 gap-3">
            <div class="bg-white border border-gray-100 rounded-2xl p-4 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]">
                <p class="text-2xl font-bold text-gray-900">{{ $totalReferrals }}</p>
                <p class="text-xs mt-1 text-gray-500">Total</p>
            </div>
            <div class="bg-white border border-gray-100 rounded-2xl p-4 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]">
                <p class="text-2xl font-bold text-[#43a027]">{{ $activeReferrals }}</p>
                <p class="text-xs mt-1 text-gray-500">Active</p>
            </div>
            <div class="bg-white border border-gray-100 rounded-2xl p-4 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]">
                <p class="text-2xl font-bold text-[#43a027]">{{ $level1->count() }}</p>
                <p class="text-xs mt-1 text-gray-500">Level 1</p>
            </div>
            <div class="bg-white border border-gray-100 rounded-2xl p-4 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]">
                <p class="text-2xl font-bold text-[#2e7d32]">{{ $level2->count() }}</p>
                <p class="text-xs mt-1 text-gray-500">Level 2</p>
            </div>
            <div class="bg-white border border-gray-100 rounded-2xl p-4 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]">
                <p class="text-2xl font-bold text-amber-500">{{ $level3->count() }}</p>
                <p class="text-xs mt-1 text-gray-500">Level 3</p>
            </div>
            <div class="bg-white border border-gray-100 rounded-2xl p-4 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]">
                <p class="text-2xl font-bold text-violet-500">{{ $level4->count() }}</p>
                <p class="text-xs mt-1 text-gray-500">Level 4</p>
            </div>
            <div class="bg-white border border-gray-100 rounded-2xl p-4 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]">
                <p class="text-2xl font-bold text-blue-500">{{ $level5->count() }}</p>
                <p class="text-xs mt-1 text-gray-500">Level 5</p>
            </div>
        </div>
        @endif

        <!-- Team Tree -->
        @if($user->is_active)
        <div class="space-y-4">
            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-3">
                <span class="w-8 h-8 rounded-lg flex items-center justify-center" style="background: rgba(139,92,246,0.15);">
                    <svg class="w-4 h-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </span>
                7-Level Team Tree <span class="font-urdu text-sm">ٹیم کی سطحیں</span>
            </h3>

            @php
                $levelConfigs = [
                    1 => ['name' => 'Level 1 - Direct Referrals', 'color' => '#4caf2f', 'bg' => 'rgba(76,175,47,0.15)', 'rate' => 'Rs 110'],
                    2 => ['name' => 'Level 2', 'color' => '#388e3c', 'bg' => 'rgba(56,142,60,0.15)', 'rate' => 'Rs 50'],
                    3 => ['name' => 'Level 3', 'color' => '#C8A951', 'bg' => 'rgba(200,169,81,0.15)', 'rate' => 'Rs 30'],
                    4 => ['name' => 'Level 4', 'color' => '#8B5CF6', 'bg' => 'rgba(139,92,246,0.15)', 'rate' => 'Rs 20'],
                    5 => ['name' => 'Level 5', 'color' => '#3B82F6', 'bg' => 'rgba(59,130,246,0.15)', 'rate' => 'Rs 10'],
                    6 => ['name' => 'Level 6', 'color' => '#EC4899', 'bg' => 'rgba(236,72,153,0.15)', 'rate' => 'Rs 10'],
                    7 => ['name' => 'Level 7', 'color' => '#06B6D4', 'bg' => 'rgba(6,182,212,0.15)', 'rate' => 'Rs 10'],
                ];
                $levelData = [
                    1 => $level1, 2 => $level2, 3 => $level3, 4 => $level4, 5 => $level5,
                ];
            @endphp

            @foreach([1, 2, 3, 4, 5, 6, 7] as $lvl)
                @php $cfg = $levelConfigs[$lvl]; @endphp
                <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
                    <button onclick="toggleSection('level{{ $lvl }}')" class="w-full flex items-center justify-between p-5 transition-colors hover:bg-gray-50">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background: {{ $cfg['bg'] }};">
                                <span class="font-bold text-sm" style="color: {{ $cfg['color'] }};">L{{ $lvl }}</span>
                            </div>
                            <div class="text-left">
                                <p class="text-gray-900 font-semibold text-sm">{{ $cfg['name'] }} <span class="text-xs font-bold" style="color: {{ $cfg['color'] }};">({{ $cfg['rate'] }})</span></p>
                                <p class="text-xs text-gray-500">{{ isset($levelData[$lvl]) ? $levelData[$lvl]->count() . ' members' : '0 members' }}</p>
                            </div>
                        </div>
                        <svg id="level{{ $lvl }}-icon" class="w-5 h-5 transition-transform duration-200 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="level{{ $lvl }}-content" class="{{ $lvl > 1 ? 'hidden' : '' }} border-t border-gray-100">
                        @if(!isset($levelData[$lvl]) || $levelData[$lvl]->isEmpty())
                            <p class="text-sm text-center py-8 text-gray-500">No referrals at this level yet</p>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm">
                                    <thead>
                                        <tr class="border-b border-gray-100">
                                            <th class="text-left py-3 px-5 font-medium text-gray-500">Name</th>
                                            @if($lvl <= 2)
                                            <th class="text-left py-3 px-5 font-medium text-gray-500">Plan</th>
                                            @endif
                                            <th class="text-left py-3 px-5 font-medium text-gray-500">Status</th>
                                            <th class="text-left py-3 px-5 font-medium text-gray-500">Joined</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($levelData[$lvl] as $ref)
                                            <tr class="border-b border-gray-50 hover:bg-gray-50">
                                                <td class="py-3 px-5 text-gray-900 font-medium">{{ $ref->name }}</td>
                                                @if($lvl <= 2)
                                                <td class="py-3 px-5 text-gray-600">{{ $ref->plan->name ?? 'None' }}</td>
                                                @endif
                                                <td class="py-3 px-5">
                                                    @if($ref->is_active)
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-[#f0faf0] text-[#43a027]">Active</span>
                                                    @else
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-400">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="py-3 px-5 text-gray-500">{{ $ref->created_at->format('d M Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        @endif

    </div>

    <script>
        function copyReferralLink() {
            var link = document.getElementById('referralLink').textContent;
            navigator.clipboard.writeText(link).then(function() {
                var msg = document.getElementById('copySuccess');
                msg.classList.remove('hidden');
                setTimeout(function() {
                    msg.classList.add('hidden');
                }, 2000);
            });
        }

        function toggleSection(id) {
            var content = document.getElementById(id + '-content');
            var icon = document.getElementById(id + '-icon');
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.style.transform = 'rotate(0deg)';
            } else {
                content.classList.add('hidden');
                icon.style.transform = 'rotate(-90deg)';
            }
        }
    </script>
</x-layouts.dashboard>
