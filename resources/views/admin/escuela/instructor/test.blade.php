@extends('layouts.admin')
@section('content')
<section>
    @livewire('escuela.instructor.table-questions',['course'=>$course,'evaluation'=>$evaluation])
</section>

@endsection
