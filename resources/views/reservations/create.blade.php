<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-800 leading-tight">
            {{ __('Nouvelle Réservation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-8">
                    
                    <h1 class="text-3xl font-bold text-slate-800 mb-2">Réserver: {{ $service->titre }}</h1>
                    <p class="text-slate-600 mb-8">Remplissez le formulaire ci-dessous pour réserver ce service auprès du Dr. {{ $service->medecin->name ?? 'N/A' }}</p>

                    <form action="{{ route('patient.reservations.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <input type="hidden" name="service_id" value="{{ $service->id }}">

                        {{-- Informations du service --}}
                        <div class="bg-blue-50 rounded-lg p-6 border border-blue-200">
                            <h3 class="font-semibold text-slate-800 mb-4">Résumé du service</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                <div>
                                    <p class="text-slate-600">Service</p>
                                    <p class="font-semibold text-slate-800">{{ $service->titre }}</p>
                                </div>
                                <div>
                                    <p class="text-slate-600">Prix</p>
                                    <p class="font-semibold text-blue-600">{{ number_format($service->prix, 2, ',', ' ') }} FCFA</p>
                                </div>
                                <div>
                                    <p class="text-slate-600">Durée</p>
                                    <p class="font-semibold text-slate-800">{{ $service->duree }} min</p>
                                </div>
                                <div>
                                    <p class="text-slate-600">Médecin</p>
                                    <p class="font-semibold text-slate-800">{{ $service->medecin->name ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Date de réservation --}}
                        <div>
                            <label for="date_reservation" class="block text-sm font-semibold text-slate-700 mb-2">
                                Date du rendez-vous <span class="text-red-600">*</span>
                            </label>
                            <input type="date" 
                                   id="date_reservation" 
                                   name="date_reservation" 
                                   value="{{ old('date_reservation') }}"
                                   min="{{ now()->format('Y-m-d') }}"
                                   class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                            @error('date_reservation')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Heure de réservation --}}
                        <div>
                            <label for="heure_reservation" class="block text-sm font-semibold text-slate-700 mb-2">
                                Heure du rendez-vous <span class="text-red-600">*</span>
                            </label>
                            <input type="time" 
                                   id="heure_reservation" 
                                   name="heure_reservation" 
                                   value="{{ old('heure_reservation', '09:00') }}"
                                   class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                            @error('heure_reservation')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Commentaire --}}
                        <div>
                            <label for="commentaire" class="block text-sm font-semibold text-slate-700 mb-2">
                                Notes ou commentaires
                            </label>
                            <textarea id="commentaire" 
                                      name="commentaire" 
                                      rows="4"
                                      placeholder="Décrivez vos symptômes, allergies, ou autres informations pertinentes..."
                                      class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('commentaire') }}</textarea>
                            @error('commentaire')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-slate-500 mt-2">Maximum 1000 caractères</p>
                        </div>

                        {{-- Boutons --}}
                        <div class="flex gap-4 pt-4 border-t">
                            <button type="submit" 
                                    class="flex-1 px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                                Confirmer la réservation
                            </button>
                            <a href="{{ route('services.show', $service->id) }}" 
                               class="flex-1 px-6 py-3 bg-slate-200 text-slate-800 font-semibold rounded-lg hover:bg-slate-300 transition text-center">
                                Annuler
                            </a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
