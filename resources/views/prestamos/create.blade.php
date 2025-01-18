@extends('layouts.tailwind')

@section('content')

    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Crear Libro</h1>

        <form action="{{ route('prestamos.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Prestamo -->
            <div>
                <label for="nombre_del_usuario" class="block text-sm font-medium text-gray-700">Destinario</label>
                <input type="text" name="nombre_del_usuario" id="nombre_del_usuario"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- dirección -->
            <div>
                <label for="dirección" class="block text-sm font-medium text-gray-700">Dirección</label>
                <input type="text" name="dirección" id="dirección"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- Género Literario -->
            <div>
                <label for="barrio" class="block text-sm font-medium text-gray-700">Barrio</label>
                <input type="text" name="barrio" id="barrio"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- ciudad -->
            <div>
                <label for="ciudad" class="block text-sm font-medium text-gray-700">Ciudad</label>
                <input type="text" name="ciudad" id="ciudad"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- teléfono -->
            <div>
                <label for="teléfono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                <input type="number" name="teléfono" id="teléfono"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- nombre_del_libro -->
            <div>
                <label for="nombre_del_libro" class="block text-sm font-medium text-gray-700">Nombre del Libro</label>
                <input type="text" name="nombre_del_libro" id="nombre_del_libro"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- asignatura -->
            <div>
                <label for="asignatura" class="block text-sm font-medium text-gray-700">Asignatura</label>
                <input type="text" name="asignatura" id="asignatura"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- fecha_de_prestamo -->
            <div>
                <label for="fecha_de_prestamo" class="block text-sm font-medium text-gray-700">Fecha del Préstamo</label>
                <input type="date" name="fecha_de_prestamo" id="fecha_de_prestamo"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- fecha_de_devolución-->
            <div>
                <label for="fecha_de_devolución" class="block text-sm font-medium text-gray-700">Fecha de Devolución</label>
                <input type="date" name="fecha_de_devolución" id="fecha_de_devolución"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- sancionado -->
            <div>
                <label for="sancionado" class="block text-sm font-medium text-gray-700">Sancionado</label>
                <select name="sancionado" id="sancionado"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="0" selected>No</option>
                    <option value="1">Si</option>
                </select>
            </div>

            <!-- código_del_libro -->
            <div>
                <label for="código_del_libro" class="block text-sm font-medium text-gray-700">Código del libro</label>
                <input type="number" name="código_del_libro" id="código_del_libro"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

           

            <!-- Botones -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('libros.index') }}"
                    class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow hover:bg-gray-300">Cancelar</a>
                <button type="submit"
                    class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow hover:bg-indigo-700">Registrar Prestamo</button>
            </div>
        </form>
    @stop

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dateInput = document.getElementById('fecha_de_prestamo');
            const today = new Date();
            dateInput.value = today.toISOString().split('T')[0];
        });
    </script>

</div>
