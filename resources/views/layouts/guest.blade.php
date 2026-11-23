<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ \App\Models\SiteSetting::current()->brand_name }} — Admin</title>
        @if (\App\Models\SiteSetting::current()->resolvedLogoMarkUrl())
            <link rel="icon" type="image/png" href="{{ \App\Models\SiteSetting::current()->resolvedLogoMarkUrl() }}">
        @endif

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="studio-canvas font-sans text-slate-200 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center px-4 py-10">
            <div class="mb-6">
                <a href="{{ route('home') }}">
                    <x-brand-logo variant="navbar" />
                </a>
            </div>

            <div class="studio-card w-full sm:max-w-md px-6 py-7 rounded-2xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
