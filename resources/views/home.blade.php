@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-5">
                <div class="col-md-12 col-sm-9 py-3 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
                    <h3 class="mb-2  text-center text-white"><strong>Tablero de Control</strong></h3>
                </div>
              
                <div class="container">
                    <div class="row align-items-start">
                        <div class="col-md-12 col-sm-6 py-1 card card-body bg-info align-self-center">
                            <h3 class="mb-2  text-center text-white"><strong>Plan</strong></h3>
                        </div>
                        <div class="col-12 align-self-center">
                        <h3>Progreso general del plan</h3>
                        <canvas id="chartActividades"></canvas>
                        <div class="col-lg-12">
                        <a class="btn float-sm-right" style="background-color:#048c74;color:white;" href="admin/implementacions#plan-just">
                              VER PLAN >>
            </a>
           
        </div>
                        </div>
                        <div class="row">
                        </div>
                    </div>
                </div>
                <div class="row nogap">
       <div class="text-center col-md-6"><p>&nbsp;</p></div>
       
</div>
                <div class="container ">
                    <div class="row align-items-start">
                        <div class="col-md-12 col-sm-6 py-1 card card-body bg-info align-self-center">
                            <h3 class="mb-2  text-center text-white"><strong>Do</strong></h3>
                        </div>
                        <div class="col-4">
                        <h3>Documentación</h3>
                        <canvas id="chartDocu" width="350" height="450"></canvas>
                        <div class="col-lg-12">
                        <a class="btn float-sm-right" style="background-color:#048c74;color:white;" href="admin/carpeta">
                              VER DETALLE >>
                        </a>
                         </div>
                        </div>
                        <div class="col-4">
                        <h3>Capacitación</h3>
                        <canvas id="chartCapaci" width="350" height="450"></canvas>
                        <div class="col-lg-12">
                        <a class="btn float-sm-right" style="background-color:#048c74;color:white;" href="admin/recursos">
                              VER DETALLE >>
                        </a>
                         </div>
                        </div>
                        <div class="col-4">
                        <h3>Incidentes de seguridad</h3>
                        <canvas id="incidentechart" width="350" height="450"></canvas>
                        <div class="col-lg-12">
                        <a class="btn float-sm-right" style="background-color:#048c74;color:white;" href="admin/incidentes-de-seguridads">
                              VER DETALLE >>
                        </a>
                         </div>
                        </div>
                    </div>
                </div>
                <div class="row nogap">
       <div class="text-center col-md-6"><p>&nbsp;</p></div>
       
</div>
                <div class="col-12" style="margin-top:20px; ">
                    <div class="card-body">
                        <div class="row">
                          
                                <div class="col-md-12 col-sm-6 py-1 card card-body bg-info align-self-center " style="margin-top:-40px; ">
                                    <h3 class="mb-2  text-center text-white"><strong>Check</strong></h3>
                                </div>
                                <div class="col-12 align-self-center">
                            <canvas id="chartAuditoria" width="350" height="100"></canvas>
                        </div>
                          

                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row align-items-start">
                        <div class="col-md-12 col-sm-6 py-1 card card-body bg-info align-self-center">
                            <h3 class="mb-2  text-center text-white"><strong>Act</strong></h3>
                        </div>
                        <div class="col-4">
                            <div class="text-value">{{ number_format($settings5['total_number']) }}</div>
                            <div>{{ $settings5['chart_title'] }}</div>
                            <br />
                            <div class="text-value">{{ number_format($settings6['total_number']) }}</div>
                            <div>{{ $settings6['chart_title'] }}</div>
                            <br />
                        </div>
                        <div class="col-8">
                            <canvas id="myChart" width="350" height="350"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://unpkg.com/gauge-chart@latest/dist/bundle.js"></script>
<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js">
</script>{!! $chart1->renderJs() !!}{!! $chart2->renderJs() !!}{!! $chart3->renderJs() !!}{!! $chart4->renderJs() !!}
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
                legend: {
                    display: true
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: true,
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1,
                            callback: function(value, index, values) {
                                return value;
                            }
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false,
                            tickMarkLength: 15,
                        }
                    }]
                },
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