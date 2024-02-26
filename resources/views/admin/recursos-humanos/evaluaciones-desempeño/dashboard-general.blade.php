@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/evaluaciones.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('content')
    {{-- {{ Breadcrumbs::render('capital-humano') }} --}}

    <h5 class="titulo_general_funcion"> Evaluación Dashboard [Nombre evaluación ]</h5>

    <p>
        <small>
            No olvides realizar tu autoevaluacion asi como tambien evaluar a las personas que estan a tu cargo
        </small>
    </p>

    <div class="row mt-4">
        <div class="col-md-3">
            <div class="w-100 p-3 text-center text-white rounded-lg" style="background-color: #2C9E7F;">
                Enviar recordatorio de Evaluación
            </div>
        </div>
        <div class="col-md-3">
            <div class="w-100 p-3 text-center text-white rounded-lg" style="background-color: #DF5050;">
                Cerrar Evaluación
            </div>
        </div>
        <div class="col-md-3">
            <div class="w-100 p-3 text-center text-white rounded-lg" style="background-color: #A650DF;">
                Modificar periodo de evaluación
            </div>
        </div>
        <div class="col-md-3">
            <div class="w-100 p-3 text-center text-white rounded-lg" style="background-color: #507BDF;">
                Generar Reporte
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card card-body">
                <table>
                    <thead>
                        <tr>
                            <th>
                                Nombre de Evaluación
                            </th>
                            <th>
                                Estatus
                            </th>
                            <th>
                                Inicio
                            </th>
                            <th>
                                Finaliza
                            </th>
                            <th>
                                Autor
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>Evaluación Trimestral del año 2023</p>
                            </td>
                            <td>
                                En curso
                            </td>
                            <td>
                                10/10/2023
                            </td>
                            <td>
                                10/10/2023
                            </td>
                            <td>
                                <div class="img-person">
                                    <img src="" alt="">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-body">
                <div class="d-flex w-100">
                    <div class="">
                        <span>Evaluaciones contestadas</span>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="">
                        <span>Total</span>
                        <p>
                            54/100
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="font-size: 18px;">
        <div class="col-md-4">
            <div class="text-white d-flex align-items-center justify-content-between p-4 rounded-lg" style="background-color: #984F96;">
                <div>
                    <span>Promedio General</span>
                </div>
                <div>
                    <small>Resultado</small> <strong>75%</strong>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-white d-flex align-items-center justify-content-between p-4 rounded-lg" style="background-color: #984F96;">
                <div>
                    <span>Objetivos</span>
                </div>
                <div>
                    <small>Resultado</small> <strong>75%</strong>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-white d-flex align-items-center justify-content-between p-4 rounded-lg" style="background-color: #984F96;">
                <div>
                    <span>Competencias</span>
                </div>
                <div>
                    <small>Resultado</small> <strong>75%</strong>
                </div>
            </div>
        </div>

    </div>

    <div class="row mt-4" style="font-size: 15px; color: #006DDB;">
        <div class="col-md-3">
            <div class="p-3 rounded-lg" style="background-color: #fff; box-shadow: 0px 1px 4px #0000000F;">
                <div class="d-flex align-items-center justify-content-between color-primary">
                    <div>
                        Trimestre 1
                    </div>
                    <div>
                        <small>Promedio</small> <strong>67%</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 rounded-lg" style="background-color: #fff; box-shadow: 0px 1px 4px #0000000F;">
                <div class="d-flex align-items-center justify-content-between color-primary">
                    <div>
                        Trimestre 2
                    </div>
                    <div>
                        <small>Promedio</small> <strong>67%</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 rounded-lg" style="background-color: #fff; box-shadow: 0px 1px 4px #0000000F;">
                <div class="d-flex align-items-center justify-content-between color-primary" style="opacity: 70%;">
                    <div>
                        Trimestre 3
                    </div>
                    <div>
                        <small>Promedio</small> <strong>67%</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 rounded-lg" style="background-color: #fff; box-shadow: 0px 1px 4px #0000000F;">
                <div class="d-flex align-items-center justify-content-between color-primary" style="opacity: 70%;"  >
                    <div>
                        Trimestre 4
                    </div>
                    <div>
                        <small>Promedio</small> <strong>67%</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-body mt-3">
        <h5>Resultado por área</h5>
        grahp
    </div>

    <div class="card card-body" style="background-color: #BF9CC4;">
        <div class="form-group">
            <select name="" id="area-select" class="form-control" style="background-color: #fff;">
                <option value="" selected disabled>Área</option>
            </select>
        </div>
    </div>

    <div class="row mt-4" style="font-size: 15px; color: #9E50AA;">
        <div class="col-md-4">
            <div class="p-3 rounded-lg" style="background-color: #fff; box-shadow: 0px 1px 4px #0000000F;">
                <div class="d-flex align-items-center justify-content-between color-primary">
                    <div>
                        Promedio General
                    </div>
                    <div>
                        <small>Resultado</small> <strong>67%</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 rounded-lg" style="background-color: #fff; box-shadow: 0px 1px 4px #0000000F;">
                <div class="d-flex align-items-center justify-content-between color-primary">
                    <div>
                        Objetivos
                    </div>
                    <div>
                        <small>Resultado</small> <strong>67%</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 rounded-lg" style="background-color: #fff; box-shadow: 0px 1px 4px #0000000F;">
                <div class="d-flex align-items-center justify-content-between color-primary">
                    <div>
                        Competencias
                    </div>
                    <div>
                        <small>Resultado</small> <strong>67%</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card card-body">
                <h5>Cumplimiento de Objetivos</h5>
                grahp
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-body">
                <h5>Resultado de evaluación por escalas</h5>

                grahp
            </div>
        </div>
    </div>

    <div class="card card-body">
        <h5>Cumplimiento de Competencias</h5>
        graph
    </div>

    <div class="card card-body">
        <div class="d-flex w-100">
            <div class="">
                <span>Evaluaciones contestadas</span>
                <div class="progress">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="">
                <span>Total</span>
                <p>
                    54/100
                </p>
            </div>
        </div>
    </div>

    <div class="card card-body">

        <div class="row">
            <div class="col-md-3 form-group">
                <select name="" id="" class="form-control">
                    <option value="" selected disabled>Área</option>
                </select>
            </div>
            <div class="col-md-3 form-group">
                <select name="" id="" class="form-control">
                    <option disabled selected value="">Colaborador</option>
                </select>
            </div>
            <div class="col-md-3 form-group">
                <select name="" id="" disabled select class="form-control">
                    <option value="">Evaluador</option>
                </select>
            </div>
        </div>
    </div>

    <nav class="mt-5">
        <div class="nav nav-tabs" role="tablist" style="margin-bottom: 0px !important;">
            <a class="nav-link active" id="" data-type="empleados" data-toggle="tab" href="#nav-config-obj-1"
                role="tab" aria-controls="nav-empleados" aria-selected="true">
                Definir Categorías
            </a>
            <a class="nav-link" id="" data-type="calendario-comunicacion" data-toggle="tab"
                href="#nav-config-obj-2" role="tab" aria-controls="nav-config-obj-2" aria-selected="false">
                Definir Escalas
            </a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">

        <div class="tab-pane mb-4 fade show active" id="nav-config-obj-1" role="tabpanel"
            aria-labelledby="nav-config-obj-1">

        </div>

        <div class="tab-pane mb-4 fade" id="nav-config-obj-2" role="tabpanel" aria-labelledby="nav-config-obj-2">

        </div>

        <div class="tab-pane mb-4 fade" id="nav-config-obj-3" role="tabpanel" aria-labelledby="nav-config-obj-3">

        </div>

        <div class="tab-pane mb-4 fade" id="nav-config-obj-4" role="tabpanel" aria-labelledby="nav-config-obj-4">

        </div>
    </div>

@endsection

@section('scripts')
    @parent

@endsection
