<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarberoRequest extends FormRequest {
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
            'nombre' => 'required|string|max:255',          // obligatorio, texto, máximo 255 caracteres
            'apellido' => 'required|string|max:255',        // obligatorio, texto, máximo 255 caracteres
            'email' => 'required|email|unique:users,email', // obligatorio, email válido, único en la tabla barberos
            'especialidad' => 'required|string|max:255',    // obligatorio, texto, máximo 255 caracteres
        ];
    }
}
