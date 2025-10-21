<?php

namespace App\Http\Controllers\Admin;

use App\Constants\ReservaEstados;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservaRequest;
use App\Models\Barbero;
use App\Models\Cliente;
use App\Models\Reserva;
use App\Models\Servicio;

class ReservaController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $reservas = Reserva::orderBy('id', 'DESC')->paginate(10);
        return view('admin.reserva.index', compact('reservas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $clientes = Cliente::all();
        $barberos = Barbero::all();
        $servicios = Servicio::all();
        $estados = ReservaEstados::ESTADOS;
        return view('admin.reserva.create', compact('clientes', 'barberos', 'servicios', 'estados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservaRequest $request) {
        $reserva = Reserva::create([
            'cliente_id' => $request->cliente_id,
            'barbero_id' => $request->barbero_id,
            'fecha_hora' => $request->fecha_hora,
            'estado'     => $request->estado,
        ]);
        $reserva->servicios()->attach($request->servicios);
        return redirect()->route('reserva.index')->with('success', 'Reserva creada correctamente');
    }


    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva) {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserva $reserva) {
        $reserva->load('servicios');
        $clientes = Cliente::all();
        $barberos = Barbero::all();
        $servicios = Servicio::all();
        $estados = ReservaEstados::ESTADOS;
        return view('admin.reserva.edit', compact('reserva', 'clientes', 'barberos', 'servicios', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreReservaRequest $request, Reserva $reserva) {
        $reserva->update($request->all());
        $reserva->servicios()->sync($request->servicios);
        return redirect()->route('reserva.index')->with('success', 'Reserva actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserva $reserva) {
        $reserva->delete();
        return redirect()->route('reserva.index')->with('success', 'Reserva eliminada correctamente');
    }
}
