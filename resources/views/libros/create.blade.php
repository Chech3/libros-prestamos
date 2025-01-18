@extends('layouts.tailwind')

@section('content')

    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Crear Libro</h1>

        <form action="{{ route('libros.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Nombre del Libro -->
            <div>
                <label for="nombre_del_libro" class="block text-sm font-medium text-gray-700">Nombre del Libro</label>
                <input type="text" name="nombre_del_libro" id="nombre_del_libro"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- Nombre del Autor -->
            <div>
                <label for="nombre_del_autor" class="block text-sm font-medium text-gray-700">Nombre del Autor</label>
                <input type="text" name="nombre_del_autor" id="nombre_del_autor"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- Género Literario -->
            <div>
                <label for="género_literario" class="block text-sm font-medium text-gray-700">Género Literario</label>
                <input type="text" name="género_literario" id="género_literario"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- ISBN -->
            <div>
                <label for="ISBN" class="block text-sm font-medium text-gray-700">ISBN</label>
                <input type="text" name="ISBN" id="ISBN"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- Editorial -->
            <div>
                <label for="editorial" class="block text-sm font-medium text-gray-700">Editorial</label>
                <input type="text" name="editorial" id="editorial"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- Idioma -->
            <div>
                <label for="idioma" class="block text-sm font-medium text-gray-700">Idioma</label>
                <input type="text" name="idioma" id="idioma"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- Nacionalidad -->
            <div>
                <label for="nacionalidad" class="block text-sm font-medium text-gray-700">Nacionalidad</label>
                <input type="text" name="nacionalidad" id="nacionalidad"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- Código del Autor -->
            <div>
                <label for="código_del_autor" class="block text-sm font-medium text-gray-700">Código del Autor</label>
                <input type="number" name="código_del_autor" id="código_del_autor"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- Número de Páginas -->
            <div>
                <label for="número_de_páginas" class="block text-sm font-medium text-gray-700">Número de Páginas</label>
                <input type="number" name="número_de_páginas" id="número_de_páginas"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- Disponibilidad -->
            <div>
                <label for="casilla_disponibilidad" class="block text-sm font-medium text-gray-700">Disponibilidad</label>
                <select name="casilla_disponibilidad" id="casilla_disponibilidad"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="1" selected>Disponible</option>
                    <option value="0">No Disponible</option>
                </select>
            </div>

            <!-- Cantidad -->
            <div>
                <label for="cantidad" class="block text-sm font-medium text-gray-700">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- Comentario -->
            <div>
                <label for="comentario" class="block text-sm font-medium text-gray-700">Comentario</label>
                <textarea name="comentario" id="comentario" rows="4"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('libros.index') }}"
                    class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow hover:bg-gray-300">Cancelar</a>
                <button type="submit"
                    class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow hover:bg-indigo-700">Guardar Libro</button>
            </div>
        </form>
    @stop

</div>
