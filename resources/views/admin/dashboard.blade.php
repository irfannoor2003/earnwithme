<x-layouts.dashboard>
    <x-slot:title>Admin Dashboard</x-slot:title>

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
        <p class="mt-1 text-gray-400">Platform overview. <span class="font-urdu text-xs">پلیٹ فارم کا جائزہ</span></p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white border border-gray-100 rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400">Total Users</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($totalUsers ?? 0) }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-[#f0faf0]">
                    <svg class="w-6 h-6 text-[#43a027]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400">Active Users</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($activeUsers ?? 0) }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-violet-50">
                    <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400">Total Deposits</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">Rs. {{ number_format($totalDeposits ?? 0) }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-[#f0faf0]">
                    <svg class="w-6 h-6 text-[#43a027]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400">Pending Deposits</p>
                    <p class="text-2xl font-bold mt-1 text-amber-500">Rs. {{ number_format($pendingDeposits ?? 0) }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-amber-50">
                    <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400">Total Withdrawals</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">Rs. {{ number_format($totalWithdrawals ?? 0) }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-violet-50">
                    <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400">Pending Withdrawals</p>
                    <p class="text-2xl font-bold mt-1 text-amber-500">Rs. {{ number_format($pendingWithdrawals ?? 0) }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-amber-50">
                    <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0] sm:col-span-2">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400">Total Commissions Paid</p>
                    <p class="text-2xl font-bold mt-1 text-[#43a027]">Rs. {{ number_format($totalCommissions ?? 0) }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-[#f0faf0]">
                    <svg class="w-6 h-6 text-[#43a027]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
            <div class="px-6 py-5 flex items-center justify-between border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900">Recent Deposits</h2>
                <a href="{{ route('admin.deposits') }}" class="text-sm font-medium transition-colors text-[#43a027]">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="text-left px-6 py-3 font-medium text-gray-500">User</th>
                            <th class="text-left px-6 py-3 font-medium text-gray-500">Amount</th>
                            <th class="text-left px-6 py-3 font-medium text-gray-500">Method</th>
                            <th class="text-left px-6 py-3 font-medium text-gray-500">Status</th>
                            <th class="text-left px-6 py-3 font-medium text-gray-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentDeposits ?? [] as $deposit)
                            <tr class="border-t border-gray-50 hover:bg-[#f0faf0]/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">{{ $deposit->user->name ?? 'N/A' }}</div>
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900">Rs. {{ number_format($deposit->amount) }}</td>
                                <td class="px-6 py-4 text-gray-400">{{ $deposit->method }}</td>
                                <td class="px-6 py-4">
                                    @if($deposit->status === 'pending')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-600">Pending</span>
                                    @elseif($deposit->status === 'approved')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#f0faf0] text-[#43a027]">Approved</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-500">Rejected</span>
                                    @endif
                                </td>
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
                                <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                    No recent deposits found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
            <div class="px-6 py-5 flex items-center justify-between border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900">Recent Withdrawals</h2>
                <a href="{{ route('admin.withdrawals') }}" class="text-sm font-medium transition-colors text-[#43a027]">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="text-left px-6 py-3 font-medium text-gray-500">User</th>
                            <th class="text-left px-6 py-3 font-medium text-gray-500">Amount</th>
                            <th class="text-left px-6 py-3 font-medium text-gray-500">Method</th>
                            <th class="text-left px-6 py-3 font-medium text-gray-500">Status</th>
                            <th class="text-left px-6 py-3 font-medium text-gray-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentWithdrawals ?? [] as $withdrawal)
                            <tr class="border-t border-gray-50 hover:bg-[#f0faf0]/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">{{ $withdrawal->user->name ?? 'N/A' }}</div>
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900">Rs. {{ number_format($withdrawal->amount) }}</td>
                                <td class="px-6 py-4 text-gray-400">{{ $withdrawal->method }}</td>
                                <td class="px-6 py-4">
                                    @if($withdrawal->status === 'pending')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-600">Pending</span>
                                    @elseif($withdrawal->status === 'approved')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#f0faf0] text-[#43a027]">Approved</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-500">Rejected</span>
                                    @endif
                                </td>
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
                                <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                    No recent withdrawals found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
