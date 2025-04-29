<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Palmarés de Edición') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @include('partials.alerts')
                    <form action="{{ route('resultados.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="id">Edición:</label>
                            <select id="id" name="id">
                                @foreach ($ediciones as $edicion)
                                    <option value="{{ $edicion->id }}" {{ session('edicion') && session('edicion')->id == $edicion->id ? 'selected' : '' }}>
                                        {{ $edicion->curso_escolar }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="palmares" class="block text-gray-700">Palmarés</label>
                            <textarea id="tinymce" name="palmares" id="palmares" class="w-full border-gray-300 rounded-md">
                                {{ old('palmares') }}
                            </textarea>
                        </div>
                        <input type="submit" class="primary" value="Guardar"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
