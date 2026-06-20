@extends('layouts.app')

@section('title', 'Connexion - Asano Services')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center px-4 py-12">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-8 md:p-10">
        
        <!-- Logo ASANO SERVICES -->
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold tracking-wide" style="color: #1976D2;">
                ASANO SERVICES
            </h1>
            <p class="text-gray-500 text-sm mt-1">Connexion</p>
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
        <form action="{{ route('client.login') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Champ Email -->
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

            <!-- Champ Mot de passe -->
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

            <!-- Boutons -->
            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <button type="submit" 
                        class="flex-1 bg-[#1976D2] hover:bg-[#1565C0] text-white font-semibold py-3 px-6 rounded-lg transition duration-200 shadow-sm hover:shadow">
                    Se connecter
                </button>
                <a href="{{ route('client.register') }}" 
                   class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-lg transition duration-200">
                    Créer un compte
                </a>
            </div>
        </form>
    </div>
</div>
@endsection