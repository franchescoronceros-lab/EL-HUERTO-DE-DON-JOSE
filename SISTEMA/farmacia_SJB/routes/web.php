<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\configuracionesController;
use App\Http\Controllers\categoriesController;
use App\Http\Controllers\medicinesController;
use App\Http\Controllers\customersController;
use App\Http\Controllers\salesController;

Route::get('/', [dashboardController::class, 'index'])->name('dashboard.index');

Route::get('/configuraciones', [configuracionesController::class, 'index'])
    ->name('configuraciones.index');

Route::resource('customers', customersController::class);

Route::resource('categories', categoriesController::class);

Route::resource('medicines', medicinesController::class);

Route::resource('sales', salesController::class);