<div>

    <style>
        .timeline-header .userimage {
            float: inherit;
            /* width: 34px; */
            height: 250px;
            border-radius: 40px;
            overflow: hidden;
            margin: -2px 10px -2px 0
        }

        .medidas {
            /*
    display: block; */
            height: 600px;
            overflow-x: hidden;
            margin-top: 30px;

        }

    </style>
    <div class="d-flex">
        <button class="ml-auto btn btn-danger btn-md" wire:click="clean">Ver todo</button>
    </div>
    <br>
    <div class="row" style="margin-bottom:30px;">
        <div class="col-sm-12 col-md-6">
            <label class="required" for="tipoactivo_id"><i class="fas fa-street-view iconos-crear"></i>Área</label>
            <select class="form-control {{ $errors->has('area') ? 'is-invalid' : '' }}" wire:model.debounce.800ms="area_id">
                <option value="">Seleccione el área</option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}">
                        {{ $area->area }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-sm-12 col-md-6">
            <label class="required" for="tipoactivo_id"><i class="fas fa-user-tie iconos-crear"></i>Empleado</label>
            <select class="form-control {{ $errors->has('tipoactivo') ? 'is-invalid' : '' }}" wire:model.debounce.800ms="empleado_id"
                id="tipoactivo_id">
                <option value="">Seleccione el nombre del empleado</option>
                @foreach ($empleados as $empleado)
                    <option value="{{ $empleado->id }}">
                        {{ $empleado->name }}</option>
                @endforeach
            </select>
        </div>
    </div>



    @php
        use App\Models\Organizacion;
        $organizacion = Organizacion::first();
        $logotipo = 'img/logo_policromatico_2.png';
        if ($organizacion) {
            if ($organizacion->logotipo) {
                $logotipo = 'images/' . $organizacion->logotipo;
            }
        }
    @endphp

    @if ($empleado_id != '')
        <div class="___class_+?11___">
            <div class="row justify-content-center medidas">
                <div class="mt-4 col-sm-12 col-md-10">
                    <div class="card" style="background-color:#EDEEF0" style="position-relative; height:auto">
                        <div class="caja_img_logo">

                            <img src="{{ asset($logotipo) }}" class="mt-2 ml-4" style="width: 20%;">
                        </div>
                        <div class="row">
                            <div class="mt-4 ml-4 col-md-7">

                                <h5 class="py-2 pl-2"
                                    style="color:#fff; font-weight:bold; background-color:#7F7F7F; width:100%">
                                    {{ $empleadoget->name }}</h5>




                                <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #0CA193;">
                                    <span style="font-size: 17px; font-weight: bold;">
                                        Resumen</span>
                                </div>

                                <p style="text-transform:capitalize; text-align:justify">{{ $empleadoget->resumen }}
                                </p>


                                <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #0CA193;">
                                    <span style="font-size: 17px; font-weight: bold;">
                                        Experiencia Profesional</span>
                                </div>

                                {{-- <ul> --}}
                                @foreach ($empleadoget->empleado_experiencia as $experiencia)
                                    <strong style="color:#00A57E;text-transform: uppercase">
                                        {{ $experiencia->empresa }}</strong>
                                    <br>
                                    <span
                                        style="text-transform:capitalize; font-weight:bold">{{ $experiencia->puesto }}
                                    </span>
                                    <br>
                                    <span style="font-weight:bold">{{ $experiencia->inicio_mes }} -
                                        {{ $experiencia->fin_mes }}</span>
                                    <span style="text-transform:capitalize; text-align:justify">
                                        <br>
                                        <p style="text-align:justify">{{ $experiencia->descripcion }}</p>
                                @endforeach
                                {{-- </ul> --}}

                                <div class="mt-4 mb-3 w-100 " style="border-bottom: solid 2px #0CA193;">
                                    <span style="font-size: 17px; font-weight: bold;">
                                        Certificaciones</span>
                                </div>

                                {{-- <ul> --}}
                                @foreach ($empleadoget->empleado_certificaciones as $certificaciones)
                                    <strong style="color:#00A57E;text-transform: uppercase">
                                        {{ $certificaciones->nombre }}</strong>
                                    <br>
                                    <span>{{ $certificaciones->estatus }}</span>
                                    <br>
                                    <span>{{ $certificaciones->vigencia }}</span>
                                @endforeach
                                {{-- </ul> --}}



                                <div class="mt-4 mb-3 w-100 " style="border-bottom: solid 2px #0CA193;">
                                    <span style="font-size: 17px; font-weight: bold;">
                                        Cursos / Diplomados</span>
                                </div>

                                {{-- <ul> --}}
                                @foreach ($empleadoget->empleado_cursos as $cursos)
                                    <strong class="font-weight-bold" style="color:#00A57E;text-transform: uppercase">
                                        {{ $cursos->curso_diploma }}</strong>
                                    <br>
                                    <span>{{ $cursos->tipo }}</span>
                                    <br>
                                    <span>{{ $cursos->año }}</span>
                                    <br>
                                    <span>{{ $cursos->duracion }} Horas</span>
                                @endforeach
                                {{-- </ul> --}}

                                <div class="mt-4 mb-3 w-100 " style="border-bottom: solid 2px #0CA193;">
                                    <span style="font-size: 17px; font-weight: bold;">
                                        Educación</span>
                                </div>

                                @foreach ($empleadoget->empleado_educacion as $educacion)
                                    <strong class="font-weight-bold" style="color:#00A57E;text-transform: uppercase">
                                        {{ $educacion->institucion }}</strong>
                                    <br>
                                    <span style="text-transform:capitalize">{{ $educacion->nivel }}</span>
                                    <br>
                                    <span>{{ $educacion->año_inicio }} - {{ $educacion->año_fin }}</span>
                                @endforeach</ul>


                            </div>

                            <div class="mt-4 col-md-4">
                                <div
                                    style="background: linear-gradient(0deg, rgba(69,125,182,1) 0%, rgba(8,170,157,1) 60%); height:100%; padding:10px;">
                                    {{-- <div class="height: 40px; clip-path: circle(20px at 50% 50%);">

                                    {{ $experiencia->foto }}</div> --}}
                                    {{-- <span><img class="rounded-circle"
                                        src="{{ asset('storage/empleados/imagenes/') . '/' . $empleadoget->Avatar }}"
                                        alt=""></span> --}}


                                    <div class="text-center w-100"><img class="mt-3"
                                            style="height: 100px; clip-path: circle(50px at 50% 50%); margin:auto"
                                            src="{{ asset('storage/empleados/imagenes/') . '/' . $empleadoget->Avatar }}"
                                            alt=""></div>


                                    <div class="mt-3 mb-4 w-100" style="border-bottom: solid 2px #fff;">
                                        <span class="text-white " style="font-size: 14px; font-weight: bold;">
                                            Datos Generales</span>
                                    </div>
                                    <strong><i class="ml-2 mr-2 text-white fas fa-map-marker-alt"></i>Dirección</strong>
                                    <br>
                                    <span style="margin-left:28px;">{{ $empleadoget->telefono }}</span>
                                    <br>
                                    <strong><i class="ml-2 mr-2 text-white fas fa-phone-alt"></i>Número de
                                        Teléfono</strong>
                                    <br>
                                    <span style="margin-left:29px;">{{ $empleadoget->telefono }}</span>
                                    <br>
                                    <strong><i class="ml-2 mr-2 text-white fas fa-envelope"></i>Correo Electrónico
                                        S4B</strong>
                                    <br>
                                    <span style="margin-left:30px;">{{ $empleadoget->email }}</span>
                                </div>
                            </div>




                        </div>


                    </div>


                </div>
            </div>
            {{-- <div class="col-6">
            {{ $empleadoget }}
        </div> --}}

            <div class="mt-5 row">
                <div class="col-sm-12 col-md-6">
                    <h6 style="font-weight:bold;"><i class="fas fa-folder-open iconos-crear"></i>Documentos</h6>
                    <br>
                    @foreach ($empleadoget->empleado_documentos as $documentos)
                    <ul>
                    <a href="{{ asset('storage/documentos_empleados/') . '/' . $documentos->documentos }}"  style="text-decoration:none" target="_blank" alt=""><span><i class="fas fa-file iconos-crear"></i>{{$documentos->documentos}}</span></a>
                    </ul>
                    @endforeach
                </div>
                <div class="col-sm-12 col-md-6">
                    <h6 style="font-weight:bold;"><i class="fas fa-folder-open iconos-crear"></i>Certificados</h6>
                    <br>
                    @foreach ($empleadoget->empleado_certificaciones as $certificaciones )
                        <ul>
                            <a href="{{ asset('storage/certificados_empleados/') . '/' . $certificaciones->documento }}"  style="text-decoration:none" target="_blank" alt=""><span><i class="fas fa-file iconos-crear"></i>{{$certificaciones->documento}}</span></a>
                        </ul>
                    @endforeach
                </div>
                <br>
            </div>


        </div>
    @else
        <div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 3px #3B82F6;">
            <div class="row w-100">
                <div class="text-center col-1 align-items-center d-flex justify-content-center">
                    <div class="w-100">
                        <i class="fas fa-info-circle" style="color: #3B82F6; font-size: 22px"></i>
                    </div>
                </div>
                <div class="col-11">
                    <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Atención</p>
                    <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Por favor seleccione el área y el
                        nombre del empleado que desea consultar
                    </p>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <img src="{{ asset('img/cv.png') }}" class="mt-3" style="height: 400px;">
        </div>
    @endif

</div>
