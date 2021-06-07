@extends('layouts.admin')
@section('content')

<style>
    html{
        scroll-behavior: smooth;
    }

    .caja_graficas, .caja_table{
        margin: 10px;
        padding: 20px;
        box-shadow: 0px 4px 10px 1px rgba(0,0,0,0.12);
    }
    .caja_graficas h5, .caja_table h5{
        width: 100%;
        height: 40px;
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

    .card_info{
        position: relative;
        padding: 0;
        margin: 10px;
        box-shadow: 0px 4px 10px 1px rgba(0,0,0,0.12);
        height: 100px;
    }
    .card_info div{
        position: absolute;
        top: 15px;
        left: 20px;
        width: 70px;
        height: 70px;
        border-radius: 100px;
        background-color: rgba(255, 255, 255, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .card_info i{
        font-size: 25pt;
        color: #fff;
    }
    .card_info h6{
        position: absolute;
        font-size: 16pt;
        color: #fff;
        top: 20px;
        left: 120px;
        font-weight: bolder;
    }
    .card_info span{
        position: absolute;
        color: #fff;
        font-size: 16pt;
        top: 50px;
        left: 120px;
    }


    body.c-dark-theme .caja_graficas h5{
        box-shadow: 0px 3px 7px -1px rgba(0,0,0,0.3);
    } 



    .menu_a{
        width: 100%;
        background-color: #1a84cd;
        height: 40px;
        position: sticky;
        top: 56px;
        z-index: 9;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
        opacity: 0.5;
        transition: 0.1s;
        border-bottom-right-radius: 6px;
        border-bottom-left-radius: 6px;
    }
    .menu_a:hover{
        opacity: 1;
    }

    .menu_a a{
        width: 200px;
        height: 30px;
        background-color: #fff;
        margin: 10px;
        color: #fff;
        font-size: 15pt;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgba(0,0,0,0.2);
        border-radius: 6px;
        transition: 0.1s;
    }
    .menu_a a:hover{
        text-decoration: none;
        background-color: rgba(0,0,0,0.5);
    }

    section:target{
        padding-top: 100px;
        margin-top: -100px;
    }



    @media(max-width: 1131px){
        .caja_graficas{
            width: calc(50% - 20px) !important;
        }
    }

    @media(max-width: 780px){
        .caja_graficas{
            width: 100% !important;
        }
    }

    @media(max-width: 600px){
        .especificaciones{
            margin-top: 60px;
        }
    }
    
</style>
<div class="content">

    <div class="menu_a">
        <a href="#iso27001">ISO 27001</a>
        <a href="#capacitaciones">Capacitaciones</a>
    </div>


    <section id="iso27001">
        <div class="row">

            <h3 style="margin-bottom: -30px; color: #888; margin-left: 1%;">Dashboard ISO 27001</h3>
            <div class="especificaciones col-12 text-right">

                <label>Plan <i class="fas fa-square iconos_espec" style="color: #3D72A1;"></i></label>
                <label>Do <i class="fas fa-square iconos_espec" style="color: #A13D86;"></i></label>
                <label>Check <i class="fas fa-square iconos_espec" style="color: #DBA82D;"></i></label>
                <label>Act <i class="fas fa-square iconos_espec" style="color: #2DB7DB;"></i></label>
                
            </div>
            <div class="card caja_graficas graf_1" style="width: calc(33.33% - 20px);">
                <h5 class="plan">Progreso General del Plan</h5>
                <canvas id="chartActividades"></canvas>
                <a id="a_plan" class="btn_ver" href="admin/implementacions#plan-just">
                    Ver Detalle 
                </a>

            </div>
            <div class="card caja_graficas graf_2" style="width: calc(33.33% - 20px);">
                <h5 class="espec">Documentación</h5>
                @if(!empty($exist_doc))
                    <style type="text/css">
                        .chartDocu{
                            display: block;
                        }
                        .chartDocu_falsa{
                            display: none;
                        }
                    </style>
                @else
                    <style type="text/css">
                        .chartDocu{
                            display: none;
                        }
                        .chartDocu_falsa{
                            display: block;
                        }
                    </style>
                @endif
                
                <div class="chartDocu"><canvas id="chartDocu"></canvas></div>
                <div class="chartDocu_falsa"><canvas id="chartDocu_falsa"></canvas></div>

                <div style="display: inline-flex; justify-content: center;">
                    <a id="" class="btn_ver" style="margin-left: 0;" href="admin/carpeta">
                        Carpetas
                    </a>
                    <a id="" class="btn_ver" style="margin-left: 5px;" href="admin/control-documentos">
                        Lista de documentos
                    </a>
                </div>
            </div>
            <div class="card caja_graficas graf_3" style="width: calc(33.33% - 20px);">
                <h5 class="espec">Capacitación</h5>
                <canvas id="chartCapaci"></canvas>
                <a id="a_plan" class="btn_ver" href="admin/recursos">
                    Ver Detalle 
                </a>
            </div>
            <div class="card caja_graficas graf_4" style="width: calc(50% - 20px);">
                <h5 class="check">Incidentes de Seguridad</h5>
                <canvas id="incidentechart"></canvas>
                <a id="a_plan" class="btn_ver" href="admin/incidentes-de-seguridads">
                    Ver Detalle 
                </a>
            </div>
            <div class="card caja_graficas graf_5" style="width: calc(50% - 20px);">
                <h5 class="act">Auditorias</h5>
                <canvas id="chartAuditoria"></canvas>
                <a id="a_plan" class="btn_ver" href="admin/auditoria-anuals">
                    Ver Detalle 
                </a>
            </div>
            <div class="card caja_graficas graf_6" style="width: calc(50% - 20px);">
                <h5 class="act">Registro de Acciones</h5>
                <canvas id="myChart"></canvas>
                <div style="display: inline-flex; justify-content: center;">
                    <a id="" class="btn_ver" style="margin-left: 0;" href="admin/accion-correctivas">
                        Ver Detalle 
                    </a>
                    <a id="" class="btn_ver" style="margin-left: 5px;" href="admin/registromejoras">
                        Ver Detalle 
                    </a>
                </div>
            </div>
        </div><!--row-->
    </section> {{-- seccion --}}



    <section id="capacitaciones" class="mt-5">
        <div class="row">
            <h3 style="margin-bottom: -30px; color: #888; margin-left: 1%;">Capacitaciones</h3>

            <div class="especificaciones col-12 text-right">
                <label>Plan <i class="fas fa-square iconos_espec" style="color: #3D72A1;"></i></label>
                <label>Do <i class="fas fa-square iconos_espec" style="color: #A13D86;"></i></label>
                <label>Check <i class="fas fa-square iconos_espec" style="color: #DBA82D;"></i></label>
                <label>Act <i class="fas fa-square iconos_espec" style="color: #2DB7DB;"></i></label>
            </div>
            
            <div class="col-12">
                <div class="card caja_table" style="width: 100%;">
                    <h5 class="espec">Total de capacitaciones</h5>
                    <table id="table_total_capaci" class="table col-12 w-100">
                        <thead>
                            <tr>
                                <th>thead1</th>
                                <th>thead1</th>
                                <th>thead1</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Info cled 1</td>
                                <td>Info cled 1</td>
                                <td>Info cled 1</td>
                            </tr>
                            <tr>
                                <td>Info cled 1</td>
                                <td>Info cled 1</td>
                                <td>Info cled 1</td>
                            </tr>
                            <tr>
                                <td>Info cled 1</td>
                                <td>Info cled 1</td>
                                <td>Info cled 1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card card_info" style="width: calc(33.33% - 20px); background: #307ab4;">
                <div><i class="fas fa-calendar-alt"></i></div>
                <h6> Fecha de curso</h6>
                <span>info</span>
            </div>
            <div class="card card_info" style="width: calc(33.33% - 20px); background: #a634b4;">
                <div><i class="fas fa-chalkboard-teacher"></i></div>
                <h6> Instructor:</h6>
                <span>info</span>
            </div>
            <div class="card card_info" style="width: calc(33.33% - 20px); background: #1dcd1a;">
                <div><i class="fas fa-user-graduate"></i></div>
                <h6> Total de alumnos:</h6>
                <span>info</span>
            </div>

            <div class="card caja_graficas graf_3" style="width: calc(50% - 20px);">
                <h5 class="espec">Alumnos</h5>
                <canvas id="chart_alumnos_capaci"></canvas>
                <a id="a_plan" class="btn_ver" href="admin/recursos">
                    Ver Detalle 
                </a>
            </div>

            <div class="card caja_graficas graf_3" style="width: calc(50% - 20px);">
                <h5 class="espec">Aprovados</h5>
                <canvas id="chart_alumnos_aprovados"></canvas>
                <a id="a_plan" class="btn_ver" href="admin/recursos">
                    Ver Detalle 
                </a>
            </div>
        </div>
    </section>
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
                            'rgba(231, 76, 60, 0.6)',
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
                        backgroundColor: 'rgba(22, 160, 133, 0.6)',
                        borderWidth: 0,
                        borderColor: 'transparent',
                        pointBorderWidth: 0,
                        pointRadius: 5.5,
                        pointBackgroundColor: 'transparent',
                        pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
                    },
                ]
            },
            options: {
            responsive: true,
            legend: {
                display: true,
                position: 'right',
                labels: {
                    fontColor: "black",
                    boxWidth: 20,
                    padding: 8
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
                responsive: true,
                legend: {
                    display: true,
                    position: 'right',
                    labels: {
                        fontColor: "black",
                        boxWidth: 20,
                        padding: 8,
                    }
                },
                tooltips: {
                    mode: 'label',
                },
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
        },
        options: {
            responsive: true,
            legend: {
                display: true,
                position: 'right',
                labels: {
                    fontColor: "black",
                    boxWidth: 20,
                    padding: 8
                }
            },
            tooltips: {
            mode: 'label'
        },
        
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
                    'rgba(43, 65, 233 , 0.6)', 
                    'rgba(244, 208, 63, 0.6)',  
                    'rgba(133, 193, 233 , 0.6)', 
                    'rgba(231, 76, 60, 0.6)',
                ]
            }]
        },
        options: {
            responsive: true,
            legend: {
                display: true,
                position: 'right',
                labels: {
                    fontColor: "black",
                    boxWidth: 20,
                    padding: 8
                }
            },
            tooltips: {
            mode: 'label'
        },
        
        }
    });


    var canvasdoc = document.getElementById("chartDocu_falsa");
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
                data: [0,0,0,0,1,],
                backgroundColor: [
                    'rgba(22, 160, 133, 0.6)',
                    'rgba(43, 65, 233 , 0.6)', 
                    'rgba(244, 208, 63, 0.6)',  
                    'rgba(133, 193, 233 , 0.6)', 
                    'rgba(231, 76, 60, 0.6)',
                ]
            }]
        },
        options: {
            responsive: true,
            legend: {
                display: true,
                position: 'right',
                labels: {
                    fontColor: "black",
                    boxWidth: 20,
                    padding: 8
                }
            },
            tooltips: {
            mode: 'label'
        },
        
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
                    
                    'rgba(133, 193, 233 , 0.6)',
                    'rgba(244, 208, 63, 0.6)',
                    'rgba(22, 160, 133, 0.6)',
                    'rgba(231, 76, 60, 0.6)'
                ]
            },]
        },
        options: {
            responsive: true,
            legend: {
                display: true,
                position: 'right',
                labels: {
                    fontColor: "black",
                    boxWidth: 20,
                    padding: 8,
                }
            },
            tooltips: {
                mode: 'label',
            },
        }
    });

    var popCanvas2 = document.getElementById("chartAuditoria").getContext('2d');
    var barAudit = new Chart(popCanvas2, {
        type: 'bar',
        labels: {
            render: 'value'
        },
        data: {
            labels: [   
                "Interna", 
                "Externa"
            ],
            datasets: [{
                label: 'Tipo de auditoria',
                data: [{!!$auditinterna!!}, {!!$auditexterna!!}],
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                ]
            },]
        },

        options: {
            responsive: true,
            legend: {
                display: true,
                position: 'right',
                labels: {
                    fontColor: "black",
                    boxWidth: 20,
                    padding: 8,
                }
            },
            tooltips: {
                mode: 'label',
            },
        }


    });


    var canvasdoc = document.getElementById("chart_alumnos_capaci");
    var pieDoc = new Chart(canvasdoc, {
        type: 'bar',
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
                data: [0,0,0,0,1,],
                backgroundColor: [
                    'rgba(22, 160, 133, 0.6)',
                    'rgba(43, 65, 233 , 0.6)', 
                    'rgba(244, 208, 63, 0.6)',  
                    'rgba(133, 193, 233 , 0.6)', 
                    'rgba(231, 76, 60, 0.6)',
                ]
            }]
        },
        options: {
            responsive: true,
            legend: {
                display: true,
                position: 'right',
                labels: {
                    fontColor: "black",
                    boxWidth: 20,
                    padding: 8
                }
            },
            tooltips: {
            mode: 'label'
        },
        
        }
    });

    var canvasdoc = document.getElementById("chart_alumnos_aprovados");
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
                data: [0,0,0,0,1,],
                backgroundColor: [
                    'rgba(22, 160, 133, 0.6)',
                    'rgba(43, 65, 233 , 0.6)', 
                    'rgba(244, 208, 63, 0.6)',  
                    'rgba(133, 193, 233 , 0.6)', 
                    'rgba(231, 76, 60, 0.6)',
                ]
            }]
        },
        options: {
            responsive: true,
            legend: {
                display: true,
                position: 'right',
                labels: {
                    fontColor: "black",
                    boxWidth: 20,
                    padding: 8
                }
            },
            tooltips: {
            mode: 'label'
        },
        
        }
    });

</script>




@endsection

@section('scripts')

    <script>
        $(document).ready(function(){
            $("#table_total_capaci").DataTable({
                buttons: []
            });
        });


    </script>

{{-- <script>
        $(document).ready(function() {
            $('#table_total_capaci').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            });
        });

    </script> --}}
@endsection
