@extends('admin.layouts.main')

@section('title', 'Editar Cliente')

@section('content')
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Editar información del cliente</div>
        </div>

        <!-- El formulario envía los datos al método update del controlador -->
        <form action="{{ route('cliente.update', $cliente->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">
                <!-- Campo: Nombre -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                           id="nombre" name="nombre"
                           value="{{ old('nombre', $cliente->nombre) }}"
                           placeholder="Ingrese el nombre del cliente" required />
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campo: Apellido -->
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control @error('apellido') is-invalid @enderror"
                           id="apellido" name="apellido"
                           value="{{ old('apellido', $cliente->apellido) }}"
                           placeholder="Ingrese el apellido del cliente" required />
                    @error('apellido')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campo: Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email"
                           value="{{ old('email', $cliente->email) }}"
                           placeholder="example@domain.com" required />
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campo: telefono -->
                <div class="mb-3">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input type="text" class="form-control @error('telefono') is-invalid @enderror"
                           id="telefono" name="telefono"
                           value="{{ old('telefono', $cliente->telefono) }}"
                           placeholder="Ej:  87654321, 12345678, etc." required />
                    @error('telefono')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                <a href="{{ route('cliente.index') }}" class="btn btn-secondary float-end">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection
