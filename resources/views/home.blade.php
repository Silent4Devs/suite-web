@extends('layouts.admin')
@section('content')

<style>
    .caja_graficas{
        width: calc(33% - 20px);
        margin: 10px;
        padding: 20px;
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
        opacity: 0.7;
        transition: 0.1s;
        margin-left: calc(100% - 150px);
    }
    .caja_graficas a:hover{
        opacity: 1;
    }
</style>
<div class="content">
    <div class="row">
        <div class="card caja_graficas">
            <canvas id="chartActividades"></canvas>
            <a id="a_plan" class="btn_ver" href="admin/implementacions#plan-just">
                Ver Plan 
            </a>

        </div>
        <div class="card caja_graficas">
            <canvas id="chartDocu"></canvas>
            <a id="a_plan" class="btn_ver" href="admin/carpeta">
                Ver Plan 
            </a>
        </div>
        <div class="card caja_graficas">
            <canvas id="chartCapaci"></canvas>
            <a id="a_plan" class="btn_ver" href="admin/recursos">
                Ver Plan 
            </a>
        </div>
        <div class="card caja_graficas">
            <canvas id="incidentechart"></canvas>
            <a id="a_plan" class="btn_ver" href="admin/incidentes-de-seguridads">
                Ver Plan 
            </a>
        </div>
        <div class="card caja_graficas">
            <canvas id="chartAuditoria"></canvas>
            <a id="a_plan" class="btn_ver" href="admin/auditoria-anuals">
                Ver Plan 
            </a>
        </div>
        <div class="card caja_graficas">
            <canvas id="myChart"></canvas>
            <div style="display: inline-block;">
                <a id="a_plan" class="btn_ver" href="admin/accion-correctivas">
                    Ver Plan 
                </a>
                <a id="a_plan" class="btn_ver" href="admin/registromejoras">
                    Ver Plan 
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
