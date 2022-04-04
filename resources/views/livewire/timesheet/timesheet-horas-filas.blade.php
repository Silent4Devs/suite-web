<div class="w-100">

    <form action="{{ route('admin.timesheet.store') }}" method="POST">
        @csrf
        <div class="form-group d-flex align-items-center" wire:ignore>
            <label class="mt-3 mr-3"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha fin de jornada laboral</label>

            
            <input type="date" id="fecha_dia" name="fecha_dia" class="form-control" style="max-width:160px;" required>
        </div>
        <div class="datatable-fix">
            <table id="datatable_timesheet_create" class="table table-responsive dataTables_scrollBody">
                <thead class="w-100">
                    <tr>
                        <th style="min-width:200px;">Proyecto </th>
                        <th style="min-width:200px;">Tarea</th>
                        <th>Facturable</th>
                        <th style="min-width:55px; padding-left: 17px;">Lunes</th>
                        <th style="min-width:55px; padding-left: 17px;">Martes</th>
                        <th style="min-width:55px; padding-left: 17px;">Miércoles</th>
                        <th style="min-width:55px; padding-left: 17px;">Jueves</th>
                        <th style="min-width:55px; padding-left: 17px;">Viernes</th>
                        <th style="min-width:55px; padding-left: 17px;">Sábado</th>
                        <th style="min-width:55px; padding-left: 17px;">Domingo</th>
                        <th style="min-width:200px;">Descripción</th>
                        <th style="">Opciones</th>
                        <th>Horas&nbsp;totales</th>
                    </tr>
                </thead>

                <tbody>
                    {{-- {{ $contador }} --}}
                    @for($i=1; $i<=$contador; $i++)
                        <tr id="tr_time_{{ $i }}">
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
                                <input type="checkbox" checked name="timesheet[{{ $i }}][facturable]" style="min-width: 50px;">
                            </td>
                            <td>
                                <input  type="number" name="timesheet[{{ $i }}][lunes]" data-dia="lunes" data-i="{{ $i }}" id="ingresar_hora_lunes_{{ $i }}" class="ingresar_horas  form-control" min="0" max="24">
                            </td>
                            <td>
                                <input  type="number" name="timesheet[{{ $i }}][martes]" data-dia="martes" data-i="{{ $i }}" id="ingresar_hora_martes_{{ $i }}"  class="ingresar_horas  form-control" min="0" max="24">
                            </td>
                            <td>
                                <input type="number" name="timesheet[{{ $i }}][miercoles]" data-dia="miercoles" data-i="{{ $i }}" id="ingresar_hora_miercoles_{{ $i }}"  class="ingresar_horas  form-control" min="0" max="24">
                            </td>
                            <td>
                                <input  type="number" name="timesheet[{{ $i }}][jueves]" data-dia="jueves" data-i="{{ $i }}" id="ingresar_hora_jueves_{{ $i }}"  class="ingresar_horas  form-control" min="0" max="24">
                            </td>
                            <td>
                                <input  type="number" name="timesheet[{{ $i }}][viernes]" data-dia="viernes" data-i="{{ $i }}" id="ingresar_hora_viernes_{{ $i }}"  class="ingresar_horas  form-control" min="0" max="24">
                            </td>   
                            <td>
                                <input  type="number" name="timesheet[{{ $i }}][sabado]" data-dia="sabado" data-i="{{ $i }}" id="ingresar_hora_sabado_{{ $i }}"  class="ingresar_horas  form-control" min="0" max="24">
                            </td>   
                            <td>
                                <input  type="number" name="timesheet[{{ $i }}][domingo]" data-dia="domingo" data-i="{{ $i }}" id="ingresar_hora_domingo_{{ $i }}"  class="ingresar_horas  form-control" min="0" max="24">
                            </td> 
                            <td>
                                <textarea name="timesheet[{{ $i }}][descripcion]" class="form-control" style="min-height:50px !important; resize: none;"></textarea>
                            </td>    
                            <td class="td_opciones">
                                @if($i > 1)
                                    <div class="btn btn_destroy_tr" data-tr="tr_time_{{ $i }}" style="color:red; font-size:20px;" title="Eliminar fila"><i class="fa-solid fa-trash-can"></i></div>
                                @endif
                            </td>  
                            {{-- <td>
                                <label id="suma_horas_fila_{{ $i }}"></label>
                            </td> --}}                     
                        </tr>
                    @endfor
                    <tr>
                        <td colspan="3"></td>
                        <td><label id="suma_dia_lunes"></label></td>
                        <td><label id="suma_dia_martes"></label></td>
                        <td><label id="suma_dia_miercoles"></label></td>
                        <td><label id="suma_dia_jueves"></label></td>
                        <td><label id="suma_dia_viernes"></label></td>
                        <td><label id="suma_dia_sabado"></label></td>
                        <td><label id="suma_dia_domingo"></label></td>
                        <td colspan="3"></td>
                    </tr>
                </tbody>
            </table>
            
        </div>
        


        <div class="mt-4" style="display:flex; justify-content:space-between;">
            <button class="btn btn-secundario" wire:click.prevent="$set('contador', {{ $contador + 1 }})">Agregar fila</button>
            <div>
                <button class="btn btn_cancelar" style="position:relative;">
                    <input id="estatus_papelera" type="radio" name="estatus" value="papelera" style="opacity:0; position: absolute;">
                    <label for="estatus_papelera" style="width:100%; height: 100%; position:absolute; display:flex; justify-content: center; align-items: center; top:0; left:0;">
                        Guardar borrador
                    </label>
                </button>
                    
                <div class="btn btn-success" style="position: relative;" data-toggle="modal" data-target="#modal_aprobar_">
                    <input id="estatus_pendiente" type="radio" name="estatus" value="pendiente" style="opacity:0; position: absolute;">
                    <label for="estatus_pendiente" style="width:100%; height: 100%; position:absolute; display:flex; justify-content: center; align-items: center; top:0; left:0;">
                        Registrar
                    </label>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_aprobar_" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="delete">
                            <div class="text-center">
                                <i class="fa-solid fa-calendar-plus" style="color: #2F96EB; font-size:60pt;"></i>
                                <h1 class="my-4" style="font-size:14pt;">Registrar Jornada Laboral</h1>
                                <p class="parrafo">¿Está seguro que desea enviar a aprobación este registro?</p>
                            </div>
                            
                            <div class="mt-4">
                                <div class="col-12 text-center">
                                    <div title="Rechazar" class="btn btn_cancelar" data-dismiss="modal">
                                        Cancelar
                                    </div>
                                    <button title="Rechazar" class="btn btn-info" style="border:none; background-color:#2F96EB;">
                                        Enviar a Aprobación
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>


    


    <script type="text/javascript">
        
        $('#mySelect2').on('select2:select', function (e) { 
            var data = e.params.data; console.log(data); 
             
        });

    </script>
</div>
