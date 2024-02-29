<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Tour;

class StoreVisitRequest extends FormRequest
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
    public function rules()
    {
        return [
            'tour_id' => [
                'required',
                'exists:tours,id',
            ],
            'number_of_people' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) {
                    $tour = Tour::find($this->tour_id);
                    if (!$tour) {
                        return $fail("El tour seleccionado no es válido.");
                    }

                    // Asegúrate de refrescar el modelo para obtener los datos más actuales
                    $tour->refresh();

                    // Implementa la lógica para calcular los cupos disponibles
                    $reservedSeats = $tour->visits()->whereIn('status', ['pending', 'approved'])->sum('number_of_people');
                    $availableSeats = $tour->max_people - $reservedSeats;

                    if ($value > $availableSeats) {
                        return $fail("El número de personas excede el cupo disponible para este tour. Cupos disponibles: $availableSeats.");
                    }
                },
            ],
            'additional_info' => 'nullable|string|max:255',
            // Aquí puedes agregar más reglas de validación según sea necesario
        ];
    }
}
