<?php

namespace App\Http\Controllers;

use App\Models\Terrain;
use App\Models\Logement;
use App\Models\RendezVous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RendezvousController extends Controller
{
    /**
     * 1. FORMULAIRE DE PRISE DE RDV
     */
    public function create(Request $request)
    {
        $id_terrain = $request->query('terrain_id');
        $id_logement = $request->query('logement_id');

        $terrain = null;
        $logement = null;

        if ($id_terrain) {
            $terrain = Terrain::where('id_terrain', $id_terrain)->first();
        }

        if ($id_logement) {
            $logement = Logement::where('id_logement', $id_logement)->first();
        }

        return view('rendezvous.create', compact('terrain', 'logement'));
    }

    /**
     * 2. ENREGISTRER LE RDV EN BDD
     */
    public function store(Request $request)
    {
        $request->validate([
            'date_rdv'    => 'required|date|after_or_equal:today',
            'heure_rdv'   => 'required',
            'message'     => 'nullable|string',
            'id_terrain'  => 'nullable|exists:terrains,id_terrain',
            'id_logement' => 'nullable|exists:logements,id_logement',
        ]);

        $messageParDefaut = 'Demande de visite.';
        if ($request->filled('id_terrain')) {
            $messageParDefaut = 'Demande de visite pour un terrain.';
        } elseif ($request->filled('id_logement')) {
            $messageParDefaut = 'Demande de visite pour un logement.';
        }

        RendezVous::create([
            'id_utilisateur' => Auth::id(), // ID du client actuellement connecté
            'id_logement'    => $request->input('id_logement'),
            'id_terrain'     => $request->input('id_terrain'),
            'date_rdv'       => $request->input('date_rdv'),
            'heure_rdv'      => $request->input('heure_rdv'),
            'message'        => $request->input('message') ?? $messageParDefaut,
            'statut_rdv'     => 'en_attente',
            'date_demande'   => now()->toDateString(),
        ]);

        return redirect()->route('rendezvous.index')->with('success', 'Votre demande de rendez-vous a bien été enregistrée !');
    }

    /**
     * 3. HISTORIQUE DES DEMANDES (Espace Client Connecté)
     */
    public function index()
    {
        // On ne récupère QUE les demandes de l'utilisateur connecté
        $demandes = RendezVous::with(['terrain', 'logement'])
            ->where('id_utilisateur', Auth::id())
            ->orderBy('date_rdv', 'desc')
            ->get();

        return view('rendezvous.index', compact('demandes'));
    }


    /**
 * Mettre à jour le statut d'un rendez-vous (Accepté / Refusé) depuis le Dashboard
 */
public function updateStatus($id, $status)
{
    // 1. Trouver le rendez-vous par son ID
    $demande = \App\Models\RendezVous::where('id_rendez_vous', $id)->firstOrFail();

    // 2. Traduire ou standardiser le statut pour correspondre à votre base de données
    // Si l'action envoie 'Accepte', on l'enregistre en minuscule 'accepte'
    if (strtolower($status) === 'accepte') {
        $demande->statut_rdv = 'accepte';
        $messageFlash = 'Le rendez-vous a été accepté avec succès !';
    } else {
        $demande->statut_rdv = 'refuse';
        $messageFlash = 'Le rendez-vous a été refusé.';
    }

    // 3. Sauvegarder en base de données
    $demande->save();

    // 4. Rediriger vers le dashboard avec un message de succès
    return redirect()->back()->with('success', $messageFlash);
}

    /**
 * 4. SUPPRIMER UN RENDEZ-VOUS (Espace Client Connecté)
 */
public function destroy($id)
{
    // 1. Trouver le rendez-vous par sa clé personnalisée 'id_rendez_vous'
    $demande = RendezVous::where('id_rendez_vous', $id)->firstOrFail();

    // 2. Sécurité : Vérifier que le rendez-vous appartient bien au client connecté
    if ($demande->id_utilisateur !== Auth::id()) {
        abort(403, 'Action non autorisée.');
    }

    // 3. Suppression
    $demande->delete();

    // 4. Redirection avec message de succès
    return redirect()->route('rendezvous.index')->with('success', 'Votre demande de rendez-vous a bien été supprimée.');
}

}