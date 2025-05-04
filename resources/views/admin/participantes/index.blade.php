<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Participantes') }} del grupo {{ $grupo->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @include('partials.alerts')
                    <a href="{{ route('grupos.participantes.create', ['grupo' => $grupo]) }}" class="button primary">Crear Participante</a>
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Nombre</th>
                                <th class="px-4 py-2">Apellidos</th>
                                <th class="px-4 py-2">Acciones</th>
                                <th class="px-4 py-2">Inspeccionar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($participantes as $participante)
                                <tr>
                                    <td class="border px-4 py-2">{{ $participante->id }}</td>
                                    <td class="border px-4 py-2">{{ $participante->nombre }}</td>
                                    <td class="border px-4 py-2">{{ $participante->apellidos }}</td>
                                    <td class="border px-4 py-2">

                                        <a href="{{ route('participantes.edit', $participante) }}" class="btn btn-sm btn-warning">Editar</a>
                                        <form action="{{ route('participantes.destroy', $participante) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                    <td class="border px-4 py-2" colspan="3">
                                        <a href="{{ route('participantes.show', $participante) }}" class="btn btn-sm btn-primary">Ver Participante</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
