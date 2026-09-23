<x-layouts.dashboard>
    <x-slot:title>Manage Withdrawals</x-slot:title>

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Manage Withdrawals</h1>
        <p class="mt-1 text-gray-400">Review and process all user withdrawal requests. <span class="font-urdu text-xs">واپسی کا انتظام</span></p>
    </div>

    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900">All Withdrawals</h2>
                <span class="text-sm text-gray-400">Total: {{ $withdrawals->total() ?? 0 }}</span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="text-left px-6 py-3 font-medium text-gray-500">#</th>
                        <th class="text-left px-6 py-3 font-medium text-gray-500">User</th>
                        <th class="text-left px-6 py-3 font-medium text-gray-500">Amount</th>
                        <th class="text-left px-6 py-3 font-medium text-gray-500">Method</th>
                        <th class="text-left px-6 py-3 font-medium text-gray-500">Account Number</th>
                        <th class="text-left px-6 py-3 font-medium text-gray-500">Status</th>
                        <th class="text-left px-6 py-3 font-medium text-gray-500">Date</th>
                        <th class="text-left px-6 py-3 font-medium text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($withdrawals ?? [] as $withdrawal)
                        <tr class="border-t border-gray-50 hover:bg-[#f0faf0]/50 transition-colors">
                            <td class="px-6 py-4 text-gray-400">{{ $withdrawal->id }}</td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $withdrawal->user->name ?? 'N/A' }}</div>
                                <div class="text-xs text-gray-400">{{ $withdrawal->user->email ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">Rs. {{ number_format($withdrawal->amount) }}</td>
                            <td class="px-6 py-4 text-gray-400">{{ $withdrawal->method }}</td>
                            <td class="px-6 py-4 font-mono text-xs text-gray-400">{{ $withdrawal->account_number }}</td>
                            <td class="px-6 py-4">
                                @if($withdrawal->status === 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-600">Pending</span>
                                @elseif($withdrawal->status === 'approved')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#f0faf0] text-[#43a027]">Approved</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-500">Rejected</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-400">{{ $withdrawal->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                @if($withdrawal->status === 'pending')
                                    <div class="flex items-center gap-2">
                                        <form action="{{ route('admin.withdrawals.approve', $withdrawal) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-[#4caf2f] hover:bg-[#43a027] text-white text-xs font-medium rounded-xl transition-colors">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.withdrawals.reject', $withdrawal) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-medium rounded-xl transition-colors">Reject</button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-xs text-gray-500">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-gray-400">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                No withdrawals found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(isset($withdrawals) && $withdrawals->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $withdrawals->links() }}
            </div>
        @endif
    </div>
</x-layouts.dashboard>
