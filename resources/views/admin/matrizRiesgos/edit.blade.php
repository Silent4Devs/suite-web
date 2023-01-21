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
            <form method="POST" action="{{ route('admin.matriz-riesgos.update', [$matrizRiesgo->id]) }}"
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
                            <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Llene los siguientes campos según
                                corresponda:</p>
                        </div>
                    </div>
                </div><br>

                <input type="hidden" value="{{ $matrizRiesgo->id_analisis }}" name="id_analisis">

                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="id_sede" class="required"><i class="fas fa-map-marker-alt iconos-crear"></i>Sede</label><br>
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
                        <label for="id_proceso" class="required"><i class="fas fa-project-diagram iconos-crear"></i>Proceso</label><br>
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
                        <label for="activo_id" class="required"><i class="fas fa-user-tie iconos-crear"></i>Activo (subcategoría)</label><br>
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
                        <label for="id_responsable" class="required"><i class="fas fa-user-tie iconos-crear"></i>Responsable</label>
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
                        <label for="id_amenaza" class="required"><i class="fas fa-fire iconos-crear"></i>Amenaza</label>
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
                        <label for="id_vulnerabilidad" class="required"><i class="fas fa-shield-alt iconos-crear"></i>Vulnerabilidad</label>
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
                        <label for="tipo_riesgo" class="required"><i class="fas fa-asterisk iconos-crear"></i>Tipo de riesgo</label>
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
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad_helper') }}</span>
                    </div>

                </div>

                <div class="form-group">
                    <label for="descripcionriesgo"><i class="far fa-file-alt iconos-crear"></i>Descripción Riesgo</label>
                    <textarea class="form-control {{ $errors->has('descripcionriesgo') ? 'is-invalid' : '' }}" type="text"
                        name="descripcionriesgo" id="descripcionriesgo" rows="3">{{ old('descripcionriesgo', $matrizRiesgo->descripcionriesgo) }}</textarea>
                    @if ($errors->has('descripcionriesgo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcionriesgo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.responsableproceso_helper') }}</span>
                </div>

                <hr>
                <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                    EVALUACIÓN DE RIESGO INICIAL
                </div>

                <p class="font-weight-bold" style="font-size:11pt;">Indique las caracteristicas del CID afectadas por este
                    riesgo</p>
                {{-- <input type="hidden" id="resultadoponderacion" name="resultadoponderacion"
                    value="{{ old('resultadoponderacion', $matrizRiesgo->resultadoponderacion) }}"> --}}
                <div class="sumaFactores">
                    <div class="py-2 row">

                        <div class="form-group col-sm-4">
                            <label for="confidencialidad" class="required"><i class="fas fa-lock iconos-crear"></i>Confidencialidad</label>
                            <select class="form-control {{ $errors->has('confidencialidad') ? 'is-invalid' : '' }}"
                                name="confidencialidad" id="confidencialidad">
                                <option value disabled {{ old('confidencialidad', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('confidencialidad', $matrizRiesgo->confidencialidad) === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('confidencialidad'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('confidencialidad') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad_helper') }}</span>
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="integridad" class="required"><i class="fab fa-black-tie iconos-crear"></i>Integridad</label>
                            <select class="form-control {{ $errors->has('integridad') ? 'is-invalid' : '' }}"
                                name="integridad" id="integridad">
                                <option value disabled {{ old('integridad', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('integridad', $matrizRiesgo->integridad) === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('integridad'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('integridad') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="disponibilidad" class="required"><i
                                    class="fas fa-lock-open iconos-crear"></i>Disponibilidad</label>
                            <select class="form-control {{ $errors->has('disponibilidad') ? 'is-invalid' : '' }}"
                                name="disponibilidad" id="disponibilidad">
                                <option value disabled {{ old('disponibilidad', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('disponibilidad', $matrizRiesgo->disponibilidad) === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('disponibilidad'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('disponibilidad') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="form-group col-sm-12 col-12" style="text-align:center;">
                            <label for="resultadoponderacion"><i
                                    class="fas fa-exclamation-circle iconos-crear"></i>Resultado de la ponderación por
                                Factores:
                            </label>
                            <div class="mb-3 input-group" style="pointer-events: none;">
                                <input class="form-control {{ $errors->has('resultadoponderacion') ? 'is-invalid' : '' }}"
                                    type="number" name="resultadoponderacion" id="resultadoponderacion"
                                    value="{{ old('resultadoponderacion', $matrizRiesgo->resultadoponderacion) }}"
                                    style="text-align: center">
                                @if ($errors->has('resultadoponderacion'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('resultadoponderacion') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <p class="font-weight-bold" style="font-size:11pt;">Evalue el riesgo inicial de acuerdo a la
                        probabilidad
                        vs
                        impacto</p>
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
                            <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad_helper') }}</span>
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="impacto"><i class="fas fa-compact-disc iconos-crear"></i>Impacto</label>
                            <select class="form-control {{ $errors->has('impacto') ? 'is-invalid' : '' }}" name="impacto"
                                id="impacto">
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

                        <div class="form-group col-sm-12 col-12" style="text-align:center;">
                            <label for="riesgototal"><i class="fas fa-exclamation-circle iconos-crear"></i>Riesgo Total
                            </label>
                            <div class="mb-3 input-group" style="pointer-events: none;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-dark mayus" id="nivelriesgo_total"></span>
                                </div>
                                <input class="form-control {{ $errors->has('nivelriesgo') ? 'is-invalid' : '' }}"
                                    type="number" name="riesgototal" id="riesgo_total"
                                    value="{{ old('riesgototal', $matrizRiesgo->riesgototal) }}"
                                    style="text-align: center">
                                @if ($errors->has('riesgototal'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('riesgototal') }}
                                    </div>
                                @endif
                            </div>
                        </div>


                        {{-- <div class="form-group col-sm-4">
                        <label for="riesgoresidual"><i class="fas fa-radiation iconos-crear"></i>Riesgo Residual</label>
                        <input class="form-control {{ $errors->has('riesgoresidual') ? 'is-invalid' : '' }}" type="text"
                            name="riesgoresidual" id="riesgoresidual" value="{{ old('riesgoresidual', '') }}">
                        @if ($errors->has('riesgoresidual'))
                            <div class="invalid-feedback">
                                {{ $errors->first('riesgoresidual') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="riesgototal"><i class="fas fa-radiation iconos-crear"></i>Riesgo Total</label>
                        <input class="form-control {{ $errors->has('riesgototal') ? 'is-invalid' : '' }}" type="text"
                            name="riesgototal" id="riesgototal" value="{{ old('riesgototal', '') }}">
                        @if ($errors->has('riesgototal'))
                            <div class="invalid-feedback">
                                {{ $errors->first('riesgototal') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                    </div>


                    <div class="form-group col-sm-4">
                        <label for="resultadoponderacion"><i class="fas fa-chart-bar iconos-crear"></i>Resultado
                            Ponderacion</label>
                        <input class="form-control {{ $errors->has('resultadoponderacion') ? 'is-invalid' : '' }}"
                            type="text" name="resultadoponderacion" id="resultadoponderacion"
                            value="{{ old('resultadoponderacion', '') }}">
                        @if ($errors->has('resultadoponderacion'))
                            <div class="invalid-feedback">
                                {{ $errors->first('resultadoponderacion') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad_helper') }}</span>
                    </div> --}}

                    </div>
                </div>
                <hr>
                <p class="font-weight-bold" style="font-size:11pt;">Acciones</p>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <div class="row">
                            <label for="controles_id" style="margin-left: 15px; margin-bottom:5px; margin-right: 0px;"><i
                                    class="fas fa-lock iconos-crear"></i>Seleccione los control(es)
                                a
                                aplicar</label>
                            <div class="mb-4 col-12">
                                {{-- <select
                                    class="form-control js-example-basic-multiple select2  {{ $errors->has('controles_id') ? 'is-invalid' : '' }}"
                                    name="controles_id[]" id="select2-multiple-input-sm" multiple="multiple">
                                    <option value disabled>
                                        Selecciona una opción</option>
                                        @foreach ($controles as $control)
                                        <option value="{{ $control->id }}"
                                            {{ in_array(old('controles_id[]',$control->id),$matrizRiesgo->matriz_riesgos_controles_pivots->pluck('id')->toArray()) == $control->id ? 'selected' : '' }}>
                                            {{ $control->anexo_indice }} {{ $control->anexo_politica }}
                                        </option>
                                    @endforeach
                                </select> --}}

                                <select
                                    class="form-control js-example-basic-multiple select2  {{ $errors->has('controles_id') ? 'is-invalid' : '' }}"
                                    name="controles_id[]" id="select2-multiple-input-sm" multiple="multiple">
                                    <option value disabled>
                                        Selecciona una opción</option>
                                    @foreach ($controles as $control)
                                        <option value="{{ $control->id }}"
                                            {{ in_array(old('controles_id[]', $control->id), $matrizRiesgo->matriz_riesgos_controles_pivots->pluck('id')->toArray()) == $control->id ? 'selected' : '' }}>
                                            {{ $control->anexo_indice }} {{ $control->anexo_politica }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('controles_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('controles_id') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-sm-12">
                        <div class="valores_tipo_tratamiento">
                            <label for="tipo_tratamiento"><i class="fas fa-lightbulb iconos-crear"></i>Seleccione el
                                tratamiento que desea darle a este riesgo</label>
                            <select class="form-control" name="tipo_tratamiento" id="ejemplo">
                                <option selected value="">Seleccione una opción</option>&gt;
                                <option
                                    {{ old('tipo_tratamiento', $matrizRiesgo->tipo_tratamiento) == 1 ? 'selected' : '' }}
                                    value="1">Aceptar</option>&gt;
                                <option
                                    {{ old('tipo_tratamiento', $matrizRiesgo->tipo_tratamiento) == 0 ? 'selected' : '' }}
                                    value="0">Mitigar</option>&gt;
                                <option
                                    {{ old('tipo_tratamiento', $matrizRiesgo->tipo_tratamiento) == 2 ? 'selected' : '' }}
                                    value="2">Transferir</option>&gt;
                            </select>
                        </div>
                        <!-- Note, I changed hidden to text so you can see it<br/> -->
                    </div>
                    <div class="form-group col-sm-12">
                        <textarea class="form-control" type="text" for="aceptar_transferir" name="aceptar_transferir" id="ver1"
                            value="1" placeholder="Justificación" rows="3" style="display: none;">{{ $matrizRiesgo->aceptar_transferir }}</textarea>
                    </div>

                    <div class="form-group col-sm-12" id="modulo_planaccion" style="display: none;">
                        {{-- MODULO AGREGAR PLAN DE ACCIÓN --}}
                        {{-- Comente vista plan de acción --}}
                        {{-- <div class="row w-100">
                            <label for="plan_accion" style="margin-left: 15px; margin-bottom:5px;"> <i
                                    class="fas fa-question-circle iconos-crear"></i> ¿Vincular con plan de acción?</label>
                            @livewire('planes-implementacion-select', ['planes_seleccionados' => []])
                            <div class="pl-0 ml-0 col-2">
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                                    data-target="#planAccionModal">
                                    <i class="mr-1 fas fa-plus-circle"></i> Crear
                                </button>
                            </div>
                            @livewire('plan-implementacion-create', [
                                'referencia' => null,
                                'modulo_origen' => 'Matríz de
                                                        riesgos',
                                'id_matriz' => $matrizRiesgo->id_analisis,
                            ])
                        </div> --}}
                        {{-- FIN MODULO AGREGAR PLAN DE ACCIÓN --}}

                        <div class="row w-100">
                            <label for="plan_accion" style="margin-left: 15px; margin-bottom:5px;"> <i
                                    class="fas fa-question-circle iconos-crear"></i> ¿Vincular con plan de acción?</label>
                            @livewire('planes-implementacion-select', ['planes_seleccionados' => []])
                            <div class="pl-0 ml-0 col-2">
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                                    data-target="#planAccionModal">
                                    <i class="mr-1 fas fa-plus-circle"></i> Crear
                                </button>
                            </div>
                            @livewire('plan-implementacion-create', [
                                'referencia' => null,
                                'modulo_origen' => 'Matríz de
                                                                                                                riesgos',
                                'id_matriz' => $matrizRiesgo->id_analisis,
                            ])
                        </div>

                    </div>

                </div>
                <hr>
                <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                    EVALUACIÓN DEL RIESGO RESIDUAL
                </div>
                <p class="font-weight-bold" style="font-size:11pt;">Indique las caracteristicas del CID afectadas por este
                    riesgo</p>
                {{-- <input type="hidden" id="resultadoponderacionRes" name="resultadoponderacionRes"
                    value="{{ old('resultadoponderacionRes', $matrizRiesgo->resultadoponderacionRes) }}"> --}}
                <div class="sumaFactoresResiduales">
                    <div class="py-2 row">
                        <div class="form-group col-sm-4">
                            <label for="confidencialidad_cid"><i
                                    class="fas fa-lock iconos-crear"></i>Confidencialidad</label>
                            <select class="form-control {{ $errors->has('confidencialidad_cid') ? 'is-invalid' : '' }}"
                                name="confidencialidad_cid" id="confidencialidad_cid">
                                <option value disabled {{ old('confidencialidad_cid', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('confidencialidad_cid', $matrizRiesgo->confidencialidad_cid) === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('confidencialidad_cid'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('confidencialidad_cid') }}
                                </div>
                            @endif
                            <span
                                class="help-block">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad_helper') }}</span>
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="integridad_cid"><i class="fab fa-black-tie iconos-crear"></i>Integridad</label>
                            <select class="form-control {{ $errors->has('integridad_cid') ? 'is-invalid' : '' }}"
                                name="integridad_cid" id="integridad_cid">
                                <option value disabled {{ old('integridad_cid', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('integridad_cid', $matrizRiesgo->integridad_cid) === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('integridad_cid'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('integridad_cid') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="disponibilidad_cid"><i
                                    class="fas fa-lock-open iconos-crear"></i>Disponibilidad</label>
                            <select class="form-control {{ $errors->has('disponibilidad_cid') ? 'is-invalid' : '' }}"
                                name="disponibilidad_cid" id="disponibilidad_cid">
                                <option value disabled {{ old('disponibilidad_cid', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('disponibilidad_cid', $matrizRiesgo->disponibilidad_cid) === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('disponibilidad_cid'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('disponibilidad_cid') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                        </div>

                    </div>


                    <hr>

                    <div class="row">
                        <div class="form-group col-sm-12 col-12" style="text-align:center;">
                            <label for="resultadoponderacionRes"><i
                                    class="fas fa-exclamation-circle iconos-crear"></i>Resultado de la ponderación por
                                Factores:
                            </label>
                            <div class="mb-3 input-group" style="pointer-events: none;">
                                <input class="form-control {{ $errors->has('nivelriesgo') ? 'is-invalid' : '' }}"
                                    type="number" name="resultadoponderacionRes" id="resultadoponderacionRes"
                                    value="{{ old('resultadoponderacionRes', $matrizRiesgo->resultadoponderacionRes) }}"
                                    style="text-align: center">
                                @if ($errors->has('resultadoponderacionRes'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('resultadoponderacionRes') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="probabilidad_residual"><i
                                    class="fas fa-wave-square iconos-crear"></i>Probabilidad</label>
                            <select class="form-control {{ $errors->has('probabilidad_residual') ? 'is-invalid' : '' }}"
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
                            <label><i class="fas fa-exclamation-circle iconos-crear"></i>Nivel Riesgo:
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

                        <div class="form-group col-sm-12 col-12" style="text-align:center;">
                            <label><i class="fas fa-exclamation-circle iconos-crear"></i>Riesgo
                                Total Residual
                            </label>
                            <div class="mb-3 input-group" style="pointer-events: none;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-dark mayus"
                                        id="nivel_riesgo_total_residual"></span>
                                </div>
                                <input class="form-control {{ $errors->has('nivelriesgo') ? 'is-invalid' : '' }}"
                                    type="number" name="riesgoresidual" id="riesgo_total_residual"
                                    value="{{ old('riesgoresidual', $matrizRiesgo->riesgoresidual) }}"
                                    style="text-align: center">
                                @if ($errors->has('riesgoresidual'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('riesgoresidual') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <hr>

                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.matriz-seguridad', ['id' => $matrizRiesgo->id_analisis]) }}"
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


@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            let tipoTratamiento = @json($matrizRiesgo->tipo_tratamiento);
            if (tipoTratamiento == 0) {
                $("#ver1").css("display", "none");
                $("#modulo_planaccion").css("display", "block");

            } else {
                $("#ver1").css("display", "block");
                $("#modulo_planaccion").css("display", "none");

            }
        })


        $("#ejemplo").click(function() {
            var val = $(this).val();
            if (val == 0) {
                $("#ver1").css("display", "none");
                $("#modulo_planaccion").css("display", "block");
            } else {
                $("#ver1").css("display", "block");
                $("#modulo_planaccion").css("display", "none");

            }
        });
    </script>


    @include('admin.matrizRiesgos.funciones')
@endsection
