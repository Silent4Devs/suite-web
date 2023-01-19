<div class="w-100" id="contendor-principal-me-deben-aprobar" x-data="{show:false}">
    <div class="row mb-4 align-items-center">
        <div class="col-12 pr-2" x-bind:class="show?'col-12':'col-12'" style="text-align:right;">
            <span class="mr-2" x-bind:class="!show?'menu-active':''" title="Visualizar Tarjetas"
                style="font-size: 1.1rem;cursor: pointer;" x-on:click="show=false"><i class="fas fa-th"></i></span>
            <span class="mr-2" style="font-size: 1.1rem;cursor: pointer;" x-bind:class="show?'menu-active':''"
                x-on:click="show=true" title="Visualizar Tabla"><i class="fas fa-th-list"></i></span>
        </div>
    </div>
    <div class="row mb-4" x-show="!show" x-transition:enter.duration.500ms x-transition:leave.duration.400ms>
        <div class="col-12">
            <div class="cards-me-deben-aprobar row" id="cards-me-deben-aprobar"></div>
            <div class="row">
                <div class="col-12" id="contenedor-info-card-me-deben-aprobar"></div>
            </div>
        </div>
    </div>
    <div x-show="show" x-transition:enter.duration.500ms x-transition:leave.duration.400ms>
        <table id="tblMisDocumentos" class="table">
            <thead>
                <tr>
                    <th style=" min-width:100px; text-align: center !important;">
                        Código&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </th>
                    <th style=" min-width:200px; text-align: center !important;">
                        Nombre
                    </th>
                    <th style="vertical-align: top; min-width:90px; text-align: center !important;">
                        Tipo
                    </th>
                    <th style="vertical-align: top; text-align: center !important; min-width:150px;">
                        Vinculado&nbsp;a
                    </th>
                    <th style="vertical-align: top  min-width:150px; text-align: center !important;">
                        Estatus
                    </th>
                    <th style="vertical-align: top; text-align: center !important; min-width:80px;">
                        Versión
                    </th>
                    <th style="vertical-align: top; text-align: center !important; min-width:90px;">
                        Fecha&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </th>
                    <th style="vertical-align: top min-width:50px;">
                        Elaboró
                    </th>
                    <th style="vertical-align: top  min-width:50px;">
                        Revisor
                    </th>
                    <th style="vertical-align: top  min-width:50px;">
                        Aprobador
                    </th>
                    <th style="vertical-align: top  min-width:50px;">
                        Responsable
                    </th>
                    <th style="vertical-align: top  min-width:80px;">
                        Visualizar
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mis_documentos as $documento)
                    <tr>
                        <td style=" text-align: center !important;">
                            {{ $documento->codigo ?? '' }}
                        </td>
                        <td>
                            {{ $documento->nombre ?? '' }}
                        </td>
                        <td style="text-transform: capitalize; text-align: center !important;">
                            {{ $documento->tipo ?? '' }}
                        </td>
                        @if ($documento->proceso_id == null)
                            <td style="text-align: center !important; font-weight: normal;">
                                {{ $documento->macroproceso ? $documento->macroproceso->nombre : 'Sin vincular' }}
                            </td>
                        @else
                            <td style="text-align: center !important; font-weight: normal;">
                                {{ $documento->proceso ? $documento->proceso->nombre : 'Sin vincular' }}
                            </td>
                        @endif
                        <td style="text-align: center !important;">
                            @if ($documento->estatus)
                                @switch($documento->estatus)
                                    @case(1)
                                        <span class="badge badge-info">EN ELABORACIÓN</span>
                                    @break
                                    @case(2)
                                        <span class="badge badge-primary">EN REVISIÓN</span>
                                    @break
                                    @case(3)
                                        <span class="badge badge-success">PUBLICADO</span>
                                    @break
                                    @case(4)
                                        <span class="badge badge-danger">RECHAZADO</span>
                                    @break
                                    @default
                                        <span class="badge badge-info">EN ELABORACIÓN</span>
                                @endswitch
                            @endif
                        </td>
                        <td style="text-align: center !important;">
                            {{ $documento->version == 0 ? 'Sin versión actualmente' : $documento->version }}
                        </td>
                        <td>
                            {{ $documento->fecha_dmy ?? '' }}
                        </td>
                        <td>
                            @if ($documento->elaborador)
                                <img src="{{ asset('storage/empleados/imagenes/') . '/' . $documento->elaborador->avatar }}"
                                    class="rounded-circle" alt="{{ $documento->elaborador->name }}"
                                    title="{{ $documento->elaborador->name }}" width="40">
                            @else
                                <span class="badge badge-info">Sin Asignar</span>
                            @endif
                        </td>
                        <td>
                            @if ($documento->revisor)
                                <img src="{{ asset('storage/empleados/imagenes/') . '/' . $documento->revisor->avatar }}"
                                    class="rounded-circle" alt="{{ $documento->revisor->name }}"
                                    title="{{ $documento->revisor->name }}" width="40">
                            @else
                                <span class="badge badge-info">Sin Asignar</span>
                            @endif
                        </td>
                        <td>
                            @if ($documento->aprobador)
                                <img src="{{ asset('storage/empleados/imagenes/') . '/' . $documento->aprobador->avatar }}"
                                    class="rounded-circle" alt="{{ $documento->aprobador->name }}"
                                    title="{{ $documento->aprobador->name }}" width="40">
                            @else
                                <span class="badge badge-info">Sin Asignar</span>
                            @endif
                        </td>
                        <td>
                            @if ($documento->responsable)
                                <img src="{{ asset('storage/empleados/imagenes/') . '/' . $documento->responsable->avatar }}"
                                    class="rounded-circle" alt="{{ $documento->responsable->name }}"
                                    title="{{ $documento->responsable->name }}" width="40">
                            @else
                                <span class="badge badge-info">Sin Asignar</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a class="btn btn-sm " title="Visualizar revisiones" style="border:none;"
                                    href="{{ route('admin.documentos.renderHistoryReview', $documento->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                        class="bi bi-clock-history" viewBox="0 0 16 16">
                                        <path
                                            d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
                                        <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
                                        <path
                                            d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                                    </svg>
                                </a>

                                {{-- @if ($documento->estatus == 3 or $documento->estatus == 4)
                                    <button class="btn_archivar" title="Archivar" data-toggle="modal"
                                        data-target="#alert_aprob_arch{{ $documento->id }}">
                                        <i class="fas fa-archive"></i>
                                    </button>
                                @endif --}}
                            </div>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>
