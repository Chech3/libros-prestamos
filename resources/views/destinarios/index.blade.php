@extends('layouts.app')


@section('content')
    <div class="max-w-7xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Listado de Destinarios</h1>

        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Botón para crear nuevo libro -->
        <div class="flex justify-between mb-4">

            <form class="flex gap-2" method="GET" action="{{ route('destinarios.index') }}">
                <input
                    class="mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    type="text" name="nombre" placeholder="Nombre" value="{{ request('nombre') }}">
                <div class="flex items-center">
                    <button
                        class="flex rounded-md bg-blue-200 px-2 py-1 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm hover:bg-blue-500"
                        type="submit">
                        <img class="w-6 h-6" src="/evaluacion.png" alt="">
                    </button>
                </div>
            </form>

            <a href="{{ route('destinarios.create') }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700">Nuevo destinario</a>


        </div>

        <!-- Tabla de libros -->
        <div class="overflow-x-auto">

            <table class="min-w-full border-collapse border border-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 border border-gray-200 text-left text-sm font-medium text-gray-700">#</th>
                        <th class="px-4 py-2 border border-gray-200 text-left text-sm font-medium text-gray-700">Nombre
                        </th>
                        <th class="px-4 py-2 border border-gray-200 text-left text-sm font-medium text-gray-700">email
                        </th>
                        <th class="px-4 py-2 border border-gray-200 text-left text-sm font-medium text-gray-700">telefono
                        </th>
                        <th class="px-4 py-2 border border-gray-200 text-left text-sm font-medium text-gray-700">direccion
                        </th>

                        <th class="px-4 py-2 border border-gray-200 text-center text-sm font-medium text-gray-700">
                            Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($destinarios as $destinario)
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $destinario->nombre }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $destinario->email }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $destinario->telefono }}</td>

                            <td class="px-4 py-2 text-sm text-gray-700">{{ $destinario->direccion }}</td>
                            <td class="flex justify-center space-x-2">
                                <a href="{{ route('destinarios.edit', $destinario) }}"
                                    class="px-3 py-1 text-xs text-white bg-blue-500 rounded-md hover:bg-blue-600">Editar</a>
                                <form action="{{ route('destinarios.destroy', $destinario) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 text-xs text-white bg-red-500 rounded-md hover:bg-red-600"
                                        onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $destinarios->links() }}
            </div>
        </div>
    </div>
@endsection
