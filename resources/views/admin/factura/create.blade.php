{{-- resources/views/admin/factura/create.blade.php --}}
@extends('admin.layouts.main')

@section('title', 'Crear Factura')

@section('content')
<div class="card card-primary card-outline mb-4">
    <div class="card-header">
        <h3 class="card-title">Crear Nueva Factura</h3>
    </div>

    <div class="card-body">
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

            {{-- Seleccionar Cliente --}}
            <div class="form-group mb-3">
                <label for="id_cliente">Cliente:</label>
                <select name="id_cliente" id="id_cliente" class="form-control" required>
                    <option value="">-- Selecciona un Cliente --</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Seleccionar Reserva --}}
            <div class="form-group mb-3">
                <label for="id_reserva">Reserva:</label>
                <select name="id_reserva" id="id_reserva" class="form-control" required>
                    <option value="">-- Selecciona una Reserva --</option>
                    @foreach ($reservas as $reserva)
                        <option value="{{ $reserva->id }}">
                            {{ $reserva->fecha_hora}}  -  {{ $reserva->cliente->nombre}} 
                        </option>
                    @endforeach
                </select>
            </div>

           

            {{-- Descripción --}}
            <div class="form-group mb-3">
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="3" placeholder="Opcional"></textarea>
            </div>

            {{-- Servicios --}}
            <div class="form-group mb-3">
                <label>Servicios:</label>
                @foreach ($servicios as $servicio)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="servicios[]" value="{{ $servicio->id }}" id="servicio{{ $servicio->id }}">
                        <label class="form-check-label" for="servicio{{ $servicio->id }}">
                            {{ $servicio->nombre }} - ${{ number_format($servicio->precio, 2) }}
                        </label>
                    </div>
                @endforeach
            </div>
        
             {{-- Precio --}}
            <div class="form-group mb-3">
                <label for="precio">Precio Total:</label>
                {{-- <input type="number" name="precio" id="precio" class="form-control" step="0.01" required> --}}
                {{-- <select name="precio" id="precio">
                    <option value="10">10</option>
                                        <option value="20">20</option>
                                                            <option value="12">12</option> --}}


                {{-- </select> --}}
            </div>

            {{-- Botón Guardar --}}
            <button type="submit" class="btn btn-success">Crear Factura</button>
            <a href="{{ route('factura.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
