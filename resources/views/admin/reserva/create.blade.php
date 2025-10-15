@extends('layouts.admin.main')

@section('title', 'Nueva Reserva')

@section('content')
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Completar el formulario para añadir una nueva reserva</div>
        </div>

        <!-- Mostrar errores de validación -->
        @if ($errors->any())
            <div class="alert alert-danger m-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
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
                    <label for="cliente_id" class="form-label">Cliente:</label>
                    <select class="form-select" id="cliente_id" name="cliente_id" required>
                        <option value="">-- Seleccione un cliente --</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->nombre }} {{ $cliente->apellido }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Seleccionar barbero -->
                <div class="mb-3">
                    <label for="barbero_id" class="form-label">Barbero:</label>
                    <select class="form-select" id="barbero_id" name="barbero_id" required>
                        <option value="">-- Seleccione un barbero --</option>
                        @foreach ($barberos as $barbero)
                            <option value="{{ $barbero->id }}" {{ old('barbero_id') == $barbero->id ? 'selected' : '' }}>
                                {{ $barbero->nombre }} {{ $barbero->apellido }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Servicios --}}
                <div class="form-group mb-3">
                    <label>Servicios:</label>
                    @foreach ($servicios as $servicio)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="servicios[]" value="{{ $servicio->id }}"
                                id="servicio{{ $servicio->id }}">
                            <label class="form-check-label" for="servicio{{ $servicio->id }}">
                                {{ $servicio->nombre }} - ${{ number_format($servicio->precio, 2) }}
                            </label>
                        </div>
                    @endforeach
                    @error('servicios')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Fecha y hora -->
                <div class="mb-3">
                    <label for="fecha_hora" class="form-label">Fecha y Hora:</label>
                    <input type="datetime-local" class="form-control" id="fecha_hora" name="fecha_hora"
                        value="{{ old('fecha_hora') }}" required>
                </div>

                <!-- Estado -->
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado:</label>
                    <select class="form-select" id="estado" name="estado" required>
                        @foreach ($estados as $key => $value)
                            <option value="{{ $key }}" @selected(old('estado') == $key)>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('reserva.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
