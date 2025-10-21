@extends('layouts.admin.main')

@section('title', 'Reservas')

@section('content')
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Título de la página -->
                <div class="card-title">Listado de Reservas</div>

                <!-- Botón para crear una nueva reserva -->
                <a href="{{ route('reserva.create') }}" class="btn btn-success">Nueva Reserva</a>
            </div>
        </div>

        <div class="card-body">
            <!-- Tabla que muestra las reservas -->
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Barbero</th>
                        <th>Fecha y Hora</th>
                        <th>Estado</th>
                        <th style="width: 100px">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservas as $reserva)
                        <tr>
                            <td>{{ $reserva->id }}</td>
                            <!-- Accedemos al cliente relacionado, previniendo errores si no existe -->
                            <td>{{ $reserva->cliente?->nombre }} {{ $reserva->cliente?->apellido }}</td>
                            <!-- Accedemos al barbero relacionado -->
                            <td>{{ $reserva->barbero?->nombre }} {{ $reserva->barbero?->apellido }}</td>
                            <!-- Mostramos fecha y hora en formato legible -->
                            <td>{{ \Carbon\Carbon::parse($reserva->fecha_hora)->format('d/m/Y H:i') }}</td>
                            <td>
                                <!-- Mostramos el estado con badges -->
                                @if ($reserva->estado == 'pendiente')
                                    <span class="badge bg-warning">{{ $reserva->estado }}</span>
                                @elseif ($reserva->estado == 'confirmada')
                                    <span class="badge bg-success">{{ $reserva->estado }}</span>
                                @elseif ($reserva->estado == 'completada')
                                    <span class="badge bg-info">{{ $reserva->estado }}</span>
                                @elseif ($reserva->estado == 'facturada')
                                    <span class="badge bg-secondary">{{ $reserva->estado }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $reserva->estado }}</span>
                                @endif
                            </td>
                            <td>
                                <!-- Botón para editar la reserva -->
                                <a href="{{ route('barbero.reserva.edit', $reserva->id) }}" class="btn btn-sm btn-primary"
                                    title="Editar">
                                    Editar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Paginación -->
            {{ $reservas->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
