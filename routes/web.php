<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TextController;

Route::get('/', function () {
    return view('displaypage');
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [TextController::class, 'showGraph']);

Route::get('/datareceive', [TextController::class, 'updateGraph']);