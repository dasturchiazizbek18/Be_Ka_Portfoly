@extends('layouts.admin')

@section('title', 'Loyihalar / Video ishlar')

@section('actions')
    <a href="{{ route('admin.projects.create') }}" class="btn-mint rounded-xl px-3.5 py-2 sm:px-6 sm:py-3 text-xs sm:text-base font-semibold whitespace-nowrap">
        + Loyiha qo'shish
    </a>
@endsection

@section('content')
    <div class="grid grid-cols-2 gap-3 sm:gap-5 lg:gap-7 min-w-0">
        @forelse ($projects as $project)
            <div class="studio-card flex flex-col justify-between overflow-hidden rounded-xl lg:rounded-2xl min-w-0">
                <div class="relative aspect-[4/3] lg:aspect-[16/10] bg-obsidian-950 border-b border-white/[0.06] overflow-hidden">
                    @if ($project->thumbnailUrl())
                        <img src="{{ $project->thumbnailUrl() }}" alt="{{ $project->title_uz }}" class="h-full w-full object-cover">
                    @else
                        <div class="viewfinder-grid h-full w-full flex items-center justify-center font-mono text-[10px] lg:text-sm text-mint-400/80">
                            {{ $project->aspect_ratio === 'vertical' ? '9:16 REELS' : '16:9 CINEMA' }}
                        </div>
                    @endif
                    <span class="absolute top-2 left-2 lg:top-4 lg:left-4 rounded lg:rounded-lg bg-obsidian-950/85 border border-white/10 px-1.5 py-0.5 lg:px-3 lg:py-1 font-mono text-[9px] lg:text-xs uppercase text-mint-400">
                        {{ $project->category }}
                    </span>
                    @if ($project->duration)
                        <span class="absolute top-2 right-2 lg:top-4 lg:right-4 rounded lg:rounded-lg bg-obsidian-950/85 border border-white/10 px-1.5 py-0.5 lg:px-3 lg:py-1 font-mono text-[9px] lg:text-xs text-slate-200">
                            {{ $project->duration }}
                        </span>
                    @endif
                </div>

                <div class="p-3 sm:p-4 lg:p-6 flex-1 flex flex-col justify-between gap-3 lg:gap-5 min-w-0">
                    <div class="min-w-0">
                        <h2 class="font-display text-xs sm:text-sm lg:text-xl font-bold text-white leading-snug line-clamp-2">{{ $project->title_uz }}</h2>
                        <p class="mt-1 lg:mt-2 font-mono text-[10px] lg:text-sm text-slate-400 truncate">
                            {{ $project->client_name ?: 'Shaxsiy' }} · {{ $project->year }} @if($project->views_count) · {{ $project->views_count }} @endif
                        </p>
                        @if ($project->description_uz)
                            <p class="mt-1.5 lg:mt-3 hidden sm:block text-xs lg:text-base text-slate-300 line-clamp-2 leading-relaxed">{{ $project->description_uz }}</p>
                        @endif
                    </div>

                    <div class="flex items-center justify-between gap-1.5 lg:gap-4 border-t border-white/[0.07] pt-2.5 lg:pt-4">
                        <a href="{{ route('admin.projects.edit', $project) }}" class="rounded-lg lg:rounded-xl border border-mint-400/35 bg-mint-400/10 px-2 py-1 lg:px-5 lg:py-2.5 font-mono text-[10px] lg:text-sm font-semibold text-mint-300 hover:bg-mint-400/20 transition whitespace-nowrap">
                            Tahrirlash
                        </a>
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Loyihani o\'chirmoqchimisiz?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-lg lg:rounded-xl border border-rose-500/35 bg-rose-500/10 px-2 py-1 lg:px-5 lg:py-2.5 font-mono text-[10px] lg:text-sm font-semibold text-rose-400 hover:bg-rose-500/20 transition whitespace-nowrap">
                                O'chirish
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-2 studio-card rounded-2xl p-12 lg:p-16 text-center text-sm lg:text-lg text-slate-400 min-h-[55vh] flex items-center justify-center">
                Hali loyiha qo'shilmagan. Yuqoridagi tugma orqali birinchi videongizni qo'shing!
            </div>
        @endforelse
    </div>
@endsection
