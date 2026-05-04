@extends('layouts.master')

@section('content')
<div id="resultados-container">
    @include('partials.frontend._resultados_tabla', ['resultados' => $resultados])
</div>

<p class="text-muted text-end mt-2">
    Última actualización: <span id="ultimo-refresco">{{ now()->format('H:i:s') }}</span>
    <span id="cuenta-atras" class="ms-2">(30s)</span>
</p>
@endsection


@section('scripts')
        @parent
            <script src="{{ asset('js/resultados.js') }}"></script>
@endsection
