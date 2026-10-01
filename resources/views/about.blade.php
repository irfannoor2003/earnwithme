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
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#e8f5e1] border border-[#c8e6b8] text-[#43a027] text-sm font-semibold mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    Skills & Business
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900" style="letter-spacing: -0.5px;">Learn Skills. <span class="gradient-text">Explore Opportunities.</span></h2>
                <p class="urdu-text text-gray-400 text-sm mt-2" dir="rtl">ہنر سیکھیں، کاروبار کے نئے مواقع تلاش کریں</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                <div class="bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-8 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg" style="border: 1px solid #e8f5e1;">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-[#e8f5e1] flex items-center justify-center mb-5 sm:mb-6">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 text-[#4caf2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3">Practical Skills Development</h3>
                    <p class="text-gray-500 leading-relaxed text-sm sm:text-base">Learn practical digital, communication, and entrepreneurship skills to help you grow with confidence.</p>
                    <p class="urdu-text text-gray-400 text-sm leading-relaxed mt-3" dir="rtl">ڈیجیٹل، ابلاغی اور کاروباری مہارتیں سیکھیں تاکہ آپ اعتماد کے ساتھ آگے بڑھ سکیں۔</p>
                </div>
                <div class="bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-8 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg" style="border: 1px solid #f3e8d0;">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-amber-50 flex items-center justify-center mb-5 sm:mb-6">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M5 7V5a2 2 0 012-2h10a2 2 0 012 2v2M5 7v12a2 2 0 002 2h10a2 2 0 002-2V7m-9 5h4m-4 4h4"/></svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3">Business Opportunities</h3>
                    <p class="text-gray-500 leading-relaxed text-sm sm:text-base">Discover ways to turn what you learn into new ideas, partnerships, and business opportunities within our community.</p>
                    <p class="urdu-text text-gray-400 text-sm leading-relaxed mt-3" dir="rtl">اپنے سیکھے ہوئے ہنر کو نئے خیالات، شراکت داری اور کاروباری مواقع میں بدلنے کے طریقے دریافت کریں۔</p>
                </div>
            </div>
            <div class="text-center mt-10 sm:mt-12">
                <p class="text-gray-600 mb-2">Ready to learn or explore an opportunity? Message our team.</p>
                <p class="urdu-text text-gray-400 text-sm mb-5" dir="rtl">ہنر سیکھنے یا کاروباری مواقع کے بارے میں جاننے کے لیے ہمیں پیغام بھیجیں۔</p>
                <a href="https://wa.me/{{ config('services.whatsapp.number') }}?text={{ urlencode('Hi, I am interested in learning skills or exploring business opportunities with Me Earning. Please share more details.') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 rounded-lg bg-[#25D366] px-5 py-3 text-sm font-semibold text-white transition-colors hover:bg-[#1fbd5b]">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.52 3.48A11.87 11.87 0 0012.04 0C5.48 0 .13 5.35.13 11.91c0 2.1.55 4.15 1.6 5.96L0 24l6.3-1.65a11.9 11.9 0 005.73 1.46h.01c6.55 0 11.9-5.35 11.9-11.91 0-3.18-1.24-6.17-3.42-8.42zM12.04 21.8a9.9 9.9 0 01-5.05-1.39l-.36-.21-3.74.98 1-3.65-.24-.37a9.85 9.85 0 01-1.52-5.25c0-5.47 4.45-9.92 9.92-9.92a9.85 9.85 0 017.02 2.91 9.85 9.85 0 012.9 7.02c0 5.47-4.45 9.92-9.92 9.92zm5.44-7.43c-.3-.15-1.77-.87-2.04-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.65.07-.3-.15-1.26-.46-2.4-1.47-.89-.8-1.49-1.78-1.66-2.08-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.08-.8.37-.27.3-1.04 1.02-1.04 2.49s1.07 2.89 1.22 3.09c.15.2 2.1 3.21 5.08 4.5.71.3 1.26.49 1.69.63.71.23 1.36.2 1.87.12.57-.09 1.77-.72 2.02-1.42.25-.7.25-1.3.17-1.42-.08-.12-.27-.2-.57-.35z"/></svg>
                    <span>Chat on WhatsApp</span>
                </a>
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
