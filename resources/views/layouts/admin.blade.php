<!DOCTYPE html>
<html lang="uz" class="admin-html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') — {{ \App\Models\SiteSetting::current()->brand_name }}</title>
    @if (\App\Models\SiteSetting::current()->resolvedLogoMarkUrl())
        <link rel="icon" type="image/png" href="{{ \App\Models\SiteSetting::current()->resolvedLogoMarkUrl() }}">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="studio-canvas admin-shell font-sans text-base text-slate-200 antialiased overflow-x-hidden" x-data="{ sidebarOpen: false }">
    @php
        $adminSetting = \App\Models\SiteSetting::current();
        $unreadCount = \App\Models\ContactMessage::where('is_read', false)->count();
        $navItems = [
            ['route' => 'dashboard', 'pattern' => 'dashboard', 'label' => 'Boshqaruv paneli', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
            ['route' => 'admin.projects.index', 'pattern' => 'admin.projects.*', 'label' => 'Loyihalar / Ishlar', 'icon' => 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z'],
            ['route' => 'admin.services.index', 'pattern' => 'admin.services.*', 'label' => 'Xizmat paketlari', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
            ['route' => 'admin.skills.index', 'pattern' => 'admin.skills.*', 'label' => "Ko'nikma va texnika", 'icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z'],
            ['route' => 'admin.experiences.index', 'pattern' => 'admin.experiences.*', 'label' => 'Tajriba', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['route' => 'admin.messages.index', 'pattern' => 'admin.messages.*', 'label' => 'Xabarlar', 'badge' => $unreadCount, 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
            ['route' => 'admin.settings.edit', 'pattern' => 'admin.settings.*', 'label' => 'Sozlamalar & Logotip', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z'],
        ];
    @endphp

    <div class="min-h-screen flex w-full max-w-full overflow-x-hidden">
        {{-- Mobile backdrop --}}
        <div
            x-show="sidebarOpen"
            x-cloak
            @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-black/70 backdrop-blur-sm lg:hidden"
        ></div>

        {{-- Sidebar --}}
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="fixed inset-y-0 left-0 z-50 w-[280px] lg:w-[330px] max-w-[85vw] shrink-0 border-r border-white/[0.08] bg-obsidian-950/95 backdrop-blur-xl transition-transform duration-200 lg:static flex flex-col justify-between min-h-screen overflow-y-auto"
        >
            <div class="flex-1 flex flex-col">
                <div class="flex items-center justify-between border-b border-white/[0.07] px-5 py-5 lg:px-6 lg:py-7">
                    <a href="{{ route('dashboard') }}" class="min-w-0">
                        <x-brand-logo :setting="$adminSetting" variant="admin" />
                    </a>
                    <button type="button" @click="sidebarOpen = false" class="lg:hidden flex h-9 w-9 items-center justify-center rounded-xl border border-white/10 text-xl text-slate-300 hover:text-white">
                        &times;
                    </button>
                </div>

                <div class="px-5 lg:px-6 pt-5 pb-2">
                    <span class="font-mono text-xs uppercase tracking-[0.18em] text-slate-500">Boshqaruv</span>
                </div>

                <nav class="px-4 lg:px-5 py-2 flex-1 flex flex-col justify-start gap-1.5 lg:gap-2.5">
                    @foreach ($navItems as $item)
                        @php $active = request()->routeIs($item['pattern']); @endphp
                        <a
                            href="{{ route($item['route']) }}"
                            @click="sidebarOpen = false"
                            class="flex items-center justify-between rounded-xl lg:rounded-2xl px-4 py-3 lg:px-5 lg:py-4 text-sm lg:text-base font-medium transition {{ $active ? 'bg-mint-400/15 text-mint-300 border border-mint-400/35 shadow-sm' : 'text-slate-300 hover:bg-white/[0.05] hover:text-white border border-transparent' }}"
                        >
                            <span class="flex items-center gap-3 lg:gap-3.5 min-w-0">
                                <svg class="h-5 w-5 shrink-0 {{ $active ? 'text-mint-400' : 'text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $item['icon'] }}" />
                                </svg>
                                <span class="truncate">{{ $item['label'] }}</span>
                            </span>
                            @if (! empty($item['badge']) && $item['badge'] > 0)
                                <span class="rounded-full bg-mint-400 px-2.5 py-0.5 font-mono text-xs font-bold text-obsidian-950 shrink-0">
                                    {{ $item['badge'] }}
                                </span>
                            @endif
                        </a>
                    @endforeach
                </nav>
            </div>

            <div class="border-t border-white/[0.07] p-4 lg:p-6 space-y-2.5 lg:space-y-3.5">
                <div class="rounded-xl lg:rounded-2xl border border-white/[0.07] bg-obsidian-900/70 p-3.5 lg:p-4">
                    <div class="flex items-center gap-3">
                        <span class="flex h-9 w-9 lg:h-10 lg:w-10 shrink-0 items-center justify-center rounded-xl bg-mint-400/15 border border-mint-400/35 font-display text-xs lg:text-sm font-bold text-mint-400">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </span>
                        <div class="min-w-0">
                            <div class="truncate text-sm font-semibold text-white">{{ auth()->user()->name }}</div>
                            <div class="truncate font-mono text-xs text-slate-400">{{ auth()->user()->email }}</div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('home') }}" target="_blank" class="btn-mint flex w-full items-center justify-center gap-2 rounded-xl px-4 py-3 lg:px-5 lg:py-3.5 text-sm font-semibold">
                    Saytni ko'rish &nearr;
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-ghost w-full rounded-xl px-4 py-2.5 lg:px-5 lg:py-3 text-sm text-slate-300 hover:border-rose-500/40 hover:text-rose-400 transition">
                        Chiqish
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col min-w-0 w-full max-w-full min-h-screen">
            <header class="sticky top-0 z-30 flex items-center justify-between gap-2.5 border-b border-white/[0.07] bg-obsidian-950/85 backdrop-blur-xl px-4 py-3.5 sm:px-6 lg:px-10 lg:py-6 w-full max-w-full">
                <div class="flex items-center gap-2.5 sm:gap-3.5 min-w-0 flex-1">
                    <button
                        type="button"
                        @click="sidebarOpen = true"
                        class="lg:hidden shrink-0 rounded-xl border border-white/10 bg-obsidian-900 p-2 text-slate-300 hover:border-mint-400/40 hover:text-white"
                        aria-label="Menu"
                    >
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="font-display text-lg sm:text-2xl lg:text-3xl font-bold text-white truncate">@yield('title', 'Admin Panel')</h1>
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    @yield('actions')
                </div>
            </header>

            <main class="flex-1 flex flex-col min-w-0 w-full max-w-full overflow-x-hidden px-4 pt-4 pb-24 sm:px-6 sm:pt-6 lg:p-10">
                @if (session('success'))
                    <div class="mb-4 lg:mb-5 flex items-center gap-3 rounded-xl border border-mint-400/40 bg-mint-400/10 px-4 py-3 text-sm lg:text-base text-mint-300" role="status">
                        <span class="h-2.5 w-2.5 shrink-0 rounded-full bg-mint-400"></span>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 lg:mb-5 rounded-xl border border-rose-500/40 bg-rose-500/10 px-4 py-3 text-sm lg:text-base text-rose-300">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>

            {{-- Sleek Native-App Style Mobile Bottom Navigation Bar (iPhone 15 Pro optimized) --}}
            <nav aria-label="Mobile admin navigation" class="lg:hidden fixed bottom-0 inset-x-0 z-30 border-t border-white/[0.08] bg-obsidian-950/92 backdrop-blur-xl px-2 py-2">
                <div class="grid grid-cols-5 gap-1">
                    @php
                        $bottomNav = [
                            ['route' => 'dashboard', 'pattern' => 'dashboard', 'label' => 'Panel', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                            ['route' => 'admin.projects.index', 'pattern' => 'admin.projects.*', 'label' => 'Ishlar', 'icon' => 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z'],
                            ['route' => 'admin.services.index', 'pattern' => 'admin.services.*', 'label' => 'Xizmat', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
                            ['route' => 'admin.messages.index', 'pattern' => 'admin.messages.*', 'label' => 'Xabar', 'badge' => $unreadCount, 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                            ['route' => 'admin.settings.edit', 'pattern' => 'admin.settings.*', 'label' => 'Sozlama', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z'],
                        ];
                    @endphp
                    @foreach ($bottomNav as $bItem)
                        @php $bActive = request()->routeIs($bItem['pattern']); @endphp
                        <a
                            href="{{ route($bItem['route']) }}"
                            class="relative flex flex-col items-center justify-center gap-1 rounded-xl py-1.5 text-[11px] font-medium transition {{ $bActive ? 'bg-mint-400/15 text-mint-300' : 'text-slate-400 hover:text-white' }}"
                        >
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $bItem['icon'] }}" />
                            </svg>
                            <span>{{ $bItem['label'] }}</span>
                            @if (! empty($bItem['badge']) && $bItem['badge'] > 0)
                                <span class="absolute top-1 right-2.5 flex h-4 min-w-[16px] items-center justify-center rounded-full bg-mint-400 px-1 font-mono text-[9px] font-bold text-obsidian-950">
                                    {{ $bItem['badge'] }}
                                </span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </nav>
        </div>
    </div>
</body>
</html>
