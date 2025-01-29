<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Libro;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function index()
    {
        // Obtener todas las categorías
        $categorias = Categoria::all();
        return view('reporte.index', compact('categorias'));
    }

    public function generarReporte(Request $request)
    {
        // Validar entrada
        $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        // Filtrar los libros por la categoría seleccionada
        $libros = Libro::where('categoria_id', $request->categoria_id)->get();
        $categoria = Categoria::find($request->categoria_id);

        // Generar el PDF
        $pdf = Pdf::loadView('reporte.pdf', compact('libros', 'categoria'));
        
        // Descargar el archivo PDF
        return $pdf->download('reporte_libros_categoria_' . $categoria->nombre . '.pdf');
    }
}

