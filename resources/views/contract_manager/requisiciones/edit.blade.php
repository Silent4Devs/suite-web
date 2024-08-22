@extends('layouts.admin')

@section('content')
@section('titulo', 'Actualizar Requisicion')
    <link rel="stylesheet" href="{{asset('css/requisitions/requisitions.css')}}{{config('app.cssVersion')}}">
    {{-- {{ Breadcrumbs::render('proveedores_create') }} --}}

    @livewire('requisiciones-edit-component', ['requisiciondata' => $requisiciondata])

@endsection
