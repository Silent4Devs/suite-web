<div>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/print_foda.css') }}{{config('app.cssVersion')}}">

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
            background: #345183;
            color: white;
            font-weight: 500;
        }

        .list-border-y {
            border-top: solid 1px #e3e3e3;
            border-bottom: solid 1px #e3e3e3;
        }
    </style>
    <x-loading-indicator />
    @php
        use App\Models\Organizacion;
        $organizacion = Organizacion::getFirst();
        $logotipo = $organizacion->logotipo;
    @endphp

    @if (!$isPersonal)
        <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
            CURRICULUM VITAE
        </div>
    @else
        <div class="d-flex justify-content-end">
            {{-- @can('subir_documentacion_empleados')
                <button data-toggle="modal" data-target="#modalDocumentos" data-backdrop="static" data-keyboard="false"
                    class="btn btn-danger btn-md"><i class="fas fa-plus mr-1"></i>Documento</button>
            @endcan --}}

            <button onclick="$('#modalCertificaciones').modal('show');" class="btn btn-danger btn-md"><i
                    class="fas fa-plus mr-1"></i>Certificación</button>


            <button onclick="event.preventDefault();return false;" data-toggle="modal" data-target="#modalcursoIt"
                class="btn btn-danger btn-md"><i class="fas fa-plus mr-1"></i>Capacitación</button>

            <a class="btn btn-danger btn-md " href="{{ route('admin.editarCompetencias', $empleadoModel) }}">Editar</a>

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
                        <label class="text-muted" for="tipoactivo_id"><i class="fas fa-user mr-2"></i>Empleado</label>
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
                        <p class="text-muted" style="border-bottom: 2px solid #345183">CERTIFICACIONES</p>
                    </div>
                    <div class="col-12">
                        <label class="text-muted" for=""><i class="fas fa-award mr-2"></i>Certificación</label>
                        <input type="text" class="form-control" placeholder="Certificación"
                            wire:model.debounce.800ms="certificacion">
                    </div>
                    <div class="col-12 mt-3">
                        <p class="text-muted" style="border-bottom: 2px solid #345183">CURSOS / DIPLOMADOS</p>
                    </div>
                    <div class="col-12">
                        <label class="text-muted" for=""><i
                                class="fas fa-chalkboard-teacher mr-2"></i>Curso</label>
                        <input type="text" class="form-control" placeholder="Curso"
                            wire:model.debounce.800ms="curso">
                    </div>
                    {{-- <div class="col-12 mt-3">
                        <p class="text-muted" style="border-bottom: 2px solid #345183">EXPERIENCIA</p>
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
            x-data="{ open: true }">
            @if ($empleadosCV->count())
                @if (!$isPersonal)
                    <div class="text-center" wire:loading>
                        <i class="fas fa-circle-notch fa-spin mr-2"></i> Buscando Coincidencias
                    </div>
                    <div class="row col-12 align-items-center mx-md-m5" x-show="open">
                        @foreach ($empleadosCV as $item)
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div style="cursor: pointer; border:1px solid #ccc!important;  border-radius: 5px; height: 80px;"
                                    class="p-2 shadow-sm mb-3" x-on:click="open = false"
                                    wire:click="mostrarCurriculum({{ $item->id }})">
                                    <div class="row">
                                        <div class="col-sm-3 col-md-3 col-lg-3 mt-2">
                                            <img src="{{ asset("storage/empleados/imagenes/{$item->avatar}") }}"
                                                style="max-width:40px;clip-path:circle(50% at 50% 50%)">
                                        </div>
                                        <div class="col-sm-8 col-md-8 col-lg-8 mt-2">
                                            <p class="m-0" style="font-size:10px; font-weight:bold; ">
                                                <span>{{ $item->area->area }}</span>
                                            </p>
                                            <p class="m-0 text-muted" style="font-size:10px"
                                                title="{{ $item->name }}">
                                                {{ Str::limit($item->name, 20, '...') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class=" col-12 d-flex justify-content-end">
                            {{ $empleadosCV->links() }}
                        </div>
                    </div>
                @endif
            @else
                <div class="px-1 py-2 mx-3 rounded shadow"
                    style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                    <div class="row w-100">
                        <div class="text-center col-1 align-items-center d-flex justify-content-center">
                            <div class="w-100">
                                <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
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

                            <button onclick="imprimirElemento('imp1');" class="btn btn-sm btn-success">
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
                                        overflow: unset !important;
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
                            <div class="caja_img_logo mt-4">
                                <img src="{{ asset($logotipo) }}" class="mt-2 ml-4" style="width: 100px;">
                            </div>
                            <div class="row medidas">
                                <div class="mt-4 mb-3  ml-4 col-md-7 datos_iz_cv">
                                    <h5 class="py-2 pl-2"
                                        style="color:#fff; font-weight:bold; background-color:#7F7F7F; width:100%">
                                        {{ $empleadoModel->name }}</h5>
                                    <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #345183;">
                                        <span style="font-size: 17px; font-weight: bold;">
                                            Resumen</span>
                                    </div>
                                    <p style="text-align:justify">
                                        {{ $empleadoModel->resumen ? $empleadoModel->resumen : 'No hay resumen' }}
                                    </p>
                                    <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #345183;">
                                        <span style="font-size: 17px; font-weight: bold;">
                                            Experiencia Profesional</span>
                                    </div>
                                    @forelse ($empleadoModel->empleado_experiencia as $experiencia)
                                        <div>
                                            <strong style="color:#00A57E;text-transform: uppercase">
                                                {{ $experiencia->empresa }}</strong>
                                            <br>
                                            <span
                                                style="text-transform:capitalize; font-weight:bold">{{ $experiencia->puesto }}
                                            </span>
                                            <br>
                                            <span>
                                                De
                                                <strong>{{ $experiencia->inicio_mes }}</strong>
                                                a
                                                @if (!$experiencia->fin_mes)
                                                    <strong>día de hoy</strong>
                                                @else
                                                    <strong>{{ $experiencia->fin_mes }}</strong>
                                                @endif

                                            </span>
                                            <span style="text-transform:capitalize; text-align:justify">
                                                <br>
                                                <p style="text-align:justify">{{ $experiencia->descripcion }}</p>
                                        </div>
                                    @empty
                                        <p><i class="fas fa-info-circle text-primary mr-2"></i>No hay información
                                            registrada
                                        </p>
                                    @endforelse

                                    <div class="mt-4 mb-3 w-100 dato_mairg "
                                        style="border-bottom: solid 2px #345183;">
                                        <span style="font-size: 17px; font-weight: bold;">
                                            Certificaciones</span>
                                    </div>
                                    @forelse ($empleadoModel->empleado_certificaciones as $certificaciones)
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
                                    @empty
                                        <p><i class="fas fa-info-circle text-primary mr-2"></i>No hay información
                                            registrada
                                        </p>
                                    @endforelse

                                    <div class="mt-4 mb-3 w-100 dato_mairg "
                                        style="border-bottom: solid 2px #345183;">
                                        <span style="font-size: 17px; font-weight: bold;">
                                            Capacitaciones</span>
                                    </div>
                                    @forelse ($empleadoModel->empleado_cursos as $cursos)
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
                                    @empty
                                        <p><i class="fas fa-info-circle text-primary mr-2"></i>No hay información
                                            registrada
                                        </p>
                                    @endforelse

                                    <div class="mt-4 mb-3 w-100 dato_mairg "
                                        style="border-bottom: solid 2px #345183;">
                                        <span style="font-size: 17px; font-weight: bold;">
                                            Educación Académica</span>
                                    </div>
                                    @forelse ($empleadoModel->empleado_educacion as $educacion)
                                        <div>
                                            <strong class="font-weight-bold"
                                                style="color:#00A57E;text-transform: uppercase">
                                                {{ $educacion->institucion }}</strong>
                                            <br>
                                            <span style="text-transform:capitalize">{{ $educacion->nivel }}</span>
                                            <br>
                                            <span>
                                                De
                                                <strong>{{ $educacion->año_inicio }}</strong>
                                                a
                                                @if (!$educacion->año_fin)
                                                    <strong>día de hoy</strong>
                                                @else
                                                    <strong>{{ $educacion->año_fin }}</strong>
                                                @endif

                                                {{-- <strong>{{ \Carbon\Carbon::parse($educacion->año_fin)->format('d/m/Y') }}</strong> --}}
                                            </span>
                                        </div>
                                    @empty
                                        <p><i class="fas fa-info-circle text-primary mr-2"></i>No hay información
                                            registrada
                                        </p>
                                    @endforelse
                                    <div class="mt-4 mb-3 w-100 dato_mairg "
                                        style="border-bottom: solid 2px #345183;">
                                        <span style="font-size: 17px; font-weight: bold;">
                                            Idiomas</span>
                                    </div>
                                    @forelse ($empleadoModel->idiomas as $idioma)
                                        <div>
                                            <strong class="font-weight-bold"
                                                style="color:#00A57E;text-transform: uppercase">
                                                {{ $idioma->language ? $idioma->language->idioma : 'Sin definir' }}</strong>
                                            <br>
                                            <span style="text-transform:capitalize">
                                                <strong>Nivel:</strong> {{ $idioma->nivel }}
                                            </span>
                                            <br>
                                            <span style="text-transform:capitalize" class="mb-">
                                                <strong>Porcentaje:</strong> {{ $idioma->porcentaje }} %
                                            </span>
                                        </div>
                                    @empty
                                        <p><i class="fas fa-info-circle text-primary mr-2"></i>No hay información
                                            registrada
                                        </p>
                                    @endforelse
                                    </ul>
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
                                        <strong class="text-white"><i
                                                class="ml-2 mr-2 text-white fas fa-map-marker-alt"></i>Dirección</strong>
                                        <br>
                                        <div class="text-white" style="margin-left:28px;">
                                            <span>{{ $empleadoModel->sede ? $empleadoModel->sede->direccion : 'Dato no definido' }}</span>
                                        </div>
                                        <br>
                                        <strong class="text-white"><i
                                                class="ml-2 mr-2 text-white fas fa-phone-alt"></i>Número de
                                            Teléfono</strong>
                                        <br>
                                        <div class="text-white" style="margin-left:28px;">
                                            <span>{{ $empleadoModel->telefono }}</span>
                                        </div>
                                        <br>
                                        <strong class="text-white"><i
                                                class="ml-2 mr-2 text-white fas fa-envelope"></i>Correo
                                            Electrónico</strong>
                                        <br>
                                        <div class="text-white" style="margin-left:28px;">
                                            <span>{{ $empleadoModel->email }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3 row">
                    {{-- <div class="col-sm-12 col-md-4 col-sm-4 pt-3" x-data="{open:false}">
                        <div class="row justify-content-center">
                            <div class="col-11 border rounded shadow-sm p-4">
                                <div class="mb-3 w-100 " style="border-bottom: solid 2px #345183;">
                                    <div class="row align-items-center justify-content-center">
                                        <div class="col-10" style="white-space: nowrap;">
                                            <span style="font-size: 17px; font-weight: bold;"><i
                                                    class="fas iconos-crear"
                                                    x-bind:class="! open ? 'fa-folder' : 'fa-folder-open'"></i>Mi
                                                Expediente
                                            </span>
                                        </div>
                                        <div class="col text-center">
                                            <i class="fas text-muted"
                                                x-bind:class="! open ? 'fa-plus-circle' : 'fa-minus-circle'"
                                                x-on:click="open = ! open"></i>
                                        </div>
                                    </div>
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


                                                                <select class="form-control" name="nombre" id="nombre_documento">
                                                                    <option value="" selected disabled>Selecciones documento</option>
                                                                    @forelse($lista_docs as $list_doc)
                                                                        <option
                                                                            data-activar="{{ $list_doc->activar_numero ? 'si' : 'no'}}"
                                                                            data-tipo="{{ $list_doc->tipo }}"

                                                                        {{ $list_doc->documento }}
                                                                    </option>
                                                                @empty
                                                                    <option value="">sin documentos</option>
                                                                @endforelse
                                                            </select>
                                                            <span class="errors nombre_error text-danger"></span>
                                                        </div>
                                                        <div class="form-group col-sm-6 d-none"
                                                            id="group_numero_activo">
                                                            <label for="numero"><i
                                                                    class="fas fa-barcode iconos-crear"></i>ID</label>
                                                            <input
                                                                class="form-control {{ $errors->has('numero') ? 'is-invalid' : '' }}"
                                                                type="text" name="numero" id="numero"
                                                                value="{{ old('numero', '') }}" required>
                                                            <span class="errors numero_error text-danger"></span>
                                                        </div>
                                                        <style type="text/css">
                                                            #tipo_doc {
                                                                color: #fff;
                                                                padding: 5px;
                                                                border-radius: 4px;
                                                            }

                                                            #tipo_doc.opcional {
                                                                background-color: #25B82B;
                                                                text-transform: capitalize;
                                                            }

                                                            #tipo_doc.obligatorio {
                                                                background-color: #DD3939;
                                                                text-transform: capitalize;
                                                            }

                                                            #tipo_doc.aplica {
                                                                background-color: #FA8E1C;
                                                            }

                                                            #tipo_doc.aplica::before {
                                                                content: "Solo si ";
                                                            }

                                                        </style>
                                                        <div class="form-group col-12 ml-1" id="group_tipo_doc">
                                                            <strong>Tipo: </strong>
                                                            <font id="tipo_doc" class=""></font>
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



                                <div x-show="open" x-transition>
                                    @if ($isPersonal)
                                        @can('subir_documentacion_empleados')
                                            <div class="text-center">
                                                <label type="button" onclick="event.preventDefault();return false;"
                                                    data-toggle="modal" data-target="#modalDocumentos"
                                                    style="cursor: pointer;" class="text-center">
                                                    <i class="fas fa-upload text-success" style="font-size: 15px"></i>
                                                    Subir
                                                    Documento
                                                </label>
                                            </div>
                                        @endcan
                                    @endif
                                    @foreach ($empleadoModel->empleado_documentos as $documentos)
                                        @if ($documentos->archivado == false)
                                            <div class="list-group list-border-y list-group-flush">
                                                <a href="{{ $documentos->ruta_documento }}" target="_blank"
                                                    class="list-group-item list-group-item-action">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <h6 class="mb-1">{{ $documentos->nombre }}</h6>
                                                        <small>{{ $documentos->created_at->diffForHumans() }}</small>
                                                    </div>
                                                    <small class="mb-1"><strong>ID:
                                                            {{ $documentos->numero ? $documentos->numero : '' }}</strong></small>
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-sm-12 col-md-6 col-sm-6 pt-3" x-data="{ open: false }">
                        <div class="row justify-content-center">
                            <div class="col-11 shadow-sm rounded border p-4">
                                <div class="mb-3 w-100 " style="border-bottom: solid 2px #345183;">
                                    <div class="row align-items-center justify-content-center">
                                        <div class="col-10" style="white-space: nowrap;">
                                            <span style="font-size: 17px; font-weight: bold;"><i
                                                    class="fas iconos-crear"
                                                    x-bind:class="!open ? 'fa-folder' : 'fa-folder-open'"></i>Certificados
                                            </span>
                                        </div>
                                        <div class="col text-center">
                                            <i class="fas text-muted"
                                                x-bind:class="!open ? 'fa-plus-circle' : 'fa-minus-circle'"
                                                x-on:click="open = ! open"></i>
                                        </div>
                                    </div>
                                    {{-- <span style="font-size: 17px; font-weight: bold;"><i class="fas iconos-crear"
                                            x-bind:class="! open ? 'fa-folder' : 'fa-folder-open'"></i>Certificados
                                        <i class="fas text-muted"
                                            x-bind:class="! open ? 'fa-plus-circle' : 'fa-minus-circle'"
                                            x-on:click="open = ! open"></i>
                                    </span> --}}
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
                                                    method="POST" id="formCargarCertificacion"
                                                    class="form-group m-0">
                                                    <div class="row" x-data="{ open: false }">
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


                                <div x-show="open" x-transition>
                                    @if ($isPersonal)
                                        @can('subir_certificaciones_empleados')
                                            <div x-data="{ open: false }">
                                                <div class="text-center">
                                                    <label type="button" onclick="event.preventDefault();return false;"
                                                        data-toggle="modal" data-target="#modalCertificaciones"
                                                        style="cursor: pointer;" class="text-center">
                                                        <i class="fas fa-upload text-success" style="font-size: 15px"></i>
                                                        Subir
                                                        Certificación
                                                    </label>
                                                </div>
                                            </div>
                                        @endcan
                                    @endif
                                    @foreach ($empleadoModel->empleado_certificaciones as $certificaciones)
                                        <div class="list-group list-border-y list-group-flush">
                                            <a href="{{ $certificaciones->ruta_documento }}" target="_blank"
                                                class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h6 class="mb-1">{{ $certificaciones->nombre }}</h6>
                                                    <small>{{ $certificaciones->created_at->diffForHumans() }}</small>
                                                </div>
                                                <small class="mb-1"><strong style="text-transform: capitalize">
                                                        {{ $certificaciones->vigencia ? \Carbon\Carbon::parse($certificaciones->vigencia_string_formated)->format('F d, Y') : '' }}</strong></small>
                                                <p class="my-1">
                                                    @if (Str::lower($certificaciones->estatus) == 'vencida')
                                                        <strong
                                                            class="badge badge-danger">{{ $certificaciones->estatus ? $certificaciones->estatus : 'Sin vigencia' }}</strong>
                                                    @elseif (Str::lower($certificaciones->estatus) == 'vigente')
                                                        <strong
                                                            class="badge badge-success">{{ $certificaciones->estatus ? $certificaciones->estatus : 'Sin vigencia' }}</strong>
                                                    @else
                                                        <strong
                                                            class="badge badge-primary">{{ $certificaciones->estatus ? $certificaciones->estatus : 'Sin vigencia' }}</strong>
                                                    @endif
                                                </p>
                                                {{-- <small style="white-space: nowrap;">
                                                    <i class="fas fa-file mr-2"></i>
                                                    {{ $certificaciones->documento ? $certificaciones->documento : 'Sin documento' }}
                                                </small> --}}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-sm-6 pt-3" x-data="{ open: false }">
                        <div class="row justify-content-center">
                            <div class="col-11 shadow-sm rounded border p-4">
                                <div class="mb-3 w-100 " style="border-bottom: solid 2px #345183;">
                                    <div class="row align-items-center justify-content-center">
                                        <div class="col-10" style="white-space: nowrap;">
                                            <span style="font-size: 17px; font-weight: bold;"><i
                                                    class="fas iconos-crear"
                                                    x-bind:class="!open ? 'fa-folder' : 'fa-folder-open'"></i>Capacitaciones
                                            </span>
                                        </div>
                                        <div class="col text-center">
                                            <i class="fas text-muted"
                                                x-bind:class="!open ? 'fa-plus-circle' : 'fa-minus-circle'"
                                                x-on:click="open = ! open"></i>
                                        </div>
                                    </div>
                                </div>


                                <div class="modal fade" id="modalcursoIt" data-backdrop="static"
                                    data-keyboard="false" tabindex="-1" aria-labelledby="modalcursoItLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalcursoItLabel">
                                                    <i class="fas fa-award mr-2"></i> Cargar Capacitación
                                                </h5>
                                                <button x-on:click="open = false"
                                                    onclick="limpiarFormCurso();event.preventDefault()" type="button"
                                                    class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST"
                                                    action="{{ route('admin.cargarCapacitacion', $empleadoModel) }}"
                                                    id="formCargarCurso" class="form-group m-0">
                                                    <div class="row">
                                                        <input type="hidden" name="empleado_id"
                                                            value="{{ $empleadoModel->id }}"
                                                            id="empleado_id_curso" />
                                                        <div class="form-group col-sm-12">
                                                            <label for="curso_diplomado"><i
                                                                    class="fas fa-certificate iconos-crear"></i>Nombre</label>
                                                            <input
                                                                class="form-control {{ $errors->has('curso_diplomado') ? 'is-invalid' : '' }}"
                                                                type="text" name="curso_diploma"
                                                                id="curso_diplomado"
                                                                value="{{ old('curso_diplomado', '') }}">
                                                            <span
                                                                class="errors curso_diploma_error text-danger"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-6">
                                                            <label for="tipo"><i
                                                                    class="fas fa-chalkboard-teacher iconos-crear"></i>Tipo</label>
                                                            <select
                                                                class="form-control {{ $errors->has('tipo') ? 'is-invalid' : '' }}"
                                                                name="tipo" id="tipo">
                                                                <option value disabled
                                                                    {{ old('tipo', null) === null ? 'selected' : '' }}>
                                                                    Selecciona una opción</option>
                                                                @foreach (App\Models\CursosDiplomasEmpleados::TipoSelect as $key => $label)
                                                                    <option value="{{ $key }}"
                                                                        {{ old('tipo', '') === (string) $key ? 'selected' : '' }}>
                                                                        {{ $label }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <span class="errors tipo_error text-danger"></span>
                                                        </div>
                                                        <div class="form-group col-sm-3">
                                                            <label for="año"><i
                                                                    class="far fa-calendar-alt iconos-crear"></i>Inicio</label>
                                                            <input
                                                                class="form-control {{ $errors->has('año') ? 'is-invalid' : '' }}"
                                                                type="date" name="año" id="año"
                                                                value="{{ old('año', '') }}">
                                                            <span class="errors año_error text-danger"></span>
                                                        </div>
                                                        <div class="form-group col-sm-3">
                                                            <label for="fecha_fin"><i
                                                                    class="far fa-calendar-alt iconos-crear"></i>Fin</label>
                                                            <input
                                                                class="form-control {{ $errors->has('fecha_fin') ? 'is-invalid' : '' }}"
                                                                type="date" name="fecha_fin" id="fecha_fin"
                                                                value="{{ old('fecha_fin', '') }}">
                                                            <span class="errors fecha_fin_error text-danger"></span>
                                                        </div>

                                                        <div class="mt-3 col-sm-12 form-group">
                                                            <label for="file"><i
                                                                    class="fas fa-folder-open iconos-crear"></i>Adjuntar
                                                                Archivo</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="file" id="cargarCurso"
                                                                    class="d-none"
                                                                    aria-describedby="inputGroupFileAddon01">
                                                                <div class="">
                                                                    <label for="cargarCurso" style="cursor: pointer;"
                                                                        class="text-center m-0"><i
                                                                            class="fas fa-upload text-success"
                                                                            style="font-size: 15px"></i>Subir
                                                                        Certificado <small
                                                                            id="infoSelectedCurso"></small></label>
                                                                </div>
                                                                <span class="errors file_error text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                    onclick="limpiarForm();event.preventDefault()"
                                                    x-on:click="open = false">Cancelar</button>
                                                <button id="btnCargarCurso" type="button" class="btn btn-primary"><i
                                                        class="fas fa-upload mr-2"></i>Cargar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div x-show="open" x-transition>
                                    @if ($isPersonal)
                                        @can('subir_capacitaciones_empleados')
                                            <div x-data="{ open: false }">
                                                <div class="text-center">
                                                    <label type="button" onclick="event.preventDefault();return false;"
                                                        data-toggle="modal" data-target="#modalcursoIt"
                                                        style="cursor: pointer;" class="text-center">
                                                        <i class="fas fa-upload text-success" style="font-size: 15px"></i>
                                                        Subir Capacitación
                                                    </label>
                                                </div>
                                            </div>
                                        @endcan
                                    @endif
                                    @foreach ($empleadoModel->empleado_cursos as $cursoIt)
                                        <div class="list-group list-border-y list-group-flush">

                                            <a href="{{ $cursoIt->ruta_documento }}" target="_blank"
                                                class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h6 class="mb-1">{{ $cursoIt->curso_diploma }}</h6>
                                                    <small>{{ $cursoIt->created_at->diffForHumans() }}</small>
                                                </div>
                                                <small class="mb-1">
                                                    <strong>
                                                        Desde
                                                        <span
                                                            style="text-transform:capitalize">{{ \Carbon\Carbon::parse($cursoIt->fecha_inicio_spanish)->format('M d, Y') }}</span>
                                                        a
                                                        <span style="text-transform:capitalize">
                                                            {{ \Carbon\Carbon::parse($cursoIt->fecha_fin_spanish)->format('M d, Y') }}
                                                        </span>
                                                    </strong>
                                                </small>
                                                <br>
                                                <p class="my-1">
                                                    <strong class="badge badge-info">
                                                        {{ $cursoIt->tipo ? $cursoIt->tipo : 'No se ha definido el tipo' }}
                                                    </strong>
                                                </p>
                                                {{-- <br>
                                                <small>
                                                    <i class="fas fa-file mr-2"></i>
                                                    {{ $cursoIt->file ? $cursoIt->file : 'Sin documento' }}
                                                </small> --}}
                                            </a>
                                        </div>
                                        {{-- <ul>
                                            <a href="{{ asset('storage/cursos_empleados/') . '/' . $cursoIt->file }}"
                                                style="text-decoration:none" target="_blank" alt=""><span><i
                                                        class="fas fa-file iconos-crear"></i>{{ $cursoIt->file }}</span></a>
                                        </ul> --}}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        @endif
    </div>

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
        window.limpiarFormCurso = () => {
            limpiarErrores();
            document.getElementById('formCargarCurso').reset();
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

        const btnCargarCurso = document.getElementById('btnCargarCurso');
        btnCargarCurso.addEventListener('click', async (e) => {
            e.preventDefault();
            limpiarErrores();
            console.log('click');
            const formCargarCurso = document.getElementById('formCargarCurso');
            const formData = new FormData(formCargarCurso);
            const url = formCargarCurso.getAttribute('action');
            const method = formCargarCurso.getAttribute('method');
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

        const inputCargarCurso = document.getElementById('cargarCurso');
        inputCargarCurso.addEventListener('change', function(e) {
            document.getElementById('infoSelectedCurso').innerHTML = `
                ${this.files.length} documento(s) seleccionados
                <label title="Remover selección" style="cursor: pointer;color:red;">&times;</label>
                `
        });

        const infoSelectedArchivoCursoElemento = document.getElementById('infoSelectedCurso');
        infoSelectedArchivoCursoElemento.addEventListener('click', function(e) {
            e.preventDefault();
            if (e.target.tagName == 'LABEL') {
                this.innerHTML = "";
                console.log(inputcargarCurso.files);
                inputcargarCurso.value = null;
                console.log(inputcargarCurso.files);
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


@section('scripts')
    <script type="text/javascript">
        $(document).on('change', '#nombre_documento', function(event) {
            let op_select = $('#nombre_documento option:selected').attr('data-activar');
            console.log(op_select);
            if (op_select == 'si') {
                $('#group_numero_activo').addClass('d-block');
                $('#group_numero_activo').removeClass('d-none');
            }
            if (op_select == 'no') {
                $('#group_numero_activo').addClass('d-none');
                $('#group_numero_activo').removeClass('d-block');
            }

            let tipo_doc = $('#nombre_documento option:selected').attr('data-tipo');

            document.querySelector('#tipo_doc').innerHTML = tipo_doc;
            $('#tipo_doc').removeClass('opcional');
            $('#tipo_doc').removeClass('obligatorio');
            $('#tipo_doc').removeClass('aplica');
            $('#tipo_doc').addClass(tipo_doc);
        });
    </script>
@endsection
</div>
