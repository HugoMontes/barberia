@extends('admin.layouts.main')

@section('title', 'Nuevo barbero')

@section('content')
<div class="card card-primary card-outline mb-4">
    <div class="card-header">
        <div class="card-title">Completar el formulario para añadir un nuevo barbero</div>
    </div>

    <!-- Formulario para crear un nuevo barbero -->
    <form action="{{ route('barbero.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <!-- Nombre del barbero -->
            <div class="mb-3">
                <label for="nombre" class="form-label @error('nombre') is-invalid @enderror">Nombre de barbero</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" placeholder="Ingrese nombre completo" required>
                

                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Apellido del barbero -->
            <div class="mb-3">
                <label for="apellido" class="form-label @error('apellido') is-invalid @enderror">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido') }}" placeholder="Ingrese apellido" required>
                @error('apellido')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email del barbero -->
            <div class="mb-3">
                <label for="email" class="form-label @error('email') is-invalid @enderror">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="example@domain.com" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Especialidad del barbero -->
            <div class="mb-3">
                <label for="especialidad" class="form-label @error('especialidad') is-invalid @enderror">Especialidad</label>
                <input type="text" class="form-control" id="especialidad" name="especialidad" value="{{ old('especialidad') }}" placeholder="Ingrese especialidad" required>
                @error('especialidad')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Contraseña del barbero -->
            <div class="mb-3">
                <label for="password" class="form-label @error('password') is-invalid @enderror">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tipo de usuario (oculto si siempre será barbero) -->
            <input type="hidden" name="role" value="barbero">
        </div>

        <!-- Footer con botones -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('barbero.index') }}" class="btn btn-secondary float-end">
                <i class="fa fa-times" aria-hidden="true"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection

