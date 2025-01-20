@extends('layouts.tailwind')

@section('content')

    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Visualizar Prestamo</h1>

        <form action="{{ route('prestamos.update', $prestamo->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nombre del destinario -->
            <div>
                <label for="nombre_del_usuario" class="block text-sm font-medium text-gray-700">Nombre del Destinario</label>
                <input disabled type="text" name="nombre_del_usuario" id="nombre_del_usuario" value="{{ $prestamo->nombre_del_usuario }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- dirección -->
            <div>
                <label for="dirección" class="block text-sm font-medium text-gray-700">Nombre del Autor</label>
                <input disabled type="text" name="dirección" id="dirección" value="{{ $prestamo->dirección }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- barrio -->
            <div>
                <label for="barrio" class="block text-sm font-medium text-gray-700">Género Literario</label>
                <input disabled type="text" name="barrio" id="barrio" value="{{ $prestamo->barrio }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- ciudad -->
            <div>
                <label for="ciudad" class="block text-sm font-medium text-gray-700">Ciudad</label>
                <input disabled type="text" name="ciudad" id="ciudad" value="{{ $prestamo->ciudad }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- teléfono -->
            <div>
                <label for="teléfono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                <input disabled type="text" name="teléfono" id="teléfono" value="{{ $prestamo->teléfono }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- nombre_del_libro -->
            <select name="libro_id" id="libro_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
                    <option value="">-- Seleccione un Libro --</option>
                    @foreach ($libros as $libro)
                        <option value="{{ $libro->id }}">{{ $libro->nombre_del_libro }} (Stock: {{ $libro->cantidad }})</option>
                    @endforeach
                </select>

            <!-- asignatura -->
            <div>
                <label for="asignatura" class="block text-sm font-medium text-gray-700">Asignatura</label>
                <input disabled type="text" name="asignatura" id="asignatura" value="{{ $prestamo->asignatura }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- Fecha de Préstamo -->
            <div>
                <label for="fecha_de_prestamo" class="block text-sm font-medium text-gray-700">Fecha del Préstamo</label>
                <input value="{{ $prestamo->fecha_de_prestamo }}" type="date" name="fecha_de_prestamo" id="fecha_de_prestamo"
                    disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- Fecha de Devolución-->
            <div>
                <label for="fecha_de_devolución" class="block text-sm font-medium text-gray-700">Fecha de Devolución</label>
                <input  disabled value="{{ $prestamo->fecha_de_devolución }}" type="date" name="fecha_de_devolución" id="fecha_de_devolución"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

           

        
            <!-- Botones -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('prestamos.index') }}"
                    class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow hover:bg-gray-300">Volver</a>
            </div>
        </form>
    @stop

</div>
