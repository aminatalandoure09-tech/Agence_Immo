<?php

use App\Http\Controllers\RendezVousController; // <-- Utilisez le nouveau contrôleur déduit de votre table
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    
    // La route qui gère les boutons ✔ et ✖ du dashboard
    Route::put('/demandes/{id}/{status}', [RendezVousController::class, 'updateStatus'])
        ->name('demandes.status');

});