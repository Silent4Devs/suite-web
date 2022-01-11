<div>
    <style>
        .encabezado {
            background: #788BAC;
            color: #fff;
        }

        .preguntas {
            background: #EEEEEE;
            color: #000;
        }

    </style>
    <!-- Modal -->
    <div class="modal fade" id="modalEncuesta" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="modalEncuestaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title titulo_general_funcion m-0" id="modalEncuestaLabel">Evaluación de la
                        capacitación <span id="modalNombreCapacitacion"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.recursos.guardarEvaluacionCapacitacion') }}"
                        id="formularioEncuesta">
                        <small style="text-align:justify">
                            Instrucciones: Responde los reactivos de acuerdo con el nivel de satisfacción de la
                            formación que obtuviste recientemente. Recuerda que la información que nos brindes
                            únicamente será utilizada con fines de mejora en nuestros procesos de aprendizaje y
                            enseñanza.</small>
                        <div class="row mt-3 px-3">
                            <div class="col-12 encabezado">
                                <strong>1. CONTENIDO</strong>
                                <p class="m-1">
                                    <small>
                                        Valora los temas, ejercicios y dinámicas que se revisaron
                                        durante las sesiones.
                                    </small>
                                </p>
                            </div>
                            <div class="col-12 preguntas">
                                <p class="m-1">1.1 La utilidad de los temas vistos fue:</p>
                                <div class="d-flex align-items-center" style="flex-wrap:wrap">
                                    <small class="errores utilidadTemasVistos_error text-danger w-100"></small>
                                    <small class="mr-2 text-muted">Insuficiente</small>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="utilidadTemasVistos"
                                            id="utilidadTemasVistos1" value="1">
                                        <label class="form-check-label" for="utilidadTemasVistos1">1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="utilidadTemasVistos"
                                            id="utilidadTemasVistos2" value="2">
                                        <label class="form-check-label" for="utilidadTemasVistos2">2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="utilidadTemasVistos"
                                            id="utilidadTemasVistos3" value="3">
                                        <label class="form-check-label" for="utilidadTemasVistos3">3</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="utilidadTemasVistos"
                                            id="utilidadTemasVistos4" value="4">
                                        <label class="form-check-label" for="utilidadTemasVistos4">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="utilidadTemasVistos"
                                            id="utilidadTemasVistos5" value="5">
                                        <label class="form-check-label" for="utilidadTemasVistos5">5</label>
                                    </div>
                                    <small class="ml-0 text-muted">Excelente</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <p class="m-1">1.2 La calidad y claridad del
                                    contenido de la capacitación fue:</p>
                                <div class="d-flex align-items-center" style="flex-wrap:wrap">
                                    <small class="errores calidadClaridadContenido_error text-danger w-100"></small>
                                    <small class="mr-2 text-muted">Insuficiente</small>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="calidadClaridadContenido"
                                            id="calidadClaridadContenido1" value="1">
                                        <label class="form-check-label" for="calidadClaridadContenido1">1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="calidadClaridadContenido"
                                            id="calidadClaridadContenido2" value="2">
                                        <label class="form-check-label" for="calidadClaridadContenido2">2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="calidadClaridadContenido"
                                            id="calidadClaridadContenido3" value="3">
                                        <label class="form-check-label" for="calidadClaridadContenido3">3</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="calidadClaridadContenido"
                                            id="calidadClaridadContenido4" value="4">
                                        <label class="form-check-label" for="calidadClaridadContenido4">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="calidadClaridadContenido"
                                            id="calidadClaridadContenido5" value="5">
                                        <label class="form-check-label" for="calidadClaridadContenido5">5</label>
                                    </div>
                                    <small class="ml-0 text-muted">Excelente</small>
                                </div>
                            </div>
                            <div class="col-12 preguntas">
                                <p class="m-1">1.3 Considero que se favoreció e
                                    impulsó el aprendizaje:</p>
                                <div class="d-flex align-items-center" style="flex-wrap:wrap">
                                    <small class="errores favorecioAprendizaje_error text-danger w-100"></small>
                                    <small class="mr-2 text-muted">Insuficiente</small>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="favorecioAprendizaje"
                                            id="favorecioAprendizaje1" value="1">
                                        <label class="form-check-label" for="favorecioAprendizaje1">1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="favorecioAprendizaje"
                                            id="favorecioAprendizaje2" value="2">
                                        <label class="form-check-label" for="favorecioAprendizaje2">2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="favorecioAprendizaje"
                                            id="favorecioAprendizaje3" value="3">
                                        <label class="form-check-label" for="favorecioAprendizaje3">3</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="favorecioAprendizaje"
                                            id="favorecioAprendizaje4" value="4">
                                        <label class="form-check-label" for="favorecioAprendizaje4">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="favorecioAprendizaje"
                                            id="favorecioAprendizaje5" value="5">
                                        <label class="form-check-label" for="favorecioAprendizaje5">5</label>
                                    </div>
                                    <small class="ml-0 text-muted">Excelente</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <p class="m-1">1.4 Los materiales audiovisuales
                                    fueron de calidad y ayudaron al entendimiento de los temas:</p>
                                <div class="d-flex align-items-center" style="flex-wrap:wrap">
                                    <small
                                        class="errores materialesAudioVisualesCalidad_error text-danger w-100"></small>
                                    <small class="mr-2 text-muted">Insuficiente</small>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            name="materialesAudioVisualesCalidad" id="materialesAudioVisualesCalidad1"
                                            value="1">
                                        <label class="form-check-label" for="materialesAudioVisualesCalidad1">1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            name="materialesAudioVisualesCalidad" id="materialesAudioVisualesCalidad2"
                                            value="2">
                                        <label class="form-check-label" for="materialesAudioVisualesCalidad2">2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            name="materialesAudioVisualesCalidad" id="materialesAudioVisualesCalidad3"
                                            value="3">
                                        <label class="form-check-label" for="materialesAudioVisualesCalidad3">3</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            name="materialesAudioVisualesCalidad" id="materialesAudioVisualesCalidad4"
                                            value="4">
                                        <label class="form-check-label" for="materialesAudioVisualesCalidad4">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            name="materialesAudioVisualesCalidad" id="materialesAudioVisualesCalidad5"
                                            value="5">
                                        <label class="form-check-label" for="materialesAudioVisualesCalidad5">5</label>
                                    </div>
                                    <small class="ml-0 text-muted">Excelente</small>
                                </div>
                            </div>
                            <div class="col-12 preguntas">
                                <p class="m-1">1.5 Considero que el material que
                                    entregaron fue de calidad y con la información adecuada:</p>
                                <div class="d-flex align-items-center" style="flex-wrap:wrap">
                                    <small class="errores materialEntregadoCalidad_error text-danger w-100"></small>
                                    <small class="mr-2 text-muted">Insuficiente</small>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="materialEntregadoCalidad"
                                            id="materialEntregadoCalidad1" value="1">
                                        <label class="form-check-label" for="materialEntregadoCalidad1">1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="materialEntregadoCalidad"
                                            id="materialEntregadoCalidad2" value="2">
                                        <label class="form-check-label" for="materialEntregadoCalidad2">2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="materialEntregadoCalidad"
                                            id="materialEntregadoCalidad3" value="3">
                                        <label class="form-check-label" for="materialEntregadoCalidad3">3</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="materialEntregadoCalidad"
                                            id="materialEntregadoCalidad4" value="4">
                                        <label class="form-check-label" for="materialEntregadoCalidad4">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="materialEntregadoCalidad"
                                            id="materialEntregadoCalidad5" value="5">
                                        <label class="form-check-label" for="materialEntregadoCalidad5">5</label>
                                    </div>
                                    <small class="ml-0 text-muted">Excelente</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <p class="m-1">1.6 En general considero que
                                    el curso cumplió con el objetivo y expectativa inicial:</p>
                                <div class="d-flex align-items-center" style="flex-wrap:wrap">
                                    <small class="errores w-100 text-danger cumplioObjetivo_error"></small>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="cumplioObjetivo"
                                            id="cumplioObjetivo1" value="1">
                                        <label class="form-check-label" for="cumplioObjetivo1">Sí</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="cumplioObjetivo"
                                            id="cumplioObjetivo0" value="0">
                                        <label class="form-check-label" for="cumplioObjetivo2">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 px-3">
                            <div class="col-12 encabezado">
                                <strong>2. INSTRUCTORES</strong>
                            </div>
                            <div class="col-12 preguntas">
                                <p class="m-1">2.1 La puntualidad del instructor fue:</p>
                                <div class="d-flex align-items-center" style="flex-wrap:wrap">
                                    <small class="w-100 errores puntualidadInstructor_error text-danger"></small>
                                    <small class="mr-2 text-muted">Insuficiente</small>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="puntualidadInstructor"
                                            id="puntualidadInstructor1" value="1">
                                        <label class="form-check-label" for="puntualidadInstructor1">1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="puntualidadInstructor"
                                            id="puntualidadInstructor2" value="2">
                                        <label class="form-check-label" for="puntualidadInstructor2">2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="puntualidadInstructor"
                                            id="puntualidadInstructor3" value="3">
                                        <label class="form-check-label" for="puntualidadInstructor3">3</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="puntualidadInstructor"
                                            id="puntualidadInstructor4" value="4">
                                        <label class="form-check-label" for="puntualidadInstructor4">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="puntualidadInstructor"
                                            id="puntualidadInstructor5" value="5">
                                        <label class="form-check-label" for="puntualidadInstructor5">5</label>
                                    </div>
                                    <small class="ml-0 text-muted">Excelente</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <p class="m-1">2.2 El dominio de los temas y
                                    herramientas fue:</p>
                                <div class="d-flex align-items-center" style="flex-wrap:wrap">
                                    <small class="w-100 errores dominioTemasHerramientas_error text-danger"></small>
                                    <small class="mr-2 text-muted">Insuficiente</small>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="dominioTemasHerramientas"
                                            id="dominioTemasHerramientas1" value="1">
                                        <label class="form-check-label" for="dominioTemasHerramientas1">1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="dominioTemasHerramientas"
                                            id="dominioTemasHerramientas2" value="2">
                                        <label class="form-check-label" for="dominioTemasHerramientas2">2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="dominioTemasHerramientas"
                                            id="dominioTemasHerramientas3" value="3">
                                        <label class="form-check-label" for="dominioTemasHerramientas3">3</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="dominioTemasHerramientas"
                                            id="dominioTemasHerramientas4" value="4">
                                        <label class="form-check-label" for="dominioTemasHerramientas4">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="dominioTemasHerramientas"
                                            id="dominioTemasHerramientas5" value="5">
                                        <label class="form-check-label" for="dominioTemasHerramientas5">5</label>
                                    </div>
                                    <small class="ml-0 text-muted">Excelente</small>
                                </div>
                            </div>
                            <div class="col-12 preguntas">
                                <p class="m-1">2.3 El ritmo y tono de voz
                                    utilizado fue:</p>
                                <div class="d-flex align-items-center" style="flex-wrap:wrap">
                                    <small class="errores w-100 ritmoTonoVozUtilizado_error text-danger"></small>
                                    <small class="mr-2 text-muted">Insuficiente</small>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ritmoTonoVozUtilizado"
                                            id="ritmoTonoVozUtilizado1" value="1">
                                        <label class="form-check-label" for="ritmoTonoVozUtilizado1">1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ritmoTonoVozUtilizado"
                                            id="ritmoTonoVozUtilizado2" value="2">
                                        <label class="form-check-label" for="ritmoTonoVozUtilizado2">2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ritmoTonoVozUtilizado"
                                            id="ritmoTonoVozUtilizado3" value="3">
                                        <label class="form-check-label" for="ritmoTonoVozUtilizado3">3</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ritmoTonoVozUtilizado"
                                            id="ritmoTonoVozUtilizado4" value="4">
                                        <label class="form-check-label" for="ritmoTonoVozUtilizado4">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ritmoTonoVozUtilizado"
                                            id="ritmoTonoVozUtilizado5" value="5">
                                        <label class="form-check-label" for="ritmoTonoVozUtilizado5">5</label>
                                    </div>
                                    <small class="ml-0 text-muted">Excelente</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <p class="m-1">2.4 Las estrategias incentivaron
                                    la participación y entendimiento del conocimiento:</p>
                                <div class="d-flex align-items-center" style="flex-wrap:wrap">
                                    <small
                                        class="errores w-100 estrategirasIncentivaronParticipacion_error text-danger"></small>
                                    <small class="mr-2 text-muted">Insuficiente</small>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            name="estrategirasIncentivaronParticipacion"
                                            id="estrategirasIncentivaronParticipacion1" value="1">
                                        <label class="form-check-label"
                                            for="estrategirasIncentivaronParticipacion1">1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            name="estrategirasIncentivaronParticipacion"
                                            id="estrategirasIncentivaronParticipacion2" value="2">
                                        <label class="form-check-label"
                                            for="estrategirasIncentivaronParticipacion2">2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            name="estrategirasIncentivaronParticipacion"
                                            id="estrategirasIncentivaronParticipacion3" value="3">
                                        <label class="form-check-label"
                                            for="estrategirasIncentivaronParticipacion3">3</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            name="estrategirasIncentivaronParticipacion"
                                            id="estrategirasIncentivaronParticipacion4" value="4">
                                        <label class="form-check-label"
                                            for="estrategirasIncentivaronParticipacion4">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            name="estrategirasIncentivaronParticipacion"
                                            id="estrategirasIncentivaronParticipacion5" value="5">
                                        <label class="form-check-label"
                                            for="estrategirasIncentivaronParticipacion5">5</label>
                                    </div>
                                    <small class="ml-0 text-muted">Excelente</small>
                                </div>
                            </div>
                            <div class="col-12 preguntas">
                                <p class="m-1">2.5 En general, sus habilidades
                                    de presentación fueron:</p>
                                <div class="d-flex align-items-center" style="flex-wrap:wrap">
                                    <small class="errores w-100 habilidadesPresentacion_error text-danger"></small>
                                    <small class="mr-2 text-muted">Insuficiente</small>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="habilidadesPresentacion"
                                            id="habilidadesPresentacion1" value="1">
                                        <label class="form-check-label" for="habilidadesPresentacion1">1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="habilidadesPresentacion"
                                            id="habilidadesPresentacion2" value="2">
                                        <label class="form-check-label" for="habilidadesPresentacion2">2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="habilidadesPresentacion"
                                            id="habilidadesPresentacion3" value="3">
                                        <label class="form-check-label" for="habilidadesPresentacion3">3</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="habilidadesPresentacion"
                                            id="habilidadesPresentacion4" value="4">
                                        <label class="form-check-label" for="habilidadesPresentacion4">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="habilidadesPresentacion"
                                            id="habilidadesPresentacion5" value="5">
                                        <label class="form-check-label" for="habilidadesPresentacion5">5</label>
                                    </div>
                                    <small class="ml-0 text-muted">Excelente</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <p class="m-1">2.6 Comentarios acerca de los
                                    instructores:</p>
                                <div class="d-flex align-items-center" style="flex-wrap:wrap">
                                    <textarea class="form-control" name="comentariosAcercaInstructores"
                                        id="comentariosAcercaInstructores" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 px-3">
                            <div class="col-12 encabezado">
                                <strong>3. LOGÍSTICA</strong>
                            </div>
                            <div class="col-12 preguntas">
                                <p class="m-1">3.1 Considero que la duración del curso fue:</p>
                                <div class="d-flex align-items-center" style="flex-wrap:wrap">
                                    <small class="errores w-100 duracionCurso_error text-danger"></small>
                                    <small class="mr-2 text-muted">Insuficiente</small>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="duracionCurso"
                                            id="duracionCurso1" value="1">
                                        <label class="form-check-label" for="duracionCurso1">1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="duracionCurso"
                                            id="duracionCurso2" value="2">
                                        <label class="form-check-label" for="duracionCurso2">2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="duracionCurso"
                                            id="duracionCurso3" value="3">
                                        <label class="form-check-label" for="duracionCurso3">3</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="duracionCurso"
                                            id="duracionCurso4" value="4">
                                        <label class="form-check-label" for="duracionCurso4">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="duracionCurso"
                                            id="duracionCurso5" value="5">
                                        <label class="form-check-label" for="duracionCurso5">5</label>
                                    </div>
                                    <small class="ml-0 text-muted">Excelente</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <p class="m-1">3.2 Considero que el horario del curso fue:</p>
                                <div class="d-flex align-items-center" style="flex-wrap:wrap">
                                    <small class="errores w-100 horarioCurso_error text-danger"></small>
                                    <small class="mr-2 text-muted">Insuficiente</small>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="horarioCurso"
                                            id="horarioCurso1" value="1">
                                        <label class="form-check-label" for="horarioCurso1">1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="horarioCurso"
                                            id="horarioCurso2" value="2">
                                        <label class="form-check-label" for="horarioCurso2">2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="horarioCurso"
                                            id="horarioCurso3" value="3">
                                        <label class="form-check-label" for="horarioCurso3">3</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="horarioCurso"
                                            id="horarioCurso4" value="4">
                                        <label class="form-check-label" for="horarioCurso4">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="horarioCurso"
                                            id="horarioCurso5" value="5">
                                        <label class="form-check-label" for="horarioCurso5">5</label>
                                    </div>
                                    <small class="ml-0 text-muted">Excelente</small>
                                </div>
                            </div>
                            <div class="col-12 preguntas">
                                <p class="m-1">3.3 Considero que el seguimiento
                                    por parte del organizador fue:</p>
                                <div class="d-flex align-items-center" style="flex-wrap:wrap">
                                    <small class="errores seguimientoEmpresa_error w-100 text-danger"></small>
                                    <small class="mr-2 text-muted">Insuficiente</small>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="seguimientoEmpresa"
                                            id="seguimientoEmpresa1" value="1">
                                        <label class="form-check-label" for="seguimientoEmpresa1">1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="seguimientoEmpresa"
                                            id="seguimientoEmpresa2" value="2">
                                        <label class="form-check-label" for="seguimientoEmpresa2">2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="seguimientoEmpresa"
                                            id="seguimientoEmpresa3" value="3">
                                        <label class="form-check-label" for="seguimientoEmpresa3">3</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="seguimientoEmpresa"
                                            id="seguimientoEmpresa4" value="4">
                                        <label class="form-check-label" for="seguimientoEmpresa4">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="seguimientoEmpresa"
                                            id="seguimientoEmpresa5" value="5">
                                        <label class="form-check-label" for="seguimientoEmpresa5">5</label>
                                    </div>
                                    <small class="ml-0 text-muted">Excelente</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <p class="m-1">3.4 Recomendarías el curso:</p>
                                <div class="d-flex align-items-center" style="flex-wrap:wrap">
                                    <small class="errores w-100 recomendariaCurso_error text-danger"></small>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="recomendariaCurso"
                                            id="recomendariaCurso1" value="1">
                                        <label class="form-check-label" for="recomendariaCurso1">Sí</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="recomendariaCurso"
                                            id="recomendariaCurso0" value="0">
                                        <label class="form-check-label" for="recomendariaCurso2">No</label>
                                    </div>
                                </div>
                                {{-- <div class="d-flex align-items-center" style="flex-wrap:wrap">
                                    <small class="errores w-100 recomendariaCurso_error text-danger"></small>
                                    <small class="mr-2 text-muted">Insuficiente</small>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="recomendariaCurso"
                                            id="recomendariaCurso1" value="1">
                                        <label class="form-check-label" for="recomendariaCurso1">1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="recomendariaCurso"
                                            id="recomendariaCurso2" value="2">
                                        <label class="form-check-label" for="recomendariaCurso2">2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="recomendariaCurso"
                                            id="recomendariaCurso3" value="3">
                                        <label class="form-check-label" for="recomendariaCurso3">3</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="recomendariaCurso"
                                            id="recomendariaCurso4" value="4">
                                        <label class="form-check-label" for="recomendariaCurso4">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="recomendariaCurso"
                                            id="recomendariaCurso5" value="5">
                                        <label class="form-check-label" for="recomendariaCurso5">5</label>
                                    </div>
                                    <small class="ml-0 text-muted">Excelente</small>
                                </div> --}}
                            </div>
                            <div class="col-12 preguntas">
                                <p class="m-1">3.5 ¿Por qué?:</p>
                                <div class="d-flex align-items-center" style="flex-wrap:wrap">
                                    <textarea class="form-control" name="porqueSeRecomiendaElCurso"
                                        id="porqueSeRecomiendaElCurso" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" id="botonesContestarEncuesta">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        id="btnCancelarEvaluacion">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnGuadarEvaluacion">Guardar</button> --}}
                </div>
            </div>
        </div>
    </div>
</div>
