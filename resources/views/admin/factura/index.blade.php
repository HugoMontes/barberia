@extends('layouts.admin.main')

@section('title', 'Facturas')

@section('content')
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Listado de Facturas</div>
            <div class="card-tools">
                <a href="{{ route('factura.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Nueva Factura
                </a>
            </div>
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th style="width: 200px">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($facturas as $factura)
                        <tr>
                            <td>{{ $factura->id }}</td>
                            <!-- Cliente asociado a la factura -->
                            <td>{{ $factura->nombre_comprador }}</td>
                            <td>{{ number_format($factura->total, 2) }}</td>
                            <td>{{ $factura->descripcion ? $factura->descripcion : '-' }}</td>
                            <td>{{ $factura->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if ($factura->estado == 'pendiente')
                                    <span class="badge bg-warning">{{ $factura->estado }}</span>
                                @elseif ($factura->estado == 'pagada')
                                    <span class="badge bg-success">{{ $factura->estado }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $factura->estado }}</span>
                                @endif
                            </td>
                            <td>
                                <!-- Imprimir Factura -->
                                <a href="{{ route('factura.show', $factura->id) }}" class="btn btn-sm btn-info"
                                    title="Imprimir" {{ $factura->estado == 'pendiante' ? 'disabled' : '' }}>
                                    Imprimir
                                </a>
                                <!-- Anular factura -->
                                <form action="{{ route('factura.destroy', $factura->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger btn-eliminar"
                                        {{ $factura->estado == 'anulada' ? 'disabled' : '' }}>
                                        Anular
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Paginación -->
            {{ $facturas->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.addEventListener("click", function(e) {
                if (e.target && e.target.classList.contains('btn-eliminar')) {
                    e.preventDefault();
                    const form = e.target.closest('form');
                    Swal.fire({
                        title: '¿Estás seguro de anular la factura?',
                        text: "¡No podrás revertir este cambio!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, anular',
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
