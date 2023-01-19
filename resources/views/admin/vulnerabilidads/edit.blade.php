@extends('layouts.admin')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.vulnerabilidads.index') !!}">Vulnerabilidades</a>
        </li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
    <h5 class="col-12 titulo_general_funcion">Editar: Vulnerabilidad</h5>
    <div class="mt-4 card">
        <div class="card-body">
            {!! Form::model($vulnerabilidad, ['route' => ['admin.vulnerabilidads.update', $vulnerabilidad->id], 'method' => 'patch']) !!}

            @include('admin.vulnerabilidads.editfields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection
