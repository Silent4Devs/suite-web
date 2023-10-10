@extends('layouts.admin')
@section('content')


    <style type="text/css">
        .filtro_caja {
            margin-bottom: -40px;
            position: relative;
            z-index: 2;
        }

        @media(max-width:775px) {
            .filtro_caja {
                margin-bottom: 0px;
            }
        }
    </style>

    <h5 class="col-12 titulo_general_funcion">Documentos de {{ $organizacion }}</h5>
    <div class="mt-5 card p-4">

        @if (count($documentos) == 0)
            <div class="container pb-4 text-center">
                <img src="{{ asset('img/empleados_no_encontrados.svg') }}" alt="" class="img-fluid"
                    style="width:500px;">
                {{-- <h3 class="mt-4">Ningún documento se ha publicado</h3> --}}
                <h5 class="col-12 titulo_general_funcion">Ningún documento se ha publicado</h5>
            </div>
        @else
            <div class="datatable-fix">
                <div class="row justify-content-center">
                    <div class="col-md-3 filtro_caja mt-2" style="">
                        <label for=""><i class="fas fa-filter"></i> Filtrar por Tipo</label>
                        <select class="form-control {{ $errors->has('tipo') ? 'error-border' : '' }}" id="tipoSelect">
                            <option value="" disabled selected>--Seleccionar--</option>
                            <option value="">Todos</option>
                            <option value="Proceso">Proceso</option>
                            <option value="Politica">Política</option>
                            <option value="Procedimiento">Procedimiento</option>
                            <option value="Manual">Manual</option>
                            <option value="Plan">Plan</option>
                            <option value="Instructivo">Instructivo</option>
                            <option value="Reglamento">Reglamento</option>
                            <option value="Externo">Documento Externo</option>
                            <option value="Formato">Formato</option>
                        </select>
                    </div>
                    <div class="col-md-3 filtro_caja mt-2" style="">
                        <label for=""><i class="fas fa-filter"></i> Filtrar por Vínculo</label>
                        <select class="form-control {{ $errors->has('tipo') ? 'error-border' : '' }}" id="vinculadoSelect">
                            <option value="" disabled selected>--Seleccionar--</option>
                            <option value="">Todos</option>
                            @foreach ($macroprocesosAndProcesos as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <table id="tblDocumentos" class="table table-bordered w-100 datatable-ControlDocumento">
                    <thead class="thead-dark">
                        <tr>
                            <th style="vertical-align: top">
                                Código&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </th>
                            <th style="vertical-align: top">
                                Nombre
                            </th>
                            <th style="vertical-align: top">
                                Tipo
                            </th>

                            <th style="vertical-align: top">
                                Vinculado&nbsp;a
                            </th>
                            <th style="vertical-align: top">
                                Estatus
                            </th>
                            <th style="vertical-align: top">
                                Versión
                            </th>
                            <th style="vertical-align: top">
                                Fecha&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </th>
                            <th style="vertical-align: top">
                                Elaboró
                            </th>
                            <th style="vertical-align: top">
                                Revisó
                            </th>
                            <th style="vertical-align: top">
                                Aprobó
                            </th>
                            <th style="vertical-align: top">
                                Responsable
                            </th>
                            {{-- @can('documentos_show') --}}
                            <th style="vertical-align: top">
                                Visualizar
                            </th>
                            {{-- @endcan --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documentos as $documento)
                            <tr>
                                <td>
                                    {{ $documento->codigo ?? '' }}
                                </td>
                                <td>
                                    {{ $documento->nombre ?? '' }}
                                </td>
                                <td style="text-transform: capitalize">
                                    {{ $documento->tipo ?? '' }}
                                </td>
                                @if ($documento->proceso_id == null)
                                    <th style="vertical-align: top">
                                        {{ $documento->macroproceso ? $documento->macroproceso->nombre : 'Sin vincular' }}
                                    </th>
                                @else
                                    <th style="vertical-align: top">
                                        {{ $documento->proceso ? $documento->proceso->nombre : 'Sin vincular' }}
                                    </th>
                                @endif
                                <td>
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
                                <td>
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
                                {{-- @can('documentos_show') --}}
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">

                                        <a class="btn btn-sm" title="Visualizar Documento"
                                            href="{{ route('admin.documentos.renderViewDocument', $documento) }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                                {{-- @endcan --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {

            let tblDocumentos = $("#tblDocumentos").DataTable({
                buttons: [],
            });

            $('#tipoSelect').on('change', function() {
                if (this.value != null && this.value != "") {
                    this.style.border = "2px solid #20a4a1";
                    tblDocumentos.columns(2).search(this.value, true, false).draw();
                } else {
                    this.style.border = "1px solid rgb(206 212 218)";
                    tblDocumentos.columns(2).search(this.value).draw();
                }
            });
            $('#estatusSelect').on('change', function() {
                if (this.value != null && this.value != "") {
                    this.style.border = "2px solid #20a4a1";
                    tblDocumentos.search(this.value.toUpperCase(), true, false)
                        .draw();
                } else {
                    this.style.border = "1px solid rgb(206 212 218)";
                    tblDocumentos.search(this.value)
                        .draw();
                }
            });
            $('#vinculadoSelect').on('change', function() {
                if (this.value != null && this.value != "") {
                    this.style.border = "2px solid #20a4a1";
                    tblDocumentos.search(this.value, true, false)
                        .draw();
                } else {
                    this.style.border = "1px solid rgb(206 212 218)";
                    tblDocumentos.search(this.value)
                        .draw();
                }
            });
        });
    </script>
@endsection
