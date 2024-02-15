@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/colores.css') }}{{config('app.cssVersion')}}">
    <link rel="stylesheet" href="{{ asset('orgchart/orgchart.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.0-canary.13/tailwind.min.css"
        integrity="sha512-0mXZvQboEKApqdohlHGMJ/OZ09yeQa6UgZRkgG+b3t3JlcyIqvDnUMgpUm5CvlHT9HNtRm9xbRAJPlKaFCXzdQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
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
            border-bottom: 3px solid#2c3e50;
            padding: 0 0 10px 0;
            background: #2c3e50;
        }

        .sidenav .side.img-nav {
            width: 5rem;
            margin: auto;
            clip-path: circle(50% at 50% 50%);
            background: white;
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
            background-color: #345183;
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

        .supervisor img {
            height: 80px !important;
        }
    </style>
@endsection

@section('content')

    <h5 class="col-12 titulo_general_funcion" style="font-size:20px; font-weight: bold;">Organigrama de
        {{ $organizacion }}
    </h5>



    <!-- component -->
    <div id="contenedorOrganigrama" style="position: relative" class="w-full px-8 py-4 mb-16 bg-white rounded-lg shadow-lg">
        {{-- <div class="flex justify-center -mt-16 md:justify-end">
            <img class="object-cover w-20 h-20 border-2 rounded-full" style="border-color: #345183;"
                src="{{ $org_foto }}">
        </div> --}}
        @if (is_null($organizacionTree))
            <div class="px-4 py-3 text-blue-900 bg-blue-100 border-t-4 border-blue-500 rounded-b shadow-md" role="alert">
                <div class="flex">
                    <div class="py-1"><svg class="w-6 h-6 mr-4 text-blue-500 fill-current"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path
                                d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                        </svg></div>
                    <div>
                        <p class="font-bold">Atención</p>
                        <p class="text-sm">El organigrama no se pudo generar ya que no existe un nodo raíz (CEO),
                            defina uno
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
                <div class="m-0 mt-3 col-lg-8 col-md-12 col-sm-12" style="margin: 0px !important">
                    <div class="form-group col-sm-12 col-md-12 col-lg-12 w-100" style="margin: 0px !important">
                        <div class="row">
                            <div class="col-sm-12 col-lg-4">
                                <input type="hidden" id="id_empleado">
                                <label for="participantes_search"> <span
                                        class="mb-4 text-sm leading-tight md:text-sm lg:text-sm">
                                        <i class="mr-1 fas fa-user-circle"></i>
                                        Empleado
                                    </span></label>
                                <input class="form-control" type="search" id="participantes_search"
                                    placeholder="Nombre del empleado" style="position: relative" autocomplete="off" />
                                <i id="cargando_participantes" class="fas fa-cog fa-spin text-muted"
                                    style="position: absolute; top: 42px; right: 18px;"></i>
                                <div id="participantes_sugeridos" style="position: absolute;width: 90%;z-index: 1;"></div>
                                @if ($errors->has('participantes'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('participantes') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="areas"> <span class="text-sm leading-tight md:text-sm lg:text-sm">
                                        <i class="mr-1 fas fa-building"></i>
                                        Área
                                    </span></label>
                                <select name="areas" id="areas" class="form-control">
                                    <option value="" selected disabled>-- Selecciona área --</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}">
                                            <span><i class="mr-1 fas fa-building"></i></span> {{ $area->area }}
                                        </option>
                                    @endforeach
                                    <option id="ver_todos_option" value=null>
                                        <span><i class="mr-1 fas fa-building">Todas las areas</i></span>
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-4" id="tools_box">
                                <p class="m-0">
                                    <i class="mr-1 fas fa-box-open"></i>
                                    Caja de Herramientas
                                </p>
                                <div class="row h-100 align-items-center" style="margin-top: -12px;">
                                    <div class="pl-0 col-3">
                                        <button class="btn btn-lg" id="reloadOrg" title="Recargar organigrama"
                                            style="margin-top: 0.4rem; font-size: 13pt;"><i
                                                class="fas fa-redo-alt"></i></button>
                                    </div>
                                    <div class="col-3">
                                        <div class="mt-2 d-flex justify-content-center">
                                            <img src="{{ asset('orgchart/orientation_assests/top.png') }}"
                                                alt="Orientacion" id="orientacion" style="cursor:pointer; width:20px;"
                                                title="Cambiar orientación del diagrama">
                                        </div>
                                    </div>
                                    <div class="pl-0 col-3" id="export_csv"></div>
                                    <div class="pl-0 col-3" id="shot_screen"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="m-0 range-slider h-100">
                        <span class="mb-4 text-sm leading-tight md:text-sm lg:text-sm">
                            <i class="mr-1 fas fa-search-plus"></i>
                            Control de zoom
                        </span>
                        <div class="d-flex justify-content-center align-items-center" style="height: 75%">
                            <input id="zoomer" class="range-slider__range" type="range" value="30" min="10"
                                max="200">
                            <span id="output" class="range-slider__value">30</span>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div id="exportData"></div> --}}
            <div id="chart-container" class="m-0" style="position: relative">
                {{-- <div id="chart-side" class="sidenav" style="width: 0px"></div> --}}
            </div>
        @endif
    </div>
    {{-- Cargando... --}}
    {{-- <div id="cargandoInformacionAnimated" style="position: absolute; top:250px; right:500px;display: none;">
        <i class="fas fa-circle-notch fa-spin" style="font-size: 80px;"></i>
    </div> --}}
    {{-- End cargando... --}}

@endsection
@section('scripts')
    <script type="module">
        import OrgChart from "{{ asset('orgchart/orgchart.js') }}"; // Se importan funcionalidades de OrgChart

        document.addEventListener('DOMContentLoaded', function() {
            let orientaciones = ['t2b', 'l2r', 'r2l', 'b2t'];
            let imagenOrientaciones = ['top.png', 'left.png', 'right.png', 'bottom.png']
            let orientacion = orientaciones[0];
            let img = document.getElementById('orientacion');
            img.src = `{{ asset('orgchart/orientation_assests/') }}/${imagenOrientaciones[0]}`;
            let contador = 0;
            if (localStorage.getItem('orientationOrgChart') != null) {
                orientacion = localStorage.getItem('orientationOrgChart');
                let imgOrientacion = 'top.png';
                switch (orientacion) {
                    case 't2b':
                        imgOrientacion = 'top.png';
                        break;
                    case 'l2r':
                        imgOrientacion = 'left.png';
                        break;
                    case 'r2l':
                        imgOrientacion = 'right.png';
                        break;
                    case 'b2t':
                        imgOrientacion = 'bottom.png';
                        break;
                    default:
                        imgOrientacion = 'top.png';
                        break;
                }
                img.src = `{{ asset('orgchart/orientation_assests/') }}/${imgOrientacion}`;
                const posicionIdx = (element) => element == orientacion;
                contador = orientaciones.findIndex(posicionIdx);
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            renderOrganigrama(OrgChart, orientacion);

            $("#cargando_participantes").hide();
            let url_empleados = "{{ route('admin.empleados.lista') }}";
            let timeout = null;
            let inputSearchEmpleados = document.getElementById('participantes_search');
            $('#participantes_search').on('search', function() {
                $("#participantes_sugeridos").hide();
            });
            $("#participantes_search").keyup(function() {
                // Clear the timeout if it has already been set.
                // This will prevent the previous task from executing
                // if it has been less than <MILLISECONDS>
                clearTimeout(timeout);
                // Make a new timeout set to go off in 1000ms (1 second)
                // let textEscrito = $(this).val();
                if (inputSearchEmpleados.value.trim() != '') {
                    timeout = setTimeout(function() {
                        $.ajax({
                            type: "POST",
                            url: url_empleados,
                            data: 'nombre=' + inputSearchEmpleados.value,
                            beforeSend: function() {
                                $("#cargando_participantes").show();
                            },
                            success: function(data) {
                                $("#cargando_participantes").hide();
                                $("#participantes_sugeridos").show();
                                let sugeridos = document.querySelector(
                                    "#participantes_sugeridos");
                                let lista =
                                    `<ul class='list-group' id='empleados-lista'>`;
                                data ? JSON.parse(data).forEach(usuario => {
                                        lista += `<button type='button' class='px-2 py-1 text-muted list-group-item list-group-item-action'
                                    onClick='seleccionarUsuario("${usuario.id}","${usuario.name}","${usuario.email}");'>
                                    <i class='mr-2 fas fa-user-circle'></i>
                                    ${usuario.name}</button>
                                `;
                                    }) : lista +=
                                    '<li class="list-group-item list-group-item-action">Sin coincidencias encontradas</li>';
                                lista += `</ul>`;
                                console.log(lista);
                                sugeridos.innerHTML = lista;
                                $("#participantes_search").css("background", "#FFF");
                            }
                        });
                        if (inputSearchEmpleados.value == '') {
                            orientacion = localStorage.getItem('orientationOrgChart');
                            renderOrganigrama(OrgChart, orientacion, null);
                        }
                    }, 500);
                } else {
                    $("#participantes_sugeridos").hide();
                }
            });

            window.seleccionarUsuario = function(id, name, email) {
                $('.areas').val(null).trigger('change');
                document.querySelector("#zoomer").value = 70;
                document.querySelector("#output").innerHTML = 70;
                orientacion = localStorage.getItem('orientationOrgChart');
                document.getElementById("contenedorOrganigrama").style.pointerEvents = 'none';
                renderOrganigrama(OrgChart, orientacion, id);
                $("#participantes_search").val(name);
                $("#id_empleado").val(id);
                $("#email").val(email);
                $("#participantes_sugeridos").hide();
            }

            function renderOrganigrama(OrgChart, orientacion, id = null, area_filter = false, area_id = null) {
                let organizacionTree = @json($organizacionTree);
                let repositorioImagenes = @json($rutaImagenes);
                let organizacion = @json($organizacion);
                let chartContainer = document.querySelector('#chart-container');
                chartContainer.innerHTML = "";
                let div = document.createElement('div');
                div.id = 'chart-side';
                div.classList.add('sidenav');
                chartContainer.appendChild(div);
                // let buttonExport = document.querySelector("#exportData");
                // let buttonE = document.createElement('button');
                // buttonE.classList.add('btn');
                // buttonE.classList.add('btn-sm');
                // buttonE.classList.add('btn-outline-primary');
                // buttonE.innerHTML = "<i class='fas fa-file-code'></i>";
                // buttonE.onclick = function(e) {
                //     console.log("Exportando");
                // }
                // buttonExport.appendChild(buttonE);
                let url_organigrama = "{{ route('admin.organigrama.index') }}";
                let data = {
                    "area_filter": false,
                    id
                };
                if (area_filter) {
                    data = {
                        "area_filter": true,
                        area_id
                    }
                }
                document.querySelector('#export_csv').innerHTML = "";
                document.querySelector('#shot_screen').innerHTML = "";
                $.ajax({
                    type: "GET",
                    data,
                    url: url_organigrama,
                    beforeSend: function() {
                        let container = document.querySelector('#chart-container');
                        let img = document.createElement('img');
                        img.classList.add('imagen-search');
                        img.src = "{{ asset('img/searching.svg') }}";
                        img.width = 400;
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
                        const empleado = document.querySelector('#participantes_search');
                        const areas = document.querySelector('#areas');
                        empleado.setAttribute('disabled');
                        areas.setAttribute('disabled');
                    },
                    success: function(response) {
                        let container = document.querySelector('.imagen-search');
                        container.src = "";
                        document.querySelector('.texto-search').innerHTML = "";
                        let orgchart = new OrgChart({
                            'chartContainer': '#chart-container',
                            'zoomSlider': '#zoomer',
                            'data': JSON.parse(response.replaceAll('children_organigrama',
                                'children')),
                            'depth': 999,
                            'nodeContent': 'puesto',
                            'withImage': true,
                            'nodePhoto': 'foto',
                            'nodeRepositoryImages': repositorioImagenes,
                            'nodeNotPhoto': 'usuario_no_cargado.png',
                            'nodeID': 'id',
                            'pan': true,
                            'exportButton': true,
                            'exportFilename': `Organigrama de ${organizacion}`,
                            'direction': orientacion,
                            'urlExportCSV': "{{ route('admin.organigrama.exportar') }}"
                        });
                        const empleado = document.querySelector('#participantes_search');
                        const areas = document.querySelector('#areas');
                        empleado.removeAttribute('disabled');
                        areas.removeAttribute('disabled');
                        document.getElementById("contenedorOrganigrama").style.pointerEvents =
                            'all';
                    },
                    error: function(error) {
                        let imagen = document.querySelector('.imagen-search');
                        imagen.src = "";
                        document.querySelector('.texto-search').innerHTML = "";
                        let container = document.querySelector('#chart-container');
                        let img = document.createElement('img');
                        img.classList.add('imagen-search');
                        img.src = "{{ asset('img/empleados_no_encontrados.svg') }}";
                        img.width = 350;
                        img.style.margin = 'auto';
                        let texto = document.createElement('h3');
                        texto.classList.add('texto-search');
                        texto.innerText =
                            "No se encontraron empleados de acuerdo a los criterios de búsqueda";

                        texto.style.marginBottom = '20px';
                        texto.style.fontSize = '12pt';
                        texto.style.fontWeight = '600';
                        container.appendChild(texto);
                        container.appendChild(img);
                        const empleado = document.querySelector('#participantes_search');
                        const areas = document.querySelector('#areas');
                        empleado.removeAttribute('disabled');
                        areas.removeAttribute('disabled');
                    }
                });
            }

            let areas = document.querySelector("#areas");
            areas.addEventListener('change', function(event) {
                if ($("#areas option:selected").attr("id") != "ver_todos_option") {
                    let area_id = event.target.value;
                    orientacion = localStorage.getItem('orientationOrgChart');
                    renderOrganigrama(OrgChart, orientacion, null, true, area_id);
                }
            });
            $('.areas').select2({
                theme: 'bootstrap4',
            });
            $('.areas').on('select2:select', function(e) {
                let area_id = e.params.data.id;
                if (document.querySelector("#participantes_search").value != "") {
                    document.querySelector("#participantes_search").value = "";
                }
                document.querySelector("#zoomer").value = 30;
                document.querySelector("#output").innerHTML = 30;
                document.getElementById("contenedorOrganigrama").style.pointerEvents = 'none';
                renderOrganigrama(OrgChart, orientacion, null, true, area_id);
            });


            document.querySelector('#areas').addEventListener('change', function(e) {
                e.preventDefault();
                if ($("#areas option:selected").attr("id") == "ver_todos_option") {
                    document.getElementById("contenedorOrganigrama").style.pointerEvents = 'none';
                    $('.areas').val(null).trigger('change');
                    document.querySelector("#participantes_search").value = "";
                    document.querySelector("#zoomer").value = 30;
                    document.querySelector("#output").innerHTML = 30;
                    contador = 0;
                    orientacion = orientaciones[contador];
                    localStorage.setItem('orientationOrgChart', orientaciones[contador]);
                    img.src =
                        `{{ asset('orgchart/orientation_assests/') }}/${imagenOrientaciones[contador]}`;
                    renderOrganigrama(OrgChart, orientacion);
                    console.log("funcion");
                }

            });

            $("#reloadOrg").click(function(e) {
                e.preventDefault();
                document.getElementById("contenedorOrganigrama").style.pointerEvents = 'none';
                $('.areas').val(null).trigger('change');
                document.querySelector("#participantes_search").value = "";
                document.querySelector("#zoomer").value = 30;
                document.querySelector("#output").innerHTML = 30;
                contador = 0;
                orientacion = orientaciones[contador];
                localStorage.setItem('orientationOrgChart', orientaciones[contador]);
                img.src =
                    `{{ asset('orgchart/orientation_assests/') }}/${imagenOrientaciones[contador]}`;
                renderOrganigrama(OrgChart, orientacion);
            });

            $("#orientacion").click(function(e) {
                e.preventDefault();
                document.getElementById("contenedorOrganigrama").style.pointerEvents = 'none';
                document.querySelector("#zoomer").value = 30;
                document.querySelector("#output").innerHTML = 30;
                let orientacion;
                if (contador < 3) {
                    ++contador;
                    orientacion = orientaciones[contador];
                    localStorage.setItem('orientationOrgChart', orientaciones[contador]);
                    img.src =
                        `{{ asset('orgchart/orientation_assests/') }}/${imagenOrientaciones[contador]}`;
                } else if (contador == 3) {
                    contador = 0;
                    orientacion = orientaciones[contador];
                    localStorage.setItem('orientationOrgChart', orientaciones[contador]);
                    img.src =
                        `{{ asset('orgchart/orientation_assests/') }}/${imagenOrientaciones[contador]}`;
                } else {
                    contador = 0;
                    orientacion = orientaciones[contador];
                    localStorage.setItem('orientationOrgChart', orientaciones[contador]);
                    img.src =
                        `{{ asset('orgchart/orientation_assests/') }}/${imagenOrientaciones[contador]}`;
                }
                renderOrganigrama(OrgChart, orientacion);
            });
        });
    </script>
@endsection
