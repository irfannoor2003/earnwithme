@props(['title' => 'Dashboard'])
<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $title }} - Me Earning</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Noto+Nastaliq+Urdu:wght@400;700&display=swap" rel="stylesheet">
    <style>
        [x-cloak] { display: none !important; }
        :root {
            --accent: #4caf2f;
            --accent-dim: rgba(76, 175, 47, 0.06);
            --accent-border: rgba(76, 175, 47, 0.12);
            --purple: #8B5CF6;
            --purple-dim: rgba(139, 92, 246, 0.06);
            --purple-border: rgba(139, 92, 246, 0.12);
        }
        body { font-family: 'Inter', sans-serif; background: #F9FAFB; color: #374151; -webkit-font-smoothing: antialiased; }
        .font-urdu { font-family: 'Noto Nastaliq Urdu', serif; direction: rtl; }
        .sidebar {
            background: #FFFFFF;
            border-right: 1px solid #F3F4F6;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            color: #6B7280;
            transition: all 0.2s ease;
        }
        .sidebar-link:hover { background: #f0faf0; color: #4caf2f; }
        .sidebar-link:hover svg { color: #4caf2f; }
        .sidebar-link.active { background: var(--accent-dim); color: var(--accent); font-weight: 600; }
        .sidebar-link.active svg { color: var(--accent); }
        .admin-link.active { background: var(--purple-dim); color: var(--purple); }
        .admin-link.active svg { color: var(--purple); }
    </style>
    @php try { $enabled = \App\Models\Setting::get('adsense_enabled', '0') === '1'; $pubId = \App\Models\Setting::get('adsense_publisher_id', ''); } catch (\Exception $e) { $enabled = false; $pubId = ''; } @endphp
    @if($enabled && $pubId)
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{ $pubId }}" crossorigin="anonymous"></script>
    @endif
</head>
<body class="h-full" x-data="{ sidebarOpen: false }">

    {{-- Mobile sidebar overlay --}}
    <div
        x-show="sidebarOpen"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-black/30 lg:hidden"
    ></div>

    {{-- Sidebar --}}
    <aside
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="sidebar fixed inset-y-0 left-0 z-50 w-64 flex flex-col transition-transform duration-200 lg:translate-x-0"
    >
        {{-- Logo --}}
        <div class="flex items-center px-5 h-16 shrink-0">
            <img src="/images/logo.png" alt="Me Earning" class="h-10 w-auto">
            <button @click="sidebarOpen = false" class="ml-auto lg:hidden text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto py-3 px-3 space-y-0.5">
            @if(!Auth::user()->is_admin)
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                Dashboard
            </a>
            <a href="{{ route('deposit') }}" class="sidebar-link {{ request()->routeIs('deposit') ? 'active' : '' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                </svg>
                Deposit
            </a>
            <a href="{{ route('withdraw') }}" class="sidebar-link {{ request()->routeIs('withdraw') ? 'active' : '' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                Withdraw
            </a>
            <a href="{{ route('referrals') }}" class="sidebar-link {{ request()->routeIs('referrals') ? 'active' : '' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
                Referrals
            </a>
            <a href="{{ route('earnings') }}" class="sidebar-link {{ request()->routeIs('earnings') ? 'active' : '' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                </svg>
                Earnings
            </a>
            <a href="{{ route('profile') }}" class="sidebar-link {{ request()->routeIs('profile') ? 'active' : '' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                Profile
            </a>
            @endif

            @if(Auth::user()->is_admin)
            <div class="pt-4 pb-1 px-3">
                <p class="text-[10px] font-semibold uppercase tracking-wider text-gray-400">Admin</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link admin-link {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                </svg>
                Dashboard
            </a>
            <a href="{{ route('admin.deposits') }}" class="sidebar-link admin-link {{ request()->routeIs('admin.deposits') ? 'active' : '' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                </svg>
                Deposits
            </a>
            <a href="{{ route('admin.withdrawals') }}" class="sidebar-link admin-link {{ request()->routeIs('admin.withdrawals') ? 'active' : '' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                Withdrawals
            </a>
            <a href="{{ route('admin.users') }}" class="sidebar-link admin-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
                Users
            </a>
            <a href="{{ route('admin.rewards') }}" class="sidebar-link admin-link {{ request()->routeIs('admin.rewards*') ? 'active' : '' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                </svg>
                Rewards
            </a>
            <a href="{{ route('admin.settings') }}" class="sidebar-link admin-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 010 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 010-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Settings
            </a>
            @endif
        </nav>

        {{-- Logout --}}
        <div class="shrink-0 p-3 border-t border-gray-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link w-full text-gray-500 hover:text-red-500 hover:bg-red-50">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- Main content --}}
    <div class="lg:pl-64 min-h-full flex flex-col bg-gray-50">
        {{-- Top bar --}}
        <header class="sticky top-0 z-30 h-16 flex items-center justify-between px-4 sm:px-6 bg-white/80 backdrop-blur-md border-b border-gray-100">
            <button @click="sidebarOpen = true" class="lg:hidden p-2 -ml-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>

            <div class="hidden lg:block"></div>

            @auth
                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                    </div>

                    @if(Auth::user()->is_admin)
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-purple-50 text-purple-600 border border-purple-100">
                            Admin
                        </span>
                    @endif

                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-white text-sm font-bold bg-[#4caf2f]">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </div>
            @endauth
        </header>

        {{-- Page content --}}
        <main class="flex-1 p-4 sm:p-6 lg:p-8">
            {{ $slot }}
        </main>
    </div>
</body>
</html>
