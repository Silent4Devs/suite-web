<style>
    #table_total_capaci tbody tr.selected {
        color: black;
        background-color: #E9ECEF;
    }

    #table_total_capaci tbody tr {
        cursor: pointer;
    }

    #table_total_capaci_filter label {
        margin-left: -40rem;
    }

    .card_new {
        font-family: 'Inter', sans-serif;

    }

    .card_new .header {
        font-style: normal;
        font-weight: 500;
        font-size: 16px;
        line-height: 21px;
        color: #9ca3af;
    }

    .card_new .header p {
        font-style: normal;
        font-weight: 400;
        font-size: 20px;
        line-height: 30px;
        color: #374151;
    }

    .card_new .header h5 {
        font-style: normal;
        font-weight: 700;
        font-size: 22px;
        line-height: 36px;
        color: #1f2937;
    }

    .card_new .main p {
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 21px;
        color: #6b7280;
    }

    .card_texto {
        font-family: 'Inter', sans-serif;

    }

    .card_texto .header {
        font-style: normal;
        font-weight: 500;
        font-size: 16px;
        line-height: 21px;
        color: #9ca3af;
    }

    .card_texto .header p {
        font-style: normal;
        font-weight: 700;
        font-size: 15px;
        line-height: 36px;
        color: #1f2937;
    }

    .card_texto .header h5 {
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 21px;
        color: #6b7280;
    }

    .card_texto .main p {
        font-style: normal;
        font-weight: 700;
        font-size: 22px;
        line-height: 36px;
        color: #1f2937;
    }


    .shadow-propia {
        box-shadow: 0px 5px 5px 1px rgba(0, 0, 0, 0.1);
    }

</style>
<style>
    #cargando_informacion_capacitacion {
        z-index: 1;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        position: absolute;
        background: rgb(0 0 0 / 25%);
        border-radius: 5px;
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
<div class="pl-0 mb-3 container-fluid">
    <div class="row">
        <div class="col-6" style="padding-left: 30px">
            <h3 class="text-muted">Capacitaciones</h3>
        </div>
        <div class="col-6"></div>
    </div>
    <div class="row">
        <div class="col-md-8 card_new">
            <div class="p-3 mb-3 bg-white rounded shadow-propia">
                <div class="header d-flex align-items-baseline">
                    <h5>Histórico/Capacitaciones {{ date('Y') }}: </h5>
                    <p class="ml-3">{{ $capacitaciones_year_actual }} capacitaciones</p>
                </div>
                <canvas id="line" height="150px"></canvas>
            </div>
            <div class="p-3 bg-white rounded text-dark shadow-propia datatable-fix"
                style="width: 100%; position: relative;">
                <div class="header d-flex align-items-baseline">
                    <h5>Lista de capacitaciones: </h5>
                    <p class="ml-3">{{ count($capacitaciones) }} capacitaciones en total</p>
                </div>
                <table id="table_total_capaci" class="table w-100">
                    <thead class="thead-light">
                        <tr>
                            <th>ID.</th>
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
                                <td>{{ \Carbon\Carbon::parse($capacitacion->fecha_curso)->format('d D, M Y') }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($capacitacion->fecha_fin)->format('d D, M Y') }}
                                </td>
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
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12 card_texto">
                    <div class="p-3 mb-3 bg-white rounded row shadow-propia">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                            <div class="text-center icono_oculto_print" style="font-size: 24pt">
                                <i class="p-3 text-white rounded fas fa-chalkboard-teacher bg-success"></i>
                            </div>
                        </div>
                        <div class="p-0 col-12 col-sm-12 col-md-12 col-lg-8">
                            <div class="header">
                                <span class="text-success">Total capacitaciones</span>
                                <p class="p-0">{{ count($capacitaciones) }} <span>capacitacion(es)</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 card_texto">
                    <div class="p-3 mb-3 bg-white rounded row shadow-propia">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                            <div class="text-center icono_oculto_print" style="font-size: 24pt">
                                <i class="p-3 text-white rounded fas fa-calendar-week bg-primary"></i>
                            </div>
                        </div>
                        <div class="p-0 col-12 col-sm-12 col-md-12 col-lg-8">
                            <div class="header">
                                <span class="text-primary">Capacitaciones en {{ date('Y') - 1 }}</span>
                                <p class="p-0">{{ $capacitaciones_year_actual_uno_antes }}
                                    <span>capacitación(es)</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 card_texto">
                    <div class="p-3 mb-3 bg-white rounded row shadow-propia">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                            <div class="text-center" style="font-size: 24pt">
                                <i class="p-3 text-white rounded fas fa-calendar-week bg-primary"></i>
                            </div>
                        </div>
                        <div class="p-0 col-12 col-sm-12 col-md-12 col-lg-8">
                            <div class="header">
                                <span class="text-primary">Capacitaciones en {{ date('Y') }}</span>
                                <p class="p-0">{{ $capacitaciones_year_actual }} <span>capacitación(es)</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 card_new">
                    <div class="p-3 mb-3 bg-white rounded row shadow-propia">
                        <div class="header d-flex align-items-baseline">
                            <h5>Categorías: </h5>
                            <p class="ml-3">{{ count($categorias_arr) }} categoría(s)</p>
                        </div>
                        <canvas id="chart_categorias"></canvas>
                        <a id="a_plan" class="btn_ver" href="frontend/recursos">
                            Ver Detalle
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 card_new">
                    <div class="p-3 bg-white rounded row shadow-propia">
                        <div class="header d-flex align-items-baseline">
                            <h5>Tipos: </h5>
                            <p class="ml-3">{{ count($tipos_total_arr) }} tipos</p>
                        </div>
                        <canvas id="chart_tipos"></canvas>
                        <a id="a_plan" class="btn_ver" href="frontend/recursos">
                            Ver Detalle
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mb-3 container-fluid card_new">
    <div id="contenedor_card_participantes"></div>
</div>

@section('scripts')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"></script> --}}

    <script>
        $(document).ready(function() {
            moment.lang('es', {
                months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'
                    .split('_'),
                monthsShort: 'Ene_Feb_Mar_Abr_May_Jun_Jul_Ago_Sept_Oct_Nov_Dic.'.split('_'),
                weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
                weekdaysShort: 'Dom._Lun._Mar._Mier._Jue._Vier._Sab.'.split('_'),
                weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sa'.split('_')
            });
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
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            fontColor: "black",
                            boxWidth: 20,
                            padding: 8
                        }
                    },
                },
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
                        position: 'bottom',
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
                        position: 'bottom',
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
                url: `recursos/${id_recurso}/participantes/get/`,
                beforeSend: function() {
                    $("#cargando_informacion_capacitacion").show();
                },
                success: function(response) {
                    $("#cargando_informacion_capacitacion").hide();
                    if (response != null) {
                        console.log(response);
                        let fecha_inicio = response.recurso.fecha_curso;
                        let fecha_fin = response.recurso.fecha_fin;
                        let duracion = response.recurso.duracion;
                        let instructor = response.recurso.instructor;
                        let total_participantes = response.empleados.length;
                        let tipo = response.recurso.tipo;
                        let nombre = response.recurso.cursoscapacitaciones;
                        let categoria = response.recurso.categoria_capacitacion.nombre;
                        let contenedor = document.querySelector('#contenedor_card_participantes');
                        let renderHTML = `
                                 <div class="row">
                    <div class="col-12">
                        <h3 class="mb-3 text-muted">Información detallada de la capacitación: <span
                                class="text-dark">${nombre}</span></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="p-0 pr-2 mb-3 col-md-4 card_texto">
                        <div class="p-3 bg-white rounded text-dark shadow-propia">
                            <div class="row">
                                <div class="p-0 col-12 col-sm-12 col-md-12 col-lg-4 justify-content-center d-flex">
                                    <div class="text-center" style="font-size: 24pt">
                                        <i class="p-3 text-white rounded fas fa-user bg-info"></i>
                                    </div>
                                </div>
                                <div class="p-0 col-12 col-sm-12 col-md-12 col-lg-8 d-flex align-items-center">
                                    <div class="header">
                                        <span class="text-info">Instructor</span>
                                        <p class="p-0 m-0" title="${instructor}" style="text-transform:capitalize">
                                            ${instructor.length >= 20 ? instructor.substr(0,20)+'...':instructor}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-0 pr-2 mb-3 col-md-4 card_texto">
                        <div class="p-3 bg-white rounded text-dark shadow-propia">
                            <div class="row">
                                <div class="p-0 col-12 col-sm-12 col-md-12 col-lg-4 justify-content-center d-flex">
                                    <div class="text-center" style="font-size: 24pt">
                                        <i class="p-3 text-white rounded fas fa-th-list bg-success"></i>
                                    </div>
                                </div>
                                <div class="p-0 col-12 col-sm-12 col-md-12 col-lg-8 d-flex align-items-center">
                                    <div class="header">
                                        <span class="text-success">Categoría</span>
                                        <p class="p-0 m-0" title="${categoria}">${categoria.length >= 20 ?
                                            categoria.substr(0,20)+'...':categoria}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-0 mb-3 col-md-4 card_texto">
                        <div class="p-3 bg-white rounded text-dark shadow-propia">
                            <div class="row">
                                <div class="p-0 col-12 col-sm-12 col-md-12 col-lg-4 justify-content-center d-flex">
                                    <div class="text-center" style="font-size: 24pt">
                                        <i class="p-3 text-white rounded fas fa-th-list bg-success"></i>
                                    </div>
                                </div>
                                <div class="p-0 col-12 col-sm-12 col-md-12 col-lg-8 d-flex align-items-center">
                                    <div class="header">
                                        <span class="text-success">Tipo</span>
                                        <p class="p-0 m-0" title="${tipo}">${tipo.length >= 20 ? tipo.substr(0,20)+'...':tipo}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="p-0 pr-2 mb-3 col-md-4 card_texto">
                        <div class="p-3 bg-white rounded text-dark shadow-propia">
                            <div class="row">
                                <div class="p-0 col-12 col-sm-12 col-md-12 col-lg-4 justify-content-center d-flex">
                                    <div class="text-center" style="font-size: 24pt">
                                        <i class="p-3 text-white rounded fas fa-users bg-info"></i>
                                    </div>
                                </div>
                                <div class="p-0 col-12 col-sm-12 col-md-12 col-lg-8 d-flex align-items-center">
                                    <div class="header">
                                        <span class="text-info">No. Participantes</span>
                                        <p class="p-0 m-0">${total_participantes} participantes inscritos</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-0 pr-2 mb-3 col-md-4 card_texto">
                        <div class="p-3 bg-white rounded text-dark shadow-propia">
                            <div class="row">
                                <div class="p-0 col-12 col-sm-12 col-md-12 col-lg-4 justify-content-center d-flex">
                                    <div class="text-center" style="font-size: 24pt">
                                        <i class="p-3 text-white rounded fas fa-calendar-day bg-primary"></i>
                                    </div>
                                </div>
                                <div class="p-0 col-12 col-sm-12 col-md-12 col-lg-8 d-flex align-items-center">
                                    <div class="header">
                                        <span class="text-primary">Fecha de Inicio</span>
                                        <p class="p-0 m-0">${moment(fecha_inicio).locale('es').format("dd DD, MMM YYYY hh:mm a")}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-0 mb-3 col-md-4 card_texto">
                        <div class="p-3 bg-white rounded text-dark shadow-propia">
                            <div class="row">
                                <div class="p-0 col-12 col-sm-12 col-md-12 col-lg-4 justify-content-center d-flex">
                                    <div class="text-center" style="font-size: 24pt">
                                        <i class="p-3 text-white rounded fas fa-calendar-day bg-primary"></i>
                                    </div>
                                </div>
                                <div class="p-0 col-12 col-sm-12 col-md-12 col-lg-8 d-flex align-items-center">
                                    <div class="header">
                                        <span class="text-primary">Fecha de Fin</span>
                                        <p class="p-0 m-0">${moment(fecha_fin).locale('es').format("dd DD, MMM YYYY hh:mm a")}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="pl-0 col-md-6 card_new">
                        <div class="p-3 mb-3 bg-white rounded shadow-propia">
                            <div class="header">
                                <h5>Participantes</h5>
                                <p></p>
                            </div>
                            <canvas id="chart_alumnos_capaci"></canvas>
                            <a id="a_plan" class="btn_ver" href="frontend/recursos">
                                Ver Detalle
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="card_new w-100">
                                <div class="p-3 mb-3 bg-white rounded shadow-propia">
                                    <div class="header">
                                        <h5>Aprobados/Reprobados</h5>
                                        <p></p>
                                    </div>
                                    <canvas id="chart_alumnos_aprovados"></canvas>
                                    <a id="a_plan" class="btn_ver" href="frontend/recursos">
                                        Ver Detalle
                                    </a>
                                </div>
                            </div>
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
                },
                error: function(error) {
                    console.log(error);
                    Swal.fire(
                        'Ocurrió un error',
                        `Error: ${error.responseJSON.message}`,
                        'error'
                    )
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
