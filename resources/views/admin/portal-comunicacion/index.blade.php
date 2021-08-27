@extends('layouts.admin')
@section('content')
    {{-- @can('planes_accion_access') --}}
    <style>
        @import url(https://fonts.googleapis.com/css?family=Muli:400, 300);

        .calendar,
        .calendar_weekdays,
        .calendar_content {
            max-width: 300px;
        }

        .calendar {
            margin: auto;
            font-family: 'Muli', sans-serif;
            font-weight: 400;
        }

        .calendar_content,
        .calendar_weekdays,
        .calendar_header {
            position: relative;
            overflow: hidden;
        }

        .calendar_weekdays div {
            display: inline-block;
            vertical-align: top;
        }

        .calendar_weekdays div,
        .calendar_content div {
            width: 14.28571%;
            overflow: hidden;
            text-align: center;
            background-color: transparent;
            color: #6f6f6f;
            font-size: 12px;
        }

        .calendar_content div {
            border: 1px solid transparent;
            float: left;
        }

        .calendar_content div:hover {
            border: 1px solid #dcdcdc;
            cursor: default;
        }

        .calendar_content div.blank:hover {
            cursor: default;
            border: 1px solid transparent;
        }

        .calendar_content div.past-date {
            color: #d5d5d5;
        }

        .calendar_content div.today {
            font-weight: bold;
            font-size: 12px;
            color: #1040dd;
            border: 1px solid #dcdcdc;
        }

        .calendar_content div.selected {
            background-color: #f0f0f0;
        }

        .calendar_header {
            width: 100%;
            text-align: center;
        }

        .calendar_header h2 {
            padding: 5px 10px;
            font-family: 'Muli', sans-serif;
            font-weight: 300;
            font-size: 12px;
            color: #1040dd;
            float: left;
            width: 70%;
            margin: 0 0 10px;
        }

        button.switch-month {
            background-color: transparent;
            padding: 0;
            outline: none;
            border: none;
            color: #dcdcdc;
            float: left;
            width: 15%;
            transition: color .2s;
        }

        button.switch-month:hover {
            color: #1040dd;
        }

    </style>
    <style>
        .c_main,
        .container-fluid {
            padding: 0 !important;
            padding-top: 0 !important;
        }

        .btn-silent {
            width: 100%;
            border: 2px solid #00abb2;
            background-color: transparent;
            padding: 7px 10px;
            border-radius: 8px;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .btn-silent:hover {
            background-color: #00abb2;
            color: white;

        }

    </style>
    <div class="card" style="margin-top: -30px;">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center "
            style="margin-top:0px !important; ">
            <h3 class="mb-2 text-center text-white"
                style="background: #00abb2;color: white !important;padding: 5px;border-radius: 8px;"><strong>Portal de
                    Comunicación </strong></h3>
        </div>

        @include('partials.flashMessages')
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-12 col-lg-3">
                    <div class="p-3 text-center card" id="clima" style="position:relative; background:aliceblue;"></div>
                    <div class="p-3 card" style="background:aliceblue;">
                        <div class="calendar calendar-first" id="calendar_first">
                            <div class="calendar_header">
                                <button class="switch-month switch-left"> <i class="fa fa-chevron-left"></i></button>
                                <h2></h2>
                                <button class="switch-month switch-right"> <i class="fa fa-chevron-right"></i></button>
                            </div>
                            <div class="calendar_weekdays"></div>
                            <div class="calendar_content"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-12 col-lg-7">
                    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('images/casco-romano-o-griego-spartan-helmet-vector-enojado-del-gráfico-de-la-historieta-cara-guerrero-105830864.jpg') }}"
                                    class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>First slide label</h5>
                                    <p>Some representative placeholder content for the first slide.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/casco-romano-o-griego-spartan-helmet-vector-enojado-del-gráfico-de-la-historieta-cara-guerrero-105830864.jpg') }}"
                                    class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Second slide label</h5>
                                    <p>Some representative placeholder content for the second slide.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/casco-romano-o-griego-spartan-helmet-vector-enojado-del-gráfico-de-la-historieta-cara-guerrero-105830864.jpg') }}"
                                    class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Third slide label</h5>
                                    <p>Some representative placeholder content for the third slide.</p>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-sm-12 col-12 col-lg-2">
                    <button class="btn-silent"><i class="mr-2 fas fa-gopuram"></i> Organización</button>
                    <button class="btn-silent"><i class="mr-2 fas fa-sitemap"></i> Organigrama</button>
                    <button class="btn-silent"><i class="mr-2 fas fa-folder"></i> Documentos</button>
                    <button class="btn-silent"><i class="mr-2 fas fa-file"></i> Política SGSI</button>
                    <button class="btn-silent"><i class="mr-2 fas fa-users"></i> Comité del SGSI</button>
                    <button class="btn-silent"><i class="mr-2 fas fa-plus"></i> Beneficios</button>
                    <button class="btn-silent"><i class="mr-2 fas fa-hand-paper"></i> Reportar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- @endcan --}}
@endsection
@section('scripts')
    <script src="{{ asset('js/calendar-comunicado.js') }}"></script>
    <script>
        /*SEARCH BY USING A CITY NAME (e.g. athens) OR A COMMA-SEPARATED CITY NAME ALONG WITH THE COUNTRY CODE (e.g. athens,gr)*/
        /*SUBSCRIBE HERE FOR API KEY: https://home.openweathermap.org/users/sign_up*/
        const apiKey = "4d8fb5b93d4af21d66a2948710284366";
        let city = 'Mexico';
        const url =
            `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric&lang=es`;

        obtenerClima(url);

        async function obtenerClima(url) {
            let api = await fetch(url);
            let response = await api.json();
            let climaContenedor = document.getElementById('clima');
            const icon = `https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/${response.weather[0]["icon"]}.svg`;
            climaContenedor.innerHTML = `
            <h2 class="m-3"><i class="fas fa-globe-americas" style="font-size: 24px;"></i> ${response.name}</h2>
            <h4 style="display: flex;justify-content: center;">
                <strong style="font-size: 35px;">${Math.ceil(response.main.temp)}</strong>
                <span style="font-size:12px">°C</span>
            </h4>
            <span style="text-transform:capitalize;">${response.weather[0]["description"]}</span>
            <hr>
            <img src="${icon}" style="position: absolute;top: -40px;right: -20px;width: 100px;height: 100px;">
            <div class="row">
                <div class="col-12">
                    <p class="m-0">Sensación Real</p>
                    <strong style="display: flex;justify-content: center;">${Math.ceil(response.main.feels_like)} <span style="font-size:10px">°C</span></strong>
                </div>
                <div class="col-6">
                    <p class="m-0">Temp. Min</p>
                    <strong style="display: flex;justify-content: center;">${Math.ceil(response.main.temp_min)} <span style="font-size:10px">°C</span></strong>
                </div>
                <div class="col-6">
                    <p class="m-0">Temp. Máx</p>
                    <strong style="display: flex;justify-content: center;">${Math.ceil(response.main.temp_max)} <span style="font-size:10px">°C</span></strong>
                </div>
            </div>
            `;
            console.log(response);
        }
    </script>
    <script src="{{ asset('js/calendario-comunicacion.js') }}"></script>
@endsection
