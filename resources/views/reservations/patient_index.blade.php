<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-800 leading-tight">
            {{ __('Mes Réservations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Messages flash --}}
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Statistiques --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                @php
                    $total = $reservations->count();
                    $pending = $reservations->where('statut', 'en_attente')->count();
                    $confirmed = $reservations->where('statut', 'confirmee')->count();
                    $completed = $reservations->where('statut', 'effectuee')->count();
                @endphp

                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                    <p class="text-sm font-medium text-slate-600 mb-1">Total Réservations</p>
                    <p class="text-3xl font-bold text-slate-800">{{ $total }}</p>
                </div>

                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
                    <p class="text-sm font-medium text-slate-600 mb-1">En Attente</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $pending }}</p>
                </div>

                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-indigo-500">
                    <p class="text-sm font-medium text-slate-600 mb-1">Confirmées</p>
                    <p class="text-3xl font-bold text-indigo-600">{{ $confirmed }}</p>
                </div>

                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                    <p class="text-sm font-medium text-slate-600 mb-1">Terminées</p>
                    <p class="text-3xl font-bold text-green-600">{{ $completed }}</p>
                </div>
            </div>

            {{-- Bouton ajouter réservation --}}
            <div class="mb-8">
                <a href="{{ route('services.index') }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Nouvelle réservation
                </a>
            </div>

            {{-- Tableau des réservations --}}
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="px-6 py-4 bg-slate-50 border-b border-slate-200">
                    <h3 class="text-lg font-semibold text-slate-800">Liste de mes réservations</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Service</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Médecin</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Date & Heure</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @forelse($reservations as $reservation)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <p class="font-semibold text-slate-800">{{ $reservation->service->titre ?? 'N/A' }}</p>
                                        <p class="text-sm text-slate-600">{{ number_format($reservation->service->prix ?? 0, 2, ',', ' ') }} FCFA</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-slate-800">{{ $reservation->service->medecin->name ?? 'N/A' }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-slate-800">
                                            {{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y') }}
                                        </p>
                                        <p class="text-sm text-slate-600">
                                            {{ $reservation->heure_reservation }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $statusStyles = [
                                                'en_attente' => ['bg' => 'yellow-100', 'text' => 'yellow-800', 'label' => 'En attente'],
                                                'confirmee' => ['bg' => 'blue-100', 'text' => 'blue-800', 'label' => 'Confirmée'],
                                                'effectuee' => ['bg' => 'green-100', 'text' => 'green-800', 'label' => 'Effectuée'],
                                                'annulee' => ['bg' => 'red-100', 'text' => 'red-800', 'label' => 'Annulée'],
                                            ];
                                            $style = $statusStyles[$reservation->statut] ?? ['bg' => 'gray-100', 'text' => 'gray-800', 'label' => 'Inconnu'];
                                        @endphp
                                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-{{ $style['bg'] }} text-{{ $style['text'] }}">
                                            {{ $style['label'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($reservation->statut !== 'effectuee' && $reservation->statut !== 'annulee')
                                            <form action="{{ route('patient.reservations.cancel', $reservation->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" 
                                                        class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700 transition"
                                                        onclick="return confirm('Êtes-vous sûr(e) d\'annuler cette réservation ?');">
                                                    Annuler
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-sm text-slate-500">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <p class="text-slate-600 text-lg mb-4">Vous n'avez aucune réservation pour le moment.</p>
                                        <a href="{{ route('services.index') }}" 
                                           class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                            Réserver un service
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
