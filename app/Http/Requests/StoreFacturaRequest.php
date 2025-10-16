<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFacturaRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'id_reserva' => 'exists:reservas,id',   // La reserva debe existir
            'descripcion' => 'nullable|string',     // La descripción es opcional
            'servicios'  => 'required|array',       // Los servicios deben ser enviados como un arreglo
            'servicios.*' => 'exists:servicios,id', // Cada servicio debe existir en la tabla servicios
        ];
    }
}
