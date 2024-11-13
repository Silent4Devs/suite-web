@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/workPlan/kanban/planTrabajo.css') }}{{ config('app.cssVersion') }}">

    <style>
        .separator {
            border-left: 1px solid black;
            height: 30px;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
        }
    </style>
@endsection
@section('content')
    <h5 class="col-12 titulo_general_funcion">Planes de Trabajo</h5>
    <div class="text-right">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPlanAccion">
            Agregar nuevo
            <i class="material-symbols-outlined">add</i>
        </button>
    </div>
    <div class="mt-3 mb-5">
        <div id="bloqueado"></div>
        <div class="blue-menu-header-plan d-flex align-items-center justify-content-between px-5">
            <h3 id="titlo-tab" class="mb-0" style="font-weight: lighter;">Mis Planes de Trabajo</h3>
            <div class="d-flex align-items-center gap-2">
                <button class="btn"
                    onclick="cambiarTituloIndex('Mis Planes de Trabajo'); navSectionIndex('plan_trabajo');">
                    <i class="material-symbols-outlined"> content_paste</i>
                    <span>Mis Planes de Trabajo</span>
                </button>
                <hr>
                <button class="btn" onclick="cambiarTituloIndex('Mis asignaciones'); navSectionIndex('asignaciones');">
                    <i class="material-symbols-outlined"> receipt_long</i>
                    <span>Mis asignaciones</span>
                </button>
                <hr>
                <button class="btn" onclick="cambiarTituloIndex('Área'); navSectionIndex('area');">
                    <i class="material-symbols-outlined">pageless</i>
                    <span>Área</span>
                </button>
                {{-- <hr>
                <button class="btn" data-toggle="modal" data-target="#modalPlanAccion">
                    <i class="material-symbols-outlined">add</i>
                </button> --}}
            </div>
        </div>
        <div class="card card-body">

            <div id="plan_trabajo_workspace">
                <div class="content-sections">
                    <section id="plan_trabajo" class="caja_tab_reveldada active">
                        @include('partials.flashMessages')
                        @livewire('plan-de-accion.plan-accion-index-component', ['tab' => 1])
                    </section>

                    <section id="asignaciones">
                        @include('partials.flashMessages')
                        @livewire('plan-de-accion.plan-accion-index-component', ['tab' => 2])
                    </section>
                    <section id="area">
                        @include('partials.flashMessages')
                        @livewire('plan-de-accion.plan-accion-index-component', ['tab' => 3])
                    </section>
                </div>
            </div>
        </div>
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
                        Trabajo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Aquí carga el contenido del formulario -->
                    <div class="mt-4">
                        <div class="">
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
                                                    name="inicio" required>
                                                <label for="inicio"> Fecha inicio <span class="text-danger">*</span></label>
                                                <small class="p-0 m-0 text-xs error_inicio errores text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group anima-focus">
                                                <input type="date" min="1945-01-01" class="form-control" id="fin"
                                                    name="fin" required>
                                                <label for="fin"> Fecha fin <span class="text-danger">*</span></label>
                                                <small class="p-0 m-0 text-xs error_fin errores text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div style="width: -webkit-fill-available;padding-left: 20px;padding-right: 20px;">
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
                                <button class="btn btn-xs btn-primary" type="submit">
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
@section('scripts')
    <script type="text/javascript">
        $(".botones_vistas_gantt a").click(function() {
            $(".botones_vistas_gantt a").removeClass("boton_activo");
            $(".botones_vistas_gantt a:hover").addClass("boton_activo");
        });

        function cambiarTituloIndex(titulo) {
            setTimeout(() => {
                document.getElementById('titlo-tab').innerText = titulo;
            }, 100);
        }

        function navSectionIndex(id) {
            document.querySelector('.content-sections section.active').classList.remove('active');
            document.getElementById(id).classList.add('active');
        }
    </script>
@endsection
