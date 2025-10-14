@extends('admin.layouts.main')

@section('title', 'Nuevo Cliente')

@section('content')
<div class="card card-primary card-outline mb-4">
    <div class="card-header">
        <div class="card-title">Completar el formulario para añadir un nuevo cliente</div>
    </div>

    <!-- Formulario para crear un nuevo cliente -->
    <form action="{{ route('cliente.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <!-- Nombre del cliente -->
            <div class="mb-3">
                <label for="nombre" class="form-label @error('nombre') is-invalid @enderror">Nombre de cliente </label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" placeholder="Ingrese nombre completo" required>
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Apellido del cliente -->
            <div class="mb-3">
                <label for="apellido" class="form-label @error('apellido') is-invalid @enderror">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido') }}" placeholder="Ingrese apellido" required>
                @error('apellido')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email del cliente  -->
            <div class="mb-3">
                <label for="email" class="form-label @error('email') is-invalid @enderror">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="example@domain.com" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- telefono del cliente -->
            <div class="mb-3">
                <label for="telefono" class="form-label @error('telefono') is-invalid @enderror">Telefono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}" placeholder="Ingrese telefono" required>
                @error('telefono')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tipo de usuario (oculto si siempre será barbero) -->
            <input type="hidden" name="role" value="cliente">
        </div>

        <!-- Footer con botones -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('cliente.index') }}" class="btn btn-secondary float-end">
                <i class="fa fa-times" aria-hidden="true"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection


