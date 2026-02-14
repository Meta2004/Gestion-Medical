<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-900 leading-tight">
            {{ __('Créer un Nouveau Service') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h3 class="text-lg font-semibold text-slate-800">Formulaire de Création</h3>
                </div>

                <div class="p-8">
                    <form method="POST" action="{{ route('admin.services.store') }}" class="space-y-6">
                        @csrf

                        <!-- Titre -->
                        <div>
                            <label for="titre" class="block text-sm font-medium text-slate-700 mb-2">Titre du Service</label>
                            <input type="text" id="titre" name="titre" value="{{ old('titre') }}" 
                                   class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('titre') border-red-500 @enderror"
                                   required>
                            @error('titre')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-slate-700 mb-2">Description</label>
                            <textarea id="description" name="description" rows="4"
                                      class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror"
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Prix -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="prix" class="block text-sm font-medium text-slate-700 mb-2">Prix (FCFA)</label>
                                <input type="number" id="prix" name="prix" value="{{ old('prix') }}" step="0.01" min="0"
                                       class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('prix') border-red-500 @enderror"
                                       required>
                                @error('prix')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="duree" class="block text-sm font-medium text-slate-700 mb-2">Durée (minutes)</label>
                                <input type="number" id="duree" name="duree" value="{{ old('duree') }}" min="1"
                                       class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('duree') border-red-500 @enderror"
                                       required>
                                @error('duree')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Médecin -->
                        <div>
                            <label for="medecin_id" class="block text-sm font-medium text-slate-700 mb-2">Médecin Responsable</label>
                            <select id="medecin_id" name="medecin_id" 
                                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('medecin_id') border-red-500 @enderror"
                                    required>
                                <option value="">-- Sélectionner un médecin --</option>
                                @foreach($medecins as $medecin)
                                    <option value="{{ $medecin->id }}" {{ old('medecin_id') == $medecin->id ? 'selected' : '' }}>
                                        {{ $medecin->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('medecin_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Statut -->
                        <div>
                            <label for="statut" class="block text-sm font-medium text-slate-700 mb-2">Statut</label>
                            <select id="statut" name="statut" 
                                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('statut') border-red-500 @enderror"
                                    required>
                                <option value="actif" {{ old('statut', 'actif') === 'actif' ? 'selected' : '' }}>Actif</option>
                                <option value="inactif" {{ old('statut', 'actif') === 'inactif' ? 'selected' : '' }}>Inactif</option>
                            </select>
                            @error('statut')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Boutons -->
                        <div class="flex gap-4 pt-6 border-t border-slate-200">
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                                Créer le Service
                            </button>
                            <a href="{{ route('admin.services.index') }}" class="px-6 py-2 bg-slate-200 text-slate-700 rounded-lg hover:bg-slate-300 transition font-medium">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
