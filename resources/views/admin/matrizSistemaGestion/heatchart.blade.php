@extends('layouts.admin')
@section('content')
    <style>
        .cursor-pointer {
            cursor: pointer;
        }

        .calor {
            width: 100%;
            margin-top: 30px;
            float: left;
        }

        .datosCalor {
            width: 40%;
            float: left;
        }

        .datosColor label {
            font-family: maven regular;
        }

        .barra1 {
            width: 100%;
            height: 25px;
            float: left;
            box-shadow: -3px 3px 3px 0px #999;
            border-radius: 50px;
            font-family: maven regular;
            text-align: center;
            padding-top: 5px;
            color: #fff;
        }

        #s_baja {
            background-color: #18a827;
            display: none;
        }

        #s_media {
            background-color: #eef100;
            display: none;
            color: #000;
        }

        #s_alta {
            background-color: #ff9600;
            display: none;
        }

        #s_muyAlta {
            background-color: #cb0000;
            display: none;
        }

        .barra2 {
            width: 100%;
            height: 25px;
            float: left;
            box-shadow: -3px 3px 3px 0px #999;
            border-radius: 50px;
            font-family: maven regular;
            text-align: center;
            padding-top: 5px;
            color: #fff;
        }

        #p_baja {
            background-color: #18a827;
            display: none;
        }

        #p_media {
            background-color: #eef100;
            display: none;
            color: #000;
        }

        #p_alta {
            background-color: #ff9600;
            display: none;
        }

        #p_muyAlta {
            background-color: #cb0000;
            display: none;
        }

        .barra3 {
            width: 100%;
            height: 25px;
            float: left;
            box-shadow: -3px 3px 3px 0px #999;
            border-radius: 50px;
            font-family: maven regular;
            text-align: center;
            padding-top: 5px;
            color: #fff;
        }

        #r_baja {
            background-color: #18a827;
            display: none;
        }

        #r_media {
            background-color: #eef100;
            display: none;
            color: #000;
        }

        #r_alta {
            background-color: #ff9600;
            display: none;
        }

        #r_muyAlta {
            background-color: #cb0000;
            display: none;
        }

        .mapaCalor {
            width: 60%;
            float: right;
            display: flex;
            justify-content: center;

        }

        .mapaCalor table {
            font-family: maven regular;
            margin-top: 50px;
        }

        .mapaCalor td {
            width: 100px;
            height: 50px;
            text-align: center;
        }

        .mapaCalor td:hover {
            filter: saturate(500%);
        }

        .verde {
            background-color: #18a827;
            cursor: pointer;
        }

        .amarillo {
            background-color: #eef100;
            cursor: pointer;
        }

        .naranja {
            background-color: #ff9600;
            cursor: pointer;
        }

        .rojo {
            background-color: #cb0000;
            cursor: pointer;
        }

    </style>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/heatmap.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <div class="mt-5 card">

        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Matriz Riesgo
                </strong></h3>
        </div>
        <div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
            <div class="row w-100">
                <div class="text-center col-1 align-items-center d-flex justify-content-center">
                    <div class="w-100">
                        <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                    </div>
                </div>
                <div class="col-11">
                    <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones</p>
                    <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Por favor, seleccione opciones para mostrar sus
                        datos</p>
                </div>
            </div>
        </div>
        @include('partials.flashMessages')
        <div class="card-body">
            <div class="container">
                @livewire('sistema-gestion-heatmap', ['id_analisis' => $id])
            </div>
        </div>
    </div>

@endsection
