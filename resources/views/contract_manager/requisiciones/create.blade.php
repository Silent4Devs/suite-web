@extends('layouts.admin')

@section('titulo', 'Crear Requisicion')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/requisiciones.css') }}{{ config('app.cssVersion') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.signature.css') }}{{ config('app.cssVersion') }}">

    <!-- Livewire Styles -->
    @livewireStyles

    <!-- Contenido del componente Livewire -->
    @livewire('requisiciones-create-component')

    <!-- Livewire Scripts -->
    @livewireScripts

    <!-- Otros scripts necesarios, si los hay -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery.signature.js') }}"></script>

@endsection
