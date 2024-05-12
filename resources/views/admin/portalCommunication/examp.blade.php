@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/portalCommunication/examp.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('content')
    {{-- @can('planes_accion_access') --}}


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
