<?php

use App\Http\Controllers\TerrainController;
use Illuminate\Support\Facades\Route;


Route::resource('/agence/terrains',TerrainController::class)->names('terrains');