<div class="container">
    <h3>Resultados</h3>

    <section>
        <div>
        @if ($palmares)
            <div>{!! $palmares !!}</div> <!-- Mostrar el contenido HTML del atributo palmares -->
        @else
            <p>No hay resultados disponibles para esta edición.</p>
        @endif
        </div>
    </section>
</div>
