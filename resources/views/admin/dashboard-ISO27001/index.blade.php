@extends('layouts.admin')
@section('content')

{{ Breadcrumbs::render('admin.analisis-brechas-2022.index') }}
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="mt-5 card">
                    <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center "
                         style="margin-top:-40px; ">
                        <h3 class="mb-2 text-center text-white"><strong>Análisis de Brechas ISO 27001</strong></h3>
                    </div>

                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 3px #3B82F6; margin-buttom:5px;">
                            <div class="row w-100">
                                <div class="text-center col-1 align-items-center d-flex justify-content-center">
                                    <div class="w-100">
                                        <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                                    </div>
                                </div>
                                <div class="col-11">
                                    <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones</p>
                                    <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Para visualizar registros actuales mantener actualizada la página</p>
                                </div>
                            </div>
                        </div>
                        <div class="container" style="margin-top: 20px;">
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
                                            <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#gaptres"
                                               role="tab" aria-controls="gaptres" aria-selected="false">GAP 03</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tabZ" data-toggle="tab" href="#dashboard"
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
                                            @include('admin.dashboard-ISO27001.introduccion')
                                            <!--introduccion-->
                                        </div>
                                        <div class="tab-pane fade" id="gapuno" role="tabpanel"
                                        aria-labelledby="profile-tab">
                                        <div class="container">
                                            <!--gap uno-->
                                            @include('admin.dashboard-ISO27001.gapuno')
                                            <!--gap uno-->
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="gapdos" role="tabpanel"
                                             aria-labelledby="contact-tab">
                                            <div class="container">
                                                <!--gap dos -->
                                            @include('admin.dashboard-ISO27001.gapdos')
                                            <!--gap dos -->
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="gaptres" role="tabpanel"
                                             aria-labelledby="contact-tab3">
                                            <div class="container">
                                                <!--gap tres-->
                                            @include('admin.dashboard-ISO27001.gaptres')
                                            <!--gap tres -->
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="dashboard" role="tabpanel"
                                             aria-labelledby="contact-tabZ">
                                             @include('admin.dashboard-ISO27001.tablero')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

<script>

// var tab_id = document.getElementById('contact-tabZ');

// tab_id.addEventListener('click', function() {
//     Swal.fire({
//         title: "<i>¡Alerta!</i>",
//         html: "Para ver registros actuales, por favor de actualizar la página",
//         confirmButtonText: "Ok",
//     });
// }, false);



    const ejecutar = document.querySelector('#btn_ejecutar');
    ejecutar.addEventListener('click', () => {
        document.getElementById('profile-tab').classList.add('active');
        document.getElementById('gapuno').classList.add('active');
        document.getElementById('gapuno').classList.add('show');


        document.getElementById('home-tab').classList.remove('active');
        document.getElementById('home').classList.remove('active');
        document.getElementById('home').classList.remove('show');
    });
</script>

@endsection

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://unpkg.com/gauge-chart@latest/dist/bundle.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script> --}}


