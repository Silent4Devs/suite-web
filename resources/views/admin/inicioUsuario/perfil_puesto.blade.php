@extends('layouts.admin')
@section('content')

    <style type="text/css">
        .datos_der_cv {
            color: #fff;
        }

    </style>

    {{ Breadcrumbs::render('mi-perfil-puesto') }}


    <h5 class="col-12 titulo_general_funcion">Perfil de Puesto</h5>
    <div>
        <div class="mt-4 row justify-content-center">
            <div class="card col-sm-12 col-md-10">
                <div class="card-body">


                    @php
                        use App\Models\Organizacion;
                        $organizacion = Organizacion::first();
                        $logotipo = $organizacion->logotipo;
                    @endphp
                    <div class="caja_img_logo">
                        <img src="{{ asset($logotipo) }}" class="mt-2 ml-4" style="width: 100px;">
                    </div>
                    <div class="row medidas">
                        <div class="mt-4 ml-4 col-md-7 datos_iz_cv">
                            <h5 class="py-2 pl-2"
                                style="color:#fff; font-weight:bold; background-color:#7F7F7F; width:100%">
                                {{ $puesto->puesto }}</h5>
                            <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Identificación del puesto</span>
                            </div>

                            <span><strong>Área:</strong> {{ $puesto->area ? $puesto->area->area : 'sin registro' }}</span>

                            <br>
                            <span><strong>Fecha de creación:</strong>
                                {{ \Carbon\Carbon::parse($puesto->fecha_puesto)->format('d/m/Y') }}</span>
                            <br>
                            <span><strong>Reportará a:</strong>
                                {{ $puesto->reportara ? $puesto->reportara->name : 'sin registro' }}</span>
                            <br>
                            <span><strong>N° de personas a su cargo:</strong> &nbsp;{{ $puesto->personas_internas }}
                                <strong>Internas</strong>
                                &nbsp; {{ $puesto->personas_externas }} <strong>Externas</strong>
                            </span>
                            <br>

                            <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Descripción</span>
                            </div>
                            <p style="text-align:justify">
                                {!! $puesto->descripcion !!}
                            <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Responsabilidades</span>
                            </div>

                            @foreach ($puesto->responsabilidades as $responsabilidad)
                                <div>
                                    <span>{{ $responsabilidad->actividad }}</span>
                                    <br>
                                    <span><strong>Resultado:&nbsp;</strong>{{ $responsabilidad->resultado }}</span>
                                    <br>
                                    <span><strong>Indicador:&nbsp;</strong>{{ $responsabilidad->indicador }}</span>
                                    <br>
                                    <span><strong>Tiempo:&nbsp;</strong>{{ $responsabilidad->tiempo_asignado }}</span>
                                </div>
                                <br>
                            @endforeach

                            <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Herramientas para desempeñar puesto</span>
                            </div>
                            @foreach ($puesto->herramientas as $herramienta)
                                <div>
                                    <strong style="color:#00A57E;text-transform: uppercase">
                                        {{ $herramienta->nombre_herramienta }}
                                    </strong>
                                    <br>
                                    <span>{{ $herramienta->descripcion_herramienta }}</span>
                                </div>
                                <br>
                            @endforeach

                            <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Experiencia Profesional</span>
                            </div>
                            <p style="text-align:justify">
                                {!! $puesto->experiencia !!}
                            </p>
                            <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Educación Académica</span>
                            </div>
                            <p style="text-align:justify">
                                {!! $puesto->estudios !!}

                            </p>
                            <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Conocimientos</span>
                            </div>
                            <p style="text-align:justify">
                                {!! $puesto->conocimientos !!}
                            </p>
                            <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Certificaciones</span>
                            </div>
                            @foreach ($puesto->certificados as $certificado)
                                <div>
                                    <strong style="color:#00A57E;text-transform: uppercase">
                                        {{ $certificado->nombre }}</strong>

                                    <br>
                                    <span>
                                        {{ $certificado->requisito }}
                                    </span>
                                </div>
                            @endforeach
                            <div class="mt-4 mb-3 w-100 dato_mairg " style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Idiomas</span>
                            </div>
                            @foreach ($puesto->language as $id_language)
                                <div>
                                    <strong class="font-weight-bold" style="color:#00A57E;text-transform: uppercase">
                                        {{ $id_language->language->idioma }}
                                    </strong>
                                    <br>
                                    <span>
                                        <strong>Nivel:</strong> {{ $id_language->nivel }}
                                    </span>
                                    <br>
                                    <span><strong>Porcentaje:</strong> {{ $id_language->porcentaje }}</span>
                                </div>
                                <br>
                            @endforeach
                            <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Contactos del puesto</span>
                            </div>

                            @foreach ($puesto->contactos as $contacto)
                                <div>
                                    <strong>{{ $contacto->empleados->name }}</strong>
                                    <br>
                                    <span><strong>Area:</strong> {{ $contacto->empleados->area->area }}</span>
                                    <br>
                                    <span>{{ $contacto->descripcion_contacto }}</span>
                                </div>
                            @endforeach





                            {{-- <strong class="font-weight-bold"style="color:#00A57E;text-transform: uppercase">
                                {{ $language->requisito }}</strong>
                                <br> --}}
                            {{-- @foreach ($idiomas as $idioma)
                                <span style="text-transform:capitalize">{{ $language->porcentaje}}%</span>
                                <br>
                                <p>{{ $language->nivel }}</p> --}}

                            </ul>
                        </div>


                        <div class="mt-4 col-md-4 datos_der_cv">
                            <div
                                style="background: linear-gradient(0deg, rgba(69,125,182,1) 0%, rgba(8,170,157,1) 60%); height:100%; padding:10px;">
                                {{-- <div class="text-center w-100"><img class="mt-3"
                                        style="height: 100px; clip-path: circle(50px at 50% 50%); margin:auto"
                                        src="{{ asset('storage/empleados/imagenes/') . '/' . $empleadoModel->Avatar }}"
                                        alt=""></div> --}}
                                <div class="mt-3 mb-4 w-100" style="border-bottom: solid 2px #fff;">
                                    <span class="text-white " style="font-size: 14px; font-weight: bold;">
                                        Datos Generales</span>
                                </div>
                                <strong><i class="ml-2 mr-2 far fa-building text-white"></i>Lugar de Trabajo</strong>
                                <br>
                                @if (is_null($puesto->lugar_trabajo))
                                    <label class="ml-4">Sin registro</label>
                                @else
                                    <div style="margin-left:28px;">
                                        <span>{{ $puesto->lugar_trabajo }}</span>
                                    </div>
                                @endif
                                <br>
                                <strong><i class="ml-2 mr-2 fas fa-clock text-white"></i>Horario</strong>
                                <br>
                                @if (is_null($puesto->horario))
                                    <label class="ml-4">Sin registro</label>
                                @else
                                    <div style="margin-left:28px;">
                                        <span>{{ $puesto->horario }}</span>
                                    </div>
                                @endif
                                <br>
                                <div class="mt-3 mb-4 w-100" style="border-bottom: solid 2px #fff;">
                                    <span class="text-white " style="font-size: 14px; font-weight: bold;">
                                        Competencias</span>
                                </div>
                                <div style="margin-left:28px; margin-top: 13px;">
                                    @foreach ($puesto->competencias as $competencia)
                                        <li><strong>{{ $competencia->competencia->nombre }}</strong><br>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Nivel esperado:
                                            {{ $competencia->nivel_esperado }}</li>
                                    @endforeach
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>



@endsection
