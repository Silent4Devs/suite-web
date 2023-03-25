@extends('layouts.admin')
@section('content')
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
            </div>
    </div>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade" id="nav-competencias" role="tabpanel" aria-labelledby="nav-competencias-tab">
            <h1>4</h1>
        </div>
        <div class="tab-pane fade show active" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">
            <h1>1</h1>
        </div>
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
            </div>

            @include('admin.OCTAVE.menu')



        </div>



    </div>
@endsection
@include('admin.OCTAVE.scripts')
