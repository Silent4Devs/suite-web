<script>
    // $(document).ready(function() {
    document.addEventListener('DOMContentLoaded', function() {

        // const URL_ELEARNING = @json(env('APP_ELEARNING'));
        let URL_ELEARNING = @json(env('APP_ELEARNING'));
        const navGeneral = document.querySelector('#nav-general');
        navGeneral.addEventListener('click', function(e) {
            if (e.target.getAttribute('data-action') == 'sincronizar-elearning') {
                Swal.fire({
                    title: '¿Quieres sincronizar con la plataforma de E-Learning?',
                    text: "",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sincronizar',
                    cancelButtonText: 'Cancelar',
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        document.getElementById('isElearning').setAttribute('checked',
                            true);
                        $("#elearningCargando").modal('show');
                        try {
                            if (URL_ELEARNING == null) {
                                toastr.error(
                                    'No se puede conectar a la plataforma E-Learning')
                            } else {
                                const response = await fetch(
                                    `${URL_ELEARNING}/api/courses`, {
                                        method: 'GET',
                                        headers: {
                                            Accept: "application/json",
                                            'Content-Type': 'application/json'
                                        }
                                    })
                                const data = await response.json();
                                console.log(data);
                                const contenedorSeleccionModalidad = document
                                    .getElementById('contenedorSeleccionModalidad');
                                contenedorSeleccionModalidad.innerHTML =
                                    renderizarInputTipoModalidad({
                                        title: 'E-Learning',
                                        enLinea: true,
                                        data: data
                                    });
                                $("#elearningCargando").modal('hide');
                                document.querySelector('.modal-backdrop').style.display =
                                    'none';
                            }
                        } catch (error) {
                            toastr.error(error);
                        }
                    }
                })
            }

            if (e.target.getAttribute('data-action') == 'desincronizar-elearning') {
                Swal.fire({
                    title: '¿Quieres desincronizar con la plataforma de E-Learning?',
                    text: "",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Desincronizar',
                    cancelButtonText: 'Cancelar',
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        document.getElementById('isElearning').removeAttribute('checked');
                        const contenedorSeleccionModalidad = document
                            .getElementById('contenedorSeleccionModalidad');
                        contenedorSeleccionModalidad.innerHTML =
                            renderizarInputTipoModalidad({
                                title: 'Enlace',
                                enLinea: true,
                                data: {}
                            });
                    }
                })
            }
        })

        navGeneral.addEventListener('change', async function(e) {
            if (e.target.getAttribute('id') == 'selectElearning') {
                const data = JSON.parse(window.atob(e.target.options[e.target.selectedIndex]
                    .getAttribute(
                        'data-model')));
                console.log(data);
                const cursoscapacitaciones = document.getElementById(
                    'cursoscapacitaciones');
                cursoscapacitaciones.value = data.title;
                cursoscapacitaciones.setAttribute('readonly', true);
                const instructor = document.getElementById(
                    'instructor');
                instructor.value = data.teacher.name;
                instructor.setAttribute('readonly', true);
                const participantes = [];
                data.students.forEach(participante => {
                    participantes.push(participante.email)
                });
                const urlBusqueda = "{{ route('admin.empleado.buscarEmpleadoPorCorreo') }}";
                const token = "{{ csrf_token() }}";
                const responseBusqueda = await fetch(urlBusqueda, {
                    mode: 'cors', // this cannot be 'no-cors'
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    method: 'POST',
                    body: JSON.stringify({
                        participantes,
                    })
                })
                const dataBusqueda = await responseBusqueda.json();
                console.log(dataBusqueda);
                inicializarParticipantesDesdeElServidor(dataBusqueda);
            }
        })

        initializeTab();
        initializeLimitDate();
        guardarCapacitacion();
        draftCapacitacion();

        function limpiarErrores() {
            if (document.querySelectorAll('.errores').length > 0) {
                document.querySelectorAll('.errores').forEach(element => {
                    element.innerHTML = "";
                });
            }
        }

        function initializeTab() {
            // const menuActive = localStorage.getItem('menu-capacitaciones-active');
            // $(`#tabsCapacitaciones [data-type="invitaciones"]`).tab('show');

            $('#tabsCapacitaciones a').on('click', async function(event) {
                event.preventDefault()
                const keyTab = this.getAttribute('data-type');
                if (keyTab == 'participantes') {
                    limpiarErrores();
                    mostrarLoader();
                    const url = "{{ route('admin.recursos.validateForm') }}";
                    const formData = new FormData(document.getElementById(
                        'form-informacion-general'));
                    formData.append('tipo_validacion', 'general')
                    const response = await fetch(url, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            Accept: "application/json",
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                    })
                    const data = await response.json();
                    console.log(data.errors);
                    if (data.errors) {
                        ocultarLoader();
                        $.each(data.errors, function(indexInArray,
                            valueOfElement) {
                            document.querySelector(`span.${indexInArray}_error`)
                                .innerHTML =
                                `<i class="mr-2 fas fa-info-circle"></i> ${valueOfElement[0]}`;
                        });
                    }
                    if (data.isValid) {
                        ocultarLoader();
                        $(this).tab('show');
                        localStorage.setItem('menu-capacitaciones-active', 'participantes');
                    }
                } else if (keyTab == 'invitaciones') {
                    limpiarErrores();
                    mostrarLoader();
                    const url = "{{ route('admin.recursos.validateForm') }}";
                    const formData = new FormData(document.getElementById(
                        'form-informacion-general'));
                    formData.append('tipo_validacion', 'participantes')
                    const response = await fetch(url, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            Accept: "application/json",
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                    })
                    const data = await response.json();
                    console.log(data.errors);
                    if (data.errors) {
                        ocultarLoader();
                        $.each(data.errors, function(indexInArray,
                            valueOfElement) {
                            document.querySelector(`span.${indexInArray}_error`)
                                .innerHTML =
                                `<i class="mr-2 fas fa-info-circle"></i> ${valueOfElement[0]}`;
                        });
                    }
                    if (data.isValid) {
                        ocultarLoader();
                        $(this).tab('show');
                        localStorage.setItem('menu-capacitaciones-active', 'participantes');
                    }
                } else if (keyTab == 'lecciones') {
                    limpiarErrores();
                    mostrarLoader();
                    const url = "{{ route('admin.recursos.validateForm') }}";
                    const formData = new FormData(document.getElementById(
                        'form-informacion-general'));
                    formData.append('tipo_validacion', 'lecciones')
                    const response = await fetch(url, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            Accept: "application/json",
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                    })
                    const data = await response.json();
                    console.log(data.errors);
                    if (data.errors) {
                        ocultarLoader();
                        $.each(data.errors, function(indexInArray,
                            valueOfElement) {
                            document.querySelector(`span.${indexInArray}_error`)
                                .innerHTML =
                                `<i class="mr-2 fas fa-info-circle"></i> ${valueOfElement[0]}`;
                        });
                    }
                    if (data.isValid) {
                        ocultarLoader();
                        $(this).tab('show');
                        localStorage.setItem('menu-capacitaciones-active', 'participantes');
                    }
                } else {
                    $(this).tab('show');
                    localStorage.setItem('menu-capacitaciones-active', keyTab);
                }
            });
        }

        function initializeLimitDate() {
            const elFechaInicio = document.getElementById('fecha_curso');
            const elFechaLimite = document.getElementById('fechaLimite');
            elFechaInicio.addEventListener('change', function(e) {
                const fecha = e.target.value;
                elFechaLimite.value = fecha;
            });

            elFechaLimite.addEventListener('change', function(e) {
                console.log(new Date(elFechaLimite.value));
                console.log(new Date(elFechaInicio.value));
                if (new Date(elFechaLimite.value) > new Date(elFechaInicio.value)) {
                    alert('La fecha limite no puede ser mayor a la fecha de inicio');
                    elFechaLimite.value = elFechaInicio.value;
                }
            })
        }

        function mostrarLoader() {
            const loaderCapacitaciones = document.getElementById('loaderCapacitaciones');
            loaderCapacitaciones.style.display = 'flex';
        }

        function ocultarLoader() {
            const loaderCapacitaciones = document.getElementById('loaderCapacitaciones');
            loaderCapacitaciones.style.display = 'none';
        }

        function guardarCapacitacion() {
            const btnGuardarRecurso = document.querySelector('.btnGuardarRecurso');
            // const btnGuardarRecurso = document.getElementById('btnGuardarRecurso');
            const tabContent = document.getElementById('nav-tabContent');
            tabContent.addEventListener('click', async function(e) {
                if (e.target.classList.contains('btnGuardarRecurso')) {
                    e.preventDefault();
                    limpiarErrores();
                    if (!hayParticipantes()) {
                        Swal.fire({
                            title: '¡No has agregado participantes!',
                            text: "¿Quieres agregarlos después?",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Agregar Después',
                            cancelButtonText: 'Permanecer'
                        }).then(async (result) => {
                            if (result.isConfirmed) {
                                mostrarLoader();
                                const response = await guardarEnElServidor();
                                console.log(response);
                                if (response.status == "success") {
                                    Swal.fire(
                                        '¡Excelente!',
                                        'Capacitación Creada',
                                        'success'
                                    )
                                    setTimeout(() => {
                                        window.location.href =
                                            "{{ route('admin.recursos.index') }}";
                                        ocultarLoader();
                                    }, 1500);
                                } else {
                                    toastr.error('Ocurrió un error');
                                    // setTimeout(() => {
                                    //     window.location.href =
                                    //         "{{ route('admin.recursos.index') }}";
                                    //     }, 1500);
                                    ocultarLoader();
                                }
                            }
                        })
                    } else {
                        mostrarLoader();
                        const response = await guardarEnElServidor();
                        if (response.status == "success") {
                            Swal.fire(
                                '¡Excelente!',
                                'Capacitación Creada',
                                'success'
                            )
                            setTimeout(() => {
                                window.location.href =
                                    "{{ route('admin.recursos.index') }}";
                                ocultarLoader();
                            }, 1500);
                        } else {
                            toastr.error('Ocurrió un error');
                            // setTimeout(() => {
                            //     window.location.href =
                            //         "{{ route('admin.recursos.index') }}";
                            //     }, 1500);
                            ocultarLoader();
                        }
                    }
                }
            })
        }

        function draftCapacitacion() {
            // const btnGuardarDraftRecurso = document.getElementById('btnGuardarDraftRecurso');
            const btnGuardarDraftRecurso = document.querySelector('.btnGuardarDraftRecurso');
            const tabContent = document.getElementById('nav-tabContent');
            tabContent.addEventListener('click', async function(e) {
                if (e.target.classList.contains('btnGuardarDraftRecurso')) {
                    e.preventDefault();
                    limpiarErrores();
                    if (!hayParticipantes()) {
                        Swal.fire({
                            title: '¡No has agregado participantes!',
                            text: "¿Quieres agregarlos después?",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Agregar Después',
                            cancelButtonText: 'Permanecer'
                        }).then(async (result) => {
                            if (result.isConfirmed) {
                                mostrarLoader();
                                const response = await guardarEnElServidor('Borrador');
                                console.log(response);
                                if (response.status == "success") {
                                    Swal.fire(
                                        '¡Excelente!',
                                        'Capacitación Creada',
                                        'success'
                                    )
                                    setTimeout(() => {
                                        window.location.href =
                                            "{{ route('admin.recursos.index') }}";
                                    }, 1500);
                                    ocultarLoader();
                                } else {
                                    toastr.error('Ocurrió un error');
                                    ocultarLoader();
                                }
                            }
                        })
                    } else {
                        mostrarLoader();
                        const response = await guardarEnElServidor('Borrador');
                        if (response.status == "success") {
                            Swal.fire(
                                '¡Excelente!',
                                'Capacitación Creada',
                                'success'
                            )
                            setTimeout(() => {
                                window.location.href =
                                    "{{ route('admin.recursos.index') }}";
                            }, 1500);
                            ocultarLoader();
                        } else {
                            toastr.error('Ocurrió un error');
                            // setTimeout(() => {
                            //     window.location.href =
                            //         "{{ route('admin.recursos.index') }}";
                            // }, 1500);
                            ocultarLoader();
                        }
                    }
                }
            })
        }

        async function guardarEnElServidor(tipo = 'Enviado') {
            try {
                const url = document.getElementById(
                    'form-informacion-general').getAttribute('action');
                const formData = new FormData(document.getElementById(
                    'form-informacion-general'));
                formData.append('tipo_request', 'ajax')
                formData.append('tipo_guardado', tipo)
                const response = await fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        Accept: "application/json",
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                })
                const data = await response.json();
                if (data.errors) {
                    $.each(data.errors, function(indexInArray,
                        valueOfElement) {
                        document.querySelector(`span.${indexInArray}_error`)
                            .innerHTML =
                            `<i class="mr-2 fas fa-info-circle"></i> ${valueOfElement[0]}`;
                    });
                }
                return data;
            } catch (error) {
                return error;
            }
        }

        function hayParticipantes() {
            return document.querySelectorAll('.contador-participantes').length > 0;
        }

        window.initSelect2 = () => {
            $('.select2').select2({
                'theme': 'bootstrap4'
            });
        }
        initSelect2();
        Livewire.on('select2', () => {
            initSelect2();
        });

        Livewire.on('categoriaCapacitacionStore', () => {
            $('#tipoCategoriaCapacitacionModal').modal('hide');
            $('.modal-backdrop').hide();
            document.getElementById('nombre_cat_cap').value = "";
            toastr.success('Categoría creada con éxito');
        });

        let select_activos = document.querySelector('#select_modalidad');
        select_activos.addEventListener('change', function(e) {
            e.preventDefault();
            let contenedorSeleccionModalidad = document.querySelector('#contenedorSeleccionModalidad');
            if (this.value == 'presencial') {
                contenedorSeleccionModalidad.innerHTML = renderizarInputTipoModalidad({
                    title: 'Ubicación',
                    enLinea: false,
                    data: {}
                });
            } else {
                contenedorSeleccionModalidad.innerHTML = renderizarInputTipoModalidad({
                    title: 'Enlace',
                    enLinea: true,
                    data: {}
                });
            }
        });

        function renderizarInputTipoModalidad(data) {
            let html = "";
            if (data.title == 'E-Learning') {
                html = `
                <div class="form-group">
                    <label for=""><i class="fas fa-map-marker-alt iconos-crear"></i>
                    <font id="font_modalidad_seleccionada">${data.title} <i class="fas fa-sync" id="desincronizarELearning" data-action="desincronizar-elearning"></i></font>
                    </label>
                    <select class="form-control" name="ubicacion" id="selectElearning">
                    <option value="">--Seleccionar Capacitación E-Learning--</option>
                    `;
                data.data.forEach(element => {
                    const encode = window.btoa(JSON.stringify(element));
                    html += `
                    <option value="${element.slug}" data-model="${encode}">${element.title}</option>
                    `;
                });
                html += `</select>
                    <span class="ubicacion_error text-danger errores"></span>
                </div>
                `;
            } else {
                html = `
                <div class="form-group">
                    <label for=""><i class="fas fa-map-marker-alt iconos-crear"></i>
                    <font id="font_modalidad_seleccionada">${data.title} ${data.enLinea?'<i class="fas fa-sync" id="sincronizarConELearning" data-action="sincronizar-elearning"></i>':''}</font>
                    </label>
                    <input type="text" name="ubicacion" class="form-control" id="ubicacionConfInicial">
                    <span class="ubicacion_error text-danger errores"></span>
                </div>
                `;
            }
            return html;
        }

        // PARTICIPANTES
        function inicializarParticipantesDesdeElServidor(participantesSeleccionados, enCarga = true) {
            let url_avatar = "{{ asset('storage/empleados/imagenes/') }}"
            if (participantesSeleccionados.length > 0) {
                document.getElementById('sinParticipantes').style.display = 'none';
                let html = "";
                let htmlInvitaciones = "<div class='row'>";
                if (enCarga) {
                    participantesSeleccionados.forEach(empleadoIteration => {
                        html += cardHtml(url_avatar, empleadoIteration.id, empleadoIteration.avatar,
                            empleadoIteration.name, empleadoIteration
                            .puesto);
                        htmlInvitaciones += htmlListInvitaciones(url_avatar, empleadoIteration.id,
                            empleadoIteration.avatar,
                            empleadoIteration.name, empleadoIteration.puesto);
                    });
                    setTimeout(() => {
                        const contenedorParticipantesCargados = document.getElementById(
                            'contenedorParticipantesCargados');
                        contenedorParticipantesCargados.innerHTML = html;
                        participantes_invitaciones.innerHTML = htmlInvitaciones;
                        actualizarContador();
                    }, 1000)
                } else {
                    participantesSeleccionados.forEach(empleadoIteration => {
                        const checkIfEmpleadoExists = obj => obj.id === empleadoIteration.id;
                        if (!recurso.empleados.some(checkIfEmpleadoExists)) {
                            html += cardHtml(url_avatar, empleadoIteration.id, empleadoIteration.avatar,
                                empleadoIteration.name, empleadoIteration
                                .puesto);
                            htmlInvitaciones += htmlListInvitaciones(url_avatar, empleadoIteration.id,
                                empleadoIteration.avatar,
                                empleadoIteration.name, empleadoIteration.puesto);
                        }
                    });
                    contenedorParticipantes.innerHTML = html;
                    participantes_invitaciones.innerHTML = htmlInvitaciones;
                    actualizarContador();
                }
                htmlInvitaciones += "</div>"
            } else {
                actualizarContador();
            }

        }

        function cardHtml(url_avatar, empleadoID, avatar_usuario, nombre, puesto_usuario) {
            let html = `
                <div class="col-3 contador-participantes mb-4" id="empleado_${empleadoID}ID">
                    <div class="card" style="height: 100% !important">
                        <div class="card-body" style="display: grid;align-items: center;">
                            <div class="text-center">
                                <img src="${url_avatar}/${avatar_usuario}" style="width: 50px;clip-path: circle(50% at 50% 50%);">
                                <input type="hidden" name="participantes[]" value="${empleadoID}">
                            </div>
                            <p class="text-muted m-0 text-center mt-2">${nombre}</p>
                            <p class="text-muted m-0 text-center mt-2">
                                <strong>${puesto_usuario}</strong>    
                            </p>
                            <button class="remover-elemento text-center btn btn-primary btn-sm" data-empleado-id="${empleadoID}"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                </div>
            `;
            return html;
        }

        function htmlListInvitaciones(url_avatar, empleadoID, avatar_usuario, nombre, puesto_usuario) {
            let html = `
                <div class="col-12">
                    <ul class="list-group">
                        <li class="list-group-item" id="empleado_invitacion${empleadoID}ID">
                            <div class="row justify-content-center align-items-center" style="font-size: 12px;">
                                <div class="col-2 text-center">
                                    <img src="${url_avatar}/${avatar_usuario}" style="width: 35px;clip-path: circle(50% at 50% 50%);">    
                                </div>
                                <div class="col-10 pl-0">
                                    <p class="text-muted m-0">${nombre}</p>
                                    <p class="text-muted m-0">
                                        <strong>${puesto_usuario}</strong>    
                                    </p>
                                </div>
                            </div>
                            
                        </li>
                    </ul>
                </div>
            `;
            return html;
        }

        function actualizarContador() {
            let contador = document.querySelectorAll('.contador-participantes').length;
            document.getElementById('contador-participantes-tab').innerHTML = contador;
        }
    });
</script>
