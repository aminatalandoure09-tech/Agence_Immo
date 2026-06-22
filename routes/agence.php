<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Affichage du Dashboard (accessible uniquement si connecté)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

Route::put('/dashboard/demande/{id}/statut/{status}', [DashboardController::class, 'updateStatus'])->name('demandes.status');
Route::delete('/dashboard/client/{id}', [DashboardController::class, 'destroyDemande'])->name('dashboard.demandes.destroy');
Route::delete('/dashboard/demande/{id}', [DashboardController::class, 'destroyClient'])->name('dashboard.clients.destroy');