<div>
    <div class="card">
        <div class="card-body">
            <div class="card border-0">
                <div class="card-title mb-0 d-flex align-items-center justify-content-around"
                    style="border-top-left-radius: 14px; border-top-right-radius:14px;background-color: #BB68A8; color:#FFFFFF; height: 90px;">
                    <h5 class="ml-3">Competencias</h5>
                    <h6>Evaluación de competencias: {{ $evaluacion->nombre }}</h6>
                    <h6 style="margin-left: 200px;">Inicia: 20/02/2024</h6>
                    <h6>Fin: 20/02/2024</h6>
                </div>
                <div class="card-body">
                    @if ($autoevaluacion)
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-12 col-sm-2 d-flex flex-column justify-content-center align-items-center">
                                <h6 class="title-nombre">Autoevaluacion</h6>
                                <div class="img-person d-flex justify-content-center align-items-center"
                                    style="width: 69px; height:69px;">
                                    <img src="" alt="">
                                </div>
                                <div class="title-status status-procces">
                                    En proceso
                                </div>
                            </div>
                            <div class="col-1 col-sm-1">
                                <div class="vertical-line"></div>
                            </div>
                            <div class="col-12 col-sm-2 d-flex flex-column justify-content-center align-items-center">
                                <h6 class="title-nombre">Evaluar a:</h6>
                                <div class="img-person d-flex justify-content-center align-items-center"
                                    style="width: 69px; height:69px;">
                                    <img src="" alt="">
                                </div>
                                <div class="title-status status-pendding">
                                    Pendiente
                                </div>
                            </div>
                            <div class="col-12 col-sm-2 d-flex flex-column justify-content-center align-items-center">
                                <h6 class="title-nombre">Evaluar a:</h6>
                                <div class="img-person d-flex justify-content-center align-items-center"
                                    style="width: 69px; height:69px;">
                                    <img src="" alt="">
                                </div>
                                <div class="title-status status-pendding">
                                    Pendiente
                                </div>
                            </div>
                            <div class="col-12 col-sm-2 d-flex flex-column justify-content-center align-items-center">
                                <h6 class="title-nombre">Evaluar a:</h6>
                                <div class="img-person d-flex justify-content-center align-items-center"
                                    style="width: 69px; height:69px;">
                                    <img src="" alt="">
                                </div>
                                <div class="title-status status-confirm">
                                    Evaluado
                                </div>
                            </div>
                        </div>
                    @endif
                    <hr>
                    @if ($autoevaluacion)
                        <div class="row d-flex align-items-center" style="">
                            <div class="col-3 col-sm-2 col-md-1" style="margin-left:16px;">
                                <div class="img-person" style="width: 69px; height:69px;">
                                    <img src="{{ $evaluado->empleado->avatar_ruta }}" alt="{{ $evaluado->empleado->name }}">
                                </div>
                            </div>
                            <div class="col-6 col-sm-3">
                                <div style="margin-left: 14px;">
                                    <h6 class="title-nombre">{{ $evaluado->empleado->name }}</h6>
                                    <p class="title-puesto m-0">{{ $evaluado->empleado->puesto }}</p>
                                </div>
                            </div>
                            <div class="col-9 col-sm-5">
                                <div class="progress"
                                    style="border-radius: 29px; width:auto; height:12px; margin-left:71px;">
                                    <div class="progress-bar custom-progress" role="progressbar"
                                        style="width: {{ $porcentajeCalificado }}%;"
                                        aria-valuenow="{{ $porcentajeCalificado }}" aria-valuemin="0"
                                        aria-valuemax="100">

                                    </div>
                                </div>
                            </div>
                            <div class="col-3 col-sm-2">
                                <p class="m-0">
                                    {{ $porcentajeCalificado }}%
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="row d-flex align-items-center" style="">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-6 col-sm-5 col-md-1" style="margin-left:16px;">
                                        <div class="img-person" style="width: 69px; height:69px;">
                                            <img src="{{ $evaluado->empleado->avatar_ruta }}"
                                                alt="{{ $evaluado->empleado->name }}">
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-7">
                                        <div style="margin-left: 30px;">
                                            <h6 class="title-nombre">Evaluado: {{ $evaluado->empleado->name }}</h6>
                                            <p class="title-puesto m-0">{{ $evaluado->empleado->puesto }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-3 col-sm-5 col-md-1" style="margin-left:16px;">
                                        <div class="img-person" style="width: 69px; height:69px;">
                                            <img src="{{ $evaluador->avatar_ruta }}" alt="{{ $evaluador->name }}">
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-7">
                                        <div style="margin-left: 30px;">
                                            <h6 class="title-nombre">Evaluador: {{ $evaluador->name }}</h6>
                                            <p class="title-puesto m-0">{{ $evaluador->puesto }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center mt-5">
                            <div class="col-11 col-sm-10">
                                <div class="progress"
                                    style="border-radius: 29px; width:auto; height:12px; margin-left:71px;">
                                    <div class="progress-bar custom-progress" role="progressbar"
                                        style="width: {{ $porcentajeCalificado }}%;"
                                        aria-valuenow="{{ $porcentajeCalificado }}" aria-valuemin="0"
                                        aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 col-sm-2">
                                <p class="m-0">
                                    {{ $porcentajeCalificado }}%
                                </p>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
            <hr>
            {{-- The Master doesn't talk, he acts. --}}
            @if ($validacion_competencias_evaluador)
                {{-- <div class="w-100 row"> --}}
                <table class="w-100">
                    {{-- <thead>
                            <th>Competencias</th>
                            <th>Nivel Esperado</th>
                            <th>Autoevaluación</th>
                            <th>Evaluación</th>
                        </thead> --}}
                    <tbody>
                        @foreach ($competencias_evaluado as $key => $comp_evld)
                            @php
                                $clase = $key % 2 == 0 ? 'par' : 'impar';
                            @endphp
                            <tr class="{{ $clase }}">
                                <td class="th-icon d-flex justify-content-center align-items-center">
                                    <i class="material-icons-outlined" type="button" data-toggle="modal"
                                        data-target="#descripcionCompetencia{{ $comp_evld->id }}">
                                        visibility
                                    </i>
                                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#descripcionCompetencia{{ $comp_evld->id }}">
                                        Launch demo modal
                                    </button> --}}

                                    <!-- Modal -->
                                    <div class="modal fade" id="descripcionCompetencia{{ $comp_evld->id }}"
                                        tabindex="-1"
                                        aria-labelledby="descripcionCompetencia{{ $comp_evld->id }}Label"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="descripcionCompetencia{{ $comp_evld->id }}Label">
                                                        {{ $comp_evld->infoCompetencia->competencia }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>{{ $comp_evld->infoCompetencia->descripcion_competencia }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="td-comp">{{ $comp_evld->infoCompetencia->competencia }}</td>
                                <td>
                                    <div class="auto-cal d-flex justify-content-center align-items-center"
                                        style="background-color: white;">
                                        <p style="margin: 0px;">
                                            Nivel Esperado:
                                            <strong>{{ $comp_evld->infoCompetencia->nivel_esperado }}</strong>
                                        </p>
                                    </div>

                                </td>
                                @if (!$autoevaluacion)
                                    @if ($competencias_autoevaluado[$key]->estatus_calificado)
                                        <td>
                                            <div class="auto-cal d-flex justify-content-center align-items-center">
                                                <p style="margin: 0px;">
                                                    {{ $competencias_autoevaluado[$key]->calificacion_competencia ?? null }}
                                                </p>
                                            </div>
                                        </td>
                                    @else
                                        <td>
                                            <div class="auto-cal d-flex justify-content-center align-items-center">
                                                <p style="margin: 0px;">
                                                    Sin Evaluar
                                                </p>
                                            </div>
                                        </td>
                                    @endif
                                @endif
                                <td>
                                    <div class="form-group" style="margin-right: 29px;">
                                        <select class="form-control" name="competencia_n{{ $key }}"
                                            id="competencia_n{{ $key }}"
                                            wire:change="evaluarCompetencia({{ $comp_evld->id }}, $event.target.value)">
                                            <option value="" disabled
                                                @if ($comp_evld->calificacion_competencia === null) selected @endif>
                                                Calificación
                                            </option>
                                            @foreach ($comp_evld->infoCompetencia->ponderaciones as $ponderacion)
                                                <option value="{{ $ponderacion->ponderacion }}"
                                                    @if (intval($comp_evld->calificacion_competencia) === $ponderacion->ponderacion &&
                                                            $comp_evld->calificacion_competencia !== null) selected @endif>
                                                    {{ $ponderacion->ponderacion }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- </div> --}}
            @else
                <h1>No esta asignado para evaluar Competencias.</h1>
            @endif
        </div>
    </div>
</div>
