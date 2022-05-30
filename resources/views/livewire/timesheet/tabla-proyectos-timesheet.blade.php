<div class="w-100">
    @php
        use App\Models\TimesheetHoras;
    @endphp
    @can('timesheet_administrador_proyectos_create')
    <div class="w-100">
        <h5 id="titulo_estatus">Crear Proyecto</h5>
    </div>
        <form wire:submit.prevent="store()" class="w-100">
            <div class="row mt-4">
                
            </div>
            <div class="row">
                <div class="form-group col-md-2">
                    <label><i class="fas fa-list iconos-crear"></i> ID</label>
                    <input name="identificador" wire:model="identificador" class="form-control" required>
                    @if($errors->has('identificador'))
                        <div class="invalid-feedback">
                            {{ $errors->first('identificador') }}
                        </div>
                    @endif
                    @error('identificador')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label><i class="fas fa-list iconos-crear"></i> Nombre del proyecto</label>
                    <input name="proyecto" wire:model="proyecto_name" class="form-control" required>
                </div>
                <div class="form-group col-md-2">
                    <label class="form-label"><i class="fa-solid fa-calendar-day iconos-crear"></i> Fecha de inicio</label>
                    <input type="date" name="fecha_inicio" wire:model="fecha_inicio" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label class="form-label"><i class="fa-solid fa-calendar-day iconos-crear"></i> Fecha de termino</label>
                    <input type="date" name="fecha_fin" wire:model="fecha_fin" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label><i class="fa-solid fa-bag-shopping iconos-crear"></i> Cliente</label>
                    <select name="area_id" wire:model="cliente_id" class="form-control">
                        <option selected disabled>Seleccione cliente</option>
                        <option value="">Sin cliente</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label><i class="fab fa-adn iconos-crear"></i> Área(s) participante(s)</label>
                    <select name="area_id" wire:model="area_id" class="form-control" required>
                        <option selected value="">Seleccione área</option>
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->area }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label class="form-label"><i class="fa-solid fa-building iconos-crear"></i>Sede</label>
                    <select class="form-control" name="sede_id" wire:model="sede_id">
                        <option selected value="">Seleccione sede</option>
                        @foreach($sedes as $sede)
                            <option value="{{ $sede->id }}">{{ $sede->sede }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-12 text-right">
                    <button class="btn btn-success"><i class="fas fa-plus"></i> Agregar</button>
                </div>
            </div>
        </form>
    @endcan

    
    <div class="w-100 d-flex justify-content-between mt-5">
        <h5 id="titulo_estatus">Registros</h5>
        <div class="btn_estatus_caja">
            <button class="btn btn-primary ml-3" style="background-color: #F48C16; border:none !important; position: relative;" id="btn_todos" wire:click="procesos">
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
            <button class="btn btn-primary ml-3" style="background-color: #61CB5C; border:none !important; position: relative;" id="btn_pendiente" wire:click="terminados">
                @if($terminado_count > 0)
                    <span class="indicador_numero" style="filter: contrast(200%);">{{ $terminado_count }}</span>
                @endif
                Terminados
            </button>
            <button class="btn btn-primary ml-3" style="background-color: #1E88D7; border:none !important; position: relative;" id="btn_pendiente" wire:click="todos">
                <span class="indicador_numero" style="filter: contrast(200%);">{{ $terminado_count + $proceso_count + $cancelado_count }}</span>
                Todos
            </button>
        </div>
    </div>
    <div class="datatable-fix w-100 mt-4">
        <table id="datatable_timesheet_proyectos" class="table w-100 tabla-animada">
            <thead class="w-100">
                <tr>
                    <th>ID </th>
                    <th>Nombre del proyecto </th>
                    <th>Fecha inicio </th>
                    <th>Fecha termino</th>
                    <th>Cliente</th>
                    <th>Área(s)</th>
                    <th>Sede</th>
                    <th>Estatus</th>
                    <th style="max-width:150px !important; width:150px ;">Opciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($proyectos as $proyecto)
                    <tr>
                        <td>{{ $proyecto->identificador }} </td>
                        <td>{{ $proyecto->proyecto }} </td>
                        <td>{{ $proyecto->fecha_inicio }} </td>
                        <td>{{ $proyecto->fecha_fin }} </td>
                        <td>{{ $proyecto->cliente_id ? $cliente->nombre : '' }} </td>
                        <td>{{ $proyecto->area_id ? $proyecto->area->area : '' }} </td>
                        <td>{{ $proyecto->sede_id ? $proyecto->sede->sede : '' }} </td>
                        <td>{{ $proyecto->estatus }} </td>
                        <td>
                            @can('timesheet_administrador_proyectos_delete')
                                @php
                                    $time_proyecto = TimesheetHoras::where('proyecto_id', $proyecto->id)->exists();
                                @endphp
                                @if($time_proyecto)
                                    <button class="btn" data-toggle="modal" data-target="#modal_proyecto_eliminar_{{ $proyecto->id}}">
                                            <i class="fas fa-trash-alt" style="color: red; font-size: 15pt;" title="Eliminar"></i>
                                    </button>
                                @endif
                            @endcan
                            @can('timesheet_administrador_tareas_proyectos_access')
                                <a href="{{ route('admin.timesheet-tareas-proyecto', $proyecto->id) }}" class="btn">
                                    <i class="fas fa-list-alt" style="color:#888; font-size: 15pt;"
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
                                <i class="fa-solid fa-signal" style="color: #61CB5C; font-size:60pt;"></i>
                                <h1 class="my-4" style="font-size:14pt;">Cambiar Estatus de Proyecto: <small>{{ $proyecto->proyecto }}</small></h1>
                                <p class="parrafo">Seleccione el estatus del proyecto</p>
                            </div>
                            
                            <div class="mt-4 d-flex justify-content-between">
                                @if($proyecto->estatus != 'cancelado')
                                    <button class="btn btn-info" style="border:none; background-color:#aaa;" wire:click="cancelarProyecto({{ $proyecto->id}})" data-dismiss="modal">
                                        <i class="fa-solid fa-calendar-xmark iconos_crear"></i>
                                        Cancelar Proyecto
                                    </button>
                                @endif
                                @if($proyecto->estatus != 'terminado')
                                    <button class="btn btn-info" style="border:none; background-color:#61CB5C;" wire:click="terminarProyecto({{ $proyecto->id}})" data-dismiss="modal">
                                        <i class="fas fa-calendar-check iconos_crear"></i>
                                        Proyecto Terminado
                                    </button>
                                @endif
                                @if($proyecto->estatus != 'proceso')
                                    <button class="btn btn-info" style="border:none; background-color:#F48C16;" wire:click="procesoProyecto({{ $proyecto->id}})" data-dismiss="modal">
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

        <div class="modal fade" id="modal_proyecto_eliminar_{{ $proyecto->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button class="btn btn-tache-cerrar" data-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
                        <div class="delete">
                            <div class="text-center">
                                <i class="fa-solid fa-trash-can" style="color: #E34F4F; font-size:60pt;"></i>
                                <h1 class="my-4" style="font-size:14pt;">Eliminar Proyecto: <small>{{ $proyecto->proyecto }}</small></h1>
                                <p class="parrafo">¿Desea eliminar el proyecto {{ $proyecto->proyecto }}?</p>
                            </div>
                            
                            <div class="mt-4 d-flex justify-content-between">
                                <button class="btn btn_cancelar" data-dismiss="modal">
                                    Cancelar
                                </button>
                                <button class="btn btn-info" style="border:none; background-color:#E34F4F;"  wire:click="destroy({{ $proyecto->id }})" data-dismiss="modal">
                                    Eliminar Proyecto
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', ()=>{
            Livewire.on('scriptTabla', ()=>{
                tablaLivewire('datatable_timesheet_proyectos');
            });
        });
    </script>
</div>
