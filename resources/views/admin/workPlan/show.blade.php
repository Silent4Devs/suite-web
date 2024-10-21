@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/workPlan/kanban/planTrabajo.css') }}{{ config('app.cssVersion') }}">

    <link rel=stylesheet href="{{ asset('gantt/platform.css') }}" type="text/css">
    <link rel=stylesheet href="{{ asset('gantt/libs/jquery/dateField/jquery.dateField.css') }}" type="text/css">

    <link rel=stylesheet href="{{ asset('gantt/gantt.css') }}" type="text/css">
    <link rel=stylesheet href="{{ asset('gantt/ganttPrint.css') }}" type="text/css" media="print">
    <link rel=stylesheet href="{{ asset('gantt/libs/jquery/valueSlider/mb.slider.css') }}" type="text/css" media="print">

    <link rel=stylesheet href="{{ asset('css/workPlan/kanban/jkanban.min.css') }}" type="text/css">
@endsection
@section('content')
    <h5 class="col-12 titulo_general_funcion">
        Plan de Trabajo:
        <span style="font-weight: lighter;"> {{ $planImplementacion->parent }} </span>
    </h5>

    <div class="row cards-top-plan">
        <div class="col-lg-2">
            <div class="card card-body" style="border-left-color: #83BCFE;">
                <span>Totales</span>
                <strong id="totalesStrong">20</strong>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="card card-body" style="border-left-color: #ECCE7D;">
                <span>Lista de tareas</span>
                <strong id="tareasStrong">20</strong>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="card card-body" style="border-left-color: #D4D4D4;">
                <span>Suspendidos</span>
                <strong id="suspendidosStrong">20</strong>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="card card-body" style="border-left-color: #7DC0EC;">
                <span>En proceso </span>
                <strong id="procesoStrong">20</strong>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="card card-body" style="border-left-color: #EC7D94;">
                <span>Retrasados</span>
                <strong id="retrasadosStrong">20</strong>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="card card-body" style="border-left-color: #AAE29A;">
                <span>Completados</span>
                <strong id="completadosStrong">20</strong>
            </div>
        </div>
    </div>

    <div class="mt-3 mb-5">
        <div id="bloqueado"></div>
        <div class="blue-menu-header-plan d-flex align-items-center justify-content-between px-5">
            <h3 id="titlo-tab" class="mb-0" style="font-weight: lighter;">Kanban</h3>
            <div class="d-flex align-items-center gap-2">
                <button class="btn" onclick="reloadKanban();cambiarTitulo('Kanban'); navSection('kanban_gantt');">
                    <i class="material-symbols-outlined"> view_kanban</i>
                    <span>Kanban</span>
                </button>
                <hr>
                <button class="btn"
                    onclick="renderCaleendar(); cambiarTitulo('Calendario'); navSection('calendario_gantt');">
                    <i class="material-symbols-outlined"> calendar_today</i>
                    <span>Calendario</span>
                </button>
                <hr>
                <button class="btn" onclick="initProject();cambiarTitulo('Diagrama Gantt'); navSection('original_gantt');">
                    <i class="material-symbols-outlined">align_horizontal_left</i>
                    <span>Gantt</span>
                </button>
            </div>
        </div>
        <div id="plan_trabajo_workspace">
            <div class="content-sections">
                <section id="kanban_gantt" class="caja_tab_reveldada active">
                    @include('admin.workPlan.diagramas-implementacion.kanban')
                </section>

                <section id="calendario_gantt">
                    @include('admin.workPlan.diagramas-implementacion.calendario')
                </section>

                <section id="original_gantt">
                    @include('admin.workPlan.diagramas-implementacion.gantt')
                </section>
            </div>
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
            }, 100);
        }

        function navSection(id) {
            document.querySelector('.content-sections section.active').classList.remove('active');
            document.getElementById(id).classList.add('active');
        }
    </script>
    <script>
        $(document).ready(function() {
            initail();
        });
        var ge;

        function initail(taskId, callback) {

            //this is a simulation: load data from the local storage if you have already played with the demo or a textarea with starting demo data

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('admin.planes-de-accion.loadProject', $planImplementacion) }}",
                success: function(response) {
                    //ge.loadProject(response);
                    //ge.checkpoint(); //empty the undo stac
                    renderKanban(response);
                    renderCalendar(response);
                    //initProject();
                    // $(".ganttButtonBar button.requireWrite").attr("disabled", "true");
                },
                error: function(response) {
                    toastr.error(response);
                }
            });

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
                    $('#workSpace').trigger('refreshTasks.gantt')
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
