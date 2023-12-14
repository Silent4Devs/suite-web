@extends('layouts.admin')
@section('content')
    <style>
        .titulo-card {
            /* UI Properties */
            text-align: left;
            font: 16px Roboto;
            letter-spacing: 0px;
            color: #606060;
            opacity: 1;
        }

        .texto-card {
            text-align: left;
            font: 12px Segoe UI;
            letter-spacing: 0px;
            color: #FFFFFF;
            opacity: 1;
            margin-right: 30px;
            margin-left: 20px:
        }

        .titulo {
            text-align: left;
            font: normal normal 600 24px Segoe UI;
            letter-spacing: 0px;
            color: #2567AE;
            opacity: 1;
            margin-left: 5px;
            margin-bottom: 12px;
        }

        .card-t.card {
            background-color: #3B7EB2;
            box-shadow: 0px 1px 4px #0000000F;
            border-radius: 8px;
        }

        .card-body.card {
            box-shadow: 0px 1px 4px #0000000F;
            border-radius: 14px;
            width: 410px;
        }
    </style>
    <div class="titulo">Análisis de Brechas</div>
    <div class="row">
        <div class="card card-body mt-3" style="width:1030px;">
            <div class="titulo-card">Templates generados
                <hr>
            </div>
            <table class="table table-striped datatable-AlcanceSgsi">
                <thead class="thead-dark">
                    <tr>
                        <th style="max-width:300px !important;background-color:rgb(255, 255, 255); color:#414141;">ID</th>
                        <th style="min-width:200px; background-color:rgb(255, 255, 255); color:#414141;">Nombre del template
                        </th>
                        <th style="max-width:80px;background-color:rgb(255, 255, 255); color:#414141;">
                            Fecha de creación</th>
                        <th style="background-color:rgb(255, 255, 255); color:#414141;">No de preguntas</th>
                        <th style="background-color:rgb(255, 255, 255); color:#414141;">Top 8</th>
                        <th style="background-color:rgb(255, 255, 255); color:#414141;"></th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="col-md-10">

        </div>
        <div class="col-md-2" style="padding-left:40px;">
            {{-- <a href="{{ route('admin.formulario') }}">
                <button type="button" class="btn btn-outline-primary"
                    style="width: 136px;color:#2567AE;background-color: white;">Regresar</button>
            </a> --}}
        </div>
    </div>
@endsection
