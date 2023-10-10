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
            <form method="POST" action="{{ route('admin.matriz-riesgos.store') }}" enctype="multipart/form-data">
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

                <input type="hidden" value="{{ $id_analisis }}" name="id_analisis">

                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="id_sede"  class="required"><i class="fas fa-map-marker-alt iconos-crear"></i>Sede</label><br>
                        <select class="sedeSelect form-control" name="id_sede" id="id_sede">
                            <option value="">Seleccione una opción</option>
                            @foreach ($sedes as $sede)
                                <option {{old('id_sede') == $sede->id ? ' selected="selected"' : ''}} value="{{ $sede->id }}">{{ $sede->sede }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_sede'))
                        <span class="text-danger"> {{ $errors->first('id_sede') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-md-4 col-sm-12">
                        <label for="id_proceso"  class="required"><i class="fas fa-project-diagram iconos-crear"></i>Proceso</label><br>
                        <select class="procesoSelect form-control" name="id_proceso" id="id_proceso">
                            <option value="">Seleccione una opción</option>
                            @foreach ($procesos as $proceso)
                                <option {{old('id_proceso') == $proceso->id ? ' selected="selected"' : ''}} value="{{ $proceso->id }}">{{ $proceso->codigo }} / {{ $proceso->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_proceso'))
                            <span class="text-danger"> {{ $errors->first('id_proceso') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-md-4 col-sm-12">
                        <label for="activo_id"  class="required"><i class="fas fa-user-tie iconos-crear"></i>Activo (subcategoría)</label><br>
                        <select class="responsableSelect form-control" name="activo_id" id="activo_id">
                            <option value="">Seleccione una opción</option>
                            @foreach ($activos as $activo)
                                <option {{old('activo_id') == $activo->id ? ' selected="selected"' : ''}} value="{{ $activo->id }}">{{ $activo->subcategoria }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('activo_id'))
                        <span class="text-danger"> {{ $errors->first('activo_id') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-md-4 col-sm-12">
                        <label for="id_responsable"  class="required"><i class="fas fa-user-tie iconos-crear"></i>Responsable</label><br>
                        <select class="responsableSelect form-control" name="id_responsable" id="id_responsable">
                            <option value="">Seleccione una opción</option>
                            @foreach ($responsables as $responsable)
                                <option  data-puesto="{{ $responsable->puesto }}" value="{{ $responsable->id }}" data-area="{{ $responsable->area->area }}">{{ $responsable->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_responsable'))
                        <span class="text-danger"> {{ $errors->first('id_responsable') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
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
                        <label for="id_amenaza"  class="required"><i class="fas fa-fire iconos-crear"></i>Amenaza</label>
                        <select class="procesoSelect form-control" name="id_amenaza" id="id_amenaza">
                            <option value="">Seleccione una opción</option>
                            @foreach ($amenazas as $amenaza)
                                <option {{old('id_amenaza') == $amenaza->id ? ' selected="selected"' : ''}} value="{{ $amenaza->id }}">{{ $amenaza->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_amenaza'))
                        <span class="text-danger"> {{ $errors->first('id_amenaza') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-md-4 col-sm-4">
                        <label for="id_vulnerabilidad"  class="required"><i class="fas fa-shield-alt iconos-crear"></i>Vulnerabilidad</label>
                        <select class="procesoSelect form-control" name="id_vulnerabilidad" id="id_vulnerabilidad">
                            <option value="">Seleccione una opción</option>
                            @foreach ($vulnerabilidades as $vulnerabilidad)
                                <option {{old('id_vulnerabilidad') == $vulnerabilidad->id ? ' selected="selected"' : ''}} value="{{ $vulnerabilidad->id }}">{{ $vulnerabilidad->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_vulnerabilidad'))
                        <span class="text-danger"> {{ $errors->first('id_vulnerabilidad') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-md-4 col-sm-4">
                        <label for="tipo_riesgo"  class="required"><i class="fas fa-asterisk iconos-crear"></i>Tipo de riesgo</label>
                        <select class="form-control {{ $errors->has('tipo_riesgo') ? 'is-invalid' : '' }}"
                            name="tipo_riesgo" id="tipo_riesgo">
                            <option value disabled {{ old('tipo_riesgo', null) === null ? 'selected' : '' }}>
                                Selecciona una opción</option>
                            @foreach (/*App\Models\MatrizRiesgo::TIPO_RIESGO_SELECT*/ $tipo_riesgo as $key => $label)
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
                    <textarea class="form-control {{ $errors->has('descripcionriesgo') ? 'is-invalid' : '' }}"
                        type="text" name="descripcionriesgo" id="descripcionriesgo"
                        value="{{ old('descripcionriesgo', '') }}" rows="3"></textarea>
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

                <input type="hidden" id="resultadoponderacion" name="resultadoponderacion" value="0">
                <div class="py-2 row">
                    <div class="form-group col-sm-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="confidencialidad"
                                name="confidencialidad">
                            <label class="custom-control-label" for="confidencialidad"><i
                                    class="fas fa-lock iconos-crear"></i>Confidencialidad</label>
                        </div>

                        @if ($errors->has('confidencialidad'))
                            <div class="invalid-feedback">
                                {{ $errors->first('confidencialidad') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                    </div>

                    <div class="form-group col-sm-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="integridad" name="integridad">
                            <label class="custom-control-label" for="integridad"><i
                                    class="fab fa-black-tie iconos-crear"></i>Integridad</label>
                        </div>
                        @if ($errors->has('integridad'))
                            <div class="invalid-feedback">
                                {{ $errors->first('integridad') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                    </div>

                    <div class="form-group col-sm-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="disponibilidad" name="disponibilidad">
                            <label class="custom-control-label" for="disponibilidad"><i
                                    class="fas fa-lock-open iconos-crear"></i>Disponibilidad</label>
                        </div>
                        @if ($errors->has('disponibilidad'))
                            <div class="invalid-feedback">
                                {{ $errors->first('disponibilidad') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                    </div>

                </div>
                <hr>
                <p class="font-weight-bold" style="font-size:11pt;">Evalue el riesgo inicial de acuerdo a la probabilidad vs
                    impacto</p>
                <div class="row">

                    <div class="form-group col-sm-4">
                        <label for="probabilidad"  class="required"><i class="fas fa-wave-square iconos-crear"></i>Probabilidad</label>
                        <select class="form-control {{ $errors->has('probabilidad') ? 'is-invalid' : '' }}"
                            name="probabilidad" id="probabilidad">
                            <option value disabled {{ old('probabilidad', null) === null ? 'selected' : '' }}>
                                Selecciona una opción</option>
                            @foreach (/*App\Models\MatrizRiesgo::PROBABILIDAD_SELECT*/ $probabilidad as $key => $label)
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
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad_helper') }}</span>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="impacto"  class="required"><i class="fas fa-compact-disc iconos-crear"></i>Impacto</label>
                        <select class="form-control {{ $errors->has('impacto') ? 'is-invalid' : '' }}" name="impacto"
                            id="impacto">
                            <option value disabled {{ old('impacto', null) === null ? 'selected' : '' }}>
                                Selecciona una opción</option>
                            @foreach (/*App\Models\MatrizRiesgo::IMPACTO_SELECT*/ $impacto as $key => $label)
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

                    <div class="form-group col-sm-4" >
                        <label for="nivelriesgo"><i class="fas fa-exclamation-circle iconos-crear"></i>Nivel Riesgo:
                        </label>
                        <div class="mb-3 input-group" style="pointer-events: none;">
                            <div class="input-group-prepend">
                                <span class="input-group-text text-dark mayus" id="nivelriesgo_pre"></span>
                            </div>
                            <input class="form-control {{ $errors->has('nivelriesgo') ? 'is-invalid' : '' }}"
                                type="number" name="nivelriesgo" id="nivelriesgo" value="{{ old('nivelriesgo', '') }}">
                            @if ($errors->has('nivelriesgo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nivelriesgo') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <hr>
                <p class="font-weight-bold" style="font-size:11pt;">Acciones</p>
                <input class="form-control" type="text" id="version_historico"
                name="version_historico" value="{{ $version_historico}}" readonly hidden>
                <div class="row">
                    @if ($version_historico === "true")
                        <p class="font-weight-bold" style="font-size:8pt;">Versión de Controles ISO 27001:2013</p>
                    @else
                        <p class="font-weight-bold" style="font-size:8pt;">Versión de Controles ISO 27001:2022</p>
                    @endif
                    <div class="form-group col-sm-12">
                        <div class="row">
                            <label for="controles_id" style="margin-left: 15px; margin-bottom:5px; margin-right: 0px;" class="required"><i class="fas fa-lock iconos-crear"></i>Seleccione los control(es)
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
                        <label for="tipo_tratamiento"><i class="fas fa-lightbulb iconos-crear"></i>Seleccione el tratamiento que desea darle a este riesgo</label>
                        <select class="form-control" name="tipo_tratamiento" id="ejemplo">
                            <option selected value="">Seleccione una opción</option>&gt;
                            <option value="1">Aceptar</option>&gt;
                            <option value="0">Mitigar</option>&gt;
                            <option value="2">Transferir</option>&gt;
                        </select>
                            <!-- Note, I changed hidden to text so you can see it<br/> -->
                    </div>
                    <div class="form-group col-sm-12">
                        <!-- <label for="" style="margin-left: 15px; margin-bottom:5px;"> <i class="fas fa-lightbulb iconos-crea"></i> Justificación</label> -->
                        <textarea class="form-control" type="text" for="aceptar_transferir" name="aceptar_transferir" id="ver1" value="1" placeholder="Justificación" rows="3" style="display: none;"></textarea>
                    </div>
                    <div class="form-group col-sm-12" id="modulo_planaccion" style="display: none;">

                        {{-- <label for="plan_de_accion"><i class="fas fa-lightbulb iconos-crear"></i>Plan de acción</label>
                        <select class="form-control {{ $errors->has('plan_de_accion') ? 'is-invalid' : '' }}"
                            name="plan_de_accion" id="plan_de_accion">
                            <option value disabled {{ old('plan_de_accion', null) === null ? 'selected' : '' }}>
                                Selecciona una opción</option>
                            @foreach ($controles as $control)
                                <option value="{{ $control->id }}">
                                    {{ $control->control }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('plan_de_accion'))
                            <div class="invalid-feedback">
                                {{ $errors->first('plan_de_accion') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span> --}}
                        {{-- MODULO AGREGAR PLAN DE ACCIÓN --}}

                        {{--Pendiente de revisar con Mike y Marco--}}
                        {{-- <div class="row w-100">
                            <label for="plan_accion" style="margin-left: 15px; margin-bottom:5px;"> <i class="fas fa-question-circle iconos-crear"></i> ¿Vincular con plan de acción?</label>
                            @livewire('planes-implementacion-select',['planes_seleccionados'=>[]])
                            <div class="pl-0 ml-0 col-2">
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                                    data-target="#planAccionModal">
                                    <i class="mr-1 fas fa-plus-circle"></i> Crear
                                </button>
                            </div>
                            @livewire('plan-implementacion-create', ['referencia' => null,'modulo_origen'=>'Matríz de
                            riesgos', 'id_matriz' => $id_analisis])
                        </div> --}}
                        {{-- FIN MODULO AGREGAR PLAN DE ACCIÓN --}}
                    </div>
<!-- hasta aqui -->
                </div>
                <hr>
                <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                    EVALUACIÓN DEL RIESGO RESIDUAL
                </div>


                <p class="font-weight-bold" style="font-size:11pt;">Indique las caracteristicas del CID afectadas por este
                    riesgo</p>
                <input type="hidden" id="resultadoponderacionRes" name="resultadoponderacionRes">

                <div class="py-2 row">
                    <div class="form-group col-sm-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="confidencialidad_cid"
                                name="confidencialidad_cid">
                            <label class="custom-control-label" for="confidencialidad_cid"><i
                                    class="fas fa-lock iconos-crear"></i>Confidencialidad</label>
                        </div>

                        @if ($errors->has('confidencialidad_cid'))
                            <div class="invalid-feedback">
                                {{ $errors->first('confidencialidad_cid') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                    </div>

                    <div class="form-group col-sm-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="integridad_cid" name="integridad_cid">
                            <label class="custom-control-label" for="integridad_cid"><i
                                    class="fab fa-black-tie iconos-crear"></i>Integridad</label>
                        </div>
                        @if ($errors->has('integridad_cid'))
                            <div class="invalid-feedback">
                                {{ $errors->first('integridad_cid') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                    </div>

                    <div class="form-group col-sm-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="disponibilidad_cid"
                                name="disponibilidad_cid">
                            <label class="custom-control-label" for="disponibilidad_cid"><i
                                    class="fas fa-lock-open iconos-crear"></i>Disponibilidad</label>
                        </div>
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
                    <div class="form-group col-sm-4">
                        <label for="probabilidad_residual"><i
                                class="fas fa-wave-square iconos-crear"></i>Probabilidad</label>
                        <select class="form-control {{ $errors->has('probabilidad_residual') ? 'is-invalid' : '' }}"
                            name="probabilidad_residual" id="probabilidad_residual">
                            <option value disabled {{ old('probabilidad_residual', null) === null ? 'selected' : '' }}>
                                Selecciona una opción</option>
                            @foreach (/*App\Models\MatrizRiesgo::PROBABILIDAD_SELECT*/ $probabilidad as $key => $label)
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
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad_helper') }}</span>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="impacto_residual"><i class="fas fa-compact-disc iconos-crear"></i>Impacto</label>
                        <select class="form-control {{ $errors->has('impacto_residual') ? 'is-invalid' : '' }}"
                            name="impacto_residual" id="impacto_residual">
                            <option value disabled {{ old('impacto_residual', null) === null ? 'selected' : '' }}>
                                Selecciona una opción</option>
                            @foreach (/*App\Models\MatrizRiesgo::IMPACTO_SELECT*/ $impacto as $key => $label)
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
                            <div class="input-group-prepend">
                                <span class="input-group-text text-dark mayus" id="nivelriesgo_residual_pre"></span>
                            </div>
                            <input class="form-control {{ $errors->has('nivelriesgo_residual') ? 'is-invalid' : '' }}"
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
                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.matriz-seguridad', ['id' => $id_analisis]) }}"
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

@include('admin.matrizRiesgos.scripts')
