@extends('layouts.tailwind')

@section('content')

    <div class="max-w-4xl mx-auto p-6 bg-blue-100 shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Editar Destinario</h1>

        <form action="{{ route('destinarios.update', $destinario->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

           

           

            <!-- asignatura -->
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input  type="text" name="nombre" id="nombre" value="{{ $destinario->nombre }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

           

            <!-- Asignatura -->
            <div>
                <label for="telefono" class="block text-sm font-medium text-gray-700">Telefono</label>
                <input  type="text" name="telefono" id="telefono" value="{{ $destinario->telefono }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input  type="text" name="email" id="email" value="{{ $destinario->email }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>
            <div>
                <label for="direccion" class="block text-sm font-medium text-gray-700">Direccion</label>
                <input  type="text" name="direccion" id="direccion" value="{{ $destinario->direccion }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            

            <!-- Botones -->
            <div class="flex justify-end space-x-4">
                <button type="submit"
                class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow hover:bg-indigo-700">Actualizar Préstamo</button>
                <a href="{{ route('destinarios.index') }}"
                    class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow hover:bg-gray-300">Volver</a>
            </div>
        </form>
    @stop

</div>
