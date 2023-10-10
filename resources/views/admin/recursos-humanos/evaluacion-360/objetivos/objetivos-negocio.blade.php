@extends('layouts.admin')
@section('content')
    <style>
        .breadcrumb {
            margin-bottom: 6px !important;
            padding-left: 5px;
        }

        .titulo_general_funcion {
            margin-bottom: 10px !important;
            padding: 0 !important;
        }

        .table-list {
            display: flex;
            list-style: none;
            justify-content: space-between;
        }

        .table-head {
            background: #5c739b;
            padding: 5px;
            color: white;
        }

        .table-parent {
            flex-wrap: wrap;
        }

    </style>
    <div class="col-12">
        {{ Breadcrumbs::render('EV360-Objetivos') }}
    </div>
    <h5 class="col-12 titulo_general_funcion">Crear Objetivos Estratégicos</h5>
    <div class="card p-2">
        <ul class="table-list table-head">
            <li>Nombre</li>
            <li>Acción</li>
            <li>Descripción</li>
            <li>Desempeño</li>
            <li>Progreso</li>
        </ul>
        <div>
            <ul class="table-list table-parent">
                <li style="width:25%"><i class="fas fa-building mr-2"></i>Objetivos Silent 2021</li>
                <li style="width:25%"></li>
                <li style="width:25%"></li>
                <li style="width:25%"></li>
                <li style="width:25%"></li>
                <ul class="table-list table-parent w-100">
                    <li style="width:25%"><i class="fas fa-bullseye text-danger mr-2"></i>Financiera</li>
                    <li style="width:25%"></li>
                    <li style="width:25%"></li>
                    <li style="width:25%"></li>
                    <li style="width:25%"></li>
                    <ul class="table-list  w-100">
                        <li style="width:25%"><i class="fas fa-bullseye text-danger mr-2"></i>Alcanzar ventas por 2M</li>
                        <li style="width:25%"></li>
                        <li style="width:25%"></li>
                        <li style="width:25%"></li>
                        <li style="width:25%"></li>
                    </ul>
                </ul>
                <ul class="table-list  w-100">
                    <li style="width:25%"><i class="fas fa-bullseye text-danger mr-2"></i>Clientes</li>
                    <li style="width:25%"></li>
                    <li style="width:25%"></li>
                    <li style="width:25%"></li>
                    <li style="width:25%"></li>
                </ul>
                <ul class="table-list  w-100">
                    <li style="width:25%"><i class="fas fa-bullseye text-danger mr-2"></i>Procesos Internos</li>
                    <li style="width:25%"></li>
                    <li style="width:25%"></li>
                    <li style="width:25%"></li>
                    <li style="width:25%"></li>
                </ul>
            </ul>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
