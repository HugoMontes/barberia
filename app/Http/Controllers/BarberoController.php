<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBarberoRequest;
use App\Http\Requests\UpdateBarberoRequest;
use App\Models\Barbero;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BarberoController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $barberos = Barbero::orderBy('id', 'DESC')->paginate(10);
        return view('admin.barbero.index', compact('barberos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('admin.barbero.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBarberoRequest $request) {
        $user = User::create([
            'name' => $request->nombre,
            'email'    => $request->email,
            'password' =>  Hash::make($request->password),
            'role' => 'barbero',
            'status' => 'activo',
        ]);
        Barbero::create([
            'user_id'  => $user->id,
            'nombre'   => $request->nombre,
            'apellido' => $request->apellido,
            'especialidad' => $request->especialidad,
        ]);
        return redirect()->route('barbero.index')->with('success', 'Barbero creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barbero $barbero) {
        return view('admin.barbero.show', compact('barbero'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barbero $barbero) {
        $barbero = Barbero::findOrFail($barbero->id);
        return view('admin.barbero.edit', compact('barbero'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBarberoRequest $request, Barbero $barbero) {
        $user = User::findOrFail($barbero->user_id);
        $user->email = $request->email;
        $user->update();

        $barbero->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'especialidad' => $request->especialidad,
        ]);
        return redirect()->route('barbero.index')->with('success', 'Barbero actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barbero $barbero) {
        $barbero->delete();
        return redirect()->route('barbero.index')->with('success', 'Barbero eliminado correctamente');
    }
}
