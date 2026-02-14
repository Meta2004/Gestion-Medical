<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Mes Services Médicaux') }}
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
                                        <span class="font-semibold text-slate-700">Durée:</span>
                                        <p class="text-slate-600">{{ $service->duree }} min</p>
                                    </div>
                                    <div>
                                        <span class="font-semibold text-slate-700">Prix:</span>
                                        <p class="text-slate-600">{{ number_format($service->prix, 2, ',', ' ') }} FCFA</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-slate-600 text-lg">Vous n'avez pas encore de services.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
