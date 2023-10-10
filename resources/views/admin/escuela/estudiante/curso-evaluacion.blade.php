@extends('layouts.admin')
@section('content')
    @livewire('escuela.answer-evaluation-user', [$curso_id, $evaluacion_id])
@endsection

@section('scripts')
@endsection
