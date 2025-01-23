@extends('layouts.tailwind')

@section('content')

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="max-w-4xl mx-auto p-6 bg-blue-100 shadow-md rounded-lg">

        <h1>Editar Categoría</h1>

        <form class="space-y-6" action="{{ route('categorias.update', $categoria) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="block text-sm font-medium text-gray-700" for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('nombre') is-invalid @enderror"
                    value="{{ old('nombre', $categoria->nombre) }}" required>
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex space-x-2 justify-end">
                <button type="submit"
                    class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow hover:bg-indigo-700">Actualizar
                    Categoría</button>
                <a href="{{ route('categorias.index') }}"
                    class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow hover:bg-gray-300">Cancelar</a>

            </div>
        </form>
    </div>

@stop
