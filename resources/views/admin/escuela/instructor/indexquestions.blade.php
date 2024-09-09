@extends('layouts.admin')
@section('content')
<section>
    <style>
         .cancel{
            background: #FFFFFF;
            color: #006DDB;
            border: 1px solid #006DDB;
        }

        .cancel:hover{
            color:#006DDB;
        }
    </style>
    @livewire('escuela.instructor.table-questions',['course'=>$course,'evaluation'=>$evaluation])
</section>

@endsection
