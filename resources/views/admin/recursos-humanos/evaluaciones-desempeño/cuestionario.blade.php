@extends('layouts.admin')
@section('content')
    <div class="card card-body">
        @livewire('cuestionario-evaluacion-desempeno', ['id_evaluacion' => $evaluacion, 'id_evaluado' => $evaluado])
    </div>
@endsection
