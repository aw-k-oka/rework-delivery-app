<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Shipment\RegistrationController;
use App\Http\Controllers\Shipment\SearchController;
use App\Http\Controllers\Shipment\StatusController;
use App\Http\Controllers\TopController;

Route::get('/guest', [TopController::class, 'index']);

Route::get('/login', [LoginController::class, 'index']);

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/search', [SearchController::class, 'index']);

Route::get('/search/result', [SearchController::class, 'result']);

Route::get('/registration', [RegistrationController::class, 'index']);

Route::post('/registration/confirm', [RegistrationController::class, 'confirm']);

Route::post('/registration/complete', [RegistrationController::class, 'store']);

Route::post('/status/deliver', [StatusController::class, 'deliver']);

Route::post('/status/return', [StatusController::class, 'return']);

Route::post('/status/complete', [StatusController::class, 'complete']);
