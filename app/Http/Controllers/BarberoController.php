<?php

namespace App\Http\Controllers;

use App\Models\Barbero;
use Illuminate\Http\Request;

class BarberoController extends Controller
{
    /**
     * Display a listing of the resource.
     */ 
    public function index()
    {
        // Trae todos los registros de la tabla 'barberos' usando el modelo Barbero
    $barberos = Barbero::all();
           // dd($barberos);
    // Retorna la vista 'barberos.index' y pasa la variable $barberos a la vista
    // 'compact' crea un arreglo ['barberos' => $barberos] para que la vista pueda usarlo
    return view('admin.barbero.index', compact('barberos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         // Mostrar la vista con el formulario de creación
    // Aquí el usuario puede ingresar nombre, apellido, email y especialidad
    return view('admin.barbero.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos que vienen del formulario
    // Se asegura que se cumplan las reglas antes de guardar
    $request->validate([
        'nombre' => 'required|string|max:255',          // obligatorio, texto, máximo 255 caracteres
        'apellido' => 'required|string|max:255',        // obligatorio, texto, máximo 255 caracteres
        'email' => 'required|email|unique:barberos,email', // obligatorio, email válido, único en la tabla barberos
        'especialidad' => 'required|string|max:255',    // obligatorio, texto, máximo 255 caracteres
    ]);

    // Crear un nuevo barbero en la base de datos usando el modelo
    // $request->all() trae todos los campos enviados por el formulario
    Barbero::create($request->all());

    // Redirigir al listado de barberos con un mensaje de éxito
    return redirect()->route('barbero.index')->with('success', 'Barbero creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barbero $barbero)
    {
        
    // Muestra los datos de un barbero específico
    // $barbero ya tiene los datos gracias a Laravel (model binding)
    return view('admin.barbero.show', compact('barbero'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barbero $barbero)
    {
         // Muestra el formulario para editar un barbero
    // $barbero ya tiene los datos gracias al model binding
    return view('admin.barbero.edit', compact('barbero'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barbero $barbero)
    {
         // Validar los datos enviados por el formulario
    $request->validate([
        'nombre' => 'required|string|max:255',            // obligatorio
        'apellido' => 'required|string|max:255',          // obligatorio
        'email' => 'required|email|unique:barberos,email,'.$barbero->id, // obligatorio, único, excepto este barbero
        'especialidad' => 'required|string|max:255',      // obligatorio
    ]);

    // Actualizar los datos del barbero en la base de datos
    $barbero->update($request->all());

    // Redirigir al listado de barberos con un mensaje de éxito
    return redirect()->route('barbero.index')->with('success', 'Barbero actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barbero $barbero)
    {
            // Eliminar el barbero de la base de datos
    $barbero->delete();

    // Redirigir al listado de barberos con un mensaje de éxito
    return redirect()->route('barbero.index')->with('success', 'Barbero eliminado correctamente');
    }
}
