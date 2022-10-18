<div style="zoom: 90%" class="p-4">
    <div class="p-2">
        <h4>
            Plan de Acción: {{ $planAccionModel->title }}
        </h4>
        <p>
            {{-- {{ $planAccionModel->description }} --}}
        </p>
    </div>
    <div class="d-flex" wire:sortable="updateGroupOrder" wire:sortable-group="updateTaskOrder"
        style="overflow: auto; z-index: 9999" id="lienzoKanban">
        @foreach ($groups as $group)
            <div class="border rounded p-3 mr-2" wire:key="group-{{ $group->id }}"
                wire:sortable.item="{{ $group->id }}" style="background: #F4F5F7; min-width: 300px;">
                <div style="display: flex; position: relative;">
                    <h4 style="font-size: 16px; width: 100%; position: relative;">{{ $group->label }}
                        @if (!$onlyRead)
                            <i class="fas fa-grip-vertical" style="position: absolute; right: 0; cursor: move"
                                wire:sortable.handle></i>
                        @endif
                    </h4>
                    @if (!$onlyRead)
                        <i style="cursor: pointer;position: absolute;right: 20px; top: 3px"
                            class="fas fa-trash-alt text-danger" group-id={{ $group->id }}></i>
                    @endif
                </div>
                <div class="list-group" style="min-height: 50px" wire:sortable-group.item-group="{{ $group->id }}">
                    @forelse ($group->tasks as $task)
                        <div wire:key="task-{{ $task->id }}" wire:sortable-group.item="{{ $task->id }}"
                            class="list-group-item mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <span style="font-size: 17px;font-weight: bold;">{{ $task->title }} </span>
                                </div>
                                <div class="col-6" style="text-align: end; font-size: 12px">
                                    @if (!$onlyRead)
                                        <i style="cursor: pointer" class="fas fa-trash-alt text-danger mr-2"
                                            task-id="{{ $task->id }}"></i>
                                        <i style="cursor: pointer" class="fas fa-pen text-primary mr-2"
                                            wire:click="editTask({{ $task->id }})"></i>
                                        <i class="fas fa-grip-vertical" style="cursor: move"
                                            wire:sortable-group.handle></i>
                                    @endif
                                </div>
                            </div>
                            <div class="row p-0 m-0">
                                <div class="col-6 p-0"></div>
                                <div class="col-6 p-0" style="text-align: end">
                                    <small>{{ $task->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            <div>
                                @forelse ($task->empleados as $empleado)
                                    <img style="clip-path: circle(15px at 50% 50%);height: 30px;"
                                        title="{{ $empleado->name }}" src="{{ $empleado->avatar_ruta }}"
                                        alt="{{ $empleado->name }}">
                                @empty
                                @endforelse
                            </div>
                            @if ($task->description)
                                <p class="mb-1">
                                    <small><strong>Descripción:</strong></small>
                                    <br>
                                    <small>{{ $task->description }}</small>
                                </p>
                            @endif
                            @if ($task->fecha_inicio)
                                <div>
                                    <small>
                                        <strong>Fecha de Inicio</strong>
                                    </small>
                                    <small>{{ $task->fecha_inicio }}</small>
                                </div>
                            @endif
                            @if ($task->fecha_fin)
                                <div>
                                    <small>
                                        <strong>Fecha de Fin</strong>
                                    </small>
                                    <small>{{ $task->fecha_fin }}</small>
                                </div>
                            @endif
                            {{-- <small>{{ $task->order }}</small> --}}
                        </div>
                    @empty
                        <div class="rounded" style="height: 50px;border: dotted 1px #3e3e3e;padding: 10px;">
                            Arrastra o crea la primer tarea
                        </div>
                    @endforelse
                </div>
                <form class="form-group mt-1" wire:submit.prevent="addTask({{ $group->id }})"
                    wire:key="task-group-{{ $group->id }}">
                    <div class="d-flex">
                        <input type="text" class="form-control @error('titleTask') is-invalid @enderror"
                            placeholder="Añadir tarea" wire:model.defer="titleTask">
                        <button class="btn btn-sm bodered"><i class="fas fa-plus"></i></button>
                    </div>
                    @error('titleTask')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </form>
            </div>
        @endforeach
        <form class="form-group" wire:submit.prevent="addGroup">
            <div style="width: 200px" class="d-flex">
                <input type="text" class="form-control @error('newGroupLabel') is-invalid @enderror"
                    wire:model.defer="newGroupLabel" placeholder="Añadir Grupo">
                <button class="btn btn-sm bodered"><i class="fas fa-plus"></i></button>
            </div>
            @error('newGroupLabel')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </form>
    </div>
    @livewire('modal-kanban-p-a', ['planAccionId' => $planAccionId])

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('lienzoKanban').addEventListener('click', (e) => {
                if (e.target.getAttribute('task-id')) {
                    Swal.fire({
                        title: '¿Estás seguro de eliminar esta tarea?',
                        text: "Este procedimiento es irreversible",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Eliminar',
                        cancelButtonText: 'Cancelar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let taskId = e.target.getAttribute('task-id');
                            @this.removeTask(taskId);
                        }
                    });
                }
                if (e.target.getAttribute('group-id')) {
                    Swal.fire({
                        title: '¿Estás seguro de eliminar este grupo?',
                        text: "Este procedimiento es irreversible",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Eliminar',
                        cancelButtonText: 'Cancelar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let groupId = e.target.getAttribute('group-id');
                            @this.removeGroup(groupId);
                        }
                    });
                }
            })
        })
    </script>
</div>
