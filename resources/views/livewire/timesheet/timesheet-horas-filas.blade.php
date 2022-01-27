<div class="w-100">
    <form action="{{ route('admin.timesheet.store') }}" method="POST">
        @csrf
        <table id="datatable_timesheet_create" class="table table-responsive w-100">
            <thead class="w-100">
                <tr>
                    <th style="min-width:200px;">Proyecto </th>
                    <th style="min-width:200px;">Tarea</th>
                    <th>Factible</th>
                    <th style="min-width:55px;">Lunes</th>
                    <th style="min-width:55px;">Martes</th>
                    <th style="min-width:55px;">Miercoles</th>
                    <th style="min-width:55px;">Jueves</th>
                    <th style="min-width:55px;">Viernes</th>
                    <th style="min-width:55px;">Sabado</th>
                    <th style="min-width:55px;">Domingo</th>
                    <th style="min-width:200px;">Descripción</th>
                </tr>
            </thead>

            <tbody>
                {{-- {{ $contador }} --}}
                @for($i=1; $i<=$contador; $i++)
                    <tr>
                        <td>
                            <select name="timesheet[{{ $i }}][proyecto]" class="select2">
                                <option selected disabled>Seleccione proyecto</option>   
                                @foreach($proyectos as $proyecto)
                                    <option value="{{ $proyecto->id }}">{{ $proyecto->proyecto }}</option>
                                @endforeach 
                            </select>
                        </td>
                        <td>
                            <select name="timesheet[{{ $i }}][tarea]" class="select2">
                                <option selected disabled>Seleccione tarea</option>   
                                @foreach($tareas as $tarea)
                                    <option value="{{ $tarea->id }}">{{ $tarea->tarea }}</option>
                                @endforeach  
                            </select>
                        </td>
                        <td>
                            <input type="checkbox" name="timesheet[{{ $i }}][factible]" style="min-width: 50px;">
                        </td>
                        <td>
                            <input type="" name="timesheet[{{ $i }}][lunes]" class="ingresar_horas form-control">
                        </td>
                        <td>
                            <input type="" name="timesheet[{{ $i }}][martes]" class="ingresar_horas form-control">
                        </td>
                        <td>
                            <input type="" name="timesheet[{{ $i }}][miercoles]" class="ingresar_horas form-control">
                        </td>
                        <td>
                            <input type="" name="timesheet[{{ $i }}][jueves]" class="ingresar_horas form-control">
                        </td>
                        <td>
                            <input type="" name="timesheet[{{ $i }}][viernes]" class="ingresar_horas form-control">
                        </td>   
                        <td>
                            <input type="" name="timesheet[{{ $i }}][sabado]" class="ingresar_horas form-control">
                        </td>   
                        <td>
                            <input type="" name="timesheet[{{ $i }}][domingo]" class="ingresar_horas form-control">
                        </td> 
                        <td>
                            <textarea name="timesheet[{{ $i }}][descripcion]" class="form-control" style="min-height:50px !important; resize: none;"></textarea>
                        </td>                           
                    </tr>
                @endfor

            </tbody>
        </table>
        


        <div class="mt-4" style="display:flex; justify-content:space-between;">
            <button class="btn btn-secundario" wire:click.prevent="$set('contador', {{ $contador + 1 }})">+</button>
            <button class="btn btn-success">Guardar</button>
        </div>
    </form>
</div>
