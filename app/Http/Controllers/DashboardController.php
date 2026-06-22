<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use App\Models\Terrain;
use App\Models\Logement;
use App\Models\RendezVous;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Affichage du Dashboard Administrateur
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/connexion')->with('error', "Veuillez vous connecter pour accéder à cette page.");
        }

        /** @var \App\Models\Utilisateur $admin */
        $admin = Auth::user();

        if ($admin->role !== 'admin') {
            return redirect('/')->with('error', "Vous n'avez pas l'autorisation d'accéder au dashboard.");
        }

        $totalClients  = Utilisateur::where('role', 'client')->count();
        $totalTerrains  = Terrain::count();
        $totalLogements = Logement::count();

        $clients   = Utilisateur::where('role', 'client')->orderBy('id_utilisateur', 'desc')->get();
        $terrains  = Terrain::orderBy('id_terrain', 'desc')->get();
        $logements = Logement::orderBy('id_logement', 'desc')->get();

        // On ne prend QUE ceux qui ne sont pas refusés (colonne statut_rdv)
        $demandes  = RendezVous::with(['utilisateur', 'logement', 'terrain'])
            ->where('statut_rdv', '!=', 'Refuse')
            ->where('statut_rdv', '!=', 'Refusé')
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

    /**
     * Changer le statut d'un rendez-vous (Accepter / Refuser)
     */
    public function updateStatus($id, $status)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', "Accès non autorisé.");
        }

        // On cible bien la clé primaire id_rendez_vous
        $demande = RendezVous::where('id_rendez_vous', $id)->firstOrFail();
        
        // CORRECTION : On met à jour la vraie colonne 'statut_rdv'
        $demande->statut_rdv = $status;
        $demande->save();

        if ($status === 'Refuse' || $status === 'Refusé') {
            return redirect()->back()->with('success', 'La demande a été refusée et masquée du tableau.');
        }

        return redirect()->back()->with('success', 'Le statut du rendez-vous a été mis à jour avec succès.');
    }

    /**
     * Suppression d'un compte client
     */
    public function destroyClient($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', "Accès non autorisé.");
        }

        $client = Utilisateur::where('id_utilisateur', $id)->firstOrFail();
        if ($client->role === 'admin') {
            return redirect()->back()->with('error', 'Action impossible sur un administrateur.');
        }

        $client->delete();
        return redirect()->back()->with('success', 'Le compte client a été supprimé.');
    }

    /**
     * Suppression définitive d'une demande de rendez-vous
     */
    public function destroyDemande($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', "Accès non autorisé.");
        }

        $demande = RendezVous::where('id_rendez_vous', $id)->firstOrFail();
        $demande->delete();

        return redirect()->back()->with('success', 'La demande de rendez-vous a été définitivement supprimée.');
    }
}