@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/portalCommunication/index.css') }}{{ config('css/app.cssVersion') }}">
@endsection
@section('content')
    <div>
        @if ($user->empleado)
            <div class="d-flex justify-content-center align-items-center" style="gap: 25px;">
                <div class="img-person" style="width: 100px; height: 100px;">
                    <img src="{{ asset('storage/empleados/imagenes/' . '/' . $user->empleado->avatar) }}"
                        alt="{{ $user->empleado->name }}">
                </div>
                <div class="caja-input-search">
                    <span style="font-size: 20px;"> <strong>
                            Bienvenido&nbsp;{{ $user->empleado ? explode(' ', $user->empleado->name)[0] : '' }},
                        </strong> </span>
                    <span> ¿Qué&nbsp;quieres&nbsp;hacer&nbsp;hoy? </span>
                    <span> | </span>
                    @livewire('global-search-component', ['lugar' => 'portal'])
                    <i class="material-symbols-outlined icon-mic">search</i>
                </div>
            </div>
        @endif

        <div class="mt-5">
            <div class="row">
                <div class="col-xl-5 d-flex" style="flex-direction: column;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-gadgets">
                                <div class="d-flex justify-content-center align-items-center" style="gap: 13px;">
                                    <div id="clima" class="mt-3"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex">
                            <div class="card card-gadgets w-100">
                                <div class="d-flex justify-content-center align-items-center" style="gap: 13px;">
                                    <i class="material-symbols-outlined" style="font-size: 70px;">schedule</i>
                                    <span style="font-size: 26px;" id="hora-portal"> </span>
                                    <sup style="font-size: 12px;" id="med-portal>"></sup>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="flex-grow: 1; padding-bottom: 22px;">
                        <div class="col-12">
                            <div class="div4 card card-body h-100">
                                <h4 style="font-size: 30px;" id="fecha-completa">
                                    {{-- Fecha --}}
                                </h4>

                                <div class="calendar calendar-first" id="calendar_first" style="">
                                    <div class="calendar_header">
                                        <h2></h2>
                                        <button class="switch-month switch-left btn">
                                            <i class="fa fa-chevron-left"></i>
                                        </button>
                                        <button class="switch-month switch-right btn">
                                            <i class="fa fa-chevron-right"></i>
                                        </button>
                                    </div>
                                    <div class="calendar_weekdays"></div>
                                    <div class="calendar_content"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-7" style="">
                    <div class="card carrusel-vertical-boletin" style="background-color: #F8E1E1;">
                        <div class="card-body">
                            <h4 class="title-card-portal-c">Boletín</h4>
                            <div class="caja-img-carrusel-vertical">
                                <img id="comunicado-carrusel-primer-item" src="{{ asset('img/Carrusel_inicio.png') }}"
                                    class="item-main-carrusel active">
                                @foreach ($comunicacionSgis_carrusel as $idx => $carrusel)
                                    @if ($carrusel->imagenes_comunicacion->first()->tipo == 'video')
                                        <video id="comunicado-carrusel-{{ $carrusel->id }}" muted controls
                                            src="{{ asset('storage/imagen_comunicado_SGI/' . $carrusel->imagenes_comunicacion->first()->imagen) }}"
                                            width="100%" class=" item-main-carrusel"></video>
                                    @else
                                        <img id="comunicado-carrusel-{{ $carrusel->id }}"
                                            src="{{ asset('storage/imagen_comunicado_SGI/' . $carrusel->imagenes_comunicacion->first()->imagen) }}"
                                            class=" item-main-carrusel"
                                            onerror="this.src='{{ asset('img/Carrusel_inicio.png') }}'; this.onerror=null;">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="menu-carrusel-vertical scroll_estilo">
                            <div class="caja-img-menu-crr-vertical" onclick="boletin('comunicado-carrusel-primer-item')">
                                <img src="{{ asset('img/Carrusel_inicio.png') }}" alt="">
                            </div>
                            @foreach ($comunicacionSgis_carrusel as $idx => $carrusel)
                                @if ($carrusel->imagenes_comunicacion->first()->tipo == 'video')
                                    <div class="caja-img-menu-crr-vertical"
                                        onclick="boletin('comunicado-carrusel-{{ $carrusel->id }}')"
                                        data-id="comunicado-carrusel-{{ $carrusel->id }}">
                                        <img src="{{ asset('img/example-remove/play_video.png') }}" alt=""
                                            onerror="this.src='{{ asset('img/Carrusel_inicio.png') }}'; this.onerror=null;">
                                    </div>
                                @else
                                    <div class="caja-img-menu-crr-vertical"
                                        onclick="boletin('comunicado-carrusel-{{ $carrusel->id }}')"
                                        data-id="comunicado-carrusel-{{ $carrusel->id }}">
                                        <img src="{{ asset('storage/imagen_comunicado_SGI/' . $carrusel->imagenes_comunicacion->first()->imagen) }}"
                                            alt=""
                                            onerror="this.src='{{ asset('img/Carrusel_inicio.png') }}'; this.onerror=null;">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-5">
                    <div class="row">
                        <div class="col-12">
                            <div class=" card card-body">
                                <h4 class="title-card-portal-c">Aplicaciones más usadas</h4>
                                <div class="d-flex justify-content-between" style="gap: 22px; flex-wrap:wrap;">

                                    <a href="{{ route('admin.timesheet-create') }}" class="item-app-mu">
                                        Timesheet
                                    </a>

                                    <a href="{{ route('admin.inicio-Usuario.index') }}" class="item-app-mu">
                                        Mi perfil
                                    </a>

                                    <a href="{{ route('admin.systemCalendar') }}" class="item-app-mu">
                                        Calendario
                                    </a>

                                    <a href="{{ route('admin.desk.index') }}" class="item-app-mu">
                                        Centro de atención
                                    </a>

                                    <a href="{{ asset('admin/recursos') }}" class="item-app-mu">
                                        Capacitaciones
                                    </a>

                                    <a href="{{ route('admin.iso27001.inicio-guia') }}" class="item-app-mu">
                                        Gestión Normativa
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class=" card card-body">
                                        <h4 class="title-card-portal-c"> Menú </h4>

                                        <div class="menu-portal">
                                            @can('mi_organizacion_acceder')
                                                <a href="{{ route('admin.organizacions.index') }}">
                                                    <div class="item-menu-portal">
                                                        <i class="material-symbols-outlined">corporate_fare</i>
                                                        <span>Organización</span>
                                                    </div>
                                                </a>
                                            @endcan
                                            @can('documentos_publicados_acceder')
                                                <a href="{{ route('admin.documentos.publicados') }}">
                                                    <div class="item-menu-portal">
                                                        <i class="material-symbols-outlined">description</i>
                                                        <span>Documentos Publicados</span>
                                                    </div>
                                                </a>
                                            @endcan
                                            @can('sedes_acceder')
                                                <a href="{{ route('admin.sedes.index') }}">
                                                    <div class="item-menu-portal">
                                                        <i class="material-symbols-outlined">home_pin</i>
                                                        <span>Sedes</span>
                                                    </div>
                                                </a>
                                            @endcan
                                            @can('politica_sistema_gestion_acceder')
                                                <a href="{{ route('admin.politica-sgsis.visualizacion') }}">
                                                    <div class="item-menu-portal">
                                                        <i class="material-symbols-outlined">local_library</i>
                                                        <span>Políticas</span>
                                                    </div>
                                                </a>
                                            @endcan
                                            @can('crear_area_acceder')
                                                <a href="{{ route('admin.areas.index') }}">
                                                    <div class="item-menu-portal">
                                                        <i class="material-symbols-outlined">mitre</i>
                                                        <span>Áreas</span>
                                                    </div>
                                                </a>
                                            @endcan
                                            @can('comformacion_comite_seguridad_acceder')
                                                <a href="{{ route('admin.comiteseguridads.index') }}">
                                                    <div class="item-menu-portal">
                                                        <i class="material-symbols-outlined">partner_exchange</i>
                                                        <span>Comités</span>
                                                    </div>
                                                </a>
                                            @endcan
                                            @can('portal_comunicacion_mostrar_mapa_de_procesos')
                                                <a href="{{ route('admin.procesos.mapa') }}">
                                                    <div class="item-menu-portal">
                                                        <i class="material-symbols-outlined">flowsheet</i>
                                                        <span>Mapa de procesos</span>
                                                    </div>
                                                </a>
                                            @endcan
                                            @can('organigrama_acceder')
                                                <a href="{{ route('admin.organigrama.index') }}">
                                                    <div class="item-menu-portal">
                                                        <i class="material-symbols-outlined">schema</i>
                                                        <span>Organigrama</span>
                                                    </div>
                                                </a>
                                            @endcan
                                            @can('analisis_foda_acceder')
                                                <a href="{{ route('admin.foda-organizacions') }}">
                                                    <div class="item-menu-portal">
                                                        <i class="material-symbols-outlined">border_all</i>
                                                        <span>FODA</span>
                                                    </div>
                                                </a>
                                            @endcan
                                            @can('portal_comunicacion_mostrar_directorio')
                                                <a href="{{ route('admin.directorio.index') }}">
                                                    <div class="item-menu-portal">
                                                        <i class="material-symbols-outlined">person_book</i>
                                                        <span>Directorio</span>
                                                    </div>
                                                </a>
                                            @endcan
                                            @can('determinacion_alcance_acceder')
                                                <a href="{{ route('admin.alcance-sgsis/visualizacion') }}">
                                                    <div class="item-menu-portal">
                                                        <i class="material-symbols-outlined">table_chart_view</i>
                                                        <span>Alcances</span>
                                                    </div>
                                                </a>
                                            @endcan
                                            @can('escuela_estudiante')
                                                <a href="{{ asset('/admin/mis-cursos') }}">
                                                    <div class="item-menu-portal">
                                                        <i class="material-symbols-outlined">school</i>
                                                        <span>Capacitaciones</span>
                                                    </div>
                                                </a>
                                            @endcan
                                            {{-- @can('mi_perfil_acceder')
                                                <a href="{{ route('admin.solicitud') }}">
                                                    <div class="item-menu-portal">
                                                        <i class="material-symbols-outlined">assignment_turned_in</i>
                                                        <span>Solicitudes</span>
                                                    </div>
                                                </a>
                                            @endcan --}}
                                            {{-- @can('portal_de_comunicaccion_acceder')
                                            <a href="{{ route('admin.portal-comunicacion.index') }}">
                                                <div class="item-menu-portal active">
                                                    <i class="material-symbols-outlined">home</i>
                                                    <span>Inicio</span>
                                                </div>
                                            </a>
                                        @endcan --}}
                                            {{-- @can('mi_perfil_acceder')
                                                <a href="{{ route('admin.inicio-Usuario.index') }}">
                                                    <div class="item-menu-portal">
                                                        <i class="material-symbols-outlined">account_circle</i>
                                                        <span>Perfil</span>
                                                    </div>
                                                </a>
                                            @endcan
                                            @can('timesheet_acceder')
                                                <a href="{{ route('admin.timesheet-create') }}">
                                                    <div class="item-menu-portal">
                                                        <i class="material-symbols-outlined">date_range</i>
                                                        <span>Timesheet</span>
                                                    </div>
                                                </a>
                                            @endcan
                                            @can('calendario_organizacional_acceder')
                                                <a href="{{ route('admin.systemCalendar') }}">
                                                    <div class="item-menu-portal">
                                                        <i class="material-symbols-outlined">calendar_today</i>
                                                        <span>Calendario</span>
                                                    </div>
                                                </a>
                                            @endcan
                                            @can('katbol_requisiciones_acceso')
                                                <a href="{{ asset('contract_manager/requisiciones') }}">
                                                    <div class="item-menu-portal">
                                                        <i class="material-symbols-outlined">contract</i>
                                                        <span>Requisiciones </span>
                                                    </div>
                                                </a>
                                            @endcan
                                            @can('control_documentar_acceder')
                                                <a href="{{ route('admin.documentos.index') }}">
                                                    <div class="item-menu-portal">
                                                        <i class="material-symbols-outlined">description</i>
                                                        <span>Documentos</span>
                                                    </div>
                                                </a>
                                            @endcan
                                            @can('portal_comunicacion_mostrar_reportar')
                                                <a href="{{ asset('admin/portal-comunicacion/reportes') }}">
                                                    <div class="item-menu-portal">
                                                        <i class="material-symbols-outlined">flag</i>
                                                        <span>Reportar</span>
                                                    </div>
                                                </a>
                                            @endcan --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 d-flex" style="flex-direction: column;">
                    <div class="card card-body scroll_estilo" style="flex-grow: 1; height: 500px; overflow: auto;">
                        <h4 class="title-card-portal-c"> Comunicados</h4>
                        @forelse($comunicacionSgis as $comunicacionSgi)
                            @php
                                if ($comunicacionSgi->first()->count()) {
                                    if ($comunicacionSgi->imagenes_comunicacion->first()) {
                                        $imagen =
                                            'storage/imagen_comunicado_SGI/' .
                                            $comunicacionSgi->imagenes_comunicacion->first()->imagen;
                                    }
                                } else {
                                    $imagen = 'img/portal_404.png';
                                }

                            @endphp
                            <div class="comunicado-item-portal">
                                <div width="100%">
                                    <h4 class="title-comunicado-portal">{{ $comunicacionSgi->titulo }}</h4>

                                    <span>Publicado:
                                        {{ \Carbon\Carbon::parse($comunicacionSgi->created_at)->format('d-m-Y') }}</span>
                                    <div class="descript-com">
                                        {!! $comunicacionSgi->descripcion !!}
                                    </div>
                                    <a href="{{ asset('admin/comunicacion-sgis/' . $comunicacionSgi->id) }}"
                                        style="font-size:12px;">Leer más</a>
                                </div>
                                <div class="caja-img-comunicados-portal">
                                    @if ($comunicacionSgi->imagenes_comunicacion->first()->tipo == 'video')
                                        <video autoplay muted controls src="{{ asset($imagen) }}"
                                            class="img-vid-com"></video>
                                    @else
                                        <img class="img-vid-com" src="{{ asset($imagen) }}" alt="">
                                    @endif
                                </div>
                            </div>
                            <hr class="my-4">

                        @empty
                            <img src="{{ asset('img/sincomunicados.png') }}" alt=""
                                style="width: 300px; margin:0px auto;">
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-body" style="background-color: #E6E0E9;">
                    <h4 class="title-card-portal-c"> Últimos Documentos</h4>
                    <div class="caja-documentos">
                        @forelse($documentos_publicados as $documento)
                            <a href="{{ asset('admin/documentos/' . $documento->id . '/view-document') }}">
                                <div class="doc-item-portal">
                                    <img src="{{ asset('img/desk_portal_docs.png') }}" alt="">
                                    <div class="doc-info">
                                        <span
                                            class="title-doc-portal">{{ Str::limit($documento->codigo . ' - ' . $documento->nombre . '', 50, '...') }}</span>
                                        <span style="font-size: 12px;">
                                            Publicado: {{ Carbon\Carbon::parse($documento->fecha)->format('d/m/Y') }}
                                        </span>
                                        <div class="caja-doc-etiquetas mt-2">

                                            <span>{{ $documento->tipo }}</span>
                                            @if ($documento->macroproceso_id)
                                                <span>{{ $documento->macroproceso->nombre }}</span>
                                            @endif
                                            @if ($documento->proceso_id)
                                                <span>{{ isset($documento->proceso->nombre) }}</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="doc-responsable">
                                        <span style="font-size: 10px;">Responsable</span>
                                        <div class="img-person" style="width:50px; height:50px;">
                                            <img src="{{ asset('storage/empleados/imagenes/') }}/{{ $documento->responsable ? $documento->responsable->avatar : 'user.png' }}"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                        @endforelse

                    </div>
                </div>
            </div>
        </div>

        @if (isset($nuevos))
            @if ($nuevos->count() != 0)
                <div class="card-body">
                    <h3 class="title-card-portal-c">Nuevos ingresos</h3>

                    <div class="carrusel-portal carr-port-nuevo">
                        <button onclick="carruselPortal('retreat');">
                            <i class="material-symbols-outlined">arrow_back_ios</i>
                        </button>
                        <div class="caja-items-carrusel-portal">
                            @foreach ($nuevos as $nuv)
                                <div class="item-carrusel-portal">
                                    <div class="img-person" style="width: 80px; height: 80px;">
                                        <img src="{{ $nuv->avatar_ruta }}" alt="">
                                    </div>
                                    <div>
                                        <span class="title-item-carr-port">{{ $nuv->name }} </span> <br>
                                        <p>
                                            {{ $nuv->puestoRelacionado->puesto ?? '' }} <br>
                                            {{ $nuv->area->area }}
                                        </p>
                                    </div>
                                    <hr>
                                    {{-- @php
                                    $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                                    $fecha = \Carbon\Carbon::createFromFormat('Y-m-d', $nuv->cumpleaños);
                                    $mes = $meses[$fecha->format('n') - 1];
                                    $inputs['Fecha'] = $fecha->format('d') . ' de ' . $mes;
                                @endphp --}}
                                    <div>
                                        <strong> Fecha de ingreso </strong> <br>
                                        {{ \Carbon\Carbon::parse($nuv->antiguedad)->format('d/m/Y') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button onclick="carruselPortal('advance');">
                            <i class="material-symbols-outlined">arrow_forward_ios</i>
                        </button>
                    </div>
                </div>
            @endif
        @endif

        @if (isset($cumpleaños))
            @if ($cumpleaños->count() != 0)
                <div class="card-body">
                    <h3 class="title-card-portal-c mt-5">Cumpleaños</h3>

                    <div class="carrusel-portal carr-port-cumple">
                        <button onclick="carruselPortal('retreat');">
                            <i class="material-symbols-outlined">arrow_back_ios</i>
                        </button>
                        <div class="caja-items-carrusel-portal">
                            @forelse($cumpleaños as $cumple)
                                <div class="item-carrusel-portal">
                                    <div class="img-person ml-3" style="width: 80px; min-width: 80px; height: 80px;">
                                        <img src="{{ $cumple->avatar_ruta }}" alt="">
                                    </div>
                                    <div style="width: 100%">
                                        <span class="title-item-carr-port">{{ $cumple->name }} </span> <br>
                                        <p>
                                            {{ $cumple->puestoRelacionado->puesto ?? '' }} <br>
                                            {{ $cumple->area->area ?? '' }}
                                            <br>
                                            <br>
                                            @php
                                                $meses = [
                                                    'Enero',
                                                    'Febrero',
                                                    'Marzo',
                                                    'Abril',
                                                    'Mayo',
                                                    'Junio',
                                                    'Julio',
                                                    'Agosto',
                                                    'Septiembre',
                                                    'Octubre',
                                                    'Noviembre',
                                                    'Diciembre',
                                                ];
                                                $fecha = \Carbon\Carbon::createFromFormat('Y-m-d', $cumple->cumpleaños);
                                                $mes = $meses[$fecha->format('n') - 1];
                                                $inputs['Fecha'] = $fecha->format('d') . ' de ' . $mes;
                                            @endphp
                                            <strong> Fecha de cumpleaños </strong> <br>
                                            {{ $inputs['Fecha'] }}
                                        </p>
                                    </div>
                                    <div>
                                        {{-- <i class="material-symbols-outlined" style="font-size: 50px;">thumb_up</i> --}}
                                    </div>
                                    <img src="{{ asset('img/example-remove/cumple_portal.png') }}" alt=""
                                        class="cumple-img-portal">
                                </div>

                            @endforeach
                        </div>
                        <button onclick="carruselPortal('advance');">
                            <i class="material-symbols-outlined">arrow_forward_ios</i>
                        </button>
                    </div>
                </div>
            @endif
        @endif
    </div>
    <div style="height: 100px;"></div>
@endsection
@section('scripts')
    <script src="{{ asset('js/calendar-comunicado.js') }}"></script>
    <script src="{{ asset('js/calendario-comunicacion.js') }}"></script>

    <script>
        function boletin(id) {
            $('.caja-img-carrusel-vertical .item-main-carrusel').removeClass('active');
            $('#' + id).addClass('active');
        }

        function commuteBoletin() {
            let activeItem = document.querySelector('.caja-img-carrusel-vertical .item-main-carrusel.active');
            let nextItem = activeItem.nextElementSibling;
            $('.caja-img-carrusel-vertical .item-main-carrusel').removeClass('active');
            if (nextItem != null) {
                nextItem.classList.add('active');
            } else {
                document.querySelector('.caja-img-carrusel-vertical').firstElementChild.classList.add('active');
            }
            let itemMenuTop = document.querySelector('[data-id="' + nextItem.id + '"]').offsetTop;
            console.log(itemMenuTop)
            document.querySelector('.menu-carrusel-vertical').offsetTop = itemMenuTop;
        }

        function intervalBoletin() {
            setInterval(() => {
                commuteBoletin();
            }, 15000);
        }
        commuteBoletin();


        document.addEventListener("DOMContentLoaded", () => {
            intervalBoletin();
        });
    </script>
    <script>
        let currentTime = new Date();
        let options = {
            timeStyle: 'short',
            hour12: true
        };
        let hora_complete = currentTime.toLocaleTimeString('en-US', options);
        let [hora, med] = hora_complete.split(' ');

        document.getElementById('hora-portal').innerHTML = hora;
        document.getElementById('med-portal>').innerHTML = med;

        const fechaActual = new Date();

        // Opciones para el formato de fecha
        const opcionesFecha = {
            month: 'long',
            day: 'numeric',
            weekday: 'long'
        };

        // Convertir la fecha actual a formato humano en español
        const fechaHumana = fechaActual.toLocaleDateString('es-ES', opcionesFecha).replace(' de ', ' ');

        // Mostrar la fecha en la consola
        document.getElementById('fecha-completa').innerHTML = fechaHumana;

        function carruselPortal(tipo) {
            if (tipo == 'advance') {
                console.log('iso');
                document.querySelector('.carrusel-portal:hover .caja-items-carrusel-portal').scrollLeft += 400;
            }
            if (tipo == 'retreat') {
                document.querySelector('.carrusel-portal:hover .caja-items-carrusel-portal').scrollLeft -= 400;
            }
        }

        $(document).ready(function() {
            // Reemplaza '82a605d0' y '010461c49fd2f4a8f1968e0236b802fa' con tus credenciales de WeatherUnlocked
            const appId = '82a605d0';
            const apiKey = '010461c49fd2f4a8f1968e0236b802fa';

            // Coordenadas para una ubicación específica (51.50, -0.12 es Londres, puedes cambiarlo)
            const latitude = 51.50;
            const longitude = -0.12;

            // URL de la API de WeatherUnlocked para obtener datos del tiempo en una ubicación específica
            const apiUrl =
                `http://api.weatherunlocked.com/api/current/${latitude},${longitude}?app_id=${appId}&app_key=${apiKey}`;

            // Realiza la solicitud a la API utilizando jQuery AJAX
            $.ajax({
                url: apiUrl,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Muestra la información del tiempo en el elemento con id 'weather-info'
                    console.log(data);
                },
                error: function(error) {
                    console.error('Error al obtener datos del tiempo:', error);
                }
            });
        });
    </script>
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
@endsection
