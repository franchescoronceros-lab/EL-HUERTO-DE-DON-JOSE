<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\RestTableController;
use App\Http\Controllers\WaiterOrderController;

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

// Ruta raíz redirige al login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de Autenticación
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// =========================================================================
// RUTAS PROTEGIDAS POR AUTENTICACIÓN Y ROL
// =========================================================================

// Grupo exclusivo para Administradores
Route::middleware(['auth', 'role:admin'])->group(function () {
    
    // Dashboard de Administración
    Route::get('/admin/dashboard', function () {
        return '
            <h1>Panel de Administración - El Huerto de Don José</h1>
            <p>Bienvenido Administrador. Datos protegidos.</p>
            <hr>
            <p><a href="'.route('menu-categories.index').'">👉 Gestionar Categorías del Menú</a></p>
            <p><a href="'.route('dishes.index').'">🍔 Gestionar Platos y Bebidas</a></p>
            <p><a href="'.route('tables.index').'">🪑 Gestionar Mesas del Salón</a></p>
            <hr>
            <form action="'.route('logout').'" method="POST">
                '.csrf_field().'
                <button type="submit" style="background: red; color: white; padding: 10px; border: none; cursor: pointer;">
                    Cerrar Sesión de Forma Segura
                </button>
            </form>
        ';
    })->name('admin.dashboard');

    // CRUDs de Administración con parámetro explícito restTable
    Route::resource('menu-categories', MenuCategoryController::class);
    Route::resource('dishes', DishController::class);
    Route::resource('tables', RestTableController::class)->parameters([
        'tables' => 'restTable'
    ]);
});

// Grupo exclusivo para Waiters (Mozos)
Route::middleware(['auth', 'role:waiter'])->group(function () {
    
    // Panel Principal de Mesas (Salón en Tiempo Real)
    Route::get('/mozo/dashboard', [WaiterOrderController::class, 'index'])->name('waiter.dashboard');
    Route::get('/mozo/mesas', [WaiterOrderController::class, 'index'])->name('waiter.index');

    // Apertura de Comandas (Parámetro explícito restTable)
    Route::get('/mozo/mesas/{restTable}/abrir', [WaiterOrderController::class, 'create'])->name('waiter.orders.create');
    Route::post('/mozo/mesas/{restTable}/abrir', [WaiterOrderController::class, 'store'])->name('waiter.orders.store');

    // Panel de Gestión de Comanda Activa e Inserción de Platos
    Route::get('/mozo/mesas/{restTable}/pedido', [WaiterOrderController::class, 'show'])->name('waiter.orders.show');
    Route::post('/mozo/mesas/{restTable}/pedido/agregar', [WaiterOrderController::class, 'addDish'])->name('waiter.orders.add_dish');
});