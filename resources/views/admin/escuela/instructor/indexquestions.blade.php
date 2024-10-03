@extends('layouts.admin')
@section('content')
    <section>
        <style>
            .cancel {
                background: #FFFFFF;
                color: var(--color-tbj);
                border: 1px solid var(--color-tbj);
            }

            .cancel:hover {
                color: var(--color-tbj);
            }
        </style>
        @livewire('escuela.instructor.table-questions', ['course' => $course, 'evaluation' => $evaluation])
    </section>
@endsection
