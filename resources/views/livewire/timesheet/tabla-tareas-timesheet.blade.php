<div class="w-100">
    @can('timesheet_administrador_tareas_proyectos_create')
        <form wire:submit.prevent="create()" class="form-group w-100">
            <div class="d-flex justify-content-center w-100">
                <div class="form-group w-100 mr-4 ">
                    <label><i class="fas fa-list iconos-crear"></i> Proyecto</label>
                    @if ($origen == 'tareas-proyectos')
                        <div class="form-control" style="background-color: #eee">{{ $proyecto_seleccionado->proyecto }}
                        </div>
                    @endif
                    @if ($origen == 'tareas')
                        <select class="mr-4 form-control" wire:model="proyecto_id" required>
                            <option selected value="">Seleccione proyecto al que pertenece</option>
                            @foreach ($proyectos as $proyecto)
                                <option value="{{ $proyecto->id }}">{{ $proyecto->proyecto }}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
                <div class="form-group w-100 mr-4">
                    <label><i class="fas fa-list-alt iconos-crear"></i> Tarea Nueva</label>
                    <input class="form-control w-100 mr-4" placeholder="Nombre de la tarea" wire:model="tarea_name" required>
                </div>
                <div class="form-group" style="position:relative; min-width:150px;">
                    <button class="btn btn-success" style="position: absolute; bottom: 0;"><i class="fas fa-plus"></i>
                        Agregar</button>
                </div>
            </div>
        </form>
    @endcan
    <div class="datatable-fix w-100 mt-5">
        <table id="tabla_time_tareas" class="table w-100 tabla-animada">
            <thead class="w-100">
                <tr>
                    <th>Tarea </th>
                    <th>Proyecto</th>
                    <th style="max-width: 150px; width: 150px;">Opciones</th>
                </tr>
            </thead>

            <tbody>
                @if ($origen == 'tareas')
                    @foreach ($tareas as $tarea)
                        <tr>
                            <td> {{ $tarea->tarea }} </td>
                            <td> {{ $tarea->proyecto_id ? $tarea->proyecto->proyecto : '' }} </td>
                            <td>
                                @can('timesheet_administrador_tareas_proyectos_delete')
                                    <i class="fas fa-trash-alt btn" wire:click="destroy({{ $tarea->id }})"
                                        style="color: red; font-size: 15pt;" title="Eliminar"></i>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                @endif

                @if ($origen == 'tareas-proyectos')
                    @foreach ($tareas_proyecto as $tarea)
                        <tr>
                            <td> {{ $tarea->tarea }} </td>
                            <td> {{ $tarea->proyecto_id ? $tarea->proyecto->proyecto : '' }} </td>
                            <td>
                                <i class="fas fa-trash-alt btn" wire:click="destroy({{ $tarea->id }})"
                                    style="color: red; font-size: 15pt;" title="Eliminar"></i>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', ()=>{
            Livewire.on('scriptTabla', ()=>{
                tablaLivewire('tabla_time_tareas');
            });
        });
    </script>
</div>
