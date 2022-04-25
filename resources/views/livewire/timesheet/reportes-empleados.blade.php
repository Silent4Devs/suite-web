<div class="caja_anima_reporte">
    <div class="row">
        <div class="datatable-fix w-100 mt-4">
            <table id="timesheet_empleados_lista" class="table w-100 datatable_timesheet_registros_reportes">
                <thead class="w-100">
                    <tr>
                        <th>Foto</th>
                        <th>Nombre </th>
                        <th>Área</th>
                        <th>Puesto</th>
                        <th>Retrasos</th>
                        <th>opciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($empleados as $empleado_td)
                        <tr>
                            <td><img src="{{ $empleado_td['avatar_ruta'] }}" class="img_empleado"></td>
                            <td>{{ $empleado_td['name'] }}</td>
                            <td>{{ $empleado_td['area'] }}</td>
                            <td>{{ $empleado_td['puesto'] }}</td>
                            <td><span class="span_atrasos" {{  ($empleado_td['times_atrasados'] > 0) ? 'style=background-color:#FF9D9D;' : 'style=background-color:#AEFF9D;' }}>{{ $empleado_td['times_atrasados'] }} semanas</span></td>
                            <td>
                                <button class="btn" wire:click="buscarEmpleado({{ $empleado_td['id'] }})" title="Generar Reporte">
                                    <i class="fa-solid fa-file-invoice"></i>
                                </button>
                                <button class="btn" title="Notificar retrasos en Timesheet">
                                    <i class="fa-solid fa-circle-exclamation" style="color:red;"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if($empleado)
        <div id="reporte_empleado" class="anima_reporte">
            <button class="btn btn-cerrar" onclick="cerrarVentana('reporte_empleado')"><i class="fa-solid fa-xmark"></i></button>
            <div class="col-12 my-4 d-flex justify-content-between">
                <h5 style="font-weight:bolder;">Reporte Timesheet: <font style="font-weight:lighter;">{{ $empleado->name }}</font></h5>
                <button class="btn btn-secundario" onclick="window.print()"><i class="fa-solid fa-print iconos_crear"></i> Imprimir</button>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <h5 style="font-weight:lighter;">Proyectos: </h5>
                    <ul class="lista_general">
                        @foreach($proyectos_detalle as $proyecto)
                            <li class="general_li">
                                <h4>{{ $proyecto['proyecto'] }}: <small style="padding:5px;">{{ $proyecto['horas'] }}h</small></h4>
                                <ul class="general_li_ul">
                                    <h5>Tareas</h5>
                                    @foreach($proyecto['tareas'] as $tarea)
                                        <li>{{ $tarea['tarea'] }}: <small>{{ $tarea['horas'] }}h</small></li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-3" style="background:linear-gradient(0deg, rgba(69,125,182,1) 0%, rgba(8,170,157,1) 60%); color:#fff;">   
                    <div class="p-4">
                        <h5 class="text-center">Estadisticas Generales</h5>
                        <div class="mt-3 text-center">Horas Totales</div>
                        <h1 class="mt-3 text-center">{{ $horas_totales }}h</h1>
                        <div class="mt-3"><strong>Puesto:</strong> {{ $empleado->puesto }}</div>
                        <div class="mt-3"><strong>Área:</strong> {{ $empleado->area ? $empleado->area->area : ''}}</div>
                    </div>
                </div>
                <div class="col-12" style="margin-top: 55px;">
                    <div class="row">
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
        </div>
    @endif

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', ()=>{
            Livewire.on('scriptTabla', ()=>{
                tablaLivewire('timesheet_empleados_lista');
            });
        });
    </script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', ()=>{
            Livewire.on('scriptTabla', ()=>{
                tablaLivewire('datatable_timesheet_empleados');
            });
        });
    </script>

</div>
