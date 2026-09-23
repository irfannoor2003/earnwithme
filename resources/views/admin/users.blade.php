<x-layouts.dashboard>
    <x-slot:title>Manage Users</x-slot:title>

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Manage Users</h1>
        <p class="mt-1 text-gray-400">View and manage all registered users. <span class="font-urdu text-xs">صارفین کا انتظام</span></p>
    </div>

    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900">All Users</h2>
                <span class="text-sm text-gray-400">Total: {{ $users->total() ?? 0 }}</span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="text-left px-6 py-3 font-medium text-gray-500">#</th>
                        <th class="text-left px-6 py-3 font-medium text-gray-500">Name</th>
                        <th class="text-left px-6 py-3 font-medium text-gray-500">Email</th>
                        <th class="text-left px-6 py-3 font-medium text-gray-500">Phone</th>
                        <th class="text-left px-6 py-3 font-medium text-gray-500">Referral Code</th>
                        <th class="text-left px-6 py-3 font-medium text-gray-500">Plan</th>
                        <th class="text-left px-6 py-3 font-medium text-gray-500">Status</th>
                        <th class="text-left px-6 py-3 font-medium text-gray-500">Balance</th>
                        <th class="text-left px-6 py-3 font-medium text-gray-500">Joined</th>
                        <th class="text-left px-6 py-3 font-medium text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users ?? [] as $user)
                        <tr class="border-t border-gray-50 hover:bg-[#f0faf0]/50 transition-colors">
                            <td class="px-6 py-4 text-gray-400">{{ $user->id }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full flex items-center justify-center font-semibold text-sm bg-violet-50 text-violet-600">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-400">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-gray-400">{{ $user->phone ?? 'N/A' }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-xl text-xs font-mono font-medium bg-violet-50 text-violet-600">{{ $user->referral_code }}</span>
                            </td>
                            <td class="px-6 py-4 text-gray-400">{{ $user->plan->name ?? 'No Plan' }}</td>
                            <td class="px-6 py-4">
                                @if($user->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#f0faf0] text-[#43a027]">Active</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-500">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">Rs. {{ number_format($user->balance ?? 0) }}</td>
                            <td class="px-6 py-4 text-gray-400">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                @if(!$user->is_admin)
                                    <a href="{{ route('admin.users.referrals', $user) }}"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold bg-[#f0faf0] border border-[#b0e0a0] text-[#43a027] hover:bg-[#d7f0d0] transition-all">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        Referrals
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-6 py-12 text-center text-gray-400">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(isset($users) && $users->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</x-layouts.dashboard>
