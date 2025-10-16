<?php

namespace App\Http\Controllers\Admin;

use App\Constants\FacturaEstados;
use App\Constants\ReservaEstados;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFacturaRequest;
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Factura $factura) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factura $factura) {
        $factura->estado = FacturaEstados::ANULADA;
        $factura->descripcion = '-- FACTURA ANULADA EN FECHA ' . now()->format('d/m/Y H:i');
        $factura->update();
        return redirect()->route('factura.index')->with('success', 'Factura anulada correctamente');
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
