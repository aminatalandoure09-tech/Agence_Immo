@extends('layouts.app')

@section('title', 'Inscription - Asano Services')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center px-4 py-12">
    <div class="bg-white rounded-2xl shadow-xl max-w-lg w-full p-8 md:p-10">
        
        <!-- Logo ASANO SERVICES -->
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold tracking-wide" style="color: #1976D2;">
                ASANO SERVICES
            </h1>
            <p class="text-gray-500 text-sm mt-1">Inscription</p>
        </div>

        <!-- Message d'erreur global -->
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Formulaire -->
        <form action="{{ route('client.register') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Ligne 1 : Nom + Prénom (côte à côte) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Entrez votre nom
                    </label>
                    <input type="text" name="nom" value="{{ old('nom') }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1976D2] focus:border-transparent transition duration-200"
                           placeholder="Dupont">
                    @error('nom') 
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> 
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Entrez votre prénom
                    </label>
                    <input type="text" name="prenom" value="{{ old('prenom') }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1976D2] focus:border-transparent transition duration-200"
                           placeholder="Jean">
                    @error('prenom') 
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> 
                    @enderror
                </div>
            </div>

            <!-- Ligne 2 : Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Entrez votre Email
                </label>
                <input type="email" name="email" value="{{ old('email') }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1976D2] focus:border-transparent transition duration-200"
                       placeholder="exemple@email.com">
                @error('email') 
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> 
                @enderror
            </div>

            <!-- Ligne 3 : Téléphone -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Entrez votre numéro de tel
                </label>
                <input type="tel" name="tel" value="{{ old('tel') }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1976D2] focus:border-transparent transition duration-200"
                       placeholder="77 123 45 67">
                @error('tel') 
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> 
                @enderror
            </div>

            <!-- Ligne 4 : Mot de passe -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Entrez votre Mot de passe
                </label>
                <input type="password" name="motDePasse" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1976D2] focus:border-transparent transition duration-200"
                       placeholder="••••••••">
                @error('motDePasse') 
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> 
                @enderror
            </div>

            <!-- Confirmation mot de passe (champ caché mais nécessaire) -->
            <input type="password" name="motDePasse_confirmation" class="hidden">

            <!-- Boutons -->
            <div class="flex flex-col sm:flex-row gap-3 pt-4">
                <button type="submit" 
                        class="flex-1 bg-[#22C55E] hover:bg-[#16A34A] text-white font-semibold py-3 px-6 rounded-lg transition duration-200 shadow-sm hover:shadow">
                    S'inscrire
                </button>
                <a href="{{ route('client.login') }}" 
                   class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-lg transition duration-200">
                    Déjà inscrit ? se connecter
                </a>
            </div>
        </form>
    </div>
</div>
@endsection