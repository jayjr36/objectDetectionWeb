<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorDataController;
use App\Http\Controllers\TextController;



Route::post('/messages', [TextController::class, ' updateGraph']);

Route::get('/fetch/detection-data', [SensorDataController::class, 'index']);
Route::post('/detection-data', [SensorDataController::class, 'store']);
