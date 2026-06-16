<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/logements.php';
require __DIR__.'/terrains.php';
require __DIR__.'/clients.php';
require __DIR__.'/agences.php';