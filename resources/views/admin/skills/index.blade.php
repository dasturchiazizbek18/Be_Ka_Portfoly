@extends('layouts.admin')

@section('title', "Ko'nikmalar va Texnika")

@section('content')
    <div class="flex-1 grid gap-7 xl:grid-cols-12 items-start">
        {{-- Add New Form --}}
        <div class="xl:col-span-5">
            <form action="{{ route('admin.skills.store') }}" method="POST" class="studio-card rounded-2xl p-7 sm:p-8 space-y-5">
                @csrf
                <h2 class="font-display text-2xl font-bold text-white">Yangi qo'shish</h2>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-slate-300 mb-2">Turi</label>
                        <select name="type" class="studio-input w-full px-4 py-3 text-base">
                            <option value="skill">Ko'nikma (Skill)</option>
                            <option value="gear">Texnika / Dastur (Gear)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm text-slate-300 mb-2">Daraja (10-100%)</label>
                        <input type="number" name="level" value="95" min="10" max="100" class="studio-input w-full px-4 py-3 text-base font-mono">
                    </div>
                </div>

                <div>
                    <label class="block text-sm text-slate-300 mb-2">Nomi (UZ) *</label>
                    <input type="text" name="name_uz" required placeholder="Masalan: Color Grading" class="studio-input w-full px-4 py-3 text-base">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-slate-300 mb-2">Nomi (RU)</label>
                        <input type="text" name="name_ru" class="studio-input w-full px-4 py-3 text-base">
                    </div>
                    <div>
                        <label class="block text-sm text-slate-300 mb-2">Nomi (EN)</label>
                        <input type="text" name="name_en" class="studio-input w-full px-4 py-3 text-base">
                    </div>
                </div>

                <div>
                    <label class="block text-sm text-slate-300 mb-2">Izoh / Quyi matn (UZ)</label>
                    <input type="text" name="subtitle_uz" placeholder="Masalan: Apple Log · 4K 60fps" class="studio-input w-full px-4 py-3 text-base">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-slate-300 mb-2">Izoh (RU)</label>
                        <input type="text" name="subtitle_ru" class="studio-input w-full px-4 py-3 text-base">
                    </div>
                    <div>
                        <label class="block text-sm text-slate-300 mb-2">Izoh (EN)</label>
                        <input type="text" name="subtitle_en" class="studio-input w-full px-4 py-3 text-base">
                    </div>
                </div>

                <button type="submit" class="btn-mint w-full rounded-xl py-3.5 text-base font-semibold">Qo'shish</button>
            </form>
        </div>

        {{-- Existing List --}}
        <div class="xl:col-span-7 space-y-5">
            @forelse ($skills as $skill)
                <div class="studio-card rounded-2xl p-6 sm:p-7 flex flex-wrap items-center justify-between gap-4">
                    <div class="flex-1 min-w-[220px]">
                        <div class="flex items-center gap-3">
                            <span class="rounded-lg px-3 py-1 font-mono text-xs font-semibold uppercase {{ $skill->type === 'gear' ? 'bg-sky-500/15 text-sky-300' : 'bg-mint-400/15 text-mint-400' }}">
                                {{ $skill->type === 'gear' ? 'Texnika' : "Ko'nikma" }}
                            </span>
                            <h3 class="font-display text-lg font-bold text-white">{{ $skill->name_uz }}</h3>
                        </div>
                        @if ($skill->subtitle_uz)
                            <p class="mt-2.5 font-mono text-sm text-slate-400">{{ $skill->subtitle_uz }} @if($skill->type === 'skill') · <span class="text-mint-400 font-semibold">{{ $skill->level }}%</span> @endif</p>
                        @endif
                        @if ($skill->type === 'skill')
                            <div class="mt-3.5 h-2 w-full max-w-lg overflow-hidden rounded-full bg-white/[0.07]">
                                <div class="h-full rounded-full bg-gradient-to-r from-mint-600 via-mint-400 to-mint-300" style="width: {{ min(100, max(10, (int) $skill->level)) }}%"></div>
                            </div>
                        @endif
                    </div>

                    <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" onsubmit="return confirm('O\'chirmoqchimisiz?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-xl border border-rose-500/35 bg-rose-500/10 px-5 py-2.5 font-mono text-sm font-semibold text-rose-400 hover:bg-rose-500/20 transition">
                            O'chirish
                        </button>
                    </form>
                </div>
            @empty
                <div class="studio-card rounded-2xl p-14 text-center text-lg text-slate-400">Hali ma'lumot qo'shilmagan.</div>
            @endforelse
        </div>
    </div>
@endsection
