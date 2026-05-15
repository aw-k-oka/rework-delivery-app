<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Shipment\RegistrationController;
use App\Http\Controllers\Shipment\SearchController;
use App\Http\Controllers\Shipment\StatusController;
use App\Http\Controllers\TopController;

Route::get('/guest', [TopController::class, 'index'])->name('top');

Route::get('/login', [LoginController::class, 'index']);

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/search', [SearchController::class, 'index'])->name('shipment.search.index');

Route::get('/search/result', [SearchController::class, 'result'])->name('shipment.search.result');

Route::get('/registration', [RegistrationController::class, 'index'])->name('shipment.registration.index');

Route::post('/registration/confirm', [RegistrationController::class, 'confirm'])->name('shipment.registration.confirm');

Route::post('/registration/complete', [RegistrationController::class, 'store'])->name('shipment.registration.complete');

Route::post('/status/deliver', [StatusController::class, 'deliver'])->name('shipment.status.deliver');

Route::post('/status/return', [StatusController::class, 'backToOffice'])->name('shipment.status.backToOffice');

Route::post('/status/complete', [StatusController::class, 'complete'])->name('shipment.status.complete');
