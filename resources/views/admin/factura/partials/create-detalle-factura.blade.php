<table class="table table-bordered">
    <thead>
        <tr>
            <th width="50px">Seleccionar</th>
            <th>Servicio</th>
            <th width="120px">Precio</th>
        </tr>
    </thead>
    <tbody>
        @php
            $total = 0;
        @endphp
        @foreach ($servicios as $servicio)
            @php
                $hasReserva = isset($reserva) && $reserva->servicios->contains($servicio->id);
                if ($hasReserva) {
                    $total += $servicio->precio;
                }
            @endphp
            <tr>
                <td class="text-center">
                    <input class="form-check-input servicio-checkbox" type="checkbox" name="servicios[]"
                        value="{{ $servicio->id }}" id="servicio{{ $servicio->id }}" data-precio="{{ $servicio->precio }}"
                        {{ $hasReserva ? 'checked' : '' }}>
                </td>
                <td>
                    <label class="form-check-label" for="servicio{{ $servicio->id }}">
                        {{ $servicio->nombre }}
                    </label>
                </td>
                <td class="text-end">
                    <span class="precio-cell" style="display: {{ $hasReserva ? 'block' : 'none' }}">
                        {{ number_format($servicio->precio, 2) }}
                    </span>
                </td>
            </tr>
        @endforeach
        <tr class="fw-bold">
            <td colspan="2" class="text-end">TOTAL Bs.</td>
            <td id="total" class="text-end">{{ number_format($total, 2) }}</td>
        </tr>
    </tbody>
</table>
<input type="hidden" value="{{ number_format($total, 2) }}" id="totalValue" name="total">
