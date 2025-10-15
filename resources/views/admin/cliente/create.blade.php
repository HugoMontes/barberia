@extends('layouts.admin.main')

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
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}"
                        placeholder="Ingrese nombre completo" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Apellido del cliente -->
                <div class="mb-3">
                    <label for="apellido" class="form-label @error('apellido') is-invalid @enderror">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido') }}"
                        placeholder="Ingrese apellido" required>
                    @error('apellido')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email del cliente  -->
                <div class="mb-3">
                    <label for="email" class="form-label @error('email') is-invalid @enderror">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                        placeholder="example@domain.com" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- telefono del cliente -->
                <div class="mb-3">
                    <label for="telefono" class="form-label @error('telefono') is-invalid @enderror">Telefono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}"
                        placeholder="Ingrese telefono" required>
                    @error('telefono')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- estado de usuario -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="status" name="status"
                        onchange="togglePassword()">
                    <label class="form-check-label" for="status">
                        Habilitar acceso al sistema como cliente.
                    </label>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="password"
                                class="form-label @error('password') is-invalid @enderror">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Ingresar contraseña" disabled />
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer con botones -->
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('cliente.index') }}" class="btn btn-secondary">
                    <i class="fa fa-times" aria-hidden="true"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        function togglePassword() {
            const checkbox = document.getElementById('status');
            const passwordInput = document.getElementById('password');

            if (checkbox.checked) {
                passwordInput.removeAttribute('disabled');
            } else {
                passwordInput.setAttribute('disabled', 'disabled');
            }
        }
    </script>
@endsection
