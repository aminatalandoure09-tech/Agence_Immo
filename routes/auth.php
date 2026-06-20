<?php

use App\Http\Controllers\AuthClientController;
use App\Http\Controllers\ClientDashboardController;
use Illuminate\Support\Facades\Route;

// ============================================
// ROUTES D'AUTHENTIFICATION CLIENT
// ============================================

// Inscription
Route::get('/client/register', [AuthClientController::class, 'showRegisterForm'])->name('client.register');
Route::post('/client/register', [AuthClientController::class, 'register']);

// Connexion
Route::get('/client/login', [AuthClientController::class, 'showLoginForm'])->name('client.login');
Route::post('/client/login', [AuthClientController::class, 'login']);

// Déconnexion
Route::post('/client/logout', [AuthClientController::class, 'logout'])->name('client.logout');

// ============================================
// DASHBOARD CLIENT (PROTÉGÉ)
// ============================================
Route::middleware(['auth.client'])->prefix('client')->group(function () {
    Route::get('/dashboard', [ClientDashboardController::class, 'index'])->name('client.dashboard');
});
