@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-blue-100 shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Generar Reporte por Categoría</h1>

    <form target="_blank" action="{{ route('reporte.libros.generar') }}" method="POST">
        @csrf

        <!-- Seleccionar Categoría -->
        <div>
            <label for="categoria_id" class="block text-sm font-medium text-gray-700">Seleccione una Categoría</label>
            <select name="categoria_id" id="categoria_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                <option value="">-- Seleccione una categoría --</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Botón -->
        <div class="mt-4 flex justify-end">
            <button type="submit" class="px-4 py-2 text-white bg-green-600 rounded-md shadow hover:bg-green-700">
                <img src="/imprimit.svg" class="h-8 w-8" alt="">
            </button>
        </div>
    </form>
</div>
@endsection
