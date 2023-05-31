<div class="w-100">
    <h6>Asignar Empleado a Proyecto</h6>
    <form wire:submit.prevent="addEmpleado">
        <div class="row mt-4">
            <div class="form-group col-md-6">
                <label for="">Empleado</label>
                <select wire:model="empleado_añadido" name="" id="" class="select2" required>
                    <option value="" selected disabled></option>
                    @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->id }}">{{ $empleado->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="">Área</label>
                <div class="form-control">Área de emp</div>
            </div>
            <div class="form-group col-md-3" style="display: flex; align-items: flex-end;">
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
                    <th style="max-width:150px !important; width:150px ;">Opciones</th>
                </tr>
            </thead>

            <tbody style="position:relative;">
                @foreach ($proyecto_empleados as $proyect_empleado)
                    <tr>
                        <td>{{ $proyect_empleado->name }} </td>
                        <td>{{ $proyect_empleado->area->area }} </td>
                        <td>{{ $proyect_empleado->puesto }} </td>
                        <td>ops</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @section('scripts')
    @parent
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', () => {
                Livewire.on('scriptTabla', () => {
                    tablaLivewire('tabla_time_poyect_empleados');
                    $('.select2').select2({
                        'theme' : 'bootstrap4',
                    });
                });
            });
        </script>
    @endsection
</div>
