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
                    @if ($evaluador->id != $id_evaluado->evaluador_desempeno_id)
                        <th>Autoevaluación</th>
                    @endif
                    <th>Cargar Evidencias</th>
                    <th>Evaluación</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                    @foreach ($objetivos_evaluado as $key => $obj_evld)
                        <tr>
                            <td>{{ $obj_evld->infoObjetivo->objetivo }}</td>
                            <td>
                                <select name="aplica" id="aplica"
                                    wire:change="aplicaObjetivo({{ $obj_evld->id }}, $event.target.value)">
                                    <option value="true" @if ($obj_evld->aplicabilidad == true) selected @endif>Aplica
                                    </option>
                                    <option value="false" @if ($obj_evld->aplicabilidad == false) selected @endif>No Aplica
                                    </option>
                                </select>
                            </td>
                            @foreach ($obj_evld->infoObjetivo->escalas as $obj_esc)
                                <td>
                                    {{ $obj_esc->condicion_signo }}{{ $obj_esc->valor }}&nbsp;{{ $obj_evld->unidad_objetivo }}
                                </td>
                            @endforeach
                            @if ($evaluador->id != $id_evaluado->evaluador_desempeno_id)
                                @if ($objetivos_autoevaluado[$key]->estatus_calificado)
                                    <td>
                                        <div class="row">
                                            {{ $objetivos_autoevaluado[$key]->calificacion_objetivo ?? null }}
                                        </div>
                                        <div class="row">
                                            {{ $calificacion_autoescala[$objetivos_autoevaluado[$key]->id] }}
                                        </div>
                                    </td>
                                @else
                                    <td>Sin Evaluar</td>
                                @endif
                            @endif

                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#evidenciaObjetivo{{ $obj_evld->id }}">
                                    Evidencia
                                </button>

                                <!-- Modal -->
                                <div wire:ignore.self class="modal fade" id="evidenciaObjetivo{{ $obj_evld->id }}"
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
                                                <div class="row">
                                                    <input type="file" id="file" name="file"
                                                        wire:model="file"
                                                        wire:change="asignarObjArchivo({{ $obj_evld->id }})">
                                                </div>

                                                @if (!empty($obj_evidencias[0]))
                                                    @foreach ($obj_evidencias[$key] as $key_evidencia => $evidencia)
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <a class="btn-link" data-toggle="modal"
                                                                    data-target="#modalArchivo"
                                                                    wire:click="mostrarArchivo({{ $obj_evld->id }},{{ $evidencia['id'] }})">{{ $evidencia['nombre_archivo'] }}</a>
                                                            </div>
                                                            <div class="col-9">
                                                                <textarea name="comentario_{{ $key_evidencia }}" id="comentario_{{ $key_evidencia }}" style="min-width: 100%"
                                                                    wire:change="comentarioObjetivo({{ $evidencia['id'] }}, $event.target.value)">{{ $evidencia->comentarios ?? null }}</textarea>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <input id="pregunta_n{{ $key }}"
                                        value="{{ $obj_evld->calificacion_objetivo ?? null }}"
                                        wire:change="evaluarObjetivo({{ $obj_evld->id }}, $event.target.value)"
                                        type="number">
                                </div>
                                <div class="row">
                                    {{ $calificacion_escala[$obj_evld->infoObjetivo->id] }}
                                </div>
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

    <div wire:ignore.self class="modal fade" id="modalArchivo" tabindex="-1" aria-labelledby="modalArchivoLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalArchivoLabel">
                        Evidencias</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @switch ($extension_arch)
                        @case ('pdf')
                            <embed src="{{ asset($archivo_mostrado) }}" type="application/pdf" width="100%" height="600px" />
                        @break;
                        @case ('jpg')
                            <img src="{{ asset($archivo_mostrado) }}" type="image/jpeg" width="100%" height="600px" />
                        @break;
                        @case ('jpeg')
                            <img src="{{ asset($archivo_mostrado) }}" type="image/jpeg" width="100%" height="600px" />
                        @break;
                        @case ('png')
                            <img src="{{ asset($archivo_mostrado) }}" type="image/png" width="100%" height="600px" />
                        @break;
                        @case ('xls')
                            <embed src="{{ asset($archivo_mostrado) }}" type="application/vnd.ms-excel" width="100%"
                                height="600px" />
                        @break;
                        @case ('xlsx')
                            <embed src="{{ asset($archivo_mostrado) }}" type="application/vnd.ms-excel" width="100%"
                                height="600px" />
                        @break;
                        @case ('docx')
                            <embed src="{{ asset($archivo_mostrado) }}" type="application/msword" width="100%"
                                height="600px" />
                        @break;

                        @default
                            <h1>Error al cargar archivo</h1>
                        @break;
                    @endswitch
                </div>
            </div>
        </div>
    </div>
</div>
