@extends('layouts.admin')

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

@section('content')


    <ol class="breadcrumb">
        {{-- <li class="breadcrumb-item">
            <a href="{!! route('admin.tabla-calendario.index') !!}">Amenaza</a>
        </li>
        <li class="breadcrumb-item active">Crear</li> --}}
    </ol>
    <h5 class="col-12 titulo_general_funcion">Registrar: Evento</h5>
    <div class="mt-4 card">
        <div class="card-body">
            {!! Form::open(['route' =>array('admin.tabla-calendario.update',$calendario),"method"=>"PUT"]) !!}
            @method("PUT")

            @include('admin.tabla-calendario.fields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection
