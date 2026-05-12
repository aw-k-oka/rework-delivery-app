<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SearchController;

Route::get('/guest', [TopController::class, 'index']);

Route::get('/login', [LoginController::class, 'index']);

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/search', [SearchController::class, 'index']);

Route::get('/search/result', [SearchController::class, 'result']);

Route::get('/registration', [RegistrationController::class, 'index']);

Route::post('/registration/confirm', [RegistrationController::class, 'confirm']);

Route::post('/registration/complete', [RegistrationController::class, 'store']);
