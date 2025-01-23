@extends('layouts.app')


@section('content')
    <div class="max-w-7xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Listado de Categorias</h1>

        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Botón para crear nuevo libro -->
        <div class="flex justify-end mb-4">
            {{-- <form class="flex gap-2" method="GET" action="{{ route('categorias.index') }}">
                <input
                    class="mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    type="text" name="nombre" placeholder="Nombre del libro" value="{{ request('nombre') }}">
                <input
                    class="mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    type="text" name="autor" placeholder="Autor" value="{{ request('autor') }}">
                <div class="flex items-center">
                    <button
                        class="flex rounded-md bg-blue-200 px-2 py-1 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm hover:bg-blue-500"
                        type="submit">
                        <img class="w-6 h-6" src="/evaluacion.png" alt="">
                    </button>
                </div>
            </form> --}}
            <a href="{{ route('categorias.create') }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700">Nueva Categoria</a>

        </div>

        <!-- Tabla de libros -->
        <div class="overflow-x-auto">

            <table class="min-w-full border-collapse border border-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 border border-gray-200 text-left text-sm font-medium text-gray-700">#</th>
                        <th class="px-4 py-2 border border-gray-200 text-left text-sm font-medium text-gray-700">Nombre
                            de la Categoria</th>
                        <th class="px-4 py-2 border border-gray-200 text-center text-sm font-medium text-gray-700">
                            Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($categorias as $categoria)
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $categoria->nombre }}</td>


                            <td class="flex justify-center space-x-2">
                                <a href="{{ route('categorias.edit', $categoria) }}"
                                    class="px-3 py-1 text-xs text-white bg-blue-500 rounded-md hover:bg-blue-600">Editar</a>
                                <form action="{{ route('categorias.destroy', $categoria) }}" method="POST"
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
            {{-- <div class="mt-4">
                {{ $libros->links() }}
            </div> --}}
        </div>
    </div>
@endsection
