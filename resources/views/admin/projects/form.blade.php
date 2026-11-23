@extends('layouts.admin')

@section('title', $project->exists ? 'Loyihani tahrirlash' : 'Yangi loyiha qo\'shish')

@section('actions')
    <a href="{{ route('admin.projects.index') }}" class="btn-ghost rounded-xl px-4 py-2 text-xs">
        &larr; Orqaga
    </a>
@endsection

@section('content')
    <form
        action="{{ $project->exists ? route('admin.projects.update', $project) : route('admin.projects.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6"
    >
        @csrf
        @if ($project->exists)
            @method('PUT')
        @endif

        {{-- Multilingual Title & Description --}}
        <div class="studio-card rounded-2xl p-6 space-y-5" x-data="{ tab: 'uz' }">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <h2 class="font-display text-base font-bold text-white">Sarlavha va tavsif</h2>
                <div class="inline-flex rounded-xl border border-white/10 bg-obsidian-950 p-1">
                    @foreach (['uz' => 'UZ', 'ru' => 'RU', 'en' => 'EN'] as $lang => $label)
                        <button
                            type="button"
                            @click="tab = '{{ $lang }}'"
                            :class="tab === '{{ $lang }}' ? 'bg-mint-400 text-obsidian-950 font-semibold' : 'text-slate-400 hover:text-white'"
                            class="rounded-lg px-3 py-1 font-mono text-xs transition"
                        >{{ $label }}</button>
                    @endforeach
                </div>
            </div>

            @foreach (['uz', 'ru', 'en'] as $lang)
                <div x-show="tab === '{{ $lang }}'" class="space-y-4">
                    <div>
                        <label class="block text-xs text-slate-400 mb-1.5">Loyiha nomi ({{ strtoupper($lang) }}) {{ $lang === 'uz' ? '*' : '' }}</label>
                        <input type="text" name="title_{{ $lang }}" value="{{ old('title_'.$lang, $project->{'title_'.$lang}) }}" {{ $lang === 'uz' ? 'required' : '' }} class="studio-input w-full px-4 py-2.5 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1.5">Tavsif ({{ strtoupper($lang) }})</label>
                        <textarea name="description_{{ $lang }}" rows="3" class="studio-input w-full px-4 py-2.5 text-sm">{{ old('description_'.$lang, $project->{'description_'.$lang}) }}</textarea>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Video Metadata & Media --}}
        <div class="studio-card rounded-2xl p-6 space-y-5">
            <h2 class="font-display text-base font-bold text-white">Video tafsilotlari va media</h2>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <div>
                    <label class="block text-xs text-slate-400 mb-1.5">Kategoriya *</label>
                    <select name="category" class="studio-input w-full px-3.5 py-2.5 text-sm">
                        @foreach (['reels' => 'Reels / Shorts', 'commercial' => 'Reklama', 'event' => 'Tadbirlar', 'brand' => 'Brendlar'] as $k => $v)
                            <option value="{{ $k }}" @selected(old('category', $project->category) === $k)>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs text-slate-400 mb-1.5">Video formati *</label>
                    <select name="aspect_ratio" class="studio-input w-full px-3.5 py-2.5 text-sm">
                        <option value="vertical" @selected(old('aspect_ratio', $project->aspect_ratio) === 'vertical')>9:16 Vertikal (Reels)</option>
                        <option value="horizontal" @selected(old('aspect_ratio', $project->aspect_ratio) === 'horizontal')>16:9 Gorizontal (Kino)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs text-slate-400 mb-1.5">Mijoz / Brend nomi</label>
                    <input type="text" name="client_name" value="{{ old('client_name', $project->client_name) }}" placeholder="Masalan: Roast & Ritual" class="studio-input w-full px-3.5 py-2.5 text-sm">
                </div>

                <div>
                    <label class="block text-xs text-slate-400 mb-1.5">Davomiyligi</label>
                    <input type="text" name="duration" value="{{ old('duration', $project->duration) }}" placeholder="0:45" class="studio-input w-full px-3.5 py-2.5 text-sm font-mono">
                </div>

                <div>
                    <label class="block text-xs text-slate-400 mb-1.5">Ko'rishlar soni</label>
                    <input type="text" name="views_count" value="{{ old('views_count', $project->views_count) }}" placeholder="1.2M" class="studio-input w-full px-3.5 py-2.5 text-sm font-mono">
                </div>

                <div>
                    <label class="block text-xs text-slate-400 mb-1.5">Yil / Tartib raqami</label>
                    <div class="grid grid-cols-2 gap-2">
                        <input type="text" name="year" value="{{ old('year', $project->year) }}" placeholder="2026" class="studio-input w-full px-3 py-2.5 text-sm font-mono">
                        <input type="number" name="sort_order" value="{{ old('sort_order', $project->sort_order) }}" min="0" placeholder="0" class="studio-input w-full px-3 py-2.5 text-sm font-mono">
                    </div>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label class="block text-xs text-slate-400 mb-1.5">Video havolasi (YouTube, Vimeo, Instagram yoki MP4)</label>
                    <input type="url" name="video_url" value="{{ old('video_url', $project->video_url) }}" placeholder="https://youtube.com/shorts/..." class="studio-input w-full px-3.5 py-2.5 text-sm">
                </div>
                <div>
                    <label class="block text-xs text-slate-400 mb-1.5">Texnika / Kamera izohi</label>
                    <input type="text" name="camera_spec" value="{{ old('camera_spec', $project->camera_spec) }}" placeholder="iPhone 16 Pro · 4K 60fps" class="studio-input w-full px-3.5 py-2.5 text-sm">
                </div>
            </div>

            <div>
                <label class="block text-xs text-slate-400 mb-1.5">Muqova rasmi (Thumbnail)</label>
                @if ($project->thumbnailUrl())
                    <img src="{{ $project->thumbnailUrl() }}" alt="Preview" class="mb-3 h-36 rounded-xl object-cover border border-white/10">
                    <label class="mb-2 inline-flex items-center gap-2 text-xs text-rose-400 cursor-pointer">
                        <input type="checkbox" name="remove_thumbnail" value="1" class="rounded bg-obsidian-950 border-white/20 text-rose-500">
                        <span>Rasmni o'chirish</span>
                    </label>
                @endif
                <input type="file" name="thumbnail" accept=".png,.jpg,.jpeg,.webp" class="studio-input w-full px-3 py-2 text-xs">
            </div>

            <label class="inline-flex items-center gap-2.5 cursor-pointer">
                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $project->is_featured)) class="rounded bg-obsidian-950 border-white/20 text-mint-400 focus:ring-mint-400">
                <span class="text-sm text-slate-300">Tanlangan (Featured) loyiha</span>
            </label>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn-mint rounded-xl px-8 py-3 text-sm">
                {{ $project->exists ? 'Saqlash' : "Loyihani qo'shish" }}
            </button>
        </div>
    </form>
@endsection
