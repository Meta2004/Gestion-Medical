<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-900 leading-tight">
            {{ __('Détails de la Réservation') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Détails de la Réservation -->
            <div class="bg-white shadow-lg rounded-2xl overflow-hidden mb-8">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h3 class="text-lg font-semibold text-slate-800">Informations Générales</h3>
                </div>

                <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Patient -->
                    <div>
                        <p class="text-sm font-semibold text-slate-500 uppercase mb-2">Patient</p>
                        <div class="flex items-center gap-4">
                            <div class="h-12 w-12 rounded-full bg-slate-300 flex items-center justify-center text-slate-700 font-bold text-lg">
                                {{ strtoupper(substr($reservation->user->name ?? 'P', 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-medium text-slate-900">{{ $reservation->user->name ?? 'N/A' }}</p>
                                <p class="text-sm text-slate-500">{{ $reservation->user->email ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Médecin -->
                    <div>
                        <p class="text-sm font-semibold text-slate-500 uppercase mb-2">Médecin</p>
                        <div class="flex items-center gap-4">
                            <div class="h-12 w-12 rounded-full bg-blue-300 flex items-center justify-center text-white font-bold text-lg">
                                {{ strtoupper(substr($reservation->service->medecin->name ?? 'M', 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-medium text-slate-900">{{ $reservation->service->medecin->name ?? 'N/A' }}</p>
                                <p class="text-sm text-slate-500">{{ $reservation->service->medecin->email ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service et Date -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <!-- Service -->
                <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                        <h3 class="text-lg font-semibold text-slate-800">Service</h3>
                    </div>

                    <div class="p-8">
                        <p class="text-2xl font-bold text-slate-900 mb-2">{{ $reservation->service->titre ?? 'N/A' }}</p>
                        <p class="text-slate-600 mb-4">{{ $reservation->service->description ?? 'N/A' }}</p>
                        
                        <div class="space-y-3 border-t border-slate-200 pt-4">
                            <div class="flex justify-between">
                                <span class="text-slate-600">Prix :</span>
                                <span class="font-bold text-slate-900">{{ number_format($reservation->service->prix ?? 0, 2, ',', ' ') }} FCFA</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-600">Durée :</span>
                                <span class="font-bold text-slate-900">{{ $reservation->service->duree ?? 0 }} minutes</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Réservation -->
                <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                        <h3 class="text-lg font-semibold text-slate-800">Réservation</h3>
                    </div>

                    <div class="p-8 space-y-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-500 uppercase mb-2">Date</p>
                            <p class="text-lg font-medium text-slate-900">
                                @if($reservation->date_reservation)
                                    {{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y') }}
                                @else
                                    N/A
                                @endif
                            </p>
                        </div>

                        <div>
                            <p class="text-sm font-semibold text-slate-500 uppercase mb-2">Heure</p>
                            <p class="text-lg font-medium text-slate-900">
                                {{ $reservation->heure_reservation ?? 'N/A' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm font-semibold text-slate-500 uppercase mb-2">Statut</p>
                            @switch($reservation->statut)
                                @case('pending')
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">
                                        En attente
                                    </span>
                                    @break
                                @case('confirmed')
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 border border-blue-200">
                                        Confirmée
                                    </span>
                                    @break
                                @case('completed')
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">
                                        Terminée
                                    </span>
                                    @break
                                @case('cancelled')
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800 border border-red-200">
                                        Annulée
                                    </span>
                                    @break
                                @default
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 border border-gray-200">
                                        {{ ucfirst($reservation->statut ?? '') }}
                                    </span>
                            @endswitch
                        </div>

                        <div>
                            <p class="text-sm font-semibold text-slate-500 uppercase mb-2">Créée le</p>
                            <p class="text-slate-900">{{ $reservation->created_at->format('d/m/Y à H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Commentaire -->
            @if($reservation->commentaire)
                <div class="bg-white shadow-lg rounded-2xl overflow-hidden mb-8">
                    <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                        <h3 class="text-lg font-semibold text-slate-800">Commentaire</h3>
                    </div>

                    <div class="p-8">
                        <p class="text-slate-900">{{ $reservation->commentaire }}</p>
                    </div>
                </div>
            @endif

            <!-- Boutons d'action -->
            <div class="flex gap-4">
                <a href="{{ route('admin.reservations.index') }}" class="px-6 py-2 bg-slate-200 text-slate-700 rounded-lg hover:bg-slate-300 transition font-medium">
                    Retour aux Réservations
                </a>
                <form method="POST" action="{{ route('admin.reservations.destroy', $reservation->id) }}" class="inline" 
                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium">
                        Supprimer la Réservation
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
