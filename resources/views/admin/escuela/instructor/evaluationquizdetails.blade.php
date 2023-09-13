@extends('layouts.admin')
@section('content')
   @livewire('escuela.instructor.table-quiz-details',[$course->id])
@endsection

@section('scripts')
@endsection
