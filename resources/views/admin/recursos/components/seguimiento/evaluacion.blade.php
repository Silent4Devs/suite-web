<style>
    .titulo-seccion {
        background: #788BAC;
        color: white;
        font-size: 11pt;
    }

    #comentariosEvaluacion ul,
    #comentariosEvaluacion li {
        list-style: none;
        padding: 0;
    }

    #comentariosEvaluacion .container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0 1rem;
        background: linear-gradient(45deg, #209cff, #68e0cf);
        padding: 3rem 0;
    }

    #comentariosEvaluacion .wrapper {
        background: #eaf6ff;
        padding: 2rem;
        border-radius: 15px;
    }

    #comentariosEvaluacion h1 {
        font-size: 1.1rem;
        font-family: sans-serif;
    }

    #comentariosEvaluacion .sessions {
        margin-top: 2rem;
        border-radius: 12px;
        position: relative;
    }

    #comentariosEvaluacion li {
        padding-bottom: 1.5rem;
        border-left: 1px solid #abaaed;
        position: relative;
        padding-left: 20px;
        margin-left: 10px;
    }

    #comentariosEvaluacion li:last-child {
        border: 0px;
        padding-bottom: 0;
    }

    #comentariosEvaluacion li:before {
        content: '';
        width: 15px;
        height: 15px;
        background: white;
        border: 1px solid #4e5ed3;
        box-shadow: 3px 3px 0px #bab5f8;
        box-shadow: 3px 3px 0px #bab5f8;
        border-radius: 50%;
        position: absolute;
        left: -10px;
        top: 0px;
    }

    #comentariosEvaluacion .time {
        color: #2a2839;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
    }

    @media screen and (min-width: 601px) {
        #comentariosEvaluacion .time {
            font-size: 0.9rem;
        }
    }

    @media screen and (max-width: 600px) {
        #comentariosEvaluacion .time {
            margin-bottom: 0.3rem;
            font-size: 0.85rem;
        }
    }

    #comentariosEvaluacion p {
        color: #4f4f4f;
        font-family: sans-serif;
        line-height: 1.5;
        margin-top: 0.4rem;
    }

    @media screen and (max-width: 600px) {
        #comentariosEvaluacion p {
            font-size: 0.9rem;
        }
    }

</style>
<div class="row mt-4 align-items-center">
    <div class="col-12" x-data="{show:true}">
        <div>
            <span>RADAR</span><span x-on:click="show=!show"><i class="fas fa-minus"
                    x-bind:class="show?'fa-minus':'fa-plus'"></i></span>
        </div>
        <canvas x-show="show" x-transition id="radarChart" width="400" height="400"></canvas>
    </div>
    <div class="col-12" x-data="{show:false}">
        <div>
            <span>GENERAL</span><span x-on:click="show=!show"><i class="fas fa-minus"
                    x-bind:class="show?'fa-minus':'fa-plus'"></i></span>
        </div>
        <div class="row" x-show="show" x-transition>
            <div class="col-12 titulo-seccion">
                CONTENIDO
            </div>
            <div class="col-4 text-center">
                <canvas id="utilidadTemasVistos" width="400" height="400"></canvas>
            </div>
            <div class="col-4 text-center">
                <canvas id="calidadClaridadContenido" width="400" height="400"></canvas>
            </div>
            <div class="col-4 text-center">
                <canvas id="favorecioAprendizaje" width="400" height="400"></canvas>
            </div>
            <div class="col-4 text-center">
                <canvas id="materialesAudioVisualesCalidad" width="400" height="400"></canvas>
            </div>
            <div class="col-4 text-center">
                <canvas id="materialEntregadoCalidad" width="400" height="400"></canvas>
            </div>
            <div class="col-4 text-center">
                <canvas id="cumplioObjetivo" width="400" height="400"></canvas>
            </div>
            <div class="col-12 titulo-seccion">
                INSTRUCTORES
            </div>
            <div class="col-4 text-center">
                <canvas id="puntualidadInstructor" width="400" height="400"></canvas>
            </div>
            <div class="col-4 text-center">
                <canvas id="dominioTemasHerramientas" width="400" height="400"></canvas>
            </div>
            <div class="col-4 text-center">
                <canvas id="ritmoTonoVozUtilizado" width="400" height="400"></canvas>
            </div>
            <div class="col-4 text-center">
                <canvas id="estrategirasIncentivaronParticipacion" width="400" height="400"></canvas>
            </div>
            <div class="col-4 text-center">
                <canvas id="habilidadesPresentacion" width="400" height="400"></canvas>
            </div>
            <div class="col-12 titulo-seccion">
                LOGÍSTICA
            </div>
            <div class="col-4 text-center">
                <canvas id="duracionCurso" width="400" height="400"></canvas>
            </div>
            <div class="col-4 text-center">
                <canvas id="horarioCurso" width="400" height="400"></canvas>
            </div>
            <div class="col-4 text-center">
                <canvas id="seguimientoEmpresa" width="400" height="400"></canvas>
            </div>
            <div class="col-4 text-center">
                <canvas id="recomendariaCurso" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
    <div id="comentariosEvaluacion" class="container" x-data="{show:false}">
        <div>
            <span>COMENTARIOS</span><span x-on:click="show=!show"><i class="fas fa-minus"
                    x-bind:class="show?'fa-minus':'fa-plus'"></i></span>
        </div>
        <div class="wrapper" x-show="show" x-transition>
            <h1> Comentarios de la Evaluación</h1>
            <ul class="sessions" id="comentarios">
            </ul>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
<script>
    const recurso = @json($recurso);
    const empleados = recurso.empleados;

    renderizarGraficasSuficienteInsuficiente('utilidadTemasVistos', 'Utilidad de Temas Vistos');
    renderizarGraficasSuficienteInsuficiente('calidadClaridadContenido', 'Contenido');
    renderizarGraficasSuficienteInsuficiente('favorecioAprendizaje', 'Aprendizaje de la Capacitación');
    renderizarGraficasSuficienteInsuficiente('materialesAudioVisualesCalidad', 'Material Audiovisual');
    renderizarGraficasSuficienteInsuficiente('materialEntregadoCalidad', 'Material de Apoyo');
    renderizarGraficasSiNo('cumplioObjetivo', 'Se Cumplió el Objetivo');
    renderizarGraficasSuficienteInsuficiente('puntualidadInstructor', 'Puntualidad del Instructor');
    renderizarGraficasSuficienteInsuficiente('dominioTemasHerramientas', 'Dominio del Tema');
    renderizarGraficasSuficienteInsuficiente('ritmoTonoVozUtilizado', 'Ritmo y Tono de Voz');
    renderizarGraficasSuficienteInsuficiente('estrategirasIncentivaronParticipacion', 'Estrategia de Aprendizaje');
    renderizarGraficasSuficienteInsuficiente('habilidadesPresentacion', 'Habilidades de Presentación');
    renderizarGraficasSuficienteInsuficiente('duracionCurso', 'Duración de la Capacitación');
    renderizarGraficasSuficienteInsuficiente('horarioCurso', 'Horario de la Capacitación');
    renderizarGraficasSuficienteInsuficiente('seguimientoEmpresa', 'Seguimiento del Organizador');
    renderizarGraficasSiNo('recomendariaCurso', 'Recomendarías la Capacitación');

    const promedios = {
        utilidadTemasVistos: [],
        calidadClaridadContenido: [],
        favorecioAprendizaje: [],
        materialesAudioVisualesCalidad: [],
        materialEntregadoCalidad: [],
        cumplioObjetivo: [],
        puntualidadInstructor: [],
        dominioTemasHerramientas: [],
        ritmoTonoVozUtilizado: [],
        estrategirasIncentivaronParticipacion: [],
        habilidadesPresentacion: [],
        duracionCurso: [],
        horarioCurso: [],
        seguimientoEmpresa: [],
        recomendariaCurso: []
    }
    const arrayPromedios = [];
    let reducido = null;
    const preguntas = Object.keys(promedios);
    const reducer = (previousValue, currentValue) => previousValue + currentValue;
    preguntas.forEach(pregunta => {
        obtenerPromedioPorPregunta(pregunta);
        reducido = promedios[pregunta].reduce(reducer);
        arrayPromedios.push(reducido);
    });
    renderizarRadarChart(arrayPromedios);

    renderizarComentarios();

    function renderizarComentarios() {
        const comentarios = obtenerComentarios();
        comentarios.forEach((comentario, index) => {
            const comentariosContenedor = document.getElementById('comentarios');
            console.log(comentario.porqueSeRecomiendaElCurso.trim() != null);
            if (comentario.comentariosAcercaInstructores != null && comentario.porqueSeRecomiendaElCurso !=
                null) {
                comentariosContenedor.innerHTML += `
                    <p class="text-muted"><i class="fas fa-user-secret"></i> Anónimo ${index+1}</p>
                    ${comentario.comentariosAcercaInstructores.trim()!= null&&comentario.comentariosAcercaInstructores.trim()!= "" ? `
                        <li>
                            <div class="time">Comentarios acerca de los instructores</div>
                            <p>${comentario.comentariosAcercaInstructores}</p>
                        </li>`:''
                    }
                    ${comentario.porqueSeRecomiendaElCurso.trim() != null && comentario.porqueSeRecomiendaElCurso.trim() != "" ? `
                    <li>
                        <div class="time">¿Por qué recomienda el curso?</div>
                        <p>${comentario.porqueSeRecomiendaElCurso}</p>
                    </li>
                    `:''}`;
            }
        });
    }

    function renderizarRadarChart(arrayPromedios) {
        console.log(arrayPromedios);
        const preguntas = Object.keys(arrayPromedios);
        const ctx = document.getElementById('radarChart').getContext('2d');
        const evaluacionRealizada = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: ['Utilidad de Temas Vistos', 'Contenido', 'Aprendizaje de la Capacitación',
                    'Material Audiovisual', 'Material de Apoyo', 'Se Cumplió el Objetivo',
                    'Puntualidad del Instructor', 'Dominio del Tema', 'Ritmo y Tono de Voz',
                    'Estrategia de Aprendizaje', 'Habilidades de Presentación',
                    'Duración de la Capacitación', 'Horario de la Capacitación',
                    'Seguimiento del Organizador', 'Recomendarías la Capacitación'
                ],
                datasets: [{
                    label: '# de Evaluaciones',
                    data: arrayPromedios,
                    fill: true,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgb(255, 99, 132)',
                    pointBackgroundColor: 'rgb(255, 99, 132)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(255, 99, 132)'
                }]
            },
            options: {
                indexAxis: 'y',
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Promedios'
                    },
                    legend: {
                        display: false
                    },
                }
            }
        });
    }

    function obtenerPromedioPorPregunta(pregunta) {
        empleados.forEach(empleado => {
            if (empleado.pivot.evaluacion != null) {
                const evaluacion = JSON.parse(empleado.pivot.evaluacion);
                for (const key in evaluacion) {
                    if (key === pregunta) {
                        const evaluacionDada = evaluacion[key];
                        promedios[pregunta].push(Number(evaluacionDada));
                    }

                }
            }
        });
    }

    function obtenerComentarios() {
        const arrayComentarios = [];
        empleados.forEach(empleado => {
            if (empleado.pivot.evaluacion != null) {
                const evaluacion = JSON.parse(empleado.pivot.evaluacion);
                const comentarios = {
                    comentariosAcercaInstructores: evaluacion
                        .comentariosAcercaInstructores,
                    porqueSeRecomiendaElCurso: evaluacion
                        .porqueSeRecomiendaElCurso
                };
                arrayComentarios.push(comentarios);
            }
        });
        return arrayComentarios;
    }

    function renderizarGraficasSuficienteInsuficiente(pregunta, titulo = "Sin Titulo") {
        let insuficiente = 0;
        let nivel2 = 0;
        let nivel3 = 0;
        let nivel4 = 0;
        let suficiente = 0;
        empleados.forEach(empleado => {
            if (empleado.pivot.evaluacion != null) {
                const evaluacion = JSON.parse(empleado.pivot.evaluacion);
                for (const key in evaluacion) {
                    if (key === pregunta) {
                        const evaluacionDada = evaluacion[key];
                        if (evaluacionDada == 1) {
                            insuficiente++;
                        } else if (evaluacionDada == 2) {
                            nivel2++;
                        } else if (evaluacionDada == 3) {
                            nivel3++;
                        } else if (evaluacionDada == 4) {
                            nivel4++;
                        } else if (evaluacionDada == 5) {
                            suficiente++;
                        }
                    }

                }
            }
        });

        const ctx = document.getElementById(pregunta).getContext('2d');
        const evaluacionRealizada = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Insuficiente  1', '2', '3', '4', 'Excelente  5'],
                datasets: [{
                    label: '# de Evaluaciones',
                    data: [insuficiente, nivel2, nivel3, nivel4, suficiente],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: titulo
                    },
                    legend: {
                        display: false
                    },
                }
            }
        });
    }

    function renderizarGraficasSiNo(pregunta, titulo = "Sin Titulo") {
        let respuestaSi = 0;
        let respuestaNo = 0;
        empleados.forEach(empleado => {
            if (empleado.pivot.evaluacion != null) {
                const evaluacion = JSON.parse(empleado.pivot.evaluacion);
                for (const key in evaluacion) {
                    if (key === pregunta) {
                        const evaluacionDada = evaluacion[key];
                        if (evaluacionDada == 1) {
                            respuestaSi++;
                        } else if (evaluacionDada == 0) {
                            respuestaNo++;
                        }
                    }

                }
            }
        });

        const ctx = document.getElementById(pregunta).getContext('2d');
        const evaluacionRealizada = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Sí', 'No'],
                datasets: [{
                    label: '# de Evaluaciones',
                    data: [respuestaSi, respuestaNo],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: titulo
                    },
                    legend: {
                        display: false
                    },
                }
            }
        });
    }
</script>
