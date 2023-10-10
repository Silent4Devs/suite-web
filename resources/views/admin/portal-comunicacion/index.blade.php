@extends('layouts.frontend')
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

        .modal-dialog {
            margin-top: 170px !important;
        }
    </style>
    <style>
        .c_main,
        .container-fluid {
            padding: 0 !important;
            padding-top: 0 !important;
        }

        .btn-silent {
            display: block;
            width: 100%;
            position: relative;
            color: #747474 !important;
            text-decoration: underline;
            padding: 10px 0;
            cursor: pointer;
        }

        .btn-silent:before {
            content: "";
            position: absolute;
            width: 0%;
            height: 1px;
            bottom: 5px;
            background-color: #345183;
            transition: 0.3s;
            z-index: 1;
        }

        .btn-silent:after {
            /*content: "";
                        position: absolute;
                        width: 100%;
                        height: 2px;
                        bottom: 5px;
                        background-color: #e6e6e6;
                        transition: 0.4s;
                        left: 0;
                        z-index: 0;*/
        }

        .btn-silent:hover:before {
            width: 100%;
        }

        .btn-silent i {
            font-size: 15pt;
        }

        .btn-silent span {
            position: absolute;
            left: 50px;
        }

        .btn-silent:hover {
            color: #345183 !important;
        }
    </style>
    <style type="text/css">
        .titulo-seccion {
            font-size: 20px;
            margin-bottom: 0px;
            border-bottom: 2px solid #ccc;
            padding-bottom: 7px;
            padding-left: 20px;
        }

        .titulo-seccion i {
            margin-left: -18px;
            font-size: 17pt;
        }


        .carousel-item {
            text-align: center;
            background-color: #f1f1f1;
        }

        .img_carrusel {
            height: 320px !important;
            opacity: 0.8;

            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: all;
        }

        .carousel-caption {
            z-index: 3;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }

        .carousel-inner h5 {
            text-shadow: 0px 0px 3px #000 !important;
            text-align: left;
            z-index: 1;
            background-color: rgba(255, 255, 255, 0.2);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            padding: 7px;
            opacity: 0;
            transition: 0.2s;
            text-align: center;
        }

        .carousel-inner:hover h5 {
            opacity: 1;
        }

        .carousel-inner p {
            display: none;
        }

        .carousel-control-prev,
        .carousel-control-next {
            opacity: 1 !important;
            z-index: 3;
        }

        .carousel-indicators li {
            opacity: 1 !important;
        }

        .carousel-indicators li.active {
            opacity: 1 !important;
            background-color: #345183 !important;
        }


        .comunicado {
            display: flex;
            height: 200px;
            align-items: center;
            justify-content: space-between;
        }

        .comunicado {
            /*margin-top: 10px;*/
        }

        .img_comunicado {
            width: 33.3%;
            height: 160px;

            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: all;
        }

        .text_comunicado {
            width: calc(100% - 200px);
            padding: 0 40px;

        }

        .text_comunicado p {
            text-align: justify;
        }


        .doc_publicado {
            display: flex;
            align-items: center;
            position: relative;
            padding-top: 7px;
            box-sizing: border-box;
            border-radius: 7px;
        }

        .doc_publicado {
            margin-top: 20px;
        }

        .icon_doc {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 20%;
        }

        .icon_doc i {
            font-size: 35pt;
            color: #1E94A8;
            transition: 0.1s;
        }

        .icon_doc i:hover {
            transform: scale(1.1);
            filter: brightness(1.2);
        }

        .text_doc {
            width: 60%;
        }

        .text_doc h5 {
            font-size: 16px;
        }

        .text_doc p {
            font-size: 12px;
        }

        .text_doc .badge {
            background-color: #1E94A8;
            color: #fff;
        }

        .opciones_doc {
            width: 20%;
            text-align: right;
        }

        .opciones_doc {
            font-size: 12px;
        }

        .img_empleado {
            height: 40px;
            width: auto;
            clip-path: circle(20px at 50% 50%);
        }



        .cuadro_empleados {
            position: sticky;
            top: 56px;
            height: auto;
            max-height: 600px;
            overflow-y: auto;
        }

        @media(max-with: 1000px) {
            .cuadro_empleados {
                position: relative !important;
                height: auto !important;
            }
        }


        .caja_nuevo {}

        .nuevo {
            text-align: center;
            background-color: #f3f3f3;
            padding: 10px;
            margin-bottom: 10px;
        }

        .nombre_nuevo {
            font-size: 14px;
            text-align: center;
            width: 100%;
            margin-top: 10px;
            font-weight: medium;
            color: #345183;
        }

        .img_nuevo {
            width: 100%;
            text-align: center;
        }

        .img_nuevo img {
            height: 50px;
            clip-path: circle(25px at 50% 50%);
        }

        .datos_nuevo {
            width: 100%;
            font-size: 14px !important;
            margin-top: 21px;
            font-weight: lighter;
        }

        .datos_nuevo h6 {
            margin: 0;
            font-weight: medium;
        }

        .datos_nuevo p {
            margin: 0;
            margin-bottom: 4px;
            line-height: 20px;
            margin-top: -5px;
        }

        .btn_link_agenda {
            all: unset;
            font-size: 11pt;
            color: #345183;
            cursor: pointer;
            transition: 0.09;
        }

        .opciones_felicitar {
            display: flex;
            justify-content: space-between;
        }

        .opciones_felicitar i {
            color: #345183;
            font-size: 15pt;
            cursor: pointer;
        }

        .modal-backdrop.fade.show {
            display: none !important;
        }

        .carrusel-modal .modal-dialog {
            margin-top: 30px !important;
        }

        .carousel-indicators {
            z-index: 5 !important;
        }
    </style>


    <div class="card" style="box-shadow: none; background-color: transparent;">


        @include('partials.flashMessages')

        <div class="card-body">
            <div class="row">
                <h5 class="col-12 titulo_general_funcion">Portal de Comunicación </h5>

                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-12 col-12 col-lg-4">
                            <div class="card" id="clima"
                                style="padding:5px !important; background-color: #FFF9F0 !important;"></div>
                            <div class="card"
                                style="position: relative; padding: 5px !important; background-color:#DFECFF !important;">
                                <a href="{{ asset('admin/system-calendar') }}" class="btn_link_agenda" style=""
                                    title="Agenda organizacional"><i class="fas fa-calendar-alt"></i></a>
                                <div class="calendar calendar-first" id="calendar_first" style="">
                                    <div class="calendar_header">
                                        <button class="switch-month switch-left"> <i
                                                class="fa fa-chevron-left"></i></button>
                                        <h2></h2>
                                        <button class="switch-month switch-right"> <i
                                                class="fa fa-chevron-right"></i></button>
                                    </div>
                                    <div class="calendar_weekdays"></div>
                                    <div class="calendar_content"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-12 col-lg-8">
                            <div id="carouselExampleCaptions" class="carousel slide card" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    {{-- <li data-target="#carouselExampleCaptions" data-slide-to=""
                                    class="active"></li> --}}
                                    @foreach ($comunicacionSgis_carrusel as $idx => $carrusel)
                                        <li data-target="#carouselExampleCaptions" data-slide-to="{{ $idx }}"
                                            class="{{ $idx == 0 ? 'active' : '' }}"></li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    {{-- <div class="carousel-item active">
                                        <div class="img_carrusel" style="background-image: url('{{ asset('img/Carrusel_inicio.png') }}');">
                                        </div>
                                            <div class="carousel-caption d-none d-md-block">
                                            </div>
                                    </div> --}}
                                    @forelse($comunicacionSgis_carrusel as $idx=>$carrusel)
                                        @php
                                            if ($carrusel->first()->count()) {
                                                if ($carrusel->imagenes_comunicacion->first()) {
                                                    $imagen = 'storage/imagen_comunicado_SGI/' . $carrusel->imagenes_comunicacion->first()->imagen;
                                                }
                                            } else {
                                                $imagen = 'img/tabantaj_fondo_blanco.png';
                                            }
                                            
                                        @endphp
                                        @if ($carrusel->imagenes_comunicacion->first()->tipo == 'video')
                                            <div class="carousel-item {{ $idx == 0 ? 'active' : '' }}" data-toggle="modal"
                                                data-target="#comunicado_carrusel_modal{{ $idx }}"
                                                style="cursor: pointer;">
                                                <div class="img_carrusel"
                                                    style="display: flex; justify-content: center; align-items: center;">
                                                    <video muted controls src="{{ asset($imagen) }}" width="100%"></video>
                                                </div>
                                            </div>
                                        @else
                                            <div class="carousel-item {{ $idx == 0 ? 'active' : '' }}" data-toggle="modal"
                                                data-target="#comunicado_carrusel_modal{{ $idx }}"
                                                style="cursor: pointer;">
                                                <div class="img_carrusel"
                                                    style="background-image: url('{{ asset($imagen) }}');">
                                                </div>
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h5>{{ $carrusel->titulo }}</h5>
                                                </div>
                                            </div>
                                        @endif
                                    @empty
                                        <div class="carousel-item active">
                                            <div class="img_carrusel"
                                                style="background-image: url('{{ asset('img/Carrusel_inicio.png') }}');">
                                            </div>
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5>Sin Comunicados</h5>
                                                <p></p>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>



                                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>

                        {{-- modal carrusel --}}
                        @foreach ($comunicacionSgis_carrusel as $idx => $carrusel)
                            @if ($carrusel->imagenes_comunicacion->first()->tipo == 'video')
                                <div class="modal fade carrusel-modal" id="comunicado_carrusel_modal{{ $idx }}"
                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document" style="max-width: 75% !important;">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <a
                                                    href="{{ $carrusel->link }}">{{ Str::limit($carrusel->link, 50, '...') }}</a>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <video muted controls
                                                    src="{{ asset('storage/imagen_comunicado_SGI/' . $carrusel->imagenes_comunicacion->first()->imagen) }}"
                                                    width="100%"></video>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="modal fade carrusel-modal" id="comunicado_carrusel_modal{{ $idx }}"
                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document" style="max-width: 75% !important;">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <a
                                                    href="{{ $carrusel->link }}">{{ Str::limit($carrusel->link, 50, '...') }}</a>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <img src="{{ asset('storage/imagen_comunicado_SGI/' . $carrusel->imagenes_comunicacion->first()->imagen) }}"
                                                    style="width: 100%;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        <div class="col-lg-12">
                            @can('portal_comunicacion_mostrar_comunicados')
                                <div class="card card-body">
                                    <h2 class="titulo-seccion mb-3" style="font-weight:normal;"><i
                                            class="mr-3 far fa-newspaper"></i>Comunicados</h2>
                                    @forelse($comunicacionSgis as $comunicacionSgi)
                                        <div class="comunicado" style="position:relative;">
                                            @php
                                                if ($comunicacionSgi->first()->count()) {
                                                    if ($comunicacionSgi->imagenes_comunicacion->first()) {
                                                        $imagen = 'storage/imagen_comunicado_SGI/' . $comunicacionSgi->imagenes_comunicacion->first()->imagen;
                                                    }
                                                } else {
                                                    $imagen = 'img/portal_404.png';
                                                }
                                                
                                            @endphp

                                            {{-- {{ asset('public/storage/imagen_comunicado_SGI/'. $comunicacionSgi->imagenes_comunicacion->first()->imagen) }} --}}
                                            @if ($comunicacionSgi->imagenes_comunicacion->first()->tipo == 'video')
                                                <div class="img_comunicado"
                                                    style="display:flex; justify-content: center; align-items:center;">
                                                    <video autoplay muted controls src="{{ asset($imagen) }}"
                                                        width="100%"></video>
                                                </div>
                                            @else
                                                <div class="img_comunicado"
                                                    style="background-image: url('{{ asset($imagen) }}');">
                                                </div>
                                            @endif
                                            <div class="text_comunicado">
                                                <h4 class="w-100 mb-4" style="font-size:16px;">
                                                    {{ $comunicacionSgi->titulo }}</h4>

                                                <div
                                                    style="text-align:left !important; overflow:hidden; height:100px !important;  padding:0px; display:block !important; justify-content:start !important;">
                                                    {!! $comunicacionSgi->descripcion !!}
                                                </div>
                                                <a href="{{ asset('admin/comunicacion-sgis/' . $comunicacionSgi->id) }}"
                                                    style="font-size:12px;">Leer
                                                    más</a>
                                            </div>
                                        </div>

                                        <hr style="margin: 18px 0;">
                                    @empty
                                        <div class="comunicado" style="position:relative;">
                                            <div class="img_comunicado"
                                                style="background-image: url('{{ asset('img/portal_404.png') }}');"></div>
                                            <div class="text_comunicado">
                                                <h4 class="w-100">Sin comunicados que mostar</h4>
                                                <p class="w-100">

                                                </p>
                                                <a href=""></a>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            @endcan
                            @can('portal_comunicacion_mostrar_documentos_publicados')
                                <div class="card card-body">
                                    <h2 class="titulo-seccion" style="font-weight:normal;"><i
                                            class="mr-3 far fa-file-alt"></i>Documentos publicados </h2>
                                    @forelse($documentos_publicados as $documento)
                                        <div class="doc_publicado">
                                            <div class="icon_doc">
                                                <a href="{{ route('admin.documentos.renderViewDocument', $documento->id) }}"
                                                    title="Ver documento">
                                                    <i class="bi bi-file-earmark-pdf"></i>
                                                </a>
                                            </div>
                                            <div class="text_doc">
                                                <h5>{{ Str::limit($documento->codigo . ' - ' . $documento->nombre . '', 50, '...') }}
                                                </h5>
                                                <p>
                                                    Se ha publicado el documento {{ $documento->codigo }}
                                                    {{ $documento->nombre }} el
                                                    10/10/21.
                                                </p>
                                                <p>
                                                    <span class="badge"
                                                        style="text-transform: capitalize">{{ $documento->tipo }}</span>
                                                    @if ($documento->macroproceso_id)
                                                        <span class="badge"
                                                            style="text-transform: capitalize">{{ $documento->macroproceso->nombre }}</span>
                                                    @endif
                                                    @if ($documento->proceso_id)
                                                        <span class="badge"
                                                            style="text-transform: capitalize">{{ $documento->proceso->nombre }}</span>
                                                    @endif
                                                    <span style="color:#1E94A8; margin-left:20px;"><i class="fas fa-eye"></i>
                                                        <strong>{{ $documento->no_vistas }}</strong></span>
                                                </p>
                                            </div>
                                            <div class="opciones_doc">
                                                <p>Responsable:</p>
                                                <img src="{{ asset('storage/empleados/imagenes/') }}/{{ $documento->responsable ? $documento->responsable->avatar : 'user.png' }}"
                                                    class="img_empleado"
                                                    title="{{ $documento->responsable ? $documento->responsable->name : 'Sin dato' }}"><br />
                                                <a href="{{ route('admin.documentos.renderViewDocument', $documento->id) }}">Ver
                                                    documento</a>
                                            </div>
                                        </div>

                                        <hr style="margin: 18px 0;">
                                    @empty
                                        <div class="comunicado" style="position:relative;">
                                            <div class="img_comunicado"
                                                style="background-image: url('{{ asset('img/no_docs.svg') }}'); transform: scale(0.8);">
                                            </div>
                                            <div class="text_comunicado">
                                                <h4 class="w-100">Sin documentos que mostar</h4>
                                                <p class="w-100">

                                                </p>
                                            </div>

                                        </div>
                                    @endforelse
                                </div>
                            @endcan
                        </div>

                    </div>
                </div>
                <div class="col-sm-3">
                    @livewire('eventos-portal')
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
            <p class="" style="text-align:left; margin:0;">
                <i class="fas fa-globe-americas" style="font-size:;"></i>
                ${response.name}
            </p>
            <div style="text-align:left; margin:0 ; display:inline-block;">
                <div style="font-size:7pt; width:100px; text-align:left; float:left;">
                    <img src="${icon}" style="width:40px; margin-top:-13px;">
                    <strong style="font-size: 27px;">${Math.ceil(response.main.temp)}</strong>
                    <span style="font-size:12px">°C</span>
                </div>
                <div style="font-size:7pt; width:90px; text-align:left; margin-top: 5px; float:left; text-transform: capitalize;">
                    <strong>${response.weather[0]["description"]}</strong> <br>
                    ${Math.ceil(response.main.temp_max)}<sup>°</sup>/
                    ${Math.ceil(response.main.temp_min)}<sup>°</sup>
                    Temp.${Math.ceil(response.main.feels_like)}<sup>°C</sup>
                </div>
            </div>
            `;
                console.log(response);
            }
        </script>
        <script src="{{ asset('js/calendario-comunicacion.js') }}"></script>
    @endsection
