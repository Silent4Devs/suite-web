@extends('layouts.frontend')

@section('content')


    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('amenazas.index') !!}">Amenaza</a>
        </li>
        <li class="breadcrumb-item active">Crear</li>
    </ol>
    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Amenaza</h3>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'amenazas.store']) !!}

            @include('frontend.amenazas.fields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection
