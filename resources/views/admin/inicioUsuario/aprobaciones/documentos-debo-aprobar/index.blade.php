<div class="w-100" id="contendor-principal-debo-aprobar" x-data="{ show: false }">
    <div class="row mb-4 align-items-center">
        <div class="col-12 pr-2" x-bind:class="show ? 'col-12' : 'col-12'" style="text-align:right;">
            <span class="mr-2" x-bind:class="!show ? 'menu-active' : ''" title="Visualizar Tarjetas"
                style="font-size: 1.1rem;cursor: pointer;" x-on:click="show=false"><i class="fas fa-th"></i></span>
            <span class="mr-2" style="font-size: 1.1rem;cursor: pointer;"
                x-bind:class="show ? 'menu-active' : ''" x-on:click="show=true" title="Visualizar Tabla"><i
                    class="fas fa-th-list"></i></span>
            <span x-show="!show" x-data="{ archivado: false }">
                <span id="btnArchivoDeboAprobar"
                    data-url="{{ route('admin.revisiones.obtenerDocumentosDeboAprobarArchivo') }}"
                    class="mr-2" style="font-size: 1.1rem;cursor: pointer;" title="Archivo" x-show="!archivado"
                    x-on:click="archivado=true" x-transition><i class="fas fa-archive"></i></span>
                <span id="btnPrincipalesDeboAprobar"
                    data-url="{{ route('admin.revisiones.obtenerDocumentosDeboAprobar') }}" class="mr-2"
                    style="font-size: 1.1rem;cursor: pointer;" title="Principales" x-show="archivado"
                    x-on:click="archivado=false" x-transition><i class="fas fa-chalkboard-teacher"></i></span>
            </span>
        </div>
        {{-- <div class="pl-0" x-bind:class="!show?'col-2':''">
            <select class="form-control" id="selectTipoDeboAprobar" x-show="!show">
                <option value="todo" selected>Todas</option>
                <option value="aceptadas">Aceptadas</option>
                <option value="rechazadas">Rechazadas</option>
                <option value="sin_respuesta">Sin Respuesta</option>
            </select>
        </div> --}}
    </div>
    <div class="row mb-4" x-show="!show" x-transition:enter.duration.500ms x-transition:leave.duration.400ms>
        <div class="col-12">
            <div class="cards-debo-aprobar row" id="cards-debo-aprobar" style="height: 100%;"></div>
            <div class="row">
                <div class="col-12" id="contenedor-info-card-debo-aprobar"></div>
            </div>
        </div>
    </div>
    <div x-show="show" x-transition:enter.duration.500ms x-transition:leave.duration.400ms>
        <table id="tabla_usuario_aprobaciones" class="table">
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
                    <th style="vertical-align: top; text-align: center !important; min-width:150px;">
                        Estatus
                    </th>
                    <th style="vertical-align: top; text-align: center !important; min-width:80px;">
                        Versión
                    </th>
                    <th style="vertical-align: top; text-align: center !important; min-width:90px;">
                        Fecha&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </th>
                    <th style="vertical-align: top  min-width:50px;">
                        Solicitante
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
                @foreach ($revisiones as $revision)
                    @if ($revision->before_level_all_answered)
                        @if ($revision->estatus != $Documento::RECHAZADO_EN_CONSECUENCIA_POR_NIVEL_ANTERIOR)
                            <tr>
                                <td style="text-align: center !important;">
                                    {{ Str::limit($revision->documento ? $revision->documento->codigo : 'Sin Código Asignado', 40, '...') }}
                                </td>
                                <td>
                                    @if ($revision->documento)
                                        <a href="{{ route('admin.documentos.renderViewDocument', $revision->documento->id) }}"
                                            class="text-dark">
                                            {{ Str::limit($revision->documento ? $revision->documento->nombre : 'Sin Documento Asignado', 40, '...') }}
                                        </a>
                                    @else
                                        Sin revisión
                                    @endif
                                </td>
                                <td style="text-transform: capitalize;">
                                    {{ $revision->documento ? $revision->documento->tipo : 'El tipo no ha sido asignado' }}
                                </td>
                                @if ($revision->documento)
                                    @if ($revision->documento->proceso_id == null)
                                        <td style="text-align: center !important; font-weight: normal;">
                                            {{ $revision->documento->macroproceso ? $revision->documento->macroproceso->nombre : 'Sin vincular' }}
                                        </td>
                                    @else
                                        <td style="text-align: center !important; font-weight: normal;">
                                            {{ $revision->documento->proceso ? $revision->documento->proceso->nombre : 'Sin vincular' }}
                                        </td>
                                    @endif
                                @else
                                    <td style="text-align: center !important; font-weight: normal;">
                                        Sin documento asignado
                                    </td>
                                @endif

                                <td style="text-align: center !important;">
                                    <span class="badge badge-info"
                                        style="background-color:{{ $revision->color_revisiones_estatus }}">{{ mb_strtoupper($revision->estatus_revisiones_formateado) }}</span>
                                </td>
                                <td style="text-align: center !important;">
                                    {{ $revision->documento ? $revision->documento->version : 'Sin Versión' }}
                                </td>
                                <td class="justify-content:center">{{ $revision->fecha_solicitud }}</td>
                                <td style="text-align: center !important;">
                                    @if ($revision->documento)
                                        @if ($revision->documento->elaborador)
                                            <img class="rounded-circle" style="clip-path: circle(40%);height: 35px"
                                                src="{{ Storage::url('empleados/imagenes/' . $revision->documento->elaborador->avatar) }}"
                                                alt="{{ $revision->documento->elaborador->name }}"
                                                title="{{ $revision->documento->elaborador->name }}" />
                                        @endif
                                    @else
                                        Sin Asignar
                                    @endif
                                </td>
                                <td style="text-align: center !important;">
                                    @if ($revision->documento)
                                        @if ($revision->documento->revisor)
                                            <img src="{{ asset('storage/empleados/imagenes/') . '/' . $revision->documento->revisor->avatar }}"
                                                class="rounded-circle"
                                                alt="{{ $revision->documento->revisor->name }}"
                                                title="{{ $revision->documento->revisor->name }}" width="40">
                                        @endif
                                    @else
                                        <span class="badge badge-info">Sin Asignar</span>
                                    @endif
                                </td>
                                <td style="text-align: center !important;">
                                    @if ($revision->documento)
                                        @if ($revision->documento->aprobador)
                                            <img src="{{ asset('storage/empleados/imagenes/') . '/' . $revision->documento->aprobador->avatar }}"
                                                class="rounded-circle"
                                                alt="{{ $revision->documento->aprobador->name }}"
                                                title="{{ $revision->documento->aprobador->name }}" width="40">
                                        @endif
                                    @else
                                        <span class="badge badge-info">Sin Asignar</span>
                                    @endif
                                </td>
                                <td style="text-align: center !important;">
                                    @if ($revision->documento)
                                        @if ($revision->documento->responsable)
                                            <img src="{{ asset('storage/empleados/imagenes/') . '/' . $revision->documento->responsable->avatar }}"
                                                class="rounded-circle"
                                                alt="{{ $revision->documento->responsable->name }}"
                                                title="{{ $revision->documento->responsable->name }}" width="40">
                                        @endif
                                    @else
                                        <span class="badge badge-info">Sin Asignar</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($revision->documento)
                                        <a href="{{ route('admin.documentos.renderViewDocument', $revision->documento) }}"
                                            class="btn btn-sm" style="border:none;" title="Visualizar Documento">
                                            <i class="fas fa-eye text-dark" style="font-size: 15px;"></i>
                                        </a>
                                    @endif
                                    @if ($revision->before_level_all_answered)
                                        @if ($revision->estatus == $Documento::SOLICITUD_REVISION)
                                            <a href="{{ route('revisiones.revisar', $revision) }}"
                                                class="btn btn-sm" style="border:none;" title="Revisar">
                                                <i class="fas fa-file-signature text-dark" style="font-size: 15px;"></i>
                                            </a>
                                        @endif
                                        @if ($revision->estatus != $Documento::SOLICITUD_REVISION)
                                            <a class="btn btn-sm" style="border:none;" title="Archivar"
                                                onClick="Archivar('{{ route('admin.revisiones.archivar') }}','{{ $revision->id }}')">
                                                <i class=" fas fa-archive text-success" style="font-size: 15px;"></i>
                                            </a>
                                        @endif
                                    @else
                                        <span class="badge badge-info">El nivel anterior de revisores aún no termina
                                            de
                                            revisar</span>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="archivoDocumentoModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="archivoDocumentoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="archivoDocumentoModalLabel">Aprobación para el documento: <span
                            id="nombreDocumento"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="bodyModalDocumento">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
