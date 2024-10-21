<div>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/global/foda/print.css') }}{{ config('app.cssVersion') }}">

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
            background: var(--color-tbj);
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

    @if ($isPersonal)
        <div class="d-flex justify-content-end">
            <button onclick="$('#modalCertificaciones').modal('show');" class="btn btn-primary btn-md"><i
                    class="fas fa-plus mr-1"></i>Certificación</button>
            <button onclick="event.preventDefault();return false;" data-toggle="modal" data-target="#modalcursoIt"
                class="btn btn-primary btn-md"><i class="fas fa-plus mr-1"></i>Capacitación</button>
            <a class="btn btn-primary btn-md " href="{{ route('admin.editarCompetencias', $empleadoModel) }}">Editar</a>
        </div>
    @endif

    <div class="row">
        @if (!$isPersonal)
            {{-- Filtros para perfiles profesionales --}}
            <div class="col-sm-3 col-3 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h4 style="color: var(--color-tbj);">Filtros</h4>
                        <hr>
                        <div class="">
                            <div class="px-3">
                                <button wire:click="resetFilter" type="button"
                                    class="btn btn-outline-secondary w-100">Limpiar
                                    Filtros</button>
                            </div>
                            <div class="form-group px-3 anima-focus mt-4">
                                <select id="type" style="max-width:614px; width:100%;" class="form-control"
                                    name="type" wire:model.live="type_id" wire:change="getCatalogueName"
                                    @if ($enableField) disabled @endif>
                                    <option value="" selected>
                                        -- Selecciona una opción --
                                    </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="type">Tipo de capacitación</label>
                            </div>
                            <div class="form-group  px-3 anima-focus">
                                <select id="name" style="max-width:614px; width:100%;" class="form-control"
                                    name="name" wire:model.live="name_id" wire:change="filterName"
                                    @if ($enableField) disabled @endif>
                                    <option value="" selected>
                                        -- Selecciona una opción --
                                    </option>
                                    @if (!is_null($names))
                                        @foreach ($names as $name)
                                            <option value="{{ $name->id }}">
                                                {{ $name->name }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="" disabled>
                                            -- Sin opciones --
                                        </option>
                                    @endif
                                </select>
                                <label for="name">Nombre de la capacitación</label>
                            </div>
                            <div class="form-group  px-3 anima-focus">
                                <select id="area" style="max-width:614px; width:100%;" class="form-control"
                                    name="area" wire:model.live="area_id" wire:change="filterArea"
                                    @if ($enableField) disabled @endif>
                                    <option value="" selected>
                                        -- Selecciona una opción --
                                    </option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}">
                                            {{ $area->area }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="area">Área</label>
                            </div>
                            <div class="form-group  px-3 mb-0 anima-focus">
                                <select id="employees" style="max-width:614px; width:100%;" class="form-control"
                                    name="employees" wire:model.live="employ_id" wire:change="filterEmploy"
                                    @if ($enableField) disabled @endif>
                                    <option value="" selected>
                                        -- Selecciona una opción --
                                    </option>
                                    @foreach ($employess as $employ)
                                        <option value="{{ $employ->id }}">
                                            {{ $employ->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="employees">Empleado</label>
                            </div>
                            <div class="col-12 px-3">
                                <hr style="border: none; border-top: 1px dashed #8F8F8F;">
                            </div>
                            <div class="form-group  px-3 mb-0 anima-focus">
                                <select id="issuing_company" style="max-width:614px; width:100%;" class="form-control"
                                    name="issuing_company" wire:model.live="issuingCompanyId"
                                    wire:change="filterIssuingCompany"
                                    @if ($enableField) disabled @endif>
                                    <option value="" selected>
                                        -- Selecciona una opción --
                                    </option>
                                    @foreach ($issuingCompanies as $issuingCompany)
                                        <option value="{{ $issuingCompany }}">
                                            {{ $issuingCompany }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="issuing_company">Empresa emisora</label>
                            </div>
                            <div class="col-12 px-3">
                                <hr style="border: none; border-top: 1px dashed #8F8F8F;">
                            </div>
                            <div class="form-group  px-3 anima-focus">
                                <select id="norma" style="max-width:614px; width:100%;" class="form-control"
                                    name="type" wire:model.live="normaId" wire:change="filterNorma"
                                    @if ($enableField) disabled @endif>
                                    <option value="" selected>
                                        -- Selecciona una opción --
                                    </option>
                                    @foreach ($normas as $norma)
                                        <option value="{{ $norma }}">
                                            {{ $norma }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="type">Norma</label>
                            </div>
                            <div class="col-12 col-sm-12">
                                {{-- <button wire:click="resetFilter" class="btn btn-sm btn-success">
                                    Limpiar filtros
                                </button> --}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endif
        <div class="{{ $isPersonal ? 'col-sm-12 col-md-12 col-12' : 'col-sm-9 col-md-9 col-9' }}"
            x-data="{ open: true }">
            <div class="card" style="{{ $isPersonal ? 'border:none;' : null }}">
                <div class="card-body {{ $isPersonal ? 'p-0 m-0' : null }}"
                    style="{{ $isPersonal ? 'border:none;' : null }}">
                    @if (!$isPersonal)
                        <h4 style="color: var(--color-tbj);">Curriculum Vitae</h4>
                        <hr>
                        <div class="text-center" wire:loading>
                            <i class="fas fa-circle-notch fa-spin mr-2"></i> Buscando Coincidencias
                        </div>
                        <div class="row col-12 align-items-center mx-md-m5" x-show="open">
                            @forelse ($employedCv as $item)
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
                            @empty
                                <div class="col-12 px-1 py-2 mx-3 rounded shadow"
                                    style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                                    <div class="row w-100">
                                        <div
                                            class="text-center col-1 align-items-center d-flex justify-content-center">
                                            <div class="w-100">
                                                <i class="bi bi-info mr-3"
                                                    style="color: #3B82F6; font-size: 30px"></i>
                                            </div>
                                        </div>
                                        <div class="col-11">
                                            <p class="m-0"
                                                style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                                                Atención</p>
                                            <p class="m-0" style="font-size: 14px; color:#1E3A8A ">No se
                                                encontraron
                                                coincidencias.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-center">
                                    <img src="{{ asset('img/cv.png') }}" class="mt-3" style="height: 400px;">
                                </div>
                            @endforelse

                            {{-- <div class=" col-12 d-flex justify-content-end">
                                    {{ $employedCv->links() }}
                                </div> --}}
                        </div>
                    @endif
                    @if ($empleadoModel)
                        @if (!$isPersonal)
                            <div x-show="!open">
                                <div class="row justify-content-center">
                                    <div class="col-10">
                                        <button class="btn btn-sm btn_cancelar" x-on:click="open = true"
                                            wire:click="enableFields"><i class="fas fa-arrow-left"></i>
                                            Regresar</button>

                                        <button onclick="imprimirElemento('imp1');" class="btn btn-sm btn-success">
                                            <i class="mr-2 fas fa-print"></i>
                                            Imprimir
                                        </button>
                                    </div>
                                    @can('profile_professional_edit')
                                        <div class="col-2 justify-content-end">
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('admin.editarCompetencias', $empleadoModel) }}"
                                                role="button">Editar</a>
                                        </div>
                                    @endcan
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
                                                <img src="{{ asset($logotipo) }}" class="mt-2 ml-4"
                                                    style="width: 100px;">
                                            </div>
                                            <div class="row medidas">
                                                <div class="mt-4 mb-3  ml-4 col-md-7 datos_iz_cv">
                                                    <h5 class="py-2 pl-2"
                                                        style="color:#fff; font-weight:bold; background-color:#7F7F7F; width:100%">
                                                        {{ $empleadoModel->name }}</h5>
                                                    <div class="mt-4 mb-3 w-100 dato_mairg"
                                                        style="border-bottom: solid 2px var(--color-tbj)">
                                                        <span style="font-size: 17px; font-weight: bold;">
                                                            Resumen</span>
                                                    </div>
                                                    <p style="text-align:justify">
                                                        {{ $empleadoModel->resumen ? $empleadoModel->resumen : 'No hay resumen' }}
                                                    </p>
                                                    <div class="mt-4 mb-3 w-100 dato_mairg"
                                                        style="border-bottom: solid 2px var(--color-tbj)">
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
                                                            <span
                                                                style="text-transform:capitalize; text-align:justify">
                                                                <br>
                                                                <p style="text-align:justify">
                                                                    {{ $experiencia->descripcion }}
                                                                </p>
                                                        </div>
                                                    @empty
                                                        <p><i class="fas fa-info-circle text-primary mr-2"></i>No hay
                                                            información
                                                            registrada
                                                        </p>
                                                    @endforelse

                                                    <div class="mt-4 mb-3 w-100 dato_mairg "
                                                        style="border-bottom: solid 2px var(--color-tbj)">
                                                        <span style="font-size: 17px; font-weight: bold;">
                                                            Certificaciones</span>
                                                    </div>
                                                    <ul>
                                                        @forelse ($documents as $document)
                                                            <li>
                                                                <div class="d-flex">
                                                                    <h6> <strong>{{ $document->category->name }}</strong>
                                                                        con
                                                                        nombre
                                                                        <strong>{{ $document->getName->name }}</strong>
                                                                        de la empresa
                                                                        <strong>{{ $document->getName->issuing_company }}</strong>
                                                                    </h6>

                                                                </div>
                                                            </li>
                                                        @empty
                                                            <p><i class="fas fa-info-circle text-primary mr-2"></i>No
                                                                hay
                                                                información
                                                                registrada
                                                            </p>
                                                        @endforelse
                                                    </ul>

                                                    <div class="mt-4 mb-3 w-100 dato_mairg "
                                                        style="border-bottom: solid 2px var(--color-tbj)">
                                                        <span style="font-size: 17px; font-weight: bold;">
                                                            Educación Académica</span>
                                                    </div>
                                                    @forelse ($empleadoModel->empleado_educacion as $educacion)
                                                        <div>
                                                            <strong class="font-weight-bold"
                                                                style="color:#00A57E;text-transform: uppercase">
                                                                {{ $educacion->institucion }}</strong>
                                                            <br>
                                                            <span
                                                                style="text-transform:capitalize">{{ $educacion->nivel }}</span>
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
                                                        <p><i class="fas fa-info-circle text-primary mr-2"></i>No hay
                                                            información
                                                            registrada
                                                        </p>
                                                    @endforelse
                                                    <div class="mt-4 mb-3 w-100 dato_mairg "
                                                        style="border-bottom: solid 2px var(--color-tbj)">
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
                                                                <strong>Porcentaje:</strong> {{ $idioma->porcentaje }}
                                                                %
                                                            </span>
                                                        </div>
                                                    @empty
                                                        <p><i class="fas fa-info-circle text-primary mr-2"></i>No hay
                                                            información
                                                            registrada
                                                        </p>
                                                    @endforelse
                                                </div>
                                                <div class="mt-4 col-md-4 datos_der_cv">
                                                    <div
                                                        style="background: linear-gradient(0deg, rgba(69,125,182,1) 0%, rgba(8,170,157,1) 60%); height:100%; padding:10px;">
                                                        <div class="text-center w-100"><img class="mt-3"
                                                                style="height: 100px; clip-path: circle(50px at 50% 50%); margin:auto"
                                                                src="{{ asset('storage/empleados/imagenes/') . '/' . $empleadoModel->Avatar }}"
                                                                alt=""></div>
                                                        <div class="mt-3 mb-4 w-100"
                                                            style="border-bottom: solid 2px #fff;">
                                                            <span class="text-white "
                                                                style="font-size: 14px; font-weight: bold;">
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
                                                                class="ml-2 mr-2 text-white fas fa-phone-alt"></i>Número
                                                            de
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
                                    <div class="col-12 mt-3 row">
                                        <div class="col-sm-12 col-md-6 col-sm-6 pt-3 pl-0" x-data="{ open: false }">
                                            <div class="row justify-content-center">
                                                <div class="col-11 shadow-sm rounded border p-4">
                                                    <div class="mb-3 w-100 "
                                                        style="border-bottom: solid 2px var(--color-tbj)">
                                                        <div class="row align-items-center justify-content-center">
                                                            <div class="col-10" style="white-space: nowrap;">
                                                                <span style="font-size: 17px; font-weight: bold;"><i
                                                                        class="fas iconos-crear"
                                                                        x-bind:class="!open ? 'fa-folder' : 'fa-folder-open'"></i>Certificaciones
                                                                </span>
                                                            </div>
                                                            <div class="col text-center">
                                                                <i class="fas text-muted"
                                                                    x-bind:class="!open ? 'fa-plus-circle' : 'fa-minus-circle'"
                                                                    x-on:click="open = ! open"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div x-show="open">
                                                        @foreach ($documents as $document)
                                                            @if (!is_null($document->evidence_id))
                                                                <div class="d-flex align-items-center">
                                                                    <h6 class="p-0 m-0">
                                                                        {{ $document->category->name }} con nombre
                                                                        {{ $document->getName->name }} </h6>
                                                                    <i class="material-symbols-outlined ml-3"
                                                                        wire:click='downloadEvidencie({{ $document->evidence_id }})'>
                                                                        download
                                                                    </i>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            {{-- curriculumn personal --}}
                            <div class="row justify-content-center">
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
                                            <img src="{{ asset($logotipo) }}" class="mt-2 ml-4"
                                                style="width: 100px;">
                                        </div>
                                        <div class="row medidas">
                                            <div class="mt-4 mb-3  ml-4 col-md-7 datos_iz_cv">
                                                <h5 class="py-2 pl-2"
                                                    style="color:#fff; font-weight:bold; background-color:#7F7F7F; width:100%">
                                                    {{ $empleadoModel->name }}</h5>
                                                <div class="mt-4 mb-3 w-100 dato_mairg"
                                                    style="border-bottom: solid 2px var(--color-tbj)">
                                                    <span style="font-size: 17px; font-weight: bold;">
                                                        Resumen</span>
                                                </div>
                                                <p style="text-align:justify">
                                                    {{ $empleadoModel->resumen ? $empleadoModel->resumen : 'No hay resumen' }}
                                                </p>
                                                <div class="mt-4 mb-3 w-100 dato_mairg"
                                                    style="border-bottom: solid 2px var(--color-tbj)">
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
                                                            <p style="text-align:justify">
                                                                {{ $experiencia->descripcion }}
                                                            </p>
                                                    </div>
                                                @empty
                                                    <p><i class="fas fa-info-circle text-primary mr-2"></i>No hay
                                                        información
                                                        registrada
                                                    </p>
                                                @endforelse

                                                <div class="mt-4 mb-3 w-100 dato_mairg "
                                                    style="border-bottom: solid 2px var(--color-tbj)">
                                                    <span style="font-size: 17px; font-weight: bold;">
                                                        Certificaciones</span>
                                                </div>
                                                <ul>
                                                    @forelse ($documents as $document)
                                                        <li>
                                                            <div class="d-flex">
                                                                <h6> <strong>{{ $document->category->name }}</strong>
                                                                    con
                                                                    nombre
                                                                    <strong>{{ $document->getName->name }}</strong>
                                                                    de la empresa
                                                                    <strong>{{ $document->getName->issuing_company }}</strong>
                                                                </h6>

                                                            </div>
                                                        </li>
                                                    @empty
                                                        <p><i class="fas fa-info-circle text-primary mr-2"></i>No hay
                                                            información
                                                            registrada
                                                        </p>
                                                    @endforelse
                                                </ul>

                                                <div class="mt-4 mb-3 w-100 dato_mairg "
                                                    style="border-bottom: solid 2px var(--color-tbj)">
                                                    <span style="font-size: 17px; font-weight: bold;">
                                                        Educación Académica</span>
                                                </div>
                                                @forelse ($empleadoModel->empleado_educacion as $educacion)
                                                    <div>
                                                        <strong class="font-weight-bold"
                                                            style="color:#00A57E;text-transform: uppercase">
                                                            {{ $educacion->institucion }}</strong>
                                                        <br>
                                                        <span
                                                            style="text-transform:capitalize">{{ $educacion->nivel }}</span>
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
                                                    <p><i class="fas fa-info-circle text-primary mr-2"></i>No hay
                                                        información
                                                        registrada
                                                    </p>
                                                @endforelse
                                                <div class="mt-4 mb-3 w-100 dato_mairg "
                                                    style="border-bottom: solid 2px var(--color-tbj)">
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
                                                    <p><i class="fas fa-info-circle text-primary mr-2"></i>No hay
                                                        información
                                                        registrada
                                                    </p>
                                                @endforelse
                                            </div>
                                            <div class="mt-4 col-md-4 datos_der_cv">
                                                <div
                                                    style="background: linear-gradient(0deg, rgba(69,125,182,1) 0%, rgba(8,170,157,1) 60%); height:100%; padding:10px;">
                                                    <div class="text-center w-100"><img class="mt-3"
                                                            style="height: 100px; clip-path: circle(50px at 50% 50%); margin:auto"
                                                            src="{{ asset('storage/empleados/imagenes/') . '/' . $empleadoModel->Avatar }}"
                                                            alt=""></div>
                                                    <div class="mt-3 mb-4 w-100"
                                                        style="border-bottom: solid 2px #fff;">
                                                        <span class="text-white "
                                                            style="font-size: 14px; font-weight: bold;">
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
                                <div class="col-12 mt-3 row">
                                    <div class="col-sm-12 col-md-6 col-sm-6 pt-3 pl-0" x-data="{ open: false }">
                                        <div class="row justify-content-center">
                                            <div class="col-11 shadow-sm rounded border p-4">
                                                <div class="mb-3 w-100 "
                                                    style="border-bottom: solid 2px var(--color-tbj)">
                                                    <div class="row align-items-center justify-content-center">
                                                        <div class="col-10" style="white-space: nowrap;">
                                                            <span style="font-size: 17px; font-weight: bold;"><i
                                                                    class="fas iconos-crear"
                                                                    x-bind:class="!open ? 'fa-folder' : 'fa-folder-open'"></i>Certificaciones
                                                            </span>
                                                        </div>
                                                        <div class="col text-center">
                                                            <i class="fas text-muted"
                                                                x-bind:class="!open ? 'fa-plus-circle' : 'fa-minus-circle'"
                                                                x-on:click="open = ! open"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div x-show="open">
                                                    @foreach ($documents as $document)
                                                        @if (!is_null($document->evidence_id))
                                                            <div class="d-flex align-items-center">
                                                                <h6 class="p-0 m-0">{{ $document->category->name }}
                                                                    con nombre
                                                                    {{ $document->getName->name }} </h6>
                                                                <i class="material-symbols-outlined ml-3"
                                                                    wire:click='downloadEvidencie({{ $document->evidence_id }})'>
                                                                    download
                                                                </i>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>
