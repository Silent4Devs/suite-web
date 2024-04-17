<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <h5 class="titulo_general_funcion"> Dashboard Personal </h5>

    <div class="row mt-4">
        <div class="col-md-11">
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
                            <img src="{{ $info_evaluado->empleado->avatar }}" alt="{{ $info_evaluado->empleado->name }}"
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
        <div class="col-md-1">
            <div class="card card-body">
                <div class="d-flex w-100">
                    <div class="">
                        <strong>Reporte</strong>
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

    {{-- @if ($evaluacion->activar_objetivos)
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
    @endif --}}

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
            <a wire:click.prevent="cambioRadar">
                Grafica
            </a>
            <div class="row">
                @if ($grafica_radar == false)
                    <div class="col-12">
                        <div id="contenedor-competencias" style="height:600px;">
                            <canvas id="cumplimientoCompetencias"></canvas>
                        </div>
                    </div>
                @else
                    <div class="col-12">
                        <div id="contenedor-competencias-radar" style="height:600px;">
                            <canvas id="cumplimientoCompetenciasRadar"></canvas>
                        </div>
                    </div>
                @endif
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

    {{-- <div class="card card-body">

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
    </div> --}}

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
                            <th>Meta</th>
                            <th>Estatus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($evaluados_tabla->evaluados as $evaluado)
                                <td>{{ $evaluado->empleado->name }}</td>
                                <td>{{ $evaluado->empleado->area->area }}</td>
                                <td>Avance</td>
                                <td>Actividad</td>
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
                                <th colspan="8">RESULTADOS</th>
                                <th colspan="21">COMPETENCIAS</th>
                                <th colspan="20">OBJETIVOS</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>Nombre</th>
                                <th>Puesto y Área</th>
                                <th>Evaluadores</th>
                                {{-- @if ($evaluacion->activar_competencias) --}}
                                <th>Competencias</th>
                                {{-- @endif --}}
                                {{-- @if ($evaluacion->activar_objetivos) --}}
                                <th>Objetivos</th>
                                {{-- @endif --}}
                                <th>Calificación</th>
                                <th>Nivel</th>

                                <th>Apego a procesos</th>
                                <th>Innovación y creatividad</th>
                                <th>Comunicación efectiva</th>
                                <th>Enfocque al cliente</th>
                                <th>Trabajo en equipo</th>
                                <th>Adaptabilidad al cambio</th>
                                <th>Solución de problemas y toma de desiciones</th>
                                <th>Liderazgo e influencia</th>
                                <th>Pensamiento estratégico</th>
                                <th>Planificación y organización</th>
                                <th>Negociación comercial</th>
                                <th>Analisis de negocio</th>
                                <th>Visión de negocio</th>
                                <th>Enfoque a resultados</th>
                                <th>Mejora continua</th>
                                <th>Búsqueda de información</th>
                                <th>Análisis y síntesis</th>
                                <th>Efectividad interpersonal (Empatía)</th>
                                <th>Negociación</th>
                                <th>Trabajo bajo presión</th>
                                <th>Impacto e influencia</th>

                                <th>Objetivo 1</th>
                                <th>%</th>
                                <th>Objetivo 2</th>
                                <th>%</th>
                                <th>Objetivo 3</th>
                                <th>%</th>
                                <th>Objetivo 4</th>
                                <th>%</th>
                                <th>Objetivo 5</th>
                                <th>%</th>
                                <th>Objetivo 6</th>
                                <th>%</th>
                                <th>Objetivo 7</th>
                                <th>%</th>
                                <th>Objetivo 8</th>
                                <th>%</th>
                                <th>Objetivo 9</th>
                                <th>%</th>
                                <th>Objetivo 10</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($evaluados_tabla->evaluados as $evaluado)
                                <tr>
                                    <td></td>
                                    <td>{{ $evaluado->empleado->name }}</td>
                                    <td>{{ $evaluado->empleado->puestoRelacionado->puesto }}/{{ $evaluado->empleado->area->area }}
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


                                    {{-- <td>Apego a procesos</td>
                                    <td>Innovación y creatividad</td>
                                    <td>Comunicación efectiva</td>
                                    <td>Enfocque al cliente</td>
                                    <td>Trabajo en equipo</td>
                                    <td>Adaptabilidad al cambio</td>
                                    <td>Solución de problemas y toma de desiciones</td>
                                    <td>Liderazgo e influencia</td>
                                    <td>Pensamiento estratégico</td>
                                    <td>Planificación y organización</td>
                                    <td>Negociación comercial</td>
                                    <td>Analisis de negocio</td>
                                    <td>Visión de negocio</td>
                                    <td>Enfoque a resultados</td>
                                    <td>Mejora continua</td>
                                    <td>Búsqueda de información</td>
                                    <td>Análisis y síntesis</td>
                                    <td>Efectividad interpersonal (Empatía)</td>
                                    <td>Negociación</td>
                                    <td>Trabajo bajo presión</td>
                                    <td>Impacto e influencia</td> --}}

                                    {{-- <td>Objetivo 1</td>
                                    <td>%</td>
                                    <td>Objetivo 2</td>
                                    <td>%</td>
                                    <td>Objetivo 3</td>
                                    <td>%</td>
                                    <td>Objetivo 4</td>
                                    <td>%</td>
                                    <td>Objetivo 5</td>
                                    <td>%</td>
                                    <td>Objetivo 6</td>
                                    <td>%</td>
                                    <td>Objetivo 7</td>
                                    <td>%</td>
                                    <td>Objetivo 8</td>
                                    <td>%</td>
                                    <td>Objetivo 9</td>
                                    <td>%</td>
                                    <td>Objetivo 10</td>
                                    <td>%</td> --}}
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
            {{-- <script>
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
            </script> --}}
            {{-- Codigo cambio de filtros --}}
            {{-- <script>
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
            </script> --}}

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

                    const escalas = @json($escalas['nombres']);
                    const colores = @json($escalas['colores']);

                    var ctx3 = document.getElementById('escalas').getContext('2d');
                    ChartCO = new Chart(ctx3, {
                        type: 'bar',
                        data: {
                            labels: escalas,
                            datasets: [{
                                label: 'Porcentaje de cumplimiento',
                                data: [12, 43, 2, 2],
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
                                    data: [12, 43, 2, 2],
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

            <script>
                document.addEventListener('livewire:load', function() {

                    const competencias = @json($resComp['nombres'][$periodo_seleccionado]);
                    const resultados = @json($resComp['resultado_competencia'][$periodo_seleccionado]);
                    const esperados = @json($resComp['nivel_esperado'][$periodo_seleccionado]);

                    // console.log(competencias, resultados);
                    var ctx5 = document.getElementById('cumplimientoCompetenciasRadar').getContext('2d');
                    ChartCO = new Chart(ctx5, {
                        type: 'radar',
                        data: {
                            labels: competencias,
                            datasets: [{
                                    label: 'Nivel Alcanzado',
                                    data: resultados,
                                    borderWidth: 1
                                },
                                {
                                    label: 'Nivel Esperado',
                                    data: esperados,
                                    borderWidth: 1
                                },
                            ]
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
                    Livewire.on('cumplimientoRadarComp', (cumpCompRadar) => {

                        document.getElementById('cumplimientoCompetenciasRadar').remove();
                        let canvas = document.createElement("canvas");
                        canvas.id = "cumplimientoCompetenciasRadar";
                        canvas.style.width = '100%';
                        canvas.style.height = '100%';
                        document.getElementById("contenedor-competencias-radar").appendChild(canvas);

                        let grafica_competencias_radar = new Chart(document.getElementById(
                            'cumplimientoCompetenciasRadar'), {
                            type: 'radar',
                            data: {
                                labels: cumpCompRadar.labels,
                                datasets: [{
                                        label: 'Nivel Alcanzado',
                                        data: cumpCompRadar.data,
                                        borderWidth: 1
                                    },
                                    {
                                        label: 'Nivel Esperado',
                                        data: cumpCompRadar.data2,
                                        borderWidth: 1
                                    },
                                ]
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
