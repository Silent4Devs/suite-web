@extends('layouts.admin')
@section('content')
    @livewire('escuela.instructor.quiz-details',[$evaluation, $course])
@endsection

@section('scripts')
@endsection
