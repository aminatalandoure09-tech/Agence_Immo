<?php

use App\Http\Controllers\TerrainController;
use Illuminate\Support\Facades\Route;


Route::get('/terrains/ajouter', function () {
    return view('agence.terrains.AjouterTerrain');
});

Route::get('/agence/modifier', function () {
    return view('agence.terrains.ModifierTerrain');
});