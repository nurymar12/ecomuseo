<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Tour;
use App\Models\Visit;
use Illuminate\Validation\Rule;

class UpdateVisitRequest extends FormRequest
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
        $visit = $this->route('visit');
        // Acceder al Tour relacionado directamente
        $tour = $visit->tour;


        return [
            'number_of_people' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) use ($tour, $visit) {
                    // Calcular los asientos ya reservados excluyendo la reserva actual
                    $reservedSeats = $tour->visits()
                                          ->where('id', '!=', $visit->id) // Excluir la visita actual
                                          ->whereIn('status', ['pending', 'approved'])
                                          ->sum('number_of_people');
                    // Calcular los asientos disponibles tomando en cuenta la reserva actual
                    $availableSeats = $tour->max_people - $reservedSeats;

                    if ($value > $availableSeats) {
                        $fail('El número de personas excede el cupo disponible para este tour.');
                    }
                },
            ],
            'status' => [
                'required',
                Rule::in(['pending', 'approved', 'rejected']),
            ],
            'requested_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
            'additional_info' => 'nullable|string|max:255',
            // No necesitas validar user_id y tour_id si no son editables
            // Si son editables, asegúrate de validarlos aquí
        ];
    }
}
