@extends('layouts.admin')

@section('title', 'Kelgan xabarlar')

@section('content')
    <div class="flex-1 flex flex-col gap-6">
        @forelse ($messages as $msg)
            <div class="studio-card rounded-2xl p-7 sm:p-8 {{ ! $msg->is_read ? 'border-mint-400/45' : '' }}">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <div class="flex flex-wrap items-center gap-3">
                            @if (! $msg->is_read)
                                <span class="rounded-full bg-mint-400 px-3 py-1 font-mono text-xs font-bold uppercase text-obsidian-950">Yangi</span>
                            @endif
                            <h2 class="font-display text-2xl font-bold text-white">{{ $msg->name }}</h2>
                            <span class="font-mono text-sm text-slate-500">{{ $msg->created_at->format('d.m.Y H:i') }}</span>
                        </div>
                        <div class="mt-2.5 flex flex-wrap items-center gap-3 font-mono text-base">
                            <span class="text-mint-400 font-semibold">{{ $msg->contact }}</span>
                            @if ($msg->service_type)
                                <span class="rounded-lg bg-white/[0.06] px-3.5 py-1 text-sm text-slate-200">{{ $msg->service_type }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <form action="{{ route('admin.messages.toggle', $msg) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-ghost rounded-xl px-5 py-2.5 text-sm font-semibold">
                                {{ $msg->is_read ? "O'qilmagan qilish" : "O'qildi" }}
                            </button>
                        </form>
                        <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('Xabarni o\'chirmoqchimisiz?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-xl border border-rose-500/35 bg-rose-500/10 px-5 py-2.5 font-mono text-sm font-semibold text-rose-400 hover:bg-rose-500/20 transition">
                                O'chirish
                            </button>
                        </form>
                    </div>
                </div>

                <p class="mt-6 rounded-xl bg-obsidian-950/75 border border-white/[0.07] p-6 text-base leading-relaxed text-slate-200 whitespace-pre-line">{{ $msg->message }}</p>
            </div>
        @empty
            <div class="flex-1 studio-card rounded-2xl p-16 text-center flex flex-col items-center justify-center min-h-[65vh]">
                <div class="flex h-20 w-20 items-center justify-center rounded-2xl border border-white/10 bg-obsidian-950/80 text-mint-400/70 mb-6">
                    <svg class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="font-display text-2xl font-bold text-white">Hozircha xabarlar kelmagan</p>
                <p class="mt-3 text-base text-slate-400 max-w-md">Saytdagi aloqa formasi orqali yuborilgan xabarlar shu bo'limda saqlanadi.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $messages->links() }}
    </div>
@endsection
