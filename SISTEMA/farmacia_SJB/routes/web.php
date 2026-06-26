<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Redirección de la raíz del sitio al Login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de Autenticación (Públicas)
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


// ==========================================
// RUTAS PROTEGIDAS POR AUTENTICACIÓN Y ROL
// ==========================================

// Grupo exclusivo para Administradores
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return 'Panel de Administración de El Huerto de Don José - Próximamente';
    })->name('admin.dashboard');
});

// Grupo exclusivo para Waiters (Unificado con la Base de Datos)
Route::middleware(['auth', 'role:waiter'])->group(function () {
    Route::get('/mozo/dashboard', function () {
        return 'Panel de Mozos (Mesas y Pedidos) - Próximamente';
    })->name('waiter.dashboard');
});