@extends('layouts.admin')

@section('title', $experience->exists ? 'Tajribani tahrirlash' : "Yangi tajriba qo'shish")

@section('actions')
    <a href="{{ route('admin.experiences.index') }}" class="btn-ghost rounded-xl px-4 py-2 text-xs">&larr; Orqaga</a>
@endsection

@section('content')
    <form action="{{ $experience->exists ? route('admin.experiences.update', $experience) : route('admin.experiences.store') }}" method="POST" class="space-y-6">
        @csrf
        @if ($experience->exists) @method('PUT') @endif

        <div class="studio-card rounded-2xl p-6 grid gap-4 sm:grid-cols-3">
            <div>
                <label class="block text-xs text-slate-400 mb-1.5">Davr *</label>
                <input type="text" name="period" value="{{ old('period', $experience->period) }}" required placeholder="2025 — Hozir" class="studio-input w-full px-3.5 py-2.5 text-sm font-mono">
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-1.5">Kompaniya / Studiya *</label>
                <input type="text" name="company" value="{{ old('company', $experience->company) }}" required class="studio-input w-full px-3.5 py-2.5 text-sm">
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-1.5">Tartib raqami</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $experience->sort_order) }}" min="0" class="studio-input w-full px-3.5 py-2.5 text-sm font-mono">
            </div>
        </div>

        <div class="studio-card rounded-2xl p-6 space-y-5" x-data="{ tab: 'uz' }">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <h2 class="font-display text-base font-bold text-white">Lavozim va tavsif (UZ / RU / EN)</h2>
                <div class="inline-flex rounded-xl border border-white/10 bg-obsidian-950 p-1">
                    @foreach (['uz' => 'UZ', 'ru' => 'RU', 'en' => 'EN'] as $lang => $label)
                        <button type="button" @click="tab = '{{ $lang }}'" :class="tab === '{{ $lang }}' ? 'bg-mint-400 text-obsidian-950 font-semibold' : 'text-slate-400'" class="rounded-lg px-3 py-1 font-mono text-xs">{{ $label }}</button>
                    @endforeach
                </div>
            </div>

            @foreach (['uz', 'ru', 'en'] as $lang)
                <div x-show="tab === '{{ $lang }}'" class="space-y-4">
                    <div>
                        <label class="block text-xs text-slate-400 mb-1.5">Lavozim ({{ strtoupper($lang) }}) {{ $lang === 'uz' ? '*' : '' }}</label>
                        <input type="text" name="role_{{ $lang }}" value="{{ old('role_'.$lang, $experience->{'role_'.$lang}) }}" {{ $lang === 'uz' ? 'required' : '' }} class="studio-input w-full px-4 py-2.5 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1.5">Tavsif ({{ strtoupper($lang) }})</label>
                        <textarea name="description_{{ $lang }}" rows="3" class="studio-input w-full px-4 py-2.5 text-sm">{{ old('description_'.$lang, $experience->{'description_'.$lang}) }}</textarea>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn-mint rounded-xl px-8 py-3 text-sm">Saqlash</button>
        </div>
    </form>
@endsection
