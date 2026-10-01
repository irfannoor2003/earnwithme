<x-layouts.public>
    <x-slot:title>Contact Us</x-slot:title>

    <section class="relative overflow-hidden" style="background: linear-gradient(135deg, #f0faf0 0%, #e8f5e1 30%, #ffffff 100%);">
        <div class="relative max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-24 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#e8f5e1] border border-[#c8e6b8] text-[#43a027] text-sm font-semibold mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Get In Touch
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-6xl font-extrabold text-gray-900 mb-4" style="letter-spacing: -1px;">
                Contact <span class="gradient-text">Us</span>
            </h1>
            <p class="text-lg sm:text-xl text-gray-500 max-w-2xl mx-auto mb-2">Koi bhi sawaal hai? Hum se raabta karein.</p>
            <p class="urdu-text text-gray-400 text-sm max-w-2xl mx-auto">کوئی بھی سوال ہے؟ ہم سے رابطہ کریں۔</p>
        </div>
    </section>

    @if(session('success'))
        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 mt-8">
            <div class="bg-white rounded-2xl px-6 py-4 flex items-center gap-3" style="border: 1px solid #c8e6b8;">
                <svg class="w-5 h-5 text-[#43a027] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span class="font-medium text-[#43a027]">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <section class="py-16 sm:py-20 lg:py-24">
        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-10 sm:gap-12">
                <div class="lg:col-span-3">
                    <h2 class="text-xl sm:text-2xl font-extrabold text-gray-900 mb-6">Send Us a <span class="gradient-text">Message</span></h2>
                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-500 mb-2">Your Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3.5 rounded-xl bg-white border border-gray-200 text-gray-900 placeholder-gray-400 focus:border-[#4caf2f] focus:ring-2 focus:ring-[#4caf2f]/10 outline-none transition-all" placeholder="Enter your name">
                                @error('name')<p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-500 mb-2">Your Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3.5 rounded-xl bg-white border border-gray-200 text-gray-900 placeholder-gray-400 focus:border-[#4caf2f] focus:ring-2 focus:ring-[#4caf2f]/10 outline-none transition-all" placeholder="Enter your email">
                                @error('email')<p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-semibold text-gray-500 mb-2">Subject</label>
                            <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required class="w-full px-4 py-3.5 rounded-xl bg-white border border-gray-200 text-gray-900 placeholder-gray-400 focus:border-[#4caf2f] focus:ring-2 focus:ring-[#4caf2f]/10 outline-none transition-all" placeholder="What is this about?">
                            @error('subject')<p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-500 mb-2">Message</label>
                            <textarea id="message" name="message" rows="5" required class="w-full px-4 py-3.5 rounded-xl bg-white border border-gray-200 text-gray-900 placeholder-gray-400 focus:border-[#4caf2f] focus:ring-2 focus:ring-[#4caf2f]/10 outline-none transition-all resize-none" placeholder="Write your message here...">{{ old('message') }}</textarea>
                            @error('message')<p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>@enderror
                        </div>
                        <button type="submit" class="btn-primary text-lg inline-flex items-center">
                            <span>Send Message</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        </button>
                    </form>
                </div>

                <div class="lg:col-span-2">
                    <h2 class="text-xl sm:text-2xl font-extrabold text-gray-900 mb-6">Get in <span class="gradient-text">Touch</span></h2>
                    <div class="space-y-4">
                        @php
                        $contacts = [
                            ['title' => 'Phone', 'value' => '+92 300 1234567', 'sub' => 'Available 9 AM - 9 PM (Mon-Sat)', 'icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z'],
                            ['title' => 'WhatsApp', 'value' => '+92 300 1234567', 'sub' => 'Quick response within 1 hour', 'icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z'],
                            ['title' => 'Email', 'value' => 'support@meearningplatform.com', 'sub' => 'We reply within 24 hours', 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                            ['title' => 'Office Hours', 'value' => 'Monday - Saturday', 'sub' => '9:00 AM - 9:00 PM (Pakistan Time)', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ];
                        @endphp
                        @foreach($contacts as $c)
                        <div class="bg-white rounded-xl p-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#d7f0d0]" style="border: 1px solid #e8f5e1;">
                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0 bg-[#e8f5e1]">
                                    <svg class="w-5 h-5 text-[#4caf2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $c['icon'] }}"/></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 text-sm">{{ $c['title'] }}</h3>
                                    <p class="text-gray-500 mt-0.5 text-sm">{{ $c['value'] }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ $c['sub'] }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-10 sm:py-12 lg:py-16" style="background: linear-gradient(135deg, #e8f5e1 0%, #f0faf0 50%, #ffffff 100%);">
        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 text-center">
            <div class="bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-8 md:p-10" style="border: 1px solid #c8e6b8; box-shadow: 0 4px 20px rgba(76,175,47,0.06);">
                <h2 class="text-xl sm:text-2xl font-extrabold text-gray-900 mb-4">Sawaal ka jawab nahi mila?</h2>
                <p class="text-gray-500 mb-2 max-w-lg mx-auto text-sm sm:text-base">Aap hamari FAQ page bhi dekh sakte hain ya seedha WhatsApp par raabta kar sakte hain.</p>
                <p class="urdu-text text-gray-400 text-sm mb-8 max-w-lg mx-auto">آپ ہماری FAQ page بھی دیکھ سکتے ہیں یا سیدھا WhatsApp پر رابطہ کر سکتے ہیں۔</p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('plans') }}#faq" class="btn-outline inline-flex items-center">
                        View FAQ
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    <a href="https://wa.me/{{ config('services.whatsapp.number') }}" target="_blank" rel="noopener noreferrer" class="btn-primary inline-flex items-center">
                        <span>WhatsApp Us</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>
