<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Shipment\RegistrationController;
use App\Http\Controllers\Shipment\SearchController;
use App\Http\Controllers\Shipment\StatusController;
use App\Http\Controllers\TopController;
use Illuminate\Support\Facades\Route;

// Top
Route::get('/delivery/customer/top', [TopController::class, 'index'])->name('customer.top');

// Auth
Route::get('/staff/login', [LoginController::class, 'staffIndex']);
Route::post('/staff/login', [LoginController::class, 'staffLogin'])->name('staff.login');

Route::get('/delivery/login', [LoginController::class, 'customerIndex']);
Route::post('/delivery/login', [LoginController::class, 'customerLogin'])->name('customer.login');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/logout', [LoginController::class, function () {
    abort(403);
}]);

// Shipment Search
Route::prefix('search')
    ->name('shipment.search.')
    ->controller(SearchController::class)
    ->group(function () {

        Route::get('/', 'index')->name('index');

        Route::get('/list', 'search')->name('list');

        Route::get('/result', 'result')->name('result');
    });

// Shipment Registration
Route::prefix('registration')
    ->name('shipment.registration.')
    ->controller(RegistrationController::class)
    ->group(function () {

        Route::get('/', 'index')->name('index');

        Route::post('/confirm', 'confirm')->name('confirm');
        Route::get('/confirm', 'rejectConfirmAccess');

        Route::post('/store', 'store')->name('store');
        Route::get('/store', function () {
            abort(403);
        });

        Route::get('/complete', 'complete')->name('complete');
    });

// Shipment Status
Route::prefix('status')
    ->name('shipment.status.')
    ->controller(StatusController::class)
    ->group(function () {

        Route::post('/deliver', 'deliver')->name('deliver');
        Route::get('/deliver', function () {
            abort(403);
        });

        Route::post('/return', 'backToOffice')->name('backToOffice');
        Route::get('/return', function () {
            abort(403);
        });

        Route::post('/complete', 'complete')->name('complete');
        Route::get('/complete', function () {
            abort(403);
        });
    });
