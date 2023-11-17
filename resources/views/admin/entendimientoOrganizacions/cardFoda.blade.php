@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/foda.css') }}">
@endsection
@section('content')
    <h5 class="col-12 titulo_general_funcion">Análisis FODA</h5>

    <div class="caja-cards">
        @foreach ($query as $foda)
            <div class="card card-foda">
                <div class="card-header">
                    <strong> 16-10-2022 </strong>
                </div>
                <div class="card-body">
                    <h3>
                        FODA Corporativo 2023 V3
                    </h3>
                    <p>
                        <small>Layla Delgadillo Aguilar</small>
                    </p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
