<x-layouts.public>
    <div class="min-h-screen flex items-center justify-center px-4 py-12 relative overflow-hidden" style="background: linear-gradient(135deg, #f0faf0 0%, #e8f5e1 30%, #ffffff 100%);">

        <div class="w-full max-w-5xl relative z-10">
            <div class="text-center mb-10">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 mb-6">
                    <img src="/images/logo.png" alt="Me Earning" class="h-14 w-auto">
                </a>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight" style="letter-spacing: -1px;">Create Account</h1>
                <p class="text-gray-500 mt-2 text-sm">Start your earning journey with Me Earning</p>
                <p class="urdu-text text-gray-400 text-xs mt-1">Me Earning کے ساتھ اپنا earning سفر شروع کریں</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-start">

                {{-- Benefits --}}
                <div class="lg:col-span-2 rounded-2xl bg-white border border-gray-200 shadow-sm p-8 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                    <h2 class="text-lg font-bold text-gray-900 mb-1">Why join Me Earning?</h2>
                    <p class="urdu-text text-gray-400 text-xs mb-6">Me Earning کیوں جوائن کریں؟</p>

                    <div class="space-y-5">
                        @php
                        $benefits = [
                            ['title' => 'Earn Commissions', 'desc' => 'Get paid for every referral you bring to the platform', 'iconClass' => 'text-[#43a027]', 'bgClass' => 'bg-[#f0faf0]'],
                            ['title' => '7-Level Referrals', 'desc' => 'Earn from 7 levels deep in your referral network', 'iconClass' => 'text-violet-600', 'bgClass' => 'bg-violet-50'],
                            ['title' => 'Instant Withdrawals', 'desc' => 'Withdraw your earnings anytime via JazzCash, EasyPaisa', 'iconClass' => 'text-[#43a027]', 'bgClass' => 'bg-[#f0faf0]'],
                            ['title' => 'Trusted Platform', 'desc' => 'Secure, reliable, and transparent earnings', 'iconClass' => 'text-amber-500', 'bgClass' => 'bg-amber-50'],
                        ];
                        @endphp
                        @foreach($benefits as $b)
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 {{ $b['bgClass'] }}">
                                <svg class="w-5 h-5 {{ $b['iconClass'] }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900">{{ $b['title'] }}</h3>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $b['desc'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="flex -space-x-2">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-[#4caf2f] to-[#388e3c] flex items-center justify-center text-xs font-bold text-white border-2 border-white">A</div>
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-[#C8A951] to-[#A68B3C] flex items-center justify-center text-xs font-bold text-white border-2 border-white">K</div>
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-purple-500 to-purple-700 flex items-center justify-center text-xs font-bold text-white border-2 border-white">M</div>
                            </div>
                            <p class="text-xs text-gray-400">Join {{ number_format($memberCount) }} {{ \Illuminate\Support\Str::plural('Pakistani', $memberCount) }} already earning</p>
                        </div>
                    </div>
                </div>

                {{-- Registration Form --}}
                <div class="lg:col-span-3 rounded-2xl bg-white border border-gray-200 shadow-sm p-8 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                    <div class="mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Create Account</h2>
                        <p class="text-gray-500 text-sm mt-1">Fill in your details to get started</p>
                    </div>

                    @if ($errors->any())
                        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-100">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-red-500 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                                </svg>
                                <div>
                                    @foreach ($errors->all() as $error)
                                        <p class="text-sm text-red-500">{{ $error }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-600 mb-2">Full Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                                class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3.5 text-gray-900 placeholder-gray-400 focus:outline-none focus:border-[#4caf2f] focus:ring-2 focus:ring-[#4caf2f]/10 transition-all duration-300"
                                placeholder="Enter your full name" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-600 mb-2">Email Address</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                    class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3.5 text-gray-900 placeholder-gray-400 focus:outline-none focus:border-[#4caf2f] focus:ring-2 focus:ring-[#4caf2f]/10 transition-all duration-300"
                                    placeholder="you@example.com" />
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-semibold text-gray-600 mb-2">Phone Number</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required
                                    class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3.5 text-gray-900 placeholder-gray-400 focus:outline-none focus:border-[#4caf2f] focus:ring-2 focus:ring-[#4caf2f]/10 transition-all duration-300"
                                    placeholder="03XX XXXXXXX" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" x-data="{ show: false }">
                            <div>
                                <label for="password" class="block text-sm font-semibold text-gray-600 mb-2">Password</label>
                                <div class="relative">
                                    <input :type="show ? 'text' : 'password'" type="password" id="password" name="password" required minlength="8"
                                        class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3.5 pr-12 text-gray-900 placeholder-gray-400 focus:outline-none focus:border-[#4caf2f] focus:ring-2 focus:ring-[#4caf2f]/10 transition-all duration-300"
                                        placeholder="e.g. MeEarning2026" autocomplete="new-password" />
                                    <button type="button" @click="show = !show" :aria-label="show ? 'Hide password' : 'Show password'"
                                        class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-400 hover:text-[#43a027] focus:outline-none focus:text-[#43a027] transition-colors">
                                        <svg x-show="!show" x-cloak class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                        <svg x-show="show" x-cloak class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243" />
                                        </svg>
                                    </button>
                                </div>
                                <p class="mt-2 text-xs text-gray-400 leading-relaxed">
                                    At least 8 characters, including letters and numbers.
                                    <span class="urdu-text text-gray-300">کم از کم 8 کردار، انگریز اور نمبر شامل۔</span>
                                </p>
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-semibold text-gray-600 mb-2">Confirm Password</label>
                                <div class="relative">
                                    <input :type="show ? 'text' : 'password'" type="password" id="password_confirmation" name="password_confirmation" required minlength="8"
                                        class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3.5 pr-12 text-gray-900 placeholder-gray-400 focus:outline-none focus:border-[#4caf2f] focus:ring-2 focus:ring-[#4caf2f]/10 transition-all duration-300"
                                        placeholder="e.g. MeEarning2026" autocomplete="new-password" />
                                    <button type="button" @click="show = !show" :aria-label="show ? 'Hide confirm password' : 'Show confirm password'"
                                        class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-400 hover:text-[#43a027] focus:outline-none focus:text-[#43a027] transition-colors">
                                        <svg x-show="!show" x-cloak class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                        <svg x-show="show" x-cloak class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243" />
                                        </svg>
                                    </button>
                                </div>
                                <p x-show="show" x-cloak class="mt-2 text-xs text-[#43a027] font-medium">Passwords are visible.</p>
                            </div>
                        </div>

                        <div>
                            <label for="referral_code" class="block text-sm font-semibold text-gray-600 mb-2">Referral Code <span class="text-gray-400">(optional)</span></label>
                            <input type="text" id="referral_code" name="referral_code" value="{{ old('referral_code', $ref ?? '') }}"
                                class="w-full bg-white border rounded-xl px-4 py-3.5 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 transition-all duration-300 {{ ($errors->has('referral_code') || ($refInvalid ?? false)) ? 'border-red-300 focus:border-red-400 focus:ring-red-100' : 'border-gray-200 focus:border-[#4caf2f] focus:ring-[#4caf2f]/10' }}"
                                placeholder="Enter referral code" />
                            @error('referral_code')
                                <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                            @else
                                @if($refInvalid ?? false)
                                    <p class="mt-1.5 text-sm text-red-500">This referral link is invalid or the referrer has not activated their account yet.</p>
                                @endif
                            @enderror
                        </div>

                        <button type="submit" class="w-full btn-primary text-lg py-4 mt-2">
                            <span>Create Account</span>
                        </button>
                    </form>

                    <div class="mt-6 pt-6 border-t border-gray-100 text-center">
                        <p class="text-gray-400 text-sm">
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-[#43a027] hover:text-[#388e3c] font-semibold transition-colors">
                                Sign in
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.public>
