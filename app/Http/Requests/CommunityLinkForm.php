<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth; // Importar Auth para verificar la autenticación

class CommunityLinkForm extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     */
    public function authorize(): bool
    {
        // Solo permitir que los usuarios autenticados puedan enviar un link
        return Auth::check();
    }

    /**
     * Reglas de validación para la solicitud.
     */
    // app/Http/Requests/CommunityLinkForm.php
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'link' => 'required|url|max:255',
            'channel_id' => 'required|exists:channels,id',
        ];
    }



    /**
     * Mensajes de error personalizados.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'El título es obligatorio.',
            'link.required' => 'El enlace es obligatorio.',
            'link.url' => 'El enlace debe ser una URL válida.',
            'channel_id.required' => 'Debes seleccionar un canal.',
            'channel_id.exists' => 'El canal seleccionado no es válido.',
        ];
    }
}
