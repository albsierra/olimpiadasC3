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

    // ── Estado de carruseles (sobrevive al refresco del DOM) ──────────
    var estadoCarruseles = {};  // { 'GM': { indice: 0, timer: null }, ... }

    // ── Carrusel ──────────────────────────────────────────────────────

    function irASlide(carousel, indice) {
        var slides = carousel.querySelectorAll('.olimpiadas-slide');
        var dots   = carousel.querySelectorAll('.olimpiadas-dot');
        var grado  = carousel.dataset.grado;
        if (!slides.length) return;

        indice = (indice + slides.length) % slides.length;

        slides.forEach(function (s) { s.classList.remove('active'); });
        dots.forEach(function (d)   { d.classList.remove('active'); });
        slides[indice].classList.add('active');
        if (dots[indice]) dots[indice].classList.add('active');

        estadoCarruseles[grado].indice = indice;
    }

    function iniciarCarrusel(carousel) {
        var grado  = carousel.dataset.grado;
        var slides = carousel.querySelectorAll('.olimpiadas-slide');
        if (slides.length <= 1) return;

        // Recupera el índice anterior si el DOM fue refrescado
        var indiceInicial = (estadoCarruseles[grado] !== undefined)
            ? estadoCarruseles[grado].indice
            : 0;

        // Limpia el timer anterior
        if (estadoCarruseles[grado] && estadoCarruseles[grado].timer) {
            clearInterval(estadoCarruseles[grado].timer);
        }

        estadoCarruseles[grado] = { indice: indiceInicial, timer: null };
        irASlide(carousel, indiceInicial);

        carousel.querySelector('.olimpiadas-prev').addEventListener('click', function () {
            clearInterval(estadoCarruseles[grado].timer);
            irASlide(carousel, estadoCarruseles[grado].indice - 1);
            estadoCarruseles[grado].timer = arrancarTimer(carousel);
        });

        carousel.querySelector('.olimpiadas-next').addEventListener('click', function () {
            clearInterval(estadoCarruseles[grado].timer);
            irASlide(carousel, estadoCarruseles[grado].indice + 1);
            estadoCarruseles[grado].timer = arrancarTimer(carousel);
        });

        carousel.querySelectorAll('.olimpiadas-dot').forEach(function (dot) {
            dot.addEventListener('click', function () {
                clearInterval(estadoCarruseles[grado].timer);
                irASlide(carousel, parseInt(this.dataset.index));
                estadoCarruseles[grado].timer = arrancarTimer(carousel);
            });
        });

        estadoCarruseles[grado].timer = arrancarTimer(carousel);
    }

    function arrancarTimer(carousel) {
        var grado = carousel.dataset.grado;
        return setInterval(function () {
            irASlide(carousel, estadoCarruseles[grado].indice + 1);
        }, 5000);
    }

    function inicializarCarruseles(contexto) {
        (contexto || document).querySelectorAll('.olimpiadas-carousel').forEach(function (c) {
            iniciarCarrusel(c);
        });
    }

    // ── Pestañas (igual que antes, sin cambios) ───────────────────────

    function inicializarTabs(contexto) {
        var tabs = (contexto || document).querySelectorAll('.olimpiadas-tab-item');
        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                var grado = this.dataset.tab;
                var nav   = this.closest('.olimpiadas-tabs');
                nav.querySelectorAll('.olimpiadas-tab-item').forEach(function (t) { t.classList.remove('active'); });
                nav.querySelectorAll('.olimpiadas-tab-panel').forEach(function (p) { p.classList.remove('active'); });
                this.classList.add('active');
                nav.querySelector('[data-panel="' + grado + '"]').classList.add('active');
            });
        });
    }

    function gradoActivo() {
        var activo = document.querySelector('.olimpiadas-tab-item.active');
        return activo ? activo.dataset.tab : 'GM';
    }

    function restaurarTab(grado) {
        var tab   = document.querySelector('.olimpiadas-tab-item[data-tab="' + grado + '"]');
        var panel = document.querySelector('.olimpiadas-tab-panel[data-panel="' + grado + '"]');
        if (tab && panel) {
            document.querySelectorAll('.olimpiadas-tab-item').forEach(function (t) { t.classList.remove('active'); });
            document.querySelectorAll('.olimpiadas-tab-panel').forEach(function (p) { p.classList.remove('active'); });
            tab.classList.add('active');
            panel.classList.add('active');
        }
    }

    // ── Arranque inicial ──────────────────────────────────────────────
    inicializarTabs();
    inicializarCarruseles();

    // ── Refresco automático ───────────────────────────────────────────
    var segundos = 30;

    function actualizarCuentaAtras() {
        document.getElementById('cuenta-atras').textContent = '(' + segundos + 's)';
    }

    function refrescarResultados() {
        var gradoAnterior = gradoActivo();

        fetch('{{ route("resultados_live.datos") }}')
            .then(function (response) {
                if (!response.ok) throw new Error('Error HTTP: ' + response.status);
                return response.text();
            })
            .then(function (html) {
                document.getElementById('resultados-container').innerHTML = html;
                inicializarTabs();
                inicializarCarruseles();        // restaura índices desde estadoCarruseles
                restaurarTab(gradoAnterior);
                document.getElementById('ultimo-refresco').textContent =
                    new Date().toLocaleTimeString('es-ES');
                segundos = 30;
            })
            .catch(function (err) {
                console.error('Error al refrescar resultados:', err);
                segundos = 30;
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
