@extends('layouts.master')

@section('header')
        @include('readonly.header')
@endsection

@section('content')
        @include('readonly.main')
@endsection

@section('scripts')
        @parent
			<script src="{{ asset('js/inscripciones.js') }}"></script>
@endsection
