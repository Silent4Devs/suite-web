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

    </style>

    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Escenario de Riesgo</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.matriz-seguridad.NIST.update', $matrizNist) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <p class="font-weight-bold" style="font-size:11pt;">Llene los siguientes campos según corresponda:</p>
                </div>

                <input type="hidden" value="{{ $id_analisis }}" name="id_analisis">


                <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                    Evaluacion del Riesgo
                </div>

                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="nombre"><i class="fas fa-shield-alt iconos-crear"></i>Nombre de la
                            Vulnerabilidad</label><br>
                        <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text"
                            name="nombre" id="nombre" value="{{ old('nombre', $matrizNist->nombre) }}">
                    </div>

                    <div class="form-group col-md-4 col-sm-12">
                        <label for="amenaza"><i class="fas fa-shield-alt iconos-crear"></i>Amenaza de la
                            vulnerabilidad</label><br>
                        <input class="form-control {{ $errors->has('amenaza') ? 'is-invalid' : '' }}" type="text"
                            name="amenaza" id="amenaza" value="{{ old('amenaza', $matrizNist->amenaza) }}">
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="impacto_vulnerabilidad"><i class="fas fa-shield-alt iconos-crear"></i>Impacto de la
                            Vulnerabilidad</label><br>
                        <input class="form-control {{ $errors->has('impacto_vulnerabilidad') ? 'is-invalid' : '' }}"
                            type="text" name="impacto_vulnerabilidad" id="impacto_vulnerabilidad"
                            value="{{ old('impacto_vulnerabilidad', $matrizNist->impacto_vulnerabilidad) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="aplicaciones"><i class="fas fa-fire iconos-crear"></i>Aplicaciones
                            Impactadas</label><br>
                        <input class="form-control {{ $errors->has('aplicaciones') ? 'is-invalid' : '' }}" type="text"
                            name="aplicaciones" id="aplicaciones"
                            value="{{ old('aplicaciones', $matrizNist->aplicaciones) }}">
                    </div>

                    <div class="form-group col-md-4 col-sm-12">
                        <label for="escenario"><i class="fas fa-fire iconos-crear"></i>Escenario de Riesgo</label><br>
                        <input class="form-control {{ $errors->has('escenario') ? 'is-invalid' : '' }}" type="text"
                            name="escenario" id="escenario" value="{{ old('escenario', $matrizNist->escenario) }}">
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="categoria"><i class="fas fa-fire iconos-crear"></i>Categoría del Riesgo</label><br>
                        <input class="form-control {{ $errors->has('categoria') ? 'is-invalid' : '' }}" type="text"
                            name="categoria" id="categoria" value="{{ old('categoria', $matrizNist->categoria) }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="causa"><i class="fas fa-seedling iconos-crear"></i>Causa Raíz</label><br>
                        <input class="form-control {{ $errors->has('causa') ? 'is-invalid' : '' }}" type="text"
                            name="causa" id="causa" value="{{ old('causa', $matrizNist->causa) }}">
                    </div>

                    <div class="form-group col-md-6 col-sm-12">
                        <label for="tipo"><i class="fas fa-ruler-combined iconos-crear"></i>Tipo de Riesgo</label><br>
                        <input class="form-control {{ $errors->has('tipo') ? 'is-invalid' : '' }}" type="text"
                            name="tipo" id="tipo" value="{{ old('tipo', $matrizNist->tipo) }}">
                    </div>
                </div>
                @livewire('n-i-s-t.select-impacto',['severidad'=>$matrizNist->severidad,'probabilidad'=>$matrizNist->probabilidad,'impacto'=>$matrizNist->impacto_num])

                <div class="row">
                    <div class="col-12" style="text-align: right">
                        <button type="submit" class="btn btn-danger">Editar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    @include('admin.NIST.scripts')
@endsection
