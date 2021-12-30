<div class="my-3">
    <div class="pl-3 row w-100">
        <div class="form-group col-sm-12 col-md-12 col-lg-12">
            <label for="participantes"><i class="fas fa-search iconos-crear"></i>Buscar
                participante</label>
            <input type="hidden" id="id_empleado">
            <input class="form-control" type="text" id="participantes_search" placeholder="Busca un empleado"
                style="position: relative" autocomplete="off" />
            <i id="cargando_participantes" class="fas fa-cog fa-spin text-muted"
                style="position: absolute; top: 43px; right: 25px;"></i>
            <div id="participantes_sugeridos"></div>
            @if ($errors->has('participantes'))
                <div class="invalid-feedback">
                    {{ $errors->first('participantes') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.recurso.fields.participantes_helper') }}</span>
        </div>
        {{-- <div class="form-group col-sm-12 col-md-12 col-lg-6">
            <label for="email"><i class="fas fa-at iconos-crear"></i>Email</label>
            <input class="form-control" type="text" id="emailParticipante" placeholder="Correo del participante"
                readonly style="cursor: not-allowed" />
        </div> --}}
        {{-- <div class="col-12" style="text-align: end;">
            <button id="btnAgregarParticipante" class="btn btn-success">Añadir</button>
        </div> --}}
        <div class="col-12">
            <label for="enviarInvitacionParticipantes"><i class="fas fa-calendar-day mr-1 iconos-crear"></i>Fecha
                Limite</label>
        </div>
        <div class="col-6 form-group">
            <input class="form-control" type="datetime-local" id="fechaLimite" name="fecha_limite"
                value="{{ old('fechaLimite', \Carbon\Carbon::parse($recurso->fecha_limite)->format('Y-m-d\TH:i')) }}">
            <small class="text-muted">Debe ser una fecha anterior o igual a la fecha de inicio de la
                capacitación</small>
            <span class="fecha_limite_error text-danger errores"></span>
        </div>
        <div class="col-6" style="align-self: top;">
            <label for="enviarInvitacionParticipantes"><i class="fas fa-envelope mr-1 iconos-crear"></i>Enviar
                Invitación
                por Correo</label>
            <input type="checkbox" id="enviarInvitacionParticipantes" name="enviarInvitacionParticipantes">
        </div>
        <div class="col-12 mt-3">
            <div id="sinParticipantes" class="col-12 text-center">
                <p><strong>Sin Participantes</strong></p>
                <img src="{{ asset('img/empleados_no_encontrados.svg') }}" alt="sin participante" width="250">
            </div>
            <div class="row" id="contenedorParticipantes"></div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let url_avatar = "{{ asset('storage/empleados/imagenes/') }}"
        let avatar_usuario = null;
        let puesto_usuario = null;
        let participantesSeleccionados = @json($recurso->empleados);
        document.getElementById('contador-participantes-tab').innerHTML = participantesSeleccionados.length >
            0 ?
            participantesSeleccionados.length : 0;
        window.quitarElemento = (empleadoID) => {
            document.getElementById(`empleado_${empleadoID.value}ID`).remove();
        }
        inicializarParticipantesDesdeElServidor();
        agregarParticipante();

        function inicializarParticipantesDesdeElServidor() {
            if (participantesSeleccionados.length > 0) {
                document.getElementById('sinParticipantes').style.display = 'none';
                let html = "";
                participantesSeleccionados.forEach(empleado => {
                    html += `
                        <div class="col-3 contador-participantes" id="empleado_${empleado.id}ID">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img src="${url_avatar}/${empleado.avatar}" style="width: 50px;clip-path: circle(50% at 50% 50%);">
                                        <input type="hidden" name="participantes[]" value="${empleado.id}">
                                    </div>
                                    <p class="text-muted m-0 text-center mt-2">${empleado.name}</p>
                                    <p class="text-muted m-0 text-center mt-2">
                                        <strong>${empleado.puesto}</strong>    
                                    </p>
                                    <button class="remover-elemento text-center btn btn-primary btn-sm" data-empleado-id="${empleado.id}"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                        </div>
                `;
                    contenedorParticipantes.innerHTML = html;
                });
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

        function agregarPersona(nombre, empleadoID,
            contenedorParticipantes) {
            // if (nombre.value != null && nombre.value != "") {
            if (!document.getElementById(`empleado_${empleadoID}ID`)) {
                const html = `
                        <div class="col-3 contador-participantes" id="empleado_${empleadoID}ID">
                            <div class="card">
                                <div class="card-body">
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
                if (document.getElementById('sinParticipantes')) {
                    document.getElementById('sinParticipantes').style.display = 'none';
                }
                contenedorParticipantes.innerHTML += html;
                limpiarCamposBusqueda();
            } else {
                alert('Este participante ya ha sido registrado');
                limpiarCamposBusqueda();
            }
            // } else {
            //     alert('No se ha buscado ningún participante');
            // }
            actualizarContador();
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
        let inputSearchEmpleados = document.getElementById('participantes_search');
        $('#participantes_search').on('search', function() {
            $("#participantes_sugeridos").hide();
        });
        $("#participantes_search").keyup(function() {
            $("#emailParticipante").val("");
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
                                    console.log(usuario);
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
            console.log(user);
            $("#participantes_search").val(user.name);
            $("#id_empleado").val(user.id);
            $("#emailParticipante").val(user.email);
            $("#participantes_sugeridos").hide();
        }
    })
</script>
