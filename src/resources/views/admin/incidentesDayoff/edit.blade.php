@extends('layouts.admin')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{!! route('admin.incidentes-dayoff.index') !!}">Exepciones Day Off</a>
    </li>
    <li class="breadcrumb-item active">Editar</li>
</ol>
    <h5 class="col-12 titulo_general_funcion">Editar: Excepción</h5>
    <div class="mt-4 card">
        <div class="card-body">
            {!! Form::model($vacacion, ['route' => ['admin.incidentes-dayoff.update', $vacacion->id], 'method' => 'patch']) !!}

            @include('admin.incidentesVacaciones.fields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection
