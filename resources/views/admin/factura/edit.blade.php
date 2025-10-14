@extends('admin.layouts.main')

@section('title', 'Editar Factura')

@section('content')
<div class="card card-primary card-outline mb-4">
    <div class="card-header">
        <div class="card-title">Completar el formulario para editar la factura</div>
    </div>

    <!-- Formulario para editar factura -->
    <form action="{{ route('factura.update', $factura->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body">
            <!-- Seleccionar cliente -->
            <div class="mb-3">
                <label for="id_cliente" class="form-label @error('id_cliente') is-invalid @enderror">Cliente</label>
                <select name="id_cliente" class="form-select" id="id_cliente" required>
                    <option value="" disabled hidden>Seleccione un cliente</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}" @selected(old('id_cliente', $factura->id_cliente) == $cliente->id)>
                            {{ $cliente->nombre }} {{ $cliente->apellido }}
                        </option>
                    @endforeach
                </select>
                @error('id_cliente')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Total de la factura -->
            <div class="mb-3">
                <label for="total" class="form-label @error('total') is-invalid @enderror">Total</label>
                <input type="number" class="form-control" id="total" name="total" value="{{ old('total', $factura->total) }}" required>
                @error('total')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Descripción -->
            <div class="mb-3">
                <label for="descripcion" class="form-label @error('descripcion') is-invalid @enderror">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" required>{{ old('descripcion', $factura->descripcion) }}</textarea>
                @error('descripcion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Detalle de la factura: seleccionar servicios -->
            <div class="mb-3">
                <label for="servicios" class="form-label @error('servicios') is-invalid @enderror">Servicios</label>
                <select name="servicios[]" class="form-select" id="servicios" multiple required>
                    @foreach ($servicios as $servicio)
                        <option value="{{ $servicio->id }}"
                            @selected(in_array($servicio->id, old('servicios', $factura->detalle->pluck('id_servicio')->toArray() ?? [])))>
                            {{ $servicio->nombre }} - ${{ $servicio->precio }}
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">Mantenga presionada la tecla Ctrl para seleccionar múltiples servicios.</small>
                @error('servicios')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            <a href="{{ route('factura.index') }}" class="btn float-end">
                <i class="fa fa-times" aria-hidden="true"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
