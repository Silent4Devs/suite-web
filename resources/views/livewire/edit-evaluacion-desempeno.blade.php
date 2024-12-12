<div>

    <div class="container">
        <div class="mt-5 mb-5 text-center titulo_general_funcion">
            <h2>Configuración de la Evaluación</h2>
        </div>
        <div class="mt-5 mb-5">
            <ul class="step d-flex flex-nowrap">
                <li class="step-item @if ($paso == 1) active @endif">
                    <a href="#!" class="">Inicio</a>
                </li>
                <li class="step-item @if ($paso == 2) active @endif">
                    <a href="#!" class="">Periodos</a>
                </li>
                <li class="step-item @if ($paso == 3) active @endif">
                    <a href="#!" class="">Público</a>
                </li>
                <li class="step-item @if ($paso == 4) active @endif">
                    <a href="#!" class="">Evaluadores</a>
                </li>
            </ul>
        </div>
    </div>

    @switch($paso)
        @case('1')
            <div class="tab-content" id="nav-create-1" role="tabpanel" aria-labelledby="nav-create-1">
                <div>
                    <div class="card card-body">
                        <div class="info-first-config">
                            <h4 class="title-config">Nombre de Evaluación</h4>
                            <p>Asigna un nombre a tu evaluación y coloca una breve descripción.</p>
                            <hr class="my-4">
                        </div>

                        <div class="form-group anima-focus">
                            <input type="text" placeholder="" name="nombre_evaluacion" wire:model="nombre_evaluacion"
                                class="form-control">
                            <label for="nombre-evaluacion">Nombre</label>
                        </div>

                        <div class="form-group anima-focus">
                            <textarea placeholder="" name="descripcion_evaluacion" wire:model="descripcion_evaluacion" class="form-control"></textarea>
                            <label for="descripcion-evaluacion">Descripción</label>
                        </div>
                    </div>

                    <div class="card card-body">
                        <div class="info-first-config">
                            <h4 class="title-config">Alcance de la Evaluación</h4>
                            <p>
                                Selecciona los rubros que deseas considerar en tu evaluación. Podrás distribuir el
                                porcentaje
                                que prefieras asignar a cada una de ellos, asegurándote de sumar en total el 100%."
                            </p>
                            <hr class="my-4">
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="p-4 rounded-lg d-flex align-items-center justify-content-between"
                                    style="background-color: #8C91D6;">
                                    <div class="d-flex align-items-center" style="gap: 10px;">
                                        <input type="checkbox" name="activar_objetivos" wire:model="activar_objetivos">
                                        <label for="activar_objetivos" style="color: #fff;" class="mb-0"> Objetivos
                                        </label>
                                    </div>
                                    <div>
                                        <input class="form-control" type="number" wire:model="porcentaje_objetivos"
                                            name="porcentaje_objetivos" style="width: 90px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-4 rounded-lg d-flex align-items-center justify-content-between"
                                    style="background-color: #BB68A8;">
                                    <div class="d-flex align-items-center" style="gap: 10px;">
                                        <input type="checkbox" name="activar_competencias" wire:model="activar_competencias">
                                        <label for="activar_competencias" style="color: #fff;" class="mb-0"> Competencias
                                        </label>
                                    </div>
                                    <div>
                                        <input class="form-control" type="number" wire:model="porcentaje_competencias"
                                            name="porcentaje_competencias" style="width: 90px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 text-left my-4">
                            <a wire:click.prevent="guardarBorrador" class="btn btn-primary" style="width: 170px;">Guardar
                                Borrador</a>
                        </div>

                        <div class=" col-6 text-right my-4">
                            <a href="{{ route('admin.rh.evaluaciones-desempeno.dashboard-general') }}"
                                class="btn btn-outline-primary" style="width: 170px;">Cancelar</a>
                            <a wire:click.prevent="primerPaso" class="btn btn-primary" style="width: 170px;">SIGUIENTE</a>
                        </div>
                    </div>
                </div>
            </div>
        @break

        @case('2')
            <div class="tab-content" id="nav-create-2" role="tabpanel" aria-labelledby="nav-create-2">
                {{-- <form wire:submit.prevent="segundoPaso(Object.fromEntries(new FormData($event.target)))"> --}}
                <div class="card card-body">
                    <div class="info-first-config">
                        <h4 class="title-config">Periodos de los Objetivos</h4>
                        <p>Define la periodicidad con la que se medirá la evaluación de tu empresa.</p>
                        <hr class="my-4">
                    </div>
                    <div>
                        Selecciona la periodicidad
                    </div>
                    <div class="d-flex mt-3" style="gap: 20px;">
                        @foreach (['mensual', 'bimestral', 'trimestral', 'semestral', 'anualmente', 'abierta'] as $periodo)
                            <div class="form-group">
                                <input
                                    type="radio"
                                    name="periodo"
                                    id="{{ $periodo }}"
                                    value="{{ $periodo }}"
                                    wire:change="seleccionPeriodo('{{ $periodo }}')"
                                    @if ($periodo_evaluacion === $periodo) checked @endif>
                                <label class="mb-0" for="{{ $periodo }}">{{ ucfirst($periodo) }}</label>
                            </div>
                        @endforeach
                    </div>

                    <hr>

                    <div class="card card-body p-2 "
                        style="background-color: #FFF3F3; color: var(--color-tbj); font-size: 12px;">
                        <div>
                            El periodo de carga de objetivos esta corriendo del <strong> 01/01/24 </strong> al <strong>
                                15/03/24
                            </strong>
                            <i class="ml-3">*Al cambiar y habilitar las fechas de los periodos de las evaluaciones se
                                interrumpirá la carga de objetivos</i>
                        </div>
                    </div>

                    <div class="datatable-fix">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Periodicidad: {{ ucfirst($periodo_evaluacion) }}</th>
                                    <th>Fecha de inicio de la evaluación</th>
                                    <th>Fecha de fin de la evaluación</th>
                                    <th>Habilitar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($arreglo_periodos as $index => $ap)
                                    <tr>
                                        <td>
                                            <div class="form-group anima-focus">
                                                <input type="text" name="nombre_evaluacion[]"
                                                    id="nombre_evaluacion_{{ $index }}"
                                                    wire:model.live="arreglo_periodos.{{ $index }}.nombre_evaluacion"
                                                    class="form-control"
                                                    value="{{ $ap['nombre_evaluacion'] }}"@if ($index == 0) required @endif>
                                                <label for="">Evaluación*</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group anima-focus">
                                                <input type="date" placeholder=""
                                                    wire:model.live="arreglo_periodos.{{ $index }}.fecha_inicio"
                                                    class="form-control"
                                                    value="{{ $ap['fecha_inicio'] }}"@if ($index == 0) required @endif>
                                                <label for="">Inicio de la evaluación</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group anima-focus">
                                                <input type="date" placeholder=""
                                                    wire:model.live="arreglo_periodos.{{ $index }}.fecha_fin"
                                                    class="form-control"
                                                    value="{{ $ap['fecha_fin'] }}"@if ($index == 0) required @endif>
                                                <label for="">Fin de la evaluación</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check d-flex justify-content-center align-items-center" style="height: 100%;">
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input checkbox-large"
                                                    id="checkbox-{{ $index }}"
                                                    wire:model.live="arreglo_periodos.{{ $index }}.habilitar"
                                                    @if ($index == 0) disabled @endif>
                                            </div>
                                        </td>
                                        @if ($periodo_evaluacion == 'abierta')
                                            <td>
                                                @if ($index > 0)
                                                    <div class="form-group">
                                                        <button class="btn btn-link"
                                                            wire:click.prevent="eliminarPeriodo({{ $index }})">
                                                            <i class="fa-regular fa-trash-can"></i>
                                                        </button>
                                                    </div>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 text-left my-4">
                        <a wire:click.prevent="guardarBorrador" class="btn btn-primary" style="width: 170px;">Guardar
                            Borrador</a>
                    </div>

                    <div class="col-6 text-right my-4">
                        <a wire:click.prevent="retroceder" class="btn btn-outline-primary" style="width: 170px;">ATRÁS</a>
                        <a wire:click.prevent="segundoPaso" class="btn btn-primary" style="width: 170px;">SIGUIENTE</a>
                    </div>
                </div>
                {{-- </form> --}}
            </div>
        @break

        @case(3)
            <div class="tab-content" id="nav-create-3" role="tabpanel" aria-labelledby="nav-create-3">
                <div class="card card-body">
                    <div class="info-first-config">
                        <h4 class="title-config">Público</h4>
                        <p>Selecciona a quien(es) va dirigida la evaluación o crea un nuevo grupo.</p>
                        <hr class="my-4">
                    </div>
                    <div class="d-flex align-items-center mb-2" style="gap: 20px;">
                        <select name="se" id="se" class="form-control" style="max-width: 350px;"
                            wire:change="seleccionarEvaluados($event.target.value)" wire:model.live="select_evaluados">
                            <option value="toda">Toda la empresa</option>
                            <option value="areas">Area</option>
                            <option value="manualmente">Manualmente</option>
                            <option value="grupo">Grupo</option>
                        </select>

                        <button class="btn btn-outline-primary" type="button" data-toggle="modal"
                            data-target="#crearGrupo">
                            CREAR&nbsp;GRUPO
                        </button>
                    </div>

                    <div class="modal fade" id="crearGrupo" tabindex="-1" role="dialog" aria-labelledby="crearGrupoLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="crearGrupoLabel">Crear Grupo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="nombreGrupo">Nombre del grupo: <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('nombreGrupo') ? 'is-invalid' : '' }}"
                                                    id="nombre" aria-describedby="nombre" wire:model="nombreGrupo"
                                                    value="{{ old('nombreGrupo') }}" autocomplete="off">
                                                <small>Ingresa el nombre del grupo</small>
                                                @if ($errors->has('nombreGrupo'))
                                                    <span class="invalid-feedback">{{ $errors->first('nombreGrupo') }}</span>
                                                @endif
                                                <span class="text-danger nombre_error error-ajax"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-12">
                                            <select class="form-control" wire:model="empleados_grupo" multiple
                                                id="empleadosPertenecientes">
                                                @foreach ($empleados as $empleado)
                                                    <option value="{{ $empleado['id'] }}">{{ $empleado['name'] }}</option>
                                                @endforeach
                                            </select>
                                            <small>Manten presionada la tecla ctrl y selecciona a los empleados que formarán el
                                                grupo</small>
                                            @if ($errors->has('empleados'))
                                                <small class="text-danger">{{ $errors->first('empleados') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button wire:click.prevent="guardarGrupo" type="button" class="btn btn-primary"
                                        data-dismiss="modal">Guardar
                                        cambios</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mt-2" style="gap: 20px;">
                        @switch($select_evaluados)
                            @case('toda')
                            @break

                            @case('areas')
                                <select class="form-control" name="evaluados_areas" id="evaluados_areas"
                                    wire:model.live="evaluados_areas">
                                    <option value="" disabled selected>Seleccione una opcion</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}">{{ $area->area }}</option>
                                    @endforeach
                                </select>
                            @break

                            @case('manualmente')
                                <div class="w-100">
                                    <!-- Dropdown -->
                                    <div class="row">
                                        <div class="col-3">
                                            <select class="form-control"
                                                    wire:change="asignacionEmpleados($event.target.value, $event.target.options[$event.target.selectedIndex].text)">
                                                <option value="" disabled selected>Seleccione un empleado</option>
                                                @foreach ($empleados as $empleado)
                                                    <option value="{{ $empleado['id'] }}">{{ $empleado['name'] }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    <!-- Tabla -->
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <table id="tabla_time_poyect_empleados" class="table w-100 tabla-animada">
                                                <thead class="w-100">
                                                    <tr>
                                                        <th>Nombre </th>
                                                        <th style="max-width:150px !important; width:150px ;">Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="position:relative;">
                                                    @forelse ($empleados_seleccionados as $keySelect => $empleado)
                                                        <tr>
                                                            <td>
                                                                <img src="{{ asset('storage/empleados/imagenes/' . ($empleado['foto'] ?? 'usuario_no_cargado.png')) }}"
                                                                     alt="{{ $empleado['name'] }}"
                                                                     style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                                                {{ $empleado['name'] }}
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-primary" type="button" wire:click.prevent="desasignarColaborador({{ $keySelect }})">
                                                                    Desasignar
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="2" class="text-center">
                                                                <h4>Sin colaboradores seleccionados</h4>
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @break

                            @case('grupo')
                                <select class="form-control" name="evaluados_grupos" id="evaluados_grupos"
                                    wire:model.live="evaluados_grupos">
                                    <option value="" disabled selected>Seleccione una opcion</option>
                                    @foreach ($grupos as $grupo)
                                        <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                                    @endforeach
                                </select>
                            @break

                            @default
                        @endswitch
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 text-left my-4">
                        <a wire:click.prevent="guardarBorrador" type="button" class="btn btn-primary"
                            style="width: 170px;">Guardar
                            Borrador</a>
                    </div>

                    <div class="col-6 text-right my-4">
                        <a wire:click.prevent="retroceder" type="button" class="btn btn-outline-primary" style="width: 170px;">ATRÁS</a>
                        <button wire:click.prevent="tercerPaso" type="button" class="btn btn-primary" style="width: 170px;">SIGUIENTE</button>
                    </div>
                </div>
            </div>
        @break

        @case('4')
            <div class="tab-content" id="nav-create-4" role="tabpanel" aria-labelledby="nav-create-4">
                <div class="card card-body">
                    <div class="info-first-config">
                        <h4 class="title-config">Evaluador(es).</h4>
                        <p>Asigna a los evaluadores y su porcentaje de evaluacións</p>
                        <hr class="my-4">
                    </div>

                    @if ($hayEmpleadosSinCompetencias)
                        <div class="alert alert-danger"
                            style="background: #FFFDE3 0% 0% no-repeat padding-box !important;
            box-shadow: 0px 2px 3px #00000024 !important;
            border: 2px solid #FFC400 !important;
            border-radius: 21px !important;
            opacity: 1 !important;"
                            role="alert">
                            Existen {{ $totalEmpleadosSinCompetencias }} colaboradores que no contienen
                            competencias
                            <div class="row mt-2 mb-2 ml-2 mr-2">
                                @foreach ($listaEmpleadosSinCompetencias as $eSinCompetencias)
                                    <div class="col-1">
                                        <img class="img_empleado"
                                            src="{{ asset('storage/empleados/imagenes') }}/{{ $eSinCompetencias['avatar'] }}"
                                            width="20px;" alt="{{ $eSinCompetencias['name'] }}"
                                            title="{{ $eSinCompetencias['name'] }}">
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-outline-primary"
                                style="border: 1px solid var(--unnamed-color-ff9900);
                            background: #FFFFFF 0% 0% no-repeat padding-box;
                            border: 1px solid #FF9900;
                            border-radius: 8px;
                            opacity: 0.8; text-align: center;
                            font: normal normal normal 18px/22px Roboto;
                            letter-spacing: 0px;
                            color: #FF9900;
                            opacity: 1;"
                                onclick="openNewTabCompetencias()">Asignar
                                Competencias
                            </button>
                            <button type="button" class="btn btn-outline-primary"
                                style="background: #FF9900 0% 0% no-repeat padding-box;
                            border: 1px solid #FF9900;
                            border-radius: 8px;
                            opacity: 0.8; text-align: center;
                            font: normal normal normal 18px/22px Roboto;
                            letter-spacing: 0px;
                            color: #FFFFFF;
                            opacity: 1;"
                                wire:click="repetirConsultaCompetencias">
                                Validar Competencias de Colaboradores
                            </button>
                        </div>
                    @endif
                    @if ($hayEmpleadosSinObjetivos)
                        <div class="alert alert-danger"
                            style="background: #FFFDE3 0% 0% no-repeat padding-box !important;
            box-shadow: 0px 2px 3px #00000024 !important;
            border: 2px solid #FFC400 !important;
            border-radius: 21px !important;
            opacity: 1 !important;"
                            role="alert">
                            Existen {{ $totalEmpleadosSinObjetivos }} colaboradores que no contienen
                            objetivos
                            <div class="row mt-2 mb-2 ml-2 mr-2">
                                @foreach ($listaEmpleadosSinObjetivos as $eSinObjetivo)
                                    <div class="col-1">
                                        <img class="img_empleado"
                                            src="{{ asset('storage/empleados/imagenes') }}/{{ $eSinObjetivo['avatar'] }}"
                                            width="20px;" alt="{{ $eSinObjetivo['name'] }}"
                                            title="{{ $eSinObjetivo['name'] }}">
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-outline-primary"
                                style="border: 1px solid var(--unnamed-color-ff9900);
                            background: #FFFFFF 0% 0% no-repeat padding-box;
                            border: 1px solid #FF9900;
                            border-radius: 8px;
                            opacity: 0.8; text-align: center;
                            font: normal normal normal 18px/22px Roboto;
                            letter-spacing: 0px;
                            color: #FF9900;
                            opacity: 1;"
                                onclick="openNewTabObjetivos()">Asignar
                                Objetivos
                            </button>
                            <button type="button" class="btn btn-outline-primary"
                                style="background: #FF9900 0% 0% no-repeat padding-box;
                            border: 1px solid #FF9900;
                            border-radius: 8px;
                            opacity: 0.8; text-align: center;
                            font: normal normal normal 18px/22px Roboto;
                            letter-spacing: 0px;
                            color: #FFFFFF;
                            opacity: 1;"
                                wire:click="repetirConsultaObjetivos">
                                Validar Objetivos de Colaboradores
                            </button>
                        </div>
                    @endif
                    @if ($hayEmpleadosObjetivosPendiente)
                        <div class="alert alert-danger"
                            style="background: #FFFDE3 0% 0% no-repeat padding-box !important;
                            box-shadow: 0px 2px 3px #00000024 !important;
                            border: 2px solid #FFC400 !important;
                            border-radius: 21px !important;
                            opacity: 1 !important;"
                            role="alert">
                            Existen {{ $totalEmpleadosObjetivosPendiente }} colaboradores que tienen
                            objetivos pendientes de revisión.
                            <div class="row mt-2 mb-2 ml-2 mr-2">
                                @foreach ($listaEmpleadosObjetivosPendiente as $eObjetivoPendiente)
                                    <div class="col-1">
                                        <img class="img_empleado"
                                            src="{{ asset('storage/empleados/imagenes') }}/{{ $eObjetivoPendiente['avatar'] }}"
                                            width="20px;" alt="{{ $eObjetivoPendiente['name'] }}"
                                            title="{{ $eObjetivoPendiente['name'] }}">
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-outline-primary"
                                style="border: 1px solid var(--unnamed-color-ff9900);
                            background: #FFFFFF 0% 0% no-repeat padding-box;
                            border: 1px solid #FF9900;
                            border-radius: 8px;
                            opacity: 0.8; text-align: center;
                            font: normal normal normal 18px/22px Roboto;
                            letter-spacing: 0px;
                            color: #FF9900;
                            opacity: 1;"
                                onclick="openNewTabObjetivos()">Revisar
                                Objetivos
                                Pendientes
                            </button>
                            <button type="button" class="btn btn-outline-primary"
                                style="background: #FF9900 0% 0% no-repeat padding-box;
                            border: 1px solid #FF9900;
                            border-radius: 8px;
                            opacity: 0.8; text-align: center;
                            font: normal normal normal 18px/22px Roboto;
                            letter-spacing: 0px;
                            color: #FFFFFF;
                            opacity: 1;"
                                wire:click="repetirConsultaObjetivosPendientes">
                                Revisar Objetivos de Colaboradores
                            </button>
                        </div>
                    @endif

                    <div class="mt-3">
                        @foreach ($array_evaluados as $key => $evaluado)
                            <div class="row">
                                <div class="col-2">
                                    <div class="row">
                                        {{ $evaluado['name'] }}
                                    </div>
                                    <div class="row">
                                        {{ $evaluado['area'] }}
                                    </div>
                                </div>
                                <div class="col-10">
                                    @if ($activar_objetivos)
                                        <div class="row">
                                            <div class="col-2">
                                                Objetivos
                                            </div>
                                            <div class="col-10">
                                                <div class="row">
                                                    @foreach ($array_evaluadores[$key]['evaluador_objetivos'] as $index_obj => $evldr_obj)
                                                        <div class="col-3">
                                                            <div class="anima-focus">
                                                                <select class="form-control"
                                                                    name="evaluador_objetivo_{{ $key }}"
                                                                    id="evaluador_objetivo_{{ $key }}"
                                                                    wire:model="array_evaluadores.{{ $key }}.evaluador_objetivos.{{ $index_obj }}">
                                                                    <option value="" selected>Seleccione un Evaluador
                                                                    </option>
                                                                    @foreach ($colaboradores as $colaborador)
                                                                        <option value="{{ $colaborador['id'] }}"
                                                                            {{ $evldr_obj == $colaborador['id'] ? 'selected' : '' }}>
                                                                            {{ $colaborador['name'] }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <label
                                                                    for="evaluador_objetivo_{{ $key }}.evaluador_objetivos.{{ $index_obj }}">Evaluador</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <div class="anima-focus">
                                                                <input
                                                                    id="porcentaje_objetivos_evaluador_{{ $key }}_{{ $index_obj }}"
                                                                    type="number" min="0" max="100"
                                                                    class="form-control"
                                                                    wire:model="array_porcentaje_evaluadores.{{ $key }}.porcentaje_evaluador_objetivos.{{ $index_obj }}">
                                                                <label
                                                                    for="porcentaje_objetivos_evaluador_{{ $key }}_{{ $index_obj }}">Porcentaje
                                                                    (%)
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @if ($index_obj > 0)
                                                            <div class="col-1">
                                                                <button class="btn trash-button"
                                                                    wire:click="removerEvaluadorObjetivos({{ $key }}, {{ $index_obj }})"
                                                                    class="btn btn-cancel"><i class="fa-regular fa-trash-can"
                                                                        style="color: rgb(0, 0, 0); font-size: 15pt;"
                                                                        title="Eliminar"></i></button>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    <div class="col-2">
                                                        <a class="btn btn-link" style="color: #3490dc;"
                                                            wire:click.prevent="agregarEvaluadorObjetivos({{ $key }} )">+Agregar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($activar_competencias)
                                        <div class="row">
                                            <div class="col-2">
                                                Competencias
                                            </div>
                                            <div class="col-10">
                                                <div class="row">
                                                    @foreach ($array_evaluadores[$key]['evaluador_competencias'] as $index_comp => $evldr_comp)
                                                        <div class="col-3">
                                                            <div class="anima-focus">
                                                                <select class="form-control"
                                                                    name="evaluador_competencia_{{ $key }}"
                                                                    id="evaluador_competencia_{{ $key }}"
                                                                    wire:model="array_evaluadores.{{ $key }}.evaluador_competencias.{{ $index_comp }}">
                                                                    <option value="" selected>Seleccione un Evaluador
                                                                    </option>
                                                                    @foreach ($colaboradores as $colaborador)
                                                                        <option value="{{ $colaborador['id'] }}">
                                                                            {{ $colaborador['name'] }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <label
                                                                    for="evaluador_competencia_{{ $key }}.evaluador_competencias.{{ $index_comp }}">Evaluador</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <div class="anima-focus">
                                                                <input
                                                                    id="porcentaje_objetivos_evaluador_{{ $key }}_{{ $index_obj }}"
                                                                    type="number" min="0" max="100"
                                                                    class="form-control"
                                                                    wire:model="array_porcentaje_evaluadores.{{ $key }}.porcentaje_evaluador_competencias.{{ $index_comp }}">
                                                                <label
                                                                    for="porcentaje_competencias_evaluador_{{ $key }}_{{ $index_comp }}">Porcentaje
                                                                    (%)
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @if ($index_comp > 0)
                                                            <div class="col-1">
                                                                <button class="btn trash-button"
                                                                    wire:click="removerEvaluadorCompetencias({{ $key }}, {{ $index_comp }})"
                                                                    class="btn btn-cancel"> <i class="fa-regular fa-trash-can"
                                                                        style="color: rgb(0, 0, 0); font-size: 15pt;"
                                                                        title="Eliminar"></i></button>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    <div class="col-4">
                                                        <a class="btn-link" style="color: #3490dc;"
                                                            wire:click.prevent="agregarEvaluadorCompetencias({{ $key }})">+Agregar
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 text-left my-4">
                        <a wire:click.prevent="guardarBorrador" class="btn btn-primary" style="width: 170px;">Guardar
                            Borrador</a>
                    </div>

                    <div class="col-6 text-right my-4">
                        <a wire:click.prevent="retroceder" class="btn btn-outline-primary" style="width: 170px;">ATRÁS</a>
                        <a wire:click.prevent="cuartoPaso" class="btn btn-primary" style="width: 170px;">FINALIZAR</a>
                    </div>
                </div>
            </div>
        @break

        @default
    @endswitch

    @section('scripts')
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', () => {
                let dataEmpleados = []; // Declarada fuera de la función para que sea accesible en todo el ámbito

                Livewire.on('select2', () => {
                    $('.select2').select2({
                        'theme': 'bootstrap4',
                    });

                    $('.select2').select2().on('change', function(e) {
                        var data = $(this).select2("val");
                        dataEmpleados = data;
                        console.log(dataEmpleados);
                    });
                });

                $('.select2').select2().on('change', function(e) {
                    var data = $(this).select2("val");
                    dataEmpleados = data;
                });

                document.addEventListener('click', (e) => {
                    if (e.target && e.target.id == 'btn-paso3') {
                        e.preventDefault();
                        console.log(dataEmpleados);
                        @this.set('empleados_seleccionados', dataEmpleados);
                    }
                });
            });
        </script>

        <script>
            function openNewTabCompetencias() {
                var url = "{{ route('admin.ev360-competencias-por-puesto.index') }}"; // Replace with the actual route name
                window.open(url, '_blank');
            }
        </script>
        <script>
            function openNewTabObjetivos() {
                var url =
                    "{{ route('admin.ev360-objetivos-periodo.config') }}"; // Replace with the actual route name
                window.open(url, '_blank');
            }
        </script>
    @endsection
</div>
