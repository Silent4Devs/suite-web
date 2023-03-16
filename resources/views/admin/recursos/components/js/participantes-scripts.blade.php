<script>
    document.addEventListener('DOMContentLoaded', function() {
        let url_avatar = "{{ asset('storage/empleados/imagenes/') }}"
        let avatar_usuario = null;
        let puesto_usuario = null;
        let participantesSeleccionados = @json($recurso->empleados);
        let recurso = @json($recurso);
        const contenedorDesicion = document.getElementById('contenedorDesicion');
        const participantes_invitaciones = document.getElementById(
            'participantes_invitaciones'); // Contenedor de participantes para tab EnviarInvitacion
        const areas = @json($areas);
        const grupos = @json($grupos);
        const empleados = @json($empleados);
        document.getElementById('contador-participantes-tab').innerHTML = participantesSeleccionados.length >
            0 ? participantesSeleccionados.length : 0;
        console.log(participantesSeleccionados.length > 0);
        window.quitarElemento = (empleadoID) => {
            document.getElementById(`empleado_${empleadoID.value}ID`).remove();
        }
        inicializarParticipantesDesdeElServidor(participantesSeleccionados);
        agregarParticipante();
        if (recurso.id) {
            inicializarSeleccionGrupo();
        }
        seleccionarGrupo();

        function inicializarSeleccionGrupo() {
            const seleccion = recurso.tipo_seleccion_participantes.tipo;
            const tipoID = Number(recurso.tipo_seleccion_participantes.tipo_id);
            renderizarSeleccion(seleccion, tipoID);
        }

        function seleccionarGrupo() {
            const selectGrupoDeParticipantes = document.getElementById('selectGrupoDeParticipantes');
            const seleccion_id = null;
            selectGrupoDeParticipantes.addEventListener('change', function(e) {
                const seleccion = this.value;
                renderizarSeleccion(seleccion, seleccion_id);
            })
        }

        function renderizarSeleccion(seleccion, seleccion_id) {
            if (seleccion != 'individual') {
                if (recurso.estatus == 'Borrador') {
                    reinicializarContenedorParticipantes();
                }
            }
            if (seleccion == 'all') {
                contenedorDesicion.innerHTML = ``;
                inicializarParticipantesDesdeElServidor(empleados, false);
            } else if (seleccion == 'area') {
                let html = `
                    <label for="area_grupo_select"><i class="fas fa-search iconos-crear"></i>Selecciona un área</label>
                    <select class="form-control" id="area_grupo_select" name="id_tipo_participacion">
                    <option value="" disabled selected>-- Selecciona un área --</option>`;
                areas.forEach(area => {
                    html +=
                        `<option value="${area.id}" ${area.id==seleccion_id?'selected':''}>${area.area}</option>`;
                });
                html += `</select>`;
                contenedorDesicion.innerHTML = html;
                document.getElementById('area_grupo_select').addEventListener('change', function(
                    e) {
                    const areaSeleccionada = areas.find(area => area.id == Number(this
                        .value));
                    inicializarParticipantesDesdeElServidor(areaSeleccionada.empleados, false);
                })
            } else if (seleccion == 'grupo') {
                let html = `
                    <label for="grupo_g_select"><i class="fas fa-search iconos-crear"></i>Selecciona un grupo</label>
                    <select class="form-control" id="grupo_g_select" name="id_tipo_participacion">
                    <option value="" disabled selected>--Selecciona una opción--</option>
                        `;
                grupos.forEach(grupo => {
                    html +=
                        `<option value="${grupo.id}" ${grupo.id==seleccion_id?'selected':''}>${grupo.nombre}</option>`;
                });
                html += `</select>`;
                contenedorDesicion.innerHTML = html;
                document.getElementById('grupo_g_select').addEventListener('change', function(
                    e) {
                    const grupoSeleccionado = grupos.find(grupo => grupo.id == Number(this
                        .value));
                    inicializarParticipantesDesdeElServidor(grupoSeleccionado.empleados, false);
                })
            } else if (seleccion == 'individual') {
                contenedorDesicion.innerHTML = `
                    <label for="participantes"><i class="fas fa-search iconos-crear"></i>Buscar
                        participante</label>
                    <input type="hidden" id="id_empleado">
                    <input class="form-control" type="text" id="participantes_search" placeholder="Busca un empleado"
                        style="position: relative" autocomplete="off" />
                    <i id="cargando_participantes" class="fas fa-cog fa-spin text-muted"
                        style="position: absolute; top: 96px; right: 26px;"></i>
                    <div id="participantes_sugeridos"></div>
                    @if ($errors->has('participantes'))
                        <div class="invalid-feedback">
                            {{ $errors->first('participantes') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.recurso.fields.participantes_helper') }}</span>
                    `;
                $("#cargando_participantes").hide();
            } else if (seleccion == 'almacenada') {
                contenedorDesicion.innerHTML = ``;
                inicializarParticipantesDesdeElServidor(participantesSeleccionados, false);
            } else {
                contenedorDesicion.innerHTML = ``;
            }
        }

        function reinicializarContenedorParticipantes() {
            document.getElementById('contenedorParticipantes').innerHTML = null;
            document.getElementById('participantes_invitaciones').innerHTML = null;
            actualizarContador();
        }

        function inicializarParticipantesDesdeElServidor(participantesSeleccionados, enCarga = true) {
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

        function agregarParticipante() {
            const btnAgregarParticipante = document.getElementById('btnAgregarParticipante');
            const contenedorParticipantes = document.getElementById('contenedorParticipantes');
            contenedorParticipantes.addEventListener('click', function(e) {
                e.preventDefault();
                let elemento = e.target;
                if (e.target.tagName == "I") {
                    elemento = e.target.parentElement;
                }
                if (elemento.classList.contains('remover-elemento')) {
                    const empleadoID = elemento.getAttribute('data-empleado-id');
                    document.getElementById(`empleado_${empleadoID}ID`).remove();
                    document.getElementById(`empleado_invitacion${empleadoID}ID`).remove();
                    if (document.querySelectorAll('.contador-participantes').length == 0) {
                        document.getElementById('sinParticipantes').style.display = 'block';
                    }
                }
                actualizarContador();
            })
            // const inputSearchEmpleados = document.getElementById('participantes_search');
            // const emailParticipante = document.getElementById('emailParticipante');
            // const empleadoID = document.getElementById('id_empleado');

            // window.onbeforeunload = function() {
            //     if (document.querySelectorAll('.contador-participantes').length > 0) {
            //         return "Data will be lost if you leave the page, are you sure?";
            //     }
            // }

            // btnAgregarParticipante.addEventListener('click', (e) => {
            //     e.preventDefault();
            //     agregarPersona(inputSearchEmpleados.value, empleadoID.value, contenedorParticipantes);
            // });
        }

        function agregarPersona(nombre, empleadoID, contenedorParticipantes) {
            if (!document.getElementById(`empleado_${empleadoID}ID`)) {
                const html = cardHtml(url_avatar, empleadoID, avatar_usuario, nombre, puesto_usuario);
                const htmlInvitaciones = `<div class='row'>
                        ${htmlListInvitaciones(url_avatar, empleadoID, avatar_usuario, nombre, puesto_usuario)}
                    </div>`;
                if (document.getElementById('sinParticipantes')) {
                    document.getElementById('sinParticipantes').style.display = 'none';
                }
                contenedorParticipantes.innerHTML += html;
                participantes_invitaciones.innerHTML += htmlInvitaciones;
                limpiarCamposBusqueda();
            } else {
                alert('Este participante ya ha sido registrado');
                limpiarCamposBusqueda();
            }
            actualizarContador();
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

        function limpiarCamposBusqueda() {
            $("#participantes_search").val("");
            $("#emailParticipante").val("");
        }

        $("#cargando_participantes").hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#cargando_participantes").hide();
        let url_empleados = "{{ route('admin.empleados.lista') }}";
        let timeout = null;
        $('#participantes_search').on('search', function() {
            $("#participantes_sugeridos").hide();
        });
        $("#contenedorDesicion").on('keyup', '#participantes_search', function() {
            $("#emailParticipante").val("");
            let inputSearchEmpleados = document.getElementById('participantes_search');
            clearTimeout(timeout);
            if (inputSearchEmpleados.value.trim() != '') {
                timeout = setTimeout(function() {
                    $.ajax({
                        type: "POST",
                        url: url_empleados,
                        data: 'nombre=' + inputSearchEmpleados.value,
                        beforeSend: function() {
                            $("#cargando_participantes").show();
                        },
                        success: function(data) {
                            $("#cargando_participantes").hide();
                            $("#participantes_sugeridos").show();
                            let sugeridos = document.querySelector(
                                "#participantes_sugeridos");
                            let lista =
                                `<ul class='list-group' id='empleados-lista' style="position: absolute;z-index: 1;width: 97%;">`;
                            data ? JSON.parse(data).forEach(usuario => {
                                    lista += `<button type='button' class='px-2 py-1 text-muted list-group-item list-group-item-action'
                                    onClick='seleccionarUsuario("${usuario.id}","${usuario.name}","${usuario.email}","${usuario.avatar}","${usuario.puesto}");'>
                                    <div class="row align-items-center">
                                        <div class="col-1 pr-0 text-center">
                                            <img src="${url_avatar}/${usuario.avatar}" style="width: 42px;clip-path: circle(50% at 50% 50%);">    
                                        </div> 
                                        <div class="col-11 pl-0">
                                            <p class="m-0"><strong>Nombre:</strong> ${usuario.name}</p>
                                            <p class="m-0"><strong>Área:</strong> ${usuario.area.area}</p>
                                        </div> 
                                    </div>
                                    </button>
                                `;
                                }) : lista +=
                                '<li class="list-group-item list-group-item-action">Sin coincidencias encontradas</li>';
                            lista += `</ul>`;
                            sugeridos.innerHTML = lista;
                            $("#participantes_search").css("background", "#FFF");
                        }
                    });
                    // if (inputSearchEmpleados.value == '') {
                    //     orientacion = localStorage.getItem('orientationOrgChart');
                    //     renderOrganigrama(OrgChart, orientacion, null);
                    // }
                }, 500);
            } else {
                $("#participantes_sugeridos").hide();
            }
        });

        window.seleccionarUsuario = function(id, name, email, avatar, puesto) {
            $("#participantes_search").val(name);
            $("#id_empleado").val(id);
            $("#emailParticipante").val(email);
            $("#participantes_sugeridos").hide();
            avatar_usuario = avatar;
            puesto_usuario = puesto;
            const contenedorParticipantes = document.getElementById('contenedorParticipantes');
            agregarPersona(name, id, contenedorParticipantes);
        }

        //To select country name
        function seleccionarUsuario(user) {
            $("#participantes_search").val(user.name);
            $("#id_empleado").val(user.id);
            $("#emailParticipante").val(user.email);
            $("#participantes_sugeridos").hide();
        }
    })
</script>
