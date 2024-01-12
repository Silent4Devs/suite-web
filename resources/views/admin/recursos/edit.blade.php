@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.recursos.create') }}
    <h5 class="col-12 titulo_general_funcion">Transferencia de conocimiento</h5>
    <div class="card card-body" style="background-color: #5397D5; color: #fff;">
        <div class="d-flex" style="gap: 25px;">
            <img src="{{ asset('assets/Imagen 2@2x.png') }}" alt="jpg" style="width:200px;" class="mt-2 mb-2 ml-2 img-fluid">
            <div>
                <br>
                <br>
                <h4> ¿Qué es Transferencia de conocimiento?  </h4>
                <p>
                    Garantizar que todos en la empresa tengan el conocimiento certificando que este se comparta y perdure.
                </p>
                <p>
                    Esto asegura que todos los miembros del personal comprendan las prácticas y directrices establecidas por la organización.
                </p>
            </div>
        </div>
    </div>
    @include('admin.recursos.styles.style')
    <div class="mt-4 card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <nav>
                        <div class="nav nav-tabs" id="tabsCapacitaciones" role="tablist">
                            <a class="nav-link active" data-type="general" id="nav-general-tab" data-toggle="tab"
                                href="#nav-general" role="tab" aria-controls="nav-general" aria-selected="true">
                                <span class="material-icons" style="text-decoration:none;">
                                    cast_for_education
                                </span>
                                <span>Crear Capacitación</span>
                            </a>
                            <a class="nav-link" data-type="participantes" id="nav-participantes-tab"
                                href="#nav-participantes" style="position:relative">
                                <i class="mr-2 fas fa-users" style="font-size:20px;" style="text-decoration:none;"></i>
                                Agregar Participantes
                                <span class="indicador_numero" id="contador-participantes-tab">0</span>
                            </a>
                            <a class="nav-link" data-type="invitaciones" id="nav-invitaciones-tab"
                                href="#nav-invitaciones" style="position:relative">
                                <span class="material-icons">
                                    forward_to_inbox
                                </span>
                                <span>Enviar Invitación</span>
                            </a>

                        </div>
                    </nav>
                    @include('admin.recursos.components.parciales.loader')
                    <form id="form-informacion-general" method="POST"
                        action="{{ route('admin.recursos.update', $recurso) }}" enctype="multipart/form-data"
                        class="mt-3 row">
                        @csrf
                        <div class="tab-content col-12" id="nav-tabContent" style="position:relative">
                            <div class="tab-pane fade show active" id="nav-general" role="tabpanel"
                                aria-labelledby="nav-general-tab">
                                @include('admin.recursos.components.configuracion-inicial')
                            </div>
                            <div class="tab-pane fade" id="nav-participantes">
                                @include('admin.recursos.components.participantes')
                            </div>
                            <div class="tab-pane fade" id="nav-invitaciones">
                                @include('admin.recursos.components.invitaciones')
                            </div>
                        </div>
                        {{-- <div class="text-right form-group col-12">
                            <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                            @if ($recurso->estatus == 'Borrador' || $recurso->estatus == null)
                                <button class="btn btn-danger" type="submit" id="btnGuardarDraftRecurso">
                                    Borrador
                                </button>
                            @endif
                            <button class="btn btn-danger" type="submit" id="btnGuardarRecurso">
                                Enviar
                            </button>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('admin.recursos.js.app')
@endsection
