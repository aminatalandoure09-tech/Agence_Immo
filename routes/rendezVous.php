<?php

use App\Http\Controllers\RendezVousController;
use Illuminate\Support\Facades\Route;

// Routes accessibles uniquement aux utilisateurs connectés
Route::middleware('auth')->group(function () {
    
    // Formulaire de création de rendez-vous (Reçoit l'id du terrain en paramètre)
    Route::get('/rendezvous/create', [RendezVousController::class, 'create'])->name('rendezvous.create');
    
    // Traitement de l'envoi du formulaire (Enregistrement en base de données)
    Route::post('/rendezvous', [RendezVousController::class, 'store'])->name('rendezvous.store');
    
    // Espace de consultation des demandes / historique
    Route::get('/demandes', [RendezVousController::class, 'index'])->name('rendezvous.index');
    
    // Validation ou refus des statuts (Boutons ✔ et ✖ du tableau de bord)
    Route::put('/demandes/{id}/{status}', [RendezVousController::class, 'updateStatus'])->name('demandes.status');
    
});