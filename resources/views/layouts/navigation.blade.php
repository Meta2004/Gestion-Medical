<nav x-data="{ open: false, sidebarOpen: true }" class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white shadow-2xl">
    <!-- Top Navigation Bar -->
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo and Brand -->
            <div class="flex items-center gap-3">
                <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-lg hover:bg-slate-700 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 hover:opacity-80 transition">
                    <div class="p-2 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg">
                        <x-medical-logo class="w-6 h-6 text-white" />
                    </div>
                    <span class="font-bold text-lg hidden sm:inline">{{ config('app.name', 'MediCare') }}</span>
                </a>
            </div>

            <!-- User Profile -->
            <div class="flex items-center gap-4">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-slate-600 text-sm leading-4 font-medium rounded-lg text-slate-200 bg-slate-700 hover:bg-slate-600 focus:outline-none transition ease-in-out duration-150">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold text-sm mr-2">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
                            <svg class="fill-current h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-slate-200">
                            <p class="text-sm font-semibold text-slate-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-slate-500">{{ Auth::user()->email }}</p>
                        </div>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profil') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Déconnexion') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>

    <!-- Sidebar Navigation -->
    <div x-show="sidebarOpen" x-transition class="max-w-7xl mx-auto">
        <div class="flex">
            <div class="w-full border-t border-slate-700">
                <div class="px-4 py-3 space-y-1">
                    <!-- Dashboard Link -->
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-700' }} transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 4l4 2m-8-2l4-2" />
                        </svg>
                        <span class="font-medium">Tableau de Bord</span>
                    </a>

                    <!-- Admin Links -->
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <div class="mt-6 pt-4 border-t border-slate-700">
                            <p class="px-4 py-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">Administration</p>
                            
                            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg {{ request()->routeIs('admin.users*') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-700' }} transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <span class="font-medium">Utilisateurs</span>
                            </a>

                            <a href="{{ route('admin.services.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg {{ request()->routeIs('admin.services*') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-700' }} transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                </svg>
                                <span class="font-medium">Services</span>
                            </a>

                            <a href="{{ route('admin.reservations.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg {{ request()->routeIs('admin.reservations*') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-700' }} transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="font-medium">Réservations</span>
                            </a>
                        </div>
                    @endif

                    <!-- Patient Links -->
                    @if(auth()->check() && auth()->user()->role === 'patient')
                        <div class="mt-6 pt-4 border-t border-slate-700">
                            <p class="px-4 py-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">Patient</p>
                            
                            <a href="{{ route('services.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg {{ request()->routeIs('services.*') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-700' }} transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-medium">Services</span>
                            </a>

                            <a href="{{ route('patient.reservations.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg {{ request()->routeIs('patient.reservations.index') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-700' }} transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="font-medium">Mes Réservations</span>
                            </a>
                        </div>
                    @endif

                    <!-- Medecin Links -->
                    @if(auth()->check() && auth()->user()->role === 'medecin')
                        <div class="mt-6 pt-4 border-t border-slate-700">
                            <p class="px-4 py-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">Médecin</p>
                            
                            <a href="{{ route('medecin.services') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg {{ request()->routeIs('medecin.services') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-700' }} transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                </svg>
                                <span class="font-medium">Mes Services</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>
