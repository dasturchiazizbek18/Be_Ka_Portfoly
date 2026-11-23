<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $setting->brand_name }} — {{ $setting->t('role_title') }}</title>
    <meta name="description" content="{{ $setting->t('hero_bio') }}">
    @if ($setting->resolvedLogoMarkUrl())
        <link rel="icon" type="image/png" href="{{ $setting->resolvedLogoMarkUrl() }}">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body
    class="studio-canvas font-sans text-slate-200 antialiased selection:bg-mint-400/30 selection:text-white"
    x-data="portfolioApp()"
>
    {{-- 1-to-1 Proportional Desktop-to-Mobile Mini-Scale Wrapper --}}
    <div id="site-scale-root" class="w-full min-h-screen">
        {{-- Sticky Glass Header (Exact 1-to-1 Desktop Navbar on Mobile & Desktop) --}}
        <header class="sticky top-0 z-40 border-b border-white/[0.06] bg-obsidian-950/75 backdrop-blur-xl">
            <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-8 py-6">
                {{-- Key Logo Slot #1: Navbar --}}
                <a href="#top" class="shrink-0 focus:outline-none focus-visible:ring-2 focus-visible:ring-mint-400 rounded-xl">
                    <x-brand-logo :setting="$setting" variant="navbar" />
                </a>

                {{-- Full Navigation Links (Always Visible 1-to-1) --}}
                <nav aria-label="Main navigation" class="flex items-center gap-8 text-base font-medium text-slate-400">
                    <a href="#about" class="hover:text-white transition-colors whitespace-nowrap">{{ __('nav.about') }}</a>
                    <a href="#projects" class="hover:text-white transition-colors whitespace-nowrap">{{ __('nav.projects') }}</a>
                    <a href="#services" class="hover:text-white transition-colors whitespace-nowrap">{{ __('nav.services') }}</a>
                    <a href="#experience" class="hover:text-white transition-colors whitespace-nowrap">{{ __('nav.experience') }}</a>
                    <a href="#contact" class="hover:text-white transition-colors whitespace-nowrap">{{ __('nav.contact') }}</a>
                </nav>

                {{-- Right controls: Language Switcher + Admin link --}}
                <div class="flex items-center gap-3 shrink-0">
                    <div class="inline-flex items-center rounded-xl border border-white/[0.08] bg-obsidian-900/90 p-1.5" role="group" aria-label="Language switcher">
                        @foreach (['uz' => 'UZ', 'ru' => 'RU', 'en' => 'EN'] as $code => $label)
                            <a
                                href="{{ route('locale.switch', $code) }}"
                                class="rounded-lg px-3.5 py-2 font-mono text-sm font-semibold transition-all {{ app()->getLocale() === $code ? 'bg-mint-400 text-obsidian-950 shadow-sm' : 'text-slate-400 hover:text-white' }}"
                                @if (app()->getLocale() === $code) aria-current="true" @endif
                            >
                                {{ $label }}
                            </a>
                        @endforeach
                    </div>

                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 rounded-xl border border-mint-400/30 bg-mint-400/10 px-4 py-2 font-mono text-sm font-medium text-mint-300 hover:bg-mint-400/20 transition">
                            {{ __('nav.admin') }}
                        </a>
                    @endauth
                </div>
            </div>
        </header>

        <main id="top">
            {{-- HERO SECTION --}}
            <section id="hero-section" class="relative overflow-hidden pt-12 pb-0">
                <div class="mx-auto w-full max-w-6xl px-8">
                    <div id="hero-grid" class="grid grid-cols-12 items-end gap-6">
                        {{-- Left Content (All elements strictly aligned to the exact width of Erkinjonov Bexruz) --}}
                        <div id="hero-text-col" class="col-span-7 pb-24 flex flex-col items-start">
                            <div class="inline-flex w-min max-w-full flex-col">
                                {{-- Main H1 + Centered Role --}}
                                <h1 class="whitespace-nowrap font-display text-[72px] font-bold tracking-tight text-white leading-[1.05]">
                                    {{ $setting->brand_name }}
                                </h1>

                                <p class="mt-3 text-center font-display text-[30px] font-medium text-mint-400">
                                    {{ $setting->t('role_title') }}
                                </p>

                                {{-- Video formats / genres (strictly inside heading width, crisp 3x2 grid) --}}
                                @php
                                    $vTypes = array_map('trim', explode(',', __('hero.video_types')));
                                @endphp
                                <div class="mt-7 grid w-full grid-cols-3 gap-2.5">
                                    @foreach ($vTypes as $vType)
                                        <span class="inline-flex items-center justify-center gap-1.5 rounded-lg border border-white/[0.08] bg-obsidian-900/80 px-3.5 py-2.5 font-mono text-[14px] text-slate-300 whitespace-nowrap">
                                            <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-mint-400"></span>
                                            {{ $vType }}
                                        </span>
                                    @endforeach
                                </div>

                                {{-- CTA Buttons --}}
                                <div class="mt-8 flex w-full flex-wrap items-center gap-4">
                                    <a href="#projects" class="btn-mint inline-flex items-center gap-2 rounded-xl px-8 py-4 text-[18px] whitespace-nowrap">
                                        <span>{{ __('hero.cta_projects') }}</span>
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>

                                    <a href="#contact" class="btn-ghost inline-flex items-center gap-2 rounded-xl px-8 py-4 text-[18px] whitespace-nowrap">
                                        <span>{{ __('hero.cta_contact') }}</span>
                                    </a>

                                    @if ($setting->showreel_url)
                                        <button
                                            type="button"
                                            @click="openShowreel()"
                                            class="inline-flex items-center gap-2 rounded-xl px-4 py-4 font-mono text-sm font-medium text-mint-400 hover:text-mint-300 transition whitespace-nowrap"
                                        >
                                            <span class="flex h-7 w-7 items-center justify-center rounded-full border border-mint-400/40 bg-mint-400/10">
                                                <svg class="h-3 w-3 ml-0.5 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
                                            </span>
                                            {{ __('hero.showreel') }}
                                        </button>
                                    @endif
                                </div>

                                {{-- Stats Strip (exact width of heading) --}}
                                <div class="mt-9 w-full grid grid-cols-4 gap-4 border-t border-white/[0.07] pt-7">
                                    <div>
                                        <div class="font-display text-[44px] leading-none font-bold text-white">{{ $setting->stat_projects }}</div>
                                        <div class="mt-2 text-[15px] text-slate-400 whitespace-nowrap">{{ __('hero.stat_projects') }}</div>
                                    </div>
                                    <div>
                                        <div class="font-display text-[44px] leading-none font-bold text-white">{{ $setting->stat_clients }}</div>
                                        <div class="mt-2 text-[15px] text-slate-400 whitespace-nowrap">{{ __('hero.stat_clients') }}</div>
                                    </div>
                                    <div>
                                        <div class="font-display text-[44px] leading-none font-bold text-mint-400">{{ $setting->stat_views }}</div>
                                        <div class="mt-2 text-[15px] text-slate-400 whitespace-nowrap">{{ __('hero.stat_views') }}</div>
                                    </div>
                                    <div>
                                        <div class="font-display text-[44px] leading-none font-bold text-white">{{ $setting->stat_experience }}</div>
                                        <div class="mt-2 text-[15px] text-slate-400 whitespace-nowrap">{{ __('hero.stat_experience') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Right Column: Isolated Portrait Cutout Anchored Flush to Section Bottom --}}
                        <div class="col-span-5 self-end flex justify-end">
                            <div id="hero-portrait-wrap" class="relative w-full max-w-[385px] flex items-end justify-center leading-none">
                                <div id="hero-portrait-glow" class="pointer-events-none absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 h-[350px] w-[350px] rounded-full bg-[radial-gradient(circle,rgba(94,240,200,0.22)_0%,rgba(52,211,153,0.08)_48%,transparent_72%)] blur-2xl"></div>

                                @if ($setting->heroImageUrl())
                                    <img
                                        id="hero-portrait-img"
                                        src="{{ $setting->heroImageUrl() }}?v=2"
                                        alt="{{ $setting->brand_name }}"
                                        fetchpriority="high"
                                        class="relative z-10 block w-full max-w-[380px] h-auto object-contain object-bottom select-none"
                                    >
                                @else
                                    <div class="studio-card relative z-10 mb-12 aspect-[4/5] w-full max-w-[330px] rounded-[2rem] flex items-center justify-center p-6">
                                        <x-brand-logo :setting="$setting" variant="showcase" />
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- 01 / ABOUT + LOGO SHOWCASE + SKILLS & GEAR BENTO GRID --}}
            <section id="about" class="py-24 border-t border-white/[0.05]">
                <div class="mx-auto max-w-6xl px-8">
                    <div class="reveal-item mb-12 max-w-2xl">
                        <p class="font-mono text-xs font-semibold uppercase tracking-[0.18em] text-mint-400">
                            {{ __('about.eyebrow') }}
                        </p>
                        <h2 class="mt-2 font-display text-4xl font-bold tracking-tight text-white">
                            {{ $setting->t('about_title') ?: __('about.heading') }}
                        </h2>
                    </div>

                    <div class="grid grid-cols-12 gap-5">
                        {{-- About Story Card --}}
                        <div class="reveal-item studio-card rounded-2xl p-8 col-span-7 flex flex-col justify-between gap-6">
                            <div class="space-y-6">
                                <p class="text-xl leading-relaxed text-slate-200">
                                    {{ $setting->t('about_text') }}
                                </p>

                                {{-- 3-step craft highlights --}}
                                <div class="grid grid-cols-3 gap-3">
                                    <div class="rounded-xl border border-white/[0.07] bg-obsidian-950/70 p-4">
                                        <span class="font-mono text-xs font-semibold text-mint-400">01</span>
                                        <h3 class="mt-1.5 font-display text-sm font-semibold text-white">{{ __('about.pillar1_title') }}</h3>
                                        <p class="mt-1 text-xs leading-relaxed text-slate-400">{{ __('about.pillar1_desc') }}</p>
                                    </div>
                                    <div class="rounded-xl border border-white/[0.07] bg-obsidian-950/70 p-4">
                                        <span class="font-mono text-xs font-semibold text-mint-400">02</span>
                                        <h3 class="mt-1.5 font-display text-sm font-semibold text-white">{{ __('about.pillar2_title') }}</h3>
                                        <p class="mt-1 text-xs leading-relaxed text-slate-400">{{ __('about.pillar2_desc') }}</p>
                                    </div>
                                    <div class="rounded-xl border border-white/[0.07] bg-obsidian-950/70 p-4">
                                        <span class="font-mono text-xs font-semibold text-mint-400">03</span>
                                        <h3 class="mt-1.5 font-display text-sm font-semibold text-white">{{ __('about.pillar3_title') }}</h3>
                                        <p class="mt-1 text-xs leading-relaxed text-slate-400">{{ __('about.pillar3_desc') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-2.5 border-t border-white/[0.06] pt-5">
                                @foreach (explode(',', __('about.tags')) as $tag)
                                    <span class="rounded-lg border border-white/[0.08] bg-obsidian-950/70 px-3.5 py-2 font-mono text-sm text-slate-200">
                                        <span class="text-mint-400 mr-1">#</span>{{ trim($tag) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        {{-- Key Logo Slot #3: Dedicated Brand Logo Showcase Card --}}
                        <div class="reveal-item studio-card rounded-2xl p-6 col-span-5 flex flex-col justify-between gap-4">
                            <div class="flex items-center justify-between">
                                <h3 class="font-display text-sm font-semibold text-white">{{ __('about.brand_card_title') }}</h3>
                                <span class="font-mono text-[10px] uppercase tracking-widest text-mint-400">IDENTITY</span>
                            </div>

                            <x-brand-logo :setting="$setting" variant="showcase" />

                            <p class="text-xs leading-relaxed text-slate-400">
                                {{ __('about.brand_card_desc') }}
                            </p>
                        </div>

                        {{-- Core Skills Card --}}
                        <div class="reveal-item studio-card rounded-2xl p-7 col-span-6">
                            <div class="mb-6 flex items-center justify-between">
                                <h3 class="font-display text-lg font-semibold text-white">{{ __('about.skills_title') }}</h3>
                                <span class="font-mono text-xs text-mint-400">CRAFT</span>
                            </div>

                            <div class="space-y-5">
                                @foreach ($skills as $skill)
                                    <div>
                                        <div class="flex items-center justify-between gap-2 text-sm">
                                            <div>
                                                <span class="font-medium text-white">{{ $skill->t('name') }}</span>
                                                @if ($skill->t('subtitle'))
                                                    <span class="ml-2 font-mono text-xs text-slate-400">{{ $skill->t('subtitle') }}</span>
                                                @endif
                                            </div>
                                            <span class="font-mono text-xs font-semibold text-mint-400">{{ $skill->level }}%</span>
                                        </div>
                                        <div class="mt-2 h-1.5 w-full overflow-hidden rounded-full bg-white/[0.07]">
                                            <div
                                                class="h-full rounded-full bg-gradient-to-r from-mint-600 via-mint-400 to-mint-300"
                                                style="width: {{ min(100, max(10, (int) $skill->level)) }}%"
                                            ></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Gear & Software Card --}}
                        <div class="reveal-item studio-card rounded-2xl p-7 col-span-6">
                            <div class="mb-6 flex items-center justify-between">
                                <h3 class="font-display text-lg font-semibold text-white">{{ __('about.gear_title') }}</h3>
                                <span class="font-mono text-xs text-mint-400">KIT / SETUP</span>
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($gears as $gear)
                                    <div class="rounded-xl border border-white/[0.07] bg-obsidian-950/75 p-4 hover:border-mint-400/35 transition">
                                        <div class="flex items-center gap-2">
                                            <span class="h-2 w-2 rounded-full bg-mint-400"></span>
                                            <h4 class="font-display text-sm font-semibold text-white">{{ $gear->t('name') }}</h4>
                                        </div>
                                        @if ($gear->t('subtitle'))
                                            <p class="mt-1.5 font-mono text-xs text-slate-400">{{ $gear->t('subtitle') }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- 02 / PORTFOLIO PROJECTS --}}
            <section id="projects" class="py-24 border-t border-white/[0.05]">
                <div class="mx-auto max-w-6xl px-8">
                    <div class="reveal-item flex flex-row items-end justify-between gap-6">
                        <div class="max-w-xl">
                            <p class="font-mono text-xs font-semibold uppercase tracking-[0.18em] text-mint-400">
                                {{ __('projects.eyebrow') }}
                            </p>
                            <h2 class="mt-2 font-display text-4xl font-bold tracking-tight text-white">
                                {{ __('projects.heading') }}
                            </h2>
                            <p class="mt-3 text-base text-slate-400">
                                {{ __('projects.subtitle') }}
                            </p>
                        </div>

                        {{-- Filter Pills --}}
                        <div class="flex flex-wrap gap-2" role="tablist" aria-label="Portfolio categories">
                            @php
                                $categories = [
                                    'all' => __('projects.filter_all'),
                                    'reels' => __('projects.filter_reels'),
                                    'commercial' => __('projects.filter_commercial'),
                                    'event' => __('projects.filter_event'),
                                    'brand' => __('projects.filter_brand'),
                                ];
                            @endphp
                            @foreach ($categories as $key => $label)
                                <button
                                    type="button"
                                    @click="activeCategory = '{{ $key }}'"
                                    :class="activeCategory === '{{ $key }}'
                                        ? 'bg-mint-400 text-obsidian-950 border-mint-400 font-semibold'
                                        : 'bg-obsidian-900/90 text-slate-300 border-white/10 hover:border-mint-400/40 hover:text-white'"
                                    class="rounded-xl border px-3.5 py-2 text-sm transition"
                                >
                                    {{ $label }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Projects Grid (3 Columns 1-to-1) --}}
                    <div class="mt-10 grid grid-cols-3 gap-6">
                        @foreach ($projects as $index => $project)
                            @php
                                $payload = [
                                    'title' => $project->t('title'),
                                    'description' => $project->t('description'),
                                    'category' => $project->category,
                                    'client' => $project->client_name,
                                    'duration' => $project->duration,
                                    'views' => $project->views_count,
                                    'year' => $project->year,
                                    'camera' => $project->camera_spec,
                                    'videoUrl' => $project->video_url,
                                    'embedUrl' => $project->embedUrl(),
                                    'isDirectVideo' => $project->isDirectVideo(),
                                    'thumbnail' => $project->thumbnailUrl(),
                                ];
                                $gradients = [
                                    'from-emerald-950/90 via-obsidian-900 to-obsidian-950',
                                    'from-teal-950/90 via-obsidian-900 to-slate-950',
                                    'from-cyan-950/80 via-obsidian-900 to-obsidian-950',
                                ];
                                $grad = $gradients[$index % count($gradients)];
                            @endphp
                            <article
                                x-show="activeCategory === 'all' || activeCategory === '{{ $project->category }}'"
                                x-transition.opacity.duration.250ms
                                class="studio-card group flex flex-col overflow-hidden rounded-2xl"
                            >
                                {{-- Video Poster / Thumbnail --}}
                                <button
                                    type="button"
                                    @click='openProject(@json($payload))'
                                    class="relative block w-full overflow-hidden text-left {{ $project->aspect_ratio === 'vertical' ? 'aspect-[4/5]' : 'aspect-[4/3]' }} bg-gradient-to-br {{ $grad }}"
                                >
                                    @if ($project->thumbnailUrl())
                                        <img
                                            src="{{ $project->thumbnailUrl() }}"
                                            alt="{{ $project->t('title') }}"
                                            loading="lazy"
                                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                        >
                                        <div class="absolute inset-0 bg-gradient-to-t from-obsidian-950 via-obsidian-950/25 to-obsidian-950/30"></div>
                                    @else
                                        <div class="viewfinder-grid absolute inset-0 opacity-60"></div>
                                        <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_35%,rgba(94,240,200,0.16),transparent_65%)]"></div>
                                    @endif

                                    {{-- Top Badges --}}
                                    <div class="absolute top-3.5 left-3.5 right-3.5 flex items-center justify-between gap-2 font-mono text-[11px]">
                                        <span class="rounded-lg border border-white/15 bg-obsidian-950/80 backdrop-blur-md px-2.5 py-1 uppercase text-mint-400">
                                            {{ $project->aspect_ratio === 'vertical' ? '9:16 REELS' : '16:9 CINEMA' }}
                                        </span>
                                        @if ($project->duration)
                                            <span class="rounded-lg border border-white/10 bg-obsidian-950/80 backdrop-blur-md px-2.5 py-1 text-slate-200">
                                                {{ $project->duration }}
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Play Overlay --}}
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="flex h-14 w-14 items-center justify-center rounded-full border border-mint-400/50 bg-obsidian-950/75 text-mint-400 backdrop-blur-md shadow-mint-glow transition-all duration-300 group-hover:scale-110 group-hover:bg-mint-400 group-hover:text-obsidian-950">
                                            <svg class="h-5 w-5 ml-0.5 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                                                <path d="M8 5v14l11-7z"/>
                                            </svg>
                                        </span>
                                    </div>

                                    {{-- Bottom Stats Overlay --}}
                                    <div class="absolute bottom-3.5 left-3.5 right-3.5 flex items-center justify-between font-mono text-[11px] text-slate-300">
                                        <span>{{ $project->client_name ?: $project->year }}</span>
                                        @if ($project->views_count)
                                            <span class="inline-flex items-center gap-1 rounded-md bg-obsidian-950/80 px-2 py-0.5 text-mint-300">
                                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                {{ $project->views_count }}
                                            </span>
                                        @endif
                                    </div>
                                </button>

                                {{-- Card Body --}}
                                <div class="flex flex-1 flex-col justify-between p-5">
                                    <div>
                                        <h3 class="font-display text-lg font-semibold text-white group-hover:text-mint-300 transition-colors">
                                            {{ $project->t('title') }}
                                        </h3>
                                        @if ($project->t('description'))
                                            <p class="mt-2 line-clamp-2 text-sm leading-relaxed text-slate-400">
                                                {{ $project->t('description') }}
                                            </p>
                                        @endif
                                    </div>

                                    <div class="mt-4 flex items-center justify-between border-t border-white/[0.06] pt-3.5">
                                        <span class="font-mono text-[11px] text-slate-400 truncate max-w-[70%]">
                                            {{ $project->camera_spec ?: '4K · Mobile Cinema' }}
                                        </span>
                                        <button
                                            type="button"
                                            @click='openProject(@json($payload))'
                                            class="font-mono text-xs font-semibold text-mint-400 hover:text-mint-300 transition"
                                        >
                                            {{ __('projects.watch') }} &rarr;
                                        </button>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- 03 / SERVICES & DIRECTIONS --}}
            <section id="services" class="py-24 border-t border-white/[0.05]">
                <div class="mx-auto max-w-6xl px-8">
                    <div class="reveal-item max-w-2xl">
                        <p class="font-mono text-xs font-semibold uppercase tracking-[0.18em] text-mint-400">
                            {{ __('services.eyebrow') }}
                        </p>
                        <h2 class="mt-2 font-display text-4xl font-bold tracking-tight text-white">
                            {{ __('services.heading') }}
                        </h2>
                        <p class="mt-3 text-base text-slate-400">
                            {{ __('services.subtitle') }}
                        </p>
                    </div>

                    <div class="mt-12 grid grid-cols-3 gap-6">
                        @foreach ($services as $service)
                            <div class="reveal-item relative flex flex-col justify-between rounded-2xl p-7 transition {{ $service->is_popular ? 'bg-gradient-to-b from-mint-400/[0.11] via-obsidian-800 to-obsidian-900 border border-mint-400/45 shadow-mint-soft' : 'studio-card' }}">
                                @if ($service->is_popular)
                                    <span class="absolute -top-3 right-6 rounded-full bg-mint-400 px-3 py-1 font-mono text-[11px] font-bold uppercase tracking-wider text-obsidian-950">
                                        {{ __('services.popular') }}
                                    </span>
                                @endif

                                <div>
                                    <div>
                                        <h3 class="font-display text-xl font-bold text-white">{{ $service->t('title') }}</h3>
                                    </div>

                                    @if ($service->t('description'))
                                        <p class="mt-3 text-sm leading-relaxed text-slate-400">
                                            {{ $service->t('description') }}
                                        </p>
                                    @endif

                                    @if (count($service->featuresList()))
                                        <ul class="mt-6 space-y-3 border-t border-white/[0.07] pt-6 text-sm text-slate-300">
                                            @foreach ($service->featuresList() as $feature)
                                                <li class="flex items-start gap-2.5">
                                                    <svg class="mt-0.5 h-4 w-4 shrink-0 text-mint-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.4" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    <span>{{ $feature }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>

                                <button
                                    type="button"
                                    @click="selectService(@js($service->t('title')))"
                                    class="mt-8 w-full rounded-xl py-3 text-sm font-semibold transition {{ $service->is_popular ? 'btn-mint' : 'btn-ghost' }}"
                                >
                                    {{ __('services.order_btn') }}
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- 04 / EXPERIENCE TIMELINE --}}
            <section id="experience" class="py-24 border-t border-white/[0.05]">
                <div class="mx-auto max-w-6xl px-8">
                    <div class="reveal-item max-w-2xl">
                        <p class="font-mono text-xs font-semibold uppercase tracking-[0.18em] text-mint-400">
                            {{ __('experience.eyebrow') }}
                        </p>
                        <h2 class="mt-2 font-display text-4xl font-bold tracking-tight text-white">
                            {{ __('experience.heading') }}
                        </h2>
                    </div>

                    <div class="mt-12 relative border-l border-white/10 pl-10 space-y-8">
                        @foreach ($experiences as $exp)
                            <div class="reveal-item relative">
                                <span class="absolute -left-[47px] top-6 flex h-3.5 w-3.5 items-center justify-center rounded-full bg-obsidian-950 ring-2 ring-mint-400">
                                    <span class="h-1.5 w-1.5 rounded-full bg-mint-400"></span>
                                </span>

                                <div class="studio-card rounded-2xl p-7">
                                    <div class="flex flex-wrap items-center justify-between gap-2">
                                        <div>
                                            <h3 class="font-display text-xl font-bold text-white">{{ $exp->t('role') }}</h3>
                                            <p class="mt-0.5 text-sm font-medium text-mint-400">{{ $exp->company }}</p>
                                        </div>
                                        <span class="rounded-lg border border-white/10 bg-obsidian-950/80 px-3 py-1 font-mono text-xs text-slate-300">
                                            {{ $exp->period }}
                                        </span>
                                    </div>
                                    @if ($exp->t('description'))
                                        <p class="mt-4 text-base leading-relaxed text-slate-400">
                                            {{ $exp->t('description') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- 05 / CONTACT SECTION --}}
            <section id="contact" class="py-24 border-t border-white/[0.05]">
                <div class="mx-auto max-w-6xl px-8">
                    <div class="grid grid-cols-12 gap-10">
                        {{-- Left Contact Details --}}
                        <div class="reveal-item col-span-5 flex flex-col justify-between gap-8">
                            <div>
                                <p class="font-mono text-xs font-semibold uppercase tracking-[0.18em] text-mint-400">
                                    {{ __('contact.eyebrow') }}
                                </p>
                                <h2 class="mt-2 font-display text-4xl font-bold tracking-tight text-white">
                                    {{ __('contact.heading') }}
                                </h2>
                                <p class="mt-4 text-base leading-relaxed text-slate-400">
                                    {{ __('contact.subtitle') }}
                                </p>

                                <div class="mt-8 space-y-3">
                                    @if ($setting->phone)
                                        <a href="tel:{{ preg_replace('/[^+\d]/', '', $setting->phone) }}" class="studio-card flex items-center justify-between rounded-xl px-4 py-3.5 text-sm">
                                            <span class="text-slate-400 font-mono text-xs uppercase">Tel</span>
                                            <span class="font-medium text-white">{{ $setting->phone }}</span>
                                        </a>
                                    @endif

                                    @if ($setting->telegram)
                                        <a href="{{ $setting->telegram }}" target="_blank" rel="noopener" class="studio-card flex items-center justify-between rounded-xl px-4 py-3.5 text-sm">
                                            <span class="text-slate-400 font-mono text-xs uppercase">Telegram</span>
                                            <span class="font-medium text-mint-400">{{ str_replace(['https://t.me/', 'http://t.me/'], '@', rtrim($setting->telegram, '/')) }} &nearr;</span>
                                        </a>
                                    @endif

                                    @if ($setting->telegram_channel)
                                        <a href="{{ $setting->telegram_channel }}" target="_blank" rel="noopener" class="studio-card flex items-center justify-between rounded-xl px-4 py-3.5 text-sm">
                                            <span class="text-slate-400 font-mono text-xs uppercase">Telegram Kanal</span>
                                            <span class="font-medium text-mint-400">{{ str_replace(['https://t.me/', 'http://t.me/'], '@', rtrim($setting->telegram_channel, '/')) }} &nearr;</span>
                                        </a>
                                    @endif

                                    @if ($setting->instagram)
                                        <a href="{{ $setting->instagram }}" target="_blank" rel="noopener" class="studio-card flex items-center justify-between rounded-xl px-4 py-3.5 text-sm">
                                            <span class="text-slate-400 font-mono text-xs uppercase">Instagram</span>
                                            <span class="font-medium text-white">{{ str_replace(['https://instagram.com/', 'https://www.instagram.com/'], '@', rtrim(strtok($setting->instagram, '?'), '/')) }} &nearr;</span>
                                        </a>
                                    @endif

                                    @if ($setting->t('location'))
                                        <div class="studio-card flex items-center justify-between rounded-xl px-4 py-3.5 text-sm">
                                            <span class="text-slate-400 font-mono text-xs uppercase">{{ __('contact.location') }}</span>
                                            <span class="text-slate-200">{{ $setting->t('location') }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Right Contact Form --}}
                        <div class="reveal-item col-span-7">
                            <div class="studio-card rounded-2xl p-8">
                                @if (session('contact_success'))
                                    <div class="mb-6 flex items-center gap-3 rounded-xl border border-mint-400/40 bg-mint-400/10 px-4 py-3.5 text-sm text-mint-300" role="status">
                                        <svg class="h-5 w-5 shrink-0 text-mint-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>{{ session('contact_success') }}</span>
                                    </div>
                                @endif

                                <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                                    @csrf
                                    <div class="grid grid-cols-2 gap-5">
                                        <div>
                                            <label for="contact-name" class="block text-xs font-medium uppercase tracking-wider text-slate-400 mb-2">
                                                {{ __('contact.form_name') }} *
                                            </label>
                                            <input
                                                id="contact-name"
                                                type="text"
                                                name="name"
                                                value="{{ old('name') }}"
                                                autocomplete="name"
                                                required
                                                class="studio-input w-full px-4 py-3 text-sm"
                                            >
                                            @error('name') <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p> @enderror
                                        </div>

                                        <div>
                                            <label for="contact-phone" class="block text-xs font-medium uppercase tracking-wider text-slate-400 mb-2">
                                                {{ __('contact.form_contact') }} *
                                            </label>
                                            <input
                                                id="contact-phone"
                                                type="text"
                                                name="contact"
                                                value="{{ old('contact') }}"
                                                autocomplete="tel"
                                                required
                                                class="studio-input w-full px-4 py-3 text-sm"
                                            >
                                            @error('contact') <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                    <div>
                                        <label for="contact-service" class="block text-xs font-medium uppercase tracking-wider text-slate-400 mb-2">
                                            {{ __('contact.form_service') }}
                                        </label>
                                        <select
                                            id="contact-service"
                                            name="service_type"
                                            x-model="selectedService"
                                            class="studio-input w-full px-4 py-3 text-sm"
                                        >
                                            <option value="">{{ __('contact.form_service_ph') }}</option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->t('title') }}">{{ $service->t('title') }}</option>
                                            @endforeach
                                            <option value="{{ __('contact.form_service_other') }}">{{ __('contact.form_service_other') }}</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="contact-message" class="block text-xs font-medium uppercase tracking-wider text-slate-400 mb-2">
                                            {{ __('contact.form_message') }} *
                                        </label>
                                        <textarea
                                            id="contact-message"
                                            name="message"
                                            rows="4"
                                            required
                                            class="studio-input w-full px-4 py-3 text-sm"
                                        >{{ old('message') }}</textarea>
                                        @error('message') <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p> @enderror
                                    </div>

                                    <button type="submit" class="btn-mint inline-flex items-center justify-center gap-2 rounded-xl px-7 py-3.5 text-sm">
                                        <span>{{ __('contact.form_submit') }}</span>
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        {{-- FOOTER with Key Logo Slot #4 --}}
        <footer class="border-t border-white/[0.06] bg-obsidian-950/90 py-20">
            <div class="mx-auto flex max-w-6xl items-center justify-between gap-8 px-8">
                <div class="flex flex-col items-start gap-3">
                    <x-brand-logo :setting="$setting" variant="footer" />
                    <p class="font-mono text-base text-slate-500">{{ __('footer.crafted') }}</p>
                </div>

                <div class="flex items-center gap-7 text-base text-slate-400">
                    @if ($setting->instagram)
                        <a href="{{ $setting->instagram }}" target="_blank" rel="noopener" class="hover:text-mint-400 transition">Instagram</a>
                    @endif
                    @if ($setting->telegram)
                        <a href="{{ $setting->telegram }}" target="_blank" rel="noopener" class="hover:text-mint-400 transition">Telegram</a>
                    @endif
                    @if ($setting->telegram_channel)
                        <a href="{{ $setting->telegram_channel }}" target="_blank" rel="noopener" class="hover:text-mint-400 transition">Telegram Kanal</a>
                    @endif
                    @if ($setting->youtube)
                        <a href="{{ $setting->youtube }}" target="_blank" rel="noopener" class="hover:text-mint-400 transition">YouTube</a>
                    @endif
                    <a href="{{ route('dashboard') }}" class="text-slate-600 hover:text-mint-400 transition font-mono">Admin</a>
                </div>

                <p class="text-base text-slate-500">
                    &copy; {{ date('Y') }} {{ $setting->brand_name }}. {{ __('footer.rights') }}
                </p>
            </div>
        </footer>
    </div>

    {{-- Instant 1-to-1 Proportional Scale Engine (Desktop >= 1180px untouched; Mobile/Narrow = exact mini desktop) --}}
    <script>
        (function () {
            const DESKTOP_BREAKPOINT = 1180;
            const MOBILE_BASE_WIDTH = 1080;
            const root = document.getElementById('site-scale-root');
            const hero = document.getElementById('hero-section');
            const header = root ? root.querySelector('header') : null;
            if (!root) return;

            function applyScale() {
                const vw = document.documentElement.clientWidth || window.innerWidth;
                const vh = window.innerHeight || document.documentElement.clientHeight;
                if (vw < DESKTOP_BREAKPOINT) {
                    const base = vw < 768 ? MOBILE_BASE_WIDTH : DESKTOP_BREAKPOINT;
                    const scale = vw / base;
                    root.style.width = base + 'px';
                    root.style.zoom = scale.toFixed(5);
                    root.classList.add('is-mobile-scaled');
                    if (hero && vw < 768 && vh > vw) {
                        // Portrait phone: Hero fills ~48-50% of screen tightly with zero empty sky gap
                        const headerH = header ? header.offsetHeight : 96;
                        const targetUnscaled = Math.round((vh * 0.48) / scale) - headerH;
                        hero.style.minHeight = Math.max(840, Math.min(targetUnscaled, 940)) + 'px';
                    } else if (hero) {
                        hero.style.minHeight = '';
                    }
                } else {
                    root.style.width = '';
                    root.style.zoom = '';
                    root.classList.remove('is-mobile-scaled');
                    if (hero) hero.style.minHeight = '';
                }
            }

            applyScale();
            window.addEventListener('resize', applyScale, { passive: true });
            window.addEventListener('orientationchange', applyScale, { passive: true });
        })();
    </script>

    {{-- Native <dialog> Modal for Project / Showreel Preview (modern-web-guidance compliant) --}}
    <dialog
        id="project-modal"
        closedby="any"
        aria-labelledby="modal-project-title"
        @close="activeProject = null"
        class="w-full"
    >
        <div class="rounded-2xl border border-white/10 bg-obsidian-900 shadow-2xl overflow-hidden">
            <div class="flex items-center justify-between gap-4 border-b border-white/[0.08] px-5 py-4">
                <div>
                    <h2 id="modal-project-title" class="font-display text-lg font-bold text-white" x-text="activeProject?.title || ''"></h2>
                    <p class="font-mono text-xs text-mint-400" x-text="[activeProject?.client, activeProject?.camera].filter(Boolean).join(' · ')"></p>
                </div>
                <form method="dialog">
                    <button
                        type="submit"
                        autofocus
                        aria-label="{{ __('modal.close') }}"
                        class="flex h-9 w-9 items-center justify-center rounded-xl border border-white/10 bg-obsidian-950 text-slate-300 hover:border-mint-400/50 hover:text-white transition"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </form>
            </div>

            <div class="p-6 space-y-5">
                {{-- Video Player Area --}}
                <template x-if="activeProject?.embedUrl">
                    <div class="aspect-video w-full overflow-hidden rounded-xl bg-black border border-white/10">
                        <iframe
                            :src="activeProject.embedUrl"
                            class="h-full w-full"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                        ></iframe>
                    </div>
                </template>

                <template x-if="!activeProject?.embedUrl && activeProject?.isDirectVideo">
                    <video
                        controls
                        :src="activeProject.videoUrl"
                        :poster="activeProject.thumbnail || ''"
                        class="w-full max-h-[60vh] rounded-xl bg-black border border-white/10"
                    ></video>
                </template>

                <template x-if="!activeProject?.embedUrl && !activeProject?.isDirectVideo">
                    <div class="rounded-xl border border-dashed border-white/15 bg-obsidian-950/80 p-8 text-center">
                        <template x-if="activeProject?.videoUrl">
                            <div>
                                <p class="text-sm text-slate-300 mb-4" x-text="activeProject.description"></p>
                                <a
                                    :href="activeProject.videoUrl"
                                    target="_blank"
                                    rel="noopener"
                                    class="btn-mint inline-flex items-center gap-2 rounded-xl px-5 py-2.5 text-sm"
                                >
                                    {{ __('projects.open_external') }} &nearr;
                                </a>
                            </div>
                        </template>
                        <template x-if="!activeProject?.videoUrl">
                            <p class="text-sm text-slate-400 max-w-md mx-auto">
                                {{ __('modal.no_video') }}
                            </p>
                        </template>
                    </div>
                </template>

                {{-- Details & Meta --}}
                <div x-show="activeProject?.description" class="text-sm leading-relaxed text-slate-300" x-text="activeProject?.description"></div>

                <div class="grid grid-cols-4 gap-3 font-mono text-xs">
                    <div x-show="activeProject?.client" class="rounded-xl bg-obsidian-950/80 border border-white/[0.06] p-3">
                        <div class="text-slate-500 uppercase text-[10px]">{{ __('projects.client') }}</div>
                        <div class="mt-1 text-white" x-text="activeProject?.client"></div>
                    </div>
                    <div x-show="activeProject?.views" class="rounded-xl bg-obsidian-950/80 border border-white/[0.06] p-3">
                        <div class="text-slate-500 uppercase text-[10px]">{{ __('projects.views') }}</div>
                        <div class="mt-1 text-mint-400" x-text="activeProject?.views"></div>
                    </div>
                    <div x-show="activeProject?.duration" class="rounded-xl bg-obsidian-950/80 border border-white/[0.06] p-3">
                        <div class="text-slate-500 uppercase text-[10px]">{{ __('projects.duration') }}</div>
                        <div class="mt-1 text-white" x-text="activeProject?.duration"></div>
                    </div>
                    <div x-show="activeProject?.camera" class="rounded-xl bg-obsidian-950/80 border border-white/[0.06] p-3">
                        <div class="text-slate-500 uppercase text-[10px]">{{ __('projects.camera') }}</div>
                        <div class="mt-1 text-white truncate" x-text="activeProject?.camera"></div>
                    </div>
                </div>
            </div>
        </div>
    </dialog>

    <script>
        function portfolioApp() {
            const showreelUrl = @js($setting->showreel_url);
            const parseEmbed = (url) => {
                if (!url) return null;
                let m = url.match(/(?:youtube\.com\/(?:watch\?v=|shorts\/|embed\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/);
                if (m) return `https://www.youtube.com/embed/${m[1]}?rel=0&modestbranding=1`;
                m = url.match(/vimeo\.com\/(?:video\/)?(\d+)/);
                if (m) return `https://player.vimeo.com/video/${m[1]}`;
                return null;
            };

            return {
                activeCategory: 'all',
                selectedService: @js(old('service_type', '')),
                activeProject: null,

                openProject(project) {
                    this.activeProject = project;
                    const dialog = document.getElementById('project-modal');
                    if (dialog && !dialog.open) {
                        dialog.showModal();
                    }
                },

                openShowreel() {
                    this.openProject({
                        title: @js($setting->brand_name . ' — Showreel'),
                        description: @js($setting->t('hero_bio')),
                        client: 'Showreel ' + new Date().getFullYear(),
                        camera: '4K · 60fps · Mobile Cinema',
                        videoUrl: showreelUrl,
                        embedUrl: parseEmbed(showreelUrl),
                        isDirectVideo: !!(showreelUrl && /\.(mp4|webm|mov)(\?.*)?$/i.test(showreelUrl)),
                        thumbnail: @js($setting->heroImageUrl()),
                    });
                },

                selectService(serviceTitle) {
                    this.selectedService = serviceTitle;
                    const el = document.getElementById('contact');
                    if (el) el.scrollIntoView({ behavior: 'smooth' });
                }
            };
        }
    </script>
</body>
</html>
