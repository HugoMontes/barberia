@extends('admin.layouts.main')

@section('title', 'Reservas')

@section('content')
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Título de la página -->
                <div class="card-title">Listado de Reservas</div>

                <!-- Botón para crear una nueva reserva -->
                <a href="{{ route('reserva.create') }}" class="btn btn-primary">Nueva Reserva</a>
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
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservas as $reserva)
                        <tr>
                            <td>{{ $reserva->id }}</td>
                            <!-- Accedemos al cliente relacionado, previniendo errores si no existe -->
                            <td>{{ $reserva->cliente?->nombre }} {{ $reserva->cliente?->apellido }}</td>
                            <!-- Accedemos al barbero relacionado -->
                            <td>{{ $reserva->barbero?->nombre }}</td>
                            <!-- Mostramos fecha y hora en formato legible -->
                            <td>{{ \Carbon\Carbon::parse($reserva->fecha_hora)->format('d/m/Y H:i') }}</td>
                            <td>
                                <!-- Mostramos el estado con badges -->
                                @if ($reserva->estado == 'pendiente')
                                    <span class="badge bg-warning">{{ $reserva->estado }}</span>
                                @elseif ($reserva->estado == 'confirmada')
                                    <span class="badge bg-success">{{ $reserva->estado }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $reserva->estado }}</span>
                                @endif
                            </td>
                            <td>
                                <!-- Botón para editar la reserva -->
                                <a href="{{ route('reserva.edit', $reserva->id) }}" class="btn btn-sm btn-primary" title="Editar">
                                    Editar
                                </a>

                                <!-- Formulario para eliminar la reserva -->
                                <form action="{{ route('reserva.destroy', $reserva->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger btn-eliminar">Eliminar</button>
                                </form>
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

@section('scripts')
    <!-- SweetAlert para confirmación de eliminación -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.addEventListener("click", function(e) {
                if (e.target && e.target.classList.contains('btn-eliminar')) {
                    e.preventDefault();
                    const form = e.target.closest('form');
                    Swal.fire({
                        title: '¿Estás seguro de eliminar la reserva?',
                        text: "¡No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }
            });
        });
    </script>
@endsection
