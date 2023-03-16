@extends('layouts.admin')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.amenazas.index') !!}">Amenaza</a>
        </li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body azul_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Editar: </strong> Amenaza</h3>
        </div>
        <div class="card-body">
            {!! Form::model($amenaza, ['route' => ['admin.amenazas.update', $amenaza->id], 'method' => 'patch']) !!}

            @include('admin.amenazas.fields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection
