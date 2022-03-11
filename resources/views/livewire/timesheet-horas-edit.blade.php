<div>
    <form action="{{ route('admin.timesheet.update', $timesheet->id) }}" method="POST">
        @csrf
        @method('PUT')
        {{-- <div class="form-group d-flex align-items-center" wire:ignore>
            <label class="mt-3 mr-3"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha</label>

            
            <input type="date" id="fecha_dia" name="fecha_dia" class="form-control" style="max-width:160px;" required>
        </div> --}}
        <div class="datatable-fix">
            <table id="datatable_timesheet_create" class="table w-100">
                <thead class="w-100">
                    <tr>
                        <th style="min-width:200px;">Proyecto </th>
                        <th style="min-width:200px;">Tarea</th>
                        <th>Facturable</th>
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
                    @php
                        $i_hora = 0;
                    @endphp
                    @foreach($horas as $hora)
                        @php
                            $i_hora ++;
                        @endphp
                        <tr>
                            <td wire:ignore>
                                <input type="hidden" name="timesheet[{{ $i_hora }}][id_hora]" value="{{ $hora->id }}">
                                <select name="timesheet[{{ $i_hora }}][proyecto]" class="select2">
                                    <option selected value="{{ $hora->proyecto->id }}">{{ $hora->proyecto->proyecto }}</option>   
                                    @foreach($proyectos as $proyecto)
                                        <option value="{{ $proyecto->id }}">{{ $proyecto->proyecto }}</option>
                                    @endforeach 
                                </select>   
                            </td>
                            <td wire:ignore>
                                <select name="timesheet[{{ $i_hora }}][tarea]" class="select2">
                                    <option selected value="{{ $hora->tarea->id }}">{{ $hora->tarea->tarea }}</option>   
                                    @foreach($tareas as $tarea)
                                        <option value="{{ $tarea->id }}">{{ $tarea->tarea }}</option>
                                    @endforeach  
                                </select>
                            </td>
                            <td>
                                @if($hora->facturable)
                                    <input type="checkbox" checked name="timesheet[{{ $i_hora }}][facturable]" style="min-width: 50px;">
                                 @else
                                    <input type="checkbox" name="timesheet[{{ $i_hora }}][facturable]" style="min-width: 50px;">
                                @endif
                            </td>
                            <td>
                                <input type="" name="timesheet[{{ $i_hora }}][lunes]" class="ingresar_horas form-control" value="{{ $hora->horas_lunes }}">
                            </td>
                            <td>
                                <input type="" name="timesheet[{{ $i_hora }}][martes]" class="ingresar_horas form-control" value="{{ $hora->horas_martes }}">
                            </td>
                            <td>
                                <input type="" name="timesheet[{{ $i_hora }}][miercoles]" class="ingresar_horas form-control" value="{{ $hora->horas_miercoles }}">
                            </td>
                            <td>
                                <input type="" name="timesheet[{{ $i_hora }}][jueves]" class="ingresar_horas form-control" value="{{ $hora->horas_jueves }}">
                            </td>
                            <td>
                                <input type="" name="timesheet[{{ $i_hora }}][viernes]" class="ingresar_horas form-control" value="{{ $hora->horas_viernes }}">
                            </td>   
                            <td>
                                <input type="" name="timesheet[{{ $i_hora }}][sabado]" class="ingresar_horas form-control" value="{{ $hora->horas_sabado }}">
                            </td>   
                            <td>
                                <input type="" name="timesheet[{{ $i_hora }}][domingo]" class="ingresar_horas form-control" value="{{ $hora->horas_domingo }}">
                            </td> 
                            <td>
                                <textarea name="timesheet[{{ $i_hora }}][descripcion]" class="form-control" style="min-height:50px !important; resize: none;">{{ $hora->descripcion }}</textarea>
                            </td>                           
                        </tr>
                    @endforeach

                    @for($i=$i_hora+1; $i<=$contador; $i++)
                        <tr>
                            <td wire:ignore>
                                <input type="hidden" name="timesheet[{{ $i }}][id_hora]" value="0">
                                <select name="timesheet[{{ $i }}][proyecto]" class="select2">
                                    <option selected disabled>Seleccione proyecto</option>   
                                    @foreach($proyectos as $proyecto)
                                        <option value="{{ $proyecto->id }}">{{ $proyecto->proyecto }}</option>
                                    @endforeach 
                                </select>
                            </td>
                            <td wire:ignore>
                                <select name="timesheet[{{ $i }}][tarea]" class="select2">
                                    <option selected disabled>Seleccione tarea</option>   
                                    @foreach($tareas as $tarea)
                                        <option value="{{ $tarea->id }}">{{ $tarea->tarea }}</option>
                                    @endforeach  
                                </select>
                            </td>
                            <td>
                                <input type="checkbox" checked name="timesheet[{{ $i }}][factible]" style="min-width: 50px;">
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
            
        </div>
        


        <div class="mt-4" style="display:flex; justify-content:space-between;">
            <button id="btn_agregar_fila" class="btn btn-secundario" wire:click.prevent="agregarFila">Agregar fila</button>
            <div>
                <button class="btn_cancelar" style="position:relative;">
                    <input id="estatus_papelera" type="radio" name="estatus" value="papelera" style="opacity:0; position: absolute;">
                    <label for="estatus_papelera" style="width:100%; height: 100%; position:absolute; display:flex; justify-content: center; align-items: center; top:0; left:0;">
                        Guardar borrador
                    </label>
                </button>
                    
                <button class="btn btn-success" style="position: relative;">
                    <input id="estatus_pendiente" type="radio" name="estatus" value="pendiente" style="opacity:0; position: absolute;">
                    <label for="estatus_pendiente" style="width:100%; height: 100%; position:absolute; display:flex; justify-content: center; align-items: center; top:0; left:0;">
                        Enviar
                    </label>
                </button>
            </div>
        </div>
    </form>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', ()=>{
            @this.set('contador', @json($i_hora));

            Livewire.on('filaAgregada', ()=>{
                $('.select2').select2({
                    'theme' : 'bootstrap4',
                });
            });
        });
    </script>
</div>
