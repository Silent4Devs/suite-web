@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('EV360-Evaluaciones-Create') }}

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
                            <p class="m-0">100%</p>
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
                            <p class="m-0">40%</p>
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
                            <p class="m-0">64%</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 row">
                <div class="p-2 text-center col-12" style="background: #3e3e3e">
                    <h6 class="m-0 text-white">Evaluación de competencias</h6>
                </div>
            </div>
            @foreach ($evaluadores_competencias as $evaluador)
                <div class="row">
                    <div class="col-12">
                        <div class="mt-2 row">
                            <div class="col-6">
                                Evaluación realizada por:
                                <strong> {{ $evaluador['nombre'] }}</strong>
                                <span class="badge badge-primary">{{ $evaluador['tipo'] }}</span>
                            </div>
                            <div class="text-center col-2"><small>Alcanzado</small></div>
                            <div class="text-center col-1"><small>Meta</small></div>
                            <div class="text-center col-2"><small>Calificación</small></div>
                            <div class="text-center col-1"><small>Peso</small></div>
                        </div>
                    </div>
                    <div class="col-12">
                        @foreach ($evaluador['competencias'] as $idx => $competencia)
                            <div class="row">
                                <div class="text-white col-6" style="background: #3e3e3e; border: 1px solid #fff">
                                    {{ $idx + 1 }}.- {{ $competencia['competencia'] }}
                                </div>
                                <div class="text-center border col-2">
                                    {{ $competencia['calificacion'] }}
                                </div>
                                <div class="text-center border col-1">
                                    {{ $competencia['meta'] }}
                                </div>
                                <div class="text-center border col-2">
                                    {{ $competencia['porcentaje'] }}
                                </div>
                                <div class="text-center border col-1">
                                    {{ $competencia['peso'] }} %
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
            <div class="mt-3 row">
                <div class="col-8"></div>
                <div class="col-4">
                    <p class="m-0 text-center text-white" style="background: #3e3e3e; border: 1px solid #fff">Competencias
                    </p>
                    <div class="col-12">
                        <div class="row">
                            <div class="border col-6">Promedio</div>
                            <div class="border col-6">0</div>
                        </div>
                        <div class="row">
                            <div class="border col-6">% Participación</div>
                            <div class="border col-6">0%</div>
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
                            <div class="border col-6">0</div>
                        </div>
                        <div class="row">
                            <div class="border col-6">% Participación</div>
                            <div class="border col-6">0%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
