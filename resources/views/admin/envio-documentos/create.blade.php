@extends('layouts.admin')

@section('content')


    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.envio-documentos.index') !!}">Mensajería</a>
        </li>
        <li class="breadcrumb-item active">Solicitar</li>
    </ol>
    <h5 class="col-12 titulo_general_funcion">Solicitar: Mensajería</h5>
    <div class="mt-4 card">
        {{-- <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Amenaza</h3>
        </div> --}}
        <div class="card-body">
            {!! Form::open(['route' => 'admin.envio-documentos.store']) !!}

            @include('admin.envio-documentos.fields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection
