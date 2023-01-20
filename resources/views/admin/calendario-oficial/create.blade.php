@extends('layouts.admin')

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>$(function () {
    $('#fecha').daterangepicker({
        "locale": {
            "format": "YYYY-MM-DD",
            "separator": " - ",
            "applyLabel": "Guardar",
            "cancelLabel": "Cancelar",
            "fromLabel": "Desde",
            "toLabel": "Hasta",
            "customRangeLabel": "Personalizar",
            "daysOfWeek": [
                "Do",
                "Lu",
                "Ma",
                "Mi",
                "Ju",
                "Vi",
                "Sa"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Setiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
            "firstDay": 1
        },
        "startDate": "2016-01-01",
        "endDate": "2016-01-07",
        "opens": "center"
    });
});
 </script>
@section('content')


    <ol class="breadcrumb">
        {{-- <li class="breadcrumb-item">
            <a href="{!! route('admin.calendario-oficial.index') !!}">Amenaza</a>
        </li>
        <li class="breadcrumb-item active">Crear</li> --}}
    </ol>
    <h5 class="col-12 titulo_general_funcion"> Registrar: Evento</h5>
    <div class="mt-4 card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.calendario-oficial.store']) !!}

            @include('admin.calendario-oficial.fields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection
