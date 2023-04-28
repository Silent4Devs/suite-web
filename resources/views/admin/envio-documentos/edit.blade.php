@extends('layouts.admin')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.envio-documentos.index') !!}">Mensajería</a>
        </li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
    <h5 class="col-12 titulo_general_funcion">Editar: Solicitud de Mensajería</h5>
    <div class="mt-4 card">
        <div class="card-body">
            {!! Form::model($solicitud, [
                'route' => ['admin.envio-documentos.update', $solicitud->id],
                'method' => 'put',
            ]) !!}

            @include('admin.envio-documentos.fields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection
