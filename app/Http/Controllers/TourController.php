<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Components;
use App\Http\Requests\StoreTourRequest;
use App\Http\Requests\UpdateTourRequest;
use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class TourController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-tour|edit-tour|delete-tour', ['only' => ['index','show']]);
        $this->middleware('permission:create-tour', ['only' => ['create','store']]);
        $this->middleware('permission:edit-tour', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-tour', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Carga ansiosa de los componentes relacionados con cada tour y paginación
        $tours = Tour::with('components')->latest()->paginate(4);

        // Pasar los tours a la vista
        return view('tours.index', compact('tours'));
    }


    /**
     * Show the form for creating a new resource.
     */

     public function create(): View
    {
        // Obtener todos los componentes para poder seleccionarlos en el formulario
        $components = Components::all();

        // Pasar los componentes a la vista
        return view('tours.create', compact('components'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTourRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $tour = Tour::create($validatedData);

        // Asociar componentes si se han proporcionado
        if (!empty($validatedData['components'])) {
            $tour->components()->sync($validatedData['components']);
        }

        // Redirigir al índice con un mensaje de éxito
        return redirect()->route('tours.index')->with('success', 'Tour created successfully!');
    }



    /**
     * Display the specified resource.
     */
    public function show(Tour $tour)
    {
        return view('tours.show', [
            'tour' => $tour
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tour $tour)
    {
        // Obtén todos los componentes para poder listarlos en la vista.
        $components = Components::all();

        return view('tours.edit', [
            'tour' => $tour,
            'components' => $components,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTourRequest $request, Tour $tour)
    {
        // Recuperar los datos validados
        $validatedData = $request->validated();

        // Actualizar el tour con los datos validados
        $tour->update($validatedData);

        // Si se proporcionaron componentes, actualizar la relación many-to-many
        // Esto reemplazará cualquier relación existente con los nuevos componentes seleccionados
        if (array_key_exists('components', $validatedData)) {
            $tour->components()->sync($validatedData['components']);
        }

        // Redirigir al usuario con un mensaje de éxito
        return redirect()->route('tours.index')->with('success', 'Tour updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tour $tour)
    {
        $tour->delete();
        return redirect()->route('tours.index')
                ->withSuccess('Tours is deleted successfully.');
    }
}
