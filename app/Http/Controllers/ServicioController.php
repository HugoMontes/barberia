<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServicioRequest;
use App\Http\Requests\UpdateServicioRequest;
use App\Models\Servicio;

class ServicioController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $servicios = Servicio::orderBy('id', 'DESC')->paginate(10);
        return view('admin.servicio.index', compact('servicios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('admin.servicio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServicioRequest $request) {
        if ($request->file('imagen')) {
            $file = $request->file('imagen');
            $name_file = 'servicio_' . time() . '.' . $file->getClientOriginalExtension();
            $path_file = public_path() . '/imagenes/servicios';
            $file->move($path_file, $name_file);
        }
        Servicio::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'imagen' => $name_file,
        ]);
        return redirect()->route('servicio.index')->with('success', 'Servicio creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Servicio $servicio) {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servicio $servicio) {
        return view('admin.servicio.edit', compact('servicio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServicioRequest $request, Servicio $servicio) {
        if (isset($request->imagen)) {
            if ($request->file('imagen')) {
                $file = $request->file('imagen');
                $name_file = 'servicio_' . time() . '.' . $file->getClientOriginalExtension();
                $path_file = public_path() . '/imagenes/servicios';
                $file->move($path_file, $name_file);
            }
            $servicio->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'imagen' => $name_file,
            ]);
        } else {
            $servicio->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
            ]);
        }
        return redirect()->route('servicio.index')->with('success', 'Servicio actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servicio $servicio) {
        $servicio->delete();
        return redirect()->route('servicio.index')->with('success', 'Servicio eliminado correctamente');
    }
}
