{{-- resources/views/admin/factura/create.blade.php --}}
@extends('layouts.admin.main')

@section('title', 'Crear Factura')

@section('content')
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <h3 class="card-title">Crear Nueva Factura</h3>
        </div>

        {{-- Mostrar errores de validación --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulario para crear factura --}}
        <form action="{{ route('factura.store') }}" method="POST">
            @csrf
            <div class="card-body">

                {{-- Seleccionar Reserva --}}
                <div class="form-group mb-3">
                    <label for="reserva_id">Reserva:</label>
                    <select name="reserva_id" id="reserva_id" class="form-control">
                        <option value="">-- Selecciona una Reserva --</option>
                        @foreach ($reservas as $reserva)
                            <option value="{{ $reserva->id }}">
                                {{ $reserva->fecha_hora }} -
                                {{ $reserva->cliente->nombre }}
                                {{ $reserva->cliente->apellido }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Nombre Comprador -->
                <div class="mb-3">
                    <label for="nombre_comprador" class="form-label @error('nombre_comprador') is-invalid @enderror">
                        Nombre / Razon Social:
                    </label>
                    <input type="text" class="form-control" id="nombre_comprador" name="nombre_comprador"
                        value="{{ old('nombre_comprador') }}" placeholder="Ingrese nombre para la factura" required>
                    @error('nombre_comprador')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- NIT Comprador -->
                <div class="mb-3">
                    <label for="nit_comprador" class="form-label @error('nit_comprador') is-invalid @enderror">
                        NIT / CI:
                    </label>
                    <input type="text" class="form-control" id="nit_comprador" name="nit_comprador"
                        value="{{ old('nit_comprador') }}" placeholder="Ingrese nombre para la factura" required>
                    @error('nit_comprador')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Descripción --}}
                <div class="form-group mb-3">
                    <label for="descripcion">Descripción:</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" rows="3" placeholder="Opcional"></textarea>
                </div>

                {{-- Detalle Factura --}}
                <div class="form-group mb-3">
                    <label>Detalle Factura:</label>
                    <div id="detalle-factura-container">
                        <!-- Contenido dinamico -->
                        @include('admin.factura.partials.create-detalle-factura', [
                            'servicios' => $servicios,
                            'reserva' => null,
                        ])
                    </div>
                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('factura.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection

@section('script')
    @vite(['resources/js/facturacion.js'])
@endsection
