  <div class="mb-3 container-fluid">
      <div class="row">
          <div class="col-6">
              <h3 class="text-muted">Dashboard ISO 27001</h3>
          </div>
          <div class="col-6">
              <div class="text-right especificaciones">
                  <label>Plan <i class="fas fa-circle" style="color: #3D72A1; font-size: 13px"></i></label>
                  <label>Do <i class="fas fa-circle" style="color: #A13D86; font-size: 13px"></i></label>
                  <label>Check <i class="fas fa-circle" style="color: #DBA82D; font-size: 13px"></i></label>
                  <label>Act <i class="fas fa-circle" style="color: #2DB7DB; font-size: 13px"></i></label>
              </div>
          </div>
      </div>


      <div class="row">
          <div class="col-md-7">
              <div class="row">
                  <div class="pr-0 col-md-6 card_new">
                      <div class="p-3 mb-2 bg-white rounded row shadow-propia" style="margin-right: 10px;">
                          <div class="header">
                              <font class="circulo_iso_27001" style="
                                    width: 10px;
                                    height: 10px;
                                    background-color: #3D72A1;
                                    border-radius: 100%;
                                    position: absolute;
                                    top: 29px;
                                    left: 18px;
                                "></font>
                              <h5 class="ml-3" style="font-size: 16px">Plan Base ISO 27001</h5>
                          </div>
                          <canvas id="chartActividades"></canvas>
                          <a id="a_plan" class="btn_ver" href="/planTrabajoBase">
                              Ver Detalle
                          </a>
                      </div>
                  </div>


                  <div class="pr-0 col-md-6 card_new">
                    <div class="p-3 mb-2 bg-white rounded row shadow-propia" style="margin-right: 10px;">
                        <div class="header">
                            <font class="circulo_iso_27001" style="
                                  width: 10px;
                                  height: 10px;
                                  background-color: #A13D86;
                                  border-radius: 100%;
                                  position: absolute;
                                  top: 29px;
                                  left: 18px;
                              "></font>
                            <h5 class="ml-3" style="font-size: 16px">Documentación</h5>
                        </div>
                        <canvas id="chartDocu"></canvas>
                        <div style="display: inline-flex; justify-content: center;">
                            <a id="" class="btn_ver" style="margin-left: 0;" href="/carpeta">
                                Carpetas
                            </a>
                            <a id="" class="btn_ver" style="margin-left: 5px;" href="/control-documentos">
                                Lista de documentos
                            </a>
                        </div>
                    </div>
                </div>

                  {{-- <div class="pr-0 col-md-6 card_new">
                      <div class="p-3 mb-2 bg-white rounded row shadow-propia" style="margin-right: 10px;">
                          <div class="header">
                              <font class="circulo_iso_27001" style="
                                    width: 10px;
                                    height: 10px;
                                    background-color: #A13D86;
                                    border-radius: 100%;
                                    position: absolute;
                                    top: 29px;
                                    left: 18px;
                                "></font>
                              <h5 class="ml-3" style="font-size: 16px">Capacitación</h5>
                          </div>
                          <canvas id="chartCapaci"></canvas>
                          <a id="a_plan" class="btn_ver" href="/recursos">
                              Ver Detalle
                          </a>
                      </div>
                  </div>--}}
                  <div class="pr-0 col-md-12 card_new">
                      <div class="p-3 mb-2 bg-white rounded row shadow-propia" style="margin-right: 10px;">
                          <div class="header">
                              <font class="circulo_iso_27001" style="
                                    width: 10px;
                                    height: 10px;
                                    background-color: #A13D86;
                                    border-radius: 100%;
                                    position: absolute;
                                    top: 29px;
                                    left: 18px;
                                "></font>
                              <h5 class="ml-3" style="font-size: 16px">Indicadores SGSI</h5>
                          </div>
                          <canvas id="chartIndicadoresSGSI"></canvas>
                          <a id="a_plan" class="btn_ver" href="/indicadores-sgsis">
                              Ver Detalle
                          </a>
                      </div>
                  </div>

              </div>
          </div>
          <div class="col-md-5">
              <div class="row">
                  <div class="col-md-12 card_new">
                      <div class="p-3 mb-3 bg-white rounded row shadow-propia">
                          <div class="header">
                              <font class="circulo_iso_27001" style="
                                    width: 10px;
                                    height: 10px;
                                    background-color: #DBA82D;
                                    border-radius: 100%;
                                    position: absolute;
                                    top: 29px;
                                    left: 20px;
                                "></font>
                              <h5 style="font-size: 16px; margin-left: 18px;">Incidentes de Seguridad</h5>
                          </div>
                          <div class="w-100" style="min-height: 385px">
                              <canvas id="incidentechart"></canvas>
                              {{-- <a id="a_plan" class="btn_ver" href="/incidentes-de-seguridads">
                                  Ver Detalle
                              </a> --}}
                          </div>

                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="pr-0 col-md-6 card_new">
              <div class="p-3 mb-3 bg-white rounded row shadow-propia" style="margin-right: 10px;">
                  <div class="header">
                      <font class="circulo_iso_27001" style="
                                    width: 10px;
                                    height: 10px;
                                    background-color: #2DB7DB;
                                    border-radius: 100%;
                                    position: absolute;
                                    top: 29px;
                                    left: 18px;
                                "></font>
                      <h5 class="ml-3" style="font-size: 16px">Auditorias</h5>
                  </div>
                  <canvas id="chartAuditoria"></canvas>
                  <a id="a_plan" class="btn_ver" href="/auditoria-anuals">
                      Ver Detalle
                  </a>
              </div>
          </div>
          <div class="pr-0 col-md-6 card_new">
              <div class="p-3 mb-3 bg-white rounded row shadow-propia" style="margin-right: 1px;">
                  <div class="header">
                      <font class="circulo_iso_27001" style="
                                    width: 10px;
                                    height: 10px;
                                    background-color: #2DB7DB;
                                    border-radius: 100%;
                                    position: absolute;
                                    top: 29px;
                                    left: 18px;
                                "></font>
                      <h5 class="ml-3" style="font-size: 16px">Registro de Acciones</h5>
                  </div>
                  <canvas id="myChart"></canvas>
                  <div style="display: inline-flex; justify-content: center;">
                      <a id="" class="btn_ver" style="margin-left: 0;" href="/accion-correctivas">
                          Ver Detalle
                      </a>
                      <a id="" class="btn_ver" style="margin-left: 5px;" href="/registromejoras">
                          Ver Detalle
                      </a>
                  </div>
              </div>
          </div>
      </div>
  </div>
  @section('scripts')
      @parent

      <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
      <script src="https://unpkg.com/gauge-chart@latest/dist/bundle.js"></script>

      {{-- <script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"> --}}
      </script>{!! $chart1->renderJs() !!}{!! $chart2->renderJs() !!}{!! $chart4->renderJs() !!}

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
                          data: [{!! $accionc !!}],
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
                          data: [{!! $registro !!}],
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
                          label: 'Nuevos',
                          data: [{!! $nuevos !!}],
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
                          data: [{!! $en_curso !!}],
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
                          label: 'En espera',
                          data: [{!! $en_espera !!}],
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
                          label: 'Cerrados',
                          data: [{!! $cerrados !!}],
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
                          data: [{!! $cancelados !!}],
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

              options: {
                  responsive: true,
                  maintainAspectRatio: false,
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
                          ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart
                              .defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
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

        //   var canvasccap = document.getElementById("chartCapaci");
        //   var pieCapacit = new Chart(canvasccap, {
        //       type: 'pie',
        //       labels: {
        //           render: 'value'
        //       },
        //       data: {
        //           labels: [
        //               "Capacitados",
        //               "No capacitados"
        //           ],
        //           datasets: [{
        //               label: '% Capacitacion',
        //               data: [10, 1],
        //               backgroundColor: [
        //                   'rgba(22, 160, 133, 0.6)',
        //                   'rgba(244, 208, 63, 0.6)',

        //               ]
        //           }]
        //       },
        //       options: {
        //           responsive: true,
        //           legend: {
        //               display: true,
        //               position: 'right',
        //               labels: {
        //                   fontColor: "black",
        //                   boxWidth: 20,
        //                   padding: 8
        //               }
        //           },
        //           tooltips: {
        //               mode: 'label'
        //           },

        //       }
        //   });

          var canvas_sgsi = document.getElementById("chartIndicadoresSGSI");
          var pie_sgsi = new Chart(canvas_sgsi, {
              type: 'horizontalBar',
              labels: {
                  render: 'value'
              },
              data: {
                  labels:
                    JSON.parse(@json( json_encode($evaluacion_nombre))),


                  datasets: [{
                      label: '% Cumplimiento',
                      data:JSON.parse(@json( json_encode($evaluaciones))),


                      backgroundColor: [
                          'rgba(22, 160, 133, 0.6)',
                          'rgba(244, 208, 63, 0.6)',
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
          var canvasdoc = document.getElementById("chartDocu");
          var pieDoc = new Chart(canvasdoc, {
              type: 'pie',
              labels: {
                  render: 'value'
              },
              data: {
                  labels: [
                      "Publicados",
                      "En Elaboración",
                      "En Revisión",
                      "Rechazados",
                      "Obsoletos"
                  ],
                  datasets: [{
                      label: '% Documentación',
                      data: [@json($contador_documentos_publicados), @json($contador_documentos_en_elaboracion), @json($contador_documentos_en_revision),
                          @json($contador_documentos_rechazados), @json($contador_documentos_obsoletos),
                      ],
                      backgroundColor: [
                          'rgba(22, 160, 133, 0.9)',
                          'rgba(1, 140, 250 , 0.9)',
                          'rgba(43, 65, 233 , 0.9)',
                          'rgba(231, 76, 60, 0.9)',
                          'rgba(90, 100, 100 , 0.9)',
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

          renderProgresoGeneralPlan();

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
                      data: [{!! $auditinterna !!}, {!! $auditexterna !!}],
                      backgroundColor: [
                          'rgba(255, 99, 132, 0.6)',
                          'rgba(54, 162, 235, 0.6)',
                      ]
                  }, ]
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
          // Progreso general Plan
          function renderProgresoGeneralPlan() {
              let tasks = @json($actividades);
              let cantidad_done = 0; // Completadas
              let cantidad_undefined = 0; // Sin iniciar
              let cantidad_active = 0; // En proceso
              let cantidad_failed = 0; // Con retraso
              let cantidad_suspended = 0; // Suspendida
              let arr_cantidad_por_estatus = [];
              let arr_estatus = ['Completadas', 'Sin iniciar', 'En proceso', 'Con retraso',
                  'Suspendida'
              ];
              tasks.forEach(task => {
                  switch (task.status) {
                      case 'STATUS_DONE':
                          cantidad_done++;
                          break;
                      case 'STATUS_UNDEFINED':
                          cantidad_undefined++;
                          break;
                      case 'STATUS_ACTIVE':
                          cantidad_active++;
                          break;
                      case 'STATUS_FAILED':
                          cantidad_failed++;
                          break;
                      case 'STATUS_SUSPENDED':
                          cantidad_suspended++;
                          break;
                      default:
                          cantidad_undefined++;
                          break;
                  }
              });
              arr_cantidad_por_estatus.push(cantidad_done);
              arr_cantidad_por_estatus.push(cantidad_undefined);
              arr_cantidad_por_estatus.push(cantidad_active);
              arr_cantidad_por_estatus.push(cantidad_failed);
              arr_cantidad_por_estatus.push(cantidad_suspended);
              renderGraficaProgresoGeneralPlan(arr_estatus, arr_cantidad_por_estatus)
          }

          function renderGraficaProgresoGeneralPlan(arr_estatus, arr_cantidad_por_estatus) {
              var canvasdoc = document.getElementById("chartActividades");
              var pieDoc = new Chart(canvasdoc, {
                  type: 'pie',
                  labels: {
                      render: 'value'
                  },
                  data: {
                      labels: arr_estatus,
                      datasets: [{
                          data: arr_cantidad_por_estatus,
                          backgroundColor: [
                              'rgb(0, 200, 117)',
                              '#00b1e1 ',
                              'rgb(253, 171, 61)',
                              'rgb(226, 68, 92)',
                              '#aaaaaa',
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
          }
      </script>

  @endsection
