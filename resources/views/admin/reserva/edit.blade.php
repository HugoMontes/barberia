@extends('layouts.admin.main')

@section('title', 'Editar Reserva')

@section('content')
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Completar el formulario para editar la reserva</div>
        </div>

        <!-- Formulario para editar reserva -->
        <form action="{{ route('reserva.update', $reserva->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Método PUT para actualizar el registro -->

            <div class="card-body">
                <!-- Seleccionar cliente -->
                <div class="mb-3">
                    <label for="cliente_id" class="form-label @error('cliente_id') is-invalid @enderror">
                        Cliente
                    </label>
                    <select name="cliente_id" class="form-select" id="cliente_id" required>
                        <option value="" disabled hidden>Seleccione un cliente</option>
                        @foreach ($clientes as $cliente)
                            <!-- Mantener la selección actual del cliente -->
                            <option value="{{ $cliente->id }}" @selected(old('cliente_id', $reserva->cliente_id) == $cliente->id)>
                                {{ $cliente->nombre }} {{ $cliente->apellido }}
                            </option>
                        @endforeach
                    </select>
                    @error('cliente_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Seleccionar barbero -->
                <div class="mb-3">
                    <label for="barbero_id" class="form-label @error('barbero_id') is-invalid @enderror">
                        Barbero
                    </label>
                    <select name="barbero_id" class="form-select" id="barbero_id" required>
                        <option value="" disabled hidden>Seleccione un barbero</option>
                        @foreach ($barberos as $barbero)
                            <option value="{{ $barbero->id }}" @selected(old('barbero_id', $reserva->barbero_id) == $barbero->id)>
                                {{ $barbero->nombre }} {{ $barbero->apellido }}
                            </option>
                        @endforeach
                    </select>
                    @error('barbero_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Servicios --}}
                <div class="form-group mb-3">
                    <label>Servicios:</label>
                    @foreach ($servicios as $servicio)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="servicios[]" value="{{ $servicio->id }}"
                                id="servicio{{ $servicio->id }}"
                                {{ $reserva->servicios->contains($servicio->id) ? 'checked' : '' }}>
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
                    <label for="fecha_hora" class="form-label @error('fecha_hora') is-invalid @enderror">
                        Fecha y Hora
                    </label>
                    <input type="datetime-local" name="fecha_hora" id="fecha_hora" class="form-control"
                        value="{{ old('fecha_hora', $reserva->fecha_hora) }}" required>
                    @error('fecha_hora')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Estado de la reserva -->
                <div class="mb-3">
                    <label for="estado" class="form-label @error('estado') is-invalid @enderror">
                        Estado
                    </label>
                    <select name="estado" id="estado" class="form-select" required>
                        @foreach ($estados as $key => $value)
                            <option value="{{ $key }}" @selected(old('estado', $reserva->estado) == $key)>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Botones para actualizar o cancelar -->
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('reserva.index') }}" class="btn btn-secondary">
                    <i class="fa fa-times" aria-hidden="true"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection
