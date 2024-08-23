<style>
    .addCard {
        background-color: transparent;
        border: none;
        color: #0080FF;
        margin: 10px;
        text-align: center;
        font-size: 16px;
        width: -webkit-fill-available;
        display: inline-block;
    }

    .addBtn {
        background-color: #DEEFFF;
        color: #0080FF;
        border: none;
        border-radius: 5px;
        padding: 6px;
        padding-left: 20px;
        padding-right: 20px;
    }

    .cancelBtn {
        background-color: #FFDFDF;
        color: #FF5C3A;
        border: none;
        border-radius: 5px;
        padding: 6px;
        padding-left: 20px;
        padding-right: 20px;
    }
</style>
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
                <button type="button" class="close" data-dismiss="modal">X</button>
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
                                <img class="addSVG" src="{{ asset('img/planTrabajo/add.svg') }}">
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
                                <img class="addSVG" src="{{ asset('img/planTrabajo/attach.svg') }}">
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
                                <img class="addSVG" src="{{ asset('img/planTrabajo/account.svg') }}">
                                <span>Participantes</span>
                            </button>
                            <div id="drop-Personas" class="dropdownBtn-content" style="height: 542px;">
                                <div class="texto-Etiquetas">
                                    <p>Participantes</p>
                                </div>
                                <div class="contenedorSelect">
                                    <div class="form-group anima-focus">
                                        <select required class="form-control" name="agregarSelect"
                                            id="agregarSelect">
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
                                <div class="assigned-to" id="personasAsignadas"
                                    style="display: block;overflow-y: auto;height: 250px;"></div>
                            </div>
                        </div>
                        <div class="dropdownBtn">
                            <button onclick="dropguardar()" class="dropbtn">
                                <img class="addSVG" src="{{ asset('img/planTrabajo/save.svg') }}">
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
                        style="border-bottom: 1px dashed #0000001C;font-size: 18px;padding-top: 20px;">Subtareas</h6>
                    <div>
                        <div id="task-container">
                            <div class="progress-container">
                                <div class="progress-label">Progreso: 0%</div>
                                <div class="progress-bar"></div>
                            </div>
                            <ul id="task-list"></ul>
                        </div>
                        <div id="task-add">
                            <button id="add-task-btn"></button>
                            <input type="text" id="task-input" placeholder="Agregar subtarea">
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
@php
    use App\Models\User;

    $usuario = User::getCurrentUser();
@endphp

@section('scripts')
    @parent
    <script src="{{ asset('js/workPlan/kanban/jkanban.js') }}"></script>
    <script src="{{ asset('js/workPlan/kanban/kanbanFunc.js') }}"></script>
    <script>
        $(function() {

        });
        var Kanban
        const imagePath = '{{ asset('img/planTrabajo/documento.svg') }}';
        const imagePathEye = '{{ asset('img/planTrabajo/visibility.svg') }}';
        const imageTrash = '{{ asset('img/planTrabajo/deleteX.svg') }}';

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

        function reloadKanban() {
            Kanban = null
            console.log(Kanban);
            document.getElementById("myKanban").innerHTML = "";
            initKanban();
        }

        function renderKanban(response) {
            $.ajax({
                type: "GET",
                url: "{{ asset('storage/gantt/status.json') }}",
                success: function(estatuses) {
                    renderKanbanNew(response.tasks, response);
                }
            });
        }
        // Obtener el token CSRF una vez
        document.getElementById('fileInput').addEventListener('change', manejarSeleccionArchivos);
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        let tasksModel = [];
        let personasAsignadas = [];
        let responseLocal = {};
        let grupos = [];

        function renderKanbanNew(tasks, response) {
            let progreso = [];
            responseLocal = response;
            tasksModel = tasks;
            const modal = new bootstrap.Modal(document.getElementById('myModal'));
            agruparTaks();
            let countIniciar;
            Kanban = new jKanban({
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
                dragEl: function(el, source) {},
                dragendEl: function(el) {},
                dropEl: function(el, target, source, sibling) {
                    pintar(el.dataset.eid, el.offsetParent.dataset.id);
                    contarElementosPorBoard();
                    guardarStatus(el.dataset.eid, source.offsetParent.dataset.id, target.offsetParent
                        .dataset
                        .id);
                },
                buttonClick: function(el, boardId) {
                    var formItem = document.createElement("form");
                    formItem.setAttribute("class", "itemform");
                    formItem.innerHTML = `
                    <div class="form-group">
                          <textarea class="form-control" rows="1" autofocus style="min-height: 34px !important;"></textarea>
                        </div>
                        <div class="form-group">
                          <button type="submit" class="addBtn">Aceptar</button>
                          <button type="button" id="CancelBtn" class="cancelBtn">Cancelar</button>
                        </div>
                    `;
                    Kanban.addForm(boardId, formItem);
                    formItem.addEventListener("submit", function(e) {
                        e.preventDefault();
                        var text = e.target[0].value;
                        let cardpulseClass = "";
                        if (status === "STATUS_FAILED") {
                            cardpulseClass = "pulse";
                        }
                        const timestamp = Date.now();
                        let id = "tmp_" + timestamp;
                        insertTask(text, boardId, id);
                        var newElementHTML = `
                            <div id="id" class="cardContenido ${cardpulseClass}">
                              <div class="tituloCard">${text}</div>
                              <div class="contenido">
                                <div class="etiquetaContenido">
                                  <div class="etiquetaTitulo">Etiqueta</div>
                                </div>
                                <div class="estatusContenido">
                                  <div class="estatusTitulo">Estatus</div>
                                  <div id="estatusColor" class="${boardId}-estatusColor">${mapStatusToEstatusText[boardId]}</div>
                                </div>
                              </div>
                              <div class="contenido">
                                <div id="taskContenido">
                                  <div id="taskText">0/0</div>
                                </div>
                                <div class="resourceContenido">
                                  <img class="addSVG" src="{{ asset('img/planTrabajo/attach.svg') }}">
                                  <div id="resourceText">0</div>
                                </div>
                              </div>`;
                        Kanban.addElement(boardId, {
                            title: newElementHTML
                        });
                        formItem.parentNode.removeChild(formItem);
                    });
                    document.getElementById("CancelBtn").onclick = function() {
                        formItem.parentNode.removeChild(formItem);
                    };
                },
                itemAddOptions: {
                    enabled: true,
                    content: '+ Añada una tarjeta',
                    class: 'addCard',
                    footer: true
                },
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
                    const detalle = "ha movido esta tarjeta de " + mapStatusToEstatusText[statusInicial] + " a " +
                        mapStatusToEstatusText[statusFinal];
                    insertHistorico(detalle, objet[objetoEncontrado]);
                    saveOnServer(response);
                } else {
                    console.log('No se encontró ningún objeto con el ID dado.');
                }

            }

            function insertHistorico(detalle, history) {
                const timestamp = new Date().getTime();
                var usuario = <?php echo json_encode($usuario); ?>;
                const historicoNuevo = {
                    "detalle": detalle,
                    "fecha": timestamp,
                    "edito": usuario.empleado_id
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
                var elementoColorEstatus = intro.querySelector('#estatusColor');
                elementoColorEstatus.style.backgroundColor = mapStatusToColor[status];
                elementoColorEstatus.style.color = mapStatusToColorText[status];
                elementoColorEstatus.textContent = mapStatusToEstatusText[status];
                if (status == "STATUS_FAILED") {
                    intro.classList.add('pulse');
                } else {
                    intro.classList.remove('pulse');
                }
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
                personasAsignadas = assigs;
                const divparticipantes = document.getElementById("participantes");
                const imagenes = assigs.slice(0, 8).map(asignado => {
                    const foto = asignado.foto || (asignado.genero === 'M' ? 'woman.png' :
                        'usuario_no_cargado.png');
                    return `<div class="person"><img class="person-img" title="${asignado.name}" src="{{ asset('storage/empleados/imagenes') }}/${foto}" /></div>`;
                }).join("");
                divparticipantes.style.display = assigs.length > 0 ? "block" : "none";

                //mostrar el historial
                const htmlContentHistory = task.historic && task.historic.length > 0 ?
                    task.historic.map(item => {
                        const editedResource = response.resources.find(resource => resource.id === item.edito);
                        const initials = editedResource.name.trim().split(' ').map(word => word.charAt(0)).join('')
                            .toUpperCase();
                        const color = editedResource && (editedResource.genero === 'H' ? '#7DC0EC' : '#EC7D94');
                        const fecha = new Date(item.fecha);
                        const fechaFormateada = fecha.toLocaleString();
                        return `<div class="person" style="display: flex; align-items: center; margin-bottom: 5px; margin-left: 20px;">
                        <div class="initials" style="background-color: ${color}; color: white; border-radius: 50%; width: 35px; height: 35px; display: flex; justify-content: center; align-items: center; margin-right: 5px;font-size: 10px;">${initials}</div>
                        <div style="margin-left: 5px; margin-right: auto;"><a style="color: #818181;font-size: 14px; font-weight: bold;">${editedResource.name}</a> <a style="color: #818181;font-size: 12px;">${item.detalle}</a> <div>${fechaFormateada}</div></div>
                    </div>`
                    }).join("") :
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

                const areaSelect = document.getElementById('areaSelect');
                response.area.forEach(area => {
                    const option = document.createElement('option');
                    option.value = area.id;
                    option.text = area.area;
                    areaSelect.appendChild(option);
                });

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
                document.getElementById('logHistorico').innerHTML = htmlContentHistory;
                clearTasks();
                updateProgressBar();
                seleccionarCheckboxes(task.tag);
                insertTasksFromService(task.subtasks);
                addOptionsFromArray([], personasAsignadas);

                modal.show();

            }
        }

        function contarElementosPorBoard() {
            var tableros = {
                "STATUS_UNDEFINED": "tareasStrong",
                "STATUS_SUSPENDED": "suspendidosStrong",
                "STATUS_ACTIVE": "procesoStrong",
                "STATUS_FAILED": "retrasadosStrong",
                "STATUS_DONE": "completadosStrong"
            };

            var sumaTotal = 0;
            for (var tablero in tableros) {
                if (tableros.hasOwnProperty(tablero)) {
                    var elementos = Kanban.getBoardElements(tablero);
                    document.getElementById(tableros[tablero]).innerHTML = elementos.length;
                    sumaTotal += elementos.length;
                }
            }
            document.getElementById('totalesStrong').innerHTML = sumaTotal;
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
                    resources,
                    tag
                } = item;

                const resourcesCount = resources ? resources.length : 0;
                const subtasksCount = subtasks ? subtasks.length : 0;
                const subtasksReady = subtasks ? subtasks.filter(subtask => subtask.selected).length : 0;
                const etiquetaColorHTML = tag ? tag.map(tagItem =>
                    `<div class="etiquetaColor ${etiquetaColors[tagItem.etiqueta]}"></div>`).join('') : '';

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
                                  ${etiquetaColorHTML}
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
                                  <img class="addSVG" src="{{ asset('img/planTrabajo/attach.svg') }}">
                                  <div id="resourceText">${resourcesCount}</div>
                                </div>
                              </div>`,
                };
                cards.push(jsonEvents);
            });
            return cards
        }

        function agruparTaks() {
            for (const estado in mapStatusToEstatus) {
                grupos[mapStatusToEstatus[estado]] = [];
            }
            responseLocal.tasks.forEach(item => {
                const estado = mapStatusToEstatus[item.status];
                if (estado) {
                    grupos[estado].push(item);
                }
            });

            document.getElementById('totalesStrong').innerHTML = responseLocal.tasks.length;
            document.getElementById('tareasStrong').innerHTML = grupos.iniciar.length;
            document.getElementById('suspendidosStrong').innerHTML = grupos.suspendida.length;
            document.getElementById('procesoStrong').innerHTML = grupos.progreso.length;
            document.getElementById('retrasadosStrong').innerHTML = grupos.retraso.length;
            document.getElementById('completadosStrong').innerHTML = grupos.completado.length;
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

                insertPersonas(addedArray, updatedTask)

                saveOnServer(responseLocal);
                location.reload();
            } else {
                console.log('No se encontró ningún objeto con el ID dado.');
            }
        }

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

        function insertPersonas(value, personas) {
            if (!value || value.length === 0) {
                personas.assigs = []; // Si value está vacío, borramos todas las etiquetas
                return;
            }

            if ('assigs' in responseLocal.tasks) {
                value.forEach(element => {
                    const existingAssigsIndex = personas.assigs.findIndex(existingAssigs => existingAssigs
                        .resourceId === element.id);
                    if (existingAssigsIndex !== -1) {
                        // Si la etiqueta ya existe, no hacemos nada
                        return;
                    } else {
                        // Si la etiqueta no existe, la agregamos
                        personas.assigs.push({
                            "id": `${personas.id}_${element.id}_${element.id}`,
                            "resourceId": element.id,
                            "roleId": "tmp_1",
                            "effort": 0
                        });
                    }
                });
            } else {
                personas.assigs = value.map(element => ({
                    "id": `${personas.id}_${element.id}_${element.id}`,
                    "resourceId": element.id,
                    "roleId": "tmp_1",
                    "effort": 0
                }));
            }
        }

        function insertTask(value, status, id) {
            if (!value || value.length === 0) {
                return;
            }
            const timestamp = Date.now();
            responseLocal.tasks.push({
                "id": id,
                "name": value,
                "progress": 0,
                "progressByWorklog": false,
                "relevance": 0,
                "type": "",
                "typeId": "",
                "description": "",
                "code": "",
                "level": 1,
                "status": status,
                "depends": "",
                "start": timestamp,
                "duration": 1,
                "end": timestamp,
                "startIsMilestone": false,
                "endIsMilestone": false,
                "canWrite": true,
                "canAdd": true,
                "canDelete": true,
                "canAddIssue": true,
                "assigs": []
            });
            agruparTaks();
            location.reload();
            saveOnServer(responseLocal);
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
