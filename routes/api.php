<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorDataController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/noise-data', [SensorDataController::class, 'index']);
Route::post('/noise-data', [SensorDataController::class, 'store']);