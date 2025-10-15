@extends('admin.layouts.main')

@section('title', 'Editar Servicio')

@section('content')
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Completar el formulario para editar un servicio</div>
        </div>

        <!-- Formulario para actualizar el servicio -->
        <form action="{{ route('servicio.update', $servicio->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Método PUT para actualización -->

            <div class="card-body">
                <!-- Nombre del servicio -->
                <div class="mb-3">
                    <label for="nombre" class="form-label @error('nombre') is-invalid @enderror">Nombre del servicio</label>
                    <input type="text" class="form-control" id="nombre" name="nombre"
                        value="{{ old('nombre', $servicio->nombre) }}" placeholder="Ingrese el nombre del servicio"
                        required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Descripción del servicio -->
                <div class="mb-3">
                    <label for="descripcion"
                        class="form-label @error('descripcion') is-invalid @enderror">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese una descripción" required>{{ old('descripcion', $servicio->descripcion) }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Precio del servicio -->
                <div class="mb-3">
                    <label for="precio" class="form-label @error('precio') is-invalid @enderror">Precio</label>
                    <input type="number" class="form-control" id="precio" name="precio"
                        value="{{ old('precio', $servicio->precio) }}" placeholder="Ingrese el precio del servicio"
                        required>
                    @error('precio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Imagen del servicio -->
                <div class="mb-3">
                    <label for="imagen" class="form-label @error('imagen') is-invalid @enderror">Imagen</label>
                    <input type="file" class="form-control file-imagen" id="imagen" name="imagen"
                        value="{{ old('imagen') }}" placeholder="Ingrese la ruta o nombre de la imagen">
                    <small class="text-muted">Formatos aceptados: JPG, PNG, JPEG. Tamaño máximo: 2MB</small>
                    <img id="imageview" src="/imagenes/servicios/{{ $servicio->imagen }}" alt="Imagen del servicio"
                        class="img-rounded" style="max-width: 500px; display: block;" />
                    @error('imagen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('servicio.index') }}" class="btn btn-secondary">
                    <i class="fa fa-times" aria-hidden="true"></i> Cancelar
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
