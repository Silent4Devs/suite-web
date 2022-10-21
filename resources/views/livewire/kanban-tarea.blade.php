<div>
    <div class="w-100" id="contendor-principal-actividades" x-data="{ show: false }">
        <div class="row mb-4 align-items-center">
            <div class="col-12 pr-2" x-bind:class="show ? 'col-12' : 'col-12'" style="text-align:right;">
                <span class="mr-2" x-bind:class="!show ? 'menu-active' : ''" title="Visualizar Tarjetas"
                    style="font-size: 1.1rem;cursor: pointer;" x-on:click="show=false"><i class="fas fa-th"></i></span>
                <span class="mr-2" style="font-size: 1.1rem;cursor: pointer;" x-bind:class="show ? 'menu-active' : ''"
                    x-on:click="handdleClick" title="Visualizar Tabla"><i class="fas fa-th-list"></i></span>
            </div>
        </div>
        <div class="row" id="cardTasks" x-show="!show" x-transition:enter.duration.500ms
            x-transition:leave.duration.400ms>

            @forelse ($tareas as $tarea)
                <div class="col-4">
                    <div class="card" style="box-shadow: none;">
                        <div class="card-body p-2">
                            <div style="position: relative">
                                <i class="fas fa-house"></i> {{ $tarea->group->planAccion->title }} /
                                {{ $tarea->title }}
                                <span style="position: absolute;top: 0px;right: 0;">
                                    @livewire('evidencia-task-kanban', ['taskId' => $tarea->id], key($tarea->id))
                                </span>
                            </div>
                            <div class="text-center pt-2">
                                <strong style="font-size: 20px;">{{ $tarea->title }}</strong>
                            </div>
                            <div class="py-2">
                                <select name="" class="form-control select-tarea" tarea-id="{{ $tarea->id }}">
                                    @foreach ($tarea->group->planAccion->groups as $group)
                                        <option value="{{ $group->id }}" tarea-id="{{ $tarea->id }}"
                                            {{ $tarea->group->id == $group->id ? 'selected' : '' }}>
                                            {{ $group->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <p class="m-0">
                                    <small>
                                        Fecha: {{ $tarea->fecha_inicio ?? 'N/A' }} / {{ $tarea->fecha_fin ?? 'N/A' }}
                                    </small>
                                </p>
                                <p class="m-0">
                                    <small>
                                        Fecha de creción: {{ $tarea->created_at->diffForHumans() }}
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center">
                    <p>NO TIENES ACTIVIDADES ASIGNADAS</p>
                    <img src="{{ asset('img/empleados_no_encontrados.svg') }}" alt="" class="img-fluid"
                        style="max-width: 350px">
                </div>
            @endforelse
        </div>
        <div x-show="show" x-transition:enter.duration.500ms x-transition:leave.duration.400ms class="w-100">
            <table class="table" id="tableTasks">
                <thead>
                    <td>Plan Acción</td>
                    <td>Tarea</td>
                    <td>Estatus</td>
                    <td>Fecha Inicio</td>
                    <td>Fecha Fin</td>
                    <td>Creación</td>
                    <td>Opciones</td>
                </thead>
                <tbody>
                    @foreach ($tareas as $tarea)
                        <tr>
                            <td><span class="badge badge-primary">{{ $tarea->group->planAccion->title }}</span></td>
                            <td>{{ $tarea->title }}</td>
                            <td>
                                <select name="" class="form-control select-tarea"
                                    tarea-id="{{ $tarea->id }}">
                                    @foreach ($tarea->group->planAccion->groups as $group)
                                        <option value="{{ $group->id }}" tarea-id="{{ $tarea->id }}"
                                            {{ $tarea->group->id == $group->id ? 'selected' : '' }}>
                                            {{ $group->label }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>{{ $tarea->fecha_inicio ?? 'N/A' }}</td>
                            <td>{{ $tarea->fecha_fin ?? 'N/A' }}</td>
                            <td>{{ $tarea->created_at->diffForHumans() }}</td>
                            <td>
                                @livewire('evidencia-task-kanban', ['taskId' => $tarea->id], key($tarea->id))
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('tableTasks').addEventListener('change', (e) => {
                if (e.target.classList.contains('select-tarea')) {
                    let groupId = e.target.value;
                    let taskId = e.target.getAttribute('tarea-id');
                    @this.taskGroupChange(taskId, groupId);
                }
            })
            document.getElementById('cardTasks').addEventListener('change', (e) => {
                if (e.target.classList.contains('select-tarea')) {
                    let groupId = e.target.value;
                    let taskId = e.target.getAttribute('tarea-id');
                    @this.taskGroupChange(taskId, groupId);
                }
            })
        });
    </script>

</div>
