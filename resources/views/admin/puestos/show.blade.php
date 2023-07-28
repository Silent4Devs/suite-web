@extends('layouts.admin')
@section('content')
    <style type="text/css">
        .datos_der_cv {
            color: #fff;
        }
    </style>

    {{ Breadcrumbs::render('perfil-puesto-show', $puesto) }}
    <h5 class="col-12 titulo_general_funcion">Perfil de Puesto</h5>
    <div>
        <div class="mt-4 row justify-content-center">
            <div class="card col-sm-12 col-md-10">
                <div class="card-body">


                    @php
                        use App\Models\Organizacion;
                        $organizacion = Organizacion::getFirst();
                        $logotipo = $organizacion->logotipo;
                    @endphp
                    <div class="caja_img_logo">
                        <div class="row">
                            <div class="col-4">
                                <img src="{{ asset($logotipo) }}" class="mt-2 ml-4" style="width:100px;">

                            </div>
                            <div class="col-8 mt-5">
                                <h5 class="col-12 titulo_general_funcion">Perfil de Puesto</h5>

                            </div>
                        </div>
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
                            <strong style="color:#00A57E;text-transform: uppercase">
                                Área</strong>
                            <br>
                            <span>{{ $puesto->area ? $puesto->area->area : 'Sin definir' }}</span>
                            <br>
                            <strong style="color:#00A57E;text-transform: uppercase">
                                Reportará a </strong>
                            <br>
                            <span>{{ $puesto->reportara ? $puesto->reportara->puesto : 'Sin definir' }}</span>
                            <br>
                            <strong style="color:#00A57E;text-transform: uppercase">
                                N° de personas a su cargo</strong>
                            <br>
                            <span><strong>Internas</strong>&nbsp;{{ $puesto->personas_internas }}</span>
                            <br>
                            <span> <strong>Externas</strong>&nbsp; {{ $puesto->personas_externas }}</span>
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
                                    <strong style="color:#00A57E;text-transform: uppercase">
                                        {{ $responsabilidad->actividad }}</strong>
                                    <br>
                                    <p style=" text-align: justify !important;"><strong>
                                            Resultado Esperado:</strong>
                                        {{ $responsabilidad->resultado }}</p>
                                    <p style="margin-top:-13px; text-align: justify !important;">
                                        <strong>Indicador de cumplimiento</strong>
                                        {{ $responsabilidad->indicador }}
                                    </p>
                                    <p style="margin-top:-13px; text-align: justify !important;">
                                        <strong>% de tiempo asignado</strong>
                                        {{ $responsabilidad->tiempo_asignado }}
                                    </p>
                                </div>
                            @endforeach

                            <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Herramientas para desempeñar puesto</span>
                            </div>
                            @foreach ($puesto->herramientas as $herramienta)
                                <div>
                                    <strong style="color:#00A57E;text-transform: uppercase">
                                        {{ $herramienta->nombre_herramienta }}</strong>

                                    <br>
                                    <span style="font-weight:normal !important">
                                        {{ $herramienta->descripcion_herramienta }}
                                    </span>
                                </div>
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
                                    Entrenamiento recomendado para este rol</span>
                            </div>
                            <p style="text-align:justify">
                                {!! $puesto->entrenamiento !!}
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
                                    Contactos Internos del puesto</span>
                            </div>

                            @foreach ($puesto->contactos as $contacto)
                                <div>
                                    <strong class="font-weight-bold" style="color:#00A57E;text-transform: uppercase">
                                        {{ $contacto->puesto->puesto }}</strong>
                                    <br>
                                    <strong> {{ $contacto->puesto->area->area }}</strong>
                                    <br>
                                    <span
                                        style="text-align:justify; font-weight:normal !important">{{ $contacto->descripcion_contacto }}</span>
                                </div>
                            @endforeach

                            <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Contactos Externos del puesto</span>
                            </div>
                            @foreach ($puesto->externos as $externo)
                                <div>
                                    <strong class="font-weight-bold" style="color:#00A57E;text-transform: uppercase">
                                        {{ $externo->nombre_contacto_int }}</strong>
                                    <p style="margin-top:-13px; text-align:justify; font-weight:normal !important">
                                        {{ $externo->proposito }}</p>
                                </div>
                            @endforeach

                            <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Responsiva del colaborador</span>
                            </div>
                            <p style="text-align:justify">
                                Manifiesto que leí la descripción de mi puesto, y acepto cumplir con lo establecido y estar
                                en el entendido en que las aquí relacionadas son enunciativas más no limitativas.
                                Me comprometo en cumplir y participar activamente en la normatividad del Sistema de Gestión
                                Integral, así como, de las políticas de seguridad de información en donde tenga
                                responsabilidad directa o indirectamente, así como conducirme bajo la misión, visión,
                                valores de Silent4business.
                            </p>

                            <table class="w-100 mb-5">
                                <thead style="background-color:#0CA193;color:#fff;text-align:center">
                                    <tr>
                                        <th>
                                            Elaboró
                                        </th>
                                        <th>
                                            Revisó
                                        </th>
                                        <th>
                                            Autoriza
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align:center">
                                            <img src="{{ asset('storage/empleados/imagenes') }}/{{ $puesto->elaboro ? $puesto->reviso->avatar : 'user.png' }}"
                                                class="img_empleado text-center mt-1">
                                            <br>
                                            <span>{{ $puesto->elaboro ? $puesto->elaboro->name : 'Sin definir' }}</span>
                                            <br>
                                            <span
                                                style="color:#0CA193">{{ $puesto->elaboro ? $puesto->elaboro->area->area : 'Sin definir' }}</span>
                                        </td>
                                        <td style="text-align:center">
                                            <img src="{{ asset('storage/empleados/imagenes') }}/{{ $puesto->reviso ? $puesto->reviso->avatar : 'user.png' }}"
                                                class="img_empleado text-center mt-1">
                                            <br>
                                            <span>{{ $puesto->reviso ? $puesto->reviso->name : 'Sin definir' }}</span>
                                            <br>
                                            <span
                                                style="color:#0CA193">{{ $puesto->reviso ? $puesto->reviso->area->area : 'Sin definir' }}</span>

                                        </td>
                                        <td style="text-align:center">
                                            <img src="{{ asset('storage/empleados/imagenes') }}/{{ $puesto->autoriza ? $puesto->autoriza->avatar : 'user.png' }}"
                                                class="img_empleado text-center mt-1">
                                            <br>
                                            <span>{{ $puesto->autoriza ? $puesto->autoriza->name : 'Sin definir' }}</span>
                                            <br>
                                            <span
                                                style="color:#0CA193">{{ $puesto->autoriza ? $puesto->autoriza->area->area : 'Sin definir' }}</span>

                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                            <br>
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

                                <strong><i class="ml-2 mr-2 text-white fas fa-user-tie"></i>Edad</strong>
                                <br>
                                @if (is_null($puesto->edad_de) && is_null($puesto->edad_a))
                                    <label class="ml-4">{{ $puesto->edad }}</label>
                                @else
                                    <div style="margin-left:28px;">
                                        <span>{{ $puesto->edad_de }}</span>-<span>{{ $puesto->edad_a }}&nbsp;años</span>
                                    </div>
                                @endif
                                <br>
                                <strong><i class="ml-2 mr-2 text-white fas fa-restroom"></i>Género</strong>
                                <br>
                                @if (is_null($puesto->genero))
                                    <label class="ml-4">Sin registro</label>
                                @else
                                    <div style="margin-left:28px;">
                                        <span>{{ $puesto->genero }}</span>
                                    </div>
                                @endif
                                <br>
                                <strong><i class="ml-2 mr-2 fas fa-heart text-white"></i>Estado Civil</strong>
                                <br>
                                @if (is_null($puesto->estado_civil))
                                    <label class="ml-4">Sin registro</label>
                                @else
                                    <div style="margin-left:28px;">
                                        <span>{{ $puesto->estado_civil }}</span>
                                    </div>
                                @endif
                                <br>
                                <strong><i class="ml-2 mr-2 fas fa-dollar-sign text-white"></i>Sueldo</strong>
                                <br>
                                @if (is_null($puesto->sueldo))
                                    <label class="ml-4">Sin registro</label>
                                @else
                                    <div style="margin-left:28px;">
                                        <span>{{ $puesto->sueldo }}</span>
                                    </div>
                                @endif
                                <br>
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
