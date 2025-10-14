<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\DetalleFactura;
use App\Models\Factura;
use App\Models\Reserva;
use App\Models\Servicio;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facturas = Factura::with('cliente')->get(); // Trae las facturas junto con info del cliente
return view('admin.factura.index', compact('facturas'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $clientes = Cliente::all();    // Todos los clientes
    $reservas = Reserva::all();    // Todas las reservas
    $servicios = Servicio::all();  // Todos los servicios

    return view('admin.factura.create', compact('clientes', 'reservas', 'servicios'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos del formulario
    $request->validate([
        'id_cliente' => 'required|exists:clientes,id',  // El cliente es obligatorio y debe existir
        'id_reserva' => 'required|exists:reservas,id',  // La reserva es obligatoria y debe existir
        // 'precio'     => 'required|numeric',            // El precio es obligatorio y debe ser un número
        'descripcion'=> 'nullable|string',             // La descripción es opcional
        'servicios'  => 'required|array',              // Los servicios deben ser enviados como un arreglo
        'servicios.*'=> 'exists:servicios,id',         // Cada servicio debe existir en la tabla servicios
    ]);

    // Crear la factura principal
    $factura = Factura::create([
        'id_cliente' => $request->id_cliente,
        'id_reserva' => $request->id_reserva,
        // 'precio'     => $request->precio,
        'precio'     =>0,
        'descripcion'=> $request->descripcion,
        // 'total'      => $request->precio, // Puedes ajustar si el total depende de los servicios
         'total' =>0,
    ]);

    // Guardar los detalles de la factura (relación 1 a N con detalle_factura)
    foreach ($request->servicios as $servicio_id) {
        DetalleFactura::create([
            'id_factura' => $factura->id,
            'id_servicio'=> $servicio_id,
            'id_reserva' => $request->id_reserva,
            'precio'     => Servicio::find($servicio_id)->precio, // Tomamos el precio del servicio
        ]);
    }

    // Redirigir al listado de facturas con un mensaje de éxito
    return redirect()->route('factura.index')->with('success', 'Factura creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Factura $factura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factura $factura)
    {
        // Trae todos los clientes para el select
    $clientes = Cliente::all();

    // Trae todas las reservas para poder seleccionar la reserva asociada
    $reservas = Reserva::all();

    // Trae todos los servicios disponibles
    $servicios = Servicio::all();

    // Trae los detalles de la factura para marcar los servicios ya seleccionados
    $detalle = $factura->detalles; // Relación hasMany desde el modelo Factura

    // Retorna la vista de edición con todos los datos necesarios
    return view('admin.factura.edit', compact('factura', 'clientes', 'reservas', 'servicios', 'detalle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Factura $factura)
    {
        // Validar los datos recibidos del formulario
    $request->validate([
        'total' => 'required|numeric',         // El total debe ser un número
        'descripcion' => 'required|string',    // Descripción obligatoria
        'precio' => 'required|numeric',        // Precio debe ser numérico
        'id_cliente' => 'required|exists:clientes,id',  // Cliente debe existir
        'id_reserva' => 'required|exists:reservas,id',  // Reserva debe existir
        'servicios' => 'required|array',       // Servicios es un arreglo
        'servicios.*' => 'exists:servicios,id' // Cada servicio debe existir en la tabla servicios
    ]);

    // Actualizar los campos de la factura
    $factura->update($request->only('total', 'descripcion', 'precio', 'id_cliente'));

    // Eliminar los detalles de factura existentes para reemplazarlos
    $factura->detalles()->delete();

    // Guardar los nuevos detalles de la factura
    foreach ($request->servicios as $servicio_id) {
        $factura->detalles()->create([
            'id_reserva' => $request->id_reserva,
            'id_servicio' => $servicio_id,
            'precio' => $request->precio,  // Se podría ajustar por servicio
        ]);
    }

    // Redirigir al listado de facturas con mensaje de éxito
    return redirect()->route('factura.index')->with('success', 'Factura actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factura $factura)
    {
        // Primero eliminamos todos los detalles asociados a la factura
    $factura->detalles()->delete();

    // Luego eliminamos la factura principal
    $factura->delete();

    // Redirigir al listado de facturas con mensaje de éxito
    return redirect()->route('factura.index')->with('success', 'Factura eliminada correctamente');
    }
}
