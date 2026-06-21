<?php

namespace App\Http\Controllers;

use App\Models\RendezVous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RendezVousController extends Controller
{
    /**
     * Action Admin : Changer le statut (Boutons ✔ et ✖)
     */
    public function updateStatus($id, $status)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', "Action non autorisée.");
        }

        if (!in_array($status, ['Accepte', 'Refuse'])) {
            return redirect()->back()->with('error', 'Statut non valide.');
        }

        // Recherche par la vraie clé primaire
        $rdv = RendezVous::where('id_rendez_vous', $id)->firstOrFail();
        
        // Mise à jour de votre colonne réelle 'statut_rdv'
        $rdv->statut_rdv = $status;
        $rdv->save();

        $messageText = $status === 'Accepte' ? 'Le rendez-vous a été accepté.' : 'Le rendez-vous a été refusé.';
        return redirect()->back()->with('success', $messageText);
    }
}