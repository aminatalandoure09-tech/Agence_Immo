<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogementController;

Route::middleware(['auth'])->group(function () {
    // Écran d'affichage du formulaire (GET)
    Route::get('/logements/create', [LogementController::class, 'create'])->name('logements.create');
    
    // Traitement de la soumission du formulaire (POST)
    Route::post('/logements', [LogementController::class, 'store'])->name('logements.store');
    
    // Édition et Suppression
    Route::get('/logements/{id}/edit', [LogementController::class, 'edit'])->name('logements.edit');
    Route::put('/logements/{id}', [LogementController::class, 'update'])->name('logements.update');
    Route::delete('/logements/{id}', [LogementController::class, 'destroy'])->name('logements.destroy');
});