@extends('layouts.admin')
@section('content')
    <style>
        span.errors {
            font-size: 11px;
        }

    </style>
    <div class="mt-3">
        {{ Breadcrumbs::render('EV360-Evaluaciones') }}
    </div>
    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Evaluación: {{ $evaluacion->nombre }}</strong></h3>
        </div>
        <div class="pt-0 card-body">

            <div>
                <div class="w-100"
                    style="padding:15px 10px;color:white;background: #008186;border-radius: 8px 8px 0 0;">
                    <span style="font-size:20px;"><i class="mr-2 fas fa-file"></i>Evaluación:
                        {{ $evaluacion->nombre }}</span>
                    @if ($evaluado->id == $evaluador->id)
                        <span class="badge badge-primary">Autoevaluación</span>
                    @endif
                    <p class="m-0">Evaluado: {{ $evaluado->name }}</p>
                    <p class="m-0">Evaluador: {{ $evaluador->name }}</p>
                    <span class="badge badge-light">{{ $total_preguntas }}
                        pregunta{{ $total_preguntas > 1 ? 's' : '' }}
                        en total</span>
                    <span class="badge badge-light">Contestadas: <span
                            id="contestadas">{{ $preguntas_contestadas }}</span></span>
                    <span class="badge badge-light">No Contestadas: <span
                            id="noContestadas">{{ $preguntas_no_contestadas }}</span></span>
                </div>
                @if ($progreso == 100)
                    <div class="mt-3 row">
                        <div class="col-12">
                            <div class="px-1 py-2 mx-3 rounded shadow"
                                style="background-color: #DBEAFE; border-top:solid 3px #3B82F6;">
                                <div class="row w-100">
                                    <div class="text-center col-1 align-items-center d-flex justify-content-center">
                                        <div class="w-40 ml-3">
                                            <img src="{{ asset('img/cohete.png') }}" style=width:30px;>

                                        </div>
                                    </div>
                                    <div class="col-11">
                                        <p class="m-0"
                                            style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                                            Muchas gracias</p>
                                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Su respuesta ha
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
                    </div>
                @else
                    @if ($finalizo_tiempo)
                        <div class="mt-3 row">
                            <div class="col-12">
                                <div class="px-1 py-2 mx-3 rounded shadow"
                                    style="background-color: #DBEAFE; border-top:solid 3px #3B82F6;">
                                    <div class="row w-100">
                                        <div class="text-center col-1 align-items-center d-flex justify-content-center">
                                            <div class="w-40 ml-3">
                                                <img src="{{ asset('img/cohete.png') }}" style=width:30px;>

                                            </div>
                                        </div>
                                        <div class="col-11">
                                            <p class="m-0"
                                                style="font-size: 16px; font-weight: bold; color: #1E3A8A">
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
                        <p class="m-0 mt-3 text-muted"><i class="mr-2 fas fa-question-circle"></i>INSTRUCCIONES: Seleccione
                            la
                            calificación
                            de
                            cada competencia de acuerdo a las
                            conductas observadas en:
                            {{ $evaluado->name }}</p>
                        <p class="m-0 mt-3 text-muted"><i class="mr-2 fas fa-info-circle"></i>IMPORTANTE: Sus repuestas se
                            almacenan
                            de
                            manera inmediata, por lo que una vez llenado todo el cuestionario no podrá volver a editarlas
                        </p>
                        <div class="mt-3 progress">
                            <div class="progress-bar" id="progresoEvaluacion" role="progressbar"
                                style="width: {{ $progreso }}%;" aria-valuenow="{{ $progreso }}" aria-valuemin="0"
                                aria-valuemax="100">{{ $progreso }}%</div>
                        </div>
                        @foreach ($preguntas as $idx => $pregunta)
                            <div class="mt-3 row">
                                <div class="col-sm-12 col-lg-7 col-md-7">
                                    <span>{{ $idx + 1 }}.- {!! $pregunta->competencia->nombre !!}</span>
                                    <span style="cursor: pointer; font-size: 10px;" title="Visualizar competencia"
                                        onclick="event.preventDefault();VisualizarSignificado(this,'{{ route('admin.ev360-competencias.informacionCompetencia', $pregunta->competencia->id) }}')"><i
                                            class="ml-2 fas fa-eye"></i></span>
                                </div>
                                <div class="col-sm-12 col-lg-5 col-md-5">
                                    <select class="form-control" name="respuesta"
                                        onchange="event.preventDefault();GuardarRepuesta(this,'{{ route('admin.ev360-competencias.guardarRespuestaCompetencia', $pregunta->competencia->id) }}')">
                                        <option value="" disabled selected>
                                            -- Selecciona una calificación --
                                        </option>
                                        @foreach ($pregunta->competencia->opciones as $opcion)
                                            <option data-evaluacion="{{ $evaluacion->id }}"
                                                data-evaluado="{{ $evaluado->id }}"
                                                data-evaluador="{{ $evaluador->id }}"
                                                value="{{ $opcion->ponderacion }}"
                                                {{ $opcion->ponderacion == $pregunta->calificacion ? 'selected' : '' }}>
                                                {{ $opcion->ponderacion }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endforeach
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
                    <h5 class="modal-title" id="competenciaModalLabel">Diccionario de la competencia: <span
                            id="nombreCompetencia"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="border row" style="background: #008186;color: white;font-size: 16px;font-weight: bold;">
                        <div class="text-center col-sm-2 col-lg-2">
                            Nivel
                        </div>
                        <div class="col-sm-10 col-lg-10">
                            Conducta Esperada
                        </div>
                    </div>
                    <div id="competenciaInformacion"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn_cancelar" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    @parent
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
                            if (Number(response.progreso) == 100) {
                                toastr.info(
                                    'Encuesta Finalizada, recargaremos la página,espere un momento...'
                                );
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1500);
                            }
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

                        document.getElementById('nombreCompetencia').innerHTML = competencia.nombre;
                        let html = "";
                        competencia.opciones.forEach(opcion => {
                            html += `
                            <div class="border row">
                                <div class="text-center col-sm-2 col-lg-2 d-flex justify-content-center align-items-center" style="font-weight:bold;background:#008186;color:#fff">
                                    <p>${opcion.ponderacion}</p>
                                </div>    
                                <div class="col-sm-10 col-lg-10">
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
        })
    </script>
@endsection
