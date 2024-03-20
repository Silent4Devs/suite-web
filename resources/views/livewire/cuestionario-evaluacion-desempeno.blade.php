<div>
    {{-- Stop trying to control. --}}

    <nav class="mt-4 d-flex justify-content-center">
        <div class="nav nav-tabs" id="tabsIso27001" role="tablist">
            <a class="nav-link active" id="nav-registros-tab" data-type="registros" data-toggle="tab" href="#nav-registros"
                role="tab" aria-controls="nav-registros" aria-selected="true">
                Objetivos
            </a>
            <a class="nav-link" id="nav-empleados-tab" data-type="empleados" data-toggle="tab" href="#nav-empleados"
                role="tab" aria-controls="nav-empleados" aria-selected="false">
                Competencias
            </a>
        </div>
    </nav>

    <div class="tab-content mt-2" id="nav-tabContent">
        <div class="tab-pane mb-4 fade show active" id="nav-registros" role="tabpanel"
            aria-labelledby="nav-registros-tab">
            <div class="w-100 row">
                <table class="datatable-rds">
                    <thead>
                        <th>Objetivo</th>
                        {{-- <th>Habilitado</th> --}}
                        <th>Métrica</th>
                        @foreach ($escalas as $escala)
                            <th style="background-color: {{ $escala->color }}">
                                {{ $escala->parametro }}
                            </th>
                        @endforeach
                        <th>AutoEvaluación</th>
                        <th>Cargar Evidencias</th>
                        <th>Evaluación</th>
                        <th>Opciones</th>
                    </thead>
                    <tbody>
                        @foreach ($objetivos_evaluado as $key => $obj_evld)
                            <tr>
                                <td>{{ $obj_evld->objetivo }}</td>
                                <td>
                                    <select name="aplica" id="aplica">
                                        <option value="true">Aplica</option>
                                        <option value="false">No Aplica</option>
                                    </select>
                                </td>
                                @foreach ($obj_evld->escalas as $obj_esc)
                                    <td>
                                        {{ $obj_esc->condicion_signo }}{{ $obj_esc->valor }}&nbsp;{{ $obj_evld->unidad_objetivo }}
                                    </td>
                                @endforeach
                                <td>Sin Evaluar</td>
                                <td>Evidencia</td>
                                <td>
                                    <input id="pregunta_n{{ $key }}"
                                        value="{{ $obj_evld->calificacion_objetivo ?? null }}"
                                        wire:change="evaluarObjetivo({{ $obj_evld->id }}, $event.target.value)"
                                        type="number">
                                </td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane mb-4 fade" id="nav-empleados" role="tabpanel" aria-labelledby="nav-empleados-tab">
            <div class="w-100 row">
                <table class="datatable-rds">
                    <thead>
                        <th>Competencias</th>
                        <th>Nivel Esperado</th>
                        <th>Autoevaluación</th>
                        <th>Evaluación</th>
                        <th>Opciones</th>
                    </thead>
                    <tbody>
                        @foreach ($competencias_evaluado as $key => $comp_evld)
                            <tr>
                                <td>{{ $comp_evld->competencia }}</td>
                                <td>{{ $comp_evld->nivel_esperado }}</td>
                                <td>Sin Evaluar</td>
                                <td>
                                    <select name="competencia_n{{ $key }}"
                                        id="competencia_n{{ $key }}"
                                        wire:change="evaluarCompetencia({{ $comp_evld->id }}, $event.target.value)">
                                        <option value="" disabled
                                            @if ($comp_evld->calificacion_competencia === null) selected @endif>
                                            Seleccione una Ponderación
                                        </option>
                                        @foreach ($comp_evld->ponderaciones as $ponderacion)
                                            <option value="{{ $ponderacion->ponderacion }}"
                                                @if ($comp_evld->calificacion_competencia === $ponderacion->ponderacion) selected @endif>
                                                {{ $ponderacion->ponderacion }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {{-- <input id="pregunta_n{{ $key }}"
                                        value="{{ $comp_evld->calificacion_competencia ?? null }}"
                                        wire:change="evaluarPregunta({{ $comp_evld->id }}, $event.target.value)"
                                        type="number"> --}}
                                </td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
