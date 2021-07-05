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
            border-color: #00abb2;
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
            width: 5rem;
            margin: auto;
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
            width: calc(100% - (73px));
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
@endsection

@section('content')
    <div class="text-center">
        <h1 class="mb-4 text-2xl font-black leading-tight md:text-2xl lg:text-3xl">
            Áreas por jerarquía
        </h1>
    </div>


    <!-- component -->
    <div class="w-full px-8 py-4 mb-16 bg-white rounded-lg shadow-lg">
        {{-- <div class="flex justify-center -mt-16 md:justify-end">
            <img class="object-cover w-20 h-20 border-2 rounded-full" style="border-color: #00abb2;"
                src="{{ $org_foto }}">
        </div> --}}
        @if (is_null($areasTree))
            <div class="px-4 py-3 text-blue-900 bg-blue-100 border-t-4 border-blue-500 rounded-b shadow-md" role="alert">
                <div class="flex">
                    <div class="py-1"><svg class="w-6 h-6 mr-4 text-blue-500 fill-current"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path
                                d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                        </svg></div>
                    <div>
                        <p class="font-bold">Atención</p>
                        <p class="text-sm">El organigrama no se pudo generar ya que no existe un nodo raíz (CEO), defina uno
                            en el apartado de empleados <a href="{{ route('admin.empleados.index') }}"><i
                                    class="fas fa-share"></i></a></p>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <img src="{{ asset('img/OrganigramaFinal.jpg') }}" alt="No se pudo cargar el organigrama" class="mt-3"
                    style="width: 640px;height: 357px;">
            </div>
        @else
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="m-0 range-slider h-100">
                        <span class="mb-4 text-sm leading-tight md:text-sm lg:text-sm">
                            <i class="mr-1 fas fa-search-plus"></i>
                            Control de zoom
                        </span>
                        <div class="d-flex justify-content-center align-items-center" style="height: 75%">
                            <input id="zoomer" class="range-slider__range" type="range" value="70" min="10" max="200">
                            <span id="output" class="range-slider__value">70</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div id="exportData"></div> --}}
            <div class="contenedor-areas">
                <div id="chart-container" class="m-0" style="position: relative">
                    {{-- <div id="chart-side" class="sidenav" style="width: 0px"></div> --}}
                </div>
                <div class="row justify-content-end" style="position: absolute;top: 10px;right: 35px;">
                    <ul style="background: white;">
                        @foreach ($grupos as $grupo)
                            <li class="mb-2 d-flex align-items-center" data-toggle="modal"
                                data-target="#Grupo{{ $grupo->id }}" style="cursor: pointer;">
                                <div class="mr-2 cuadrado" style="border: 2px solid {{ $grupo->color }}">&nbsp;
                                </div>
                                <div>{{ $grupo->nombre }}</div>
                            </li>
                            <div class="modal fade" id="Grupo{{ $grupo->id }}" tabindex="-1"
                                aria-labelledby="Grupo{{ $grupo->id }}Label" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header"
                                            style="font-weight: bold; background: {{ $grupo->color }};">
                                            <h5 class="text-center modal-title" id="Grupo{{ $grupo->id }}Label">
                                                {{ $grupo->nombre }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
            </div>
        @endif
    </div>

@endsection
@section('scripts')
    <script type="module">
        import OrgChart from "{{ asset('orgchart/orgchart.js') }}"; // Se importan funcionalidades de OrgChart

        document.addEventListener('DOMContentLoaded', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            renderOrganigrama(OrgChart, 'l2r');

            function renderOrganigrama(OrgChart, orientacion, id = null, area_filter = false, area_id = null) {
                let areasTree = @json($areasTree);
                console.log(areasTree);
                let repositorioImagenes = @json($rutaImagenes);
                let organizacion = @json($organizacion);
                let chartContainer = document.querySelector('#chart-container');
                chartContainer.innerHTML = "";
                let div = document.createElement('div');
                div.id = 'chart-side';
                div.classList.add('sidenav');
                chartContainer.appendChild(div);

                let url_organigrama = "{{ route('admin.areas.renderJerarquia') }}";

                $.ajax({
                    type: "GET",
                    url: url_organigrama,
                    beforeSend: function() {
                        let container = document.querySelector('#chart-container');
                        let img = document.createElement('img');
                        img.classList.add('imagen-search');
                        img.src = "{{ asset('img/searching.svg') }}";
                        img.width = 500;
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
                            'depth': 4,
                            'nodeTitle': 'area',
                            'nodeContent': 'grupo_name',
                            'withImage': false,
                            // 'nodePhoto': 'foto',
                            // 'nodeRepositoryImages': repositorioImagenes,
                            // 'nodeNotPhoto': 'usuario_no_cargado.png',
                            'typeOrgChart': 'area',
                            'nodeID': 'id',
                            'pan': true,
                            'exportButton': true,
                            'exportFilename': `Organigrama de ${organizacion}`,
                            'direction': orientacion,
                            'urlExportCSV': "{{ route('admin.organigrama.exportar') }}"
                        });
                    }
                });
            }
        });
    </script>
@endsection
