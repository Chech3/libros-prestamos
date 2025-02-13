@extends('layouts.tailwind')

@section('content')

    <div class="max-w-4xl mx-auto p-6 bg-blue-100 shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Editar Prestamo</h1>

        <form action="{{ route('prestamos.update', $prestamo->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="destinario_id" class="block text-sm font-medium text-gray-700">Seleccione un Destinatario</label>
                <select name="destinario_id" id="destinario_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
                    @foreach ($destinarios as $destinario)
                        <option value="{{ $destinario->id }}"
                            {{ $prestamo->destinario_id == $destinario->id ? 'selected' : '' }}>
                            {{ $destinario->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="libro_id" class="block text-sm font-medium text-gray-700">Seleccione Libros</label>
                <select name="libro_id[]" id="libro_id" multiple
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
                    @foreach ($libros as $libro)
                        <option value="{{ $libro->id }}" {{ in_array($libro->id, (array) $prestamo->libro_id) ? 'selected' : '' }}>
                            {{ $libro->nombre_del_libro }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- asignatura -->
            <div>
                <label for="asignatura" class="block text-sm font-medium text-gray-700">Asignatura</label>
                <input type="text" name="asignatura" id="asignatura" value="{{ $prestamo->asignatura }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- Fecha de Préstamo -->
            <div>
                <label for="fecha_de_prestamo" class="block text-sm font-medium text-gray-700">Fecha del Préstamo</label>
                <input value="{{ $prestamo->fecha_de_prestamo }}" type="date" name="fecha_de_prestamo"
                    id="fecha_de_prestamo"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- Fecha de Devolución-->
            <div>
                <label for="fecha_de_devolución" class="block text-sm font-medium text-gray-700">Fecha de Devolución</label>
                <input value="{{ $prestamo->fecha_de_devolución }}" type="date" name="fecha_de_devolución"
                    id="fecha_de_devolución"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-4">
                <button type="submit"
                    class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow hover:bg-indigo-700">Actualizar
                    Préstamo</button>
                <a href="{{ route('prestamos.index') }}"
                    class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow hover:bg-gray-300">Volver</a>
            </div>
        </form>
        <script>
            $(document).ready(function() {
           $('#libro_id').select2({
               placeholder: "Seleccione uno o varios libros",
               allowClear: true
           });
       });
       
       </script>
    @stop
        
</div>