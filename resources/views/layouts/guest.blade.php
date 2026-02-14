<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 via-white to-sky-50 py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl w-full grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div class="hidden md:flex flex-col justify-center px-6">
                    <a href="/" class="mb-6 inline-flex items-center">
                        <x-application-logo class="w-16 h-16" />
                        <span class="ms-3 text-2xl font-semibold text-indigo-700">{{ config('app.name', 'Gestion Medical') }}</span>
                    </a>

                    <h2 class="text-3xl font-extrabold text-slate-700 mb-4">Soignez votre planning, simplement</h2>
                    <p class="text-slate-500">Plateforme de gestion des services et réservations médicales — sécurisée, rapide et intuitive.</p>

                    <div class="mt-8">
                        <svg viewBox="0 0 600 400" class="w-full max-w-sm opacity-90 rounded-lg shadow-lg" xmlns="http://www.w3.org/2000/svg" fill="none">
                            <rect width="600" height="400" rx="20" fill="url(#g)" />
                            <defs>
                                <linearGradient id="g" x1="0" x2="1">
                                    <stop offset="0" stop-color="#eef2ff" />
                                    <stop offset="1" stop-color="#e0f2fe" />
                                </linearGradient>
                            </defs>
                            <g transform="translate(60,40)" fill="#6366f1" opacity="0.95">
                                <rect x="20" y="30" width="220" height="120" rx="12"></rect>
                                <rect x="40" y="70" width="180" height="12" rx="6" fill="#fff" opacity="0.9"></rect>
                                <rect x="40" y="96" width="120" height="12" rx="6" fill="#fff" opacity="0.9"></rect>
                                <circle cx="330" cy="90" r="60" fill="#06b6d4" opacity="0.9"></circle>
                            </g>
                        </svg>
                    </div>
                </div>

                <div class="bg-white/95 backdrop-blur-sm shadow-lg rounded-2xl p-8 sm:p-10">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
