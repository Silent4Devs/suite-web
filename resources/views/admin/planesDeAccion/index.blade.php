@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/plan_accion.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('content')
    <h5 class="col-12 titulo_general_funcion">PLAN DE TRABAJO</h5>
    <div class="text-right">
        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalPlanAccion">
            Agregar nuevo
            <i class="material-symbols-outlined">add</i>
        </button>
    </div>
    <div class="mt-3 card">
        @include('partials.flashMessages')
        @livewire('plan-de-accion.plan-accion-index-component')
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalPlanAccion" tabindex="-1" role="dialog" aria-labelledby="modalPlanAccionLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="titulo_general_funcion"
                        style="
                    margin-bottom: 0px !important;
                ">Registrar: Plan de
                        Acción</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Aquí carga el contenido del formulario -->
                    <div class="mt-4 card">
                        <div class="card-body">
                            @can('planes_de_accion_agregar')
                                <form method="POST" action="{{ route('admin.planes-de-accion.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group">
                                                <div class="form-group anima-focus">
                                                    <input type="text"
                                                        class="form-control {{ $errors->has('parent') ? 'is-invalid' : '' }}"
                                                        id="parent" aria-describedby="parent" name="parent" required>
                                                    @if ($errors->has('parent'))
                                                        <span class="invalid-feedback">{{ $errors->first('parent') }}</span>
                                                    @endif
                                                    <label for="parent"> Nombre: <span class="text-danger">*</span></label>
                                                    <span class="text-danger parent_error error-ajax"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm" style="padding-left: inherit !important">
                                            <div class="form-group anima-focus">
                                                <input type="date" min="1945-01-01" class="form-control" id="inicio"
                                                    name="inicio">
                                                <label for="inicio"> Fecha inicio <span class="text-danger">*</span></label>
                                                <small class="p-0 m-0 text-xs error_inicio errores text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group anima-focus">
                                                <input type="date" min="1945-01-01" class="form-control" id="fin"
                                                    name="fin">
                                                <label for="fin"> Fecha fin <span class="text-danger">*</span></label>
                                                <small class="p-0 m-0 text-xs error_fin errores text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div
                                            style="
                        width: -webkit-fill-available;
                        padding-left: 20px;
                        padding-right: 20px;">
                                            <div class="form-group">
                                                <div class="form-group anima-focus">
                                                    <textarea class="form-control" id="objetivo" name="objetivo" required></textarea>
                                                    <label for="objetivo">Objetivo:</label>
                                                    <span class="text-danger norma_error error-ajax"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="text-right form-group col-12" style="margin-left:-5px;">
                                <button class="btn btn-danger" type="submit">
                                    {{ trans('global.save') }}
                                </button>
                            </div>
                            </form>
                        @endcan
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
