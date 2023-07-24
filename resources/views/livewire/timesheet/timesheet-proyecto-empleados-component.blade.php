<div class="w-100">
    <h5 class="d-flex justify-content-between">Asignar Empleado a Proyecto</h5>
    <div class="row">
        <div class="form-group col-12 text-right">
        <a href="{{ route('admin.timesheet-proyectos-edit', $proyecto->id) }}" class="btn btn_cancelar">Editar Proyecto</a>
        @if($proyecto->tipo === "Externo")
            <a href="{{ route('admin.timesheet-proyecto-externos', $proyecto->id) }}" class="btn btn-success">Asignar Proveedores/Consultores</a>
        @endif
        <a href="{{ route('admin.timesheet-proyectos') }}" class="btn btn-info">Pagina Principal de Proyectos</a>
        </div>
    </div>
    <form wire:submit.prevent="addEmpleado" wire:ignore>
        {{-- <x-loading-indicator /> --}}
        <div class="row mt-4">
            <div class="form-group col-md-7">
                <label for="">Empleado<sup>*</sup></label>
                <select wire:model.defer="empleado_añadido" name="" id="" class="select2" required>
                    <option value="" selected readonly>Seleccione un empleado</option>
                    @foreach ($empleados as $empleado)
                        @foreach ($areasempleado as $ae)
                            @if($empleado->area_id === $ae->area_id)
                                <option value="{{ $empleado->id }}">{{ $empleado->name }}</option>
                            @endif
                        @endforeach
                    @endforeach
                </select>
            </div>
            {{-- <div class="form-group col-md-5">
                <label for="">Área</label>
                <div class="form-control">Área de emp</div>
            </div> --}}
        </div>
        <div class="row">
            @if($proyecto->tipo === "Externo")
            <div class="form-group col-md-4">
                <label for="">Horas asignadas<sup>*</sup>(obligatorio)</label>
                <input wire:model.defer="horas_asignadas" name="horas_asignadas" id="horas_asignadas" type="number" min="1" class="form-control">
            </div>
            @error('horas_asignadas')
                <small class="text-danger"><i class="fas fa-info-circle mr-2"></i>{{ $message }}</small>
            @enderror
            <div class="form-group col-md-4">
                <label for="">Costo por hora<sup>*</sup>(obligatorio)</label>
                <input wire:model.defer="costo_hora" name="costo_hora" id="costo_hora" type="number" min="1" class="form-control">
            </div>
            @error('costo_hora')
                <small class="text-danger"><i class="fas fa-info-circle mr-2"></i>{{ $message }}</small>
            @enderror
            @endif
            <div class="form-group col-md-4" style="display: flex; align-items: flex-end;">
                <button class="btn btn-success">Agregar</button>
            </div>
        </div>
    </form>
    <div class="datatable-fix w-100 mt-5">
        <table id="tabla_time_poyect_empleados" class="table w-100 tabla-animada">
            <thead class="w-100">
                <tr>
                    <th>Nombre </th>
                    <th>Área </th>
                    <th>Puesto </th>
                @if($proyecto->tipo === "Externo")
                    <th>Horas Asignadas </th>
                    <th>Horas Totales </th>
                    <th>Horas Sobrepasadas </th>
                    <th>Costo por Hora </th>
                    <th>Costo Total Estimado</th>
                @endif
                    <th style="max-width:150px !important; width:150px ;">Opciones</th>
                </tr>
            </thead>

            <tbody style="position:relative;">
                @foreach ($proyecto_empleados as $proyect_empleado)
                    <tr>
                        <td>{{ $proyect_empleado->empleado->name }} </td>
                        <td>{{ $proyect_empleado->empleado->area->area }} </td>
                        <td>{{ $proyect_empleado->empleado->puesto }} </td>
                    @if($proyecto->tipo === "Externo")
                        <td>{{ $proyect_empleado->horas_asignadas ?? '0'}} </td>
                        <td>{{ $proyect_empleado->totales ?? '0'}} </td>
                        <td>{{ $proyect_empleado->sobrepasadas ?? '0'}} </td>
                        <td>{{ $proyect_empleado->costo_hora ?? '0'}} </td>
                        <td>{{($proyect_empleado->horas_asignadas * $proyect_empleado->costo_hora) ?? '0'}}</td>
                    @endif
                        <td>
                            <button class="btn" data-toggle="modal"
                            data-target="#modal_proyecto_empleado_editar_{{ $proyect_empleado->id }}">
                            <i class="fa-solid fa-pen-to-square" style="color: rgb(62, 86, 246); font-size: 15pt;"
                                title="Editar"></i>
                            </button>
                            {{-- <a wire:click="bloquearEmpleado({{ $proyect_empleado->id }})" class="btn btn-sm">
                                @if ($proyect_empleado->usuario_bloqueado == false)
                                    <i class="fas fa-unlock"></i>
                                @else
                                    <i class="fas fa-lock"></i>
                                @endif
                            </a> --}}
                            {{-- <button class="btn" data-toggle="modal"
                                data-target="#modal_proyecto_empleado_eliminar_{{ $proyect_empleado->id }}">
                                <i class="fas fa-trash-alt" style="color: red; font-size: 15pt;"
                                    title="Eliminar"></i>
                            </button> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

        @foreach($proyecto_empleados as $proyect_empleado)
        <div class="modal fade" id="modal_proyecto_empleado_editar_{{ $proyect_empleado->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore>
            <x-loading-indicator />
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <button class="btn btn-tache-cerrar" data-dismiss="modal"><i
                                class="fa-solid fa-xmark"></i></button>
                        <div>
                            <div class="text-center">
                                <i class="fa-solid fa-pen-to-square" style="color: rgb(62, 86, 246); font-size:60pt;"></i>
                                <h1 class="my-4" style="font-size:14pt;">Editar empleado:
                                    <small>{{ $proyect_empleado->empleado->name }}</small></h1>
                            </div>
                            <form wire:submit.prevent="editEmpleado({{$proyect_empleado->id}}, Object.fromEntries(new FormData($event.target)))">
                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label for="">Empleado<sup>*</sup>(obligatorio)</label>
                                        <select name="empleado_editado" id="" class="select2" required>
                                            <option value="{{ $proyect_empleado->empleado->id }}" selected>{{ $proyect_empleado->empleado->name }}</option>
                                            @foreach ($empleados as $empleado)
                                                @foreach ($areasempleado as $ae)
                                                    @if($empleado->area_id === $ae->area_id)
                                                        <option value="{{ $empleado->id }}">{{ $empleado->name }}</option>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if($proyecto->tipo === "Externo")
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="">Horas asignadas<sup>*</sup>(obligatorio)</label>
                                            <input value="{{ old('horas_edit', $proyect_empleado->horas_asignadas  ?? '0') }}"
                                            name="horas_edit" id="" type="number" min="1" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Costo por hora<sup>*</sup>(obligatorio)</label>
                                            <input value="{{ old('horas_edit', $proyect_empleado->costo_hora) }}"
                                            name="costo_edit" id="" type="number" min="1" value="{{$proyect_empleado->costo_hora  ?? '0' }}"  class="form-control">
                                        </div>
                                    </div>
                                @endif
                                    <div class="row">
                                        <div class="mt-4 d-flex justify-content-between">
                                            <div class="form-group col-md-4" style="display: flex; align-items: flex-end;">
                                                <button class="btn btn_cancelar" data-dismiss="modal">
                                                    Cancelar
                                                </button>
                                            </div>
                                            <div class="form-group col-md-4" style="display: flex; align-items: flex-end;">
                                                <button class="btn btn-success" >Editar</button>
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

    {{-- @foreach($proyecto_empleados as $proyect_empleado)
        <div class="modal fade" id="modal_proyecto_empleado_eliminar_{{ $proyect_empleado->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button class="btn btn-tache-cerrar" data-dismiss="modal"><i
                                class="fa-solid fa-xmark"></i></button>
                        <div class="delete">
                            <div class="text-center">
                                <i class="fa-solid fa-trash-can" style="color: #E34F4F; font-size:60pt;"></i>
                                <h1 class="my-4" style="font-size:14pt;">Remover empleado de Proyecto:
                                    <small>{{ $proyect_empleado->proyecto->proyecto }}</small></h1>
                                <p class="parrafo">¿Desea remover a {{ $proyect_empleado->empleado->name }} del proyecto {{ $proyect_empleado->proyecto->proyecto }}?</p>
                            </div>

                            <div class="mt-4 d-flex justify-content-between">
                                <button class="btn btn_cancelar" data-dismiss="modal">
                                    Cancelar
                                </button>
                                <button class="btn btn-info" style="border:none; background-color:#E34F4F;"
                                    wire:click="empleadoProyectoRemove({{ $proyect_empleado->id }})" data-dismiss="modal">
                                    Eliminar Proyecto
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach --}}

    @section('js')
    <script>
        window.addEventListener('closeModal', event => {
            $('.modal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();

        })
    </script>
    @stop


    @section('scripts')
    @parent
    <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', () => {

                Livewire.on('scriptTabla', () => {
                    tablaLivewire('tabla_time_poyect_empleados');

                    $('.select2').select2().on('change', function (e) {
                        var data = $(this).select2("val");
                        @this.set('empleado_añadido', data);
                    });
                });

                $('.select2').select2().on('change', function (e) {
                    var data = $(this).select2("val");
                    @this.set('empleado_añadido', data);
                });
            });
        </script>



    {{-- <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {

            Livewire.on('scriptTabla', () => {
                tablaLivewire('tabla_time_poyect_empleados');

                $('.select2').select2().on('change', function (e) {
                    var data = $(this).select2("val");
                    @this.set('empleado_editado', data);
                });
            });

            $('.select2').select2().on('change', function (e) {
                var data = $(this).select2("val");
                @this.set('empleado_editado', data);
            });
        });
    </script> --}}
    @endsection
</div>
