@extends('layouts.admin')
@section('content')
    <style>
        .text-orange {
            color: orange !important;
        }

        .mayus {
            text-transform: uppercase;
        }

        .text-yellow {
            color: #f4c272 !important;
        }

    </style>

    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body azul_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Editar: </strong> Riesgo </h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.matriz-riesgos.sistema-gestion.update', [$matrizRiesgo->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                    DATOS GENERALES
                </div>

                <div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                    <div class="row w-100">
                        <div class="text-center col-1 align-items-center d-flex justify-content-center">
                            <div class="w-100">
                                <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                            </div>
                        </div>
                        <div class="col-11">
                            <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones
                            </p>
                            <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Llene los siguientes campos según corresponda:</p>
                        </div>
                    </div>
                </div><br>

                <input type="hidden" value="{{ $matrizRiesgo->id_analisis }}" name="id_analisis">

                <div class="row">
                    <div class="form-group col-md-4 mb-4">
                        <label for="validationServer01"><i class="fas fa-barcode iconos-crear"></i>ID</label>
                        <input type="number" class="form-control" name="identificador" id="identificador"  value="{{ $matrizRiesgo->identificador }}" required>
                        <div id="identificadorDisponible">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="id_sede"><i class="fas fa-map-marker-alt iconos-crear"></i>Sede</label><br>
                        <select class="sedeSelect form-control" name="id_sede" id="id_sede"
                            value="{{ $matrizRiesgo->id_sede }}">
                            <option value="">Seleccione una sede</option>
                            @foreach ($sedes as $sede)
                                <option value="{{ $sede->id }}"
                                    {{ $matrizRiesgo->id_sede == $sede->id ? 'selected' : '' }}>
                                    {{ $sede->sede }}</option>
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
                            <option value="">Seleccione una opción</option>
                            @foreach ($procesos as $proceso)
                                <option value="{{ $proceso->id }}"
                                    {{ $matrizRiesgo->id_proceso == $proceso->id ? 'selected' : '' }}>
                                    {{ $proceso->codigo }} / {{ $proceso->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_proceso'))
                            <div class="invalid-feedback">
                                {{ $errors->first('id_proceso') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-4 col-sm-12">
                        <label for="activo_id"><i class="fas fa-user-tie iconos-crear"></i>Activo (subcategoría)</label><br>
                        <select class="responsableSelect form-control" name="activo_id" id="activo_id">
                            <option value="">Seleccione una opción</option>
                            @foreach ($activos as $activo)
                                <option value="{{ $activo->id }}"
                                    {{ $matrizRiesgo->activo_id == $activo->id ? 'selected' : '' }}>
                                    {{ $activo->subcategoria }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('activo_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('activo_id') }}
                            </div>
                        @endif
                    </div>



                    <div class="form-group col-md-4">
                        <label for="id_responsable"><i class="fas fa-user-tie iconos-crear"></i>Responsable</label>
                        <select class="form-control {{ $errors->has('id_responsable') ? 'is-invalid' : '' }}"
                            name="id_responsable" id="id_responsable">
                            <option value="">Seleccione una opción</option>
                            @foreach ($responsables as $responsable)
                                <option data-puesto="{{ $responsable->puesto }}" value="{{ $responsable->id }}"
                                    data-area="{{ $responsable->area->area }}"
                                    {{ old('id_responsable', $matrizRiesgo->id_responsable) == $responsable->id ? 'selected' : '' }}>
                                    {{ $responsable->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_responsable'))
                            <div class="invalid-feedback">
                                {{ $errors->first('id_responsable') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-4">
                        <label for="id_puesto"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                        <div class="form-control" id="id_puesto" readonly></div>

                    </div>
                    <div class="form-group col-md-4">
                        <label for="id_area"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                        <div class="form-control" id="id_area" readonly></div>

                    </div>

                </div>


                <div class="row">
                    <div class="form-group col-md-4 col-sm-4">
                        <label for="id_amenaza"><i class="fas fa-fire iconos-crear"></i>Amenaza</label>
                        <select class="procesoSelect form-control" name="id_amenaza" id="id_amenaza">
                            <option value="">Seleccione una opción</option>
                            @foreach ($amenazas as $amenaza)
                                <option value="{{ $amenaza->id }}"
                                    {{ $matrizRiesgo->id_amenaza == $amenaza->id ? 'selected' : '' }}>
                                    {{ $amenaza->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('amenaza'))
                            <div class="invalid-feedback">
                                {{ $errors->first('amenaza') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.proceso_helper') }}</span>
                    </div>

                    <div class="form-group col-md-4 col-sm-4">
                        <label for="id_vulnerabilidad"><i class="fas fa-shield-alt iconos-crear"></i>Vulnerabilidad</label>
                        <select class="procesoSelect form-control" name="id_vulnerabilidad" id="id_vulnerabilidad">
                            <option value="">Seleccione una opción</option>
                            @foreach ($vulnerabilidades as $vulnerabilidad)
                                <option value="{{ $vulnerabilidad->id }}"
                                    {{ $matrizRiesgo->id_vulnerabilidad == $vulnerabilidad->id ? 'selected' : '' }}>
                                    {{ $vulnerabilidad->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_vulnerabilidad'))
                            <div class="invalid-feedback">
                                {{ $errors->first('id_vulnerabilidad') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.proceso_helper') }}</span>
                    </div>

                    <div class="form-group col-md-4 col-sm-4">
                        <label for="tipo_riesgo"><i class="fas fa-asterisk iconos-crear"></i>Tipo de riesgo</label>
                        <select class="form-control {{ $errors->has('tipo_riesgo') ? 'is-invalid' : '' }}"
                            name="tipo_riesgo" id="tipo_riesgo">
                            <option value disabled {{ old('tipo_riesgo', null) === null ? 'selected' : '' }}>
                                Selecciona una opción</option>
                            @foreach (App\Models\MatrizRiesgo::TIPO_RIESGO_SELECT as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('tipo_riesgo', $matrizRiesgo->tipo_riesgo) === (string) $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('tipo_riesgo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('tipo_riesgo') }}
                            </div>
                        @endif
                        <span
                            class="help-block">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad_helper') }}</span>
                    </div>

                </div>

                <div class="form-group">
                    <label for="descripcionriesgo"><i class="far fa-file-alt iconos-crear"></i>Descripción Riesgo</label>
                    <textarea class="form-control {{ $errors->has('descripcionriesgo') ? 'is-invalid' : '' }}" type="text"
                        name="descripcionriesgo" id="descripcionriesgo"
                        rows="3">{{ old('descripcionriesgo', $matrizRiesgo->descripcionriesgo) }}</textarea>
                    @if ($errors->has('descripcionriesgo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcionriesgo') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.matrizRiesgo.fields.responsableproceso_helper') }}</span>
                </div>

                <hr>
                <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                    EVALUACIÓN DE RIESGO INICIAL
                </div>
                <p class="font-weight-bold" style="font-size:11pt;">Evalue el riesgo inicial de acuerdo a los apartados
                    afectados</p>
                <hr>
                <div class="sumaFactores">
                    <div class="text-center form-group" style="background-color: #e3e6eb;
                                                    border-radius: 100px;
                                                    color: #681818;">
                        ISO 9001:2015
                    </div>
                    <hr>
                    {{-- 9001:2015 --}}
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="estrategia_negocio"><i class="fa-solid fa-chess iconos-crear"></i>Estrategia de
                                Negocio</label>
                            <select class="form-control {{ $errors->has('estrategia_negocio') ? 'is-invalid' : '' }}"
                                name="estrategia_negocio" id="estrategia_negocio">
                                <option value disabled {{ old('estrategia_negocio', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('estrategia_negocio', $matrizRiesgo->estrategia_negocio) === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('estrategia_negocio'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('probabilidad_residual') }}
                                </div>
                            @endif
                            <span
                                class="help-block">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad_helper') }}</span>
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="calidad_servicio"><i class="fa-solid fa-chart-line iconos-crear"></i>Calidad de
                                servicio</label>
                            <select class="form-control {{ $errors->has('calidad_servicio') ? 'is-invalid' : '' }}"
                                name="calidad_servicio" id="calidad_servicio">
                                <option value disabled {{ old('calidad_servicio', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('calidad_servicio', $matrizRiesgo->calidad_servicio) === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('calidad_servicio'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('impacto_residual') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="cliente"><i class="fa-solid fa-circle-dollar-to-slot iconos-crear"></i>Cliente</label>
                            <select class="form-control {{ $errors->has('cliente') ? 'is-invalid' : '' }}" name="cliente"
                                id="cliente">
                                <option value disabled {{ old('cliente', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('cliente', $matrizRiesgo->cliente) === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('cliente'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('impacto_residual') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                        </div>
                    </div>
                    {{-- 20000-1:2018 --}}
                    <hr>
                    <div class="text-center form-group" style="background-color: #e3e6eb;
                                                    border-radius: 100px;
                                                    color: #681818;">
                        ISO 20000-1:2018
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="disponibilidad_2000"><i class="fa-solid fa-check iconos-crear"></i>Disponibilidad</label>
                            <select class="form-control {{ $errors->has('disponibilidad_2000') ? 'is-invalid' : '' }}"
                                name="disponibilidad_2000" id="disponibilidad_2000">
                                <option value disabled {{ old('disponibilidad_2000', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('disponibilidad_2000', $matrizRiesgo->disponibilidad_2000) === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('probabilidad_residual'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('probabilidad_residual') }}
                                </div>
                            @endif
                            <span
                                class="help-block">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad_helper') }}</span>
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="niveles_servicio"><i class="fas fa-tasks iconos-crear"></i>Niveles de
                                Servicio</label>
                            <select class="form-control {{ $errors->has('niveles_servicio') ? 'is-invalid' : '' }}"
                                name="niveles_servicio" id="niveles_servicio">
                                <option value disabled {{ old('niveles_servicio', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('niveles_servicio', $matrizRiesgo->niveles_servicio) === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('impacto_residual'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('impacto_residual') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="continuidad_BCP"><i class="fas fa-retweet iconos-crear"></i>Continuidad
                                BCP</label>
                            <select class="form-control {{ $errors->has('continuidad_BCP') ? 'is-invalid' : '' }}"
                                name="continuidad_BCP" id="continuidad_BCP">
                                <option value disabled {{ old('continuidad_BCP', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('continuidad_BCP', $matrizRiesgo->continuidad_BCP) === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('continuidad_BCP'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('continuidad_BCP') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                        </div>
                    </div>
                    {{-- 27001:2013 --}}
                    <hr>
                    @if ($matrizRiesgo->version_historico === true)
                    <div class="text-center form-group"
                        style="background-color: #e3e6eb;
                                border-radius: 100px;
                                color: #681818;">
                        ISO 27001:2013
                    </div>
                    @else
                    <div class="text-center form-group"
                        style="background-color: #e3e6eb;
                                border-radius: 100px;
                                color: #681818;">
                        ISO 27001:2022
                    </div>
                    @endif


                    <hr>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="confidencialidad_270000"><i
                                class="fas fa-lock iconos-crear"></i>Confidencialidad</label>
                            <select
                                class="form-control {{ $errors->has('confidencialidad_270000') ? 'is-invalid' : '' }}"
                                name="confidencialidad_270000" id="confidencialidad_270000">
                                <option value disabled
                                    {{ old('confidencialidad_270000', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('confidencialidad_270000',  $matrizRiesgo->confidencialidad_270000) === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('confidencialidad_270000'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('confidencialidad_270000') }}
                                </div>
                            @endif
                            <span
                                class="help-block">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad_helper') }}</span>
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="integridad_27000"><i class="fab fa-black-tie iconos-crear"></i>Integridad</label>
                            <select class="form-control {{ $errors->has('integridad_27000') ? 'is-invalid' : '' }}"
                                name="integridad_27000" id="integridad_27000">
                                <option value disabled {{ old('integridad_27000', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('integridad_27000',  $matrizRiesgo->integridad_27000) === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('integridad_27000'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('integridad_27000') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="disponibilidad_27000"><i
                                class="fas fa-lock-open iconos-crear"></i>Disponibilidad</label>
                            <select class="form-control {{ $errors->has('disponibilidad_27000') ? 'is-invalid' : '' }}"
                                name="disponibilidad_27000" id="disponibilidad_27000">
                                <option value disabled
                                {{ old('disponibilidad_27000', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('disponibilidad_27000', $matrizRiesgo->disponibilidad_27000) === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('continuidad_BCP'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('continuidad_BCP') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                        </div>
                    </div>
                    <hr>
                    {{-- Resultado suma Factores --}}
                    <div class="row">
                        <div class="form-group col-sm-12 col-12" style="text-align:center;">
                            <label for="resultado_ponderacion"><i
                                    class="fas fa-exclamation-circle iconos-crear"></i>Resultado de la ponderación por
                                Factores:
                            </label>
                            <div class="mb-3 input-group" style="pointer-events: none;">
                                <input class="form-control {{ $errors->has('nivelriesgo') ? 'is-invalid' : '' }}"
                                    type="number" name="resultado_ponderacion" id="resultado_ponderacion"
                                    value="{{ old('resultado_ponderacion', $matrizRiesgo->resultado_ponderacion) }}" style="text-align: center">
                                @if ($errors->has('resultado_ponderacion'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('resultado_ponderacion') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <hr>

                    {{-- Probabilidad vs Impacto --}}

                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="probabilidad"><i class="fas fa-wave-square iconos-crear"></i>Probabilidad</label>
                            <select class="form-control {{ $errors->has('probabilidad') ? 'is-invalid' : '' }}"
                                name="probabilidad" id="probabilidad">
                                <option value disabled {{ old('probabilidad', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::PROBABILIDAD_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('probabilidad', $matrizRiesgo->probabilidad) === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('probabilidad'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('probabilidad') }}
                                </div>
                            @endif
                            <span
                                class="help-block">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad_helper') }}</span>
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="impacto"><i class="fas fa-compact-disc iconos-crear"></i>Impacto</label>
                            <select class="form-control {{ $errors->has('impacto') ? 'is-invalid' : '' }}"
                                name="impacto" id="impacto">
                                <option value disabled {{ old('impacto', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::IMPACTO_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('impacto', $matrizRiesgo->impacto) === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('impacto'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('impacto') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="nivelriesgo"><i class="fas fa-exclamation-circle iconos-crear"></i>Nivel Riesgo:
                            </label>
                            <div class="mb-3 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-dark mayus" id="nivelriesgo_pre"></span>
                                </div>
                                <input class="form-control {{ $errors->has('nivelriesgo') ? 'is-invalid' : '' }}"
                                    type="number" name="nivelriesgo" id="nivelriesgo"
                                    value="{{ old('nivelriesgo', $matrizRiesgo->nivelriesgo) }}">
                                @if ($errors->has('nivelriesgo'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nivelriesgo') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group col-sm-12 col-12" style="text-align:center;">
                            <label for="riesgo_total"><i class="fas fa-exclamation-circle iconos-crear"></i>Riesgo Total
                            </label>
                            <div class="mb-3 input-group" style="pointer-events: none;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-dark mayus" id="nivelriesgo_pre"></span>
                                </div>
                                <input class="form-control {{ $errors->has('nivelriesgo') ? 'is-invalid' : '' }}"
                                    type="number" name="riesgo_total" id="riesgo_total"
                                    value="{{ old('riesgo_total', $matrizRiesgo->riesgo_total) }}" style="text-align: center">
                                @if ($errors->has('riesgo_total'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('riesgo_total') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                    EVALUACIÓN DEL RIESGO RESIDUAL
                </div>

                <p class="font-weight-bold" style="font-size:11pt;">Riesgo Residual</p>
                <div class="sumaFactoresResiduales">
                    <div class="text-center form-group" style="background-color: #e3e6eb;
                                        border-radius: 100px;
                                        color: #681818;">
                        ISO 9001:2015
                    </div>
                    <hr>
                    {{-- 9001:2015 --}}
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="estrategia_negocioRes"><i class="fa-solid fa-chess iconos-crear"></i>Estrategia de
                                Negocio</label>
                            <select
                                class="form-control {{ $errors->has('estrategia_negocioRes') ? 'is-invalid' : '' }}"
                                name="estrategia_negocioRes" id="estrategia_negocioRes">
                                <option value disabled
                                    {{ old('estrategia_negocioRes', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('estrategia_negocioRes', $matrizRiesgo->estrategia_negocioRes) === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('estrategia_negocioRes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('probabilidad_residual') }}
                                </div>
                            @endif
                            <span
                                class="help-block">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad_helper') }}</span>
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="calidad_servicioRes"><i class="fa-solid fa-chart-line iconos-crear"></i>Calidad de
                                servicio</label>
                            <select class="form-control {{ $errors->has('calidad_servicioRes') ? 'is-invalid' : '' }}"
                                name="calidad_servicioRes" id="calidad_servicioRes">
                                <option value disabled
                                    {{ old('calidad_servicioRes', $matrizRiesgo->calidad_servicioRes) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('calidad_servicioRes', '') === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('calidad_servicioRes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('impacto_residual') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="clienteRes"><i class="fa-solid fa-circle-dollar-to-slot iconos-crear"></i>Cliente</label>
                            <select class="form-control {{ $errors->has('clienteRes') ? 'is-invalid' : '' }}"
                                name="clienteRes" id="clienteRes">
                                <option value disabled {{ old('clienteRes', $matrizRiesgo->clienteRes) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('clienteRes', '') === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('clienteRes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('impacto_residual') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                        </div>
                    </div>
                    {{-- 20000-1:2018 --}}
                    <hr>
                    <div class="text-center form-group" style="background-color: #e3e6eb;
                                        border-radius: 100px;
                                        color: #681818;">
                        ISO 20000-1:2018
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="disponibilidad_2000Res"><i class="fa-solid fa-check iconos-crear"></i>Disponibilidad</label>
                            <select
                                class="form-control {{ $errors->has('disponibilidad_2000Res') ? 'is-invalid' : '' }}"
                                name="disponibilidad_2000Res" id="disponibilidad_2000Res">
                                <option value disabled
                                    {{ old('disponibilidad_2000Res', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('disponibilidad_2000Res', $matrizRiesgo->disponibilidad_2000Res) === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('probabilidad_residual'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('probabilidad_residual') }}
                                </div>
                            @endif
                            <span
                                class="help-block">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad_helper') }}</span>
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="niveles_servicioRes"><i class="fas fa-tasks iconos-crear"></i>Niveles de
                                Servicio</label>
                            <select class="form-control {{ $errors->has('niveles_servicioRes') ? 'is-invalid' : '' }}"
                                name="niveles_servicioRes" id="niveles_servicioRes">
                                <option value disabled
                                    {{ old('niveles_servicioRes', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('niveles_servicioRes', $matrizRiesgo->niveles_servicioRes) === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('niveles_servicioRes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('niveles_servicioRes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="continuidad_BCPRes"><i class="fas fa-retweet iconos-crear"></i>Continuidad
                                BCP</label>
                            <select class="form-control {{ $errors->has('continuidad_BCPRes') ? 'is-invalid' : '' }}"
                                name="continuidad_BCPRes" id="continuidad_BCPRes">
                                <option value disabled {{ old('continuidad_BCPRes', $matrizRiesgo->continuidad_BCPRes) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('continuidad_BCPRes', '') === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('continuidad_BCPRes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('continuidad_BCPRes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                        </div>
                    </div>
                    {{-- 27001:2013 --}}
                    <hr>
                    @if ($matrizRiesgo->version_historico === true)
                    <div class="text-center form-group"
                        style="background-color: #e3e6eb;
                                border-radius: 100px;
                                color: #681818;">
                        ISO 27001:2013
                    </div>
                    @else
                    <div class="text-center form-group"
                        style="background-color: #e3e6eb;
                                border-radius: 100px;
                                color: #681818;">
                        ISO 27001:2022
                    </div>
                    @endif
                    <hr>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="confidencialidad_270000Res"><i
                                class="fas fa-lock iconos-crear"></i>Confidencialidad</label>
                            <select
                                class="form-control {{ $errors->has('confidencialidad_270000Res') ? 'is-invalid' : '' }}"
                                name="confidencialidad_270000Res" id="confidencialidad_270000Res">
                                <option value disabled
                                    {{ old('confidencialidad_270000Res', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('confidencialidad_270000Res', $matrizRiesgo->confidencialidad_270000Res) === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('confidencialidad_270000Res'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('confidencialidad_270000Res') }}
                                </div>
                            @endif
                            <span
                                class="help-block">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad_helper') }}</span>
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="integridad_27000Res"><i class="fab fa-black-tie iconos-crear"></i>Integridad</label>
                            <select class="form-control {{ $errors->has('integridad_27000Res') ? 'is-invalid' : '' }}"
                                name="integridad_27000Res" id="integridad_27000Res">
                                <option value disabled
                                    {{ old('integridad_27000Res', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('integridad_27000Res',  $matrizRiesgo->integridad_27000Res) === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('integridad_27000Res'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('integridad_27000Res') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="disponibilidad_27000Res"><i
                                class="fas fa-lock-open iconos-crear"></i>Disponibilidad</label>
                            <select
                                class="form-control {{ $errors->has('disponibilidad_27000Res') ? 'is-invalid' : '' }}"
                                name="disponibilidad_27000Res" id="disponibilidad_27000Res">
                                <option value disabled
                                    {{ old('disponibilidad_27000Res',  null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('disponibilidad_27000Res',  $matrizRiesgo->disponibilidad_27000Res) === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('disponibilidad_27000Res'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('disponibilidad_27000Res') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                        </div>
                    </div>
                    <hr>
                    {{-- Resultado suma Factores --}}
                    <div class="row">
                        <div class="form-group col-sm-12 col-12" style="text-align:center;">
                            <label for="resultado_ponderacionRes"><i
                                    class="fas fa-exclamation-circle iconos-crear"></i>Resultado de la ponderación por
                                Factores:
                            </label>
                            <div class="mb-3 input-group" style="pointer-events: none;">
                                <input class="form-control {{ $errors->has('nivelriesgo') ? 'is-invalid' : '' }}"
                                    type="number" name="resultado_ponderacionRes" id="resultado_ponderacionRes"
                                    value="{{ old('resultado_ponderacionRes', $matrizRiesgo->resultado_ponderacionRes) }}" style="text-align: center">
                                @if ($errors->has('resultado_ponderacionRes'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('resultado_ponderacionRes') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <hr>
                    <p class="font-weight-bold" style="font-size:11pt;">Riesgo Residual</p>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="probabilidad_residual"><i
                                    class="fas fa-wave-square iconos-crear"></i>Probabilidad</label>
                            <select
                                class="form-control {{ $errors->has('probabilidad_residual') ? 'is-invalid' : '' }}"
                                name="probabilidad_residual" id="probabilidad_residual">
                                <option value disabled
                                    {{ old('probabilidad_residual', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::PROBABILIDAD_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('probabilidad_residual', $matrizRiesgo->probabilidad_residual) === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('probabilidad_residual'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('probabilidad_residual') }}
                                </div>
                            @endif
                            <span
                                class="help-block">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad_helper') }}</span>
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="impacto_residual"><i class="fas fa-compact-disc iconos-crear"></i>Impacto</label>
                            <select class="form-control {{ $errors->has('impacto_residual') ? 'is-invalid' : '' }}"
                                name="impacto_residual" id="impacto_residual">
                                <option value disabled {{ old('impacto_residual', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::IMPACTO_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('impacto_residual', $matrizRiesgo->impacto_residual) === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('impacto_residual'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('impacto_residual') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="nivelriesgo"><i class="fas fa-exclamation-circle iconos-crear"></i>Nivel Riesgo:
                            </label>
                            <div class="mb-3 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-dark mayus" id="nivelriesgo_residual_pre"></span>
                                </div>
                                <input
                                    class="form-control {{ $errors->has('nivelriesgo_residual') ? 'is-invalid' : '' }}"
                                    type="number" name="nivelriesgo_residual" id="nivelriesgo_residual"
                                    value="{{ old('nivelriesgo_residual', $matrizRiesgo->nivelriesgo_residual) }}">
                                @if ($errors->has('nivelriesgo_residual'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nivelriesgo_residual') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                    <hr>

                    <div class="row">
                        <div class="form-group col-sm-12 col-12" style="text-align:center;">
                            <label for="riesgo_residual"><i class="fas fa-exclamation-circle iconos-crear"></i>Riesgo
                                Total Residual
                            </label>
                            <div class="mb-3 input-group" style="pointer-events: none;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-dark mayus" id="nivelriesgo_residual_pre"></span>
                                </div>
                                <input class="form-control {{ $errors->has('nivelriesgo') ? 'is-invalid' : '' }}"
                                    type="number" name="riesgo_residual" id="riesgo_residual"
                                    value="{{ old('riesgo_residual', $matrizRiesgo->riesgo_residual) }}" style="text-align: center">
                                @if ($errors->has('riesgo_residual'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('riesgo_residual') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                {{-- Accciones --}}
                <p class="font-weight-bold" style="font-size:11pt;">Acciones</p>
                <div class="row">
                    @if ($matrizRiesgo->version_historico === true)
                        <p class="font-weight-bold" style="font-size:8pt;">Versión de Controles ISO 27001:2013</p>
                    @else
                        <p class="font-weight-bold" style="font-size:8pt;">Versión de Controles ISO 27001:2022</p>
                    @endif
                    <div class="form-group col-sm-12">
                        <div class="row">
                            <label for="controles_id" style="margin-left: 15px; margin-bottom:5px; margin-right: 0px;"><i
                                    class="fas fa-lock iconos-crear"></i>Seleccione los control(es)
                                a
                                aplicar</label>
                            <div class="mb-4 col-12">
                                <select
                                    class="form-control js-example-basic-multiple select2  {{ $errors->has('controles_id') ? 'is-invalid' : '' }}"
                                    name="controles_id[]" id="select2-multiple-input-sm" multiple="multiple">
                                    <option value disabled>
                                        Selecciona una opción</option>
                                        @if ($matrizRiesgo->version_historico === true)
                                        @foreach ($controles as $control)
                                            <option value="{{ $control->id }}"
                                                {{ in_array(old('controles_id[]',$control->id),$matrizRiesgo->matriz_riesgos_controles_pivots->pluck('id')->toArray()) == $control->id ? 'selected' : '' }}>
                                                {{ $control->anexo_indice }} {{ $control->anexo_politica }}
                                            </option>
                                        @endforeach
                                        @else
                                        @foreach ($controles as $control)
                                            <option value="{{ $control->id }}"
                                                {{ in_array(old('controles_id[]',$control->id),$matrizRiesgo->matriz_riesgos_controles_pivots->pluck('id')->toArray()) == $control->id ? 'selected' : '' }}>
                                                {{ $control->control_iso }} {{ $control->anexo_politica }}
                                            </option>
                                        @endforeach
                                        @endif
                                </select>
                                @if ($errors->has('controles_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('controles_id') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label for="tipo_tratamiento"><i class="fas fa-lightbulb iconos-crear"></i>Seleccione el
                            tratamiento
                            que desea darle a este riesgo</label>
                        <select class="form-control" name="tipo_tratamiento" id="ejemplo">
                            <option selected value="">Seleccione una opción</option>&gt;
                            <option value="1"   {{ old('tipo_tratamiento',$matrizRiesgo->tipo_tratamiento) == 1 ? 'selected' : '' }}>Aceptar</option>
                            <option value="0"   {{ old('tipo_tratamiento',$matrizRiesgo->tipo_tratamiento) == 0 ? 'selected' : '' }}>Mitigar</option>
                            <option value="2"   {{ old('tipo_tratamiento',$matrizRiesgo->tipo_tratamiento) == 2 ? 'selected' : '' }}>Transferir</option>
                            <option value="3"   {{ old('tipo_tratamiento',$matrizRiesgo->tipo_tratamiento) == 3 ? 'selected' : '' }}>Eliminar</option>&gt;
                            <option value="4"   {{ old('tipo_tratamiento',$matrizRiesgo->tipo_tratamiento) == 4 ? 'selected' : '' }}>Evitar</option>&gt;
                        </select>
                        <!-- Note, I changed hidden to text so you can see it<br/> -->
                    </div>

                    <div class="form-group col-sm-12">
                        <!-- <label for="" style="margin-left: 15px; margin-bottom:5px;"> <i class="fas fa-lightbulb iconos-crea"></i> Justificación</label> -->
                        <textarea class="form-control" type="text" for="aceptar_transferir" name="aceptar_transferir" id="ver1" value="1"
                            placeholder="Justificación" rows="3" style="display: none;">{{ old('aceptar_transferir', $matrizRiesgo->aceptar_transferir) }}</textarea>
                    </div>
                    <div class="form-group col-sm-12" id="modulo_planaccion" style="display: none;">

                        {{-- MODULO AGREGAR PLAN DE ACCIÓN --}}
                        {{-- <div class="row w-100">
                            <label for="plan_accion" style="margin-left: 15px; margin-bottom:5px;"> <i
                                    class="fas fa-question-circle iconos-crear"></i> ¿Vincular con plan de acción?</label>
                            @livewire('planes-implementacion-select',['planes_seleccionados'=>[]])
                            <div class="pl-0 ml-0 col-2">
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                                    data-target="#planAccionModal">
                                    <i class="mr-1 fas fa-plus-circle"></i> Crear
                                </button>
                            </div>
                            @livewire('plan-implementacion-create', ['referencia' => null,'modulo_origen'=>'Matríz de
                            riesgos', 'id_matriz' => $matrizRiesgo->id_analisis])
                        </div> --}}
                        {{-- FIN MODULO AGREGAR PLAN DE ACCIÓN --}}
                    </div>

                </div>
                <hr>
                {{-- Enviar - Cancelar --}}
                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.matriz-seguridad.sistema-gestion', ['id' => $matrizRiesgo->id_analisis]) }}"
                        class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
        </form>
    </div>
@endsection


@include('admin.matrizSistemaGestion.scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('identificador').addEventListener('keyup', (e) => {
            let identificador = e.target.value;
            let url = "{{ route('admin.matriz-seguridad.sistema-gestion.identificadorExist') }}";
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    identificador
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "JSON",
                beforeSend: function() {
                    document.getElementById('identificadorDisponible').innerHTML =
                        "Buscando.."
                    e.target.classList.remove('is-valid');
                    document.getElementById('identificadorDisponible').classList.remove(
                        "valid-feedback")
                    e.target.classList.remove('is-invalid');
                    document.getElementById('identificadorDisponible').classList.remove(
                        "invalid-feedback")
                },
                success: function(response) {
                    if (response.existe) {
                        e.target.classList.add('is-invalid');
                        document.getElementById('identificadorDisponible').classList.add(
                            "invalid-feedback")
                        document.getElementById('identificadorDisponible').innerHTML =
                            "ID no disponible"
                    } else {
                        e.target.classList.add('is-valid');
                        document.getElementById('identificadorDisponible').classList.add(
                            "valid-feedback")
                        document.getElementById('identificadorDisponible').innerHTML =
                            "ID disponible"
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        })
    })
</script>

