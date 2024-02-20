@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/print_foda.css') }}{{config('app.cssVersion')}}">
    <style>
        .fs-consulta {
            font-size: 11px;
        }

        img.rounded-circle {
            border-radius: 0 !important;
            clip-path: circle(40px at 50% 50%);
            height: 20px;
        }

        @media print {
            .print-none {
                display: none !important;
            }
        }
    </style>
    <div class="print-none">
        {{ Breadcrumbs::render('EV360-Evaluacion-Consulta-Evaluado', ['evaluacion' => $evaluacion, 'evaluado' => $evaluado]) }}
    </div>
    <div class="mt-4 card">
        <div class="print-none py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Resúmen de la</strong> evaluación </h3>
        </div>
        <div class="card-body">
            <div class="col-12 pr-0 mr-0 mb-4">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-danger print-none" onclick="javascript:window.print()">
                        <i class="fas fa-print"></i>
                        Imprimir
                    </button>

                </div>
            </div>
            <div class="col-12">
                <div class="mb-3 row">
                    <div class="text-center border col-4">
                        @php
                            use App\Models\Organizacion;
                            $organizacion = Organizacion::getFirst();

                        @endphp
                        <img src="{{ $organizacion->logotipo }}" class="img-fluid" alt="" width="70">
                    </div>
                    <div class="border col-4 text-center">
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
                            <span
                                style="font-size: 11px">{{ \Carbon\Carbon::parse($evaluacion->fecha_inicio)->format('d-m-Y') }}</span>
                        </p>
                        <p class="m-0" style="font-size:11px">
                            <strong>Fecha Fin:</strong>
                            <span
                                style="font-size: 11px">{{ \Carbon\Carbon::parse($evaluacion->fecha_fin)->format('d-m-Y') }}</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    {{-- <div class="p-1 text-center col-12" style="background: #3e3e3e">
                    <h6 class="m-0 text-white">Informe de resultados</h6>
                </div> --}}
                    <div class="text-center form-group col-12"
                        style="background-color:#345183; border-radius: 100px; color: white;">
                        DATOS DEL EVALUADO
                    </div>
                    <div class="col-12">
                        <div class="row align-items-center" style="font-size:12px">
                            <div class="border col-3">
                                <p class="m-0">Nombre del evaluado:</p>
                            </div>
                            <div class="border col-9">
                                <p class="m-0">{{ $evaluado->name }}</p>
                                <input type="text" name="evaname" id="evaname" value="{{ $evaluado->name }}" disabled
                                    hidden>
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
                    {{-- <div class="p-1 text-center col-12" style="background: #3e3e3e">
                    <h6 class="m-0 text-white">Metodología utilizada</h6>
                </div> --}}
                    {{-- <div class="mt-2 text-center form-group col-12"
                        style="background-color:#345183; border-radius: 100px; color: white; text-transform: uppercase;">
                        Metodología utilizada
                    </div>
                    <p class="p-0 col-12" style="font-size:11px; text-align: justify;">
                        Método de evaluación 360°: La evaluación de 360° también conocida como evaluación integral, es
                        una
                        herramienta muy utilizada. Esta evaluación ayuda a identificar las fortalezas y necesidades de
                        desarrollo de los subordinados solicitando información a todas aquellas personas que interactúan
                        con
                        el
                        colaborador, que abarcan jefes y compañeros, además de brindarle
                        una amplia retroalimentación de su desempeño; estos resultados son necesarios para tomar medidas
                        en
                        cuanto a mejorar su desempeño, comportamiento o ambos, y dar a la gerencia la información
                        necesaria
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
                        Esta forma ayuda a reducir los desvíos a partir de proveer una retroalimentación equilibradadada
                        la
                        variedad de fuentes
                    </p> --}}

                    <div class="col-12">
                        <div class="mt-1 row justify-content-between">
                            <div class="mt-2 text-center form-group col-12"
                                style="background-color:#345183; border-radius: 100px; color: white; text-transform: uppercase;">
                                Resultados Generales obtenidos
                            </div>
                            <div class="col-4" style="font-size:12px">
                                <div class="text-center row align-items-center">
                                    <div class="border col-6" style="background: #3e3e3e">
                                        <p class="m-0 text-white">Calificación Final</p>
                                    </div>
                                    <div class="border col-6">
                                        <p class="m-0">{{ round($calificacion_final) }}%</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4" style="font-size:12px">
                                <div class="text-center row align-items-center">
                                    <div class="border col-6" style="background: #3e3e3e">
                                        <p class="m-0 text-white">Competencias</p>
                                    </div>
                                    <div class="border col-6">
                                        <p class="m-0">
                                            {{ round(($promedio_competencias * $peso_general_competencias) / $peso_general_competencias, 2) }}%
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4" style="font-size:12px">
                                <div class="text-center row align-items-center">
                                    <div class="border col-6" style="background: #3e3e3e">
                                        <p class="m-0 text-white">Objetivos</p>
                                    </div>
                                    <div class="border col-6">
                                        <p class="m-0">
                                            {{ round(($promedio_general_objetivos / $peso_general_objetivos) * $peso_general_objetivos, 2) }}%
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2 text-center form-group col-12"
                style="background-color:#345183; border-radius: 100px; color: white; text-transform: uppercase;">
                Resultado de la evaluación por competencias
            </div>
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="col-12">
                {{-- <div class="mt-2 row">
                    <div class="p-0 col-12 progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $calificacion_final }}%;"
                            aria-valuenow="{{ $calificacion_final }}" aria-valuemin="0" aria-valuemax="100">
                            {{ $calificacion_final }}%
                        </div>
                    </div>
                </div> --}}
                <div class="mt-2">
                    <span style="font-size: 11px">{{ $lista_autoevaluacion->first()['tipo'] ?? '' }}</span>
                    <span style="font-size: 11px">{{ $lista_autoevaluacion->first()['peso_general'] ?? '' }}%</span>
                    <button id="btnExportarAutoevaluacion" class="btn-sm rounded pr-2"
                        style="background-color:#fff; border: #fff">
                        <i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"
                            title="Exportar Excel Autoevaluación"></i>
                    </button>
                    @forelse ($lista_autoevaluacion->first()['evaluaciones'] as $evaluador)
                        @include(
                            'admin.recursos-humanos.evaluacion-360.evaluaciones.consultas.evaluacion_competencia_template',
                            [
                                'tipo' => 'autoevaluacion',
                            ]
                        )
                    @empty
                        <div class="text-muted" style="font-size:11px"><i class="fas fa-exclamation-triangle"></i> No
                            aplica
                            para la evaluación
                        </div>
                    @endforelse
                </div>

                <div class="mt-2">
                    <span style="font-size: 11px">{{ $lista_jefe_inmediato->first()['tipo'] }}</span>
                    <span style="font-size: 11px">{{ $lista_jefe_inmediato->first()['peso_general'] }}%</span>
                    <button id="btnExportarJefe" class="btn-sm rounded pr-2" style="background-color:#fff; border: #fff">
                        <i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"
                            title="Exportar Excel Jefe"></i>
                    </button>
                    @forelse ($lista_jefe_inmediato->first()['evaluaciones'] as $evaluador)
                        @include(
                            'admin.recursos-humanos.evaluacion-360.evaluaciones.consultas.evaluacion_competencia_template',
                            ['tipo' => 'jefe']
                        )
                    @empty
                        <div class="text-muted" style="font-size:11px"><i class="fas fa-exclamation-triangle"></i> No
                            aplica
                            para la evaluación
                        </div>
                    @endforelse
                </div>

                <div class="mt-2">
                    <span style="font-size: 11px">Subordinado</span>
                    <span style="font-size: 11px">{{ $lista_equipo_a_cargo->first()['peso_general'] }}%</span>
                    <button id="btnExportarSubordinado" class="btn-sm rounded pr-2"
                        style="background-color:#fff; border: #fff">
                        <i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"
                            title="Exportar Excel Subordinado"></i>
                    </button>
                    @forelse ($lista_equipo_a_cargo->first()['evaluaciones'] as $evaluador)
                        @include(
                            'admin.recursos-humanos.evaluacion-360.evaluaciones.consultas.evaluacion_competencia_template',
                            ['tipo' => 'equipo']
                        )
                    @empty
                        <div class="text-muted" style="font-size:11px"><i class="fas fa-exclamation-triangle"></i> No
                            aplica
                            para la evaluación
                        </div>
                    @endforelse
                </div>

                <div class="mt-2">
                    <span style="font-size: 11px">Par</span>
                    <span style="font-size: 11px">{{ $lista_misma_area->first()['peso_general'] }}%</span>
                    <button id="btnExportarPar" class="btn-sm rounded pr-2" style="background-color:#fff; border: #fff">
                        <i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"
                            title="Exportar Excel Colega"></i>
                    </button>
                    @forelse ($lista_misma_area->first()['evaluaciones'] as $evaluador)
                        @include(
                            'admin.recursos-humanos.evaluacion-360.evaluaciones.consultas.evaluacion_competencia_template',
                            [
                                'tipo' => 'misma_area',
                            ]
                        )
                    @empty
                        <div class="text-muted" style="font-size:11px"><i class="fas fa-exclamation-triangle"></i> No
                            aplica
                            para la evaluación
                        </div>
                    @endforelse
                </div>
                <div class="mt-3 row">
                    <div class="col-8"></div>
                    <div class="col-4">
                        <p class="m-0 text-center text-white" style="background: #3e3e3e; border: 1px solid #fff">
                            Competencias
                        </p>
                        <div class="col-12" style="font-size:11px">
                            <div class="row">
                                <div class="border col-6">Promedio</div>
                                <div class="border col-6">
                                    {{ number_format(($promedio_competencias * 100) / $peso_general_competencias / 100, 2) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="border col-6">% Participación</div>
                                <div class="border col-6">
                                    {{ round(($promedio_competencias * 100) / $peso_general_competencias, 2) }}%</div>
                            </div>
                            <div class="row">
                                <div class="border col-6">Promedio total en la evaluación</div>
                                <div class="border col-6">
                                    {{ round(($promedio_competencias / $peso_general_competencias) * $peso_general_competencias, 2) }}%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2 text-center form-group col-12"
                style="background-color:#345183; border-radius: 100px; color: white; text-transform: uppercase;">
                Gráficas Competencias
            </div>
            <div id="graficasCompetencias">
                <div class="row">
                    <div class="col-12" x-data="{ show: false }">
                        <div style="display: flex;justify-content: end">
                            <button title="Gráfica Radar" @click="show=true" class="btn btn-sm"
                                x-bind:style="show ? 'background:blue;color:white' : 'backgrond:white'"><i
                                    class="fas fa-chart-area"></i></button>
                            <button title="Gráfica de Barras" @click="show=false" class="btn btn-sm"
                                x-bind:style="!show ? 'background:blue;color:white' : 'backgrond:white'"><i
                                    class="fas fa-chart-bar"></i></button>
                        </div>
                        <div x-show="show" x-transition>
                            <canvas id="radarCompetencias" width="400" height="400"></canvas>
                        </div>
                        <div x-show="!show" x-transition>
                            <canvas id="barCompetencias" width="400" height="400"></canvas>
                        </div>
                    </div>
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
            <div class="col-12">
                <div class="mt-4 row">
                    <div class="mt-2 text-center form-group col-12"
                        style="background-color:#345183; border-radius: 100px; color: white; text-transform: uppercase;">
                        Resultado de la evaluación por objetivos
                    </div>
                </div>
            </div>
            <div class="col-12">
                <small><i class="fas fa-info mr-1"></i> Para editar la columna "logrado" se debe posicionar sobre el
                    número y dar doble clic, se habilitará un input y podrá realizar la edición.
                    Una vez que termine de editar recargue la página para que se vean reflejados los cambios. </small>

                <table id="tblobjetivos" hidden>
                    <thead>
                        <th>Evaluador</th>
                        <th>
                            Objetivo
                        </th>
                        <th>
                            KPI
                        </th>
                        <th>
                            Puesto
                        </th>
                        <th>
                            Logrado
                        </th>
                        <th>
                            <small>Descripción</small>
                        </th>
                        <th>
                            Comentarios
                        </th>
                    </thead>
                    @forelse ($evaluadores_objetivos as $evaluador)
                        <tbody>
                            <div class="col-12" id="tblObjetivosSupervisor">
                                @forelse ($evaluador['objetivos'] as $idx => $objetivo)
                                    <tr>
                                        @if ($evaluador['esAutoevaluacion'])
                                            <td>{{ $evaluador['nombre'] }}</td>
                                        @endif
                                        @if ($evaluador['esSupervisor'])
                                            <td>{{ $jefe_evaluador->name }}</td>
                                        @endif
                                        <td>
                                            {{ $objetivo['nombre'] }}
                                        </td>
                                        <td>
                                            {{ $objetivo['KPI'] }}
                                        </td>
                                        <td>
                                            {{ $objetivo['meta'] }} {{ $objetivo['metrica'] }}
                                        </td>
                                        <td>
                                            {{ $objetivo['calificacion'] }} {{ $objetivo['metrica'] }}
                                        </td>
                                        <td>
                                            {{ $objetivo['descripcion_meta'] ? $objetivo['descripcion_meta'] : 'N/A' }}
                                        </td>
                                        <td>
                                            {{ $objetivo['meta_alcanzada'] }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <strong class="text-muted">
                                            <i class="fas fa-info-circle"></i>
                                            Sin objetivos a evaluar
                                        </strong>
                                    </tr>
                                @endforelse
                            @empty
                                <tr>Sin objetivos a evaluar</tr>
                    @endforelse
                    {{-- <tr></tr>
                <tr>
                    <td>Objetivo</td>
                </tr>
                <tr>
                <td>Promedio</td>
                <td>{{ number_format($promedio_objetivos / 100, 2) }}</td>
                </tr>
            <tr>
                <td>% Participación</td>
                <td>{{ number_format($promedio_objetivos, 2) }}%<td>
                </tr> --}}
                    </tbody>
                </table>
                <div class="text-center">
                    <button id="btnExportar" class="btn-sm rounded pr-2" style="background-color:#fff; border: #fff">
                        <i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935" title="Exportar Excel"></i>
                    </button>
                </div>
                @forelse ($evaluadores_objetivos as $evaluador)
                    <div class="row">
                        <div class="col-12">
                            <div class="mt-2 row">
                                <div class="col-12" style="font-size: 12px">
                                    Evaluación realizada por:
                                    @if ($evaluador['esAutoevaluacion'])
                                        <strong> {{ $evaluador['nombre'] }}</strong>
                                        <span class="badge badge-primary">Autoevaluación</span>
                                    @endif
                                    @if ($evaluador['esSupervisor'])
                                        <strong> {{ $jefe_evaluador->name }}</strong>
                                        <span class="badge badge-success">Evaluador</span>
                                    @endif
                                </div>
                                <div class="text-center text-white col-2"
                                    style="background: #3e3e3e; border: 1px solid #fff; font-size:11px">
                                    <small>Objetivo</small>
                                </div>
                                <div class="text-center text-white col-3"
                                    style="background: #3e3e3e; border: 1px solid #fff; font-size:11px"><small>KPI</small>
                                </div>
                                <div class="text-center text-white col-1"
                                    style="background: #3e3e3e; border: 1px solid #fff; font-size:11px">
                                    <small>Puesto</small>
                                </div>
                                <div class="text-center text-white col-1"
                                    style="background: #3e3e3e; border: 1px solid #fff; font-size:11px">
                                    <small>Logrado</small>
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
                        <div class="col-12" id="tblObjetivosSupervisor">
                            @forelse ($evaluador['objetivos'] as $idx => $objetivo)
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
                                        <span
                                            data-objetivo-calificacion="{{ $objetivo['objetivo_calificacion_id'] }}">{{ $objetivo['calificacion'] }}</span>
                                        {{ $objetivo['metrica'] }}
                                    </div>
                                    <div class="text-center border col-2" style="font-size:10px">
                                        {{ $objetivo['descripcion_meta'] ? $objetivo['descripcion_meta'] : 'N/A' }}
                                    </div>
                                    <div class="text-center border col-3" style="font-size:10px">
                                        {{ $objetivo['meta_alcanzada'] }}
                                    </div>
                                </div>
                            @empty
                                <div>
                                    <strong class="text-muted">
                                        <i class="fas fa-info-circle"></i>
                                        Sin objetivos a evaluar
                                    </strong>
                                </div>
                            @endforelse
                        </div>
                    </div>
                @empty
                    <div>Sin objetivos a evaluar</div>
                @endforelse
            </div>
            <div class="col-12">
                <div class="mt-3 row" style="font-size:11px">
                    <div class="col-8"></div>
                    <div class="col-4">
                        <p class="m-0 text-center text-white" style="background: #3e3e3e; border: 1px solid #fff">
                            Objetivos
                        </p>
                        <div class="col-12">
                            <div class="row">
                                <div class="border col-6">Promedio</div>
                                <div class="border col-6">{{ number_format($promedio_objetivos / 100, 2) }}</div>
                            </div>
                            <div class="row">
                                <div class="border col-6">% Participación</div>
                                <div class="border col-6">{{ round($promedio_objetivos, 2) }}%</div>
                            </div>
                            <div class="row">
                                <div class="border col-6">Promedio total en la evaluación</div>
                                <div class="border col-6">
                                    {{ round(($promedio_general_objetivos / $peso_general_objetivos) * $peso_general_objetivos, 2) }}%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2 text-center form-group col-12"
                style="background-color:#345183; border-radius: 100px; color: white; text-transform: uppercase;">
                Gráficas Objetivos
            </div>
            <div id="graficasObjetivos">
                <div class="row">
                    <div class="col-12" x-data="{ show: false }">
                        <div style="display: flex;justify-content: end">
                            <button title="Gráfica Radar" @click="show=true" class="btn btn-sm"
                                x-bind:style="show ? 'background:blue;color:white' : 'backgrond:white'"><i
                                    class="fas fa-chart-area"></i></button>
                            <button title="Gráfica de Barras" @click="show=false" class="btn btn-sm"
                                x-bind:style="!show ? 'background:blue;color:white' : 'backgrond:white'"><i
                                    class="fas fa-chart-bar"></i></button>
                        </div>
                        <div x-show="show" x-transition>
                            <canvas id="objetivosGrafica" height="500"></canvas>
                        </div>
                        <div x-show="!show" x-transition>
                            <canvas id="barObjetivos" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2 text-center form-group col-12"
                style="background-color:#345183; border-radius: 100px; color: white; text-transform: uppercase;">
                Sección de Firmas
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-6 border text-center">
                        <img class="img-fluid" src="{{ asset($firmaAuto) }}"
                            style="{{ !$existeFirmaAuto ? 'max-width:97px' : '' }}" />
                        <h6 class="my-2">Firma Autoevaluación</h6>
                    </div>
                    <div class="col-6 border text-center">
                        <img class="img-fluid" src="{{ asset($firmaJefe) }}"
                            style="{{ !$existeFirmaJefe ? 'max-width:97px' : '' }}" />
                        <h6 class="my-2">Firma Jefe Inmediato</h6>
                    </div>
                    {{-- <div class="col-3 border text-center">
                        <img class="img-fluid" src="{{ asset($firmaEquipo) }}"
                            style="{{ !$existeFirmaSubordinado ? 'max-width:97px' : '' }}" />
                        <h6 class="my-2">Firma Subordinado</h6>
                    </div>
                    <div class="col-3 border text-center">
                        <img class="img-fluid" src="{{ asset($firmaPar) }}"
                            style="{{ !$existeFirmaPar ? 'max-width:97px' : '' }}" />
                        <h6 class="my-2">Firma Par</h6>
                    </div> --}}
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/xlsx@0.16.9/dist/xlsx.full.min.js"></script>

    <script src="https://unpkg.com/file-saverjs@latest/FileSaver.min.js"></script>

    <script src="https://unpkg.com/tableexport@latest/dist/js/tableexport.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <script>
        const $btnExportar = document.querySelector("#btnExportar"),
            $tabla = document.querySelector("#tblobjetivos");

        $btnExportar.addEventListener("click", function() {
            let tableExport = new TableExport($tabla, {
                exportButtons: false, // No queremos botones
                filename: "Evaluacion Individual", //Nombre del archivo de Excel
                sheetname: "Evaluacion Objetivos", //Título de la hoja
            });
            let datos = tableExport.getExportData();
            console.log(datos.tblobjetivos.xlsx.data);

            // console.log(datos.tblobjetivos);
            // console.log(datos.tblobjetivos.xlsx);
            // console.log(datos.tblobjetivos.xlsx.data);
            let preferenciasDocumento = datos.tblobjetivos.xlsx;
            tableExport.export2file(preferenciasDocumento.data, preferenciasDocumento.mimeType,
                preferenciasDocumento.filename, preferenciasDocumento.fileExtension, preferenciasDocumento
                .merges, preferenciasDocumento.RTL, preferenciasDocumento.sheetname);
        });
    </script>

    <script>
        const $btnExportarAutoevaluacion = document.querySelector("#btnExportarAutoevaluacion"),
            $tablaauto = document.querySelector("#autoevaluacion");

        $btnExportarAutoevaluacion.addEventListener("click", function() {
            let nombeva = document.getElementById("evaname").value;
            let tableExport = new TableExport($tablaauto, {
                exportButtons: false, // No queremos botones
                filename: "Evaluacion Competencias de " + nombeva +
                    "-Autoevaluacion", //Nombre del archivo de Excel
                sheetname: "Evaluacion Competencias", //Título de la hoja
            });
            let datos = tableExport.getExportData();
            console.log(datos.autoevaluacion.xlsx.data);

            // console.log(datos.tblobjetivos);
            // console.log(datos.tblobjetivos.xlsx);
            // console.log(datos.tblobjetivos.xlsx.data);
            let preferenciasDocumento = datos.autoevaluacion.xlsx;
            tableExport.export2file(preferenciasDocumento.data, preferenciasDocumento.mimeType,
                preferenciasDocumento.filename, preferenciasDocumento.fileExtension, preferenciasDocumento
                .merges, preferenciasDocumento.RTL, preferenciasDocumento.sheetname);
        });
    </script>

    <script>
        const $btnExportarJefe = document.querySelector("#btnExportarJefe"),
            $tablajefe = document.querySelector("#jefe");

        $btnExportarJefe.addEventListener("click", function() {
            let nombeva = document.getElementById("evaname").value;
            let tableExport = new TableExport($tablajefe, {
                exportButtons: false, // No queremos botones
                filename: "Evaluacion Competencias de " + nombeva + "-Jefe", //Nombre del archivo de Excel
                sheetname: "Evaluacion Competencias", //Título de la hoja
            });
            let datos = tableExport.getExportData();
            console.log(datos.jefe.xlsx.data);

            // console.log(datos.tblobjetivos);
            // console.log(datos.tblobjetivos.xlsx);
            // console.log(datos.tblobjetivos.xlsx.data);
            let preferenciasDocumento = datos.jefe.xlsx;
            tableExport.export2file(preferenciasDocumento.data, preferenciasDocumento.mimeType,
                preferenciasDocumento.filename, preferenciasDocumento.fileExtension, preferenciasDocumento
                .merges, preferenciasDocumento.RTL, preferenciasDocumento.sheetname);
        });
    </script>

    <script>
        const $btnExportarSubordinado = document.querySelector("#btnExportarSubordinado"),
            $tablasub = document.querySelector("#equipo");

        $btnExportarSubordinado.addEventListener("click", function() {
            let nombeva = document.getElementById("evaname").value;
            let tableExport = new TableExport($tablasub, {
                exportButtons: false, // No queremos botones
                filename: "Evaluacion Competencias de " + nombeva +
                    "-Subordinado", //Nombre del archivo de Excel
                sheetname: "Evaluacion Competencias", //Título de la hoja
            });
            let datos = tableExport.getExportData();
            console.log(datos.equipo.xlsx.data);

            // console.log(datos.tblobjetivos);
            // console.log(datos.tblobjetivos.xlsx);
            // console.log(datos.tblobjetivos.xlsx.data);
            let preferenciasDocumento = datos.equipo.xlsx;
            tableExport.export2file(preferenciasDocumento.data, preferenciasDocumento.mimeType,
                preferenciasDocumento.filename, preferenciasDocumento.fileExtension, preferenciasDocumento
                .merges, preferenciasDocumento.RTL, preferenciasDocumento.sheetname);
        });
    </script>

    <script>
        const $btnExportarPar = document.querySelector("#btnExportarPar"),
            $tablapar = document.querySelector("#misma_area");

        $btnExportarPar.addEventListener("click", function() {
            let nombeva = document.getElementById("evaname").value;
            let tableExport = new TableExport($tablapar, {
                exportButtons: false, // No queremos botones
                filename: "Evaluacion Competencias de " + nombeva + "-Colega", //Nombre del archivo de Excel
                sheetname: "Evaluacion Competencias", //Título de la hoja
            });
            let datos = tableExport.getExportData();
            console.log(datos.misma_area.xlsx.data);

            // console.log(datos.tblobjetivos);
            // console.log(datos.tblobjetivos.xlsx);
            // console.log(datos.tblobjetivos.xlsx.data);
            let preferenciasDocumento = datos.misma_area.xlsx;
            tableExport.export2file(preferenciasDocumento.data, preferenciasDocumento.mimeType,
                preferenciasDocumento.filename, preferenciasDocumento.fileExtension, preferenciasDocumento
                .merges, preferenciasDocumento.RTL, preferenciasDocumento.sheetname);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('si');
            document.querySelectorAll("#tblObjetivosSupervisor div:nth-child(4) span").forEach(function(node) {
                node.style.cursor = "pointer";
                node.ondblclick = function() {
                    let span = this;
                    var oldVal = span.innerHTML;
                    var input = document.createElement("input")
                    input.setAttribute("type", "number");
                    input.style.width = "40px";
                    input.style.outline = "none";
                    input.value = oldVal;
                    input.onblur = function(e) {
                        let newVal = e.target.value;
                        if (oldVal != newVal) {
                            let data = {
                                id: e.target.parentNode.getAttribute(
                                    'data-objetivo-calificacion'),
                                calificacion: newVal
                            }
                            $.ajax({
                                type: "POST",
                                url: "{{ route('admin.ev360-evaluaciones.normalizar.objetivo') }}",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                data: data,
                                dataType: "JSON",
                                beforeSend: function() {
                                    e.target.closest('span').innerHTML =
                                        `<strong style="font-size:7px"><i style="font-size:5px" class="fas fa-circle-notch fa-spin"></i> Guardando</strong>`;
                                },
                                success: function(response) {

                                    if (response.success) {
                                        span.innerHTML =
                                            `<i class="fas fa-check text-success"></i> ${newVal}`;
                                        setTimeout(() => {
                                            span.innerHTML = newVal;
                                        }, 2000);

                                    }
                                },
                                error: function(request, status, error) {
                                    toastr.error(error);
                                }
                            });
                        } else {
                            span.innerHTML = oldVal;
                        }
                    }
                    span.innerHTML = "";
                    span.appendChild(input);
                    input.focus();
                }
            });

            let labels = @json($competencias_lista_nombre);
            let data = {
                labels: labels,
                datasets: [{
                    label: 'Puesto',
                    backgroundColor: 'rgb(46, 204, 65)',
                    borderColor: 'rgb(46, 204, 65)',
                    data: @json($nivelesEsperadosCompetencias),
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
                            text: 'Puesto vs Calificación Jefe Inmediato',
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
                    label: 'Puesto',
                    backgroundColor: 'rgb(46, 204, 65)',
                    borderColor: 'rgb(46, 204, 65)',
                    data: @json($nivelesEsperadosCompetencias),
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
                            text: 'Puesto vs Calificación Subordinado',
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
                    label: 'Puesto',
                    backgroundColor: 'rgb(46, 204, 65)',
                    borderColor: 'rgb(46, 204, 65)',
                    data: @json($nivelesEsperadosCompetencias),
                }, {
                    label: 'Par',
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
                            text: 'Puesto vs Calificación Par',
                        }
                    }
                }
            };
            var myChart = new Chart(
                document.getElementById('areaGrafica'),
                configArea
            );
            //Radar
            const dataRadar = {
                labels: @json($competencias_lista_nombre),
                datasets: [{
                        label: 'Puesto',
                        data: @json($nivelesEsperadosCompetencias),
                        fill: true,
                        backgroundColor: 'rgba(51,109,255, 0.5)',
                        borderColor: 'rgb(51,109,255)',
                        pointBackgroundColor: 'rgb(51,109,255)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(51,109,255)'
                    }, {
                        label: 'Jefe Inmediato',
                        data: @json($calificaciones_jefe_competencias),
                        fill: true,
                        backgroundColor: 'rgba(192, 57, 43, 0.5)',
                        borderColor: 'rgb(192, 57, 43)',
                        pointBackgroundColor: 'rgb(192, 57, 43)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(192, 57, 43)'
                    },
                    {
                        label: 'Subordinado',
                        data: @json($calificaciones_equipo_competencias),
                        fill: true,
                        backgroundColor: 'rgba(46, 204, 65, 0.5)',
                        borderColor: 'rgb(46, 204, 65)',
                        pointBackgroundColor: 'rgb(46, 204, 65)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(46, 204, 65)'
                    }, {
                        label: 'Par',
                        data: @json($calificaciones_area_competencias),
                        fill: true,
                        backgroundColor: 'rgba(250, 0, 53 , 0.5)',
                        borderColor: 'rgb(250, 0, 53 )',
                        pointBackgroundColor: 'rgb(250, 0, 53 )',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(250, 0, 53 )'
                    }
                ]
            };
            const configRadar = {
                type: 'radar',
                data: dataRadar,
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Promedios'
                        },
                        legend: {
                            display: true
                        },
                    },
                    scale: {
                        min: 0,
                    },
                }
            };
            let radarChart = new Chart(
                document.getElementById('radarCompetencias'),
                configRadar
            );
            const configBarCompetenciasChart = {
                type: 'bar',
                data: dataRadar,
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Promedios'
                        },
                        legend: {
                            display: true
                        },
                    },
                    scale: {
                        min: 0,
                    },
                }
            };
            let barCompetenciasChart = new Chart(
                document.getElementById('barCompetencias'),
                configBarCompetenciasChart
            );
            //OBJETIVOS
            const dataRadarObjetivos = {
                labels: @json($nombresObjetivos),
                datasets: [{
                    label: 'Puesto',
                    data: @json($metaObjetivos),
                    fill: true,
                    backgroundColor: 'rgba(51,109,255, 0.5)',
                    borderColor: 'rgb(51,109,255)',
                    pointBackgroundColor: 'rgb(51,109,255)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(51,109,255)'
                }, {
                    label: 'Califiación Jefe',
                    data: @json($calificacionObjetivos),
                    fill: true,
                    backgroundColor: 'rgba(46, 204, 65, 0.5)',
                    borderColor: 'rgb(46, 204, 65)',
                    pointBackgroundColor: 'rgb(46, 204, 65)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(46, 204, 65)'
                }]
            };
            const configRadarObjetivos = {
                type: 'radar',
                data: dataRadarObjetivos,
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Objetivos'
                        },
                        legend: {
                            display: true
                        },
                    },
                    scale: {
                        min: 0,
                    },
                }
            };

            let objetivosChart = new Chart(
                document.getElementById('objetivosGrafica'),
                configRadarObjetivos
            );
            const configBarObjetivos = {
                type: 'bar',
                data: dataRadarObjetivos,
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Objetivos'
                        },
                        legend: {
                            display: true
                        },
                    },
                    scale: {
                        min: 0,
                    },
                }
            };

            let objetivosBarChart = new Chart(
                document.getElementById('barObjetivos'),
                configBarObjetivos
            );
        });
    </script>
@endsection
