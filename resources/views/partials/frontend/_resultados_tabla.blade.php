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
                        <div class="olimpiadas-slide {{ $loop->first ? 'active' : '' }}">
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

                    @if($resultados[$grado]->count() > 1)
                        <div class="olimpiadas-carousel-controls">
                            <button class="olimpiadas-prev">&#8592;</button>
                            <div class="olimpiadas-dots">
                                @foreach($resultados[$grado] as $prueba => $filas)
                                    <span class="olimpiadas-dot {{ $loop->first ? 'active' : '' }}"
                                          data-index="{{ $loop->index }}"></span>
                                @endforeach
                            </div>
                            <button class="olimpiadas-next">&#8594;</button>
                        </div>
                    @endif

                </div>

            @else
                <p class="olimpiadas-sin-datos">Sin resultados disponibles.</p>
            @endif
        </div>
    @endforeach
</div>

<style>
    .olimpiadas-tab-nav {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0 0 1rem 0;
        border-bottom: 2px solid #ccc;
        gap: 0.5rem;
    }
    .olimpiadas-tab-item {
        padding: 0.5rem 1.5rem;
        cursor: pointer;
        border: 2px solid transparent;
        border-bottom: none;
        border-radius: 4px 4px 0 0;
        margin-bottom: -2px;
        transition: background 0.2s;
    }
    .olimpiadas-tab-item:hover          { background: #f0f0f0; }
    .olimpiadas-tab-item.active         { border-color: #ccc; border-bottom-color: white; background: white; font-weight: bold; }
    .olimpiadas-tab-panel               { display: none; }
    .olimpiadas-tab-panel.active        { display: block; }
    .olimpiadas-sin-datos               { padding: 1rem; color: #888; font-style: italic; }

    .olimpiadas-slide                   { display: none; }
    .olimpiadas-slide.active            { display: block; }

    .olimpiadas-carousel-controls {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        margin-top: 1rem;
    }
    .olimpiadas-prev,
    .olimpiadas-next {
        background: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 0.25rem 0.75rem;
        cursor: pointer;
        font-size: 1rem;
        transition: background 0.2s;
    }
    .olimpiadas-prev:hover,
    .olimpiadas-next:hover              { background: #f0f0f0; }

    .olimpiadas-dots                    { display: flex; gap: 0.4rem; align-items: center; }
    .olimpiadas-dot {
        width: 10px; height: 10px;
        border-radius: 50%;
        background: #ccc;
        cursor: pointer;
        transition: background 0.2s;
    }
    .olimpiadas-dot.active              { background: #555; }
</style>
