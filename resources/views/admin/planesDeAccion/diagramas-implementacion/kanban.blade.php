<style>
    .dropbtn {
        background-color: #EFEFEF;
        color: #818181;
        font-size: 16px;
        border: none;
        cursor: pointer;
        width: inherit;
        display: flex;
        align-items: center;
        border-radius: 5px;
    }

    #myInput {
        box-sizing: border-box;
        background-image: url('searchicon.png');
        background-position: 14px 12px;
        background-repeat: no-repeat;
        font-size: 16px;
        padding: 14px 20px 12px 45px;
        border: none;
        border-bottom: 1px solid #ddd;
    }

    #myInput:focus {
        outline: 3px solid #ddd;
    }

    .dropdownBtn {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
        box-sizing: border-box;
    }

    .dropdownBtn-content {
        display: none;
        position: absolute;
        background-color: #FFFFFF;
        min-width: 230px;
        width: 300px;
        overflow: auto;
        border: 1px solid #E6E6E6;
        z-index: 1;
        border-radius: 10px;
    }

    .dropdownBtn-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdownBtn a:hover {
        background-color: #ddd;
    }

    .show {
        display: block;
    }

    .checkbox-list {
        list-style-type: none;
        padding-left: 20px;
    }

    .color1 {
        background-color: #C2DCFE;
    }

    .color2 {
        background-color: #DEC2FE;
    }

    .color3 {
        background-color: #CAEFC0;
    }

    .color4 {
        background-color: #EFC0C0;
    }

    .color5 {
        background-color: #FFD1F7;
    }

    .color6 {
        background-color: #FFECAF;
    }

    .etiquetasLista {
        margin-right: 20px;
        margin-left: 30px;
        height: 30px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }

    .texto-Etiquetas {
        display: flex;
        align-items: center;
        text-align: center;
        padding-top: 8px;
        padding-bottom: 3px;
        justify-content: center;
        font-size: 16px;
        color: #575757;
        font-weight: 700;
    }

    input[type="checkbox"] {
        width: 20px;
        height: 20px;
        margin-left: -25px;
    }

    .txtSub {
        font-size: 14px;
        color: #5A5A5A;
        justify-content: center;
        text-align: center;
    }

    .buttonArchivo {
        background-color: #E3EBFF;
        color: #5A5A5A;
        font-size: 14px;
        width: -webkit-fill-available;
        height: 36px;
        justify-content: center;
        text-align: center;
        display: flex;
        align-items: center;
        margin-left: 30px;
        margin-right: 30px;
        border: none;
        border-radius: 5px;
    }

    input::file-selector-button {
        background-color: #E3EBFF;
        color: #5A5A5A;
        font-size: 14px;
        width: -webkit-fill-available;
        height: 36px;
        justify-content: center;
        text-align: center;
        display: flex;
        align-items: center;
        margin-left: 30px;
        margin-right: 30px;
        border: none;
        border-radius: 5px;
    }

    .contenedorSelect {
        display: flow;
        align-content: center;
        padding-left: 30px;
    }

    .textcomplement {
        text-align: left;
        font-size: 14px;
        padding-bottom: 8px;
        padding-top: 8px;
    }

    #task-container {
        margin-bottom: 20px;
    }

    #task-list {
        list-style-type: none;
        column-count: 4;
    }

    .task-item {
        margin-bottom: 10px;
    }

    .progress-container {
        margin-bottom: 10px;
    }

    .progress-bar {
        width: 0;
        height: 10px;
        background-color: green;
        transition: width 0.5s;
    }

    .collapsible {
        background-color: #777;
        color: white;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
    }

    .content {
        padding: 0 18px;
        display: none;
        overflow: hidden;
        background-color: #f1f1f1;
    }

    /*  */
    .litcss {
        list-style: none;
        padding: 10px;
        margin: 5px 0;
        background-color: #f2f2f2;
        border-radius: 5px;
        display: flex;
        align-items: center;
    }

    .filename {
        margin-left: 10px;
    }

    .filesize {
        margin-left: auto;
        color: #818181;
        font-size: 0.9em;
    }

    .delete-btn {
        margin-left: 10px;
        color: #818181;
        border: none;
        border-radius: 3px;
        padding: 5px 10px;
        cursor: pointer;
    }

    .listaarchivos {
        padding-left: 5px;
        padding-right: 5px;
    }

    .circle {
        display: inline-block;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        margin-left: 10px;
    }

    .butonLog {
        background-color: #E3EBFF;
        color: #5A5A5A;
        font-size: 14px;
        height: 36px;
        justify-content: center;
        text-align: center;
        display: flex;
        align-items: center;
        border: none;
        border-radius: 5px;
    }
</style>
<link rel=stylesheet href="{{ asset('css/kanban/jkanban.min.css') }}" type="text/css">
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
                                                placeholder="">
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
                                            name="progresoLabel" placeholder="">
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
                                <span>Etiquetas</span>
                            </button>
                            <div id="drop-Personas" class="dropdownBtn-content">
                                <div class="texto-Etiquetas">
                                    <p>Participantes</p>
                                </div>
                                <div class="contenedorSelect">
                                    <div class="form-group anima-focus">
                                        <select required class="form-control" name="grupoSelect" id="grupoSelect">
                                            <option>En proceso</option>
                                            <option>Completado</option>
                                            <option>Retrasado</option>
                                            <option>Suspendido</option>
                                            <option>Lista de tareas</option>
                                        </select>
                                        <label for="grupoSelect">Agregar</label>
                                    </div>
                                    <div class="form-group anima-focus">
                                        <select required class="form-control" name="areaSelect" id="areaSelect">
                                            <option>En proceso</option>
                                            <option>Completado</option>
                                            <option>Retrasado</option>
                                            <option>Suspendido</option>
                                            <option>Lista de tareas</option>
                                        </select>
                                        <label for="areaSelect">Área</label>
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
                <div>
                    <h6 class="textcomplement">Participantes</h6>
                    <div class="assigned-to" id="imagenesParticipantes"></div>
                </div>
                <div>
                    <h6 class="textcomplement">Etiquetas</h6>
                    <div id="circle-container"></div>
                </div>
                <div>
                    <h6 class="textcomplement">Adjuntos</h6>
                </div>
                <div>
                    <h6 class="textcomplement" style="border-bottom: 1px dashed #0000001C;">Sub tareas</h6>
                    <div>
                        <div id="task-container">
                            <div class="progress-container">
                                <div class="progress-bar"></div>
                            </div>
                            <ul id="task-list"></ul>
                        </div>
                        <div id="task-add">
                            <input type="text" id="task-input" placeholder="Ingrese una tarea">
                            <button onclick="addTask()">Agregar Tarea</button>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row" style="border-bottom: 1px dashed #0000001C;">
                        <div class="col"
                            style="
                        justify-content: left;
                        display: flex;">
                            <h6 class="textcomplement">Log</h6>
                        </div>
                        <div class="col"
                            style="
                        justify-content: right;
                        display: flex;">
                            <button class="butonLog" onclick="toggleCollapse()">Mostrar detalles</button>
                        </div>
                    </div>
                    <div id="logHistorico" class="content">

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
            $.ajax({
                type: "GET",
                url: "{{ asset('storage/gantt/status.json') }}",
                success: function(estatuses) {
                    // let contenedor = $('#c_kanban');
                    // let html = "";
                    // let tasks = response.tasks.filter(task => task.level > 0 && !isParent(task, response
                    //     .tasks));

                    // estatuses.forEach(estatus => {
                    //     let key = Object.keys(estatus)[0];
                    //     let value = Object.values(estatus)[0];
                    //     let actividad_por_estatus = tasks.filter(actividad => actividad.status == key);

                    //     let renderedActividades = actividad_por_estatus.map(actividad =>
                    //         renderActividad(actividad, response));
                    //     html +=
                    //         `<ul><i class="fas fa-grip-vertical dragg-icon"></i><div><div class="${key}-titulo"><span class="name">${value}</span><div class="separator"></div><span class="subtitle">${actividad_por_estatus.length}</span></div></div><div id="${key}" class="scroll-li">${renderedActividades.join('')}</div></ul>`;
                    // });

                    // contenedor.html(html);
                    // attachEventListeners(response);
                    // initializeSortable(response);
                    renderKanbanNew(response.tasks, response);
                }
            });
        }
        // Obtener el token CSRF una vez
        document.getElementById('fileInput').addEventListener('change', manejarSeleccionArchivos);
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        let tasksModel = [];
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

            console.log(items(grupos.iniciar));

            let countIniciar;
            var KanbanTest = new jKanban({
                element: "#myKanban",
                gutter: '3px',
                widthBoard: '300px',
                responsivePercentage: true,
                dragItems: true,
                dragBoards: false,
                click: function(el) {
                    // $("#myModal").modal();
                    abrirModalConDatos(el.dataset.eid, tasks, response);
                },
                context: function(el, e) {
                    console.log("Trigger on all items right-click!");
                },
                dragEl: function(el, source) {
                    console.log("START DRAG: " + el.dataset.eid);
                    console.log("donde biene: " + source.offsetParent.dataset.id);
                    console.log("END DRAG: " + el);

                },
                dragendEl: function(el) {

                    // if (el == null) {

                    // } else {

                    //   pintar(el.dataset.eid, el.offsetParent.dataset.id);


                    // }
                },
                dropEl: function(el, target, source, sibling) {
                    console.log("DROPPED: " + el.dataset.eid);
                    console.log("de donde va: " + target.offsetParent.dataset.id);
                    console.log("donde biene: " + source.offsetParent.dataset.id);
                    // if (!confirm("¿Estás seguro de mover esta tarjeta?")) {
                    //   return false; // Cancela el movimiento
                    // }
                    // console.log("entrooooo");
                    pintar(el.dataset.eid, el.offsetParent.dataset.id);
                    guardarStatus(el.dataset.eid, source.offsetParent.dataset.id, target.offsetParent.dataset
                        .id);
                    // return true;
                    //KanbanTest.moveElement(el, source.id);
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

                    const jsonEvents = {
                        id: id,
                        title: `
          <div id="${id}" class="cardContenido">
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
                <div id="taskText">2/3</div>
              </div>
              <div class="resourceContenido">
                <div id="resourceIMG"></div>
                <div id="resourceText">1</div>
              </div>
            </div>`,
                    };
                    cards.push(jsonEvents);
                });
                return cards
            }

            function abrirModalConDatos(id, array, response) {
                let task;
                let imagenes = "";
                let imagenestogle = "";
                let assigs = [];
                let history = [];
                //se busca el usuario seleccionado
                for (let i = 0; i < array.length; i++) {
                    if (array[i].id === id) {
                        task = array[i];
                    }
                }
                //se agregan la simagenes por usuarios agregados
                if (task.assigs) {
                    assigs = task.assigs.map(asignado => response.resources.find(r => Number(r.id) === Number(asignado
                        .resourceId)));
                }
                let filteredAssigs = assigs.filter(a => a != null);
                filteredAssigs.slice(0, 4).forEach(asignado => {
                    let foto = asignado.foto || (asignado.genero === 'M' ? 'woman.png' : 'usuario_no_cargado.png');
                    imagenes +=
                        `<div class="person">
                            <img class="person-img" title="${asignado.name}" src="{{ asset('storage/empleados/imagenes') }}/${foto}" />
                        </div>`;
                });
                let filteredAssigsM = assigs.filter(a => a != null);
                filteredAssigsM.slice(0, 4).forEach(asignado => {
                    if (asignado.name) {
                        let initials = asignado.name.trim().split(' ').map(word => word.charAt(0)).join('')
                            .toUpperCase();
                        let color = asignado.genero === 'M' ? 'blue' : 'pink';
                        imagenestogle =
                            `<div class="person" style="display: flex; align-items: center; margin-bottom: 5px; margin-left: 20px;">
                                <div class="initials" style="background-color: ${color}; color: white; border-radius: 50%; width: 45px; height: 45px; display: flex; justify-content: center; align-items: center; margin-right: 5px;">${initials}</div>
                                <div style="margin-left: 5px; margin-right: auto;">${asignado.name}</div>
                            </div>`;
                    }
                });

                var htmlContent = ""; // Inicializamos el contenido HTML vacío

                // Verificamos si task.historic existe y tiene elementos
                if (task.historic && task.historic.length > 0) {
                    htmlContent += "<ul>";
                    // Iteramos sobre cada elemento del arreglo historic
                    task.historic.forEach(function(item) {
                        htmlContent += "<li>Initial Status: " + mapStatusToEstatusText[item.initialstatus] + ", Final Status: " + mapStatusToEstatusText[item
                            .finestatus] + ", Fecha: " + item.fecha + ", Edito: " + item.edito + "</li>";
                    });
                    htmlContent += "</ul>";
                } else {
                    // Si no existe o está vacío historic, mostramos un mensaje
                    htmlContent = "<span>No tiene historial</span>";
                }

                //se agregan parametros por elemento del modal
                document.getElementById('idTaks').value = `${task.id}`;
                document.getElementById('modal-title').innerHTML = `${task.name}`;
                document.getElementById('imagenesParticipantes').innerHTML = `${imagenes}`;
                document.getElementById('nombreLabel').value = `${task.name}`;
                document.getElementById('descriptionLabel').value = `${task.description}`;
                document.getElementById('progresoLabel').value = `${task.progress}%`;
                document.getElementById('diasLabel').value = `${task.duration}`;
                document.getElementById('inicio').value = `${timestampToDateString(task.start)}`;
                document.getElementById('fin').value = `${timestampToDateString(task.end)}`;
                document.getElementById('estatusSelect').value = `${mapStatusToEstatusText[task.status]}`;
                document.getElementById('personasAsignadas').innerHTML = `${imagenestogle}`;
                document.getElementById('logHistorico').innerHTML = `${htmlContent}`;
                // Mostrar el modal
                modal.show();
            }
        }

        function guardarDatosmodal(id, nombre, descripcion, inicio, fin, dias, estatus, progreso) {
            let taksnew = tasksModel.findIndex(objeto => objeto.id === id);
            if (taksnew !== -1) {
                const objet = tasksModel;
                objet[taksnew].name = nombre;
                objet[taksnew].progress = progreso.replace('%', '');;
                objet[taksnew].description = descripcion;
                objet[taksnew].status = estatus;
                objet[taksnew].start = inicio;
                objet[taksnew].end = fin;
                objet[taksnew].duration = dias;
                responseLocal.tasks = objet;
                saveOnServer(responseLocal);
                location.reload();
            } else {
                console.log('No se encontró ningún objeto con el ID dado.');
            }
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
