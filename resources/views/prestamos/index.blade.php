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
        <div class="flex justify-between mb-4">
            <form class="flex gap-2" method="GET" action="{{ route('prestamos.index') }}">
                <input
                    class="mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    type="text" name="nombre_del_usuario" placeholder="Nombre de la persona"
                    value="{{ request('nombre_del_usuario') }}">
                <div class="flex items-center">
                    <button
                        class="flex rounded-md bg-blue-200 px-2 py-1 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm hover:bg-blue-500"
                        type="submit">
                        <img class="w-6 h-6" src="/evaluacion.png" alt="">
                    </button>
                </div>
            </form>
            <a href="{{ route('prestamos.create') }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700">Nuevo Prestamo</a>
        </div>

        <!-- Tabla de Prestamos -->
        <div class="overflow-x-auto">
            <table id="prestamos-table" class="min-w-full border-collapse border border-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 border border-gray-200 text-left text-sm font-medium text-gray-700">#</th>
                        <th class="px-4 py-2 border border-gray-200 text-left text-sm font-medium text-gray-700">Usuario
                        </th>
                        <th class="px-4 py-2 border border-gray-200 text-left text-sm font-medium text-gray-700">Nombre del
                            Libro</th>
                        <th class="px-4 py-2 border border-gray-200 text-left text-sm font-medium text-gray-700">Fecha de
                            Prestamo</th>
                        <th class="px-4 py-2 border border-gray-200 text-left text-sm font-medium text-gray-700">Fecha de
                            Devolucion</th>
                        <th class="px-4 py-2 border border-gray-200 text-center text-sm font-medium text-gray-700">Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($prestamos as $prestamo)
                        @php
                            // Definir el rango de proximidad (3 días antes de la fecha de devolución)
                            $proximityDays = 3;
                            $dueDate = \Carbon\Carbon::parse($prestamo->fecha_de_devolución);
                            $now = \Carbon\Carbon::now();
                            $isDueSoon = $now->diffInDays($dueDate) <= $proximityDays && $dueDate->gt($now);
                        @endphp

                        <tr class="@if ($isDueSoon) bg-yellow-100 @endif">
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">
                                {{ $prestamo->destinario->nombre ?? 'Destinario no encontrado' }}
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-700">
                                {{ $prestamo->libro->nombre_del_libro ?? 'Libro no encontrado' }}
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $prestamo->fecha_de_prestamo }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">
                                @if ($isDueSoon)
                                    <span class="text-red-600 font-bold">{{ $prestamo->fecha_de_devolución }} (Próximo a
                                        vencer)</span>
                                @else
                                    {{ $prestamo->fecha_de_devolución }}
                                @endif
                            </td>
                            <td class="px-4 py-2 text-sm text-center">
                                <div class="flex justify-center space-x-2 ">
                                    <a href="{{ route('prestamos.show', $prestamo) }}"
                                        class="px-3 py-1 flex justify-center items-center rounded-md bg-purple-500 hover:bg-purple-600 transition-all">
                                        <img class="w-4 h-4" src="/lupa.svg" alt="">
                                    </a>

                                    <a href="{{ route('prestamos.edit', $prestamo->id) }}"
                                        class="px-3 py-1 text-xs text-white bg-blue-500 rounded-md hover:bg-blue-600 flex items-center justify-center transition-all">
                                        <img class="w-4 h-4" src="/edit.svg" alt="">
                                    </a>

                                    <a target="_blank" href="{{ route('imprimir.prestamo', $prestamo) }}"
                                        class="px-3 py-1 text-xs text-white bg-green-500 rounded-md hover:bg-green-600 transition-all">
                                        <img class="w-6 h-6" src="/imprimit.svg" alt="">
                                    </a>


                                    <x-delete-button url="{{ route('prestamos.destroy', $prestamo->id) }}" />

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $prestamos->links() }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.getElementById('prestamos-table');
            const rows = table.getElementsByTagName('tr');

            const today = new Date();
            today.setHours(0, 0, 0, 0); // Ignorar la hora, solo comparar fechas

            // Recorrer las filas de la tabla (empezando desde 1 para omitir el encabezado)
            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                const fechaDevolucionCell = cells[4]; // La celda de la fecha de devolución (índice 4)

                // Obtener la fecha de devolución del texto de la celda
                const fechaDevolucionText = fechaDevolucionCell.textContent.trim();
                const fechaDevolucion = new Date(fechaDevolucionText);

                // Comparar fechas
                if (fechaDevolucion < today) {
                    // Aplicar estilo a la fila
                    rows[i].classList.add('bg-red-100'); // Fondo rojo claro
                    fechaDevolucionCell.innerHTML =
                        `<span class="text-red-600 font-bold">${fechaDevolucionText} (Atrasado)</span>`;
                }
            }
        });
    </script>
@endsection
