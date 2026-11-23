@extends('layouts.admin')

@section('title', $service->exists ? 'Xizmat paketini tahrirlash' : 'Yangi xizmat paketi')

@section('actions')
    <a href="{{ route('admin.services.index') }}" class="btn-ghost rounded-xl px-4 py-2 text-xs">&larr; Orqaga</a>
@endsection

@section('content')
    <form action="{{ $service->exists ? route('admin.services.update', $service) : route('admin.services.store') }}" method="POST" class="space-y-6">
        @csrf
        @if ($service->exists) @method('PUT') @endif

        <div class="studio-card rounded-2xl p-6 space-y-5" x-data="{ tab: 'uz' }">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <h2 class="font-display text-base font-bold text-white">Paket ma'lumotlari (UZ / RU / EN)</h2>
                <div class="inline-flex rounded-xl border border-white/10 bg-obsidian-950 p-1">
                    @foreach (['uz' => 'UZ', 'ru' => 'RU', 'en' => 'EN'] as $lang => $label)
                        <button type="button" @click="tab = '{{ $lang }}'" :class="tab === '{{ $lang }}' ? 'bg-mint-400 text-obsidian-950 font-semibold' : 'text-slate-400'" class="rounded-lg px-3 py-1 font-mono text-xs">{{ $label }}</button>
                    @endforeach
                </div>
            </div>

            @foreach (['uz', 'ru', 'en'] as $lang)
                <div x-show="tab === '{{ $lang }}'" class="space-y-4">
                    <div>
                        <label class="block text-xs text-slate-400 mb-1.5">Paket nomi ({{ strtoupper($lang) }}) {{ $lang === 'uz' ? '*' : '' }}</label>
                        <input type="text" name="title_{{ $lang }}" value="{{ old('title_'.$lang, $service->{'title_'.$lang}) }}" {{ $lang === 'uz' ? 'required' : '' }} class="studio-input w-full px-4 py-2.5 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1.5">Qisqa tavsif ({{ strtoupper($lang) }})</label>
                        <textarea name="description_{{ $lang }}" rows="2" class="studio-input w-full px-4 py-2.5 text-sm">{{ old('description_'.$lang, $service->{'description_'.$lang}) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1.5">Afzalliklar (har bir qatorda bittadan, {{ strtoupper($lang) }})</label>
                        <textarea name="features_{{ $lang }}" rows="5" class="studio-input w-full px-4 py-2.5 text-sm">{{ old('features_'.$lang, $service->{'features_'.$lang}) }}</textarea>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="studio-card rounded-2xl p-6 grid gap-4 sm:grid-cols-3 items-end">
            <div>
                <label class="block text-xs text-slate-400 mb-1.5">Narx belgisi</label>
                <input type="text" name="price_label" value="{{ old('price_label', $service->price_label) }}" placeholder="$150+" class="studio-input w-full px-4 py-2.5 text-sm font-mono">
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-1.5">Tartib raqami</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}" min="0" class="studio-input w-full px-4 py-2.5 text-sm font-mono">
            </div>
            <label class="inline-flex items-center gap-2.5 cursor-pointer py-2.5">
                <input type="checkbox" name="is_popular" value="1" @checked(old('is_popular', $service->is_popular)) class="rounded bg-obsidian-950 border-white/20 text-mint-400">
                <span class="text-sm text-slate-200">"Ommabop" deb belgilash</span>
            </label>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn-mint rounded-xl px-8 py-3 text-sm">Saqlash</button>
        </div>
    </form>
@endsection
