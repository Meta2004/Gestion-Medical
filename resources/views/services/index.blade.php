<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-800 leading-tight">
            {{ __('Services Médicaux Disponibles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($services as $service)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-slate-800 mb-2">{{ $service->titre }}</h3>
                            
                            <div class="mb-4">
                                <p class="text-sm text-slate-600 mb-3">{{ Str::limit($service->description, 100) }}</p>
                                
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="font-semibold text-slate-700">Médecin:</span>
                                        <p class="text-slate-600">{{ $service->medecin->name ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <span class="font-semibold text-slate-700">Durée:</span>
                                        <p class="text-slate-600">{{ $service->duree }} min</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t">
                                <span class="text-2xl font-bold text-blue-600">{{ number_format($service->prix, 2, ',', ' ') }} FCFA</span>
                                <a href="{{ route('services.show', $service->id) }}" 
                                   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    Détails
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-slate-600 text-lg">Aucun service disponible pour le moment.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
