@extends('layouts.admin')
@section('content')

    <style type="text/css">
    
        .datos_der_cv{
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
                        $organizacion = Organizacion::first();
                        $logotipo = $organizacion->logotipo;
                    @endphp
                    <div class="caja_img_logo">
                        <img src="{{ asset($logotipo) }}" class="mt-2 ml-4" style="width: 200px;">
                    </div>
                    <div class="row medidas">
                        <div class="mt-4 ml-4 col-md-7 datos_iz_cv">
                            <h5 class="py-2 pl-2"
                                style="color:#fff; font-weight:bold; background-color:#7F7F7F; width:100%">
                                {{ $puesto->puesto }}</h5>
                            <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Descripción</span>
                            </div>
                            <p style="text-align:justify">
                                {{ html_entity_decode(strip_tags( $puesto->descripcion  ), ENT_QUOTES, 'UTF-8')}}
                            <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Responsabilidades</span>
                            </div>

                            @foreach($puesto->responsabilidades as $responsabilidad)
                            {{$responsabilidad->actividad}}
                             @endforeach
                             <br>
                             @foreach($puesto->responsabilidades as $responsabilidad)
                             <span><strong style="font-size:10pt;">Resultado:&nbsp;</strong>{{$responsabilidad->resultado}}</span>
                            @endforeach
                            <br>
                            @foreach($puesto->responsabilidades as $responsabilidad)
                                <span><strong style="font-size:10pt;">Indicador:&nbsp;</strong>{{$responsabilidad->indicador}}</span>
                            @endforeach
                            <br>
                            @foreach($puesto->responsabilidades as $responsabilidad)
                            <span><strong  style="font-size:10pt;">Tiempo:&nbsp;</strong>{{$responsabilidad->tiempo_asignado}}</span>
                            @endforeach

                            <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                            <span style="font-size: 17px; font-weight: bold;">
                                Experiencia Profesional</span>
                            </div>
                            <p style="text-align:justify">
                                {{ html_entity_decode(strip_tags( $puesto->experiencia  ), ENT_QUOTES, 'UTF-8')}}
                            </p>
                            <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Educación Académica</span>
                            </div>
                            <p style="text-align:justify">
                                {{ html_entity_decode(strip_tags( $puesto->estudios  ), ENT_QUOTES, 'UTF-8')}}

                            </p>
                            <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Conocimientos</span>
                            </div>
                            <p style="text-align:justify">
                                {{ html_entity_decode(strip_tags( $puesto->conocimientos  ), ENT_QUOTES, 'UTF-8')}}
                            </p>
                            <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Certificaciones</span>
                            </div>
                            @foreach($puesto->certificados as $certificado)
                                <strong style="color:#00A57E;text-transform: uppercase">
                                    {{ $certificado->nombre }}</strong>
                            @endforeach
                            <br>
                            @foreach($puesto->certificados as $certificado)
                                <span>
                                    {{ $certificado->requisito }}
                                </span>
                            @endforeach
                            <div class="mt-4 mb-3 w-100 dato_mairg " style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Idiomas</span>
                            </div>
                            @php
                            use App\Models\PuestoIdiomaPorcentajePivot;
                            @endphp
                            @foreach($idiomas as $idioma)
                                @php
                                    $porcentaje_puesto=PuestoIdiomaPorcentajePivot::where('id_language', $idioma->id)->where('id_puesto', $puesto->id)->first();
                                @endphp
                            <strong>
                                {{$porcentaje_puesto}}</strong>
                            @endforeach
                            <br>


                            {{-- <strong class="font-weight-bold"style="color:#00A57E;text-transform: uppercase">
                                {{ $language->requisito }}</strong>
                                <br>--}}
                                {{-- @foreach($idiomas as $idioma)
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
                                    <span>{{ $puesto->lugar_trabajo}}</span>
                                </div>
                                @endif
                                <br>
                                <strong><i class="ml-2 mr-2 fas fa-clock text-white"></i>Horario</strong>
                                <br>
                                @if (is_null($puesto->horario))
                                <label class="ml-4">Sin registro</label>
                                @else
                                <div style="margin-left:28px;">
                                    <span>{{ $puesto->horario}}</span>
                                </div>
                                 @endif
                                <br>
                                <div class="mt-3 mb-4 w-100" style="border-bottom: solid 2px #fff;">
                                    <span class="text-white " style="font-size: 14px; font-weight: bold;">
                                       Competencias</span>
                                </div>
                                <div style="margin-left:28px; margin-top: 13px;">
                                   @foreach($puesto->competencias as $competencia)
                                    <li><strong>{{$competencia->competencia->nombre}}</strong><br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Nivel esperado: {{$competencia->nivel_esperado}}</li>
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