<div>
    <style>
        .alerta-error {
            font-size: 13px;
            padding: 5px;
            background: #3451837a;
            border: 2px solid #345183;
            color: #353535;
            border-radius: 5px;
        }

        /* The container */
        .container-check {
            display: block;
            position: relative;
            padding-left: 24px;
            padding-top: 2px;
            margin-bottom: 0px;
            cursor: pointer;
            font-size: 11px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox */
        .container-check input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #f9f9f9;
            border: 1px solid #345183;
        }

        /* On mouse-over, add a grey background color */
        .container-check:hover input~.checkmark {
            background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .container-check input:checked~.checkmark {
            background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .container-check input:checked~.checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .container-check .checkmark:after {
            left: 6px;
            top: 1px;
            width: 7px;
            height: 13px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }
    </style>
    <style>
        article {
            position: relative;
            width: 160px;
            height: 120px;
            margin: 5px;
            float: left;
            border: 2px solid #345183;
            box-sizing: border-box;
            border-radius: 10px;
        }

        article div {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            line-height: 25px;
            transition: .3s ease;
        }

        article input[type="checkbox"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 160px;
            height: 120px;
            opacity: 0;
            /* cursor: pointer; */
        }

        article input[type="number"] {
            position: absolute;
            bottom: 5px;
            left: 24px;
            width: 65px;
            height: 20px;
            outline: none;
            background: white;
            border: none;
            border-bottom: 1px solid rgb(32, 32, 32);
            color: black;
            text-align: center;
        }

        input[type=checkbox]:checked~div {
            color: #ffffff;
            background: #345183;
            border-radius: 7px;
            border: none;
            /* box-shadow: 5px 5px 5px 0px #004d4d; */
        }

        input[type=checkbox]:checked~input[type=number] {
            border-bottom: 2px solid rgb(78 230 236);
            color: #ffffff;
            background: #345183;
            text-align: center;
        }

        .silent-color {
            color: #289aaa;
            font-weight: bold;
        }

        .gray-color {
            color: #555;
        }

        .icono-card-evaluadores {
            text-align: center;
            font-size: 28pt;
        }

        .disableEvents {
            pointer-events: none;
        }
    </style>
    <style>
        .card {
            border: none;
            position: relative
        }

        #progressbar {
            margin-top: 30px;
            overflow: hidden;
            color: lightgrey;
            padding: 0;
        }

        #progressbar .active {
            z-index: 1;
            color: #345183;
        }

        #progressbar li {
            list-style-type: none;
            font-size: 15px;
            width: 20%;
            float: left;
            position: relative;
            font-weight: 400;
            text-align: center;
        }

        #progressbar #createEvaluacion:before {
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            content: "\f02d"
        }

        #progressbar #publicoObjetivo:before {
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            content: "\f007";
        }

        #progressbar #evaluadores:before {
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            content: "\f470"
        }

        #progressbar #periodosCircle:before {
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            content: "\f073"
        }

        #progressbar #finalizarEvaluacion:before {
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            content: "\f00c"
        }

        #progressbar li:before {
            width: 50px;
            height: 50px;
            line-height: 45px;
            display: block;
            font-size: 20px;
            color: #ffffff;
            background: lightgray;
            border-radius: 50%;
            margin: 0 auto 10px auto;
            padding: 2px
        }

        #progressbar li:after {
            content: '';
            width: 100%;
            height: 2px;
            background: lightgray;
            position: absolute;
            left: 0;
            top: 25px;
            z-index: 0;
        }

        #progressbar li.active:before,
        #progressbar li.active:after {
            background: #345183;
            z-index: -1;
        }

        .progress {
            height: 20px
        }

        .progress-bar {
            background-color: #345183;
        }

        .head {
            text-transform: capitalize;
            color: #345183;
            font-weight: normal
        }

        .iconos-evaluacion {
            color: #3e3e3e;
            font-size: 16px;
        }

        .fit-image {
            width: 100%;
            object-fit: cover
        }

        .display-almacenando {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 2;
            margin-left: -15px;
            background: #0000000d;
            align-items: center;
            justify-content: center;
            text-align: center;
            top: 0;
        }

        .display-almacenando h1 {
            font-size: 50px;
        }

        .display-almacenando p {
            font-size: 30px;
        }
    </style>
    <style>
        .lds-facebook {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }

        .lds-facebook div {
            display: inline-block;
            position: absolute;
            left: 8px;
            width: 16px;
            background: rgb(24, 24, 24);
            animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
        }

        .lds-facebook div:nth-child(1) {
            left: 8px;
            animation-delay: -0.24s;
        }

        .lds-facebook div:nth-child(2) {
            left: 32px;
            animation-delay: -0.12s;
        }

        .lds-facebook div:nth-child(3) {
            left: 56px;
            animation-delay: 0;
        }

        @keyframes lds-facebook {
            0% {
                top: 8px;
                height: 64px;
            }

            50%,
            100% {
                top: 24px;
                height: 32px;
            }
        }
    </style>
    <style>
        /* The container */
        .container-check {
            display: block;
            position: relative;
            padding-left: 33px;
            margin-bottom: 11px;
            cursor: pointer;
            font-size: 14px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox */
        .container-check input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 23px;
            width: 23px;
            background-color: #eee;
        }

        /* On mouse-over, add a grey background color */
        .container-check:hover input~.checkmark {
            background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .container-check input:checked~.checkmark {
            background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .container-check input:checked~.checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .container-check .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }
    </style>
    <div class="container row justify-content-center">
        <div class="mt-3 col-12" style="position: relative;">
            <form wire:submit.prevent="register">
                {{-- STEP 1 --}}
                @if ($currentStep == 1)
                    <div class="step-one">
                        <div>
                            <ul id="progressbar">
                                <li class="active" id="createEvaluacion"><strong>Configuración</strong></li>
                                <li id="publicoObjetivo"><strong>Público Objetivo</strong></li>
                                <li id="evaluadores"><strong>Evaluadores</strong></li>
                                <li id="periodosCircle"><strong>Períodos</strong></li>
                                <li id="finalizarEvaluacion"><strong>Finalizar</strong></li>
                            </ul>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 25%"></div>
                            </div>
                            <div class="card-body">
                                {{-- <h4 class="head">Configura tu evaluación</h4> --}}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="px-1 py-2 mb-3 rounded shadow-sm"
                                            style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                                            <div class="row w-100">
                                                <div
                                                    class="text-center col-1 align-items-center d-flex justify-content-center">
                                                    <div class="w-100">
                                                        <i class="fas fa-info-circle"
                                                            style="color: #3B82F6; font-size: 22px"></i>
                                                    </div>
                                                </div>
                                                <div class="col-11">
                                                    <p class="m-0"
                                                        style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                                                        Instrucciones</p>
                                                    <p class="m-0" style="font-size: 14px; color:#1E3A8A ">
                                                        Empieza
                                                        configurando tu evaluación, definiendo el nombre y agregando
                                                        una
                                                        descripción

                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-12 col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="nombre">
                                                <i class="mr-1 fas fa-user-circle iconos-crear"></i> Nombre <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="text" wire:model.defer="nombre"
                                                class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                                                id="nombre" aria-describedby="nombreHelp" name="nombre"
                                                maxlength="250" value="{{ old('nombre') }}">
                                            <small id="nombreHelp" class="form-text text-muted">Ingresa el nombre de la
                                                evaluación</small>
                                            @if ($errors->has('nombre'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('nombre') }}
                                                </div>
                                            @endif
                                            <span class="errors nombre_error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-12 col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="descripcion">
                                                <i class="mr-1 fas fa-file-signature iconos-crear"></i> Descripción
                                            </label>
                                            <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion" id=""
                                                cols="1" wire:model.defer="descripcion" rows="1">{{ old('descripcion') }}</textarea>
                                            <small id="descripcionHelp" class="form-text text-muted">Ingresa la
                                                descripción de la evaluación</small>
                                            @if ($errors->has('descripcion'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('descripcion') }}
                                                </div>
                                            @endif
                                            <span class="errors descripcion_error text-danger"></span>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="col-sm-12 col-lg-12 col-md-12 col-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-5">
                                                    <label for="">
                                                        <i class="mr-2 iconos-crear fas fa-question-circle"></i>
                                                        ¿Qué
                                                        desea evaluar?
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                </div>
                                                @if ($showPesoGeneralCompetencias || $showPesoGeneralObjetivos)
                                                    <div class="col-7">
                                                        <label for="pesoGeneralCompetencias"><i
                                                                class="mr-2 iconos-crear fas fa-question-circle"></i>Peso
                                                            General (0-100%)<span class="text-danger">*</span></label>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="mt-3 row align-items-center">
                                                <div class="col-5">
                                                    <div style="margin-top: 8px;">
                                                        <label class="mr-4 container-check">Competencias
                                                            @if ($errors->has('includeCompetencias'))
                                                                <small class="text-danger">
                                                                    ({{ $errors->first('includeCompetencias') }})
                                                                </small>
                                                            @endif
                                                            {{-- Evaluación de Desempeño Jun-Dic 2021 --}}
                                                            {{-- Evaluación de desempeño realizada en el segundo periodo del año 2021 para los empleados de S4B sede Torre Murano. --}}
                                                            <input type="checkbox" type="checkbox"
                                                                wire:model.lazy="includeCompetencias"
                                                                wire:change.prevent="$set('showPesoGeneralCompetencias',{{ !$showPesoGeneralCompetencias }})">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-7 {{ $showPesoGeneralCompetencias ? '' : 'd-none' }}"
                                                    style="position: relative;">
                                                    <input style="width: 120px;text-align: center;padding-right: 20px;"
                                                        wire:model.defer="pesoGeneralCompetencias"
                                                        id="pesoGeneralCompetencias" class="form-control" type="text"
                                                        pattern="[0-9]*"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                                        min="0" max="100">
                                                    <span style="position: absolute;top: 8px;left: 80px;">%</span>
                                                </div>
                                            </div>
                                            <div class="mt-3 row align-items-center">
                                                <div class="col-5">
                                                    <div style="margin-top: 8px;">
                                                        <label class="container-check">Objetivos
                                                            @if ($errors->has('includeObjetivos'))
                                                                <small class="text-danger">
                                                                    ({{ $errors->first('includeObjetivos') }})
                                                                </small>
                                                            @endif
                                                            <input type="checkbox" wire:model.lazy="includeObjetivos"
                                                                class="form-check-input" type="checkbox"
                                                                wire:change.prevent="$set('showPesoGeneralObjetivos',{{ !$showPesoGeneralObjetivos }})">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-3 {{ $showPesoGeneralObjetivos ? '' : 'd-none' }}">
                                                    <input style="width: 120px;text-align: center;padding-right: 20px;"
                                                        wire:model.defer="pesoGeneralObjetivos"
                                                        id="pesoGeneralOnjetivos" class="form-control" type="text"
                                                        pattern="[0-9]*"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                                        min="0" max="100">
                                                    <span style="position: absolute;top: 8px;left: 80px;">%</span>
                                                </div>
                                                <div class="col-4 {{ $showPesoGeneralObjetivos ? '' : 'd-none' }}">
                                                    <select class="form-control" name="catalogoObjetivos"
                                                        id="catalogoObjetivos" wire:model.defer="catalogoObjetivos">
                                                        <option value="" selected>Seleccione el Catalogo
                                                            de
                                                            Parametros que utilizara la Evaluacion</option>
                                                        @foreach ($catalogo_rangos_objetivos as $c)
                                                            <option value="{{ $c->id }}">
                                                                {{ $c->nombre_catalogo }}</option>
                                                        @endforeach
                                                        @if ($errors->has('catalogoObjetivos'))
                                                            <small class="text-danger">
                                                                ({{ $errors->first('catalogoObjetivos') }})
                                                            </small>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('sumaTotalPesoGeneral'))
                                            <p style="font-size:12px;" class="m-0 text-center text-danger">
                                                {{ $errors->first('sumaTotalPesoGeneral') }}
                                            </p>
                                        @endif
                                    </div>
                                    {{-- @if ($showContentTable)
                                        <div class="col-sm-12 col-lg-12 col-md-12 col-12">
                                            <label for="descripcion">
                                                <i class="mr-2 fab fa-discourse iconos-evaluacion"></i>
                                                Selecciona las competencias a evaluar
                                            </label>
                                            <div>
                                                <div class="mb-3 row">
                                                    <div class="col-8">
                                                        <input class="form-control" type="text" wire:model="search"
                                                            placeholder="Buscar competencia...">
                                                    </div>
                                                    <div class="col-4">
                                                        <select wire:model="filter" class="form-control">
                                                            @foreach ($tipos as $tipo)
                                                                <option value="{{ $tipo->id }}">
                                                                    {{ $tipo->nombre }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                @if ($competencias->isNotEmpty())
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th>Competencia</th>
                                                                <th>Tipo</th>
                                                                <th>Descripción</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($competencias as $competencia)
                                                                <tr>
                                                                    <th scope="row"><input wire:model.prevent="selected"
                                                                            value="{{ $competencia->id }}"
                                                                            type="checkbox">
                                                                    </th>
                                                                    <td>{{ $competencia->nombre }}</td>
                                                                    <td>{{ $competencia->tipo->nombre }}</td>
                                                                    <td>{{ $competencia->descripcion }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    @if ($errors->has('selected'))
                                                        <small
                                                            class="text-danger">{{ $errors->first('selected') }}</small>
                                                    @endif
                                                    {!! $competencias->links() !!}
                                                @else
                                                    <p class="text-center "><i
                                                            class="mr-2 fas fa-exclamation-triangle"></i>Opps...
                                                        No hemos
                                                        encontrado ninguna
                                                        competencia</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endif --}}

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- STEP 2 --}}
                @if ($currentStep == 2)
                    <div class="step-two">
                        <div>
                            <ul id="progressbar">
                                <li id="createEvaluacion"><strong>Configuración</strong></li>
                                <li class="active" id="publicoObjetivo"><strong>Público Objetivo</strong></li>
                                <li id="evaluadores"><strong>Evaluadores</strong></li>
                                <li id="periodosCircle"><strong>Períodos</strong></li>
                                <li id="finalizarEvaluacion"><strong>Finalizar</strong></li>
                            </ul>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated"
                                    role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                                </div>
                            </div>
                            <div class="card-body">
                                {{-- <h4 class="head">Selecciona tu público objetivo</h4> --}}
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-12">
                                        <div class="px-1 py-2 mb-3 rounded shadow-sm"
                                            style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                                            <div class="row w-100">
                                                <div
                                                    class="text-center col-1 align-items-center d-flex justify-content-center">
                                                    <div class="w-100">
                                                        <i class="fas fa-info-circle"
                                                            style="color: #3B82F6; font-size: 22px"></i>
                                                    </div>
                                                </div>
                                                <div class="col-11">
                                                    <p class="m-0"
                                                        style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                                                        Instrucciones</p>
                                                    <p class="m-0" style="font-size: 14px; color:#1E3A8A ">
                                                        Ahora es tiempo de elegir a los empleados a evaluar.
                                                        Puedes seleccionar a toda la
                                                        organización, áreas en específico, grupos creados o selección
                                                        manual por
                                                        empleados.
                                                        {{-- también tienes la posibilidad de crear tus grupos de evaluación
                                                        para utilizarlos posteriormente. --}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row justify-content-center align-items-center">
                                            <div class="col-9">
                                                {{-- <p class="text-muted"><i class="fas fa-info-circle"></i> Seleccionar
                                                    Evaluados
                                                </p> --}}
                                                <label class="mb-0" for="descripcion">
                                                    <i class="fas fa-users iconos-crear"></i> Público objetivo <small
                                                        class="text-danger">*</small>
                                                </label>
                                                <select
                                                    class="mt-2 form-control {{ $errors->has('evaluados_objetivo') ? 'is-invalid' : '' }}"
                                                    wire:model.lazy="evaluados_objetivo" id="evaluados_objetivo"
                                                    name="evaluados_objetivo"
                                                    wire:change="habilitarSelectAlternativo()">
                                                    <option value="" selected>-- Seleciona una opción --</option>
                                                    {{--  <option value="all">Toda la empresa</option>  --}}
                                                    <option value="area">Por Área</option>
                                                    @foreach ($grupos_evaluados as $grupo)
                                                        <option value="{{ $grupo->id }}">{{ $grupo->nombre }} -
                                                            Grupo
                                                        </option>
                                                    @endforeach
                                                    <option value="manual">Manualmente</option>
                                                </select>
                                                @if ($errors->has('evaluados_objetivo'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('evaluados_objetivo') }}
                                                    </div>
                                                @endif
                                                <span class="errors evaluados_manual_error text-danger"></span>
                                                <small id="evaluadosQuestionHelp"
                                                    class="form-text text-muted">Selecciona a
                                                    quien(es)
                                                    va dirigida la
                                                    evaluación</small>
                                                @if ($habilitarSelectAreas)
                                                    <select
                                                        class="mt-3 form-control {{ $errors->has('by_area') ? 'is-invalid' : '' }}"
                                                        id="by_area" wire:model.defer="by_area">
                                                        <option value="" selected>-- Seleciona el área a evaluar
                                                            --
                                                        </option>
                                                        @foreach ($areas as $area)
                                                            <option value="{{ $area->id }}">{{ $area->area }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('by_area'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('by_area') }}
                                                        </div>
                                                    @endif
                                                @endif
                                                @if ($habilitarSelectManual)
                                                    <label class="m-0 mt-2" for="">Selecciona a los empleados
                                                        a
                                                        evaluar</label>
                                                    <select
                                                        class="mt-3 form-control {{ $errors->has('by_manual') ? 'is-invalid' : '' }}"
                                                        multiple id="by_manual" wire:model.defer="by_manual">
                                                        @foreach ($empleados as $empleado)
                                                            <option value="{{ $empleado->id }}">
                                                                {{ $empleado->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('by_manual'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('by_manual') }}
                                                        </div>
                                                    @endif
                                                    <small class="form-text text-muted">Importante: No se creará un
                                                        nuevo grupo,esta opción es recomendada para selecciones de una
                                                        sola vez</small>
                                                @endif
                                            </div>
                                            <div class="col-3" style="margin-top: 0;">
                                                @livewire('ev360-grupo-evaluados-create')
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- STEP 3 --}}
                @if ($currentStep == 3)
                    <div class="step-three">
                        <div>
                            <ul id="progressbar">
                                <li id="createEvaluacion"><strong>Configuración</strong></li>
                                <li id="publicoObjetivo"><strong>Público Objetivo</strong></li>
                                <li class="active" id="evaluadores"><strong>Evaluadores</strong></li>
                                <li id="periodosCircle"><strong>Períodos</strong></li>
                                <li id="finalizarEvaluacion"><strong>Finalizar</strong></li>
                            </ul>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated"
                                    role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="px-1 py-2 mb-3 rounded shadow-sm"
                                    style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                                    <div class="row w-100">
                                        <div
                                            class="text-center col-1 align-items-center d-flex justify-content-center">
                                            <div class="w-100">
                                                <i class="fas fa-info-circle"
                                                    style="color: #3B82F6; font-size: 22px"></i>
                                            </div>
                                        </div>
                                        <div class="col-11">
                                            <p class="m-0"
                                                style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                                                Instrucciones</p>
                                            <p class="m-0" style="font-size: 14px; color:#1E3A8A ">
                                                Ahora define el peso porcentual de cada evaluador, repartiendo el 100%
                                                entre todos ellos.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @if ($errors->has('sumaTotalPeso'))
                                    <p class="m-0 text-center alerta-error">
                                        {{ $errors->first('sumaTotalPeso') }}
                                    </p>
                                @endif

                                <!-- Evaluators checkboxes and inputs -->
                                <section class="mt-4 row justify-content-center">
                                    <div class="col-8" wire:loading.class="disableEvents">
                                        <article class="ml-5 feature1">
                                            <input readonly disabled type="checkbox"
                                                wire:change="restarGrados('jefe_inmediato')"
                                                wire:model.lazy="evaluado_por_jefe" wire:target="evaluado_por_jefe"
                                                id="feature1" wire:loading.attr="readonly" />
                                            <div>
                                                <span class="text-center">
                                                    <span class="icono-card-evaluadores"><i
                                                            class="fas fa-user-tie"></i></span>
                                                    <br>
                                                    Jefe Inmediato
                                                    <br>
                                                    @if ($errors->has('evaluado_por_jefe'))
                                                        <small style="font-size:9px;"
                                                            class="text-danger">{{ $errors->first('evaluado_por_jefe') }}</small>
                                                    @endif
                                                </span>
                                            </div>
                                            @if ($evaluado_por_jefe)
                                                <input class="ml-4" wire:model.defer="pesoEvaluacionJefe"
                                                    type="number" placeholder="Define peso..." max="100"
                                                    min="0">
                                                <span
                                                    style="position: absolute;top: 89px;color: white;left: 83px;">%</span>
                                                @if ($errors->has('pesoEvaluacionJefe'))
                                                    <small style="font-size:9px;"
                                                        class="text-danger">{{ $errors->first('pesoEvaluacionJefe') }}</small>
                                                @endif
                                            @endif

                                        </article>

                                        <article class="feature2">
                                            <input readonly disabled type="checkbox"
                                                wire:change="restarGrados('misma_area')"
                                                wire:model.lazy="evaluado_por_misma_area" id="feature2"
                                                wire:target="evaluado_por_misma_area" wire:loading.attr="readonly" />
                                            <div>
                                                <div>
                                                    <span class="text-center">
                                                        <span class="icono-card-evaluadores"><i
                                                                class="fas fa-user-friends"></i></span>
                                                        <br>
                                                        Par
                                                        <br>
                                                        @if ($errors->has('evaluado_por_misma_area'))
                                                            <small style="font-size:9px;"
                                                                class="text-danger">{{ $errors->first('evaluado_por_misma_area') }}</small>
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            @if ($evaluado_por_misma_area)
                                                <input class="ml-4" wire:model.defer="pesoEvaluacionArea"
                                                    type="number" placeholder="Define peso..." max="100"
                                                    min="0">
                                                <span
                                                    style="position: absolute;top: 89px;color: white;left: 83px;">%</span>
                                                @if ($errors->has('pesoEvaluacionArea'))
                                                    <small style="font-size:9px;"
                                                        class="text-danger">{{ $errors->first('pesoEvaluacionArea') }}</small>
                                                @endif
                                            @endif
                                        </article>

                                        <article class="mt-4 ml-5 feature3">
                                            <input readonly disabled type="checkbox"
                                                wire:change="restarGrados('equipo_a_cargo')"
                                                wire:model.lazy="evaluado_por_equipo_a_cargo" id="feature3"
                                                wire:target="evaluado_por_equipo_a_cargo"
                                                wire:loading.attr="readonly" />
                                            <div>
                                                <span class="text-center">
                                                    <span class="icono-card-evaluadores"><i
                                                            class="fas fa-users"></i></span>
                                                    <br>
                                                    Subordinado
                                                    <br>
                                                    @if ($errors->has('evaluado_por_equipo_a_cargo'))
                                                        <small style="font-size:9px;"
                                                            class="text-danger">{{ $errors->first('evaluado_por_equipo_a_cargo') }}</small>
                                                    @endif
                                                </span>
                                            </div>
                                            @if ($evaluado_por_equipo_a_cargo)
                                                <input class="ml-4" wire:model.defer="pesoEvaluacionEquipo"
                                                    type="number" placeholder="Define peso..." max="100"
                                                    min="0">
                                                <span
                                                    style="position: absolute;top: 89px;color: white;left: 83px;">%</span>
                                                @if ($errors->has('pesoEvaluacionEquipo'))
                                                    <small style="font-size:9px;"
                                                        class="text-danger">{{ $errors->first('pesoEvaluacionEquipo') }}</small>
                                                @endif
                                            @endif
                                        </article>

                                        <article class="mt-4 feature4">
                                            <input readonly disabled type="checkbox"
                                                wire:change="restarGrados('autoevaluacion')"
                                                wire:model.lazy="autoevaluacion" id="feature4"
                                                wire:target="autoevaluacion" wire:loading.attr="readonly" />
                                            <div>
                                                <span class="text-center">
                                                    <span class="icono-card-evaluadores"><i
                                                            class="fas fa-user"></i></span>
                                                    <br>
                                                    Autoevaluación
                                                    <br>
                                                    @if ($errors->has('autoevaluacion'))
                                                        <small style="font-size:9px;"
                                                            class="text-danger">{{ $errors->first('autoevaluacion') }}</small>
                                                    @endif
                                                </span>
                                            </div>
                                            @if ($autoevaluacion)
                                                <input class="ml-4" wire:model.defer="pesoAutoevaluacion"
                                                    type="number" placeholder="Define peso..." max="100"
                                                    min="0">
                                                <span
                                                    style="position: absolute;top: 89px;color: white;left: 83px;">%</span>
                                                @if ($errors->has('pesoAutoevaluacion'))
                                                    <small style="font-size:9px;"
                                                        class="text-danger">{{ $errors->first('pesoAutoevaluacion') }}</small>
                                                @endif
                                            @endif
                                        </article>
                                    </div>
                                </section>
                                <div class="mt-3 text-center">
                                    <h3>
                                        Evaluación <span class="silent-color">{{ $typeEvaluation }}°</span>
                                        <h1> {{ $time_elapsed_secs }}</h1>
                                    </h3>
                                </div>

                            </div>
                            <div class="datatable-fix w-100">

                                <table class="table">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th>Evaluado</th>
                                            <th>Área</th>
                                            <th>Autoevaluación</th>
                                            <th>Jefe Inmediato</th>
                                            <th>Pares</th>
                                            <th>Subordinado</th>
                                            {{-- <th>Equipo a cargo</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listaEvaluados as $index => $listaEvaluado)
                                            <tr>
                                                <td style="text-align: left !important;">
                                                    {{ $listaEvaluado['evaluado']['name'] }}</td>
                                                <td style="text-align: left !important;">
                                                    {{ $listaEvaluado['evaluado']['area']['area'] }}</td>
                                                @isset($listaEvaluado['evaluadores']['autoevaluacion'])
                                                    <td style="text-align: left !important;">
                                                        {{-- <p>{{$listaEvaluado['evaluadores']['autoevaluacion']['id']}}</p> --}}
                                                        <select name="" id="" class="form-control"
                                                            wire:model.defer="listaEvaluados.{{ $index }}.evaluadores.autoevaluacion.id"
                                                            style="pointer-events: none; -webkit-appearance: none;">
                                                            <option value="" selected>Selecciona un evaluador
                                                            </option>
                                                            @foreach ($empleados as $empleado)
                                                                <option value="{{ $empleado->id }}">
                                                                    {{ $empleado->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('listaEvaluados.{{ $index }}.evaluadores.0.id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                @else
                                                    <td style="text-align: left !important;">
                                                        {{-- <p>{{$listaEvaluado['evaluadores']['autoevaluacion']['id']}}</p> --}}
                                                        <select name="" id="" class="form-control"
                                                            wire:model.defer="listaEvaluados.{{ $index }}.evaluadores.autoevaluacion.id"
                                                            style="pointer-events: none; -webkit-appearance: none;">
                                                            <option value="" selected>Selecciona un evaluador
                                                            </option>
                                                            @foreach ($empleados as $empleado)
                                                                <option value="{{ $empleado->id }}">
                                                                    {{ $empleado->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('listaEvaluados.{{ $index }}.evaluadores.0.id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                @endisset
                                                @isset($listaEvaluado['evaluadores']['jefe'])
                                                    <td style="text-align: left !important;">
                                                        {{-- <p>{{$listaEvaluado['evaluadores']['jefe']['id']}}</p> --}}
                                                        <select name="" id="" class="form-control"
                                                            wire:model.defer="listaEvaluados.{{ $index }}.evaluadores.jefe.id">
                                                            {{-- <option value="" selected>Selecciona un evaluador</option> --}}
                                                            @foreach ($empleados as $empleado)
                                                                <option value="{{ $empleado->id }}">
                                                                    {{ $empleado->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('listaEvaluados.{{ $index }}.evaluadores.1.id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                @else
                                                    <td style="text-align: left !important;">
                                                        {{-- <p>{{$listaEvaluado['evaluadores']['jefe']['id']}}</p> --}}
                                                        <select name="" id="" class="form-control"
                                                            wire:model.defer="listaEvaluados.{{ $index }}.evaluadores.jefe.id">
                                                            {{-- <option value="" selected>Selecciona un evaluador</option> --}}
                                                            @foreach ($empleados as $empleado)
                                                                <option value="{{ $empleado->id }}">
                                                                    {{ $empleado->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('listaEvaluados.{{ $index }}.evaluadores.1.id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                @endisset
                                                @isset($listaEvaluado['evaluadores']['par'])
                                                    <td style="text-align: left !important;">
                                                        {{-- <p>{{$listaEvaluado['evaluadores']['par']['id']}}</p> --}}
                                                        <select name="" id="" class="form-control"
                                                            wire:model.defer="listaEvaluados.{{ $index }}.evaluadores.par.id">
                                                            {{-- <option value="" selected>Selecciona un evaluador</option> --}}
                                                            @foreach ($empleados as $empleado)
                                                                <option value="{{ $empleado->id }}">
                                                                    {{ $empleado->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('listaEvaluados.{{ $index }}.evaluadores.2.id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                @else
                                                    <td style="text-align: left !important;">
                                                        {{-- <p>{{$listaEvaluado['evaluadores']['par']['id']}}</p> --}}
                                                        <select name="" id="" class="form-control"
                                                            wire:model.defer="listaEvaluados.{{ $index }}.evaluadores.par.id">
                                                            <option value="" selected>Selecciona un evaluador
                                                            </option>
                                                            @foreach ($empleados as $empleado)
                                                                <option value="{{ $empleado->id }}">
                                                                    {{ $empleado->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('listaEvaluados.{{ $index }}.evaluadores.2.id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                @endisset
                                                @isset($listaEvaluado['evaluadores']['subordinado'])
                                                    <td style="text-align: left !important;">
                                                        {{-- <p>{{$listaEvaluado['evaluadores']['subordinado']['id']}}</p> --}}
                                                        <select name="" id="" class="form-control"
                                                            wire:model.defer="listaEvaluados.{{ $index }}.evaluadores.subordinado.id">
                                                            <option value="" selected>Selecciona un evaluador
                                                            </option>
                                                            @foreach ($empleados as $empleado)
                                                                <option value="{{ $empleado->id }}">
                                                                    {{ $empleado->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('listaEvaluados.{{ $index }}.evaluadores.3.id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                @else
                                                    <td style="text-align: left !important;">
                                                        {{-- <p>{{$listaEvaluado['evaluadores']['subordinado']['id']}}</p> --}}
                                                        <select name="" id="" class="form-control"
                                                            wire:model.defer="listaEvaluados.{{ $index }}.evaluadores.subordinado.id">
                                                            <option value="" selected>Selecciona un evaluador
                                                            </option>
                                                            @foreach ($empleados as $empleado)
                                                                <option value="{{ $empleado->id }}">
                                                                    {{ $empleado->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('listaEvaluados.{{ $index }}.evaluadores.3.id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                @endisset
                                                {{-- @foreach ($listaEvaluado['evaluadores'] as $evaluador)
                                                    {{count($listaEvaluado['evaluadores'])}}
                                                    @if (array_key_exists('tipo', $evaluador))
                                                        @if ($evaluador['tipo'] == 0)
                                                            <td style="text-align: left !important;">
                                                                    {{$evaluador['empleado']->name}}
                                                            </td>
                                                        @endif

                                                        @if ($evaluador['tipo'] == 1)
                                                            <td style="text-align: left !important;">
                                                                    {{$evaluador['empleado']->name}}
                                                            </td>
                                                        @endif

                                                        @if ($evaluador['tipo'] == 2)
                                                            <td style="text-align: left !important;">
                                                                    {{$evaluador['empleado']->name}}
                                                            </td>
                                                        @endif
                                                        @if ($evaluador['tipo'] == 3)
                                                            <td style="text-align: left !important;">
                                                                {{$evaluador['empleado']->name}}
                                                            </td>

                                                        @endif
                                                    @else
                                                        <td style="text-align: left !important;">
                                                            no tiene evaluador
                                                        </td>
                                                    @endif
                                                @endforeach --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- STEP 4 --}}
                @if ($currentStep == 4)
                    <div class="step-four">
                        <div>
                            <ul id="progressbar">
                                <li id="createEvaluacion"><strong>Configuración</strong></li>
                                <li id="publicoObjetivo"><strong>Público Objetivo</strong></li>
                                <li id="evaluadores"><strong>Evaluadores</strong></li>
                                <li class="active" id="periodosCircle"><strong>Períodos</strong></li>
                                <li id="finalizarEvaluacion"><strong>Finalizar</strong></li>
                            </ul>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated"
                                    role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
                                </div>
                            </div>
                            <div class="card-body">
                                {{-- <h4 class="head">Selecciona los periodos a evaluar</h4>
                                <p class="m-0 text-muted"><i class="fas fa-info-circle"></i>
                                    Define los periodos que requieras para la evaluación
                                </p> --}}
                                @if ($hayEmpleadosSinCompetencias)
                                    <div class="alert alert-danger" role="alert">
                                        Existen {{ $totalEmpleadosSinCompetencias }} empleados que no contienen
                                        competencias
                                        <ul>
                                            @foreach ($listaEmpleadosSinCompetencias as $eSinCompetencias)
                                                <li>{{ $eSinCompetencias }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="px-1 py-2 mb-3 rounded shadow-sm"
                                    style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                                    <div class="row w-100">
                                        <div
                                            class="text-center col-1 align-items-center d-flex justify-content-center">
                                            <div class="w-100">
                                                <i class="fas fa-info-circle"
                                                    style="color: #3B82F6; font-size: 22px"></i>
                                            </div>
                                        </div>
                                        <div class="col-11">
                                            <p class="m-0"
                                                style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                                                Instrucciones</p>
                                            <p class="m-0" style="font-size: 14px; color:#1E3A8A ">
                                                Por último, define el número de veces que se aplicará la evaluación y el
                                                periodo
                                                en el que se ejecutará.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($periodos as $idx => $periodo)
                                    <div class="mt-4 row align-items-center">
                                        <div class="pr-0 col-4">
                                            <span><i class="mr-2 fas fa-calendar-day"></i>Fecha de evaluación
                                                <strong>{{ $idx + 1 }}</strong></span>
                                        </div>
                                        <div class="pl-0 col-3">
                                            <p class="m-0 text-muted">Fecha Inicio</p>
                                            <input class="form-control" type="date"
                                                wire:model.defer="periodos.{{ $idx }}.fecha_inicio"
                                                value="{{ $periodo['fecha_inicio'] }}">
                                        </div>
                                        <div class="pl-0 col-3">
                                            <p class="m-0 text-muted">Fecha Fin</p>
                                            <input class="form-control" type="date"
                                                wire:model.defer="periodos.{{ $idx }}.fecha_fin"
                                                value="{{ $periodo['fecha_fin'] }}">
                                        </div>
                                        <div class="col-2">
                                            @if ($idx > 0)
                                                <button wire:click.prevent="removePeriodo({{ $idx }})"
                                                    class="mt-4 removePeriodo btn btn-sm text-danger"><i
                                                        class="fas fa-trash"></i></button>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                <button class="mt-4 btn btn-sm btn-outline-primary" id="addPeriodo"
                                    wire:click="addPeriodo()"><i class="mr-2 fas fa-plus"></i> Añadir Periodo</button>
                                <hr>
                                <label class="container-check">Enviar notificación por email a los evaluadores
                                    <input class="form-check-input" type="checkbox" id="sendEmail"
                                        wire:model.defer="sendEmail">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- STEP 5 --}}
                @if ($currentStep == 5)
                    <div class="step-four">
                        <div>
                            <ul id="progressbar">
                                <li id="createEvaluacion"><strong>Configuración</strong></li>
                                <li id="publicoObjetivo"><strong>Público Objetivo</strong></li>
                                <li id="evaluadores"><strong>Evaluadores</strong></li>
                                <li id="periodosCircle"><strong>Períodos</strong></li>
                                <li class="active" id="finalizarEvaluacion"><strong>Finalizar</strong></li>
                            </ul>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated"
                                    role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                </div>
                            </div>
                            <div class="card-body">
                                <h2 class="mt-2 text-center purple-text"><strong>¡EVALUACIÓN CREADA!</strong></h2> <br>
                                <div class="row justify-content-center">
                                    <div class="col-6">
                                        <img src="{{ asset('img/success_evaluacion.svg') }}" class="fit-image">
                                    </div>
                                </div> <br><br>
                                <div class="row justify-content-center">
                                    <div class="text-center col-7">
                                        <h5 class="text-center purple-text">
                                            Su evaluación ha sido creada satisfactoriamente, los evaluadores recibirán
                                            una notificación en el sistema y por correo eléctronico.
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="p-3 bg-white" style="float: right;">
                    @if ($currentStep == 1)
                        <div></div>
                    @endif
                    @if ($currentStep == 2 || $currentStep == 3 || $currentStep == 4)
                        <button type="button" class="btn btn-md btn_cancelar" wire:click="decreaseStep()"><i
                                class="mr-2 fas fa-arrow-circle-left"></i>Atrás</button>
                    @endif
                    @if ($currentStep == 1 || $currentStep == 2 || $currentStep == 3)
                        <button type="button" class="btn btn-md btn-success" wire:click="increaseStep()"><i
                                class="mr-2 fas fa-arrow-circle-right"></i>Siguiente</button>
                    @endif
                    @if ($currentStep == 4)
                        {{-- <button type="submit" class="btn btn-md btn-danger"><i
                                class="mr-2 fab fa-firstdraft"></i>Draft</button> --}}
                        <button type="button" wire:click="activateEvaluation" class="btn btn-md btn-danger"><i
                                class="mr-2 fas fa-paper-plane"></i>Activar</button>
                    @endif
                    @if ($currentStep == 5)
                        <a type="button" href="{{ route('admin.ev360-evaluaciones.index') }}"
                            class="btn btn-md btn-danger"><i class="mr-2 fas fa-share"></i>Salir</a>
                    @endif
                </div>
            </form>
            <div class="display-almacenando row" wire:loading.grid>
                <div class="col-12">
                    <h1>
                        <div class="lds-facebook">
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $("#pesoGeneralObjetivos").keydown(function(event) {

                //prevent using shift with numbers
                if (event.shiftKey == true) {
                    event.preventDefault();
                }

                if (!((event.keyCode == 190) || (event.keyCode >= 48 && event.keyCode <= 57) || (event
                            .keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event
                        .keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46
                    )) {
                    event.preventDefault();

                }
            });

            $("#pesoGeneralObjetivos").keyup(function(event) {

                var number = parseFloat($(this).val());
                if (number > 100 || number == 0) {
                    $(this).val("");
                }
            });
            $("#pesoGeneralCompetencias").keydown(function(event) {

                //prevent using shift with numbers
                if (event.shiftKey == true) {
                    event.preventDefault();
                }

                if (!((event.keyCode == 190) || (event.keyCode >= 48 && event.keyCode <= 57) || (event
                            .keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event
                        .keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46
                    )) {
                    event.preventDefault();

                }
            });

            $("#pesoGeneralCompetencias").keyup(function(event) {

                var number = parseFloat($(this).val());
                if (number > 100 || number == 0) {
                    $(this).val("");
                }
            });

            window.initSelect2 = () => {
                $('#by_manual').select2({
                    'theme': 'bootstrap4'
                });
                $('#by_manual').on('change', function(e) {
                    var data = $('#by_manual').select2("val");
                    console.log(data);
                    @this.set('by_manual', data);
                });
            }

            initSelect2();

            Livewire.on('select2', () => {
                initSelect2();
            });


            window.livewire.on('increaseStep', () => {
                if (document.getElementById('btnModalOpen')) {
                    document.getElementById('btnModalOpen').addEventListener('click', function(e) {
                        e.preventDefault();
                    })
                }
                if (document.getElementById('addPeriodo')) {
                    document.getElementById('addPeriodo').addEventListener('click', function(e) {
                        e.preventDefault();
                    })
                }
                if (document.querySelector('.removePeriodo')) {
                    document.querySelector('.removePeriodo').addEventListener('click', function(e) {
                        e.preventDefault();
                    })
                }
            });
            window.livewire.on('decreaseStep', () => {
                if (document.getElementById('btnModalOpen')) {
                    document.getElementById('btnModalOpen').addEventListener('click', function(e) {
                        e.preventDefault();
                    })
                }
                if (document.getElementById('addPeriodo')) {
                    document.getElementById('addPeriodo').addEventListener('click', function(e) {
                        e.preventDefault();
                    })
                }
                if (document.querySelector('.removePeriodo')) {
                    document.querySelector('.removePeriodo').addEventListener('click', function(e) {
                        e.preventDefault();
                    })
                }
            });
            if (document.getElementById('addPeriodo')) {
                document.getElementById('addPeriodo').addEventListener('click', function(e) {
                    e.preventDefault();
                })
            }
            if (document.querySelector('.removePeriodo')) {
                document.querySelector('.removePeriodo').addEventListener('click', function(e) {
                    e.preventDefault();
                })
            }

            window.livewire.on('openModalClick', () => {
                $('#grupoModal').modal('show');
            });
            window.livewire.on('grupoEvaluadosSaved', () => {
                $('#grupoModal').modal('hide');
            });
        })

        $('#ddlViewBy').on('load', function() {
            console.log($("option:selected", this));

            /*
            this.$('.textbox').hide();
            var myTag = element.attr("myTag");
            */
        }());
    </script>

</div>
