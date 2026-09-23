<x-layouts.dashboard>
    <x-slot:title>User Referrals - {{ $user->name }}</x-slot:title>

    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <a href="{{ route('admin.users') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-[#43a027] hover:text-[#388e3c] transition-colors mb-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Back to Users
            </a>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Referral Network — {{ $user->name }}</h1>
            <p class="mt-1 text-sm text-gray-400">Complete 7-level downline. <span class="font-urdu text-xs">مکمل ٹیم ڈھانچہ</span></p>
        </div>
    </div>

    {{-- Summary --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white border border-gray-100 rounded-2xl p-5">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Member</p>
            <p class="text-lg font-bold text-gray-900 mt-1 truncate">{{ $user->name }}</p>
            <p class="text-xs text-gray-400 mt-0.5">{{ $user->email }}</p>
        </div>
        <div class="bg-white border border-gray-100 rounded-2xl p-5">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Account</p>
            @if($user->is_active)
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#f0faf0] text-[#43a027] mt-2">Active</span>
            @else
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-500 mt-2">Inactive</span>
            @endif
            <p class="text-xs text-gray-400 mt-1.5">Code: <span class="font-mono">{{ $user->referral_code }}</span></p>
        </div>
        <div class="bg-white border border-gray-100 rounded-2xl p-5">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Total Referrals (L1-L7)</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($totalReferrals) }}</p>
        </div>
        <div class="bg-white border border-gray-100 rounded-2xl p-5">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Active Referrals</p>
            <p class="text-2xl font-bold text-[#43a027] mt-1">{{ number_format($totalActive) }}</p>
        </div>
    </div>

    {{-- Level bars overview --}}
    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden mb-8">
        <div class="px-6 py-5 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-900">Level Overview</h2>
        </div>
        <div class="p-6 grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-3">
            @foreach([1,2,3,4,5,6,7] as $lvl)
                @php $colors = [1 => '#4caf2f', 2 => '#8B5CF6', 3 => '#ff9800', 4 => '#4caf2f', 5 => '#8B5CF6', 6 => '#ff9800', 7 => '#4caf2f']; @endphp
                <div class="rounded-xl p-4 text-center border" style="background: {{ $colors[$lvl] }}08; border-color: {{ $colors[$lvl] }}30;">
                    <p class="text-xs font-bold" style="color: {{ $colors[$lvl] }};">Level {{ $lvl }}</p>
                    <p class="text-2xl font-extrabold text-gray-900 mt-1">{{ $levels[$lvl]['count'] }}</p>
                    <p class="text-[10px] text-gray-400 mt-1">{{ $levels[$lvl]['active'] }} active</p>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Detailed lists --}}
    <div class="space-y-6">
        @foreach([1,2,3,4,5,6,7] as $lvl)
            @php
                $colors = [1 => '#4caf2f', 2 => '#8B5CF6', 3 => '#ff9800', 4 => '#4caf2f', 5 => '#8B5CF6', 6 => '#ff9800', 7 => '#4caf2f'];
                $members = $levels[$lvl]['members'];
            @endphp
            <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
                <div class="px-6 py-4 flex items-center justify-between border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg flex items-center justify-center" style="background: {{ $colors[$lvl] }}15;">
                            <span class="text-sm font-extrabold" style="color: {{ $colors[$lvl] }};">L{{ $lvl }}</span>
                        </div>
                        <h3 class="font-semibold text-gray-900">Level {{ $lvl }}</h3>
                    </div>
                    <span class="text-sm font-semibold text-gray-500">{{ $levels[$lvl]['count'] }} referral(ies)</span>
                </div>

                @if($members->isEmpty())
                    <div class="px-6 py-8 text-center text-sm text-gray-400">No referrals at this level.</div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="text-left px-6 py-3 font-medium text-gray-500">#</th>
                                    <th class="text-left px-6 py-3 font-medium text-gray-500">Name</th>
                                    <th class="text-left px-6 py-3 font-medium text-gray-500">Email</th>
                                    <th class="text-left px-6 py-3 font-medium text-gray-500">Plan</th>
                                    <th class="text-left px-6 py-3 font-medium text-gray-500">Status</th>
                                    <th class="text-left px-6 py-3 font-medium text-gray-500">Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($members as $i => $ref)
                                    <tr class="border-t border-gray-50 hover:bg-[#f0faf0]/50 transition-colors">
                                        <td class="px-6 py-3.5 text-gray-400">{{ $i + 1 }}</td>
                                        <td class="px-6 py-3.5 font-medium text-gray-900">{{ $ref->name }}</td>
                                        <td class="px-6 py-3.5 text-gray-400">{{ $ref->email }}</td>
                                        <td class="px-6 py-3.5 text-gray-400">{{ $ref->plan->name ?? 'None' }}</td>
                                        <td class="px-6 py-3.5">
                                            @if($ref->is_active)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#f0faf0] text-[#43a027]">Active</span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-500">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-3.5 text-gray-400">{{ $ref->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</x-layouts.dashboard>
