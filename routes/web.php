<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogementController;
use App\Http\Controllers\TerrainController;
use App\Http\Controllers\RendezVousController;



// Remplacez Route::view('/', 'layouts.app'); par :
Route::get('/', function () {
    return view('accueil.index');
})->name('home');



Route::resource('logements', LogementController::class)->parameters([
        'logements' => 'id_logement' // Force Laravel à utiliser $id_logement au lieu de $logement
    ]);
// Route publique pour les clients
Route::get('/logements', [LogementController::class, 'index'])->name('logements.index');


Route::get('/nos-terrains', [TerrainController::class, 'index'])->name('terrains.index');


// 2. ROUTES PROTÉGÉES : Uniquement pour l'administration (connexion requise)
Route::middleware('auth')->group(function () {
    
    // On protège toutes les autres actions (create, store, edit, update, destroy)
    Route::resource('terrains', TerrainController::class)
        ->except(['index']) // On dit à Laravel de ne pas recréer la route index ici
        ->parameters([
            'terrains' => 'id_terrain'
        ]);
        
});

Route::post('/rendezvous', [RendezVousController::class, 'store'])->name('rendezvous.store');

require __DIR__.'/logements.php';
require __DIR__.'/terrains.php';
require __DIR__.'/clients.php';
require __DIR__.'/agence.php';
require __DIR__.'/auth.php';
require __DIR__.'/rendezVous.php';





