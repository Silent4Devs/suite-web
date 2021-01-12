@extends('layouts.admin')
@section('content')

<style>

.tablac-titulos{

 margin-top:-40px;
 height:45px;
 margin-left:250px;

}

.titulo_capacitacion{

background-color:#0B0C0B;
height:20px;
 width:300px;

}

.titulo_incidente{
  background-color:#0B0C0B;
  height:20px;
   width:300px;

}

	@media(max-width: 796px){
    .tablac-titulos{

      margin-left:150px;

    }

    .titulo_capacitacion{


     width:150px;

    }

    .titulo_incidente{

     width:160px;
     height: 30px;
     font-size:12px;
    }


  }
</style>
<div class="content">
    <div class="row">
        <div class="col-lg-12">

        <div class="card mt-5">
            <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center "
                 style="margin-top:-40px; ">
                <h3 class="mb-2  text-center text-white"><strong>Tablero de Control</strong></h3>
            </div>

          <div class="row">
              <div class="col-12">
                  <div class="card diseño-caja" style="margin-left:30px;margin-right:30px; margin-top:80px;">
                    <div class="card-body">

                        <div class="col-md-5 col-sm-5 py-3 card card-body bg-primary align-self-center tablac-titulos">
                            <h4 class="mb-2  text-center text-white" style="margin-top:-10px;"><strong>Plan</strong></h4>
                        </div>
                        <div class="col-12 align-self-center" style="background-color:#0B0C0B;height:20px;">
                        <h6 class="text-white text-center">PROGRESO GENERAL DEL PLAN</h6>
                        </div>

                        <div class="container">
                            <div class="row align-items-start">

                              <div class="col-lg-2 col-md-2 col-sm-2" style="margin-top:20px; " >
                              <a class="btn float-sm-right" style="background-color:#048c74;color:white;" href="admin/implementacions#plan-just">
                                    Ver Plan >>
                              </a>
                              </div>

                              <div class="col-lg-9 col-md-9 col-sm-9"  style="margin-top:20px; ">
                                <canvas id="chartActividades"></canvas>
                              </div>

                          </div>
                        </div>


                  </div>
                </div>
              </div>
            </div>

                <div class="row nogap">
                     <div class="text-center col-md-6"><p>&nbsp;</p></div>

                </div>

      <div class="row">
          <div class="col-12">
              <div class="card diseño-caja" style="margin-left:30px;margin-right:30px;">
                <div class="card-body">

                  <div class="col-md-5 col-sm-5 py-3 card card-body bg-primary align-self-center tablac-titulos ">
                      <h4 class="mb-2  text-center text-white" style="margin-top:-10px;"><strong>Do</strong></h4>
                  </div>
                      <div class="row">
                        <div class="col-4" style="background-color:#0B0C0B;height:20px;">
                          <h6 class="text-white text-center">DOCUMENTACIÓN</h6>
                        <canvas id="chartDocu" width="350" height="450"></canvas>
                        <div class="col-lg-12">
                        <a class="btn float-sm-right" style="background-color:#048c74;color:white;" href="admin/carpeta">
                              Ver Detalle >>
                        </a>
                         </div>
                        </div>
                        <div class="col-4" >
                            <h6  class="text-white text-center titulo_capacitacion">CAPACITACION</h6>

                        <canvas id="chartCapaci" width="350" height="450"></canvas>
                        <div class="col-lg-8">
                        <a class="btn float-sm-right" style="background-color:#048c74;color:white;" href="admin/recursos">
                              Ver Detalle >>
                        </a>
                         </div>
                        </div>
                        <div class="col-4" >
                        <h6  class="text-white text-center titulo_incidente">INCIDENTES DE SEGURIDAD</h6>
                        <canvas id="incidentechart" width="350" height="450"></canvas>
                        <div class="col-lg-12">
                        <a class="btn float-sm-right" style="background-color:#048c74;color:white;" href="admin/incidentes-de-seguridads">
                              Ver Detalle >>
                        </a>
                         </div>
                        </div>
                    </div>
                </div>
              </div>
          </div>
        </div>

                <div class="row nogap">
       <div class="text-center col-md-6"><p>&nbsp;</p></div>

</div>
        <div class="row">
            <div class="col-12">
                <div class="card diseño-caja" style="margin-left:30px;margin-right:30px;">
                  <div class="card-body">

                      <div class="col-md-5 col-sm-5 py-3 card card-body bg-primary align-self-center tablac-titulos">
                          <h4 class="mb-2  text-center text-white" style="margin-top:-10px;"><strong>Check</strong></h4>
                      </div>
                      <div class="container">
                          <div class="row align-items-start">

                            <div class="col-4  mb-4">
                                 <a class="btn" style="background-color:#048c74;color:white;" href="admin/auditoria-anuals">
                              Ver Detalle &nbsp;>>
                                </a>
                            </div>

                          <div class="col-7  mb-4">
                              <canvas id="chartAuditoria" ></canvas>
                          </div>

                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>




        <div class="row">
            <div class="col-12">
                <div class="card diseño-caja" style="margin-left:30px;margin-right:30px;margin-top:50px;">
                  <div class="card-body">

                    <div class="col-md-5 col-sm-5 py-3 card card-body bg-primary align-self-center tablac-titulos">
                        <h4 class="mb-2  text-center text-white" style="margin-top:-10px;"><strong>Act</strong></h4>
                    </div>

                    <div class="container">
                        <div class="row align-items-start">

                            <div class="col-4 text-left row">
                                <div class="text-value col-12 mb-4">{{ number_format($settings5['total_number']) }}
                                {{ $settings5['chart_title'] }}</div>
                                <br />
                                <div class="text-value col-12 mb-4">{{ number_format($settings6['total_number']) }}
                                {{ $settings6['chart_title'] }}</div>
                                <br />
                                <div class="col-12 text-left mb-4">
                                     <a class="btn" style="background-color:#048c74;color:white;" href="admin/accion-correctivas">
                                  Ver Acción Correctiva &nbsp;>>
                                    </a>
                             </div>
                             <div class="col-12 text-left mb-4">
                            <a class="btn" style="background-color:#048c74;color:white;" href="admin/registromejoras">
                                  Ver Registro de Mejora >>
                            </a>
                             </div>
                            </div>



                            <div class="col-8">
                                <canvas id="myChart" width="0" height="300px"></canvas>
                            </div>
                      </div>
                    </div>
                 </div>
              </div>
          </div>
        </div>
      </div><!--content-->
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
