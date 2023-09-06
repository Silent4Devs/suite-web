@extends('layouts.admin')
@section('content')
    @livewire('escuela.instructor.table-quiz-details', [$curso_id, $evaluacion_id])
@endsection

@section('scripts')
@endsection
