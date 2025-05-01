<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Participante ') . $participante->nombre . __(' del grupo ') . $participante->grupo->nombre }}
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
                                    <th class="px-4 py-2">Grupo</th>
                                </tr>
                            </thead>
                            <tr>
                                <td class="border px-4 py-2">{{ $participante->grupo->id }}</td>
                                <td class="border px-4 py-2">{{ $participante->grupo->nombre }}</td>
                                <td class="border px-4 py-2">&nbsp;</td>
                            </tr>
                            <thead>
                                <tr>
                                    <th class="px-4 py-2" colspan="1">Participante</th>
                                    <th class="px-4 py-2">Apellidos</th>
                                    <th class="px-4 py-2">Acciones</th>
                                    <th class="px-4 py-2">&nbsp;</th>
                                </tr>
                            </thead>
                                <tr>
                                    <td class="border px-4 py-2">{{ $participante->nombre }}</td>
                                    <td class="border px-4 py-2">{{ $participante->apellidos }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('participantes.edit', $participante) }}" class="btn btn-sm btn-warning">Editar</a>
                                        <form action="{{ route('participantes.destroy', $participante) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
                                        <a href="{{ route('participantes.index') }}" class="btn btn-sm btn-warning">Volver al listado</a>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
