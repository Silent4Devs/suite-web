@extends('layouts.admin')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/botones.css') }}">

    <style>
        .asterisco {
            color: red;
            margin-left: 5px;

        }
    </style>

    <div class="row">
        <div class="col s12 m12">
            <div class="card">
                @livewire('evaluacion-servicio.evaluacion-component', ['nivel_id' => $ids])
                <div class="card-row">
                    <div class="form-group col-12 text-right mt-4" style="margin-left: 10px; margin-right: 10px;">
                        <div class="col s12 m12 right-align btn-grd distancia">
                            <a onclick="window.close();" class="btn btn_cancelar">
                                Cerrar
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
