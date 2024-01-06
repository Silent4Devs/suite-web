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
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-body" style="padding: 20px;">
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
                            <div class="card card-body" style="padding: 20px;">
                                <div class="d-flex justify-content-center align-items-center" style="gap: 13px;">
                                    <i class="material-symbols-outlined" style="font-size: 70px;">schedule</i>
                                    <span style="font-size: 26px;" id="hora-portal"> </span>
                                    <sup style="font-size: 12px;" id="med-portal>"></sup>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="div4 card card-body">
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
                <div class="col-md-7">
                    <div class="card carrusel-vertical-boletin" style="background-color: #F8E1E1;">
                        <div class="card-body">
                            <h4 class="title-card-portal-c">Boletín</h4>
                            <div class="caja-img-carrusel-vertical">
                                <img src="https://1.bp.blogspot.com/-UoYVfbN-PIk/YYbmcUxfbLI/AAAAAAAAEuA/XymxRDvsPP8ODUT8mnXf7fzXehAlPifugCLcBGAsYHQ/s2000/1.png"
                                    alt="" class="active-carrusel-vertical" id="img-crr-v-1">
                                <img src="https://p.calameoassets.com/220407180419-11eebf2100c28e2638d89473f1717eb7/p1.jpg"
                                    alt="" id="img-crr-v-2">
                                <img src="https://www.gob.mx/cms/uploads/image/file/281561/no_circula_viernes.jpg"
                                    alt="" id="img-crr-v-3">
                            </div>
                        </div>
                        <div class="menu-carrusel-vertical scroll_estilo">
                            <div class="caja-img-menu-crr-vertical">
                                <img src="https://1.bp.blogspot.com/-UoYVfbN-PIk/YYbmcUxfbLI/AAAAAAAAEuA/XymxRDvsPP8ODUT8mnXf7fzXehAlPifugCLcBGAsYHQ/s2000/1.png"
                                    alt="" class="active-carrusel-vertical">
                            </div>
                            <div class="caja-img-menu-crr-vertical">
                                <img src="https://p.calameoassets.com/220407180419-11eebf2100c28e2638d89473f1717eb7/p1.jpg"
                                    alt="">
                            </div>
                            <div class="caja-img-menu-crr-vertical">
                                <img src="https://www.gob.mx/cms/uploads/image/file/281561/no_circula_viernes.jpg"
                                    alt="">
                            </div>

                            <div class="caja-img-menu-crr-vertical">
                                <img src="https://1.bp.blogspot.com/-UoYVfbN-PIk/YYbmcUxfbLI/AAAAAAAAEuA/XymxRDvsPP8ODUT8mnXf7fzXehAlPifugCLcBGAsYHQ/s2000/1.png"
                                    alt="">
                            </div>
                            <div class="caja-img-menu-crr-vertical">
                                <img src="https://p.calameoassets.com/220407180419-11eebf2100c28e2638d89473f1717eb7/p1.jpg"
                                    alt="">
                            </div>
                            <div class="caja-img-menu-crr-vertical">
                                <img src="https://www.gob.mx/cms/uploads/image/file/281561/no_circula_viernes.jpg"
                                    alt="">
                            </div>

                            <div class="caja-img-menu-crr-vertical">
                                <img src="https://1.bp.blogspot.com/-UoYVfbN-PIk/YYbmcUxfbLI/AAAAAAAAEuA/XymxRDvsPP8ODUT8mnXf7fzXehAlPifugCLcBGAsYHQ/s2000/1.png"
                                    alt="">
                            </div>
                            <div class="caja-img-menu-crr-vertical">
                                <img src="https://p.calameoassets.com/220407180419-11eebf2100c28e2638d89473f1717eb7/p1.jpg"
                                    alt="">
                            </div>
                            <div class="caja-img-menu-crr-vertical">
                                <img src="https://www.gob.mx/cms/uploads/image/file/281561/no_circula_viernes.jpg"
                                    alt="">
                            </div>
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
                                    <div class="item-app-mu">Aplicación más usuada</div>
                                    <div class="item-app-mu">Aplicación más usuada</div>
                                    <div class="item-app-mu">Aplicación más usuada</div>
                                    <div class="item-app-mu">Aplicación más usuada</div>
                                    <div class="item-app-mu">Aplicación más usuada</div>
                                    <div class="item-app-mu">Aplicación más usuada</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class=" card card-body">
                                        <h4 class="title-card-portal-c"> Menú </h4>

                                        <div class="menu-portal">
                                            <div class="item-menu-portal">
                                                <i class="material-symbols-outlined">corporate_fare</i>
                                                <span>Organización</span>
                                            </div>
                                            <div class="item-menu-portal">
                                                <i class="material-symbols-outlined">description</i>
                                                <span>Documentos</span>
                                            </div>
                                            <div class="item-menu-portal">
                                                <i class="material-symbols-outlined">home_pin</i>
                                                <span>Sedes</span>
                                            </div>
                                            <div class="item-menu-portal">
                                                <i class="material-symbols-outlined">local_library</i>
                                                <span>Políticas</span>
                                            </div>
                                            <div class="item-menu-portal">
                                                <i class="material-symbols-outlined">mitre</i>
                                                <span>Áreas</span>
                                            </div>
                                            <div class="item-menu-portal">
                                                <i class="material-symbols-outlined">partner_exchange</i>
                                                <span>Comités</span>
                                            </div>
                                            <div class="item-menu-portal">
                                                <i class="material-symbols-outlined">flowsheet</i>
                                                <span>Mapa de procesos</span>
                                            </div>
                                            <div class="item-menu-portal">
                                                <i class="material-symbols-outlined">flag</i>
                                                <span>Reportar</span>
                                            </div>
                                            <div class="item-menu-portal">
                                                <i class="material-symbols-outlined">schema</i>
                                                <span>Organigrama</span>
                                            </div>
                                            <div class="item-menu-portal">
                                                <i class="material-symbols-outlined">border_all</i>
                                                <span>FODA</span>
                                            </div>
                                            <div class="item-menu-portal">
                                                <i class="material-symbols-outlined">person_book</i>
                                                <span>Directorio</span>
                                            </div>
                                            <div class="item-menu-portal">
                                                <i class="material-symbols-outlined">table_chart_view</i>
                                                <span>Alcances</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card card-body">
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
                                    <br>
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
                    <button>
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
                    <button>
                        <i class="material-symbols-outlined">arrow_forward_ios</i>
                    </button>
                </div>
            </div>
        @endif

        @if (isset($cumpleaños))
            <div class="card-body">
                <h3 class="title-card-portal-c mt-5">Cumpleaños</h3>

                <div class="carrusel-portal carr-port-cumple">
                    <button>
                        <i class="material-symbols-outlined">arrow_back_ios</i>
                    </button>
                    <div class="caja-items-carrusel-portal">
                        @forelse($cumpleaños as $cumple)
                            <div class="item-carrusel-portal">
                                <div class="img-person" style="width: 80px; min-width: 80px; height: 80px;">
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
                                    <i class="material-symbols-outlined" style="font-size: 50px;">thumb_up</i>
                                </div>
                                <img src="{{ asset('img/example-remove/cumple_portal.png') }}" alt=""
                                    class="cumple-img-portal">
                            </div>
                        @endforeach
                    </div>
                    <button>
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
    </script>
@endsection
