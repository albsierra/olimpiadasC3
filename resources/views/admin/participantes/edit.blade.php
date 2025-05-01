<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Participante') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @include('partials.alerts')
                    <form action="{{ route('participantes.update', ['participante' => $participante]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="grupo">Grupo:</label>
                            <select id="grupo" name="grupo">
                                @foreach ($grupos as $grupo)
                                    <option value="{{ $grupo->id }}" {{ (old('grupo') == $grupo->id || $participante->grupo->id == $grupo->id) ? 'selected' : '' }}>
                                        {{ $grupo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="nombre" class="block text-gray-700">Nombre</label>
                            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') ?? $participante->nombre }}" class="w-full border-gray-300 rounded-md">
                        </div> <!-- con que rellene el nombre ya sera suficiente no hace falta apellidos -->
                        <div class="mb-4">
                            <label for="apellidos" class="block text-gray-700">Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" value="{{ old('apellidos') ?? $participante->apellidos}}" class="w-full border-gray-300 rounded-md">
                        </div>
                        <input type="submit" class="primary" value="Guardar"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>