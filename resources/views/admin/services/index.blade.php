@extends('layouts.admin')

@section('title', 'Xizmat paketlari')

@section('actions')
    <a href="{{ route('admin.services.create') }}" class="btn-mint rounded-xl px-3.5 py-2 sm:px-6 sm:py-3 text-xs sm:text-base font-semibold whitespace-nowrap">
        + Paket qo'shish
    </a>
@endsection

@section('content')
    <div class="grid grid-cols-2 gap-3 sm:gap-5 lg:gap-7 min-w-0 items-stretch">
        @forelse ($services as $service)
            @php
                $features = $service->featuresList();
            @endphp
            <div class="studio-card flex flex-col justify-between rounded-xl lg:rounded-2xl p-3.5 sm:p-5 lg:p-7 min-w-0 {{ $service->is_popular ? 'border-mint-400/45' : '' }}">
                <div class="min-w-0">
                    <div class="flex flex-wrap items-start justify-between gap-1.5 lg:gap-3">
                        <h2 class="font-display text-xs sm:text-base lg:text-xl font-bold text-white leading-snug line-clamp-2">{{ $service->title_uz }}</h2>
                        @if ($service->is_popular)
                            <span class="shrink-0 rounded-full bg-mint-400 px-2 py-0.5 lg:px-3 lg:py-1 font-mono text-[9px] lg:text-xs font-bold uppercase text-obsidian-950">Asosiy</span>
                        @endif
                    </div>

                    @if ($service->description_uz)
                        <p class="mt-2 lg:mt-3 text-[11px] sm:text-sm lg:text-base leading-snug lg:leading-relaxed text-slate-400 line-clamp-2">
                            {{ $service->description_uz }}
                        </p>
                    @endif

                    @if (count($features))
                        <ul class="mt-3 lg:mt-5 space-y-1.5 lg:space-y-2.5 border-t border-white/[0.07] pt-3 lg:pt-5 text-[10px] sm:text-xs lg:text-sm text-slate-300">
                            @foreach ($features as $idx => $feature)
                                <li class="flex items-center gap-1.5 lg:gap-2.5 min-w-0 {{ $idx >= 3 ? 'hidden lg:flex' : '' }}">
                                    <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-mint-400"></span>
                                    <span class="truncate">{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>
                        @if (count($features) > 3)
                            <p class="mt-1.5 lg:hidden font-mono text-[10px] text-mint-400/80">+{{ count($features) - 3 }} band</p>
                        @endif
                    @endif
                </div>

                <div class="mt-4 lg:mt-6 flex items-center justify-between gap-1.5 lg:gap-4 border-t border-white/[0.07] pt-3 lg:pt-5">
                    <a href="{{ route('admin.services.edit', $service) }}" class="rounded-lg lg:rounded-xl border border-mint-400/35 bg-mint-400/10 px-2 py-1 lg:px-5 lg:py-2.5 font-mono text-[10px] lg:text-sm font-semibold text-mint-300 hover:bg-mint-400/20 transition whitespace-nowrap">
                        Tahrirlash
                    </a>
                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Xizmat paketini o\'chirmoqchimisiz?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-lg lg:rounded-xl border border-rose-500/35 bg-rose-500/10 px-2 py-1 lg:px-5 lg:py-2.5 font-mono text-[10px] lg:text-sm font-semibold text-rose-400 hover:bg-rose-500/20 transition whitespace-nowrap">
                            O'chirish
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-2 studio-card rounded-2xl p-12 lg:p-16 text-center text-sm lg:text-lg text-slate-400 min-h-[55vh] flex items-center justify-center">
                Xizmat paketlari hali qo'shilmagan.
            </div>
        @endforelse
    </div>
@endsection
