@foreach($resultados as $grado => $pruebas)
    <h3>{{ $grado }}</h3>
    @foreach($pruebas as $prueba => $filas)
        <h4>{{ $prueba }}</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Apellidos</th>
                    <th>Nombre</th>
                    <th>Puntuación</th>
                    <th>Tiempo final</th>
                    <th>Penalizaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($filas as $pos => $r)
                <tr>
                    <td>{{ $pos + 1 }}</td>
                    <td>{{ $r->lastname }}</td>
                    <td>{{ $r->firstname }}</td>
                    <td>{{ number_format($r->maxpuntuacion, 2) }}</td>
                    <td>{{ $r->TiempoFinal }}</td>
                    <td>{{ $r->penalizaciones }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
@endforeach
