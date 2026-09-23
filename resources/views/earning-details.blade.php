<x-layouts.public>
    <x-slot:title>Earning Details</x-slot:title>

    <section class="relative overflow-hidden" style="background: linear-gradient(135deg, #f0faf0 0%, #e8f5e1 30%, #ffffff 100%);">
        <div class="relative max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-24 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#e8f5e1] border border-[#c8e6b8] text-[#43a027] text-sm font-semibold mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Earning Details
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-6xl font-extrabold text-gray-900 mb-4" style="letter-spacing: -1px;">Earning <span class="gradient-text">Details</span></h1>
            <p class="text-lg sm:text-xl text-gray-500 max-w-2xl mx-auto mb-2">Learn how Me Earning's multi-level referral system helps you build a sustainable income stream.</p>
            <p class="urdu-text text-gray-400 text-sm max-w-2xl mx-auto">جانیں کیسے Me Earning کا ملٹی لیول ریفرل سسٹم آپ کو پائیدار آمدن بنانے میں مدد کرتا ہے۔</p>
        </div>
    </section>

    <section class="py-16 sm:py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-2xl sm:text-3xl lg:text-5xl font-extrabold text-gray-900">How It <span class="gradient-text">Works</span></h2>
                <p class="text-gray-500 mt-3 max-w-2xl mx-auto text-base sm:text-lg">Follow these simple steps to start earning with Me Earning</p>
                <p class="urdu-text text-gray-400 text-sm mt-2 max-w-2xl mx-auto">ان آسان مراحل کی پیروی کریں اور Me Earning کے ساتھ کمانا شروع کریں</p>
            </div>

            @php
            $steps = [
                ['num' => '01', 'title' => 'Register & Choose Plan', 'desc' => 'Sign up on Me Earning and activate the Rs 350 Premium plan to start earning.', 'color' => '#4caf2f'],
                ['num' => '02', 'title' => 'Share Your Referral Link', 'desc' => 'Share your unique referral link with friends, family, and your network. Every registration counts.', 'color' => '#7c4dff'],
                ['num' => '03', 'title' => 'Earn & Withdraw', 'desc' => 'Earn commissions up to 7 levels deep. Withdraw your earnings anytime via JazzCash or EasyPaisa.', 'color' => '#ff9800'],
            ];
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
                @foreach($steps as $step)
                <div class="bg-white rounded-2xl p-6 sm:p-8 text-center transition-all duration-300 hover:-translate-y-2 hover:shadow-xl group" style="border: 1px solid #e8f5e1;">
                    <div class="w-16 h-16 rounded-2xl mx-auto mb-5 flex items-center justify-center transition-all duration-300 group-hover:scale-110" style="background: {{ $step['color'] }}15;">
                        <span class="text-2xl font-extrabold" style="color: {{ $step['color'] }};">{{ $step['num'] }}</span>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2">{{ $step['title'] }}</h3>
                    <p class="text-gray-500 leading-relaxed text-sm">{{ $step['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-16 sm:py-20 lg:py-28" style="background: linear-gradient(180deg, #f0faf0 0%, #ffffff 100%);">
        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#e8f5e1] border border-[#c8e6b8] text-[#43a027] text-sm font-semibold mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Commission Structure
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-5xl font-extrabold text-gray-900">7-Level <span class="gradient-text">Commission Structure</span></h2>
                <p class="text-gray-500 mt-3 max-w-2xl mx-auto text-base sm:text-lg">Aap ki team jitni badi hogi, utna zyada kamaayenge.</p>
                <p class="urdu-text text-gray-400 text-sm mt-2 max-w-2xl mx-auto">آپ کی ٹیم جتنی بڑی ہوگی، اتنا زیادہ کمائیں گے۔</p>
            </div>

            @php
            $levels = [
                ['level' => 'L1', 'title' => 'Level 1 - Direct Referral', 'desc' => 'Aap ne jisay khud invite kiya hai, uski activation pe Rs 110 commission milega.', 'amount' => 'Rs 110', 'color' => '#4caf2f'],
                ['level' => 'L2', 'title' => 'Level 2', 'desc' => 'Aap ke direct referral ne jisay invite kiya, uski activation pe Rs 50 commission milega.', 'amount' => 'Rs 50', 'color' => '#7c4dff'],
                ['level' => 'L3', 'title' => 'Level 3', 'desc' => 'Teesray level pe aap ki team ke member ki activation pe Rs 30 commission milega.', 'amount' => 'Rs 30', 'color' => '#ff9800'],
                ['level' => 'L4', 'title' => 'Level 4', 'desc' => 'Chothay level pe team member ki activation pe Rs 20 commission milega.', 'amount' => 'Rs 20', 'color' => '#4caf2f'],
                ['level' => 'L5', 'title' => 'Level 5', 'desc' => 'Panjway level pe team member ki activation pe Rs 10 commission milega.', 'amount' => 'Rs 10', 'color' => '#7c4dff'],
                ['level' => 'L6', 'title' => 'Level 6', 'desc' => 'Chhatay level pe team member ki activation pe Rs 10 commission milega.', 'amount' => 'Rs 10', 'color' => '#ff9800'],
                ['level' => 'L7', 'title' => 'Level 7', 'desc' => 'Saatway level pe team member ki activation pe Rs 10 commission milega. Yeh aap ki team ki gehraai hai!', 'amount' => 'Rs 10', 'color' => '#4caf2f'],
            ];
            @endphp
            <div class="space-y-3 sm:space-y-4">
                @foreach($levels as $lvl)
                <div class="bg-white rounded-2xl p-4 sm:p-6 flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:gap-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]" style="border: 1px solid #e8f5e1;">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center flex-shrink-0" style="background: {{ $lvl['color'] }}15;">
                        <span class="text-xl font-extrabold" style="color: {{ $lvl['color'] }};">{{ $lvl['level'] }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-base sm:text-lg font-bold text-gray-900">{{ $lvl['title'] }}</h3>
                        <p class="text-gray-500 mt-1 text-sm">{{ $lvl['desc'] }}</p>
                    </div>
                    <div class="sm:text-right flex-shrink-0">
                        <span class="inline-flex items-center px-5 py-2.5 rounded-xl font-bold text-lg" style="background: {{ $lvl['color'] }}15; color: {{ $lvl['color'] }};">{{ $lvl['amount'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-16 sm:py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-2xl sm:text-3xl lg:text-5xl font-extrabold text-gray-900">Example <span class="gradient-text">Calculation</span></h2>
                <p class="urdu-text text-gray-400 text-sm mt-2">دیکھیں کیسے کام کرتا ہے - یہ ایک example ہے</p>
            </div>

            <div class="bg-white rounded-3xl p-6 sm:p-8 md:p-10" style="border: 2px solid #c8e6b8; box-shadow: 0 10px 40px rgba(76,175,47,0.08);">
                <div class="rounded-2xl p-5 sm:p-6 mb-6" style="background: #f8fdf7; border: 1px solid #e8f5e1;">
                        <h3 class="font-bold text-gray-900 mb-4">Agar aap ne 5 logon ko invite kiya (Rs 350 plan):</h3>
                        <div class="space-y-3">
                            @php
                            $calc = [
                                ['label' => '5 Direct Referrals x Rs 110', 'amount' => 'Rs 550', 'color' => '#4caf2f'],
                                ['label' => '25 Level 2 referrals x Rs 50', 'amount' => 'Rs 1,250', 'color' => '#7c4dff'],
                                ['label' => '125 Level 3 referrals x Rs 30', 'amount' => 'Rs 3,750', 'color' => '#ff9800'],
                                ['label' => '625 Level 4 referrals x Rs 20', 'amount' => 'Rs 12,500', 'color' => '#4caf2f'],
                                ['label' => '3,125 Level 5 referrals x Rs 10', 'amount' => 'Rs 31,250', 'color' => '#7c4dff'],
                                ['label' => '15,625 Level 6 referrals x Rs 10', 'amount' => 'Rs 156,250', 'color' => '#ff9800'],
                                ['label' => '78,125 Level 7 referrals x Rs 10', 'amount' => 'Rs 781,250', 'color' => '#4caf2f'],
                            ];
                            @endphp
                            @foreach($calc as $c)
                            <div class="flex justify-between items-center py-2 border-b border-gray-100 gap-3">
                                <span class="text-gray-500 text-xs sm:text-sm">{{ $c['label'] }}</span>
                                <span class="font-bold text-xs sm:text-sm whitespace-nowrap" style="color: {{ $c['color'] }};">{{ $c['amount'] }}</span>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-6 pt-4 border-t-2 border-[#c8e6b8] flex justify-between items-center gap-3">
                            <span class="text-base sm:text-xl font-bold text-gray-900">Total Potential Earnings</span>
                            <span class="text-xl sm:text-2xl font-extrabold gradient-text whitespace-nowrap">Rs 986,550</span>
                        </div>
                    </div>
                    <p class="text-sm text-gray-400 text-center">*Yeh sirf ek example hai. Actual earnings aap ki team ki activity pe depend karti hain.</p>
            </div>
        </div>
    </section>

    <section class="py-16 sm:py-20 lg:py-28" style="background: linear-gradient(180deg, #f0faf0 0%, #ffffff 100%);">
        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#e8f5e1] border border-[#c8e6b8] text-[#43a027] text-sm font-semibold mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    Success Tips
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-5xl font-extrabold text-gray-900">Tips for <span class="gradient-text">Success</span></h2>
                <p class="urdu-text text-gray-400 text-sm mt-2">کامیابی کے لیے ضروری مشورے</p>
            </div>

            @php
            $tips = [
                ['title' => 'Apne Network ko Barhao', 'desc' => 'Zyada se zyada logon ko apne referral link se join karao. Har naya member aap ke liye earning ka zariya hai.'],
                ['title' => 'Social Media Ka Istemal Karo', 'desc' => 'Facebook, WhatsApp, Instagram pe apna referral link share karo. Short video aur graphics ka use karo.'],
                ['title' => 'Team Ko Guide Karo', 'desc' => 'Apni team ko bhi batayein ke kaise refer karna hai. Jab wo refer karenge to aap ko bhi benefit milega.'],
                ['title' => 'Sabr aur Consistency', 'desc' => 'Earning mein waqt lagta hai. Roz koshish karte raho, consistent raho. Bade results zaroor milenge InshAllah.'],
                ['title' => 'Dil Se Kaam Karo', 'desc' => 'Logon ko honestly batayein ke Me Earning kya hai. Trust banao, relationships grow karo. Long-term earning hogi.'],
                ['title' => 'Level 7 Tak Pahuncho', 'desc' => 'Apni team ko samjhao ke wo bhi refer karein. Jab aap ki team 7 levels tak phaili hogi, to passive income hogi.'],
            ];
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                @foreach($tips as $tip)
                <div class="bg-white rounded-2xl p-5 sm:p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]" style="border: 1px solid #e8f5e1;">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 mt-1 bg-[#e8f5e1]">
                            <svg class="w-5 h-5 text-[#4caf2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="min-w-0">
                            <h3 class="font-bold text-gray-900 mb-1">{{ $tip['title'] }}</h3>
                            <p class="text-gray-500 text-sm leading-relaxed">{{ $tip['desc'] }}</p>
                        </div>
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
                    Abhi Shuru <span class="gradient-text">Karo!</span>
                </h2>
                <p class="text-gray-500 text-base sm:text-lg max-w-xl mx-auto mb-3">Der na karo. Aaj hi register karo aur apni earning shuru karo.</p>
                <p class="urdu-text text-[#43a027]/50 text-sm max-w-xl mx-auto mb-8">دیر نہ کریں۔ آج ہی رجسٹر کریں اور اپنی earning شروع کریں۔</p>
                <a href="{{ route('register') }}" class="btn-primary text-lg inline-flex items-center">
                    <span>Register Now</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
            </div>
        </div>
    </section>
</x-layouts.public>
