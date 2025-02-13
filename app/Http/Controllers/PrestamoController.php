<?php

namespace App\Http\Controllers;

use App\Models\Destinario;
use App\Models\Libro;
use App\Models\Prestamo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Log;

class PrestamoController extends Controller
{
    public function index(Request $request)
    {
        $query = Prestamo::with(['destinario', 'libro']); // Cargar relaciones

        // Filtrar por nombre del usuario si se proporciona
        if ($request->filled('nombre_del_usuario')) {
            $query->whereHas('destinario', function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->nombre_del_usuario . '%');
            });
        }

        // Obtener los préstamos con paginación
        $prestamos = $query->paginate(10); // Paginación de 10 elementos por página

        // Agrupar los préstamos por 'destinario_id' después de la paginación
        $prestamosGrouped = $prestamos->getCollection()->groupBy('destinario_id');

        // Reemplazar la colección de la paginación con la agrupada
        $prestamos->setCollection(collect($prestamosGrouped));

        return view('prestamos.index', compact('prestamos'));
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
            'libro_id' => 'required|array|min:1',  // Asegurar que es un array con al menos un elemento
            'libro_id.*' => 'exists:libros,id',
        ]);

        try {
            foreach ($request->libro_id as $libroId) {
                // Buscar el libro
                $libro = Libro::find($libroId);

                if ($libro && $libro->cantidad > 0) {
                    // Crear el préstamo
                    Prestamo::create([
                        'fecha_de_prestamo' => $request->fecha_de_prestamo,
                        'fecha_de_devolución' => $request->fecha_de_devolución,
                        'destinario_id' => $request->destinario_id,
                        'libro_id' => $libroId,
                        'asignatura' => $request->asignatura,
                        'sancionado' => $request->sancionado ?? false,
                    ]);

                    // Restar 1 a la cantidad de libros disponibles
                    $libro->decrement('cantidad');
                } else {
                    return back()->withErrors("El libro con ID {$libroId} no está disponible.");
                }
            }

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
        $libros = Libro::all();
        $prestamo = Prestamo::findOrFail($id);
        $destinarios = Destinario::all();
    
        return view('prestamos.edit', compact('prestamo', 'libros', 'destinarios'));
    }


    public function update(Request $request, Prestamo $prestamo)
    {
        // Validar los datos de entrada
        $request->validate([
            'destinario_id' => 'required|string',
            'fecha_de_prestamo' => 'required|date',
            'fecha_de_devolución' => 'required|date|after:fecha_de_prestamo',
            'libro_id' => 'required|array',
            'libro_id.*' => 'exists:libros,id',
        ]);

        try {
            // Restaurar la cantidad de libros del préstamo anterior
            $libroAnterior = Libro::find($prestamo->libro_id);
            if ($libroAnterior) {
                $libroAnterior->increment('cantidad');
            }

            // Actualizar el préstamo con los nuevos valores
            $prestamo->update([
                'fecha_de_prestamo' => $request->fecha_de_prestamo,
                'fecha_de_devolución' => $request->fecha_de_devolución,
                'destinario_id' => $request->destinario_id,
                'libro_id' => is_array($request->libro_id) ? $request->libro_id[0] : $request->libro_id, // Si quieres múltiples libros, necesitarás cambiar la lógica
                'asignatura' => $request->asignatura,
                'sancionado' => $request->sancionado ?? false,
            ]);

            // Restar la cantidad del nuevo libro
            $libroNuevo = Libro::find($request->libro_id[0]);
            if ($libroNuevo && $libroNuevo->cantidad > 0) {
                $libroNuevo->decrement('cantidad');
            } else {
                return back()->withErrors("El libro seleccionado no está disponible.");
            }

            return redirect()->route('prestamos.index')->with('success', 'Préstamo actualizado correctamente');

        } catch (\Exception $e) {
            Log::error('Error al actualizar préstamo: ' . $e->getMessage());
            return back()->withErrors('Error al actualizar el préstamo. Intenta nuevamente.');
        }
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
