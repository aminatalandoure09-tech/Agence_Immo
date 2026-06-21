<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Afficher la page de connexion
    public function showConnexion()
    {
        return view('auth.connexion');
    }

    // Gérer la tentative de connexion
    public function connexion(Request $request)
    {
        // Validation selon la maquette (Email + Mot de passe)
        $credentials = $request->validate([
            'email' => 'required|email',
            'mot_de_passe' => 'required',
        ]);

        // Recherche de l'utilisateur par email
        $utilisateur = Utilisateur::where('email', $credentials['email'])->first();

        // Vérification du mot de passe haché
        if ($utilisateur && Hash::check($credentials['mot_de_passe'], $utilisateur->mot_de_passe)) {
            // Connecter l'utilisateur dans la session Laravel
            Auth::login($utilisateur);
            $request->session()->regenerate();

            // Rediriger vers la page d'accueil (ou tableau de bord)
            return redirect()->route('home');
        }

        // Retourner une erreur si les identifiants sont incorrects
        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ])->onlyInput('email');
    }

    // Afficher la page d'inscription
    public function showInscription()
    {
        return view('auth.inscription');
    }

    // Gérer la création du compte
    public function inscription(Request $request)
    {
        // Validation stricte basée sur les 5 champs de la maquette
        $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'required|string|email|max:150|unique:utilisateurs,email',
            'telephone' => 'required|string|max:20',
            'mot_de_passe' => 'required|string|min:6',
        ]);

        // Création de l'utilisateur avec mot de passe haché (sécurisé)
        $utilisateur = Utilisateur::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'mot_de_passe' => Hash::make($request->mot_de_passe),
        ]);

        // Connecter l'utilisateur immédiatement après l'inscription
        Auth::login($utilisateur);

        return redirect()->route('home')->with('success', 'Votre compte a été créé avec succès !');    }

    // Déconnexion
    public function deconnexion(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/connexion');
    }
}