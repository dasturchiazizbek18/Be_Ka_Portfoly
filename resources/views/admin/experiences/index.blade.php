@extends('layouts.admin')

@section('title', 'Tajriba va Hamkorliklar')

@section('actions')
    <a href="{{ route('admin.experiences.create') }}" class="btn-mint rounded-xl px-3.5 py-2 sm:px-6 sm:py-3 text-xs sm:text-base font-semibold whitespace-nowrap">
        + Tajriba qo'shish
    </a>
@endsection

@section('content')
    <div class="grid grid-cols-2 gap-3 sm:gap-5 lg:gap-7 min-w-0 items-stretch">
        @forelse ($experiences as $exp)
            <div class="studio-card flex flex-col justify-between rounded-xl lg:rounded-2xl p-3.5 sm:p-5 lg:p-7 min-w-0">
                <div class="min-w-0">
                    <span class="inline-block rounded lg:rounded-lg border border-white/10 bg-obsidian-950/80 px-2 py-0.5 lg:px-3 lg:py-1 font-mono text-[10px] lg:text-xs text-mint-400">
                        {{ $exp->period }}
                    </span>
                    <h2 class="mt-2.5 lg:mt-3.5 font-display text-xs sm:text-base lg:text-xl font-bold text-white leading-snug">
                        {{ $exp->role_uz }}
                    </h2>
                    <p class="mt-1 font-mono text-[10px] sm:text-xs lg:text-sm text-mint-300">
                        {{ $exp->company }}
                    </p>
                    @if ($exp->description_uz)
                        <p class="mt-2 lg:mt-3 text-[11px] sm:text-sm lg:text-base leading-snug lg:leading-relaxed text-slate-400">
                            {{ $exp->description_uz }}
                        </p>
                    @endif
                </div>

                <div class="mt-4 lg:mt-6 flex items-center justify-between gap-1.5 lg:gap-4 border-t border-white/[0.07] pt-3 lg:pt-5">
                    <a href="{{ route('admin.experiences.edit', $exp) }}" class="rounded-lg lg:rounded-xl border border-mint-400/35 bg-mint-400/10 px-2 py-1 lg:px-5 lg:py-2.5 font-mono text-[10px] lg:text-sm font-semibold text-mint-300 hover:bg-mint-400/20 transition whitespace-nowrap">
                        Tahrirlash
                    </a>
                    <form action="{{ route('admin.experiences.destroy', $exp) }}" method="POST" onsubmit="return confirm('O\'chirmoqchimisiz?')">
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
                Tajriba yozuvlari hali qo'shilmagan.
            </div>
        @endforelse
    </div>
@endsection
