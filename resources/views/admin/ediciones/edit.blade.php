<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Edicion') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @include('partials.alerts')
                    <form action="{{ route('ediciones.update', ['edicion' => $edicion]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="curso_escolar" class="block text-gray-700">Curso Escolar</label>
                            <input type="text" name="curso_escolar" id="curso_escolar" value="{{ old('curso_escolar') ?? $edicion->curso_escolar }}" class="w-full border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="fecha_celebracion" class="block text-gray-700">Fecha Celebracion</label>
                            <input type="date" name="fecha_celebracion" id="fecha_celebracion" value="{{ old('fecha_celebracion') ?? $edicion->fecha_celebracion }}" class="w-full border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="fecha_apertura" class="block text-gray-700">Fecha Apertura</label>
                            <input type="datetime-local" name="fecha_apertura" id="fecha_apertura" value="{{ old('fecha_apertura') ?? $edicion->fecha_apertura }}" class="w-full border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="fecha_cierre" class="block text-gray-700">Fecha Cierre</label>
                            <input type="datetime-local" name="fecha_cierre" id="fecha_cierre" value="{{ old('fecha_cierre') ?? $edicion->fecha_cierre }}" class="w-full border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="css_file" class="block text-gray-700">File CSS</label>
                            <input type="file" name="css_file" id="css_file" class="w-full border-gray-300 rounded-md">
                        </div>

                        <!-- Gestión de categorías de esa edición-->
                        <div class="mb-4">
                            <h3 class="text-gray-700">Categorías</h3>
                            @foreach (\App\Models\Categoria::all() as $categoria)
                                <div class="flex items-center mb-2">
                                    <!-- Checkbox para seleccionar la categoría -->
                                    <input type="checkbox" name="categorias[{{ $categoria->id }}][seleccionada]" id="categoria_{{ $categoria->id }}" value="1"
                                        {{ $edicion->categorias->contains($categoria->id) ? 'checked' : '' }}
                                        class="mr-2">
                                    <label for="categoria_{{ $categoria->id }}" class="text-gray-700">{{ $categoria->nombre }}</label>

                                    <!-- Campo numérico para el número de convocatoria -->
                                    <input type="number" name="categorias[{{ $categoria->id }}][num_convocatoria]" value="{{ $edicion->categorias->find($categoria->id)->pivot->num_convocatoria ?? '' }}"
                                        class="ml-4 w-20 border-gray-300 rounded-md" placeholder="Nº">
                                </div>
                            @endforeach
                        </div>
                        <input type="submit" class="primary" value="Guardar"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('admin.ediciones._files', ['edicion' => $edicion])
</x-app-layout>
