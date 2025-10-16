<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BarberoController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\FacturaController;
use App\Http\Controllers\Admin\ReservaController;
use App\Http\Controllers\Admin\ServicioController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/plantilla', function () {
    return view('admin.layouts.main');
});

Route::resource('cliente', ClienteController::class);
Route::resource('barbero', BarberoController::class);
Route::resource('servicio', ServicioController::class);
Route::resource('reserva', ReservaController::class);
Route::resource('factura', FacturaController::class);
Route::get('factura/reserva/detalle/{reserva_id}', [FacturaController::class, 'detalleFactura'])->name('factura.reserva.detalle');
