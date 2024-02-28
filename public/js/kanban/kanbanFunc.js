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
function dropguardar() {
    console.log('asdasdasd');
    let id = document.getElementById('idTaks').value;
    let nombre = document.getElementById('nombreLabel').value;
    let descripcion = document.getElementById('descriptionLabel').value;
    let progreso = document.getElementById('progresoLabel').value;
    let dias = document.getElementById('diasLabel').value;
    let inicio = document.getElementById('inicio').value;
    let fin = document.getElementById('fin').value;
    let estatus = document.getElementById('estatusSelect').value;

    // Convertir las fechas en objetos Date
    let inicioDate = new Date(inicio);
    let finDate = new Date(fin);

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
//agregar archivos en la lista
function manejarSeleccionArchivos() {
    var input = document.getElementById('fileInput');
    var files = input.files;
    var lista = document.getElementById('listaArchivos');
    var archivosArray = []; // Array para almacenar archivos en Base64

    // Agregar archivos uno por uno a la lista
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var listItem = document.createElement('li');
        listItem.classList.add('litcss');
        listItem.classList.add('file-item');

        function archivoAbase64(file) {
            return new Promise((resolve, reject) => {
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function () {
                    resolve(reader.result);
                };
                reader.onerror = function (error) {
                    reject(error);
                };
            });
        }
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
            archivosArray.push(base64);
            console.log("Archivo convertido a Base64:", base64);
        }).catch(error => {
            console.error("Error al convertir archivo a Base64:", error);
        });
    }

    console.log("Array de archivos en Base64:", archivosArray);
}

//log colapsee
function toggleCollapse() {
    var content = document.querySelector('.content');
    if (content.style.display === 'none') {
        content.style.display = 'block';
    } else {
        content.style.display = 'none';
    }
}

//taks modal
function addTask() {
    var taskName = document.getElementById("task-input").value.trim();
    if (taskName) {
        var taskList = document.getElementById("task-list");
        var li = document.createElement("li");
        li.classList.add("task-item");
        var checkbox = document.createElement("input");
        checkbox.type = "checkbox";
        checkbox.addEventListener("change", updateProgressBar);
        var span = document.createElement("span");
        span.textContent = taskName;
        span.addEventListener("click", editTaskName);

        li.appendChild(checkbox);
        li.appendChild(span);
        taskList.appendChild(li);

        document.getElementById("task-input").value = ""; // Limpiar el campo de entrada después de agregar la tarea
    }
}

function updateProgressBar() {
    var checkboxes = document.querySelectorAll("input[type='checkbox']");
    var completedTasks = Array.from(checkboxes).filter(checkbox => checkbox.checked).length;
    var progressBarWidth = (completedTasks / checkboxes.length) * 100;
    var progressBar = document.querySelector(".progress-bar");
    progressBar.style.width = progressBarWidth + "%";
}

function editTaskName(event) {
    var span = event.target;
    var taskName = span.textContent;
    var input = document.createElement("input");
    input.type = "text";
    input.value = taskName;
    input.addEventListener("blur", function () {
        span.textContent = input.value;
    });
    span.textContent = "";
    span.appendChild(input);
    input.focus();
}
/// se agrega logica para etiquetas
var circleContainer = document.getElementById('circle-container');
var listArrayP1 = [];
var checkboxes1 = document.querySelectorAll('.checkboxp1');
checkboxes1.forEach(function (checkbox, index) {
    checkbox.addEventListener('change', function () {
        if (this.checked) {
            listArrayP1.push(this.value);
        } else {
            listArrayP1.splice(listArrayP1.indexOf(this.value), 1);
        }
        updateDisplay();
    });
});

function updateDisplay() {
    var displayValue = '';
    circleContainer.innerHTML = '';
    listArrayP1.forEach(function (value) {
        var circle = document.createElement('span');
        circle.className = 'circle';
        circle.style.backgroundColor = getCircleColor(value);
        circleContainer.appendChild(circle);
        displayValue += value;
    });
    //valuelist1.innerHTML = displayValue;
}

function getCircleColor(value) {
    switch (value) {
        case '#C2DCFE':
            return '#C2DCFE';
        case '#DEC2FE':
            return '#DEC2FE';
        case '#CAEFC0':
            return '#CAEFC0';
        case '#EFC0C0':
            return '#EFC0C0';
        case '#FFD1F7':
            return '#FFD1F7';
        case '#FFECAF':
            return '#FFECAF';
        default:
            return 'black';
    }
}
