<div>
    {{-- Stop trying to control. --}}
    @if ($validacion_objetivos_evaluador)
        <div class="card border-0">
            <div class="card-title mb-0 d-flex align-items-center justify-content-around"
                style="border-top-left-radius: 14px; border-top-right-radius:14px;background-color: #8C91D6; color:#FFFFFF; height: 90px;">
                <h5 class="ml-3">Objetivos</h5>
                <h6>Evaluación de objetivos: Evaluación 2024</h6>
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
                                    aria-valuenow="{{ $porcentajeCalificado }}" aria-valuemin="0" aria-valuemax="100">

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
                                    aria-valuenow="{{ $porcentajeCalificado }}" aria-valuemin="0" aria-valuemax="100">
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
        <div class="mb-4" style="background-color: #FEFFE3; height: 53px; margin-right:12px; padding:18px;">
            Ya puedes comenzar a evaluar el periodo 12/12/12 al 12/12/12
        </div>

        {{-- <div class="w-100 row"> --}}
        <div class="d-flex justify-content-start">

            {{-- <div class="option-q-inactive">
                Q2
            </div> --}}
        </div>
        <div class="scroll_estilo" style="overflow-x: auto;">
            <table class="">
                <thead>
                    <tr>
                        <th class="th-table-objetive th-objetive" colspan="2">Objetivo</th>
                        {{-- <th>Habilitado</th> --}}
                        <th class=" th-table-objetive th-metrica">Métrica</th>
                        @foreach ($escalas as $escala)
                            <th class="th-custom" style="background-color: {{ $escala->color }}">
                                {{ $escala->parametro }}
                            </th>
                        @endforeach
                        @if ($evaluador->id != $id_evaluado->evaluador_desempeno_id)
                            <th class="th-table-objetive th-auto-evaluation">Autoevaluación</th>
                        @endif
                        <th class="th-table-objetive th-evidencie">Cargar Evidencias</th>
                        <th class="th-table-objetive th-evaluation">Evaluación</th>
                        <th class="th-table-objetive th-options">Opciones</th>
                    </tr>
                </thead>


                <tbody>
                    @foreach ($objetivos_evaluado as $key => $obj_evld)
                        <tr class="tr-sections">
                            <td colspan="{{ count($escalas) + 7 }}">
                                <h6>
                                    Financiero
                                </h6>
                            </td>
                        </tr>
                        <tr style="text-align: center;">
                            <td class="td-f1">F1</td>
                            <td style="text-align: left;">{{ $obj_evld->infoObjetivo->objetivo }}</td>
                            <td>
                                <div class="form-group">
                                    <select class="form-control" name="aplica" id="aplica"
                                        wire:change="aplicaObjetivo({{ $obj_evld->id }}, $event.target.value)">
                                        <option value="true" @if ($obj_evld->aplicabilidad == true) selected @endif>Aplica
                                        </option>
                                        <option value="false" @if ($obj_evld->aplicabilidad == false) selected @endif>No
                                            Aplica
                                        </option>
                                    </select>
                                </div>
                            </td>
                            @foreach ($obj_evld->infoObjetivo->escalas as $obj_esc)
                                <td>
                                    {{ $obj_esc->condicion_signo }}{{ $obj_esc->valor }}&nbsp;{{ $obj_evld->infoObjetivo->unidad_objetivo }}
                                </td>
                            @endforeach
                            @if ($evaluador->id != $id_evaluado->evaluador_desempeno_id)
                                @if ($objetivos_autoevaluado[$key]->estatus_calificado)
                                    <td
                                        style="background-color: {{ $autoevaluacion_colors[$objetivos_autoevaluado[$key]->id . '-bg-color'] }}; ">
                                        <div class="">
                                            {{ $objetivos_autoevaluado[$key]->calificacion_objetivo ?? null }}
                                        </div>
                                        {{-- <div class=""> --}}
                                        <p
                                            style="color: {{ $autoevaluacion_colors[$objetivos_autoevaluado[$key]->id . '-tx-color'] }};">
                                            <b>
                                                {{ $calificacion_autoescala[$objetivos_autoevaluado[$key]->id] }}
                                            </b>
                                        </p>
                                        {{-- </div> --}}
                                        <div>

                                        </div>
                                    </td>
                                @else
                                    <td>Sin Evaluar</td>
                                @endif
                            @endif

                            <td>
                                <button type="button" class="btn btn-evidencia" data-toggle="modal"
                                    data-target="#evidenciaObjetivo{{ $obj_evld->id }}">
                                    Evidencia
                                </button>

                                <!-- Modal -->
                                <div wire:ignore.self class="modal fade" id="evidenciaObjetivo{{ $obj_evld->id }}"
                                    tabindex="-1" aria-labelledby="evidenciaObjetivo{{ $obj_evld->id }}Label"
                                    aria-hidden="true">
                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"
                                        style="margin:50px 0px 10px 1030px; background:none; border: none;"><i
                                            class="fa-solid fa-x fa-2xl" style="color: #ffffff;"></i>
                                    </button>
                                    <div class="modal-dialog  modal-lg">
                                        <div class="modal-content">
                                            {{-- <div class="modal-header">
                                                    <h5 class="modal-title" id="evidenciaObjetivo{{ $obj_evld->id }}Label">Carga de Evidencias</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div> --}}
                                            <div class="modal-body">
                                                <div class="d-flex  justify-content-center">
                                                    <h5 class="modal-title"
                                                        id="evidenciaObjetivo{{ $obj_evld->id }}Label">Carga de
                                                        Evidencias</h5>
                                                </div>
                                                <div class="d-flex justify-content-start">
                                                    <p>
                                                        Carga un archivo, documento o evidencia
                                                    </p>
                                                </div>
                                                <div class="drag-area">
                                                    <input type="file" id="file" name="file"
                                                        wire:model.live="file"
                                                        wire:change="asignarObjArchivo({{ $obj_evld->id }})">
                                                </div>

                                                @if (!empty($obj_evidencias[$key]))
                                                    @foreach ($obj_evidencias[$key] as $key_evidencia => $evidencia)
                                                        <div class="row align-items-center">
                                                            <div class="col-1">
                                                                Evidencia {{$key_evidencia + 1}}
                                                            </div>
                                                            <div class="col-3">
                                                                <a class="btn-link" data-toggle="modal"
                                                                    data-target="#modalArchivo"
                                                                    wire:click="mostrarArchivo({{ $evidencia['id_objetivo'] }},{{ $evidencia['id'] }})">{{ $evidencia['nombre_archivo'] }}</a>
                                                            </div>
                                                            <div class="col-8">
                                                                <div class="form-group">
                                                                    <textarea class="form-control" style="min-height: 83px;" name="comentario_{{ $key_evidencia }}"
                                                                        id="comentario_{{ $key_evidencia }}" style="min-width: 100%"
                                                                        wire:change="comentarioObjetivo({{ $evidencia['id'] }}, $event.target.value)" placeholder="Comentario">{{ $evidencia->comentarios ?? null }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="p-3">
                                    @if (!empty($obj_evidencias[$key]))
                                        <div class="form-group">
                                            <input class="form-control" id="pregunta_n{{ $key }}"
                                                style="width: 97px;"
                                                value="{{ $obj_evld->calificacion_objetivo ?? null }}"
                                                wire:change="evaluarObjetivo({{ $obj_evld->id }}, $event.target.value)"
                                                type="number" placeholder="Calificación">
                                        </div>

                                        <p style="color: {{ $evaluacion_colors[$obj_evld->infoObjetivo->id . '-tx-color'] }};">
                                            {{ $calificacion_escala[$obj_evld->infoObjetivo->id] }}
                                        </p>
                                    @else
                                        <p>
                                            Proporcione evidencias en el objetivo antes de calificarlo.
                                        </p>
                                    @endif
                                </div>
                            </td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="d-flex justify-content-end" style="margin-top: 28px;">
            <div class="autoevaluacion d-flex align-items-center justify-content-center">
                <h5 class="text-evaluations">
                    Autoevaluación: 90%
                </h5>
            </div>
            <div class="evaluacion d-flex align-items-center justify-content-center">
                <h5 class="text-evaluations">
                    Evaluación
                </h5>
            </div>
        </div>
        <div class="d-flex justify-content-end" style="margin-top: 11px;">
            <div class="evaluacion-global d-flex align-items-center justify-content-center">
                <h5 class="text-evaluations" style="color: #FFFFFF">
                    Resultado Global:
                </h5>
            </div>
        </div>
        {{-- </div> --}}
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
                            <embed src="{{ asset($archivo_mostrado) }}" type="application/pdf" width="100%"
                                height="600px" />
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
