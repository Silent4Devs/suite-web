<div class="w-100">
    <form wire:submit.prevent="create()" class="form-group w-100">
        <label>Proyecto Nuevo</label>
        <div class="d-flex justify-content-center w-100">
            <input name="proyecto" wire:model="proyecto_name" class="form-control w-100 mr-4" required> <button class="btn btn-success"><i class="fas fa-plus"></i> Agregar</button>
        </div>
    </form>
    
    <div class="datatable-fix w-100 mt-5">
        <table id="datatable_timesheet_proyectos" class="table w-100">
            <thead class="w-100">
                <tr>
                    <th>Proyecto </th>
                    <th style="max-width:200px;">Opciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($proyectos as $proyecto)
                    <tr>
                        <td>{{ $proyecto->proyecto }} </td>
                        <td>opciones</td>                    
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
