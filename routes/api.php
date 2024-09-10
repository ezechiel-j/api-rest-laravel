<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BirdController;
use App\Http\Controllers\AuthController;

Route::get('/birds', [BirdController::class, 'index']);


//authentification
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('me', [AuthController::class, 'me']);
