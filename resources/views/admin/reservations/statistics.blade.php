<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-900 leading-tight">
            {{ __('Statistiques des Réservations') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
                <!-- Total -->
                <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500 mb-1">Total Réservations</p>
                            <p class="text-3xl font-bold text-slate-800">{{ $totalReservations }}</p>
                        </div>
                        <div class="p-3 rounded-xl bg-slate-100 text-slate-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- En attente -->
                <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500 mb-1">En Attente</p>
                            <p class="text-3xl font-bold text-yellow-600">{{ $pendingReservations }}</p>
                            <p class="text-xs text-slate-400 mt-1">{{ round(($pendingReservations / max($totalReservations, 1)) * 100) }}%</p>
                        </div>
                        <div class="p-3 rounded-xl bg-yellow-100 text-yellow-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 2m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Confirmées -->
                <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500 mb-1">Confirmées</p>
                            <p class="text-3xl font-bold text-blue-600">{{ $confirmedReservations }}</p>
                            <p class="text-xs text-slate-400 mt-1">{{ round(($confirmedReservations / max($totalReservations, 1)) * 100) }}%</p>
                        </div>
                        <div class="p-3 rounded-xl bg-blue-100 text-blue-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Terminées -->
                <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500 mb-1">Terminées</p>
                            <p class="text-3xl font-bold text-green-600">{{ $completedReservations }}</p>
                            <p class="text-xs text-slate-400 mt-1">{{ round(($completedReservations / max($totalReservations, 1)) * 100) }}%</p>
                        </div>
                        <div class="p-3 rounded-xl bg-green-100 text-green-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Annulées -->
                <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500 mb-1">Annulées</p>
                            <p class="text-3xl font-bold text-red-600">{{ $cancelledReservations }}</p>
                            <p class="text-xs text-slate-400 mt-1">{{ round(($cancelledReservations / max($totalReservations, 1)) * 100) }}%</p>
                        </div>
                        <div class="p-3 rounded-xl bg-red-100 text-red-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphique -->
            <div class="bg-white shadow-lg rounded-2xl p-8 mb-8">
                <h3 class="text-lg font-semibold text-slate-800 mb-6">Répartition par Statut</h3>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-slate-600">En Attente</span>
                            <span class="font-semibold text-slate-800">{{ $pendingReservations }} ({{ round(($pendingReservations / max($totalReservations, 1)) * 100) }}%)</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ round(($pendingReservations / max($totalReservations, 1)) * 100) }}%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-slate-600">Confirmées</span>
                            <span class="font-semibold text-slate-800">{{ $confirmedReservations }} ({{ round(($confirmedReservations / max($totalReservations, 1)) * 100) }}%)</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: {{ round(($confirmedReservations / max($totalReservations, 1)) * 100) }}%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-slate-600">Terminées</span>
                            <span class="font-semibold text-slate-800">{{ $completedReservations }} ({{ round(($completedReservations / max($totalReservations, 1)) * 100) }}%)</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: {{ round(($completedReservations / max($totalReservations, 1)) * 100) }}%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-slate-600">Annulées</span>
                            <span class="font-semibold text-slate-800">{{ $cancelledReservations }} ({{ round(($cancelledReservations / max($totalReservations, 1)) * 100) }}%)</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div class="bg-red-500 h-2 rounded-full" style="width: {{ round(($cancelledReservations / max($totalReservations, 1)) * 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Retour -->
            <div class="flex gap-4">
                <a href="{{ route('admin.reservations.index') }}" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                    Voir Tous les Réservations
                </a>
                <a href="{{ route('admin.dashboard') }}" class="px-6 py-2 bg-slate-200 text-slate-700 rounded-lg hover:bg-slate-300 transition font-medium">
                    Retour au Tableau de Bord
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
