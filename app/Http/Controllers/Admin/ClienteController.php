<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\Cliente;
use App\Models\User;

class ClienteController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $clientes = Cliente::orderBy('id', 'DESC')->paginate(10);
        return view('admin.cliente.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('admin.cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteRequest $request) {
        $user = User::create([
            'name' => $request->nombre,
            'email'    => $request->email,
            'password' => isset($request->status) ? $request->password : '',
            'role' => 'cliente',
            'status' => isset($request->status) ? 'activo' : 'inactivo',
        ]);

        Cliente::create([
            'user_id'  => $user->id,
            'nombre'   => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
        ]);

        return redirect()->route('cliente.index')
            ->with('success', 'Cliente registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente) {
        $cliente = Cliente::findOrFail($cliente->id);
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente) {
        $cliente = Cliente::findOrFail($cliente->id);
        return view('admin.cliente.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClienteRequest $request, Cliente $cliente) {
        $user = User::findOrFail($cliente->user_id);
        $user->email = $request->email;
        $user->update();

        $cliente->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
        ]);

        return redirect()->route('cliente.index')->with('success', 'Cliente actualizado.corectamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente) {
        $cliente->delete();
        return redirect()->route('cliente.index')->with('success', 'cliente eliminado correctamente');
    }
}
