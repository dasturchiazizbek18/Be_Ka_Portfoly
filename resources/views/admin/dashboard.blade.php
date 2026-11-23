@extends('layouts.admin')

@section('title', 'Boshqaruv paneli')

@section('actions')
    <a href="{{ route('admin.projects.create') }}" class="btn-mint rounded-xl px-3.5 py-2 sm:px-5 sm:py-3 text-xs sm:text-sm lg:text-base font-semibold whitespace-nowrap">
        + Yangi loyiha
    </a>
@endsection

@section('content')
    <div class="flex-1 flex flex-col gap-4 lg:gap-8 min-w-0 w-full max-w-full">
        {{-- Mobile Compact Brand Header Strip (iPhone 15 Pro clean app-card feel) --}}
        <div class="lg:hidden studio-card rounded-2xl p-4 flex items-center justify-between gap-3">
            <div class="flex items-center gap-3 min-w-0">
                @if ($setting->resolvedLogoMarkUrl())
                    <img src="{{ $setting->resolvedLogoMarkUrl() }}" alt="{{ $setting->brand_name }}" class="h-11 w-11 shrink-0 object-contain drop-shadow-[0_0_10px_rgba(94,240,200,0.3)]">
                @else
                    <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-mint-400/15 border border-mint-400/35 font-display text-sm font-bold text-mint-400">EB</span>
                @endif
                <div class="min-w-0">
                    <div class="truncate font-display text-base font-bold text-white">{{ $setting->brand_name }}</div>
                    <div class="truncate font-mono text-[11px] uppercase tracking-wider text-mint-400">{{ $setting->t('role_title') }} · LIVE</div>
                </div>
            </div>
            <a href="{{ route('home') }}" target="_blank" class="shrink-0 rounded-xl border border-white/10 bg-obsidian-950/80 px-3 py-2 font-mono text-xs text-slate-200 hover:border-mint-400/40">
                Sayt &nearr;
            </a>
        </div>

        {{-- Stat Cards (Crisp symmetrical 2x2 on iPhone 15 Pro, 4-col on Desktop) --}}
        <div class="grid grid-cols-2 gap-3 lg:grid-cols-4 lg:gap-6">
            <a href="{{ route('admin.projects.index') }}" class="studio-card rounded-2xl p-4 lg:p-7 flex flex-col justify-between min-h-[108px] lg:min-h-[155px]">
                <div class="flex items-center justify-between gap-2">
                    <span class="font-mono text-[11px] lg:text-sm uppercase tracking-wider text-slate-400 truncate">Loyihalar</span>
                    <span class="h-2 w-2 shrink-0 rounded-full bg-mint-400/70"></span>
                </div>
                <div class="mt-2 font-display text-3xl lg:text-5xl font-bold text-white leading-none">{{ $stats['projects'] }}</div>
                <div class="mt-3 font-mono text-[11px] lg:text-xs text-mint-400/90">Boshqarish &rarr;</div>
            </a>

            <a href="{{ route('admin.services.index') }}" class="studio-card rounded-2xl p-4 lg:p-7 flex flex-col justify-between min-h-[108px] lg:min-h-[155px]">
                <div class="flex items-center justify-between gap-2">
                    <span class="font-mono text-[11px] lg:text-sm uppercase tracking-wider text-slate-400 truncate">Xizmatlar</span>
                    <span class="h-2 w-2 shrink-0 rounded-full bg-mint-400/70"></span>
                </div>
                <div class="mt-2 font-display text-3xl lg:text-5xl font-bold text-white leading-none">{{ $stats['services'] }}</div>
                <div class="mt-3 font-mono text-[11px] lg:text-xs text-mint-400/90">Boshqarish &rarr;</div>
            </a>

            <a href="{{ route('admin.skills.index') }}" class="studio-card rounded-2xl p-4 lg:p-7 flex flex-col justify-between min-h-[108px] lg:min-h-[155px]">
                <div class="flex items-center justify-between gap-2">
                    <span class="font-mono text-[11px] lg:text-sm uppercase tracking-wider text-slate-400 truncate">Ko'nikmalar</span>
                    <span class="h-2 w-2 shrink-0 rounded-full bg-mint-400/70"></span>
                </div>
                <div class="mt-2 font-display text-3xl lg:text-5xl font-bold text-white leading-none">{{ $stats['skills'] }}</div>
                <div class="mt-3 font-mono text-[11px] lg:text-xs text-mint-400/90">Boshqarish &rarr;</div>
            </a>

            <a href="{{ route('admin.messages.index') }}" class="studio-card rounded-2xl p-4 lg:p-7 flex flex-col justify-between min-h-[108px] lg:min-h-[155px]">
                <div class="flex items-center justify-between gap-2">
                    <span class="font-mono text-[11px] lg:text-sm uppercase tracking-wider text-slate-400 truncate">Xabarlar</span>
                    <span class="h-2 w-2 shrink-0 rounded-full {{ $stats['unread_messages'] > 0 ? 'bg-mint-400 animate-pulse' : 'bg-slate-600' }}"></span>
                </div>
                <div class="mt-2 font-display text-3xl lg:text-5xl font-bold text-mint-400 leading-none">
                    {{ $stats['unread_messages'] }}
                    <span class="text-base lg:text-xl font-normal text-slate-500">/ {{ $stats['total_messages'] }}</span>
                </div>
                <div class="mt-3 font-mono text-[11px] lg:text-xs text-mint-400/90">Ko'rish &rarr;</div>
            </a>
        </div>

        {{-- Mobile Quick Actions (Right under stats on iPhone 15 Pro for instant thumb reach!) --}}
        <div class="lg:hidden studio-card rounded-2xl p-4">
            <div class="flex items-center justify-between mb-3">
                <h2 class="font-display text-base font-bold text-white">Tezkor amallar</h2>
                <span class="font-mono text-[10px] uppercase tracking-wider text-mint-400">QUICK</span>
            </div>
            <div class="grid grid-cols-2 gap-2.5">
                <a href="{{ route('admin.projects.create') }}" class="flex items-center gap-2.5 rounded-xl border border-white/[0.08] bg-obsidian-950/80 px-3.5 py-3 active:scale-[0.98] transition">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-mint-400/15 text-mint-400 font-bold text-sm">+</span>
                    <span class="text-xs font-semibold text-white truncate">Yangi loyiha</span>
                </a>
                <a href="{{ route('admin.services.create') }}" class="flex items-center gap-2.5 rounded-xl border border-white/[0.08] bg-obsidian-950/80 px-3.5 py-3 active:scale-[0.98] transition">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-mint-400/15 text-mint-400 font-bold text-sm">+</span>
                    <span class="text-xs font-semibold text-white truncate">Xizmat</span>
                </a>
                <a href="{{ route('admin.experiences.create') }}" class="flex items-center gap-2.5 rounded-xl border border-white/[0.08] bg-obsidian-950/80 px-3.5 py-3 active:scale-[0.98] transition">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-mint-400/15 text-mint-400 font-bold text-sm">+</span>
                    <span class="text-xs font-semibold text-white truncate">Tajriba</span>
                </a>
                <a href="{{ route('admin.settings.edit') }}" class="flex items-center gap-2.5 rounded-xl border border-white/[0.08] bg-obsidian-950/80 px-3.5 py-3 active:scale-[0.98] transition">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-mint-400/15 text-mint-400 font-mono text-xs font-bold">EB</span>
                    <span class="text-xs font-semibold text-white truncate">Sozlamalar</span>
                </a>
            </div>
        </div>

        {{-- Main Panels: Recent Messages & Recent Video Projects --}}
        <div class="grid gap-4 lg:gap-6 lg:grid-cols-2 flex-1 min-w-0">
            {{-- Recent Messages --}}
            <div class="studio-card rounded-2xl p-4 sm:p-6 lg:p-8 flex flex-col justify-between lg:min-h-[380px] min-w-0 overflow-hidden">
                <div class="flex-1 flex flex-col">
                    <div class="flex items-center justify-between gap-2 mb-3.5 lg:mb-6">
                        <h2 class="font-display text-base lg:text-xl font-bold text-white">Oxirgi xabarlar</h2>
                        <a href="{{ route('admin.messages.index') }}" class="font-mono text-xs lg:text-sm text-mint-400 hover:underline shrink-0">Barchasi &rarr;</a>
                    </div>

                    @forelse ($recentMessages as $msg)
                        <div class="border-t border-white/[0.07] py-3 first:border-t-0 first:pt-0">
                            <div class="flex items-center justify-between gap-2">
                                <span class="font-semibold text-sm lg:text-base text-white flex items-center gap-2 min-w-0">
                                    @if (! $msg->is_read)
                                        <span class="h-2 w-2 shrink-0 rounded-full bg-mint-400"></span>
                                    @endif
                                    <span class="truncate">{{ $msg->name }}</span>
                                </span>
                                <span class="font-mono text-[11px] lg:text-xs text-slate-500 shrink-0">{{ $msg->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="mt-1 text-xs lg:text-sm text-mint-400/90 font-mono truncate">{{ $msg->contact }} @if($msg->service_type) · {{ $msg->service_type }} @endif</p>
                            <p class="mt-1 text-xs lg:text-sm text-slate-400 line-clamp-2">{{ $msg->message }}</p>
                        </div>
                    @empty
                        <div class="flex-1 flex items-center lg:flex-col lg:justify-center gap-3.5 lg:text-center rounded-xl border border-white/[0.05] bg-obsidian-950/50 p-4 lg:border-0 lg:bg-transparent lg:py-10">
                            <div class="flex h-11 w-11 lg:h-14 lg:w-14 shrink-0 items-center justify-center rounded-xl lg:rounded-2xl border border-white/10 bg-obsidian-950/80 text-slate-400">
                                <svg class="h-5 w-5 lg:h-6 lg:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm lg:text-base font-semibold text-slate-200">Hozircha xabarlar yo'q</p>
                                <p class="mt-0.5 text-xs lg:text-sm text-slate-500">Aloqa formasidan kelgan xabarlar shu yerda chiqadi.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Recent Projects --}}
            <div class="studio-card rounded-2xl p-4 sm:p-6 lg:p-8 flex flex-col justify-between lg:min-h-[380px] min-w-0 overflow-hidden">
                <div class="min-w-0">
                    <div class="flex items-center justify-between gap-2 mb-3.5 lg:mb-6">
                        <h2 class="font-display text-base lg:text-xl font-bold text-white truncate">So'nggi video ishlar</h2>
                        <a href="{{ route('admin.projects.index') }}" class="font-mono text-xs lg:text-sm text-mint-400 hover:underline shrink-0">Barchasi &rarr;</a>
                    </div>
                    <div class="space-y-2.5 lg:space-y-4 min-w-0">
                        @forelse ($recentProjects as $project)
                            <a href="{{ route('admin.projects.edit', $project) }}" class="flex items-center justify-between gap-3 rounded-xl border border-white/[0.07] bg-obsidian-950/75 px-3.5 py-3 lg:px-5 lg:py-4 hover:border-mint-400/35 transition group min-w-0 max-w-full overflow-hidden">
                                <div class="min-w-0 flex-1">
                                    <div class="truncate text-sm lg:text-base font-semibold text-white group-hover:text-mint-300 transition">{{ $project->title_uz }}</div>
                                    <div class="mt-1 flex items-center gap-2 font-mono text-[11px] lg:text-xs text-slate-400 uppercase truncate">
                                        <span class="text-mint-400">{{ $project->aspect_ratio === 'vertical' ? '9:16' : '16:9' }}</span>
                                        <span>·</span>
                                        <span>{{ $project->category }}</span>
                                        @if ($project->views_count)
                                            <span>·</span>
                                            <span>{{ $project->views_count }}</span>
                                        @endif
                                    </div>
                                </div>
                                <span class="shrink-0 rounded-lg border border-mint-400/30 bg-mint-400/10 px-2.5 py-1.5 lg:px-3.5 lg:py-2 font-mono text-[11px] lg:text-xs font-semibold text-mint-300">
                                    Tahrir &rarr;
                                </span>
                            </a>
                        @empty
                            <p class="text-sm lg:text-base text-slate-500">Loyihalar hali qo'shilmagan.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- Desktop Bottom Row: Quick Actions + Brand Identity Card (Preserved 100% for Desktop) --}}
        <div class="hidden lg:grid gap-6 lg:grid-cols-12">
            <div class="studio-card rounded-2xl p-8 lg:col-span-7 flex flex-col justify-between">
                <div>
                    <h2 class="font-display text-xl font-bold text-white">Tezkor boshqaruv</h2>
                    <p class="mt-1 text-sm text-slate-400">Portfolio bo'limlarini bir bosishda yangilang</p>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-4">
                    <a href="{{ route('admin.projects.create') }}" class="rounded-xl border border-white/[0.08] bg-obsidian-950/75 p-5 hover:border-mint-400/40 transition group">
                        <div class="font-mono text-xs uppercase text-mint-400">+ Video</div>
                        <div class="mt-1.5 font-display text-base font-bold text-white group-hover:text-mint-300">Yangi loyiha qo'shish</div>
                    </a>
                    <a href="{{ route('admin.services.create') }}" class="rounded-xl border border-white/[0.08] bg-obsidian-950/75 p-5 hover:border-mint-400/40 transition group">
                        <div class="font-mono text-xs uppercase text-mint-400">+ Yo'nalish</div>
                        <div class="mt-1.5 font-display text-base font-bold text-white group-hover:text-mint-300">Xizmat qo'shish</div>
                    </a>
                    <a href="{{ route('admin.experiences.create') }}" class="rounded-xl border border-white/[0.08] bg-obsidian-950/75 p-5 hover:border-mint-400/40 transition group">
                        <div class="font-mono text-xs uppercase text-mint-400">+ Tajriba</div>
                        <div class="mt-1.5 font-display text-base font-bold text-white group-hover:text-mint-300">Tajriba qo'shish</div>
                    </a>
                    <a href="{{ route('admin.settings.edit') }}" class="rounded-xl border border-white/[0.08] bg-obsidian-950/75 p-5 hover:border-mint-400/40 transition group">
                        <div class="font-mono text-xs uppercase text-mint-400">Sozlamalar</div>
                        <div class="mt-1.5 font-display text-base font-bold text-white group-hover:text-mint-300">Logotip va ijtimoiy tarmoqlar</div>
                    </a>
                </div>
            </div>

            <div class="studio-card rounded-2xl p-8 lg:col-span-5 flex flex-col justify-between gap-5">
                <div class="flex items-center justify-between">
                    <h2 class="font-display text-xl font-bold text-white">Faol brend</h2>
                    <span class="font-mono text-xs text-mint-400">LIVE</span>
                </div>

                <x-brand-logo :setting="$setting" variant="showcase" />

                <div class="flex items-center justify-between gap-3 pt-1">
                    <div class="text-sm text-slate-400 truncate">
                        {{ $setting->brand_name }} · {{ $setting->t('role_title') }}
                    </div>
                    <a href="{{ route('admin.settings.edit') }}" class="shrink-0 font-mono text-xs font-semibold text-mint-400 hover:underline">
                        Tahrirlash &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
