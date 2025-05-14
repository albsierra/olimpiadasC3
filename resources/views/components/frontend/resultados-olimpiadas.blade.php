<table class="table table-bordered">
    <thead>
        <tr>
            <th>Grado</th>
            <th>Centro</th>
            <th>Grupo</th>
            <th>ID Prueba</th>
            <th>Máxima Puntuación</th>
            <th>Momento Conseguido</th>
            <th>Penalizaciones</th>
            <th>Tiempo Final</th>
            <th>Nombre de la Prueba</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($resultados as $resultado)
            <tr>
                <td>{{ $resultado->grado }}</td>
                <td>{{ $resultado->lastname }}</td>
                <td>{{ $resultado->firstname }}</td>
                <td>{{ $resultado->id_prueba }}</td>
                <td>{{ $resultado->maxpuntuacion }}</td>
                <td>{{ $resultado->MomentoConsecución }}</td>
                <td>{{ $resultado->penalizaciones }}</td>
                <td>{{ $resultado->TiempoFinal }}</td>
                <td>{{ $resultado->nombrePrueba }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
