<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MediCare') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-slate-50 via-slate-50 to-blue-50 min-h-screen">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-gradient-to-r from-blue-600 via-blue-500 to-cyan-500 text-white shadow-xl">
                    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-white/20 rounded-xl backdrop-blur-sm">
                                    <x-medical-logo class="w-8 h-8 text-white" />
                                </div>
                                <div>
                                    {{ $header }}
                                </div>
                            </div>
                            <div class="text-sm text-blue-100 font-medium">{{ config('app.name', 'MediCare') }}</div>
                        </div>
                    </div>
                </header>
            @endisset

            <main class="flex-1 py-8">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="space-y-6">
                        {{ $slot }}
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 text-slate-400 py-8 mt-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center text-sm">
                        <p>&copy; {{ date('Y') }} {{ config('app.name', 'MediCare') }}. Tous droits réservés.</p>
                        <p class="mt-2 text-xs text-slate-500">Plateforme de Gestion Médicale Moderne</p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
