@extends('layouts.admin.main')

@section('title', 'Servicios')

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
            <h3 class="card-title">Lista de Servicios</h3>
            <div class="card-tools">
                <a href="{{ route('servicio.create') }}" class="btn btn-success">
                    <i class="bi bi-plus"></i> Nuevo Servicio
                </a>
            </div>
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th style="width: 200px">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($servicios as $servicio)
                        <tr>
                            <td>{{ $servicio->id }}</td>
                            <td>{{ $servicio->nombre }}</td>
                            <td>{{ $servicio->descripcion }}</td>
                            <td>{{ $servicio->precio }}</td>
                            <td>
                                <a href="{{ route('servicio.edit', $servicio->id) }}"
                                    class="btn btn-primary btn-sm">Editar</a>
                                <form action="{{ route('servicio.destroy', $servicio->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm btn-eliminar">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No hay servicios registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <br />
            {{ $servicios->links('pagination::bootstrap-5') }}
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
