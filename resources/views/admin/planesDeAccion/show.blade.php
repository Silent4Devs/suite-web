@extends('layouts.admin')
@section('content')
    <style>
        body {
            background-color: #fff !important;
        }

        .resEdit {
            padding: 15px;
        }

        .resLine {
            width: 95%;
            padding: 3px;
            margin: 5px;
            border: 1px solid #d0d0d0;
        }


        .ganttButtonBar h1 {
            color: #000000;
            font-weight: bold;
            font-size: 28px;
            margin-left: 10px;
        }

        #TWGanttArea {
            height: 550px !important;
        }

        #__popup__1 {
            background-color: rgba(0, 0, 0, 0.5) !important;
        }

        .bwinPopupd {
            position: absolute;
            width: 90%;
            max-width: 600px;
            top: 0px;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            margin-top: 100px !important;
            height: 400px;
        }

        .gdfTable.table.ganttFixHead thead tr .gdfColHeader.gdfied.unselectable {
            font-size: 12px !important;
        }

        .gdfTable.table.ganttFixHead {
            display: none !important;
        }

        .ganttFixHead {
            border-bottom: 1px solid #ccc !important;
        }

        .table thead th {
            border-bottom: none !important;
            border-top: none !important;
        }

        #workSpace {
            border: none !important;
        }

        table.gdfTable thead>tr:nth-child(1n) {
            position: sticky;
            top: 0;
            background-color: #fff !important;
            z-index: 2;
        }

        .icons_propios_gantt {
            transform: scale(1.2);
            color: #34495e !important;
        }

        .icons_propios_gantt.guardar {
            transform: scale(1.5);
            color: #345183 !important;
        }


        .botones_vistas_gantt {
            width: 100%;
            position: relative;
            z-index: 2;
        }

        .botones_vistas_gantt a {
            padding: 5px 10px;
            color: #FFFFFF;
            cursor: pointer;
            text-align: center;
        }

        .botones_vistas_gantt a:hover {
            border: 0px solid #6F8FB8;
            background-color: #6F8FB8;
            color: #fff;
        }

        .caja_botones_menu a:hover {
            background-color: #6F8FB8;
        }

        .caja_botones_menu a.btn_activo,
        .caja_botones_menu a.btn_activo:hover {
            background-color: #6F8FB8;
            box-shadow: 0px 0px 0px 0px;
            color: #fff;
        }

        .boton_activo {
            border: 1px solid #6F8FB8 !important;
            background-color: #6F8FB8 !important;
            color: #fff !important;
        }

        .botones_vistas_gantt a i {
            font-size: 11pt;
            margin-right: 5px;
        }

        select.formElements option {
            text-transform: capitalize !important;
        }

        .splitterContainer rect:nth-child(1) {
            rx: 10px;
            ry: 10px;
            width: calc(+ 20px);
        }

        .splitterContainer rect[height="3"] {
            height: 10px;
            fill: #505050 !important;
            rx: 11px;
            ry: 14px;
        }

        .splitterContainer rect[height="60%"] {
            transform: scaleX(0.9) translate(5%);
            rx: 5px;
            ry: 5px;
        }

        @media print {

            header,
            footer,
            .sistema_gantt p,
            .botones_vistas_gantt,
            body.font-lato {
                display: none !important;
            }

            * {
                transform: scale(1.001);
            }
        }
        .rounded-circle {
            border-radius: 0 !important;
            clip-path: circle(18px at 50% 50%);
            height: 37px;
        }
        h3.mb-2 {
            position: relative;
            z-index: 2;
        }
        select {
            appearance: none;
            background-color: transparent;
            border: none;
            padding: 0 1em 0 0;
            margin: 0;
            width: 100%;
            min-width: 15ch;
            max-width: 30ch;
            font-family: inherit;
            font-size: inherit;
            cursor: inherit;
            line-height: inherit;
            outline: none;
            cursor: pointer;
        }

        select::-ms-expand {
            display: none;
        }

        .caja_botones_menu {
            display: inline-block !important;
        }
        .caja_botones_menu a {
            display: inline-block;
            align-items: center;
        }

        .vertical-line {
            height: 20px;
            border-left: 1px solid #ccc;
            margin: 0 10px;
        }

        .navNew {
            height: 68px;
            background-color: #6F8FB8;
            border-radius: 10px 10px 0 0;
            margin-left: 45px;
            margin-right: 45px;
            display: flex;
            align-items: center;
        }

        .text-capitalize {
            text-transform: capitalize !important;
            color: #ffff;
            margin-left: 20px;
            display: contents;
            font-size: 25px;
        }

        .img_nav {
            padding-right: 10px;
            width: 40px;
        }
    </style>
    <h5 class="col-12 titulo_general_funcion">Plan de Acción - {{ $planImplementacion->parent }}</h5>
    <div class="mt-5 mb-5">
        <div id="bloqueado"></div>
        <div>
            <div class="navNew">
                <div class="botones_vistas_gantt">
                    <div class="row">
                        <div class="col-4" style="display: flex; align-items: center; padding-left: 50px;">
                            <p id="titlo-tab" class="text-capitalize">Diagrama Gantt</p>
                        </div>
                        <div class="text-right col-8 caja_botones_menu">
                            <a href="#" data-tabs="original_gantt" onclick="cambiarTitulo('Diagrama Gantt');"
                                class="boton_activo">
                                <img class="img_nav" src="{{ asset('img/plan-trabajo/gantt.svg') }}">Gantt
                            </a>

                            <span class="vertical-line"></span>

                            <a href="#" data-tabs="calendario_gantt"
                                onclick="renderCaleendar();cambiarTitulo('Calendario');" class="">
                                <img class="img_nav" src="{{ asset('img/plan-trabajo/calendar.svg') }}"
                                    alt="Imagen 2">Calendario
                            </a>

                            <span class="vertical-line"></span>

                            <a href="#" data-tabs="kanban_gantt" onclick="cambiarTitulo('Kanban');" class="">
                                <img class="img_nav" src="{{ asset('img/plan-trabajo/kanban.svg') }}" alt="Imagen 3">Kanban
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="plan_trabajo_workspace">
            <div class="caja_caja_secciones">
                <div class="caja_secciones">
                    <section id="original_gantt" class="caja_tab_reveldada">
                        @include('admin.planesDeAccion.diagramas-implementacion.gantt')
                    </section>

                    {{-- <section id="tabla_gantt">
                        @include('admin.planesDeAccion.diagramas-implementacion.tabla')
                    </section> --}}

                    <section id="calendario_gantt">
                        @include('admin.planesDeAccion.diagramas-implementacion.calendario')
                    </section>

                    <section id="kanban_gantt">
                        @include('admin.planesDeAccion.diagramas-implementacion.kanban')
                    </section>
                </div>
            </div>
            <div id="modales"></div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <script type="text/javascript">
        $(".botones_vistas_gantt a").click(function() {
            $(".botones_vistas_gantt a").removeClass("boton_activo");
            $(".botones_vistas_gantt a:hover").addClass("boton_activo");
        });

        function cambiarTitulo(titulo) {
            setTimeout(() => {
                document.getElementById('titlo-tab').innerText = titulo;
            }, 500);
        }
    </script>
    <script>
        $(document).ready(function() {
            initail();
        });
        var ge;

        function initail(taskId, callback) {

            //this is a simulation: load data from the local storage if you have already played with the demo or a textarea with starting demo data
            var ret = loadFromLocalStorage();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('admin.planes-de-accion.loadProject', $planImplementacion) }}",
                success: function(response) {
                    ge.loadProject(response);
                    // document.getElementById("ultima_modificacion").innerHTML = moment(response.updated_at)
                    //     .format("DD-MM-YYYY hh:mm:ss A")
                    ge.checkpoint(); //empty the undo stac
                    renderKanban(response);
                    //renderTable(response);
                    renderCalendar(response);
                    $(".ganttButtonBar button.requireWrite").attr("disabled", "true");
                },
                error: function(response) {
                    toastr.error(response);
                    // setTimeout(() => {
                    //     toastr.info("Reiniciaremos el diagrama de gantt");
                    //     window.location.reload();
                    // }, 1000);
                }
            });
            return ret;
        }
        //funciones globales para gantt y kamba

        function getRow(task, tasks) {
            return tasks.indexOf(task);
        }

        function getParents(task, tasks) {
            const pos = getRow(task, tasks);
            const topLevel = task.level;
            return tasks.slice(0, pos).filter(parent => parent.level < topLevel);
        }

        function getParent(task, tasks) {
            const pos = getRow(task, tasks);
            return tasks.slice(0, pos).reverse().find(parent => parent.level < task.level);
        }

        function isParent(task, tasks) {
            const pos = getRow(task, tasks);
            return pos < tasks.length - 1 && tasks[pos + 1].level > task.level;
        }

        function getChildren(task, tasks) {
            const pos = getRow(task, tasks);
            const children = tasks.slice(pos + 1);
            return children.filter(child => child.level === task.level + 1);
        }

        function renderResources(response, tarea_correspondiente, nombre = null) {
            let recursos = nombre ? response.resources.filter(r => r.name.toLowerCase().includes(nombre.toLowerCase())) :
                response.resources;

            return recursos.map(resource => {
                let foto = resource.foto || (resource.genero === 'M' ? 'woman.png' : 'usuario_no_cargado.png');

                return `<li class="list-group-item ${tarea_correspondiente.assigs?.some(assig => Number(assig.resourceId) === Number(resource.id)) ? 'selected_resource_task':''}" resource-id="${resource.id}">
                    <div class="row">
                        <div class="col-11">
                            <img class="rounded-circle" src="{{ asset('storage/empleados/imagenes') }}/${foto}" title="${resource.name}" />
                            <span class="m-0 ml-2">${resource.name}</span>
                        </div>
                        <div class="text-center col-1">
                            ${tarea_correspondiente.assigs?.some(assig => Number(assig.resourceId) === Number(resource.id)) ? '<i class="fas fa-trash-alt resources-modal-remove text-danger" style="vertical-align:middle;margin-top:7px; font-size:15pt; cursor:pointer;"></i>':'<i class="fa fa-plus-circle resources-modal text-success" style="vertical-align:middle;margin-top:7px; font-size:15pt; cursor:pointer;"></i>'}
                        </div>
                    </div>
                </li>`;
            }).join('');
        }

        function renderListEvent(response, tarea_correspondiente, id_row, funRenderCallback) {
            addResource(response, tarea_correspondiente, id_row, funRenderCallback);
            removeResource(response, tarea_correspondiente, id_row, funRenderCallback);
        }

        function addResource(response, tarea_correspondiente, id_row, funRenderCallback) {
            let resources_modal = document.querySelectorAll('.resources-modal');
            resources_modal.forEach(resource_modal => {
                resource_modal.addEventListener('click', function() {
                    let id = Number(this.closest('[resource-id]').getAttribute('resource-id'));
                    let resource = response.resources.find(r => r.id === id);
                    let new_assig = {
                        "id": `tmp_162439120526${resource.id}_${resource.id}`,
                        "resourceId": resource.id,
                        "roleId": "tmp_1",
                        "effort": 0
                    };
                    if (!tarea_correspondiente.assigs) {
                        tarea_correspondiente.assigs = [];
                    }
                    if (!tarea_correspondiente.assigs.some(a => a.resourceId === id)) {
                        tarea_correspondiente.assigs.push(new_assig);
                        let id_tbody = this.closest('.modal').getAttribute('tbody-contenedor');
                        saveOnServer(response);
                        funRenderCallback(response, id_tbody);
                    }
                    $(`#${id_row}-modal`).modal('hide');
                });
            });
        }

        function removeResource(response, tarea_correspondiente, id_row, funRenderCallback) {
            let resources_modal_remove = document.querySelectorAll('.resources-modal-remove');
            resources_modal_remove.forEach(resource_modal => {
                resource_modal.addEventListener('click', function() {
                    let id = Number(this.closest('[resource-id]').getAttribute('resource-id'));
                    let idx_resource = tarea_correspondiente.assigs.findIndex(a => a.resourceId === id);
                    if (idx_resource !== -1) {
                        tarea_correspondiente.assigs.splice(idx_resource, 1);
                        let id_tbody = this.closest('.modal').getAttribute('tbody-contenedor');
                        saveOnServer(response);
                        funRenderCallback(response, id_tbody);
                    }
                    $(`#${id_row}-modal`).modal('hide');
                });
            });
        }

        function saveOnServer(response) {
            $.ajax({
                type: "post",
                url: "{{ route('admin.planes-de-accion.saveProject', $planImplementacion) }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    prj: JSON.stringify(response),
                },
                dataType: "JSON",
                success: function(response) {
                    $('#workSpace').trigger('refreshTasks.gantt');
                    document.getElementById('ultima_modificacion').innerHTML = response.ultima_modificacion;
                    // toastr.success('Tarea actualizada con éxito');
                }
            });
        }

        function calculateAverageOnNodes(tasks) {
            let root = tasks.find(t => Number(t.level) === 0);
            let tasksWitOutRoot = tasks.filter(t => Number(t.level) !== 0);
            let rootAverage = tasksWitOutRoot.map(task => isParent(task, tasks) ? getAVG(task, tasks) : task.progress);
            let rootTotal = rootAverage.reduce((accumulator, value) => accumulator + value, 0) / rootAverage.length;
            root.progress = rootTotal;
        }

        function calculateStatus(tasks) {
            let root = tasks.find(t => Number(t.level) === 0);
            let tasksWithoutRoot = tasks.filter(t => Number(t.level) !== 0);

            tasksWithoutRoot.forEach(task => {
                if (isParent(task, tasks)) {
                    calculateStatusOnChildrens(task, tasks);
                } else {
                    changeStatusByProgress(task);
                }
            });

            changeStatusByProgress(root);
        }

        function calculateStatusOnChildrens(node, tasks) {
            let children = getChildren(node, tasks);
            children.forEach(task => changeStatusByProgress(task));
            changeStatusByProgress(node);
        }

        function changeStatusByProgress(task) {
            if (task.isFailed) {
                task.status = "STATUS_FAILED";
            } else if (task.isSuspended) {
                task.status = "STATUS_SUSPENDED";
            } else {
                switch (true) {
                    case (task.progress == 100):
                        task.status = "STATUS_DONE";
                        break;
                    case (task.progress >= 1 && task.progress <= 99):
                        task.status = "STATUS_ACTIVE";
                        break;
                    case (task.progress == 0):
                        task.status = "STATUS_UNDEFINED";
                        break;
                    default:
                        break;
                }
            }
        }
    </script>
@endsection
