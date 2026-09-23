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
            <h1 class="text-2xl font-bold text-gray-900">AdSense Settings</h1>
            <p class="text-sm mt-1 text-gray-400">Configure Google AdSense to display ads on your platform. <span class="font-urdu text-xs">اشتہارات کی ترتیب</span></p>
        </div>

        <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6">
            @csrf

            <div class="bg-white border border-gray-100 rounded-2xl p-6 space-y-6">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center bg-blue-50">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Google AdSense</h2>
                        <p class="text-xs text-gray-400">Display ads across your platform</p>
                    </div>
                </div>

                <!-- Enable/Disable -->
                <div class="flex items-center justify-between p-4 rounded-xl bg-gray-50 border border-gray-200">
                    <div>
                        <p class="text-gray-900 font-medium text-sm">Enable AdSense Ads</p>
                        <p class="text-xs mt-0.5 text-gray-500">Show ads on dashboard and public pages</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="adsense_enabled" value="1" {{ $settings['adsense_enabled'] === '1' ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all bg-gray-300 peer-checked:bg-[#4caf2f] peer-focus:outline-none"></div>
                    </label>
                </div>

                <!-- Publisher ID -->
                <div>
                    <label for="adsense_publisher_id" class="block text-sm font-semibold mb-2 text-gray-600">Publisher ID</label>
                    <input type="text" name="adsense_publisher_id" id="adsense_publisher_id" value="{{ old('adsense_publisher_id', $settings['adsense_publisher_id']) }}" placeholder="ca-pub-XXXXXXXXXXXXXXXX" class="w-full rounded-xl px-4 py-3 text-gray-900 text-sm placeholder-gray-500 focus:outline-none transition-colors font-mono bg-gray-50 border border-gray-200">
                    <p class="text-xs mt-1.5 text-gray-500">Format: ca-pub-xxxxxxxxxxxxxxxx</p>
                </div>

                <!-- Ad Slots -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label for="adsense_ad_slot_header" class="block text-sm font-semibold mb-2 text-gray-600">Header Ad Slot</label>
                        <input type="text" name="adsense_ad_slot_header" id="adsense_ad_slot_header" value="{{ old('adsense_ad_slot_header', $settings['adsense_ad_slot_header']) }}" placeholder="1234567890" class="w-full rounded-xl px-4 py-3 text-gray-900 text-sm placeholder-gray-500 focus:outline-none transition-colors font-mono bg-gray-50 border border-gray-200">
                        <p class="text-xs mt-1.5 text-gray-500">Leaderboard (728x90)</p>
                    </div>
                    <div>
                        <label for="adsense_ad_slot_sidebar" class="block text-sm font-semibold mb-2 text-gray-600">Sidebar Ad Slot</label>
                        <input type="text" name="adsense_ad_slot_sidebar" id="adsense_ad_slot_sidebar" value="{{ old('adsense_ad_slot_sidebar', $settings['adsense_ad_slot_sidebar']) }}" placeholder="1234567890" class="w-full rounded-xl px-4 py-3 text-gray-900 text-sm placeholder-gray-500 focus:outline-none transition-colors font-mono bg-gray-50 border border-gray-200">
                        <p class="text-xs mt-1.5 text-gray-500">Sidebar (300x250)</p>
                    </div>
                    <div>
                        <label for="adsense_ad_slot_footer" class="block text-sm font-semibold mb-2 text-gray-600">Footer Ad Slot</label>
                        <input type="text" name="adsense_ad_slot_footer" id="adsense_ad_slot_footer" value="{{ old('adsense_ad_slot_footer', $settings['adsense_ad_slot_footer']) }}" placeholder="1234567890" class="w-full rounded-xl px-4 py-3 text-gray-900 text-sm placeholder-gray-500 focus:outline-none transition-colors font-mono bg-gray-50 border border-gray-200">
                        <p class="text-xs mt-1.5 text-gray-500">Anchor (320x50)</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="text-white font-bold px-8 py-3 rounded-xl transition-all duration-200 bg-[#4caf2f] hover:bg-[#43a027]">
                    Save Settings
                </button>
            </div>
        </form>

        <div class="bg-white border border-gray-100 rounded-2xl p-6">
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
                <li>Copy the Publisher ID (<code class="px-1.5 py-0.5 rounded font-mono text-xs bg-gray-50 text-[#43a027]">ca-pub-xxxxx</code>) and paste above</li>
                <li>Copy each ad unit's Slot ID and paste in the corresponding field</li>
                <li>Enable AdSense and save settings</li>
            </ol>
        </div>

    </div>
</x-layouts.dashboard>
