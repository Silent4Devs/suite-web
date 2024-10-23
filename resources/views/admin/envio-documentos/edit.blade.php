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
            <form action="{{ route('admin.envio-documentos.update', $solicitud->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('admin.envio-documentos.fields')

            </form>
        </div>

    </div>
@endsection
