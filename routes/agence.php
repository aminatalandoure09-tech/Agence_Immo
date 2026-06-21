<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Affichage du Dashboard (accessible uniquement si connecté)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');