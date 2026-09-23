<x-layouts.dashboard>
    <x-slot:title>Special Rewards</x-slot:title>

    <div class="mb-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Special Rewards</h1>
        <p class="mt-1 text-sm text-gray-400">Issue manual reward receipts to encourage top referrers. <span class="font-urdu text-xs">خصوصی انعامات</span></p>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-[#f0faf0] border border-[#d7f0d0] rounded-2xl p-4 flex items-center gap-3">
            <svg class="w-5 h-5 shrink-0 text-[#43a027]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="text-sm font-medium text-[#43a027]">{{ session('success') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">

        {{-- Issue Form --}}
        <div class="lg:col-span-2">
            <form action="{{ route('admin.rewards.store') }}" method="POST" class="bg-white border border-gray-100 rounded-2xl p-6 space-y-5 sticky top-24">
                @csrf
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center bg-[#f0faf0]">
                        <svg class="w-5 h-5 text-[#43a027]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-gray-900">Issue Reward</h2>
                        <p class="text-xs text-gray-400">Balance is credited instantly</p>
                    </div>
                </div>

                <div>
                    <label for="user_id" class="block text-sm font-semibold mb-2 text-gray-600">Select User</label>
                    <select name="user_id" id="user_id" required
                        class="w-full rounded-xl px-4 py-3 text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-[#4caf2f]/20 focus:border-[#4caf2f] transition-colors bg-gray-50 border border-gray-200">
                        <option value="">— Choose a member —</option>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? 'selected' : '' }}>{{ $u->name }} ({{ $u->email }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="amount" class="block text-sm font-semibold mb-2 text-gray-600">Amount (Rs)</label>
                    <input type="number" name="amount" id="amount" min="1" max="1000000" step="1" required value="{{ old('amount') }}"
                        placeholder="e.g. 500"
                        class="w-full rounded-xl px-4 py-3 text-gray-900 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4caf2f]/20 focus:border-[#4caf2f] transition-colors bg-gray-50 border border-gray-200" />
                </div>

                <div>
                    <label for="reason" class="block text-sm font-semibold mb-2 text-gray-600">Reason / Award Title</label>
                    <input type="text" name="reason" id="reason" required maxlength="255" value="{{ old('reason') }}"
                        placeholder="e.g. Top Referrer of the Month"
                        class="w-full rounded-xl px-4 py-3 text-gray-900 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4caf2f]/20 focus:border-[#4caf2f] transition-colors bg-gray-50 border border-gray-200" />
                    <p class="text-xs mt-1.5 text-gray-500">Shown on the receipt.</p>
                </div>

                @error('amount')<p class="text-sm text-red-500">{{ $message }}</p>@enderror
                @error('reason')<p class="text-sm text-red-500">{{ $message }}</p>@enderror
                @error('user_id')<p class="text-sm text-red-500">{{ $message }}</p>@enderror

                <button type="submit" class="w-full bg-[#4caf2f] hover:bg-[#43a027] text-white font-bold py-3.5 rounded-xl transition-all">
                    Issue Reward Receipt
                </button>
            </form>
        </div>

        {{-- Rewards List --}}
        <div class="lg:col-span-3">
            <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
                <div class="px-6 py-5 flex items-center justify-between border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">Issued Rewards</h2>
                    <span class="text-sm text-gray-400">Total: {{ $rewards->total() }}</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="text-left px-6 py-3 font-medium text-gray-500">#</th>
                                <th class="text-left px-6 py-3 font-medium text-gray-500">User</th>
                                <th class="text-left px-6 py-3 font-medium text-gray-500">Amount</th>
                                <th class="text-left px-6 py-3 font-medium text-gray-500">Reason</th>
                                <th class="text-left px-6 py-3 font-medium text-gray-500">Date</th>
                                <th class="text-left px-6 py-3 font-medium text-gray-500">Receipt</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rewards ?? [] as $reward)
                                <tr class="border-t border-gray-50 hover:bg-[#f0faf0]/50 transition-colors">
                                    <td class="px-6 py-4 text-gray-400">{{ $reward->id }}</td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">{{ $reward->user->name ?? 'N/A' }}</div>
                                        <div class="text-xs text-gray-400">{{ $reward->user->email ?? '' }}</div>
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-[#43a027]">Rs. {{ number_format($reward->amount) }}</td>
                                    <td class="px-6 py-4 text-gray-500 max-w-[180px] truncate" title="{{ $reward->reason }}">{{ $reward->reason }}</td>
                                    <td class="px-6 py-4 text-gray-400">{{ $reward->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('admin.rewards.receipt', $reward) }}" target="_blank"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold bg-[#f0faf0] border border-[#b0e0a0] text-[#43a027] hover:bg-[#d7f0d0] transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg>
                                        No rewards issued yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(isset($rewards) && $rewards->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $rewards->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.dashboard>
