@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('EV360-Evaluacion-Consulta-Evaluado', ['evaluacion' => $evaluacion, 'evaluado' => $evaluado]) }}

    <style>
        .fs-consulta {
            font-size: 11px;
        }

        img.rounded-circle {
            border-radius: 0 !important;
            clip-path: circle(40px at 50% 50%);
            height: 20px;
        }

    </style>
    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Consulta: </strong> Evaluación </h3>
        </div>
        <div class="card-body">
            <div class="mb-3 row">
                <div class="text-center border col-4">
                    @php
                        use App\Models\Organizacion;
                        $organizacion = Organizacion::first();
                        $logotipo = $organizacion->logotipo;
                    @endphp
                    <img src="{{ asset($logotipo) }}" class="img-fluid" alt="" width="70">
                </div>
                <div class="border col-4">
                    <p class="m-0" style="font-size:13px">
                        <strong>Evaluación 360°</strong>
                    </p>
                    <p class="m-0" style="font-size:12px">Informe de resultados de la evaluación de desempeño
                        laboral</p>
                </div>
                <div class="border col-4">
                    <p class="m-0" style="font-size:11px">
                        <strong>Nombre de la evaluación:</strong>
                        <span style="font-size: 11px">{{ $evaluacion->nombre }}</span>
                    </p>
                    <p class="m-0" style="font-size:11px">
                        <strong>Fecha Inicio:</strong>
                        <span style="font-size: 11px">{{ $evaluacion->fecha_inicio }}</span>
                    </p>
                    <p class="m-0" style="font-size:11px">
                        <strong>Fecha Fin:</strong>
                        <span style="font-size: 11px">{{ $evaluacion->fecha_fin }}</span>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="p-1 text-center col-12" style="background: #3e3e3e">
                    <h6 class="m-0 text-white">Informe de resultados</h6>
                </div>
                <div class="col-12">
                    <div class="row align-items-center" style="font-size:12px">
                        <div class="border col-3">
                            <p class="m-0">Nombre del evaluado:</p>
                        </div>
                        <div class="border col-9">
                            <p class="m-0">{{ $evaluado->name }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row align-items-center" style="font-size:12px">
                        <div class="border col-3">
                            <p class="m-0">Puesto:</p>
                        </div>
                        <div class="border col-9">
                            <p class="m-0">{{ $evaluado->puesto }}</p>
                        </div>
                    </div>
                </div>
                <div class="p-1 text-center col-12" style="background: #3e3e3e">
                    <h6 class="m-0 text-white">Metodología utilizada</h6>
                </div>
                <div class="col-12">
                    <p class="p-0" style="font-size:11px; text-align: justify;">
                        Método de evaluación 360°: La evaluación de 360° también conocida como evaluación integral, es una
                        herramienta muy utilizada. Esta evaluación ayuda a identificar las fortalezas y necesidades de
                        desarrollo de los subordinados solicitando información a todas aquellas personas que interactúan con
                        el
                        colaborador, que abarcan jefes y compañeros, además de brindarle
                        una amplia retroalimentación de su desempeño; estos resultados son necesarios para tomar medidas en
                        cuanto a mejorar su desempeño, comportamiento o ambos, y dar a la gerencia la información necesaria
                        para
                        tomar decisiones en el futuro.
                        Los objetivos de realizar una evaluación de 360° grados son: Conocer el
                        desempeño de cada uno de los evaluados de acuerdo a diferentes competencias requeridas por la
                        organización y el puesto; Detectar áreas de oportunidad del individuo, del equipo y de la
                        organización y
                        Llevar a cabo acciones precisas para mejorar el desempeño del personal y de la organización. La
                        diferencia de este método se basa en el hecho que la retroalimentación no proviene de una sola
                        persona,
                        llámese superior o evaluador, sino que proviene de un entorno global que incluye incluso al
                        evaluado, a
                        los niveles jerárquicos superiores, a los inferiores, por lo tanto, esta retroalimentación se
                        convierte en aceptable o creíble para el
                        evaluado.
                        Esta forma ayuda a reducir los desvíos a partir de proveer una retroalimentación equilibradadada la
                        variedad de fuentes
                    </p>
                </div>
                <div class="p-1 text-center col-12" style="background: #3e3e3e">
                    <h6 class="m-0 text-white">Analisis de resultados - competencias una a una</h6>
                </div>
            </div>
            <div class="mt-2 row">
                <div class="p-0 col-12 progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $calificacion_final }}%;"
                        aria-valuenow="{{ $calificacion_final }}" aria-valuemin="0" aria-valuemax="100">
                        {{ $calificacion_final }}%
                    </div>
                </div>
            </div>
            <div class="mt-2">
                <span style="font-size: 11px">{{ $lista_autoevaluacion->first()['tipo'] }}</span>
                <span style="font-size: 11px">{{ $lista_autoevaluacion->first()['peso_general'] }}%</span>
                @forelse ($lista_autoevaluacion->first()['evaluaciones'] as $evaluador)
                    @include('admin.recursos-humanos.evaluacion-360.evaluaciones.consultas.evaluacion_competencia_template',['tipo'=>'autoevaluacion'])
                @empty
                    <div class="text-muted" style="font-size:11px"><i class="fas fa-exclamation-triangle"></i> No aplica
                        para la evaluación
                    </div>
                @endforelse
            </div>

            <div class="mt-2">
                <span style="font-size: 11px">{{ $lista_jefe_inmediato->first()['tipo'] }}</span>
                <span style="font-size: 11px">{{ $lista_jefe_inmediato->first()['peso_general'] }}%</span>
                @forelse ($lista_jefe_inmediato->first()['evaluaciones'] as $evaluador)
                    @include('admin.recursos-humanos.evaluacion-360.evaluaciones.consultas.evaluacion_competencia_template',['tipo'=>'jefe'])
                @empty
                    <div class="text-muted" style="font-size:11px"><i class="fas fa-exclamation-triangle"></i> No aplica
                        para la evaluación
                    </div>
                @endforelse
            </div>

            <div class="mt-2">
                <span style="font-size: 11px">{{ $lista_equipo_a_cargo->first()['tipo'] }}</span>
                <span style="font-size: 11px">{{ $lista_equipo_a_cargo->first()['peso_general'] }}%</span>
                @forelse ($lista_equipo_a_cargo->first()['evaluaciones'] as $evaluador)
                    @include('admin.recursos-humanos.evaluacion-360.evaluaciones.consultas.evaluacion_competencia_template',['tipo'=>'equipo'])
                @empty
                    <div class="text-muted" style="font-size:11px"><i class="fas fa-exclamation-triangle"></i> No aplica
                        para la evaluación
                    </div>
                @endforelse
            </div>

            <div class="mt-2">
                <span style="font-size: 11px">{{ $lista_misma_area->first()['tipo'] }}</span>
                <span style="font-size: 11px">{{ $lista_misma_area->first()['peso_general'] }}%</span>
                @forelse ($lista_misma_area->first()['evaluaciones'] as $evaluador)
                    @include('admin.recursos-humanos.evaluacion-360.evaluaciones.consultas.evaluacion_competencia_template',['tipo'=>'misma_area'])
                @empty
                    <div class="text-muted" style="font-size:11px"><i class="fas fa-exclamation-triangle"></i> No aplica
                        para la evaluación
                    </div>
                @endforelse
            </div>
            <div class="mt-3 row">
                <div class="col-8"></div>
                <div class="col-4">
                    <p class="m-0 text-center text-white" style="background: #3e3e3e; border: 1px solid #fff">Competencias
                    </p>
                    <div class="col-12" style="font-size:11px">
                        <div class="row">
                            <div class="border col-6">Promedio</div>
                            <div class="border col-6">{{ $promedio_competencias }}</div>
                        </div>
                        <div class="row">
                            <div class="border col-6">% Participación</div>
                            <div class="border col-6">{{ $promedio_competencias * 100 }}%</div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="graficasCompetencias">
                <div class="row">
                    <div class="col-4">
                        <canvas id="jefeGrafica" width="400" height="400"></canvas>
                    </div>
                    <div class="col-4">
                        <canvas id="equipoGrafica" width="400" height="400"></canvas>
                    </div>
                    <div class="col-4">
                        <canvas id="areaGrafica" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
            <div class="mt-4 row">
                <div class="p-1 text-center col-12" style="background: #3e3e3e">
                    <h6 class="m-0 text-white">Evaluación de objetivos</h6>
                </div>
            </div>
            @foreach ($evaluadores_objetivos as $evaluador)
                <div class="row">
                    <div class="col-12">
                        <div class="mt-2 row">
                            <div class="col-12" style="font-size: 12px">
                                Evaluación realizada por:
                                <strong> {{ $evaluador['nombre'] }}</strong>
                                @if ($evaluador['esAutoevaluacion'])
                                    <span class="badge badge-primary">Autoevaluación</span>
                                @endif
                                @if ($evaluador['esSupervisor'])
                                    <span class="badge badge-success">Supervisor</span>
                                @endif
                            </div>
                            <div class="text-center text-white col-2"
                                style="background: #3e3e3e; border: 1px solid #fff; font-size:11px"><small>Objetivo</small>
                            </div>
                            <div class="text-center text-white col-3"
                                style="background: #3e3e3e; border: 1px solid #fff; font-size:11px"><small>KPI</small></div>
                            <div class="text-center text-white col-1"
                                style="background: #3e3e3e; border: 1px solid #fff; font-size:11px"><small>Meta</small>
                            </div>
                            <div class="text-center text-white col-1"
                                style="background: #3e3e3e; border: 1px solid #fff; font-size:11px"><small>Logrado</small>
                            </div>
                            <div class="text-center text-white col-2"
                                style="background: #3e3e3e; border: 1px solid #fff; font-size:11px">
                                <small>Descripción</small>
                            </div>
                            <div class="text-center text-white col-3"
                                style="background: #3e3e3e; border: 1px solid #fff; font-size:11px">
                                <small>Comentarios</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        @foreach ($evaluador['objetivos'] as $idx => $objetivo)
                            <div class="row">
                                <div class="text-white col-2"
                                    style="background: #3e3e3e; border: 1px solid #fff; font-size:10px">
                                    {{ $objetivo['nombre'] }}
                                </div>
                                <div class="text-center border col-3" style="font-size:10px">
                                    {{ $objetivo['KPI'] }}
                                </div>
                                <div class="text-center border col-1" style="font-size:10px">
                                    {{ $objetivo['meta'] }} {{ $objetivo['metrica'] }}
                                </div>
                                <div class="text-center border col-1" style="font-size:10px">
                                    {{ $objetivo['calificacion'] }} {{ $objetivo['metrica'] }}
                                </div>
                                <div class="text-center border col-2" style="font-size:10px">
                                    {{ $objetivo['descripcion_meta'] ? $objetivo['descripcion_meta'] : 'N/A' }}
                                </div>
                                <div class="text-center border col-3" style="font-size:10px">
                                    {{ $objetivo['meta_alcanzada'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
            <div class="mt-3 row" style="font-size:11px">
                <div class="col-8"></div>
                <div class="col-4">
                    <p class="m-0 text-center text-white" style="background: #3e3e3e; border: 1px solid #fff">Objetivos
                    </p>
                    <div class="col-12">
                        <div class="row">
                            <div class="border col-6">Promedio</div>
                            <div class="border col-6">{{ $promedio_objetivos }}</div>
                        </div>
                        <div class="row">
                            <div class="border col-6">% Participación</div>
                            <div class="border col-6">{{ $promedio_objetivos * 100 }}%</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-1 row justify-content-between">
                <div class="p-1 mt-2 text-center col-12" style="background: #3e3e3e">
                    <h6 class="m-0 text-white">Resultados obtenidos</h6>
                </div>
                <div class="col-4" style="font-size:12px">
                    <div class="text-center row align-items-center">
                        <div class="border col-6" style="background: #3e3e3e">
                            <p class="m-0 text-white">Calificación Final</p>
                        </div>
                        <div class="border col-6">
                            <p class="m-0">{{ $calificacion_final }}%</p>
                        </div>
                    </div>
                </div>
                <div class="col-4" style="font-size:12px">
                    <div class="text-center row align-items-center">
                        <div class="border col-6" style="background: #3e3e3e">
                            <p class="m-0 text-white">Competencias</p>
                        </div>
                        <div class="border col-6">
                            <p class="m-0">{{ $promedio_general_competencias }}%</p>
                        </div>
                    </div>
                </div>
                <div class="col-4" style="font-size:12px">
                    <div class="text-center row align-items-center">
                        <div class="border col-6" style="background: #3e3e3e">
                            <p class="m-0 text-white">Objetivos</p>
                        </div>
                        <div class="border col-6">
                            <p class="m-0">{{ $promedio_general_objetivos }}%
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let labels = @json($competencias_lista_nombre);
            let data = {
                labels: labels,
                datasets: [{
                    label: 'Autoevaluación',
                    backgroundColor: 'rgb(46, 204, 65)',
                    borderColor: 'rgb(46, 204, 65)',
                    data: @json($calificaciones_autoevaluacion_competencias),
                }, {
                    label: 'Jefe Inmediato',
                    backgroundColor: 'rgb(46, 106, 204)',
                    borderColor: 'rgb(46, 106, 204)',
                    data: @json($calificaciones_jefe_competencias),
                }]
            };
            let config = {
                type: 'line',
                data: data,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Autoevaluación vs Jefe Inmediato',
                        }
                    }
                }
            };
            var myChart = new Chart(
                document.getElementById('jefeGrafica'),
                config
            );
            //Equipo
            let labelsEquipo = @json($competencias_lista_nombre);
            let dataEquipo = {
                labels: labelsEquipo,
                datasets: [{
                    label: 'Autoevaluación',
                    backgroundColor: 'rgb(46, 204, 65)',
                    borderColor: 'rgb(46, 204, 65)',
                    data: @json($calificaciones_autoevaluacion_competencias),
                }, {
                    label: 'Equipo a cargo',
                    backgroundColor: 'rgb(46, 106, 204)',
                    borderColor: 'rgb(46, 106, 204)',
                    data: @json($calificaciones_equipo_competencias),
                }]
            };
            let configEquipo = {
                type: 'line',
                data: dataEquipo,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Autoevaluación vs Equipo a cargo',
                        }
                    }
                }
            };
            var myChart = new Chart(
                document.getElementById('equipoGrafica'),
                configEquipo
            );
            //Area
            let labelsArea = @json($competencias_lista_nombre);
            let dataArea = {
                labels: labelsArea,
                datasets: [{
                    label: 'Autoevaluación',
                    backgroundColor: 'rgb(46, 204, 65)',
                    borderColor: 'rgb(46, 204, 65)',
                    data: @json($calificaciones_autoevaluacion_competencias),
                }, {
                    label: 'Misma área',
                    backgroundColor: 'rgb(46, 106, 204)',
                    borderColor: 'rgb(46, 106, 204)',
                    data: @json($calificaciones_area_competencias),
                }]
            };
            let configArea = {
                type: 'line',
                data: dataArea,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Autoevaluación vs Misma área',
                        }
                    }
                }
            };
            var myChart = new Chart(
                document.getElementById('areaGrafica'),
                configArea
            );
        });
    </script>
@endsection
