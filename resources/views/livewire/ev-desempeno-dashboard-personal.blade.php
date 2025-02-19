<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <h5 class="titulo_general_funcion"> Dashboard Personal </h5>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card card-body">
                <div class="row">
                    <div class="col-4">
                        <h5>{{ $evaluacion->nombre }}</h5>
                    </div>
                    <div class="col-4">
                        <p>
                            <strong>Evaluado</strong> <br>
                            {{ $info_evaluado->empleado->name }}
                        </p>
                    </div>
                    <div class="col-1">
                        <p>
                            <strong>Foto</strong> <br>
                        <div class="img-person">
                            <img src="{{ $info_evaluado->empleado->avatar_ruta }}" alt="{{ $info_evaluado->empleado->name }}"
                                title="{{ $info_evaluado->empleado->name }}">
                        </div>
                        </p>
                    </div>
                    <div class="col-1">
                        <p>
                            <strong>Estatus</strong><br>
                            @switch($evaluacion->estatus)
                                @case(0)
                                    <span class="badge"
                                        style="color: #FF9900; background-color: 'rgba(255, 200, 0, 0.2)'; border-radius: 7px; padding: 5px; font-weight: 300; font-size:16px;">
                                        <small>Borrador</small>
                                    </span>
                                @break

                                @case(1)
                                    <span class="badge"
                                        style="color: #039C55; background-color: 'rgba(3, 156, 85, 0.1)'; border-radius: 7px; padding: 5px; font-weight: 300; font-size:16px;">
                                        <small>Activa</small>
                                    </span>
                                @break

                                @case(2)
                                    <span class="badge"
                                        style="color: #FF0000; background-color: 'rgba(221, 4, 131, 0.1)'; border-radius: 7px; padding: 5px; font-weight: 300; font-size:16px;">
                                        <small>Cancelada</small>
                                    </span>
                                @break

                                @case(3)
                                    <span class="badge"
                                        style="color: #0080FF; background-color: 'rgba(0, 128, 255, 0.1)'; border-radius: 7px; padding: 5px; font-weight: 300; font-size:16px;">
                                        <small>Finalizada</small>
                                    </span>
                                @break

                                @default
                                    <span class="badge"
                                        style="color: #0080FF; background-color: 'rgba(0, 128, 255, 0.1)'; border-radius: 7px; padding: 5px; font-weight: 300; font-size:16px;">
                                        <small>Borrador</small>
                                    </span>
                                </p>
                        @endswitch
                    </div>
                    <div class="col-1">
                        <p>
                            <strong>Inicio</strong> <br>

                        </p>
                    </div>
                    <div class="col-1">
                        <p>
                            <strong>Finaliza</strong> <br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-2">
            <div class="card card-body">
                <div class="d-flex w-100">
                    <div class="">
                        <strong>Reporte</strong>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    <div class="row" style="font-size: 18px;">
        <div class="col-md-4">
            <div class="text-white d-flex align-items-center justify-content-between p-4 rounded-lg"
                style="background-color: #984F96;">
                <div>
                    <span>Promedio General</span>
                </div>
                <div>
                    <small>Resultado</small> <strong>{{ $promedio_total }}%</strong>
                </div>
            </div>
        </div>
        @if ($evaluacion->activar_objetivos)
            <div class="col-md-4">
                <div class="text-white d-flex align-items-center justify-content-between p-4 rounded-lg"
                    style="background-color: #984F96;">
                    <div>
                        <span>Objetivos</span>
                    </div>
                    <div>
                        <small>Resultado</small> <strong>{{ $promedio_objetivos }}%</strong>
                    </div>
                </div>
            </div>
        @endif
        @if ($evaluacion->activar_competencias)
            <div class="col-md-4">
                <div class="text-white d-flex align-items-center justify-content-between p-4 rounded-lg"
                    style="background-color: #984F96;">
                    <div>
                        <span>Competencias</span>
                    </div>
                    <div>
                        <small>Resultado</small> <strong>{{ $promedio_competencias }}%</strong>
                    </div>
                </div>
            </div>
        @endif

    </div>

    <div class="row mt-4" style="font-size: 15px; color: var(--color-tbj)">
        @foreach ($array_periodos as $key => $periodo)
            <div class="col-md-3">
                <div class="p-3 rounded-lg" style="background-color: #fff; box-shadow: 0px 1px 4px #0000000F; ">
                    <a wire:click="cambiarSeccion({{ $key }})">
                        <div class="row mb-3" style="cursor: pointer;">
                            <div class="col-8">
                                {{ $periodo['nombre_evaluacion'] }}
                            </div>
                            <div class="col-4">
                                <small>Promedio</small> <strong>{{ $resultadoPeriodos[$key] ?? 0 }}%</strong>
                            </div>
                        </div>
                    </a>
                    <div class="d-flex align-items-center justify-content-between color-primary">
                        <div class="row">
                            <div class="col-6">
                                <small>Objetivos</small><br>
                                <div class="d-flex" style="position:relative">
                                    @foreach ($evaluado->evaluadoresObjetivos($periodo['id_periodo']) as $evOb)
                                        <img style=""
                                            src="{{ asset('storage/empleados/imagenes/') }}/{{ $evOb->empleado->avatar }}"
                                            class="rounded-circle" alt="{{ $evOb->empleado->name }}"
                                            title="{{ $evOb->empleado->name }}" width="40" height="37">
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modificarEvaluadoresObjetivos">
                                    Evaluadores Objetivos
                                </button>
                                <!-- Modal -->
                                <div wire:ignore.self class="modal fade" id="modificarEvaluadoresObjetivos"
                                    data-backdrop="static" data-keyboard="false" tabindex="-1"
                                    aria-labelledby="modificarEvaluadoresObjetivosLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modificarEvaluadoresObjetivosLabel">
                                                    Modificar Evaluadores - Objetivos
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @foreach ($array_mod_evaluadores_objetivos[$key] as $key_evaluador => $evaluador)
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4 anima-focus">
                                                            <select class="form-control"
                                                                name="modificar_obj_evaluador_{{ $key_evaluador }}"
                                                                id="modificar_obj_evaluador_{{ $key_evaluador }}"
                                                                wire:model="array_mod_evaluadores_objetivos.{{ $key }}.{{ $key_evaluador }}.id_empleado_evaluador">
                                                                <option value={{ $evaluador['id_empleado_evaluador'] }}
                                                                    default>
                                                                    {{ $evaluador['nombre_evaluador'] }}</option>
                                                                @foreach ($modificar_empleados as $me)
                                                                    <option value="{{ $me->id }}">
                                                                        {{ $me->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <label
                                                                for="modificar_obj_evaluador_{{ $key_evaluador }}">Evaluador</label>
                                                        </div>

                                                        <div class="form-group col-md-4 anima-focus">
                                                            <input class="form-control" type="number" placeholder=""
                                                                class="form-input"
                                                                id="porcentaje_modificar_obj_evaluador_{{ $key_evaluador }}"
                                                                name="porcentaje_modificar_obj_evaluador_{{ $key_evaluador }}"
                                                                wire:model="array_mod_evaluadores_objetivos.{{ $key }}.{{ $key_evaluador }}.porcentaje_objetivos">
                                                            <label
                                                                for="porcentaje_modificar_obj_evaluador_{{ $key_evaluador }}">Porcentaje</label>
                                                        </div>
                                                        @if ($key_evaluador > 0)
                                                            <div class="col-md-4">
                                                                <button type="button" class="btn btn-primary"
                                                                    onclick="confirmDeleteEvaluadorObjetivos({{ $key }}, {{ $key_evaluador }})">
                                                                    Eliminar
                                                                </button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                                <div class="row">
                                                    <button type="button" class="btn btn-primary"
                                                        wire:click="agregarEvaluadorPeriodoObjetivos({{ $key }})">
                                                        + Agregar Evaluador
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cerrar</button>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="confirmarModificacionObjetivos({{ $key }})">
                                                    Modificar Evaluadores
                                                </button>
                                                {{-- <button class="btn btn-primary" type="button"
                                                wire:click="modificarEvaluadoresPeriodoObjetivos({{ $key }})">
                                                Modificar Evaluadores</button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <small>Competencias</small><br>
                                <div class="d-flex" style="position:relative">
                                    @foreach ($evaluado->evaluadoresCompetencias($periodo['id_periodo']) as $evComp)
                                        <img style=""
                                            src="{{ asset('storage/empleados/imagenes/') }}/{{ $evComp->empleado->avatar }}"
                                            class="rounded-circle" alt="{{ $evComp->empleado->name }}"
                                            title="{{ $evComp->empleado->name }}" width="40" height="37">
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modificarEvaluadoresCompetencias">
                                    Evaluadores Competencias
                                </button>
                                <div wire:ignore.self class="modal fade" id="modificarEvaluadoresCompetencias"
                                    data-backdrop="static" data-keyboard="false" tabindex="-1"
                                    aria-labelledby="modificarEvaluadoresCompetenciasLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modificarEvaluadoresCompetenciasLabel">
                                                    Modificar Evaluadores - Competencias</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @foreach ($array_mod_evaluadores_competencias[$key] as $key_evaluador => $evaluador)
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4 anima-focus">
                                                            <select class="form-control"
                                                                name="modificar_comp_evaluador_{{ $key_evaluador }}"
                                                                id="modificar_comp_evaluador_{{ $key_evaluador }}"
                                                                wire:model="array_mod_evaluadores_competencias.{{ $key }}.{{ $key_evaluador }}.id_empleado_evaluador">
                                                                <option value={{ $evaluador['id_empleado_evaluador'] }}
                                                                    default>
                                                                    {{ $evaluador['nombre_evaluador'] }}</option>
                                                                @foreach ($modificar_empleados as $me)
                                                                    <option value="{{ $me->id }}">
                                                                        {{ $me->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <label
                                                                for="modificar_comp_evaluador_{{ $key_evaluador }}">Evaluador</label>
                                                        </div>

                                                        <div class="form-group col-md-4 anima-focus">
                                                            <input class="form-control" type="number" placeholder=""
                                                                class="form-input"
                                                                id="porcentaje_modificar_comp_evaluador_{{ $key_evaluador }}"
                                                                name="porcentaje_modificar_comp_evaluador_{{ $key_evaluador }}"
                                                                wire:model="array_mod_evaluadores_competencias.{{ $key }}.{{ $key_evaluador }}.porcentaje_competencias">
                                                            <label
                                                                for="porcentaje_modificar_comp_evaluador_{{ $key_evaluador }}">Porcentaje</label>
                                                        </div>
                                                        @if ($key_evaluador > 0)
                                                            <div class="col-md-4">
                                                                <button type="button" class="btn btn-primary"
                                                                    onclick="confirmDeleteEvaluadorCompetencias({{ $key }}, {{ $key_evaluador }})">
                                                                    Eliminar
                                                                </button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                                <div class="row">
                                                    <button type="button" class="btn btn-primary"
                                                        wire:click="agregarEvaluadorPeriodoCompetencias({{ $key }})">
                                                        + Agregar Evaluador
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cerrar</button>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="confirmarModificacionCompetencias({{ $key }})">
                                                    Modificar Evaluadores
                                                </button>
                                                {{-- <button type="button" type="button" class="btn btn-primary"
                                                    wire:click="modificarEvaluadoresPeriodoCompetencias({{ $key }})">
                                                    Modificar Evaluadores</button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="d-flex w-100">
                            <div class="col-9">
                                <span>Evaluaciones contestadas</span>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{ ($evaluacion->cuenta_evaluados_evaluaciones_completadas_totales / $evaluacion->cuenta_evaluados_evaluaciones_totales) * 100 }}%"
                                        aria-valuenow="{{ ($evaluacion->cuenta_evaluados_evaluaciones_completadas_totales / $evaluacion->cuenta_evaluados_evaluaciones_totales) * 100 }}"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-3">
                                <span>Total</span>
                                <p>
                                    {{ $evaluacion->cuenta_evaluados_evaluaciones_completadas_totales }}/{{ $evaluacion->cuenta_evaluados_evaluaciones_totales }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if ($evaluacion->activar_objetivos)
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card card-body">
                    <h5>Cumplimiento de Objetivos</h5>
                    <div class="row">
                        <div class="col-12">
                            <div id="contenedor-objetivos" style="height:300px;">
                                <canvas id="cumplimientoObjetivos"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-body">
                    <h5>Resultado de evaluación por escalas</h5>
                    <div class="row">
                        <div class="col-12">
                            <div id="contenedor-escalas" style="height:300px;">
                                <canvas id="escalas"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($evaluacion->activar_competencias)
        <div class="card card-body mt-3">
            <div class="row">
                <div class="col-md-10">
                    <h5>Cumplimiento de Competencias</h5>
                </div>
                <div class="col-md-2">
                    <nav>
                        <div class="nav nav-tabs justify-content-end" role="tablist"
                            style="margin-bottom: 0px !important;">
                            <a class="nav-link active" id="" data-type="barras" data-toggle="tab"
                                href="#nav-grafica-1" role="tab" aria-controls="nav-barras"
                                aria-selected="true">
                                <i class="fa-solid fa-chart-column"></i>
                            </a>
                            <a class="nav-link" id="" data-type="radar" data-toggle="tab"
                                href="#nav-grafica-2" role="tab" aria-controls="nav-radar"
                                aria-selected="false">
                                <i class="fa-solid fa-chart-line"></i>
                            </a>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="tab-content" id="nav-tabContent">

                <div class="tab-pane mb-4 fade show active" id="nav-grafica-1" role="tabpanel"
                    aria-labelledby="nav-grafica-1">
                    <div class="row">
                        <div class="col-12">
                            <div id="contenedor-competencias" style="height:600px;">
                                <canvas id="cumplimientoCompetencias"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane mb-4 fade" id="nav-grafica-2" role="tabpanel" aria-labelledby="nav-grafica-2">
                    <div class="row">
                        <div class="col-12">
                            <div id="contenedor-competencias-radar" style="height:600px;">
                                <canvas id="cumplimientoCompetenciasRadar"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <nav class="mt-5">
        <div class="nav nav-tabs" role="tablist" style="margin-bottom: 0px !important;">
            @if ($evaluacion->activar_competencias)
                <a class="nav-link" id="" data-type="competencias" data-toggle="tab"
                    href="#nav-config-competencias" role="tab" aria-controls="nav-competencias"
                    aria-selected="false">
                    Competencias
                </a>
            @endif
            @if ($evaluacion->activar_objetivos)
                <a class="nav-link" id="" data-type="objetivos" data-toggle="tab"
                    href="#nav-config-objetivos" role="tab" aria-controls="nav-objetivos" aria-selected="false">
                    Objetivos
                </a>
            @endif
            <a class="nav-link active" id="" data-type="general" data-toggle="tab"
                href="#nav-config-general" role="tab" aria-controls="nav-config-general" aria-selected="true">
                Resultados de la evaluacion
            </a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">

        @if ($evaluacion->activar_competencias)
            <div class="tab-pane mb-4 fade" id="nav-config-competencias" role="tabpanel"
                aria-labelledby="nav-config-competencias">
                <div class="card card-body">
                    <h5>Resultados Competencias</h5>
                    @foreach ($evaluado->evaluadoresCompetencias as $key => $evaluador)
                        <div class="mt-4 mb-4">
                            <div class="datatable-fix">
                                <table id="" class="table-striped"
                                    style="border-collapse: collapse; width: 100%; border-top-left-radius: 20px !important; border-top-right-radius: 20px !important;">
                                    <thead style="color: white">
                                        <tr style="background-color: #BB68A8;">
                                            <th style="background-color: #BB68A8;" colspan="5">
                                                <div class="mt-3 mb-3">
                                                    <h4>Competencias</h4>
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            @if ($evaluador->empleado->id == $evaluado->empleado->id)
                                                <th>Autoevaluación:
                                                    {{ $evaluador->empleado->name }}</th>
                                            @else
                                                <th>Evaluación Realizada por:
                                                    {{ $evaluador->empleado->name }}&nbsp;(
                                                    {{ $evaluador->porcentaje_competencias }}%)
                                                </th>
                                            @endif
                                            <th>Tipo</th>
                                            <th>Meta</th>
                                            <th>Alcanzado</th>
                                            <th>Calificación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($competenciasEvaluado[$periodo_seleccionado][$evaluador->id] as $key => $competencia)
                                            <tr>
                                                <td
                                                    style="border: 1px solid #CCCCCC; border-bottom:#CCCCCC !important;">
                                                    {{ $competencia->infoCompetencia->competencia }}</td>
                                                <td
                                                    style="border: 1px solid #CCCCCC; border-bottom:#CCCCCC !important;">
                                                    {{ $competencia->infoCompetencia->tipo_competencia }}</td>
                                                <td
                                                    style="border: 1px solid #CCCCCC; border-bottom:#CCCCCC !important;">
                                                    {{ $competencia->infoCompetencia->nivel_esperado }}</td>
                                                @if ($competencia->estatus_calificado)
                                                    <td
                                                        style="border: 1px solid #CCCCCC; border-bottom:#CCCCCC !important;">
                                                        {{ $competencia->calificacion_competencia }}
                                                    </td>
                                                    <td
                                                        style="border: 1px solid #CCCCCC; border-bottom:#CCCCCC !important;">
                                                        {{ round($competencia->calificacion_competencia / $competencia->infoCompetencia->nivel_esperado, 2) }}
                                                    </td>
                                                @else
                                                    <td
                                                        style="border: 1px solid #CCCCCC; border-bottom:#CCCCCC !important;">
                                                        <p>Sin Calificar</p>
                                                    </td>
                                                    <td
                                                        style="border: 1px solid #CCCCCC; border-bottom:#CCCCCC !important;">
                                                        <p>Sin Calificar</p>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if ($evaluacion->activar_objetivos)
            <div class="tab-pane mb-4 fade" id="nav-config-objetivos" role="tabpanel"
                aria-labelledby="nav-config-objetivos">
                <div class="card card-body">
                    <h5>Resultados Objetivos</h5>
                    <div class="mt-4 mb-4">
                        <div class="datatable-fix">
                            <table id="" style="border-collapse: collapse; width: 100%;">
                                <thead>

                                    <tr>
                                        <th>
                                            <p>Objetivo</p>
                                        </th>
                                        <th class="th-table-objetive th-metrica">Métrica</th>
                                        @foreach ($escalas['nombres'] as $key => $parametro)
                                            <th class="th-custom"
                                                style="background-color: {{ $escalas['colores'][$key] }}">
                                                {{ $parametro }}
                                            </th>
                                        @endforeach
                                        <th>Autoevaluación</th>
                                        <th>Evidencias</th>
                                        @foreach ($cabecera_objetivos as $key => $evaluador)
                                            <th>
                                                <p>{{ $evaluador->empleado->name }} <br>
                                                    {{ $evaluador->porcentaje_objetivos }}%</p>
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                @forelse ($objetivosEvaluado[$periodo_seleccionado] as $tipo_objetivo => $objetivosEvaluadoByTipo)
                                    <thead>
                                        <tr>
                                            <th colspan="{{ $contadorColumnas }}">{{ $tipo_objetivo }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($objetivosEvaluadoByTipo['autoevaluacion'] as $cuestionario)
                                            <tr>
                                                <td>{{ $cuestionario->infoObjetivo->objetivo }}</td>
                                                <td>
                                                    <div class="form-group">
                                                        <select class="form-control" name="aplica" id="aplica"
                                                            disabled>
                                                            <option value="true"
                                                                @if ($cuestionario->aplicabilidad == true) selected @endif>
                                                                Aplica
                                                            </option>
                                                            <option value="false"
                                                                @if ($cuestionario->aplicabilidad == false) selected @endif>No
                                                                Aplica
                                                            </option>
                                                        </select>
                                                    </div>
                                                </td>
                                                @foreach ($cuestionario->infoObjetivo->escalas as $obj_esc)
                                                    <td>
                                                        {{ $obj_esc->condicion_signo }}{{ $obj_esc->valor }}&nbsp;{{ $cuestionario->infoObjetivo->unidad_objetivo }}
                                                    </td>
                                                @endforeach
                                                <td>
                                                    @if ($cuestionario->estatus_calificado)
                                                        {{ $cuestionario->calificacion_objetivo }}
                                                    @else
                                                        <p>Sin asignar</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-evidencia"
                                                        data-toggle="modal"
                                                        data-target="#evidenciaObjetivo{{ $cuestionario->id }}">
                                                        Evidencia
                                                    </button>

                                                    <!-- Modal -->
                                                    <div wire:ignore.self class="modal fade"
                                                        id="evidenciaObjetivo{{ $cuestionario->id }}" tabindex="-1"
                                                        aria-labelledby="evidenciaObjetivo{{ $cuestionario->id }}Label"
                                                        aria-hidden="true">
                                                        <button type="button" class="btn-close" data-dismiss="modal"
                                                            aria-label="Close"
                                                            style="margin:50px 0px 10px 1030px; background:none; border: none;"><i
                                                                class="fa-solid fa-x fa-2xl"
                                                                style="color: #ffffff;"></i>
                                                        </button>
                                                        <div class="modal-dialog  modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <div class="d-flex  justify-content-center">
                                                                        <h5 class="modal-title"
                                                                            id="evidenciaObjetivo{{ $cuestionario->id }}Label">
                                                                            Evidencias</h5>
                                                                    </div>

                                                                    @if (!empty($obj_evidencias[0]))
                                                                        @foreach ($obj_evidencias[$key] as $key_evidencia => $evidencia)
                                                                            <div class="row align-items-center">
                                                                                <div class="col-1">
                                                                                    F1
                                                                                </div>
                                                                                <div class="col-3">
                                                                                    <a class="btn-link"
                                                                                        data-toggle="modal"
                                                                                        data-target="#modalArchivo"
                                                                                        wire:click="mostrarArchivo({{ $cuestionario->id }},{{ $evidencia['id'] }})">{{ $evidencia['nombre_archivo'] }}</a>
                                                                                </div>
                                                                                <div class="col-8">
                                                                                    <div class="form-group">
                                                                                        <textarea class="form-control" style="min-height: 83px;" name="comentario_{{ $key_evidencia }}"
                                                                                            id="comentario_{{ $key_evidencia }}" style="min-width: 100%"
                                                                                            wire:change="comentarioObjetivo({{ $evidencia['id'] }}, $event.target.value)" placeholder="Comentario">{{ $evidencia->comentarios ?? null }}</textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    @else
                                                                        <div>
                                                                            <h4>No hay evidencias adjuntas</h4>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                @foreach ($objetivosEvaluadoByTipo['evaluacion'] as $evaluador)
                                                    <td>
                                                        {{ $evaluador->calificacion_objetivo }}
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @empty
                                            <tr>
                                                <td>Sin Evaluar</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                @empty
                                    <tr>
                                        <td>Sin Evaluar</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="tab-pane mb-4 fade show active" id="nav-config-general" role="tabpanel"
            aria-labelledby="nav-config-general">
            <div class="card card-body">
                <div class="datatable-fix">
                    <table id="" class="table table-bordered w-100 datatable">
                        <thead class="thead-dark">
                            <tr>
                                <th colspan="8">RESULTADOS</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>Nombre</th>
                                <th>Puesto y Área</th>
                                <th>Evaluadores</th>
                                @if ($evaluacion->activar_competencias)
                                    <th>Competencias</th>
                                @endif
                                @if ($evaluacion->activar_objetivos)
                                    <th>Objetivos</th>
                                @endif
                                <th>Calificación</th>
                                <th>Nivel</th>
                                @if ($evaluacion->activar_competencias)
                                    <th>Competencias</th>
                                @endif
                                @if ($evaluacion->activar_objetivos)
                                    <th>Objetivos</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>{{ $evaluado->empleado->name }}</td>
                                <td>
                                    {{ $evaluado->empleado->puestoRelacionado->puesto }}/{{ $evaluado->empleado->area->area }}
                                    <br>
                                    @foreach ($evaluado->empleado->registrosHistorico as $key => $historico)
                                        @if (isset($historico->relacion['puesto']->puesto))
                                            Puesto Anterior:{{ $historico->relacion['puesto']->puesto }}
                                        @elseif (isset($historico->relacion['area']->area))
                                            Area
                                            Anterior:{{ $historico->relacion['area']->area }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <ul>
                                        @foreach ($this->evaluadores_evaluado[$evaluado->id] as $evaluador)
                                            <li>{{ $evaluador['nombre'] }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $totales_evaluado[$periodo_seleccionado][$evaluado->id]['competencias'] }}
                                </td>
                                <td>{{ $totales_evaluado[$periodo_seleccionado][$evaluado->id]['objetivos'] }}
                                </td>
                                <td>{{ $totales_evaluado[$periodo_seleccionado][$evaluado->id]['final'] }}
                                </td>
                                <td>Nivel</td>
                                @if ($evaluacion->activar_competencias)
                                    @php
                                        $calif_total_competencias = $evaluado->calificacionesCompetenciasEvaluadoPeriodo(
                                            $this->array_periodos[$this->periodo_seleccionado]['id_periodo'],
                                        )['calif_total'];
                                    @endphp

                                    <td>
                                        <table>
                                            <thead>
                                                <tr>
                                                    @foreach ($calif_total_competencias as $calif_comp)
                                                        <th>{{ $calif_comp['competencia'] }}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    @foreach ($calif_total_competencias as $calif_comp)
                                                        <td>{{ $calif_comp['calificacion_total'] }}</td>
                                                    @endforeach
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                @endif
                                @if ($evaluacion->activar_objetivos)
                                    @php
                                        $calif_total_objetivos = $evaluado->calificacionesObjetivosEvaluadoPeriodo(
                                            $this->array_periodos[$this->periodo_seleccionado]['id_periodo'],
                                        )['calif_total'];
                                    @endphp

                                    <td>
                                        <table>
                                            <thead>
                                                <tr>
                                                    @foreach ($calif_total_objetivos as $calif_obj)
                                                        <th>{{ $calif_obj['nombre'] }}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    @foreach ($calif_total_objetivos as $calif_obj)
                                                        <td>{{ $calif_obj['calificacion_total'] }}</td>
                                                    @endforeach
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:initialized', function() {
            @this.on('validacionObjetivos', (erroresDetectadosObjetivos) => {
                console.log('Mostrar alerta', erroresDetectadosObjetivos);
                if (Array.isArray(erroresDetectadosObjetivos)) {
                    erroresDetectadosObjetivos = erroresDetectadosObjetivos[0];
                }

                Swal.fire({
                    title: erroresDetectadosObjetivos.title,
                    text: erroresDetectadosObjetivos.text,
                    icon: erroresDetectadosObjetivos.icon,
                });
            });
        });
    </script>

    <script>
        document.addEventListener('livewire:initialized', function() {
            @this.on('validacionCompetencias', (erroresDetectadosCompetencias) => {
                console.log('Mostrar alerta', erroresDetectadosCompetencias);
                if (Array.isArray(erroresDetectadosCompetencias)) {
                    erroresDetectadosCompetencias = erroresDetectadosCompetencias[0];
                }

                Swal.fire({
                    title: erroresDetectadosCompetencias.title,
                    text: erroresDetectadosCompetencias.text,
                    icon: erroresDetectadosCompetencias.icon,
                });
            });
        });
    </script>
    <script>
        document.addEventListener('livewire:initialized', function() {
            @this.on('evaluadoresObjetivosModificados', () => {
                Swal.fire({
                    title: 'Evaluadores Modificados - Objetivos',
                    text: 'Evaluadores de objetivos modificados correctamente',
                    icon: 'success',
                    timer: 3000, // Puedes ajustar el tiempo de cierre automático si lo deseas
                    showConfirmButton: false,
                }).then(() => {
                    // Cerrar el modal después de la alerta
                    $('#modificarEvaluadoresObjetivos').modal('hide');
                    $('.modal-backdrop').remove();
                })
            });
        });
    </script>
    <script>
        document.addEventListener('livewire:initialized', function() {
            @this.on('evaluadoresCompetenciasModificados', () => {
                Swal.fire({
                    title: 'Evaluadores Modificados - Competencias',
                    text: 'Evaluadores de competencias modificados correctamente',
                    icon: 'success',
                    timer: 3000, // Puedes ajustar el tiempo de cierre automático si lo deseas
                    showConfirmButton: false,
                }).then(() => {
                    // Cerrar el modal después de la alerta
                    $('#modificarEvaluadoresCompetencias').modal('hide');
                    $('.modal-backdrop').remove();
                })
            });
        });
    </script>
    <script>
        function confirmarModificacionObjetivos(keyObj) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción modificará los evaluadores de objetivos.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, modificar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log(keyObj);
                    Livewire.dispatch('modificarEvaluadoresPeriodoObjetivos', {
                        keyObj
                    });
                }
            });
        }
    </script>
    <script>
        function confirmarModificacionCompetencias(keyComp) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción modificará los evaluadores de objetivos.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, modificar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log(keyComp);
                    Livewire.dispatch('modificarEvaluadoresPeriodoCompetencias', {
                        keyComp
                    });
                }
            });
        }
    </script>
    @include('admin.recursos-humanos.evaluaciones-desempeno.scriptsEvaluadoPersonal')
</div>
