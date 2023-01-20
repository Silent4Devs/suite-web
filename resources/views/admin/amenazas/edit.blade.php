@extends('layouts.admin')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.amenazas.index') !!}">Amenaza</a>
        </li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
    <h5 class="col-12 titulo_general_funcion">Editar: Amenaza</h5>
    <div class="mt-4 card">
        <div class="card-body">
            {!! Form::model($amenaza, ['route' => ['admin.amenazas.update', $amenaza->id], 'method' => 'patch']) !!}

            @include('admin.amenazas.fields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection
