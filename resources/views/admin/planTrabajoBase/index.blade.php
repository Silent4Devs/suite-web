@extends('layouts.admin')
@section('content')
    <style>
          
        .btn-outline-success {
            background: #788bac !important;
            color: white;
            border:none;
        }
        .btn-outline-success:focus{
            border-color:#345183 !important;
            box-shadow:none;
        }

        .btn-outline-success:active{
            box-shadow:none !important;
        }
        .btn-outline-success:hover {
            background: #788bac;
            color: white;

        }

        .btn_cargar {
            border-radius: 100px !important;
            border: 1px solid #345183;
            color: #345183;
            text-align: center;
            padding: 0;
            width: 45px;
            height: 45px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 !important;
            margin-right: 10px !important;
        }
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


        /*.taskBox.taskBoxSVG.taskStatusSVG.deSVGdrag.deSVG rect:nth-child(even){
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      fill: #fff !important;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      height: 15px !important;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     }*/


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
            width: 100px;
            display: inline-block;
            padding: 5px 10px;
            background-color: #fff;
            color: #345183;
            font-size: 9pt;
            cursor: pointer;
            border: 1px solid #345183;
            border-radius: 5px;
            text-align: center;
            vertical-align: middle;
        }

        .botones_vistas_gantt a:hover {
            border: 1px solid #345183;
            background-color: #345183;
            color: #fff;
        }

        .boton_activo {
            border: 1px solid #345183 !important;
            background-color: #345183 !important;
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
    </style>

    {{ Breadcrumbs::render('admin.planTrabajoBase.index') }}
    {{-- <h5 class="col-12 titulo_general_funcion">Plan de Implementación ISO 27001 </h5>
    <div class="mt-5 mb-5">
        <div id="bloqueado"></div>

        <div class="botones_vistas_gantt">
            <div class="row">
                <div class="col-4">
                    <h2 id="titlo-tab" class="text-capitalize">Diagrama Gantt</h2>
                </div>
                <div class="text-right col-8 caja_botones_menu">
                    @can('plan_de_implementacion_Gantt')
                        <a href="#" id="tabla_remove" data-tabs="original_gantt"
                            onclick="loadGanttFromServer();cambiarTitulo('Gantt');" class="btn_gantt_vista boton_activo"><i
                                class="fas fa-stream"></i>Gantt</a>
                    @endcan
                    @can('plan_de_implementacion_Tabla')
                        <a href="#" id="tabla_gantt_click" data-tabs="tabla_gantt" onclick="initTable();cambiarTitulo('Tabla');"
                            class="btn_gantt_tabla_vista"><i class="fas fa-table"></i>Tabla</a>
                    @endcan
                    @can('plan_de_implementacion_Calendario')
                        <a href="#" data-tabs="calendario_gantt" onclick="initCalendar();cambiarTitulo('Calendario');"
                            class="btn_gantt_calendario_vista"><i class="fas fa-calendar-alt"></i>Calendario</a>
                    @endcan
                    @can('plan_de_implementacion_Kanban')
                        <a href="#" data-tabs="kanban_gantt" onclick="initKanban();cambiarTitulo('Kanban');"
                            class="btn_gantt_kanban_vista"><i class="fas fa-th-large"></i>Kanban</a>
                    @endcan
                </div>
            </div>


        </div>
        <div id="plan_trabajo_workspace">
            <p><i class="mr-2 fas fa-calendar"></i>Última modificación: <span id="ultima_modificacion"></span></p>
            <div class="caja_caja_secciones">
                <div class="caja_secciones ">
                    <section id="original_gantt" class="caja_tab_reveldada">
                        @include('admin.planTrabajoBase.gantt')
                    </section>

                    <section id="tabla_gantt">
                        @include('admin.planTrabajoBase.tabla')
                    </section>

                    <section id="calendario_gantt">
                        @include('admin.planTrabajoBase.calendario')
                    </section>

                    <section id="kanban_gantt">
                        @include('admin.planTrabajoBase.kanban')
                    </section>
                </div>
            </div>
            <div id="modales"></div>
        </div>
    </div> --}}
    <h5 class="col-12 titulo_general_funcion">Planes de Implementación </h5>
    <div class="mt-3 card">
        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <table class="table table-bordered w-100" id="tblPlanesAccion">
                <thead class="thead-dark">
                    <tr>
                        <th style="min-width:150px;">
                            Nombre
                        </th>
                        <th style="min-width:100px;">
                            Norma
                        </th>
                        <th>
                            Módulo&nbsp;de&nbsp;Origen
                        </th>
                        <th style="min-width:200px;">
                            Objetivo
                        </th>
                        <th>
                            Elaboró
                        </th>
                        <th>
                            %&nbsp;de&nbsp;Avance
                        </th>
                        <th>
                            Fecha&nbsp;de&nbsp;Inicio
                        </th>
                        <th>
                            Fecha&nbsp;de&nbsp;Fin
                        </th>
                        <th>
                            Estatus
                        </th>
                        <th>
                            Opciones
                        </th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection
{{-- @section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <script type="text/javascript">
        $(".botones_vistas_gantt a").click(function() {
            $(".botones_vistas_gantt a").removeClass("boton_activo");
            $(".botones_vistas_gantt a:hover").addClass("boton_activo");
        });

        window.onbeforeunload = function(event) {
            // checkChangesGantt();
            estaBloqueado(event);
        }
        let idleTime = 0;
        document.addEventListener('DOMContentLoaded', function() {
            if (@json($texto)) {
                console.log("asdasdasd");
                /*document.getElementById("tabla_remove").classList.remove("boton_activo");
                document.getElementById("tabla_gantt_click").classList.add("btn_activo", "boton_activo");*/
                console.log("vvvvv");
                initTable();
            }
            // let isBlocked = JSON.parse(Cookies.get('bloqueo'));
            // if (!isBlocked.bloqueado) {
            //     Cookies.set('bloqueo', '{"user":"Uriel", "bloqueado":true}');
            // }

            // console.log(isBlocked);
            let idleInterval = setInterval(timerIncrement, 60000); // 1 minute

            // Zero the idle timer on mouse movement.
            $(this).mousemove(function(e) {
                idleTime = 0;
            });
            $(this).keypress(function(e) {
                idleTime = 0;
            });
            // obtenerBloqueo(); //Esta función se encarga de verificar si el plan de trabajo esta bloqueado o no
        });

        function timerIncrement() {
            idleTime = idleTime + 1;
            if (idleTime > 19) { // 20 minutes
                window.location.reload();
            }
        }


        function obtenerBloqueo() {
            $.ajax({
                type: "POST",
                url: "{{ route('admin.lockedPlan.getLockedToPlanTrabajo') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    "user_id": "{{ auth()->user()->id }}",
                },
                success: function(response) {
                    console.log(response);
                    document.getElementById('bloqueado').innerHTML = "";
                    let workspace = document.getElementById('plan_trabajo_workspace');
                    workspace.style.opacity = "1";
                    workspace.style.pointerEvents = "all";
                    if (response.success) {
                        ponerBloqueo();
                    } else if (response.error) {
                        document.getElementById('bloqueado').innerHTML = `
                     <div class="px-3 py-2 mb-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                        <div class="row w-100">
                            <div class="text-center col-1 align-items-center d-flex justify-content-center">
                                <div class="w-100">
                                    <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                                </div>
                            </div>
                            <div class="col-11">
                                <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Atención</p>
                                <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Plan de trabajo bloqueado debido a que está siendo modificado por el siguiente usuario: <strong><i class="mr-1 fas fa-user-circle"></i>${response.locked_by.name}</strong></p>
                            </div>
                        </div>
                    </div>
                    `;
                        let workspace = document.getElementById('plan_trabajo_workspace');
                        workspace.style.opacity = "0.7";
                        workspace.style.pointerEvents = "none";
                    }
                }
            });
        }


        function ponerBloqueo() {
            $.ajax({
                type: "POST",
                url: "{{ route('admin.lockedPlan.setLockedToPlanTrabajo') }}",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    //console.log(response);
                }
            });
        }

        function estaBloqueado(event) {
            $.ajax({
                type: "POST",
                url: "{{ route('admin.lockedPlan.isLockedToPlanTrabajo') }}",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    //console.log(response);
                    if (response.blocked_by_self) {
                        removerBloqueo();
                        // let confirmacion = confirm("Está seguro de abandonar la página");
                        // if (confirmacion) {
                        //     removerBloqueo();
                        // } else {
                        //     event.preventDefault();
                        //     window.location = "{{ route('admin.planTrabajoBase.index') }}";
                        // }

                    } else if (response.blocked) {

                    } else {

                    }
                }
            });
        }

        function removerBloqueo() {
            $.ajax({
                type: "POST",
                url: "{{ route('admin.lockedPlan.removeLockedToPlanTrabajo') }}",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    //console.log(response);
                }
            });
        }

        function cambiarTitulo(titulo) {
            setTimeout(() => {
                document.getElementById('titlo-tab').innerText = titulo;
            }, 500);
        }
    </script>
@endsection --}}
@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Plan de Trabajo Base ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Plan de Trabajo Base ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                // {
                //     extend: 'pdfHtml5',
                //     title: `Plan de Trabajo Base ${new Date().toLocaleDateString().trim()}`,
                //     text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                //     className: "btn-sm rounded pr-2",
                //     titleAttr: 'Exportar PDF',
                //     orientation: 'landscape',
                //     exportOptions: {
                //         columns: ['th:not(:last-child):visible']
                //     },
                //     customize: function(doc) {
                //         doc.pageMargins = [20, 60, 20, 30];
                //         doc.styles.tableHeader.fontSize = 8.5;
                //         doc.defaultStyle.fontSize = 8.5; //<-- set fontsize to 16 instead of 10
                //     }
                // },
                {
                    extend: 'print',
                    title: `Plan de Trabajo Base ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Imprimir',
                    titleAttr: 'Imprimir',
                    customize: function(doc) {
                        let logo_actual = @json($logo_actual);
                        let empresa_actual = @json($empresa_actual);

                        var now = new Date();
                        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
                        $(doc.document.body).prepend(`
                        <div class="row mt-5 mb-4 col-12 ml-0" style="border: 2px solid #ccc; border-radius: 5px">
                            <div class="col-2 p-2" style="border-right: 2px solid #ccc">
                                    <img class="img-fluid" style="max-width:120px" src="${logo_actual}"/>
                                </div>
                                <div class="col-7 p-2" style="text-align: center; border-right: 2px solid #ccc">
                                    <p>${empresa_actual}</p>
                                    <strong style="color:#345183">ANÁLISIS DE BRECHAS</strong>
                                </div>
                                <div class="col-3 p-2">
                                    Fecha: ${jsDate}
                                </div>
                            </div>
                        `);

                        $(doc.document.body).find('table')
                            .css('font-size', '12px')
                            .css('margin-top', '15px')
                        // .css('margin-bottom', '60px')
                        $(doc.document.body).find('th').each(function(index) {
                            $(this).css('font-size', '18px');
                            $(this).css('color', '#fff');
                            $(this).css('background-color', 'blue');
                        });
                    },
                    title: '',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'colvis',
                    text: '<i class="fas fa-filter" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Seleccionar Columnas',
                },
                {
                    extend: 'colvisGroup',
                    text: '<i class="fas fa-eye" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    show: ':hidden',
                    titleAttr: 'Ver todo',
                },
                {
                    extend: 'colvisRestore',
                    text: '<i class="fas fa-undo" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Restaurar a estado anterior',
                }

            ];
            let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar nuevo',
                url: "{{ route('admin.planes-de-accion.createPlanTrabajoBase') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config) {
                    let {
                        url
                    } = config;
                    window.location.href = url;
                }
            };
            @can('planes_de_accion_agregar')
            dtButtons.push(btnAgregar);
            @endcan
            let url = "{{ route('admin.plantTrabajoBase.listaDataTables') }}"
            window.tblPlanesAccion = $('#tblPlanesAccion').DataTable({
                buttons: dtButtons,
                ajax: {
                    url: url,
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}"
                    }
                },
                columns: [
                //     {
                //     data: 'id',
                // },
                {
                    data: 'parent',
                }, {
                    data: 'norma',
                }, {
                    data: 'modulo_origen',
                }, {
                    data: 'objetivo',
                }, {
                    data: 'elaborador',
                    render: function(data, type, meta, config) {
                        let elaborador =
                            '<span class="badge badge-primary">Elaborado por el sistema</span>';
                        if (data) {
                            elaborador = `
                            <img src="{{ asset('storage/empleados/imagenes') }}/${data.avatar}" title="${data.name}" class="rounded-circle" style="clip-path: circle(21px at 50% 50%);height: 42px;" />
                            `;
                        }
                        return elaborador;
                    }
                }, {
                    data: 'id',
                    render: function(data, type, row, meta) {
                        if (row.tasks) {
                            let tasks = row.tasks;
                            let zero_task = tasks.find(t => Number(t.level) == 0);
                            if (zero_task != undefined) {
                                let progress = Math.ceil(zero_task.progress);
                                let html = "";
                                if (progress >= 90) {
                                    html =
                                        `<span class="badge badge-success">${progress} %</span>`;
                                } else if (progress < 90 && progress >= 60) {
                                    html =
                                        `<span class="badge badge-warning">${progress} %</span>`;
                                } else {
                                    html =
                                        `<span class="badge badge-danger">${progress} %</span>`;
                                }
                                return html;
                            }
                        }
                        return "<span class='badge badge-primary'>Sin progreso calculable</span>"
                    }
                }, {
                    data: 'id',
                    render: function(data, type, row, meta) {
                        if (row.tasks) {
                            let tasks = row.tasks;
                            let zero_task = tasks.find(t => Number(t.level) == 0);
                            if (zero_task != undefined) {
                                return `
                                    <p>${moment.unix((zero_task.start)/1000).format("DD-MM-YYYY")}</p>
                                `;
                            }
                        }
                        return "<span class='badge badge-primary'>No encontrado</span>";
                    }
                }, {
                    data: 'id',
                    render: function(data, type, row, meta) {
                        if (row.tasks) {
                            let tasks = row.tasks;
                            let zero_task = tasks.find(t => Number(t.level) == 0);
                            if (zero_task != undefined) {
                                return `
                                    <p>${moment.unix((zero_task.end)/1000).format("DD-MM-YYYY")}</p>
                                `;
                            }
                        }
                        return "<span class='badge badge-primary'>No encontrado</span>";
                    }
                }, {
                    data: 'id',
                    render: function(data, type, row, meta) {
                        if (row.tasks) {
                            let tasks = row.tasks;
                            let zero_task = tasks.find(t => Number(t.level) == 0);
                            if (zero_task != undefined) {
                                if (zero_task.status == 'STATUS_UNDEFINED') {
                                    return `
                                        <span class="badge badge-primary">Sin iniciar</span>
                                    `;
                                } else if (zero_task.status == 'STATUS_ACTIVE') {
                                    return `
                                        <span class="badge badge-warning">En proceso</span>
                                    `;

                                } else if (zero_task.status == 'STATUS_DONE') {
                                    return `
                                        <span class="badge badge-success">Completado</span>
                                    `;

                                } else if (zero_task.status == 'STATUS_FAILED') {
                                    return `
                                        <span class="badge badge-danger">Retraso</span>
                                    `;

                                } else if (zero_task.status == 'STATUS_SUSPENDED') {
                                    return `
                                        <span class="badge badge-secondary">Suspendido</span>
                                    `;

                                } else {
                                    return `
                                    <p>${zero_task.status}</p>
                                `;
                                }

                            }
                        }
                        return "<span class='badge badge-primary'>No encontrado</span>";
                    }

                }, {
                    data: 'id',
                    render: function(data, type, row, meta) {
                        let urlVerPlanAccion = "";
                        let urlEditarPlanAccion = `/admin/planes-de-accion/${data}/edit`;

                        let urlEliminarPlanAccion = `/admin/planes-de-accion/${data}`;
                        if (data == 1) {
                            urlVerPlanAccion = "{{ route('admin.planTrabajoBase.index') }}";
                        } else {
                            urlVerPlanAccion = `/admin/planes-de-accion/${data}`;
                        }
                        let botones = `
                            <div class="btn-group">
                                @can('planes_de_accion_editar')
                                <a class="btn" href="${urlEditarPlanAccion}" title="Editar Plan de Acción"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('planes_de_accion_visualizar_diagrama')
                                <a class="btn" href="${urlVerPlanAccion}" title="Visualizar Plan de Acción"><i class="fas fa-stream"></i></a>
                                @endcan
                            `;

                        if (data > 1) {
                            botones += `
                            @can('planes_de_accion_eliminar')
                                <button class="btn" onclick="eliminar('${urlEliminarPlanAccion}','${row.parent}')" title="Eliminar Plan de Acción"><i class="fas fa-trash-alt text-danger"></i></button>
                                </div>
                            @endcan
                             `;
                        } else {
                            botones += `
                             </div>
                             `;
                        }

                        return botones;

                    }
                }]
            });
        });

        window.eliminar = function(url, nombre) {
            Swal.fire({
                title: `¿Está seguro de eliminar el siguiente plan de trabajo base?`,
                html: `<strong><i class="mr-2 fas fa-exclamation-triangle"></i>${nombre}</strong>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        headers: {
                            'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        beforeSend: function() {
                            Swal.fire(
                                '¡Estamos Eliminando!',
                                `El Plan de Trabajo Base: ${nombre} está siendo eliminado`,
                                'info'
                            )
                        },
                        success: function(response) {
                            Swal.fire(
                                'Eliminado!',
                                `El Plan de Trabajo Base: ${nombre} ha sido eliminado`,
                                'success'
                            ).then(() => {
                                tblPlanesAccion.ajax.reload();
                            });                            
                        },
                        error: function(error) {
                            Swal.fire(
                                'Ocurrió un error',
                                `Error: ${error.responseJSON.message}`,
                                'error'
                            )
                        }
                    });
                }
            })
        }
    </script>
@endsection

