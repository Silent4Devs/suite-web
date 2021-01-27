@extends('layouts.admin')
@section('content')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/gantt/modules/gantt.js"></script>
<script src="https://code.highcharts.com/gantt/modules/exporting.js"></script>
<script src="https://code.highcharts.com/gantt/modules/full-screen.js"></script>
<style type="text/css">

		</style>
<div class="card">
    <div class="card-header">

    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-12">
            <div id="containergantt"></div>
            </div>
            <div class="col-12">
                @include('admin.gantt.grap')
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
		Highcharts.setOptions({
    lang: {
            loading: 'Cargando...',
            start: 'Inicio',
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
    // Utility functions
    dateFormat = Highcharts.dateFormat,
    defined = Highcharts.defined,
    isObject = Highcharts.isObject,
    reduce = Highcharts.reduce;

// Set to 00:00:00:000 today
today.setUTCHours(0);
today.setUTCMinutes(0);
today.setUTCSeconds(0);
today.setUTCMilliseconds(0);
today = today.getTime();
var containerName = "containergantt";

(function (H) {
				 H.addEvent(H.Chart, 'load', function (e) {
					var chart = e.target;
					H.addEvent(chart.container, 'click', function (e) {

							var visibleRowsCount = 0, ganttHeight = 130;
							for(var tickIndex in chart.yAxis[0].ticks){
								if(tickIndex >= 0){
									visibleRowsCount++
								}
							}
							console.log("visibleRowsCount: " + visibleRowsCount);
							ganttHeight = (visibleRowsCount>0)?((visibleRowsCount*20) +120):ganttHeight;
							chart.setSize(null,ganttHeight);
							//chart.reflow();

					});



				});

			}(Highcharts));


// THE CHART
var gchart = Highcharts.ganttChart(containerName, {
		chart: {
    		animation: true,
    	 height:240
    },
    title: {
        text: 'IMPLEMENTACIÓN DE ISO 27001'
    },

    plotOptions: {

        series: {
            animation: {
            	complete: function(){

              	console.log("Elementi lvl2: " + document.getElementsByClassName("highcharts-treegrid-node-level-2").length);

              var visibleRowsCount = 0;
              var ganttHeight = this.plotHeight;
              visibleRowsCount = document.getElementsByClassName("highcharts-treegrid-node-level-2").length + 6; //phases always out
              gchart.reflow();
              ganttHeight = (visibleRowsCount>0)?((visibleRowsCount*20)+120):ganttHeight;
							gchart.setSize(null,ganttHeight);

						//	gchart.reflow();
              }
            },

            dataLabels: {
                enabled: true,
                format: '{point.label}',
                style: {
                   cursor: 'default',
                   pointerEvents: 'none'
                }
            },
        }
  },
  tooltip: {
        style: {
            color: 'black',
            fontWeight: 'bold'
        }
    },
    xAxis: [{
    labels: {
						events: {
            	click: function(){
              	alert("test")
              }
            }
          },
     tickInterval: day * 365,
			currentDateIndicator: {
            width: 4,
            dashStyle: 'dash',
            color: 'red',
            label: {
                format: 'Hoy %m-%d-%Y'
            }},
        type: 'datetime',
        dashStyle: 'dot',
        }],
    yAxis: {
    			labels: {

        },

        },

    series: [{

        name: 'Nombre:',
       borderColor: 'white',

        data: [
{id: 'Milestone7', name: 'Realizar levantamiento de información con formulario de estado actual', milestone: true,start: Date.UTC(2020, 1, 7), end: Date.UTC(2020, 1, 8), parent: 'Phase1', y: 32, rentedTo: 'Lisa Star',},
{id: 'MilestoneS', name: 'Evaluar tablero y presentar resultados a dirección', milestone: true,start: Date.UTC(2020, 5, 28), end: Date.UTC(2020, 5, 28), parent: 'Phase1', y: 19},
{id: 'Milestone2', name: ' Identificar brechas y esfuerzos', milestone: true,start: Date.UTC(2020, 6, 11), end: Date.UTC(2020, 6, 11), parent: 'Phase1', y: 27},
{id: 'Milestone1', name: 'Identificar el Contexto de la Organización', milestone: true,start: Date.UTC(2020, 6, 11), end: Date.UTC(2020, 6, 11), parent: 'Phase2', y: 26},
{id: 'MilestoneT', name: 'Entendimiento de las necesidades y expectativas de las partes interesadas', milestone: true,start: Date.UTC(2020, 12, 3), end: Date.UTC(2020, 12, 3), parent: 'Phase2', y: 20},
{id: 'MilestoneW', name: 'Manual del SGI', milestone: true,start: Date.UTC(2020, 10, 22), end: Date.UTC(2020, 10, 22), parent: 'Phase2', y: 23},
{id: 'Milestone5', name: 'Elaborar matriz FODA', milestone: true,start: Date.UTC(2020, 4, 19), end: Date.UTC(2020, 4, 19), parent: 'Phase2', y: 30},
{id: 'MilestoneU', name: ' Determinar Alcance del SGSI', milestone: true,start: Date.UTC(2020, 4, 20), end: Date.UTC(2020, 4, 20), parent: 'Phase2', y: 21},
{id: 'MilestoneV', name: '     Política de Seguridad de Información', milestone: true,start: Date.UTC(2020, 6, 24), end: Date.UTC(2020, 6, 24), parent: 'Phase2', y: 22},
{id: 'MilestoneX', name: '     Objetivos del SGSI', milestone: true,start: Date.UTC(2020, 6, 24), end: Date.UTC(2020, 6, 24), parent: 'Phase2', y: 24},
{id: 'Milestone4', name: 'Análisis y Evaluación de Riesgos', milestone: true,start: Date.UTC(2020, 11, 17), end: Date.UTC(2020, 11, 17), parent: 'Phase2', y: 29},
{id: 'MilestoneY', name: 'Inventario de activos de Información', milestone: true,start: Date.UTC(2020, 2, 22), end: Date.UTC(2020, 2, 22), parent: 'Phase2', y: 25},
{id: 'MilestoneQ', name: 'Evaluación y valoración del Riesgo', milestone: true,start: Date.UTC(2020, 8, 29), end: Date.UTC(2020, 8, 29), parent: 'Phase2', y: 17},
{id: 'MilestoneE', name: '     Plan de Tratamiento de Riesgos conforme a los controles de seguridad', milestone: true,start: Date.UTC(2020, 1, 11), end: Date.UTC(2020, 1, 11), parent: 'Phase2', y: 5},
{id: 'MilestoneR', name: 'Declaración de aplicabilidad SoA', milestone: true,start: Date.UTC(2020, 3, 13), end: Date.UTC(2020, 3, 13), parent: 'Phase2', y: 18},
{id: 'MilestoneA', name: 'Compromiso de la Alta Dirección', milestone: true,start: Date.UTC(2020, 5, 31), end: Date.UTC(2020, 5, 31), parent: 'Phase3', y: 1},
{id: 'MilestoneM', name: 'Asignación de Recursos', milestone: true,start: Date.UTC(2020, 9, 26), end: Date.UTC(2020, 9, 26), parent: 'Phase3', y: 13},
{id: 'MilestoneB', name: 'Conformar el Comité de Seguridad', milestone: true,start: Date.UTC(2020, 11, 30), end: Date.UTC(2020, 11, 30), parent: 'Phase3', y: 2},
{id: 'MilestoneN', name: ' Elaborar matriz de roles y responsabilidades', milestone: true,start: Date.UTC(2020, 1, 17), end: Date.UTC(2020, 1, 17), parent: 'Phase3', y: 14},
{id: 'MilestoneJ', name: 'Competencias y capacitación', milestone: true,start: Date.UTC(2020, 11, 5), end: Date.UTC(2020, 11, 5), parent: 'Phase3', y: 10},
{id: 'MilestoneO', name: 'Descripciones de puesto', milestone: true,start: Date.UTC(2020, 9, 28), end: Date.UTC(2020, 9, 28), parent: 'Phase3', y: 15},
{id: 'MilestoneK', name: ' Control de capacitación del personal', milestone: true,start: Date.UTC(2021, 3, 31), end: Date.UTC(2021, 3, 31), parent: 'Phase3', y: 11},
{id: 'MilestoneC', name: 'Comunicación del SGSI', milestone: true,start: Date.UTC(2022, 11, 4), end: Date.UTC(2022, 11, 4), parent: 'Phase3', y: 3},
{id: 'MilestoneF', name: 'Procesos de gestión', milestone: true,start: Date.UTC(2020, 4, 10), end: Date.UTC(2020, 4, 10), parent: 'Phase4', y: 6},
{id: 'MilestoneH', name: ' Información documentada', milestone: true,start: Date.UTC(2020, 2, 9), end: Date.UTC(2020, 2, 9), parent: 'Phase4', y: 8},
{id: 'MilestoneI', name: 'Acciones correctivas', milestone: true,start: Date.UTC(2020, 3, 16), end: Date.UTC(2020, 3, 16), parent: 'Phase4', y: 9},
{id: 'MilestoneG', name: 'Auditoria interna', milestone: true,start: Date.UTC(2020, 8, 27), end: Date.UTC(2020, 8, 27), parent: 'Phase4', y: 7},
{id: 'MilestoneP', name: ' Gestión de incidentes de seguridad de la información', milestone: true,start: Date.UTC(2020, 3, 17), end: Date.UTC(2020, 3, 17), parent: 'Phase4', y: 16},
{id: 'MilestoneL', name: 'Manual de Políticas de seguridad de la información', milestone: true,start: Date.UTC(2020, 12, 4), end: Date.UTC(2020, 12, 4), parent: 'Phase4', y: 12},
{id: 'MilestoneD', name: 'A.5 Políticas de seguridad de información', milestone: true,start: Date.UTC(2022, 1, 23), end: Date.UTC(2022, 1, 23), parent: 'Phase4', y: 4},
{id: 'Milestone9', name: 'A.6 Organización de la seguridad de información', milestone: true,start: Date.UTC(2022, 1, 23), end: Date.UTC(2022, 1, 23), parent: 'Phase4', y: 34},
{id: 'Milestone6', name: ' A.7 Seguridad en recursos humanos', milestone: true,start: Date.UTC(2022, 2, 25), end: Date.UTC(2022, 2, 25), parent: 'Phase4', y: 31},
{id: 'Milestone8', name: 'A.8 Administración de activos', milestone: true,start: Date.UTC(2022, 5, 12), end: Date.UTC(2022, 5, 12), parent: 'Phase4', y: 33},
{id: 'Milestone99', name: ' A.9 Control de acceso', milestone: true,start: Date.UTC(2022, 5, 12), end: Date.UTC(2022, 5, 12), parent: 'Phase4', y: 33},
{id: 'Milestone10', name: 'A.10 Criptografía', milestone: true,start: Date.UTC(2022, 5, 12), end: Date.UTC(2022, 5, 12), parent: 'Phase4', y: 33},
{id: 'Milestone11', name: ' A.11 Seguridad física y ambiental', milestone: true,start: Date.UTC(2022, 5, 12), end: Date.UTC(2022, 5, 12), parent: 'Phase4', y: 33},
{id: 'Milestone12', name: ' A.12 Seguridad en operaciones', milestone: true,start: Date.UTC(2022, 5, 12), end: Date.UTC(2022, 5, 12), parent: 'Phase4', y: 33},
{id: 'Milestone13', name: '    A.13 Seguridad en comunicaciones', milestone: true,start: Date.UTC(2022, 5, 12), end: Date.UTC(2022, 5, 12), parent: 'Phase4', y: 33},
{id: 'Milestone14', name: '   A.14 Adquisición, desarrollo y mantenimiento de sistemas', milestone: true,start: Date.UTC(2022, 5, 12), end: Date.UTC(2022, 5, 12), parent: 'Phase4', y: 33},
{id: 'Milestone15', name: ' A.15 Relación con proveedores', milestone: true,start: Date.UTC(2022, 5, 12), end: Date.UTC(2022, 5, 12), parent: 'Phase4', y: 33},
{id: 'Milestone16', name: 'A.16 Administración de incidentes de seguridad de la información', milestone: true,start: Date.UTC(2022, 5, 12), end: Date.UTC(2022, 5, 12), parent: 'Phase4', y: 33},
{id: 'Milestone17', name: 'A.17 Aspectos de seguridad de la información en la administración de continuidad del negocio', milestone: true,start: Date.UTC(2022, 5, 12), end: Date.UTC(2022, 5, 12), parent: 'Phase4', y: 33},
{id: 'Milestone18', name: 'A.18 Cumplimiento', milestone: true,start: Date.UTC(2022, 5, 12), end: Date.UTC(2022, 5, 12), parent: 'Phase4', y: 33},
{id: 'Milestone19', name: 'Auditoría Interna', milestone: true,start: Date.UTC(2022, 5, 12), end: Date.UTC(2022, 5, 12), parent: 'Phase5', y: 33},
{id: 'Milestone20', name: 'Evaluación', milestone: true,start: Date.UTC(2022, 5, 12), end: Date.UTC(2022, 5, 12), parent: 'Phase5', y: 33},
{id: 'Milestone21', name: 'Reporte de Auditoría', milestone: true,start: Date.UTC(2022, 5, 12), end: Date.UTC(2022, 5, 12), parent: 'Phase5', y: 33},
{id: 'Milestone22', name: 'Consolidación de Información para la Revisión de la Dirección', milestone: true,start: Date.UTC(2022, 5, 12), end: Date.UTC(2022, 5, 12), parent: 'Phase5', y: 33},
{id: 'Milestone23', name: 'Revisión de la Dirección', milestone: true,start: Date.UTC(2022, 5, 12), end: Date.UTC(2022, 5, 12), parent: 'Phase5', y: 33},
{id: 'Milestone24', name: 'Revisión de resultados de auditoría y desempeño del SGSI', milestone: true,start: Date.UTC(2022, 5, 12), end: Date.UTC(2022, 5, 12), parent: 'Phase5', y: 33},
{id: 'Milestone25', name: 'Documentación de Acciones Correctivas y mejora', milestone: true,start: Date.UTC(2022, 5, 12), end: Date.UTC(2022, 5, 12), parent: 'Phase6', y: 33},
{id: 'Milestone26', name: 'Cierre de acciones de mejora', milestone: true,start: Date.UTC(2022, 5, 12), end: Date.UTC(2022, 5, 12), parent: 'Phase6', y: 33},
{id: 'Milestone27', name: 'Cierre de acciones correctivas de la Auditoria Interna y/o externa', milestone: true,start: Date.UTC(2022, 5, 12), end: Date.UTC(2022, 5, 12), parent: 'Phase6', y: 33},
{id: 'Milestone28', name: 'Cierre de acciones correctivas derivadas de la Revisión de la Dirección', milestone: true,start: Date.UTC(2022, 5, 12), end: Date.UTC(2022, 5, 12), parent: 'Phase6', y: 33},
{id: 'Phase1',
name: 'ANALISIS INICIAL',
start: Date.UTC(2020, 1, 7),
end: Date.UTC(2020, 6, 11),
color: '#A9DFBF',
y: 1, collapsed: true},
{id: 'Phase2',
name: 'PLANEACIÓN',
start: Date.UTC(2020, 6, 24),
end: Date.UTC(2020, 4, 19),
color: '#D2B4DE',
dependency: 'Phase1',
y: 2, collapsed: true},
{id: 'Phase3',
name: 'SOPORTE',
start: Date.UTC(2020, 4, 19),
end: Date.UTC(2020, 11, 5),
color: '#F8C471',
dependency: 'Phase2',
y: 3, collapsed: true},
{id: 'Phase4',
name: 'OPERACIÓN DE SGSI',
start: Date.UTC(2020, 4, 10),
end: Date.UTC(2022, 11, 4),
color: '#F5CBA7',
dependency: 'Phase3',
y: 4, collapsed: true},
{id: 'Phase5',
name: 'EVALUACIÓN',
start: Date.UTC(2020, 8, 27),
end: Date.UTC(2022, 5, 12),
color: '#AED6F1',
dependency: 'Phase4',
y: 5, collapsed: true},
{id: 'Phase6',
name: 'MEJORA CONTINUA',
start: Date.UTC(2020, 4, 18),
end: Date.UTC(2020, 8, 27),
color: '#F5B7B1',
dependency: 'Phase5',
y: 6, collapsed: true},



       ],
    }]
});





		</script>

@endsection
