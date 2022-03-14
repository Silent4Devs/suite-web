@extends('layouts.admin')
@section('content')

<<<<<<< HEAD
        <div class="card-body">
            <form method="POST" action="{{ route('admin.matriz-riesgos.octave.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <p class="font-weight-bold" style="font-size:11pt;">Llene los siguientes campos según corresponda:</p>
                </div>
                <input type="hidden" value="{{ $id_analisis }}" name="id_analisis">
                <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                    DATOS GENERALES
                </div>
                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="vp"><i class="fas fa-city iconos-crear"></i>VP</label><br>
                        <input class="form-control {{ $errors->has('vp') ? 'is-invalid' : '' }}" type="text" name="vp"
                            id="nombre_herramienta_puesto" value="{{ old('indicador', '') }}">
                        @if ($errors->has('vp'))
                            <div class="invalid-feedback">
                                {{ $errors->first('vp') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="id_area"><i class="fas fa-street-view iconos-crear"></i>Área</label><br>
                        <select class="sedeSelect form-control" name="id_area" id="id_area">
                            <option value="" selected disabled>Seleccione una opción</option>
                            @foreach ($areas as $area)
                                <option {{ old('id_area') == $area->id ? ' selected="selected"' : '' }}
                                    value="{{ $area->id }}">{{ $area->area }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_area'))
                            <div class="invalid-feedback">
                                {{ $errors->first('id_area') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="servicio"><i class="fas fa-handshake iconos-crear"></i>Servicio</label><i
                            class="fas fa-info-circle" style="font-size:12pt; float: right;"
                            title="En este campo por favor agregue el nombre del servicio"></i><br>
                        <input class="form-control {{ $errors->has('servicio') ? 'is-invalid' : '' }}" type="text"
                            name="servicio" id="servicio" value="{{ old('servicio', '') }}">
                        @if ($errors->has('servicio'))
                            <div class="invalid-feedback">
                                {{ $errors->first('servicio') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="id_sede"><i class="fas fa-map-marker-alt iconos-crear"></i>Sede</label><br>
                        <select class="sedeSelect form-control" name="id_sede" id="id_sede">
                            {{-- <option value="" selected disabled>Seleccione una opción</option> --}}
                            @foreach ($sedes as $sede)
                                <option {{ old('id_sede') == $sede->id ? ' selected="selected"' : '' }}
                                    value="{{ $sede->id }}">{{ $sede->sede }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_sede'))
                            <div class="invalid-feedback">
                                {{ $errors->first('id_sede') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="id_proceso"><i class="fas fa-project-diagram iconos-crear"></i>Proceso</label><br>
                        <select class="procesoSelect form-control" name="id_proceso" id="id_proceso">
                            <option value="" selected disabled>Seleccione una opción</option>
                            @foreach ($procesos as $proceso)
                                <option {{ old('id_proceso') == $proceso->id ? ' selected="selected"' : '' }}
                                    value="{{ $proceso->id }}">{{ $proceso->codigo }} / {{ $proceso->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_proceso'))
                            <div class="invalid-feedback">
                                {{ $errors->first('id_proceso') }}
                            </div>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                    EVALUACIÓN DE IMPACTOS ASOCIADOS AL PROCESO
                </div>
                <div>
                    @livewire('octave.select-impactos',["operacionalId"=>1,"cumplimientoId"=>1,"legalId"=>1,"reputacionalId"=>1,"tecnologicoId"=>1])
=======
<style>
    .select2-results__option {
        position: relative;
        padding-left: 30px !important;

    }

    .select2-results__option:nth-child(2)::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: rgb(61, 114, 77);
        margin-left: -20px;
        border-radius: 100px;
        margin-top: 6px;
    }

    .select2-selection__rendered[title="1"]::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: rgb(61, 114, 77);
        margin-left: -18px;
        border-radius: 100px;
        margin-top: 11px;
    }

    .select2-results__option:nth-child(3)::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: rgb(50, 205, 63);
        margin-left: -20px;
        border-radius: 100px;
        margin-top: 6px;
    }

    .select2-selection__rendered[title="2"]::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: rgb(50, 205, 63);
        margin-left: -18px;
        border-radius: 100px;
        margin-top: 11px;
    }

    .select2-results__option:nth-child(4)::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: yellow;
        margin-left: -20px;
        border-radius: 100px;
        margin-top: 6px;
    }

    .select2-selection__rendered[title="3"]::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: yellow;
        margin-left: -18px;
        border-radius: 100px;
        margin-top: 11px;
    }

    .select2-results__option:nth-child(5)::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: rgb(255, 136, 0);
        margin-left: -20px;
        border-radius: 100px;
        margin-top: 6px;
    }

    .select2-selection__rendered[title="4"]::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: rgb(255, 136, 0);
        margin-left: -18px;
        border-radius: 100px;
        margin-top: 11px;
    }

    .select2-results__option:nth-child(6)::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: red;
        margin-left: -20px;
        border-radius: 100px;
        margin-top: 6px;
    }

    .select2-selection__rendered[title="5"]::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: red;
        margin-left: -18px;
        border-radius: 100px;
        margin-top: 11px;
    }

    .select2-selection__rendered {
        padding-left: 30px !important;


    }

    .select2-selection__rendered[title="Bajo"]::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: rgb(50, 205, 63);
        margin-left: -18px;
        border-radius: 100px;
        margin-top: 11px;
    }

    .select2-selection__rendered[title="Medio"]::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: yellow;
        margin-left: -18px;
        border-radius: 100px;
        margin-top: 11px;
    }

    .select2-selection__rendered[title="Alto"]::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: rgb(255, 136, 0);
        margin-left: -18px;
        border-radius: 100px;
        margin-top: 11px;
    }

    .select2-selection__rendered[title="Crítico"]::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: red;
        margin-left: -18px;
        border-radius: 100px;
        margin-top: 11px;
    }

    .select2-selection__rendered[title="Muy Bajo"]::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: rgb(61, 114, 77);
        margin-left: -18px;
        border-radius: 100px;
        margin-top: 11px;
    }

</style>

<div class="mt-5 card">
    <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
        <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Matriz Octave</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12" style="margin-left:-15px;">
                <div class="nav nav-tabs" id="tabsEmpleado" role="tablist">
                    <a class="nav-link" href="{{route('admin.procesos-octave.index')}}">
                    <i class="fas fa-project-diagram mr-2" style="font-size:20px;"></i>Procesos
                    </a>
                    <a class="nav-link"  href="{{route('admin.activosInformacion.index')}}" >
                        <i class="mr-2 fas fa-briefcase" style="font-size:20px;" style="text-decoration:none;"></i>
                       Activos
                    </a>
                    <a class="nav-link"  href="{{route('admin.carta-aceptacion.index')}}"  >
                        <i class="fas fa-camera-retro mr-2" style="font-size:20px;" style="text-decoration:none;"></i>
                       Escenarios
                    </a>
                    <a class="nav-link"  href="{{route('admin.carta-aceptacion.index')}}" >
                        <i class="fas fa-box-open mr-2" style="font-size:20px;" style="text-decoration:none;"></i>
                        Contenedores
                    </a>

                    <a class="nav-link"  href="{{route('admin.carta-aceptacion.index')}}" >
                        <i class="fas fa-network-wired mr-2" style="font-size:20px;" style="text-decoration:none;"></i>
                        Árbol de Riesgos
                    </a>
                    <a class="nav-link "  href="{{route('admin.carta-aceptacion.index')}}" >
                    <i class="fas fa-chart-bar mr-2" style="font-size:20px;" style="text-decoration:none;"></i>Gráfica
                    </a>
>>>>>>> dcd9a764e02a1a55579eb3e4e7917811655b4dc2
                </div>
            </div>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade" id="nav-competencias" role="tabpanel"
                aria-labelledby="nav-competencias-tab">
                <h1>4</h1>
                 </div>
                <div class="tab-pane fade show active" id="nav-general" role="tabpanel"
                    aria-labelledby="nav-general-tab">
                    <h1>1</h1>
                </div>
<<<<<<< HEAD
                <div class="row">
                    {{-- <div class="form-group col-md-8 col-sm-12">
                        <label><i class="fas fa-file-alt iconos-crear"></i>Nombre del AI</label><br>
                        <input class="form-control {{ $errors->has('nombre_ai') ? 'is-invalid' : '' }}" type="text"
                            name="nombre_ai" id="nombre_ai_informacion" value="{{ old('nombre_ai', '') }}">
                        <small class="text-danger errores nombre_ai_error"></small>
                    </div> --}}

                    <div class="form-group col-md-4 col-sm-12">
                        <label for="nombre_ai_informacion"><i class="fas fa-project-diagram iconos-crear"></i>Nombre del
                            AI</label><br>
                        <select class="procesoSelect form-control" name="nombre_ai_informacion" id="nombre_ai_informacion">
                            <option value="" selected disabled>Seleccione una opción</option>
                            @foreach ($nombreAis as $nombreAi)
                                <option {{ old('nombre_ai_informacion') == $nombreAi->id ? ' selected="selected"' : '' }}
                                    value="{{ $nombreAi->id }}" data-dueno="{{ $nombreAi->dueno->name }}"
                                    data-dueno-puesto="{{ $nombreAi->dueno->puesto }}"
                                    data-dueno-area="{{ $nombreAi->dueno->area->area }}"
                                    data-custodio="{{ $nombreAi->custodio->name }}"
                                    data-custodio-puesto="{{ $nombreAi->custodio->puesto }}"
                                    data-custodio-area="{{ $nombreAi->custodio->area->area }}">
                                    {{ $nombreAi->activo_informacion }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('nombre_ai_informacion'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nombre_ai_informacion') }}
                            </div>
                        @endif
=======
                <div class="tab-pane fade" id="nav-personal" role="tabpanel" aria-labelledby="nav-personal-tab">
                    <div class="mt-4">
                        @include('admin.OCTAVE.escenario')
>>>>>>> dcd9a764e02a1a55579eb3e4e7917811655b4dc2
                    </div>

                </div>
                <div class="tab-pane fade" id="nav-financiera" role="tabpanel"
                    aria-labelledby="nav-financiera-tab">
                    @include('admin.OCTAVE.contenedores')


                </div>

                <div class="tab-pane fade" id="nav-documentos" role="tabpanel"
                    aria-labelledby="nav-documentos-tab">
                    <h1>5</h1>
                </div>

            </div>
        </div>
    </div>



</div>


@endsection
<<<<<<< HEAD
@include('admin.OCTAVE.scripts')
=======


@section('scripts')
<script type="text/javascript">
    Livewire.on('planStore', () => {
        $('#planAccionModal').modal('hide');
        $('.modal-backdrop').hide();
        toastr.success('Plan de Acción creado con éxito');
    });
    window.initSelect2 = () => {
        $('.select2').select2({
            'theme': 'bootstrap4'
        });
    }

    initSelect2();

    Livewire.on('select2', () => {
        initSelect2();
    });
</script>
@endsection
>>>>>>> dcd9a764e02a1a55579eb3e4e7917811655b4dc2
