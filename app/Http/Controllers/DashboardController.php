<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use App\Models\Terrain;
use App\Models\Logement;
use App\Models\RendezVous; // Changement de modèle ici
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. SÉCURITÉ ACCÈS
        if (!Auth::check()) {
            return redirect('/connexion')->with('error', "Veuillez vous connecter pour accéder à cette page.");
        }

        /** @var \App\Models\Utilisateur $admin */
        $admin = Auth::user();

        /*if ($admin->role !== 'admin') {
            return redirect('/')->with('error', "Vous n'avez pas l'autorisation d'accéder au dashboard.");
        }*/

        // 2. STATISTIQUES (Remplacement de latest() par orderBy explicite)
        $totalClients  = Utilisateur::where('role', 'client')->count();
        $totalTerrains  = Terrain::count();
        $totalLogements = Logement::count();

        // 3. RÉCUPÉRATION DES DONNÉES SANS TIMESTAMPS
        $clients   = Utilisateur::where('role', 'client')->orderBy('id_utilisateur', 'desc')->get();
        $terrains  = Terrain::orderBy('id_terrain', 'desc')->get(); // Utilisez la bonne clé si différente de id
        $logements = Logement::orderBy('id_logement', 'desc')->get();

        // Chargement des rendez-vous avec les relations adaptées
        $demandes  = RendezVous::with(['utilisateur', 'logement', 'terrain'])
            ->orderBy('id_rendez_vous', 'desc')
            ->get();

        return view('agence.dashboard', compact(
            'totalClients',
            'totalTerrains',
            'totalLogements',
            'clients',
            'terrains',
            'logements',
            'demandes'
        ));
    }

    public function destroyClient($id)
    {
        $client = Utilisateur::where('id_utilisateur', $id)->firstOrFail();
        
        if ($client->role === 'admin') {
            return redirect()->back()->with('error', 'Action impossible sur un administrateur.');
        }

        $client->delete();

        return redirect()->back()->with('success', 'Le compte client a été supprimé.');
    }
}