<?php
use Illuminate\Support\Facades\Routes;
Route::view('/terrains','terrains.index');

Route::view('/rendezvous', 'terrains.PrendreRendezVous');