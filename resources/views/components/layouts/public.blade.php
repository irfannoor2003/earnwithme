@props(['title' => 'Me Earning - Earn, Refer, Build Your Future'])

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Noto+Nastaliq+Urdu:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @php try { $enabled = \App\Models\Setting::get('adsense_enabled', '0') === '1'; $pubId = \App\Models\Setting::get('adsense_publisher_id', ''); } catch (\Exception $e) { $enabled = false; $pubId = ''; } @endphp
    @if($enabled && $pubId)
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{ $pubId }}" crossorigin="anonymous"></script>
    @endif
    <style>
        [x-cloak] { display: none !important; }
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #FFFFFF;
            color: #6B7280;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }
        .urdu-text { font-family: 'Noto Nastaliq Urdu', serif; direction: rtl; }
        .gradient-text {
            background: linear-gradient(135deg, #43a027, #66bb6a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #4caf2f;
            color: white;
            font-weight: 600;
            padding: 14px 32px;
            border-radius: 12px;
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 15px;
            box-shadow: 0 2px 8px rgba(76, 175, 47, 0.25);
        }
        .btn-primary:hover { background: #43a027; transform: translateY(-2px); box-shadow: 0 8px 25px rgba(76, 175, 47, 0.35); }
        .btn-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: white;
            color: #374151;
            font-weight: 600;
            padding: 14px 32px;
            border-radius: 12px;
            border: 1px solid #E5E7EB;
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 15px;
        }
        .btn-outline:hover { border-color: #4caf2f; color: #4caf2f; background: #f0faf0; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(76, 175, 47, 0.1); }
        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.01em;
        }
        .card {
            background: white;
            border: 1px solid #F3F4F6;
            border-radius: 16px;
            transition: all 0.3s ease;
        }
        .card:hover {
            border-color: #d7f0d0;
            box-shadow: 0 8px 30px rgba(76, 175, 47, 0.08);
            transform: translateY(-2px);
        }
        .nav-link {
            font-size: 14px;
            font-weight: 500;
            color: #6B7280;
            transition: all 0.2s ease;
            text-decoration: none;
            position: relative;
        }
        .nav-link:hover { color: #4caf2f; }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: #4caf2f;
            border-radius: 1px;
            transition: width 0.2s ease;
        }
        .nav-link:hover::after { width: 100%; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #F9FAFB; }
        ::-webkit-scrollbar-thumb { background: #E5E7EB; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #D1D5DB; }
    </style>
</head>
<body x-data="{ mobileMenuOpen: false }">

    {{-- Navbar --}}
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-lg border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="/images/logo.png" alt="Me Earning" class="h-10 w-auto">
                </a>

                {{-- Desktop Nav Links --}}
                <div class="hidden lg:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                    <a href="{{ route('plans') }}" class="nav-link">Plans</a>
                    <a href="{{ route('earning-details') }}" class="nav-link">How to Earn</a>
                    <a href="{{ route('about') }}" class="nav-link">About</a>
                    <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                    <a href="{{ route('business-plan') }}" class="nav-link">Business Plan</a>
                </div>

                {{-- Desktop Auth Buttons --}}
                <div class="hidden lg:flex items-center gap-3">
                    <a href="{{ route('login') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-600 hover:text-gray-900 rounded-lg hover:bg-gray-50 transition-all">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="btn-primary text-sm py-2.5 px-6">
                        Start Earning
                    </a>
                </div>

                {{-- Mobile Hamburger --}}
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="mobileMenuOpen" x-cloak x-transition class="lg:hidden bg-white border-t border-gray-100">
            <div class="px-4 py-4 space-y-1">
                <a href="{{ route('home') }}" @click="mobileMenuOpen = false" class="block px-4 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-all">Home</a>
                <a href="{{ route('plans') }}" @click="mobileMenuOpen = false" class="block px-4 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-all">Plans</a>
                <a href="{{ route('earning-details') }}" @click="mobileMenuOpen = false" class="block px-4 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-all">How to Earn</a>
                <a href="{{ route('about') }}" @click="mobileMenuOpen = false" class="block px-4 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-all">About</a>
                <a href="{{ route('contact') }}" @click="mobileMenuOpen = false" class="block px-4 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-all">Contact</a>
                <a href="{{ route('business-plan') }}" @click="mobileMenuOpen = false" class="block px-4 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-all">Business Plan</a>
                <div class="pt-3 border-t border-gray-100 space-y-2">
                    <a href="{{ route('login') }}" @click="mobileMenuOpen = false" class="block px-4 py-2.5 text-sm font-semibold text-center text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-all">Login</a>
                    <a href="{{ route('register') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 text-sm font-semibold text-center text-white bg-[#4caf2f] hover:bg-[#43a027] rounded-lg transition-all">Start Earning Free</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="pt-16">
        <x-adsense slot="header" />
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="bg-white border-t border-gray-100 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8">
                {{-- Brand --}}
                <div class="lg:col-span-5">
                    <div class="mb-5">
                        <img src="/images/logo.png" alt="Me Earning" class="h-12 w-auto">
                    </div>
                    <p class="text-gray-500 text-sm leading-relaxed max-w-sm mb-4">
                        Pakistan's trusted referral earning platform. Start earning passive income with our 7-level commission system.
                    </p>
                    <p class="urdu-text text-gray-400 text-sm leading-relaxed max-w-sm mb-6">
                        پاکستان کی سب سے قابل اعتماد ریفرل earning platform۔ ہمارے ثابت شدہ 7-level کمیشن سسٹم کے ساتھ passive income کمانا شروع کریں۔
                    </p>

                    <a href="https://wa.me/9230012345678" target="_blank" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#f0faf0] border border-[#b0e0a0] rounded-lg text-[#43a027] text-sm font-semibold hover:bg-[#d7f0d0] transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        Chat on WhatsApp
                    </a>
                </div>

                {{-- Quick Links --}}
                <div class="lg:col-span-3">
                    <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-5">Quick Links</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-[#43a027] transition-colors">Home</a></li>
                        <li><a href="{{ route('plans') }}" class="text-sm text-gray-500 hover:text-[#43a027] transition-colors">Investment Plans</a></li>
                        <li><a href="{{ route('earning-details') }}" class="text-sm text-gray-500 hover:text-[#43a027] transition-colors">How to Earn</a></li>
                        <li><a href="{{ route('business-plan') }}" class="text-sm text-gray-500 hover:text-[#43a027] transition-colors">Business Plan</a></li>
                        <li><a href="{{ route('about') }}" class="text-sm text-gray-500 hover:text-[#43a027] transition-colors">About Us</a></li>
                        <li><a href="{{ route('contact') }}" class="text-sm text-gray-500 hover:text-[#43a027] transition-colors">Contact Us</a></li>
                    </ul>
                </div>

                {{-- Support --}}
                <div class="lg:col-span-2">
                    <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-5">Support</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-sm text-gray-500 hover:text-gray-900 transition-colors">Help Center</a></li>
                        <li><a href="#" class="text-sm text-gray-500 hover:text-gray-900 transition-colors">FAQ</a></li>
                        <li><a href="https://wa.me/9230012345678" target="_blank" class="text-sm text-gray-500 hover:text-gray-900 transition-colors">WhatsApp</a></li>
                    </ul>
                </div>

                {{-- Legal --}}
                <div class="lg:col-span-2">
                    <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-5">Legal</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-sm text-gray-500 hover:text-gray-900 transition-colors">Terms</a></li>
                        <li><a href="#" class="text-sm text-gray-500 hover:text-gray-900 transition-colors">Privacy</a></li>
                        <li><a href="#" class="text-sm text-gray-500 hover:text-gray-900 transition-colors">Refund</a></li>
                    </ul>
                </div>
            </div>

            {{-- Bottom Bar --}}
            <div class="mt-12 pt-8 border-t border-gray-100">
                <x-adsense slot="footer" />
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-gray-400">&copy; {{ date('Y') }} Me Earning Platform. All rights reserved.</p>
                    <p class="text-sm text-gray-400">Made with care for the people of Pakistan 🇵🇰</p>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
