<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Trae todos los registros de la tabla 'servicios' usando el modelo Servicio
        $servicios = Servicio::all();

        // Retorna la vista 'admin.servicio.index' y pasa la variable $servicios a la vista
        // 'compact' crea un arreglo ['servicios' => $servicios] para que la vista pueda usarlo
        return view('admin.servicio.index', compact('servicios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retorna la vista del formulario para crear un nuevo servicio
        // Aquí no necesitamos pasar datos porque los campos serán llenados por el usuario
        return view('admin.servicio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos enviados desde el formulario
        $request->validate([
            'nombre' => 'required|string|max:255',        // obligatorio, texto, max 255 caracteres
            'descripcion' => 'nullable|string|max:500',   // opcional, texto, max 500 caracteres
            'precio' => 'required|numeric',               // obligatorio, debe ser un número
            'imagen' => 'required|string|max:255',        // obligatorio, nombre de la imagen o ruta
        ]);

        // Crear un nuevo registro en la tabla 'servicios' con los datos validados
        Servicio::create($request->all());

        // Redirigir al listado de servicios con un mensaje de éxito
        return redirect()->route('servicio.index')->with('success', 'Servicio creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Servicio $servicio) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servicio $servicio)
    {
        // Muestra el formulario para editar un servicio específico
        // Gracias al model binding, $servicio ya contiene los datos del servicio seleccionado
        return view('admin.servicio.edit', compact('servicio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Servicio $servicio)
    {
        // Validar los datos enviados desde el formulario
        $request->validate([
            'nombre' => 'required|string|max:255',       // obligatorio, texto, máximo 255 caracteres
            'descripcion' => 'nullable|string|max:500',  // opcional, texto, máximo 500 caracteres
            'precio' => 'required|numeric',              // obligatorio, debe ser un número
            'imagen' => 'nullable|string|max:255',       // opcional, texto
        ]);

        // Actualizar el servicio en la base de datos con los datos validados
        $servicio->update($request->all());

        // Redirigir al listado de servicios con un mensaje de éxito
        return redirect()->route('servicio.index')->with('success', 'Servicio actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servicio $servicio)
    {
        // Elimina el servicio de la base de datos
        $servicio->delete();

        // Redirige al listado de servicios con un mensaje de éxito
        return redirect()->route('servicio.index')->with('success', 'Servicio eliminado correctamente');
    }
}
