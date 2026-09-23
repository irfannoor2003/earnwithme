<x-layouts.public>
    <x-slot:title>Our Plans</x-slot:title>

    <section class="relative overflow-hidden" style="background: linear-gradient(135deg, #f0faf0 0%, #e8f5e1 30%, #ffffff 100%);">
        <div class="relative max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-24 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#e8f5e1] border border-[#c8e6b8] text-[#43a027] text-sm font-semibold mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Investment Plan
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-6xl font-extrabold text-gray-900 mb-4" style="letter-spacing: -1px;">Our Investment <span class="gradient-text">Plan</span></h1>
            <p class="text-lg sm:text-xl text-gray-500 max-w-2xl mx-auto mb-2">Choose the plan that suits your goals. Start earning today with Me Earning's proven referral system.</p>
            <p class="urdu-text text-gray-400 text-sm max-w-2xl mx-auto">اپنے اہداف کے مطابق پلان منتخب کریں۔ آج ہی Me Earning کے ساتھ کمانا شروع کریں۔</p>
        </div>
    </section>

    <section class="py-16 sm:py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
            @foreach($plans as $plan)
            <div>
                <div class="relative group">
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 px-6 py-2 rounded-full text-sm font-bold text-white z-10 uppercase tracking-wider" style="background: linear-gradient(135deg, #43a027, #4caf2f); box-shadow: 0 4px 15px rgba(76,175,47,0.4);">
                        Most Popular
                    </div>
                    <div class="bg-white rounded-3xl p-6 sm:p-8 md:p-12 transition-all duration-300 group-hover:shadow-2xl group-hover:-translate-y-1" style="border: 2px solid #e8f5e1; box-shadow: 0 10px 40px rgba(76,175,47,0.08);">
                        <div class="text-center mb-10">
                            <div class="w-20 h-20 mx-auto mb-5 rounded-2xl bg-[#e8f5e1] flex items-center justify-center">
                                <svg class="w-10 h-10 text-[#4caf2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $plan->name }}</h3>
                            <span class="text-5xl sm:text-6xl font-extrabold gradient-text">Rs {{ number_format($plan->price) }}</span>
                            <p class="text-gray-400 mt-2">One-time investment</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-10">
                            @if($plan->features)
                                @foreach($plan->features as $feature)
                                <div class="flex items-center gap-3 p-3 rounded-xl" style="background: #f8fdf7;">
                                    <div class="w-8 h-8 rounded-lg bg-[#e8f5e1] flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-[#4caf2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700">{{ $feature }}</span>
                                </div>
                                @endforeach
                            @endif
                            <div class="flex items-center gap-3 p-3 rounded-xl" style="background: #f8fdf7;">
                                <div class="w-8 h-8 rounded-lg bg-[#e8f5e1] flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-[#4caf2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <span class="text-sm font-medium text-gray-700">7-Level Referral Commission</span>
                            </div>
                            <div class="flex items-center gap-3 p-3 rounded-xl" style="background: #f8fdf7;">
                                <div class="w-8 h-8 rounded-lg bg-[#e8f5e1] flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-[#4caf2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <span class="text-sm font-medium text-gray-700">Rs 20 Welcome Bonus</span>
                            </div>
                        </div>

                        <div class="mb-8">
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4 text-center">Commission Per Referral</h4>
                            <div class="flex flex-wrap justify-center gap-2">
                                <span class="px-3 py-1.5 rounded-lg text-xs font-bold text-white" style="background: #4caf2f;">L1: Rs 110</span>
                                <span class="px-3 py-1.5 rounded-lg text-xs font-bold text-white" style="background: #7c4dff;">L2: Rs 50</span>
                                <span class="px-3 py-1.5 rounded-lg text-xs font-bold text-white" style="background: #ff9800;">L3: Rs 30</span>
                                <span class="px-3 py-1.5 rounded-lg text-xs font-bold text-white" style="background: #4caf2f;">L4: Rs 20</span>
                                <span class="px-3 py-1.5 rounded-lg text-xs font-bold text-white" style="background: #7c4dff;">L5: Rs 10</span>
                                <span class="px-3 py-1.5 rounded-lg text-xs font-bold text-white" style="background: #ff9800;">L6: Rs 10</span>
                                <span class="px-3 py-1.5 rounded-lg text-xs font-bold text-white" style="background: #4caf2f;">L7: Rs 10</span>
                            </div>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 w-full sm:max-w-sm py-4 px-8 rounded-xl font-bold transition-all btn-primary text-lg">
                                Start Earning Now
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </a>
                            <p class="text-xs text-gray-400 mt-4">JazzCash / EasyPaisa</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <section class="py-16 sm:py-20 lg:py-28" style="background: linear-gradient(180deg, #f0faf0 0%, #ffffff 100%);">
        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#e8f5e1] border border-[#c8e6b8] text-[#43a027] text-sm font-semibold mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Commission Structure
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-5xl font-extrabold text-gray-900 mb-4">
                    7-Level <span class="gradient-text">Commission</span>
                </h2>
                <p class="text-gray-500 text-base sm:text-lg max-w-2xl mx-auto">Earn from your referrals up to 7 levels deep</p>
                <p class="urdu-text text-gray-400 text-sm max-w-2xl mx-auto mt-2">7 لیولز تک اپنے ریفرلز سے کمائیں</p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-3 sm:gap-4">
                @php
                $levels = [
                    ['level' => 1, 'amount' => 'Rs 110', 'label' => 'Direct Referral', 'urdu' => 'لیول 1', 'color' => '#4caf2f'],
                    ['level' => 2, 'amount' => 'Rs 50', 'label' => '2nd Generation', 'urdu' => 'لیول 2', 'color' => '#7c4dff'],
                    ['level' => 3, 'amount' => 'Rs 30', 'label' => '3rd Generation', 'urdu' => 'لیول 3', 'color' => '#ff9800'],
                    ['level' => 4, 'amount' => 'Rs 20', 'label' => '4th Generation', 'urdu' => 'لیول 4', 'color' => '#4caf2f'],
                    ['level' => 5, 'amount' => 'Rs 10', 'label' => '5th Generation', 'urdu' => 'لیول 5', 'color' => '#7c4dff'],
                    ['level' => 6, 'amount' => 'Rs 10', 'label' => '6th Generation', 'urdu' => 'لیول 6', 'color' => '#ff9800'],
                    ['level' => 7, 'amount' => 'Rs 10', 'label' => '7th Generation', 'urdu' => 'لیول 7', 'color' => '#4caf2f'],
                ];
                @endphp
                @foreach($levels as $lvl)
                <div class="bg-white rounded-xl p-4 sm:p-5 text-center transition-all duration-300 hover:-translate-y-2 hover:shadow-xl group" style="border: 1px solid #e8f5e1;">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 mx-auto mb-2 sm:mb-3 rounded-xl flex items-center justify-center transition-all duration-300 group-hover:scale-110" style="background: {{ $lvl['color'] }}15;">
                        <span class="text-sm sm:text-base font-extrabold" style="color: {{ $lvl['color'] }};">{{ $lvl['level'] }}</span>
                    </div>
                    <div class="text-lg sm:text-xl font-extrabold text-gray-900 mb-1">{{ $lvl['amount'] }}</div>
                    <div class="text-[10px] sm:text-[11px] text-gray-400 font-medium">Level {{ $lvl['level'] }}</div>
                    <div class="text-[10px] text-gray-300 mt-1 urdu-text">{{ $lvl['urdu'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="faq" class="py-16 sm:py-20 lg:py-28" x-data="{ openFaq: null }">
        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#e8f5e1] border border-[#c8e6b8] text-[#43a027] text-sm font-semibold mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    FAQ
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-5xl font-extrabold text-gray-900 mb-4">
                    Frequently Asked <span class="gradient-text">Questions</span>
                </h2>
                <p class="urdu-text text-[#43a027]/60 text-sm">کوئی سوال ہے؟ ہمارے پاس جوابات ہیں۔</p>
            </div>
            @php
            $faqs = [
                ['q' => 'How do I earn commissions?', 'a' => 'When someone joins Me Earning using your referral link, you earn a fixed commission: Rs 110 from direct referrals, Rs 50 from level 2, Rs 30 from level 3, Rs 20 from level 4, and Rs 10 each from levels 5-7. Plus, your direct referral gets a Rs 20 bonus!'],
                ['q' => 'How do I withdraw my earnings?', 'a' => 'You can withdraw your earnings through JazzCash or EasyPaisa. Simply go to your dashboard, click on Withdraw, enter the amount and your account details. Min Rs 170, Max Rs 70,000. 1% fee applies.'],
                ['q' => 'Is there a minimum withdrawal amount?', 'a' => 'Yes, the minimum withdrawal amount is Rs 170 and maximum is Rs 70,000. A 1% fee applies on all withdrawals.'],
                ['q' => 'What payment methods do you accept?', 'a' => 'We accept JazzCash and EasyPaisa. All transactions are secure and your financial data is encrypted.'],
                ['q' => 'Can I upgrade my plan later?', 'a' => 'We currently offer a single Premium plan at Rs 350. All features and commissions are included from day one.'],
            ];
            @endphp
            <div class="space-y-3">
                @foreach($faqs as $i => $faq)
                <div class="bg-white rounded-xl overflow-hidden transition-all duration-300 hover:shadow-md" style="border: 1px solid #e8f5e1;">
                    <button @click="openFaq === {{ $i }} ? openFaq = null : openFaq = {{ $i }}" class="w-full flex items-center justify-between p-4 sm:p-5 text-left">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-8 h-8 rounded-lg bg-[#e8f5e1] flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-[#4caf2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <span class="text-sm font-semibold text-gray-900">{{ $faq['q'] }}</span>
                        </div>
                        <svg class="w-5 h-5 text-[#4caf2f] flex-shrink-0 ml-4 transition-transform duration-200" :class="openFaq === {{ $i }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openFaq === {{ $i }}" x-cloak x-transition class="px-4 sm:px-5 pb-4 sm:pb-5">
                        <p class="text-gray-500 text-sm leading-relaxed pl-11">{{ $faq['a'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-10 sm:py-12 lg:py-16">
        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
            <div class="rounded-2xl p-6 sm:p-8 md:p-12 text-center bg-white" style="border: 2px solid #c8e6b8; box-shadow: 0 20px 60px rgba(76,175,47,0.1);">
                <h2 class="text-2xl sm:text-3xl lg:text-5xl font-extrabold text-gray-900 mb-4">
                    Ready to Start <span class="gradient-text">Earning?</span>
                </h2>
                <p class="text-gray-500 text-base sm:text-lg max-w-xl mx-auto mb-3">Join thousands of Pakistanis earning passive income.</p>
                <p class="urdu-text text-[#43a027]/50 text-sm max-w-xl mx-auto mb-8">دیر نہ کریں۔ آج ہی رجسٹر کریں اور اپنی earning شروع کریں۔</p>
                <a href="{{ route('register') }}" class="btn-primary text-lg inline-flex items-center">
                    <span>Create Free Account</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
            </div>
        </div>
    </section>
</x-layouts.public>
