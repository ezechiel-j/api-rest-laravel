<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BirdController;

Route::get('/birds', [BirdController::class, 'index']);