<?php

namespace App\Http\Controllers;

use App\Models\Destinario;
use Illuminate\Http\Request;

class DestinarioController extends Controller
{
    public function index(Request $request)
    {

        $query = Destinario::query();

        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

       

        $destinarios = $query->paginate(10);

        return view('destinarios.index', compact('destinarios'));
        
        // $destinarios = Destinario::all();
        // return view('destinarios.index', compact('destinarios'));
    }

    public function create()
    {
        return view('destinarios.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ]);

        Destinario::create($validated);

        return redirect()->route('destinarios.index')->with('success', 'Destinario creado exitosamente.');
    }

    public function destroy(Destinario $destinario)
    {
        $destinario->delete();
        return redirect()->route('destinarios.index');
    }

    public function edit($id)
    {
        $destinario = Destinario::findOrFail($id);
        
        return view('destinarios.edit', compact('destinario', ));
    }

    public function update(Request $request, Destinario $destinario)
    {
        $destinario->update($request->all());
        return redirect()->route('destinarios.index')->with('success', 'Destinario actualizado exitosamente.');
    }
}
