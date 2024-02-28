<?php

namespace App\Http\Controllers;

use App\Models\Components;
use App\Http\Requests\StoreComponentsRequest;
use App\Http\Requests\UpdateComponentsRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Parsedown;


class ComponentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('permission:create-component|edit-component|delete-component', ['only' => ['index','show']]);
       $this->middleware('permission:create-component', ['only' => ['create','store']]);
       $this->middleware('permission:edit-component', ['only' => ['edit','update']]);
       $this->middleware('permission:delete-component', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        return view('components.index', [
            'components' => Components::latest()->paginate(4)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('components.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreComponentsRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('rutaImagenComponente') && $request->file('rutaImagenComponente')->isValid()) {
            $image = $request->file('rutaImagenComponente');
            $imageName = Str::slug($request->input('titleComponente')).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/componentes'), $imageName);
            $data['rutaImagenComponente'] = 'images/componentes/'.$imageName;
        }

        Components::create($data);
        return redirect()->route('components.index')
                ->withSuccess('New component is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Components $component)
    {
        return view('components.show', [
            'component' => $component
        ]);
    }

    public function publicShow($id)
    {
        $component = Components::findOrFail($id);
        // $component = Component::findOrFail($id);
        // $component->contentComponente = Markdown::parse($component->contentComponente);

        $parsedown = new Parsedown();

        $component->contentComponente = $parsedown->text($component->contentComponente);
        // Asumiendo que `components_detail` es el nombre de tu nueva vista.
        return view('components.component_detail', compact('component'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Components $component) // Cambia $components a $component
    {
        return view('components.edit', [
            'component' => $component // Asegúrate de que esto coincida con la variable en tu vista
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateComponentsRequest $request, Components $component): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('rutaImagenComponente') && $request->file('rutaImagenComponente')->isValid()) {
            // Eliminar la imagen anterior si existe
            // $oldImage = public_path($component->rutaImagenComponente);
            // if (file_exists($oldImage)) {
            //     @unlink($oldImage);
            // }

            // Procesar la nueva imagen
            $image = $request->file('rutaImagenComponente');
            $imageName = Str::slug($request->input('titleComponente')).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/componentes'), $imageName);
            $data['rutaImagenComponente'] = 'images/componentes/'.$imageName;
        }

        $component->update($data);
        return redirect()->route('components.index')
                ->withSuccess('Component updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Components $component)
    {
        $component->delete();
        return redirect()->route('components.index')
                ->withSuccess('Components is deleted successfully.');
    }
}
