@props([
    'setting' => null,
    'variant' => 'navbar', // navbar | badge | showcase | footer | admin
    'showText' => true,
])

@php
    $setting = $setting ?? \App\Models\SiteSetting::current();
    $logoUrl = $setting->resolvedLogoUrl();
    $markUrl = $setting->resolvedLogoMarkUrl();
    $brandName = $setting->brand_name ?: 'Erkinjonov Bexruz';
@endphp

@if ($variant === 'showcase')
    {{-- Dedicated prominent Logo Showcase Stage (About Bento Brand Card & Admin Settings) --}}
    <div data-logo-slot="showcase" class="relative flex flex-col items-center justify-center w-full h-full min-h-[210px] rounded-2xl border {{ $logoUrl ? 'border-mint-400/20' : 'border-dashed border-mint-400/35' }} bg-obsidian-950/80 p-6 overflow-hidden group">
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(94,240,200,0.14),transparent_68%)]"></div>
        <span class="pointer-events-none absolute top-3 left-3 w-3.5 h-3.5 border-t-2 border-l-2 border-mint-400/50 rounded-tl"></span>
        <span class="pointer-events-none absolute top-3 right-3 w-3.5 h-3.5 border-t-2 border-r-2 border-mint-400/50 rounded-tr"></span>
        <span class="pointer-events-none absolute bottom-3 left-3 w-3.5 h-3.5 border-b-2 border-l-2 border-mint-400/50 rounded-bl"></span>
        <span class="pointer-events-none absolute bottom-3 right-3 w-3.5 h-3.5 border-b-2 border-r-2 border-mint-400/50 rounded-br"></span>

        @if ($logoUrl)
            <img
                src="{{ $logoUrl }}"
                alt="{{ $brandName }} Logo"
                class="relative z-10 max-h-52 w-auto object-contain drop-shadow-[0_0_28px_rgba(94,240,200,0.22)] transition-transform duration-300 group-hover:scale-105"
            >
        @else
            <div class="relative z-10 flex flex-col items-center gap-3 text-center">
                <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-mint-400/10 border border-mint-400/40 shadow-mint-glow">
                    <span class="font-display text-2xl font-bold tracking-tight text-mint-400">EB</span>
                </div>
                <span class="font-mono text-[11px] uppercase tracking-[0.22em] text-mint-400/80">
                    {{ __('hero.logo_slot') }}
                </span>
            </div>
        @endif
    </div>
@elseif ($variant === 'badge')
    {{-- Compact Brand Watermark Badge --}}
    <div data-logo-slot="hero-badge" class="inline-flex items-center gap-2.5 rounded-xl bg-obsidian-950/80 border border-white/10 backdrop-blur-md px-3 py-2">
        @if ($markUrl)
            <img src="{{ $markUrl }}" alt="{{ $brandName }} Logo" class="h-8 w-8 object-contain">
        @else
            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-mint-400/15 border border-mint-400/40 font-display text-xs font-bold text-mint-400">
                EB
            </span>
        @endif
    </div>
@else
    {{-- Navbar / Footer / Admin lockup --}}
    @php
        $imgSize = match ($variant) {
            'footer' => 'h-16 w-16',
            'admin' => 'h-9 w-9 lg:h-14 lg:w-14',
            default => 'h-[60px] w-[60px]',
        };
        $boxSize = match ($variant) {
            'footer' => 'h-14 w-14 text-lg',
            'admin' => 'h-9 w-9 text-xs lg:h-12 lg:w-12 lg:text-base',
            default => 'h-12 w-12 text-base',
        };
        $titleSize = match ($variant) {
            'admin' => 'text-base lg:text-xl',
            'footer', 'navbar' => 'text-2xl',
            default => 'text-lg',
        };
    @endphp
    <span data-logo-slot="{{ $variant }}" {{ $attributes->merge(['class' => 'inline-flex items-center gap-2.5 lg:gap-4 group']) }}>
        @if ($markUrl)
            <img
                src="{{ $markUrl }}"
                alt="{{ $brandName }} Logo"
                class="{{ $imgSize }} shrink-0 object-contain drop-shadow-[0_0_12px_rgba(94,240,200,0.28)] transition-transform duration-200 group-hover:scale-105"
            >
        @else
            <span class="corner-frame flex {{ $boxSize }} items-center justify-center rounded-xl bg-mint-400/10 border border-mint-400/35 font-display font-bold tracking-tight text-mint-400 group-hover:bg-mint-400/20 transition">
                EB
            </span>
        @endif

        @if ($showText)
            <span class="flex flex-col leading-tight">
                <span class="font-display {{ $titleSize }} font-bold tracking-tight text-white group-hover:text-mint-300 transition whitespace-nowrap">
                    {{ $brandName }}
                </span>
                @if ($variant === 'navbar')
                    <span class="font-mono text-xs uppercase tracking-[0.18em] text-mint-400/80">
                        {{ $setting->t('role_title') ?: 'Mobilograf' }}
                    </span>
                @endif
            </span>
        @endif
    </span>
@endif
