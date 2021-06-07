<div class="row">
    <style>
        #table_total_capaci tbody tr.selected {
            color: white;
            background-color: #0275D8;
        }

        #table_total_capaci tbody tr {
            cursor: pointer;
        }

    </style>
    <h3 style="margin-bottom: -30px; color: #888; margin-left: 1%;">Capacitaciones</h3>

    <div class="text-right especificaciones col-12" style="opacity: 0">

        <label>Plan <i class="fas fa-square iconos_espec" style="color: #3D72A1;"></i></label>
        <label>Do <i class="fas fa-square iconos_espec" style="color: #A13D86;"></i></label>
        <label>Check <i class="fas fa-square iconos_espec" style="color: #DBA82D;"></i></label>
        <label>Act <i class="fas fa-square iconos_espec" style="color: #2DB7DB;"></i></label>

    </div>
    <div class="col-12">
        <div class="row">
            <div class="card card_info" style="width:calc(50% - 20px); background: #307ab4;">
                <div><i class="fas fa-calendar-alt"></i></div>
                <h6>Total de capacitaciones</h6>
                <span style="font-size: 15pt">{{ count($capacitaciones) }} capacitaciones</span>
            </div>
            <div class="card card_info" style="width:calc(50% - 20px); background: #A13D86;">
                <div><i class="fas fa-calendar-alt"></i></div>
                <h6>Total de capacitaciones en {{ date('Y') }}</h6>
                <span style="font-size: 15pt">{{ $capacitaciones_year_actual }} capacitaciones</span>
            </div>
        </div>
        <div class="row">
            <div class="col-6 p-0">
                <div class="card caja_graficas graf_3">
                    <h5 class="espec" style="background-color: #2DB7DB">Categorias</h5>
                    <canvas id="chart_categorias"></canvas>
                    <a id="a_plan" class="btn_ver" href="admin/recursos">
                        Ver Detalle
                    </a>
                </div>
            </div>
            <div class="col-6 p-0">
                <div class="card caja_graficas graf_3">
                    <h5 class="espec" style="background-color: #2DB7DB">Tipos</h5>
                    <canvas id="chart_tipos"></canvas>
                    <a id="a_plan" class="btn_ver" href="admin/recursos">
                        Ver Detalle
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 p-0">
                <div class="card caja_graficas graf_3">
                    <h5 class="espec" style="background-color: #2DB7DB">Capacitaciones en {{ date('Y') }}</h5>
                    <canvas id="line" height="200px"></canvas>
                    <a id="a_plan" class="btn_ver" href="admin/recursos">
                        Ver Detalle
                    </a>
                </div>
            </div>
            <div class="card caja_table graf_3 datatable-fix" style="width: 100%; position: relative;">
                <h5 class="espec">Lista de capacitaciones</h5>
                <table id="table_total_capaci" class="table col-12 w-100">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Instructor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($capacitaciones as $index => $capacitacion)
                            <tr>
                                <td>{{ $capacitacion->id }}</td>
                                <td>{{ $capacitacion->cursoscapacitaciones }}</td>
                                <td>{{ $capacitacion->fecha_curso }}</td>
                                <td>{{ $capacitacion->fecha_fin }}</td>
                                <td>{{ $capacitacion->instructor }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div id="cargando_informacion_capacitacion">
                    <div class="circulo"></div>
                </div>
            </div>
        </div>
    </div>
    <style>
        #cargando_informacion_capacitacion {
            width: calc(100% - 20px);
            height: 90%;
            position: absolute;
            background: rgba(255, 255, 255, 0.5);
        }

        .circulo {
            width: 50px;
            height: 50px;
            border-radius: 100px;
            border-bottom: 5px solid black;
            animation: 0.8s girar infinite linear;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
        }

        @keyframes girar {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

    </style>

    <div id="contenedor_card_participantes" class="col-12"></div>

</div>
@section('scripts')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"></script> --}}

    <script>
        $(document).ready(function() {
            $("#cargando_informacion_capacitacion").hide();
            renderChartCategorias();
            renderChartPorTipo();
            renderChartCursosPorYearActual();
            let tbl_capacitaciones = $("#table_total_capaci").DataTable({
                buttons: [],
                select: true
            });
            $("#table_total_capaci tbody").on("click", "tr", function() {
                let data = tbl_capacitaciones.row(this).data();
                let id_recurso = data[0];
                // console.log(data);
                renderInformacionParticipantes(id_recurso);
            });
        });

        function renderChartCursosPorYearActual() {
            let fechas_cursos = @json($arr_fechas_cursos);
            let participantes_cursos = @json($arr_participantes);
            var ctx = document.getElementById("line").getContext('2d');
            var line = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: fechas_cursos,
                    datasets: [{
                        label: 'Capacitaciones', // Name the series
                        data: participantes_cursos, // Specify the data values array
                        fill: false,
                        borderColor: '#2196f3', // Add custom color border (Line)
                        backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
                        borderWidth: 1 // Specify bar border width
                    }]
                },
                options: {
                    responsive: true, // Instruct chart js to respond nicely.
                    maintainAspectRatio: true, // Add to prevent default behaviour of full-width/height 
                }
            });
        }

        function renderChartCategorias() {
            let categorias = @json($categorias_arr);
            let total_por_categoria = @json($recursos_categoria_arr);
            var canvasdoc = document.getElementById("chart_categorias");
            var pieDoc = new Chart(canvasdoc, {
                type: 'pie',
                labels: {
                    render: 'value'
                },
                data: {
                    labels: categorias,
                    datasets: [{
                        data: total_por_categoria,
                        backgroundColor: [
                            'rgba(22, 160, 133, 0.6)',
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
        }

        function renderChartPorTipo() {
            let total_por_tipo = @json($tipos_total_arr);

            var canvasdoc = document.getElementById("chart_tipos");
            var pieDoc = new Chart(canvasdoc, {
                type: 'pie',
                labels: {
                    render: 'value'
                },
                data: {
                    labels: ['Diplomado', 'Certificación', 'Curso'],
                    datasets: [{
                        data: total_por_tipo,
                        backgroundColor: [
                            'rgba(22, 160, 133, 0.6)',
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
        }

        function renderInformacionParticipantes(id_recurso) {
            $.ajax({
                type: "POST",
                url: `/admin/recursos/${id_recurso}/participantes/get/`,
                beforeSend: function() {
                    console.log('cargando..');
                    $("#cargando_informacion_capacitacion").show();
                },
                success: function(response) {
                    // console.log(response);
                    $("#cargando_informacion_capacitacion").hide();
                    if (response != null) {
                        let fecha_inicio = response.recurso.fecha_curso;
                        let fecha_fin = response.recurso.fecha_fin;
                        let duracion = response.recurso.duracion;
                        let instructor = response.recurso.instructor;
                        let total_participantes = response.empleados.length;
                        let contenedor = document.querySelector('#contenedor_card_participantes');
                        let renderHTML =
                            `
                              <div class="row">
                                <div class="col-4 p-0">
                                    <div class="card card_info graf_3" style="background: #307ab4;">
                                        <div><i class="fas fa-calendar-alt"></i></div>
                                        <h6> Fecha de curso</h6>
                                        <span>${fecha_inicio} - ${fecha_fin} (${duracion} días)</span>
                                    </div>
                                </div>
                                <div class="col-4 p-0">
                                    <div class="card card_info" style="background: #a634b4;">
                                        <div><i class="fas fa-chalkboard-teacher"></i></div>
                                        <h6> Instructor:</h6>
                                        <span style="font-size:14pt">${instructor}</span>
                                    </div>
                                </div>
                                <div class="col-4 p-0">
                                    <div class="card card_info" style="background: #DBA82D;">
                                        <div><i class="fas fa-user-graduate"></i></div>
                                        <h6 style="font-size:14pt"> Total de participantes:</h6>
                                        <span style="font-size:14pt">${total_participantes}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 p-0">
                                    <div class="card caja_graficas graf_3">
                                        <h5 class="espec">Participantes</h5>
                                        <canvas id="chart_alumnos_capaci"></canvas>
                                        <a id="a_plan" class="btn_ver" href="admin/recursos">
                                            Ver Detalle
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 p-0">
                                    <div class="card caja_graficas graf_3">
                                        <h5 class="espec">Aprobados/Reprobados</h5>
                                        <canvas id="chart_alumnos_aprovados"></canvas>
                                        <a id="a_plan" class="btn_ver" href="admin/recursos">
                                            Ver Detalle
                                        </a>
                                    </div>
                                </div>
                            </div>
                        `;
                        contenedor.innerHTML = renderHTML;
                        let calificaciones = response.empleados.map(empleado => {
                            return empleado.pivot.calificacion != null ? Number(empleado.pivot
                                .calificacion) : 0;
                        });

                        calificaciones.push(0); // Este es para inicializar en 0 el eje Y

                        let participantes = response.empleados.map(empleado => {
                            return empleado.name;
                        });

                        let aprobados = 0;
                        let reprobados = 0;
                        let arrAprobadosReprobados = [];
                        response.empleados.forEach(empleado => {
                            let calificacion = 0;
                            if (empleado.pivot.calificacion != null) {
                                calificacion = empleado.pivot.calificacion;
                            }

                            if (calificacion <= 60) {
                                reprobados++;
                            } else {
                                aprobados++;
                            }
                        });
                        arrAprobadosReprobados.push(aprobados);
                        arrAprobadosReprobados.push(reprobados);
                        renderParticipantes(participantes, calificaciones);

                        renderAprobadosReprobados(arrAprobadosReprobados);
                    }
                }
            });
        }

        function renderParticipantes(participantes, calificaciones) {
            var canvasdoc = document.getElementById("chart_alumnos_capaci");
            var pieDoc = new Chart(canvasdoc, {
                type: 'bar',
                data: {
                    labels: participantes,
                    datasets: [{
                        label: "Participantes",
                        data: calificaciones,
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
                        position: 'top',
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
                        y: {
                            suggestedMin: 50,
                            suggestedMax: 100
                        }
                    }
                }
            });
        }

        function renderAprobadosReprobados(arrAprobadosReprobados) {
            var canvasdoc = document.getElementById("chart_alumnos_aprovados");
            var pieDoc = new Chart(canvasdoc, {
                type: 'pie',
                labels: {
                    render: 'value'
                },
                data: {
                    labels: [
                        "Aprobados",
                        "Reprobados",
                    ],
                    datasets: [{
                        data: arrAprobadosReprobados,
                        backgroundColor: [
                            'rgba(22, 160, 133, 0.6)',
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
        }

    </script>
@endsection
