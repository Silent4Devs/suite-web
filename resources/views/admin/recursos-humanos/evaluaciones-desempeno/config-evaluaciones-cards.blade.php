@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/evaluations/evaluations.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('content')
    {{-- {{ Breadcrumbs::render('capital-humano') }} --}}

    <h5 class="titulo_general_funcion"> Configuración de la Evaluación </h5>

    <div class="d-flex align-items-center rounded-lg text-white p-3" style="background-color: #BF9CC4; gap: 20px;">
        <img src="{{ asset('img/purple-config-ev.png') }}" alt="">
        <div>
            <span style="font-size: 16px;">Asigna los Objetivos Estratégicos</span>
            <p class="mt-2">
                En esta sección puedes asignar los objetivos que le correspondan a cada colaborador de la organización. <br>
                Consulte los Objetivos Estratégicos con el líder de cada Colaborador
            </p>
        </div>
    </div>

    <div class="card card-body mt-4">
        <div class="d-flex aling-items-center" style="gap: 20px;">

            <div class="card card-body mb-0" style="background-color: #F8F8F8;">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <select name="" id="" class="form-control">
                            <option value="" selected disabled>Fecha Años</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <input type="search" name="" id="" placeholder="Buscar" class="form-control">
                    </div>
                </div>
            </div>
            <a href="" class="btn btn-light d-flex align-items-center" style="background-color: #E9FBFF;">
                Dashboard
                <i class="fa-solid fa-chart-area ml-3"></i>
            </a>
        </div>
    </div>

    <div class="card card-body">
        <div class="text-right">
            <a href="" class="btn btn-primary" style="background-color: #59BB87 !important;">
                Crear nueva evaluación
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>

        <div class="d-flex flex-wrap mt-5" style="gap: 20px; max-width: 1000px; margin: auto;">

            @for ($i = 0; $i < 10; $i++)
                <div class="card overflow-hidden m-0" style="width: 230px;">
                    <div class="card-header text-center position-relative" style="background-color: #fff;">
                        <span style="color: #0489FE;">28-02-2022</span>
                        <i class="fa-solid fa-ellipsis-vertical btn-menu-card-evaluaciones"></i>
                    </div>
                    <div class="card-body py-1">
                        <div class="contetn-card-evaluaciones-config">
                            <p class="mt-2">
                                <strong>
                                    Evaluación Trimestral 2022
                                </strong>
                            </p>
                            <p>
                                <span class="estatus-card-evaluaciones-config" style="background-color: #039C55;">En
                                    curso</span>
                            </p>
                            <p>
                                <small>
                                    <strong>Público: Desarrollo</strong>
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
            @endfor

        </div>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
