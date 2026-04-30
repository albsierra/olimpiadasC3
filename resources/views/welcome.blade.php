@extends('layouts.master')

@section('header')
        @include('readonly.header')
@endsection

@section('content')
        @include('readonly.main')
@endsection

@section('scripts')
        @include('partials.frontend.scripts')
@endsection
