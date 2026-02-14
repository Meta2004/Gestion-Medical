<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-slate-800">Se connecter</h1>
        <p class="text-sm text-slate-500 mt-1">Accédez à votre tableau de bord en toute sécurité</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="space-y-4">
        <div class="flex gap-3">
            <a href="#" class="flex-1 inline-flex justify-center items-center gap-2 py-2 px-4 rounded-lg border border-slate-200 text-sm hover:bg-slate-50">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21.6 12.227c0-.72-.064-1.413-.182-2.082H12v3.942h5.173c-.222 1.2-.9 2.217-1.922 2.904v2.41h3.106c1.817-1.672 2.645-4.19 2.645-7.174z" fill="#4285F4"/><path d="M12 22c2.43 0 4.47-.8 5.96-2.17l-3.106-2.41c-.86.58-1.96.92-2.854.92-2.19 0-4.04-1.48-4.703-3.48H3.98v2.19C5.46 19.86 8.5 22 12 22z" fill="#34A853"/><path d="M7.297 13.26a5.993 5.993 0 010-3.52V7.55H3.98a9.998 9.998 0 000 8.9l3.317-2.19z" fill="#FBBC05"/><path d="M12 6.2c1.32 0 2.5.45 3.43 1.34l2.57-2.57C16.46 3.56 14.42 2.6 12 2.6 8.5 2.6 5.46 4.74 3.98 7.55l3.317 2.19C7.96 7.68 9.81 6.2 12 6.2z" fill="#EA4335"/></svg>
                Continuer avec Google
            </a>
            <a href="#" class="flex-1 inline-flex justify-center items-center gap-2 py-2 px-4 rounded-lg border border-slate-200 text-sm hover:bg-slate-50">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="#1877F2" xmlns="http://www.w3.org/2000/svg"><path d="M22 12.07C22 6.48 17.52 2 11.93 2S2 6.48 2 12.07C2 17.07 5.66 21.2 10.44 21.95v-6.99H8.08v-2.9h2.36V9.41c0-2.33 1.38-3.62 3.5-3.62.99 0 2.03.18 2.03.18v2.23h-1.14c-1.12 0-1.47.7-1.47 1.42v1.7h2.5l-.4 2.9h-2.1v6.99C18.34 21.2 22 17.07 22 12.07z"/></svg>
                Facebook
            </a>
        </div>

        <div class="flex items-center gap-3">
            <span class="flex-1 h-px bg-slate-200"></span>
            <span class="text-xs text-slate-400">ou</span>
            <span class="flex-1 h-px bg-slate-200"></span>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-indigo-300 focus:border-indigo-300 px-3 py-2" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-slate-700">Mot de passe</label>
                <input id="password" name="password" type="password" required autocomplete="current-password" class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-indigo-300 focus:border-indigo-300 px-3 py-2" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-4">
                <label class="inline-flex items-center gap-2">
                    <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 rounded text-indigo-600 border-gray-300 focus:ring-indigo-500">
                    <span class="text-sm text-slate-600">Se souvenir de moi</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-indigo-600 hover:underline" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                @endif
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full inline-flex justify-center items-center gap-2 bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-300">Se connecter</button>
            </div>
        </form>

        <p class="text-center text-sm text-slate-500">Pas encore de compte ? <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Inscrivez-vous</a></p>
    </div>
</x-guest-layout>
