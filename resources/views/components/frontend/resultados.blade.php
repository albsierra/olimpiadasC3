<div class="container">
    <h3>Resultados</h3>

    <section>
        <div>
        @if ($palmares)
            <div>{!! $palmares !!}</div> <!-- Mostrar el contenido HTML del atributo palmares -->
        @else
            <p>Resultado NO oficiales</p>
            <x-resultados-olimpiadas />
        @endif
        </div>
    </section>
</div>
