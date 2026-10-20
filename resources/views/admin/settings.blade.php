<x-layouts.dashboard title="Settings">
    <div class="max-w-4xl mx-auto space-y-8">

        @if(session('success'))
            <div class="bg-[#f0faf0] border border-[#d7f0d0] rounded-2xl p-4 flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0 text-[#43a027]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm font-medium text-[#43a027]">{{ session('success') }}</p>
            </div>
        @endif

        <div>
            <h1 class="text-2xl font-bold text-gray-900">Settings</h1>
            <p class="text-sm mt-1 text-gray-400">Manage your admin account. <span class="font-urdu text-xs">اکاؤنٹ سیٹنگز</span></p>
        </div>

        {{-- Password --}}
        <form method="POST" action="{{ route('admin.settings.password') }}" class="space-y-6">
            @csrf

            <div class="bg-white border border-gray-100 rounded-2xl p-6 space-y-6">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center bg-purple-50">
                        <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Change Password</h2>
                        <p class="text-xs text-gray-400">Keep this account private - admins can approve real money</p>
                    </div>
                </div>

                <div>
                    <label for="current_password" class="block text-sm font-semibold mb-2 text-gray-600">Current Password</label>
                    <input type="password" name="current_password" id="current_password" autocomplete="current-password"
                           class="w-full rounded-xl px-4 py-3 text-gray-900 text-sm focus:outline-none transition-colors bg-gray-50 border border-gray-200 @error('current_password') border-red-400 @enderror">
                    @error('current_password')
                        <p class="text-xs mt-1.5 text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-sm font-semibold mb-2 text-gray-600">New Password</label>
                        <input type="password" name="password" id="password" autocomplete="new-password"
                               class="w-full rounded-xl px-4 py-3 text-gray-900 text-sm focus:outline-none transition-colors bg-gray-50 border border-gray-200 @error('password') border-red-400 @enderror">
                        @error('password')
                            <p class="text-xs mt-1.5 text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold mb-2 text-gray-600">Confirm New Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password"
                               class="w-full rounded-xl px-4 py-3 text-gray-900 text-sm focus:outline-none transition-colors bg-gray-50 border border-gray-200">
                    </div>
                </div>

                <p class="text-xs text-gray-500">Minimum 8 characters, with at least one letter and one number.</p>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="text-white font-bold px-8 py-3 rounded-xl transition-all duration-200 bg-[#4caf2f] hover:bg-[#43a027]">
                    Update Password
                </button>
            </div>
        </form>

        {{-- AdSense: developer-owned, read-only here --}}
        @php
            $mask = function (?string $value): string {
                if (! $value) {
                    return 'Not set';
                }

                if (strlen($value) <= 4) {
                    return str_repeat('*', strlen($value));
                }

                return str_repeat('*', min(8, strlen($value) - 4)).substr($value, -4);
            };
        @endphp

        <div class="bg-white border border-gray-100 rounded-2xl p-6 space-y-6">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center bg-blue-50">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h2 class="text-lg font-bold text-gray-900">Google AdSense</h2>
                    <p class="text-xs text-gray-400">Managed by the developer - read only from here</p>
                </div>
                <span class="text-xs font-bold px-3 py-1.5 rounded-full {{ $adsense['enabled'] ? 'bg-[#f0faf0] text-[#43a027]' : 'bg-gray-100 text-gray-500' }}">
                    {{ $adsense['enabled'] ? 'Enabled' : 'Disabled' }}
                </span>
            </div>

            <div class="p-4 rounded-xl bg-amber-50 border border-amber-200 flex items-start gap-3">
                <svg class="w-5 h-5 shrink-0 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.78 1.33.19 3 1.73 3z"/>
                </svg>
                <p class="text-xs text-amber-800">These values are stored in the application's environment file and can only be changed by the developer. They are intentionally not editable from the admin panel.</p>
            </div>

            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 rounded-xl bg-gray-50 border border-gray-200">
                    <div>
                        <p class="text-gray-900 font-medium text-sm">Publisher ID</p>
                        <p class="text-xs mt-0.5 text-gray-500">Format: ca-pub-xxxxxxxxxxxxxxxx</p>
                    </div>
                    <code class="px-3 py-1.5 rounded-lg font-mono text-xs text-gray-600 bg-white border border-gray-200">{{ $mask($adsense['publisher_id']) }}</code>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @foreach(['header' => 'Header Ad Slot', 'sidebar' => 'Sidebar Ad Slot', 'footer' => 'Footer Ad Slot'] as $key => $label)
                        <div class="p-4 rounded-xl bg-gray-50 border border-gray-200">
                            <p class="text-gray-900 font-medium text-sm">{{ $label }}</p>
                            <code class="mt-2 block px-3 py-1.5 rounded-lg font-mono text-xs text-gray-600 bg-white border border-gray-200 break-all">{{ $mask($adsense['slots'][$key]) }}</code>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="border-t border-gray-100 pt-4">
                <h3 class="text-gray-900 font-bold mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    How to set up
                </h3>
                <ol class="text-sm space-y-2 list-decimal list-inside text-gray-400">
                    <li>Create a <a href="https://www.google.com/adsense/" target="_blank" class="underline text-[#43a027]">Google AdSense</a> account</li>
                    <li>Add your site and get approved by Google</li>
                    <li>Create ad units in AdSense dashboard for Header, Sidebar, and Footer</li>
                    <li>Give the developer the Publisher ID and each Slot ID</li>
                    <li>Developer sets <code class="px-1.5 py-0.5 rounded font-mono text-xs bg-gray-50 text-[#43a027]">ADSENSE_*</code> in the environment file</li>
                </ol>
            </div>
        </div>

    </div>
</x-layouts.dashboard>