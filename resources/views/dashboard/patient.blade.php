<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-800 leading-tight">
            {{ __('Mon Espace Patient') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Messages flash --}}
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-sm" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-sm" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @php
                $total = $reservations->count();
                $pending = $reservations->where('statut', 'en_attente')->count();
                $confirmed = $reservations->where('statut', 'confirmee')->count();
                $completed = $reservations->where('statut', 'effectuee')->count();
            @endphp

            {{-- Statistiques --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                @foreach([
                    ['label' => 'Total Réservations', 'count' => $total, 'color' => 'blue', 'icon' => 'M12 4v16m8-8H4'],
                    ['label' => 'En Attente', 'count' => $pending, 'color' => 'yellow', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['label' => 'Confirmées', 'count' => $confirmed, 'color' => 'indigo', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['label' => 'Terminées', 'count' => $completed, 'color' => 'emerald', 'icon' => 'M5 13l4 4L19 7']
                ] as $stat)
                    <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-slate-100 p-6 hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-500 mb-1">{{ $stat['label'] }}</p>
                                <p class="text-3xl font-bold text-slate-800">{{ $stat['count'] }}</p>
                            </div>
                            <div class="p-3 rounded-xl bg-{{ $stat['color'] }}-100 text-{{ $stat['color'] }}-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Bouton principal --}}
            <div class="mb-8 flex justify-center sm:justify-start">
                <a href="{{ route('services.index') }}" class="inline-flex items-center px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-lg shadow-blue-200 transition-all duration-300 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Réserver un service
                </a>
            </div>

            {{-- Liste des réservations --}}
            <div class="bg-white shadow-lg rounded-2xl border border-slate-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-slate-800">Mes Réservations</h3>
                    <span class="text-sm text-slate-500">{{ $total }} résultat(s)</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Service</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Médecin</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Date du RDV</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Statut</th>
                                <th class="hidden md:table-cell px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Réservé le</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            @forelse($reservations as $reservation)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $reservation->service->titre ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $reservation->service->medecin->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                        {{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusColors = [
                                                'en_attente' => 'yellow',
                                                'confirmee' => 'blue',
                                                'effectuee' => 'green',
                                                'annulee' => 'red'
                                            ];
                                            $color = $statusColors[$reservation->statut] ?? 'gray';
                                            $labels = [
                                                'en_attente' => 'En attente',
                                                'confirmee' => 'Confirmée',
                                                'effectuee' => 'Effectuée',
                                                'annulee' => 'Annulée'
                                            ];
                                            $label = $labels[$reservation->statut] ?? 'Inconnu';
                                        @endphp
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $color }}-100 text-{{ $color }}-800 border border-{{ $color }}-200">
                                            {{ $label }}
                                        </span>
                                    </td>
                                    <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                        {{ $reservation->created_at?->format('d/m/Y') ?? 'N/A' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                        <p class="text-sm mb-2">Aucune réservation trouvée</p>
                                        <p class="text-xs text-slate-400">Commencez par réserver un service médical</p>
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