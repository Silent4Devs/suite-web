<div class="caja_anima_reporte">
    <div class="w-100">
        
        <div class="datatable-fix mt-5">
            <table id="datatable_timesheet_proyectos" class="table">
                <thead>
                    <tr>
                        <th style="min-width:250px;">Proyecto </th>
                        <th style="min-width:250px;">Área a la que pertenece</th>
                        <th>Cliente</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proyectos as $proyecto)
                        <tr>
                            <td>{{ $proyecto->proyecto }} </td>
                            <td>{{ $proyecto->area_id ? $proyecto->area->area : '--' }} </td>
                            <td>{{ $proyecto->cliente_id ? $cliente->nombre : '--' }} </td>
                            <td><button class="btn" wire:click="genrarReporte({{ $proyecto->id }})"><i class="fa-solid fa-file-invoice"></i></button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if($proyecto_reporte)
        <div id="reporte_proyecto" class="anima_reporte">
            <button class="btn btn-cerrar" onclick="cerrarVentana('reporte_proyecto')"><i class="fa-solid fa-xmark"></i></button>
            <div class="my-4 d-flex justify-content-between">
                 <h5 style="font-weight:bolder;">Proyecto: <font style="font-weight:lighter;">{{ $proyecto_reporte->proyecto }}</font></h5>
                <button class="btn btn-secundario" onclick="window.print()"><i class="fa-solid fa-print iconos_crear"></i> Imprimir</button>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <h5 style="font-weight:lighter;">Tareas: </h5>

                    <ul class="lista_general">
                        @foreach($tareas_array as $tarea)
                            <li class="general_li">
                                <h4>{{ $tarea['tarea'] }}: <small style="padding:5px;">{{ $tarea['horas_totales'] }}h</small></h4>
                                <ul class="general_li_ul">
                                    @foreach($tarea['empleados'] as $empleado)
                                        <li style="font-size:10px;">
                                            <img src="{{ $empleado['foto'] }}" class="img_empleado mr-2" style="width: 30px; height: 30px; clip-path:circle( 15px at 50% 50%) !important;">
                                            {{ $empleado['name'] }}: 
                                            <strong>{{ $empleado['horas'] }}h</strong></li>
                                        <hr>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-3" style="background:linear-gradient(0deg, rgba(69,125,182,1) 0%, rgba(8,170,157,1) 60%); color:#fff;">   
                    <div class="p-4">
                        <h5 class="text-center">Estadisticas Generales</h5>
                        <div class="mt-3 text-center">Horas Totales Dedicas al Proyecto</div>
                        <h1 class="mt-3 text-center">{{ $total_horas_proyecto }}h</h1>
                        <div class="mt-3"><strong>Área: </strong> {{ $area_proyecto->area }}</div>
                        <div class="mt-3"><strong>Cliente: </strong> {{ $cliente_proyecto ? $cliente_proyecto->nombre : 'sin cliente' }}</div>
                        <div class="mt-3"><strong>Empleados: </strong> 
                            <ul class="pl-2">
                                @foreach($empleados_proyecto as $empleado_p)
                                    <li style="display: flex; align-items: center; margin-top:6px;"><img src="{{ $empleado_p['foto'] }}" class="img_empleado mr-2" style="width: 30px; height: 30px; clip-path:circle( 15px at 50% 50%) !important;"><small> {{ $empleado_p['name'] }}</small></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', ()=>{
            Livewire.on('scriptTabla', ()=>{
                tablaLivewire('datatable_timesheet_proyectos');
            });
        });
    </script>
</div>
