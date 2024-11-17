<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->user->id ?? '', // Asegura la exclusividad del email ignorando el email actual del usuario
            'password' => 'sometimes|required|string|min:8|confirmed', // Validación opcional para password
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image es opcional y debe ser un archivo de imagen válido
            'trusted' => 'required|boolean', // Trusted debe ser booleano
        ];
    }
}
