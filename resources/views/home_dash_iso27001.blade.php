  <div class="row">

      <h3 style="margin-bottom: -30px; color: #888; margin-left: 1%;">Dashboard ISO 27001</h3>
      <div class="text-right especificaciones col-12">

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
          @if (!empty($exist_doc))
              <style type="text/css">
                  .chartDocu {
                      display: block;
                  }

                  .chartDocu_falsa {
                      display: none;
                  }

              </style>
          @else
              <style type="text/css">
                  .chartDocu {
                      display: none;
                  }

                  .chartDocu_falsa {
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
  </div>
  @section('scripts')
      @parent

      <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
      <script src="https://unpkg.com/gauge-chart@latest/dist/bundle.js"></script>

      {{-- <script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"> --}}
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
                          label: 'Cerrado',
                          data: [{!! $incidentescerrado !!}],
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
                          data: [{!! $incidentescurso !!}],
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
                          data: [{!! $incidentesasignado !!}],
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
                          data: [{!! $incidentespendiente !!}],
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
                          data: [{!! $incidentescancelado !!}],
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
                      data: [{!! $documentoPubli !!}, {!! $documentoAprob !!}, {!! $documentorev !!},
                          {!! $documentoElab !!}, {!! $docunoelab !!},
                      ],
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
                      data: [0, 0, 0, 0, 1, ],
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
                      data: [{!! $actividadsininici !!}, {!! $actividadenproc !!}, {!! $actividadcompl !!},
                          {!! $actividadretr !!},
                      ],
                      backgroundColor: [

                          'rgba(133, 193, 233 , 0.6)',
                          'rgba(244, 208, 63, 0.6)',
                          'rgba(22, 160, 133, 0.6)',
                          'rgba(231, 76, 60, 0.6)'
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
          // aprobados

      </script>




  @endsection
