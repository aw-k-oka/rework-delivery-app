<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;
use App\Http\Controllers\RegistrationController;

Route::get('/guest', [TopController::class, 'index']);

Route::get('/registration', [RegistrationController::class, 'index']);

Route::post('/registration/confirm', [RegistrationController::class, 'confirm']);

Route::post('/registration/complete', [RegistrationController::class, 'store']);
