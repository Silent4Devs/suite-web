@extends('layouts.admin')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.vulnerabilidads.index') !!}">Vulnerabilidad</a>
        </li>
        <li class="breadcrumb-item active">Crear</li>
    </ol>
    <h5 class="col-12 titulo_general_funcion"> Registrar: Vulnerabilidad</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <div class="card-body">
                {!! Form::open(['route' => 'admin.vulnerabilidads.store']) !!}

                @include('admin.vulnerabilidads.fields')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
