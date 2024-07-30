@extends('layouts.admin')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/requisitions/requisitions.css') }}{{ config('app.cssVersion') }}">
    <link rel="stylesheet" href="{{ asset('css/requisitions/jquery.signature.css') }}{{ config('app.cssVersion') }}">

    @livewire('requisiciones-create-component')
@endsection
