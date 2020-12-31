@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-5">
                <div class="col-md-12 col-sm-9 py-3 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
                    <h3 class="mb-2  text-center text-white"><strong>Tablero de Control</strong></h3>
                </div>
                <div class="col-12">
                    <div class="card-body">
                        @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-12 col-sm-6 py-1 card card-body bg-info align-self-center">
                                    <h3 class="mb-2  text-center text-white"><strong>Plan</strong></h3>
                                </div>
                                <h3>Progreso general del plan <strong>20%</strong></h3>
                                <canvas id="progresochart1"></canvas>
                            </div>
                            <div class="{{ $chart3->options['column_class'] }}">
                                <div class="col-md-12 col-sm-6 py-1 card card-body bg-info align-self-center ">
                                    <h3 class="mb-2  text-center text-white"><strong>Do</strong></h3>
                                </div>
                                <h3>{!! $chart3->options['chart_title'] !!}</h3>
                                {!! $chart3->renderHtml() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12" style="margin-top:20px; ">
                    <div class="card-body">
                        <div class="row">
                            <div class="{{ $chart1->options['column_class'] }}">
                                <div class="col-md-12 col-sm-6 py-1 card card-body bg-info align-self-center " style="margin-top:-40px; ">
                                    <h3 class="mb-2  text-center text-white"><strong>Check</strong></h3>
                                </div>
                                <h3>{!! $chart1->options['chart_title'] !!}</h3>
                                {!! $chart1->renderHtml() !!}
                            </div>
                            <div class="{{ $chart2->options['column_class'] }}">
                                <div class="col-md-12 col-sm-6 py-1 card card-body bg-info align-self-center"  style="margin-top:-40px;">
                                    <h3 class="mb-2  text-center text-white"><strong>Act</strong></h3>
                                </div>
                                <h3>{!! $chart2->options['chart_title'] !!}</h3>
                                {!! $chart2->renderHtml() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12" style="margin-top:20px; ">
                    <div class="card-body">
                        <div class="row">
                            <div class="{{ $chart4->options['column_class'] }}">
                                <div class="col-md-12 col-sm-6 py-1 card card-body bg-info align-self-center " style="margin-top:-40px; ">
                                    <h3 class="mb-2  text-center text-white"><strong>Check</strong></h3>
                                </div>
                                <h3>{!! $chart4->options['chart_title'] !!}</h3>
                                {!! $chart4->renderHtml() !!}
                            </div>
                          
                        </div>
                    </div>
                </div>
                <div class="{{ $settings5['column_class'] }}">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div class="text-value">{{ number_format($settings5['total_number']) }}</div>
                                    <div>{{ $settings5['chart_title'] }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $settings6['column_class'] }}">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div class="text-value">{{ number_format($settings6['total_number']) }}</div>
                                    <div>{{ $settings6['chart_title'] }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $chart7->options['column_class'] }}">
                            <h3>{!! $chart7->options['chart_title'] !!}</h3>
                            {!! $chart7->renderHtml() !!}
                        </div>
                        <div class="{{ $chart8->options['column_class'] }}">
                            <h3>{!! $chart8->options['chart_title'] !!}</h3>
                            {!! $chart8->renderHtml() !!}
                        </div>
                        <div class="{{ $chart9->options['column_class'] }}">
                            <h3>{!! $chart9->options['chart_title'] !!}</h3>
                            {!! $chart9->renderHtml() !!}
                        </div>
                        <div class="{{ $chart10->options['column_class'] }}">
                            <h3>{!! $chart10->options['chart_title'] !!}</h3>
                            {!! $chart10->renderHtml() !!}
                        </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://unpkg.com/gauge-chart@latest/dist/bundle.js"></script>
<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>{!! $chart1->renderJs() !!}{!! $chart2->renderJs() !!}{!! $chart3->renderJs() !!}
<script>
    var popCanvas1 = document.getElementById("progresochart1");
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
                data: [30, 20, 20, 10],
                backgroundColor: [
                    'rgba(22, 160, 133, 0.6)',
                    'rgba(244, 208, 63, 0.6)',
                    'rgba(231, 76, 60, 0.6)',
                    'rgba(133, 193, 233 , 0.6)',
                ]
            }]
        }
    });
</script>
@endsection