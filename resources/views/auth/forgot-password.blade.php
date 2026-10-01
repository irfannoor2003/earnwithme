<x-layouts.public>
    <div class="min-h-screen flex items-center justify-center px-4 py-12" style="background: linear-gradient(135deg, #f0faf0 0%, #e8f5e1 30%, #ffffff 100%);">

        <div class="w-full max-w-md relative z-10">
            <div class="text-center mb-8">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 mb-6">
                    <img src="/images/logo.png" alt="Me Earning" class="h-14 w-auto">
                </a>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight" style="letter-spacing: -1px;">Reset Password</h1>
                <p class="text-gray-500 mt-2 text-sm">Enter your email and we will send you a reset link</p>
                <p class="urdu-text text-gray-400 text-xs mt-1">اپنا ای میل دیں تاکہ آپ کو ری سیٹ لنک ملے</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
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

                @if (session('status'))
                    <div class="mb-6 p-4 rounded-xl bg-[#f0faf0] border border-[#d7f0d0]">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-[#43a027] mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <p class="text-sm text-[#43a027]">{{ session('status') }}</p>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.request') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-600 mb-2">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3.5 text-gray-900 placeholder-gray-400 focus:outline-none focus:border-[#4caf2f] focus:ring-2 focus:ring-[#4caf2f]/10 transition-all duration-300"
                            placeholder="you@example.com" />
                    </div>

                    <button type="submit" class="w-full btn-primary text-lg py-4">
                        <span>Send Reset Link</span>
                    </button>
                </form>

                <p class="text-center text-sm text-gray-500 mt-6">
                    <a href="{{ route('login') }}" class="text-[#43a027] hover:text-[#4caf2f] font-medium transition-colors">
                        &larr; Back to Sign In
                    </a>
                </p>
            </div>
        </div>
    </div>
</x-layouts.public>
