@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/templateAnalisisRiesgo/sections.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/global/tbButtons.css') }}">
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

    <div class="card card-body">
        <div class="row">
            <div class="col-md-4 py-5">
                <div class="form-group">
                    <label for="">Metrica 1</label>
                    <input type="text" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Metrica 2</label>
                    <input type="text" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Metrica 3</label>
                    <input type="text" class="form-control">
                </div>

                <div class="form-group text-right">
                    <button class="btn btn-primary">Enviar</button>
                </div>
            </div>
            <div class="col-md-8">
                <div id="map-position-cl" style="width: 100%; height: 100%;"></div>
            </div>
        </div>
    </div>

    @livewire('analisis-riesgos.form-risk-analysis', ['RiskAnalysisId' => $riskAnalysisId])
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.5.0/dist/echarts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>
    <script>
        $(document).ready(function() {
            var chartDom = document.getElementById('map-position-cl');
            var myChart = echarts.init(chartDom);
            var option;

            // prettier-ignore
            const hours = [
                '1a', '2a', '3a', '4a'
            ];
            // prettier-ignore
            const days = [
                '1', '2', '3', '4',
            ];
            // prettier-ignore
            const data = [
                    [0, 0, 1],
                    [0, 1, 1],
                    [0, 2, 2],
                    [0, 3, 3],
                    [1, 0, 1],
                    [1, 1, 2],
                    [1, 2, 3],
                    [1, 3, 4],
                    [2, 0, 2],
                    [2, 1, 3],
                    [2, 2, 4],
                    [2, 3, 4],
                    [3, 0, 3],
                    [3, 1, 4],
                    [3, 2, 4],
                    [3, 3, 4]
                ]
                .map(function(item) {
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
                        color: ['#4BCFA2', '#F2C322', '#FF8C34', '#FC5375']
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
    </script>
@endsection
