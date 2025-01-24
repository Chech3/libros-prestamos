<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Prestamo;
use Illuminate\Http\Request;
use Log;

class PrestamoController extends Controller
{
    public function index(Request $request)
    {
        $query = Prestamo::query();

        if ($request->filled('nombre_del_usuario')) {
            $query->where('nombre_del_usuario', 'like', '%' . $request->nombre_del_usuario . '%');
        }
        $prestamos = $query->paginate(10);
    
        return view('prestamos.index', compact('prestamos'));

        // $prestamos = Prestamo::paginate(10);
        
        // return view('prestamos.index', compact('prestamos'));
    }

    public function create()
    {
        $libros = Libro::where('cantidad', '>', 0)->get(); // Solo libros con stock disponible
        return view('prestamos.create', compact('libros'));
    }

    public function store(Request $request)
{
    // Validar los datos de entrada
    $request->validate([
        'nombre_del_usuario' => 'required|string',
        'fecha_de_prestamo' => 'required|date',
        'fecha_de_devolución' => 'required|date|after:fecha_de_prestamo',
        'libro_id' => 'required|exists:libros,id', // Asegúrate de validar el campo libro_id
    ]);

    try {
        // Crear el préstamo
        $prestamo = Prestamo::create([
            'nombre_del_usuario' => $request->nombre_del_usuario,
            'fecha_de_prestamo' => $request->fecha_de_prestamo,
            'fecha_de_devolución' => $request->fecha_de_devolución,
            'dirección' => $request->dirección,
            'barrio' => $request->barrio,
            'ciudad' => $request->ciudad,
            'teléfono' => $request->teléfono,
            'libro_id' => $request->libro_id,
            'asignatura' => $request->asignatura, // Si el campo asignatura no es obligatorio, lo puedes añadir también
            'sancionado' => $request->sancionado ?? false, 
        ]);

        // Reducir la cantidad del libro
        $libro = Libro::find($request->libro_id);
        if ($libro->cantidad > 0) {
            $libro->cantidad -= 1;
            $libro->save();
        } else {
            return redirect()->back()->withErrors(['error' => 'El libro no está disponible']);
        }

        return redirect()->route('prestamos.index')->with('success', 'Préstamo registrado correctamente');
    } catch (\Exception $e) {
        Log::error('Error al registrar préstamo: ' . $e->getMessage());
        return back()->withErrors('Error al registrar el préstamo. Intenta nuevamente.');
    }
}
    

    public function show(Prestamo $prestamo)
    {
        $libros = Libro::all();
        return view('prestamos.show', compact('prestamo', 'libros'));
    }

    public function edit($id)
    {
       // Obtener el préstamo con el ID proporcionado
       $prestamo = Prestamo::findOrFail($id);
        
       // Obtener todos los libros para el select
       $libros = Libro::all();
       
       // Retornar la vista con el préstamo y los libros
       return view('prestamos.edit', compact('prestamo', 'libros'));
    }

    public function update(Request $request, Prestamo $prestamo)
    {
        $prestamo->update($request->all());
        return redirect()->route('prestamos.index');
    }

    public function destroy(Prestamo $prestamo)
    {
        $prestamo->delete();
        return redirect()->route('prestamos.index');
    }
}
