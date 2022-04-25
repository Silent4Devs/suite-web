<div class="w-100">
    @can('timesheet_administrador_proyectos_create')
        <form wire:submit.prevent="create()" class="form-group w-100">
            <div class="d-flex justify-content-center w-100">
                <div class="form-group w-100 mr-4">
                    <label><i class="fas fa-list iconos-crear"></i> Proyecto Nuevo</label>
                    <input name="proyecto" wire:model="proyecto_name" class="form-control" required>
                </div>
                <div class="form-group w-100 mr-4">
                    <label><i class="fab fa-adn iconos-crear"></i> Área</label>
                    <select name="area_id" wire:model="area_id" class="form-control" required>
                        <option selected value="">Seleccione área</option>
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->area }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group w-100 mr-4">
                    <label><i class="fa-solid fa-bag-shopping iconos-crear"></i> Cliente</label>
                    <select name="area_id" wire:model="cliente_id" class="form-control">
                        <option selected disabled>Seleccione cliente</option>
                        <option value="">Sin cliente</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="position:relative; min-width:150px;">
                    <button class="btn btn-success" style="position: absolute; bottom: 0;"><i class="fas fa-plus"></i>
                        Agregar</button>
                </div>
            </div>
        </form>
    @endcan

    
    <div class="w-100 d-flex justify-content-between">
        <h5 id="titulo_estatus">Registros</h5>
        <div class="btn_estatus_caja">
            <button class="btn btn-primary ml-3" style="background-color: #1ED726; border:none !important; position: relative;" id="btn_todos" wire:click="procesos">
                @if($proceso_count > 0)
                    <span class="indicador_numero" style="filter: contrast(200%);">{{ $proceso_count }}</span>
                @endif
                En Proceso
            </button>
            <button class="btn btn-primary ml-3" style="background-color: #aaa; border:none !important; position: relative;" id="btn_papelera" wire:click="cancelados">
                @if($cancelado_count > 0)
                    <span class="indicador_numero" style="filter: contrast(200%);">{{ $cancelado_count }}</span>
                @endif
                Cancelados
            </button>
            <button class="btn btn-primary ml-3" style="background-color: #1EC6D7; border:none !important; position: relative;" id="btn_pendiente" wire:click="terminados">
                @if($terminado_count > 0)
                    <span class="indicador_numero" style="filter: contrast(200%);">{{ $terminado_count }}</span>
                @endif
                Terminados
            </button>
            <button class="btn btn-primary ml-3" style="background-color: #1E88D7; border:none !important; position: relative;" id="btn_pendiente" wire:click="todos">
                Todos
            </button>
        </div>
    </div>
    <div class="datatable-fix w-100 mt-5">
        <table id="datatable_timesheet_proyectos" class="table w-100 tabla-animada">
            <thead class="w-100">
                <tr>
                    <th>Proyecto </th>
                    <th>Área a la que pertenece</th>
                    <th>Cliente</th>
                    <th>Estatus</th>
                    <th style="max-width:150px !important; width:150px ;">Opciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($proyectos as $proyecto)
                    <tr>
                        <td>{{ $proyecto->proyecto }} </td>
                        <td>{{ $proyecto->area_id ? $proyecto->area->area : '' }} </td>
                        <td>{{ $proyecto->cliente_id ? $cliente->nombre : '' }} </td>
                        <td>{{ $proyecto->estatus }} </td>
                        <td>
                            @can('timesheet_administrador_proyectos_delete')
                                <i class="fas fa-trash-alt btn" wire:click="destroy({{ $proyecto->id }})"
                                    style="color: red; font-size: 15pt;" title="Eliminar"></i>
                            @endcan
                            @can('timesheet_administrador_tareas_proyectos_access')
                                <a href="{{ route('admin.timesheet-tareas-proyecto', $proyecto->id) }}">
                                    <i class="fas fa-list-alt btn" style="color:#888; font-size: 15pt;"
                                        title="Tareas de {{ $proyecto->proyecto }}"></i>
                                </a>
                            @endcan
                            <button class="btn" data-toggle="modal" data-target="#modal_proyecto_{{ $proyecto->id}}"><i class="fa-solid fa-signal"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @foreach ($proyectos as $proyecto)
        <div class="modal fade" id="modal_proyecto_{{ $proyecto->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button class="btn btn-tache-cerrar" data-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
                        <div class="delete">
                            <div class="text-center">
                                <i class="fa-solid fa-signal" style="color: #34B6DC; font-size:60pt;"></i>
                                <h1 class="my-4" style="font-size:14pt;">Cambiar Estatus de Proyecto: <small>{{ $proyecto->proyecto }}</small></h1>
                                <p class="parrafo">Seleccione el estatus del proyecto</p>
                            </div>
                            
                            <div class="mt-4 d-flex justify-content-between">
                                @if($proyecto->estatus != 'cancelado')
                                    <button title="Rechazar" class="btn btn-info" style="border:none; background-color:#aaa;" wire:click="cancelarProyecto({{ $proyecto->id}})" data-dismiss="modal">
                                        <i class="fa-solid fa-calendar-xmark iconos_crear"></i>
                                        Cancelar Proyecto
                                    </button>
                                @endif
                                @if($proyecto->estatus != 'terminado')
                                    <button title="Rechazar" class="btn btn-info" style="border:none; background-color:#34B6DC;" wire:click="terminarProyecto({{ $proyecto->id}})" data-dismiss="modal">
                                        <i class="fas fa-calendar-check iconos_crear"></i>
                                        Proyecto Terminado
                                    </button>
                                @endif
                                @if($proyecto->estatus != 'proceso')
                                    <button title="Rechazar" class="btn btn-info" style="border:none; background-color:#26D71E;" wire:click="procesoProyecto({{ $proyecto->id}})" data-dismiss="modal">
                                        <i class="fa-solid fa-calendar iconos_crear"></i>
                                        Proyecto en Proceso
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script type="text/javascript">
        // document.addEventListener('DOMContentLoaded', ()=>{
        //     Livewire.on('cerrarModal', ()=>{
        //         $('.modal-backdrop').modal('hide');
        //     });
        // });
    </script>
</div>
