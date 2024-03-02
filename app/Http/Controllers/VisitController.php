<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Tour;
use App\Models\User;

use App\Http\Requests\StoreVisitRequest;
use App\Http\Requests\UpdateVisitRequest;
use Illuminate\View\View;

class VisitController extends Controller
{

    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('permission:edit-visit|delete-visit', ['only' => ['index','show']]);
    //    $this->middleware('permission:create-visit', ['only' => ['create','store']]);
       $this->middleware('permission:edit-visit', ['only' => ['edit','update']]);
       $this->middleware('permission:delete-visit', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ordenar por estado 'pending' primero y luego por 'requested_date'
        $visits = Visit::with(['user', 'tour'])
            ->orderByRaw("FIELD(status, 'pending') DESC") // Dar prioridad a 'pending'
            ->orderBy('requested_date', 'asc') // Luego ordenar por la fecha solicitada
            ->latest() // Finalmente, ordenar por fecha de creación
            ->paginate(10);

        // Pasar las visitas a la vista
        return view('visits.index', compact('visits'));
    }

    private function validateVisit($tour, $numberOfPeople, $visitId = null) {
        $reservedSeats = $tour->visits()
                              ->where('id', '!=', $visitId)
                              ->whereIn('status', ['pending', 'approved'])
                              ->sum('number_of_people');
        $availableSeats = $tour->max_people - $reservedSeats;

        if ($numberOfPeople > $availableSeats) {
            throw ValidationException::withMessages(['number_of_people' => 'El número de personas excede el cupo disponible para este tour  .']);

        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVisitRequest $request)
    {
        $validated = $request->validated();

        // Crear la visita con los datos validados
        $visit = new Visit();
        $visit->user_id = auth()->id(); // o $request->user()->id;
        $visit->tour_id = $validated['tour_id'];
        $visit->number_of_people = $validated['number_of_people'];
        $visit->additional_info = $validated['additional_info'] ?? ''; // Asume que 'additional_info' es opcional
        $visit->status = 'pending';
        $visit->requested_date = now();
        $visit->save();

        // Opcionalmente, actualiza los cupos disponibles del tour si es necesario
        // Este paso depende de tu lógica de negocio y cómo quieres manejar los cupos
        // Por ejemplo, si deseas disminuir el cupo disponible inmediatamente después de la reserva:
        // $tour = Tour::find($validated['tour_id']);
        // if ($tour) {
        //     // Actualizar cupo disponible, esto es solo un ejemplo
        //     $tour->max_people -= $validated['number_of_people'];
        //     $tour->save();
        // }

        return redirect()->route('tours.publicShow')->with('success', 'Reserva realizada con éxito. Espera la confirmación.');
    }

    public function approve($id)
    {
        $visit = Visit::findOrFail($id);
        $tour = $visit->tour;

        // Usar el método privado para validar
        $this->validateVisit($tour, $visit->number_of_people, $visit->id);

        $visit->update(['status' => 'approved', 'approved_date' => now()]);
        return back()->with('success', 'Visit approved successfully.');
    }


    public function decline($id)
    {
        $visit = Visit::findOrFail($id);
        $visit->update(['status' => 'rejected']);
        return back()->with('success', 'Visit declined successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        // Buscar la visita por su ID y cargar las relaciones necesarias
        $visit = Visit::with(['user', 'tour'])->findOrFail($id);

        // Pasar la visita a la vista
        return view('visits.show', compact('visit'));
    }

    public function publicVisits()
    {
        // Asegúrate de que solo los usuarios autenticados puedan acceder a sus visitas
        $userId = auth()->id();

        // Obtener todas las visitas del usuario para hoy o fechas futuras, incluyendo la información del tour asociado
        $visits = Visit::with('tour')
                        ->where('user_id', $userId)
                        ->whereDate('requested_date', '>=', now()->toDateString()) // Filtra para incluir solo visitas de hoy en adelante
                        ->orderBy('requested_date', 'asc') // Ordena las visitas por la fecha solicitada, de más antigua a más reciente
                        ->get();

        // Pasar las visitas a la vista correspondiente
        return view('visits.publicVisits', compact('visits'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visit $visit)
    {
        // Cargar la relación con User y Tour para acceder a sus propiedades en la vista
        $visit->load('user', 'tour');

        // Pasar la visita y listas adicionales si son necesarias para el formulario, como listados de usuarios o tours.
        // Esto es útil si, por ejemplo, quieres permitir cambiar el tour de la visita.
        $users = User::all(); // O la lista de usuarios que pueden ser asignados a la visita
        $tours = Tour::all(); // O la lista de tours que pueden ser seleccionados

        return view('visits.edit', compact('visit', 'users', 'tours'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVisitRequest $request, Visit $visit)
    {
        $validatedData = $request->validated();
        // dd($validatedData);

        // Actualizar la visita
        $visit->update($validatedData);

        // Redirigir a alguna parte con un mensaje de éxito
        return redirect()->route('visits.index')->with('success', 'Visit updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visit $visit)
    {
        $visit->delete();
        return redirect()->route('visits.index')
                ->withSuccess('Visit is deleted successfully.');
        // $tour->delete();
        // return redirect()->route('tours.index')
        //         ->withSuccess('Tours is deleted successfully.');
        //
    }
}
