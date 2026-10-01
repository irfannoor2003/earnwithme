<x-layouts.dashboard>
    <x-slot:title>Deposit & Activate Account</x-slot:title>

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

        <!-- Instructions -->
        <div class="rounded-2xl p-6 relative overflow-hidden bg-[#f0faf0] border border-[#d7f0d0]">
            <h3 class="text-lg font-bold text-gray-900 mb-5 flex items-center gap-3">
                <span class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0 bg-[#d7f0d0]">
                    <svg class="w-5 h-5 text-[#43a027]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </span>
                Kaise Deposit Karein <span class="font-urdu text-sm">ڈپوزٹ کا طریقہ</span>
            </h3>
            <ol class="space-y-4 text-sm text-gray-600">
                <li class="flex gap-4">
                    <span class="flex-shrink-0 w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold mt-0.5 bg-[#f0faf0] text-[#43a027]">1</span>
                    <span>Apni plan ki amount <strong class="text-gray-900">JazzCash</strong> ya <strong class="text-gray-900">EasyPaisa</strong> se neeche diye gaye numbers par bhejein.</span>
                </li>
                <li class="flex gap-4">
                    <span class="flex-shrink-0 w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold mt-0.5 bg-[#f0faf0] text-[#43a027]">2</span>
                    <span>Payment karne ke baad neeche form mein apna Transaction ID aur account details bharein.</span>
                </li>
                <li class="flex gap-4">
                    <span class="flex-shrink-0 w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold mt-0.5 bg-[#f0faf0] text-[#43a027]">3</span>
                    <span>Hamari team aapki payment verify karegi aur <strong class="text-gray-900">24 ghanton</strong> mein aapka account activate kar degi.</span>
                </li>
            </ol>
        </div>

        <!-- Payment Numbers -->
        <div class="rounded-2xl p-6 bg-white border border-gray-100">
            <h3 class="text-lg font-bold text-gray-900 mb-5 flex items-center gap-3">
                <span class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0 bg-violet-50">
                    <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                </span>
                Payment Yahan Bhejein <span class="font-urdu text-sm">ادائیگی</span>
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="rounded-xl p-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0] bg-gray-50 border border-gray-200">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-amber-50">
                            <span class="font-bold text-sm text-amber-500">JC</span>
                        </div>
                        <div>
                            <p class="text-gray-900 font-semibold text-sm">JazzCash</p>
                            <p class="text-xs text-gray-500">Instant transfer</p>
                        </div>
                    </div>
                    <p class="text-2xl font-mono font-bold text-gray-900 tracking-wider">03XX-XXXXXXX</p>
                </div>
                <div class="rounded-xl p-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0] bg-gray-50 border border-gray-200">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-[#f0faf0]">
                            <span class="font-bold text-sm text-[#43a027]">EP</span>
                        </div>
                        <div>
                            <p class="text-gray-900 font-semibold text-sm">EasyPaisa</p>
                            <p class="text-xs text-gray-500">Instant transfer</p>
                        </div>
                    </div>
                    <p class="text-2xl font-mono font-bold text-gray-900 tracking-wider">03XX-XXXXXXX</p>
                </div>
            </div>
        </div>

        <!-- Deposit Form -->
        <div class="rounded-2xl p-6 bg-white border border-gray-100 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                    </svg>
                </span>
                Deposit Form <span class="font-urdu text-sm">ڈپوزٹ فارم</span>
            </h3>
            @php($selectedPlan = $plans->firstWhere('id', old('plan_id')) ?? $plans->first())
            <form method="POST" action="{{ route('deposit.store') }}" class="space-y-6" x-data="{ submitting: false, amount: {{ json_encode((float) ($selectedPlan?->price ?? 0)) }} }" @submit="submitting = true">
                @csrf

                <!-- Plan Selection -->
                <div>
                    <label class="block text-sm font-semibold mb-3 text-gray-600">Plan Chunain</label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        @foreach($plans as $plan)
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="plan_id" value="{{ $plan->id }}" data-price="{{ $plan->price }}" class="peer sr-only" {{ old('plan_id') == $plan->id || (! old('plan_id') && $loop->first) ? 'checked' : '' }} @change="amount = Number($event.target.dataset.price)" required>
                                <div class="rounded-xl p-4 text-center transition-all duration-300 peer-checked:shadow-lg bg-gray-50 border-2 border-gray-200 peer-checked:border-[#4caf2f] peer-checked:bg-[#f0faf0]">
                                    <p class="text-gray-900 font-bold text-lg">Rs {{ number_format($plan->price) }}</p>
                                    <p class="text-sm mt-1 text-gray-400">{{ $plan->name }}</p>
                                    <p class="text-xs mt-2 font-medium text-[#43a027]">7-Level Commission</p>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    @error('plan_id')
                        <p class="text-xs mt-2 text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Amount -->
                <div>
                    <label for="amount" class="block text-sm font-semibold mb-2 text-gray-600">Amount (Rs)</label>
                    <input type="number" name="amount" id="amount" value="{{ $selectedPlan?->price ?? '' }}" step="0.01" class="w-full rounded-xl px-4 py-3 text-gray-900 text-sm placeholder-gray-500 focus:outline-none transition-colors bg-gray-50 border border-gray-200" required readonly x-model="amount">
                    <p class="text-xs mt-1.5 text-gray-500">The amount is set by your selected plan.</p>
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
                    <label for="account_number" class="block text-sm font-semibold mb-2 text-gray-600">Account Number (jis se payment ki)</label>
                    <input type="text" name="account_number" id="account_number" value="{{ old('account_number') }}" placeholder="03XXXXXXXXX" class="w-full rounded-xl px-4 py-3 text-gray-900 text-sm placeholder-gray-500 focus:outline-none transition-colors bg-gray-50 border border-gray-200" required>
                    @error('account_number')
                        <p class="text-xs mt-2 text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Transaction ID -->
                <div>
                    <label for="transaction_id" class="block text-sm font-semibold mb-2 text-gray-600">Transaction ID (TrxID)</label>
                    <input type="text" name="transaction_id" id="transaction_id" value="{{ old('transaction_id') }}" placeholder="Apna transaction ID daalein" class="w-full rounded-xl px-4 py-3 text-gray-900 text-sm placeholder-gray-500 focus:outline-none transition-colors bg-gray-50 border border-gray-200" required>
                    @error('transaction_id')
                        <p class="text-xs mt-2 text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <button type="submit" :disabled="submitting" class="w-full bg-[#4caf2f] hover:bg-[#43a027] text-white font-bold py-3.5 rounded-xl transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                    <span x-show="!submitting">Deposit Request Bhejein</span>
                    <span x-show="submitting" class="flex items-center justify-center gap-2">
                        <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                        Submitting...
                    </span>
                </button>
            </form>
        </div>

        <!-- Deposit History -->
        <div class="rounded-2xl p-6 bg-white border border-gray-100">
            <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-3">
                <span class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0 bg-violet-50">
                    <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </span>
                Deposit History <span class="font-urdu text-sm">ڈپوزٹ کی تاریخ</span>
            </h3>

            @if($deposits->isEmpty())
                <div class="text-center py-12">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <p class="text-gray-500 text-sm">Abhi tak koi deposit nahi</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="text-left py-3 px-4 font-medium text-gray-500">Plan</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-500">Amount</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-500">Method</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-500">Status</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-500">Date</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-500">Receipt</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deposits as $deposit)
                                <tr class="border-b border-gray-50">
                                    <td class="py-3.5 px-4 text-gray-900 font-medium">{{ $deposit->plan->name ?? 'N/A' }}</td>
                                    <td class="py-3.5 px-4 text-gray-900">Rs {{ number_format($deposit->amount) }}</td>
                                    <td class="py-3.5 px-4 text-gray-600">{{ ucfirst($deposit->method) }}</td>
                                    <td class="py-3.5 px-4">
                                        @if($deposit->status === 'approved')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-[#f0faf0] text-[#43a027]">Approved</span>
                                        @elseif($deposit->status === 'pending')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-600">Pending</span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-50 text-red-500">Rejected</span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-4 text-gray-500">{{ $deposit->created_at->format('d M Y') }}</td>
                                    <td class="py-3.5 px-4">
                                        @if($deposit->status === 'approved')
                                            <a href="{{ route('deposits.receipt', $deposit) }}" target="_blank"
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
