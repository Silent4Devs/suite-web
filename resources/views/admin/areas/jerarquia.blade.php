@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/colores.css') }}">
    <link rel="stylesheet" href="{{ asset('orgchart/orgchart.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.0-canary.13/tailwind.min.css"
        integrity="sha512-0mXZvQboEKApqdohlHGMJ/OZ09yeQa6UgZRkgG+b3t3JlcyIqvDnUMgpUm5CvlHT9HNtRm9xbRAJPlKaFCXzdQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #chart-container {
            position: relative;
            display: inline-block;
            top: 10px;
            left: 10px;
            width: calc(100% - 24px);
            /* border: 2px dashed #aaa; */
            border-radius: 5px;
            overflow: auto;
            text-align: center;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
            margin-bottom: 50px;
            height: 500px;
        }

        .orgchart .second-menu-icon {
            transition: opacity .5s;
            opacity: 0;
            right: -5px;
            top: -5px;
            z-index: 2;
            color: rgba(68, 157, 68, 0.5);
            font-size: 18px;
            position: absolute;
        }

        .orgchart .second-menu-icon:hover {
            color: #449d44;
        }

        .orgchart .node:hover .second-menu-icon {
            opacity: 1;
        }

        .orgchart .node .second-menu {
            position: absolute;
            top: 0;
            right: -70px;
            border-radius: 35px;
            box-shadow: 0 0 10px 1px #999;
            background-color: #fff;
            z-index: 1;
        }

        .avatar {
            border-color: #345183;
        }

        .orgchart.r2l .avatar {
            transform: rotate(-90deg);
        }

        .orgchart.l2r .avatar {
            transform: rotate(-90deg);
        }

        .orgchart.b2t .avatar {
            transform: rotate(180deg);
        }

        .orgchart .node {
            width: 200px;
        }

    </style>
    <style>
        /* width */
        .sidenav::-webkit-scrollbar {
            width: 7px;
        }

        /* Track */
        .sidenav::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0);
        }

        /* Handle */
        .sidenav::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 50px;
        }

        /* Handle on hover */
        .sidenav::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.5);
        }

        .sidenav {
            height: 100%;
            width: 0px;
            position: absolute;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #ffffffe8;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 0px;
            font-size: 36px;
            margin-left: 50px;
            text-align: end;
            width: 100%;
            background: #2c3e50;
            z-index: -1;
            color: white;
        }

        .sidenav .container-img-nav {
            width: 100%;
            margin-bottom: 10px;
            padding: 0 0 10px 0;
            background: #2c3e50;
        }

        .sidenav .side.img-nav {
            width: 250px;
            margin: auto;
            margin-top: -10px;
            z-index: 0;
            position: relative;
        }

        .side.nav-shadow {
            box-shadow: 5px 1px 5px -7px;
        }

        .side.title-info-nav {
            text-align: left;
            font-size: 14pt;
            font-weight: bold;
            padding: 10px;
        }

        .side.name-nav {
            font-size: 11pt;
            padding: 5px 0;
            text-align: left;
        }

        .side.title-nav {
            background-color: #374151;
            color: white;
            font-size: 13px;
            border-radius: 5px;
            padding: 5px;
            margin: 5px 10px;
        }

        .side.area-nav {
            background-color: #374151;
            color: white;
            font-size: 13px;
            border-radius: 5px;
            padding: 5px;
            margin: 5px 10px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }

        .c_more {
            text-align: left;
            margin-top: 1rem;
        }

        .c_more h4 {
            font-size: 11pt;
            font-weight: bold;
            margin-bottom: 0.6rem;
            color: #1f2937;
        }

        .c_more p.it_1,
        .c_more p.it_2,
        .c_more p.it_3,
        .c_more p.it_4,
        .c_more p.it_5 {
            font-size: 10pt;
            margin-bottom: 5px;
        }

        .c_more p.it_1 i {
            margin-right: 10px;
        }

        .c_more p.it_2 i {
            margin-right: 10px;
        }

        .c_more p.it_3 i {
            margin-right: 10px;
        }

        .c_more p.it_4 i {
            margin-right: 10px;
        }

        .c_more p.it_5 i {
            margin-right: 10px;
        }

        .c_more .supervisor .supervisor-title {
            font-size: 11pt;
            font-weight: bold;
            margin-top: 0.9rem;
            margin-bottom: 0.6rem;
            color: #1f2937;
        }

        .c_more .supervisor .supervisor-name {
            font-size: 10pt;
            margin-bottom: 5px;
        }

        .c_more .supervisor .supervisor-name i {
            margin-right: 10px;
        }

        .c_more .supervisor .supervisor-puesto {
            font-size: 10pt;
            margin-bottom: 5px;
        }

        .c_more .supervisor .supervisor-puesto i {
            margin-right: 10px;
        }

        .slider-zoom {
            position: absolute;
            top: 0;
            right: 70px;
        }

        /* #shot_screen{
                width:100% !important;
            } */

    </style>
    <style>
        .range-slider {
            margin: 10px 0 0 0%;
        }

        .range-slider {
            width: 100%;
        }

        .range-slider__range {
            -webkit-appearance: none;
            width: 100%;
            height: 10px;
            border-radius: 5px;
            background: #d7dcdf;
            outline: none;
            padding: 0;
            margin: 0;
        }

        .range-slider__range::-webkit-slider-thumb {
            appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #2c3e50;
            cursor: pointer;
            transition: background 0.15s ease-in-out;
        }

        .range-slider__range::-webkit-slider-thumb:hover {
            background: #1abc9c;
        }

        .range-slider__range:active::-webkit-slider-thumb {
            background: #1abc9c;
        }

        .range-slider__range::-moz-range-thumb {
            width: 20px;
            height: 20px;
            border: 0;
            border-radius: 50%;
            background: #2c3e50;
            cursor: pointer;
            transition: background 0.15s ease-in-out;
        }

        .range-slider__range::-moz-range-thumb:hover {
            background: #1abc9c;
        }

        .range-slider__range:active::-moz-range-thumb {
            background: #1abc9c;
        }

        .range-slider__range:focus::-webkit-slider-thumb {
            box-shadow: 0 0 0 3px #fff, 0 0 0 6px #1abc9c;
        }

        .range-slider__value {
            display: inline-block;
            position: relative;
            width: 50px;
            color: #fff;
            line-height: 20px;
            text-align: center;
            border-radius: 3px;
            background: #2c3e50;
            padding: 5px 10px;
            margin-left: 8px;
            margin-right: 19px;
        }

        .range-slider__value:after {
            position: absolute;
            top: 8px;
            left: -7px;
            width: 0;
            height: 0;
            border-top: 7px solid transparent;
            border-right: 7px solid #2c3e50;
            border-bottom: 7px solid transparent;
            content: '';
        }

        ::-moz-range-track {
            background: #d7dcdf;
            border: 0;
        }

        input::-moz-focus-inner,
        input::-moz-focus-outer {
            border: 0;
        }

    </style>
    <style>
        .orgchart.l2r {
            margin-left: -200px;
        }

        .orgchart.l2r .node .title {
            -ms-transform: none !important;
            -moz-transform: none !important;
            -webkit-transform: none !important;
            transform: none !important;
            -ms-transform-origin: unset !important;
            -moz-transform-origin: unset !important;
            -webkit-transform-origin: unset !important;
            transform-origin: unset !important;
            width: 100% !important;
            color: #3a3a3a;
            font-size: 16px;
            font-weight: 700;
        }

        .orgchart.l2r .node .content {
            -ms-transform: none !important;
            -moz-transform: none !important;
            -webkit-transform: none !important;
            transform: none !important;
            -ms-transform-origin: unset !important;
            -moz-transform-origin: unset !important;
            -webkit-transform-origin: unset !important;
            transform-origin: unset !important;
            width: 100% !important;
            mix-blend-mode: difference;
            font-size: 14px;
        }

        .orgchart.l2r .node .symbol {
            margin-right: -68px;
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
            background-color: #717171;
        }

        .orgchart.l2r .node:first-child {
            width: 300px;
            height: 70px;
            transform: rotate(-90deg) rotateY(180deg);
            transform-origin: center;
            margin-bottom: 115px;
            border: 1px solid;
            border-radius: 10px;
        }

        .orgchart.l2r .node {
            width: 300px;
            transform: rotate(-90deg) rotateY(180deg);
            transform-origin: center;
            margin-top: 115px;
            border: 1px solid;
            border-radius: 10px;
            margin-left: -110px;
            margin-right: -110px;
        }

        .cuadrado {
            width: 15px;
            height: 15px;
            border: 2px solid;
            border-radius: 5px;
        }

        .contenedor-areas {
            position: relative;
        }

    </style>

    <style>
        .menulogin {
            width: 40%;
            height: auto;
            position: fixed;
            z-index: 30;
            top: 200px;
            left: 35%;
            background-color: rgba(255, 255, 255, 10);
            border-radius: 20px;
            /* redondear bordes (esquinas)*/
            /* box-shadow: 3px 3px 3px #707070; */
            /*sombra del elemento-desplazamiento x-desplazamiento y-desenfoque-color*/

        }

        .btnCerrar {
            width: 25px;
            height: 25px;
            color: #ffffff;
            font-size: 13pt;
            text-align: center;
            line-height: 1.5;
            float: right;
            margin-right: 30px;
            margin-top: 10px;
            cursor: pointer;

        }

        .caja_btn_a {
            width: 100%;
            height: auto;
            text-align: center;
        }

        .caja_btn_a a {
            padding: 15px;
            margin-top: 10px;
            color: #345183;
            display: inline-block;
        }

        .caja_btn_a a:hover,
        .btn_a_seleccionado {
            border-bottom: 2px solid #345183;
            margin-bottom: -2px;
            margin-right: 10px;
        }

        #chart-container {
            /* background-color:red; */
            /* z-index:1 !important; */
            position: relative !important;
        }

        .charContainerAll {
            /* background-color:yellow; */
            z-index: 0 !important;
            position: relative !important;
        }

        .caja_grupos {
            left: 20px;
            transition: 0.5s !important;
            margin-left: -200px;
            position: absolute;
            top: 30px;
            background: white;
            z-index: 1;
        }

        .grupos_funciones .caja_grupos {
            margin-left: 0px;
            /* transition:0.5s !important; */

        }

        .btn_grupos {
            transform: rotate(0deg);
            transition: 0.5s;
        }

        .grupos_funciones .btn_grupos {
            transform: rotate(180deg);
        }

        .modal-backdrop {
            display: none;
        }

        .caja_grupos ul {
            transition: 0.5s !important;
        }

        .btn_iconos_areas {
            margin-top: 15px;
            transform: scale(1.25);
        }

        .text-center.img_empleado{
            margin:auto !important;
        }

        @media(min-width:2000px) {
            .contenido_blanco {
                padding-bottom: 300px !important;
            }
        }

    </style>
@endsection
@section('content')
    {{ Breadcrumbs::render('areas-render') }}


    <h5 class="col-12 titulo_general_funcion" style="font-size:20px;">Áreas de {{ $organizacion->empresa ? $organizacion->empresa : 'La Organización' }}</h5>
    <!-- component -->
    <div class="w-full px-6 py-4 mb-16 bg-white rounded-lg shadow-lg contenido_blanco">

        @if (!$areasTree)
            <div class="px-4 py-3 text-blue-900 bg-blue-100 border-t-4 border-blue-500 rounded-b shadow-md" role="alert">
                <div class="row w-100">
                    <div class="text-center col-1 align-items-center d-flex justify-content-center">
                        <div class="w-100">
                            <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                        </div>
                    </div>
                    <div class="col-11">
                        <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Atención</p>
                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Aún no se han agregado áreas a la
                            organización
                            <a href="{{ route('admin.grupoarea.index') }}" class="item-right col-2 btn text-light"
                                style="background-color:rgb(85, 217, 226); float:right">Agregar</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <img src="{{ asset('img/areas_fondo.jpg') }}" class="mt-3" style="height: 400px;">
            </div>
        @else
            <div class="caja_botones_menu">
                <div class="caja_botones_menu">
                    <a href="#" data-tabs="contenido2" class="btn_activo"><i class="mr-2 bi bi-boxes" style="font-size:30px;"></i> Áreas por
                        Grupo</a>
                    <a href="#" data-tabs="contenido1"><i class="mr-2 bi bi-diagram-3"
                            style="font-size:30px;" style="text-decoration:none;"></i> Áreas por Jerarquia</a>

                </div>
            </div>
            <div class="caja_caja_secciones">
                <div class="caja_secciones">
                    <section id="contenido1">
                        <div class="row">
                            <div class="col-8">
                                <div class="m-0 range-slider h-100">
                                    <span class="mb-4 text-sm leading-tight md:text-sm lg:text-sm">
                                        <i class="mr-1 fas fa-search-plus"></i>
                                        Control de zoom
                                    </span>
                                    <div class="d-flex justify-content-center align-items-center"
                                        style="height: 75%; width:100% !important;">
                                        <input id="zoomer" class="range-slider__range" type="range" value="70" min="10"
                                            max="200">
                                        <span id="output" class="range-slider__value">70</span>
                                    </div>
                                </div>
                            </div>

                            <div class="btn_iconos_areas" id="export_csv"></div>
                            <div class="btn_iconos_areas" id="shot_screen"></div>
                            <div class="col-lg-1 col-sm-12" style="position: relative;">
                                <div class="pl-0 col-3" style="position: absolute;top: 20px;left: 0;">
                                    <button class="btn btn-lg" id="reloadOrg" title="Recargar organigrama"
                                        style="font-size: 13pt;outline: none"><i class="fas fa-redo-alt"></i></button>
                                </div>
                            </div>
                        </div>




                        {{-- <div id="exportData"></div> --}}
                        <div class="contenedor-areas grupos_funciones">
                            <i class="fas fa-caret-right btn_grupos" title="Ver grupos"
                                style="position:absolute; top:0; font-size:25pt; cursor:pointer;"></i>
                            <div class="row caja_grupos">
                                <ul style="max-width: 200px !important; overflow:hidden !important;">
                                    @foreach ($grupos as $grupo)
                                        <li class="mb-2 d-flex align-items-center" data-toggle="modal"
                                            data-target="#Grupo{{ $grupo->id }}" style="cursor: pointer;">
                                            <div class="mr-2 cuadrado" style="border: 3px solid {{ $grupo->color }}">
                                                &nbsp;
                                            </div>
                                            <div>{{ $grupo->nombre }}</div>
                                        </li>
                                        <div class="modal fade" id="Grupo{{ $grupo->id }}" tabindex="-1"
                                            aria-labelledby="Grupo{{ $grupo->id }}Label" aria-hidden="true">
                                            <div
                                                class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header"
                                                        style="font-weight: bold; background: {{ $grupo->color }};">
                                                        <h5 class="text-center modal-title"
                                                            id="Grupo{{ $grupo->id }}Label">
                                                            {{ $grupo->nombre }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            @foreach ($grupo->areas as $area)
                                                                <div class="col-sm-6 col-lg-6">
                                                                    <div class="card"
                                                                        style="border-top: 3px solid {{ $grupo->color }} !important;">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title"
                                                                                style="font-weight:bold; font-size:13pt; position: relative;">
                                                                                <i class="mr-1 fas fa-building"></i>
                                                                                {{ $area->area }}
                                                                                <div
                                                                                    style="width: 10px; height: 10px; border-radius:100%; position: absolute; top:-15px; right:-15px;background: {{ $grupo->color }};">
                                                                                    &nbsp;
                                                                                </div>
                                                                            </h5>
                                                                            <blockquote class="mb-0 blockquote">
                                                                                <p style="font-size: 13px">Descripción</p>
                                                                                <footer class="blockquote-footer">
                                                                                    {{ $area->descripcion }}
                                                                                </footer>
                                                                            </blockquote>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                            <div id="chart-container" class="m-0" style="position: relative">
                                {{-- <div id="chart-side" class="sidenav" style="width: 0px"></div> --}}
                            </div>
                        </div>

                    </section>

                    <section id="contenido2" class="mt-4 caja_tab_reveldada">
                        <div class="col-12 text-right">
                            <a href="{{ route('admin.areas.exportar') }}" class="mr-5"><i class="fas fa-file-csv"
                                    style="font-size:18pt;"></i></a>
                            <a href="{{ route('admin.areas.exportar') }}" class="mr-5"><i class="fas fa-camera"
                                    style="font-size:18pt;"></i></a>
                        </div>
                        <div class="row">


                            <div class="col-sm-12 col-12 col-lg-{{ count($areas_sin_grupo) ? '9' : '12' }}">
                                @if ($numero_grupos > 0)
                                    <div class="justify-content-center">
                                        @foreach ($grupos as $grupo)
                                            <div style="width:calc(100% - 8px); margin-left:5px;">
                                                <div class="mt-3 card justify-content-center"
                                                    style="box-shadow: 0px 0px 0px 2px {{ $grupo->color }}!important;">
                                                    <div class="row justify-content-center">
                                                        <div class="col-3 card justify-content-center"
                                                            style="margin-top:-18px; background-color:{{ $grupo->color }}!important;">
                                                            <p class="text-center text-white">{{ $grupo->nombre }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="container">
                                                        <div class="row justify-content-center">
                                                            @foreach ($grupo->areas as $area)
                                                                <div class="mb-3 ml-2 mr-2 bg-white rounded col-3 sesioninicio"
                                                                    style="height:40px; border:1px solid #ccc !important"
                                                                    onclick="renderModal(this,'{{ $area->area }}', '{{ $area->descripcion }}', '{{ $grupo->color }}')">
                                                                    <p class="text-center"
                                                                        style="cursor:pointer border:1px solid #ccc !important">
                                                                        {{ $area->area }}
                                                                    </p>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="menulogin d-none" style="border:solid 3px rgb(163, 163, 163);">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            @if (count($areas_sin_grupo))
                                <div class="col-sm-12 col-12 col-lg-3">
                                    <h3 class="text-center"><i class="mr-2 fas fa-exclamation-triangle"></i>Áreas sin
                                        grupo asignado
                                    </h3>
                                    <ul class="mt-3 list-group">
                                        @foreach ($areas_sin_grupo as $area)
                                            <a href="{{ route('admin.areas.edit', $area) }}"
                                                class="mb-1 list-group-item list-group-item-action" title="Asignar Grupo"><i
                                                    class="fab fa-adn "></i> {{ $area->area }}</a>
                                        @endforeach
                                    </ul>

                                </div>
                            @endif
                        </div>
                    </section>
                </div>
            </div>
        @endif
    </div>
@endsection
@section('scripts')

    <script>
        $(".btn_grupos").click(function() {
            $(".contenedor-areas").toggleClass("grupos_funciones");
        });
    </script>

    <script type="module">
        import OrgChart from "{{ asset('orgchart/orgchart.js') }}"; // Se importan funcionalidades de OrgChart

        document.addEventListener('DOMContentLoaded', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            renderOrganigrama(OrgChart, 'l2r');

            $("#reloadOrg").click(function(e) {
                e.preventDefault();

                document.querySelector("#zoomer").value = 70;
                document.querySelector("#output").innerHTML = 70;
                renderOrganigrama(OrgChart, 'l2r');
            });

            function renderOrganigrama(OrgChart, orientacion, id = null, area_filter = false, area_id = null) {
                let areasTree = @json($areasTree);
                let repositorioImagenes = @json($rutaImagenes);
                let organizacion = @json($organizacion);
                let chartContainer = document.querySelector('#chart-container');
                chartContainer.innerHTML = "";
                let div = document.createElement('div');
                div.id = 'chart-side';
                div.classList.add('sidenav');
                chartContainer.appendChild(div);

                let url_organigrama = "{{ route('admin.areas.obtenerJerarquia') }}";

                document.querySelector('#export_csv').innerHTML = "";
                document.querySelector('#shot_screen').innerHTML = "";
                $.ajax({
                    type: "GET",
                    url: url_organigrama,
                    beforeSend: function() {
                        let container = document.querySelector('#chart-container');
                        let img = document.createElement('img');
                        img.classList.add('imagen-search');
                        img.src = "{{ asset('img/searching.svg') }}";
                        img.width = 0;
                        img.style.margin = 'auto';
                        let texto = document.createElement('h3');
                        texto.classList.add('texto-search');
                        texto.innerText = "Buscando información...";
                        texto.style.marginTop = '30px';
                        texto.style.marginBottom = '20px';
                        texto.style.fontSize = '12pt';
                        texto.style.fontWeight = '600';
                        container.appendChild(texto);
                        container.appendChild(img);
                    },
                    success: function(response) {
                        console.log(JSON.parse(response));
                        let container = document.querySelector('.imagen-search');
                        container.src = "";
                        document.querySelector('.texto-search').innerHTML = "";

                        let orgchart = new OrgChart({
                            'chartContainer': '#chart-container',
                            'zoomSlider': '#zoomer',
                            'data': JSON.parse(response),
                            'depth': 999,
                            'nodeTitle': 'area',
                            'nodeContent': 'area',
                            'withImage': false,
                            // 'nodePhoto': 'foto',
                            // 'nodeRepositoryImages': repositorioImagenes,
                            // 'nodeNotPhoto': 'usuario_no_cargado.png',
                            'typeOrgChart': 'area',
                            'nodeID': 'id',
                            'pan': true,
                            'exportButton': true,
                            'exportFilename': `Jerarquia de Areas`,
                            'direction': orientacion,
                            // 'urlExportCSV': "{{ route('admin.areas.exportar') }}"
                        });
                    }
                });
            }
        });
    </script>


    <script>
        function renderModal(element, nombre, descripcion, color) {
            //element.style.border = `2px solid ${color!=null?color:"black"}`;

            let contenedor = document.querySelector(".menulogin");
            contenedor.classList.remove("d-none")
            contenedor.classList.add("d-block")
            contenedor.innerHTML = `


                <div class="btnCerrar" style="color:${color}">X</div>
                                <div class="row justify-content-center">
                                    <div class="ml-5 mt-5 bg-white rounded shadow-sm col-12 justify-content-center" style=" background-color:${color}!important">
                                        <p class="text-center text-white"> ${nombre} </p>
                                    </div>

                                </div>

                                <p class="mb-5 text-justify ml-4 mr-4" style="margin-top:20px;" >${descripcion}</p>
                                `;
            let btnCerrar = document.querySelector(".btnCerrar");
            btnCerrar.addEventListener("click", function(e) {
                e.preventDefault();
                // element.style.border = "none";
                contenedor.classList.remove("d-block")
                contenedor.classList.add("d-none")
            });


        }
    </script>


    <script type="text/javascript">
        $(".caja_btn_a a").click(function() {
            $(".caja_btn_a a").removeClass("btn_a_seleccionado");
            $(".caja_btn_a a:hover").addClass("btn_a_seleccionado");
            $("#contenido1").removeClass("d-block");

        });
    </script>





@endsection
