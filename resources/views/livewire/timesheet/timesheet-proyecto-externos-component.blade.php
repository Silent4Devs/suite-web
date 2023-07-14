<div class="w-100">
    <h5 class="d-flex justify-content-between">Asignar Proveedor/Consultor Externo a Proyecto</h5>
    <div class="row">
        <div class="form-group col-12 text-right">
            <a href="{{ route('admin.timesheet-proyectos-edit', $proyecto->id) }}" class="btn btn_cancelar">Editar Proyecto</a>
            <a href="{{ route('admin.timesheet-proyecto-empleados', $proyecto->id) }}" class="btn btn-success">Asignar Empleados</a>
            <a href="{{ route('admin.timesheet-proyectos') }}" class="btn btn-info">Pagina Principal de Proyectos</a>
        </div>
    </div>

    <form wire:submit.prevent="addExterno" wire:ignore>
        <div class="row">
            <div class="form-group col-md-8">
                <label for="">Externo<sup>*</sup>(obligatorio)</label><br>
                <input wire:model.defer="externo_añadido" name="" id=""type="text" class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="">Horas asignadas<sup>*</sup>(obligatorio)</label>
                <input wire:model.defer="horas_tercero" name="" id="" type="number" min="1" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label for="">Costo por hora<sup>*</sup>(obligatorio)</label>
                <input wire:model.defer="costo_tercero" name="" id="" type="number" min="1" class="form-control">
            </div>
            <div class="form-group col-md-4" style="display: flex; align-items: flex-end;">
                <button class="btn btn-success">Agregar</button>
            </div>
        </div>
    </form>
    <div class="datatable-fix w-100 mt-5">
        <table id="tabla_time_proyect_externos" class="table w-100 tabla-animada">
            <thead class="w-100">
                <tr>
                    <th>Nombre </th>
                    <th>Horas asignadas </th>
                    <th>Costo por hora </th>
                    <th>Costo Total Estimado</th>
                    <th style="max-width:150px !important; width:150px ;">Opciones</th>
                </tr>
            </thead>

            <tbody style="position:relative;">
                @foreach ($proyecto_proveedores as $proyecto_proveedor)
                    <tr>
                        <td>{{ $proyecto_proveedor->proveedor_tercero }} </td>
                        <td>{{ $proyecto_proveedor->horas_tercero ?? '0' }} </td>
                        <td>{{ $proyecto_proveedor->costo_tercero ?? '0'}} </td>
                        <td>{{ ($proyecto_proveedor->horas_tercero * $proyecto_proveedor->costo_tercero) ?? ''}}</td>
                        <td>
                            <button class="btn" data-toggle="modal"
                            data-target="#modal_proyecto_externo_editar_{{ $proyecto_proveedor->id }}">
                            <i class="fa-solid fa-pen-to-square" style="color: rgb(62, 86, 246); font-size: 15pt;"
                                title="Editar"></i>
                            </button>
                            {{-- <button class="btn" data-toggle="modal"
                                data-target="#modal_proyecto_externo_eliminar_{{ $proyecto_proveedor->id }}">
                                <i class="fas fa-trash-alt" style="color: red; font-size: 15pt;"
                                    title="Eliminar"></i>
                            </button> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- @foreach($proyecto_proveedores as $proyecto_proveedor)
        <div class="modal fade" id="modal_proyecto_externo_eliminar_{{ $proyecto_proveedor->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button class="btn btn-tache-cerrar" data-dismiss="modal"><i
                                class="fa-solid fa-xmark"></i></button>
                        <div class="delete">
                            <div class="text-center">
                                <i class="fa-solid fa-trash-can" style="color: #E34F4F; font-size:60pt;"></i>
                                <h1 class="my-4" style="font-size:14pt;">Remover externo de Proyecto:
                                    <small>{{ $proyecto_proveedor->proyecto->proyecto }}</small></h1>
                                <p class="parrafo">¿Desea remover a {{ $proyecto_proveedor->proveedor_tercero }} del proyecto {{ $proyecto_proveedor->proyecto->proyecto }}?</p>
                            </div>

                            <div class="mt-4 d-flex justify-content-between">
                                <button class="btn btn_cancelar" data-dismiss="modal">
                                    Cancelar
                                </button>
                                <button class="btn btn-info" style="border:none; background-color:#E34F4F;"
                                    wire:click="externoProyectoRemove({{ $proyecto_proveedor->id }})" data-dismiss="modal">
                                    Eliminar Proyecto
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach --}}

    @foreach($proyecto_proveedores as $proyecto_proveedor)
        <div class="modal fade" id="modal_proyecto_externo_editar_{{ $proyecto_proveedor->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button class="btn btn-tache-cerrar" data-dismiss="modal"><i
                                class="fa-solid fa-xmark"></i></button>
                        <div class="edit">
                            <div class="text-center">
                                <i class="fa-solid fa-pen-to-square" style="color: rgb(62, 86, 246); font-size:60pt;"></i>
                                <h1 class="my-4" style="font-size:14pt;">Editar Externo de Proyecto:
                                    <small>{{ $proyecto_proveedor->proveedor_tercero }}</small></h1>
                                <form wire:submit.prevent="editExterno({{$proyecto_proveedor->id}})">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="">Horas asignadas<sup>*</sup>(obligatorio)</label>
                                            <input wire:model.defer="horas_tercero_edit" name="" id="" type="number" min="1" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Costo por hora<sup>*</sup>(obligatorio)</label>
                                            <input wire:model.defer="costo_tercero_edit" name="" id="" type="number" min="1" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mt-4 d-flex justify-content-between">
                                            <div class="form-group col-md-4" style="display: flex; align-items: flex-end;">
                                                <button class="btn btn_cancelar" data-dismiss="modal">
                                                    Cancelar
                                                </button>
                                            </div>
                                            <div class="form-group col-md-4" style="display: flex; align-items: flex-end;">
                                                <button class="btn btn-success">Editar</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div wire:loading>
                                        <h5 style="color:rgb(34, 56, 91)"><i class="fas fa-circle-notch fa-spin"></i> Modificando Datos...</h5>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

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
                    tablaLivewire('tabla_time_proyect_externos');

                    $('.select2').select2().on('change', function (e) {
                        var data = $(this).select2("val");
                        @this.set('externo_añadido', data);
                    });
                });

                $('.select2').select2().on('change', function (e) {
                    var data = $(this).select2("val");
                    @this.set('externo_añadido', data);
                });
            });
        </script>
    @endsection

</div>
