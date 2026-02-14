<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-800 leading-tight">
            {{ $service->titre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-8">
                    
                    <h1 class="text-4xl font-bold text-slate-800 mb-4">{{ $service->titre }}</h1>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8 pb-8 border-b">
                        <div>
                            <p class="text-sm text-slate-500 uppercase font-semibold">Prix</p>
                            <p class="text-3xl font-bold text-blue-600">{{ number_format($service->prix, 2, ',', ' ') }} FCFA</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500 uppercase font-semibold">Durée</p>
                            <p class="text-3xl font-bold text-slate-800">{{ $service->duree }} min</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500 uppercase font-semibold">Statut</p>
                            <span class="inline-block mt-2 px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
                                {{ ucfirst($service->statut) }}
                            </span>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-2xl font-semibold text-slate-800 mb-4">Description</h3>
                        <p class="text-slate-600 leading-relaxed mb-6">{{ $service->description }}</p>
                    </div>

                    <div class="bg-blue-50 rounded-lg border border-blue-200 p-6 mb-8">
                        <h3 class="text-lg font-semibold text-slate-800 mb-2">Médecin responsable</h3>
                        <p class="text-slate-700 mb-1">
                            <span class="font-semibold">{{ $service->medecin->name ?? 'N/A' }}</span>
                        </p>
                        <p class="text-sm text-slate-600">{{ $service->medecin->email ?? '' }}</p>
                    </div>

                    <div class="flex gap-4">
                        @auth
                            @if(auth()->user()->role === 'patient' && $service->statut === 'actif')
                                <a href="{{ route('patient.reservations.create', $service->id) }}" 
                                    class="flex-1 px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition text-center">
                                        Réserver ce service
                                </a>
                            @endif
                        @endauth
                        <a href="{{ route('services.index') }}" 
                           class="flex-1 px-6 py-3 bg-slate-200 text-slate-800 font-semibold rounded-lg hover:bg-slate-300 transition text-center">
                            Retour aux services
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
