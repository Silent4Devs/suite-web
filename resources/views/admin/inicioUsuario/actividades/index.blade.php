<div class="w-100" id="contendor-principal-actividades" x-data="{show:false}">
    <div class="row mb-4 align-items-center">
        <div class="col-12 pr-2" x-bind:class="show?'col-12':'col-12'" style="text-align:right;">
            <span class="mr-2" x-bind:class="!show?'menu-active':''" title="Visualizar Tarjetas"
                style="font-size: 1.1rem;cursor: pointer;" x-on:click="show=false"><i class="fas fa-th"></i></span>
            <span class="mr-2" style="font-size: 1.1rem;cursor: pointer;" x-bind:class="show?'menu-active':''"
                x-on:click="handdleClick" title="Visualizar Tabla"><i class="fas fa-th-list"></i></span>
        </div>
    </div>
    <div class="row mb-4" x-show="!show" x-transition:enter.duration.500ms x-transition:leave.duration.400ms>
        <div class="col-12">
            <div class="cards-actividades row" id="cards-actividades"></div>
            <div class="row" id="cards-actividades2">
                @php
                    $allArchived = true;
                @endphp
                @foreach ($actividades as $index => $task)
                    @php
                        
                        if (isset($task->archivado)) {
                            $archivado = $task->archivado;
                            if (!$task->archivado) {
                                $allArchived = false;
                            }
                        } else {
                            $archivado = false;
                            $allArchived = false;
                        }
                    @endphp
                    @if (!$archivado)
                        <div class="col-4 mb-4">
                            <div id="carouselActividad{{ $task->id }}" class="carousel slide rounded p-2 bg-white"
                                style="height: 100%;" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="row">
                                            <div class="col-12" style="text-align: right">
                                                @php
                                                    if (intval($task->parent_id) == 1) {
                                                        $ruta = '/admin/planTrabajoBase/';
                                                    } else {
                                                        $ruta = '/admin/planes-de-accion/' . $task->parent_id;
                                                    }
                                                @endphp
                                                <a title="Abrir Plan de Implementación" href="{{ asset($ruta) }}"><i
                                                        class="far fas fa-stream"></i></a>
                                                <a title="Visualizar Actividad"
                                                    href="plantTrabajoBase/{{ $task->name }}" target="_blank"><i
                                                        class="fas fa-eye" style="font-size:12pt;"></i></a>
                                                @if ($task->status == 'STATUS_DONE' or $task->status == 'STATUS_FAILED')
                                                    <button title="Archivar" class="btn_archivar" title="Archivar">
                                                        <i class="fas fa-archive" data-archivar="true"
                                                            style="cursor: pointer"
                                                            data-actividad-id="{{ $task->id }}"
                                                            data-plan-implementacion="{{ $task->id_implementacion }}"></i>
                                                    </button>
                                                @endif
                                            </div>
                                            <div class="deben-aprobar-card w-100">
                                                <div class="px-4">
                                                    <div class="row align-items-center">
                                                        <div class="col-12">
                                                            <h6 class="card-title text-center"
                                                                style="text-transform: capitalize;">
                                                                @if ($task->status == 'STATUS_DONE')
                                                                    <i class="far fa-check-circle mr-1 text-success"
                                                                        style="font-size: 18px;position: absolute;top: -22px;left: 15px;"></i>
                                                                @elseif ($task->status == 'STATUS_ACTIVE')
                                                                    <i class="fas fa-info-circle mr-1 text-primary"
                                                                        style="font-size: 18px;position: absolute;top: -22px;left: 15px;"></i>
                                                                @elseif ($task->status == 'STATUS_SUSPENDED')
                                                                    <i class="far fa-question-circle mr-1 text-muted"
                                                                        style="font-size: 18px;position: absolute;top: -22px;left: 15px;"></i>
                                                                @elseif ($task->status == 'STATUS_WAITING')
                                                                    <i class="fas fa-clock mr-1 text-warning"
                                                                        style="font-size: 18px;position: absolute;top: -22px;left: 15px;"></i>
                                                                @elseif ($task->status == 'STATUS_UNDEFINED')
                                                                    <i class="far fa-question-circle mr-1 text-muted"
                                                                        style="font-size: 18px;position: absolute;top: -22px;left: 15px;"></i>
                                                                @elseif ($task->status == 'STATUS_FAILED')
                                                                    <i class="far fa-times-circle mr-1 text-danger"
                                                                        style="font-size: 18px;position: absolute;top: -22px;left: 15px;"></i>
                                                                @endif
                                                                {{ Str::limit($task->name, 52, '...') }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                    <select class="form-control" data-status="on"
                                                        data-actividad-id="{{ $task->id }}"
                                                        data-last-selection="{{ $task->status }}"
                                                        data-plan-implementacion="{{ $task->id_implementacion }}">
                                                        <option value="STATUS_SUSPENDED"
                                                            {{ $task->status == 'STATUS_SUSPENDED' ? 'selected' : '' }}>
                                                            Suspendida
                                                        </option>
                                                        <option value="STATUS_FAILED"
                                                            {{ $task->status == 'STATUS_FAILED' ? 'selected' : '' }}>
                                                            Con retraso</option>
                                                        <option value="STATUS_UNDEFINED"
                                                            {{ $task->status == 'STATUS_UNDEFINED' ? 'selected' : '' }}>
                                                            Sin iniciar
                                                        </option>
                                                        <option value="STATUS_ACTIVE"
                                                            {{ $task->status == 'STATUS_ACTIVE' ? 'selected' : '' }}>
                                                            En proceso</option>
                                                        <option value="STATUS_DONE"
                                                            {{ $task->status == 'STATUS_DONE' ? 'selected' : '' }}>
                                                            Completada</option>
                                                    </select>
                                                    {{-- @switch($task->status)
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
                                                            <p class="m-0" style="font-size: 12px;color:#00b1e1">
                                                                Sin
                                                                iniciar</p>
                                                        @break
                                                        @default
                                                            <p class="m-0" style="font-size: 12px;color:#00b1e1">Sin
                                                                iniciar</p>
                                                    @endswitch --}}
                                                    <br>
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
                    @endif
                @endforeach
                @if ($allArchived)
                    <div class="col-12 text-center" id="sinActividades">
                        <p><strong style="text-transform: capitalize">Sin Actividades</strong></p>
                        <img class="img-fluid" src="{{ asset('img/empleados_no_encontrados.svg') }}"
                            alt="Sin Actividades" width="300">
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div x-show="show" x-transition:enter.duration.500ms x-transition:leave.duration.400ms class="w-100">
        <table id="tabla_usuario_actividades" class="table w-100">
            <thead>
                <tr>
                    <th>Actividad</th>
                    <th>Origen</th>
                    <th>Fecha&nbsp;inicio</th>
                    <th>Fecha&nbsp;fin</th>
                    <th>Compartida&nbsp;con</th>
                    <th>Estatus&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($actividades as $task)
                    @php
                        if (isset($task->archivado)) {
                            $archivado = $task->archivado;
                        } else {
                            $archivado = false;
                        }
                    @endphp
                    @if (!$archivado)
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
                                <select class="form-control" data-status="on" data-actividad-id="{{ $task->id }}"
                                    data-last-selection="{{ $task->status }}"
                                    data-plan-implementacion="{{ $task->id_implementacion }}">
                                    <option value="STATUS_SUSPENDED"
                                        {{ $task->status == 'STATUS_SUSPENDED' ? 'selected' : '' }}>Suspendida
                                    </option>
                                    <option value="STATUS_FAILED"
                                        {{ $task->status == 'STATUS_FAILED' ? 'selected' : '' }}>Con retraso</option>
                                    <option value="STATUS_UNDEFINED"
                                        {{ $task->status == 'STATUS_UNDEFINED' ? 'selected' : '' }}>Sin iniciar
                                    </option>
                                    <option value="STATUS_ACTIVE"
                                        {{ $task->status == 'STATUS_ACTIVE' ? 'selected' : '' }}>En proceso</option>
                                    <option value="STATUS_DONE"
                                        {{ $task->status == 'STATUS_DONE' ? 'selected' : '' }}>
                                        Completada</option>
                                </select>
                                {{-- @switch($task->status)
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
                                @endswitch --}}
                            </td>
                            <td class="d-flex">
                                @php
                                    if (intval($task->parent_id) == 1) {
                                        $ruta = '/admin/planTrabajoBase/';
                                    } else {
                                        $ruta = '/admin/planes-de-accion/' . $task->parent_id;
                                    }
                                @endphp
                                <a href="{{ asset($ruta) }}"><i class="far fas fa-stream" style="font-size:12pt"
                                        title="Abrir Plan de Implementación"></i></a>
                                <a href="plantTrabajoBase/{{ $task->name }}" target="_blank"><i
                                        class="fas fa-eye" style="font-size:12pt"
                                        title="Visualizar Actividad"></i></a>
                                @if ($task->status == 'STATUS_DONE' or $task->status == 'STATUS_SUSPENDED')
                                    <button class="btn_archivar" title="Archivar" title="Archivar Actividad">
                                        <i class="fas fa-archive" data-archivar="true"
                                            data-actividad-id="{{ $task->id }}"
                                            data-plan-implementacion="{{ $task->id_implementacion }}"
                                            style="font-size:12pt"></i>
                                    </button>
                                    {{-- <button class="btn_archivar" id="btnArchivarActividad" title="Archivar"
                                        data-toggle="modal" data-target="#alert_activ{{ $task->id }}">
                                        <i class="fas fa-archive" style="font-size:12pt"></i>
                                    </button> --}}
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    function handdleClick(e) {
        this.show = true;
        setTimeout(() => {
            $.fn.dataTable.tables({
                visible: true,
                api: true
            }).columns.adjust();
        }, 400);
    }
    document.addEventListener('DOMContentLoaded', () => {
        const tblActivudadesEmpleado = document.getElementById('tabla_usuario_actividades');
        const cardActividades = document.getElementById('cards-actividades2');
        tblActivudadesEmpleado.addEventListener('change', async (e) => {
            if (e.target.tagName == 'SELECT') {
                if (e.target.getAttribute('data-status') == 'on') {
                    const estatusSeleccionado = e.target.value;
                    const actividadID = e.target.getAttribute('data-actividad-id');
                    const planImplementacionID = e.target.getAttribute('data-plan-implementacion');
                    const seleccionAnterior = e.target.getAttribute('data-last-selection');
                    const formData = new FormData();
                    formData.append('taskID', actividadID);
                    formData.append('planImplementacionID', planImplementacionID);
                    formData.append('estatusSeleccionado', estatusSeleccionado);
                    if (estatusSeleccionado == 'STATUS_ACTIVE') {
                        const {
                            value: progreso
                        } = await Swal.fire({
                            title: 'Progreso Alcanzado',
                            showCancelButton: true,
                            confirmButtonText: "Cambiar Estatus",
                            cancelButtonText: "Cancelar",
                            input: 'number',
                            inputLabel: 'Ingresa el progreso, en un rango de 1-99',
                            inputPlaceholder: 'Progreso',
                            inputAttributes: {
                                min: 1,
                                max: 99,
                            },
                            inputValidator: (value) => {
                                if (value > 99) {
                                    return 'Debes de ingresar un número en el rango de 1 a 99'
                                }
                                if (value < 1) {
                                    return 'Debes de ingresar un número en el rango de 1 a 99'
                                }
                            },
                        })
                        if (progreso) {
                            formData.append('progreso', progreso);
                            toastr.info('Actualizando el estatus');
                            const url =
                                "{{ route('admin.inicio-Usuario.actividades.cambiarEstatusActividad') }}"
                            const response = await fetch(url, {
                                method: "POST",
                                body: formData,
                                headers: {
                                    Accept: "application/json",
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                        .attr(
                                            'content'),
                                },
                            })
                            const data = await response.json();
                            if (data.success) {
                                toastr.success('Estatus Actualizado');
                                window.location.reload();
                            }
                        } else {
                            e.target.value = seleccionAnterior;
                        }
                    } else {
                        toastr.info('Actualizando el estatus');
                        const url =
                            "{{ route('admin.inicio-Usuario.actividades.cambiarEstatusActividad') }}"
                        const response = await fetch(url, {
                            method: "POST",
                            body: formData,
                            headers: {
                                Accept: "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr(
                                        'content'),
                            },
                        })
                        const data = await response.json();
                        if (data.success) {
                            toastr.success('Estatus Actualizado');
                            window.location.reload();
                        }
                    }

                }
            }
        })
        cardActividades.addEventListener('change', async (e) => {
            if (e.target.tagName == 'SELECT') {
                if (e.target.getAttribute('data-status') == 'on') {
                    const estatusSeleccionado = e.target.value;
                    const actividadID = e.target.getAttribute('data-actividad-id');
                    const planImplementacionID = e.target.getAttribute('data-plan-implementacion');
                    const seleccionAnterior = e.target.getAttribute('data-last-selection');
                    console.log(seleccionAnterior);
                    const formData = new FormData();
                    formData.append('taskID', actividadID);
                    formData.append('planImplementacionID', planImplementacionID);
                    formData.append('estatusSeleccionado', estatusSeleccionado);
                    if (estatusSeleccionado == 'STATUS_ACTIVE') {
                        const {
                            value: progreso
                        } = await Swal.fire({
                            title: 'Progreso Alcanzado',
                            showCancelButton: true,
                            confirmButtonText: "Cambiar Estatus",
                            cancelButtonText: "Cancelar",
                            input: 'number',
                            inputLabel: 'Ingresa el progreso, en un rango de 1-99',
                            inputPlaceholder: 'Progreso',
                            inputAttributes: {
                                min: 1,
                                max: 99,
                            },
                            inputValidator: (value) => {
                                if (value > 99) {
                                    return 'Debes de ingresar un número en el rango de 1 a 99'
                                }
                                if (value < 1) {
                                    return 'Debes de ingresar un número en el rango de 1 a 99'
                                }
                            },
                        })
                        console.log(progreso);
                        if (progreso) {
                            formData.append('progreso', progreso);
                            toastr.info('Actualizando el estatus');
                            const url =
                                "{{ route('admin.inicio-Usuario.actividades.cambiarEstatusActividad') }}"
                            const response = await fetch(url, {
                                method: "POST",
                                body: formData,
                                headers: {
                                    Accept: "application/json",
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                        .attr(
                                            'content'),
                                },
                            })
                            const data = await response.json();
                            if (data.success) {
                                toastr.success('Estatus Actualizado');
                                window.location.reload();
                            }
                        } else {
                            e.target.value = seleccionAnterior;
                        }

                    } else {
                        toastr.info('Actualizando el estatus');
                        const url =
                            "{{ route('admin.inicio-Usuario.actividades.cambiarEstatusActividad') }}"
                        const response = await fetch(url, {
                            method: "POST",
                            body: formData,
                            headers: {
                                Accept: "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr(
                                        'content'),
                            },
                        })
                        const data = await response.json();
                        if (data.success) {
                            toastr.success('Estatus Actualizado');
                            window.location.reload();
                        }
                    }

                }
            }
        })
    })
</script>
