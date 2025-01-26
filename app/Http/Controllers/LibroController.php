<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    public function index(Request $request)
    {
        $query = Libro::query();

        if ($request->filled('nombre')) {
            $query->where('nombre_del_libro', 'like', '%' . $request->nombre . '%');
        }

        if ($request->filled('autor')) {
            $query->where('nombre_del_autor', 'like', '%' . $request->autor . '%');
        }

        $libros = $query->paginate(10);

        return view('libros.index', compact('libros'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('libros.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        Libro::create($request->all());
        return redirect()->route('libros.index');
    }

    public function show($id)
    {
        $libro = Libro::findOrFail($id);
        $categorias = Categoria::all();
        return view('libros.show', compact('libro', 'categorias'));
    }

   
    public function edit($id)
    {
        $libro = Libro::findOrFail($id);
        $categorias = Categoria::all();
        return view('libros.edit', compact('libro', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        // Validar los datos enviados por el formulario
        $request->validate([
            'nombre_del_libro' => 'required|string|max:255',
            'nombre_del_autor' => 'required|string|max:255',
            // 'género_literario' => 'nullable|string|max:255',
            'ISBN' => 'nullable|string|max:255',
            'cantidad' => 'nullable|string|max:255',
            'editorial' => 'nullable|string|max:255',
            'idioma' => 'nullable|string|max:255',
            'nacionalidad' => 'nullable|string|max:255',
            'código_del_autor' => 'nullable|string|max:255',
            'número_de_páginas' => 'nullable|string|max:255',
            'casilla_disponibilidad' => 'nullable|string|max:255',
        ]);

        // Buscar el libro por ID
        $libro = Libro::findOrFail($id);

        // Actualizar los datos del libro
        $libro->update([
            'nombre_del_libro' => $request->nombre_del_libro,
            'nombre_del_autor' => $request->nombre_del_autor,
            'categoria_id' => $request->categoria_id,
            'ISBN' => $request->ISBN,
            'cantidad' => $request->cantidad,
            'editorial' => $request->editorial,
            'idioma' => $request->idioma,
            'nacionalidad' => $request->nacionalidad,
            'código_del_autor' => $request->código_del_autor,
            'número_de_páginas' => $request->número_de_páginas,
            'casilla_disponibilidad' => $request->casilla_disponibilidad,
        ]);

        // Redirigir al listado con un mensaje de éxito
        return redirect()->route('libros.index')->with('success', 'Libro actualizado correctamente');

    }

    public function destroy(Libro $libro)
    {
        $libro->delete();
        return redirect()->route('libros.index');
    }

}
