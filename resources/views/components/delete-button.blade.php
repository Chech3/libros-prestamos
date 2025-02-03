<form class="display: inline-block;" action="{{ $url }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar?')">
    @csrf
    @method('DELETE')
    <button type="submit"
            class="px-3 py-1 text-xs text-white bg-red-500 rounded-md hover:bg-red-600" {{ $attributes }}>
        <img class="w-4 h-6" src="/delete.svg" alt="Eliminar">
    </button>
</form>