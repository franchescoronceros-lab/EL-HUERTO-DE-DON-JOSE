<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\configuracionesController;

use App\Http\Controllers\categoriesController;
use App\Http\Controllers\medicinesController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\salesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/',[dashboardController::class, 'index'])->name('dashboard.index');
Route::get('configuraciones', [configuracionesController::class, 'index'])->name('configuaciones.index');

Route::get('/', [dashboardController::class, 'index'])->name('dashboard.index');

Route::resource('categories', categoriesController::class);
Route::resource('medicines', medicinesController::class);
Route::resource('customer', customersController::class);
Route::resource('sales', salesController::class);