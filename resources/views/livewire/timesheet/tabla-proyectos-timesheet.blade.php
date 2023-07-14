<div class="w-100">
    @php
        use App\Models\TimesheetHoras;
    @endphp
    <x-loading-indicator />
    @can('timesheet_administrador_proyectos_create')
        {{--  <div class="w-100">
            <h5 id="titulo_estatus">Crear Proyecto</h5>
        </div>
        <form wire:submit.prevent="store()" class="w-100">
            <div class="row">
                <div class="form-group col-md-2">
                    <label><i class="fas fa-list iconos-crear"></i> ID</label>
                    <input id="identificador_proyect" class="form-control" required>
                    @if ($errors->has('identificador'))
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
                    <input id="name_proyect" class="form-control" required>
                </div>
                <div class="form-group col-md-2">
                    <label class="form-label"><i class="fa-solid fa-calendar-day iconos-crear"></i> Fecha de inicio <small>(opcional)</small></label>
                    <input type="date" name="fecha_inicio" wire:model="fecha_inicio" class="form-control">
                    @if ($errors->has('fecha_inicio'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_inicio') }}
                        </div>
                    @endif
                    @error('fecha_inicio')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group col-md-2">
                    <label class="form-label"><i class="fa-solid fa-calendar-day iconos-crear"></i> Fecha de fin <small>(opcional)</small></label>
                    <input type="date" name="fecha_fin" wire:model="fecha_fin" class="form-control">
                    @if ($errors->has('fecha_fin'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_fin') }}
                        </div>
                    @endif
                    @error('fecha_fin')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group col-md-3">
                    <label><i class="fa-solid fa-bag-shopping iconos-crear"></i> Cliente</label>
                    <select name="area_id" wire:model.defer="cliente_id" class="form-control">
                        <option selected value="">Seleccione cliente</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->identificador }} - {{ $cliente->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3" wire:ignore id="caja_areas_seleccionadas_create">
                    <label><i class="fab fa-adn iconos-crear"></i> Área(s) participante(s)</label>
                    <select id="areas_seleccionadas" name="areas_seleccionadas" wire:model.defer="areas_seleccionadas"
                        class="form-control select2" required multiple required>
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->area }}</option>
                        @endforeach
                    </select>
                    <div class="mt-1">
                        <input id="chkall" type="checkbox" > Seleccionar Todas
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label class="form-label"><i class="fa-solid fa-building iconos-crear"></i>Sede</label>
                    <select class="form-control" name="sede_id" wire:model.defer="sede_id">
                        <option selected value="">Seleccione sede</option>
                        @foreach ($sedes as $sede)
                            <option value="{{ $sede->id }}">{{ $sede->sede }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label class="form-label"><i
                            class="fa-solid fa-info-circle iconos-crear"></i>Tipo</label>
                    <select class="form-control" name="tipo" wire:model.defer="tipo">
                        @foreach ($tipos as $tipo_it)
                            <option value="{{ $tipo_it }}" {{ $tipo == $tipo_it?'selected':'' }}>{{ $tipo_it }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-12 text-right">
                    <button class="btn btn-success"><i class="fas fa-plus"></i> Agregar</button>
                </div>
            </div>
        </form>  --}}
        <div class="text-right">
            <a href="{{ route('admin.timesheet-proyectos-create') }}" class="btn btn-success">Crear Proyecto</a>
        </div>
    @endcan

    <style type="text/css">
        .edit_modal .modal-dialog {
            max-width: 973px !important;
        }
    </style>

    <div class="w-100 d-flex justify-content-between mt-5">
        <h5 id="titulo_estatus">Registros</h5>
        <div class="btn_estatus_caja">
            <button class="btn btn-primary ml-3"
                style="background-color: #F48C16; border:none !important; position: relative;" id="btn_todos"
                wire:click="procesos">
                @if ($proceso_count > 0)
                    <span class="indicador_numero" style="filter: contrast(200%);">{{ $proceso_count }}</span>
                @endif
                En Proceso
            </button>
            <button class="btn btn-primary ml-3"
                style="background-color: #aaa; border:none !important; position: relative;" id="btn_papelera"
                wire:click="cancelados">
                @if ($cancelado_count > 0)
                    <span class="indicador_numero" style="filter: contrast(200%);">{{ $cancelado_count }}</span>
                @endif
                Cancelados
            </button>
            <button class="btn btn-primary ml-3"
                style="background-color: #61CB5C; border:none !important; position: relative;" id="btn_pendiente"
                wire:click="terminados">
                @if ($terminado_count > 0)
                    <span class="indicador_numero" style="filter: contrast(200%);">{{ $terminado_count }}</span>
                @endif
                Terminados
            </button>
            <button class="btn btn-primary ml-3"
                style="background-color: #1E88D7; border:none !important; position: relative;" id="btn_pendiente"
                wire:click="todos">
                <span class="indicador_numero"
                    style="filter: contrast(200%);">{{ $terminado_count + $proceso_count + $cancelado_count }}</span>
                Todos
            </button>
        </div>
    </div>
    @include('partials.flashMessages')
    <div class="datatable-fix w-100 mt-4">
        <table id="datatable_timesheet_proyectos" class="table w-100 tabla-animada">
            <thead class="w-100">
                <tr>
                    <th>ID </th>
                    <th>Nombre del proyecto </th>
                    <th>Fecha inicio </th>
                    <th>Fecha termino</th>
                    <th>Cliente</th>
                    <th style="max-width: 250px !important;">Área(s)</th>
                    <th>Sede</th>
                    <th>Estatus</th>
                    <th>Tipo</th>
                    <th style="max-width:150px !important; width:150px ;">Opciones</th>
                </tr>
            </thead>

            <tbody style="position:relative;">
                @foreach ($proyectos as $proyecto)
                    <tr>
                        <td>{{ $proyecto->identificador }} </td>
                        <td>{{ $proyecto->proyecto }} </td>
                        <td>{{ $proyecto->fecha_inicio }} </td>
                        <td>{{ $proyecto->fecha_fin }} </td>
                        <td>{{ $proyecto->cliente_id ? $proyecto->cliente->nombre : '' }} </td>
                        <td>
                            <ul style="padding-left:10px; ">
                                @foreach ($proyecto->areas as $area)
                                    <li>{{ $area->area }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $proyecto->sede_id ? $proyecto->sede->sede : '' }} </td>
                        <td>{{ $proyecto->estatus }} </td>
                        <td>{{ $proyecto->tipo??'No Definido' }} </td>
                        <td>
                            @can('timesheet_administrador_proyectos_delete')
                                @php
                                    $time_proyecto = TimesheetHoras::where('proyecto_id', $proyecto->id)->exists();
                                @endphp
                                @if (!$time_proyecto)
                                    <button class="btn" data-toggle="modal"
                                        data-target="#modal_proyecto_eliminar_{{ $proyecto->id }}">
                                        <i class="fas fa-trash-alt" style="color: red; font-size: 15pt;"
                                            title="Eliminar"></i>
                                    </button>
                                @else
                                    <div class="btn">
                                        <i class="fas fa-trash-alt" style="color: #aaa; font-size: 15pt;"
                                            title="Este proyecto no puede ser eliminado debido a que está en uso"></i>
                                    </div>
                                @endif
                                <a href="{{ route('admin.timesheet-proyectos-edit', $proyecto->id) }}" class="btn">
                                    <i class="fa-solid fa-pen-to-square" style="font-size:15pt;"
                                    title="Editar proyecto: {{ $proyecto->proyecto }}"></i>
                                </a>
                            @endcan
                            @can('timesheet_administrador_tareas_proyectos_access')
                                <a href="{{ route('admin.timesheet-tareas-proyecto', $proyecto->id) }}" class="btn">
                                    <i class="fas fa-list-alt" style="color:#888; font-size: 15pt;"
                                        title="Tareas de {{ $proyecto->proyecto }}"></i>
                                </a>
                            @endcan
                            <button class="btn" data-toggle="modal"
                                data-target="#modal_proyecto_{{ $proyecto->id }}"><i
                                    class="fa-solid fa-signal"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @foreach ($proyectos as $proyecto)
        <div class="modal fade" id="modal_proyecto_{{ $proyecto->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button class="btn btn-tache-cerrar" data-dismiss="modal"><i
                                class="fa-solid fa-xmark"></i></button>
                        <div class="delete">
                            <div class="text-center">
                                <i class="fa-solid fa-signal" style="color: #61CB5C; font-size:60pt;"></i>
                                <h1 class="my-4" style="font-size:14pt;">Cambiar Estatus de Proyecto:
                                    <small>{{ $proyecto->proyecto }}</small></h1>
                                <p class="parrafo">Seleccione el estatus del proyecto</p>
                            </div>

                            <div class="mt-4 d-flex justify-content-between">
                                @if ($proyecto->estatus != 'cancelado')
                                    <button class="btn btn-info" style="border:none; background-color:#aaa;"
                                        wire:click="cancelarProyecto({{ $proyecto->id }})" data-dismiss="modal">
                                        <i class="fa-solid fa-calendar-xmark iconos_crear"></i>
                                        Cancelar Proyecto
                                    </button>
                                @endif
                                @if ($proyecto->estatus != 'terminado')
                                    <button class="btn btn-info" style="border:none; background-color:#61CB5C;"
                                        wire:click="terminarProyecto({{ $proyecto->id }})" data-dismiss="modal">
                                        <i class="fas fa-calendar-check iconos_crear"></i>
                                        Proyecto Terminado
                                    </button>
                                @endif
                                @if ($proyecto->estatus != 'proceso')
                                    <button class="btn btn-info" style="border:none; background-color:#F48C16;"
                                        wire:click="procesoProyecto({{ $proyecto->id }})" data-dismiss="modal">
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

        <div class="modal fade" id="modal_proyecto_eliminar_{{ $proyecto->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button class="btn btn-tache-cerrar" data-dismiss="modal"><i
                                class="fa-solid fa-xmark"></i></button>
                        <div class="delete">
                            <div class="text-center">
                                <i class="fa-solid fa-trash-can" style="color: #E34F4F; font-size:60pt;"></i>
                                <h1 class="my-4" style="font-size:14pt;">Eliminar Proyecto:
                                    <small>{{ $proyecto->proyecto }}</small></h1>
                                <p class="parrafo">¿Desea eliminar el proyecto {{ $proyecto->proyecto }}?</p>
                            </div>

                            <div class="mt-4 d-flex justify-content-between">
                                <button class="btn btn_cancelar" data-dismiss="modal">
                                    Cancelar
                                </button>
                                <button class="btn btn-info" style="border:none; background-color:#E34F4F;"
                                    wire:click="destroy({{ $proyecto->id }})" data-dismiss="modal">
                                    Eliminar Proyecto
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="modal fade edit_modal" id="modal_proyecto_editar_{{ $proyecto->id }}" tabindex="-1"
            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin.timesheet-proyectos-update', $proyecto->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Proyecto:
                                {{ $proyecto->proyecto }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label><i class="fas fa-list iconos-crear"></i> ID</label>
                                    <input name="identificador" class="form-control" required
                                        value="{{ $proyecto->identificador }}">
                                    @if ($errors->has('identificador'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('identificador') }}
                                        </div>
                                    @endif
                                    @error('identificador')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-9">
                                    <label><i class="fas fa-list iconos-crear"></i> Nombre del proyecto</label>
                                    <input name="proyecto" class="form-control" required
                                        value="{{ $proyecto->proyecto }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label"><i class="fa-solid fa-calendar-day iconos-crear"></i>
                                        Fecha de inicio</label>
                                    <input type="date" name="fecha_inicio" class="form-control"
                                        value="{{ $proyecto->fecha_inicio }}">
                                    @if ($errors->has('fecha_inicio'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('fecha_inicio') }}
                                        </div>
                                    @endif
                                    @error('fecha_inicio')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label"><i class="fa-solid fa-calendar-day iconos-crear"></i>
                                        Fecha de fin</label>
                                    <input type="date" name="fecha_fin" class="form-control"
                                        value="{{ $proyecto->fecha_fin }}">
                                    @if ($errors->has('fecha_fin'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('fecha_fin') }}
                                        </div>
                                    @endif
                                    @error('fecha_fin')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label><i class="fa-solid fa-bag-shopping iconos-crear"></i> Cliente</label>
                                    <select name="area_id" class="form-control">
                                        <option selected
                                            value="{{ $proyecto->cliente_id ? $proyecto->cliente->id : '' }}">
                                            {{ $proyecto->cliente_id ? $proyecto->cliente->nombre : '' }}</option>
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6" wire:ignore id="caja_areas_select_edit">
                                    <label><i class="fab fa-adn iconos-crear"></i> Área(s) participante(s)</label>
                                    <select name="areas_seleccionadas[]" class="form-control select2" required
                                        multiple>
                                        @foreach ($proyecto->areas as $area)
                                            <option selected value="{{ $area->id }}">{{ $area->area }}</option>
                                        @endforeach
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->area }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label"><i
                                            class="fa-solid fa-building iconos-crear"></i>Sede</label>
                                    <select class="form-control" name="sede_id">
                                        <option selected
                                            value="{{ $proyecto->sede_id ? $proyecto->sede->id : '' }}">
                                            {{ $proyecto->sede_id ? $proyecto->sede->sede : '' }}</option>
                                        @foreach ($sedes as $sede)
                                            <option value="{{ $sede->id }}">{{ $sede->sede }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label"><i
                                            class="fa-solid fa-building iconos-crear"></i>Tipo</label>
                                    <select class="form-control" name="tipo">
                                        <option selected
                                            value="{{ $proyecto->tipo ? $proyecto->tipo : '' }}">
                                            {{ $proyecto->tipo ? $proyecto->tipo : '' }}</option>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo }}">{{ $tipo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-12 text-right">
                                    <div type="button" class="btn btn_cancelar" data-dismiss="modal">Cancelar</div>
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
        {{-- <div class="btn btn-danger" wire:click="click_e()">wire:click="click_e()"</div> --}}
    @endforeach
    @section('scripts')
        @parent
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', () => {
                Livewire.on('scriptTabla', () => {
                    tablaLivewire('datatable_timesheet_proyectos');
                    $('.select2').select2({
                        'theme' : 'bootstrap4',
                    });
                });
                document.getElementById('identificador_proyect').addEventListener('keyup', (e) => {
                    let value = e.target.value;
                    @this.set('identificador', value, true);
                });
                document.getElementById('name_proyect').addEventListener('keyup', (e) => {
                    let value = e.target.value;
                    @this.set('proyecto_name', value, true);
                });

                $(document.body).on("change", "#areas_seleccionadas", function() {
                    let value = $('#areas_seleccionadas').val();
                    @this.set('areas_seleccionadas', value, true);
                });

            });
        </script>
    @endsection
</div>
