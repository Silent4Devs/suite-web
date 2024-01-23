@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/portal_comunicacion.css') }}">
@endsection
@section('content')
    @include('partials.menu-slider')
    <div style="max-width: 1900px;">

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
                    <input type="text" placeholder="Ejem: Cargar mis horas en Timesheet" autocomplete="off">
                    <i class="material-symbols-outlined icon-mic">mic</i>
                </div>
            </div>
        @endif

        <div class="mt-5">
            <div class="row">
                <div class="col-md-5 d-flex" style="flex-direction: column;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-gadgets">
                                <div class="d-flex justify-content-center align-items-center" style="gap: 13px;">
                                    <i class="material-symbols-outlined" style="font-size: 70px;">rainy</i>
                                    <span style="font-size: 26px;">26&nbsp;<font style="font-size: 16px;">°C</font></span>
                                    <div style="font-size: 12px;">
                                        Nublado <br>
                                        26º/26º Temp 27ºC
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card card-gadgets">
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

                <div class="col-md-7" style="">
                    <div class="card carrusel-vertical-boletin" style="background-color: #F8E1E1;">
                        <div class="card-body">
                            <h4 class="title-card-portal-c">Boletín</h4>
                            <div class="caja-img-carrusel-vertical">
                                <img id="comunicado-carrusel-primer-item" src="{{ asset('img/Carrusel_inicio.png') }}"
                                    class="item-main-carrusel">
                                @foreach ($comunicacionSgis_carrusel as $idx => $carrusel)
                                    @if ($carrusel->imagenes_comunicacion->first()->tipo == 'video')
                                        <video id="comunicado-carrusel-{{ $carrusel->id }}" muted controls
                                            src="{{ asset('storage/imagen_comunicado_SGI/' . $carrusel->imagenes_comunicacion->first()->imagen) }}"
                                            width="100%" class="d-none item-main-carrusel"></video>
                                    @else
                                        <img id="comunicado-carrusel-{{ $carrusel->id }}"
                                            src="{{ asset('storage/imagen_comunicado_SGI/' . $carrusel->imagenes_comunicacion->first()->imagen) }}"
                                            class="d-none item-main-carrusel">
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
                                        onclick="boletin('comunicado-carrusel-{{ $carrusel->id }}')">
                                        <img src="{{ asset('img/example-remove/play_video.png') }}" alt="">
                                    </div>
                                @else
                                    <div class="caja-img-menu-crr-vertical"
                                        onclick="boletin('comunicado-carrusel-{{ $carrusel->id }}')">
                                        <img src="{{ asset('storage/imagen_comunicado_SGI/' . $carrusel->imagenes_comunicacion->first()->imagen) }}"
                                            alt="">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-12">
                            <div class=" card card-body">
                                <h4 class="title-card-portal-c">Aplicaciones más usadas</h4>
                                <div class="d-flex justify-content-between" style="gap: 22px; flex-wrap:wrap;">

                                    <a href="{{ route('admin.timesheet-inicio') }}" class="item-app-mu">
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
                                            {{-- @can('mi_organizacion_acceder')
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
                                                <a href="{{ route('admin.politica-sgsis/visualizacion') }}">
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
                                            @endcan --}}
                                            @can('escuela_estudiante')
                                                <a href="{{ asset('/admin/mis-cursos') }}">
                                                    <div class="item-menu-portal">
                                                        <i class="material-symbols-outlined">school</i>
                                                        <span>Capacitaciones</span>
                                                    </div>
                                                </a>
                                            @endcan
                                            @can('mi_perfil_acceder')
                                                <a href="{{ route('admin.solicitud') }}">
                                                    <div class="item-menu-portal">
                                                        <i class="material-symbols-outlined">assignment_turned_in</i>
                                                        <span>Solicitudes</span>
                                                    </div>
                                                </a>
                                            @endcan
                                            {{-- @can('portal_de_comunicaccion_acceder')
                                                <a href="{{ route('admin.portal-comunicacion.index') }}">
                                                    <div class="item-menu-portal active">
                                                        <i class="material-symbols-outlined">home</i>
                                                        <span>Inicio</span>
                                                    </div>
                                                </a>
                                            @endcan --}}
                                            @can('mi_perfil_acceder')
                                                <a href="{{ route('admin.inicio-Usuario.index') }}">
                                                    <div class="item-menu-portal">
                                                        <i class="material-symbols-outlined">account_circle</i>
                                                        <span>Perfil</span>
                                                    </div>
                                                </a>
                                            @endcan
                                            @can('timesheet_acceder')
                                                <a href="{{ route('admin.timesheet-inicio') }}">
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
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 d-flex" style="flex-direction: column;">
                    <div class="card card-body" style="flex-grow: 1;">
                        <h4 class="title-card-portal-c"> Comunicados</h4>
                        @forelse($comunicacionSgis as $comunicacionSgi)
                            @php
                                if ($comunicacionSgi->first()->count()) {
                                    if ($comunicacionSgi->imagenes_comunicacion->first()) {
                                        $imagen = 'storage/imagen_comunicado_SGI/' . $comunicacionSgi->imagenes_comunicacion->first()->imagen;
                                    }
                                } else {
                                    $imagen = 'img/portal_404.png';
                                }

                            @endphp
                            <div class="comunicado-item-portal">
                                <div width="100%">
                                    <h4 class="title-comunicado-portal">{{ $comunicacionSgi->titulo }}</h4>
                                    <span>{{ $comunicacionSgi->fecha_publicacion }}</span>
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
                        @endforeach
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
                                            <span>{{ $documento->proceso->nombre }}</span>
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
                        @empty
                        @endforelse

                    </div>
                </div>
            </div>
        </div>

        @if (isset($nuevos))
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
                                        {{ $nuv->puesto }} <br>
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

        @if (isset($cumpleaños))
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
                                        {{ $cumple->puesto }} <br>
                                        {{ $cumple->area->area }}
                                        <br>
                                        <br>
                                        @php
                                            $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
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
                        @if ($cumpleaños)
                            <img src="{{ asset('img/sincomunicados.png') }}" alt=""
                                style="width: 100px; margin:0px auto; margin-top: 100px;">
                        @endif
                    </div>
                    <button onclick="carruselPortal('advance');">
                        <i class="material-symbols-outlined">arrow_forward_ios</i>
                    </button>
                </div>
            </div>
        @endif
    </div>
    <div style="height: 100px;"></div>
@endsection
@section('scripts')
    <script src="{{ asset('js/calendar-comunicado.js') }}"></script>
    <script src="{{ asset('js/calendario-comunicacion.js') }}"></script>

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
        console.log(hora);
        console.log(med);

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
        console.log(fechaHumana); // Ejemplo: "martes, 21 de diciembre de 2023"
        document.getElementById('fecha-completa').innerHTML = fechaHumana;

        function boletin(id) {
            console.log(id);
            $('.caja-img-carrusel-vertical .item-main-carrusel').addClass('d-none');
            $('#' + id).removeClass('d-none');
        }

        function carruselPortal(tipo) {
            if (tipo == 'advance') {
                console.log('iso');
                document.querySelector('.carrusel-portal:hover .caja-items-carrusel-portal').scrollLeft += 400;
            }
            if (tipo == 'retreat') {
                document.querySelector('.carrusel-portal:hover .caja-items-carrusel-portal').scrollLeft -= 400;
            }
        }
    </script>
@endsection
