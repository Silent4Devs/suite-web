@extends('layouts.admin')
@section('content')
<script src="https://github.highcharts.com/gantt/highcharts-gantt.src.js"></script>
<script src="https://github.highcharts.com/gantt/modules/draggable-points.js"></script>
<script src="https://github.highcharts.com/gantt/modules/exporting.js"></script>

<style type="text/css">
#containergantt, #buttonGroup {
    max-width: 900px;
    min-width: 50px;
    margin: 1em auto;
}

.hidden {
    display: none;
}

.main-container button {
    font-size: 12px;
    border-radius: 2px;
    border: 0;
    background-color: #ddd;
    padding: 13px 18px;
}

.main-container button[disabled] {
    color: silver;
}

.button-row button {
    display: inline-block;
    margin: 0;
}

.overlay {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.3);
    transition: opacity 500ms;
}

.popup {
    margin: 70px auto;
    padding: 20px;
    background: #fff;
    border-radius: 5px;
    width: 300px;
    position: relative;
}

.popup input, .popup select {
    width: 100%;
    margin: 5px 0 15px;
}

.popup button {
    float: right;
    margin-left: 0.2em;
}

.popup .clear {
    height: 50px;
}

.popup input[type=text], .popup select {
    height: 2em;
    font-size: 16px;
}

		</style>
<div class="card">
    <div class="card-header">
       
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
            <div id="containergantt"></div>
    <div id="buttonGroup" class="button-row">
        <button id="btnShowDialog">
            <i class="fa fa-plus"></i>
            Agregar tarea
        </button>
        <button id="btnRemoveSelected" disabled="disabled">
            <i class="fa fa-remove"></i>
            Eliminar seleccionado
        </button>
    </div>

    <div id="addTaskDialog" class="hidden overlay">
        <div class="popup">
            <h3>Nueva Tarea</h3>

            <label>Nombre de actividad <input id="inputName" type="text" /></label>

            <label>Fase
                <select id="selectDepartment">
                    <option value="0">ASSESSMENT</option>
                    <option value="1">PLANEACIÓN</option>
                    <option value="2">SOPORTE</option>
					<option value="3">OPERACIÓN DE SGSI</option>
					<option value="4">EVALUACIÓN</option>
					<option value="5">MEJORA CONTINUA</option>
					
                </select>
            </label>

            <label>Dependencia
                <select id="selectDependency">
                    <!-- Filled in by Javascript -->
                </select>
            </label>

            <label>
                Hito
                <input id="chkMilestone" type="checkbox" />
            </label>

            <div class="button-row">
                <button id="btnAddTask">Agregar</button>
                <button id="btnCancelAddTask">Cancelar</button>
            </div>
            <div class="clear"></div>
        </div>
    </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
		Highcharts.setOptions({
    lang: {
            loading: 'Cargando...',
            months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            weekdays: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            shortMonths: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            exportButtonTitle: "Exportar",
            printButtonTitle: "Importar",
            rangeSelectorFrom: "Desde",
            rangeSelectorTo: "Hasta",
            rangeSelectorZoom: "Período",
            downloadPNG: 'Descargar imagen PNG',
            downloadJPEG: 'Descargar imagen JPEG',
            downloadPDF: 'Descargar imagen PDF',
            downloadSVG: 'Descargar imagen SVG',
            printChart: 'Imprimir',
            resetZoom: 'Reiniciar zoom',
            resetZoomTitle: 'Reiniciar zoom',
            thousandsSep: ",",
            decimalPoint: '.'
        }        
});
var today = new Date(),
    day = 1000 * 60 * 60 * 24,
    each = Highcharts.each,
    reduce = Highcharts.reduce,
    btnShowDialog = document.getElementById('btnShowDialog'),
    btnRemoveTask = document.getElementById('btnRemoveSelected'),
    btnAddTask = document.getElementById('btnAddTask'),
    btnCancelAddTask = document.getElementById('btnCancelAddTask'),
    addTaskDialog = document.getElementById('addTaskDialog'),
    inputName = document.getElementById('inputName'),
    selectDepartment = document.getElementById('selectDepartment'),
    selectDependency = document.getElementById('selectDependency'),
    chkMilestone = document.getElementById('chkMilestone'),
    isAddingTask = false;

// Set to 00:00:00:000 today
today.setUTCHours(0);
today.setUTCMinutes(0);
today.setUTCSeconds(0);
today.setUTCMilliseconds(0);
today = today.getTime();


// Update disabled status of the remove button, depending on whether or not we
// have any selected points.
function updateRemoveButtonStatus() {
    var chart = this.series.chart;
    // Run in a timeout to allow the select to update
    setTimeout(function () {
        btnRemoveTask.disabled = !chart.getSelectedPoints().length ||
            isAddingTask;
    }, 10);
}



Highcharts.ganttChart('containergantt', {
 chart: {
        spacingLeft: 1
    },
	
	  plotOptions: {
        series: {
            animation: false, // Do not animate dependency connectors
            dragDrop: {
                draggableX: true,
                draggableY: true,
                dragMinY: 0,
                dragMaxY: 2,
                dragPrecisionX: day / 3 // Snap to eight hours
            },
            dataLabels: {
                enabled: true,
                format: '{point.name}',
                style: {
                    cursor: 'default',
                    pointerEvents: 'none'
                }
            },
            allowPointSelect: true,
            point: {
                events: {
                    select: updateRemoveButtonStatus,
                    unselect: updateRemoveButtonStatus,
                    remove: updateRemoveButtonStatus
                }
            }
        }
    },
    series: [{
        name: 'ASSESSMENT',
        data: [{
            name: 'ASSESSMENT',
            id: 'idassessment',
            owner: 'Peter'
        }, {
            name: '1.- Realizar levantamiento de información con formulario de estado actual',
            id: 'prepare_building',
            parent: 'idassessment',
            start: today - (2 * day),
            end: today + (6 * day),
            completed: {
                amount: 0.2
            },
            owner: 'Linda'
        }, {
            name: '2.- Evaluar tablero y presentar resultados a dirección',
            id: 'inspect_building',
            parent: 'idassessment',
            start: today + 6 * day,
            end: today + 8 * day,
            owner: 'Ivy'
        }, {
            name: '2.1- Identificar brechas y esfuerzos',
            id: 'passed_inspection',
            dependency: 'inspect_building',
            parent: 'inspect_building',
            start: today + 9.5 * day,
            milestone: true,
            owner: 'Peter'
        }, {
            name: 'PLANEACIÓN',
            id: 'planeacion',
            owner: 'Josh'
        }, {
            name: '3.- Identificar el Contexto de la Organización',
            id: 'relocate_staff',
            parent: 'planeacion',
            start: today + 10 * day,
            end: today + 11 * day,
            owner: 'Mark'
        }, {
            name: '4.- Entendimiento de las necesidades y expectativas de las partes interesadas',
            dependency: 'necesidades',
            parent: 'planeacion',
            start: today + 11 * day,
            end: today + 13 * day,
            owner: 'Anne'
        }, {
            name: '5.- Manual del SGI',
            id: 'manual_sgi',
            parent: 'planeacion',
            start: today + 11 * day,
            end: today + 14 * day
        }
        , {
            name: '5.1- Elaborar matriz FODA',
            dependency: 'manual_sgi',
            parent: 'manual_sgi',
            start: today + 11 * day,
            end: today + 14 * day
        }
        , {
            name: '5.2- Determinar Alcance del SGSI',
            dependency: 'manual_sgi',
            parent: 'manual_sgi',
            start: today + 11 * day,
            end: today + 14 * day
        }
        , {
            name: '5.3- Política de Seguridad de Información',
            dependency: 'manual_sgi',
            parent: 'manual_sgi',
            start: today + 11 * day,
            end: today + 14 * day
        }
        , {
            name: '5.4- Objetivos del SGSI',
            dependency: 'manual_sgi',
            parent: 'manual_sgi',
            start: today + 11 * day,
            end: today + 14 * day
        }, {
            name: '6.- Análisis y Evaluación de Riesgos',
            id: 'analisis_riesgos',
            parent: 'planeacion',
            start: today + 10 * day,
            end: today + 11 * day,
            owner: 'Mark'
        }, {
            name: '6.1- Inventario de activos de Información',
            id: 'analisis_riesgos1',
            parent: 'analisis_riesgos',
            start: today + 10 * day,
            end: today + 11 * day,
            owner: 'Mark'
        }
        , {
            name: '6.2- Evaluación y valoración del Riesgo',
            id: 'analisis_riesgos2',
            parent: 'analisis_riesgos',
            start: today + 10 * day,
            end: today + 11 * day,
            owner: 'Mark'
        }
        , {
            name: '6.3- Plan de Tratamiento de Riesgos conforme a los controles de seguridad',
            id: 'analisis_riesgos3',
            parent: 'analisis_riesgos',
            start: today + 10 * day,
            end: today + 11 * day,
            owner: 'Mark'
        }
        
        , {
            name: '7.- Declaración de aplicabilidad SoA',
            id: 'declaracionsoa',
            parent: 'planeacion',
            start: today + 10 * day,
            end: today + 11 * day,
            owner: 'Mark'
        }]
    }, {
        name: 'SOPORTE',
        data: [{
            name: 'SOPORTE',
            id: 'id_sop',
            owner: 'Peter'
        }, {
            name: '8.- Compromiso de la Alta Dirección',
            id: 'development',
            parent: 'id_sop',
            start: today - day,
            end: today + (11 * day),
            completed: {
                amount: 0.6,
                fill: '#e80'
            },
            owner: 'Susan'
        }, {
            name: '8.1- Asignación de Recursos',
            id: 'beta',
            dependency: 'development',
            parent: 'development',
            start: today + 12.5 * day,
            milestone: true,
            owner: 'Peter'
        }, {
            name: '9.- Conformar el Comité de Seguridad',
            id: 'comite',
            dependency: 'beta',
            parent: 'id_sop',
            start: today + 13 * day,
            end: today + 17 * day
        }, {
            name: '9.1-  Elaborar matriz de roles y responsabilidades',
            dependency: 'comite',
            parent: 'comite',
            start: today + 17.5 * day,
            milestone: true,
            owner: 'Peter'
        }
        , {
            name: '10.- Competencias y capacitación',
            id: 'competencias',
            dependency: 'beta',
            parent: 'id_sop',
            start: today + 13 * day,
            end: today + 17 * day
        }, {
            name: '10.1-  Descripciones de puesto',
           
            parent: 'competencias',
            start: today + 17.5 * day,
            start: today + 13 * day,
            end: today + 17 * day,
            owner: 'Peter'
        }
        , {
            name: '10.2-  Control de capacitación del personal',

            parent: 'competencias',
            start: today + 17.5 * day,
            start: today + 13 * day,
            end: today + 17 * day,
            owner: 'Peter'
        }, 
        {
            name: '11.- Comunicación del SGSI',
            id: 'comunicacionsgsi',
            parent: 'id_sop',
            start: today + 13 * day,
            end: today + 17 * day
        }]
    }, {
        name: 'OPERACIÓN DE SGSI',
        data: [{
            name: 'OPERACIÓN DE SGSI',
            id: 'id_operacion',
            owner: 'Peter'
        }, {
            name: '12.- Procesos de gestión',
            id: 'procesosg',
            parent: 'id_operacion',
            start: today - day,
            end: today + (11 * day),
            completed: {
                amount: 0.6,
                fill: '#e80'
            },
            owner: 'Susan'
        }, {
            name: '12.1- Información documentada',
            id: 'infodoc',
            dependency: 'procesosg',
            parent: 'procesosg',
            start: today + 12.5 * day,
            milestone: true,
            owner: 'Peter'
        }, {
            name: '12.2.- Acciones correctivas',
            id: 'accionc',
            dependency: 'procesosg',
            parent: 'procesosg',
            start: today + 13 * day,
            end: today + 17 * day
        }, {
            name: '12.3-  Auditoria interna',
            dependency: 'procesosg',
            parent: 'procesosg',
            start: today + 17.5 * day,
            milestone: true,
            owner: 'Peter'
        }
        , {
            name: '12.4.- Gestión de incidentes de seguridad de la información',
            id: 'gestionis',
            dependency: 'bprocesosgeta',
            parent: 'procesosg',
            start: today + 13 * day,
            end: today + 17 * day
        }, {
            name: '13-  Manual de Políticas de seguridad de la información',
           id: 'manualpolitisi',
            parent: 'id_operacion',
            start: today + 17.5 * day,
            start: today + 13 * day,
            end: today + 17 * day,
            owner: 'Peter'
        }
        , {
            name: '13.1-   Políticas de seguridad de información',

            parent: 'manualpolitisi',
            start: today + 17.5 * day,
            start: today + 13 * day,
            end: today + 17 * day,
            owner: 'Peter'
        }, 
        {
            name: '13.2.- Organización de la seguridad de información',
            
            parent: 'manualpolitisi',
            start: today + 13 * day,
            end: today + 17 * day
        }
        , 
        {
            name: '13.3.- Seguridad en recursos humanos',
            
            parent: 'manualpolitisi',
            start: today + 13 * day,
            end: today + 17 * day
        }
        , 
        {
            name: '13.4.- Administración de activos',
            
            parent: 'manualpolitisi',
            start: today + 13 * day,
            end: today + 17 * day
        }
        , 
        {
            name: '13.5.- Control de acceso',
            
            parent: 'manualpolitisi',
            start: today + 13 * day,
            end: today + 17 * day
        }
        , 
        {
            name: '13.6.- Criptografía',
            
            parent: 'manualpolitisi',
            start: today + 13 * day,
            end: today + 17 * day
        }
        , 
        {
            name: '13.7.- Seguridad física y ambiental',
            
            parent: 'manualpolitisi',
            start: today + 13 * day,
            end: today + 17 * day
        }
        , 
        {
            name: '13.8.- Seguridad en operaciones',
            
            parent: 'manualpolitisi',
            start: today + 13 * day,
            end: today + 17 * day
        }
        , 
        {
            name: '13.9.- Seguridad en comunicaciones',
            
            parent: 'manualpolitisi',
            start: today + 13 * day,
            end: today + 17 * day
        }
        , {
            name: '14-  Adquisición, desarrollo y mantenimiento de sistemas',
           id: 'adquisicion',
            parent: 'id_operacion',
            start: today + 17.5 * day,
            start: today + 13 * day,
            end: today + 17 * day,
            owner: 'Peter'
        }
        , 
        {
            name: '14.1.- Relación con proveedores',
            
            parent: 'adquisicion',
            start: today + 13 * day,
            end: today + 17 * day
        }
        , 
        {
            name: '14.2.- Administración de incidentes de seguridad de la información',
            
            parent: 'adquisicion',
            start: today + 13 * day,
            end: today + 17 * day
        }
        , 
        {
            name: '14.3.- Aspectos de seguridad de la información en la administración de continuidad del negocio',
            parent: 'adquisicion',
            start: today + 13 * day,
            end: today + 17 * day
        }
        , 
        {
            name: '14.4.- Cumplimiento',
            
            parent: 'adquisicion',
            start: today + 13 * day,
            end: today + 17 * day
        }

        ]}
        , {
        name: 'EVALUACIÓN',
        data: [{
            name: 'EVALUACIÓN',
            id: 'id_Eva',
            owner: 'Peter'
        }, {
            name: '15.- Auditoría Interna',
            id: 'id_eva_aud',
            parent: 'id_Eva',
            start: today - day,
            end: today + (11 * day),
            completed: {
                amount: 0.6,
                fill: '#e80'
            },
            owner: 'Susan'
        }, {
            name: '15.1- Evaluación',
            dependency: 'id_eva_aud',
            parent: 'id_eva_aud',
            start: today + 12.5 * day,
            milestone: true,
            owner: 'Peter'
        }, {
            name: '15.2.- Reporte de Auditoría',
            dependency: 'id_eva_aud',
            parent: 'id_eva_aud',
            start: today + 13 * day,
            end: today + 17 * day
        }, {
            name: '15.3-  Consolidación de Información para la Revisión de la Dirección',
            dependency: 'id_eva_aud',
            parent: 'id_eva_aud',
            start: today + 17.5 * day,
            milestone: true,
            owner: 'Peter'
        }
        , {
            name: '16.- Revisión de la Dirección',
            id: 'id_revisiondir',
            parent: 'id_Eva',
            start: today + 13 * day,
            end: today + 17 * day
        }, {
            name: '16.1- Revisión de resultados de auditoría y desempeño del SGSI',
           
            parent: 'id_revisiondir',
            start: today + 17.5 * day,
            start: today + 13 * day,
            end: today + 17 * day,
            owner: 'Peter'
        }]
        
    },
    {
        name: 'MEJORA CONTINUA',
        data: [{
            name: 'MEJORA CONTINUA',
            id: 'id_mejora',
            owner: 'Peter'
        }, {
            name: '17.- Documentación de Acciones Correctivas y mejora',
            id: 'id_doc_acc',
            parent: 'id_mejora',
            start: today - day,
            end: today + (11 * day),
            completed: {
                amount: 0.6,
                fill: '#e80'
            },
            owner: 'Susan'
        }, {
            name: '17.1- Cierre de acciones de mejora',
            dependency: 'id_doc_acc',
            parent: 'id_doc_acc',
            start: today + 12.5 * day,
            start: today - day,
            end: today + (11 * day),
            owner: 'Peter'
        }, {
            name: '17.2.- Cierre de acciones correctivas de la Auditoria Interna y/o externa',
            dependency: 'id_doc_acc',
            parent: 'id_doc_acc',
            start: today + 13 * day,
            end: today + 17 * day
        }, {
            name: '17.3- Cierre de acciones correctivas derivadas de la Revisión de la Dirección',
            dependency: 'id_doc_acc',
            parent: 'id_doc_acc',
            start: today + 17.5 * day,
            start: today - day,
            end: today + (11 * day),
            owner: 'Peter'
        }]
        
    },
    
    ],
        
    
	

    tooltip: {
        pointFormatter: function () {
            var point = this,
                format = '%e. %b',
                options = point.options,
                completed = options.completed,
                amount = isObject(completed) ? completed.amount : completed,
                status = ((amount || 0) * 100) + '%',
                lines;

            lines = [{
                value: point.name,
                style: 'font-weight: bold;'
            }, {
                title: 'Start',
                value: dateFormat(format, point.start)
            }, {
                visible: !options.milestone,
                title: 'End',
                value: dateFormat(format, point.end)
            }, {
                title: 'Completed',
                value: status
            }, {
                title: 'Owner',
                value: options.owner || 'unassigned'
            }];

            return reduce(lines, function (str, line) {
                var s = '',
                    style = (
                        defined(line.style) ? line.style : 'font-size: 0.8em;'
                    );
                if (line.visible !== false) {
                    s = (
                        '<span style="' + style + '">' +
                        (defined(line.title) ? line.title + ': ' : '') +
                        (defined(line.value) ? line.value : '') +
                        '</span><br/>'
                    );
                }
                return str + s;
            }, '');
        }
    },
    title: {
        text: 'IMPLEMENTACIÓN DE ISO 27001'
    },
    yAxis: {
        uniqueNames: true
    },

    navigator: {
        enabled: true,
        liveRedraw: true,
        series: {
            type: 'gantt',
            pointPlacement: 0.5,
            pointPadding: 0.25
        },
        yAxis: {
            min: 0,
            max: 3,
            reversed: true,
            categories: []
        }
    },
    scrollbar: {
        enabled: true
    },
    rangeSelector: {
        enabled: true,
        selected: 0
    },
	
	///errr
	

	
	
	
	
});
exporting: {
        sourceWidth: 1000
    }

/* Add button handlers for add/remove tasks */

btnRemoveTask.onclick = function () {
    var points = chart.getSelectedPoints();
    each(points, function (point) {
        point.remove();
    });
};

btnShowDialog.onclick = function () {
    // Update dependency list
    var depInnerHTML = '<option value=""></option>';
    each(chart.series[0].points, function (point) {
        depInnerHTML += '<option value="' + point.id + '">' + point.name +
            ' </option>';
    });
    selectDependency.innerHTML = depInnerHTML;

    // Show dialog by removing "hidden" class
    addTaskDialog.className = 'overlay';
    isAddingTask = true;

    // Focus name field
    inputName.value = '';
    inputName.focus();
};

btnAddTask.onclick = function () {
    // Get values from dialog
    var series = chart.series[0],
        name = inputName.value,
        undef,
        dependency = chart.get(
            selectDependency.options[selectDependency.selectedIndex].value
        ),
        y = parseInt(
            selectDepartment.options[selectDepartment.selectedIndex].value,
            10
        ),
        maxEnd = reduce(series.points, function (acc, point) {
            return point.y === y && point.end ? Math.max(acc, point.end) : acc;
        }, 0),
        milestone = chkMilestone.checked || undef;

    // Empty category
    if (maxEnd === 0) {
        maxEnd = today;
    }

    // Add the point
    series.addPoint({
        start: maxEnd + (milestone ? day : 0),
        end: milestone ? undef : maxEnd + day,
        y: y,
        name: name,
        dependency: dependency ? dependency.id : undef,
        milestone: milestone
    });

    // Hide dialog
    addTaskDialog.className += ' hidden';
    isAddingTask = false;
};

btnCancelAddTask.onclick = function () {
    // Hide dialog
    addTaskDialog.className += ' hidden';
    isAddingTask = false;
};


		</script>

@endsection