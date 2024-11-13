@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/templateAnalisisRiesgo/sections.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/global/tbButtons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/global/tbButtons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common/alerts.css') }}">
@endsection
@section('content')
    {{-- <style>
    h6 {
        margin:0px;
    }
    .tb-btn-primary:hover {
        color:#006DDB;
    }
</style> --}}
    <style>
        .custom-title {
            font-size: 20px;
        }

        .swal2-cancel.custom-cancel-button {
            background-color: #FFFFFF !important;
            /* Cambia el color de fondo */
            color: #006DDB !important;
            /* Cambia el color del texto */
            border: 1px solid #0069D2 !important;
            border-radius: 5px !important;
            /* Ajusta el radio de borde */
            padding: 10px 20px !important;
            /* Ajusta el relleno */
            font-size: 16px !important;
            /* Cambia el tamaño de la letra */
        }

        .caja-options {
            z-index: 1;
            width: 180px !important;
            padding: 10px;
            margin-bottom: 0px;
            margin-right: 30px;
            right: 55px;
            margin-top: -40px;
            /* top:10px; */
            /* top: 45px; */
        }

        .options .caja-options {
            display: none;
        }

        .options:hover .caja-options {
            display: flex;
        }

        .icon-option {
            font-size: 20px;
        }

        .dropdown-toggle::after {
            display: none;
        }
    </style>
    <div class="mt-4 card card-body shadow-sm">
        <h4 style="margin: 0px;">Análisis de riesgo: {{ $riskAnalysis->name }}</h4>
        <hr style="margin-top: 10px;">
        <div style="display:flex; flex-direction: row; gap:120px; align-items:center;">
            <h6>{{ $riskAnalysis->fecha }}</h6>
            <h6>nombre</h6>
            <h6>{{ $riskAnalysis->norma->norma }}</h6>
            <div style="position:absolute; right:77px;">
                <div style="flex-direction: row; display:flex; align-items:center; gap:10px">
                    <h6>Responsable</h6>
                    <img class="img_empleado"
                        src="{{ asset('storage/empleados/imagenes') }}/{{ $riskAnalysis->elaboro->foto }}" />
                </div>
            </div>


        </div>

    </div>

    @livewire('analisis-riesgos.head-map-risk-two', ['RiskAnalysisId' => $riskAnalysisId])

    @livewire('analisis-riesgos.form-risk-analysis', ['RiskAnalysisId' => $riskAnalysisId])

    @livewire('analisis-riesgos.treatment-plan')
@endsection

@section('scripts')
    @parent
    <script>
        let cont = 0;

        function tablaLivewire(id_tabla) {
            $('#' + id_tabla).attr('id', id_tabla + cont);
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Mis Registros ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Mis Registros ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print" style="font-size: 1.1rem;color:#345183"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Imprimir',
                    // set custom header when print
                    customize: function(doc) {
                        let logo_actual = @json($logo_actual);
                        let empresa_actual = @json($empresa_actual);

                        var now = new Date();
                        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
                        $(doc.document.body).prepend(`
                            <div class="row">
                                <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                    <img class="img-fluid" style="max-width:120px" src="${logo_actual}"/>
                                </div>
                                <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                    <p>${empresa_actual}</p>

                                    <strong style="color:#345183">Timsheet: Mis Registros</strong>
                                </div>
                                <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                    Fecha: ${jsDate}
                                </div>
                            </div>
                        `);

                        $(doc.document.body).find('table')
                            .css('font-size', '12px')
                            .css('margin-top', '15px')
                        // .css('margin-bottom', '60px')
                        $(doc.document.body).find('th').each(function(index) {
                            $(this).css('font-size', '18px');
                            $(this).css('color', '#fff');
                            $(this).css('background-color', 'blue');
                        });
                    },
                    title: '',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'colvis',
                    text: '<i class="fas fa-filter" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Seleccionar Columnas',
                },
                {
                    extend: 'colvisGroup',
                    text: '<i class="fas fa-eye" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    show: ':hidden',
                    titleAttr: 'Ver todo',
                },
                {
                    extend: 'colvisRestore',
                    text: '<i class="fas fa-undo" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Restaurar a estado anterior',
                }
            ];
            let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar empleado',
                url: "{{ asset('admin/inicioUsuario/reportes/quejas') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config) {
                    let {
                        url
                    } = config;
                    window.location.href = url;
                }
            };
            let dtOverrideGlobals = {
                buttons: dtButtons,
                order: [
                    [0, 'desc']
                ],
                destroy: true,
                render: true,
            };

            let table = $('#' + id_tabla + cont).DataTable(dtOverrideGlobals);

            return table;
        }

        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                tablaLivewire('datatable-risk-analysis');
            }, 100);
        });

        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                tablaLivewire('datatable-risk-analysis-controls');
            }, 200);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/echarts@5.5.0/dist/echarts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>
    {{-- <script>
        $(document).ready(function() {
            var columnsCount = 5;

            var celdas = [];
            var colorsCeldas = [];

            for (let i = 0; i < columnsCount; i++) {
                for (let ii = 0; ii < columnsCount; ii++) {
                    celdas.push([i, ii, i + 1]);
                }

                colorsCeldas.push('#' + Math.floor(Math.random() * 16777215).toString(16));
            }

            // celdas = [
            //     [0, 0, 1],
            //     [0, 1, 1],
            //     [0, 2, 2],
            //     [0, 3, 3],
            //     [1, 0, 1],
            //     [1, 1, 2],
            //     [1, 2, 3],
            //     [1, 3, 4],
            //     [2, 0, 2],
            //     [2, 1, 3],
            //     [2, 2, 4],
            //     [2, 3, 4],
            //     [3, 0, 3],
            //     [3, 1, 4],
            //     [3, 2, 4],
            //     [3, 3, 4]
            // ]

            console.log(celdas, colorsCeldas);

            var chartDom = document.getElementById('map-position-cl');
            var myChart = echarts.init(chartDom);
            var option;

            // prettier-ignore
            const hours = [
                // '1a', '2a', '3a', '4a'
            ];
            // prettier-ignore
            const days = [
                // '1', '2', '3', '4',
            ];
            // prettier-ignore
            const data = celdas.map(function(item) {
                return [item[1], item[0], item[2] || '-'];
            });
            option = {
                tooltip: {
                    position: 'top'
                },
                grid: {
                    // top: '10%'
                },
                xAxis: {
                    type: 'category',
                    data: hours,
                    splitArea: {
                        show: true
                    },
                    name: "Probabilidad",
                    nameLocation: "center",
                    nameGap: 20,
                    axisLabel: {
                        show: false,
                    },
                    axisTick: {
                        show: false,
                    },
                },
                yAxis: {
                    type: 'category',
                    name: 'Valor Y',
                    splitArea: {
                        show: true
                    },
                    name: "Impacto",
                    nameLocation: "center",
                    nameGap: 20,
                    axisLabel: {
                        show: false,
                    },
                    axisTick: {
                        show: false,
                    },
                },
                visualMap: {
                    show: false,
                    min: 1,
                    max: 4,
                    calculable: true,
                    orient: 'horizontal',
                    left: 'center',
                    inRange: {
                        color: colorsCeldas,
                    }
                    // padding:5,
                    // top: '5%'
                },
                series: [{
                    // name: 'Punch Card',
                    type: 'heatmap',
                    data: data,
                    label: {
                        show: false,
                    },
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }]
            };

            option && myChart.setOption(option);
        });
    </script> --}}
    {{-- <script>
        $(document).ready(function() {
            var chartDom = document.getElementById('map-position-cl-v2');
            var myChart = echarts.init(chartDom);
            var option;
            const filterStartIndex = 16;

            // Configuración de etiquetas y colores
            const probabilidad = ['1', '2', '3', '4']; // Ascendente de izquierda a derecha
            const impacto = ['1', '2', '3', '4']; // Ascendente de abajo hacia arriba

            // Colors
            const colores = ['#4BCFA2', '#F2C322', '#FF8C34', '#FC5375'];

            const pieces = [
                        { min: 1, max: 2, color: 'green' },       // Verde para valores de 1 a 3
                        { min: 3, max: 6, color: 'yellow' },      // Amarillo para valores de 4 a 6
                        { min: 8, max: 9, color: 'orange' },      // Naranja para valores de 7 a 9
                        { min: 10, max: 16, color: 'red' }        // Rojo para valores de 10 a 16
                    ]

            //data default
            const dataDefault = [
                [0, 0, 1], [1, 0, 2], [2, 0, 3], [3, 0, 4], // Nivel de riesgo para Impacto 1
                [0, 1, 2], [1, 1, 4], [2, 1, 6], [3, 1, 8], // Nivel de riesgo para Impacto 2
                [0, 2, 3], [1, 2, 6], [2, 2, 9], [3, 2, 12], // Nivel de riesgo para Impacto 3
                [0, 3, 4], [1, 3, 8], [2, 3, 12], [3, 3, 16], // Nivel de riesgo para Impacto 4
            ];


            const dataNew = [[0,0,1],[3,3,15],]

            const data = [...dataDefault,...dataNew];

            // Configuración del gráfico
            option = {
                tooltip: {
                    position: 'top',
                    formatter: (params) => {
                        const [x, y] = params.value;
                        // Filtra valores solo después del índice definido
                        let valuesAtCoordinates = data
                            .slice(filterStartIndex) // Aplica el filtro de inicio
                            .filter(item => item[0] === x && item[1] === y)
                            .map(item => item[2]);

                        const valuesString = valuesAtCoordinates.join(', ');
                        if(valuesString){
                            return `Riesgos Residuales: <br> ${valuesString}`;
                        }else {
                            return null;
                        }
                    }
                },
                xAxis: {
                    type: 'category',
                    data: probabilidad,
                    name: "Probabilidad",
                    nameLocation: "center",
                    nameGap: 20,
                    splitArea: {
                        show: false
                    },
                    axisLabel: {
                        show: false
                    },
                    axisTick: {
                        show: false
                    },
                },
                yAxis: {
                    type: 'category',
                    data: impacto,
                    name: "Impacto",
                    nameLocation: "center",
                    nameGap: 20,
                    splitArea: {
                        show: false
                    },
                    axisLabel: {
                        show: false
                    },
                    axisTick: {
                        show: false
                    },
                },
                visualMap: {
                    show:false,
                    min: 1,
                    max: 4,
                    calculable: false,
                    orient: 'horizontal',
                    left: 'center',
                    pieces: pieces,
                    inRange: {
                        color: colores // Asignación de colores para los niveles
                    }
                },
                series: [{
                    name: 'Riesgo Residual',
                    type: 'heatmap',
                    data: data,
                    label: {
                        show: true,  // Asegúrate de que las etiquetas se muestren
                        formatter: (params) => {
                            const [x, y] = params.value;
                            // Filtra los valores de la celda correspondiente
                            let valuesAtCoordinates = data
                                .slice(filterStartIndex) // Aplica el filtro de inicio
                                .filter(item => item[0] === x && item[1] === y);
                            // Muestra la cantidad de valores en la celda
                            return valuesAtCoordinates.length > 0 ? valuesAtCoordinates.length : 0;
                        },
                        textStyle: {
                            fontSize: 18, // Aumenta el tamaño de la fuente (en píxeles)
                            // fontWeight: 'bold', // O puedes cambiar el peso de la fuente si lo deseas
                            color: '#FFFFFF' // Puedes cambiar el color del texto si lo necesitas
                        }
                    },
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }]
            };

            // Renderizar la gráfica
            myChart.setOption(option);

        });
    </script> --}}

@endsection
