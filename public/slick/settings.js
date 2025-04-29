
document.addEventListener('DOMContentLoaded', function () {
    $('.carousel').slick({
        infinite: true,
        slidesToShow: 3, // Número de patrocinadores visibles
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        dots: true, // Mostrar indicadores
        arrows: true, // Mostrar flechas de navegación
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });
});
