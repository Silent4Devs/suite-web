@extends('layouts.admin')

@section('content')
@section('titulo', 'Actualizar Requisicion')
    <link rel="stylesheet" href="{{asset('css/requisiciones.css')}}">
    {{-- {{ Breadcrumbs::render('proveedores_create') }} --}}

    @livewire('requisiciones-edit-component', ['requisiciondata' => $requisiciondata])

@endsection
