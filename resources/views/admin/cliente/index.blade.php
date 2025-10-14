@extends('admin.layouts.main')

@section('title', 'Clientes')

@section('style')
    <style>
        .pagination .page-link {
            border-radius: 0 !important;
        }
    </style>
@endsection

@section('content')
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <h3 class="card-title">Listado de Clientes</h3>
            <div class="card-tools">
                <a href="{{ route('cliente.create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-user-plus"></i> Nuevo Cliente
                </a>
            </div>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th style="width: 200px">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->id }}</td>
                            <td>{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->user->email }}</td>
                            <td>{{ $cliente->telefono }}</td>
                            <td>
                                <a href="{{ route('cliente.edit', $cliente->id) }}" class="btn btn-sm btn-primary"
                                    title="Editar">
                                    Editar
                                </a>
                                <form action="{{ route('cliente.destroy', $cliente->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger btn-eliminar">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No hay clientes registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <br />
            {{ $clientes->links('pagination::bootstrap-5') }}
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
                        title: '¿Estás seguro?',
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
