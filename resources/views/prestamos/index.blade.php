@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Listado de Prestamos</h1>

        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Botón para crear nuevo libro -->
        <div class="flex justify-end mb-4">
            <a href="{{ route('prestamos.create') }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700">Nuevo Prestamo</a>
        </div>

        <!-- Tabla de Prestamos -->
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 border border-gray-200 text-left text-sm font-medium text-gray-700">#</th>
                        <th class="px-4 py-2 border border-gray-200 text-left text-sm font-medium text-gray-700">Destinario
                        </th>
                        <th class="px-4 py-2 border border-gray-200 text-left text-sm font-medium text-gray-700">Dirección
                        </th>
                        <th class="px-4 py-2 border border-gray-200 text-left text-sm font-medium text-gray-700">Teléfono
                        </th>
                        <th class="px-4 py-2 border border-gray-200 text-left text-sm font-medium text-gray-700">Nombre del
                            Libro
                        </th>
                        <th class="px-4 py-2 border border-gray-200 text-left text-sm font-medium text-gray-700">
                            Fecha de Prestamo</th>
                        <th class="px-4 py-2 border border-gray-200 text-left text-sm font-medium text-gray-700">
                            Fecha de Devolucion</th>
                        <th class="px-4 py-2 border border-gray-200 text-center text-sm font-medium text-gray-700">
                            Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($prestamos as $prestamo)
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $prestamo->nombre_del_usuario }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $prestamo->dirección }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $prestamo->teléfono }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">
                                {{ $prestamo->libro->nombre_del_libro ?? 'Libro no encontrado' }} </td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $prestamo->fecha_de_prestamo }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $prestamo->fecha_de_devolución }}</td>
                            
                            <td class="px-4 py-2 text-sm text-center">
                                <div class="flex justify-center space-x-2">

                                    <a href="{{ route('prestamos.show', $prestamo) }}"
                                        class="px-3 py-1 text-xs text-white bg-purple-500 rounded-md hover:bg-purple-600"
                                        href="">Ver</a>
                                    <!-- Botón Editar -->
                                    <a href="{{ route('prestamos.edit', $prestamo->id) }}"
                                        class="px-3 py-1 text-xs text-white bg-blue-500 rounded-md hover:bg-blue-600">Editar</a>

                                    <!-- Botón Eliminar -->
                                    <form action="{{ route('prestamos.destroy', $prestamo->id) }}" method="POST"
                                        onsubmit="return confirm('¿Estás seguro de que deseas eliminar este libro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1 text-xs text-white bg-red-500 rounded-md hover:bg-red-600">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
