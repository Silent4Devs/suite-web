<div>
    @php
        use App\Models\TimesheetTarea;
        use App\Models\Timesheet;
        use App\Models\TimesheetHoras;
        use App\Models\TimesheetProyecto;
    @endphp
    <div class="row">
        <form class="col-12 d-flex" style="align-items: flex-end;" wire:submit.prevent="buscarEmpleado()">
            <div class="form-group">
                <label><strong>Seleccione emplea</strong></label>
                <select class="form-control " wire:model="empleado_seleccionado_id">
                    @foreach($empleados as $emplea)
                        <option value="{{ $emplea->id }}">{{ $emplea->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group ml-3">
                <button class="btn btn-success">Buscar</button>
            </div>
        </form>
    </div>

    @if($empleado)
        <div class="row">
            <div class="col-12 my-5 d-flex justify-content-between">
                <h5 style="font-weight:bolder;">Reporte Timesheet: <font style="font-weight:lighter;">{{ $empleado->name }}</font></h5>
                <button class="btn btn-secundario" onclick="window.print()"><i class="fa-solid fa-print iconos_crear"></i> Imprimir</button>
            </div>
            <div class="col-lg-9">
                <ul id="lista_proyectos_tareas">
                    @foreach($timesheet as $timeshe)
                        @php
                            $horas_id_proyectos = TimesheetHoras::where('timesheet_id', $timeshe->id)->get();

                            $proyectos = [];
                            $proyectos = collect();
                            foreach($horas_id_proyectos as $id_proyect){
                                $proyecto = TimesheetProyecto::find($id_proyect->proyecto_id);

                                $proyectos->push($proyecto);
                            }
                        @endphp

                        @foreach($proyectos as $proyecto)
                            @php
                                $tareas = TimesheetTarea::where('proyecto_id', $proyecto->id)->get();
                            @endphp
                            <li>
                                <strong>Proyecto:</strong> {{ $proyecto->proyecto }}
                                <ul><strong>Tareas</strong>
                                    @foreach($tareas as $tarea)
                                        <li>{{ $tarea->tarea }}</li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-3" style="background:linear-gradient(0deg, rgba(69,125,182,1) 0%, rgba(8,170,157,1) 60%); color:#fff;">   
                <div class="p-4">
                    
                    <h5 class="text-center">Estadisticas Generales</h5>
                    <div class="mt-3 text-center">Horas Totales</div>
                    <h1 class="mt-3 text-center">346</h1>
                    <div class="mt-3"><strong>Puesto:</strong> {{ $empleado->puesto }}</div>
                    <div class="mt-3"><strong>Área:</strong> {{ $empleado->area ? $empleado->area->area : ''}}</div>
                </div>
            </div>
            <div class="col-12">
                <div class="row mt-4">
                    <div class="col-12 d-flex justify-content-between">
                        <h5 id="titulo_estatus">Todos los Registros</h5>
                        <div class="btn_estatus_caja">
                            <button class="btn btn-primary" style="background-color: #5AC3E5; border:none !important; position: relative;" id="btn_todos" wire:click="todos">
                                @if($todos_contador > 0)
                                    <span class="indicador_numero" style="filter: contrast(200%);">{{ $todos_contador }}</span>
                                @endif
                                Todos
                            </button>
                            <button class="btn btn-primary" style="background-color: #aaa; border:none !important; position: relative;" id="btn_papelera" wire:click="papelera">
                                @if($borrador_contador > 0)
                                    <span class="indicador_numero" style="filter: contrast(200%);">{{ $borrador_contador }}</span>
                                @endif
                                Borrador
                            </button>
                            <button class="btn btn-primary" style="background-color: #F48C16; border:none !important; position: relative;" id="btn_pendiente" wire:click="pendientes">
                                @if($pendientes_contador > 0)
                                    <span class="indicador_numero" style="filter: contrast(200%);">{{ $pendientes_contador }}</span>
                                @endif
                                Pendientes
                            </button>
                            <button class="btn btn-primary" style="background-color: #61CB5C; border:none !important; position: relative;" id="btn_aprobado" wire:click="aprobados">
                                @if($aprobados_contador > 0)
                                    <span class="indicador_numero" style="filter: contrast(200%);">{{ $aprobados_contador }}</span>
                                @endif
                                Aprobados
                            </button>
                            <button class="btn btn-primary" style="background-color: #EA7777; border:none !important; position: relative;" id="btn_rechazado" wire:click="rechazos">
                                @if($rechazos_contador > 0)
                                    <span class="indicador_numero" style="filter: contrast(200%);">{{ $rechazos_contador }}</span>
                                @endif
                                Rechazados
                            </button>
                        </div>
                    </div>

                    <div class="datatable-fix w-100 mt-4">
                        <table id="datatable_timesheet_empleados" class="table w-100 datatable_timesheet_registros_reportes">
                            <thead class="w-100">
                                <tr>
                                    <th>Semana </th>
                                    <th>Fecha de corte</th>
                                    <th>Empleado</th>
                                    <th>Responsable</th>
                                    <th>Aprobación</th>
                                    <th>opciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($times_empleado as $time)
                                    <tr class="tr_{{  $time->estatus }}">
                                        <td>
                                            {!! $time->semana !!}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($time->fecha_dia)->format("d/m/Y") }}
                                        </td>
                                        <td>
                                            {{ $time->empleado->name }}
                                        </td>
                                        <td>
                                            {{ $time->aprobador->name }}
                                        </td>
                                        <td>
                                            @if($time->estatus == 'aprobado')
                                                <span class="aprobado">Aprobada</span>
                                            @endif

                                            @if($time->estatus == 'rechazado')
                                                <span class="rechazado">Rechazada</span>
                                            @endif

                                            @if($time->estatus == 'pendiente')
                                                <span class="pendiente">Pendiente</span>
                                            @endif

                                            @if($time->estatus == 'papelera')
                                                <span class="papelera">Borrador</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ asset('admin/timesheet/show') }}/{{ $time->id }}" title="Visualizar" class="btn"><i class="fa-solid fa-eye"></i></a>
                                        </td>                       
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', ()=>{
            Livewire.on('scriptTabla', ()=>{
                cont = 7;
                tablaLivewire('datatable_timesheet_empleados');
            });
            
        });
    </script>

</div>
