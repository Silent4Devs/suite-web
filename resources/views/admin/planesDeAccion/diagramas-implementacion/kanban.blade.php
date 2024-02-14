<style>
    #kanban {
        overflow-x: scroll;
        display: flex;
        height: auto;
        justify-content: center;
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
        list-style: none;
        margin-right: 15px;
        background-color: #ebebeb;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 14px;
        width: 250px;
        height: 550px;
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

    .header {
        color: black;
        text-align: center;
    }

    .scroll-li {
        padding: 5px 2px;
        max-height: 450px;
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
        /*padding: 5px;*/
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
        padding: 10px;
        outline: none;
        border: none;
        color: #fff;
        text-align: center;
    }

    /* Estilo para el foco */
    #kanban .estatus_select:focus {
        box-shadow: 0 0 5px #fff;
        /* Agrega un suave resplandor al enfocar */
    }

    /* Estilo para cuando se pasa el ratón */
    #kanban .estatus_select:hover {
        background-color: #555;
        /* Oscurece un poco el color de fondo al pasar el ratón */
        cursor: pointer;
        /* Cambia el cursor al pasar el ratón */
    }

    #kanban .td_estatus_select {
        border-radius: 10px;
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

<style>
    .card {
        background-color: #f5f5f5;
        /* Color de fondo de la tarjeta */
        border-radius: 10px;
        /* Borde redondeado */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Sombra */
        margin: 20px auto;
        /* Margen exterior */
        padding: 20px;
        /* Espaciado interior */
    }

    .card h2 {
        margin-bottom: 10px;
    }

    .content {
        margin-bottom: 15px;
        border-bottom: 2px solid #c9c3c3;
        text-align: justify;
    }

    .assigned-to {
        display: flex;
        flex-wrap: nowrap;
        align-items: center;
        margin-bottom: 15px;
    }

    .person {
        margin-right: 10px;
    }

    .person-img {
        width: 25px;
        height: 25px;
        border-radius: 50%;
        /* Hacemos la imagen circular */
    }

    .add-person-button {
        font-size: 20px;
        border: none;
        background-color: transparent;
        cursor: pointer;
        padding: 0;
        width: fit-content;
    }

    .add-person-button i {
        color: #007bff;
        /* Color azul para el icono */
    }

    .status {
        display: flex;
        align-items: center;
    }

    .status-text {
        margin-right: 10px;
    }

    .status button {
        margin-right: 5px;
    }

    .STATUS_UNDEFINED-titulo {
        border-bottom: 2px solid #00b1e1;
        text-align: left;
        padding-bottom: 10px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .STATUS_ACTIVE-titulo {
        border-bottom: 2px solid rgb(253, 171, 61);
        text-align: left;
        padding-bottom: 10px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .STATUS_DONE-titulo {
        border-bottom: 2px solid rgb(0, 200, 117);
        text-align: left;
        padding-bottom: 10px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .STATUS_FAILED-titulo {
        border-bottom: 2px solid rgb(226, 68, 92);
        text-align: left;
        padding-bottom: 10px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .STATUS_SUSPENDED-titulo {
        border-bottom: 2px solid #aaaaaa;
        text-align: left;
        padding-bottom: 10px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .name {
        font-size: 24px;
        font-weight: bold;
    }

    .separator {
        margin: 0 10px;
        border-left: 1px solid #000;
        height: 1em;
    }

    .subtitle {
        font-size: 18px;
        color: #555;
    }

    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 10px;
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
            //initKanban();
        });

        // Obtener el token CSRF una vez
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        function initKanban() {
            $.ajax({
                type: "POST", // Cambiado a GET si es posible
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                url: "{{ route('admin.planes-de-accion.loadProject', $planImplementacion) }}",
                success: function(response) {
                    renderKanban(response);
                },
                error: function(xhr, status, error) {
                    // Manejo de errores
                    console.error("Error en la solicitud:", error);
                    alert("Error en la solicitud. Por favor, inténtelo de nuevo.");
                }
            });
        }

        function renderKanban(response) {
            $.ajax({
                type: "GET",
                url: "{{ asset('storage/gantt/status.json') }}",
                success: function(estatuses) {
                    let contenedor = $('#c_kanban');
                    let html = "";
                    let tasks = response.tasks.filter(task => task.level > 0 && !isParent(task, response
                        .tasks));

                    estatuses.forEach(estatus => {
                        let key = Object.keys(estatus)[0];
                        let value = Object.values(estatus)[0];
                        let actividad_por_estatus = tasks.filter(actividad => actividad.status == key);

                        let renderedActividades = actividad_por_estatus.map(actividad =>
                            renderActividad(actividad, response));
                        html +=
                            `<ul><i class="fas fa-grip-vertical dragg-icon"></i><div><div class="${key}-titulo"><span class="name">${value}</span><div class="separator"></div><span class="subtitle">${actividad_por_estatus.length}</span></div></div><div id="${key}" class="scroll-li">${renderedActividades.join('')}</div></ul>`;
                    });

                    contenedor.html(html);
                    attachEventListeners(response);
                    initializeSortable(response);
                }
            });
        }

        function renderActividad(actividad, response) {
            let imagenes = "";
            let assigs = [];

            if (actividad.assigs) {
                assigs = actividad.assigs.map(asignado => response.resources.find(r => Number(r.id) === Number(asignado
                    .resourceId)));
            }

            let filteredAssigs = assigs.filter(a => a != null);

            filteredAssigs.slice(0, 4).forEach(asignado => {
                let foto = asignado.foto || (asignado.genero === 'M' ? 'woman.png' : 'usuario_no_cargado.png');
                imagenes +=
                    `<div class="person"><img class="person-img" title="${asignado.name}" src="{{ asset('storage/empleados/imagenes') }}/${foto}" /></div>`;
            });

            if (filteredAssigs.length > 4) {
                imagenes +=
                    `<span class="btn_empleados" onmouseover="renderCard(this, '${encodeURIComponent(JSON.stringify(assigs))}')">+${assigs.length - 4}</span>`;
            }

            return `
            <li actividad-id="${actividad.id}" class="card">
                <div class="content">
                     ${actividad.name}
                </div>
                <div class="status-text">Asignados</div>
                <div class="assigned-to">
                    ${imagenes}
                    <button class="add-person-button"><i class="fas fa-plus"></i></button>
                </div>
                <div class="status">
                    <div class="status-text">Status:</div>
                    <div class="${actividad.status} td_estatus_select">
                        <select class="estatus_select">
                         ${renderEstatusOptions(actividad.status)}
                        </select>
                     </div>
                </div>
            </li>
    `;
        }

        function renderEstatusOptions(selectedStatus) {
            const statuses = ['STATUS_ACTIVE', 'STATUS_DONE', 'STATUS_FAILED', 'STATUS_SUSPENDED', 'STATUS_UNDEFINED'];
            return statuses.map(status =>
                `<option class="${status}" value="${status}" ${selectedStatus === status ? 'selected' : ''}>${getStatusText(status)}</option>`
            ).join('');
        }

        function getStatusText(status) {
            switch (status) {
                case 'STATUS_ACTIVE':
                    return 'En proceso';
                case 'STATUS_DONE':
                    return 'Completado';
                case 'STATUS_FAILED':
                    return 'Retraso';
                case 'STATUS_SUSPENDED':
                    return 'Suspendida';
                case 'STATUS_UNDEFINED':
                    return 'Sin iniciar';
                default:
                    return '';
            }
        }

        function attachEventListeners(response) {
            $('.estatus_select').change(function() {
                let id_row = $(this).closest('li').attr('actividad-id');
                let valor_nuevo = $(this).val();
                let actividad_correspondiente = response.tasks.find(t => t.id === id_row);
                changeStatusInKanban(actividad_correspondiente, response, valor_nuevo, $(this));
            });

            $('.add-person-button').click(function() {
                let id_row = $(this).closest('li').attr('actividad-id');
                let actividad_correspondiente = response.tasks.find(t => t.id === id_row);
                renderModal(id_row, actividad_correspondiente, response);
            });
        }

        function renderModal(id_row, actividad_correspondiente, response) {
            let contenedor = $('#modales');

            let modalHtml = `
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
                                ${renderResources(response, actividad_correspondiente)}
                            </div>
                        </ul>
                    </div>
                    <div class="pagination-container mt-3">
                        <button class="btn btn-sm btn-outline-primary prev-page">&laquo; Anterior</button>
                        <button class="btn btn-sm btn-outline-primary next-page">Siguiente &raquo;</button>
                        <span class="page-indicator ml-2 mr-2"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    `;

            contenedor.html(modalHtml);

            // Función para mostrar los recursos correspondientes a la página actual
            function showPage(pageNumber) {
                var startIndex = (pageNumber - 1) * 5;
                var endIndex = startIndex + 5;
                $('.contenedor_lista .list-group-item').hide().slice(startIndex, endIndex).show();
                $('.page-indicator').text("Página " + pageNumber + " de " + Math.ceil($(
                    '.contenedor_lista .list-group-item').length / 5));
            }

            // Función para inicializar la paginación y mostrar la primera página
            function initializePagination() {
                // Ocultar todos los recursos y mostrar los primeros 5
                $('.contenedor_lista .list-group-item').hide().slice(0, 5).show();
                // Mostrar la primera página
                showPage(1);
            }

            // Ejecutar la paginación al cargar el modal
            initializePagination();

            // Evento para avanzar a la página siguiente
            $('.next-page').click(function() {
                var currentPage = parseInt($('.page-indicator').text().split(' ')[1]);
                var totalPages = Math.ceil($('.contenedor_lista .list-group-item').length / 5);
                if (currentPage < totalPages) {
                    showPage(currentPage + 1);
                }
            });

            // Evento para retroceder a la página anterior
            $('.prev-page').click(function() {
                var currentPage = parseInt($('.page-indicator').text().split(' ')[1]);
                if (currentPage > 1) {
                    showPage(currentPage - 1);
                }
            });

            var listaOriginal;

            $('.search_resources').keyup(function() {
                var query = $(this).val().trim().toLowerCase();
                let contenedor_lista = $('.contenedor_lista');

                if (query !== '') {
                    // Si hay un término de búsqueda, renderizar los recursos que coinciden
                    contenedor_lista.html(renderResources(response, actividad_correspondiente, query));
                    renderListEvent(response, actividad_correspondiente, id_row, renderKanban);
                } else {
                    // Si el campo de búsqueda está vacío, restablecer la lista original y volver a inicializar la paginación
                    contenedor_lista.html(listaOriginal);
                    initializePagination();
                }
            });


            $(`#${id_row}-modal`).modal('show');


            // contenedor.html(modalHtml);
            // $('.search_resources').keyup(function() {
            //     let contenedor_lista = $('.contenedor_lista');
            //     contenedor_lista.html(renderResources(response, actividad_correspondiente, $(this).val()));
            //     renderListEvent(response, actividad_correspondiente, id_row, renderKanban);
            // });

            // $(`#${id_row}-modal`).modal('show');
            renderListEvent(response, actividad_correspondiente, id_row, renderKanban);
        }

        function initializeSortable(response) {
            const statuses = ['STATUS_DONE', 'STATUS_ACTIVE', 'STATUS_FAILED', 'STATUS_SUSPENDED', 'STATUS_UNDEFINED'];

            statuses.forEach(status => {
                Sortable.create(document.getElementById(status), {
                    group: {
                        name: status,
                        put: statuses.filter(s => s !== status)
                    },
                    animation: 100,
                    ghostClass: "sortable-ghost",
                    sort: false,
                    onEnd: function(evt) {
                        let id_row = evt.item.getAttribute('actividad-id');
                        let valor_nuevo = evt.to.id;
                        let actividad_correspondiente = response.tasks.find(t => t.id === id_row);
                        changeStatusInKanban(actividad_correspondiente, response, valor_nuevo);
                    },
                });
            });

            Sortable.create(document.getElementById('c_kanban'), {
                group: "sorting",
                sort: true,
                onSort: function(evt) {
                    let orden_ul = Array.from(evt.target.getElementsByTagName('ul'));
                    let estatuses = orden_ul.map(ul => ({
                        [ul.classList]: ul.querySelector('h4').innerText.split('/')[0].trim()
                    }));
                    saveStatusOnServer(estatuses);
                },
            });
        }

        function changeStatusInKanban(tarea_correspondiente, response, valor_nuevo, element = null) {
            function updateTask(status, progress) {
                tarea_correspondiente.isSuspended = false;
                tarea_correspondiente.isFailed = false;
                tarea_correspondiente.status = status;
                tarea_correspondiente.progress = progress;
                calculateAverageOnNodes(response.tasks);
                calculateStatus(response.tasks);
                saveOnServer(response);
                renderKanban(response);
            }

            if (isParent(tarea_correspondiente, response.tasks)) {
                if (element) {
                    element.value = tarea_correspondiente.status;
                }
                renderKanban(response);
                toastr.info('No puedes editar una actividad padre');
                return;
            }

            switch (valor_nuevo) {
                case 'STATUS_DONE':
                    tarea_correspondiente.isSuspended = false;
                    tarea_correspondiente.isFailed = false;
                    tarea_correspondiente.status = valor_nuevo;
                    tarea_correspondiente.progress = 100;
                    updateTask(valor_nuevo, 100);
                    break;

                case 'STATUS_UNDEFINED':
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
                            updateTask(valor_nuevo, 0);
                        } else {
                            renderKanban(response);
                        }
                    });
                    break;

                case 'STATUS_SUSPENDED':
                    tarea_correspondiente.isSuspended = true;
                    tarea_correspondiente.isFailed = false;
                    updateTask(valor_nuevo, null);
                    break;

                case 'STATUS_FAILED':
                    if (tarea_correspondiente.end - Date.now() >= 0) {
                        toastr.info('Esta actividad no puede ser puesta en retraso');
                        renderKanban(response);
                        if (element) {
                            element.value = tarea_correspondiente.status;
                        }
                    } else {
                        tarea_correspondiente.isSuspended = false;
                        tarea_correspondiente.isFailed = true;
                        updateTask(valor_nuevo, null);
                    }
                    break;

                default:
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
                                updateTask(valor_nuevo, Number(progress));
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
                    });
                    break;
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
