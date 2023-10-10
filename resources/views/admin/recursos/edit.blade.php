@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.recursos.create') }}
    <h5 class="col-12 titulo_general_funcion"> Editar: Capacitación</h5>
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
