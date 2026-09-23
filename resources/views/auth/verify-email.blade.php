<x-layouts.public>
    <x-slot:title>Verify Email - Me Earning</x-slot:title>

    <section class="min-h-[70vh] flex items-center justify-center py-12 px-4">
        <div class="max-w-md w-full">
            <div class="bg-white border border-gray-200 shadow-sm rounded-2xl p-8 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <div class="w-16 h-16 mx-auto mb-6 rounded-2xl flex items-center justify-center bg-amber-50">
                    <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                
                <h2 class="text-2xl font-bold text-gray-900 mb-3">Email Verify Karein</h2>
                <p class="text-gray-500 text-sm mb-2">Humne aapke email par ek verification link bheja hai.</p>
                <p class="urdu-text text-gray-400 text-xs mb-6">اپنا اکاؤنٹ استعمال کرنے کے لیے اپنا ایمیل تصدیق کریں۔</p>

                @if(session('success'))
                    <div class="rounded-xl px-4 py-3 text-sm font-medium bg-[#f0faf0] border border-[#d7f0d0] text-[#43a027] mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="space-y-4">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="w-full bg-[#4caf2f] hover:bg-[#43a027] text-white font-bold py-3 rounded-xl transition-all">
                            Dobara Verification Link Bhejein
                        </button>
                    </form>

                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-400">ya</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 rounded-xl transition-all">
                            Logout
                        </button>
                    </form>
                </div>

                <p class="text-xs text-gray-400 mt-6">Spam folder mein bhi check karein. Link 60 minutes tak valid hai.</p>
            </div>
        </div>
    </section>
</x-layouts.public>
