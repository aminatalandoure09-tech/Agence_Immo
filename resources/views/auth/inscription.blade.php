<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asano Services - Inscription</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-white flex items-center justify-center min-h-screen font-sans relative">

    <!-- Bouton Retour à l'accueil -->
    <div class="absolute top-6 left-6">
        <a href="{{ route('home') }}" class="flex items-center text-gray-600 hover:text-gray-900 font-medium text-sm transition space-x-1">
            <span>←</span> <span>Retour à l'accueil</span>
        </a>
    </div>

    <div class="w-full max-w-md bg-white rounded-lg shadow-2xl overflow-hidden my-6 border border-gray-100">
        <div class="bg-[#1D74E8] px-6 py-4 flex items-center space-x-3">
            <div class="text-white font-bold text-xl flex items-center">
                <span class="border-2 border-white rounded px-1 mr-2 text-sm">AS</span> ASANO SERVICES
            </div>
        </div>

        <div class="p-8">
            <div class="bg-[#111827] text-white text-center font-bold py-3 rounded-t-md text-lg">
                Inscription
            </div>
            
            <form action="{{ route('inscription.submit') }}" method="POST" class="border-x-2 border-b-2 border-gray-100 p-6 rounded-b-md space-y-4 bg-white shadow-sm">
                @csrf

                @if ($errors->any())
                    <div class="text-red-500 text-xs space-y-1">
                        @foreach ($errors->all() as $error)
                            <p>• {{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div>
                    <input type="text" name="nom" value="{{ old('nom') }}" placeholder="Entrez votre nom" class="w-full px-4 py-2 border rounded border-gray-200 bg-gray-50 text-sm focus:outline-none" required>
                </div>

                <div>
                    <input type="text" name="prenom" value="{{ old('prenom') }}" placeholder="Entrez votre prenom" class="w-full px-4 py-2 border rounded border-gray-200 bg-gray-50 text-sm focus:outline-none" required>
                </div>

                <div>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Entrez votre Email" class="w-full px-4 py-2 border rounded border-gray-200 bg-gray-50 text-sm focus:outline-none" required>
                </div>

                <div>
                    <input type="text" name="telephone" value="{{ old('telephone') }}" placeholder="Entrez votre numero de tel" class="w-full px-4 py-2 border rounded border-gray-200 bg-gray-50 text-sm focus:outline-none" required>
                </div>

                <div>
                    <input type="password" name="mot_de_passe" placeholder="Entrez votre Mot de passe" class="w-full px-4 py-2 border rounded border-gray-200 bg-gray-50 text-sm focus:outline-none" required>
                </div>

                <div class="flex items-center justify-between pt-2">
                    <button type="submit" class="bg-[#111827] text-white font-semibold px-6 py-2 rounded text-sm hover:bg-gray-800 transition">
                        S'inscrire
                    </button>
                    <a href="{{ route('login') }}" class="text-[10px] text-gray-900 font-medium hover:underline">Déjà inscrit? se connecter</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>