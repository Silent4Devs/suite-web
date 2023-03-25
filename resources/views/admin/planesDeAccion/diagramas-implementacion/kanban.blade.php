<style>
    #kanban {
        overflow-x: scroll;
        display: flex;
        height: auto;
    }

    /* width */
    #kanban::-webkit-scrollbar {
        width: 7px;
    }

    /* Track */
    #kanban::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0);
    }

    /* Handle */
    #kanban::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.2);
        border-radius: 50px;
    }

    /* Handle on hover */
    #kanban::-webkit-scrollbar-thumb:hover {
        background: rgba(0, 0, 0, 0.5);
    }

    .caja_kanban {
        width: auto;
        display: flex;
    }

    #kanban ul {
        padding: 20px 0;
        list-style: none;
        width: 200px;
        margin-right: 10px;
        border-radius: 8px;
        box-shadow: 0 5px 8px -1px rgba(0, 0, 0, 0.3);
        display: table;
        position: relative;
    }

    .dragg-icon {
        font-size: 15pt;
        color: white;
        position: absolute;
        left: 20px;
        top: 22px;
        z-index: 1;
        opacity: 0;
    }

    #kanban ul:hover .dragg-icon {
        opacity: 1;
        transition: 0.5s;
        cursor: move;
    }

    #kanban ul:last-child {
        margin-right: 0;
    }

    #kanban ul h4 {
        color: white;
        text-align: center;
    }

    .scroll-li {
        padding: 0 20px;
        max-height: 400px;
        overflow-y: auto;
        height: auto;
        width: 100%;
    }

    /* width */
    .scroll-li::-webkit-scrollbar {
        width: 7px;
    }

    /* Track */
    .scroll-li::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0);
    }

    /* Handle */
    .scroll-li::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.2);
        border-radius: 50px;
    }

    /* Handle on hover */
    .scroll-li::-webkit-scrollbar-thumb:hover {
        background: rgba(0, 0, 0, 0.5);
    }

    #kanban li {
        padding: 5px;
        background-color: #fff;
        margin: auto;
        margin-top: 20px;
        border-radius: 5px;
        box-shadow: 0 5px 8px -1px rgba(0, 0, 0, 0.3);
    }

    #kanban li:first-child {
        margin-top: 0;
    }

    #kanban li:hover,
    #kanban li:active,
    #kanban li:focus {
        cursor: grabbing;
    }

    #kanban table {
        border-collapse: separate;
        border-spacing: 0 10px;
        width: 100%;
    }

    #kanban li td {
        height: 40px;
        position: relative;

    }

    #kanban .estatus_select {
        /* position: absolute; */
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0) !important;
        outline: none !important;
        border: none !important;
        color: #fff;
        border-radius: 50px;
        text-align-last: center;
        -ms-text-align-last: center;
        -moz-text-align-last: center;
    }

    #kanban .td_estatus_select {
        border-radius: 50px;
        overflow: hidden;
    }

    #kanban li td:first-child {
        width: 103px;
    }

    #kanban li td,
    #kanban li thead th {
        font-size: 9pt;
    }

    #kanban li td i {
        font-size: 15pt;
        margin-right: 5px;
    }

    .divi {
        display: flex;
        align-items: center;
    }

    .td-imagenes-asignados {
        background-color: #f4f6fa;
        display: flex;
        justify-content: flex-end;
        align-items: center
    }

    .td-imagenes-asignados .btn-mas {
        position: absolute;
        top: 0;
        right: 0;
        margin-top: -10px;
        margin-right: -10px;
        z-index: 2;
        opacity: 0;
    }

    .td-imagenes-asignados:hover {
        cursor: pointer;
    }

    .td-imagenes-asignados:hover .btn-mas {
        opacity: 1;
        transition: 0.5s;
    }

    .caja-imagen-asignado {
        width: 37px;
        height: 37px;
        border-radius: 50%;
        border: solid 3px #f4f6fa;
        margin-left: -15px;
        transform: scale(0.85);
    }

    .td-imagenes-asignados img {
        background-color: rgb(124, 124, 124);
        transform: scale(1.05);
    }

    .td-imagenes-asignados * {
        box-sizing: content-box;
    }

    .simplebar-scrollbar::before {
        background-color: rgba(0, 0, 0, 0.5);
    }

    #kanban .btn_empleados {
        top: 0;
        left: 0;
        margin-left: -10px;
        margin-top: -10px;
        position: absolute;
        width: 35px;
        height: 35px;
        border-radius: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #666;
        color: #fff;
        z-index: 1;
        cursor: pointer;
        font-size: 1.5vw;
        transform: scale(0.8);
    }

    .sortable-ghost {
        transform: rotate(5deg);
    }

</style>

<div class="card" style="box-shadow: none; !important">
    <div class="card-body">
        <div id="kanban">
            <div class="caja_kanban" id="c_kanban"></div>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            initKanban();
        });

        function initKanban() {
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('admin.planes-de-accion.loadProject', $planImplementacion) }}",
                success: function(response) {
                    renderKanban(response);
                }
            });
        }

        function renderKanban(response) {
            $.ajax({
                type: "GET",
                url: "{{ asset('storage/gantt/status.json') }}",
                success: function(estatuses) {
                    let html = "";
                    let contenedor = document.getElementById('c_kanban');
                    estatuses.forEach(estatus => {
                        let key = Object.keys(estatus)[0];
                        let value = Object.values(estatus)[0];
                        let actividades = response.tasks.filter(task => task.level > 0 && !isParent(
                            task,
                            response.tasks));
                        let actividad_por_estatus = actividades.filter(actividad => actividad.status ==
                            key);
                        // data-simplebar
                        html +=
                            `<ul class=${key}><i class="fas fa-grip-vertical dragg-icon"></i><h4 class=${key}>${value} / ${actividad_por_estatus.length}</h4><div id="${key}" class="scroll-li">`;
                        actividad_por_estatus.forEach(actividad => {
                            let foto = 'man.png';
                            let imagenes = "";
                            let assigs = [];
                            if (actividad.assigs) {
                                assigs = actividad.assigs.map(asignado => {
                                    return response.resources.find(r => Number(r.id) ===
                                        Number(
                                            asignado.resourceId));
                                });
                            }
                            let filteredAssigs = assigs.filter(function(a) {
                                return a != null;
                            });
                            let contador = 1;
                            if (filteredAssigs.length > 0) {
                                if (filteredAssigs.length <= 4) {
                                    for (var i = 0; i < filteredAssigs.length; i++) {
                                        if (assigs[i] != undefined) {
                                            if (assigs[i].foto == null) {
                                                if (assigs[i].genero == 'M') {
                                                    foto = 'woman.png';
                                                } else {
                                                    foto = 'usuario_no_cargado.png';
                                                }
                                            } else {
                                                foto = assigs[i].foto;
                                            }
                                            imagenes += `<div class="caja-imagen-asignado">
                                                    <img class="rounded-circle" title="${assigs[i].name}"
                                                        src="{{ asset('storage/empleados/imagenes') }}/${foto}" />
                                                </div>`;
                                        }
                                    }
                                } else {
                                    while (contador <= 4) {
                                        if (assigs[contador] != undefined) {
                                            if (assigs[contador].foto == null) {
                                                if (assigs[contador].genero == 'M') {
                                                    foto = 'woman.png';
                                                } else {
                                                    foto = 'usuario_no_cargado.png';
                                                }
                                            } else {
                                                foto = assigs[contador].foto;
                                            }

                                            if (contador == 4) {
                                                imagenes +=
                                                    `<div class="caja-imagen-asignado">
                                                    <img class="rounded-circle" title="${assigs[contador].name}"
                                                        src="{{ asset('storage/empleados/imagenes') }}/${foto}" />
                                            </div>
                                            <span class="btn_empleados" onmouseover="renderCard(this, '${encodeURIComponent(JSON.stringify(assigs))}')">+${assigs.length - 4}</span>
                                            `;
                                            } else {
                                                imagenes +=
                                                    `<div class="caja-imagen-asignado">
                                                    <img class="rounded-circle" title="${assigs[contador].name}"
                                                        src="{{ asset('storage/empleados/imagenes') }}/${foto}" />
                                                </div>`;
                                            }
                                        }
                                        contador++;
                                    }
                                }
                            }
                            html += `
                                    <li actividad-id="${actividad.id}">
                                    <table>
                                        <thead>
                                            <th colspan="2">${actividad.name}</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="divi"><i class="far fa-user-circle"></i> Asignados</div>
                                                </td>
                                                <td class="td-imagenes-asignados">
                                                    <i class="fas fa-plus-circle btn-mas"></i>
                                                    ${imagenes}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="divi"><i class="fas fa-stream"></i>
                                                        Estatus
                                                    </div>
                                                </td>
                                                <td class="${key} td_estatus_select">
                                                    <select class="estatus_select">
                                                        <option class="STATUS_ACTIVE" value="STATUS_ACTIVE"
                                                            ${key == 'STATUS_ACTIVE' ? 'selected':''}><span>En proceso</span></option>
                                                        <option class="STATUS_DONE" value="STATUS_DONE"
                                                            ${key == 'STATUS_DONE' ? 'selected':''}><span>Completado</span></option>
                                                        <option class="STATUS_FAILED" value="STATUS_FAILED"
                                                            ${key == 'STATUS_FAILED' ? 'selected':''}><span>Retraso</span></option>
                                                        <option class="STATUS_SUSPENDED" value="STATUS_SUSPENDED"
                                                            ${key == 'STATUS_SUSPENDED' ? 'selected':''}><span>Suspendida</span></option>
                                                        <option class="STATUS_UNDEFINED" value="STATUS_UNDEFINED"
                                                            ${key == 'STATUS_UNDEFINED' ? 'selected':''}><span>Sin iniciar</span></option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </li>
                                `;
                        });
                        html += `</div></ul>`;
                    });
                    contenedor.innerHTML = html;

                    //Eventos para hacer dinámico el Kanban

                    // Se añade evento change a select para estatus
                    let estatus_select = document.querySelectorAll('.estatus_select');
                    estatus_select
                        .forEach(s_status => {
                            s_status.addEventListener('change', function() {
                                // let id_row = Number(this.closest('li').getAttribute(
                                //     'actividad-id'));
                                let id_row = this.closest('li').getAttribute(
                                    'actividad-id');
                                let valor_nuevo = this.value;
                                let actividad_correspondiente = response.tasks?.find(t => t.id ==
                                    id_row);
                                changeStatusInKanban(actividad_correspondiente, response,
                                    valor_nuevo, s_status);
                            });
                        });

                    //Evento click para td resources
                    let td_resources = document.querySelectorAll('.td-imagenes-asignados');
                    td_resources
                        .forEach(element => {
                            element.addEventListener('click', function() {
                                // let id_row = Number(this.closest('li').getAttribute(
                                //     'actividad-id'));
                                let id_row = this.closest('li').getAttribute(
                                    'actividad-id');
                                let valor_nuevo = this.value;
                                let contenedor = document.getElementById('modales');

                                let actividad_correspondiente = response.tasks.find(t => t.id ==
                                    id_row);

                                contenedor.innerHTML = `
						<div class="modal fade" id="${id_row}-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="${id_row}-modalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
								<div class="modal-header" style="background-color: #00A8AF !important; color:#fff">
									<h5 class="modal-title" id="${id_row}-modalLabel">Recursos</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="mb-3 input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
										</div>
										<input type="text" class="form-control search_resources" placeholder="Nombre empleado" aria-label="Username" aria-describedby="basic-addon1">
									</div>
									<ul class="list-group">
										<div class="contenedor_lista">
											${renderResources(response,actividad_correspondiente)}
										</div>
									</ul>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
								</div>
								</div>
							</div>
						</div>
					`;
                                document.querySelector('.search_resources').addEventListener(
                                    'keyup',
                                    function() {
                                        let contenedor_lista = document.querySelector(
                                            '.contenedor_lista');
                                        contenedor_lista.innerHTML = "";
                                        contenedor_lista.innerHTML = renderResources(
                                            response,
                                            actividad_correspondiente, this.value);
                                        renderListEvent(response, actividad_correspondiente,
                                            id_row, renderKanban);
                                    });
                                $(`#${id_row}-modal`).modal('show');
                                renderListEvent(response, actividad_correspondiente, id_row,
                                    renderKanban);
                            });
                        });

                    Sortable.create(STATUS_DONE, {
                        group: {
                            name: 'STATUS_DONE',
                            put: ['STATUS_ACTIVE',
                                'STATUS_FAILED', 'STATUS_SUSPENDED',
                                'STATUS_UNDEFINED'
                            ]
                        },
                        animation: 100,
                        ghostClass: "sortable-ghost", // Class name for the drop placeholder
                        sort: false,
                        onEnd: function( /**Event*/ evt) {
                            let id_row = evt.clone.getAttribute('actividad-id');
                            let valor_nuevo = evt.to.getAttribute('id');
                            let actividad_correspondiente = response.tasks.find(t => t.id ==
                                id_row);

                            changeStatusInKanban(actividad_correspondiente, response,
                                valor_nuevo);
                        },
                    });
                    Sortable.create(STATUS_ACTIVE, {
                        group: {
                            name: 'STATUS_ACTIVE',
                            put: ['STATUS_DONE',
                                'STATUS_FAILED', 'STATUS_SUSPENDED',
                                'STATUS_UNDEFINED'
                            ]
                        },
                        animation: 100,
                        ghostClass: "sortable-ghost", // Class name for the drop placeholder
                        sort: false,
                        onEnd: function( /**Event*/ evt) {
                            let id_row = evt.clone.getAttribute('actividad-id');
                            let valor_nuevo = evt.to.getAttribute('id');
                            let actividad_correspondiente = response.tasks.find(t => t.id ==
                                id_row);
                            changeStatusInKanban(actividad_correspondiente, response,
                                valor_nuevo);
                        },
                    });
                    Sortable.create(STATUS_FAILED, {
                        group: {
                            name: 'STATUS_FAILED',
                            put: ['STATUS_DONE', 'STATUS_ACTIVE',
                                'STATUS_SUSPENDED',
                                'STATUS_UNDEFINED'
                            ]
                        },
                        animation: 100,
                        ghostClass: "sortable-ghost", // Class name for the drop placeholder
                        sort: false,
                        onEnd: function( /**Event*/ evt) {
                            let id_row = evt.clone.getAttribute('actividad-id');
                            let valor_nuevo = evt.to.getAttribute('id');
                            let actividad_correspondiente = response.tasks.find(t => t.id ==
                                id_row);

                            changeStatusInKanban(actividad_correspondiente, response,
                                valor_nuevo);
                        },
                    });
                    Sortable.create(STATUS_SUSPENDED, {
                        group: {
                            name: 'STATUS_SUSPENDED',
                            put: ['STATUS_DONE', 'STATUS_ACTIVE',
                                'STATUS_FAILED', 'STATUS_UNDEFINED'
                            ]
                        },
                        animation: 100,
                        ghostClass: "sortable-ghost", // Class name for the drop placeholder
                        sort: false,
                        onEnd: function( /**Event*/ evt) {
                            let id_row = evt.clone.getAttribute('actividad-id');
                            let valor_nuevo = evt.to.getAttribute('id');
                            let actividad_correspondiente = response.tasks.find(t => t.id ==
                                id_row);

                            changeStatusInKanban(actividad_correspondiente, response,
                                valor_nuevo);
                        },
                    });
                    Sortable.create(STATUS_UNDEFINED, {
                        group: {
                            name: 'STATUS_UNDEFINED',
                            put: ['STATUS_DONE', 'STATUS_ACTIVE',
                                'STATUS_FAILED', 'STATUS_SUSPENDED',
                            ]
                        },
                        animation: 100,
                        ghostClass: "sortable-ghost", // Class name for the drop placeholder
                        sort: false,
                        onStart: function(evt) {
                            let id_row = evt.clone.getAttribute('actividad-id');
                            let valor_nuevo = evt.to.getAttribute('id');
                            let actividad_correspondiente = response.tasks.find(t => t.id ==
                                id_row);
                            actividad_correspondiente.status = valor_nuevo;

                            saveOnServer(response);
                            renderKanban(response); // element index within parent
                        },
                        onEnd: function( /**Event*/ evt) {
                            let id_row = evt.clone.getAttribute('actividad-id');
                            let valor_nuevo = evt.to.getAttribute('id');
                            let actividad_correspondiente = response.tasks.find(t => t.id ==
                                id_row);
                            changeStatusInKanban(actividad_correspondiente, response,
                                valor_nuevo);
                        },
                    });

                    Sortable.create(c_kanban, {
                        group: "sorting",
                        sort: true,
                        onSort: function( /**Event*/ evt) {
                            let orden_ul = evt.target.getElementsByTagName('ul');
                            let array_orden_ul = [...orden_ul];
                            let estatuses = array_orden_ul.map(ul => {
                                let key = `${ul.getAttribute('class')}`;
                                return {
                                    [key]: `${ul.getElementsByTagName('h4')[0].innerText.split('/')[0].trim()}`
                                }
                            });
                            console.log(array_orden_ul);
                            saveStatusOnServer(estatuses);
                        },
                    });

                }
            });

        }

        function changeStatusInKanban(tarea_correspondiente, response, valor_nuevo, element = null) {
            if (!isParent(tarea_correspondiente, response.tasks)) {
                if (valor_nuevo == 'STATUS_DONE') {
                    if (tarea_correspondiente.isSuspended) {
                        tarea_correspondiente.isSuspended = false;
                    } else {
                        tarea_correspondiente['isSuspended'] = false;

                    }
                    if (tarea_correspondiente.isFailed) {
                        tarea_correspondiente.isFailed = false;
                    } else {
                        tarea_correspondiente['isFailed'] = false;
                    }
                    tarea_correspondiente.status = valor_nuevo;
                    tarea_correspondiente.progress = 100; // set progress in 100
                    calculateAverageOnNodes(response.tasks);
                    calculateStatus(response.tasks);
                    saveOnServer(response);
                    renderKanban(response);

                } else if (valor_nuevo == 'STATUS_UNDEFINED') {
                    Swal.fire({
                        title: '¿Estás seguro de reinicializar la actividad?',
                        text: "No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí',
                        cancelButtonText: 'No'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            if (tarea_correspondiente.isSuspended) {
                                tarea_correspondiente.isSuspended = false;
                            } else {
                                tarea_correspondiente['isSuspended'] = false;

                            }
                            if (tarea_correspondiente.isFailed) {
                                tarea_correspondiente.isFailed = false;
                            } else {
                                tarea_correspondiente['isFailed'] = false;
                            }
                            tarea_correspondiente.status = valor_nuevo;
                            tarea_correspondiente.progress = 0; // set progress in 0
                            calculateAverageOnNodes(response.tasks);
                            calculateStatus(response.tasks);
                            saveOnServer(response);

                        }
                        renderKanban(response);
                    })

                } else if (valor_nuevo == 'STATUS_SUSPENDED') {
                    if (tarea_correspondiente.isSuspended) {
                        tarea_correspondiente.isSuspended = true;
                    } else {
                        tarea_correspondiente['isSuspended'] = true;

                    }
                    if (tarea_correspondiente.isFailed) {
                        tarea_correspondiente.isFailed = false;
                    } else {
                        tarea_correspondiente['isFailed'] = false;
                    }
                    calculateAverageOnNodes(response.tasks);
                    calculateStatus(response.tasks);
                    saveOnServer(response);
                    renderKanban(response);
                } else if (valor_nuevo == 'STATUS_FAILED') {
                    if (tarea_correspondiente.end - Date.now() >= 0) {
                        toastr.info('Esta actividad no puede ser puesta en retraso');
                        renderKanban(response);
                        if (element) {
                            element.value = tarea_correspondiente.status;
                        }
                    } else {
                        if (tarea_correspondiente.isSuspended) {
                            tarea_correspondiente.isSuspended = false;
                        } else {
                            tarea_correspondiente['isSuspended'] = false;

                        }
                        if (tarea_correspondiente.isFailed) {
                            tarea_correspondiente.isFailed = true;
                        } else {
                            tarea_correspondiente['isFailed'] = true;
                        }
                        tarea_correspondiente.status = valor_nuevo;
                        calculateAverageOnNodes(response.tasks);
                        calculateStatus(response.tasks);
                        saveOnServer(response);
                        renderKanban(response);
                    }
                } else { // Si la tarea cambia a otro estatus se pregunta el progreso
                    Swal.fire({
                        title: 'Ingresa el progreso, en un rango de 1-99',
                        input: 'number',
                        icon: 'question',
                        inputAttributes: {
                            autocapitalize: 'off'
                        },
                        showCancelButton: true,
                        confirmButtonText: 'Cambiar Estatus',
                        cancelButtonText: 'Cancelar',
                        showLoaderOnConfirm: true,
                        inputValidator: (progress) => {
                            if (Number(progress) >= 1 && Number(progress) <= 99) {
                                return null;
                            } else {
                                return 'Debes de ingresar un número en el rango de 1 a 99';
                            }
                        },
                        preConfirm: (progress) => {
                            if (Number(progress) >= 1 && Number(progress) <= 99) {
                                if (tarea_correspondiente.isSuspended) {
                                    tarea_correspondiente.isSuspended = false;
                                } else {
                                    tarea_correspondiente['isSuspended'] = false;

                                }
                                if (tarea_correspondiente.isFailed) {
                                    tarea_correspondiente.isFailed = false;
                                } else {
                                    tarea_correspondiente['isFailed'] = false;
                                }
                                tarea_correspondiente.status = valor_nuevo;
                                tarea_correspondiente.progress = Number(progress);
                                calculateAverageOnNodes(response.tasks);
                                calculateStatus(response.tasks);
                                saveOnServer(response);
                                renderKanban(response);
                            } else {
                                if (element) {
                                    element.value = tarea_correspondiente.status;
                                }
                            }
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {

                        if (result.isDismissed) {
                            if (element) {
                                element.value = tarea_correspondiente.status;
                            }
                            renderKanban(response);
                        }

                    })
                }
            } else {
                if (element) {
                    element.value = tarea_correspondiente.status;
                }
                renderKanban(response);
                toastr.info('No puedes editar una actividad padre');
            }
        }

        function saveStatusOnServer(response) {
            $.ajax({
                type: "post",
                url: "{{ route('admin.planTrabajoBase.saveStatus') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    estatuses: JSON.stringify(response),
                },
                dataType: "JSON",
                success: function(response) {
                    console.log(response);
                }
            });
        }
    </script>
@endsection
