<x-guest-layout>
    <x-auth-session-status class="mb-4 text-mint-400" :status="session('status')" />

    <div class="mb-6">
        <h1 class="font-display text-xl font-bold text-white">Admin Panelga kirish</h1>
        <p class="mt-1 text-xs text-slate-400">Portfolio, loyihalar va logotipni boshqarish</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="block text-xs font-medium uppercase tracking-wider text-slate-400 mb-1.5">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="studio-input w-full px-4 py-2.5 text-sm">
            <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-rose-400" />
        </div>

        <div>
            <label for="password" class="block text-xs font-medium uppercase tracking-wider text-slate-400 mb-1.5">Parol</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" class="studio-input w-full px-4 py-2.5 text-sm">
            <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-rose-400" />
        </div>

        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember" class="rounded bg-obsidian-950 border-white/20 text-mint-400 focus:ring-mint-400">
                <span class="text-xs text-slate-400">Eslab qolish</span>
            </label>

            <a href="{{ route('home') }}" class="text-xs text-slate-400 hover:text-mint-400 transition">&larr; Saytga qaytish</a>
        </div>

        <button type="submit" class="btn-mint w-full rounded-xl py-3 text-sm mt-2">
            Kirish
        </button>
    </form>
</x-guest-layout>
