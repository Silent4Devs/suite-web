<div class="w-100">
    <form wire:submit.prevent="create()" class="form-group w-100">
        <label>Tarea Nueva</label>
        <div class="d-flex justify-content-center w-100">
            <input class="form-control w-100 mr-4" placeholder="Nombre de la tarea" wire:model="tarea_name" required> 
            <select class="form-control mr-4" wire:model="proyecto_id" required>
                <option selected disabled>Seleccione proyecto al que pertenece</option>
                @foreach($proyectos as $proyecto)
                    <option value="{{ $proyecto->id }}">{{ $proyecto->proyecto }}</option>
                @endforeach 
            </select>
            <button class="btn btn-success" style="min-width: 140px;"><i class="fas fa-plus"></i> Agregar</button>
        </div>
    </form>
    
    <div class="datatable-fix w-100 mt-5">
        <table id="datatable_timesheet_tareas" class="table w-100">
            <thead class="w-100">
                <tr>
                    <th>Tarea </th>
                    <th>Proyecto</th>
                    <th style="max-width:200px;">Opciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($tareas as $tarea)
                    <tr>
                        <td> {{ $tarea->tarea }} </td>
                        <td> {{ $tarea->proyecto->proyecto }} </td>
                        <td>opciones</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
