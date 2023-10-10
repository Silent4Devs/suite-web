@extends('layouts.admin')
@section('content')
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

        .select2-selection__rendered[title="1 - Muy Bajo"]::before {
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

        .select2-selection__rendered[title="2 - Bajo"]::before {
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

        .select2-selection__rendered[title="3 - Medio"]::before {
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

        .select2-selection__rendered[title="4 - Alto"]::before {
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

        .select2-selection__rendered[title="5 - Crítico"]::before {
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
            <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong>Proceso</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.procesos-octave.store') }}" enctype="multipart/form-data">
                @csrf

                @include('admin.OCTAVE.menu')


                <div class="text-center form-group col-12"
                    style="background-color:#345183; border-radius: 100px; color: white;">
                    DATOS DEL PROCESO
                </div>
                {{-- <input type="text" value="{{$id_matriz}}"> --}}

                <input type="hidden" name="matriz_id" value="{{ $matriz }}" />
                <div class="col-12 row">
                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                        <label for="fecha_registro"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha de registro<span
                                class="text-danger">*</span></label>
                        <input class="form-control date" type="date" name="fecha_registro" id="fecha_registro"
                            value="{{ old('fecha_registro') }}">
                        @if ($errors->has('fecha_registro'))
                            <span class="text-danger">
                                {{ $errors->first('fecha_registro') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6 col-sm-12">
                        <label><i class="fas fa-handshake iconos-crear"></i>Servicio</label>
                        <div style="float: right;">
                            <button id="btnAgregarTipo" onclick="event.preventDefault();" class="text-white btn btn-sm"
                                style="background:#3eb2ad;height: 32px;" data-toggle="modal"
                                data-target="#tipoCompetenciaModal" data-whatever="@mdo" data-whatever="@mdo"
                                title="Agregar Tipo Impacto"><i class="fas fa-plus"></i></button>
                        </div>
                        @livewire('servicio-component')

                        @livewire('servicio-select-component', ['servicio_seleccionado' => $servicio_seleccionado])
                    </div>
                </div>


                <div class="col-12 row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="id_proceso"><i class="fas fa-project-diagram iconos-crear"></i>Proceso a
                            evaluar</label><br>
                        <select class="procesoSelect mt-2 form-control" name="id_proceso" id="proceso_activo">
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
                    <div class="form-group col-sm-4 col-md-3 col-lg-3">
                        <label for="nivel_riesgo"><i class="fas fa-bullseye iconos-crear"></i>Valor de Riesgo</label>
                        <input class="form-control mt-2 {{ $errors->has('nivel_riesgo') ? 'is-invalid' : '' }}"
                            type="number" id="nivel_riesgo" name="nivel_riesgo" value="{{ old('nivel_riesgo', '') }}"
                            readonly>
                        @if ($errors->has('nivel_riesgo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nivel_riesgo') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-sm-4 col-md-3 col-lg-3">
                        <label for="nivel_riesgo"><i class="fas fa-bullseye iconos-crear"></i>Nivel de Riesgo</label>
                        <div class="mt-2 form-control" id="valorCriticidadTxt"></div>
                    </div>
                </div>


                <div class="col-12 row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="id_direccion"><i class="fas fa-street-view iconos-crear"></i>Dirección</label><br>
                        <select class="sedeSelect form-control" name="id_direccion" id="id_direccion">
                            <option value="" selected disabled>Seleccione una opción</option>
                            @foreach ($areas as $area)
                                <option {{ old('id_direccion') == $area->id ? ' selected="selected"' : '' }}
                                    value="{{ $area->id }}">{{ $area->area }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_direccion'))
                            <div class="invalid-feedback">
                                {{ $errors->first('id_direccion') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                        <label for="nombreVP"><i class="fas fa-street-view iconos-crear"></i>Nombre VP</label>
                        <select class="custom-select my-1 mr-sm-2" id="nombredevp_id" name="nombredevp_id">
                            @foreach ($grupos as $grupo)
                                <option value="{{ $grupo->id }}">
                                    {{ $grupo->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="text-center form-group col-12"
                    style="background-color:#345183; border-radius: 100px; color: white;">
                    EVALUACIÓN DE IMPACTOS
                </div>


                @livewire('octave.select-impactos', ['operacionalId' => 0, 'cumplimientoId' => 0, 'legalId' => 0, 'reputacionalId' => 0, 'tecnologicoId' => 0])


                <div class="text-center form-group col-12"
                    style="background-color:#345183; border-radius: 100px; color: white;">
                    ACTIVOS DEL PROCESO
                </div>

                <div class="col-12 row">
                    <div class="form-group col-md-6 col-sm-12" id="contenedorActivos">

                    </div>

                    <div class="form-group col-sm-4 col-md-3 col-lg-3">
                        <label for="valor"><i class="fas fa-bullseye iconos-crear"></i>Promedio de Activos</label>
                        <input class="form-control mt-2 {{ $errors->has('valor') ? 'is-invalid' : '' }}" type="number"
                            name="valor" id="valor" value="{{ old('valor', '') }}" readonly>
                        @if ($errors->has('valor'))
                            <div class="invalid-feedback">
                                {{ $errors->first('valor') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-sm-4 col-md-3 col-lg-3">
                        <label for="valor"><i class="fas fa-bullseye iconos-crear"></i>Nivel de Activos</label>
                        <div class="form-control mt-2" readonly id="valorActivosText"></div>
                    </div>
                </div>


                <div class="modal fade" id="marcaslec" tabindex="-1" aria-labelledby="marcaslecLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="marcaslec" id="exampleModalLabel">Impacto Operacional</h5>
                            </div>
                            <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                <div class="col-4" style="background-color:rgb(238, 238, 238);">
                                    <strong class="text-center">Criterio</strong>
                                </div>
                                <div class="col-8">
                                    <span style="justify-content;">Afectaciones a la operación
                                        (Capacidad de hacer negocios)</span>
                                </div>
                            </div>
                            <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                <div class="col-4" style="background-color:#ccc;">
                                    <strong class="text-center">Base</strong>
                                </div>
                                <div class="col-8">
                                    <span style="justify-content;">Demandas de clientes, revocación de contratos y
                                        licencias</span>
                                </div>
                            </div>
                            <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                <div class="col-4" style="background-color:#1168af;">
                                    <strong style="color:#fff" class="text-center">0 - Sin Impacto</strong>
                                </div>
                                <div class="col-8">
                                    <span style="justify-content;">No se considera riesgo legal asociado al riesgo
                                        evaluado</span>
                                </div>
                            </div>
                            <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                <div class="col-4" style="background-color: rgb(61, 114, 77);">
                                    <strong style="color:#fff" class="text-center">1 - Muy Bajo</strong>
                                </div>
                                <div class="col-8">
                                    <span style="justify-content;">No existen demandas de clientes y acciones legales en
                                        contra</span>
                                </div>
                            </div>
                            <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                <div class="col-4" style="background-color: rgb(50, 205, 63)">
                                    <strong style="color:#fff" class="text-center">2 - Bajo</strong>
                                </div>
                                <div class="col-8">
                                    <span style="justify-content;">Pérdida de contratos de clientes no relevantes y
                                        acciones legales con poca afectación</span>
                                </div>
                            </div>
                            <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                <div class="col-4" style="background-color: yellow;">
                                    <strong class="text-center">3 - Medio</strong>
                                </div>
                                <div class="col-8">
                                    <span style="justify-content;">Operación con licencias restringidas sin afectar a los
                                        clientes sin llegar a demandas</span>
                                </div>
                            </div>
                            <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                <div class="col-4" style="background-color: rgb(255, 136, 0);">
                                    <strong style="color:#fff" class="text-center">4 - Alto</strong>
                                </div>
                                <div class="col-8">
                                    <span style="justify-content;">Demandas y revocación de contratos de uno o varios
                                        clientes relevantes</span>
                                </div>
                            </div>
                            <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                <div class="col-4" style="background-color: red;">
                                    <strong style="color:#fff" class="text-center">5 - Crítico</strong>
                                </div>
                                <div class="col-8">
                                    <span style="justify-content;">Cierre de negocios relevantes e incremento de
                                        demandas</span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="marcaslec" tabindex="-1" aria-labelledby="marcaslecLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="marcaslec" id="exampleModalLabel">Impacto Operacional</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color:rgb(238, 238, 238);">
                                        <strong class="text-center">Criterio</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Afectaciones a la operación
                                            (Capacidad de hacer negocios)</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color:#ccc;">
                                        <strong class="text-center">Base</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Demandas de clientes, revocación de contratos y
                                            licencias</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color:#1168af;">
                                        <strong style="color:#fff" class="text-center">Sin Impacto</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">No se considera riesgo legal asociado al riesgo
                                            evaluado</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: rgb(61, 114, 77);">
                                        <strong style="color:#fff" class="text-center">1 - Muy Bajo</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">No existen demandas de clientes y acciones legales
                                            en contra</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: rgb(50, 205, 63)">
                                        <strong style="color:#fff" class="text-center">2 - Bajo</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Pérdida de contratos de clientes no relevantes y
                                            acciones legales con poca afectación</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: yellow;">
                                        <strong class="text-center">3 - Medio</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Operación con licencias restringidas sin afectar a
                                            los clientes sin llegar a demandas</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: rgb(255, 136, 0);">
                                        <strong style="color:#fff" class="text-center">4 - Alto</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Demandas y revocación de contratos de uno o varios
                                            clientes relevantes</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: red;">
                                        <strong style="color:#fff" class="text-center">5 - Crítico</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Cierre de negocios relevantes e incremento de
                                            demandas</span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modelolec" tabindex="-1" aria-labelledby="modelolecLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modelolec" id="exampleModalLabel">Impacto Cumplimiento</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color:rgb(238, 238, 238);">
                                        <strong class="text-center">Criterio</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Normatividad Aplicable</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color:#ccc;">
                                        <strong class="text-center">Base</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Multas por reguladores</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color:#1168af;">
                                        <strong style="color:#fff" class="text-center">0 - Sin Impacto</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">No se considera riesgo legal asociado al riesgo
                                            evaluado</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: rgb(61, 114, 77);">
                                        <strong style="color:#fff" class="text-center">1 - Muy Bajo</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Sin requerimientos y observaciones por él
                                            regulados</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: rgb(50, 205, 63)">
                                        <strong style="color:#fff" class="text-center">2 - Bajo</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Requerimientos de Información</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: yellow;">
                                        <strong class="text-center">3 - Medio</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Visitas de Inspección con observaciones</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: rgb(255, 136, 0);">
                                        <strong style="color:#fff" class="text-center">4 - Alto</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Suspensión de operaciones > 1 día</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: red;">
                                        <strong style="color:#fff" class="text-center">5 - Crítico</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Revocación de concesiones y autorización de
                                            operación</span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="legalec" tabindex="-1" aria-labelledby="legalecLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modelolec" id="exampleModalLabel">Impacto Legal</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color:rgb(238, 238, 238);">
                                        <strong class="text-center">Criterio</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Contratos de clientes y operación de licencias
                                            otorgados por entidades legales</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color:#ccc;">
                                        <strong class="text-center">Base</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Demandas de clientes, revocación de contratos y
                                            licencias</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color:#1168af;">
                                        <strong style="color:#fff" class="text-center">0 - Sin Impacto</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;"> No se considera riesgo legal asociado al riesgo
                                            evaluado</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: rgb(61, 114, 77);">
                                        <strong style="color:#fff" class="text-center">1 - Muy Bajo</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">No existen demandas de clientes y acciones legales
                                            en contra</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: rgb(50, 205, 63)">
                                        <strong style="color:#fff" class="text-center">2 - Bajo</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Pérdida de contratos de clientes no relevantes y
                                            acciones legales con poca afectación</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: yellow;">
                                        <strong class="text-center">3 - Medio</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Operación con licencias restringidas sin afectar a
                                            los clientes sin llegar a demandas</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: rgb(255, 136, 0);">
                                        <strong style="color:#fff" class="text-center">4 - Alto</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Demandas y revocación de contratos de uno o varios
                                            clientes relevantes</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: red;">
                                        <strong style="color:#fff" class="text-center">5 - Crítico</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Cierre de negocios relevantes e incremento de
                                            demandasn</span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="reputacionallec" tabindex="-1" aria-labelledby="reputacionallecLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modelolec" id="exampleModalLabel">Impacto Reputacional</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color:rgb(238, 238, 238);">
                                        <strong class="text-center">Criterio</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Confianza del clientes, inversionistas y dueños de
                                            la organización</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color:#ccc;">
                                        <strong class="text-center">Base</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Pérdida de confianza</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color:#1168af;">
                                        <strong style="color:#fff" class="text-center">0 - Sin Impacto</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">No se considera riesgo reputacional asociado al
                                            riesgo evaluado </span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: rgb(61, 114, 77);">
                                        <strong style="color:#fff" class="text-center">1 - Muy Bajo</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Divulgación de empleados o externos sin afectación a
                                            la organización por cualquier medio.</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: rgb(50, 205, 63)">
                                        <strong style="color:#fff" class="text-center">2 - Bajo</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Daños reputacionales en medios tradicionales y redes
                                            sociales con afectación de 1 día.</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: yellow;">
                                        <strong class="text-center">3 - Medio</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Daños reputacionales en medios B y C Tradicionales
                                            con afectación de 2 a 10 días.</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: rgb(255, 136, 0);">
                                        <strong style="color:#fff" class="text-center">4 - Alto</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Daños reputacionales a través de medios AAA
                                            Tradicionales Nacionales con afectación < a 30 días.</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: red;">
                                        <strong style="color:#fff" class="text-center">5 - Crítico</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Daños reputacionales a través de medios AAA
                                            Tradicionales Internacionales dañando la imagen y fuga de clientes.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="tecnologialec" tabindex="-1" aria-labelledby="tecnologialecLabel"
                    aria-hidden="true">
                    <div class="modal-dialog  modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modelolec" id="exampleModalLabel">Impacto Tecnológico</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color:rgb(238, 238, 238);">
                                        <strong class="text-center">Criterio</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Fallas en la operación de los servicios tecnológicos
                                            y seguridad</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color:#ccc;">
                                        <strong class="text-center">Base</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Tiempos de interrupción o degradación del
                                            servicio</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color:#1168af;">
                                        <strong style="color:#fff" class="text-center">0 - Sin Impacto</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;"> No se considera riesgo tecnológico asociado al
                                            riesgo evaluado </span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: rgb(61, 114, 77);">
                                        <strong style="color:#fff" class="text-center">1 - Muy Bajo</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Interrupciones momentáneas derivado de incidentes
                                            tecnológicos sin afectación</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: rgb(50, 205, 63)">
                                        <strong style="color:#fff" class="text-center">2 - Bajo</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Suspensión de servicios de TI de 1 hr a 2 hrs</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: yellow;">
                                        <strong class="text-center">3 - Medio</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Suspensión de servicios de TI >4 hrs</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: rgb(255, 136, 0);">
                                        <strong style="color:#fff" class="text-center">4 - Alto</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Suspensión de servicios de TI > 8 hrs</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: red;">
                                        <strong style="color:#fff" class="text-center">5 - Crítico</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Pérdida de servicios de TI por > 1 día que impiden
                                            continuar con la operación activando procesos manuales.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="form-group col-12 text-right mt-4" style="margin-left:15px;">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection


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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let contacto = document.querySelector('#nombre_contacto_puesto');
            let area_init = contacto.options[contacto.selectedIndex].getAttribute('data-area');

            document.getElementById('area_contacto').innerHTML = area_init;
            contacto.addEventListener('change', function(e) {
                e.preventDefault();
                let area = this.options[this.selectedIndex].getAttribute('data-area');
                document.getElementById('area_contacto').innerHTML = area;
            })
        })
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Livewire.on('cerrarModal', () => {
                console.log('cerrarModal');
                $('#tipoCompetenciaModal').modal('hide');
                document.querySelector('.modal-backdrop').style.display = 'none'
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let proceso = document.querySelector('#proceso_activo');
            // let activo_init = proceso.options[proceso.selectedIndex].getAttribute('data-activo');

            // document.getElementById('area_proceso').innerHTML = area_init;

            proceso.addEventListener('change', function(e) {
                let proceso = e.target.options[e.target.selectedIndex].value;
                document.getElementById('valor').value = null;
                $.ajax({
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    url: "{{ route('admin.procesos.octave.activos') }}",
                    data: {
                        proceso
                    },
                    dataType: "json",
                    success: function(response) {
                        let contenedor = document.getElementById('contenedorActivos');
                        let contenedorTxt = document.getElementById('valorCriticidadTxt');
                        contenedorTxt.innerHTML = null;
                        let contenedorValor = document.getElementById('nivel_riesgo');
                        contenedorValor.innerHTML = null;
                        let cantidadActivos = response.length > 0 ? response.length : 1;
                        let sumatoria = 0;
                        let html = '<ul>';
                        response.forEach(item => {
                            sumatoria += item.riesgo_activo;
                            html += `<li>${item.activo_informacion}</li>`;
                        })
                        sumatoria = Number(sumatoria / cantidadActivos);
                        html += '</ul>'
                        contenedor.innerHTML = html;
                        let resultado = "";
                        document.getElementById('valor').value = Math.round(sumatoria);
                        obtenerTextoValor(sumatoria)
                        let total = sumatoria * Number(document.getElementById('valorImpacto')
                            .value);
                        document.getElementById('nivel_riesgo').value = Math.round(total);
                        if (total <= 5) {
                            resultado = "Muy Bajo"
                            contenedorTxt.style.background = "green"
                            contenedorValor.style.background = "green"
                            contenedorTxt.style.color = "white"
                            contenedorValor.style.color = "white"
                        } else if (total > 5 && total <= 20) {
                            resultado = "Baja"
                            contenedorTxt.style.background = "rgb(50, 205, 63)"
                            contenedorValor.style.background = "rgb(50, 205, 63)"
                            contenedorTxt.style.color = "white"
                            contenedorValor.style.color = "white"
                        } else if (total <= 50) {
                            resultado = "Medio"
                            contenedorTxt.style.background = "yellow"
                            contenedorValor.style.background = "yellow"
                            contenedorTxt.style.color = "black"
                            contenedorValor.style.color = "black"
                        } else if (total <= 80) {
                            resultado = "Alta"
                            contenedorTxt.style.background = "orange"
                            contenedorValor.style.background = "orange"
                            contenedorTxt.style.color = "white"
                            contenedorValor.style.color = "white"
                        } else {
                            resultado = "Crítica"
                            contenedorTxt.style.background = "red"
                            contenedorValor.style.background = "red"
                            contenedorTxt.style.color = "white"
                            contenedorValor.style.color = "white"

                        }
                        document.getElementById('valorCriticidadTxt').innerHTML = resultado;

                    }


                });


            })



        })
    </script>

    <script>
        function obtenerTextoValor(valor) {
            let valorActivosText = document.getElementById('valorActivosText');
            valorActivosText.innerHTML = null;
            let contenedorValorActivo = document.getElementById('valor');
            contenedorValorActivo.innerHTML = null;
            let resultadoOperacion = "";
            if (valor <= 3) {
                resultadoOperacion = "Muy Bajo"
                valorActivosText.style.background = "green"
                contenedorValorActivo.style.background = "green"
                valorActivosText.style.color = "white"
                contenedorValorActivo.style.color = "white"
            }
            if (valor >= 5) {
                resultadoOperacion = "Medio"
                valorActivosText.style.background = "yellow"
                contenedorValorActivo.style.background = "yellow"
                valorActivosText.style.color = "black"
                contenedorValorActivo.style.color = "black"
            }
            if (valor >= 7) {
                resultadoOperacion = "Alta"
                valorActivosText.style.background = "orange"
                contenedorValorActivo.style.background = "orange"
                valorActivosText.style.color = "white"
                contenedorValorActivo.style.color = "white"
            }
            if (valor >= 10) {
                resultadoOperacion = "Crítica"
                valorActivosText.style.background = "red"
                contenedorValorActivo.style.background = "red"
                valorActivosText.style.color = "white"
                contenedorValorActivo.style.color = "white"

            }
            document.getElementById('valorActivosText').innerHTML = resultadoOperacion;
        }
    </script>
@endsection
