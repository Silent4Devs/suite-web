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

        span.red {
            background: red;
            border-radius: 0.8em;
            -moz-border-radius: 0.8em;
            -webkit-border-radius: 0.8em;
            color: #ffffff;
            display: inline-block;
            font-weight: bold;
            line-height: 1.6em;
            margin-right: 15px;
            text-align: center;
            width: 1.6em;
        }

    </style>

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

    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Escenario de Riesgo</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.matriz-riesgos.octave.update', $matrizOctave) }}"
                enctype="multipart/form-data">
                @csrf
                @method("PUT")
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
                            id="nombre_herramienta_puesto" value="{{ old('indicador', $matrizOctave->vp) }}">
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
                                <option
                                    {{ old('id_area', $matrizOctave->id_area) == $area->id ? ' selected="selected"' : '' }}
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
                        <label for="servicio"><i class="fas fa-handshake iconos-crear"></i>Servicio</label><br>
                        <input class="form-control {{ $errors->has('servicio') ? 'is-invalid' : '' }}" type="text"
                            name="servicio" id="servicio" value="{{ old('servicio', $matrizOctave->servicio) }}">
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
                            <option value="" selected disabled>Seleccione una opción</option>
                            @foreach ($sedes as $sede)
                                <option
                                    {{ old('id_sede', $matrizOctave->id_sede) == $sede->id ? ' selected="selected"' : '' }}
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
                                <option
                                    {{ old('id_proceso', $matrizOctave->id_proceso) == $proceso->id ? ' selected="selected"' : '' }}
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
                    @livewire('octave.select-impactos',["operacionalId"=>$matrizOctave->operacional,"cumplimientoId"=>$matrizOctave->cumplimiento,"legalId"=>$matrizOctave->legal,"reputacionalId"=>$matrizOctave->reputacional,"tecnologicoId"=>$matrizOctave->tecnologico])
                </div>
                <hr>
                <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                    ACTIVOS DE INFORMACIÓN
                </div>
                <div class="row">
                    {{-- <div class="form-group col-md-8 col-sm-12">
                        <label><i class="fas fa-file-alt iconos-crear"></i>Nombre del AI</label><br>
                        <input class="form-control {{ $errors->has('nombre_ai') ? 'is-invalid' : '' }}" type="text"
                            name="nombre_ai" id="nombre_ai_informacion" value="{{ old('nombre_ai', '') }}">
                        <small class="text-danger errores nombre_ai_error"></small>
                    </div> --}}

                    <div class="form-group col-md-4 col-sm-12">
                        <label for="nombre_ai_informacion"><i class="fas fa-project-diagram iconos-crear"></i>Nombre del AI</label><br>
                        <select class="procesoSelect form-control" name="nombre_ai_informacion" id="nombre_ai_informacion">
                            <option value="" selected disabled>Seleccione una opción</option>
                            @foreach ($nombreAis as $nombreAi)
                                <option {{ old('nombre_ai_informacion') == $nombreAi->id ? ' selected="selected"' : '' }}
                                    value="{{ $nombreAi->id }}"> {{ $nombreAi->activo_informacion }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('nombre_ai_informacion'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nombre_ai_informacion') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-sm-12 col-md-4 col-lg-4" style="margin-top:-7px;">
                        <label><i class="fab fa-cloudscale iconos-crear"></i>Valor de la criticidad del activo</label>
                        <select class="form-control select2 {{ $errors->has('valor_criticidad') ? 'is-invalid' : '' }}"
                            name="valor_criticidad" id="criticidad_informacion">
                            <option value="" selected disabled>Selecciona una opción</option>
                            <option value="1">Muy Bajo</option>
                            <option value="2">Bajo</option>
                            <option value="3">Medio</option>
                            <option value="4">Alto</option>
                            <option value="5">Crítico</option>
                        </select>
                        <small class="text-danger errores valor_critico_error"></small>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="id_dueno"><i class="fas fa-user-tie iconos-crear"></i>Dueño del Activo</label><br>
                        <select class="responsableSelect form-control" name="id_dueno" id="dueno_informacion">
                            <option value="" selected disabled>Seleccione una opción</option>
                            @foreach ($duenos as $dueno)
                                <option data-puesto="{{ $dueno->puesto }}" value="{{ $dueno->id }}"
                                    data-area="{{ $dueno->area->area }}">{{ $dueno->name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-danger errores dueno_error"></small>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="id_puesto"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                        <div class="form-control" id="dueno_id_puesto" readonly></div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="id_area"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                        <div class="form-control" id="dueno_id_area" readonly></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="id_custodio"><i class="fas fa-user-tie iconos-crear"></i>Custodio del Activo</label><br>
                        <select class="responsableSelect form-control" name="id_custodio" id="custodio_informacion">
                            <option value="" selected disabled>Seleccione una opción</option>
                            @foreach ($custodios as $custodio)
                                <option data-puesto="{{ $custodio->puesto }}" value="{{ $custodio->id }}"
                                    data-area="{{ $custodio->area->area }}">{{ $custodio->name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-danger errores custodio_error"></small>
                    </div>
                    <div class="form-group col-md-4">
                        <label><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                        <div class="form-control" id="id_custodio_puesto" readonly></div>
                    </div>
                    <div class="form-group col-md-4">
                        <label><i class="fas fa-street-view iconos-crear"></i>Área</label>
                        <div class="form-control" id="id_custodio_area" readonly></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label><i class="fas fa-box-open iconos-crear"></i>Contenedor del Activo</label><br>
                        <select class="form-control {{ $errors->has('contenedor_activos') ? 'is-invalid' : '' }}"
                            name="contenedor_activos" id="contenedor_activos_informacion">
                            <option value="" selected disabled>Selecciona una opción</option>
                            <option value="Soluciones Cloud (Google Workspace-Azure)">Soluciones Cloud (Google
                                Workspace-Azure)</option>
                            <option value="Soluciones Corporativas (Equipo de Cómputo-IPAD-Disco Externo-Gavetas)">
                                Soluciones Corporativas (Equipo de Cómputo-IPAD-Disco Externo-Gavetas)</option>
                            <option value="Base de Datos">Base de Datos</option>
                            <option value="Servidores">Servidores</option>
                            <option value="Aplicaciones Internas (Meltsan-Astro)">Aplicaciones Internas (Meltsan-Astro)
                            </option>
                            <option value="Aplicaciones Externas (CRM)">Aplicaciones Externas (CRM)</option>
                        </select>
                        <small class="text-danger errores contenedor_activo_error"></small>
                    </div>

                    <div class="form-group col-md-4 col-sm-4">
                        <label for="id_amenaza"><i class="fas fa-fire iconos-crear"></i>Amenaza</label>
                        <select class="procesoSelect form-control" name="id_amenaza" id="amenaza_informacion">
                            <option value="" selected disabled>Seleccione una opción</option>
                            @foreach ($amenazas as $amenaza)
                                <option {{ old('id_amenaza') == $amenaza->id ? ' selected="selected"' : '' }}
                                    value="{{ $amenaza->id }}">{{ $amenaza->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-danger errores amenaza_error"></small>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="id_vulnerabilidad"><i class="fas fa-shield-alt iconos-crear"></i>Vulnerabilidad</label>
                        <select class="procesoSelect form-control" name="id_vulnerabilidad" id="vulnerabilidad_informacion">
                            <option value="" selected disabled>Seleccione una opción</option>
                            @foreach ($vulnerabilidades as $vulnerabilidad)
                                <option
                                    {{ old('id_vulnerabilidad') == $vulnerabilidad->id ? ' selected="selected"' : '' }}
                                    value="{{ $vulnerabilidad->id }}">{{ $vulnerabilidad->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-danger errores vulnerabilidad_error"></small>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12 col-sm-12">
                        <label><i class="fas fa-camera-retro iconos-crear"></i>Escenario de Riesgo</label><br>
                        <textarea class="form-control {{ $errors->has('escenario_riesgo') ? 'is-invalid' : '' }}"
                            type="text" name="escenario_riesgo"
                            id="escenario_riesgo_informacion">{{ old('escenario_riesgo', '') }}</textarea>
                    </div>
                    <small class="text-danger errores escenario_riesgo_error"></small>
                </div>
                {{-- COMPONENTE PARA EVALUACION DE RIESGOS --}}
                @livewire('octave.select-evaluacion-riesgos',['impactoOb'=>$matrizOctave->valor])
                {{-- FIN COMPONENTE PARA EVALUACION DE RIESGOS --}}
                <div class="mb-3 ml-3 col-12 mt-4 text-right">
                    <button type="button" name="btn-suscribir-activos_info" id="btn-suscribir-activos_info"
                        class="btn btn-success">Agregar</button>
                </div>
                <div class="mt-3 mb-4 col-12 w-100 datatable-fix p-0">
                    <table class="scroll_estilo table table-responsive" id="activos_info_table" style="width:100%">
                        <thead>
                            <tr class="negras">
                                <th class="text-center" style="background-color:#3490DC;" colspan="8">Descripción
                                    General
                                </th>
                                <th class="text-center" style="background-color:#1168af;" colspan="3">Evaluación del
                                    Escenario</th>
                                <th class="text-center" style="background-color:#3490DC;" colspan="1">Evaluación del
                                    Riesgo</th>
                                <th class="text-center" style="background-color:#1168af;" colspan="1">Opciones</th>
                            </tr>
                            <tr>
                                <th style="min-width:300px;">Activos del AI</th>
                                <th style="min-width:300px;">Valor de criticidad del activo</th>
                                <th style="min-width:300px;">Dueño del Activo</th>
                                <th style="min-width:300px;">Custodio del Activo</th>
                                <th style="min-width:300px;">Contenedor del activo</th>
                                <th style="min-width:300px;">Escenario de Riesgo</th>
                                <th style="min-width:300px;">Amenazas</th>
                                <th style="min-width:300px;">Vulnerabilidades</th>
                                <th style="min-width:300px;">Confidencialidad</th>
                                <th style="min-width:300px;">Disponibilidad</th>
                                <th style="min-width:300px;">Integridad</th>
                                <th style="min-width:300px;">Evaluación del Riesgo</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="contenedor_informacion">

                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.matriz-seguridad.octaveIndex', ['id' => $id_analisis]) }}"
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
@include('admin.OCTAVE.scripts')
