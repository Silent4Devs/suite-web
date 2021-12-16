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
    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Evento</h3>
        </div>
        <div class="card-body">
            {!! Form::open(['route' =>array('admin.tabla-calendario.update',$calendario),"method"=>"PUT"]) !!}
            @method("PUT")

            @include('admin.tabla-calendario.fields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection
