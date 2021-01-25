@extends('layouts.admin')
@section('content')

<style>
    .caja_graficas{
        width: calc(33% - 20px);
        margin: 10px;
        padding: 20px;
        box-shadow: 0px 4px 10px 1px rgba(0,0,0,0.12);
    }
    .caja_graficas h5{
        width: 100%;
        height: 30px;
        color: #fff;
        box-shadow: 0px 3px 5px 1px #888;
        margin-bottom: 25px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 7px;
    }
    .caja_graficas a{
        width: 150px;
        height: 30px;
        background: #459e9e;
        margin-top: 30px;
        border-radius: 6px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        text-decoration: none;
        opacity: 0.8;
        transition: 0.1s;
        margin-left: calc(100% - 150px);
        box-shadow: 0px 4px 10px 1px rgba(0,0,0,0.3);
    }
    .caja_graficas a:hover{
        opacity: 1;
        box-shadow: 0px 4px 10px 1px rgba(0,0,0,0.2);
    } 
    .especificaciones .iconos_espec{
        font-size: 15pt;
    }
    .especificaciones label{
        font-size: 12pt;
        margin-left: 20px;
        color: #888;
    }
    .espec{
        background-color: #A13D86;
    }
    .plan{
        background-color: #3D72A1;
    }
    .check{
        background-color: #DBA82D;
    }
    .act{
        background-color: #2DB7DB;
    }


    body.c-dark-theme .caja_graficas h5{
        box-shadow: 0px 3px 5px 1px rgba(0,0,0,0.5);
    } 
</style>
<div class="content">
    <div class="row">

        <h3 style="margin-bottom: -30px; color: #888; margin-left: 1%;">Dashboard ISO 27001</h3>
        <div class="especificaciones col-12 text-right">

            <label>Plan <i class="fas fa-square iconos_espec" style="color: #3D72A1;"></i></label>
            <label>Do <i class="fas fa-square iconos_espec" style="color: #A13D86;"></i></label>
            <label>Check <i class="fas fa-square iconos_espec" style="color: #DBA82D;"></i></label>
            <label>Act <i class="fas fa-square iconos_espec" style="color: #2DB7DB;"></i></label>
            
        </div>
        <div class="card caja_graficas">
            <h5 class="plan">Progreso General del Plan</h5>
            <canvas id="chartActividades"></canvas>
            <a id="a_plan" class="btn_ver" href="admin/implementacions#plan-just">
                Ver Detalle 
            </a>

        </div>
        <div class="card caja_graficas">
            <h5 class="espec">Documentación</h5>
            <canvas id="chartDocu"></canvas>
            <a id="a_plan" class="btn_ver" href="admin/carpeta">
                Ver Detalle 
            </a>
        </div>
        <div class="card caja_graficas">
            <h5 class="espec">Capacitación</h5>
            <canvas id="chartCapaci"></canvas>
            <a id="a_plan" class="btn_ver" href="admin/recursos">
                Ver Detalle 
            </a>
        </div>
        <div class="card caja_graficas" style="width: 48%;">
            <h5 class="check">Incidentes de Seguridad</h5>
            <canvas id="incidentechart"></canvas>
            <a id="a_plan" class="btn_ver" href="admin/incidentes-de-seguridads">
                Ver Detalle 
            </a>
        </div>
        <div class="card caja_graficas" style="width: 48%;">
            <h5 class="act">Auditorias</h5>
            <canvas id="chartAuditoria"></canvas>
            <a id="a_plan" class="btn_ver" href="admin/auditoria-anuals">
                Ver Detalle 
            </a>
        </div>
        <div class="card caja_graficas" style="width: 100%;">
            <h5 class="act">Registro de Acciones</h5>
            <canvas id="myChart"></canvas>
            <div style="display: inline-flex; justify-content: center;">
                <a id="a_plan" class="btn_ver" style="margin-left: 0;" href="admin/accion-correctivas">
                    Ver Detalle 
                </a>
                <a id="a_plan" class="btn_ver" style="margin-left: 5px;" href="admin/registromejoras">
                    Ver Detalle 
                </a>
            </div>
        </div>
    </div><!--row-->
 </div><!--col-->


@endsection
@section('scripts')
@parent
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://unpkg.com/gauge-chart@latest/dist/bundle.js"></script>
<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js">
</script>{!! $chart1->renderJs() !!}{!! $chart2->renderJs() !!}{!! $chart3->renderJs() !!}{!! $chart4->renderJs() !!}

<script>

    const a_plan = document.querySelector('#a_plan');
    a_plan.addEventListener('click', () => {
        localStorage.setItem('tab_plan', 'true');
    });
</script>
<script>


        var ctx = document.getElementById("myChart").getContext('2d');
        var barChart2 = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Hallazgo'],
                datasets: [{
                        label: 'Acciones Correctivas',
                        data: [{!!$accionc!!}],
                        borderWidth: 2,
                        backgroundColor: [
                            'rgba(22, 160, 133, 0.6)',
                            'rgba(244, 208, 63, 0.6)',
                            'rgba(231, 76, 60, 0.6)',
                            'rgba(133, 193, 233 , 0.6)',
                        ],
                        borderWidth: 0,
                        borderColor: 'transparent',
                        pointBorderWidth: 0,
                        pointRadius: 5.5,
                        pointBackgroundColor: 'transparent',
                        pointHoverBackgroundColor: 'rgba(254,86,83,.8)',
                    },
                    {
                        label: 'Acciones de Mejora',
                        data: [{!!$registro!!}],
                        borderWidth: 2,
                        backgroundColor: 'rgba(231, 76, 60, 0.6)',
                        borderWidth: 0,
                        borderColor: 'transparent',
                        pointBorderWidth: 0,
                        pointRadius: 5.5,
                        pointBackgroundColor: 'transparent',
                        pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
                    }
                ]
            },
            options: {
            responsive: true,
            legend: {
                display: true,
                position: 'left',
                labels: {
                    fontColor: "black",
                    boxWidth: 20,
                    padding: 20
                }
            },
            tooltips: {
            mode: 'label'
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }],
            xAxes: [{
            gridLines: {
                offsetGridLines: true
            }
        }]
        }
        }
        });

        var ctx2 = document.getElementById("incidentechart").getContext('2d');
        var barChart3 = new Chart(ctx2, {
            type: 'horizontalBar',
            data: {
                labels: ['Estado'],
                datasets: [{
                        label: 'Cerrado',
                        data: [{!!$incidentescerrado!!}],
                        borderWidth: 2,
                        backgroundColor: 'rgba(22, 160, 133, 0.6)',
                        borderWidth: 0,
                        borderColor: 'transparent',
                        pointBorderWidth: 0,
                        pointRadius: 5.5,
                        pointBackgroundColor: 'transparent',
                        pointHoverBackgroundColor: 'rgba(254,86,83,.8)',
                    },
                    {
                        label: 'En curso',
                        data: [{!!$incidentescurso!!}],
                        borderWidth: 2,
                        backgroundColor: 'rgba(244, 208, 63, 0.6)',
                        borderWidth: 0,
                        borderColor: 'transparent',
                        pointBorderWidth: 0,
                        pointRadius: 5.5,
                        pointBackgroundColor: 'transparent',
                        pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
                    },
                    {
                        label: 'Asignado',
                        data: [{!!$incidentesasignado!!}],
                        borderWidth: 2,
                        backgroundColor: 'rgba(133, 193, 54 , 0.6)',
                        borderWidth: 0,
                        borderColor: 'transparent',
                        pointBorderWidth: 0,
                        pointRadius: 5.5,
                        pointBackgroundColor: 'transparent',
                        pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
                    },
                    {
                        label: 'Pendiente',
                        data: [{!!$incidentespendiente!!}],
                        borderWidth: 2,
                        backgroundColor: 'rgba(231, 76, 60, 0.6)',
                        borderWidth: 0,
                        borderColor: 'transparent',
                        pointBorderWidth: 0,

                        pointBackgroundColor: 'transparent',
                        pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
                    },
                    {
                        label: 'Cancelado',
                        data: [{!!$incidentescancelado!!}],
                        borderWidth: 2,
                        backgroundColor: 'rgba(54, 23, 60, 0.6)',
                        borderWidth: 0,
                        borderColor: 'transparent',
                        pointBorderWidth: 0,
                        pointRadius: 5.5,
                        pointBackgroundColor: 'transparent',
                        pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
                    },
                ]
            },
            options:  {
    "hover": {
					      "animationDuration": 0
					    },
					    "animation": {
					      "duration": 1,
					      "onComplete": function() {
					        var chartInstance = this.chart
					        ctx = chartInstance.ctx;
					        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
					        ctx.fillStyle = this.chart.config.options.defaultFontColor;
					        ctx.textAlign = 'left';
					        ctx.textBaseline = 'top';

					        this.data.datasets.forEach(function(dataset, i) {
					          var meta = chartInstance.controller.getDatasetMeta(i);
					          meta.data.forEach(function(bar, index) {
					            	var data = dataset.data[index];
					            	ctx.fillText(data, bar._model.x, bar._model.y - 5);
					          });
					        });
					      }
					    },

    }
        });

    var canvasccap = document.getElementById("chartCapaci");
    var pieCapacit = new Chart(canvasccap, {
        type: 'pie',
        labels: {
            render: 'value'
        },
        data: {
            labels: [
                "Capacitados",
                "No capacitados"
            ],
            datasets: [{
                label: '% Capacitacion',
                data: [10, 1],
                backgroundColor: [
                    'rgba(22, 160, 133, 0.6)',
                    'rgba(244, 208, 63, 0.6)',

                ]
            }]
        }
    });
    var canvasdoc = document.getElementById("chartDocu");
    var pieDoc = new Chart(canvasdoc, {
        type: 'pie',
        labels: {
            render: 'value'
        },
        data: {
            labels: [
                "Publicados",
                "Aprobados",
                "En revisión",
                "Elaborado",
                "No elaborado"
            ],
            datasets: [{
                label: '% Documentación',
                data: [{!!$documentoPubli!!},{!!$documentoAprob!!},{!!$documentorev!!},{!!$documentoElab!!},{!!$docunoelab!!},],
                backgroundColor: [
                    'rgba(22, 160, 133, 0.6)',
                    'rgba(244, 208, 63, 0.6)',
                    'rgba(231, 76, 60, 0.6)',
                    'rgba(133, 193, 233 , 0.6)',
                    'rgba(43, 65, 233 , 0.6)',

                ]
            }]
        }
    });

	var popCanvas1 = document.getElementById("chartActividades");
    var barChart1 = new Chart(popCanvas1, {
        type: 'doughnut',
        labels: {
            render: 'value'
        },
        data: {
            labels: [
                "Sin iniciar",
                "En proceso",
                "Completadas",
                "Retrasadas"
            ],
            datasets: [{
                label: '% Implementación por fase',
                data: [{!!$actividadsininici!!},{!!$actividadenproc!!},{!!$actividadcompl!!},{!!$actividadretr!!},],
                backgroundColor: [
                    'rgba(22, 160, 133, 0.6)',
                    'rgba(244, 208, 63, 0.6)',
                    'rgba(231, 76, 60, 0.6)',
                    'rgba(133, 193, 233 , 0.6)',
                ]
            }]
        }
    });

    var popCanvas2 = document.getElementById("chartAuditoria").getContext('2d');
    var barAudit = new Chart(popCanvas2, {
        type: 'bar',
        data: {
            labels: ["Interna", "Externa"],
            datasets: [{
                label: 'Tipo de auditoria',
                data: [{!!$auditinterna!!},{!!$auditexterna!!},],
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                ]
            }]

        },


    });

</script>
@endsection
