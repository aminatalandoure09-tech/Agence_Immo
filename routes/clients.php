<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Suppression d'un client (via sa clé primaire personnalisée)
Route::delete('/clients/{id_utilisateur}', [DashboardController::class, 'destroyClient'])
    ->name('clients.destroy')
    ->middleware('auth');

    