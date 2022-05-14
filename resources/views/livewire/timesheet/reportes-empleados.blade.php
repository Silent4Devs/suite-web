<div class="caja_anima_reporte">
    @php
        use App\Models\Organizacion;
    @endphp
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
                            <td><span class="span_atrasos btn" {{  ($empleado_td['times_atrasados'] > 0) ? 'style=background-color:#FF9D9D;' : 'style=background-color:#69D552;' }} data-toggle="modal" data-target="#modal_semanas_{{ $empleado_td['id'] }}">{{ $empleado_td['times_atrasados'] }} </span></td>
                            <td>
                                <button class="btn" wire:click="buscarEmpleado({{ $empleado_td['id'] }})" title="Generar Reporte">
                                    <i class="fa-solid fa-file-invoice"></i>
                                </button>

                                @if($empleado_td['times_atrasados'] > 0)
                                    <button class="btn" title="Notificar retrasos en Timesheet" data-toggle="modal" data-target="#modal_semanas_{{ $empleado_td['id'] }}">
                                        <i class="fa-solid fa-circle-exclamation" style="color:red;"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal semanas faltantes -->
        @foreach($empleados as $empleado_md)
            <div class="modal fade" id="modal_semanas_{{ $empleado_md['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{ $empleado_md['id'] }}" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel{{ $empleado_md['id'] }}"><font style="font-weight:lighter;">Semanas Faltantes de </font>{{ $empleado_md['name'] }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class=" d-flex justify-content-between"  style="padding: 7px;">    
                        <strong> Semanas sin registrar </strong> <span class="span_atrasos" {{  ($empleado_md['times_atrasados'] > 0) ? 'style=background-color:#FF9D9D;' : 'style=background-color:#69D552;' }}>{{ $empleado_md['times_atrasados'] }} </span>
                    </div>
                    <ul class="list_times_faltantes scroll_estilo mt-3">
                        @foreach($empleado_md['times_faltantes'] as $time_f)
                            <li>
                                {!! $time_f !!} 
                            </li>
                        @endforeach
                    </ul>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn_cancelar" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success" wire:click="correoRetraso({{ $empleado_md['id'] }})" data-dismiss="modal">Notificar Retrasos al Colaborador</button>
                  </div>
                </div>
              </div>
            </div>
        @endforeach
    </div>

    @if($empleado)
        <div id="reporte_empleado" class="anima_reporte">
            <button class="btn btn-cerrar" onclick="cerrarVentana('reporte_empleado')"><i class="fa-solid fa-xmark"></i></button>
            <div class="col-12 my-4 d-flex justify-content-between">
                <h5 style="font-weight:bolder;">Reporte Timesheet: <font style="font-weight:lighter;">{{ $empleado->name }}</font></h5>
                <button class="btn btn-secundario" onclick="imprimirElemento('reporte_empleado_div_imprimir')"><i class="fa-solid fa-print iconos_crear"></i> Imprimir</button>
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
                    <div class="col-12 d-flex justify-content-between">
                        <h5>Registro de Horas por Semana</h5>
                        <div class="btn_estatus_caja">

                        </div>
                    </div>
                    <div class="datatable-fix w-100 mt-4">
                        <table id="table_horas_empleado_semanas" class="table w-100">
                            <thead class="w-100">
                                <tr>
                                    <th>Semana</th>
                                    <th>Lunes</th>
                                    <th>Martes</th>
                                    <th>Miercoles</th>
                                    <th>Jueves</th>
                                    <th>Viernes</th>
                                    <th>Sabado</th>
                                    <th>Domingo</th>
                                    <th>Total de horas semanales</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($times_empleado_horas as $time_empleado_horas)
                                    @if(($time_empleado_horas['estatus'] == 'pendiente') || ($time_empleado_horas['estatus'] == 'aprobado'))
                                        <tr>
                                            <td>{!! $time_empleado_horas['semana'] !!}</td>
                                            <td>{{ $time_empleado_horas['horas_lunes'] }} <small>h</small></td>
                                            <td>{{ $time_empleado_horas['horas_martes'] }} <small>h</small></td>
                                            <td>{{ $time_empleado_horas['horas_miercoles'] }} <small>h</small></td>
                                            <td>{{ $time_empleado_horas['horas_jueves'] }} <small>h</small></td>
                                            <td>{{ $time_empleado_horas['horas_viernes'] }} <small>h</small></td>
                                            <td>{{ $time_empleado_horas['horas_sabado'] }} <small>h</small></td>
                                            <td>{{ $time_empleado_horas['horas_domingo'] }} <small>h</small></td>
                                            <td>{{ $time_empleado_horas['horas_totales'] }} <small>h</small></td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>  
                </div>
                <div class="col-12" style="margin-top: 55px;">
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

        {{-- div para imprimir __________________________________________________________________________ --}}
        @php
            $organizacion = Organizacion::select('id', 'logotipo', 'empresa')->first();
            if (!is_null($organizacion)) {
                $logotipo = $organizacion->logotipo;
            } else {
                $logotipo = 'logotipo-tabantaj.png';
            }
        @endphp
        <div id="reporte_empleado_div_imprimir" class="solo-print">
            <table class="encabezado-print">
                <tr>
                    <td style="width: 25%;">
                        <img src="{{ asset($logotipo) }}" class="img_logo" style="height: 70px;">
                    </td>
                    <td style="width: 50%;">
                        <h4><strong>{{ $organizacion->empresa }}</strong></h4>
                        <h5 style="font-weight: bolder;">Timesheet: <font style="font-weight:lighter;">{{ $empleado->name }}</font></h5>
                    </td>
                    <td style="width: 25%;"class="encabezado_print_td_no_paginas">
                        Fecha: {{ $hoy_format }} <br>
                    </td>
                </tr>
            </table>
            <h5 style="font-weight:bolder;">Reporte Timesheet: <font style="font-weight:lighter;">{{ $empleado->name }}</font></h5>
            <div style="width:100%; display:flex;">
                <div>
                    <h5 style="font-weight:lighter;">Proyectos: </h5>
                    <ul class="lista_general">
                        @foreach($proyectos_detalle as $proyecto)
                            <li class="general_li" style="overflow:unset !important;">
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
                <div style="width: 20%;">
                    <div style="background:linear-gradient(0deg, rgba(69,125,182,1) 0%, rgba(8,170,157,1) 60%); color:#fff;">   
                        <div class="p-4">
                            <h5 class="text-center">Estadisticas Generales</h5>
                            <div class="mt-3 text-center">Horas Totales</div>
                            <h1 class="mt-3 text-center">{{ $horas_totales }}h</h1>
                            <div class="mt-3"><strong>Puesto:</strong> {{ $empleado->puesto }}</div>
                            <div class="mt-3"><strong>Área:</strong> {{ $empleado->area ? $empleado->area->area : ''}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <h5>Registro de Horas por Semana</h5>
            <div class="w-100 mt-4">
                <table id="table_horas_empleado_semanas_print" class="table w-100">
                    <thead class="w-100">
                        <tr>
                            <th>Semana</th>
                            <th>Lunes</th>
                            <th>Martes</th>
                            <th>Miercoles</th>
                            <th>Jueves</th>
                            <th>Viernes</th>
                            <th>Sabado</th>
                            <th>Domingo</th>
                            <th>Total de horas semanales</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($times_empleado_horas as $time_empleado_horas)
                            <tr>
                                <td>{!! $time_empleado_horas['semana'] !!}</td>
                                <td>{{ $time_empleado_horas['horas_lunes'] }} <small>h</small></td>
                                <td>{{ $time_empleado_horas['horas_martes'] }} <small>h</small></td>
                                <td>{{ $time_empleado_horas['horas_miercoles'] }} <small>h</small></td>
                                <td>{{ $time_empleado_horas['horas_jueves'] }} <small>h</small></td>
                                <td>{{ $time_empleado_horas['horas_viernes'] }} <small>h</small></td>
                                <td>{{ $time_empleado_horas['horas_sabado'] }} <small>h</small></td>
                                <td>{{ $time_empleado_horas['horas_domingo'] }} <small>h</small></td>
                                <td>{{ $time_empleado_horas['horas_totales'] }} <small>h</small></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> 
            <h5>Registros del Empleado</h5>
            <div class="w-100 mt-4">
                <table class="table w-100">
                    <thead class="w-100">
                        <tr>
                            <th>Semana </th>
                            <th>Fecha de corte</th>
                            <th>Empleado</th>
                            <th>Responsable</th>
                            <th>Aprobación</th>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', ()=>{
            Livewire.on('scriptTabla', ()=>{
                tablaLivewire('table_horas_empleado_semanas');
            });
        });
    </script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', ()=>{
            Livewire.on('cerrarModal', ()=>{
                $('.modal-backdrop').modal('hide');
            });
        });
    </script>
</div>
