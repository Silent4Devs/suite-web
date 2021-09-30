<div>
    <style>
        /* The container */
        .container-check {
            display: block;
            position: relative;
            padding-left: 18px;
            margin-bottom: 6px;
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
            height: 15px;
            width: 15px;
            background-color: #f9f9f9;
            border: 1px solid #00abb2;
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
            left: 4px;
            top: 2px;
            width: 5px;
            height: 8px;
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
            border: 2px solid #008186;
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
            cursor: pointer;
        }

        article input[type="number"] {
            position: absolute;
            bottom: 5px;
            left: 31px;
            width: 50px;
            height: 20px;
            outline: none;
            background: white;
            border: none;
            border-bottom: 1px solid rgb(32, 32, 32);
            color: black;
            text-align: center;
        }

        input[type=checkbox]:checked~div {
            color: #f3f3f3;
            background: #008186;
            border-radius: 7px;
            border: none;
            box-shadow: 5px 5px 5px 0px #004d4d;
        }

        input[type=checkbox]:checked~input[type=number] {
            border-bottom: 2px solid rgb(43, 43, 43);
            color: #dfdfdf;
            background: #008186;
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
            z-index: 0;
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
            color: #008186;
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
            content: "\f007"
        }

        #progressbar #publicoObjetivo:before {
            font-family: "Font Awesome 5 Free";
            content: "\f500"
        }

        #progressbar #evaluadores:before {
            font-family: "Font Awesome 5 Free";
            content: "\f500"
        }

        #progressbar #periodosCircle:before {
            font-family: "Font Awesome 5 Free";
            content: "\f00c"
        }

        #progressbar #finalizarEvaluacion:before {
            font-family: "Font Awesome 5 Free";
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
            z-index: -1
        }

        #progressbar li.active:before,
        #progressbar li.active:after {
            background: #008186;
        }

        .progress {
            height: 20px
        }

        .progress-bar {
            background-color: #008186;
        }

        .head {
            text-transform: uppercase;
            color: #008186;
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

    </style>
    <div class="container row justify-content-center">
        <div class="mt-3 col-9 card">
            <form wire:submit.prevent="register">
                {{-- STEP 1 --}}
                @if ($currentStep == 1)


                    <div class="step-one">
                        <div>
                            <ul id="progressbar">
                                <li class="active" id="createEvaluacion"><strong>Configuración</strong></li>
                                <li id="publicoObjetivo"><strong>Publico Objetivo</strong></li>
                                <li id="evaluadores"><strong>Evaluadores</strong></li>
                                <li id="periodosCircle"><strong>Periodos</strong></li>
                                <li id="finalizarEvaluacion"><strong>Finalizar</strong></li>
                            </ul>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 25%"></div>
                            </div>
                            <div class="card-body">
                                <h4 class="head">Configura tu evaluación</h4>
                                <div class="row">
                                    <div class="col-12">
                                        <p class="text-muted"><i class="fas fa-info-circle"></i> Empieza
                                            configurando tu evaluación, defininendo el nombre y agregando una
                                            descripción opcionalmente,
                                            no olvides incluir los objetivos o competencias... </p>
                                    </div>
                                    <div class="col-sm-12 col-lg-12 col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="nombre">
                                                <i class="mr-1 fas fa-user-circle iconos-evaluacion"></i> Nombre <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="text" wire:model.prevent="nombre"
                                                class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                                                id="nombre" aria-describedby="nombreHelp" name="nombre"
                                                value="{{ old('nombre') }}">
                                            <small id="nombreHelp" class="form-text text-muted">Ingresa el nombre del
                                                Grupo</small>
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
                                                <i class="mr-1 fas fa-file-signature iconos-evaluacion"></i> Descripción
                                            </label>
                                            <textarea
                                                class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                                                name="descripcion" id="" cols="1" wire:model.prevent="descripcion"
                                                rows="1">{{ old('descripcion') }}</textarea>
                                            <small id="descripcionHelp" class="form-text text-muted">Ingresa la
                                                Descripción
                                                la
                                                evaluación</small>
                                            @if ($errors->has('descripcion'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('descripcion') }}
                                                </div>
                                            @endif
                                            <span class="errors descripcion_error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-12 col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="">
                                                <i class="mr-2 fab fa-discourse iconos-evaluacion"></i> ¿Qué campos
                                                deseas evaluar?
                                                <span class="text-danger">*</span>
                                            </label>
                                            <br>
                                            <div class="d-flex">
                                                <label class="mr-2 container-check">Competencias
                                                    @if ($errors->has('includeCompetencias'))
                                                        <small class="text-danger">
                                                            ({{ $errors->first('includeCompetencias') }})
                                                        </small>
                                                    @endif
                                                    <input type="checkbox" type="checkbox"
                                                        wire:change="$set('showContentTable',{{ !$showContentTable }})"
                                                        wire:model="includeCompetencias">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="container-check">Objetivos
                                                    @if ($errors->has('includeObjetivos'))
                                                        <small class="text-danger">
                                                            ({{ $errors->first('includeObjetivos') }})
                                                        </small>
                                                    @endif
                                                    <input type="checkbox" wire:model="includeObjetivos"
                                                        class="form-check-input" type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                    @if ($showContentTable)
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
                                    @endif

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
                                <li class="active" id="publicoObjetivo"><strong>Publico Objetivo</strong></li>
                                <li id="evaluadores"><strong>Evaluadores</strong></li>
                                <li id="periodosCircle"><strong>Periodos</strong></li>
                                <li id="finalizarEvaluacion"><strong>Finalizar</strong></li>
                            </ul>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 50%"></div>
                            </div>
                            <div class="card-body">
                                <h4 class="head">SELECCIONA TU PÚBLICO OBJETIVO</h4>
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-9">
                                        <div>
                                            <p class="text-muted"><i class="fas fa-info-circle"></i> Seleccionar
                                                Evaluados
                                            </p>
                                            <select
                                                class="form-control {{ $errors->has('evaluados_objetivo') ? 'is-invalid' : '' }}"
                                                wire:model="evaluados_objetivo" id="evaluados_objetivo"
                                                name="evaluados_objetivo" wire:change="habilitarSelectAlternativo()">
                                                <option value="" selected>-- Seleciona una opción --</option>
                                                <option value="all">Toda la empresa</option>
                                                <option value="area">Por areas</option>
                                                @foreach ($grupos_evaluados as $grupo)
                                                    <option value="{{ $grupo->id }}">{{ $grupo->nombre }} - Grupo
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
                                            <small id="evaluadosQuestionHelp" class="form-text text-muted">Selecciona a
                                                quien(es)
                                                irá dirigida la
                                                evaluación</small>
                                            @if ($habilitarSelectAreas)
                                                <select
                                                    class="mt-3 form-control {{ $errors->has('by_area') ? 'is-invalid' : '' }}"
                                                    id="by_area" wire:model="by_area">
                                                    <option value="" selected>-- Seleciona una opción --</option>
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
                                                <select
                                                    class="mt-3 form-control {{ $errors->has('by_manual') ? 'is-invalid' : '' }}"
                                                    multiple id="by_manual" wire:model="by_manual">
                                                    @foreach ($empleados as $empleado)
                                                        <option value="{{ $empleado->id }}">{{ $empleado->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('by_manual'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('by_manual') }}
                                                    </div>
                                                @endif
                                                <small class="form-text text-muted">No se creará un nuevo grupo,
                                                    recomendado
                                                    para
                                                    selecciones de una sola vez</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-3 col-3">
                                        @livewire('ev360-grupo-evaluados-create')
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
                                <li id="publicoObjetivo"><strong>Publico Objetivo</strong></li>
                                <li class="active" id="evaluadores"><strong>Evaluadores</strong></li>
                                <li id="periodosCircle"><strong>Periodos</strong></li>
                                <li id="finalizarEvaluacion"><strong>Finalizar</strong></li>
                            </ul>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                            </div>
                            <div class="card-body">
                                <h4 class="head">SELECCIONA LOS EVALUADORES ENCARGADOS</h4>
                                <p class="m-0 text-muted"><i class="fas fa-info-circle"></i>
                                    Selecciona los evaluadores participantes
                                </p>
                                <small>Nota: Puedes realizar por defecto una evaluación de desempeño de 360° o la que
                                    mas se
                                    adecue a
                                    tu evaluación</small>
                                @if ($errors->has('sumaTotalPeso'))
                                    <p style="font-size:12px;" class="m-0 text-center text-danger">
                                        {{ $errors->first('sumaTotalPeso') }}
                                    </p>
                                @endif
                                <section class="mt-4 row justify-content-center">
                                    <div class="col-8" wire:loading.class="disableEvents">
                                        <article class="ml-5 feature1">
                                            <input type="checkbox" wire:change="restarGrados('jefe_inmediato')"
                                                wire:model="evaluado_por_jefe" wire:target="evaluado_por_jefe"
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
                                                <input class="ml-4" wire:model="pesoEvaluacionJefe"
                                                    type="number" placeholder="Define peso..." max="100" min="0">
                                                <span
                                                    style="position: absolute;top: 89px;color: white;left: 90px;">%</span>
                                                @if ($errors->has('pesoEvaluacionJefe'))
                                                    <small style="font-size:9px;"
                                                        class="text-danger">{{ $errors->first('pesoEvaluacionJefe') }}</small>
                                                @endif
                                            @endif

                                        </article>

                                        <article class="feature2">
                                            <input type="checkbox" wire:change="restarGrados('misma_area')"
                                                wire:model="evaluado_por_misma_area" id="feature2"
                                                wire:target="evaluado_por_misma_area" wire:loading.attr="readonly" />
                                            <div>
                                                <div>
                                                    <span class="text-center">
                                                        <span class="icono-card-evaluadores"><i
                                                                class="fas fa-user-friends"></i></span>
                                                        <br>
                                                        Por Area
                                                        <br>
                                                        @if ($errors->has('evaluado_por_misma_area'))
                                                            <small style="font-size:9px;"
                                                                class="text-danger">{{ $errors->first('evaluado_por_misma_area') }}</small>
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            @if ($evaluado_por_misma_area)
                                                <input class="ml-4" wire:model="pesoEvaluacionArea"
                                                    type="number" placeholder="Define peso..." max="100" min="0">
                                                <span
                                                    style="position: absolute;top: 89px;color: white;left: 90px;">%</span>
                                                @if ($errors->has('pesoEvaluacionArea'))
                                                    <small style="font-size:9px;"
                                                        class="text-danger">{{ $errors->first('pesoEvaluacionArea') }}</small>
                                                @endif
                                            @endif
                                        </article>

                                        <article class="mt-4 ml-5 feature3">
                                            <input type="checkbox" wire:change="restarGrados('equipo_a_cargo')"
                                                wire:model="evaluado_por_equipo_a_cargo" id="feature3"
                                                wire:target="evaluado_por_equipo_a_cargo"
                                                wire:loading.attr="readonly" />
                                            <div>
                                                <span class="text-center">
                                                    <span class="icono-card-evaluadores"><i
                                                            class="fas fa-users"></i></span>
                                                    <br>
                                                    Equipo a cargo
                                                    <br>
                                                    @if ($errors->has('evaluado_por_equipo_a_cargo'))
                                                        <small style="font-size:9px;"
                                                            class="text-danger">{{ $errors->first('evaluado_por_equipo_a_cargo') }}</small>
                                                    @endif
                                                </span>
                                            </div>
                                            @if ($evaluado_por_equipo_a_cargo)
                                                <input class="ml-4" wire:model="pesoEvaluacionEquipo"
                                                    type="number" placeholder="Define peso..." max="100" min="0">
                                                <span
                                                    style="position: absolute;top: 89px;color: white;left: 90px;">%</span>
                                                @if ($errors->has('pesoEvaluacionEquipo'))
                                                    <small style="font-size:9px;"
                                                        class="text-danger">{{ $errors->first('pesoEvaluacionEquipo') }}</small>
                                                @endif
                                            @endif
                                        </article>

                                        <article class="mt-4 feature4">
                                            <input type="checkbox" wire:change="restarGrados('autoevaluacion')"
                                                wire:model="autoevaluacion" id="feature4" wire:target="autoevaluacion"
                                                wire:loading.attr="readonly" />
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
                                                <input class="ml-4" wire:model="pesoAutoevaluacion"
                                                    type="number" placeholder="Define peso..." max="100" min="0">
                                                <span
                                                    style="position: absolute;top: 89px;color: white;left: 90px;">%</span>
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
                                    </h3>
                                </div>
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
                                <li id="publicoObjetivo"><strong>Publico Objetivo</strong></li>
                                <li id="evaluadores"><strong>Evaluadores</strong></li>
                                <li class="active" id="periodosCircle"><strong>Periodos</strong></li>
                                <li id="finalizarEvaluacion"><strong>Finalizar</strong></li>
                            </ul>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 90%"></div>
                            </div>
                            <div class="card-body">
                                <h4 class="head">SELECCIONA LOS PERIODOS A EVALUAR</h4>
                                <p class="m-0 text-muted"><i class="fas fa-info-circle"></i>
                                    Define los periodos que requieras para la evaluación
                                </p>
                                @foreach ($periodos as $idx => $periodo)
                                    <div class="mt-4 row align-items-center">
                                        <div class="pr-0 col-4">
                                            <span><i class="mr-2 fas fa-calendar-day"></i>Fecha de evaluación
                                                <strong>{{ $idx + 1 }}</strong></span>
                                        </div>
                                        <div class="pl-0 col-3">
                                            <p class="m-0 text-muted">Fecha Inicio</p>
                                            <input class="form-control" type="date"
                                                wire:model="periodos.{{ $idx }}.fecha_inicio"
                                                value="{{ $periodo['fecha_inicio'] }}">
                                        </div>
                                        <div class="pl-0 col-3">
                                            <p class="m-0 text-muted">Fecha Finalización</p>
                                            <input class="form-control" type="date"
                                                wire:model="periodos.{{ $idx }}.fecha_fin"
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
                                <li id="publicoObjetivo"><strong>Publico Objetivo</strong></li>
                                <li id="evaluadores"><strong>Evaluadores</strong></li>
                                <li id="periodosCircle"><strong>Periodos</strong></li>
                                <li class="active" id="finalizarEvaluacion"><strong>Finalizar</strong></li>
                            </ul>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
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
                                            Su evaluación ha sido creada satisfactoriamente :)
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
                            class="btn btn-md btn-danger"><i class="mr-2 fas fa-paper-plane"></i>Salir</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
    </script>
</div>
