<?php

namespace App\Http\Controllers;

use App\Models\Destinario;
use App\Models\Libro;
use App\Models\Prestamo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
        $destinarios = Destinario::all();
        $libros = Libro::where('cantidad', '>', 0)->get(); // Solo libros con stock disponible
        return view('prestamos.create', compact('libros', 'destinarios'));
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'destinario_id' => 'required|string',
            'fecha_de_prestamo' => 'required|date',
            'fecha_de_devolución' => 'required|date|after:fecha_de_prestamo',
            'libro_id' => 'required|exists:libros,id',
        ]);

        try {
            // Crear el préstamo
            $prestamo = Prestamo::create([
                'fecha_de_prestamo' => $request->fecha_de_prestamo,
                'fecha_de_devolución' => $request->fecha_de_devolución,
                'destinario_id' => $request->destinario_id,
                'libro_id' => $request->libro_id,
                'asignatura' => $request->asignatura,
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

          

            // Redirigir a la vista prestamos.index
            return redirect()->route('prestamos.index')->with('success', 'Préstamo registrado correctamente');

        } catch (\Exception $e) {
            Log::error('Error al registrar préstamo: ' . $e->getMessage());
            return back()->withErrors('Error al registrar el préstamo. Intenta nuevamente.');
        }
    }


    public function show($id)
    {
        $libros = Libro::all();
        $prestamo = Prestamo::findOrFail($id);
        $destinarios = Destinario::all();
        return view('prestamos.show', compact('prestamo', 'libros', 'destinarios'));
    }

    public function edit($id)
    {
        // Obtener todos los libros para el select
        $libros = Libro::all();

        $prestamo = Prestamo::findOrFail($id);
        $destinarios = Destinario::all();


        // Retornar la vista con el préstamo y los libros
        return view('prestamos.edit', compact('prestamo', 'libros', 'destinarios'));
    }


    public function update(Request $request, Prestamo $prestamo)
    {
        $prestamo->update($request->all());
        return redirect()->route('prestamos.index')->with('success', 'Préstamo actualizado correctamente');
    }

    public function destroy(Prestamo $prestamo)
    {
        $prestamo->delete();
        $libro = Libro::find($prestamo->libro_id);
        if ($libro->cantidad > 0) {
            $libro->cantidad += 1;
            $libro->save();
        } else {
            return redirect()->back()->withErrors(['error' => 'El libro no está disponible']);
        }

        return redirect()->route('prestamos.index');
    }

    public function imprimir($id)
    {
        $prestamo = Prestamo::findOrFail($id);
        $destinario = Destinario::findOrFail($prestamo->destinario_id);
        $libro = Libro::findOrFail($prestamo->libro_id);

        $pdf = Pdf::loadView('prestamos.pdf', compact('prestamo', 'destinario', 'libro'));
        return $pdf->stream('reporte_prestamo_' . $prestamo->id . '.pdf');
    }
}
