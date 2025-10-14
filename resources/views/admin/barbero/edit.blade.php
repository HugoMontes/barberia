@extends('admin.layouts.main')

@section('title', 'Editar Barbero')

@section('content')
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Editar información del barbero</div>
        </div>

        <!-- El formulario envía los datos al método update del controlador -->
        <form action="{{ route('barbero.update', $barbero->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">
                <!-- Campo: Nombre -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                           id="nombre" name="nombre"
                           value="{{ old('nombre', $barbero->nombre) }}"
                           placeholder="Ingrese el nombre del barbero" required />
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campo: Apellido -->
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control @error('apellido') is-invalid @enderror"
                           id="apellido" name="apellido"
                           value="{{ old('apellido', $barbero->apellido) }}"
                           placeholder="Ingrese el apellido del barbero" required />
                    @error('apellido')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campo: Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email"
                           value="{{ old('email', $barbero->email) }}"
                           placeholder="example@domain.com" required />
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campo: Especialidad -->
                <div class="mb-3">
                    <label for="especialidad" class="form-label">Especialidad</label>
                    <input type="text" class="form-control @error('especialidad') is-invalid @enderror"
                           id="especialidad" name="especialidad"
                           value="{{ old('especialidad', $barbero->especialidad) }}"
                           placeholder="Ej: Corte clásico, degradado, barba, etc." required />
                    @error('especialidad')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                <a href="{{ route('barbero.index') }}" class="btn btn-secondary float-end">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection
