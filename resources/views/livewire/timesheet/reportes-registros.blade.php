<div>    
    <div class="row" wire:ignore>
        <div class="col-md-4 form-group">
            <label class="form-label">Área</label>
            <select class="form-control" wire:model="area_id">
                <option selected value="0">Todas</option>
                @foreach($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->area }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 form-group">
            <label class="form-label">Fecha de inicio</label>
            <input class="form-control date_librery" type="date" name="fecha_inicio" wire:model="fecha_inicio">
        </div>
        <div class="col-md-4 form-group">
            <label class="form-label">Fecha de fin</label>
            <input class="form-control date_librery" type="date" name="fecha_fin" wire:model="fecha_fin">
        </div>
    </div>
    <div class="row mt-5">
        @include('partials.flashMessages')
        <div class="col-12 d-flex justify-content-between" style="padding-left: 0 !important; padding-right: 0 !important;">
            <h5 id="titulo_estatus">Registros Timesheet</h5>
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
            <table id="datatable_timesheet" class="table w-100 datatable_timesheet_registros_reportes">
                <thead class="w-100">
                    <tr>
                        <th >Semana </th>
                        <th >Empleado</th>
                        <th >Aprobador</th>
                        <th style="min-width:250px;">Área</th>
                        <th>Estatus</th>
                        <th>Opciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($times as $time)
                        <tr class="tr_{{  $time->estatus }}">
                            <td>
                                {!! $time->semana !!}
                            </td>                            
                            <td>
                                {{ $time->empleado->name }}
                            </td>
                            <td>
                                {{ $time->aprobador->name }}
                            </td>
                            <td>
                                {{ $time->empleado->area->area }}
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

                                {{-- @if(($time->estatus == 'papelera') || ($time->estatus == 'rechazado'))
                                    <a href="{{ asset('admin/timesheet/edit') }}/{{ $time->id }}" title="Editar" class="btn"><i class="fa-solid fa-pen-to-square"></i></a>
                                @endif

                                
                                @if(($time->estatus == 'papelera') || ($time->estatus == 'rechazado'))
                                    <button title="Eliminar" class="btn" style="color:red;" data-toggle="modal" data-target="#alert_time_delet_{{ $time->id }}"><i class="fa-solid fa-trash-can"></i></button>
                                @endif --}}
                            </td>                       
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', ()=>{
            Livewire.on('scriptTabla', ()=>{
                tablaLivewire('datatable_timesheet');
            });
        });
    </script>
</div>
