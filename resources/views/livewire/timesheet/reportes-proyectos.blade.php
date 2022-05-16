<div class="caja_anima_reporte">
    @php
        use App\Models\Organizacion;
    @endphp
    <div class="w-100">
        
        <div class="datatable-fix mt-5">
            <table id="datatable_timesheet_proyectos" class="table w-100">
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
                            <td>{{ $proyecto->cliente_id ? $proyecto->cliente->nombre : '--' }} </td>
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
                <button class="btn btn-secundario" onclick="imprimirElemento('reporte_proyecto_div_imprimir')"><i class="fa-solid fa-print iconos_crear"></i> Imprimir</button>
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
                                            <label><strong class="horas_tarea_empleado{{ $empleado['id'] }}" data-empleado="{{ $empleado['id'] }}">{{ $empleado['horas'] }}</strong>&nbsp;h</label></li>
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
                        <div class="mt-3 text-center">Costo de Horas del Proyecto</div>
                        <h4 class="mt-3 text-center" id="costo_proyecto_total"></h4>
                        <div class="mt-3"><strong>Área: </strong> {{ $area_proyecto->area }}</div>
                        <div class="mt-3"><strong>Cliente: </strong> {{ $cliente_proyecto ? $cliente_proyecto->nombre : 'sin cliente' }}</div>
                    </div>
                </div>
            </div>
            <div class="w-100">
                <div class="datatable-fix mt-5">
                    <table id="datatable_timesheet_proyectos_empleados" class="table w-100">
                        <thead>
                            <tr>
                                <th>Foto </th>
                                <th>Nombre</th>
                                <th>Puesto</th>
                                <th>Área</th>
                                <th>Horas dedicadas</th>
                                <th>Costo de horas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($empleados_proyecto as $empleado_p)
                                <tr>
                                    <td><img src="{{ $empleado_p['foto'] }}" class="img_empleado"></td>
                                    <td>{{ $empleado_p['name'] }}</td>
                                    <td>{{ $empleado_p['puesto'] }}</td>
                                    <td>{{ $empleado_p['area']['area'] }}</td>
                                    <td id="horas_proyecto_empleado{{$empleado_p['id']}}"></td>
                                    <td id="costo_proyecto_empleado{{$empleado_p['id']}}"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @php
            $organizacion = Organizacion::select('id', 'logotipo', 'empresa')->first();
            if (!is_null($organizacion)) {
                $logotipo = $organizacion->logotipo;
            } else {
                $logotipo = 'logotipo-tabantaj.png';
            }
        @endphp
        {{-- div para imprimir __________________________________________ --}}
        <div id="reporte_proyecto_div_imprimir" class="solo-print">
            <table class="encabezado-print">
                <tr>
                    <td style="width: 25%;">
                        <img src="{{ asset($logotipo) }}" class="img_logo" style="height: 70px;">
                    </td>
                    <td style="width: 50%;">
                        <h4><strong>{{ $organizacion->empresa }}</strong></h4>
                        <h5 style="font-weight: bolder;">Proyecto: <font style="font-weight:lighter;">{{ $proyecto_reporte->proyecto }}</font></h5>
                    </td>
                    <td style="width: 25%;">
                        Fecha: {{ $hoy_format }}
                    </td>
                </tr>
            </table>
            <h5 style="font-weight:bolder;">Reporte Timesheet Proyecto: <font style="font-weight:lighter;">{{ $proyecto_reporte->proyecto }}</font></h5>
            <div style="width:100%; display:flex;">
                <div>
                    <h5 style="font-weight:lighter;">Tareas: </h5>
                    <ul class="lista_general">
                        @foreach($tareas_array as $tarea)
                            <li class="general_li" style="overflow:unset !important;">
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
                <div style="width: 20%;">
                    <div class="w-100" style="background:linear-gradient(0deg, rgba(69,125,182,1) 0%, rgba(8,170,157,1) 60%); color:#fff;">   
                        <div class="p-4">
                            <h5 class="text-center">Estadisticas Generales</h5>
                            <div class="mt-3 text-center">Horas Totales Dedicas al Proyecto</div>
                            <h1 class="mt-3 text-center">{{ $total_horas_proyecto }}h</h1>
                            <div class="mt-3 text-center">Costo de Horas del Proyecto</div>
                            <h4 class="mt-3 text-center" id="costo_proyecto_total_print"></h4>
                            <div class="mt-3"><strong>Área: </strong> {{ $area_proyecto->area }}</div>
                            <div class="mt-3"><strong>Cliente: </strong> {{ $cliente_proyecto ? $cliente_proyecto->nombre : 'sin cliente' }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100">
                <div class="datatable-fix mt-5">
                    <h5><strong>Empleados en el Proyecto</strong></h5>
                    <table id="datatable_timesheet_proyectos_empleados_print" class="table w-100">
                        <thead>
                            <tr>
                                <th>Foto </th>
                                <th>Nombre</th>
                                <th>Puesto</th>
                                <th>Área</th>
                                <th>Horas dedicadas</th>
                                <th>Costo de horas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($empleados_proyecto as $empleado_p)
                                <tr>
                                    <td><img src="{{ $empleado_p['foto'] }}" class="img_empleado"></td>
                                    <td>{{ $empleado_p['name'] }}</td>
                                    <td>{{ $empleado_p['puesto'] }}</td>
                                    <td>{{ $empleado_p['area']['area'] }}</td>
                                    <td id="horas_proyecto_empleado_print{{$empleado_p['id']}}"></td>
                                    <td id="costo_proyecto_empleado_print{{$empleado_p['id']}}"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            let costo_proyecto_total = 0;
            let total_horas = 0;
            let costo_proyecto_empleado = 0;
            let horas_empleado_horas;
            let salario_hora;
            @foreach($empleados_proyecto as $empleado_p)
                total_horas = 0;
                salario_hora = 0; 
                costo_proyecto_empleado = 0;
                horas_empleado_horas = document.querySelectorAll('.horas_tarea_empleado{{ $empleado_p['id'] }}');  
                total_horas = 0;
                horas_empleado_horas.forEach(function(horas){
                   total_horas += Number(horas.innerText);
                });
                document.getElementById('horas_proyecto_empleado{{$empleado_p['id']}}').innerHTML = total_horas + ' <small>h</small>';
                document.getElementById('horas_proyecto_empleado_print{{$empleado_p['id']}}').innerHTML = total_horas + ' <small>h</small>';

                salario_hora = ({{ $empleado_p['salario_diario'] ? $empleado_p['salario_diario'] : '0' }}) / 24;
                costo_proyecto_empleado = (salario_hora * total_horas).toFixed(2);
                document.getElementById('costo_proyecto_empleado{{$empleado_p['id']}}').innerHTML = '<strong>$</strong> ' + costo_proyecto_empleado;
                document.getElementById('costo_proyecto_empleado_print{{$empleado_p['id']}}').innerHTML = '<strong>$</strong> ' + costo_proyecto_empleado;

                costo_proyecto_total += Number(costo_proyecto_empleado);
            @endforeach
            document.getElementById('costo_proyecto_total').innerHTML = '<strong>$</strong> ' + costo_proyecto_total;
            document.getElementById('costo_proyecto_total_print').innerHTML = '<strong>$</strong> ' + costo_proyecto_total;
        </script>
    @endif
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', ()=>{
            Livewire.on('scriptTabla', ()=>{
                tablaLivewire('datatable_timesheet_proyectos');
            });
        });
    </script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', ()=>{
            Livewire.on('scriptTabla', ()=>{
                tablaLivewire('datatable_timesheet_proyectos_empleados');
            });
        });
    </script>
</div>
