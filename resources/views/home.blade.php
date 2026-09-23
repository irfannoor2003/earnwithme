<x-layouts.public>
    <x-slot:title>Me Earning - Earn, Refer, Build Your Future</x-slot:title>

{{-- HERO --}}
<section class="relative overflow-hidden" style="background: linear-gradient(135deg, #f0faf0 0%, #e8f5e1 30%, #ffffff 70%);">
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full" style="background: radial-gradient(circle, rgba(76,175,47,0.08) 0%, transparent 70%);"></div>
        <div class="absolute -bottom-32 -left-32 w-[500px] h-[500px] rounded-full" style="background: radial-gradient(circle, rgba(76,175,47,0.06) 0%, transparent 70%);"></div>
        <div class="absolute top-1/3 right-1/4 w-2 h-2 rounded-full bg-[#4caf2f] opacity-20"></div>
        <div class="absolute top-1/2 left-1/3 w-1.5 h-1.5 rounded-full bg-[#4caf2f] opacity-30"></div>
        <div class="absolute bottom-1/3 right-1/3 w-1 h-1 rounded-full bg-[#4caf2f] opacity-40"></div>
    </div>
    <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-24 relative">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-20 items-center">
            <div class="text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#e8f5e1] border border-[#c8e6b8] text-[#43a027] text-sm font-semibold mb-8">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    Pakistan's #1 Referral Platform
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-[56px] font-extrabold leading-[1.08] mb-6 text-gray-900">
                    <span class="urdu-text block text-xl sm:text-2xl text-[#43a027] mb-4 font-semibold">کمائیں، رجوع حاصل کریں،مستقبل بنائیں</span>
                    <span class="gradient-text">Earn, Refer,</span><br>
                    <span class="text-gray-900">Build Wealth</span>
                </h1>

                <p class="text-gray-500 text-base sm:text-lg max-w-xl mx-auto lg:mx-0 mb-3 leading-relaxed">
                    Join thousands of Pakistanis earning passive income through our proven 7-level referral system. Start with just <strong class="text-gray-900">Rs 350</strong>.
                </p>
                <p class="urdu-text text-[#43a027]/60 text-sm max-w-xl mx-auto lg:mx-0 mb-10">
                    ہزاروں پاکستانیوں سے جڑیں۔ صرف Rs 350 سے شروع کریں۔
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('register') }}" class="btn-primary">
                        Get Started Free
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                    <a href="{{ route('plans') }}" class="btn-outline">View Plans</a>
                </div>

                <div class="flex flex-wrap items-center gap-6 mt-10 justify-center lg:justify-start">
                    <div class="flex items-center gap-3">
                        <div class="flex -space-x-2">
                            <div class="w-9 h-9 rounded-full bg-[#4caf2f] flex items-center justify-center text-xs font-bold text-white border-2 border-white shadow-sm">A</div>
                            <div class="w-9 h-9 rounded-full bg-amber-400 flex items-center justify-center text-xs font-bold text-white border-2 border-white shadow-sm">K</div>
                            <div class="w-9 h-9 rounded-full bg-blue-400 flex items-center justify-center text-xs font-bold text-white border-2 border-white shadow-sm">M</div>
                        </div>
                        <span class="text-sm font-medium text-gray-600">{{ number_format($displayUsers) }}+ Users</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        @for($i = 0; $i < 5; $i++)
                        <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                        <span class="text-sm font-medium text-gray-600 ml-1">Trusted Platform</span>
                    </div>
                </div>
            </div>

            {{-- Hero Visual --}}
            <div class="relative hidden lg:block">
                <div class="relative w-full h-[480px]">
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 bg-white rounded-2xl p-6 z-10" style="box-shadow: 0 20px 60px rgba(76,175,47,0.15), 0 4px 20px rgba(0,0,0,0.06);">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 rounded-xl bg-[#e8f5e1] flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#4caf2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-medium">Total Deposits</p>
                                <p class="text-2xl font-bold text-gray-900">Rs {{ number_format($displayDeposits) }}+</p>
                            </div>
                        </div>
                        <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full w-3/4 rounded-full" style="background: linear-gradient(90deg, #4caf2f, #66bb6a);"></div>
                        </div>
                    </div>

                    <div class="absolute top-8 left-0 bg-white rounded-2xl p-4 w-52" style="box-shadow: 0 10px 30px rgba(0,0,0,0.06);">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-[#e8f5e1] flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#4caf2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-lg font-bold text-gray-900">{{ number_format($displayUsers) }}+</p>
                                <p class="text-[11px] text-gray-400 font-medium">Active Users</p>
                            </div>
                        </div>
                    </div>

                    <div class="absolute top-12 right-0 bg-white rounded-2xl p-4 w-52" style="box-shadow: 0 10px 30px rgba(0,0,0,0.06);">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-[#e8f5e1] flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#4caf2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            </div>
                            <div>
                                <p class="text-lg font-bold text-gray-900">7 Levels</p>
                                <p class="text-[11px] text-gray-400 font-medium">Commission Depth</p>
                            </div>
                        </div>
                    </div>

                    <div class="absolute bottom-12 left-4 bg-white rounded-2xl p-4 w-52" style="box-shadow: 0 10px 30px rgba(0,0,0,0.06);">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-[#e8f5e1] flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#4caf2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </div>
                            <div>
                                <p class="text-lg font-bold text-gray-900">100%</p>
                                <p class="text-[11px] text-gray-400 font-medium">Secure & Trusted</p>
                            </div>
                        </div>
                    </div>

                    <div class="absolute bottom-8 right-4 bg-white rounded-2xl p-4 w-52" style="box-shadow: 0 10px 30px rgba(0,0,0,0.06);">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-[#e8f5e1] flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#4caf2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-lg font-bold text-gray-900">24/7</p>
                                <p class="text-[11px] text-gray-400 font-medium">Fast Withdrawals</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- STATS --}}
<section class="relative -mt-8 z-10 max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
        <div class="bg-white rounded-2xl p-4 sm:p-6 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#c8e6b8]" style="border: 1px solid #e8f5e1; box-shadow: 0 4px 15px rgba(76,175,47,0.06);">
            <div class="w-12 h-12 sm:w-14 sm:h-14 mx-auto mb-3 sm:mb-4 rounded-2xl bg-[#e8f5e1] flex items-center justify-center">
                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-[#4caf2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <p class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-gray-900">{{ number_format($displayUsers) }}</p>
            <p class="text-[10px] sm:text-xs text-[#4caf2f] mt-1 font-semibold uppercase tracking-wider">Total Users</p>
        </div>
        <div class="bg-white rounded-2xl p-4 sm:p-6 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#c8e6b8]" style="border: 1px solid #e8f5e1; box-shadow: 0 4px 15px rgba(76,175,47,0.06);">
            <div class="w-12 h-12 sm:w-14 sm:h-14 mx-auto mb-3 sm:mb-4 rounded-2xl bg-[#e8f5e1] flex items-center justify-center">
                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-[#4caf2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-gray-900">Rs {{ number_format($displayDeposits) }}</p>
            <p class="text-[10px] sm:text-xs text-[#4caf2f] mt-1 font-semibold uppercase tracking-wider">Total Deposits</p>
        </div>
        <div class="bg-white rounded-2xl p-4 sm:p-6 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#c8e6b8]" style="border: 1px solid #e8f5e1; box-shadow: 0 4px 15px rgba(76,175,47,0.06);">
            <div class="w-12 h-12 sm:w-14 sm:h-14 mx-auto mb-3 sm:mb-4 rounded-2xl bg-violet-50 flex items-center justify-center">
                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <p class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-gray-900">Rs {{ number_format($displayWithdrawals) }}</p>
            <p class="text-[10px] sm:text-xs text-violet-500 mt-1 font-semibold uppercase tracking-wider">Total Withdrawals</p>
        </div>
        <div class="bg-white rounded-2xl p-4 sm:p-6 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#c8e6b8]" style="border: 1px solid #e8f5e1; box-shadow: 0 4px 15px rgba(76,175,47,0.06);">
            <div class="w-12 h-12 sm:w-14 sm:h-14 mx-auto mb-3 sm:mb-4 rounded-2xl bg-amber-50 flex items-center justify-center">
                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <p class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-gray-900">7</p>
            <p class="text-[10px] sm:text-xs text-amber-500 mt-1 font-semibold uppercase tracking-wider">Commission Levels</p>
        </div>
    </div>
</section>

{{-- HOW IT WORKS --}}
<section class="py-16 sm:py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
        <div class="text-center mb-12 sm:mb-16">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#e8f5e1] border border-[#c8e6b8] text-[#43a027] text-sm font-semibold mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                How It Works
            </div>
            <h2 class="text-2xl sm:text-3xl lg:text-5xl font-extrabold text-gray-900 mb-4">
                Start Earning in <span class="gradient-text">4 Simple Steps</span>
            </h2>
            <p class="text-gray-500 text-base sm:text-lg max-w-2xl mx-auto">Our platform makes it easy to start earning passive income.</p>
        </div>

        @php
        $steps = [
            ['num' => '01', 'title' => 'Register', 'urdu' => 'رجسٹر کریں', 'desc' => 'Create your free account in 30 seconds with just your basic details.', 'icon' => 'M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z'],
            ['num' => '02', 'title' => 'Activate Plan', 'urdu' => 'پلان فعال کریں', 'desc' => 'Choose the Rs 350 plan and activate it to unlock earning potential.', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
            ['num' => '03', 'title' => 'Refer Friends', 'urdu' => 'دوستوں کو ریفر کریں', 'desc' => 'Share your referral link. Earn from 7 levels deep in your network.', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
            ['num' => '04', 'title' => 'Earn & Withdraw', 'urdu' => 'کمائیں اور واپس لیں', 'desc' => 'Watch your earnings grow. Withdraw anytime via JazzCash or EasyPaisa.', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
        ];
        @endphp
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            @foreach($steps as $i => $step)
            <div class="bg-white rounded-2xl p-6 sm:p-8 text-center transition-all duration-300 hover:-translate-y-2 hover:shadow-xl group" style="border: 1px solid #e8f5e1;">
                <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl mx-auto mb-4 sm:mb-5 flex items-center justify-center bg-[#e8f5e1] group-hover:bg-[#4caf2f] transition-all duration-300">
                    <svg class="w-6 h-6 sm:w-7 sm:h-7 text-[#4caf2f] group-hover:text-white transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $step['icon'] }}"/></svg>
                </div>
                <div class="text-xs font-bold text-[#4caf2f] mb-2 tracking-wider">{{ $step['num'] }}</div>
                <h3 class="text-base font-bold text-gray-900 mb-1">{{ $step['title'] }}</h3>
                <p class="urdu-text text-xs text-[#43a027]/60 mb-3">{{ $step['urdu'] }}</p>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- PLAN --}}
<section class="py-16 sm:py-20 lg:py-28" style="background: linear-gradient(180deg, #f0faf0 0%, #ffffff 100%);">
    <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
        <div class="text-center mb-12 sm:mb-16">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#e8f5e1] border border-[#c8e6b8] text-[#43a027] text-sm font-semibold mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Investment Plan
            </div>
            <h2 class="text-2xl sm:text-3xl lg:text-5xl font-extrabold text-gray-900 mb-4">
                Start Your <span class="gradient-text">Journey</span>
            </h2>
            <p class="urdu-text text-[#43a027]/60 text-sm">صرف Rs 350 میں اپنا کاروبار شروع کریں</p>
        </div>

        <div>
            <div class="relative group">
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 px-6 py-2 rounded-full text-sm font-bold text-white z-10 uppercase tracking-wider" style="background: linear-gradient(135deg, #43a027, #4caf2f); box-shadow: 0 4px 15px rgba(76,175,47,0.4);">
                    Premium Plan
                </div>
                <div class="bg-white rounded-3xl p-6 sm:p-8 md:p-12 transition-all duration-300 group-hover:shadow-2xl group-hover:-translate-y-1" style="border: 2px solid #e8f5e1; box-shadow: 0 10px 40px rgba(76,175,47,0.08);">
                    <div class="text-center mb-10">
                        <div class="w-20 h-20 mx-auto mb-5 rounded-2xl bg-[#e8f5e1] flex items-center justify-center">
                            <svg class="w-10 h-10 text-[#4caf2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="flex items-baseline justify-center gap-2">
                            <span class="text-5xl sm:text-6xl font-extrabold gradient-text">Rs 350</span>
                        </div>
                        <p class="text-gray-400 mt-2">One-time investment</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 mb-10">
                        <div class="flex items-center gap-3 p-3 rounded-xl" style="background: #f8fdf7;">
                            <div class="w-8 h-8 rounded-lg bg-[#e8f5e1] flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-[#4caf2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700">Daily Returns</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl" style="background: #f8fdf7;">
                            <div class="w-8 h-8 rounded-lg bg-[#e8f5e1] flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-[#4caf2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700">7-Level Referral</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl" style="background: #f8fdf7;">
                            <div class="w-8 h-8 rounded-lg bg-[#e8f5e1] flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-[#4caf2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700">Earn Up to Rs 230/Referral</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl" style="background: #f8fdf7;">
                            <div class="w-8 h-8 rounded-lg bg-[#e8f5e1] flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-[#4caf2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700">Instant Withdrawals</span>
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
                            Activate Now - Rs 350
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                        <p class="text-xs text-gray-400 mt-4">JazzCash / EasyPaisa</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- COMMISSION --}}
<section class="py-16 sm:py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
        <div class="text-center mb-12 sm:mb-16">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#e8f5e1] border border-[#c8e6b8] text-[#43a027] text-sm font-semibold mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                Commission Structure
            </div>
            <h2 class="text-2xl sm:text-3xl lg:text-5xl font-extrabold text-gray-900 mb-4">
                7-Level <span class="gradient-text">Commission</span>
            </h2>
            <p class="text-gray-500 text-base sm:text-lg max-w-2xl mx-auto">Earn commissions from 7 levels of referrals.</p>
        </div>

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
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-3 sm:gap-4">
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

{{-- LIVE ACTIVITY --}}
<section class="py-16 sm:py-20 lg:py-28" style="background: linear-gradient(180deg, #f0faf0 0%, #ffffff 100%);">
    <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
        <div class="text-center mb-12 sm:mb-16">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#e8f5e1] border border-[#c8e6b8] text-[#43a027] text-sm font-semibold mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                Live Activity
            </div>
            <h2 class="text-2xl sm:text-3xl lg:text-5xl font-extrabold text-gray-900 mb-4">
                Live <span class="gradient-text">Activity</span>
            </h2>
            <p class="text-gray-500 text-base sm:text-lg max-w-2xl mx-auto">Real-time deposits and withdrawals</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
            <div class="bg-white rounded-2xl p-5 sm:p-6 md:p-8 transition-all duration-300 hover:shadow-lg" style="border: 1px solid #e8f5e1;">
                <div class="flex items-center gap-3 mb-5 sm:mb-6">
                    <div class="w-10 h-10 rounded-xl bg-[#e8f5e1] flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#4caf2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/></svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-gray-900">Latest Deposits</h3>
                        <p class="text-xs text-gray-400">Real-time activity</p>
                    </div>
                </div>
                <div class="space-y-3">
                    @forelse($recentDeposits as $deposit)
                    <div class="flex items-center justify-between p-3 sm:p-4 rounded-xl transition-colors duration-200" style="background: #f8fdf7;">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-10 h-10 rounded-full bg-[#e8f5e1] flex items-center justify-center flex-shrink-0">
                                <span class="text-sm font-bold text-[#4caf2f]">{{ substr($deposit->user->name ?? 'U', 0, 1) }}</span>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ $deposit->user->name ?? 'User' }}</p>
                                <p class="text-xs text-gray-400">{{ $deposit->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="text-right flex-shrink-0 ml-3">
                            <p class="text-sm font-bold text-[#4caf2f]">+Rs {{ number_format($deposit->amount) }}</p>
                            <p class="text-xs text-gray-400">{{ $deposit->plan->name ?? 'Plan' }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <p class="text-gray-300 text-sm">No recent deposits yet</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 sm:p-6 md:p-8 transition-all duration-300 hover:shadow-lg" style="border: 1px solid #e8f5e1;">
                <div class="flex items-center gap-3 mb-5 sm:mb-6">
                    <div class="w-10 h-10 rounded-xl bg-violet-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-gray-900">Latest Withdrawals</h3>
                        <p class="text-xs text-gray-400">Successful payouts</p>
                    </div>
                </div>
                <div class="space-y-3">
                    @forelse($recentWithdrawals as $withdrawal)
                    <div class="flex items-center justify-between p-3 sm:p-4 rounded-xl transition-colors duration-200" style="background: #f8f8fc;">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-10 h-10 rounded-full bg-violet-50 flex items-center justify-center flex-shrink-0">
                                <span class="text-sm font-bold text-violet-500">{{ substr($withdrawal->user->name ?? 'U', 0, 1) }}</span>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ $withdrawal->user->name ?? 'User' }}</p>
                                <p class="text-xs text-gray-400">{{ $withdrawal->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="text-right flex-shrink-0 ml-3">
                            <p class="text-sm font-bold text-gray-500">-Rs {{ number_format($withdrawal->amount) }}</p>
                            <p class="text-xs text-gray-400">{{ $withdrawal->method ?? 'Bank' }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <p class="text-gray-300 text-sm">No recent withdrawals yet</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FAQ --}}
<section class="py-16 sm:py-20 lg:py-28" x-data="{ openFaq: null }">
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
        <div class="space-y-3">
            @php
            $faqs = [
                ['q' => 'How do I start earning with Me Earning?', 'a' => 'Simply register for free, activate the Rs 350 plan, and start referring friends. You\'ll earn daily returns plus multi-level referral commissions instantly.', 'urdu' => 'بس مفت میں رجسٹر کریں، Rs 350 کا پلان فعال کریں، اور دوستوں کو ریفر کرنا شروع کریں۔'],
                ['q' => 'How are referral commissions calculated?', 'a' => 'You earn fixed amounts from 7 levels: Rs 110 from direct referrals, Rs 50 from level 2, Rs 30 from level 3, Rs 20 from level 4, Rs 10 from level 5, Rs 10 from level 6, and Rs 10 from level 7. Plus, your direct referral gets a Rs 20 bonus!', 'urdu' => 'آپ 7 لیولز سے مقررہ رقم کمائیں گے۔'],
                ['q' => 'How do I withdraw my earnings?', 'a' => 'Withdraw anytime via JazzCash or EasyPaisa. Go to your dashboard, click Withdraw, enter the amount. Min Rs 170, Max Rs 70,000. 1% fee applies. Withdrawals are processed within 24 hours.', 'urdu' => 'آپ جب چاہیں واپس لے سکتے ہیں۔'],
                ['q' => 'Is Me Earning safe and trustworthy?', 'a' => 'Absolutely! Operating since 2024 with thousands of active users. We have a proven track record of timely withdrawals and transparent operations.', 'urdu' => 'بالکل! ہمارے پاس ثابت شدہ ریکارڈ ہے۔'],
                ['q' => 'Can I have multiple accounts?', 'a' => 'No, each user is allowed only one account. Multiple accounts will be detected and may result in suspension.', 'urdu' => 'نہیں، صرف ایک اکاؤنٹ کی اجازت ہے۔'],
            ];
            @endphp
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
                    <p class="urdu-text text-[#43a027]/50 text-xs leading-relaxed mt-2 pl-11">{{ $faq['urdu'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-10 sm:py-12 lg:py-16" style="background: linear-gradient(135deg, #e8f5e1 0%, #f0faf0 50%, #ffffff 100%);">
    <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
        <div class="rounded-2xl p-6 sm:p-8 md:p-12 text-center bg-white" style="border: 2px solid #c8e6b8; box-shadow: 0 20px 60px rgba(76,175,47,0.1);">
            <h2 class="text-2xl sm:text-3xl lg:text-5xl font-extrabold text-gray-900 mb-4">
                Start Earning <span class="gradient-text">Today</span>
            </h2>
            <p class="text-gray-500 text-base sm:text-lg max-w-xl mx-auto mb-3">
                Join thousands of Pakistanis earning passive income.
            </p>
            <p class="urdu-text text-[#43a027]/50 text-sm max-w-xl mx-auto mb-8">
                ہزاروں پاکستانیوں سے جڑیں جو پہلے سے passive income کما رہے ہیں۔
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="btn-primary">
                    Create Free Account
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
                <a href="https://wa.me/9230012345678" target="_blank" class="btn-outline">
                    <svg class="w-5 h-5 text-[#4caf2f]" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    Chat on WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

</x-layouts.public>
