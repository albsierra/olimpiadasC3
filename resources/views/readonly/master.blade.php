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
		<link rel="stylesheet" href="{{ asset('storage/ediciones/edicion' . \App\Models\Edicion::getEdicionActual()->id . '/main.css') }}" />
        <link rel="icon" href="{{ asset('favicon.ico') }}">
        <!-- Carrusel patrocinadores CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('/slick/slick.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('/slick/slick-theme.css') }}"/>
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
                        <img src="{{ asset('storage/ediciones/edicion' . \App\Models\Edicion::getEdicionActual()->id . '/banner.png') }}" alt="" />
                        </a>
                    </div>

                    @yield('content')
                </div>
            <!-- Footer -->
            @include('readonly.footer')
        </div>
        @yield('scripts')
	</body>
</html>
