@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/evaluations/evaluations.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('content')
    @livewire('cargar-objetivos-area', ['id_area' => $AreaID])
@endsection
