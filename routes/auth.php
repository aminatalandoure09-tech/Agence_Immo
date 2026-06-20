<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Routes invités (accessibles uniquement si non connecté)
Route::middleware('guest')->group(function () {
    Route::get('/connexion', [AuthController::class, 'showConnexion'])->name('connexion');
    Route::post('/connexion', [AuthController::class, 'connexion'])->name('connexion.submit');
    
    Route::get('/inscription', [AuthController::class, 'showInscription'])->name('inscription');
    Route::post('/inscription', [AuthController::class, 'inscription'])->name('inscription.submit');
});

// Route de déconnexion
Route::post('/deconnexion', [AuthController::class, 'deconnexion'])->name('deconnexion')->middleware('auth');