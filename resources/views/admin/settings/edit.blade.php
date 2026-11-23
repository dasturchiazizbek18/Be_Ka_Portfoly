@extends('layouts.admin')

@section('title', 'Sayt sozlamalari va Logotip')

@section('content')
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Brand & Logo Upload --}}
        <div class="studio-card rounded-2xl p-6 sm:p-8 space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="font-display text-xl font-bold text-white">Brend va Logotip</h2>
                    <p class="text-sm text-slate-400 mt-1">Logotip yuklasangiz Navbar, Men haqimda va Footer joylarida avtomatik chiqadi (PNG/SVG/WEBP tavsiya etiladi).</p>
                </div>
                <span class="font-mono text-xs text-mint-400">LOGO</span>
            </div>

            <div class="grid gap-7 xl:grid-cols-2">
                <div>
                    <label class="block text-xs font-medium uppercase tracking-wider text-slate-400 mb-2">Logotip fayli</label>
                    <div class="mb-4">
                        <x-brand-logo :setting="$setting" variant="showcase" />
                    </div>
                    <input type="file" name="logo" accept=".png,.jpg,.jpeg,.webp,.svg" class="studio-input w-full px-3 py-2 text-xs">
                    @if ($setting->logo_path)
                        <label class="mt-2 inline-flex items-center gap-2 text-xs text-rose-400 cursor-pointer">
                            <input type="checkbox" name="remove_logo" value="1" class="rounded bg-obsidian-950 border-white/20 text-rose-500">
                            <span>Yuklangan logotipni o'chirish</span>
                        </label>
                    @endif
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-medium uppercase tracking-wider text-slate-400 mb-2">Hero Viewfinder rasmi (ixtiyoriy)</label>
                        @if ($setting->heroImageUrl())
                            <img src="{{ $setting->heroImageUrl() }}" alt="Hero cover" class="mb-3 h-32 w-full rounded-xl object-cover border border-white/10">
                        @endif
                        <input type="file" name="hero_image" accept=".png,.jpg,.jpeg,.webp" class="studio-input w-full px-3 py-2 text-xs">
                        @if ($setting->hero_image_path)
                            <label class="mt-2 inline-flex items-center gap-2 text-xs text-rose-400 cursor-pointer">
                                <input type="checkbox" name="remove_hero_image" value="1" class="rounded bg-obsidian-950 border-white/20 text-rose-500">
                                <span>Hero rasmini o'chirish</span>
                            </label>
                        @endif
                    </div>

                    <div>
                        <label class="block text-xs font-medium uppercase tracking-wider text-slate-400 mb-2">Brend / Ism-familiya *</label>
                        <input type="text" name="brand_name" value="{{ old('brand_name', $setting->brand_name) }}" required class="studio-input w-full px-4 py-2.5 text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-medium uppercase tracking-wider text-slate-400 mb-2">Showreel video havola (YouTube / Vimeo / MP4)</label>
                        <input type="url" name="showreel_url" value="{{ old('showreel_url', $setting->showreel_url) }}" placeholder="https://youtube.com/watch?v=..." class="studio-input w-full px-4 py-2.5 text-sm">
                    </div>

                    <label class="inline-flex items-center gap-2.5 cursor-pointer pt-1">
                        <input type="checkbox" name="is_available" value="1" @checked(old('is_available', $setting->is_available)) class="rounded bg-obsidian-950 border-white/20 text-mint-400 focus:ring-mint-400">
                        <span class="text-sm text-slate-200">"Syomka uchun ochiqman" belgisini ko'rsatish</span>
                    </label>
                </div>
            </div>
        </div>

        {{-- Multilingual Texts --}}
        <div class="studio-card rounded-2xl p-6 space-y-5" x-data="{ tab: 'uz' }">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <h2 class="font-display text-lg font-bold text-white">Matnlar (UZ / RU / EN)</h2>
                <div class="inline-flex rounded-xl border border-white/10 bg-obsidian-950 p-1">
                    @foreach (['uz' => "O'zbekcha", 'ru' => 'Русский', 'en' => 'English'] as $lang => $langLabel)
                        <button
                            type="button"
                            @click="tab = '{{ $lang }}'"
                            :class="tab === '{{ $lang }}' ? 'bg-mint-400 text-obsidian-950 font-semibold' : 'text-slate-400 hover:text-white'"
                            class="rounded-lg px-3 py-1 text-xs transition"
                        >
                            {{ $langLabel }}
                        </button>
                    @endforeach
                </div>
            </div>

            @foreach (['uz', 'ru', 'en'] as $lang)
                <div x-show="tab === '{{ $lang }}'" class="space-y-4">
                    <div class="grid gap-4 sm:grid-cols-3">
                        <div>
                            <label class="block text-xs text-slate-400 mb-1.5">Holat matni ({{ strtoupper($lang) }})</label>
                            <input type="text" name="status_text_{{ $lang }}" value="{{ old('status_text_'.$lang, $setting->{'status_text_'.$lang}) }}" class="studio-input w-full px-3.5 py-2.5 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs text-slate-400 mb-1.5">Kasb / Yo'nalish ({{ strtoupper($lang) }})</label>
                            <input type="text" name="role_title_{{ $lang }}" value="{{ old('role_title_'.$lang, $setting->{'role_title_'.$lang}) }}" class="studio-input w-full px-3.5 py-2.5 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs text-slate-400 mb-1.5">Joylashuv ({{ strtoupper($lang) }})</label>
                            <input type="text" name="location_{{ $lang }}" value="{{ old('location_'.$lang, $setting->{'location_'.$lang}) }}" class="studio-input w-full px-3.5 py-2.5 text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs text-slate-400 mb-1.5">Hero ustki yozuv ({{ strtoupper($lang) }})</label>
                        <input type="text" name="hero_eyebrow_{{ $lang }}" value="{{ old('hero_eyebrow_'.$lang, $setting->{'hero_eyebrow_'.$lang}) }}" class="studio-input w-full px-3.5 py-2.5 text-sm">
                    </div>

                    <div>
                        <label class="block text-xs text-slate-400 mb-1.5">Hero qisqa tanishtiruv ({{ strtoupper($lang) }})</label>
                        <textarea name="hero_bio_{{ $lang }}" rows="3" class="studio-input w-full px-3.5 py-2.5 text-sm">{{ old('hero_bio_'.$lang, $setting->{'hero_bio_'.$lang}) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs text-slate-400 mb-1.5">Men haqimda sarlavha ({{ strtoupper($lang) }})</label>
                        <input type="text" name="about_title_{{ $lang }}" value="{{ old('about_title_'.$lang, $setting->{'about_title_'.$lang}) }}" class="studio-input w-full px-3.5 py-2.5 text-sm">
                    </div>

                    <div>
                        <label class="block text-xs text-slate-400 mb-1.5">Men haqimda batafsil ({{ strtoupper($lang) }})</label>
                        <textarea name="about_text_{{ $lang }}" rows="4" class="studio-input w-full px-3.5 py-2.5 text-sm">{{ old('about_text_'.$lang, $setting->{'about_text_'.$lang}) }}</textarea>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Stats & Contacts --}}
        <div class="grid gap-6 lg:grid-cols-2">
            <div class="studio-card rounded-2xl p-6 space-y-4">
                <h2 class="font-display text-lg font-bold text-white">Raqamlar (Statistika)</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-slate-400 mb-1.5">Tayyor roliklar</label>
                        <input type="text" name="stat_projects" value="{{ old('stat_projects', $setting->stat_projects) }}" class="studio-input w-full px-3.5 py-2.5 text-sm font-mono">
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1.5">Brendlar</label>
                        <input type="text" name="stat_clients" value="{{ old('stat_clients', $setting->stat_clients) }}" class="studio-input w-full px-3.5 py-2.5 text-sm font-mono">
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1.5">Ko'rishlar</label>
                        <input type="text" name="stat_views" value="{{ old('stat_views', $setting->stat_views) }}" class="studio-input w-full px-3.5 py-2.5 text-sm font-mono">
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1.5">Yil tajriba</label>
                        <input type="text" name="stat_experience" value="{{ old('stat_experience', $setting->stat_experience) }}" class="studio-input w-full px-3.5 py-2.5 text-sm font-mono">
                    </div>
                </div>
            </div>

            <div class="studio-card rounded-2xl p-6 space-y-4">
                <h2 class="font-display text-lg font-bold text-white">Aloqa va Ijtimoiy tarmoqlar</h2>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-xs text-slate-400 mb-1.5">Telefon</label>
                        <input type="text" name="phone" value="{{ old('phone', $setting->phone) }}" class="studio-input w-full px-3.5 py-2.5 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1.5">Email</label>
                        <input type="email" name="email" value="{{ old('email', $setting->email) }}" class="studio-input w-full px-3.5 py-2.5 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1.5">Telegram (Shaxsiy URL)</label>
                        <input type="text" name="telegram" value="{{ old('telegram', $setting->telegram) }}" placeholder="https://t.me/Erkinjonov_29" class="studio-input w-full px-3.5 py-2.5 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1.5">Telegram Kanal URL</label>
                        <input type="text" name="telegram_channel" value="{{ old('telegram_channel', $setting->telegram_channel) }}" placeholder="https://t.me/erknjnvv7" class="studio-input w-full px-3.5 py-2.5 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1.5">Instagram URL</label>
                        <input type="text" name="instagram" value="{{ old('instagram', $setting->instagram) }}" placeholder="https://www.instagram.com/erkinjonovv77" class="studio-input w-full px-3.5 py-2.5 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1.5">YouTube URL</label>
                        <input type="text" name="youtube" value="{{ old('youtube', $setting->youtube) }}" placeholder="https://youtube.com/@username" class="studio-input w-full px-3.5 py-2.5 text-sm">
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-2">
            <button type="submit" class="btn-mint rounded-xl px-10 py-4 text-base font-semibold">
                Sozlamalarni saqlash
            </button>
        </div>
    </form>
@endsection
