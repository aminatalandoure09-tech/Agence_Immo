<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/', 'layouts.app');

require __DIR__.'/logements.php';
require __DIR__.'/terrains.php';
require __DIR__.'/clients.php';
require __DIR__.'/agence.php';
use App\Http\Controllers\AuthClientController;
use App\Http\Controllers\ClientDashboardController;

// Routes d'authentification client
Route::get('client/register', [AuthClientController::class, 'showRegisterForm'])->name('client.register');
Route::post('client/register', [AuthClientController::class, 'register']);
Route::get('client/login', [AuthClientController::class, 'showLoginForm'])->name('client.login');
Route::post('client/login', [AuthClientController::class, 'login']);
Route::post('client/logout', [AuthClientController::class, 'logout'])->name('client.logout');

// Dashboard client (protégé)
Route::middleware(['auth.client'])->prefix('client')->group(function () {
    Route::get('dashboard', [ClientDashboardController::class, 'index'])->name('client.dashboard');
});
