@extends('admin.layouts.main')

@section('title', 'Nueva Reserva')

@section('content')
<div class="card card-primary card-outline mb-4">
    <div class="card-header">
        <div class="card-title">Completar el formulario para añadir una nueva reserva</div>
    </div>

    <!-- Mostrar errores de validación -->
    @if($errors->any())
        <div class="alert alert-danger m-3">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reserva.store') }}" method="POST">
        @csrf

        <div class="card-body">
            <!-- Seleccionar cliente -->
            <div class="mb-3">
                <label for="id_cliente" class="form-label">Cliente</label>
                <select class="form-select" id="id_cliente" name="id_cliente" required>
                    <option value="">-- Seleccione un cliente --</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ old('id_cliente') == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Seleccionar barbero -->
            <div class="mb-3">
                <label for="id_barbero" class="form-label">Barbero</label>
                <select class="form-select" id="id_barbero" name="id_barbero" required>
                    <option value="">-- Seleccione un barbero --</option>
                    @foreach($barberos as $barbero)
                        <option value="{{ $barbero->id }}" {{ old('id_barbero') == $barbero->id ? 'selected' : '' }}>
                            {{ $barbero->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Fecha y hora -->
            <div class="mb-3">
                <label for="fecha_hora" class="form-label">Fecha y hora</label>
                <input type="datetime-local" class="form-control" id="fecha_hora" name="fecha_hora" 
                       value="{{ old('fecha_hora') }}" required>
            </div>

            <!-- Estado -->
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select" id="estado" name="estado" required>
                    <option value="pendiente" {{ old('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="confirmada" {{ old('estado') == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                    <option value="cancelada" {{ old('estado') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                </select>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success">Guardar Reserva</button>
            <a href="{{ route('reserva.index') }}" class="btn btn-secondary float-end">Cancelar</a>
        </div>
    </form>
</div>
@endsection
