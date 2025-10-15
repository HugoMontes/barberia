@extends('admin.layouts.main')

@section('title', 'Nuevo Servicio')

@section('content')
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Completar el formulario para añadir un nuevo servicio</div>
        </div>

        <!-- Mostrar errores de validación -->
        @if ($errors->any())
            <div class="alert alert-danger m-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario para crear un nuevo servicio -->
        <form action="{{ route('servicio.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <!-- Nombre del servicio -->
                <div class="mb-3">
                    <label for="nombre" class="form-label @error('nombre') is-invalid @enderror">Nombre del
                        servicio</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}"
                        placeholder="Ingrese el nombre del servicio" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Descripción del servicio (opcional) -->
                <div class="mb-3">
                    <label for="descripcion"
                        class="form-label @error('descripcion') is-invalid @enderror">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese una descripción">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Precio del servicio -->
                <div class="mb-3">
                    <label for="precio" class="form-label @error('precio') is-invalid @enderror">Precio</label>
                    <input type="number" class="form-control" id="precio" name="precio" value="{{ old('precio') }}"
                        placeholder="Ingrese el precio del servicio" required>
                    @error('precio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Imagen del servicio -->
                <div class="mb-3">
                    <label for="imagen" class="form-label @error('imagen') is-invalid @enderror">Imagen</label>
                    <input type="file" class="form-control file-imagen" id="imagen" name="imagen"
                        value="{{ old('imagen') }}" placeholder="Ingrese la ruta o nombre de la imagen" required>
                    <small class="text-muted">Formatos aceptados: JPG, PNG, JPEG. Tamaño máximo: 2MB</small>
                    <img id="imageview" src="#" alt="Imagen del servicio" class="img-rounded"
                        style="max-width: 500px; display: none;" />
                    @error('imagen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('servicio.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener("change", function(e) {
            if (e.target.classList.contains("file-imagen")) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) =>
                        (document.getElementById("imageview").src = e.target.result);
                    reader.readAsDataURL(file);
                    document.getElementById("imageview").style.display = "block";
                }
            }
        });
    </script>
@endsection
