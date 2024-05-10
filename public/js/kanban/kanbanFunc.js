// funciones para el drop de los botones de propiedades
function dropEtiquetas() {
    document.getElementById("drop-Etiquetas").classList.toggle("show");
}
function dropAdjuntar() {
    document.getElementById("drop-Adjuntar").classList.toggle("show");
}
function dropPersonas() {
    document.getElementById("drop-Personas").classList.toggle("show");
}
function dropEtiquetasd() {
    document.getElementById("drop-Etiquetasd").classList.toggle("show");
}
function dropguardar() {
    let id = document.getElementById('idTaks').value;
    let nombre = document.getElementById('nombreLabel').value;
    let descripcion = document.getElementById('descriptionLabel').value;
    let progreso = document.getElementById('progresoLabel').value;
    let dias = document.getElementById('diasLabel').value;
    let inicio = document.getElementById('inicio').value;
    let fin = document.getElementById('fin').value;
    let estatus = document.getElementById('estatusSelect').value;

    // Convertir las fechas en objetos Date
    let inicioDate = new Date(inicio + " 00:00:00");
    let finDate = new Date(fin + " 00:00:00");

    // Obtener los timestamps en milisegundos
    let inicioTimestamp = inicioDate.getTime();
    let finTimestamp = finDate.getTime();

    guardarDatosmodal(id, nombre, descripcion, inicioTimestamp, finTimestamp, dias, mapTextToStatus[estatus], progreso)
}
// func para formatear fecha
function timestampToDateString(timestamp) {
    let date = new Date(timestamp);
    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();
    if (day < 10) {
        day = '0' + day;
    }
    if (month < 10) {
        month = '0' + month;
    }
    let formattedDate = year + '-' + month + '-' + day;
    console.log(formattedDate);
    return formattedDate;
}
// fun para colores y textos
const mapStatusToColor = {
    "STATUS_ACTIVE": "#DEEFFF",
    "STATUS_DONE": "#DEFFE6",
    "STATUS_FAILED": "#FFDFDF",
    "STATUS_SUSPENDED": "#EEEEEE",
    "STATUS_UNDEFINED": "#FFECAF"
};
const mapStatusToColorText = {
    "STATUS_ACTIVE": "#0080FF",
    "STATUS_DONE": "#42A500",
    "STATUS_FAILED": "#FF5C3A",
    "STATUS_SUSPENDED": "#818181",
    "STATUS_UNDEFINED": "#FF9900"
};
const mapStatusToEstatus = {
    "STATUS_ACTIVE": "progreso",
    "STATUS_DONE": "completado",
    "STATUS_FAILED": "retraso",
    "STATUS_SUSPENDED": "suspendida",
    "STATUS_UNDEFINED": "iniciar"
};
const mapStatusToEstatusText = {
    "STATUS_ACTIVE": "En proceso",
    "STATUS_DONE": "Completado",
    "STATUS_FAILED": "Retrasado",
    "STATUS_SUSPENDED": "Suspendido",
    "STATUS_UNDEFINED": "Lista de tareas"
};
const mapTextToStatus = {
    "En proceso": "STATUS_ACTIVE",
    "Completado": "STATUS_DONE",
    "Retrasado": "STATUS_FAILED",
    "Suspendido": "STATUS_SUSPENDED",
    "Lista de tareas": "STATUS_UNDEFINED"
};
//inica lo referente a documentos y como mostrarlos //////////////////////
var archivosArray = []; // Array para almacenar objetos {name, base64}

function manejarSeleccionArchivos() {
    var input = document.getElementById('fileInput');
    var files = input.files;
    var lista = document.getElementById('listaArchivos');

    // Agregar archivos uno por uno a la lista
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var listItem = document.createElement('li');
        listItem.classList.add('litcss');
        listItem.classList.add('file-item');

        // Agregar elementos adicionales dentro del <li>
        var fileNameElement = document.createElement('span');
        fileNameElement.textContent = file.name;
        fileNameElement.classList.add('filename');
        listItem.appendChild(fileNameElement);

        var fileSizeElement = document.createElement('span');
        fileSizeElement.textContent = (file.size / 1024).toFixed(2) + ' KB';
        fileSizeElement.classList.add('filesize');
        listItem.appendChild(fileSizeElement);

        var deleteIcon = document.createElement('i');
        deleteIcon.classList.add('fas', 'fa-trash-alt', 'delete-btn');
        deleteIcon.addEventListener('click', function () {
            listItem.remove(); // Eliminar el elemento li al hacer clic en el ícono
        });
        listItem.appendChild(deleteIcon);

        lista.appendChild(listItem);

        // Convertir archivo a Base64 y almacenar en el array
        archivoAbase64(file).then(base64 => {
            const resourcesNuevo = {
                "name": file.name,
                "archivo": base64
            };
            archivosArray.push(resourcesNuevo); // Modificación aquí
            console.log("Archivo convertido a Base64:", base64);
            console.log("Array de archivos en Base64:", archivosArray); // Aquí puedes ver el contenido actualizado del array
        }).catch(error => {
            console.error("Error al convertir archivo a Base64:", error);
        });
    }
}

function archivoAbase64(file) {
    return new Promise((resolve, reject) => {
        var reader = new FileReader();
        reader.onload = function () {
            resolve(reader.result);
        };
        reader.onerror = function (error) {
            reject(error);
        };
        reader.readAsDataURL(file);
    });
}

function base64Aarchivo(file, nombreArchivo) {
    const listItem = document.createElement('div');
    listItem.classList.add('file-item');

    const imgContainer = document.createElement('div');
    imgContainer.classList.add('file-img-container');
    if (imagePath) {
        const img = document.createElement('img');
        img.src = imagePath;
        imgContainer.appendChild(img);
    }
    listItem.appendChild(imgContainer);

    const nameContainer = document.createElement('div');
    nameContainer.classList.add('file-name-container');
    const name = document.createElement('span');
    name.textContent = nombreArchivo;
    nameContainer.appendChild(name);
    listItem.appendChild(nameContainer);

    const buttonsContainer = document.createElement('div');
    buttonsContainer.classList.add('file-buttons');

    const downloadButton = document.createElement('button');
    downloadButton.innerHTML = '<i class="download-button"></i>';
    downloadButton.addEventListener('click', function () {
        downloadFile(file, nombreArchivo);
    });
    buttonsContainer.appendChild(downloadButton);

    const viewButton = document.createElement('button');
    viewButton.innerHTML = `<i class="view-button"></i>`;
    viewButton.addEventListener('click', function () {
        viewInBrowser(file);
    });
    buttonsContainer.appendChild(viewButton);

    listItem.appendChild(buttonsContainer);

    const listaArchivosDiv = document.getElementById('conteiner-adjuntos');
    listaArchivosDiv.appendChild(listItem);
}

function downloadFile(fileData, fileName) {
    // Convertir el archivo base64 en un blob
    const byteCharacters = atob(fileData.split(',')[1]);
    const byteNumbers = new Array(byteCharacters.length);
    for (let i = 0; i < byteCharacters.length; i++) {
        byteNumbers[i] = byteCharacters.charCodeAt(i);
    }
    const byteArray = new Uint8Array(byteNumbers);
    const blob = new Blob([byteArray], { type: 'application/octet-stream' });

    // Crear un enlace temporal
    const link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = fileName;

    // Hacer clic en el enlace para iniciar la descarga
    document.body.appendChild(link);
    link.click();

    // Limpiar después de la descarga
    document.body.removeChild(link);
}

function viewInBrowser(fileData) {
    const newWindow = window.open();
    newWindow.document.open();

    if (fileData.startsWith('data:text/html')) {
        // Si es un archivo HTML, abrirlo en una nueva ventana
        newWindow.document.write(fileData);
    } else if (fileData.startsWith('data:image')) {
        // Si es una imagen, mostrarla en una ventana emergente
        newWindow.document.write(`<img src="${fileData}" alt="Image Preview" />`);
    } else if (fileData.startsWith('data:text/plain')) {
        // Si es un archivo de texto, abrirlo en una nueva ventana
        newWindow.document.write(`<pre>${fileData}</pre>`);
    } else if (fileData.startsWith('data:application/pdf')) {
        // Si es un archivo PDF, mostrarlo en una ventana emergente usando un iframe
        newWindow.document.write(`<iframe src="${fileData}" style="width:100%;height:100%;" frameborder="0"></iframe>`);
    } else if (fileData.startsWith('data:application/vnd.openxmlformats-officedocument')) {
        // Si es un archivo de Office (por ejemplo, docx, xlsx, pptx), mostrarlo en una ventana emergente usando embed
        newWindow.document.write(`<embed src="${fileData}" style="width:100%;height:100%;" type="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">`);
    } else {
        // Si no se puede determinar el tipo de archivo, mostrar el archivo como texto plano
        newWindow.document.write(`<pre>${fileData}</pre>`);
    }

    newWindow.document.close();
}

//log  /////////////////////////////
function toggleCollapse() {
    var content = document.querySelector('.contentLog');
    if (content.style.display === 'none') {
        content.style.display = 'block';
    } else {
        content.style.display = 'none';
    }
}

//taks modal //////////////////////////////
let subTasks = [];
let taskIdCounter = 0;

const addTask = () => {
    const taskInput = document.getElementById("task-input");
    const taskName = taskInput.value.trim();
    if (taskName) {
        const taskId = `task-${taskIdCounter++}`;
        const checkbox = createCheckbox(taskId);
        const span = createTaskSpan(taskName);
        const li = createTaskListItem(taskId, checkbox, span);
        addTaskToDOM(li);
        subTasks.push({ selected: false, id: taskId, taskName });
        taskInput.value = "";
    }
};

const createCheckbox = (taskId) => {
    const checkbox = document.createElement("input");
    checkbox.type = "checkbox";
    checkbox.addEventListener("change", () => {
        const taskIndex = subTasks.findIndex(task => task.id === taskId);
        if (taskIndex !== -1) {
            subTasks[taskIndex].selected = checkbox.checked;
            updateProgressBar();
        }
    });
    return checkbox;
};

const createTaskSpan = (taskName) => {
    const span = document.createElement("span");
    span.textContent = taskName;
    span.addEventListener("click", editTaskName);
    return span;
};

const createTaskListItem = (taskId, checkbox, span) => {
    const li = document.createElement("li");
    li.id = taskId;
    li.classList.add("task-item");
    li.appendChild(checkbox);
    li.appendChild(span);
    return li;
};

const addTaskToDOM = (taskElement) => {
    const taskList = document.getElementById("task-list");
    taskList.appendChild(taskElement);
};

const updateProgressBar = () => {
    const checkboxes = document.querySelectorAll("#task-list input[type='checkbox']");
    const completedTasks = Array.from(checkboxes).filter(({ checked }) => checked).length;
    const progressBarWidth = (completedTasks / checkboxes.length) * 100 || 0;
    const progressBar = document.querySelector(".progress-bar");
    progressBar.style.width = `${progressBarWidth}%`;

    // Actualizar la etiqueta de progreso
    const progressLabel = document.querySelector(".progress-label");
    progressLabel.textContent = `Progreso: ${progressBarWidth.toFixed(2)}%`;
};

const clearTasks = () => {
    const taskList = document.getElementById("task-list");
    taskList.innerHTML = "";
    subTasks = [];
    taskIdCounter = 0;
};

const insertTasksFromService = (tasksFromService) => {
    clearTasks();
    if (tasksFromService && Array.isArray(tasksFromService)) {
        clearTasks();
        tasksFromService.forEach(({ selected, taskName }) => {
            const taskId = `task-${taskIdCounter++}`;
            const checkbox = createCheckbox(taskId);
            checkbox.checked = selected;
            const span = createTaskSpan(taskName);
            const li = createTaskListItem(taskId, checkbox, span);
            addTaskToDOM(li);
            subTasks.push({ selected, id: taskId, taskName });
            updateProgressBar();
        });
    } else {
        clearTasks();
        updateProgressBar();
        console.error("El parámetro subtasks no es un array definido.");
    }
};

const editTaskName = (event) => {
    const span = event.target;
    const taskId = span.parentNode.id;
    const input = document.createElement("input");
    input.type = "text";
    input.value = span.textContent.trim();
    input.classList.add("edit-task-input");
    span.parentNode.replaceChild(input, span);
    input.focus();

    // Manejar el evento 'blur' para guardar los cambios
    input.addEventListener("blur", () => {
        const newTaskName = input.value.trim();
        if (newTaskName !== "") {
            const span = document.createElement("span");
            span.textContent = newTaskName;
            span.addEventListener("click", editTaskName);
            input.parentNode.replaceChild(span, input);
            const taskIndex = subTasks.findIndex(task => task.id === taskId);
            if (taskIndex !== -1) {
                subTasks[taskIndex].taskName = newTaskName;
            }
        } else {
            input.parentNode.remove();
            const taskIndex = subTasks.findIndex(task => task.id === taskId);
            if (taskIndex !== -1) {
                subTasks.splice(taskIndex, 1);
            }
        }
    });
};

document.getElementById("add-task-btn").addEventListener("click", addTask);
document.getElementById("task-input").addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        addTask();
    }
  });
/// se agrega logica para etiquetas etiquetas ////////////////
var circleContainer = document.getElementById('circle-container');
var listArrayP1 = [];
var checkboxes1 = document.querySelectorAll('.checkboxp1');
checkboxes1.forEach(function (checkbox, index) {
    checkbox.addEventListener('change', function () {
        if (this.checked) {
            listArrayP1.push(this.getAttribute('name')); // Modificado para obtener el atributo 'name'
        } else {
            listArrayP1.splice(listArrayP1.indexOf(this.getAttribute('name')), 1); // Modificado para obtener el atributo 'name'
        }
        updateDisplay();
    });
});

var tagss = [
    { etiqueta: "etiqueta1" },
    { etiqueta: "etiqueta2" },
    { etiqueta: "etiqueta3" },
    { etiqueta: "etiqueta4" },
    { etiqueta: "etiqueta5" },
    { etiqueta: "etiqueta6" }
];

const etiquetaColors = {
    "etiqueta1": "color1",
    "etiqueta2": "color2",
    "etiqueta3": "color3",
    "etiqueta4": "color4",
    "etiqueta5": "color5",
    "etiqueta6": "color6"
};
var tagCheckboxesMap = {};

// Mapeo de etiquetas a checkboxes ///////////////////////////////
tagss.forEach(tag => {
    tagCheckboxesMap[tag.etiqueta] = document.querySelector('input[name="' + tag.etiqueta + '"]');
});
var divetiquetas = document.getElementById("etiquetas");
function seleccionarCheckboxes(tags) {
    if (tags && tags.length > 0) {
        divetiquetas.style.display = "block";
        deseleccionarCheckboxes();
        tags.forEach(tag => {
            var checkbox = tagCheckboxesMap[tag.etiqueta];
            if (checkbox) {
                checkbox.checked = true;
            }
        });
        listArrayP1 = tags.map(tag => tag.etiqueta);
        updateDisplay();
    } else {
        if (tags && tags.length > 0) {
            divetiquetas.style.display = "none";
        } else {
            divetiquetas.style.display = "block";
        }
        deseleccionarCheckboxes();
        listArrayP1 = [];
        updateDisplay();
    }
}

function deseleccionarCheckboxes() {
    Object.values(tagCheckboxesMap).forEach(checkbox => {
        checkbox.checked = false;
    });
}

function updateDisplay() {
    var displayValue = '';
    var fragment = document.createDocumentFragment();
    listArrayP1.forEach(function (value) {
        var circle = document.createElement('span');
        circle.className = 'circle';
        circle.style.backgroundColor = getCircleColor(value);
        fragment.appendChild(circle);
        displayValue += value;
    });
    if (listArrayP1.length === 0) {
        divetiquetas.style.display = "none";
    } else {
        divetiquetas.style.display = "block";
    }
    circleContainer.innerHTML = ''; // Limpiar el contenedor anterior
    circleContainer.appendChild(fragment);
}

function getCircleColor(value) {
    switch (value) {
        case 'etiqueta1':
            return '#C2DCFE';
        case 'etiqueta2':
            return '#DEC2FE';
        case 'etiqueta3':
            return '#CAEFC0';
        case 'etiqueta4':
            return '#EFC0C0';
        case 'etiqueta5':
            return '#FFD1F7';
        case 'etiqueta6':
            return '#FFECAF';
        default:
            return 'black';
    }
}
///////////////// acaba funciones para checkbox
/////////////////////////////////////////////////////////funciones para agregar personas
let addedArray = [];

const areaSelect = document.getElementById('areaSelect');
const agregarSelect = document.getElementById("agregarSelect");
const areaFormGroup = document.getElementById("areaForm");

areaSelect.addEventListener('change', handleAreaChange);
agregarSelect.addEventListener('change', handleSelectionChange);

handleSelectionChange();

function handleAreaChange() {
    const id = parseInt(areaSelect.value);
    const personafiltrada = responseLocal.resources.filter(persona => persona.area_id === id);
    addOptionsFromArray(personafiltrada, personasAsignadas);
}

function handleSelectionChange() {
    const seleccion = agregarSelect.value;
    areaFormGroup.style.display = seleccion === "Por persona" ? "none" : "block";
    const personafiltrada = seleccion === "Por persona" ? responseLocal.resources : [];
    addOptionsFromArray(personafiltrada, personasAsignadas);
}

function addOptionsFromArray(dataArray, personasAsignadas) {
    if (personasAsignadas && personasAsignadas.length > 0) {
        personasAsignadas.forEach(item => {
            if (!addedArray.some(addedItem => addedItem.id === item.id)) {
                addedArray.push({ id: item.id, name: item.name });
            }
        });
    }

    var checkboxesContainer = document.querySelector('.dropdown-checkboxes');
    var divParticipantesContainer = document.getElementById("personasAsignadas");

    function filterItems(searchTerm) {
        checkboxesContainer.innerHTML = '';
        dataArray.forEach(item => {
            var isChecked = addedArray.some(addedItem => addedItem.id === item.id);
            if (item.name.toLowerCase().includes(searchTerm.toLowerCase())) {
                var newCheckboxLabel = document.createElement('label');
                newCheckboxLabel.classList.add('dropdown-item-personas');
                newCheckboxLabel.innerHTML = `
                    <span style="max-width: calc(100% - 30px); display: inline-block; margin-right: 5px;">${item.name}</span>
                    <input type="checkbox" value="${item.id}" ${isChecked ? 'checked' : ''} style="float: right;">`;
                checkboxesContainer.appendChild(newCheckboxLabel);
            }
        });
        updateParticipantsList();
    }

    function updateParticipantsList() {
        divParticipantesContainer.innerHTML = '';
        divParticipantesContainer.style.display = addedArray.length > 0 ? "block" : "none";

        const participantesHTML = addedArray.map(asignado => {
            const initials = asignado.name.trim().split(' ').map(word => word.charAt(0)).join('').toUpperCase();
            const color = 'blue';
            return `<div class="person" style="display: flex; align-items: center; margin-bottom: 5px; margin-left: 20px;">
                        <div class="initials" style="background-color: ${color}; color: white; border-radius: 50%; width: 45px; height: 45px; display: flex; justify-content: center; align-items: center; margin-right: 5px;">${initials}</div>
                        <div style="margin-left: 5px; margin-right: auto;">${asignado.name}</div>
                        <button class="delete-btn" data-id="${asignado.id}" style="background-color: transparent; border: none; cursor: pointer; outline: none; margin-left: 10px;"><img src=${imageTrash} width="20" height="20"></button>
                    </div>`;
        }).join("");

        divParticipantesContainer.innerHTML = participantesHTML;

        divParticipantesContainer.querySelectorAll('.delete-btn').forEach(button => {
            button.removeEventListener('click', deleteParticipant);
        });

        divParticipantesContainer.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', deleteParticipant);
        });
    }

    function deleteParticipant() {
        const idToDelete = parseInt(this.getAttribute('data-id'));
        addedArray = addedArray.filter(item => item.id !== idToDelete);
        filterItems(document.querySelector('.search-input').value.trim());
    }

    filterItems('');

    checkboxesContainer.style.height = '200px';
    checkboxesContainer.style.overflowY = 'auto';

    var searchInput = document.querySelector('.search-input');
    searchInput.addEventListener('input', function() {
        var searchTerm = this.value.trim();
        filterItems(searchTerm);
    });

    checkboxesContainer.addEventListener('change', function(event) {
        if (event.target.type === 'checkbox') {
            var selectedId = parseInt(event.target.value);
            var selectedName = event.target.previousElementSibling.textContent.trim();
            var isChecked = event.target.checked;
            if (isChecked) {
                if (!addedArray.some(item => item.id === selectedId)) {
                    addedArray.push({ id: selectedId, name: selectedName });
                }
            } else {
                addedArray = addedArray.filter(item => item.id !== selectedId);
            }
            console.log(addedArray);
            updateParticipantsList();
        }
    });
}
/// funcion para calcular dias entre fecha
function calcularDiferenciaFechas(inicio, fin) {
    var fechaInicio = new Date(inicio);
    var fechaFin = new Date(fin);
    var diferencia = fechaFin.getTime() - fechaInicio.getTime();
    var dias = Math.ceil(diferencia / (1000 * 3600 * 24));
    return dias;
}

// Función para actualizar el campo de días al cambiar las fechas
function actualizarDias() {
    var inicio = $("#inicio").val();
    var fin = $("#fin").val();
    if (inicio && fin) {
        var dias = calcularDiferenciaFechas(inicio, fin);
        $("#diasLabel").val(dias);
    }
}

// Asignar el evento de cambio a los campos de fecha
$("#inicio, #fin").change(actualizarDias);
