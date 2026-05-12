<!DOCTYPE HTML>
<!--
	Read Only by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Olimpiadas Informáticas Región de Murcia</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <meta name="description" content="Olimpiadas Informáticas Región de Murcia" />
        <meta name="author" content="CIFP Carlos III" />
        <meta lang="es" />
		<link rel="stylesheet" href="/storage/ediciones/edicion5/main.css" />
        <link rel="icon" href="/favicon.ico" type="image/x-icon" />
        <!-- Carrusel patrocinadores CSS -->
        <link rel="stylesheet" type="text/css" href="/slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="/slick/slick-theme.css"/>

    <style>
        .card{max-width:760px;padding:32px;background:#fff;border-radius:8px;box-shadow:0 6px 24px rgba(0,0,0,.06);text-align:center}
        .ribbon{width:96px;height:96px;margin:0 auto 18px;display:block}
        h1{margin:0 0 8px;font-size:1.4rem}
        p{margin:0 0 12px;color:#444}
        small{color:#666;display:block;margin-top:8px}
    </style>
	</head>
	<body class="is-preload">
        <!-- Header -->
        @yield('header')
		<!-- Wrapper -->
        <div id="wrapper">
            <!-- Main -->
                <div id="main">
                    <div class="image main" data-position="center">
                        <a href="{{ route('home') }}">
                        <img src="/storage/ediciones/edicion5/banner.png" alt="" />
                        </a>
                    </div>


    <div class="card" role="status" aria-live="polite">
        <!-- Lazo negro SVG -->
        <img src="https://upload.wikimedia.org/wikipedia/commons/0/0a/Black_Ribbon.svg" alt="Lazo negro" class="ribbon">

        <h1>{{ env('MAINTENANCE_TITLE', 'En memoria de un compañero') }}</h1>
        <p>{{ env('MAINTENANCE_MESSAGE', 'Guardamos luto por el fallecimiento de un compañero. Nuestro recuerdo permanece.') }}</p>
        @if(env('MAINTENANCE_PERSON'))
            <small>{{ env('MAINTENANCE_PERSON') }} · {{ env('MAINTENANCE_DATE', '') }}</small>
        @endif
        <p style="margin-top:16px;color:#666">La web de las Olimpiadas permanecerá en mantenimiento.<br />Gracias por su comprensión.</p>
    </div>
                </div>
            <!-- Footer -->
            @include('readonly.footer')
        </div>
	</body>
</html>
