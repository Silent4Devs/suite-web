<div>
    <div class="row">
        <div class="col-6" style="padding-right: 14px; padding-left: 14px;">
            <div class="card card-body shadow-sm mb-0">
                <h4 style="margin: 0px; color:#306BA9;">Riesgo Inicial</h4>
                <hr style="margin-top: 10px; margin-bottom: 20px;">
                <div id="map-position-cl" style="width: 100%; height: 350px;"></div>
            </div>
        </div>
        <div class="col-6 " style="padding-right: 14px; padding-left: 14px;">
            <div class="card card-body shadow-sm mb-0">
                <h4 style="margin: 0px; color:#306BA9;">Riesgo Residual</h4>
                <hr style="margin-top: 10px; margin-bottom: 20px;">
                <div id="map-position-cl-v2" style="width: 100%; height: 350px;"></div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            initialRiskGraphic();
            residualRiskGraphic();

            Livewire.on('reloadGraph', (data) => {
                console.log(data[0],data[1]);
                // console.log(initialRisk,residualRisk)
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
                        //grafica inicia en ocupa intervalor de 0,0 para la coordenada 1,1
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
</div>
