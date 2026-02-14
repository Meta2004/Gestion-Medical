<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Tableau de bord
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-2xl font-semibold text-slate-700">Bonjour, {{ auth()->user()->name }}</h3>
                <p class="text-sm text-slate-500 mt-2">Voici un aperçu rapide de votre activité.</p>

                <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-indigo-600 text-white p-4 rounded-lg shadow-sm">
                        <div class="text-sm">Services</div>
                        <div class="text-2xl font-bold mt-1">—</div>
                    </div>
                    <div class="bg-green-600 text-white p-4 rounded-lg shadow-sm">
                        <div class="text-sm">Réservations</div>
                        <div class="text-2xl font-bold mt-1">—</div>
                    </div>
                    <div class="bg-amber-500 text-white p-4 rounded-lg shadow-sm">
                        <div class="text-sm">Utilisateurs</div>
                        <div class="text-2xl font-bold mt-1">—</div>
                    </div>
                </div>
            </div>
        </div>

        <aside>
            <div class="bg-white rounded-lg shadow p-6">
                <h4 class="font-semibold text-slate-700">Raccourcis</h4>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="{{ route('services.index') }}" class="text-indigo-600 hover:underline">Voir les services</a></li>
                    <li><a href="{{ route('patient.reservations.index') }}" class="text-indigo-600 hover:underline">Mes réservations</a></li>
                    <li><a href="{{ route('profile.edit') }}" class="text-indigo-600 hover:underline">Mon profil</a></li>
                </ul>
            </div>
        </aside>
    </div>
</x-app-layout>