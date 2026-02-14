<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicare - Réservation Médicale</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- NAVBAR -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">Medicare</h1>

            <div class="space-x-4">
                @auth
                    <a href="{{ route('dashboard') }}" 
                       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="px-4 py-2 text-blue-600 font-semibold hover:underline">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}" 
                       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Inscription
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section class="bg-blue-600 text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                Réservez vos services médicaux en toute simplicité
            </h2>
            <p class="text-lg md:text-xl mb-8 text-blue-100">
                Une plateforme moderne pour prendre rendez-vous rapidement avec des professionnels de santé.
            </p>

            @auth
                <a href="{{ route('dashboard') }}" 
                   class="px-8 py-3 bg-white text-blue-600 font-semibold rounded-lg shadow hover:bg-gray-100 transition">
                    Accéder à mon espace
                </a>
            @else
                <a href="{{ route('register') }}" 
                   class="px-8 py-3 bg-white text-blue-600 font-semibold rounded-lg shadow hover:bg-gray-100 transition">
                    Commencer maintenant
                </a>
            @endauth
        </div>
    </section>

    <!-- SERVICES SECTION -->
    <section class="py-16">
        <div class="container mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold mb-12 text-gray-800">
                Nos Services Médicaux
            </h3>

            <div class="grid md:grid-cols-3 gap-8">

                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <div class="text-blue-600 text-4xl mb-4">🩺</div>
                    <h4 class="text-xl font-semibold mb-2">Consultation Générale</h4>
                    <p class="text-gray-600">
                        Consultation médicale standard avec diagnostic et suivi personnalisé.
                    </p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <div class="text-blue-600 text-4xl mb-4">🦷</div>
                    <h4 class="text-xl font-semibold mb-2">Soins Dentaires</h4>
                    <p class="text-gray-600">
                        Services de soins et traitements dentaires réalisés par des spécialistes.
                    </p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <div class="text-blue-600 text-4xl mb-4">🧪</div>
                    <h4 class="text-xl font-semibold mb-2">Analyses Médicales</h4>
                    <p class="text-gray-600">
                        Tests et analyses médicales rapides et fiables.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- COMMENT ÇA MARCHE -->
    <section class="bg-gray-100 py-16">
        <div class="container mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold mb-12">Comment ça fonctionne ?</h3>

            <div class="grid md:grid-cols-3 gap-8">

                <div>
                    <div class="text-blue-600 text-3xl font-bold mb-4">1</div>
                    <p class="text-gray-700">
                        Créez un compte patient en quelques secondes.
                    </p>
                </div>

                <div>
                    <div class="text-blue-600 text-3xl font-bold mb-4">2</div>
                    <p class="text-gray-700">
                        Choisissez un service médical disponible.
                    </p>
                </div>

                <div>
                    <div class="text-blue-600 text-3xl font-bold mb-4">3</div>
                    <p class="text-gray-700">
                        Réservez votre créneau et suivez votre demande.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-white border-t py-6 mt-10">
        <div class="container mx-auto px-6 text-center text-gray-500 text-sm">
            © {{ date('Y') }} Medicare - Système de Réservation Médicale
        </div>
    </footer>

</body>
</html>