<div>
    <style>
        .btn.btn-evaluacion {
            border: 1px solid var(--unnamed-color-006ddb);
            background: #D6EBFF 0% 0% no-repeat padding-box;
            border: 1px solid #006DDB;
            border-radius: 8px;
            opacity: 1;
        }
    </style>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <h5 class="titulo_general_funcion"> Evaluación Dashboard: {{ $evaluacion->nombre }}</h5>

    <p>
        <small>
            No olvides realizar tu autoevaluacion asi como tambien evaluar a las personas que estan a tu cargo
        </small>
    </p>

    <div class="row mt-4">
        <div class="col-md-3">
            <a wire:click.prevent="enviarRecordatorio">
                <div class="w-100 p-3 text-center text-white rounded-lg"
                    style="background-color: #2C9E7F;cursor: pointer;">
                    Enviar recordatorio de Evaluación
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a wire:click.prevent="cerrarEvaluacion">
                <div class="w-100 p-3 text-center text-white rounded-lg"
                    style="background-color: #DF5050; cursor: pointer;">
                    Cerrar Evaluación
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <!-- Hidden button -->
            <button id="modalOpener" type="button" class="btn btn-primary d-none" data-toggle="modal"
                data-target="#modificacionPeriodos"></button>

            <!-- Div with click event -->
            <div class="w-100 p-3 text-center text-white rounded-lg" style="background-color: #A650DF; cursor: pointer;"
                onclick="document.getElementById('modalOpener').click();">
                Modificar periodo de evaluación
            </div>

            <!-- Modal -->
            <div wire:ignore class="modal fade" id="modificacionPeriodos" data-backdrop="static" data-keyboard="false"
                tabindex="-1" aria-labelledby="modificacionPeriodosLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div>
                                <h5 class="modal-title" id="modificacionPeriodosLabel">Modal title</h5>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <table class="table">
                                    <tbody>
                                        @foreach ($evaluacion->periodos as $index => $ap)
                                            @if ($ap->finalizado)
                                                <tr>
                                                    <td>
                                                        <div class="form-group anima-focus">
                                                            <input type="text" name="nombre_evaluacion[]" disabled
                                                                id="nombre_evaluacion_{{ $index }}"
                                                                wire:model="array_periodos.{{ $index }}.nombre_evaluacion"
                                                                class="form-control"
                                                                value="{{ $ap->nombre_evaluacion }}">
                                                            <label for="">Evaluación*</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group anima-focus">
                                                            <input type="date" placeholder="" disabled
                                                                wire:model="array_periodos.{{ $index }}.fecha_inicio"
                                                                class="form-control" value="{{ $ap->fecha_inicio }}">
                                                            <label for="">Inicio de la evaluación</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group anima-focus">
                                                            <input type="date" placeholder="" disabled
                                                                wire:model="array_periodos.{{ $index }}.fecha_fin"
                                                                class="form-control" value="{{ $ap->fecha_fin }}">
                                                            <label for="">Fin de la evaluación</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="checkbox" class="form-control" disabled
                                                                wire:model="array_periodos.{{ $index }}.habilitado">
                                                        </div>
                                                    </td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td>
                                                        <div class="form-group anima-focus">
                                                            <input type="text" name="nombre_evaluacion[]"
                                                                id="nombre_evaluacion_{{ $index }}"
                                                                wire:model="array_periodos.{{ $index }}.nombre_evaluacion"
                                                                class="form-control"
                                                                value="{{ $ap->nombre_evaluacion }}">
                                                            <label for="">Evaluación*</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if ($dia_actual >= $ap->fecha_inicio)
                                                            <div class="form-group anima-focus">
                                                                <input type="date" placeholder=""
                                                                    wire:model="array_periodos.{{ $index }}.fecha_inicio"
                                                                    class="form-control"
                                                                    value="{{ $ap->fecha_inicio }}" disabled>
                                                                <label for="">Inicio de la evaluación</label>
                                                            </div>
                                                        @else
                                                            <div class="form-group anima-focus">
                                                                <input type="date" placeholder=""
                                                                    wire:model="array_periodos.{{ $index }}.fecha_inicio"
                                                                    class="form-control"
                                                                    value="{{ $ap->fecha_inicio }}">
                                                                <label for="">Inicio de la evaluación</label>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="form-group anima-focus">
                                                            <input type="date" placeholder=""
                                                                wire:model="array_periodos.{{ $index }}.fecha_fin"
                                                                class="form-control" value="{{ $ap->fecha_fin }}">
                                                            <label for="">Fin de la evaluación</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="checkbox" class="form-control"
                                                                wire:model="array_periodos.{{ $index }}.habilitado">
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button wire:click.prevent="modificarPeriodos" type="button" class="btn btn-primary"
                                data-dismiss="modal">Modificar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="w-100 p-3 text-center text-white rounded-lg" style="background-color: #507BDF;">
                Generar Reporte
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card card-body">
                <table>
                    <thead>
                        <tr>
                            <th>
                                Nombre de Evaluación
                            </th>
                            <th>
                                Estatus
                            </th>
                            <th>
                                Inicio
                            </th>
                            <th>
                                Finaliza
                            </th>
                            <th>
                                Autor
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>{{ $evaluacion->nombre }}</p>
                            </td>
                            <td>
                                {{ $evaluacion->estatus_palabra }}
                            </td>
                            <td>
                                10/10/2023
                            </td>
                            <td>
                                10/10/2023
                            </td>
                            <td>
                                <div class="img-person">
                                    <img src="{{ $evaluacion->autor->avatar }}" alt="{{ $evaluacion->autor->name }}"
                                        title="{{ $evaluacion->autor->name }}">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-body">
                <div class="d-flex w-100">
                    <div class="">
                        <span>Evaluaciones contestadas</span>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar"
                                style="width: {{ $evaluacion->porcentaje_evaluaciones_completadas }}%"
                                aria-valuenow="{{ $evaluacion->total_evaluaciones_completadas }}" aria-valuemin="0"
                                aria-valuemax="{{ $evaluacion->total_evaluaciones }}"></div>
                        </div>
                    </div>
                    <div class="">
                        <span>Total</span>
                        <p>
                            {{ $evaluacion->total_evaluaciones_completadas }}/{{ $evaluacion->total_evaluaciones }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
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

    <div class="row mt-4" style="font-size: 15px; color: #006DDB;">
        @foreach ($array_periodos as $key => $periodo)
            <div class="col-md-3">
                <a wire:click="cambiarSeccion({{ $key }})">
                    <div class="p-3 rounded-lg"
                        style="background-color: #fff; box-shadow: 0px 1px 4px #0000000F; cursor: pointer;">
                        <div class="d-flex align-items-center justify-content-between color-primary">
                            <div>
                                {{ $periodo['nombre_evaluacion'] }}
                            </div>
                            <div>
                                <small>Promedio</small> <strong>{{ $resultadoPeriodos[$key] }}%</strong>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
        {{-- <div class="col-md-3">
            <div class="p-3 rounded-lg" style="background-color: #fff; box-shadow: 0px 1px 4px #0000000F;">
                <div class="d-flex align-items-center justify-content-between color-primary">
                    <div>
                        Trimestre 1
                    </div>
                    <div>
                        <small>Promedio</small> <strong>67%</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 rounded-lg" style="background-color: #fff; box-shadow: 0px 1px 4px #0000000F;">
                <div class="d-flex align-items-center justify-content-between color-primary">
                    <div>
                        Trimestre 2
                    </div>
                    <div>
                        <small>Promedio</small> <strong>67%</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 rounded-lg" style="background-color: #fff; box-shadow: 0px 1px 4px #0000000F;">
                <div class="d-flex align-items-center justify-content-between color-primary" style="opacity: 70%;">
                    <div>
                        Trimestre 3
                    </div>
                    <div>
                        <small>Promedio</small> <strong>67%</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 rounded-lg" style="background-color: #fff; box-shadow: 0px 1px 4px #0000000F;">
                <div class="d-flex align-items-center justify-content-between color-primary" style="opacity: 70%;">
                    <div>
                        Trimestre 4
                    </div>
                    <div>
                        <small>Promedio</small> <strong>67%</strong>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    @if ($evaluacion->activar_objetivos)
        <div class="card card-body mt-3">
            <h5>Resultado por área</h5>
            <div class="row">
                <div class="col-12">
                    <div id="contenedor-principal" style="height:600px;">
                        <canvas id="resultadosxarea"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-body" style="background-color: #BF9CC4;">
            <div class="form-group">
                <select name="area_select" id="area_select" wire:model="area_select" class="form-control"
                    style="background-color: #fff;">
                    <option value="" selected disabled>Área</option>
                    @foreach ($opciones_area_select as $key => $opas)
                        <option value="{{ $opas['id'] }}">{{ $opas['area'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif

    <div class="row mt-4" style="font-size: 15px; color: #9E50AA;">
        <div class="col-md-4">
            <div class="p-3 rounded-lg" style="background-color: #fff; box-shadow: 0px 1px 4px #0000000F;">
                <div class="d-flex align-items-center justify-content-between color-primary">
                    <div>
                        Promedio General
                    </div>
                    <div>
                        <small>Resultado</small> <strong>{{ $promedio_total }}%</strong>
                    </div>
                </div>
            </div>
        </div>
        @if ($evaluacion->activar_objetivos)
            <div class="col-md-4">
                <div class="p-3 rounded-lg" style="background-color: #fff; box-shadow: 0px 1px 4px #0000000F;">
                    <div class="d-flex align-items-center justify-content-between color-primary">
                        <div>
                            Objetivos
                        </div>
                        <div>
                            <small>Resultado</small> <strong>{{ $promedio_objetivos }}%</strong>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($evaluacion->activar_competencias)
            <div class="col-md-4">
                <div class="p-3 rounded-lg" style="background-color: #fff; box-shadow: 0px 1px 4px #0000000F;">
                    <div class="d-flex align-items-center justify-content-between color-primary">
                        <div>
                            Competencias
                        </div>
                        <div>
                            <small>Resultado</small> <strong>{{ $promedio_competencias }}%</strong>
                        </div>
                    </div>
                </div>
            </div>
        @endif
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
            <h5>Cumplimiento de Competencias</h5>
            <div class="row">
                <div class="col-12">
                    <div id="contenedor-competencias" style="height:600px;">
                        <canvas id="cumplimientoCompetencias"></canvas>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="card card-body">
        <div class="d-flex w-100">
            <div class="">
                <span>Evaluaciones contestadas</span>
                <div class="progress">
                    <div class="progress-bar bg-warning" role="progressbar"
                        style="width: {{ ($evaluacion->cuenta_evaluados_evaluaciones_completadas_totales / $evaluacion->cuenta_evaluados_evaluaciones_totales) * 100 }}%"
                        aria-valuenow="{{ ($evaluacion->cuenta_evaluados_evaluaciones_completadas_totales / $evaluacion->cuenta_evaluados_evaluaciones_totales) * 100 }}"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="">
                <span>Total</span>
                <p>
                    {{ $evaluacion->cuenta_evaluados_evaluaciones_completadas_totales }}/{{ $evaluacion->cuenta_evaluados_evaluaciones_totales }}
                </p>
            </div>
        </div>
    </div>

    <div class="card card-body">

        <div class="row">
            <div class="col-md-3 form-group">
                <select name="area_tabla" id="area_tabla" wire:model.defer="select_area_tabla" class="form-control">
                    <option value="todos">Área</option>
                    @foreach ($opciones_area_select as $key => $opas)
                        <option value="{{ $opas['id'] }}">{{ $opas['area'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 form-group">
                <select name="colaborador_tabla" id="colaborador_tabla" wire:model.defer="select_colaborador_tabla"
                    class="form-control">
                    <option value="todos">Colaborador</option>
                    @foreach ($evaluacion->evaluados as $evaluado)
                        <option value="{{ $evaluado->id }}">{{ $evaluado->empleado->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 form-group">
                <select name="" id="" class="form-control">
                    <option value="">Evaluador</option>
                    @foreach ($opciones_evaluadores_select as $op)
                        <option value="{{ $op['id'] }}">{{ $op['nombre'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Buscar ...">
            </div>
        </div>
    </div>

    <nav class="mt-5">
        <div class="nav nav-tabs" role="tablist" style="margin-bottom: 0px !important;">
            <a class="nav-link active" id="" data-type="empleados" data-toggle="tab"
                href="#nav-config-obj-1" role="tab" aria-controls="nav-empleados" aria-selected="true">
                Evaluados
            </a>
            <a class="nav-link" id="" data-type="calendario-comunicacion" data-toggle="tab"
                href="#nav-config-obj-2" role="tab" aria-controls="nav-config-obj-2" aria-selected="false">
                Resultados de la evaluacion
            </a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">

        <div class="tab-pane mb-4 fade show active" id="nav-config-obj-1" role="tabpanel"
            aria-labelledby="nav-config-obj-1">
            <div class="card card-body">

                <table id="datatable-empleados-config-evaluaciones" class="table table-bordered w-100 datatable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Área</th>
                            <th>Evaluadores</th>
                            <th>Avance</th>
                            <th>Estatus</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($evaluados_tabla->evaluados as $evaluado)
                                <td>{{ $evaluado->empleado->name }}</td>
                                <td>{{ $evaluado->empleado->area->area }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex" style="position:relative">
                                                @foreach ($this->evaluadores_evaluado[$evaluado->id] as $evaluador)
                                                    <img style=""
                                                        src="{{ asset('storage/empleados/imagenes/') }}/{{ $evaluador['foto'] }}"
                                                        class="rounded-circle" alt="{{ $evaluador['nombre'] }}"
                                                        title="{{ $evaluador['nombre'] }}" width="40"
                                                        height="37">
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>Avance</td>
                                <td>Estatus</td>
                                <td>
                                    <a href="{{ route('admin.rh.evaluaciones-desempeno.dashboard-evaluado', [$evaluacion->id, $evaluado->id]) }}"
                                        class="btn btn-evaluacion">Evaluacion</a>
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

        <div class="tab-pane mb-4 fade" id="nav-config-obj-2" role="tabpanel" aria-labelledby="nav-config-obj-2">
            <div class="card card-body">
                <div class="datatable-fix">
                    <table id="" class="table table-bordered w-100 datatable">
                        <thead class="thead-dark">
                            <tr>
                                @if ($evaluacion->activar_competencias && $evaluacion->activar_objetivos)
                                    <th colspan="9">Resultados</th>
                                @else
                                    <th colspan="8">Resultados</th>
                                @endif
                                @if ($evaluacion->activar_competencias)
                                    <th colspan="{{ $evaluacion->periodos->count() }}">Competencias</th>
                                @endif
                                @if ($evaluacion->activar_objetivos)
                                    <th colspan="{{ $evaluacion->periodos->count() }}">Objetivos</th>
                                @endif
                            </tr>
                            <tr>
                                <th></th>
                                <th>Nombre</th>
                                <th>Puesto</th>
                                <th>Área</th>
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
                                    @foreach ($array_periodos as $key_periodo => $periodo)
                                        <th>{{ $periodo['nombre_evaluacion'] }}
                                        </th>
                                    @endforeach
                                @endif
                                @if ($evaluacion->activar_objetivos)
                                    @foreach ($array_periodos as $key_periodo => $periodo)
                                        <th>{{ $periodo['nombre_evaluacion'] }}
                                        </th>
                                    @endforeach
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($evaluados_tabla->evaluados as $evaluado)
                                <tr>
                                    <td>
                                        <a
                                            href="{{ route('admin.rh.evaluaciones-desempeno.dashboard-evaluado', [$evaluacion->id, $evaluado->id]) }}">
                                            <i class="material-icons-outlined">
                                                visibility
                                            </i>
                                        </a>
                                    </td>
                                    <td>{{ $evaluado->empleado->name }}</td>
                                    <td>{{ $evaluado->empleado->puesto }}
                                    </td>
                                    <td>{{ $evaluado->empleado->area->area }}</td>
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
                                        @foreach ($array_periodos as $key_periodo => $periodo)
                                            <td>
                                                <table>
                                                    @php
                                                        $calif_total_competencias = $evaluado->calificacionesCompetenciasEvaluadoPeriodo(
                                                            $periodo['id_periodo'],
                                                        )['calif_total'];
                                                    @endphp
                                                    @foreach ($calif_total_competencias as $calif_comp)
                                                        <tr>
                                                            <td>{{ $calif_comp['competencia'] }}
                                                            </td>
                                                            <td>
                                                                {{ $calif_comp['calificacion_total'] }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                        @endforeach
                                        {{-- Version Alternativa, podria usarse --}}
                                        {{-- @php
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
                                        </td> --}}
                                    @endif
                                    @if ($evaluacion->activar_objetivos)
                                        @foreach ($array_periodos as $key_periodo => $periodo)
                                            <td>
                                                <table>
                                                    @php
                                                        $calif_total_competencias = $evaluado->calificacionesObjetivosEvaluadoPeriodo(
                                                            $periodo['id_periodo'],
                                                        )['calif_total'];
                                                    @endphp
                                                    @foreach ($calif_total_competencias as $calif_comp)
                                                        <tr>
                                                            <td>{{ $calif_comp['nombre'] }}
                                                            </td>
                                                            <td>
                                                                {{ $calif_comp['calificacion_total'] }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                        @endforeach
                                        {{-- Version Alternativa, podria usarse --}}
                                        {{-- @php
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
                                        </td> --}}
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        @if ($evaluacion->activar_objetivos)
            {{-- Codigo primera vez que carga --}}
            <script>
                document.addEventListener('livewire:load', function() {

                    const areas = @json($resArea['nombres'][$periodo_seleccionado]);
                    const data = @json($resArea['resultados'][$periodo_seleccionado]);

                    var ctx = document.getElementById('resultadosxarea').getContext('2d');
                    chartRA = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: areas,
                            datasets: [{
                                label: 'Porcentaje de cumplimiento',
                                data: data,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                });
            </script>
            {{-- Codigo cambio de filtros --}}
            <script>
                document.addEventListener('livewire:load', function() {
                    Livewire.on('objetivosArea', (objArea) => {

                        document.getElementById('resultadosxarea').remove();
                        let canvas = document.createElement("canvas");
                        canvas.id = "resultadosxarea";
                        canvas.style.width = '100%';
                        canvas.style.height = '100%';
                        document.getElementById("contenedor-principal").appendChild(canvas);

                        let grafica_objetivos_area = new Chart(document.getElementById('resultadosxarea'), {
                            type: 'bar',
                            data: {
                                labels: objArea.labels,
                                datasets: [{
                                    label: 'Porcentaje de cumplimiento',
                                    data: objArea.data,
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    });
                });
            </script>

            <script>
                document.addEventListener('livewire:load', function() {

                    const tipos = @json($resObj['nombres'][$periodo_seleccionado]);
                    const resultados = @json($resObj['resultados'][$periodo_seleccionado]);
                    console.log(tipos, resultados);
                    var ctx2 = document.getElementById('cumplimientoObjetivos').getContext('2d');
                    ChartCO = new Chart(ctx2, {
                        type: 'bar',
                        data: {
                            labels: tipos,
                            datasets: [{
                                label: 'Porcentaje de cumplimiento',
                                data: resultados,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
            </script>

            <script>
                document.addEventListener('livewire:load', function() {
                    Livewire.on('cumplimientoObj', (cumpObj) => {

                        document.getElementById('cumplimientoObjetivos').remove();
                        let canvas = document.createElement("canvas");
                        canvas.id = "cumplimientoObjetivos";
                        canvas.style.width = '100%';
                        canvas.style.height = '100%';
                        document.getElementById("contenedor-objetivos").appendChild(canvas);

                        let grafica_objetivos_area = new Chart(document.getElementById('cumplimientoObjetivos'), {
                            type: 'bar',
                            data: {
                                labels: cumpObj.labels,
                                datasets: [{
                                    label: 'Porcentaje de cumplimiento',
                                    data: cumpObj.data,
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    });
                });
            </script>

            <script>
                document.addEventListener('livewire:load', function() {

                    const escalas = @json($escalas['nombres'][$periodo_seleccionado]);
                    const colores = @json($escalas['colores'][$periodo_seleccionado]);
                    const resultados = @json($escalas['resultados'][$periodo_seleccionado]);

                    var ctx3 = document.getElementById('escalas').getContext('2d');
                    ChartCO = new Chart(ctx3, {
                        type: 'bar',
                        data: {
                            labels: escalas,
                            datasets: [{
                                label: 'Porcentaje de cumplimiento',
                                data: resultados,
                                backgroundColor: colores,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
            </script>

            <script>
                document.addEventListener('livewire:load', function() {
                    Livewire.on('escalasObj', (escObj) => {

                        document.getElementById('escalas').remove();
                        let canvas = document.createElement("canvas");
                        canvas.id = "escalas";
                        canvas.style.width = '100%';
                        canvas.style.height = '100%';
                        document.getElementById("contenedor-escalas").appendChild(canvas);

                        let grafica_escalas = new Chart(document.getElementById('escalas'), {
                            type: 'bar',
                            data: {
                                labels: escObj.labels,
                                datasets: [{
                                    label: 'Porcentaje de cumplimiento',
                                    data: escObj.resultados,
                                    backgroundColor: escObj.colores,
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    });
                });
            </script>
        @endif

        @if ($evaluacion->activar_competencias)
            <script>
                document.addEventListener('livewire:load', function() {

                    const competencias = @json($resComp['nombres'][$periodo_seleccionado]);
                    const resultados = @json($resComp['resultados'][$periodo_seleccionado]);
                    console.log(competencias, resultados);
                    var ctx4 = document.getElementById('cumplimientoCompetencias').getContext('2d');
                    ChartCO = new Chart(ctx4, {
                        type: 'bar',
                        data: {
                            labels: competencias,
                            datasets: [{
                                label: 'Porcentaje de cumplimiento',
                                data: resultados,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
            </script>

            <script>
                document.addEventListener('livewire:load', function() {
                    Livewire.on('cumplimientoComp', (cumpComp) => {

                        console.log(cumpComp);

                        document.getElementById('cumplimientoCompetencias').remove();
                        let canvas = document.createElement("canvas");
                        canvas.id = "cumplimientoCompetencias";
                        canvas.style.width = '100%';
                        canvas.style.height = '100%';
                        document.getElementById("contenedor-competencias").appendChild(canvas);

                        let grafica_objetivos_area = new Chart(document.getElementById(
                            'cumplimientoCompetencias'), {
                            type: 'bar',
                            data: {
                                labels: cumpComp.labels,
                                datasets: [{
                                    label: 'Porcentaje de cumplimiento',
                                    data: cumpComp.data,
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    });
                });
            </script>
        @endif
    @endsection
</div>