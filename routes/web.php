<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BarberoController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\FacturaController;
use App\Http\Controllers\Admin\ReservaController;
use App\Http\Controllers\Admin\ServicioController;
use App\Http\Controllers\Barbero\BarberoReservaController;
use App\Http\Controllers\Barbero\DashboardBarberoController;

Route::get('/', function () {
    return view('web.index');
})->name('web.index');

Route::get('/about', function () {
    return view('web.about');
})->name('web.about');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('cliente', ClienteController::class);
    Route::resource('barbero', BarberoController::class);
    Route::resource('servicio', ServicioController::class);
    Route::resource('reserva', ReservaController::class);
    Route::resource('factura', FacturaController::class);
    Route::get('/factura/reserva/detalle/{reserva_id}', [FacturaController::class, 'detalleFactura'])->name('factura.reserva.detalle');
});

Route::prefix('barbero')->middleware('auth')->as('barbero.')->group(function () {
    Route::get('/dashboard', [DashboardBarberoController::class, 'index'])->name('dashboard');
    Route::resource('perfil', BarberoReservaController::class);
    Route::resource('reserva', BarberoReservaController::class);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
