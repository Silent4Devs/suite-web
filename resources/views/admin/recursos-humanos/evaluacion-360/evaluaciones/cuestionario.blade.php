@extends('layouts.admin')
@section('content')
    <style>
        span.errors {
            font-size: 11px;
        }

        #sig-evaluador-canvas {
            border: 2px dotted #CCCCCC;
            border-radius: 15px;
            cursor: crosshair;
        }

        #sig-evaluado-canvas {
            border: 2px dotted #CCCCCC;
            border-radius: 15px;
            cursor: crosshair;
        }

        img.rounded-circle {
            border-radius: 0 !important;
            clip-path: circle(35px at 50% 50%);
            height: 70px;
        }

        .card-custom {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 10px;
            margin: auto;
            text-align: center;
            height: 100%;
            font-family: arial;
        }

        .title-custom {
            color: grey;
            font-size: 14px;
        }
    </style>
    <div class="mt-3">
        {{ Breadcrumbs::render('EV360-Evaluacion-Cuestionario', ['evaluacion' => $evaluacion, 'evaluado' => $evaluado, 'evaluador' => $evaluador]) }}
    </div>
    @include('partials.flashMessages')
    <h5 class="col-12 titulo_general_funcion">Evaluación: {{ $evaluacion->nombre }}</h5>

    @if ($evaluador->id == $evaluado->id)
        <div class="mt-4 card">
            <div class="pt-0 card-body">
                <table class="datatable-rds">
                    <thead>
                        <th>
                            Nombre de la evaluación
                        </th>
                        <th>
                            Fecha de creación
                        </th>
                        <th>
                            Autoevaluación
                        </th>
                        <th>
                            Evaluaciones a realizar
                        </th>
                    </thead>
                    <tbody>
                        <td>
                            {{ $evaluacion->nombre }}
                        </td>
                        <td>
                            {{ $evaluacion->fecha_inicio }}
                        </td>
                        <td>
                            {{ $evaluacion->fecha_fin }}
                        </td>
                        <td>
                            @foreach ($evaluaciones_a_realizar as $evaluar)
                                <img style=""
                                    src="{{ asset('storage/empleados/imagenes/') }}/{{ $evaluar->empleado_evaluado->avatar }}"
                                    class="rounded-circle" alt="{{ $evaluar->empleado_evaluado->name }}"
                                    title="{{ $evaluar->empleado_evaluado->name }}" width="40" height="37">
                                @if ($evaluar->evaluado)
                                    <i class="fas fa-check-circle"
                                        style="position: relative; top: 0; left: -20px; z-index: 1; color: #002102; text-shadow: 1px 1px 0px gainsboro;"></i>
                                @endif
                            @endforeach
                        </td>
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <div class="mt-4 card">
        <div class="pt-0 card-body">

            <div>
                <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                    RESUMEN GENERAL
                </div>
                <div class="row">
                    <div class="col-{{ $evaluado->id == $evaluador->id ? '12' : '6' }}">
                        <div class="card-custom">
                            <p><strong>{{ $evaluado->id == $evaluador->id ? 'Autoevaluación' : 'Evaluado' }}</strong></p>
                            <img class="rounded-circle"
                                src="{{ asset('storage/empleados/imagenes/' . $evaluado->avatar) }}">
                            <h5 class="mt-2">{{ $evaluado->name }}</h5>
                            <p class="title-custom">{{ $evaluado->puesto }}</p>
                        </div>
                    </div>
                    @if ($evaluado->id != $evaluador->id)
                        <div class="col-6">
                            <div class="card-custom">
                                <p><strong>Evaluador</strong></p>
                                <img class="rounded-circle"
                                    src="{{ asset('storage/empleados/imagenes/' . $evaluador->avatar) }}">
                                <h5 class="mt-2">{{ $evaluador->name }}</h5>
                                <p class="title-custom">{{ $evaluador->puesto }}</p>
                            </div>
                        </div>
                    @endif

                </div>
                @if ($evaluado->id == $evaluador->id)
                    <div class="mt-3"><strong>Nota:</strong> Estás realizando tú autoevaluación</div>
                @endif
                @if ($isJefeInmediato)
                    <div class="mt-3"><strong>Nota: </strong>Estás evaluando como jefe inmediato</div>
                @endif
                <hr>
                @if ($esta_evaluado)
                    <div class="row">
                        <div class="col-12">
                            <div class="px-1 py-2 mx-3 rounded shadow"
                                style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                                <div class="row w-100">
                                    <div class="text-center col-1 align-items-center d-flex justify-content-center">
                                        <div class="w-40 ml-3">
                                            <img src="{{ asset('img/cohete.png') }}" style=width:30px;>

                                        </div>
                                    </div>
                                    <div class="col-11">
                                        <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                                            Muchas gracias</p>
                                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Su respuesta
                                            ha
                                            sido
                                            enviada al
                                            solicitante
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <img class="img-fluid" src="{{ asset('img/mensaje2.png') }}">
                        </div>
                        <div class="col-12 text-center">
                            <a href="{{ route('admin.inicio-Usuario.index') }}" class="btn btn-success">Regresar</a>
                        </div>
                    </div>
                @else
                    @if ($finalizo_tiempo)
                        <div class="mt-3 row">
                            <div class="col-12">
                                <div class="px-1 py-2 mx-3 rounded shadow"
                                    style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                                    <div class="row w-100">
                                        <div class="text-center col-1 align-items-center d-flex justify-content-center">
                                            <div class="w-40 ml-3">
                                                <img src="{{ asset('img/cohete.png') }}" style=width:30px;>

                                            </div>
                                        </div>
                                        <div class="col-11">
                                            <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                                                Evaluación Cerrada</p>
                                            <p class="m-0" style="font-size: 14px; color:#1E3A8A ">
                                                Esta evaluación ha sido cerrada.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <img class="img-fluid" src="{{ asset('img/mensaje2.png') }}">
                            </div>
                        </div>
                    @else
                        @if ($evaluacion->include_competencias)
                            <div class="row align-items-center justify-content-center">
                                <div class="col-12">
                                    <div class="text-center form-group"
                                        style="background-color:#345183; border-radius: 100px; color: white;">
                                        SECCIÓN DE COMPETENCIAS
                                    </div>
                                    <section id="sectionCompetencias" class="mt-2" x-data="{ show: true }">
                                        <h5 class="head">
                                            <i class="mr-1 fas fa-chart-line"></i> Competencias
                                            <span style="float: right; cursor:pointer; margin-top: 0px;"
                                                @click="show=!show"><i class="fas"
                                                    :class="[show ? 'fa-minus' : 'fa-plus']"></i></span>
                                            <span style="font-size: 12px">
                                                <span class="badge badge-primary">{{ $total_preguntas }}
                                                    pregunta{{ $total_preguntas > 1 ? 's' : '' }}
                                                    en total</span>
                                                <span class="badge badge-success">Contestadas: <span
                                                        id="contestadas">{{ $preguntas_contestadas }}</span></span>
                                                <span class="badge badge-dark">No Contestadas: <span
                                                        id="noContestadas">{{ $preguntas_no_contestadas }}</span>
                                                </span>
                                            </span>
                                        </h5>
                                        <p class="m-0 my-2 text-muted">
                                            @if ($evaluado->id == $evaluador->id)
                                                Califique las siguientes competencias que le han sido asignadas
                                            @else
                                                Califique las competencias asignadas a {{ $evaluado->name }}
                                            @endif
                                        </p>
                                        <div x-show="show" x-transition:enter.duration.500ms
                                            x-transition:leave.duration.400ms>
                                            @if ($preguntas->count() == 0)
                                                <h6 class="text-center" style="color: #345183;">Sin Competencias
                                                    Asignadas</h6>
                                            @else
                                                <div class="mt-2 progress">
                                                    <div class="progress-bar bg-success" id="progresoEvaluacion"
                                                        role="progressbar" style="width: {{ $progreso }}%;"
                                                        aria-valuenow="{{ $progreso }}" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        {{ $progreso }}%</div>
                                                </div>
                                                <div class="mt-3 col-12">
                                                    <div class="row">
                                                        <div class="text-white col-4 bg-dark">
                                                            <strong>Competencia</strong>
                                                        </div>
                                                        @if ($evaluacion->autoevaluacion)
                                                            @if ($isJefeInmediato)
                                                                <div class="text-white col-2 bg-dark">
                                                                    <strong>Autoevaluación</strong>
                                                                </div>
                                                            @endif
                                                        @endif
                                                        <div class="text-white col-2 bg-dark"><strong>Nivel
                                                                esperado</strong>
                                                        </div>
                                                        <div
                                                            class="bg-dark text-white col-{{ $evaluacion->autoevaluacion ? ($isJefeInmediato ? '4' : '6') : '6' }} justify-content-between">
                                                            <strong>Nivel Obtenido</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                                @foreach ($preguntas as $idx => $competencia)
                                                    @if (!is_null($competencia->competencia))
                                                        <div class="px-2 py-3 shadow-sm col-12">
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <span class="mr-2"
                                                                        style="cursor: pointer; font-size: 10px;"
                                                                        title="Visualizar competencia"
                                                                        onclick="event.preventDefault();VisualizarSignificado(this,'{{ route('admin.ev360-competencias.informacionCompetencia', $competencia->competencia->id) }}')"><i
                                                                            class="ml-2 fas fa-eye"></i></span>
                                                                    <span><strong>
                                                                            {!! $competencia->competencia->nombre !!}</strong></span>
                                                                </div>
                                                                @if ($evaluacion->autoevaluacion)
                                                                    @if ($isJefeInmediato)
                                                                        <div class="col-2"
                                                                            id="autoev{{ $idx }}">
                                                                            <div style="background: aliceblue;"
                                                                                class="form-control">
                                                                                <i
                                                                                    class="mr-1 fas fa-circle-notch fa-spin"></i>
                                                                                Obteniendo
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                                <div class="col-2" id="esperado{{ $idx }}">
                                                                    <div style="background: aliceblue;"
                                                                        class="form-control">
                                                                        {{ $competencia->competencia->competencia_puesto->first()->nivel_esperado }}
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-{{ $evaluacion->autoevaluacion ? ($isJefeInmediato ? '4' : '6') : '6' }} justify-content-between">
                                                                    <select class="form-control" name="respuesta"
                                                                        onchange="event.preventDefault();GuardarRepuesta(this,'{{ route('admin.ev360-competencias.guardarRespuestaCompetencia', $competencia->competencia->id) }}')">
                                                                        <option value="" disabled selected>
                                                                            -- Selecciona una calificación --
                                                                        </option>
                                                                        @foreach ($competencia->competencia->opciones as $opcion)
                                                                            <option
                                                                                data-evaluacion="{{ $evaluacion->id }}"
                                                                                data-evaluado="{{ $evaluado->id }}"
                                                                                data-evaluador="{{ $evaluador->id }}"
                                                                                value="{{ $opcion->ponderacion }}"
                                                                                {{ $opcion->ponderacion == $competencia->calificacion ? 'selected' : '' }}>
                                                                                {{ $opcion->ponderacion }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif

                                        </div>
                                    </section>
                                </div>
                                @if ($isJefeInmediato)
                                    <div class="text-center col-6" id="autoevaluacionCompetencias"></div>
                                @endif
                            </div>
                            <hr>
                        @endif
                        @if ($evaluacion->include_objetivos)

                            <div class="row">
                                <div class="col-12">
                                    <div class="text-center form-group"
                                        style="background-color:#345183; border-radius: 100px; color: white;">
                                        SECCIÓN DE OBJETIVOS
                                    </div>
                                    <section class="mt-1" x-data="{ show: true }">
                                        <h5 class="head">
                                            <i class="mr-1 fas fa-bullseye"></i> Objetivos
                                            <span style="float: right; cursor:pointer; margin-top: 0px;"
                                                @click="show=!show"><i class="fas"
                                                    :class="[show ? 'fa-minus' : 'fa-plus']"></i></span>
                                            <span style="font-size: 12px">
                                                <span class="badge badge-primary">{{ count($objetivos) }}
                                                    objetivo{{ count($objetivos) > 1 ? 's' : '' }}
                                                    en total</span>
                                                <span class="badge badge-success">Evaluados: <span
                                                        id="objetivosEvaluados">{{ $objetivos_evaluados }}</span></span>
                                                <span class="badge badge-dark">No Evaluados: <span
                                                        id="objetivosNoEvaluados">{{ $objetivos_no_evaluados }}</span></span>
                                                <span><i class="ml-2 mr-1 fas fa-times-circle text-danger"></i>No
                                                    evaluado</span>
                                                <span><i class="ml-2 mr-1 fas fa-check-circle text-success"></i>
                                                    Evaluado</span>
                                            </span>
                                        </h5>
                                        <p class="m-0 my-2 text-muted">
                                            @if ($evaluado->id == $evaluador->id)
                                                Califique los siguientes objetivos que le han sido asignados.
                                            @else
                                                Califique los siguientes objetivos asignados a {{ $evaluado->name }} en
                                                cuanto al avance de sus
                                                objetivos.
                                            @endif
                                        </p>
                                        @if (count($objetivos))
                                            <div x-show="show" x-transition:enter.duration.500ms
                                                x-transition:leave.duration.400ms>
                                                <div class="mb-1 progress">
                                                    <div class="progress-bar bg-success" id="progresoEvaluacionObjetivos"
                                                        role="progressbar" style="width: {{ $progreso_objetivos }}%;"
                                                        aria-valuenow="{{ $progreso_objetivos }}" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        {{ $progreso_objetivos }}%
                                                    </div>
                                                </div>
                                                @foreach ($objetivos as $idx => $objetivo)
                                                    <div class="p-3 mt-2 border">
                                                        <div class="px-0 col-12">
                                                            <p
                                                                class="m-0 bg-dark pl-2 w-100 text-white mb-2 d-flex align-items-center">
                                                                {{-- <i class="mr-2 fas fa-info-circle"></i> --}}
                                                                <span style="font-size:10px"><i
                                                                        id="iconObjetivo{{ $objetivo->id }}"
                                                                        class="mr-1 fas fa-{{ $objetivo->evaluado ? 'check' : 'times' }}-circle text-{{ $objetivo->evaluado ? 'success' : 'danger' }}"></i>
                                                                </span>
                                                                Objetivo: {{ $objetivo->objetivo->nombre }}
                                                            </p>

                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <strong>Perspectiva:</strong>
                                                                    <img src="{{ $objetivo->objetivo->tipo->imagen_ruta }}"
                                                                        class="d-inline-block"
                                                                        style="clip-path: circle(9px at 50% 50%);width: 18px;">
                                                                    {{ $objetivo->objetivo->tipo->nombre }}
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0" style="font-size:14px">
                                                                        <strong>Descripción:</strong>
                                                                        {{ $objetivo->objetivo->descripcion_meta }}
                                                                    </p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p style="font-size:14px" class="m-0">
                                                                        <strong>KPI:</strong>
                                                                        {{ $objetivo->objetivo->KPI }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        </div>
                                                        <div class="px-0 col-12">
                                                            <label class="m-0"><i
                                                                    class="mr-2 far fa-dot-circle"></i>Meta
                                                                establecida:</label>
                                                            <div class="form-control" style="font-weight: bold">
                                                                {{ $objetivo->objetivo->meta }}
                                                                {{ $objetivo->objetivo->metrica->definicion }}
                                                            </div>
                                                            <div class="row">
                                                                @if ($evaluacion->autoevaluacion)
                                                                    @if ($isJefeInmediato)
                                                                        <div class="col-6">
                                                                            <label class="m-0 mt-2"><i
                                                                                    class="mr-2 far fa-dot-circle"></i>Meta
                                                                                Alcanzada
                                                                                ({{ $objetivo->objetivo->metrica->definicion }})
                                                                                - Autoevaluación</label>
                                                                            <div style="background: aliceblue;"
                                                                                id="autoevaluacionObjetivos{{ $objetivo->objetivo_id }}"
                                                                                class="form-control">
                                                                                <i
                                                                                    class="mr-1 fas fa-circle-notch fa-spin"></i>
                                                                                Cargando autoevaluacion...
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                                <div
                                                                    class="col-{{ $evaluacion->autoevaluacion ? ($isJefeInmediato ? '6' : '12') : '12' }}">
                                                                    <label class="m-0 mt-2">
                                                                        <i class="mr-2 far fa-dot-circle"></i>
                                                                        Meta Alcanzada
                                                                        ({{ $objetivo->objetivo->metrica->definicion }})
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    <input
                                                                        onchange="event.preventDefault();saveMetaAlcanzada(this,'{{ $objetivo->objetivo->id }}','{{ $evaluado->id }}','{{ $evaluador->id }}','{{ $evaluacion->id }}','{{ route('admin.ev360-evaluaciones.objetivos.storeMetaAlcanzada') }}','{{ $objetivo->id }}')"
                                                                        value="{{ $objetivo->calificacion }}"
                                                                        class="form-control" type="number"
                                                                        placeholder="Ingresa la meta alcanzada">
                                                                </div>
                                                                <div class="col-12">
                                                                    <label class="m-0 mt-2">
                                                                        <i class="mr-2 far fa-dot-circle"></i>
                                                                        Calificación
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    <select name="" id="calificacionPersepcion"
                                                                        class="form-control"
                                                                        onchange="event.preventDefault();saveCalificacionPersepcion(this,'{{ $objetivo->objetivo->id }}','{{ $evaluado->id }}','{{ $evaluador->id }}','{{ $evaluacion->id }}','{{ route('admin.ev360-evaluaciones.objetivos.saveCalificacionPersepcion') }}','{{ $objetivo->id }}')">
                                                                        <option value="" selected disabled>--
                                                                            Selecciona una
                                                                            calificación --</option>
                                                                        @foreach ($evaluacion->rangos as $rango)
                                                                            <option value="{{ $rango->valor }}"
                                                                                @if ($rango->valor == $objetivo->calificacion_persepcion) selected @endif>
                                                                                {{ $rango->parametro }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="px-0 mt-2 col-12">
                                                            @if ($evaluacion->autoevaluacion)
                                                                @if ($isJefeInmediato)
                                                                    <label class="m-0 mt-2"><i
                                                                            class="mr-2 far fa-dot-circle"></i>Comentarios
                                                                        Autoevaluación</label>
                                                                    <textarea class="m-0 form-control" readonly rows="0"
                                                                        id="autoevaluacionComentariosObjetivos{{ $objetivo->objetivo_id }}" type="text">Cargando autoevaluacion...</textarea>
                                                                @endif
                                                            @endif
                                                            <label class="m-0">
                                                                <i class="mr-2 fas fa-comments"></i>
                                                                @if ($evaluado->id == $evaluador->id)
                                                                    Comentarios del Autoevaluado
                                                                @else
                                                                    Comentarios del Evaluador
                                                                @endif
                                                            </label>
                                                            <textarea
                                                                onchange="event.preventDefault();saveMetaAlcanzadaDescripcion(this,'{{ $objetivo->objetivo->id }}','{{ $evaluado->id }}','{{ $evaluador->id }}','{{ $evaluacion->id }}','{{ route('admin.ev360-evaluaciones.objetivos.storeMetaAlcanzadaDescripcion') }}')"
                                                                placeholder="Comentarios adicionales" class="m-0 form-control" type="text"> {{ $objetivo->meta_alcanzada }}</textarea>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <h6 class="text-center" style="color: #345183;">Sin Objetivos
                                                Asignados</h6>
                                        @endif
                                    </section>
                                </div>
                            </div>
                            <hr>
                        @endif
                        <!-- Sección Firmas -->
                        <div class="mt-4">
                            <div class="text-center form-group"
                                style="background-color:#345183; border-radius: 100px; color: white;">
                                SECCIÓN DE FIRMAS
                            </div>
                            <h5 class="mt-3 head"><i class="mr-1 fas fa-signature"></i> Firmas</h5>
                            @if ($isJefeInmediato)
                                <p class="m-0 my-2 text-muted">
                                    La presente evaluación debe ser revisada en conjunto entre el evaluado y el jefe
                                    inmediato para mantener la transparencia de la misma.
                                    Sí no estás en revisando en conjunto programa una reunión para llevar a cabo la
                                    revisión.
                                </p>
                            @else
                                <p class="m-0 my-2 text-muted">
                                    La presente evaluación debe ser firmada por el evaluador para mantener la
                                    transparencia de la misma.
                                </p>
                            @endif
                            <div class="row">
                                <div class="text-center col-{{ $isJefeInmediato ? '6' : '12' }}">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6>Firma del
                                                {{ $evaluado->id == $evaluador->id ? 'Autoevaluado' : 'Evaluador' }}
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <canvas id="sig-evaluador-canvas">
                                                Navegador no compatible
                                            </canvas>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{-- <button class="btn btn-sm btn-success"
                                                id="sig-evaluador-submitBtn">Confirmar</button> --}}
                                            <button class="btn btn-sm" id="sig-evaluador-clearBtn"><i
                                                    class="mr-2 fas fa-trash-alt"></i>Limpiar</button>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-md-12">
                                            <textarea id="sig-evaluador-dataUrl" readonly class="d-none form-control" rows="5">Data URL de tu firma será almacenada aquí</textarea>
                                        </div>
                                    </div>
                                </div>
                                @if ($isJefeInmediato)
                                    <div class="text-center col-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h6>Firma del Colaborador Evaluado</h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <canvas id="sig-evaluado-canvas">
                                                    Navegador no compatible
                                                </canvas>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                {{-- <button class="btn btn-sm btn-success"
                                                        id="sig-evaluado-submitBtn">Confirmar</button> --}}
                                                <button class="btn btn-sm" id="sig-evaluado-clearBtn"><i
                                                        class="mr-2 fas fa-trash-alt"></i>Limpiar</button>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-md-12">
                                                <textarea id="sig-evaluado-dataUrl" readonly class="form-control d-none" rows="5">Data URL de tu firma será almacenada aquí</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <p class="m-0 text-muted">
                                @if ($isJefeInmediato)
                                    <strong>Política de la evaluación:</strong>
                                    Al firmar la evaluación ambas partes quedan conformes en que lo establecido en la
                                    evaluación es un reflejo del desempeño del colaborador evaluado.
                                @else
                                    <strong>Política de la evaluación:</strong>
                                    Al firmar la evaluación quedas conforme en que lo establecido en la
                                    evaluación es un reflejo del desempeño del colaborador evaluado.
                                @endif
                            </p>
                        </div>

                        <div class="mt-3 d-flex justify-content-end">
                            <a href="{{ route('admin.inicio-Usuario.index') }}" class="btn btn_cancelar">Salir</a>
                            <button
                                onclick="event.preventDefault();FinalizarEvaluacion('{{ route('admin.ev360-evaluaciones.finalizarEvaluacion', ['evaluacion' => $evaluacion, 'evaluado' => $evaluado, 'evaluador' => $evaluador]) }}')"
                                class="btn btn-danger">Finalizar</button>
                        </div>
                    @endif

                @endif
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="competenciaModal" tabindex="-1" aria-labelledby="competenciaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="pb-0 modal-body">
                    <div class="row" style="font-size: 12px;font-weight: bold; border-bottom:2px solid #33a74d">
                        <div class="text-center col-sm-1 col-lg-1">
                            Nivel
                        </div>
                        <div class="text-center col-sm-11 col-lg-11">
                            Conducta Esperada
                        </div>
                    </div>
                    <div id="competenciaInformacion"></div>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn_cancelar" data-dismiss="modal">Cerrar</button>
                </div> --}}
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    @parent
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.options = {
                "closeButton": true,
                "debug": true,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            let cargarAutoevaluacion = false;
            cargarAutoevaluacion = @json($isJefeInmediato);

            if (cargarAutoevaluacion) {
                let evaluado = @json($evaluado->id);
                let evaluador = @json($evaluador->id);
                let evaluacion = @json($evaluacion->id);
                let contains_autoevaluacion = @json($evaluacion->autoevaluacion ? true : false);
                if (contains_autoevaluacion) {
                    mostrarAutoevaluacion(evaluado, evaluador, evaluacion);
                    mostrarAutoevaluacionObjetivos(evaluado, evaluador, evaluacion);
                    mostrarAutoevaluacionComentariosObjetivos(evaluado, evaluador, evaluacion);
                }
            }

            window.GuardarRepuesta = function(el, url) {
                let calificacion = Number(el.options[el.options.selectedIndex].value);
                let evaluacion_id = Number(el.options[el.options.selectedIndex].dataset.evaluacion);
                let evaluado_id = Number(el.options[el.options.selectedIndex].dataset.evaluado);
                let evaluador_id = Number(el.options[el.options.selectedIndex].dataset.evaluador);
                let data = {
                    calificacion,
                    evaluacion_id,
                    evaluado_id,
                    evaluador_id
                }
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    type: "POST",
                    url: url,
                    data: data,
                    dataType: "JSON",
                    beforeSend: function() {
                        toastr.info('Guardando información, espere un momento...');
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Respuesta almacenada con éxito');
                            let barra = document.getElementById('progresoEvaluacion');
                            barra.style.width = `${response.progreso}%`;
                            barra.innerHTML = `${response.progreso}%`;
                            let contestadas = document.getElementById('contestadas');
                            let no_contestadas = document.getElementById('noContestadas');
                            contestadas.innerHTML = `${response.contestadas}`;
                            no_contestadas.innerHTML = `${response.sin_contestar}`;
                            // if (Number(response.progreso) == 100) {
                            //     toastr.info(
                            //         'Encuesta Finalizada, recargaremos la página,espere un momento...'
                            //     );
                            //     setTimeout(() => {
                            //         window.location.reload();
                            //     }, 1500);
                            // }
                        }
                        if (response.error) {
                            toastr.error('Ocurrió un error al guardar la respuesta');
                        }

                    },
                    error: function(request, status, error) {
                        toastr.error(
                            'Ocurrió un error: ' + error);
                    }
                });
            }
            window.VisualizarSignificado = function(el, url) {
                $.ajax({
                    type: "GET",
                    url: url,
                    beforeSend: function() {
                        toastr.info('Obteninedo información, espere un momento...');
                    },
                    success: function({
                        competencia
                    }) {
                        document.getElementById('modalTitle').innerHTML = competencia.nombre;
                        let html = "";
                        competencia.opciones.forEach(opcion => {
                            html += `
                            <div class="p-0 row" style="border-bottom: 1px solid #707070;">
                                <div class="text-center col-sm-1 col-lg-1 d-flex justify-content-center align-items-center" style="font-weight:bold;
                                font-size:12px;">
                                    <p>${opcion.ponderacion}</p>
                                </div>
                                <div class="px-0 py-2 col-sm-11 col-lg-11" style="font-size: 11px;">
                                    ${opcion.definicion}
                                </div>
                            </div>
                            `;
                        });
                        document.getElementById('competenciaInformacion').innerHTML = html;
                        $('#competenciaModal').modal('show');
                    },
                    error: function(request, status, error) {
                        toastr.error(
                            'Ocurrió un error: ' + error);
                    }
                });
            }

            window.saveMetaAlcanzadaDescripcion = function(input, objetivo, evaluado, evaluador, evaluacion, url) {
                let data = {
                    meta_alcanzada: input.value,
                    objetivo,
                    evaluado,
                    evaluador,
                    evaluacion,
                }

                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    type: "POST",
                    url: url,
                    data: data,
                    dataType: "JSON",
                    beforeSend: function() {
                        toastr.info('Guardando información, espere un momento...');
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Guardado con éxito');
                        }
                        if (response.error) {
                            toastr.error('Algo salió mal, intente de nuevo...');
                        }
                    },
                    error: function(request, status, error) {
                        toastr.error(
                            'Ocurrió un error: ' + error);
                    }
                });
            }
            window.saveCalificacionPersepcion = function(input, objetivo, evaluado, evaluador, evaluacion, url) {
                let data = {
                    calificacion_persepcion: input.value,
                    objetivo,
                    evaluado,
                    evaluador,
                    evaluacion,
                }

                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    type: "POST",
                    url: url,
                    data: data,
                    dataType: "JSON",
                    beforeSend: function() {
                        toastr.info('Guardando información, espere un momento...');
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Guardado con éxito');
                        }
                        if (response.error) {
                            toastr.error('Algo salió mal, intente de nuevo...');
                        }
                    },
                    error: function(request, status, error) {
                        toastr.error(
                            'Ocurrió un error: ' + error);
                    }
                });
            }

            window.saveMetaAlcanzada = function(input, objetivo, evaluado, evaluador, evaluacion, url,
                iconoObjetivoId) {
                let data = {
                    calificacion: input.value,
                    objetivo,
                    evaluado,
                    evaluador,
                    evaluacion,
                }
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    type: "POST",
                    url: url,
                    data: data,
                    dataType: "JSON",
                    beforeSend: function() {
                        toastr.info('Guardando información, espere un momento...');
                    },
                    success: function(response) {
                        if (response.success) {
                            document.getElementById(`iconObjetivo${iconoObjetivoId}`).classList
                                .remove(
                                    'fa-times-circle');
                            document.getElementById(`iconObjetivo${iconoObjetivoId}`).classList
                                .remove(
                                    'text-danger');
                            document.getElementById(`iconObjetivo${iconoObjetivoId}`).classList.add(
                                'fa-check-circle');
                            document.getElementById(`iconObjetivo${iconoObjetivoId}`).classList
                                .add(
                                    'text-success');
                            let barra = document.getElementById('progresoEvaluacionObjetivos');
                            barra.style.width = `${response.progreso}%`;
                            barra.innerHTML = `${response.progreso}%`;
                            let contestadas = document.getElementById('objetivosEvaluados');
                            let no_contestadas = document.getElementById('objetivosNoEvaluados');
                            contestadas.innerHTML = `${response.contestadas}`;
                            no_contestadas.innerHTML = `${response.sin_contestar}`;
                            toastr.success('Guardado con éxito');
                        }
                        if (response.error) {
                            toastr.error('Algo salió mal, intente de nuevo...');
                        }
                    },
                    error: function(request, status, error) {
                        toastr.error(
                            'Ocurrió un error: ' + error);
                    }
                });
            }

            window.FinalizarEvaluacion = function(url) {
                Swal.fire({
                    title: '¿Estás seguro de finalizar la evaluación?',
                    text: "¡No podras contestar de nuevo!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.isConfirmed) {
                        let cargarAutoevaluacion = false;
                        cargarAutoevaluacion = @json($isJefeInmediato);

                        let data = {}
                        let isEmptyObjetivosSigned = false;
                        if (cargarAutoevaluacion) {
                            var canvasObjetivos = document.getElementById("sig-evaluado-canvas");
                            var dataUrlObjetivos = canvasObjetivos.toDataURL();
                            isEmptyObjetivosSigned = isCanvasEmpty(canvasObjetivos);
                            if (isEmptyObjetivosSigned) {
                                toastr.info('Firma(s) no dibujadas');
                            } else {
                                data['firma_evaluado'] = dataUrlObjetivos;
                            }

                        }
                        var canvasCompetencias = document.getElementById("sig-evaluador-canvas");
                        var dataUrl = canvasCompetencias.toDataURL();
                        var isEmptyCompetenciasSigned = isCanvasEmpty(canvasCompetencias);
                        if (isEmptyCompetenciasSigned) {
                            toastr.info('Firma(s) no dibujadas');
                        } else {
                            data['firma_evaluador'] = dataUrl;
                        }
                        if (!isEmptyCompetenciasSigned && !isEmptyObjetivosSigned) {
                            $.ajax({
                                headers: {
                                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                                },
                                type: "POST",
                                data: data,
                                url: url,
                                beforeSend: function() {
                                    toastr.info(
                                        'Cerrando evaluación, espere un momento...');
                                },
                                success: function(response) {
                                    if (response.success) {
                                        toastr.success('Evaluación contestada con éxito');
                                        setTimeout(() => {
                                            window.location.reload();
                                        }, 1500)
                                    }
                                    if (response.error) {
                                        toastr.error(
                                            'La evaluación no ha sido contestada en su totalidad, no puede ser terminada...'
                                        );
                                    }
                                },
                                error: function(request, status, error) {
                                    toastr.error(
                                        'Ocurrió un error: ' + error);
                                }
                            });
                        }
                    }
                })
            }
        });

        function mostrarAutoevaluacion(evaluado, evaluador, evaluacion) {
            let data = {
                evaluado,
                evaluador,
                evaluacion
            }
            let url = "{{ route('admin.ev360-evaluaciones.autoevaluacion.competencias.get') }}";

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                type: "POST",
                url: url,
                data: data,
                dataType: "JSON",
                beforeSend: function() {

                },
                success: function(response) {
                    if (response.length > 0) {
                        console.log(response);
                        response.forEach((competencia, index) => {
                            let evaluacionContenedor = document.getElementById(`autoev${index}`);
                            if (evaluacionContenedor != null) {
                                evaluacionContenedor.innerHTML = competencia
                                    .calificacion == 0 ? 'No se ha evaluado' : competencia.calificacion;
                                evaluacionContenedor.classList.add('form-control');
                                evaluacionContenedor.style.background = 'aliceblue';
                            }
                        });

                    }
                }
            });
        }

        function mostrarAutoevaluacionObjetivos(evaluado, evaluador, evaluacion) {
            let data = {
                evaluado,
                evaluador,
                evaluacion
            }
            let url = "{{ route('admin.ev360-evaluaciones.autoevaluacion.objetivos.get') }}";

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                type: "POST",
                url: url,
                data: data,
                dataType: "JSON",
                beforeSend: function() {

                },
                success: function(response) {
                    if (response.length > 0) {
                        console.log(response);
                        response.forEach((objetivo, index) => {
                            let contenedorMetaAlcanzada = document.getElementById(
                                `autoevaluacionObjetivos${objetivo.objetivo_id}`);
                            contenedorMetaAlcanzada.innerHTML = objetivo.calificacion == 0 ?
                                'No se ha evaluado' : objetivo.calificacion;
                        });

                    }
                }
            });
        }

        function mostrarAutoevaluacionComentariosObjetivos(evaluado, evaluador, evaluacion) {
            let data = {
                evaluado,
                evaluador,
                evaluacion
            }
            let url = "{{ route('admin.ev360-evaluaciones.autoevaluacion.objetivos.get') }}";

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                type: "POST",
                url: url,
                data: data,
                dataType: "JSON",
                beforeSend: function() {

                },
                success: function(response) {
                    if (response.length > 0) {
                        console.log(response);
                        response.forEach((objetivo, index) => {
                            let contenedorComentariosObjetivosAutoevaluacion = document.getElementById(
                                `autoevaluacionComentariosObjetivos${objetivo.objetivo_id}`);
                            contenedorComentariosObjetivosAutoevaluacion.innerHTML = objetivo
                                .meta_alcanzada
                        });

                    }
                }
            });
        }

        //Render Canvas para Firmas
        (function() {
            let cargarAutoevaluacion = false;
            cargarAutoevaluacion = @json($isJefeInmediato);

            window.requestAnimFrame = (function(callback) {
                return window.requestAnimationFrame ||
                    window.webkitRequestAnimationFrame ||
                    window.mozRequestAnimationFrame ||
                    window.oRequestAnimationFrame ||
                    window.msRequestAnimaitonFrame ||
                    function(callback) {
                        window.setTimeout(callback, 1000 / 60);
                    };
            })();

            renderCanvas("sig-evaluador-canvas", "sig-evaluador-clearBtn");

            if (cargarAutoevaluacion) {
                renderCanvas("sig-evaluado-canvas", "sig-evaluado-clearBtn");
            }
        })();

        function renderCanvas(contenedor, clearBtnCanvas) {
            var canvas = document.getElementById(contenedor);
            var ctx = canvas.getContext("2d");
            ctx.strokeStyle = "#222222";
            ctx.lineWidth = 1;

            var drawing = false;
            var mousePos = {
                x: 0,
                y: 0
            };
            var lastPos = mousePos;

            canvas.addEventListener("mousedown", function(e) {
                drawing = true;
                lastPos = getMousePos(canvas, e);
            }, false);

            canvas.addEventListener("mouseup", function(e) {
                drawing = false;
            }, false);

            canvas.addEventListener("mousemove", function(e) {
                mousePos = getMousePos(canvas, e);
            }, false);

            // Add touch event support for mobile
            canvas.addEventListener("touchstart", function(e) {

            }, false);

            canvas.addEventListener("touchmove", function(e) {
                var touch = e.touches[0];
                var me = new MouseEvent("mousemove", {
                    clientX: touch.clientX,
                    clientY: touch.clientY
                });
                canvas.dispatchEvent(me);
            }, false);

            canvas.addEventListener("touchstart", function(e) {
                mousePos = getTouchPos(canvas, e);
                var touch = e.touches[0];
                var me = new MouseEvent("mousedown", {
                    clientX: touch.clientX,
                    clientY: touch.clientY
                });
                canvas.dispatchEvent(me);
            }, false);

            canvas.addEventListener("touchend", function(e) {
                var me = new MouseEvent("mouseup", {});
                canvas.dispatchEvent(me);
            }, false);

            function getMousePos(canvasDom, mouseEvent) {
                var rect = canvasDom.getBoundingClientRect();
                return {
                    x: mouseEvent.clientX - rect.left,
                    y: mouseEvent.clientY - rect.top
                }
            }

            function getTouchPos(canvasDom, touchEvent) {
                var rect = canvasDom.getBoundingClientRect();
                return {
                    x: touchEvent.touches[0].clientX - rect.left,
                    y: touchEvent.touches[0].clientY - rect.top
                }
            }

            function renderCanvas() {
                if (drawing) {
                    ctx.moveTo(lastPos.x, lastPos.y);
                    ctx.lineTo(mousePos.x, mousePos.y);
                    ctx.stroke();
                    lastPos = mousePos;
                }
            }

            // Prevent scrolling when touching the canvas
            document.body.addEventListener("touchstart", function(e) {
                if (e.target == canvas) {
                    e.preventDefault();
                }
            }, false);
            document.body.addEventListener("touchend", function(e) {
                if (e.target == canvas) {
                    e.preventDefault();
                }
            }, false);
            document.body.addEventListener("touchmove", function(e) {
                if (e.target == canvas) {
                    e.preventDefault();
                }
            }, false);

            (function drawLoop() {
                requestAnimFrame(drawLoop);
                renderCanvas();
            })();

            function clearCanvas() {
                canvas.width = canvas.width;
            }

            function isCanvasBlank() {
                const context = canvas.getContext('2d');

                const pixelBuffer = new Uint32Array(
                    context.getImageData(0, 0, canvas.width, canvas.height).data.buffer
                );

                return !pixelBuffer.some(color => color !== 0);
            }

            // Set up the UI
            // var sigText = document.getElementById(dataBaseCanvas);
            // var sigImage = document.getElementById(imageCanvas);
            var clearBtn = document.getElementById(clearBtnCanvas);
            // var submitBtn = document.getElementById(submitBtnCanvas);
            clearBtn.addEventListener("click", function(e) {
                clearCanvas();
                // sigText.innerHTML = "Data URL for your signature will go here!";
                // sigImage.setAttribute("src", "");
            }, false);
            // submitBtn.addEventListener("click", function(e) {
            //     const blank = isCanvasBlank();
            //     if (!blank) {
            //         // var dataUrl = canvas.toDataURL();
            //         // sigText.innerHTML = dataUrl;
            //         // sigImage.setAttribute("src", dataUrl);
            //     } else {
            //         if (toastr) {
            //             toastr.info('No has firmado en el canvas');
            //         } else {
            //             alert('No has firmado en el canvas');
            //         }
            //     }
            // }, false);

        }

        function isCanvasEmpty(canvas) {
            const context = canvas.getContext('2d');

            const pixelBuffer = new Uint32Array(
                context.getImageData(0, 0, canvas.width, canvas.height).data.buffer
            );

            return !pixelBuffer.some(color => color !== 0);
        }
    </script>
@endsection
