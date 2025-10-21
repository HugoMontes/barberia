<?php

namespace App\Http\Controllers\Barbero;

use App\Constants\ReservaEstados;
use App\Http\Controllers\Controller;
use App\Models\Barbero;
use App\Models\Reserva;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarberoReservaController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $barbero = Auth::user()->barbero;
        $reservas = Reserva::where('barbero_id', $barbero->id)
            ->orderBy('id', 'DESC')
            ->paginate(10);
        return view('barbero.reserva.index', compact('reservas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserva $reserva) {
        $reserva->load('servicios');
        $barberos = Barbero::all();
        $servicios = Servicio::all();
        $estados = ReservaEstados::ESTADOS_PARA_BARBEROS;
        return view('barbero.reserva.edit', compact('reserva', 'servicios', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserva $reserva) {
        $reserva->update($request->all());
        $reserva->servicios()->sync($request->servicios);
        return redirect()->route('barbero.reserva.index')->with('success', 'Reserva actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //
    }
}
