@extends('layouts.master')

@section('content')
<div id="resultados-container">
    @include('partials.frontend._resultados_tabla', ['resultados' => $resultados])
</div>

{{-- Indicador de última actualización --}}
<p class="text-muted text-end mt-2">
    Última actualización: <span id="ultimo-refresco">{{ now()->format('H:i:s') }}</span>
    <span id="cuenta-atras" class="ms-2">(30s)</span>
</p>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let segundos = 30;

        function actualizarCuentaAtras() {
            document.getElementById('cuenta-atras').textContent = '(' + segundos + 's)';
        }

        function refrescarResultados() {
            fetch('{{ route("resultados_live.datos") }}')
                .then(function (response) {
                    if (!response.ok) throw new Error('Error HTTP: ' + response.status);
                    return response.text();
                })
                .then(function (html) {
                    document.getElementById('resultados-container').innerHTML = html;
                    document.getElementById('ultimo-refresco').textContent =
                        new Date().toLocaleTimeString('es-ES');
                    segundos = 30;
                })
                .catch(function (err) {
                    console.error('Error al refrescar resultados:', err);
                    segundos = 30; // reintenta en el siguiente ciclo aunque haya fallado
                });
        }

        setInterval(function () {
            segundos--;
            actualizarCuentaAtras();
            if (segundos <= 0) refrescarResultados();
        }, 1000);
    });
</script>
@endsection
