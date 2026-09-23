<x-layouts.public>
    <x-slot:title>About Us</x-slot:title>

    <section class="relative overflow-hidden" style="background: linear-gradient(135deg, #f0faf0 0%, #e8f5e1 30%, #ffffff 100%);">
        <div class="relative max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-24 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#e8f5e1] border border-[#c8e6b8] text-[#43a027] text-sm font-semibold mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                About Me Earning
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-6xl font-extrabold text-gray-900 mb-4" style="letter-spacing: -1px;">
                About <span class="gradient-text">Me Earning</span>
            </h1>
            <p class="text-lg sm:text-xl text-gray-500 max-w-2xl mx-auto mb-2">Pakistan's most trusted referral earning platform.</p>
            <p class="urdu-text text-gray-400 text-sm max-w-2xl mx-auto">پاکستان کی سب سے قابل اعتماد ریفرل earning platform۔</p>
        </div>
    </section>

    <section class="py-16 sm:py-20 lg:py-24">
        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 sm:gap-12 items-center">
                <div>
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#e8f5e1] border border-[#c8e6b8] text-[#43a027] text-sm font-semibold mb-6">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        Our Story
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mb-6" style="letter-spacing: -0.5px;">Humara <span class="gradient-text">Story</span></h2>
                    <div class="space-y-4 text-gray-500 leading-relaxed">
                        <p>Me Earning 2024 mein launch hua ek Pakistani platform hai jo logon ko apni financial community build karne ka mauqa deta hai.</p>
                        <p>Humara maanna hai ke jab log aik doosre ki madad karein, to sab kaamyaab ho sakte hain.</p>
                        <p>Aaj hamare paas hazaron active members hain jo apni daily earning kar rahe hain.</p>
                    </div>
                    <div class="space-y-3 urdu-text text-gray-400 text-sm leading-relaxed mt-4">
                        <p>Me Earning 2024 میں launch ہوا ایک پاکستانی platform ہے جو لوگوں کو اپنی مالی community بنانے کا موقع دیتا ہے۔</p>
                        <p>ہمارا ماننا ہے کہ جب لوگ ایک دوسرے کی مدد کریں، تو سب کامیاب ہو سکتے ہیں۔</p>
                        <p>آج ہمارے پاس ہزاروں active members ہیں جو اپنی روزانہ earning کر رہے ہیں۔</p>
                    </div>
                </div>
                <div class="bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-8 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]" style="border: 1px solid #e8f5e1;">
                    <div class="grid grid-cols-2 gap-3 sm:gap-4">
                        <div class="rounded-xl sm:rounded-2xl p-4 sm:p-5 text-center bg-[#f0faf0] border border-[#b0e0a0]">
                            <p class="text-2xl sm:text-3xl font-extrabold gradient-text">{{ number_format($totalUsers) }}+</p>
                            <p class="text-xs sm:text-sm text-gray-500 mt-1 font-medium">Active Users</p>
                        </div>
                        <div class="rounded-xl sm:rounded-2xl p-4 sm:p-5 text-center bg-amber-50 border border-amber-200">
                            <p class="text-2xl sm:text-3xl font-extrabold text-amber-600">Rs {{ number_format($totalDeposits / 1000) }}K+</p>
                            <p class="text-xs sm:text-sm text-gray-500 mt-1 font-medium">Total Deposits</p>
                        </div>
                        <div class="rounded-xl sm:rounded-2xl p-4 sm:p-5 text-center bg-purple-500/10 border border-purple-500/20">
                            <p class="text-2xl sm:text-3xl font-extrabold text-purple-400">Rs {{ number_format($totalWithdrawals / 1000) }}K+</p>
                            <p class="text-xs sm:text-sm text-gray-500 mt-1 font-medium">Withdrawals Paid</p>
                        </div>
                        <div class="rounded-xl sm:rounded-2xl p-4 sm:p-5 text-center bg-[#f0faf0] border border-[#b0e0a0]">
                            <p class="text-2xl sm:text-3xl font-extrabold gradient-text">100%</p>
                            <p class="text-xs sm:text-sm text-gray-500 mt-1 font-medium">Transparent</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 sm:py-20 lg:py-24" style="background: #f9fafb;">
        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                <div class="bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-8 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]" style="border: 1px solid #e8f5e1;">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-[#e8f5e1] flex items-center justify-center mb-5 sm:mb-6">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 text-[#4caf2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3">Humara <span class="text-[#4caf2f]">Mission</span></h3>
                    <p class="text-gray-500 leading-relaxed text-sm sm:text-base">Har Pakistani ko financial independence ka mauqa dena. Hum chahte hain ke log apne ghar baithe earning kar sakein aur apni families ko behtar zindagi de sakein.</p>
                    <p class="urdu-text text-gray-400 text-sm leading-relaxed mt-3">ہر پاکستانی کو مالی آزادی کا موقع دینا۔ ہم چاہتے ہیں کہ لوگ اپنے گھر بیٹھے earning کر سکیں۔</p>
                </div>
                <div class="bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-8 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]" style="border: 1px solid #e8f5e1;">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-amber-50 flex items-center justify-center mb-5 sm:mb-6">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3">Humari <span class="text-amber-600">Vision</span></h3>
                    <p class="text-gray-500 leading-relaxed text-sm sm:text-base">Pakistan ka sabse bada aur sabse trustworthy earning platform banana. Hum long-term sustainability par focus karte hain, sirf quick schemes nahi.</p>
                    <p class="urdu-text text-gray-400 text-sm leading-relaxed mt-3">پاکستان کا سب سے بڑا اور سب سے قابل اعتماد earning platform بنانا۔ ہم long-term sustainability پر focus کرتے ہیں۔</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 sm:py-20 lg:py-24">
        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-50 border border-amber-200 text-amber-600 text-sm font-semibold mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    Core Values
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900" style="letter-spacing: -0.5px;">Our <span class="gradient-text">Values</span></h2>
                <p class="urdu-text text-gray-400 text-sm mt-2">وہ چیزیں جو ہمیں چلاتی ہیں</p>
            </div>
            @php
            $values = [
                ['title' => 'Trust', 'urdu' => 'اعتماد', 'desc' => 'Humari platform par bharosa karna sab se pehla qadam hai.', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'iconClass' => 'text-[#4caf2f]', 'bgClass' => 'bg-[#e8f5e1]'],
                ['title' => 'Community', 'urdu' => 'کمیونٹی', 'desc' => 'Mil jul kar kaam karna hamari pehchaan hai.', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'iconClass' => 'text-violet-600', 'bgClass' => 'bg-violet-50'],
                ['title' => 'Transparency', 'urdu' => 'شفافیت', 'desc' => 'Har cheez clear aur open hai, koi hidden charges nahi.', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4', 'iconClass' => 'text-amber-500', 'bgClass' => 'bg-amber-50'],
                ['title' => 'Innovation', 'urdu' => 'جدت', 'desc' => 'Hum hamesha behtar tareeqe dhoondhte hain.', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'iconClass' => 'text-[#4caf2f]', 'bgClass' => 'bg-[#e8f5e1]'],
            ];
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                @foreach($values as $v)
                <div class="bg-white rounded-xl sm:rounded-2xl sm:rounded-3xl p-5 sm:p-6 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]" style="border: 1px solid #e8f5e1;">
                    <div class="w-12 h-12 rounded-xl mx-auto mb-4 flex items-center justify-center {{ $v['bgClass'] }}">
                        <svg class="w-6 h-6 {{ $v['iconClass'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $v['icon'] }}"/></svg>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-1">{{ $v['title'] }}</h4>
                    <p class="urdu-text text-xs mb-2 text-gray-400">{{ $v['urdu'] }}</p>
                    <p class="text-sm text-gray-500">{{ $v['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-16 sm:py-20 lg:py-24" style="background: #f9fafb;">
        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-violet-500/10 border border-violet-500/20 text-violet-500 text-sm font-semibold mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Our Team
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900" style="letter-spacing: -0.5px;">Meet Our <span class="gradient-text">Team</span></h2>
                <p class="urdu-text text-gray-400 text-sm mt-2">وہ لوگ جو Me Earning کو چلا رہے ہیں</p>
            </div>
            @php
            $team = [
                ['role' => 'Founder & CEO', 'desc' => 'Visionary Leader', 'iconClass' => 'text-[#4caf2f]', 'bgClass' => 'bg-[#e8f5e1]', 'borderClass' => 'border-[#c8e6b8]'],
                ['role' => 'Tech Lead', 'desc' => 'Platform Developer', 'iconClass' => 'text-violet-600', 'bgClass' => 'bg-violet-50', 'borderClass' => 'border-violet-100'],
                ['role' => 'Operations Manager', 'desc' => 'Daily Operations', 'iconClass' => 'text-amber-500', 'bgClass' => 'bg-amber-50', 'borderClass' => 'border-amber-100'],
            ];
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach($team as $t)
                <div class="bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-8 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]" style="border: 1px solid #e8f5e1;">
                    <div class="w-20 h-20 rounded-full mx-auto mb-4 flex items-center justify-center {{ $t['bgClass'] }} border {{ $t['borderClass'] }}">
                        <svg class="w-10 h-10 {{ $t['iconClass'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <h3 class="font-bold text-gray-900">{{ $t['role'] }}</h3>
                    <p class="text-sm text-gray-500 mt-1">{{ $t['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-16 sm:py-20 lg:py-24">
        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 text-center">
            <div class="bg-white rounded-2xl sm:rounded-3xl p-8 sm:p-10" style="border: 1px solid #e8f5e1; box-shadow: 0 4px 20px rgba(76,175,47,0.06);">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mb-4" style="letter-spacing: -0.5px;">Humse <span class="gradient-text">Judein</span></h2>
                <p class="text-gray-500 mb-2 max-w-xl mx-auto text-sm sm:text-base">Koi bhi sawaal ho toh raabta karein. Hum aap ki madad ke liye hamesha tayar hain.</p>
                <p class="urdu-text text-gray-400 text-sm mb-8 max-w-xl mx-auto">کوئی بھی سوال ہو تو رابطہ کریں۔ ہم آپ کی مدد کے لیے ہمیشہ تیار ہیں۔</p>
                <a href="{{ route('contact') }}" class="btn-primary text-base sm:text-lg inline-flex items-center">
                    <span>Contact Us</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
            </div>
        </div>
    </section>
</x-layouts.public>
