@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('EV360-Evaluaciones-Create') }}
    <style>
        .fs-consulta {
            font-size: 11px;
        }

    </style>
    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Evaluación </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="p-2 text-center col-12" style="background: #3e3e3e">
                    <h6 class="m-0 text-white">Información General</h6>
                </div>
            </div>
            <div class="mt-2 row justify-content-between">
                <div class="col-7">
                    <div class="text-center row align-items-center">
                        <div class="border col-3" style="background: #3e3e3e">
                            <p class="m-0 text-white">Nombre</p>
                        </div>
                        <div class="border col-9">
                            <p class="m-0">{{ $evaluado->name }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="text-center row align-items-center">
                        <div class="border col-6" style="background: #3e3e3e">
                            <p class="m-0 text-white">Calificación Final</p>
                        </div>
                        <div class="border col-6">
                            <p class="m-0">{{ $calificacion_final }}%</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2 row justify-content-between">
                <div class="col-7">
                    <div class="text-center row align-items-center">
                        <div class="border col-3" style="background: #3e3e3e">
                            <p class="m-0 text-white">Puesto</p>
                        </div>
                        <div class="border col-9">
                            <p class="m-0">{{ $evaluado->puesto }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="text-center row align-items-center">
                        <div class="border col-6" style="background: #3e3e3e">
                            <p class="m-0 text-white">Competencias</p>
                        </div>
                        <div class="border col-6">
                            <p class="m-0">{{ $promedio_general_competencias }}%</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2 row justify-content-between">
                <div class="col-7">
                    <div class="text-center row align-items-center">
                        <div class="border col-3" style="background: #3e3e3e">
                            <p class="m-0 text-white">Área</p>
                        </div>
                        <div class="border col-9">
                            <p class="m-0">{{ $evaluado->area->area }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-4">
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
            <div class="mt-4 row">
                <div class="p-2 text-center col-12" style="background: #3e3e3e">
                    <h6 class="m-0 text-white">Evaluación de competencias</h6>
                </div>
            </div>

            <div class="mt-2">
                <span>{{ $lista_autoevaluacion->first()['tipo'] }}</span>
                <span>{{ $lista_autoevaluacion->first()['peso_general'] }}%</span>
                @forelse ($lista_autoevaluacion->first()['evaluaciones'] as $evaluador)
                    @include('admin.recursos-humanos.evaluacion-360.evaluaciones.consultas.evaluacion_competencia_template')
                @empty
                    <div class="text-muted" style="font-size:11px"><i class="fas fa-exclamation-triangle"></i> No aplica
                        para la evaluación
                    </div>
                @endforelse
            </div>

            <div class="mt-2">
                <span>{{ $lista_jefe_inmediato->first()['tipo'] }}</span>
                <span>{{ $lista_jefe_inmediato->first()['peso_general'] }}%</span>
                @forelse ($lista_jefe_inmediato->first()['evaluaciones'] as $evaluador)
                    @include('admin.recursos-humanos.evaluacion-360.evaluaciones.consultas.evaluacion_competencia_template')
                @empty
                    <div class="text-muted" style="font-size:11px"><i class="fas fa-exclamation-triangle"></i> No aplica
                        para la evaluación
                    </div>
                @endforelse
            </div>

            <div class="mt-2">
                <span>{{ $lista_equipo_a_cargo->first()['tipo'] }}</span>
                <span>{{ $lista_equipo_a_cargo->first()['peso_general'] }}%</span>
                @forelse ($lista_equipo_a_cargo->first()['evaluaciones'] as $evaluador)
                    @include('admin.recursos-humanos.evaluacion-360.evaluaciones.consultas.evaluacion_competencia_template')
                @empty
                    <div class="text-muted" style="font-size:11px"><i class="fas fa-exclamation-triangle"></i> No aplica
                        para la evaluación
                    </div>
                @endforelse
            </div>

            <div class="mt-2">
                <span>{{ $lista_misma_area->first()['tipo'] }}</span>
                <span>{{ $lista_misma_area->first()['peso_general'] }}%</span>
                @forelse ($lista_misma_area->first()['evaluaciones'] as $evaluador)
                    @include('admin.recursos-humanos.evaluacion-360.evaluaciones.consultas.evaluacion_competencia_template')
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
                    <div class="col-12">
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
            <div class="mt-4 row">
                <div class="p-2 text-center col-12" style="background: #3e3e3e">
                    <h6 class="m-0 text-white">Evaluación de objetivos</h6>
                </div>
            </div>
            @foreach ($evaluadores_objetivos as $evaluador)
                <div class="row">
                    <div class="col-12">
                        <div class="mt-2 row">
                            <div class="col-12">
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
                                    style="background: #3e3e3e; border: 1px solid #fff; font-size:11px">
                                    {{ $objetivo['nombre'] }}
                                </div>
                                <div class="text-center border col-3" style="font-size:11px">
                                    {{ $objetivo['KPI'] }}
                                </div>
                                <div class="text-center border col-1" style="font-size:11px">
                                    {{ $objetivo['meta'] }} {{ $objetivo['metrica'] }}
                                </div>
                                <div class="text-center border col-1" style="font-size:11px">
                                    {{ $objetivo['calificacion'] }} {{ $objetivo['metrica'] }}
                                </div>
                                <div class="text-center border col-2" style="font-size:11px">
                                    {{ $objetivo['descripcion_meta'] ? $objetivo['descripcion_meta'] : 'N/A' }}
                                </div>
                                <div class="text-center border col-3" style="font-size:11px">
                                    {{ $objetivo['meta_alcanzada'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
            <div class="mt-3 row">
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
        </div>
    </div>
@endsection

@section('scripts')
@endsection
