<div>
    {{-- The Master doesn't talk, he acts. --}}
    @if ($validacion_competencias_evaluador)
        <div class="w-100 row">
            <table class="datatable-rds">
                <thead>
                    <th>Competencias</th>
                    <th>Nivel Esperado</th>
                    <th>Autoevaluación</th>
                    <th>Evaluación</th>
                </thead>
                <tbody>
                    @foreach ($competencias_evaluado as $key => $comp_evld)
                        <tr>
                            <td>{{ $comp_evld->competencia }}</td>
                            <td>{{ $comp_evld->nivel_esperado }}</td>
                            <td>Sin Evaluar</td>
                            <td>
                                <select name="competencia_n{{ $key }}" id="competencia_n{{ $key }}"
                                    wire:change="evaluarCompetencia({{ $comp_evld->id }}, $event.target.value)">
                                    <option value="" disabled @if ($comp_evld->calificacion_competencia === null) selected @endif>
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <h1>No esta asignado para evaluar Competencias.</h1>
    @endif
</div>
