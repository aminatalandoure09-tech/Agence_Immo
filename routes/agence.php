<?php

use Illuminate\Support\Facades\Route;


Route::get('/terrains/ajouter', function () {
    return view('agence.terrains.AjouterTerrain');
})->name('terrains.create');

Route::get('/agence/modifier', function () {
    return view('agence.terrains.ModifierTerrain');
})->name('terrains.edit');

Route::get('/logements/ajouter', function () {
    return view('agence.logements.AjouterLogement');
})->name('logements.create');

Route::get('/logements/modifier', function () {
    return view('agence.logements.ModifierLogement');
})->name('logements.edit');

Route::get('/dashboard', function () {
    return view('agence.dashboard');
})->name('dashboard');