@extends('layouts.admin')
@section('content')
@include('layouts.instructor',['course'=>$course])
@livewire('escuela.instructor.courses-curriculum',['course'=>$course])
@endsection
