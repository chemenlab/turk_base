<?php

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/series/{id}', [HomeController::class, 'show']);
