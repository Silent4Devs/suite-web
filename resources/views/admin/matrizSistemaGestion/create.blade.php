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

        /* line 1, ../scss/core.scss */
        .select2-selection--multiple {
            overflow: hidden !important;
            height: auto !important;
        }

        .select2-container {
            box-sizing: border-box;
            display: inline-block;
            margin: 0;
            position: relative;
            vertical-align: middle;
        }

        /* line 1, ../scss/_single.scss */
        .select2-container .select2-selection--single {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            height: 38px;
            user-select: none;
            -webkit-user-select: none;
        }

        /* line 12, ../scss/_single.scss */
        .select2-container .select2-selection--single .select2-selection__rendered {
            display: block;
            padding-left: 8px;
            padding-right: 20px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* line 25, ../scss/_single.scss */
        .select2-container[dir="rtl"] .select2-selection--single .select2-selection__rendered {
            padding-right: 8px;
            padding-left: 20px;
        }

        /* line 1, ../scss/_multiple.scss */

        .select2-container .select2-selection--multiple {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            user-select: none;
            -webkit-user-select: none;
        }

        /* line 12, ../scss/_multiple.scss */
        .select2-container .select2-selection--multiple .select2-selection__rendered {
            display: inline-block;
            overflow: hidden;
            padding-left: 8px;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* line 21, ../scss/_multiple.scss */
        .select2-container .select2-search--inline {
            float: left;
        }

        /* line 24, ../scss/_multiple.scss */
        .select2-container .select2-search--inline .select2-search__field {
            box-sizing: border-box;
            border: none;
            font-size: 100%;
            margin-top: 3px;
            margin-left: 3px;
        }

        /* line 31, ../scss/_multiple.scss */
        .select2-container .select2-search--inline .select2-search__field::-webkit-search-cancel-button {
            -webkit-appearance: none;
        }

        /* line 1, ../scss/_dropdown.scss */
        .select2-dropdown {
            background-color: white;
            border: 1px solid #DDD;
            border-radius: 4px;
            box-sizing: border-box;
            display: block;
            position: absolute;
            left: -100000px;
            width: 100%;
            z-index: 1051;
        }

        /* line 18, ../scss/_dropdown.scss */
        .select2-results {
            display: block;
        }

        /* line 22, ../scss/_dropdown.scss */
        .select2-results__options {
            list-style: none;
            list-style-type: none !important;
            margin: 0;
            padding: 0;
        }

        /* line 28, ../scss/_dropdown.scss */
        .select2-results__option {
            padding: 6px;
            user-select: none;
            -webkit-user-select: none;
        }

        /* line 34, ../scss/_dropdown.scss */
        .select2-results__option[aria-selected] {
            cursor: pointer;
        }

        /* line 39, ../scss/_dropdown.scss */
        .select2-container--open .select2-dropdown {
            left: 0;
        }

        /* line 43, ../scss/_dropdown.scss */
        .select2-container--open .select2-dropdown--above {
            border-bottom: none;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        /* line 49, ../scss/_dropdown.scss */
        .select2-container--open .select2-dropdown--below {
            border-top: none;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        /* line 55, ../scss/_dropdown.scss */
        .select2-search--dropdown {
            display: block;
            padding: 7px;
        }

        /* line 59, ../scss/_dropdown.scss */
        .select2-search--dropdown .select2-search__field {
            padding: 4px;
            width: 100%;
            box-sizing: border-box;
        }

        /* line 64, ../scss/_dropdown.scss */
        .select2-search--dropdown .select2-search__field::-webkit-search-cancel-button {
            -webkit-appearance: none;
        }

        /* line 69, ../scss/_dropdown.scss */
        .select2-search--dropdown.select2-search--hide {
            display: none;
        }

        /* line 15, ../scss/core.scss */
        .select2-close-mask {
            border: 0;
            margin: 0;
            padding: 0;
            display: block;
            position: fixed;
            left: 0;
            top: 0;
            min-height: 100%;
            min-width: 100%;
            height: auto;
            width: auto;
            opacity: 0;
            z-index: 99;
            background-color: #fff;
            filter: alpha(opacity=0);
        }

        /* line 1, ../scss/theme/default/_single.scss */
        .select2-container--default .select2-selection--single {
            background-color: #f0f0f0;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 2px;
        }

        /* line 6, ../scss/theme/default/_single.scss */
        .select2-container--default .select2-selection--single:focus {
            outline: 0;
        }

        /* line 10, ../scss/theme/default/_single.scss */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 34px;
        }

        /* line 15, ../scss/theme/default/_single.scss */
        .select2-container--default .select2-selection--single .select2-selection__clear {
            cursor: pointer;
            float: right;
            font-weight: bold;
        }

        /* line 21, ../scss/theme/default/_single.scss */
        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #999;
        }

        /* line 25, ../scss/theme/default/_single.scss */
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
            position: absolute;
            top: 1px;
            right: 1px;
            width: 20px;
        }

        /* line 35, ../scss/theme/default/_single.scss */
        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #888 transparent transparent transparent;
            border-style: solid;
            border-width: 5px 4px 0 4px;
            height: 0;
            left: 50%;
            margin-left: -4px;
            margin-top: -2px;
            position: absolute;
            top: 50%;
            width: 0;
        }

        /* line 56, ../scss/theme/default/_single.scss */
        .select2-container--default[dir="rtl"] .select2-selection--single .select2-selection__clear {
            float: left;
        }

        /* line 60, ../scss/theme/default/_single.scss */
        .select2-container--default[dir="rtl"] .select2-selection--single .select2-selection__arrow {
            left: 1px;
            right: auto;
        }

        /* line 68, ../scss/theme/default/_single.scss */
        .select2-container--default.select2-container--disabled .select2-selection--single {
            background-color: #eee;
            cursor: default;
        }

        /* line 72, ../scss/theme/default/_single.scss */
        .select2-container--default.select2-container--disabled .select2-selection--single .select2-selection__clear {
            display: none;
        }

        /* line 81, ../scss/theme/default/_single.scss */
        .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
            border-color: transparent transparent #888 transparent;
            border-width: 0 4px 5px 4px;
        }

        /* line 1, ../scss/theme/default/_multiple.scss */
        .select2-container--default .select2-selection--multiple {
            background-color: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.1);
            -webkit-border-radius: 2px;
            border-radius: 2px;
            cursor: text;
            height: 22px;
        }

        /* line 7, ../scss/theme/default/_multiple.scss */
        .select2-container--default .select2-selection--multiple .select2-selection__rendered {
            box-sizing: border-box;
            list-style: none;
            list-style-type: none !important;
            padding: 0 0 0 4px !important;
            margin: 0;
            padding: 0 5px;
            width: 100%;
        }

        /* line 15, ../scss/theme/default/_multiple.scss */
        .select2-container--default .select2-selection--multiple .select2-selection__placeholder {
            color: #999;
            margin-top: 5px;
            float: left;
        }

        /* line 23, ../scss/theme/default/_multiple.scss */
        .select2-container--default .select2-selection--multiple .select2-selection__clear {
            cursor: pointer;
            float: right;
            font-weight: bold;
            margin-top: px;
            margin-right: 2px;
        }

        /* line 31, ../scss/theme/default/_multiple.scss */
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: #ffffff;
            background-color: #4a89dc;
            // border: 1px solid #ddd;
            border-radius: 2px;
            cursor: default;
            float: left;
            margin-right: 5px;
            margin-top: 1px;
            padding: 1px 2px 2px !important;
        }

        /* line 46, ../scss/theme/default/_multiple.scss */
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
            cursor: pointer;
            display: inline-block;
            font-weight: bold;
            margin-right: 2px;
        }

        /* line 55, ../scss/theme/default/_multiple.scss */
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #333;
        }

        /* line 63, ../scss/theme/default/_multiple.scss */
        .select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__choice,
        .select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__placeholder {
            float: right;
        }

        /* line 67, ../scss/theme/default/_multiple.scss */
        .select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__choice {
            margin-left: 5px;
            margin-right: auto;
        }

        /* line 72, ../scss/theme/default/_multiple.scss */
        .select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__choice__remove {
            margin-left: 2px;
            margin-right: auto;
        }

        /* line 80, ../scss/theme/default/_multiple.scss */
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border: 1px solid #CCC;
            outline: 0;
        }

        /* line 87, ../scss/theme/default/_multiple.scss */
        .select2-container--default.select2-container--disabled .select2-selection--multiple {
            background-color: #eee;
            cursor: default;
        }

        /* line 92, ../scss/theme/default/_multiple.scss */
        .select2-container--default.select2-container--disabled .select2-selection__choice__remove {
            display: none;
        }

        /* line 6, ../scss/theme/default/layout.scss */
        .select2-container--default.select2-container--open.select2-container--above .select2-selection--single,
        .select2-container--default.select2-container--open.select2-container--above .select2-selection--multiple {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        /* line 13, ../scss/theme/default/layout.scss */
        .select2-container--default.select2-container--open.select2-container--below .select2-selection--single,
        .select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        /* line 20, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid #DDD;
        }

        /* line 22, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-search--dropdown .select2-search__field:focus {
            outline: 0;
        }

        /* line 29, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-search--inline .select2-search__field {
            background: transparent;
            border: none;
            outline: 0;
        }

        /* line 36, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-results>.select2-results__options {
            max-height: 200px;
            overflow-y: auto;
            padding: 2px !important;
        }

        /* line 42, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-results__option[role=group] {
            padding: 0;
        }

        /* line 46, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-results__option[aria-disabled=true] {
            color: #999;
        }

        /* line 50, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #EEE;
        }

        /* line 54, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-results__option .select2-results__option {
            padding-left: 1em;
        }

        /* line 57, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-results__option .select2-results__option .select2-results__group {
            padding-left: 0;
        }

        /* line 61, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-results__option .select2-results__option .select2-results__option {
            margin-left: -1em;
            padding-left: 2em;
        }

        /* line 65, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
            margin-left: -2em;
            padding-left: 3em;
        }

        /* line 69, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
            margin-left: -3em;
            padding-left: 4em;
        }

        /* line 73, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
            margin-left: -4em;
            padding-left: 5em;
        }

        /* line 77, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
            margin-left: -5em;
            padding-left: 6em;
        }

        /* line 88, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #4a89dc;
            color: white;
        }

        /* line 93, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-results__group {
            cursor: default;
            display: block;
            padding: 6px;
        }
    </style>

    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Riesgo</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.matriz-riesgos.sistema-gestion.store') }}"
                enctype="multipart/form-data">
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

                <input type="hidden" value="{{ $id_analisis }}" name="id_analisis">

                <div class="row">
                    <div class="form-group col-md-4 mb-4">
                        <label for="validationServer01"><i class="fas fa-barcode iconos-crear"></i>ID</label>
                        <input type="number" class="form-control" name="identificador" id="identificador" required>
                        <div id="identificadorDisponible">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="id_sede"><i class="fas fa-map-marker-alt iconos-crear"></i>Sede</label><br>
                        <select class="sedeSelect form-control" name="id_sede" id="id_sede">
                            <option value="">Seleccione una opción</option>
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
                            <option value="">Seleccione una opción</option>
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

                    <div class="form-group col-md-4 col-sm-12">
                        <label for="activo_id"><i class="fas fa-user-tie iconos-crear"></i>Activo (subcategoría)</label><br>
                        <select class="responsableSelect form-control" name="activo_id" id="activo_id">
                            <option value="">Seleccione una opción</option>
                            @foreach ($activos as $activo)
                                <option {{ old('activo_id') == $activo->id ? ' selected="selected"' : '' }}
                                    value="{{ $activo->id }}">{{ $activo->subcategoria }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('activo_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('activo_id') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-4 col-sm-12">
                        <label for="id_responsable"><i class="fas fa-user-tie iconos-crear"></i>Responsable</label><br>
                        <select class="responsableSelect form-control" name="id_responsable" id="id_responsable">
                            <option value="">Seleccione una opción</option>
                            @foreach ($responsables as $responsable)
                                <option {{ old('id_responsable') == $responsable->id ? ' selected="selected"' : '' }}
                                data-puesto="{{ $responsable->puesto }}" value="{{ $responsable->id }}"
                                    data-area="{{ $responsable->area->area }}">{{ $responsable->name }}
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

                    @livewire('select-amenaza-component')

                    @livewire('select-vulnerabilidad-component')



                    <div class="form-group col-md-4 col-sm-4">
                        <label for="tipo_riesgo"><i class="fas fa-asterisk iconos-crear"></i>Tipo de riesgo</label>
                        <select class="form-control {{ $errors->has('tipo_riesgo') ? 'is-invalid' : '' }}"
                            name="tipo_riesgo" id="tipo_riesgo" onclick="event.preventDefault();">
                            <option value disabled {{ old('tipo_riesgo', null) === null ? 'selected' : '' }}>
                                Selecciona una opción</option>
                            @foreach (App\Models\MatrizRiesgo::TIPO_RIESGO_SELECT as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('tipo_riesgo', '') === (string) $key ? 'selected' : '' }}>
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
                        name="descripcionriesgo" id="descripcionriesgo" value="{{ old('descripcionriesgo', '') }}" rows="3"></textarea>
                    @if ($errors->has('descripcionriesgo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcionriesgo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.responsableproceso_helper') }}</span>
                </div>

                <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                    EVALUACIÓN DE RIESGO INICIAL
                </div>

                <p class="font-weight-bold" style="font-size:11pt;">Evalue el riesgo inicial de acuerdo a los apartados
                    afectados</p>
                <hr>
                <div class="sumaFactores">
                    <div class="text-center form-group"
                        style="background-color: #e3e6eb;
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
                                        {{ old('estrategia_negocio', '') === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('estrategia_negocio'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('probabilidad_residual') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad_helper') }}</span>
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
                                        {{ old('calidad_servicio', '') === (string) $key ? 'selected' : '' }}>
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
                            <label for="cliente"><i
                                    class="fa-solid fa-circle-dollar-to-slot iconos-crear"></i>Cliente</label>
                            <select class="form-control {{ $errors->has('cliente') ? 'is-invalid' : '' }}" name="cliente"
                                id="cliente">
                                <option value disabled {{ old('cliente', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('cliente', '') === (string) $key ? 'selected' : '' }}>
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
                    <div class="text-center form-group"
                        style="background-color: #e3e6eb;
                                border-radius: 100px;
                                color: #681818;">
                        ISO 20000-1:2018
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="disponibilidad_2000"><i
                                    class="fa-solid fa-check iconos-crear"></i>Disponibilidad</label>
                            <select class="form-control {{ $errors->has('disponibilidad_2000') ? 'is-invalid' : '' }}"
                                name="disponibilidad_2000" id="disponibilidad_2000">
                                <option value disabled {{ old('disponibilidad_2000', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('disponibilidad_2000', '') === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('probabilidad_residual'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('probabilidad_residual') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad_helper') }}</span>
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
                                        {{ old('niveles_servicio', '') === (string) $key ? 'selected' : '' }}>
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
                                        {{ old('continuidad_BCP', '') === (string) $key ? 'selected' : '' }}>
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
                    @if ($version_historico === "true")
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
                            <select class="form-control {{ $errors->has('confidencialidad_270000') ? 'is-invalid' : '' }}"
                                name="confidencialidad_270000" id="confidencialidad_270000">
                                <option value disabled
                                    {{ old('confidencialidad_270000', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('confidencialidad_270000', '') === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('confidencialidad_270000'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('confidencialidad_270000') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad_helper') }}</span>
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="integridad_27000"><i class="fab fa-black-tie iconos-crear"></i>Integridad</label>
                            <select class="form-control {{ $errors->has('integridad_27000') ? 'is-invalid' : '' }}"
                                name="integridad_27000" id="integridad_27000">
                                <option value disabled {{ old('integridad_27000', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('integridad_27000', '') === (string) $key ? 'selected' : '' }}>
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
                                <option value disabled {{ old('disponibilidad_27000', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('disponibilidad_27000', '') === (string) $key ? 'selected' : '' }}>
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
                                    value="{{ old('resultado_ponderacion', '') }}" style="text-align: center">
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
                                        {{ old('probabilidad', '') === (string) $key ? 'selected' : '' }}>
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
                                        {{ old('impacto', '') === (string) $key ? 'selected' : '' }}>
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
                            <div class="mb-3 input-group" style="pointer-events: none;">

                                <input class="form-control {{ $errors->has('nivelriesgo') ? 'is-invalid' : '' }}"
                                    type="number" name="nivelriesgo" id="nivelriesgo"
                                    value="{{ old('nivelriesgo', '') }}">
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
                                    value="{{ old('riesgo_total', '') }}" style="text-align: center">
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
                    <div class="text-center form-group"
                        style="background-color: #e3e6eb;
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
                            <select class="form-control {{ $errors->has('estrategia_negocioRes') ? 'is-invalid' : '' }}"
                                name="estrategia_negocioRes" id="estrategia_negocioRes">
                                <option value disabled
                                    {{ old('estrategia_negocioRes', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('estrategia_negocioRes', '') === (string) $key ? 'selected' : '' }}>
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
                                <option value disabled {{ old('calidad_servicioRes', null) === null ? 'selected' : '' }}>
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
                            <label for="clienteRes"><i
                                    class="fa-solid fa-circle-dollar-to-slot iconos-crear"></i>Cliente</label>
                            <select class="form-control {{ $errors->has('clienteRes') ? 'is-invalid' : '' }}"
                                name="clienteRes" id="clienteRes">
                                <option value disabled {{ old('clienteRes', null) === null ? 'selected' : '' }}>
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
                    <div class="text-center form-group"
                        style="background-color: #e3e6eb;
                                border-radius: 100px;
                                color: #681818;">
                        ISO 20000-1:2018
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="disponibilidad_2000Res"><i
                                    class="fa-solid fa-check iconos-crear"></i>Disponibilidad</label>
                            <select class="form-control {{ $errors->has('disponibilidad_2000Res') ? 'is-invalid' : '' }}"
                                name="disponibilidad_2000Res" id="disponibilidad_2000Res">
                                <option value disabled
                                    {{ old('disponibilidad_2000Res', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('disponibilidad_2000Res', '') === (string) $key ? 'selected' : '' }}>
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

                        <div class="form-group col-sm-4 mt-1">
                            <label for="niveles_servicioRes"><i class="fas fa-tasks icons-crear mr-2"></i> Niveles de
                                Servicio</label>
                            <select class="form-control {{ $errors->has('niveles_servicioRes') ? 'is-invalid' : '' }}"
                                name="niveles_servicioRes" id="niveles_servicioRes">
                                <option value disabled {{ old('niveles_servicioRes', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('niveles_servicioRes', '') === (string) $key ? 'selected' : '' }}>
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
                                <option value disabled {{ old('continuidad_BCPRes', null) === null ? 'selected' : '' }}>
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
                    @if ($version_historico === "true")
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
                                        {{ old('confidencialidad_270000Res', '') === (string) $key ? 'selected' : '' }}>
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
                            <label for="integridad_27000Res"><i
                                    class="fab fa-black-tie iconos-crear"></i>Integridad</label>
                            <select class="form-control {{ $errors->has('integridad_27000Res') ? 'is-invalid' : '' }}"
                                name="integridad_27000Res" id="integridad_27000Res">
                                <option value disabled {{ old('integridad_27000Res', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('integridad_27000Res', '') === (string) $key ? 'selected' : '' }}>
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
                                    {{ old('disponibilidad_27000Res', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\MatrizRiesgo::EV_INICIAL_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('disponibilidad_27000Res', '') === (string) $key ? 'selected' : '' }}>
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
                                    value="{{ old('resultado_ponderacionRes', '') }}" style="text-align: center">
                                @if ($errors->has('resultado_ponderacionRes'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('resultado_ponderacionRes') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <hr>
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
                                        {{ old('probabilidad_residual', '') === (string) $key ? 'selected' : '' }}>
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
                                        {{ old('impacto_residual', '') === (string) $key ? 'selected' : '' }}>
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
                            <div class="mb-3 input-group" style="pointer-events: none;">
                                <input
                                    class="form-control {{ $errors->has('nivelriesgo_residual') ? 'is-invalid' : '' }}"
                                    type="number" name="nivelriesgo_residual" id="nivelriesgo_residual"
                                    value="{{ old('nivelriesgo_residual', '') }}">
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
                                    value="{{ old('riesgo_residual', '') }}" style="text-align: center">
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
                {{-- Acciones --}}
                <p class="font-weight-bold" style="font-size:11pt;">Acciones</p>
                <input class="form-control" type="text" id="version_historico"
                name="version_historico" value="{{ $version_historico}}" readonly hidden>
                <div class="row">
                    @if ($version_historico === "true")
                        <p class="font-weight-bold" style="font-size:8pt;">Versión de Controles ISO 27001:2013</p><br>
                    @else
                        <p class="font-weight-bold" style="font-size:8pt;">Versión de Controles ISO 27001:2022</p><br>
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
                                        @if ($version_historico === "true")
                                        @foreach ($controles as $control)
                                        <option value="{{ $control->id }}">
                                            {{ $control->anexo_indice }} {{ $control->anexo_politica }}
                                        </option>
                                        @endforeach
                                    @else
                                        @foreach ($controles as $control)
                                        <option value="{{ $control->id }}">
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
                                <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-sm-12">
                        <label for="tipo_tratamiento"><i class="fas fa-lightbulb iconos-crear"></i>Seleccione el
                            tratamiento
                            que desea darle a este riesgo</label>
                        <select class="form-control" name="tipo_tratamiento" id="ejemplo">
                            <option selected value="">Seleccione una opción</option>&gt;
                            <option value="1">Aceptar</option>&gt;
                            <option value="0">Mitigar</option>&gt;
                            <option value="2">Transferir</option>&gt;
                            <option value="3">Eliminar</option>&gt;
                            <option value="4">Evitar</option>&gt;
                        </select>
                        <!-- Note, I changed hidden to text so you can see it<br/> -->
                    </div>
                    <div class="form-group col-sm-12">
                        <!-- <label for="" style="margin-left: 15px; margin-bottom:5px;"> <i class="fas fa-lightbulb iconos-crea"></i> Justificación</label> -->
                        <textarea class="form-control" type="text" for="aceptar_transferir" name="aceptar_transferir" id="ver1"
                            value="1" placeholder="Justificación" rows="3" style="display: none;"></textarea>
                    </div>
                    <div class="form-group col-sm-12" id="modulo_planaccion" style="display: none;">

                        {{-- MODULO AGREGAR PLAN DE ACCIÓN --}}
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
                                'id_matriz' => $id_analisis,
                            ])
                        </div> --}}
                        {{-- FIN MODULO AGREGAR PLAN DE ACCIÓN --}}
                    </div>
                    <!-- hasta aqui -->
                </div>
                <hr>


                {{-- Enviar - Cancelar --}}
                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.matriz-seguridad.sistema-gestion', ['id' => $id_analisis]) }}"
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
