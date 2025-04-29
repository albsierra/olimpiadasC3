<div class="container">
    <h3>Patrocinadores</h3>
    <p>El CIFP Carlos III y todos los participantes en la Olimpiada Informática
        agradecen la colaboración de:</p>
    <div class="features carousel">
        @foreach ($patrocinadores as $patrocinador)
            <article>
                <a href="{{ $patrocinador->url ?? '' }}" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset('storage/' . $patrocinador->logotipo) }}" alt="{{ $patrocinador->nombre }}" class="img-fluid">
                </a>
                <div class="inner">
                    <h4>{{ $patrocinador->nombre }}</h4>
                </div>
            </article>
        @endforeach
    </div>
</div>
