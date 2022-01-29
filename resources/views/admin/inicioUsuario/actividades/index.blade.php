<div class="w-100" id="contendor-principal-actividades" x-data="{show:false}">
    <div class="row mb-4 align-items-center">
        <div class="pr-0" x-bind:class="show?'col-12':'col-12'" style="text-align:right;">
            <span class="mr-2" x-bind:class="!show?'menu-active':''" title="Visualizar Tarjetas"
                style="font-size: 1.1rem;cursor: pointer;" x-on:click="show=false"><i class="fas fa-th"></i></span>
            <span class="mr-2" style="font-size: 1.1rem;cursor: pointer;" x-bind:class="show?'menu-active':''"
                x-on:click="show=true" title="Visualizar Tabla"><i class="fas fa-th-list"></i></span>
        </div>
    </div>
    <div class="row mb-4" x-show="!show" x-transition:enter.duration.500ms x-transition:leave.duration.400ms>
        <div class="col-12">
            <div class="cards-actividades row" id="cards-actividades"></div>
            <div class="row">
                @foreach ($actividades as $task)
                    <div class="col-4">
                        <div id="carouselActividad{{ $task->id }}" class="carousel slide rounded p-2 bg-white"
                            data-ride="carousel">
                            <div class="col-12" style="text-align: right">
                                @php
                                    if (intval($task->parent_id) == 1) {
                                        $ruta = '/admin/planTrabajoBase/';
                                    } else {
                                        $ruta = '/admin/planes-de-accion/' . $task->parent_id;
                                    }
                                @endphp
                                <a href="{{ asset($ruta) }}"><i class="far fas fa-stream"></i></a>
                                <a href="plantTrabajoBase/{{ $task->name }}" target="_blank"><i
                                        class="fas fa-eye" style="font-size:12pt;"></i></a>
                                @if ($task->status == 'STATUS_DONE' or $task->status == 'STATUS_FAILED')
                                    <button class="btn_archivar" title="Archivar" data-toggle="modal"
                                        data-target="#alert_activ{{ $task->id }}">
                                        <i class="fas fa-archive"></i>
                                    </button>
                                @endif
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="deben-aprobar-card">
                                            <div class="px-4">
                                                <div class="row align-items-center">
                                                    <div class="col-12">
                                                        <h6 class="card-title d-flex align-items-center"
                                                            style="text-transform: capitalize;">
                                                            @if ($task->status == 'STATUS_DONE')
                                                                <i class="far fa-check-circle mr-1 text-success"
                                                                    style="font-size: 18px"></i>
                                                            @elseif ($task->status == 'STATUS_ACTIVE')
                                                                <i class="fas fa-info-circle mr-1 text-primary"
                                                                    style="font-size: 18px"></i>
                                                            @elseif ($task->status == 'STATUS_SUSPENDED')
                                                                <i class="far fa-question-circle mr-1 text-muted">
                                                                    style="font-size: 18px"></i>
                                                            @elseif ($task->status == 'STATUS_WAITING')
                                                                <i class="fas fa-clock mr-1 text-warning">
                                                                    style="font-size: 18px"></i>
                                                            @elseif ($task->status == 'STATUS_UNDEFINED')
                                                                <i class="far fa-question-circle mr-1 text-muted"
                                                                    style="font-size: 18px"></i>
                                                            @elseif ($task->status == 'STATUS_FAILED')
                                                                <i class="far fa-times-circle mr-1 text-danger"
                                                                    style="font-size: 18px"></i>
                                                            @endif
                                                            {{ $task->name }}
                                                        </h6>
                                                    </div>
                                                </div>

                                                @switch($task->status)
                                                    @case('STATUS_ACTIVE')
                                                        <p class="m-0"
                                                            style="font-size: 12px;color:rgb(253, 171, 61)">En
                                                            proceso</p>
                                                    @break
                                                    @case('STATUS_DONE')
                                                        <p class="m-0"
                                                            style="font-size: 12px;color:rgb(0, 200, 117)">
                                                            Completada</p>
                                                    @break
                                                    @case ('STATUS_FAILED')
                                                        <p class="m-0"
                                                            style="font-size: 12px;color:rgb(226, 68, 92)">Con
                                                            retraso</p>
                                                    @break
                                                    @case ('STATUS_SUSPENDED')
                                                        <p class="m-0" style="font-size: 12px;color:#aaaaaa">
                                                            Suspendida</p>
                                                    @break
                                                    @case ('STATUS_UNDEFINED')
                                                        <p class="m-0" style="font-size: 12px;color:#00b1e1">Sin
                                                            iniciar</p>
                                                    @break
                                                    @default
                                                        <p class="m-0" style="font-size: 12px;color:#00b1e1">Sin
                                                            iniciar</p>
                                                @endswitch
                                                <p class="m-0" style="font-size: 12px;">Origen:
                                                    {{ $task->parent }}</p>
                                                <p class="m-0" style="font-size: 12px;">Fecha:
                                                    {{ \Carbon\Carbon::createFromTimestamp($task->start / 1000)->toDateTime()->format('d-m-Y') }}
                                                    /
                                                    {{ \Carbon\Carbon::createFromTimestamp($task->end / 1000)->toDateTime()->format('d-m-Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div x-show="show" x-transition:enter.duration.500ms x-transition:leave.duration.400ms>
        <table id="tabla_usuario_actividades" class="table">
            <thead>
                <tr>
                    <th style="min-width:100px;">Actividad</th>
                    <th style="min-width:100px;">Origen</th>
                    {{-- <th>Categoria</th> --}}
                    {{-- <th>Urgencia</th> --}}
                    <th style="min-width:200px;">Fecha&nbsp;inicio</th>
                    <th style="min-width:200px;">Fecha&nbsp;fin</th>
                    <th style="min-width:200px;">Compartida&nbsp;con</th>
                    {{-- <th>Asignada por</th> --}}
                    <th style="min-width:200px;">Estatus</th>
                    <th style="min-width:100px;">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($actividades as $task)
                    @if (!($task->archivo == 'archivado'))
                        <tr id="{{ $task->id }}" data-parent-plan="{{ $task->slug }}">
                            <td class="td_nombre">{{ $task->name }}</td>
                            <td><span class="badge badge-primary">{{ $task->parent }}</span></td>
                            {{-- <td>Categoria</td> --}}
                            {{-- <td>Urgencia</td> --}}
                            <td>{{ \Carbon\Carbon::createFromTimestamp($task->start / 1000)->toDateTime()->format('d-m-Y') }}
                            </td>
                            <td>{{ \Carbon\Carbon::createFromTimestamp($task->end / 1000)->toDateTime()->format('d-m-Y') }}
                            </td>
                            <td>
                                <div class="td_div_recursos">
                                    @foreach ($task->assigs as $assig)
                                        @php
                                            $empleado = $Empleado->where('id', intval($assig->resourceId))->first();
                                        @endphp
                                        @if ($empleado)
                                            <img src="{{ asset('storage/empleados/imagenes/' . $empleado->avatar) }}"
                                                style="height: 37px; clip-path: circle(18px at 50% 50%);"
                                                class="rounded-circle {{ $empleado->id == auth()->user()->empleado->id ? 'd-none' : '' }}"
                                                alt="{{ $empleado->name }}" title="{{ $empleado->name }}">
                                            {{ $empleado->id == auth()->user()->empleado->id ? '' : '' }}
                                        @endif
                                    @endforeach
                                </div>
                            </td>
                            {{-- <td>Asignada por</td> --}}
                            <td>
                                @switch($task->status)
                                    @case('STATUS_ACTIVE')
                                        <span class="badge" style="background-color:rgb(253, 171, 61)">En
                                            proceso</span>
                                    @break
                                    @case('STATUS_DONE')
                                        <span class="badge"
                                            style="background-color:rgb(0, 200, 117)">Completada</span>
                                    @break
                                    @case ('STATUS_FAILED')
                                        <span class="badge" style="background-color:rgb(226, 68, 92)">Con
                                            retraso</span>
                                    @break
                                    @case ('STATUS_SUSPENDED')
                                        <span class="badge" style="background-color:#aaaaaa">Suspendida</span>
                                    @break
                                    @case ('STATUS_UNDEFINED')
                                        <span class="badge" style="background-color:#00b1e1">Sin iniciar</span>
                                    @break
                                    @default
                                        <span class="badge" style="background-color:#00b1e1">Sin iniciar</span>
                                @endswitch
                            </td>
                            <td class="d-flex">
                                @php
                                    if (intval($task->parent_id) == 1) {
                                        $ruta = '/admin/planTrabajoBase/';
                                    } else {
                                        $ruta = '/admin/planes-de-accion/' . $task->parent_id;
                                    }
                                @endphp
                                <a href="{{ asset($ruta) }}"><i class="far fas fa-stream" style="font-size:12pt"></i></a>
                                <a href="plantTrabajoBase/{{ $task->name }}" target="_blank"><i
                                        class="fas fa-eye" style="font-size:12pt"></i></a>
                                @if ($task->status == 'STATUS_DONE' or $task->status == 'STATUS_SUSPENDED')
                                    <button class="btn_archivar" title="Archivar" data-toggle="modal"
                                        data-target="#alert_activ{{ $task->id }}">
                                        <i class="fas fa-archive" style="font-size:12pt" ></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
