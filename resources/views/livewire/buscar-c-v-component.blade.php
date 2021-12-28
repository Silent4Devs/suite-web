<div>

    <style>
        .timeline-header .userimage {
            float: inherit;
            /* width: 34px; */
            height: 250px;
            border-radius: 40px;
            overflow: hidden;
            margin: -2px 10px -2px 0;
            z-index: 1;
        }

        .medidas {
            max-height: 1200px;
            overflow: auto;
            margin-top: 30px;
            z-index: 1;
        }

        .wrapper {
            display: flex;
            overflow-x: auto;
            max-height: 150px;
        }

        /* width */
        .wrapper::-webkit-scrollbar {
            width: 7px;
            height: 5px;
        }

        /* Track */
        .wrapper::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0);
        }

        /* Handle */
        .wrapper::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 50px;
        }

        /* Handle on hover */
        .wrapper::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.5);
        }

        .wrapper .item {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            width: 120px;
            text-align: center;
            cursor: pointer;
        }

        .wrapper .item:hover {
            border: 1px solid rgb(61, 128, 252);
        }

        .mask-item {
            height: 150px;
            position: absolute;
            top: 0;
            width: 98%;
            left: 0;
            line-height: 134px;
            background: #1bb0b0;
            color: white;
            font-weight: 500;
        }

    </style>

    @php
        use App\Models\Organizacion;
        $organizacion = Organizacion::first();
        $logotipo = $organizacion->logotipo;
    @endphp

    @if (!$isPersonal)
        <div class="text-center form-group" style="background-color:#1BB0B0; border-radius: 100px; color: white;">
            CURRICULUM VITAE
        </div>
    @else
        <div class="d-flex">
            <a class="ml-auto btn btn-danger btn-md mt-2"
                href="{{ route('admin.editarCompetencias', $empleadoModel) }}">Editar</a>
        </div>
    @endif

    <div class="row">
        @if (!$isPersonal)
            <div class="col-sm-3 col-3 col-md-3" style="border-right: 1px solid #dadada;">
                <div class="row" style="margin-bottom:30px;">
                    <div class="col-12">
                        <p class="text-muted"><i class="fas fa-filter mr-2"></i>BÚSQUEDA</p>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="text-muted" for=""><i class="fas fa-font mr-2"></i>Palabra Clave</label>
                        <input type="text" class="form-control input-tags" id="general" data-role="tagsinput"
                            placeholder="Búsca en todo el curriculum" wire:model.debounce.800ms="general">
                    </div>
                    <div class="col-sm-12 col-md-12 mb-3">
                        <label class="text-muted" for="tipoactivo_id"><i
                                class="fas fa-puzzle-piece mr-2"></i>Área</label>
                        <select class="form-control {{ $errors->has('area') ? 'is-invalid' : '' }}"
                            wire:model.debounce.800ms="area_id">
                            <option value="">-- Seleccionar --</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}">
                                    {{ $area->area }}</option>
                            @endforeach
                            <option value="">Ver todas</option>
                        </select>
                    </div>

                    <div class="col-sm-12 col-md-12">
                        <label class="text-muted" for="tipoactivo_id"><i
                                class="fas fa-user mr-2"></i>Empleado</label>
                        <select class="form-control {{ $errors->has('tipoactivo') ? 'is-invalid' : '' }}"
                            wire:model.debounce.800ms="empleado_id" id="tipoactivo_id">
                            <option value="">-- Seleccionar --</option>
                            @foreach ($empleados as $empleado)
                                <option value="{{ $empleado->id }}">
                                    {{ $empleado->name }}</option>
                            @endforeach
                            <option value="">Ver todos</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p class="text-muted"><i class="fas fa-filter mr-2"></i>BÚSQUEDA ESPECÍFICA</p>
                    </div>
                    <div class="col-12">
                        <p class="text-muted" style="border-bottom: 2px solid #1BB0B0">CERTIFICACIONES</p>
                    </div>
                    <div class="col-12">
                        <label class="text-muted" for=""><i class="fas fa-award mr-2"></i>Certificación</label>
                        <input type="text" class="form-control input-tags" id="certificacion" data-role="tagsinput"
                            placeholder="Certificación" wire:model.debounce.800ms="certificacion">
                    </div>
                    <div class="col-12 mt-3">
                        <p class="text-muted" style="border-bottom: 2px solid #1BB0B0">CURSOS / DIPLOMADOS</p>
                    </div>
                    <div class="col-12">
                        <label class="text-muted" for=""><i class="fas fa-chalkboard-teacher mr-2"></i>Curso</label>
                        <input type="text" class="form-control" placeholder="Curso" wire:model.debounce.800ms="curso">
                    </div>
                    {{-- <div class="col-12 mt-3">
                        <p class="text-muted" style="border-bottom: 2px solid #1BB0B0">EXPERIENCIA</p>
                    </div>
                    <div class="col-12 mt-2">
                        <label class="text-muted" for=""><i class="fas fa-briefcase mr-2"></i>Puesto</label>
                        <input type="text" class="form-control" placeholder="Puesto"
                            wire:model.debounce.800ms="puestoExperiencia">
                    </div> --}}
                    {{-- <div class="col-12 mt-2">
                        <label class="text-muted" for=""><i class="fas fa-pen-square mr-2"></i>Descripción</label>
                        <input type="text" class="form-control" placeholder="Descripción"
                            wire:model.debounce.800ms="descripcionExperiencia">
                    </div> --}}
                </div>
            </div>
        @endif
        <div class="{{ $isPersonal ? 'col-sm-12 col-md-12 col-12' : 'col-sm-9 col-md-9 col-9' }}"
            x-data="{open:true}">
            @if ($empleadosCV->count())
                @if (!$isPersonal)
                    <div class="text-center" wire:loading>
                        <i class="fas fa-circle-notch fa-spin mr-2"></i> Buscando Coincidencias
                    </div>
                    <div class="row col-12 align-items-center" x-show="open">
                        @foreach ($empleadosCV as $item)
                            <div style="cursor: pointer;" class="border p-2 text-center col-sm-3 col-md-3 col-3"
                                x-on:click="open = false" wire:click="mostrarCurriculum({{ $item->id }})">
                                <img src="{{ asset("storage/empleados/imagenes/{$item->avatar}") }}"
                                    style="max-width:40px;clip-path:circle(50% at 50% 50%)">
                                <p class="m-0"><span
                                        class="badge badge-light">{{ $item->area->area }}</span></p>
                                <p class="text-muted mt-1 badge badge-light mb-0" style="font-size:12px"
                                    title="{{ $item->name }}">
                                    {{ Str::limit($item->name, 20, '...') }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif
            @else
                <div class="px-1 py-2 mx-3 rounded shadow"
                    style="background-color: #DBEAFE; border-top:solid 3px #3B82F6;">
                    <div class="row w-100">
                        <div class="text-center col-1 align-items-center d-flex justify-content-center">
                            <div class="w-100">
                                <i class="fas fa-info-circle" style="color: #3B82F6; font-size: 22px"></i>
                            </div>
                        </div>
                        <div class="col-11">
                            <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                                Atención</p>
                            <p class="m-0" style="font-size: 14px; color:#1E3A8A ">No se encontraron
                                coincidencias.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <img src="{{ asset('img/cv.png') }}" class="mt-3" style="height: 400px;">
                </div>
            @endif
            @if ($empleadoModel)
                @if (!$isPersonal)
                    <div x-show="!open">
                    @else
                        <div>
                @endif
                <div class="row justify-content-center">
                    @if (!$isPersonal)
                        <div class="col-12">
                            <button class="btn btn-sm btn_cancelar" x-on:click="open = true"><i
                                    class="fas fa-arrow-left"></i> Regresar</button>

                            <button onclick="javascript:imprim1(imp1);" class="btn btn-sm btn-success">
                                <i class="mr-2 fas fa-print"></i>
                                Imprimir
                            </button>


                        </div>
                    @endif
                    <div class="mt-4 col-sm-12 col-md-12">
                        <div id="imp1" class="card" style="background-color:#EDEEF0"
                            style="position-relative; height:auto">
                            <style type="text/css">
                                @media print {
                                    body {
                                        font-family: arial;
                                    }

                                    .caja_logo {
                                        width: 50%;
                                    }

                                    .h5 {
                                        padding: 20px !important;
                                    }

                                    .medidas {
                                        display: flex;
                                        justify-content: space-between;
                                    }

                                    .datos_iz_cv {
                                        width: 68%;
                                    }

                                    .datos_der_cv {
                                        margin-top: 20px;
                                        width: 30%;
                                        color: #fff;
                                    }

                                    .dato_mairg {
                                        margin-top: 25px;
                                    }
                                }

                            </style>
                            <div class="caja_img_logo">
                                <img src="{{ asset($logotipo) }}" class="mt-2 ml-4" style="width: 20%;">
                            </div>
                            <div class="row medidas">
                                <div class="mt-4 ml-4 col-md-7 datos_iz_cv">
                                    <h5 class="py-2 pl-2"
                                        style="color:#fff; font-weight:bold; background-color:#7F7F7F; width:100%">
                                        {{ $empleadoModel->name }}</h5>
                                    <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                        <span style="font-size: 17px; font-weight: bold;">
                                            Resumen</span>
                                    </div>
                                    <p style="text-align:justify">
                                        {{ $empleadoModel->resumen }}
                                    </p>
                                    <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                        <span style="font-size: 17px; font-weight: bold;">
                                            Experiencia Profesional</span>
                                    </div>
                                    @foreach ($empleadoModel->empleado_experiencia as $experiencia)
                                        <div>
                                            <strong style="color:#00A57E;text-transform: uppercase">
                                                {{ $experiencia->empresa }}</strong>
                                            <br>
                                            <span
                                                style="text-transform:capitalize; font-weight:bold">{{ $experiencia->puesto }}
                                            </span>
                                            <br>
                                            <span>
                                                Del
                                                <strong>{{ \Carbon\Carbon::parse($experiencia->inicio_mes)->format('d/m/Y') }}</strong>
                                                al
                                                <strong>{{ \Carbon\Carbon::parse($experiencia->fin_mes)->format('d/m/Y') }}</strong>
                                            </span>
                                            <span style="text-transform:capitalize; text-align:justify">
                                                <br>
                                                <p style="text-align:justify">{{ $experiencia->descripcion }}</p>
                                        </div>
                                    @endforeach

                                    <div class="mt-4 mb-3 w-100 dato_mairg " style="border-bottom: solid 2px #0CA193;">
                                        <span style="font-size: 17px; font-weight: bold;">
                                            Certificaciones</span>
                                    </div>
                                    @foreach ($empleadoModel->empleado_certificaciones as $certificaciones)
                                        <div>
                                            <strong style="color:#00A57E;text-transform: uppercase">
                                                {{ $certificaciones->nombre }}</strong>
                                            <br>
                                            @if ($certificaciones->vigencia && $certificaciones->estatus)
                                                <span>{{ $certificaciones->estatus }}
                                                    {{ Str::lower($certificaciones->estatus) == 'vencida' ? 'el' : 'al' }}
                                                    <strong>{{ \Carbon\Carbon::parse($certificaciones->vigencia)->format('d/m/Y') }}</strong>
                                                </span>
                                            @else
                                                <span>Permanente - Sin Vigencia</span>
                                            @endif
                                        </div>
                                    @endforeach

                                    <div class="mt-4 mb-3 w-100 dato_mairg " style="border-bottom: solid 2px #0CA193;">
                                        <span style="font-size: 17px; font-weight: bold;">
                                            Capacitaciones</span>
                                    </div>
                                    @foreach ($empleadoModel->empleado_cursos as $cursos)
                                        <div>
                                            <strong class="font-weight-bold"
                                                style="color:#00A57E;text-transform: uppercase">
                                                {{ $cursos->curso_diploma }}</strong>
                                            <br>
                                            <span>{{ $cursos->tipo }}</span>
                                            <br>
                                            <span>Del
                                                <strong>{{ \Carbon\Carbon::parse($cursos->año)->format('d/m/Y') }}</strong>
                                                al
                                                <strong>{{ \Carbon\Carbon::parse($cursos->fecha_fin)->format('d/m/Y') }}</strong></span>
                                            <br>
                                            <span>{{ $cursos->duracion }} Día(s)</span>
                                        </div>
                                    @endforeach

                                    <div class="mt-4 mb-3 w-100 dato_mairg " style="border-bottom: solid 2px #0CA193;">
                                        <span style="font-size: 17px; font-weight: bold;">
                                            Educación Académica</span>
                                    </div>
                                    @foreach ($empleadoModel->empleado_educacion as $educacion)
                                        <div>
                                            <strong class="font-weight-bold"
                                                style="color:#00A57E;text-transform: uppercase">
                                                {{ $educacion->institucion }}</strong>
                                            <br>
                                            <span style="text-transform:capitalize">{{ $educacion->nivel }}</span>
                                            <br>
                                            <span>
                                                Del
                                                <strong>{{ \Carbon\Carbon::parse($educacion->año_inicio)->format('d/m/Y') }}</strong>
                                                al
                                                <strong>{{ \Carbon\Carbon::parse($educacion->año_fin)->format('d/m/Y') }}</strong>
                                            </span>
                                        </div>
                                    @endforeach</ul>
                                </div>
                                <div class="mt-4 col-md-4 datos_der_cv">
                                    <div
                                        style="background: linear-gradient(0deg, rgba(69,125,182,1) 0%, rgba(8,170,157,1) 60%); height:100%; padding:10px;">
                                        <div class="text-center w-100"><img class="mt-3"
                                                style="height: 100px; clip-path: circle(50px at 50% 50%); margin:auto"
                                                src="{{ asset('storage/empleados/imagenes/') . '/' . $empleadoModel->Avatar }}"
                                                alt=""></div>
                                        <div class="mt-3 mb-4 w-100" style="border-bottom: solid 2px #fff;">
                                            <span class="text-white " style="font-size: 14px; font-weight: bold;">
                                                Datos Generales</span>
                                        </div>
                                        <strong><i
                                                class="ml-2 mr-2 text-white fas fa-map-marker-alt"></i>Dirección</strong>
                                        <br>
                                        <div style="margin-left:28px;">
                                            <span>{{ $empleadoModel->sede ? $empleadoModel->sede->direccion : 'Dato no definido' }}</span>
                                        </div>
                                        <br>
                                        <strong><i class="ml-2 mr-2 text-white fas fa-phone-alt"></i>Número de
                                            Teléfono</strong>
                                        <br>
                                        <div style="margin-left:28px;">
                                            <span>{{ $empleadoModel->telefono }}</span>
                                        </div>
                                        <br>
                                        <strong><i class="ml-2 mr-2 text-white fas fa-envelope"></i>Correo
                                            Electrónico</strong>
                                        <br>
                                        <div style="margin-left:28px;">
                                            <span>{{ $empleadoModel->email }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5 row px-5">
                    <div class="col-sm-12 col-md-5 card pt-3">
                        <div class="mb-3 w-100 " style="border-bottom: solid 2px #0CA193;">
                            <span style="font-size: 17px; font-weight: bold;"><i
                                    class="fas fa-folder-open iconos-crear"></i>Documentos Personales</span>
                        </div>
                        <br>
                        @foreach ($empleadoModel->empleado_documentos as $documentos)
                            <ul>
                                <a href="{{ $documentos->ruta_documento }}" style="text-decoration:none"
                                    target="_blank" alt=""><span><i
                                            class="fas fa-file iconos-crear"></i>{{ $documentos->documentos ? $documentos->documentos : 'Sin documento' }}</span></a>
                            </ul>
                        @endforeach
                        @if ($isPersonal)
                            <div class="text-center">
                                <label type="button" onclick="event.preventDefault();return false;" data-toggle="modal"
                                    data-target="#modalDocumentos" style="cursor: pointer;" class="text-center">
                                    <i class="fas fa-upload text-success" style="font-size: 15px"></i> Subir
                                    Documento
                                </label>
                            </div>
                            <div class="modal fade" id="modalDocumentos" data-backdrop="static"
                                data-keyboard="false" tabindex="-1" aria-labelledby="modalDocumentosLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalDocumentosLabel">
                                                <i class="fas fa-award mr-2"></i> Cargar Documentos
                                            </h5>
                                            <button onclick="limpiarForm();event.preventDefault()" type="button"
                                                class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.cargarDocumentos', $empleadoModel) }}"
                                                method="POST" id="formCargarDocumento" class="form-group m-0">
                                                <div class="row">
                                                    <div class="form-group col-sm-6 col-lg-6 col-md-6">
                                                        <label for="nombre"><i
                                                                class="fas fa-file-signature iconos-crear"></i>Nombre</label>
                                                        <input
                                                            class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                                                            type="text" name="nombre" id="nombre_documento"
                                                            value="{{ old('nombre', '') }}">
                                                        <span class="errors nombre_error text-danger"></span>
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="numero"><i
                                                                class="fas fa-barcode iconos-crear"></i>Número</label>
                                                        <input
                                                            class="form-control {{ $errors->has('numero') ? 'is-invalid' : '' }}"
                                                            type="text" name="numero" id="numero"
                                                            value="{{ old('numero', '') }}">
                                                        <span class="errors numero_error text-danger"></span>
                                                    </div>
                                                </div>
                                                <input type="file" name="documentos" id="cargarDocumento"
                                                    class="d-none ">
                                                <div class="text-center">
                                                    <label for="cargarDocumento" style="cursor: pointer;"
                                                        class="text-center m-0"><i class="fas fa-upload text-success"
                                                            style="font-size: 15px"></i> Subir
                                                        Documento <small id="infoSelectedDocumento"></small></label>
                                                </div>
                                                <div class="text-center">
                                                    <span class="errors documentos_error text-danger"></span>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                onclick="limpiarForm();event.preventDefault()">Cancelar</button>
                                            <button id="btnCargarDocumento" type="button" class="btn btn-primary"><i
                                                    class="fas fa-upload mr-2"></i>Cargar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endif
                    </div>
                    <div class="col-md col"></div>
                    <div class="col-sm-12 col-md-5 card pt-3">
                        <div class="mb-3 w-100 " style="border-bottom: solid 2px #0CA193;">
                            <span style="font-size: 17px; font-weight: bold;"><i
                                    class="fas fa-folder-open iconos-crear"></i>Certificados</span>
                        </div>
                        <br>
                        @foreach ($empleadoModel->empleado_certificaciones as $certificaciones)
                            <ul>
                                <a href="{{ asset('storage/certificados_empleados/') . '/' . $certificaciones->documento }}"
                                    style="text-decoration:none" target="_blank" alt=""><span><i
                                            class="fas fa-file iconos-crear"></i>{{ $certificaciones->documento }}</span></a>
                            </ul>
                        @endforeach
                        @if ($isPersonal)
                            <div x-data="{open:false}">
                                <div class="text-center">
                                    <label type="button" onclick="event.preventDefault();return false;"
                                        data-toggle="modal" data-target="#modalCertificaciones" style="cursor: pointer;"
                                        class="text-center">
                                        <i class="fas fa-upload text-success" style="font-size: 15px"></i> Subir
                                        Certificación
                                    </label>
                                </div>
                                <div class="modal fade" id="modalCertificaciones" data-backdrop="static"
                                    data-keyboard="false" tabindex="-1" aria-labelledby="modalCertificacionesLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalCertificacionesLabel">
                                                    <i class="fas fa-award mr-2"></i> Cargar Certificación
                                                </h5>
                                                <button x-on:click="open = false"
                                                    onclick="limpiarForm();event.preventDefault()" type="button"
                                                    class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form
                                                    action="{{ route('admin.cargarCertificacion', $empleadoModel) }}"
                                                    method="POST" id="formCargarCertificacion" class="form-group m-0">
                                                    <div class="row">
                                                        <div class="form-group col-sm-12 col-lg-12 col-md-12">
                                                            <label for="nombre"><i
                                                                    class="fas fa-file-signature iconos-crear"></i>Nombre</label>
                                                            <input
                                                                class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                                                                type="text" name="nombre" id="nombre_certificado"
                                                                value="{{ old('nombre', '') }}">
                                                            <span class="errors nombre_error text-danger"></span>
                                                        </div>
                                                        <div class="col-12 form-group">
                                                            <div class="form-check">
                                                                <input class="form-check-input" name="aplicaVigencia"
                                                                    type="checkbox" id="aplicaVigencia"
                                                                    x-on:change="open = !open">
                                                                <label class="form-check-label" for="aplicaVigencia">
                                                                    ¿Aplica Vigencia?
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div x-show="open" class="col-md-12 row" x-transition>
                                                            <div class="form-group col-sm-6">
                                                                <label for="vigencia"><i
                                                                        class="far fa-calendar-alt iconos-crear"></i>Vigencia</label>
                                                                <input
                                                                    class="form-control {{ $errors->has('vigencia') ? 'is-invalid' : '' }}"
                                                                    type="date" name="vigencia" id="vigencia"
                                                                    value="{{ old('vigencia', '') }}">
                                                                <span class="errors vigencia_error text-danger"></span>
                                                            </div>
                                                            <div class="form-group col-sm-6">
                                                                <label for="estatus"><i
                                                                        class="fas fa-street-view iconos-crear"></i>Estatus</label>
                                                                <input
                                                                    class="form-control {{ $errors->has('estatus') ? 'is-invalid' : '' }}"
                                                                    type="text" name="estatus" id="vencio_alta"
                                                                    value="{{ old('estatus', '') }}" readonly>
                                                                <span class="errors estatus_error text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="file" name="documento" id="cargarCertificacion"
                                                        class="d-none">
                                                    <div class="text-center">
                                                        <label for="cargarCertificacion" style="cursor: pointer;"
                                                            class="text-center m-0"><i
                                                                class="fas fa-upload text-success"
                                                                style="font-size: 15px"></i> Subir
                                                            Certificado <small
                                                                id="infoSelectedCertificacion"></small></label>
                                                    </div>
                                                    <div class="text-center">
                                                        <span class="errors documento_error text-danger"></span>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                    onclick="limpiarForm();event.preventDefault()"
                                                    x-on:click="open = false">Cancelar</button>
                                                <button id="btnCargarCertificado" type="button"
                                                    class="btn btn-primary"><i
                                                        class="fas fa-upload mr-2"></i>Cargar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <br>
                </div>
        </div>
        @endif
    </div>
    {{-- @if ($empleado_id != '')
            <div class="___class_+?11___">
                <div class="row justify-content-center">
                    <div class="mt-4 col-sm-12 col-md-12">
                        <div class="card" style="background-color:#EDEEF0"
                        style="position-relative; height:auto">
                            <div class="caja_img_logo">
                                <img src="{{ asset($logotipo) }}" class="mt-2 ml-4" style="width: 20%;">
                            </div>
                            <div class="row medidas">
                                <div class="mt-4 ml-4 col-md-7">
                                    <h5 class="py-2 pl-2"
                                    style="color:#fff; font-weight:bold; background-color:#7F7F7F; width:100%">
                                    {{ $empleadoModel->name }}</h5>
                                    <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                        <span style="font-size: 17px; font-weight: bold;">
                                            Resumen</span>
                                        </div>
                                        <p style="text-transform:capitalize; text-align:justify">
                                            {{ $empleadoModel->resumen }}
                                    </p>
                                    <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                        <span style="font-size: 17px; font-weight: bold;">
                                            Experiencia Profesional</span>
                                    </div>
                                    @foreach ($empleadoModel->empleado_experiencia as $experiencia)
                                        <div>
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
                                        </div>
                                    @endforeach
    
                                    <div class="mt-4 mb-3 w-100 dato_mairg " style="border-bottom: solid 2px #0CA193;">
                                        <span style="font-size: 17px; font-weight: bold;">
                                            Certificaciones</span>
                                    </div>
                                    @foreach ($empleadoModel->empleado_certificaciones as $certificaciones)
                                        <div>
                                            <strong style="color:#00A57E;text-transform: uppercase">
                                                {{ $certificaciones->nombre }}</strong>
                                            <br>
                                            @if ($certificaciones->vigencia && $certificaciones->estatus)
                                                <span>{{ $certificaciones->estatus }}</span>
                                                <br>
                                                <span>{{ $certificaciones->vigencia }}</span>
                                            @else
                                                <span>Permanente - Sin Vigencia</span>
                                            @endif
                                        </div>
                                    @endforeach
    
                                    <div class="mt-4 mb-3 w-100 dato_mairg " style="border-bottom: solid 2px #0CA193;">
                                        <span style="font-size: 17px; font-weight: bold;">
                                            Cursos / Diplomados</span>
                                    </div>
                                    @foreach ($empleadoModel->empleado_cursos as $cursos)
                                        <div>
                                            <strong class="font-weight-bold"
                                                style="color:#00A57E;text-transform: uppercase">
                                                {{ $cursos->curso_diploma }}</strong>
                                            <br>
                                            <span>{{ $cursos->tipo }}</span>
                                            <br>
                                            <span>{{ $cursos->año }}</span>
                                            <br>
                                            <span>{{ $cursos->duracion }} Horas</span>
                                        </div>
                                    @endforeach
    
                                    <div class="mt-4 mb-3 w-100 dato_mairg " style="border-bottom: solid 2px #0CA193;">
                                        <span style="font-size: 17px; font-weight: bold;">
                                            Educación</span>
                                    </div>
                                    @foreach ($empleadoModel->empleado_educacion as $educacion)
                                        <div>
                                            <strong class="font-weight-bold"
                                                style="color:#00A57E;text-transform: uppercase">
                                                {{ $educacion->institucion }}</strong>
                                            <br>
                                            <span
                                                style="text-transform:capitalize">{{ $educacion->nivel }}</span>
                                            <br>
                                            <span>{{ $educacion->año_inicio }} -
                                                {{ $educacion->año_fin }}</span>
                                        </div>
                                    @endforeach</ul>
                                </div>
                                <div class="mt-4 col-md-4">
                                    <div
                                        style="background: linear-gradient(0deg, rgba(69,125,182,1) 0%, rgba(8,170,157,1) 60%); height:100%; padding:10px;">
                                        <div class="text-center w-100"><img class="mt-3"
                                                style="height: 100px; clip-path: circle(50px at 50% 50%); margin:auto"
                                                src="{{ asset('storage/empleados/imagenes/') . '/' . $empleadoModel->Avatar }}"
                                                alt=""></div>
                                        <div class="mt-3 mb-4 w-100" style="border-bottom: solid 2px #fff;">
                                            <span class="text-white "
                                                style="font-size: 14px; font-weight: bold;">
                                                Datos Generales</span>
                                        </div>
                                        <strong><i
                                                class="ml-2 mr-2 text-white fas fa-map-marker-alt"></i>Dirección</strong>
                                        <br>
                                        <span style="margin-left:28px;">{{ $empleadoModel->telefono }}</span>
                                        <br>
                                        <strong><i class="ml-2 mr-2 text-white fas fa-phone-alt"></i>Número de
                                            Teléfono</strong>
                                        <br>
                                        <span style="margin-left:29px;">{{ $empleadoModel->telefono }}</span>
                                        <br>
                                        <strong><i class="ml-2 mr-2 text-white fas fa-envelope"></i>Correo
                                            Electrónico</strong>
                                        <br>
                                        <span style="margin-left:30px;">{{ $empleadoModel->email }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5 row px-5">
                    <div class="col-sm-12 col-md-5 card pt-3">
                        <div class="mb-3 w-100 " style="border-bottom: solid 2px #0CA193;">
                            <span style="font-size: 17px; font-weight: bold;"><i
                                    class="fas fa-folder-open iconos-crear"></i>Documentos</span>
                        </div>
                        <br>
                        @foreach ($empleadoModel->empleado_documentos as $documentos)
                            <ul>
                                <a href="{{ asset('storage/documentos_empleados/') . '/' . $documentos->documentos }}"
                                    style="text-decoration:none" target="_blank" alt=""><span><i
                                            class="fas fa-file iconos-crear"></i>{{ $documentos->documentos ? $documentos->documentos : 'Sin documento' }}</span></a>
                            </ul>
                        @endforeach
                        @if ($isPersonal)
    
                            <div class="text-center">
                                <label type="button" onclick="event.preventDefault();return false;"
                                    data-toggle="modal" data-target="#modalDocumentos" style="cursor: pointer;"
                                    class="text-center">
                                    <i class="fas fa-upload text-success" style="font-size: 15px"></i> Subir
                                    Documento
                                </label>
                            </div>
                            <div class="modal fade" id="modalDocumentos" data-backdrop="static"
                                data-keyboard="false" tabindex="-1" aria-labelledby="modalDocumentosLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalDocumentosLabel">
                                                <i class="fas fa-award mr-2"></i> Cargar Documentos
                                            </h5>
                                            <button onclick="limpiarForm();event.preventDefault()" type="button"
                                                class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.cargarDocumentos', $empleado_id) }}"
                                                method="POST" id="formCargarDocumento" class="form-group m-0">
                                                <div class="row">
                                                    <div class="form-group col-sm-6 col-lg-6 col-md-6">
                                                        <label for="nombre"><i
                                                                class="fas fa-file-signature iconos-crear"></i>Nombre</label>
                                                        <input
                                                            class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                                                            type="text" name="nombre" id="nombre_documento"
                                                            value="{{ old('nombre', '') }}">
                                                        <span class="errors nombre_error text-danger"></span>
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="numero"><i
                                                                class="fas fa-barcode iconos-crear"></i>Número</label>
                                                        <input
                                                            class="form-control {{ $errors->has('numero') ? 'is-invalid' : '' }}"
                                                            type="text" name="numero" id="numero"
                                                            value="{{ old('numero', '') }}">
                                                        <span class="errors numero_error text-danger"></span>
                                                    </div>
                                                </div>
                                                <input type="file" name="documentos" id="cargarDocumento"
                                                    class="d-none ">
                                                <div class="text-center">
                                                    <label for="cargarDocumento" style="cursor: pointer;"
                                                        class="text-center m-0"><i
                                                            class="fas fa-upload text-success"
                                                            style="font-size: 15px"></i> Subir
                                                        Documento <small id="infoSelectedDocumento"></small></label>
                                                </div>
                                                <div class="text-center">
                                                    <span class="errors documentos_error text-danger"></span>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                onclick="limpiarForm();event.preventDefault()">Cancelar</button>
                                            <button id="btnCargarDocumento" type="button"
                                                class="btn btn-primary"><i
                                                    class="fas fa-upload mr-2"></i>Cargar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                        @endif
                    </div>
                    <div class="col-md col"></div>
                    <div class="col-sm-12 col-md-5 card pt-3">
                        <div class="mb-3 w-100 " style="border-bottom: solid 2px #0CA193;">
                            <span style="font-size: 17px; font-weight: bold;"><i
                                    class="fas fa-folder-open iconos-crear"></i>Certificados</span>
                        </div>
                        <br>
                        @foreach ($empleadoModel->empleado_certificaciones as $certificaciones)
                            <ul>
                                <a href="{{ asset('storage/certificados_empleados/') . '/' . $certificaciones->documento }}"
                                    style="text-decoration:none" target="_blank" alt=""><span><i
                                            class="fas fa-file iconos-crear"></i>{{ $certificaciones->documento }}</span></a>
                            </ul>
                        @endforeach
                        @if ($isPersonal)
                            <div x-data="{open:false}">
                                <div class="text-center">
                                    <label type="button" onclick="event.preventDefault();return false;"
                                        data-toggle="modal" data-target="#modalCertificaciones"
                                        style="cursor: pointer;" class="text-center">
                                        <i class="fas fa-upload text-success" style="font-size: 15px"></i> Subir
                                        Certificación
                                    </label>
                                </div>
                                <div class="modal fade" id="modalCertificaciones" data-backdrop="static"
                                    data-keyboard="false" tabindex="-1" aria-labelledby="modalCertificacionesLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalCertificacionesLabel">
                                                    <i class="fas fa-award mr-2"></i> Cargar Certificación
                                                </h5>
                                                <button x-on:click="open = false"
                                                    onclick="limpiarForm();event.preventDefault()" type="button"
                                                    class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form
                                                    action="{{ route('admin.cargarCertificacion', $empleado_id) }}"
                                                    method="POST" id="formCargarCertificacion"
                                                    class="form-group m-0">
                                                    <div class="row">
                                                        <div class="form-group col-sm-12 col-lg-12 col-md-12">
                                                            <label for="nombre"><i
                                                                    class="fas fa-file-signature iconos-crear"></i>Nombre</label>
                                                            <input
                                                                class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                                                                type="text" name="nombre" id="nombre_certificado"
                                                                value="{{ old('nombre', '') }}">
                                                            <span class="errors nombre_error text-danger"></span>
                                                        </div>
                                                        <div class="col-12 form-group">
                                                            <div class="form-check">
                                                                <input class="form-check-input"
                                                                    name="aplicaVigencia" type="checkbox"
                                                                    id="aplicaVigencia" x-on:change="open = !open">
                                                                <label class="form-check-label"
                                                                    for="aplicaVigencia">
                                                                    ¿Aplica Vigencia?
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div x-show="open" class="col-md-12 row" x-transition>
                                                            <div class="form-group col-sm-6">
                                                                <label for="vigencia"><i
                                                                        class="far fa-calendar-alt iconos-crear"></i>Vigencia</label>
                                                                <input
                                                                    class="form-control {{ $errors->has('vigencia') ? 'is-invalid' : '' }}"
                                                                    type="date" name="vigencia" id="vigencia"
                                                                    value="{{ old('vigencia', '') }}">
                                                                <span
                                                                    class="errors vigencia_error text-danger"></span>
                                                            </div>
                                                            <div class="form-group col-sm-6">
                                                                <label for="estatus"><i
                                                                        class="fas fa-street-view iconos-crear"></i>Estatus</label>
                                                                <input
                                                                    class="form-control {{ $errors->has('estatus') ? 'is-invalid' : '' }}"
                                                                    type="text" name="estatus" id="vencio_alta"
                                                                    value="{{ old('estatus', '') }}" readonly>
                                                                <span
                                                                    class="errors estatus_error text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="file" name="documento" id="cargarCertificacion"
                                                        class="d-none">
                                                    <div class="text-center">
                                                        <label for="cargarCertificacion" style="cursor: pointer;"
                                                            class="text-center m-0"><i
                                                                class="fas fa-upload text-success"
                                                                style="font-size: 15px"></i> Subir
                                                            Certificado <small
                                                                id="infoSelectedCertificacion"></small></label>
                                                    </div>
                                                    <div class="text-center">
                                                        <span class="errors documento_error text-danger"></span>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal"
                                                    onclick="limpiarForm();event.preventDefault()"
                                                    x-on:click="open = false">Cancelar</button>
                                                <button id="btnCargarCertificado" type="button"
                                                    class="btn btn-primary"><i
                                                        class="fas fa-upload mr-2"></i>Cargar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <br>
                </div>
            </div>
        @else
    
        @endif --}}
</div>
<script src="https://unpkg.com/@yaireo/tagify"></script>
<script src="https://unpkg.com/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('tagify', function(e) {
            var input = document.querySelector('#certificacion')
            var tagify = new Tagify(input, {
                dropdown: {
                    enabled: 0
                },
            })
            tagify.on('change', (e) => {
                let values = [];
                if (e.detail.value) {
                    values = JSON.parse(e.detail.value);
                }
                let string = "";
                values.forEach(element => {
                    string += `${element.value},`;
                });

                if (e.detail.value) {
                    let result = string.slice(0, -1);
                    console.log(result);
                    @this.set('certificacion', result)
                } else {
                    @this.set('certificacion', null)
                }
            })
        })
        var input = document.querySelector('#certificacion')
        if (input) {
            var tagify = new Tagify(input, {
                dropdown: {
                    enabled: 0
                },
            })

            tagify.on('change', (e) => {
                let values = [];
                if (e.detail.value) {
                    values = JSON.parse(e.detail.value);
                }
                let string = "";
                values.forEach(element => {
                    string += `${element.value},`;
                });
                if (e.detail.value) {
                    let result = string.slice(0, -1);
                    console.log(result);
                    @this.set('certificacion', result)
                } else {
                    @this.set('certificacion', null)
                }
            })
        }
    })
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.limpiarForm = () => {
            limpiarErrores();
            document.getElementById('vencio_alta').style.border = 'none'
            document.getElementById('formCargarCertificacion').reset();
        }
        const btnCargarCertificado = document.getElementById('btnCargarCertificado');
        btnCargarCertificado.addEventListener('click', async (e) => {
            e.preventDefault();
            limpiarErrores();
            console.log('click');
            const formCargarCertificacion = document.getElementById('formCargarCertificacion');
            const formData = new FormData(formCargarCertificacion);
            const aplicaVigencia = document.getElementById('aplicaVigencia');
            const url = formCargarCertificacion.getAttribute('action');
            const method = formCargarCertificacion.getAttribute('method');
            formData.append('esVigente', aplicaVigencia.checked)
            const response = await fetch(url, {
                method: method,
                body: formData,
                headers: {
                    Accept: 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'),
                },
            });
            const data = await response.json();
            if (data.errors) {
                $.each(data.errors, function(indexInArray,
                    valueOfElement) {
                    document.querySelector(`span.${indexInArray}_error`)
                        .innerHTML =
                        `<i class="mr-2 fas fa-info-circle"></i> ${valueOfElement[0]}`;
                });
            }
            if (data.status === "success") {
                Swal.fire(
                    data.message,
                    '',
                    'success'
                )
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }
        });

        const inputCargarCertificacion = document.getElementById('cargarCertificacion');
        inputCargarCertificacion.addEventListener('change', function(e) {
            document.getElementById('infoSelectedCertificacion').innerHTML = `
                ${this.files.length} documento(s) seleccionados
                <label title="Remover selección" style="cursor: pointer;color:red;">&times;</label>
                `
        });

        const infoSelectedCertificacionElement = document.getElementById('infoSelectedCertificacion');
        infoSelectedCertificacionElement.addEventListener('click', function(e) {
            e.preventDefault();
            if (e.target.tagName == 'LABEL') {
                this.innerHTML = "";
                console.log(inputCargarCertificacion.files);
                inputCargarCertificacion.value = null;
                console.log(inputCargarCertificacion.files);
            }
        })

        function limpiarErrores() {
            document.querySelectorAll('.errors').forEach(item => {
                item.innerHTML = ""
            })
        }

        const vigenciaCertificado = document.getElementById('vigencia');
        vigenciaCertificado.addEventListener('change', function(e) {
            const vigencia = this.value;
            const estatus = document.getElementById('vencio_alta');
            if (Date.parse(vigencia) >= Date.now()) {
                estatus.value = "Vigente"
                estatus.style.border = "2px solid #57e262";
            } else {
                estatus.value = 'Vencida'
                estatus.style.border = "2px solid #FF9C08";
            }
        })


        const btnCargarDocumento = document.getElementById('btnCargarDocumento');
        btnCargarDocumento.addEventListener('click', async (e) => {
            e.preventDefault();
            limpiarErrores();
            console.log('click');
            const formCargarDocumento = document.getElementById('formCargarDocumento');
            const formData = new FormData(formCargarDocumento);
            const url = formCargarDocumento.getAttribute('action');
            const method = formCargarDocumento.getAttribute('method');
            const response = await fetch(url, {
                method: method,
                body: formData,
                headers: {
                    Accept: 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'),
                },
            });
            const data = await response.json();
            if (data.errors) {
                $.each(data.errors, function(indexInArray,
                    valueOfElement) {
                    document.querySelector(`span.${indexInArray}_error`)
                        .innerHTML =
                        `<i class="mr-2 fas fa-info-circle"></i> ${valueOfElement[0]}`;
                });
            }
            if (data.status === "success") {
                Swal.fire(
                    data.message,
                    '',
                    'success'
                )
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }
        });

        const inputCargarDocumento = document.getElementById('cargarDocumento');
        inputCargarDocumento.addEventListener('change', function(e) {
            document.getElementById('infoSelectedDocumento').innerHTML = `
                ${this.files.length} documento(s) seleccionados
                <label title="Remover selección" style="cursor: pointer;color:red;">&times;</label>
                `
        });

        const infoSelectedDocumentoElement = document.getElementById('infoSelectedDocumento');
        infoSelectedDocumentoElement.addEventListener('click', function(e) {
            e.preventDefault();
            if (e.target.tagName == 'LABEL') {
                this.innerHTML = "";
                console.log(inputCargarDocumento.files);
                inputCargarDocumento.value = null;
                console.log(inputCargarDocumento.files);
            }
        })


        const inputFile = document.getElementById('cargarDocumentos');
        inputFile.addEventListener('change', function(e) {
            document.getElementById('infoSelected').innerHTML = `
                ${this.files.length} documento(s) seleccionados
                `
            Swal.fire({
                title: '¿Desea almacenar estos documentos?',
                text: "",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Cargar',
                cancelButtonText: 'No',
            }).then(async (result) => {
                if (result.isConfirmed) {
                    const formulario = document.getElementById('formCargaDocumentos');
                    const url = formulario.getAttribute('action');
                    const method = formulario.getAttribute('method');
                    const formData = new FormData(formulario);
                    const response = await fetch(url, {
                        method: method,
                        body: formData,
                        headers: {
                            Accept: "application/json",
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'),
                        },
                    })
                    const data = await response.json();
                    if (data.status === "success") {
                        Swal.fire(
                            data.message,
                            '',
                            'success'
                        )
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                } else {
                    document.getElementById('infoSelected').innerHTML = ""
                }
            })
        })
    })
</script>

<script>
    function imprim1(imp1) {
        var printContents = document.getElementById('imp1').innerHTML;
        w = window.open();
        w.document.write(printContents);
        w.document.close(); // necessary for IE >= 10
        w.focus(); // necessary for IE >= 10
        w.print();
        w.close();
        return true;
    }
</script>
</div>
