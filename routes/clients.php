<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

// ============================================
// ROUTES DE GESTION DES CLIENTS (CRUD)
// ============================================

// Route resource pour la gestion complète des clients
Route::resource('clients', ClientController::class);

// Si vous voulez des routes spécifiques en plus :
// Route::get('/clients/recherche', [ClientController::class, 'search'])->name('clients.search');
// Route::get('/clients/export', [ClientController::class, 'export'])->name('clients.export');