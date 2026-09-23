<x-layouts.public>
    <div class="min-h-screen flex items-center justify-center px-4 py-12" style="background: linear-gradient(135deg, #f0faf0 0%, #e8f5e1 30%, #ffffff 100%);">

        <div class="w-full max-w-md relative z-10">
            <div class="text-center mb-8">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 mb-6">
                    <img src="/images/logo.png" alt="Me Earning" class="h-14 w-auto">
                </a>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight" style="letter-spacing: -1px;">Welcome Back</h1>
                <p class="text-gray-500 mt-2 text-sm">Sign in to your Me Earning account</p>
                <p class="urdu-text text-gray-400 text-xs mt-1">اپنے Me Earning اکاؤنٹ میں سائن ان کریں</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Sign In</h2>

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
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <p class="text-sm text-[#43a027]">{{ session('status') }}</p>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-600 mb-2">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3.5 text-gray-900 placeholder-gray-400 focus:outline-none focus:border-[#4caf2f] focus:ring-2 focus:ring-[#4caf2f]/10 transition-all duration-300"
                            placeholder="you@example.com" />
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-600 mb-2">Password</label>
                        <input type="password" id="password" name="password" required
                            class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3.5 text-gray-900 placeholder-gray-400 focus:outline-none focus:border-[#4caf2f] focus:ring-2 focus:ring-[#4caf2f]/10 transition-all duration-300"
                            placeholder="Enter your password" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label for="remember" class="flex items-center gap-2 cursor-pointer select-none">
                            <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}
                                class="w-4 h-4 rounded border-gray-200 bg-white text-[#43a027] focus:ring-[#4caf2f]/50 focus:ring-offset-0 cursor-pointer" />
                            <span class="text-sm text-gray-500">Remember me</span>
                        </label>
                        <a href="{{ route('login') }}" class="text-sm text-[#43a027] hover:text-[#4caf2f] font-medium transition-colors">
                            Forgot password?
                        </a>
                    </div>

                    <button type="submit" class="w-full btn-primary text-lg py-4">
                        <span>Sign In</span>
                    </button>
                </form>

                <div class="mt-6 pt-6 border-t border-gray-100 text-center">
                    <p class="text-gray-400 text-sm">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-[#43a027] hover:text-[#4caf2f] font-semibold transition-colors">
                            Create one now
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.public>
