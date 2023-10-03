<div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
    <div class="row w-100">
        <div class="text-center col-1 align-items-center d-flex justify-content-center">
            <div class="w-100">
                <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
            </div>
        </div>
        <div class="col-11">
            <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Intrucciones</p>
            <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Por favor seleccione de los siguientes
                controles
                cuales serán aplicables a su organización y justifique su selección
            </p>

        </div>
    </div>
</div>
<div class="form-group col-12 text-right">
    <a href="{{ route('admin.declaracion-aplicabilidad-2022.dashboard') }}" class="btn btn-danger">Dashboard</a>
</div>
<div class="row">
    <div class="col">
        <div class="card-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-2 col">
                            @can('declaracion_aplicabilidad_reporte')
                                <button url="{{ route('admin.declaracion-aplicabilidad-2022.descargar') }}"
                                    onclik="generarReporte()" class="btn btn-sm btn-outline-primary generar-reporte">
                                    <i class="mr-1 fas fa-print"></i>
                                    Generar Reporte
                                </button>
                            @endcan

                            @if (count($lista_archivos_declaracion) > 0)
                                <div class="btn-group dropright">
                                    <button type="button" class="btn btn-sm btn-outline-danger dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="far fa-file-pdf"></i>
                                        Documentos Generados
                                    </button>
                                    <div class="dropdown-menu">
                                        @foreach ($lista_archivos_declaracion as $archivo)
                                            <a class="dropdown-item" target="_blank"
                                                href=" {{ asset($ISO27001_2022_SoA_PATH . basename($archivo)) }}">
                                                <i class="far fa-file-pdf text-danger"></i>
                                                {{ basename($archivo) }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            {{-- <button type="button" class="btn btn-sm btn-outline-success dropdown-toggle"
                                aria-haspopup="true" aria-expanded="false" data-toggle="modal"
                                data-target="#ResponsablesModal">
                                <i class="far fa-file"></i>
                                Notificar aprobador
                            </button>

                            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                aria-haspopup="true" aria-expanded="false" data-toggle="modal"
                                data-target="#ResponsablesModal">
                                <i class="far fa-file"></i>
                                Notificar responsable
                            </button> --}}
                            {{-- <a href="#" class="btn btn-sm btn-primary tamaño" style="with:400px !important;" data-toggle="modal" data-target="#ResponsablesModal">Notificar&nbsp;responsable</a> --}}
                        </div>

                        @php
                            use App\Models\User;
                            $usuario = User::getCurrentUser();
                            $permisoResponsable = false;
                            $permisoAprobador = false;
                            foreach ($responsables as $responsable) {
                                if ($usuario->empleado->id == $responsable->empleado_id) {
                                    $permisoResponsable = true;
                                    break;
                                } else {
                                    $permisoResponsable = false;
                                }
                            }
                            
                            foreach ($aprobadores as $aprobador) {
                                if ($usuario->empleado->id == $aprobador->empleado_id) {
                                    $permisoAprobador = true;
                                    break;
                                } else {
                                    $permisoAprobador = false;
                                }
                            }
                            
                        @endphp
                        <div class="table-responsive">
                            <table class="table" style="font-size: 12px;">
                                <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col" style="width: 5%">INDICE</th>
                                        <th style="min-width:400px" COLSPAN="2">CONTROL</th>
                                        <th scope="col" style="width: 5%">CLASIFICACIÓN</th>
                                        <th style="width:15px !important;">RESPONSABLE</th>
                                        <th style="width:15px !important;">APROBADOR</th>

                                        @if ($permisoResponsable || $permisoAprobador)
                                            <th scope="col" style="width: 5%">APLICA</th>
                                            <th style="min-width:200px;" scope="col">JUSTIFICACIÓN</th>
                                            <th style="width:15%;" scope="col">ESTATUS</th>
                                            <th style="width:35%;" scope="col">COMENTARIOS</th>
                                            <th style="width:15px !important;">FECHA DE APROBACIÓN</th>
                                        @endif


                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="negras">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="11">
                                            CONTROLES ORGANIZACIONALES</td>
                                    </tr>
                                    @foreach ($gapda5s as $g5s)
                                        <tr>

                                            <th scope="row" style="width: 5%">
                                                {{ $g5s->gapdos->control_iso }}
                                            </th>
                                            <td style="width:20%">
                                                {{ $g5s->gapdos->anexo_politica }}
                                            </td>
                                            <td style="width:35%">
                                                {{ $g5s->gapdos->anexo_descripcion }}
                                            </td>
                                            <td scope="row" style="width: 5%">
                                                {{ $g5s->gapdos->clasificacion->nombre }}
                                            </td>
                                            <td>
                                                @foreach ($responsables as $responsable)
                                                    @if (!is_null($responsable))
                                                        @if ($responsable->declaracion_id == $g5s->id)
                                                            @if (!is_null($responsable->empleado))
                                                                <img src="{{ asset('storage/empleados/imagenes') }}/{{ $responsable->empleado->avatar }}"
                                                                    class="img_empleado"
                                                                    title="{{ $responsable->empleado->name }}">
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($aprobadores as $aprobador)
                                                    @if ($aprobador->declaracion_id == $g5s->id)
                                                        @if (!is_null($aprobador->empleado))
                                                            <img src="{{ asset('storage/empleados/imagenes') }}/{{ $aprobador->empleado->avatar }}"
                                                                class="img_empleado"
                                                                title="{{ $aprobador->empleado->name }}">
                                                        @endif
                                                        {{-- {{$aprobador->empleado_id}} --}}
                                                    @endif
                                                @endforeach
                                            </td>

                                            @php
                                                foreach ($responsables as $responsable) {
                                                    if ($responsable->declaracion_id == $g5s->id) {
                                                        $aplica = $responsable->aplica;
                                                    }
                                                }
                                                // dd($responsable);
                                            @endphp
                                            @foreach ($aprobadores as $aprobador)
                                                @if ($aprobador->declaracion_id == $g5s->id)
                                                    @if ($usuario->empleado->id == $aprobador->empleado_id)
                                                        <td style="width:5%">
                                                            @if (!isset($aplica))
                                                                <div class="text-center"><i style="font-size:12pt"
                                                                        class=" fas fa-user-lock mr-2 text-danger"
                                                                        title="Acción no permitida"></i>
                                                                </div>
                                                            @else
                                                                {{ $aplica == '1' ? 'Si' : 'No' }}
                                                            @endif

                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @foreach ($responsables as $responsable)
                                                @if ($responsable->declaracion_id == $g5s->id)
                                                    @if ($usuario->empleado->id == $responsable->empleado_id)
                                                        <td style="width:5%">
                                                            {{-- Seleccionar --}}
                                                            <a href="#" data-type="select"
                                                                data-pk="{{ $g5s->id }}"
                                                                data-url="{{ route('admin.declaracion-aplicabilidad-2022.update', $g5s->id) }}"
                                                                data-title="Seleccionar aplica"
                                                                data-value="{{ $responsable->aplica }}" class="aplica2"
                                                                data-name="aplica">
                                                            </a>
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @php
                                                foreach ($responsables as $responsable) {
                                                    if ($responsable->declaracion_id == $g5s->id) {
                                                        $justificacion = $responsable->justificacion;
                                                    }
                                                }
                                            @endphp
                                            @foreach ($aprobadores as $aprobador)
                                                @if ($aprobador->declaracion_id == $g5s->id)
                                                    @if ($usuario->empleado->id == $aprobador->empleado_id)
                                                        <td class="text-justify">
                                                            @if (!isset($justificacion))
                                                                <div class="text-center"><i style="font-size:12pt"
                                                                        class=" fas fa-user-lock mr-2 text-danger"
                                                                        title="Acción no permitida"></i>
                                                                </div>
                                                            @else
                                                                {{ $justificacion }}
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach


                                            @foreach ($responsables as $responsable)
                                                @if ($responsable->declaracion_id == $g5s->id)
                                                    @if ($usuario->empleado->id == $responsable->empleado_id)
                                                        <td class="text-justify">
                                                            <a data-type="textarea" data-pk="{{ $g5s->id }}"
                                                                data-url="{{ route('admin.declaracion-aplicabilidad-2022.update', $g5s->id) }}"
                                                                data-title="Justificacion"
                                                                data-value="{{ $responsable->justificacion }}"
                                                                class="justificacion" data-name="justificacion">
                                                            </a>
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @php
                                                foreach ($aprobadores as $aprobador) {
                                                    if ($aprobador->declaracion_id == $g5s->id) {
                                                        $estatusy = $aprobador->estatus;
                                                    }
                                                }
                                            @endphp

                                            @foreach ($responsables as $responsable)
                                                @if ($responsable->declaracion_id == $g5s->id)
                                                    @if ($usuario->empleado->id == $responsable->empleado_id)
                                                        <td style="width:15%">
                                                            @if (!isset($estatusy))
                                                                <div class="text-center"><i style="font-size:12pt"
                                                                        class=" fas fa-user-lock mr-2 text-danger"
                                                                        title="Acción no permitida"></i>
                                                                </div>
                                                            @else
                                                                @if ($estatusy == 1)
                                                                    <p>Pendiente de aprobar</p>
                                                                @elseif($estatusy == 2)
                                                                    <p>Aprobada</p>
                                                                @else
                                                                    <p>Rechazada</p>
                                                                @endif
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @foreach ($aprobadores as $aprobador)
                                                @if ($aprobador->declaracion_id == $g5s->id)
                                                    @if ($usuario->empleado->id == $aprobador->empleado_id)
                                                        <td style="width:15%">
                                                            <a href="#" data-type="select"
                                                                data-pk="{{ $g5s->id }}"
                                                                data-url="{{ route('admin.declaracion-aplicabilidad-2022.update', $g5s->id) }}"
                                                                data-title="Seleccionar estatus"
                                                                data-value="{{ $aprobador->estatus }}"
                                                                class="estatus" data-name="estatus"
                                                                onchange='cambioOpciones();' id="opciones">
                                                            </a>
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach


                                            @php
                                                $comentariox = null;
                                                foreach ($aprobadores as $aprobador) {
                                                    if ($aprobador->declaracion_id == $g5s->id) {
                                                        $comentariox = $aprobador->comentarios;
                                                    }
                                                }
                                            @endphp

                                            @foreach ($aprobadores as $aprobador)
                                                @if ($aprobador->declaracion_id == $g5s->id)
                                                    @if ($usuario->empleado->id == $aprobador->empleado_id)
                                                        <td class="text-justify">
                                                            <a href="#" data-type="textarea"
                                                                data-pk="{{ $g5s->id }}"
                                                                data-url="{{ route('admin.declaracion-aplicabilidad-2022.update', $g5s->id) }}"
                                                                data-title="Comentarios"
                                                                data-value="{{ $aprobador->comentarios }}"
                                                                class="comentarios" data-name="comentarios">
                                                            </a>
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @foreach ($responsables as $responsable)
                                                @if ($responsable->declaracion_id == $g5s->id)
                                                    @if ($usuario->empleado->id == $responsable->empleado_id)
                                                        <td class="text-justify">
                                                            @if (!isset($comentariox))
                                                                <div class="text-center"><i style="font-size:12pt"
                                                                        class=" fas fa-user-lock mr-2 text-danger"
                                                                        title="Acción no permitida"></i></div>
                                                            @else
                                                                {{ $comentariox }}
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach


                                            @php
                                                foreach ($aprobadores as $aprobador) {
                                                    if ($aprobador->declaracion_id == $g5s->id) {
                                                        $fecha = $aprobador->fecha_aprobacion;
                                                    }
                                                }
                                            @endphp

                                            @foreach ($responsables as $responsable)
                                                @if ($responsable->declaracion_id == $g5s->id)
                                                    @if ($usuario->empleado->id == $responsable->empleado_id)
                                                        <td style="width:15%">
                                                            @if ($estatusy == 1)
                                                                <p>Pendiente de aprobar</p>
                                                            @elseif($estatusy == 2)
                                                                {{ $fecha }}
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach


                                            @foreach ($aprobadores as $aprobador)
                                                @if ($aprobador->declaracion_id == $g5s->id)
                                                    @if ($usuario->empleado->id == $aprobador->empleado_id)
                                                        <td style="width:15%"
                                                            id="actualizacion_fecha_{{ $g5s->id }}">
                                                            @if ($aprobador->estatus == 2)
                                                                {{ $aprobador->fecha_aprobacion }}
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive">


                            <table class="table" style="font-size: 12px;">
                                <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col" style="width: 5%">INDICE</th>
                                        <th style="min-width:400px" COLSPAN="2">CONTROL</th>
                                        <th scope="col" style="width: 5%">CLASIFICACIÓN</th>
                                        <th style="width:15px !important;">RESPONSABLE</th>
                                        <th style="width:15px !important;">APROBADOR</th>

                                        @if ($permisoResponsable || $permisoAprobador)
                                            <th scope="col" style="width: 5%">APLICA</th>
                                            <th style="min-width:200px;" scope="col">JUSTIFICACIÓN</th>
                                            <th style="width:15%;" scope="col">ESTATUS</th>
                                            <th style="width:35%;" scope="col">COMENTARIOS</th>
                                            <th style="width:15px !important;">FECHA DE APROBACIÓN</th>
                                        @endif

                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="negras">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;"
                                            colspan="11">
                                            CONTROLES PERSONALES
                                        </td>
                                    </tr>

                                    @foreach ($gapda6s as $g6s)
                                        <tr>
                                            <th scope="row" style="width: 5%">
                                                {{ $g6s->gapdos->control_iso }}
                                            </th>
                                            <td style="width:20%">
                                                {{ $g6s->gapdos->anexo_politica }}
                                            </td>
                                            <td style="width:35%">
                                                {{ $g6s->gapdos->anexo_descripcion }}
                                            </td>
                                            <td scope="row" style="width: 5%">
                                                {{ $g6s->gapdos->clasificacion->nombre }}
                                            </td>
                                            <td>
                                                @foreach ($responsables as $responsable)
                                                    @if ($responsable->declaracion_id == $g6s->id)
                                                        @if (!is_null($responsable->empleado))
                                                            <img src="{{ asset('storage/empleados/imagenes') }}/{{ $responsable->empleado->avatar }}"
                                                                class="img_empleado"
                                                                title="{{ $responsable->empleado->name }}">
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </td>

                                            <td>
                                                @foreach ($aprobadores as $aprobador)
                                                    @if ($aprobador->declaracion_id == $g6s->id)
                                                        @if (!is_null($aprobador->empleado))
                                                            <img src="{{ asset('storage/empleados/imagenes') }}/{{ $aprobador->empleado->avatar }}"
                                                                class="img_empleado"
                                                                title="{{ $aprobador->empleado->name }}">
                                                        @endif
                                                        {{-- {{$aprobador->empleado_id}} --}}
                                                    @endif
                                                @endforeach
                                            </td>

                                            @php
                                                foreach ($responsables as $responsable) {
                                                    if ($responsable->declaracion_id == $g6s->id) {
                                                        $aplica = $responsable->aplica;
                                                    }
                                                }
                                            @endphp

                                            @foreach ($aprobadores as $aprobador)
                                                @if ($aprobador->declaracion_id == $g6s->id)
                                                    @if ($usuario->empleado->id == $aprobador->empleado_id)
                                                        <td style="width:5%">
                                                            @if (!isset($aplica))
                                                                <div class="text-center"><i style="font-size:12pt"
                                                                        class=" fas fa-user-lock mr-2 text-danger"
                                                                        title="Acción no permitida"></i></div>
                                                            @else
                                                                {{ $aplica == 1 ? 'Si' : 'No' }}
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @foreach ($responsables as $responsable)
                                                @if ($responsable->declaracion_id == $g6s->id)
                                                    @if ($usuario->empleado->id == $responsable->empleado_id)
                                                        <td style="width:5%">
                                                            <a href="#" data-type="select"
                                                                data-pk="{{ $g6s->id }}"
                                                                data-url="{{ route('admin.declaracion-aplicabilidad-2022.update', $g6s->id) }}"
                                                                data-title="Seleccionar aplica"
                                                                data-value="{{ $responsable->aplica }}"
                                                                class="aplica2" data-name="aplica">
                                                            </a>
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @php
                                                foreach ($responsables as $responsable) {
                                                    if ($responsable->declaracion_id == $g6s->id) {
                                                        $justificacion = $responsable->justificacion;
                                                    }
                                                }
                                            @endphp

                                            @foreach ($aprobadores as $aprobador)
                                                @if ($aprobador->declaracion_id == $g6s->id)
                                                    @if ($usuario->empleado->id == $aprobador->empleado_id)
                                                        <td class="text-justify">
                                                            @if (is_null($justificacion))
                                                                <div class="text-center"><i style="font-size:12pt"
                                                                        class=" fas fa-user-lock mr-2 text-danger"
                                                                        title="Acción no permitida"></i></div>
                                                            @else
                                                                {{ $justificacion }}
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @foreach ($responsables as $responsable)
                                                @if ($responsable->declaracion_id == $g6s->id)
                                                    @if ($usuario->empleado->id == $responsable->empleado_id)
                                                        <td class="text-justify">
                                                            <a href="#" data-type="textarea"
                                                                data-pk="{{ $g6s->id }}"
                                                                data-url="{{ route('admin.declaracion-aplicabilidad-2022.update', $g6s->id) }}"
                                                                data-title="Justificacion"
                                                                data-value="{{ $responsable->justificacion }}"
                                                                class="justificacion" data-name="justificacion">
                                                            </a>
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @php
                                                foreach ($aprobadores as $aprobador) {
                                                    if ($aprobador->declaracion_id == $g6s->id) {
                                                        $estatusy = $aprobador->estatus;
                                                    }
                                                }
                                            @endphp

                                            @foreach ($responsables as $responsable)
                                                @if ($responsable->declaracion_id == $g6s->id)
                                                    @if ($usuario->empleado->id == $responsable->empleado_id)
                                                        <td style="width:15%">
                                                            @if (!isset($estatusy))
                                                                <div class="text-center"><i style="font-size:12pt"
                                                                        class=" fas fa-user-lock mr-2 text-danger"
                                                                        title="Acción no permitida"></i></div>
                                                            @else
                                                                @if ($estatusy == 1)
                                                                    <p>Pendiente de aprobar</p>
                                                                @elseif($estatusy == 2)
                                                                    <p>Aprobada</p>
                                                                @else
                                                                    <p>Rechazada</p>
                                                                @endif
                                                            @endif

                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @foreach ($aprobadores as $aprobador)
                                                @if ($aprobador->declaracion_id == $g6s->id)
                                                    @if ($usuario->empleado->id == $aprobador->empleado_id)
                                                        <td style="width:15%">
                                                            <a href="#" data-type="select"
                                                                data-pk="{{ $g6s->id }}"
                                                                data-url="{{ route('admin.declaracion-aplicabilidad-2022.update', $g6s->id) }}"
                                                                data-title="Seleccionar estatus"
                                                                data-value="{{ $aprobador->estatus }}"
                                                                class="estatus" data-name="estatus"
                                                                onchange='cambioOpciones();' id="opciones">
                                                            </a>
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @php
                                                foreach ($aprobadores as $aprobador) {
                                                    if ($aprobador->declaracion_id == $g6s->id) {
                                                        $comentariox = $aprobador->comentarios;
                                                    }
                                                }
                                            @endphp

                                            @foreach ($responsables as $responsable)
                                                @if ($responsable->declaracion_id == $g6s->id)
                                                    @if ($usuario->empleado->id == $responsable->empleado_id)
                                                        <td class="text-justify">
                                                            @if (!isset($comentariosx))
                                                                <div class="text-center"><i style="font-size:12pt"
                                                                        class=" fas fa-user-lock mr-2 text-danger"
                                                                        title="Acción no permitida"></i></div>
                                                            @else
                                                                {{ $comentariox }}
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @foreach ($aprobadores as $aprobador)
                                                @if ($aprobador->declaracion_id == $g6s->id)
                                                    @if ($usuario->empleado->id == $aprobador->empleado_id)
                                                        <td class="text-justify">
                                                            <a href="#" data-type="textarea"
                                                                data-pk="{{ $g6s->id }}"
                                                                data-url="{{ route('admin.declaracion-aplicabilidad-2022.update', $g6s->id) }}"
                                                                data-title="Comentarios"
                                                                data-value="{{ $aprobador->comentarios }}"
                                                                class="comentarios" data-name="comentarios">
                                                            </a>
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach


                                            @php
                                                foreach ($aprobadores as $aprobador) {
                                                    if ($aprobador->declaracion_id == $g6s->id) {
                                                        $fecha = $aprobador->fecha_aprobacion;
                                                    }
                                                }
                                            @endphp

                                            @foreach ($responsables as $responsable)
                                                @if ($responsable->declaracion_id == $g6s->id)
                                                    @if ($usuario->empleado->id == $responsable->empleado_id)
                                                        <td style="width:15%"
                                                            id="actualizacion_fecha_{{ $g6s->id }}">
                                                            @if ($estatusy == 1)
                                                                <p>Pendiente de aprobar</p>
                                                            @elseif($estatusy == 2)
                                                                {{ $fecha }}
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @foreach ($aprobadores as $aprobador)
                                                @if ($aprobador->declaracion_id == $g6s->id)
                                                    @if ($usuario->empleado->id == $aprobador->empleado_id)
                                                        <td style="width:15%"
                                                            id="actualizacion_fecha_{{ $g6s->id }}">
                                                            @if ($aprobador->estatus == 2)
                                                                {{ $aprobador->fecha_aprobacion }}
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive">

                            <table class="table" style="font-size: 12px;">
                                <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col" style="width: 5%">INDICE</th>
                                        <th style="min-width:400px" COLSPAN="2">CONTROL</th>
                                        <th scope="col" style="width: 5%">CLASIFICACIÓN</th>
                                        <th style="width:15px !important;">RESPONSABLE</th>
                                        <th style="width:15px !important;">APROBADOR</th>
                                        @if ($permisoResponsable || $permisoAprobador)
                                            <th scope="col" style="width: 5%">APLICA</th>
                                            <th style="min-width:200px;" scope="col">JUSTIFICACIÓN</th>
                                            <th style="width:15%;" scope="col">ESTATUS</th>
                                            <th style="width:35%;" scope="col">COMENTARIOS</th>
                                            <th style="width:15px !important;">FECHA DE APROBACIÓN</th>
                                        @endif


                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="negras">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;"
                                            colspan="11">
                                            CONTROLES FISICOS</td>
                                    </tr>

                                    @foreach ($gapda7s as $g7s)
                                        <tr>
                                            <th scope="row" style="width: 5%">
                                                {{ $g7s->gapdos->control_iso }}
                                            </th>
                                            <td style="width:20%">
                                                {{ $g7s->gapdos->anexo_politica }}
                                            </td>
                                            <td style="width:35%">
                                                {{ $g7s->gapdos->anexo_descripcion }}
                                            </td>
                                            <td scope="row" style="width: 5%">
                                                {{ $g7s->gapdos->clasificacion->nombre }}
                                            </td>
                                            <td>
                                                @foreach ($responsables as $responsable)
                                                    @if ($responsable->declaracion_id == $g7s->id)
                                                        @if (!is_null($responsable->empleado))
                                                            <img src="{{ asset('storage/empleados/imagenes') }}/{{ $responsable->empleado->avatar }}"
                                                                class="img_empleado"
                                                                title="{{ $responsable->empleado->name }}">
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($aprobadores as $aprobador)
                                                    @if ($aprobador->declaracion_id == $g7s->id)
                                                        @if (!is_null($aprobador->empleado))
                                                            <img src="{{ asset('storage/empleados/imagenes') }}/{{ $aprobador->empleado->avatar }}"
                                                                class="img_empleado"
                                                                title="{{ $aprobador->empleado->name }}">
                                                        @endif
                                                        {{-- {{$aprobador->empleado_id}} --}}
                                                    @endif
                                                @endforeach
                                            </td>

                                            @php
                                                foreach ($responsables as $responsable) {
                                                    if ($responsable->declaracion_id == $g7s->id) {
                                                        $aplica = $responsable->aplica;
                                                    }
                                                }
                                            @endphp

                                            @foreach ($aprobadores as $aprobador)
                                                @if ($aprobador->declaracion_id == $g7s->id)
                                                    @if ($usuario->empleado->id == $aprobador->empleado_id)
                                                        <td style="width:5%">
                                                            @if (!isset($aplica))
                                                                <div class="text-center"><i style="font-size:12pt"
                                                                        class=" fas fa-user-lock mr-2 text-danger"
                                                                        title="Acción no permitida"></i></div>
                                                            @else
                                                                {{ $aplica == '1' ? 'Si' : 'No' }}
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @foreach ($responsables as $responsable)
                                                @if ($responsable->declaracion_id == $g7s->id)
                                                    @if ($usuario->empleado->id == $responsable->empleado_id)
                                                        <td style="width:5%">
                                                            <a href="#" data-type="select"
                                                                data-pk="{{ $g7s->id }}"
                                                                data-url="{{ route('admin.declaracion-aplicabilidad-2022.update', $g7s->id) }}"
                                                                data-title="Seleccionar aplica"
                                                                data-value="{{ $responsable->aplica }}"
                                                                class="aplica2" data-name="aplica">
                                                            </a>
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @php
                                                foreach ($responsables as $responsable) {
                                                    if ($responsable->declaracion_id == $g7s->id) {
                                                        $justificacion = $responsable->justificacion;
                                                    }
                                                }
                                            @endphp

                                            @foreach ($aprobadores as $aprobador)
                                                @if ($aprobador->declaracion_id == $g7s->id)
                                                    @if ($usuario->empleado->id == $aprobador->empleado_id)
                                                        <td class="text-justify">
                                                            @if (!isset($justificacion))
                                                                <div class="text-center"><i style="font-size:12pt"
                                                                        class=" fas fa-user-lock mr-2 text-danger"
                                                                        title="Acción no permitida"></i></div>
                                                            @else
                                                                {{ $justificacion }}
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @foreach ($responsables as $responsable)
                                                @if ($responsable->declaracion_id == $g7s->id)
                                                    @if ($usuario->empleado->id == $responsable->empleado_id)
                                                        <td class="text-justify">
                                                            <a href="#" data-type="textarea"
                                                                data-pk="{{ $g7s->id }}"
                                                                data-url="{{ route('admin.declaracion-aplicabilidad-2022.update', $g7s->id) }}"
                                                                data-title="Justificacion"
                                                                data-value="{{ $responsable->justificacion }}"
                                                                class="justificacion" data-name="justificacion">
                                                            </a>
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @php
                                                foreach ($aprobadores as $aprobador) {
                                                    if ($aprobador->declaracion_id == $g7s->id) {
                                                        $estatusy = $aprobador->estatus;
                                                    }
                                                }
                                            @endphp
                                            @foreach ($aprobadores as $aprobador)
                                                @if ($aprobador->declaracion_id == $g7s->id)
                                                    @if ($usuario->empleado->id == $aprobador->empleado_id)
                                                        <td style="width:15%">
                                                            <a href="#" data-type="select"
                                                                data-pk="{{ $g7s->id }}"
                                                                data-url="{{ route('admin.declaracion-aplicabilidad-2022.update', $g7s->id) }}"
                                                                data-title="Seleccionar estatus"
                                                                data-value="{{ $aprobador->estatus }}"
                                                                class="estatus" data-name="estatus"
                                                                onchange='cambioOpciones();' id="opciones">
                                                            </a>
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach
                                            @foreach ($responsables as $responsable)
                                                @if ($responsable->declaracion_id == $g7s->id)
                                                    @if ($usuario->empleado->id == $responsable->empleado_id)
                                                        <td style="width:15%">
                                                            @if (!isset($estatusy))
                                                                <div class="text-center"><i style="font-size:12pt"
                                                                        class=" fas fa-user-lock mr-2 text-danger"
                                                                        title="Acción no permitida"></i></div>
                                                            @else
                                                                @if ($estatusy == 1)
                                                                    <p>Pendiente de aprobar</p>
                                                                @elseif($estatusy == 2)
                                                                    <p>Aprobada</p>
                                                                @else
                                                                    <p>Rechazada</p>
                                                                @endif
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @php
                                                foreach ($aprobadores as $aprobador) {
                                                    if ($aprobador->declaracion_id == $g7s->id) {
                                                        $comentariox = $aprobador->comentarios;
                                                    }
                                                }
                                            @endphp

                                            @foreach ($responsables as $responsable)
                                                @if ($responsable->declaracion_id == $g7s->id)
                                                    @if ($usuario->empleado->id == $responsable->empleado_id)
                                                        <td class="text-justify">
                                                            @if (!isset($comentariox))
                                                                <div class="text-center"><i style="font-size:12pt"
                                                                        class=" fas fa-user-lock mr-2 text-danger"
                                                                        title="Acción no permitida"></i></div>
                                                            @else
                                                                {{ $comentariox }}
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @foreach ($aprobadores as $aprobador)
                                                @if ($aprobador->declaracion_id == $g7s->id)
                                                    @if ($usuario->empleado->id == $aprobador->empleado_id)
                                                        <td class="text-justify">
                                                            <a href="#" data-type="textarea"
                                                                data-pk="{{ $g7s->id }}"
                                                                data-url="{{ route('admin.declaracion-aplicabilidad-2022.update', $g7s->id) }}"
                                                                data-title="Comentarios"
                                                                data-value="{{ $aprobador->comentarios }}"
                                                                class="comentarios" data-name="comentarios">
                                                            </a>
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @php
                                                foreach ($aprobadores as $aprobador) {
                                                    if ($aprobador->declaracion_id == $g7s->id) {
                                                        $fecha = $aprobador->fecha_aprobacion;
                                                    }
                                                }
                                            @endphp




                                            @foreach ($responsables as $responsable)
                                                @if ($responsable->declaracion_id == $g7s->id)
                                                    @if ($usuario->empleado->id == $responsable->empleado_id)
                                                        <td style="width:15%">
                                                            @if ($estatusy == 1)
                                                                <p>Pendiente de aprobar</p>
                                                            @elseif($estatusy == 2)
                                                                {{ $fecha }}
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @foreach ($aprobadores as $aprobador)
                                                @if ($aprobador->declaracion_id == $g7s->id)
                                                    @if ($usuario->empleado->id == $aprobador->empleado_id)
                                                        <td style="width:15%"
                                                            id="actualizacion_fecha_{{ $g7s->id }}">
                                                            @if ($aprobador->estatus == 2)
                                                                {{ $aprobador->fecha_aprobacion }}
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive">

                            <table class="table" style="font-size: 12px;">
                                <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col" style="width: 5%">INDICE</th>
                                        <th style="min-width:400px" COLSPAN="2">CONTROL</th>
                                        <th scope="col" style="width: 5%">CLASIFICACIÓN</th>
                                        <th style="width:15px !important;">RESPONSABLE</th>
                                        <th style="width:15px !important;">APROBADOR</th>
                                        @if ($permisoResponsable || $permisoAprobador)
                                            <th scope="col" style="width: 5%">APLICA</th>
                                            <th style="min-width:200px;" scope="col">JUSTIFICACIÓN</th>
                                            <th style="width:15%;" scope="col">ESTATUS</th>
                                            <th style="width:35%;" scope="col">COMENTARIOS</th>
                                            <th style="width:15px !important;">FECHA DE APROBACIÓN</th>
                                        @endif


                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="negras">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;"
                                            colspan="11">
                                            CONTROLES TECNOLOGICOS</td>
                                    </tr>

                                    @foreach ($gapda8s as $g8s)
                                        <tr>
                                            <th scope="row" style="width: 5%">
                                                {{ $g8s->gapdos->control_iso }}
                                            </th>
                                            <td style="width:20%">
                                                {{ $g8s->gapdos->anexo_politica }}
                                            </td>
                                            <td style="width:35%">
                                                {{ $g8s->gapdos->anexo_descripcion }}
                                            </td>
                                            <td scope="row" style="width: 5%">
                                                {{ $g8s->gapdos->clasificacion->nombre }}
                                            </td>
                                            <td>
                                                @foreach ($responsables as $responsable)
                                                    @if ($responsable->declaracion_id == $g8s->id)
                                                        @if (!is_null($responsable->empleado))
                                                            <img src="{{ asset('storage/empleados/imagenes') }}/{{ $responsable->empleado->avatar }}"
                                                                class="img_empleado"
                                                                title="{{ $responsable->empleado->name }}">
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($aprobadores as $aprobador)
                                                    @if ($aprobador->declaracion_id == $g8s->id)
                                                        @if (!is_null($aprobador->empleado))
                                                            <img src="{{ asset('storage/empleados/imagenes') }}/{{ $aprobador->empleado->avatar }}"
                                                                class="img_empleado"
                                                                title="{{ $aprobador->empleado->name }}">
                                                        @endif
                                                        {{-- {{$aprobador->empleado_id}} --}}
                                                    @endif
                                                @endforeach
                                            </td>

                                            @php
                                                foreach ($responsables as $responsable) {
                                                    if ($responsable->declaracion_id == $g8s->id) {
                                                        $aplica = $responsable->aplica;
                                                    }
                                                }
                                            @endphp

                                            @foreach ($aprobadores as $aprobador)
                                                @if ($aprobador->declaracion_id == $g8s->id)
                                                    @if ($usuario->empleado->id == $aprobador->empleado_id)
                                                        <td style="width:5%">
                                                            @if (!isset($aplica))
                                                                <div class="text-center"><i style="font-size:12pt"
                                                                        class=" fas fa-user-lock mr-2 text-danger"
                                                                        title="Acción no permitida"></i></div>
                                                            @else
                                                                {{ $aplica == '1' ? 'Si' : 'No' }}
                                                            @endif

                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @foreach ($responsables as $responsable)
                                                @if ($responsable->declaracion_id == $g8s->id)
                                                    @if ($usuario->empleado->id == $responsable->empleado_id)
                                                        <td style="width:5%">
                                                            <a href="#" data-type="select"
                                                                data-pk="{{ $g8s->id }}"
                                                                data-url="{{ route('admin.declaracion-aplicabilidad-2022.update', $g8s->id) }}"
                                                                data-title="Seleccionar aplica"
                                                                data-value=" {{ $responsable->aplica }}"
                                                                class="aplica2" data-name="aplica">
                                                            </a>
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @php
                                                foreach ($responsables as $responsable) {
                                                    if ($responsable->declaracion_id == $g8s->id) {
                                                        $justificacion = $responsable->justificacion;
                                                    }
                                                }
                                            @endphp


                                            @foreach ($aprobadores as $aprobador)
                                                @if ($aprobador->declaracion_id == $g8s->id)
                                                    @if ($usuario->empleado->id == $aprobador->empleado_id)
                                                        <td class="text-justify">
                                                            @if (!isset($justificacion))
                                                                <div class="text-center"><i style="font-size:12pt"
                                                                        class=" fas fa-user-lock mr-2 text-danger"
                                                                        title="Acción no permitida"></i>
                                                                </div>
                                                            @else
                                                                {{ $justificacion }}
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @foreach ($responsables as $responsable)
                                                @if ($responsable->declaracion_id == $g8s->id)
                                                    @if ($usuario->empleado->id == $responsable->empleado_id)
                                                        <td class="text-justify">
                                                            <a href="#" data-type="textarea"
                                                                data-pk="{{ $g8s->id }}"
                                                                data-url="{{ route('admin.declaracion-aplicabilidad-2022.update', $g8s->id) }}"
                                                                data-title="Justificacion"
                                                                data-value="{{ $responsable->justificacion }}"
                                                                class="justificacion" data-name="justificacion">
                                                            </a>
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @php
                                                foreach ($aprobadores as $aprobador) {
                                                    if ($aprobador->declaracion_id == $g8s->id) {
                                                        $estatusy = $aprobador->estatus;
                                                    }
                                                }
                                            @endphp

                                            @foreach ($aprobadores as $aprobador)
                                                @if ($aprobador->declaracion_id == $g8s->id)
                                                    @if ($usuario->empleado->id == $aprobador->empleado_id)
                                                        <td style="width:15%">
                                                            <a href="#" data-type="select"
                                                                data-pk="{{ $g8s->id }}"
                                                                data-url="{{ route('admin.declaracion-aplicabilidad-2022.update', $g8s->id) }}"
                                                                data-title="Seleccionar estatus"
                                                                data-value="{{ $aprobador->estatus }}"
                                                                class="estatus" data-name="estatus"
                                                                onchange='cambioOpciones();' id="opciones">
                                                            </a>
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @foreach ($responsables as $responsable)
                                                @if ($responsable->declaracion_id == $g8s->id)
                                                    @if ($usuario->empleado->id == $responsable->empleado_id)
                                                        <td style="width:15%">
                                                            @if (!isset($estatusy))
                                                                <div class="text-center"><i style="font-size:12pt"
                                                                        class=" fas fa-user-lock mr-2 text-danger"
                                                                        title="Acción no permitida"></i>
                                                                </div>
                                                            @else
                                                                @if ($estatusy == 1)
                                                                    <p>Pendiente de aprobar</p>
                                                                @elseif($estatusy == 2)
                                                                    <p>Aprobada</p>
                                                                @else
                                                                    <p>Rechazada</p>
                                                                @endif
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @php
                                                foreach ($aprobadores as $aprobador) {
                                                    if ($aprobador->declaracion_id == $g8s->id) {
                                                        $comentariox = $aprobador->comentarios;
                                                    }
                                                }
                                            @endphp

                                            @foreach ($responsables as $responsable)
                                                @if ($responsable->declaracion_id == $g8s->id)
                                                    @if ($usuario->empleado->id == $responsable->empleado_id)
                                                        <td class="text-justify">
                                                            @if (!isset($comentariosx))
                                                                <div class="text-center"><i style="font-size:12pt"
                                                                        class=" fas fa-user-lock mr-2 text-danger"
                                                                        title="Acción no permitida"></i></div>
                                                            @else
                                                                {{ $comentariox }}
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @foreach ($aprobadores as $aprobador)
                                                @if ($aprobador->declaracion_id == $g8s->id)
                                                    @if ($usuario->empleado->id == $aprobador->empleado_id)
                                                        <td class="text-justify">
                                                            <a href="#" data-type="textarea"
                                                                data-pk="{{ $g8s->id }}"
                                                                data-url="{{ route('admin.declaracion-aplicabilidad-2022.update', $g8s->id) }}"
                                                                data-title="Comentarios"
                                                                data-value="{{ $aprobador->comentarios }}"
                                                                class="comentarios" data-name="comentarios">
                                                            </a>
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @php
                                                foreach ($aprobadores as $aprobador) {
                                                    if ($aprobador->declaracion_id == $g8s->id) {
                                                        $fecha = $aprobador->fecha_aprobacion;
                                                    }
                                                }
                                            @endphp

                                            @foreach ($responsables as $responsable)
                                                @if ($responsable->declaracion_id == $g8s->id)
                                                    @if ($usuario->empleado->id == $responsable->empleado_id)
                                                        <td style="width:15%">
                                                            @if ($estatusy == 1)
                                                                <p>Pendiente de aprobar</p>
                                                            @elseif($estatusy == 2)
                                                                {{ $fecha }}
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach
                                            @foreach ($aprobadores as $aprobador)
                                                @if ($aprobador->declaracion_id == $g8s->id)
                                                    @if ($usuario->empleado->id == $aprobador->empleado_id)
                                                        <td style="width:15%"
                                                            id="actualizacion_fecha_{{ $g8s->id }}">
                                                            @if ($aprobador->estatus == 2)
                                                                {{ $aprobador->fecha_aprobacion }}
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach



                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- <div class="mt-2 col">
                            <button url="{{ route('admin.declaracion-aplicabilidad-2022.descargar') }}"
                                onclik="generarReporte()" class="btn btn-sm btn-outline-primary generar-reporte">
                                <i class="mr-1 fas fa-print"></i>
                                Generar Reporte
                            </button>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
