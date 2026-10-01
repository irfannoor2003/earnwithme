<x-layouts.dashboard>
    <x-slot:title>Withdraw Earnings</x-slot:title>

    <div class="space-y-8">

        @if(session('success'))
            <div class="rounded-2xl px-5 py-4 text-sm font-medium bg-[#f0faf0] border border-[#d7f0d0] text-[#43a027]">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="rounded-2xl px-5 py-4 text-sm font-medium space-y-1 bg-red-50 border border-red-100 text-red-500">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Balance Card -->
        <div class="rounded-2xl p-8 text-white relative overflow-hidden" style="background: linear-gradient(135deg, #388e3c, #4caf2f); box-shadow: 0 8px 32px -8px rgba(0,166,81,0.3);">
            <div class="absolute top-0 right-0 w-40 h-40 rounded-full -translate-y-1/2 translate-x-1/2" style="background: rgba(255,255,255,0.1);"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 rounded-full translate-y-1/2 -translate-x-1/2" style="background: rgba(255,255,255,0.05);"></div>
            <div class="relative">
                <p class="text-sm font-medium mb-1" style="color: rgba(255,255,255,0.8);">Available Balance</p>
                <p class="text-4xl font-bold tracking-tight">Rs {{ number_format($user->balance, 2) }}</p>
                <p class="text-xs mt-2" style="color: rgba(255,255,255,0.6);">Min: Rs {{ number_format($min, 0) }} | Max: Rs {{ number_format($max, 0) }} | Fee: {{ rtrim(rtrim(number_format((float) config('withdrawals.fee_percent'), 2, '.', ''), '0'), '.') }}%</p>
            </div>
        </div>

        <!-- Withdraw Form -->
        <div class="rounded-2xl p-6 bg-white border border-gray-100 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]">
            <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-3">
                <span class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0 bg-[#f0faf0]">
                    <svg class="w-5 h-5 text-[#43a027]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </span>
                Withdrawal Request <span class="font-urdu text-sm">واپسی کی درخواست</span>
            </h3>
            <form method="POST" action="{{ route('withdraw.store') }}" class="space-y-6" x-data="{ submitting: false }" @submit="submitting = true">
                @csrf

                <!-- Amount -->
                @php
                    $feePct = (float) config('withdrawals.fee_percent');
                    $seedAmount = (float) old('amount', $defaultAmount);
                    // Mirrors WithdrawController::feeFor() exactly: 2dp half-up rounding.
                    $seedFee = round($seedAmount * ($feePct / 100), 2);
                    $seedTotal = round($seedAmount + $seedFee, 2);
                @endphp
                <div x-data="{
                        amount: {{ $seedAmount }},
                        feePercent: {{ $feePct }},
                        get fee() { return Math.round(Number(this.amount) * this.feePercent) / 100; },
                        get total() { return Math.round((Number(this.amount) + this.fee) * 100) / 100; },
                    }">
                    <label for="amount" class="block text-sm font-semibold mb-2 text-gray-600">Amount (Rs)</label>
                    <input type="number" name="amount" id="amount" value="{{ $seedAmount }}" min="{{ $min }}" max="{{ $max }}" step="0.01" placeholder="Min Rs {{ number_format($min, 0) }} / Max Rs {{ number_format($max, 0) }}" class="w-full rounded-xl px-4 py-3 text-gray-900 text-sm placeholder-gray-500 focus:outline-none transition-colors bg-gray-50 border border-gray-200" required x-model="amount">
                    <div class="mt-3 p-3 rounded-xl bg-gray-50 border border-gray-200">
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-500">Withdrawal Amount:</span>
                            <span class="font-semibold text-gray-900" x-text="'Rs ' + Number(amount).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})">Rs {{ number_format($defaultAmount, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-500">Fee ({{ rtrim(rtrim(number_format($feePct, 2, '.', ''), '0'), '.') }}%):</span>
                            <span class="font-semibold text-amber-600" x-text="'Rs ' + fee.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})">Rs {{ number_format($seedFee, 2) }}</span>
                        </div>
                        <div class="border-t border-gray-200 mt-2 pt-2 flex justify-between text-sm">
                            <span class="text-gray-600 font-medium">Total Deducted:</span>
                            <span class="font-bold text-gray-900" x-text="'Rs ' + total.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})">Rs {{ number_format($seedTotal, 2) }}</span>
                        </div>
                    </div>
                    <p class="text-xs mt-1.5 text-gray-500">Min: Rs {{ number_format($min, 0) }} / Max: Rs {{ number_format($max, 0) }} | fee applies</p>
                    @error('amount')
                        <p class="text-xs mt-2 text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Payment Method -->
                <div>
                    <label for="payment_method" class="block text-sm font-semibold mb-2 text-gray-600">Payment Method</label>
                    <select name="payment_method" id="payment_method" class="w-full rounded-xl px-4 py-3 text-gray-900 text-sm focus:outline-none transition-colors bg-gray-50 border border-gray-200" required>
                        <option value="">Select payment method</option>
                        <option value="jazzcash" {{ old('payment_method') == 'jazzcash' ? 'selected' : '' }}>JazzCash</option>
                        <option value="easypaisa" {{ old('payment_method') == 'easypaisa' ? 'selected' : '' }}>EasyPaisa</option>
                    </select>
                    @error('payment_method')
                        <p class="text-xs mt-2 text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Account Number -->
                <div>
                    <label for="account_number" class="block text-sm font-semibold mb-2 text-gray-600">Account Number</label>
                    <input type="text" name="account_number" id="account_number" value="{{ old('account_number') }}" placeholder="03XXXXXXXXX" class="w-full rounded-xl px-4 py-3 text-gray-900 text-sm placeholder-gray-500 focus:outline-none transition-colors bg-gray-50 border border-gray-200" required>
                    @error('account_number')
                        <p class="text-xs mt-2 text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Account Name -->
                <div>
                    <label for="account_name" class="block text-sm font-semibold mb-2 text-gray-600">Account Holder Name</label>
                    <input type="text" name="account_name" id="account_name" value="{{ old('account_name') }}" placeholder="Apne JazzCash/EasyPaisa account ka naam" class="w-full rounded-xl px-4 py-3 text-gray-900 text-sm placeholder-gray-500 focus:outline-none transition-colors bg-gray-50 border border-gray-200" required>
                    @error('account_name')
                        <p class="text-xs mt-2 text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Note -->
                <div class="rounded-xl p-4 bg-gray-50 border border-gray-200">
                    <div class="flex gap-3">
                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Important</p>
                            <p class="text-xs mt-1 text-gray-500">Minimum withdrawal Rs {{ number_format($min, 0) }} hai. {{ rtrim(rtrim(number_format((float) config('withdrawals.fee_percent'), 2, '.', ''), '0'), '.') }}% fee apply hoti hai. Withdrawals 24-48 ghanton mein process hoti hain. Apne account details sahi rakhein.</p>
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <button type="submit" :disabled="submitting" class="w-full bg-[#4caf2f] hover:bg-[#43a027] text-white font-bold py-3.5 rounded-xl transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                    <span x-show="!submitting">Withdrawal Request Bhejein</span>
                    <span x-show="submitting" class="flex items-center justify-center gap-2">
                        <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                        Submitting...
                    </span>
                </button>
            </form>
        </div>

        <!-- Withdrawal History -->
        <div class="rounded-2xl p-6 bg-white border border-gray-100 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]">
            <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-3">
                <span class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0 bg-violet-50">
                    <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </span>
                Withdrawal History <span class="font-urdu text-sm">واپسی کی تاریخ</span>
            </h3>

            @if($withdrawals->isEmpty())
                <div class="text-center py-12">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <p class="text-gray-500 text-sm">Abhi tak koi withdrawal nahi</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="text-left py-3 px-4 font-medium text-gray-500">Amount</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-500">Fee</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-500">Method</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-500">Account</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-500">Status</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-500">Date</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-500">Receipt</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($withdrawals as $withdrawal)
                                <tr class="border-b border-gray-50">
                                    <td class="py-3.5 px-4 text-gray-900 font-medium">Rs {{ number_format($withdrawal->amount, 2) }}</td>
                                    <td class="py-3.5 px-4 text-amber-600 font-medium">Rs {{ number_format($withdrawal->fee ?? 0, 2) }}</td>
                                    <td class="py-3.5 px-4 text-gray-600">{{ ucfirst($withdrawal->method) }}</td>
                                    <td class="py-3.5 px-4 font-mono text-xs text-gray-600">{{ $withdrawal->account_number }}</td>
                                    <td class="py-3.5 px-4">
                                        @if(in_array($withdrawal->status, ['completed', 'approved']))
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-[#f0faf0] text-[#43a027]">Completed</span>
                                        @elseif($withdrawal->status === 'pending')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-600">Pending</span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-50 text-red-500">Rejected</span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-4 text-gray-500">{{ $withdrawal->created_at->format('d M Y') }}</td>
                                    <td class="py-3.5 px-4">
                                        @if(in_array($withdrawal->status, ['completed', 'approved']))
                                            <a href="{{ route('withdrawals.receipt', $withdrawal) }}" target="_blank"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold bg-[#f0faf0] border border-[#b0e0a0] text-[#43a027] hover:bg-[#d7f0d0] transition-all">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                                                Receipt
                                            </a>
                                        @else
                                            <span class="text-xs text-gray-300">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>
</x-layouts.dashboard>
