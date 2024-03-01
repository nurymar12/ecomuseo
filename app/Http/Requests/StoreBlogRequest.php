<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Aquí puedes verificar si el usuario tiene permiso para crear un blog
        // Por defecto, podrías retornar true si cualquier usuario autenticado puede crear blogs
        // return auth()->check();

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
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'components' => 'sometimes|array',
            'components.*' => 'exists:components,id',
            // No necesitas 'author_id' aquí si se asignará automáticamente basado en el usuario autenticado
        ];
    }
}
