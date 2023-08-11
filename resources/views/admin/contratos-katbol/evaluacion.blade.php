@extends('layouts.app')

@section('content')

    <link rel="stylesheet" type="text/css" href="{{asset('css/botones.css')}}">

    <style>

        .asterisco {
            color: red;
            margin-left: 5px;

        }

    </style>

    <div class="row">
        <div class="col s12 m12">
            <div class="card">
                <div class="card-content black-text">
                    <span class="card-title"></span>
                    @livewire('evaluacion-servicio.evaluacion-component', ['nivel_id' => $ids])

                </div>
                <div class="card-action">
                    <div class="col s12 right-align">
                        <a onclick="window.close();" class="btn-redondeado waves-effect waves-light btn">Cerrar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
