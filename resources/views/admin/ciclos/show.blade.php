<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ciclo ') . $ciclo->nombre . __(' del  ') . $ciclo->grado->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table-auto w-full">
                        <tbody>
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">ID</th>
                                    <th class="px-4 py-2">Nombre</th>
                                </tr>
                            </thead>
                            <tr>
                                <td class="border px-4 py-2">{{ $ciclo->grado->id }}</td>
                                <td class="border px-4 py-2">{{ $ciclo->grado->nombre }}</td>
                                <td class="border px-4 py-2">&nbsp;</td>
                            </tr>
                            <thead>
                                <tr>
                                    <th class="px-4 py-2" colspan="1">Codigo</th>
                                    <th class="px-4 py-2">Nombre</th>
                                    <th class="px-4 py-2">Acciones</th>
                                    <th class="px-4 py-2">&nbsp;</th>
                                </tr>
                            </thead>
                                <tr>
                                    <td class="border px-4 py-2">{{ $ciclo->codigo }}</td>
                                    <td class="border px-4 py-2">{{ $ciclo->nombre }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('ciclos.edit', $ciclo) }}" class="btn btn-sm btn-warning">Editar</a>
                                        <form action="{{ route('ciclos.destroy', $ciclo) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
                                        <a href="{{ route('grados.ciclos.index', ['grado' => $ciclo->grado->id]) }}"
                                             class="btn btn-sm btn-warning">
                                             Volver al listado
                                        </a>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>