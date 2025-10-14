@extends('admin.layouts.main')

@section('title', 'Facturas')

@section('content')
    <div class="card card-primary card-outline mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">Listado de Facturas</div>
            <a href="{{ route('factura.create') }}" class="btn btn-primary">Nueva Factura</a>
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
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($facturas as $factura)
                        <tr>
                            <td>{{ $factura->id }}</td>
                            <!-- Cliente asociado a la factura -->
                            <td>{{ $factura->cliente->nombre }} {{ $factura->cliente->apellido }}</td>
                            <td>${{ number_format($factura->total, 2) }}</td>
                            <td>{{ $factura->descripcion }}</td>
                            <td>{{ $factura->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <!-- Editar factura -->
                                <a href="{{ route('factura.edit', $factura->id) }}" class="btn btn-sm btn-primary">Editar</a>

                                <!-- Eliminar factura -->
                                <form action="{{ route('factura.destroy', $factura->id) }}" method="POST" style="display:inline;">
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
            {{-- {{ $facturas->links('pagination::bootstrap-5') }} --}}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.addEventListener("click", function(e) {
                if (e.target && e.target.classList.contains('btn-eliminar')) {
                    e.preventDefault();
                    const form = e.target.closest('form');
                    Swal.fire({
                        title: '¿Estás seguro de eliminar la factura?',
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
