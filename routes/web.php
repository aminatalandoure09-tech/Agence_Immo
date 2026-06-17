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

