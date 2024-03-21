<div>
    {{-- Stop trying to control. --}}
    @if ($validacion_objetivos_evaluador)
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
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#evidenciaObjetivo{{ $obj_evld->id }}">
                                    Evidencia
                                </button>

                                <!-- Modal -->
                                <div wire:ignore class="modal fade" id="evidenciaObjetivo{{ $obj_evld->id }}"
                                    tabindex="-1" aria-labelledby="evidenciaObjetivo{{ $obj_evld->id }}Label"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="evidenciaObjetivo{{ $obj_evld->id }}Label">
                                                    Carga de Evidencias</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="file" wire:model="file"
                                                    wire:change="asignarObjArchivo({{ $obj_evld->id }})">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
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
    @else
        <h1>No tiene permitido evaluar Objetivos</h1>
    @endif

</div>
