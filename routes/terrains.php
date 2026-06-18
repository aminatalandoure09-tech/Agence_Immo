<?php

use Illuminate\Support\Facades\Route;

Route::get('/terrains', function () {
    return view('agence.terrains.index');
});

Route::get('/terrains/ajouter', function () {
    return view('agence.terrains.AjouterTerrain');
});

Route::get('/terrains/modifier', function () {
    return view('agence.terrains.ModifierTerrain');
});