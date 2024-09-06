@extends('layouts.admin')
@section('content')
    @livewire('escuela.course-status', [$curso, $evaluacionesLeccion])
@endsection

@section('scripts')
@endsection
