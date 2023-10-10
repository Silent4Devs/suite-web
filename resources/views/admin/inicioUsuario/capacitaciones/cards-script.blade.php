<script>
    document.addEventListener('DOMContentLoaded', function() {
        const contenedorCards = document.getElementById('cards-mis-capacitaciones');
        const contendorPrincipalCapacitaciones = document.getElementById('contendor-principal-capacitaciones');
        const selectTipoCapacitacion = document.getElementById('selectTipoCapacitacion');
        const btnArchivo = document.getElementById('btnArchivo');
        const btnPrincipales = document.getElementById('btnPrincipales');
        let popperInstance = null; // instancia para popper js
        // Iniciar con cards
        inicializarCapacitacionesGeneralesCards();


        btnArchivo.addEventListener('click', function(e) {
            const url = this.getAttribute('data-url');
            inicializarCapacitacionesGeneralesCards('Sin Capacitaciones Archivadas', 'todo', url);
        })
        // btnPrincipales.addEventListener('click', function(e) {
        //     const url = this.getAttribute('data-url');
        //     inicializarCapacitacionesGeneralesCards('Sin Capacitaciones', 'todo', url);
        // })

        selectTipoCapacitacion.addEventListener('change', function(e) {
            inicializarCapacitacionesGeneralesCards(`Sin Capacitaciones ${this.value}`, this.value);
        })

        contenedorCards.addEventListener('click', function(e) {
            const parentCard = e.target.closest('.capacitacion-card');
            if (parentCard?.classList.contains('capacitacion-card')) {
                limpiarContenedorInformacionCards();
                parentCard.classList.add('active-card');
                const modelo = JSON.parse(window.atob(parentCard.getAttribute('data-capacitacion')));
                const categoriaColumn = parentCard.getAttribute('data-categoria');
                const capacitacionAceptada = parentCard.getAttribute('data-aceptada');
                const capacitacionArchivada = parentCard.getAttribute('data-archivado');
                const empleadoYaEvaluo = parentCard.getAttribute('data-evaluacion-contestada');
                const encuestaRealizadaPorElEmpleado = parentCard.getAttribute(
                    'data-evaluacion-realizada');
                let html =
                    `
                <div id="configuracionCard" style="z-index:1 !important;width:339px" role="tooltip">
                    <div class="arrow"></div>
                    <div id="carouselCapacitaciones" class="carousel slide border-blue rounded p-2 bg-white" data-ride="carousel">
                        <div class="col-12">
                            ${headerAuxCardHTML(modelo,categoriaColumn,capacitacionAceptada,capacitacionArchivada,empleadoYaEvaluo,encuestaRealizadaPorElEmpleado)}
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row align-items-center">
                                    <div class="col-12" id="contenedorInformacionGeneral">
                                        <p class="m-0" style="text-transform: capitalize; font-weight: bold">
                                            ${modelo.cursoscapacitaciones}
                                        </p>
                                        <p class="m-0" style="font-size: 12px">Tipo: ${modelo.tipo}</p>
                                        <p class="m-0" style="font-size: 12px">Categoría: ${modelo.categoria_capacitacion.nombre}</p>
                                        <p class="m-0" style="font-size: 12px">Instructor: ${modelo.instructor}</p>
                                        ${modelo.modalidad =='presencial'?`<p class="m-0" style="font-size: 12px">Ubicación: ${modelo.ubicacion}</p>`:''}`;
                if (capacitacionAceptada == 'null') {
                    html += `
                        <p class="m-0" style="font-size: 12px">
                            <span id="timer" style="font-weight: bold;">${timer(modelo.fecha_limite_ymd)?timer(modelo.fecha_inicio_ymd):''}</span>
                        </p>
                    `;
                }
                html += `</div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row" id="contenedorDescripcion">
                                    <div class="col-12">
                                        <p class="m-0">
                                        <strong>Descripción</strong>
                                        </p>
                                        <p class="m-0" style="overflow: auto;max-height: 95px;">${modelo.descripcion?modelo.descripcion:'Sin descripción'}</p>
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-next" type="button" data-target="#carouselCapacitaciones" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </button>
                        </div>
                    </div>

                    <div id="arrow" data-popper-arrow></div>
                </div>
                `;
                const contenedorInformacionCapacitaciones = document.getElementById(
                    'contenedor-info-card-capacitaciones');

                contenedorInformacionCapacitaciones.innerHTML = html;

                const popcorn = parentCard;
                const tooltip = document.querySelector('#configuracionCard');
                popperInstance = Popper.createPopper(popcorn, tooltip, {
                    placement: 'bottom',
                    modifiers: [{
                        name: 'offset',
                        options: {
                            offset: [0, 10],
                        },
                    }, {
                        name: 'flip',
                        enabled: false,
                    }]
                });
                $('#carouselCapacitaciones').carousel('pause');

                document.querySelector('[data-type="cerrar"]').addEventListener('click', function(e) {
                    popperInstance.destroy();
                    limpiarContenedorInformacionCards();
                })
                document.getElementById('descripcionBtn').addEventListener('click', function(e) {
                    $('#carouselCapacitaciones').carousel('next')
                })

                if (document.getElementById('rechazarCapacitacion')) {
                    document.getElementById('rechazarCapacitacion').addEventListener('click', function(
                        e) {
                        try {
                            Swal.fire({
                                title: '¿Quieres rechazar esta capacitación?',
                                text: "",
                                icon: 'question',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Sí, Rechazar',
                                cancelButtonText: 'Cancelar',
                            }).then(async (result) => {
                                if (result.isConfirmed) {
                                    const url =
                                        "{{ route('admin.recursos.respuestaCapacitacion') }}"
                                    const recurso = e.target.getAttribute(
                                        'data-recurso');
                                    const formData = new FormData();
                                    formData.append('esAceptada', false);
                                    formData.append('recurso', recurso);
                                    const response = await fetch(url, {
                                        method: "POST",
                                        body: formData,
                                        headers: {
                                            Accept: "application/json",
                                            'X-CSRF-TOKEN': $(
                                                    'meta[name="csrf-token"]'
                                                )
                                                .attr('content')
                                        },
                                    });
                                    const data = await response.json();
                                    if (data.estatus == 200) {
                                        inicializarCapacitacionesGeneralesCards();
                                        toastr.success(data.mensaje);
                                    } else {
                                        toastr.error(data.mensaje);
                                    }
                                }
                            })
                        } catch (error) {
                            toastr.error(error);
                        }
                    })
                }

                if (document.getElementById('aceptarCapacitacion')) {
                    document.getElementById('aceptarCapacitacion').addEventListener('click', function(
                        e) {
                        try {
                            Swal.fire({
                                title: '¿Quieres aceptar esta capacitación?',
                                text: "",
                                icon: 'question',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Aceptar',
                                cancelButtonText: 'Cancelar',
                            }).then(async (result) => {
                                if (result.isConfirmed) {
                                    const url =
                                        "{{ route('admin.recursos.respuestaCapacitacion') }}"
                                    const recurso = e.target.getAttribute(
                                        'data-recurso');
                                    const formData = new FormData();
                                    formData.append('esAceptada', true);
                                    formData.append('recurso', recurso);
                                    const response = await fetch(url, {
                                        method: "POST",
                                        body: formData,
                                        headers: {
                                            Accept: "application/json",
                                            'X-CSRF-TOKEN': $(
                                                    'meta[name="csrf-token"]'
                                                )
                                                .attr('content')
                                        },
                                    });
                                    const data = await response.json();
                                    if (data.estatus == 200) {
                                        inicializarCapacitacionesGeneralesCards();
                                        toastr.success(data.mensaje);
                                    } else {
                                        toastr.error(data.mensaje);
                                    }
                                }
                            })

                        } catch (error) {
                            toastr.error(error);
                        }
                    })
                }
                if (document.getElementById('archivarBtn')) {
                    document.getElementById('archivarBtn').addEventListener('click', function(
                        e) {
                        try {
                            const tipo = e.target.getAttribute('data-tipo');
                            Swal.fire({
                                title: `¿Quieres ${tipo} esta capacitación?`,
                                text: "",
                                icon: 'question',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Archivar',
                                cancelButtonText: 'Cancelar',
                            }).then(async (result) => {
                                if (result.isConfirmed) {
                                    const url =
                                        "{{ route('admin.recursos.archivarCapacitacion') }}"
                                    const aceptada = e.target.getAttribute(
                                        'data-aceptada');
                                    const recurso = e.target.getAttribute(
                                        'data-recurso');
                                    const formData = new FormData();
                                    if (tipo == "archivar") {
                                        formData.append('archivado', true);
                                    } else {
                                        formData.append('archivado', false);
                                    }
                                    formData.append('recurso', recurso);
                                    formData.append('aceptada', aceptada);
                                    const response = await fetch(url, {
                                        method: "POST",
                                        body: formData,
                                        headers: {
                                            Accept: "application/json",
                                            'X-CSRF-TOKEN': $(
                                                    'meta[name="csrf-token"]'
                                                )
                                                .attr('content')
                                        },
                                    });
                                    const data = await response.json();
                                    if (data.estatus == 200) {
                                        inicializarCapacitacionesGeneralesCards();
                                        toastr.success(data.mensaje);
                                    } else {
                                        toastr.error(data.mensaje);
                                    }
                                }
                            })

                        } catch (error) {
                            toastr.error(error);
                        }
                    })
                }

                if (document.getElementById('evaluarCapacitacionBtn')) {
                    document.getElementById('evaluarCapacitacionBtn').addEventListener('click',
                        function(e) {
                            document.getElementById('botonesContestarEncuesta').innerHTML = null;
                            const nombre = e.target.getAttribute('data-nombre');
                            const empleadoYaEvaluo = e.target.getAttribute('data-evaluo');
                            const encuestaRealizadaPorElEmpleado = JSON.parse(window.atob(e.target
                                .getAttribute(
                                    'data-evaluacion-realizada')));
                            renderizarRespuestas(encuestaRealizadaPorElEmpleado);
                            if (empleadoYaEvaluo == 'false') {
                                const recurso = e.target.getAttribute('data-recurso');
                                document.getElementById('botonesContestarEncuesta').innerHTML = `
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                id="btnCancelarEvaluacion">Cancelar</button>
                                <button type="button" class="btn btn-primary" id="btnGuadarEvaluacion">Guardar</button>
                                `
                                const btnGuadarEvaluacion = document.getElementById(
                                    'btnGuadarEvaluacion');
                                btnGuadarEvaluacion.setAttribute('data-recurso', recurso);
                            }
                            const modalNombreCapacitacion = document.getElementById(
                                'modalNombreCapacitacion');
                            modalNombreCapacitacion.innerText = nombre;
                            $('#modalEncuesta').modal('show');

                        })
                }
                if (document.getElementById('modalEncuesta')) {
                    document.getElementById('modalEncuesta').addEventListener('click', async function(
                        e) {
                        if (e.target.getAttribute('id') == 'btnGuadarEvaluacion') {
                            const recurso = e.target.getAttribute(
                                'data-recurso');
                            const formularioEncuesta = document.getElementById(
                                'formularioEncuesta');
                            const url = formularioEncuesta.getAttribute(
                                'action');
                            const formData = new FormData(formularioEncuesta);
                            formData.append('recurso', recurso);
                            limpiarErroresValidacion();
                            try {
                                const response = await fetch(url, {
                                    method: "POST",
                                    body: formData,
                                    headers: {
                                        Accept: "application/json",
                                        'X-CSRF-TOKEN': $(
                                                'meta[name="csrf-token"]'
                                            )
                                            .attr('content')
                                    },
                                });
                                const data = await response.json();
                                if (data.estatus == 200) {
                                    inicializarCapacitacionesGeneralesCards();
                                    document.getElementById('formularioEncuesta').reset();
                                    $('#modalEncuesta').modal('hide');
                                    document.getElementById('modalEncuesta').style.display =
                                        'none';
                                    toastr.success('Gracias por tu evaluación');
                                }
                                if (data.errors) {
                                    $.each(data.errors, function(indexInArray,
                                        valueOfElement) {
                                        $(`.${indexInArray.replaceAll('.','_')}_error`)
                                            .text(
                                                valueOfElement[0]);
                                    });
                                    toastr.error(
                                        'Tu resgitro contiene errores de validación, revisa los inputs por favor.'
                                    );
                                }
                            } catch (error) {
                                toastr.error(error);
                            }
                        }
                    })
                }


                // document.getElementById('generalBtn').addEventListener('click', function(e) {
                //     $('#carouselCapacitaciones').carousel('prev')
                // })
                // $('#carouselCapacitaciones').on('slide.bs.carousel', function() {
                //     const currentSlide = $('.active');
                //     if (currentSlide.is(':first-child')) {
                //         console.log('first');
                //     }
                //     if (currentSlide.is(':last-child')) {
                //         console.log('last');
                //     }
                // })
            }
        })

        function limpiarErroresValidacion() {
            document.querySelectorAll('.errores').forEach(element => {
                element.innerText = null;
            });
        }

        function destruirInstanciaDePopperLimparConfigCard(popperInstance) {
            popperInstance.destroy();
            const contenedorInformacionCapacitaciones = document.getElementById(
                'contenedor-info-card-capacitaciones');
            contenedorInformacionCapacitaciones.innerHTML = null;
        }

        async function inicializarCapacitacionesGeneralesCards(mensaje = "Sin Capacitaciones", filtro = 'todo',
            url =
            "{{ route('admin.recursos.obtenerCapacitacionesPrincipales') }}") {
            const cardsMisCapacitaciones = document.getElementById('cards-mis-capacitaciones');
            if (popperInstance) {
                destruirInstanciaDePopperLimparConfigCard(popperInstance);
            }
            // cardsMisCapacitaciones.innerHTML = null; // limpiar el conenedor
            const formData = new FormData();
            formData.append('filtro', filtro)
            const response = await fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    Accept: "application/json",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'),
                }
            });
            const {
                capacitaciones
            } = await response.json();
            // const {
            //     curso,
            //     proximas,
            //     terminadas
            // } = capacitaciones;
            let html = "";
            // let htmlProximas = `<div class="col-4" id="proximamente">`
            // proximas.forEach(element => {
            //     const icono = definirIconoParaCardPrincipal(element);
            //     htmlProximas += cardInformacionCapacitacionHTML(element, 'Próximamente', 'blue',
            //         icono, 'proximamente');
            // });
            // htmlProximas += "</div>";

            // let htmlEnCurso = `<div class="col-4" id="en_curso">`;
            // curso.forEach(element => {
            //     const icono = definirIconoParaCardPrincipal(element);
            //     htmlEnCurso += cardInformacionCapacitacionHTML(element, 'En Curso', 'green',
            //         icono, 'curso');
            // });
            // htmlEnCurso += "</div>";

            // let htmlTerminado = `<div class="col-4" id="terminado">`;
            // terminadas.forEach(element => {
            //     const icono = definirIconoParaCardPrincipal(element);
            //     htmlTerminado += cardInformacionCapacitacionHTML(element, 'Terminado', 'red',
            //         icono, 'terminado');
            // });
            // htmlTerminado += "</div>";
            if (capacitaciones.length > 0) {
                document.getElementById('contadorDeCapacitaciones').innerText = capacitaciones.length;
                let htmlMezcladas = `<div class="col-12" id="mezcladas"><div class="row">`;
                capacitaciones.forEach(element => {
                    const icono = definirIconoParaCardPrincipal(element);
                    htmlMezcladas += cardInformacionCapacitacionHTML(
                        element,
                        element.estatus_aceptacion.nombre,
                        element.estatus_aceptacion.color,
                        icono, element.estatus_aceptacion.code
                    );
                });
                htmlMezcladas += "</div></div>";

                // html += htmlProximas;
                // html += htmlEnCurso;
                // html += htmlTerminado;
                html += htmlMezcladas;
                cardsMisCapacitaciones.innerHTML = html;
            } else {
                if (document.getElementById('contadorDeCapacitaciones')) {
                    document.getElementById('contadorDeCapacitaciones').innerText = 0;
                }
                cardsMisCapacitaciones.innerHTML = sinCapacitaciones(mensaje);
            }
        }

        function renderizarRespuestas(encuesta) {
            for (const key in encuesta) {
                const element = encuesta[key];
                const elementID = key + element;
                document.querySelectorAll(`[name="${key}"]`).forEach(el => {
                    el.setAttribute('disabled', true);
                })
                if (document.getElementById(elementID)) {
                    document.getElementById(elementID).checked = true;
                }
            }
            document.getElementById('porqueSeRecomiendaElCurso').innerText = encuesta ?
                encuesta.porqueSeRecomiendaElCurso : null;
            document.getElementById('comentariosAcercaInstructores').innerText = encuesta ?
                encuesta.comentariosAcercaInstructores : null;
        }

        function cardInformacionCapacitacionHTML(modelo, estatus, color, icono, categoria, textColor = "#fff") {
            const encode = window.btoa(JSON.stringify(modelo));
            const empleado = modelo.empleados[0].pivot;
            const encodeEvaluacion = window.btoa(modelo.empleados[0].pivot.evaluacion);
            return `
            <div class="col-4">
                <div class="card capacitacion-card" data-capacitacion="${encode}" data-categoria="${categoria}" data-aceptada="${empleado.es_aceptada}" data-evaluacion-contestada="${empleado.evaluacion!=null?true:false}" data-evaluacion-realizada="${encodeEvaluacion}" data-archivado="${empleado.archivado}">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h6 class="card-title d-flex align-items-center" style="text-transform: capitalize;">
                                    ${icono}
                                    ${modelo.cursoscapacitaciones}
                                </h6>
                            </div>
                            <div class="col-4" style="text-align: right;">
                                <p class="badge" style="color:${color}">${estatus}</p>
                            </div>
                        </div>
                        <p class="m-0" style="font-size: 12px">Inicia: ${modelo.only_fecha_inicio} Termina: ${modelo.only_fecha_fin}</p>
                        <p class="m-0" style="font-size: 12px">Horario: ${modelo.only_fecha_inicio_hora} a ${modelo.only_fecha_fin_hora}</p>
                    </div>
                </div>
            </div>
            `;
        }

        function headerAuxCardHTML(modelo, categoriaColumn, capacitacionAceptada, capacitacionArchivada,
            empleadoYaEvaluo, encuestaRealizadaPorElEmpleado, tipo =
            'general') {
            let archivo = modelo.archivos[0]?.ruta_archivo;
            let html =
                `<div class="text-muted" style="display: flex;align-items: center;justify-content: end;">`;
            if (categoriaColumn == 'proximamente' || categoriaColumn == 'curso') {
                if (capacitacionAceptada === 'true') {
                    html += `<span class="badge badge-success mr-2">Aceptada</span>`;
                    if (capacitacionArchivada == 'false') {
                        html += `
                            <i id="rechazarCapacitacion" data-recurso="${modelo.id}" class="far fa-times-circle text-danger mr-2" title="Rechazar" style="cursor: pointer;"></i>
                            `;
                    }
                } else if (capacitacionAceptada === 'false') {
                    html +=
                        `<span class="badge badge-danger mr-2">Rechazada</span>`;
                    if (capacitacionArchivada == 'false') {
                        html += `<i id="aceptarCapacitacion" data-recurso="${modelo.id}" class="far fa-check-circle mr-2" title="Confirmar"
                        style="color: rgb(50, 219, 50);cursor: pointer;"></i>`;
                    }
                } else if (capacitacionAceptada === 'null') {
                    html += `<span class="badge badge-info mr-2">Sin Respuesta</span>`;
                    if (new Date().toISOString() <= new Date(modelo.fecha_limite).toISOString()) {
                        html +=
                            `
                            <i id="aceptarCapacitacion" data-recurso="${modelo.id}" class="far fa-check-circle mr-2" title="Confirmar"
                        style="color: rgb(50, 219, 50);cursor: pointer;"></i>
                        <i id="rechazarCapacitacion" data-recurso="${modelo.id}" class="far fa-times-circle text-danger mr-2" title="Rechazar" style="cursor: pointer;"></i>`;
                    }
                }
            }
            if (archivo) {
                html += `
                <a href="${archivo}" target="_blank"><i class="fas fa-file mr-2" style="cursor: pointer;"
                    title="Documentos Adjuntos"></i></a>`;
            }
            if (tipo == 'descripcion') {
                html += `
                <i class="fas fa-chalkboard-teacher mr-2" id="generalBtn" style="cursor: pointer;" title="General"></i>
                `;
            } else {
                html += `
                    <i class="fas fa-info-circle mr-2" id="descripcionBtn" style="cursor: pointer;"
                    title="Descripción"></i>
                    `;
            }
            if (modelo.modalidad == 'linea') {
                if (!modelo.is_sync_elearning) {
                    html += `
                <a href="${modelo.ubicacion}" target="_blank"><i class="fas fa-link mr-2" style="cursor: pointer;" title="Abrir Vínculo"></i></a>
                `;
                } else {
                    let URL_API_ELEARNING = @json(env('APP_ELEARNING'));
                    html += `
                <a href="${URL_API_ELEARNING}/course-status/${modelo.ubicacion}" target="_blank"><i class="fas fa-link mr-2" style="cursor: pointer;" title="Abrir Vínculo"></i></a>
                `;
                }
            }
            if (capacitacionArchivada == 'false') {
                if (categoriaColumn == 'terminado' || capacitacionAceptada === 'false') {
                    html +=
                        `<i class="fas fa-archive mr-2" id="archivarBtn" title="Archivar" data-tipo="archivar" data-recurso="${modelo.id}" data-aceptada="${capacitacionAceptada}" style="cursor: pointer;"></i>`;
                }
            }
            if (modelo.ya_finalizo) {
                html += `
                <i class="fas fa-tasks mr-2" id="evaluarCapacitacionBtn" title="Evaluar Capacitación" data-recurso="${modelo.id}" data-evaluacion-realizada="${encuestaRealizadaPorElEmpleado}" data-nombre="${modelo.cursoscapacitaciones}" data-evaluo="${empleadoYaEvaluo}" style="cursor: pointer;"></i>
                `;
            }
            if (capacitacionArchivada == 'true') {
                if ((capacitacionAceptada === 'false' || capacitacionAceptada === "null") &&
                    categoriaColumn == 'proximamente') {
                    html +=
                        `<i class="fas fa-box-open mr-2" id="archivarBtn" title="Quitar de Archivo" data-tipo="desarchivar" data-recurso="${modelo.id}" data-aceptada="${capacitacionAceptada}" style="cursor: pointer;"></i>`;
                }
            }
            html += `<i class="fas fa-times" data-type="cerrar" style="cursor: pointer;" title="Cerrar"></i>
            </div>
            `;
            return html;
        }

        function sinCapacitaciones(mensaje) {
            let html = `
            <div class="col-12 text-center" id="sinCapacitaciones">
                    <p><strong style="text-transform: capitalize">${mensaje}</strong></p>
                    <img class="img-fluid" src="{{ asset('img/empleados_no_encontrados.svg') }}" alt="sin participante" width="300">
            </div>
            `;
            return html;
        }

        function definirIconoParaCardPrincipal(element) {
            const empleado = element.empleados[0].pivot.es_aceptada;
            let icono = `<i class="far fa-question-circle mr-1 text-muted" style="font-size: 18px"></i>`;
            if (empleado === true) {
                icono = `<i class="far fa-check-circle mr-1 text-success" style="font-size: 18px;"></i>`;
            } else if (empleado === false) {
                icono = `<i class="far fa-times-circle mr-1 text-danger" style="font-size: 18px"></i>`;
            }
            return icono;
        }

        function limpiarContenedorInformacionCards() {
            const contenedorInformacionCapacitaciones = document.getElementById(
                'contenedor-info-card-capacitaciones');
            const activos = document.querySelectorAll('.active-card').forEach(element => {
                element.classList.remove('active-card');
            })
            contenedorInformacionCapacitaciones.innerHTML = null;
            if (document.getElementById("timer")) {
                document.getElementById("timer").destroy();
            }
            const interval_id = window.setInterval(function() {}, Number.MAX_SAFE_INTEGER);
            // Clear any timeout/interval up to that id
            for (let i = 1; i < interval_id; i++) {
                window.clearInterval(i);
            }
        }

        function timer(date) {
            // Set the date we're counting down to
            var countDownDate = new Date(date).getTime();

            // Update the count down every 1 second
            var x = setInterval(function() {

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the result in an element with id="demo"
                document.getElementById("timer").innerHTML = `
                    Te quedan ${days} d ${hours} h y ${minutes} m con ${seconds} s para confirmar tu asistencia
                    `;
                // days + "d" + hours + "h"
                // + minutes + "m " + seconds + "s ";
                // If the count down is over, write some text
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("timer").innerHTML =
                        "Esta capacitación no acepta más respuestas";
                }
            }, 1000);
        }
    })
</script>
