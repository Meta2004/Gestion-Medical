<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-900 leading-tight">
            {{ __('Gestion des Réservations') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative shadow-sm">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative shadow-sm">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
                <div class="bg-white rounded-lg shadow p-4">
                    <p class="text-sm text-slate-500">Total</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $reservations->total() }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <p class="text-sm text-slate-500">En attente</p>
                    <p class="text-2xl font-bold text-yellow-600">{{ \App\Models\Reservation::where('statut', 'pending')->count() }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <p class="text-sm text-slate-500">Confirmées</p>
                    <p class="text-2xl font-bold text-blue-600">{{ \App\Models\Reservation::where('statut', 'confirmed')->count() }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <p class="text-sm text-slate-500">Terminées</p>
                    <p class="text-2xl font-bold text-green-600">{{ \App\Models\Reservation::where('statut', 'completed')->count() }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <p class="text-sm text-slate-500">Annulées</p>
                    <p class="text-2xl font-bold text-red-600">{{ \App\Models\Reservation::where('statut', 'cancelled')->count() }}</p>
                </div>
            </div>

            <!-- Filtres -->
            <div class="bg-white shadow-md rounded-xl p-6 mb-8">
                <form method="GET" action="{{ route('admin.reservations.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Recherche -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Rechercher</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Patient ou Service" 
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Statut -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Statut</label>
                        <select name="statut" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Tous les statuts --</option>
                            @foreach($statuts as $statut)
                                <option value="{{ $statut }}" {{ request('statut') === $statut ? 'selected' : '' }}>
                                    {{ ucfirst($statut === 'pending' ? 'En attente' : ($statut === 'confirmed' ? 'Confirmé' : ($statut === 'completed' ? 'Terminé' : 'Annulé'))) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Médecin -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Médecin</label>
                        <select name="medecin_id" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Tous les médecins --</option>
                            @foreach($medecins as $medecin)
                                <option value="{{ $medecin->id }}" {{ request('medecin_id') == $medecin->id ? 'selected' : '' }}>
                                    {{ $medecin->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Bouton Filtrer -->
                    <div class="flex items-end gap-2">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                            Filtrer
                        </button>
                        @if(request()->has('search') || request()->has('statut') || request()->has('medecin_id'))
                            <a href="{{ route('admin.reservations.index') }}" class="px-6 py-2 bg-slate-200 text-slate-700 rounded-lg hover:bg-slate-300 transition font-medium">
                                Réinitialiser
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Tableau -->
            <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h3 class="text-lg font-semibold text-slate-800">Liste des Réservations</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Patient</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Service</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Médecin</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Statut</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @forelse($reservations as $reservation)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                        {{ $reservation->user->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                        {{ $reservation->service->titre ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                        {{ $reservation->service->medecin->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                        @if($reservation->date_reservation)
                                            {{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y') }}
                                            @if($reservation->heure_reservation)
                                                à {{ $reservation->heure_reservation }}
                                            @endif
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @switch($reservation->statut)
                                            @case('pending')
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                    En attente
                                                </span>
                                                @break
                                            @case('confirmed')
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 border border-blue-200">
                                                    Confirmée
                                                </span>
                                                @break
                                            @case('completed')
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">
                                                    Terminée
                                                </span>
                                                @break
                                            @case('cancelled')
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 border border-red-200">
                                                    Annulée
                                                </span>
                                                @break
                                            @default
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 border border-gray-200">
                                                    {{ ucfirst($reservation->statut ?? '') }}
                                                </span>
                                        @endswitch
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <a href="{{ route('admin.reservations.show', $reservation->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                                            Voir
                                        </a>
                                        <form method="POST" action="{{ route('admin.reservations.destroy', $reservation->id) }}" class="inline" 
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                        <p class="text-sm">Aucune réservation trouvée</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if($reservations->hasPages())
                <div class="mt-6">
                    {{ $reservations->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
