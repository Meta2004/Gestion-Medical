<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-800 leading-tight">
            Tableau de bord Médecin
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Messages --}}
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Statistiques --}}
            @php
                $total = $reservations->count();
                $pending = $reservations->where('statut', 'en_attente')->count();
                $confirmed = $reservations->where('statut', 'confirmee')->count();
                $completed = $reservations->where('statut', 'effectuee')->count();
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                {{-- Total --}}
                <div class="bg-white shadow rounded-2xl p-6">
                    <p class="text-sm text-gray-500">Total Rendez-vous</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $total }}</p>
                </div>

                {{-- En attente --}}
                <div class="bg-white shadow rounded-2xl p-6">
                    <p class="text-sm text-yellow-600">En attente</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $pending }}</p>
                </div>

                {{-- Confirmés --}}
                <div class="bg-white shadow rounded-2xl p-6">
                    <p class="text-sm text-blue-600">Confirmés</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $confirmed }}</p>
                </div>

                {{-- Terminés --}}
                <div class="bg-white shadow rounded-2xl p-6">
                    <p class="text-sm text-green-600">Terminés</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $completed }}</p>
                </div>

            </div>

            {{-- Tableau des rendez-vous --}}
            <div class="bg-white shadow rounded-2xl overflow-hidden">

                <div class="px-6 py-4 border-b bg-gray-50 flex justify-between">
                    <h3 class="font-semibold text-gray-800">Liste des Rendez-vous</h3>
                    <span class="text-sm text-gray-500">{{ $total }} résultat(s)</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Patient</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Service</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Statut</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">

                        @forelse($reservations as $reservation)

                            <tr class="hover:bg-gray-50">

                                {{-- Patient --}}
                                <td class="px-6 py-4">
                                    {{ $reservation->user->name ?? 'N/A' }}
                                </td>

                                {{-- Email --}}
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $reservation->user->email ?? 'N/A' }}
                                </td>

                                {{-- Service --}}
                                <td class="px-6 py-4">
                                    {{ $reservation->service->name ?? 'N/A' }}
                                </td>

                                {{-- Date --}}
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y') }}
                                    à {{ $reservation->heure_reservation }}
                                </td>

                                {{-- Statut --}}
                                <td class="px-6 py-4">

                                    @if($reservation->statut === 'en_attente')
                                        <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                            En attente
                                        </span>
                                    @elseif($reservation->statut === 'confirmee')
                                        <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                            Confirmé
                                        </span>
                                    @elseif($reservation->statut === 'annulee')
                                        <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-800">
                                            Annulé
                                        </span>
                                    @elseif($reservation->statut === 'effectuee')
                                        <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                            Terminé
                                        </span>
                                    @endif

                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4 text-right">

                                    @if($reservation->statut === 'en_attente')

                                        {{-- Confirmer --}}
                                        <form action="{{ route('medecin.reservations.updateStatus', $reservation->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="statut" value="confirmee">
                                            <button type="submit" class="px-3 py-1 bg-blue-600 text-white text-xs rounded">
                                                Confirmer
                                            </button>
                                        </form>

                                        {{-- Annuler --}}
                                        <form action="{{ route('medecin.reservations.updateStatus', $reservation->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="statut" value="annulee">
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white text-xs rounded">
                                                Refuser
                                            </button>
                                        </form>

                                    @endif

                                    @if($reservation->statut === 'confirmee')

                                        {{-- Terminer --}}
                                        <form action="{{ route('medecin.reservations.updateStatus', $reservation->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="statut" value="effectuee">
                                            <button type="submit" class="px-3 py-1 bg-green-600 text-white text-xs rounded">
                                                Terminer
                                            </button>
                                        </form>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                    Aucun rendez-vous trouvé
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