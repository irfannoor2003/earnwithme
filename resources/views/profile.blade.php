<x-layouts.dashboard>
    <x-slot:title>My Profile</x-slot:title>

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

        <!-- Profile Form -->
        <div class="rounded-2xl p-6 bg-white border border-gray-100 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]">
            <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-3">
                <span class="w-8 h-8 rounded-lg flex items-center justify-center bg-[#f0faf0]">
                    <svg class="w-4 h-4 text-[#43a027]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </span>
                Profile Information <span class="font-urdu text-sm">پروفول کی معلومات</span>
            </h3>
            <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-semibold mb-2 text-gray-600">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full rounded-xl px-4 py-3 text-gray-900 text-sm placeholder-gray-500 focus:outline-none transition-colors bg-gray-50 border border-gray-200" required>
                    @error('name')
                        <p class="text-xs mt-2 text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold mb-2 text-gray-600">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full rounded-xl px-4 py-3 text-gray-900 text-sm placeholder-gray-500 focus:outline-none transition-colors bg-gray-50 border border-gray-200" required>
                    @error('email')
                        <p class="text-xs mt-2 text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-semibold mb-2 text-gray-600">Phone Number</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" placeholder="03XXXXXXXXX" class="w-full rounded-xl px-4 py-3 text-gray-900 text-sm placeholder-gray-500 focus:outline-none transition-colors bg-gray-50 border border-gray-200" required>
                    @error('phone')
                        <p class="text-xs mt-2 text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Divider -->
                <div class="pt-6 border-t border-gray-100">
                    <p class="text-sm font-medium mb-4 text-gray-400">Change Password <span class="text-gray-500">(Khali chhodein to current password rahega)</span></p>
                </div>

                <!-- Current Password -->
                <div>
                    <label for="current_password" class="block text-sm font-semibold mb-2 text-gray-600">Current Password</label>
                    <input type="password" name="current_password" id="current_password" class="w-full rounded-xl px-4 py-3 text-gray-900 text-sm placeholder-gray-500 focus:outline-none transition-colors bg-gray-50 border border-gray-200">
                    @error('current_password')
                        <p class="text-xs mt-2 text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold mb-2 text-gray-600">New Password</label>
                    <input type="password" name="password" id="password" class="w-full rounded-xl px-4 py-3 text-gray-900 text-sm placeholder-gray-500 focus:outline-none transition-colors bg-gray-50 border border-gray-200">
                    @error('password')
                        <p class="text-xs mt-2 text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold mb-2 text-gray-600">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full rounded-xl px-4 py-3 text-gray-900 text-sm placeholder-gray-500 focus:outline-none transition-colors bg-gray-50 border border-gray-200">
                </div>

                <!-- Submit -->
                <button type="submit" class="w-full bg-[#4caf2f] hover:bg-[#43a027] text-white font-bold py-3.5 rounded-xl transition-all">
                    Changes Save Karein
                </button>
            </form>
        </div>

        <!-- Referral Info -->
        @if(!$user->is_admin)
        <div class="rounded-2xl p-6 bg-white border border-gray-100 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]">
            <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-3">
                <span class="w-8 h-8 rounded-lg flex items-center justify-center bg-[#f0faf0]">
                    <svg class="w-4 h-4 text-[#43a027]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                </span>
                Referral Information <span class="font-urdu text-sm">ریفرل کی معلومات</span>
            </h3>

            <div class="space-y-4">
                <!-- Referral Code -->
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-600">Aapka Referral Code</label>
                    <div class="rounded-xl px-4 py-3 bg-gray-50 border border-gray-200">
                        <p class="text-gray-900 font-mono text-lg font-bold tracking-wider">{{ $user->referral_code }}</p>
                    </div>
                </div>

                <!-- Referral Link -->
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-600">Aapka Referral Link</label>
                    <div class="rounded-xl px-4 py-3 flex items-center gap-3 bg-gray-50 border border-gray-200">
                        <span class="text-sm font-mono truncate flex-1 text-gray-600">{{ url('/register?ref=' . $user->referral_code) }}</span>
                        <button onclick="copyProfileLink()" class="flex-shrink-0 text-sm font-semibold transition-colors text-[#43a027]">
                            Copy
                        </button>
                    </div>
                    <p id="profileCopySuccess" class="text-xs mt-2 hidden text-[#43a027]">Clipboard mein copy ho gaya!</p>
                </div>

                <!-- Referred By -->
                @if($user->referredBy)
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-600">Referred By</label>
                        <div class="rounded-xl px-4 py-3 bg-gray-50 border border-gray-200">
                            <p class="text-gray-900 text-sm">{{ $user->referredBy->name }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @endif

    </div>

    <script>
        function copyProfileLink() {
            var link = '{{ url("/register?ref=" . $user->referral_code) }}';
            navigator.clipboard.writeText(link).then(function() {
                var msg = document.getElementById('profileCopySuccess');
                msg.classList.remove('hidden');
                setTimeout(function() {
                    msg.classList.add('hidden');
                }, 2000);
            });
        }
    </script>
</x-layouts.dashboard>
