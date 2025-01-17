<div>
    <div class="row">
        <div class="col-6" style="padding-right: 14px; padding-left: 14px;">
            <div class="card card-body shadow-sm mb-0">
                <div class="d-flex justify-content-between">
                    <h4 style="margin: 0px; color:#306BA9;">Riesgo Inicial</h4>
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#historyRR"
                        wire:click="getHistoryRR">
                        <i class="material-symbols-outlined" style="color:#006DDB; cursor: pointer;">
                            history
                        </i>
                    </button>
                </div>
                <hr style="margin-top: 10px; margin-bottom: 20px;">
                <div id="map-position-cl" style="width: 100%; height: 350px;"></div>
            </div>
        </div>
        <div class="col-6 " style="padding-right: 14px; padding-left: 14px;">
            <div class="card card-body shadow-sm mb-0">
                <div class="d-flex justify-content-between">
                    <h4 style="margin: 0px; color:#306BA9;">Riesgo Residual</h4>
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#historyRR"
                        wire:click="getHistoryRR">
                        <i class="material-symbols-outlined" style="color:#006DDB; cursor: pointer;">
                            history
                        </i>
                    </button>
                </div>
                <hr style="margin-top: 10px; margin-bottom: 20px;">
                <div id="map-position-cl-v2" style="width: 100%; height: 350px;"></div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="historyRR" data-bs-keyboard="false" tabindex="-1" data-bs-backdrop="static"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div wire:loading>
            <div class="spinner-border text-primary" role="status" sty>
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div class="modal-dialog modal-lg">
            <div wire:loading.remove>
                <div class="modal-content" style="background:none; border:none; gap:28px;">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            style="background:none; border: none;">
                            <i class="fa-solid fa-x fa-2xl" style="color: #ffffff;"></i>
                        </button>
                    </div>
                    <div class="modal-body card">
                            <h6 style="margin: 0px; color:#606060;">Histórico del Nivel de Riesgo</h6>
                            <hr style="margin-top: 10px; margin-bottom: 20px;">
                            <table class="table w-100 datatable datatable-rr-history" id="datatable-rr-history">
                                <thead>
                                    <tr>
                                        <th>Periodo</th>
                                        <th>Fecha</th>
                                        <th>Riesgo Inicial</th>
                                        <th>Riesgo Residual</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($historiesRR)
                                        @foreach ($historiesRR as $historyRR)
                                            <tr>
                                                <th>{{ $historyRR->period_name }}</th>
                                                <th>{{ $historyRR->start }}</th>
                                                <th>{{ $historyRR->period_name }}</th>
                                                <th>{{ $historyRR->initial_risk }}</th>
                                                <th>{{ $historyRR->residual_risk }}</th>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            initialRiskGraphic();
            residualRiskGraphic();

            Livewire.on('reloadGraph', (data) => {
                console.log(data[0], data[1]);
                setTimeout(() => {
                    initialRiskGraphic(data[0]);
                    residualRiskGraphic(data[1]);
                }, 100);
            });

            function initialRiskGraphic(initialRisk = null) {
                $(document).ready(function() {
                    const {
                        scalesRegister,
                        min,
                        max,
                        probRegister,
                        prob,
                        colors,
                        probMax
                    } = getInfo();
                    const pieces = getPieces(min, max, scalesRegister);
                    const dataDefault = getInitialData(probMax);
                    const filterStartIndex = probMax * probMax;

                    const dataNew = initialRisk ? initialRisk : @json($initialRisk);
                    console.log(dataNew);


                    var chartDom = document.getElementById('map-position-cl');
                    var myChart = echarts.init(chartDom);
                    var option;

                    const data = [...dataDefault, ...dataNew];


                    // graphic config
                    option = {
                        tooltip: {
                            position: 'top',
                            formatter: (params) => {
                                const [x, y] = params.value;
                                let valuesAtCoordinates = data
                                    .slice(filterStartIndex)
                                    .filter(item => item[0] === x && item[1] === y)
                                    .map(item => item[2]);

                                const valuesString = valuesAtCoordinates.join(', ');
                                if (valuesString) {
                                    return `Riesgos Iniciales: <br> ${valuesString}`;
                                } else {
                                    return null;
                                }
                            }
                        },
                        xAxis: {
                            type: 'category',
                            data: prob,
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
                        yAxis: {
                            type: 'category',
                            data: prob,
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
                        visualMap: {
                            show: false,
                            min: 1,
                            max: 4,
                            calculable: false,
                            orient: 'horizontal',
                            left: 'center',
                            pieces: pieces,
                        },
                        series: [{
                            name: 'Riesgo Residual',
                            type: 'heatmap',
                            data: data,
                            label: {
                                show: true,
                                formatter: (params) => {
                                    const [x, y] = params.value;
                                    let valuesAtCoordinates = data
                                        .slice(filterStartIndex)
                                        .filter(item => item[0] === x && item[1] === y);

                                    return valuesAtCoordinates.length > 0 ?
                                        valuesAtCoordinates.length : 0;
                                },
                                textStyle: {
                                    fontSize: 18,
                                    color: '#FFFFFF'
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

                    myChart.setOption(option);
                });
            }

            function residualRiskGraphic(residualRisk = null) {
                $(document).ready(function() {
                    const {
                        scalesRegister,
                        min,
                        max,
                        probRegister,
                        prob,
                        colors,
                        probMax
                    } = getInfo();
                    const pieces = getPieces(min, max, scalesRegister);
                    const dataDefault = getInitialData(probMax);
                    const filterStartIndex = probMax * probMax;

                    const dataNew = residualRisk ? residualRisk : @json($residualRisk);


                    var chartDom = document.getElementById('map-position-cl-v2');
                    var myChart = echarts.init(chartDom);
                    var option;


                    const data = [...dataDefault, ...dataNew];

                    option = {
                        tooltip: {
                            position: 'top',
                            formatter: (params) => {
                                const [x, y] = params.value;
                                let valuesAtCoordinates = data
                                    .slice(filterStartIndex)
                                    .filter(item => item[0] === x && item[1] === y)
                                    .map(item => item[2]);

                                const valuesString = valuesAtCoordinates.join(', ');
                                if (valuesString) {
                                    return `Riesgos Residuales: <br> ${valuesString}`;
                                } else {
                                    return null;
                                }
                            }
                        },
                        xAxis: {
                            type: 'category',
                            data: prob,
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
                        yAxis: {
                            type: 'category',
                            data: prob,
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
                        visualMap: {
                            show: false,
                            min: 1,
                            max: 4,
                            calculable: false,
                            orient: 'horizontal',
                            left: 'center',
                            pieces: pieces,
                        },
                        series: [{
                            name: 'Riesgo Residual',
                            type: 'heatmap',
                            data: data,
                            label: {
                                show: true,
                                formatter: (params) => {
                                    const [x, y] = params.value;
                                    let valuesAtCoordinates = data
                                        .slice(filterStartIndex)
                                        .filter(item => item[0] === x && item[1] === y);
                                    return valuesAtCoordinates.length > 0 ?
                                        valuesAtCoordinates.length : 0;
                                },
                                textStyle: {
                                    fontSize: 18,
                                    color: '#FFFFFF'
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

                    myChart.setOption(option);

                });
            }

            function getInitialData(n) {
                const data = [];
                for (let i = 1; i <= n; i++) {
                    for (let j = 1; j <= n; j++) {
                        const valor = i * j;
                        //grafica inicia en intervalor de 0,0 para la coordenada 1,1
                        data.push([i - 1, j - 1, valor]);
                    }
                }
                return data;
            }

            function getPieces(min, max, scales) {
                const pieces = [];

                // Primer rango
                pieces.push({
                    min: min,
                    max: parseInt(scales[0].valor),
                    color: scales[0].color
                });

                // Rangos intermedios
                if (scales.length > 2) {
                    for (let i = 1; i < scales.length - 1; i++) {
                        pieces.push({
                            min: parseInt(scales[i - 1].valor) + 1,
                            max: parseInt(scales[i].valor),
                            color: scales[i].color,
                        });
                    }
                }

                // Último rango
                pieces.push({
                    min: parseInt(scales[scales.length - 2].valor) + 1,
                    max: max,
                    color: scales[scales.length - 1].color
                });

                return pieces;
            }

            function getInfo() {
                const scalesRegister = @json($scales->scales);
                const min = parseInt(@json($scales->valor_min));
                const max = parseInt(@json($scales->valor_max));
                const probRegister = @json($prob->prob_imp);
                const probMax = parseInt(@json($prob->valor_max));
                const prob = probRegister.map((item) => {
                    return item.valor;
                });

                const colors = probRegister.map((item) => {
                    return item.color;
                });


                return {
                    scalesRegister: scalesRegister,
                    min: min,
                    max: max,
                    probRegister: probRegister,
                    probMax: probMax,
                    prob: prob,
                    colors: colors
                }
            }
        });
    </script>
    {{-- datatable --}}
    <script>
        function tableLivewire(id_tabla) {
            $('#' + id_tabla).attr('id', id_tabla);
            let dtButtons = [

            ];

            let dtOverrideGlobals = {
                buttons: dtButtons,
                order: [
                    [0, 'desc']
                ],
                destroy: true,
                render: true,
            };

            let table = $('#' + id_tabla).DataTable(dtOverrideGlobals);

            return table;
        }

        document.addEventListener('DOMContentLoaded', function() {
            Livewire.on('reloadTableRR', function(table) {
                setTimeout(() => {
                    tableLivewire(table.table);
                }, 200);
            });
        });
    </script>
</div>
