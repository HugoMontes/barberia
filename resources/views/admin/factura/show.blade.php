@extends('admin.layouts.main')

@section('title', 'Detalle de Factura')

@section('content')
<div class="card card-primary card-outline mb-4">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="card-title">Factura #{{ $factura->id }}</div>
            <a href="{{ route('factura.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>

    <div class="card-body">
        <!-- Información general de la factura -->
        <h5>Cliente:</h5>
        <p>{{ $factura->cliente->nombre }} {{ $factura->cliente->apellido }}</p>

        <h5>Descripción:</h5>
        <p>{{ $factura->descripcion }}</p>

        <h5>Precio total:</h5>
        <p>${{ number_format($factura->total, 2) }}</p>

        <!-- Detalle de la factura -->
        <h5 class="mt-4">Servicios incluidos:</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>ID Servicio</th>
                    <th>Nombre Servicio</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($factura->detalles as $detalle)
                    <tr>
                        <td>{{ $detalle->servicio->id }}</td>
                        <td>{{ $detalle->servicio->nombre }}</td>
                        <td>${{ number_format($detalle->precio, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer">
        <a href="{{ route('factura.index') }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i> Volver
        </a>
    </div>
</div>
@endsection
