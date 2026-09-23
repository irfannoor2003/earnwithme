<x-layouts.dashboard>
    <x-slot:title>Manage Deposits</x-slot:title>

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Manage Deposits</h1>
        <p class="mt-1 text-gray-400">Review and manage all user deposit requests. <span class="font-urdu text-xs">ڈپوزٹ کا انتظام</span></p>
    </div>

    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900">All Deposits</h2>
                <span class="text-sm text-gray-400">Total: {{ $deposits->total() ?? 0 }}</span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="text-left px-6 py-3 font-medium text-gray-500">#</th>
                        <th class="text-left px-6 py-3 font-medium text-gray-500">User</th>
                        <th class="text-left px-6 py-3 font-medium text-gray-500">Plan</th>
                        <th class="text-left px-6 py-3 font-medium text-gray-500">Amount</th>
                        <th class="text-left px-6 py-3 font-medium text-gray-500">Method</th>
                        <th class="text-left px-6 py-3 font-medium text-gray-500">Transaction ID</th>
                        <th class="text-left px-6 py-3 font-medium text-gray-500">Status</th>
                        <th class="text-left px-6 py-3 font-medium text-gray-500">Date</th>
                        <th class="text-left px-6 py-3 font-medium text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($deposits ?? [] as $deposit)
                        <tr class="border-t border-gray-50 hover:bg-[#f0faf0]/50 transition-colors">
                            <td class="px-6 py-4 text-gray-400">{{ $deposit->id }}</td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $deposit->user->name ?? 'N/A' }}</div>
                                <div class="text-xs text-gray-400">{{ $deposit->user->email ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4 text-gray-400">{{ $deposit->plan->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 font-semibold text-gray-900">Rs. {{ number_format($deposit->amount) }}</td>
                            <td class="px-6 py-4 text-gray-400">{{ $deposit->method }}</td>
                            <td class="px-6 py-4 font-mono text-xs text-gray-400">{{ $deposit->transaction_id }}</td>
                            <td class="px-6 py-4">
                                @if($deposit->status === 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-600">Pending</span>
                                @elseif($deposit->status === 'approved')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#f0faf0] text-[#43a027]">Approved</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-500">Rejected</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-400">{{ $deposit->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                @if($deposit->status === 'pending')
                                    <div class="flex items-center gap-2">
                                        <form action="{{ route('admin.deposits.approve', $deposit) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-[#4caf2f] hover:bg-[#43a027] text-white text-xs font-medium rounded-xl transition-colors">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.deposits.reject', $deposit) }}" method="POST">
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
                            <td colspan="9" class="px-6 py-12 text-center text-gray-400">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                No deposits found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(isset($deposits) && $deposits->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $deposits->links() }}
            </div>
        @endif
    </div>
</x-layouts.dashboard>
