<?php

namespace App\Http\Controllers\Admin;

use App\Constants\ReservaEstados;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFacturaRequest;
use App\Models\Cliente;
use App\Models\DetalleFactura;
use App\Models\Factura;
use App\Models\Reserva;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FacturaController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $facturas = Factura::orderBy('id', 'DESC')->paginate(10);
        return view('admin.factura.index', compact('facturas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $reservas = Reserva::where('estado', ReservaEstados::COMPLETADA)->get();
        $servicios = Servicio::all();
        return view('admin.factura.create', compact('reservas', 'servicios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFacturaRequest $request) {
        DB::beginTransaction();
        try {
            // Crear la factura principal
            $factura = Factura::create([
                'reserva_id' => $request->reserva_id,
                'fecha_emision' => now(),
                'nombre_comprador' => $request->nombre_comprador,
                'nit_comprador' => $request->nit_comprador,
                'descripcion' => $request->descripcion,
                'total' => $request->total,
            ]);

            // Guardar los detalles de la factura (relación 1 a N con detalle_factura)
            foreach ($request->servicios as $servicio_id) {
                $precioServicio = Servicio::find($servicio_id)->precio; // Tomamos el precio del servicio
                $cantidad = 1; // Cantidad por default 1
                DetalleFactura::create([
                    'factura_id' => $factura->id,
                    'servicio_id' => $servicio_id,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precioServicio,
                    'subtotal' => $cantidad * $precioServicio,
                ]);
            }

            // Cambiar estado de reserva
            if (isset($request->reserva_id)) {
                $reserva = Reserva::findOrFail($request->reserva_id);
                $reserva->estado = ReservaEstados::FACTURADA;
                $reserva->update();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error en transacción:', ['error' => $e->getMessage()]);
            return redirect()->route('factura.index')->with('error', 'Error al guardar factura');
        }
        return redirect()->route('factura.index')->with('success', 'Factura creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Factura $factura) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factura $factura) {
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
    public function update(Request $request, Factura $factura) {
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
    public function destroy(Factura $factura) {
        // Primero eliminamos todos los detalles asociados a la factura
        $factura->detalles()->delete();

        // Luego eliminamos la factura principal
        $factura->delete();

        // Redirigir al listado de facturas con mensaje de éxito
        return redirect()->route('factura.index')->with('success', 'Factura eliminada correctamente');
    }

    public function detalleFactura(Request $request, int $reservaId) {
        $servicios = Servicio::all();
        $reserva = Reserva::findOrFail($reservaId);
        $reserva->load('servicios');
        return response()->json([
            'html' => view('admin.factura.partials.create-detalle-factura', compact('servicios', 'reserva'))->render(),
            'apellido_cliente' => $reserva->cliente->apellido,
        ]);
    }
}
