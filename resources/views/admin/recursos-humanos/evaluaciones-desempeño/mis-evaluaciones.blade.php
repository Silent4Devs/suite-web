@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/evaluations/evaluations.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('content')
    {{-- {{ Breadcrumbs::render('capital-humano') }} --}}

    <h5 class="titulo_general_funcion"> Mis evaluaciones </h5>

    <div class="card card-body mt-4">

        <div class="row">
            <div class="col-md-3 form-group">
                <select name="" id="" class="form-control">
                    <option value="" selected disabled>Fecha Años</option>
                </select>
            </div>
            <div class="col-md-4 form-group">
                <input type="search" name="" id="" placeholder="Buscar" class="form-control">
            </div>
        </div>
    </div>

    <div class="card card-body">

        <div class="d-flex flex-wrap" style="gap: 20px; max-width: 1500px; margin: auto;">

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
                                <span class="estatus-card-evaluaciones-config"
                                    style="background-color: #E9FFE8; color: #039C55;">En
                                    curso</span>
                            </p>
                            <p>
                                <small>
                                    <strong>Del 12/12/12 al 12/12/12</strong>
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
