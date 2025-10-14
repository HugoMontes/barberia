<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Trae todos los clientes de la base de datos usando el modelo Cliente
        $clientes = Cliente::all();
        // dd($clientes);
        // Retorna la vista 'clientes.index' y le pasa la variable $clientes
        // Compact crea un arreglo con la variable que se va a usar en la vista
        return view('admin.cliente.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
        public function create()
        {
            // Mostrar la vista con el formulario para crear un nuevo cliente
            // La vista estará en resources/views/clientes/create.blade.php
            return view('admin.cliente.create');
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    // 1️⃣ Validar datos
    $request->validate([
        'nombre'   => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'email'    => 'required|email|unique:clientes,email',
        'telefono' => 'nullable|string|max:20',
    ]);

    // 2️⃣ Obtener el usuario logueado
    $idUsuario = Auth::id(); 

    // 3️⃣ Crear el cliente
    
    Cliente::create([
        'id_user'  => $idUsuario, // aquí se usa
        'nombre'   => $request->nombre,
        'apellido' => $request->apellido,
        'email'    => $request->email,
        'telefono' => $request->telefono,
    ]);

    // 4️⃣ Redirigir
    return redirect()->route('cliente.index')
                     ->with('success', 'Cliente registrado correctamente.');
}

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        $cliente = Cliente::findOrFail($cliente->id);
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        $cliente = Cliente::findOrFail($cliente->id);
        return view('admin.cliente.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email',
            'telefono' => 'nullable|string|max:15', // puede ser opcional
        ]);
        $cliente = Cliente::find($cliente->id);
        // 2️⃣ Crear un nuevo cliente con los datos validados
        $cliente->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'telefono' => $request->telefono,
        ]);

        // 3️⃣ Redirigir al listado de clientes con un mensaje de éxito
        return redirect()->route('cliente.index')->with('success', 'Cliente actualizado.corectamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        // Redirigir al listado de barberos con un mensaje de éxito
        return redirect()->route('cliente.index')->with('success', 'cliente eliminado correctamente');
    }
}
