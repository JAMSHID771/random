<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\RandomController;

Route::get('/random', [RandomController::class, 'showRandomView']);
Route::get('/generate-random-numbers', [RandomController::class, 'generateRandomNumbers']);
