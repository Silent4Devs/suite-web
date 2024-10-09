<div class="w-100">
    <x-loading-indicator />
    <h5 class="d-flex justify-content-between">Asignar Empleado a Proyecto</h5>
    <div class="row">
        <div class="form-group col-12 text-right">
            <a href="{{ route('admin.timesheet-proyectos-edit', $proyecto->id) }}" class="btn btn-outline-primary">Editar
                Proyecto</a>
            @can('asignar_externos')
                @if ($proyecto->tipo === 'Externo')
                    <a href="{{ route('admin.timesheet-proyecto-externos', $proyecto->id) }}" class="btn btn-primary">Asignar
                        Proveedores/Consultores</a>
                @endif
            @endcan
            <a href="{{ route('admin.timesheet-proyectos') }}" class="btn btn-info">Pagina Principal de Proyectos</a>
        </div>
    </div>
    <form wire:submit="addEmpleado" wire:ignore>
        <div class="row mt-4">
            <div class="form-group col-md-3">
                <div class="dropdown">
                    <button class="btn btn-secondary btn-lg dropdown-toggle form-control" type="button"
                        id="dropdownMenuButtonEmpleados" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"
                        style="text-align: initial; background-color:#fff; color:#3086AF !important; border: 1px solid #ced4da !important">
                        Asignar Empleados
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonEmpleados"
                        style="max-height: 200px; overflow-y: auto;">
                        @foreach ($empleados as $key => $empleado)
                            <div class="dropdown-item">
                                <div class="row mt-2 mb-2">
                                    <div class="col-10">
                                        <div class="text-wrap">
                                            {{ $empleado['name'] }}
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <input type="checkbox" id="empleado_{{ $empleado['id'] }}"
                                            class="form-check-input" style="transform: scale(2);"
                                            wire:model.live="empleados.{{ $key }}.seleccionado"
                                            wire:change="asignacionEmpleados('{{ $empleado['id'] }}','{{ $key }}', $event.target.checked ? true : false)">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @if ($proyecto->tipo === 'Externo')
            <div class="modal fade" id="modalExterno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Asignar Horas y Costes</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="">Horas asignadas<sup>*</sup>(obligatorio)</label>
                                    <input wire:model="horas_asignadas" name="horas_asignadas" id="horas_asignadas"
                                        type="number" step="0.01" min="0.01" class="form-control">
                                    @error('horas_asignadas')
                                        <small class="text-danger"><i
                                                class="fas fa-info-circle mr-2"></i>{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="">Costo por hora<sup>*</sup>(obligatorio)</label>
                                    <input wire:model="costo_hora" name="costo_hora" id="costo_hora" type="number"
                                        min="0.01" step="0.01" class="form-control">
                                    @error('costo_hora')
                                        <small class="text-danger"><i
                                                class="fas fa-info-circle mr-2"></i>{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <button class="btn btn-primary">
                                    Agregar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($proyecto->tipo == 'Externo')
            <div class="row">
                <div class="form-group col-md-4" style="display: flex; align-items: flex-end;">
                    <button class="btn btn-primary" onclick="confirmSeleccionarTodos(event)">Seleccionar Todos
                        los
                        usuarios</button>
                </div>
            </div>
        @else
            <div class="row">
                <div class="form-group col-md-4" style="display: flex; align-items: flex-end;">
                    <button class="btn btn-primary" onclick="confirmSeleccionarTodos(event)">Seleccionar Todos los
                        usuarios</button>
                </div>
            </div>
        @endif
    </form>
    <div class="datatable-fix w-100 mt-5">
        <table id="tabla_time_poyect_empleados" class="table w-100 tabla-animada">
            <thead class="w-100">
                <tr>
                    <th>Nombre </th>
                    <th>Área </th>
                    <th>Puesto </th>
                    @if ($proyecto->tipo === 'Externo')
                        <th>Horas Asignadas </th>
                        <th>Costo por Hora </th>
                        <th>Costo Estimado</th>
                        <th>Horas Totales </th>
                        <th>Costo Real</th>
                        <th>Horas Sobrepasadas </th>
                        <th>Costo Horas Sobrepasadas</th>
                    @endif
                    <th style="max-width:150px !important; width:150px ;">Opciones</th>
                </tr>
            </thead>
            <tbody style="position:relative;">
                @foreach ($proyecto_empleados as $key => $proyect_empleado)
                    @php
                        $estimado = 0;
                        $real = 0;
                        $costo_sobrepasado = 0;

                        $estimado = $proyect_empleado->horas_asignadas * $proyect_empleado->costo_hora;
                        $real = $proyect_empleado->total * $proyect_empleado->costo_hora;

                        $costo_sobrepasado = $proyect_empleado->sobrepasadas * $proyect_empleado->costo_hora;
                    @endphp

                    <tr>
                        <td>{{ $proyect_empleado->empleado->name }} </td>
                        <td>{{ $proyect_empleado->empleado->area->area }} </td>
                        <td>{{ $proyect_empleado->empleado->puesto }} </td>
                        @if ($proyecto->tipo === 'Externo')
                            <td>{{ $proyect_empleado->horas_asignadas ?? '0' }} </td>
                            <td>{{ $proyect_empleado->costo_hora ?? '0' }} </td>
                            <td>{{ $estimado ?? '0' }} </td>
                            <td>{{ $proyect_empleado->total ?? '0' }} </td>
                            <td>{{ $real ?? '0' }}</td>
                            <td>{{ $proyect_empleado->sobrepasadas ?? '0' }} </td>
                            <td>{{ $costo_sobrepasado }}</td>
                        @endif
                        <td>
                            {{-- <div class="dropdown" style="display: flex;justify-content: center;justify-items: center;">
                                <button class="btn btn-option" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" data-toggle="modal"
                                        data-target="#modal_proyecto_empleado_editar_{{ $proyect_empleado->id }}">
                                        <i class="fa-solid fa-pen-to-square"
                                            style="color: rgb(62, 86, 246); font-size: 15pt;" title="Editar"></i>
                                        Editar
                                    </a>
                                    <a class="dropdown-item"
                                        wire:click="bloquearEmpleado({{ $proyect_empleado->id }})">
                                        @if ($proyect_empleado->usuario_bloqueado == false)
                                            <i class="fas fa-unlock"></i> Desbloquear
                                        @else
                                            <i class="fas fa-lock"></i> Bloquear
                                        @endif
                                    </a>
                                    <a class="dropdown-item" data-toggle="modal"
                                        data-target="#modal_proyecto_empleado_eliminar_{{ $proyect_empleado->id }}">
                                        <i class="fas fa-trash-alt" style="color: red; font-size: 15pt;"
                                            title="Eliminar"></i> Eliminar
                                    </a>
                                </div>
                            </div> --}}
                            <a class="dropdown-item" data-toggle="modal"
                                data-target="#modal_proyecto_empleado_editar_{{ $proyect_empleado->id }}">
                                <i class="fa-solid fa-pen-to-square" style="color: rgb(62, 86, 246); font-size: 15pt;"
                                    title="Editar"></i>
                                Editar
                            </a>
                            <a class="dropdown-item" wire:click="bloquearEmpleado({{ $proyect_empleado->id }})">
                                @if ($proyect_empleado->usuario_bloqueado == false)
                                    <i class="fas fa-unlock"></i> Desbloquear
                                @else
                                    <i class="fas fa-lock"></i> Bloquear
                                @endif
                            </a>
                            <a class="dropdown-item" data-toggle="modal"
                                data-target="#modal_proyecto_empleado_eliminar_{{ $proyect_empleado->id }}">
                                <i class="fas fa-trash-alt" style="color: red; font-size: 15pt;"
                                    title="Eliminar"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @foreach ($proyecto_empleados as $proyect_empleado)
        <div class="modal fade" id="modal_proyecto_empleado_editar_{{ $proyect_empleado->id }}" tabindex="-1"
            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <button class="btn btn-tache-cerrar" data-dismiss="modal"><i
                                class="fa-solid fa-xmark"></i></button>
                        <div>
                            <div class="text-center">
                                <i class="fa-solid fa-pen-to-square"
                                    style="color: rgb(62, 86, 246); font-size:60pt;"></i>
                                <h1 class="my-4" style="font-size:14pt;">Editar empleado:
                                    <small>{{ $proyect_empleado->name }}</small>
                                </h1>
                            </div>
                            <form
                                wire:submit="editEmpleado({{ $proyect_empleado->id }}, Object.fromEntries(new FormData($event.target)))">
                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label for="">Empleado<sup>*</sup>(obligatorio)</label>
                                        <select name="empleado_editado" id="empleado_editado" class="form-control"
                                            required>
                                            @foreach ($empleados as $empleado)
                                                <option value="{{ $empleado['id'] }}"
                                                    {{ $empleado['id'] == $proyect_empleado->empleado->id ? 'selected' : '' }}>
                                                    {{ $empleado['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if ($proyecto->tipo === 'Externo')
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="">Horas asignadas<sup>*</sup>(obligatorio)</label>
                                            <input
                                                value="{{ old('horas_edit', $proyect_empleado->horas_asignadas ?? '0') }}"
                                                name="horas_edit" id="" type="number" step="0.01"
                                                min="0.01" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Costo por hora<sup>*</sup>(obligatorio)</label>
                                            <input value="{{ old('horas_edit', $proyect_empleado->costo_hora) }}"
                                                name="costo_edit" id="" type="number" step="0.01"
                                                min="0.01" value="{{ $proyect_empleado->costo_hora ?? '0' }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="mt-4 d-flex justify-content-between">
                                        <div class="form-group col-md-4"
                                            style="display: flex; align-items: flex-end;">
                                            <button class="btn btn-outline-primary" data-dismiss="modal">
                                                Cancelar
                                            </button>
                                        </div>
                                        <div class="form-group col-md-4"
                                            style="display: flex; align-items: flex-end;">
                                            <button class="btn btn-primary">Editar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @foreach ($proyecto_empleados as $proyect_empleado)
        <div class="modal fade" id="modal_proyecto_empleado_eliminar_{{ $proyect_empleado->id }}" tabindex="-1"
            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button class="btn btn-tache-cerrar" data-dismiss="modal"><i
                                class="fa-solid fa-xmark"></i></button>
                        <div class="delete">
                            <div class="text-center">
                                <i class="fa-solid fa-trash-can" style="color: #E34F4F; font-size:60pt;"></i>
                                <h1 class="my-4" style="font-size:14pt;">Remover empleado de Proyecto:
                                    <small>{{ $proyecto->proyecto }}</small>
                                </h1>
                                <p class="parrafo">¿Desea remover a {{ $proyect_empleado->empleado->name }} del
                                    proyecto {{ $proyecto->proyecto }}?</p>
                            </div>
                            <div class="mt-4 d-flex justify-content-between">
                                <button class="btn btn-outline-primary" data-dismiss="modal">
                                    Cancelar
                                </button>
                                <button class="btn btn-info" style="border:none; background-color:#E34F4F;"
                                    wire:click="empleadoProyectoRemove({{ $proyect_empleado->id }})"
                                    data-dismiss="modal">
                                    Eliminar Empleado
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @section('scripts')
        @parent

        <script>
            window.addEventListener('closeModal', event => {
                $('.modal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            });

            document.addEventListener('DOMContentLoaded', () => {

                Livewire.on('scriptTabla', () => {
                    tablaLivewire('tabla_time_poyect_empleados');

                    $('.select2').select2().on('change', function(e) {
                        var data = $(this).select2("val");
                        @this.set('empleado_añadido', data);
                    });
                });

                $('.select2').select2().on('change', function(e) {
                    var data = $(this).select2("val");
                    @this.set('empleado_añadido', data);
                });
            });
        </script>

        <script>
            function confirmSeleccionarTodos(event) {
                event.preventDefault(); // Prevent default form submission behavior
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¿Quieres seleccionar todos los usuarios?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('seleccionarTodos'); // Call Livewire method if confirmed
                    }
                });
            }
        </script>

        <script>
            document.addEventListener('livewire:init', function() {
                console.log('1');
                Livewire.on('openModal', empleadoId => {
                    console.log('2', empleadoId);
                    $('#modal_proyecto_empleado_eliminar_' + empleadoId).modal('show');
                });
            });
        </script>

        <script>
            document.addEventListener('livewire:init', function() {
                Livewire.on('modalProyectosExternos', function() {
                    // Show the modal when the event is received
                    $('#modalExterno').modal('show');
                });
            });
        </script>
    @endsection
</div>
