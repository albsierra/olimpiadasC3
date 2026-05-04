document.addEventListener('DOMContentLoaded', function () {

    var INTERVALO_CARRUSEL = 5;
    var UMBRAL_PAUSA       = 6;
    var carouselTimers     = {};
    var segundos           = 30;

    // ── Carrusel con Slick ────────────────────────────────────────────

    function avanzarCarrusel(carousel) {
        if (segundos <= UMBRAL_PAUSA) return;
        $(carousel).slick('slickNext');
    }

    function iniciarTimerCarrusel(carousel) {
        var grado = carousel.dataset.grado;

        // Garantiza que solo existe un timer por carrusel
        if (carouselTimers[grado]) {
            clearInterval(carouselTimers[grado]);
            carouselTimers[grado] = null;
        }

        carouselTimers[grado] = setInterval(function () {
            avanzarCarrusel(carousel);
        }, INTERVALO_CARRUSEL * 1000);
    }

    function inicializarCarruseles() {
        $('.olimpiadas-carousel').each(function () {
            var $carousel = $(this);
            var carousel  = this;
            var grado     = this.dataset.grado;

            // Limpia el timer ANTES de tocar Slick
            if (carouselTimers[grado]) {
                clearInterval(carouselTimers[grado]);
                carouselTimers[grado] = null;
            }

            var siguienteSlide = 0;
            if ($carousel.hasClass('slick-initialized')) {
                var actual    = $carousel.slick('slickCurrentSlide');
                var numSlides = $carousel.slick('getSlick').slideCount;
                siguienteSlide = (actual + 1) % numSlides;

                // Elimina listeners ANTES de unslick
                $carousel.off('afterChange');
                $carousel.slick('unslick');
            }

            $carousel.slick({
                dots:           true,
                arrows:         true,
                autoplay:       false,
                infinite:       true,
                slidesToShow:   1,
                slidesToScroll: 1,
                initialSlide:   siguienteSlide,
                adaptiveHeight: true,
            });

            // .off().on() garantiza que solo hay UN listener afterChange
            $carousel.off('afterChange').on('afterChange', function () {
                iniciarTimerCarrusel(carousel);
            });

            iniciarTimerCarrusel(carousel);
        });
    }

    // ── Pestañas ──────────────────────────────────────────────────────

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

                nav.querySelectorAll('.olimpiadas-carousel').forEach(function (c) {
                    if ($(c).hasClass('slick-initialized')) {
                        $(c).slick('setPosition');
                    }
                });
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

    // ── Refresco automático (un único setInterval, creado una sola vez) ──

    function actualizarCuentaAtras() {
        document.getElementById('cuenta-atras').textContent = '(' + segundos + 's)';
    }

    function refrescarResultados() {
        var gradoAnterior = gradoActivo();

        fetch('/resultados_live/datos')
            .then(function (response) {
                if (!response.ok) throw new Error('Error HTTP: ' + response.status);
                return response.text();
            })
            .then(function (html) {
                document.getElementById('resultados-container').innerHTML = html;
                inicializarTabs();
                inicializarCarruseles();
                restaurarTab(gradoAnterior);
                document.getElementById('ultimo-refresco').textContent =
                    new Date().toLocaleTimeString('es-ES');
            })
            .catch(function (err) {
                console.error('Error al refrescar resultados:', err);
            });
    }

    // Este setInterval se crea UNA sola vez y nunca se destruye
    setInterval(function () {
        segundos--;
        actualizarCuentaAtras();
        if (segundos <= 0) {
            segundos = 30;
            refrescarResultados();
        }
    }, 1000);
});
