{{-- Pestañas --}}
<div class="olimpiadas-tabs">
    <ul class="olimpiadas-tab-nav">
        <li class="olimpiadas-tab-item active" data-tab="GM">Grado Medio</li>
        <li class="olimpiadas-tab-item" data-tab="GS">Grado Superior</li>
    </ul>

    @foreach(['GM' => 'Grado Medio', 'GS' => 'Grado Superior'] as $grado => $label)
        <div class="olimpiadas-tab-panel {{ $loop->first ? 'active' : '' }}" data-panel="{{ $grado }}">
            @if(isset($resultados[$grado]) && $resultados[$grado]->isNotEmpty())

                <div class="olimpiadas-carousel" data-grado="{{ $grado }}">
                    @foreach($resultados[$grado] as $prueba => $filas)
                        <div class="olimpiadas-slide">
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
                        </div>
                    @endforeach
                </div>

            @else
                <p class="olimpiadas-sin-datos">Sin resultados disponibles.</p>
            @endif
        </div>
    @endforeach
</div>

<style>
    .olimpiadas-tab-nav         { display: flex; list-style: none; padding: 0; margin: 0 0 1rem 0; border-bottom: 2px solid #ccc; gap: 0.5rem; }
    .olimpiadas-tab-item        { padding: 0.5rem 1.5rem; cursor: pointer; border: 2px solid transparent; border-bottom: none; border-radius: 4px 4px 0 0; margin-bottom: -2px; transition: background 0.2s; }
    .olimpiadas-tab-item:hover  { background: #f0f0f0; }
    .olimpiadas-tab-item.active { border-color: #ccc; border-bottom-color: white; background: white; font-weight: bold; }
    .olimpiadas-tab-panel       { display: none; }
    .olimpiadas-tab-panel.active{ display: block; }
    .olimpiadas-sin-datos       { padding: 1rem; color: #888; font-style: italic; }

    /* Slick necesita que el contenedor sea visible para inicializarse */
    .olimpiadas-carousel        { margin-top: 1rem; }
</style>
