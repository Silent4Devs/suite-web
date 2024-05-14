@extends('layouts.admin')

@section('content')
@section('titulo', 'Crear Requisicion')

    <link rel="stylesheet" href="{{asset('css/requisiciones.css')}}{{config('app.cssVersion')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.signature.css')}}{{config('app.cssVersion')}}">

    {{-- {{ Breadcrumbs::render('proveedores_create') }} --}}

    @livewire('requisiciones-create-component')

    {{--  @livewire('data-doc')  --}}

@endsection
