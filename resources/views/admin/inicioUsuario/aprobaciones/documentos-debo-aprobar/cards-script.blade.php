<script>
    document.addEventListener('DOMContentLoaded', function() {
        const contenedorCards = document.getElementById('cards-debo-aprobar');
        const contendorPrincipalCapacitaciones = document.getElementById('contendor-principal-capacitaciones');
        const selectTipoDeboAprobar = document.getElementById('selectTipoDeboAprobar');
        const btnArchivoDeboAprobar = document.getElementById('btnArchivoDeboAprobar');
        const btnPrincipalesDeboAprobar = document.getElementById('btnPrincipalesDeboAprobar');
        let popperInstance = null; // instancia para popper js
        // Iniciar con cards
        inicializarCapacitacionesGeneralesCards();


        btnArchivoDeboAprobar.addEventListener('click', function(e) {
            const url = this.getAttribute('data-url');
            inicializarCapacitacionesGeneralesCards('Sin Aprobaciones Archivadas', 'todo', url);
        })
        btnPrincipalesDeboAprobar.addEventListener('click', function(e) {
            const url = this.getAttribute('data-url');
            inicializarCapacitacionesGeneralesCards('Sin Aprobaciones', 'todo', url);
        })

        // selectTipoDeboAprobar.addEventListener('change', function(e) {
        //     inicializarCapacitacionesGeneralesCards(`Sin Aprobaciones ${this.value}`, this.value);
        // })

        function limpiarErroresValidacion() {
            document.querySelectorAll('.errores').forEach(element => {
                element.innerText = null;
            });
        }

        function destruirInstanciaDePopperLimparConfigCard(popperInstance) {
            popperInstance.destroy();
            const contenedorInformacionDeboAprobar = document.getElementById(
                'contenedor-info-card-debo-aprobar');
            contenedorInformacionDeboAprobar.innerHTML = null;
        }

        async function inicializarCapacitacionesGeneralesCards(mensaje = "Sin Documentos", filtro = 'todo',
            url =
            "{{ route('admin.revisiones.obtenerDocumentosDeboAprobar') }}") {
            const cardsMisCapacitaciones = document.getElementById('cards-debo-aprobar');
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
            const documentos = await response.json();
            let html = "";
            if (documentos.length > 0) {
                if (document.getElementById('contadorDeCapacitaciones')) {
                    document.getElementById('contadorDeCapacitaciones').innerText = documentos.length;
                }
                let htmlMezcladas = `<div class="col-12" id="mezcladas"><div class="row">`;
                documentos.forEach(element => {
                    const icono = definirIconoParaCardPrincipal(element);
                    htmlMezcladas += cardInformacionHTML(element, icono);
                });
                htmlMezcladas += "</div></div>";
                html += htmlMezcladas;
                cardsMisCapacitaciones.innerHTML = html;
            } else {
                if (document.getElementById('contadorDeCapacitaciones')) {
                    document.getElementById('contadorDeCapacitaciones').innerText = 0;
                }
                cardsMisCapacitaciones.innerHTML = sinCapacitaciones(mensaje);
            }
        }
        document.getElementById('cards-debo-aprobar').addEventListener('click', function(e) {
            if (e.target.classList.contains('btnAceptarRechazar')) {
                const bodyModalDocumento = document.getElementById('bodyModalDocumento');
                const modelo = JSON.parse(window.atob(e.target.getAttribute('data-modelo')));
                document.getElementById('nombreDocumento').innerText =
                    `${modelo.documento?.codigo}-${modelo.documento?.nombre}`
                bodyModalDocumento.innerHTML = `
                <div class="m-0 row justify-content-center w-100" style="position: relative">
                    <div class="workspace-reviwer w-100 d-flex justify-content-center">
                        <div class="w-100">
                            <h4 class="m-3 text-center text-white rounded bg-primary">Resumen</h4>
                            <div class="p-3 w-100 row">
                                <div class="col-sm-12 col-lg-6">
                                    <label for="comentarios"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                                            <path
                                                d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                            <path
                                                d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z" />
                                        </svg> Previsualizacion del documento: <strong>${modelo.documento?.archivo}</strong>
                                    </label>
                                    <iframe src="${modelo.documento?.archivo_actual}"
                                        class="w-100" style="height: 500px" frameborder="0"></iframe>
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <form method="POST" id="form-revision">
                                        <div class="form-group">
                                            <label for="comentarios"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                                    <path
                                                        d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z" />
                                                </svg> Comentarios <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="comentarios" rows="3"></textarea>
                                            <span id="comentarios-requridos" class="text-danger"></span>
                                        </div>
                                        <input id="revision" type="hidden" name="revision" value="${modelo.id}">
                                        <button id="aprobar" class="btn btn-outline-success"><i class="mr-1 fas fa-thumbs-up"></i>
                                            Aprobar</button>
                                        <button id="rechazar" class="btn btn-outline-danger"><i class="mr-1 fas fa-thumbs-down"></i>
                                            Rechazar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="c_cargando" class="cargando d-none">
                            <p>ENVIANDO...</p>
                            <small>Esto puede demorar unos minutos</small>
                            <div class="lds-hourglass"></div>
                        </div>
                    </div>
                </div>
                `;
                $('#archivoDocumentoModal').modal('show');
                CKEDITOR.replace('comentarios', {
                    toolbar: [{
                        name: 'paragraph',
                        groups: ['list', 'indent', 'blocks', 'align'],
                        items: ['NumberedList', 'BulletedList', '-', 'Outdent',
                            'Indent', '-',
                            'JustifyLeft', 'JustifyCenter', 'JustifyRight',
                            'JustifyBlock', '-',
                            'Bold', 'Italic'
                        ]
                    }, {
                        name: 'clipboard',
                        items: ['Link', 'Unlink']
                    }, ]
                });
            }
            if (e.target.classList.contains('btnArchivar')) {
                const modelo = JSON.parse(window.atob(e.target.getAttribute('data-modelo')));
                const url = "{{ route('admin.revisiones.archivar') }}";
                const revision_id = modelo.id;
                Swal.fire({
                    title: '¿Quieres archivar esta revisión?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Archivar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            url: url,
                            data: {
                                revision_id
                            },
                            dataType: "JSON",
                            beforeSend: function() {
                                let timerInterval
                                Swal.fire({
                                    title: 'Archivando...',
                                    html: 'Estamos archivando su revisión',
                                    timer: 4000,
                                    timerProgressBar: true,
                                    didOpen: () => {
                                        Swal.showLoading()
                                        timerInterval = setInterval(
                                            () => {
                                                const content =
                                                    Swal
                                                    .getHtmlContainer()
                                                if (content) {
                                                    const b =
                                                        content
                                                        .querySelector(
                                                            'b')
                                                    if (b) {
                                                        b.textContent =
                                                            Swal
                                                            .getTimerLeft()
                                                    }
                                                }
                                            }, 100)
                                    },
                                    willClose: () => {
                                        clearInterval(timerInterval)
                                    }
                                });
                            },
                            success: function(response) {
                                if (response.archivado) {
                                    inicializarCapacitacionesGeneralesCards();
                                    Swal.fire(
                                        '¡Archivado!',
                                        'Su revisión ha sido archivada',
                                        'success'
                                    )
                                    $('#archivoDocumentoModal').modal('hide');
                                    document.querySelector('.modal-backdrop').style
                                        .display = 'none';
                                } else {
                                    Swal.fire(
                                        'Erro al archivar!',
                                        'Ocurrió un error',
                                        'error'
                                    )
                                }
                            },
                            error: function(err) {
                                Swal.fire(
                                    'Error!',
                                    `${err}`,
                                    'error'
                                )
                            }
                        });
                    }
                })
            }
            if (e.target.classList.contains('btnDesArchivar')) {
                const modelo = JSON.parse(window.atob(e.target.getAttribute('data-modelo')));
                const url = "{{ route('admin.revisiones.desarchivar') }}";
                const revision_id = modelo.id;
                Swal.fire({
                    title: '¿Quieres Desarchivar esta revisión?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Desarchivar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            url: url,
                            data: {
                                revision_id
                            },
                            dataType: "JSON",
                            beforeSend: function() {
                                let timerInterval
                                Swal.fire({
                                    title: 'Archivando...',
                                    html: 'Estamos desarchivando su revisión',
                                    timer: 4000,
                                    timerProgressBar: true,
                                    didOpen: () => {
                                        Swal.showLoading()
                                        timerInterval = setInterval(
                                            () => {
                                                const content =
                                                    Swal
                                                    .getHtmlContainer()
                                                if (content) {
                                                    const b =
                                                        content
                                                        .querySelector(
                                                            'b')
                                                    if (b) {
                                                        b.textContent =
                                                            Swal
                                                            .getTimerLeft()
                                                    }
                                                }
                                            }, 100)
                                    },
                                    willClose: () => {
                                        clearInterval(timerInterval)
                                    }
                                });
                            },
                            success: function(response) {
                                if (response.desarchivado) {
                                    inicializarCapacitacionesGeneralesCards();
                                    Swal.fire(
                                        '¡Archivado!',
                                        'Su revisión ha sido desarchivada',
                                        'success'
                                    )
                                    $('#archivoDocumentoModal').modal('hide');
                                    document.querySelector('.modal-backdrop').style
                                        .display = 'none';
                                } else {
                                    Swal.fire(
                                        'Erro al desarchivar!',
                                        'Ocurrió un error',
                                        'error'
                                    )
                                }
                            },
                            error: function(err) {
                                Swal.fire(
                                    'Error!',
                                    `${err}`,
                                    'error'
                                )
                            }
                        });
                    }
                })
            }
        })

        document.getElementById('archivoDocumentoModal').addEventListener('click', function(e) {
            e.preventDefault();
            if (e.target.getAttribute('id') == 'aprobar') {
                let comentarios = CKEDITOR.instances.comentarios.getData();
                let revision = document.getElementById('revision').value;
                Swal.fire({
                    title: 'Estás seguro de aprobar el documento?',
                    text: "No podrás cambiarlo!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1BB93A',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, aprobar!',
                    cancelButtonText: 'Cancelar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('revisiones.approve') }}",
                            data: {
                                _token: "{{ csrf_token() }}",
                                revision,
                                comentarios
                            },
                            dataType: "JSON",
                            beforeSend: function() {
                                document.querySelector('.workspace-reviwer')
                                    .classList
                                    .add('enviando-respuesta');
                                document.getElementById('c_cargando').classList
                                    .remove(
                                        'd-none');
                            },
                            success: function(response) {
                                console.log(response);
                                if (response.approve) {
                                    inicializarCapacitacionesGeneralesCards();
                                    Swal.fire(
                                        'APROBADO!',
                                        'Aprobaste el documento',
                                        'success'
                                    )
                                    $('#archivoDocumentoModal').modal('hide');
                                    document.querySelector('.modal-backdrop').style
                                        .display = 'none';
                                }
                            }
                        });
                    }
                })
            }
            if (e.target.getAttribute('id') == 'rechazar') {
                let comentarios = CKEDITOR.instances.comentarios.getData();
                let revision = document.getElementById('revision').value;
                if (!comentarios) {
                    document.getElementById('comentarios-requridos').innerHTML =
                        "<strong>Nota:</strong> No has escrito los motivos por el cual estás rechazando el documento";
                } else {
                    document.getElementById('comentarios-requridos').innerHTML = "";
                    Swal.fire({
                        title: 'Estás seguro de rechazar el documento?',
                        text: "No podrás cambiarlo!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#B9271B',
                        cancelButtonColor: '#1B52B9',
                        confirmButtonText: 'Sí, rechazar!',
                        cancelButtonText: 'Cancelar!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "{{ route('revisiones.reject') }}",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    revision,
                                    comentarios
                                },
                                dataType: "JSON",
                                beforeSend: function() {
                                    document.querySelector(
                                            '.workspace-reviwer')
                                        .classList.add(
                                            'enviando-respuesta');
                                    document.getElementById('c_cargando')
                                        .classList
                                        .remove(
                                            'd-none');
                                },
                                success: function(response) {
                                    console.log(response);
                                    if (response.reject) {
                                        inicializarCapacitacionesGeneralesCards();
                                        Swal.fire(
                                            'RECHAZADO!',
                                            'Rechazaste el documento',
                                            'success'
                                        )
                                        $('#archivoDocumentoModal').modal('hide');
                                        document.querySelector('.modal-backdrop')
                                            .style
                                            .display = 'none';
                                    }

                                }
                            });
                        }
                    })
                }
            }
        })

        function cardInformacionHTML(modelo, icono) {
            const encode = window.btoa(JSON.stringify(modelo));
            const empleado = modelo;
            const encodeEvaluacion = {};
            return `
            <div class="col-4">
                <div id="carouselCapacitaciones${modelo.id}" class="carousel slide rounded p-2 bg-white" data-ride="carousel">
                    <div class="col-12" style="text-align: right">
                     ${headerAuxCardHTML(modelo)}
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="debo-aprobar-card" data-debo-aprobar="${encode}" data-aceptada="${empleado.es_aceptada}" data-evaluacion-contestada="${empleado.evaluacion!=null?true:false}" data-evaluacion-realizada="${encodeEvaluacion}" data-archivado="${empleado.archivado}">
                                    <div class="px-4">
                                        <div class="row align-items-center">
                                            <div class="col-12">
                                                <h6 class="card-title d-flex align-items-center" style="text-transform: capitalize;">
                                                    ${icono}
                                                    ${modelo.documento?.codigo} - ${modelo.documento?.nombre}
                                                </h6>
                                            </div>
                                        </div>
                                        <p class="m-0" style="font-size: 12px;color:${modelo.color_revisiones_estatus}">${modelo.estatus_revisiones_formateado}</p>
                                        <p class="m-0" style="font-size: 12px;">Versión: ${modelo.version}</p>
                                        <p class="m-0" style="font-size: 12px;text-transform:capitalize;">Tipo: ${modelo.documento?.tipo}</p>
                                        <p class="m-0" style="font-size: 12px">Fecha de Solicitud: ${modelo.fecha_solicitud.replaceAll('-', '/')}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <p class="m-0"><strong>Solicitante:</strong></p>
                                    <div> <img class="img_empleado" src="${modelo.documento?.elaborador.avatar_ruta}" title="${modelo.documento?.elaborador.name}"></div>
                                    <p class="m-0">${modelo.documento?.elaborador.name}</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-next" type="button" data-target="#carouselCapacitaciones${modelo.id}" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            `;
        }

        function headerAuxCardHTML(modelo) {
            const estatus = Number(modelo.estatus);
            const archivado = Number(modelo.archivado);
            const encode = window.btoa(JSON.stringify(modelo));
            let html = '';
            if (estatus == 2) {
                html += `
                <span class="badge badge-success">Aceptada</span>
                `;
            }
            if (estatus == 3) {
                html += `
                <span class="badge badge-danger">Rechazada</span>
                `;
            }
            if (estatus == 4) {
                html += `
                <span class="badge badge-danger">Rechazada por nivel anterior de aprobación</span>
                `;
            }
            if (estatus == 1) {
                html += `
                <i class="far fa-question-circle text-primary btnAceptarRechazar" data-modelo="${encode}"></i>
                `;
            } else {
                if (archivado == 1) {
                    html += `
                        <i class="fas fa-box-open text-primary btnDesArchivar" data-modelo="${encode}"></i>
                    `;
                } else {
                    html += `
                        <i class="fas fa-archive text-primary btnArchivar" data-modelo="${encode}"></i>
                    `;
                }
            }
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
            let aceptada = null;
            if (Number(element.estatus) == 2) {
                aceptada = true;
            } else if (Number(element.estatus) == 3 || Number(element.estatus) == 4) {
                aceptada = false;
            }
            let icono =
                `<i class="far fa-question-circle mr-1 text-muted" style="font-size: 18px;align-self: flex-start;"></i>`;
            if (aceptada === true) {
                icono =
                    `<i class="far fa-check-circle mr-1 text-success" style="font-size: 18px;align-self: flex-start;;"></i>`;
            } else if (aceptada === false) {
                icono =
                    `<i class="far fa-times-circle mr-1 text-danger" style="font-size: 18px;align-self: flex-start;"></i>`;
            }
            return icono;
        }

    })
</script>
