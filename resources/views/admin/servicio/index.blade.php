@extends('admin.layouts.main')

@section('title', 'Servicios')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lista de Servicios</h3>
        <a href="{{ route('servicio.create') }}" class="btn btn-success float-right">Nuevo Servicio</a>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    {{-- <th>Imagen</th> --}}
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($servicios as $servicio)
                    <tr>
                        <td>{{ $servicio->id }}</td>
                        <td>{{ $servicio->nombre }}</td>
                        <td>{{ $servicio->descripcion }}</td>
                        <td>{{ $servicio->precio }}</td>
                        {{-- <td><img src="{{ $servicio->imagen }}" alt="imagen" width="50"></td> --}}
                        <td>
                            <a href="{{ route('servicio.edit', $servicio->id) }}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{ route('servicio.destroy', $servicio->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar servicio?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
