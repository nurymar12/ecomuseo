<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\DB; // Importa el facade DB para realizar consultas

use App\Models\Tour; // Asegúrate de importar el modelo Tour aquí.
use Illuminate\Validation\Rule; // Si vas a usar reglas de validación personalizadas.
use Carbon\Carbon;

class StoreTourRequest extends FormRequest
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
            'description' => 'required|string',
            'start_date' => 'required|date_format:Y-m-d\TH:i',
            'end_date' => 'required|date_format:Y-m-d\TH:i|after_or_equal:start_date',
            'max_people' => 'required|integer|min:1',
            'contact_info' => 'required|string',
            'components' => 'required',
            'components.*' => 'exists:components,id',
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $startDate = Carbon::parse($this->start_date);
            $endDate = Carbon::parse($this->end_date);

            // Suponiendo que $this->components ya contiene los ID de los componentes seleccionados
            $componentIds = $this->components;

            // Verifica si hay algún tour existente que solape en fechas y utilice alguno de los mismos componentes
            $overlappingTours = DB::table('tours')
                ->join('components_tour', 'tours.id', '=', 'components_tour.tour_id')
                ->whereIn('components_tour.components_id', $componentIds)
                ->where(function($query) use ($startDate, $endDate) {
                    $query->whereBetween('tours.start_date', [$startDate, $endDate])
                          ->orWhereBetween('tours.end_date', [$startDate, $endDate]);
                })
                ->exists();

            if ($overlappingTours) {
                $validator->errors()->add('components', 'The selected components are already reserved for another tour within the provided date range.');
            }
        });
    }


}
