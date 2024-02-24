<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\DB; // Importa el facade DB para realizar consultas
use App\Models\Tour; // Asegúrate de importar el modelo Tour aquí.
use Illuminate\Validation\Rule; // Si vas a usar reglas de validación personalizadas.

class UpdateTourRequest extends FormRequest
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
        $tourId = $this->route('tour'); // Asume que 'tour' es el parámetro de ruta que contiene el ID del tour

        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date_format:Y-m-d\TH:i',
            'end_date' => 'required|date_format:Y-m-d\TH:i|after_or_equal:start_date',
            'max_people' => 'required|integer|min:1',
            'contact_info' => 'required|string',
            'components' => 'sometimes|array',
            'components.*' => 'exists:components,id',
            // Aquí puedes añadir o modificar reglas específicas para la actualización si es necesario
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->filled('components')) {
                $startDate = Carbon::parse($this->start_date);
                $endDate = Carbon::parse($this->end_date);
                $tourId = $this->route('tour'); // Obtiene el ID del tour desde la ruta

                // Verifica solapamientos excluyendo el tour actual
                $overlappingTours = Tour::whereHas('components', function ($query) {
                    $query->whereIn('components.id', $this->components); // Especifica la tabla para 'id'
                })->where(function ($query) use ($startDate, $endDate, $tourId) {
                    $query->where(function ($query) use ($startDate, $endDate) {
                        $query->whereBetween('start_date', [$startDate, $endDate])
                              ->orWhereBetween('end_date', [$startDate, $endDate]);
                    })->where('tours.id', '!=', $tourId); // Especifica la tabla para 'id' y usa la variable $tourId
                })->exists();


                if ($overlappingTours) {
                    $validator->errors()->add('components', 'The selected components are already reserved for another tour within the provided date range.');
                }
            }
        });
    }
}
