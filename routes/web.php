<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogementController;
use App\Http\Controllers\TerrainController;
use App\Http\Controllers\RendezVousController;

// ==========================================
// 1. ROUTES PUBLIQUES (Accessibles par TOUS)
// ==========================================
Route::get('/', function () {
    return view('accueil.index');
})->name('home');

Route::get('/infos', function () {
    return view('accueil.infos');
})->name('infos');

// Catalogues accessibles sans connexion
Route::get('/logements', [LogementController::class, 'index'])->name('logements.index');
Route::get('/nos-terrains', [TerrainController::class, 'index'])->name('terrains.index');

// Détails d'un logement (Public)
Route::get('/logements/{id_logement}', [LogementController::class, 'show'])->name('logements.show');
// Détails d'un terrain (Public - si tu as une page show)
Route::get('/nos-terrains/{id_terrain}', [TerrainController::class, 'show'])->name('terrains.show');


// ==========================================
// 2. ROUTES CLIENTS CONNECTÉS (Auth requis)
// ==========================================
Route::middleware(['auth'])->group(function () {
    // Espace Client : Voir ses propres demandes et les supprimer
    Route::get('/demandes', [RendezVousController::class, 'index'])->name('rendezvous.index');
    Route::delete('/rendezvous/{id}', [RendezVousController::class, 'destroy'])->name('rendezvous.destroy');
    
    // Actions liées aux fichiers inclus (connexion requise pour réserver/interagir)
    require __DIR__.'/rendezVous.php';
    require __DIR__.'/clients.php';
});


// ==========================================
// 3. ROUTES ADMINISTRATEUR (Auth + Admin requis)
// ==========================================
Route::middleware(['auth', 'admin'])->group(function () {
    
    // Gestion complète des Logements pour l'admin (sauf index/show qui sont publics)
    Route::resource('logements', LogementController::class)
        ->except(['index', 'show'])
        ->parameters(['logements' => 'id_logement']);

    // Gestion complète des Terrains pour l'admin (sauf index qui est public)
    Route::resource('terrains', TerrainController::class)
        ->except(['index', 'show'])
        ->parameters(['terrains' => 'id_terrain']);

    // Autres fichiers de gestion administrative
    require __DIR__.'/agence.php';
});


// ==========================================
// 4. AUTHENTIFICATION DE BASE (Connexion / Inscription)
// ==========================================
require __DIR__.'/auth.php';
require __DIR__.'/logements.php'; // Gardé ici si ce fichier contient d'autres routes spécifiques