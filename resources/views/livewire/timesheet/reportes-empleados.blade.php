<div class="caja_anima_reporte">
    @php
        use App\Models\Organizacion;
    @endphp
    <div class="row">
        <div class="col-md-3 form-group">
            <label class="form-label">Área</label>
            <select class="form-control" wire:model="area_id">
                <option selected value="0">Todas</option>
                @foreach($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->area }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 form-group" wire:ignore>
            <label class="form-label">Fecha de inicio</label>
            <input id="fecha_dia_registros_inicio_empleados" class="form-control date_librery" type="date" name="fecha_inicio" wire:model="fecha_inicio">
        </div>
        <div class="col-md-3 form-group" wire:ignore>
            <label class="form-label">Fecha de fin</label>
            <input id="fecha_dia_registros_fin_empleados" class="form-control date_librery" type="date" name="fecha_fin" wire:model="fecha_fin">
        </div>
        <div class="col-md-2 form-group">
            <label class="form-label">Horas totales</label>
            <div class="form-control">{{ $horas_totales_filtros_empleados }} h</div>
        </div>
        <div class="col-md-1 form-group">
            <label class="form-label" style="width:100%;">&nbsp;</label><br>
            <a href="" class="btn btn-info"><i class="fa-solid fa-arrow-rotate-right"></i></a>
        </div>
        <style type="text/css">
            .cde-nombre.ver{
                position: sticky;
                left: 68px !important;
            }
            .cde-puesto.ver{
                position: sticky; 
                left: 140px !important;
            }
            .cde-area.ver{
                position: sticky; 
                left: 202px !important;
            }
            .cde-totalh.ver{
                position: sticky; 
                right: 206px !important;
            }
            .cde-semenasf.ver{
                position: sticky; 
                right: 124px !important;
            }
            .ver{ 
                z-index: 2; 
            }
            
            .cde-foto{
                position: sticky !important; 
                left: 0px; 
                z-index: 6;
            }
            .cde-nombre{
                position: sticky !important;
                left: -50px;
                z-index: 5;
            }
            .cde-puesto{
                position: sticky !important; 
                left: 10px;
                z-index: 4;
            }
            .cde-area{
                position: sticky !important; 
                left: 60px;
                z-index: 3;
            }
            .cde-estatus{
                position: sticky !important; 
                left: 250px;
                z-index: 2;
            }
            .cde-totalh{
                position: sticky !important; 
                right: 205px;
                z-index: 3;
            }
            .cde-semenasf{
                position: sticky !important; 
                right: 124px;
                z-index: 2;
            }
            .cde-op{
                position: sticky !important; 
                right: 0px; 
                z-index: 6;
            }

            .cde-nombre,
            .cde-puesto,
            .cde-area,
            .cde-estatus,
            .cde-totalh,
            .cde-semenasf{ 
                transition: 0.3s;
            }
            .cde-nombre::before,
            .cde-puesto::before,
            .cde-area::before,
            .cde-estatus::before{ 
                content: "";
                position: absolute;
                width: 1px;
                height: 100%;
                top: 0;
                right: 0;
                background-color: grey;
             }
            tfoot .cde-nombre::before,
            tfoot .cde-puesto::before,
            tfoot .cde-area::before,
            tfoot .cde-estatus::before{ 
                content: "";
                opacity: 0 !important;
            }
            @media(max-width: 1200px){
                .cde-nombre,
                .cde-puesto,
                .cde-area,
                .cde-estatus,
                .cde-totalh,
                .cde-semenasf{ 
                    position: unset !important;
                }
            }
        </style>
        <div class="datatable-fix w-100 mt-4">
            <table id="timesheet_empleados_lista" class="table w-100 datatable_timesheet_empleados_reportes tabla-fixed" data-semanas="{{ $semanas_totales_calendario }}">
                <thead class="w-100">
                    <tr>
                        <th class="cde-foto">Foto</th>
                        <th class="cde-nombre" style="text-align: right;">Nombre </th>
                        <th class="cde-puesto" style="text-align: right;">Puesto</th>
                        <th class="cde-area" style="text-align: right;">Área</th>
                        <th class="cde-estatus" style="text-align: right;">Estatus</th>
                        @foreach($calendario_tabla as $calendar)
                            <th colspan="{{ $calendar['total_weeks'] }}" class="th-calendario th-año"><small>{{ $calendar['year'] }}</small></th>
                        @endforeach
                        <th class="cde-totalh">Total (hrs)</th>
                        <th class="cde-semenasf">Semanas sin&nbsp;registrar</th>
                        <th style="min-width:100px;" class="cde-op">Opciones</th>
                    </tr>
                    <tr>
                        <th class="cde-foto"></th>
                        <th class="cde-nombre"></th>
                        <th class="cde-puesto"></th>
                        <th class="cde-area"></th>
                        <th class="cde-estatus"></th>
                        @foreach($calendario_tabla as $calendar)
                            @foreach($calendar['months'] as $key=>$mes)
                                <th colspan="{{ $mes['total_weeks'] }}" class="th-calendario th-mes"><small>{{ $key }}</small></th>
                            @endforeach
                        @endforeach
                        <th class="cde-totalh"></th>
                        <th class="cde-semenasf"></th>
                        <th class="cde-op"></th>
                    </tr>
                    <tr>
                        <th class="cde-foto"></th>
                        <th style="min-width: 150px;" class="cde-nombre"></th>
                        <th style="min-width: 150px;" class="cde-puesto"></th>
                        <th style="min-width: 150px;" class="cde-area"></th>
                        <th class="cde-estatus"></th>
                        @foreach($calendario_tabla as $calendar)
                            @foreach($calendar['months'] as $key=>$mes)
                                @foreach($mes['weeks'] as $week)
                                @php
                                    $semanas_time_array = explode('|', $week);
                                    $fecha_inicio_time = $semanas_time_array['0'];
                                    $fecha_fin_time = $semanas_time_array['1'];
                                    $fecha_inicio_time = \Carbon\Carbon::parse($fecha_inicio_time)->format('d');
                                    $fecha_fin_time = \Carbon\Carbon::parse($fecha_fin_time)->format('d');
                                @endphp
                                    <th class="th-calendario th-semana"><small>Del&nbsp;<strong>{{ $fecha_inicio_time }}</strong>&nbsp;al&nbsp;<strong>{{ $fecha_fin_time }}</strong></small></th>
                                @endforeach
                            @endforeach
                        @endforeach
                        <th class="cde-totalh"></th>
                        <th class="cde-semenasf"></th>
                        <th class="cde-op"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($empleados as $empleado_td)
                        <tr>
                            <td class="cde-foto"><img src="{{ $empleado_td['avatar_ruta'] }}" class="img_empleado"></td>
                            <td class="cde-nombre">{{ $empleado_td['name'] }}</td>
                            <td class="cde-puesto">{{ $empleado_td['puesto'] }}</td>
                            <td class="cde-area">{{ $empleado_td['area'] }}</td>
                            <td style="text-transform: capitalize;" class="cde-estatus">
                                <span class="empleado_estatus_{{ $empleado_td['estatus'] }}">
                                {{ $empleado_td['estatus'] }}</span>
                            </td>
                            @foreach($empleado_td['calendario'] as $index=>$horas_calendar)
                                <td><small>{!! $horas_calendar !!}</small></td>
                            @endforeach
                            <td class="text-center cde-totalh">{{ $empleado_td['horas_totales'] }} h</td>
                            <td class="d-flex justify-content-center cde-semenasf">
                                <span class="span_atrasos btn" {{  ($empleado_td['times_atrasados'] > 0) ? 'style=background-color:#FF9D9D;' : 'style=background-color:#69D552;' }} data-toggle="modal" data-target="#modal_semanas_{{ $empleado_td['id'] }}">
                                    {{ $empleado_td['times_atrasados'] }} 
                                </span>
                            </td>
                            <td class="cde-op">
                                <button class="btn" wire:click="buscarEmpleado({{ $empleado_td['id'] }})" title="Generar Reporte">
                                    <i class="fa-solid fa-file-invoice" style="color:#173D59 !important;"></i>
                                </button>

                                @if($empleado_td['times_atrasados'] > 0)
                                    <button class="btn" title="Notificar retrasos en Timesheet" data-toggle="modal" data-target="#modal_semanas_{{ $empleado_td['id'] }}">
                                        <i class="fa-solid fa-envelope" style="color:#173D59 !important;"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <td class="cde-foto"></td>
                    <td class="cde-nombre"></td>
                    <td class="cde-puesto"></td>
                    <td class="cde-area"></td>
                    <td class="cde-estatus">Total:</td>
                    @foreach($empleado_td['calendario'] as $index=>$horas_calendar)
                        <td></td>
                    @endforeach
                    <td class="cde-totalh"></td>
                    <td class="cde-semenasf"></td>
                    <td class="cde-op"></td>
                </tfoot>
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
