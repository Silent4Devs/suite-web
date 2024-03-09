<div class="cardKanban" style="box-shadow: none; !important;margin-top: 30px;">
    <div id="myKanban"></div>
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 id="modal-title" class="modal-title">Modal Heading</h4>
                <p id="idTaks" style="display: none;">
                    Contenido del div invisible
                </p>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row" style="padding-top: 25px;">
                    <div class="col-sm-8">
                        <form>
                            <div class="form-group">
                                <div class="form-group anima-focus">
                                    <input type="text" class="form-control" id="nombreLabel" name="nombreLabel"
                                        placeholder="">
                                    <label for="nombreLabel"> Nombre <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group anima-focus">
                                    <textarea name="descriptionLabel" id="descriptionLabel" class="form-control" placeholder=""></textarea>
                                    <label for="descriptionLabel">Descripción</label>
                                </div>
                            </div>
                            <div class="container" style="padding-top: 10px;">
                                <div class="row">
                                    <div class="col-sm" style="padding-left: inherit !important">
                                        <div class="form-group anima-focus">
                                            <input type="date" min="1945-01-01" class="form-control" id="inicio"
                                                name="inicio">
                                            <label for="inicio"> Inicio <span class="text-danger">*</span></label>
                                            <small class="p-0 m-0 text-xs error_inicio errores text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group anima-focus">
                                            <input type="date" min="1945-01-01" class="form-control" id="fin"
                                                name="fin">
                                            <label for="fin"> Fin <span class="text-danger">*</span></label>
                                            <small class="p-0 m-0 text-xs error_fin errores text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="col-sm" style="padding-right: 0px;">
                                        <div class="form-group anima-focus">
                                            <input type="text" class="form-control" id="diasLabel" name="diasLabel"
                                                placeholder="" style="text-align: center;pointer-events: none;">
                                            <label for="diasLabel"> Dias <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding-top: 10px;">
                                <div class="col-8">
                                    <div class="form-group anima-focus">
                                        <select required class="form-control" name="estatusSelect" id="estatusSelect">
                                            <option>En proceso</option>
                                            <option>Completado</option>
                                            <option>Retrasado</option>
                                            <option>Suspendido</option>
                                            <option>Lista de tareas</option>
                                        </select>
                                        <label for="estatusSelect">Estatus</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group anima-focus">
                                        <input type="text" class="form-control" id="progresoLabel"
                                            name="progresoLabel" placeholder="" style="text-align: center;">
                                        <label for="progresoLabel"> Progreso <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-4">
                        <div class="dropdownBtn" style="padding-bottom: 20px;">
                            <button onclick="dropEtiquetas()" class="dropbtn">
                                <img class="addSVG" src="{{ asset('img/plan-trabajo/add.svg') }}">
                                <span>Etiquetas</span>
                            </button>
                            <div id="drop-Etiquetas" class="dropdownBtn-content">
                                <div class="texto-Etiquetas">
                                    <p>Etiquetas</p>
                                </div>
                                <ul class="checkbox-list">
                                    <li class="etiquetasLista color1">
                                        <input type="checkbox" name="etiqueta1" value="#C2DCFE"
                                            class="checkboxp1" />
                                        <div></div>
                                    </li>
                                    <li class="etiquetasLista color2">
                                        <input type="checkbox" name="etiqueta2" value="#DEC2FE"
                                            class="checkboxp1" />
                                        <div></div>
                                    </li>
                                    <li class="etiquetasLista color3">
                                        <input type="checkbox" name="etiqueta3" value="#CAEFC0"
                                            class="checkboxp1" />
                                        <div></div>
                                    </li>
                                    <li class="etiquetasLista color4">
                                        <input type="checkbox" name="etiqueta4" value="#EFC0C0"
                                            class="checkboxp1" />
                                        <div></div>
                                    </li>
                                    <li class="etiquetasLista color5">
                                        <input type="checkbox" name="etiqueta5" value="#FFD1F7"
                                            class="checkboxp1" />
                                        <div></div>
                                    </li>
                                    <li class="etiquetasLista color6">
                                        <input type="checkbox" name="etiqueta6" value="#FFECAF"
                                            class="checkboxp1" />
                                        <div></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="dropdownBtn" style="padding-bottom: 20px;">
                            <button onclick="dropAdjuntar()" class="dropbtn">
                                <img class="addSVG" src="{{ asset('img/plan-trabajo/attach.svg') }}">
                                <span>Adjuntar</span>
                            </button>
                            <div id="drop-Adjuntar" class="dropdownBtn-content">
                                <div class="texto-Etiquetas">
                                    <p>Carga de archivos</p>
                                </div>
                                <p class="txtSub">Adjunta un archivo de tu computadora</p>
                                <input type="file" id="fileInput" multiple>
                                <ul id="listaArchivos" class="listaarchivos"></ul>
                            </div>
                        </div>

                        <div class="dropdownBtn" style="padding-bottom: 20px;">
                            <button onclick="dropPersonas()" class="dropbtn">
                                <img class="addSVG" src="{{ asset('img/plan-trabajo/account.svg') }}">
                                <span>Participantes</span>
                            </button>
                            <div id="drop-Personas" class="dropdownBtn-content" style="height: 700px;">
                                <div class="texto-Etiquetas">
                                    <p>Participantes</p>
                                </div>
                                <div class="contenedorSelect">
                                    <div class="form-group anima-focus">
                                        <select required class="form-control" name="agregarSelect" id="agregarSelect"
                                            onchange="manejarSeleccion()">
                                            <option selected>Área</option>
                                            <option>Por persona</option>
                                        </select>
                                        <label for="agregarSelect">Agregar</label>
                                    </div>
                                    <div id="areaForm">
                                        <div class="form-group anima-focus">
                                            <select required class="form-control" name="areaSelect" id="areaSelect">
                                                <option selected>Selecciona un area</option>
                                            </select>
                                            <label for="areaSelect">Área</label>
                                        </div>
                                    </div>
                                    {{--  --}}
                                </div>
                                {{-- mostar personas --}}
                                <div class="dropdown-wrapper">
                                    <div class="dropdown-personas">
                                        <button class="personas-button dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-expanded="false">
                                            Integrantes
                                        </button>
                                        <div class="dropdown-menu">
                                            <div class="dropdown-divider"></div>
                                            <input type="text" class="form-control search-input"
                                                placeholder="Search">
                                            <div class="dropdown-divider"></div>
                                            <div class="dropdown-checkboxes">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="txtSub">Participantes agregados</p>
                                <div class="assigned-to" id="personasAsignadas"></div>
                            </div>
                        </div>
                        <div class="dropdownBtn">
                            <button onclick="dropguardar()" class="dropbtn">
                                <img class="addSVG" src="{{ asset('img/plan-trabajo/save.svg') }}">
                                <span>Guardar</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div id="participantes">
                    <h6 class="textcomplement">Participantes</h6>
                    <div class="assigned-to" id="imagenesParticipantes"></div>
                </div>
                <div id="etiquetas">
                    <h6 class="textcomplement" style="padding-top: 20px;">Etiquetas</h6>
                    <div id="circle-container"></div>
                </div>
                <div id="adjuntos">
                    <h6 class="textcomplement" style="padding-top: 20px;">Adjuntos</h6>
                    <div id="conteiner-adjuntos"></div>
                </div>
                <div id="sub-tareas">
                    <h6 class="textcomplement"
                        style="border-bottom: 1px dashed #0000001C;font-size: 18px;padding-top: 20px;">Sub tareas</h6>
                    <div>
                        <div id="task-container">
                            <div class="progress-container">
                                <div class="progress-bar"></div>
                            </div>
                            <ul id="task-list"></ul>
                        </div>
                        <div id="task-add">
                            <button id="add-task-btn"></button>
                            <input type="text" id="task-input" placeholder="Agregar sub tarea">
                        </div>
                    </div>
                </div>
                <div class="container" style="padding-top: 20px;">
                    <div class="row" style="border-bottom: 1px dashed #0000001C;">
                        <div class="col" style="justify-content: left;display: flex;">
                            <h6 class="textcomplement" style="font-size: 18px;">Log</h6>
                        </div>
                        <div class="col" style="justify-content: right;display: flex;">
                            <button class="butonLog" onclick="toggleCollapse()">Mostrar detalles</button>
                        </div>
                    </div>
                    <div id="logHistorico" class="contentLog">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@section('scripts')
    @parent
    <script src="{{ asset('../js/kanban/jkanban.js') }}"></script>
    <script src="{{ asset('../js/kanban/kanbanFunc.js') }}"></script>
    <script>
        const imagePath = '{{ asset('img/plan-trabajo/documento.svg') }}';
        const imagePathEye = '{{ asset('img/plan-trabajo/visibility.svg') }}';

        function initKanban() {
            $.ajax({
                type: "POST", // Cambiado a GET si es posible
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                url: "{{ route('admin.planes-de-accion.loadProject', $planImplementacion) }}",
                success: function(response) {
                    renderKanbanNew(response.tasks, response);
                },
                error: function(xhr, status, error) {
                    // Manejo de errores
                    console.error("Error en la solicitud:", error);
                    alert("Error en la solicitud. Por favor, inténtelo de nuevo.");
                }
            });
        }

        function renderKanban(response) {
            // $.ajax({
            //     type: "GET",
            //     url: "{{ asset('storage/gantt/status.json') }}",
            //     success: function(estatuses) {
            //         renderKanbanNew(response.tasks, response);
            //     }
            // });
        }
        // Obtener el token CSRF una vez
        document.getElementById('fileInput').addEventListener('change', manejarSeleccionArchivos);
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        let tasksModel = [];
        let taskSelection = [];
        let responseLocal = {};

        function renderKanbanNew(tasks, response) {
            let progreso = [];
            let grupos = [];
            responseLocal = response;
            tasksModel = tasks;
            const modal = new bootstrap.Modal(document.getElementById('myModal'));

            for (const estado in mapStatusToEstatus) {
                grupos[mapStatusToEstatus[estado]] = [];
            }
            tasks.forEach(item => {
                const estado = mapStatusToEstatus[item.status];
                if (estado) {
                    grupos[estado].push(item);
                }
            });
            let countIniciar;
            var KanbanTest = new jKanban({
                element: "#myKanban",
                gutter: '3px',
                widthBoard: '300px',
                responsivePercentage: true,
                dragItems: true,
                dragBoards: false,
                click: function(el) {
                    abrirModalConDatos(el.dataset.eid, tasks, response);
                },
                context: function(el, e) {},
                dragEl: function(el, source) {
                    console.log("START DRAG: " + el.dataset.eid);
                    console.log("donde biene: " + source.offsetParent.dataset.id);
                    console.log("END DRAG: " + el);
                },
                dragendEl: function(el) {},
                dropEl: function(el, target, source, sibling) {
                    pintar(el.dataset.eid, el.offsetParent.dataset.id);
                    guardarStatus(el.dataset.eid, source.offsetParent.dataset.id, target.offsetParent.dataset
                        .id);
                },
                buttonClick: function(el, boardId) {},
                boards: [{
                        id: "STATUS_UNDEFINED",
                        title: "Lista de tareas",
                        class: "UNDEFINED",
                        item: items(grupos.iniciar)
                    },
                    {
                        id: "STATUS_SUSPENDED",
                        title: "Suspendida",
                        class: "SUSPENDED",
                        item: items(grupos.suspendida)
                    },
                    {
                        id: "STATUS_ACTIVE",
                        title: "En proceso",
                        class: "ACTIVE",
                        item: items(grupos.progreso)
                    },
                    {
                        id: "STATUS_FAILED",
                        title: "Retrasado",
                        class: "FAILED",
                        item: items(grupos.retraso)
                    },
                    {
                        id: "STATUS_DONE",
                        title: "Completado",
                        class: "DONE",
                        dragTo: [],
                        item: items(grupos.completado)
                    }
                ]
            });

            function guardarStatus(id, statusInicial, statusFinal) {
                let objetoEncontrado = tasks.findIndex(objeto => objeto.id === id);
                if (objetoEncontrado !== -1) {
                    const objet = tasks;
                    objet[objetoEncontrado].status = statusFinal;
                    response.tasks = objet;
                    insertHistorico(statusInicial, statusFinal, objet[objetoEncontrado])
                    saveOnServer(response);
                } else {
                    console.log('No se encontró ningún objeto con el ID dado.');
                }

            }

            function insertHistorico(statusInicial, statusFinal, history) {
                const timestamp = new Date().getTime();
                const historicoNuevo = {
                    "initialstatus": statusInicial,
                    "finestatus": statusFinal,
                    "fecha": timestamp,
                    "edito": "asdasd"
                };

                if ('historic' in response) {
                    history.historic.push(historicoNuevo);
                } else {
                    if (!history.historic) {
                        history.historic = [];
                    }
                    history.historic.push(historicoNuevo);
                }
            }

            function pintar(id, status) {
                var intro = document.getElementById(id);
                var elementos = intro.querySelectorAll('*');
                var elementoColorEstatus = elementos[7];
                elementoColorEstatus.style.backgroundColor = mapStatusToColor[status];
                elementoColorEstatus.style.color = mapStatusToColorText[status];
                elementoColorEstatus.textContent = mapStatusToEstatusText[status];
                if (status == "STATUS_FAILED") {
                    intro.classList.add('pulse');
                } else {
                    intro.classList.remove('pulse');
                }
            }

            function items(array) {
                const cards = [];
                array.forEach(item => {
                    const {
                        id,
                        name,
                        progress,
                        status,
                        statusC = mapStatusToEstatusText[status],
                        start,
                        duration,
                        end,
                        color,
                        subtasks,
                        resources
                    } = item;

                    const resourcesCount = resources ? resources.length : 0;
                    const subtasksCount = subtasks ? subtasks.length : 0;
                    const subtasksReady = subtasks ? subtasks.filter(subtask => subtask.selected).length : 0;

                    let cardpulseClass = "";
                    if (status === "STATUS_FAILED") {
                        cardpulseClass = "pulse";
                    }

                    const jsonEvents = {
                        id: id,
                        title: `
                            <div id="${id}" class="cardContenido ${cardpulseClass}">
                              <div class="tituloCard">${name}</div>
                              <div class="contenido">
                                <div class="etiquetaContenido">
                                  <div class="etiquetaTitulo">Etiqueta</div>
                                  <div class="etiquetaColor"></div>
                                </div>
                                <div class="estatusContenido">
                                  <div class="estatusTitulo">Estatus</div>
                                  <div id="estatusColor" class="${status}-estatusColor">${statusC}</div>
                                </div>
                              </div>
                              <div class="contenido">
                                <div id="taskContenido">
                                  <div id="taskText">${subtasksCount}/${subtasksReady}</div>
                                </div>
                                <div class="resourceContenido">
                                  <img class="addSVG" src="{{ asset('img/plan-trabajo/attach.svg') }}">
                                  <div id="resourceText">${resourcesCount}</div>
                                </div>
                              </div>`,
                    };
                    cards.push(jsonEvents);
                });
                return cards
            }

            function abrirModalConDatos(id, array, response) {
                const task = array.find(item => item.id === id);

                if (!task) {
                    console.log('No se encontró ningún objeto con el ID dado.');
                    return;
                }

                //lista de participantes en el detalle
                const assigs = task.assigs ? task.assigs.map(asignado => response.resources.find(r => Number(r.id) ===
                    Number(asignado.resourceId))).filter(Boolean) : [];
                taskSelection = assigs;
                const divparticipantes = document.getElementById("participantes");
                const imagenes = assigs.slice(0, 4).map(asignado => {
                    const foto = asignado.foto || (asignado.genero === 'M' ? 'woman.png' :
                        'usuario_no_cargado.png');
                    return `<div class="person"><img class="person-img" title="${asignado.name}" src="{{ asset('storage/empleados/imagenes') }}/${foto}" /></div>`;
                }).join("");

                divparticipantes.style.display = assigs.length > 0 ? "block" : "none";
                //mostar lista de participantes en el down
                const imagenestogle = assigs.slice(0, 4).map(asignado => {
                    if (asignado.name) {
                        const initials = asignado.name.trim().split(' ').map(word => word.charAt(0)).join('')
                            .toUpperCase();
                        const color = asignado.genero === 'M' ? 'blue' : 'pink';
                        return `<div class="person" style="display: flex; align-items: center; margin-bottom: 5px; margin-left: 20px;"><div class="initials" style="background-color: ${color}; color: white; border-radius: 50%; width: 45px; height: 45px; display: flex; justify-content: center; align-items: center; margin-right: 5px;">${initials}</div><div style="margin-left: 5px; margin-right: auto;">${asignado.name}</div></div>`;
                    }
                }).join("");
                //mostrar el historial
                const htmlContentHistory = task.historic && task.historic.length > 0 ?
                    "<ul>" + task.historic.map(item =>
                        `<li class="log-list">Initial Status: ${mapStatusToEstatusText[item.initialstatus]}, Final Status: ${mapStatusToEstatusText[item.finestatus]}  Fecha: ${item.fecha} , Edito: ${item.edito} </li>`
                    ).join("") + "</ul>" :
                    "<span>No tiene historial</span>";
                //funcion mostar los documentos adjuntos
                const divadjuntos = document.getElementById("adjuntos");
                const conteinerAdjuntos = document.getElementById('conteiner-adjuntos');
                if (task.resources && task.resources.length > 0) {
                    divadjuntos.style.display = "block";
                    conteinerAdjuntos.innerHTML = '';
                    task.resources.forEach(item => {
                        base64Aarchivo(item.archivo, item.name);
                    });
                } else {
                    divadjuntos.style.display = "none";
                    conteinerAdjuntos.innerHTML = '';
                }

                //mostar las areas de la empresa en areaSelect
                const areaSelect = document.getElementById('areaSelect');
                response.area.forEach(area => {
                    const option = document.createElement('option');
                    option.value = area.id;
                    option.text = area.area;
                    areaSelect.appendChild(option);
                });
                //document.body.appendChild(areaSelect);

                document.getElementById('idTaks').value = task.id;
                document.getElementById('modal-title').innerHTML = task.name;
                document.getElementById('imagenesParticipantes').innerHTML = imagenes;
                document.getElementById('nombreLabel').value = task.name;
                document.getElementById('descriptionLabel').value = task.description;
                document.getElementById('progresoLabel').value = task.progress + "%";
                document.getElementById('diasLabel').value = task.duration;
                document.getElementById('inicio').value = timestampToDateString(task.start);
                document.getElementById('fin').value = timestampToDateString(task.end);
                document.getElementById('estatusSelect').value = mapStatusToEstatusText[task.status];
                //document.getElementById('personasAsignadas').innerHTML = imagenestogle;
                document.getElementById('logHistorico').innerHTML = htmlContentHistory;

                seleccionarCheckboxes(task.tag);
                insertTasksFromService(task.subtasks);

                modal.show();
            }

        }

        function guardarDatosmodal(id, nombre, descripcion, inicio, fin, dias, estatus, progreso) {
            const taskIndex = tasksModel.findIndex(objeto => objeto.id === id);
            if (taskIndex !== -1) {
                const updatedTask = {
                    ...tasksModel[taskIndex],
                    name: nombre,
                    progress: progreso.replace('%', ''),
                    description: descripcion,
                    status: estatus,
                    start: inicio,
                    end: fin,
                    duration: dias
                };

                tasksModel[taskIndex] = updatedTask;

                const updatedTasks = [...responseLocal.tasks];
                updatedTasks[taskIndex] = updatedTask;

                responseLocal.tasks = updatedTasks;

                insertResources(archivosArray, updatedTask);
                insertTag(listArrayP1, updatedTask);
                insertSubTasks(subTasks, updatedTask);

                saveOnServer(responseLocal);
                location.reload();
            } else {
                console.log('No se encontró ningún objeto con el ID dado.');
            }
        }
        //////////////////////////insericion de modulos faltantes en el js/////////////////////////////////////////////////
        function insertTag(value, tag) {
            if (!value || value.length === 0) {
                tag.tag = []; // Si value está vacío, borramos todas las etiquetas
                return;
            }

            if ('tag' in responseLocal.tasks) {
                value.forEach(element => {
                    const existingTagIndex = tag.tag.findIndex(existingTag => existingTag.etiqueta === element);
                    if (existingTagIndex !== -1) {
                        // Si la etiqueta ya existe, no hacemos nada
                        return;
                    } else {
                        // Si la etiqueta no existe, la agregamos
                        tag.tag.push({
                            "etiqueta": element
                        });
                    }
                });
            } else {
                tag.tag = value.map(element => ({
                    "etiqueta": element
                }));
            }
        }

        function insertResources(value, resources) {
            if ('resources' in responseLocal.tasks) {
                value.forEach(element => {
                    const resourcesNuevo = {
                        "name": element.name,
                        "archivo": element.archivo
                    };
                    resources.resources.push(resourcesNuevo);
                });
            } else {
                if (!resources.resources) {
                    resources.resources = [];
                }
                value.forEach(element => {
                    const resourcesNuevo = {
                        "name": element.name,
                        "archivo": element.archivo
                    };
                    resources.resources.push(resourcesNuevo);
                });
            }
        }

        function insertSubTasks(value, subtasks) {
            if ('subtasks' in responseLocal.tasks) {
                value.forEach(element => {
                    const existingTaskIndex = subtasks.subtasks.findIndex(task => task.id === element.id);
                    if (existingTaskIndex !== -1) {
                        // Si la tarea ya existe, actualiza sus valores
                        subtasks.subtasks[existingTaskIndex].selected = element.selected;
                        subtasks.subtasks[existingTaskIndex].taskName = element.taskName;
                    } else {
                        // Si la tarea no existe, agrégala
                        subtasks.subtasks.push({
                            "selected": element.selected,
                            "id": element.id,
                            "taskName": element.taskName
                        });
                    }
                });
            } else {
                subtasks.subtasks = [];
                value.forEach(element => {
                    const subtasksNuevo = {
                        "selected": element.selected,
                        "id": element.id,
                        "taskName": element.taskName
                    };
                    subtasks.subtasks.push(subtasksNuevo);
                });
            }
        }

        // function insertResources(idTasks,idResourse,resources) {

        // }
        ///////////////////////////////funciones para agregar, eliminar,mostrar,editar personas agregadas//////////////////
        const areaSelect = document.getElementById('areaSelect');
        areaSelect.addEventListener('change', function() {
            const id = parseInt(areaSelect.value);
            const personafiltrada = responseLocal.resources.filter(persona => persona.area_id === id);
            addOptionsFromArray(personafiltrada, taskSelection);
        });

        function manejarSeleccion() {
            var seleccion = document.getElementById("agregarSelect").value;
            var areaFormGroup = document.getElementById("areaForm");

            if (seleccion === "Por persona") {
                areaFormGroup.style.display = "none"; // Ocultar el formulario de área
                addOptionsFromArray(personafiltrada, taskSelection);
            } else {
                areaFormGroup.style.display = "block";
            }
        }
        //////////////////////////////////////////////////no es mio///////////////////////////////////
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


{{-- 'resources' =>  [],
'subtasks' => [],
'historic' => [], --}}

{{-- // if (!confirm("¿Estás seguro de mover esta tarjeta?")) {
    //   return false; // Cancela el movimiento
    // }
    // console.log("entrooooo");
    // return true; --}}
