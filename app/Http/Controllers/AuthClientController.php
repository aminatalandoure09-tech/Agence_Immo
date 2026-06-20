<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Compte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthClientController extends Controller
{
    // Afficher le formulaire d'inscription
    public function showRegisterForm()
    {
        return view('client.register');
    }

    // Traiter l'inscription
    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'email' => 'required|email|unique:clients,email',
            'tel' => 'required|string|max:20',
            'motDePasse' => 'required|string|min:6|confirmed',
        ]);

        // Créer le compte
        $compte = Compte::create([
            'login' => $request->email,
            'motDePasse' => Hash::make($request->motDePasse),
        ]);

        // Créer le client
        $client = Client::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'tel' => $request->tel,
            'idCompte' => $compte->idCompte,
            'idAgence' => null,
            'type_client' => 'locataire', // Par défaut
        ]);

        // Connecter automatiquement
        Session::put('client_id', $client->idClient);
        Session::put('client_nom', $client->prenom . ' ' . $client->nom);
        Session::put('client_type', $client->type_client);

        // ✅ REDIRECTION VERS LA PAGE D'ACCUEIL
        return redirect('/')->with('success', 'Bienvenue ' . $client->prenom . ' !');
    }

    // Afficher le formulaire de connexion
    public function showLoginForm()
    {
        return view('client.login');
    }

    // Traiter la connexion
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'motDePasse' => 'required|string',
        ]);

        $client = Client::where('email', $request->email)->first();

        if (!$client) {
            return back()->withErrors(['email' => 'Email incorrect.'])->onlyInput('email');
        }

        $compte = Compte::find($client->idCompte);

        if (!$compte || !Hash::check($request->motDePasse, $compte->motDePasse)) {
            return back()->withErrors(['email' => 'Mot de passe incorrect.'])->onlyInput('email');
        }

        // Créer la session
        Session::put('client_id', $client->idClient);
        Session::put('client_nom', $client->prenom . ' ' . $client->nom);
        Session::put('client_type', $client->type_client);

        // ✅ REDIRECTION VERS LA PAGE D'ACCUEIL
        return redirect('/')->with('success', 'Bonjour ' . $client->prenom . ' !');
    }

    // Déconnexion
    public function logout()
    {
        Session::flush();
        return redirect()->route('client.login')
                         ->with('success', 'Vous êtes déconnecté.');
    }
}