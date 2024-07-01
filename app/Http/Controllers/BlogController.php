<?php

namespace App\Http\Controllers;

use App\Models\Components;
use App\Models\Blog;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use Illuminate\View\View;
use Parsedown;
use Illuminate\Support\Facades\Auth;




class BlogController extends Controller
{

    public function __construct()
    {
        //    $this->middleware('auth');
        $this->middleware('auth')->except(['publicShow', 'publicIndex']);

       $this->middleware('permission:create-blog|edit-blog|delete-blog', ['only' => ['index','show']]);
       $this->middleware('permission:create-blog', ['only' => ['create','store']]);
       $this->middleware('permission:edit-blog', ['only' => ['edit','update']]);
       $this->middleware('permission:delete-blog', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Inicializa la consulta de blogs incluyendo las relaciones necesarias
        $query = Blog::with(['author', 'components']);

        // Si el usuario es un voluntario, filtrar para mostrar solo sus propios blogs
        if (Auth::user()->hasRole('Volunteer')) {
            $query->where('author_id', Auth::id());
        }
        // No es necesario aplicar ningún filtro para admin y superAdmin, ellos pueden ver todos los blogs

        $blogs = $query->latest()->paginate(10); // Ajusta la paginación como prefieras

        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $components = Components::all(); // Obtener todos los componentes

        return view('blogs.create', compact('components'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $validated = $request->validated();
        // dd($validated);
        // Crear el blog
        $blog = new Blog($validated);
        $blog->author_id = auth()->id(); // Asignar el ID del usuario autenticado como autor
        $blog->save();

        // Si se proporcionaron componentes, sincronizarlos
        if (!empty($validated['components'])) {
            $blog->components()->sync($validated['components']);
        }

        return redirect()->route('blogs.index')->with('success', 'Blog creado con éxito.');
    }

    public function approve($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->update(['status' => 'approved']);
        return back()->with('success', 'Blog approved successfully.');
    }


    public function decline($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->update(['status' => 'rejected']);
        return back()->with('success', 'Blog declined successfully.');
    }

    public function publicIndex()
    {
        // Obtener todos los blogs con sus componentes relacionados
        $blogs = Blog::with('components')->where('status', 'approved')->get();

        // Añadir la ruta de imagen de un componente asociado a cada blog
        foreach ($blogs as $blog) {
            // Asegúrate de que hay componentes y que tienen imágenes antes de intentar obtener una
            if ($blog->components->isNotEmpty() && $blog->components->first()->rutaImagenComponente) {
                // Puede elegir obtener la imagen del primer componente o una aleatoria
                $randomComponentWithImage = $blog->components->whereNotNull('rutaImagenComponente')->random();

                // $blog->displayImage = $blog->components;
                $blog->displayImage = $randomComponentWithImage->rutaImagenComponente;

            } else {
                // Si no hay componentes con imágenes, asignar un valor por defecto o dejarlo nulo
                $blog->displayImage = 'path/to/default-image.jpg'; // Asegúrate de que este path sea correcto
            }
        }

        // Pasar los blogs a la vista pública
        return view('blogs.public_index', compact('blogs'));
    }

    public function publicShow($id)
    {
        $blog = Blog::with('components', 'author')->findOrFail($id);

        // Convertir contenido Markdown a HTML
        $parsedown = new Parsedown();
        $blog->content = $parsedown->text($blog->content);

        return view('blogs.publicShow', compact('blog'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $blog = Blog::with(['author', 'components'])->findOrFail($id);

        // Si deseas pasar también los nombres de los componentes asociados o cualquier otra información adicional, puedes hacerlo aquí.
        // Por ejemplo, si quisieras pasar una lista de todos los componentes para mostrarlos en algún tipo de widget o lista en la vista, podrías cargarlos aquí.

        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // Método para mostrar el formulario de edición
    public function edit(Blog $blog)
    {
        $components = Components::all(); // Obtiene todos los componentes para la selección
        return view('blogs.edit', compact('blog', 'components'));
    }

    // Método para actualizar el blog
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $validated = $request->validated();
        $blog->update($validated);

        // Actualiza los componentes asociados si es necesario
        if (isset($validated['components'])) {
            $blog->components()->sync($validated['components']);
        } else {
            $blog->components()->detach();
        }

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blogs.index')
                ->withSuccess('Blog is deleted successfully.');
    }
}
