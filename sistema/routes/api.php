<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AnimalApiController;
use App\Http\Controllers\Api\ConsejoApiController;
Route::apiResource('consejos', ConsejoApiController::class);

Route::get('/animales', [AnimalApiController::class, 'index']);
Route::get('/animales/{id}', [AnimalApiController::class, 'show']);
Route::post('/animales', [AnimalApiController::class, 'store']);
Route::put('/animales/{id}', [AnimalApiController::class, 'update']);
Route::delete('/animales/{id}', [AnimalApiController::class, 'destroy']);