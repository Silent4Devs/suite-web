@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">

                <div class="card mt-5">
                    <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center "
                         style="margin-top:-40px; ">
                        <h3 class="mb-2  text-center text-white"><strong>ANÁLISIS DE BRECHAS ISO 27001</strong></h3>
                    </div>

                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="container">

                            <div class="row">
                                <div class="col">
                                    <ul class="nav nav-pills nav-justified" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                               role="tab" aria-controls="home" aria-selected="true">INTRODUCCIÓN</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#gapuno"
                                               role="tab" aria-controls="gapuno" aria-selected="false">GAP 01</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#gapdos"
                                               role="tab" aria-controls="gapdos" aria-selected="false">GAP 02</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#gaptres"
                                               role="tab" aria-controls="gaptres" aria-selected="false">GAP03</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#dashboard"
                                               role="tab" aria-controls="dashboard" aria-selected="false">DASHBOARD</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                                             aria-labelledby="home-tab">
                                            <!--introduccion-->
                                        @include('dashboard.introduccion')
                                        <!--introduccion-->
                                        </div>
                                        <div class="tab-pane fade" id="gapuno" role="tabpanel"
                                             aria-labelledby="profile-tab">
                                            <div class="container">
                                                <!--gap uno-->
                                            @include('dashboard.gapuno')
                                            <!--gap uno-->
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="gapdos" role="tabpanel"
                                             aria-labelledby="contact-tab">
                                            <div class="container">
                                                <!--gap dos -->
                                            @include('dashboard.gapdos')
                                            <!--gap dos -->
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="gaptres" role="tabpanel"
                                             aria-labelledby="contact-tab">
                                            <div class="container">
                                                <!--gap tres-->
                                            @include('dashboard.gaptres')
                                            <!--gap tres -->
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="dashboard" role="tabpanel"
                                             aria-labelledby="contact-tab">
                                                @include('dashboard.tablero')
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <!--<div class="row">
                        <div class="{{ $chart1->options['column_class'] }}">
                            <h3>{!! $chart1->options['chart_title'] !!}</h3>
                            {!! $chart1->renderHtml() !!}
                            </div>
                            <div class="{{ $chart2->options['column_class'] }}">
                            <h3>{!! $chart2->options['chart_title'] !!}</h3>
                            {!! $chart2->renderHtml() !!}
                            </div>
                            <div class="{{ $chart3->options['column_class'] }}">
                            <h3>{!! $chart3->options['chart_title'] !!}</h3>
                            {!! $chart3->renderHtml() !!}
                            </div>
                        </div>-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <!--<script
        src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>{!! $chart1->renderJs() !!}{!! $chart2->renderJs() !!}{!! $chart3->renderJs() !!}-->
@endsection

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://unpkg.com/gauge-chart@latest/dist/bundle.js"></script>
<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
