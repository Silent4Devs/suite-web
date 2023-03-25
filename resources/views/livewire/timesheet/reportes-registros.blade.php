<div>
    <x-loading-indicator />
    <div class="row" wire:ignore>
        <div class="col-md-4 form-group" style="padding-left:0px !important;">
            <label class="form-label">Área</label>
            <select class="form-control" wire:model="area_id">
                <option selected value="0">Todas</option>
                @foreach ($areas as $area)
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
        <div class="col-12 d-flex justify-content-between"
            style="padding-left: 0 !important; padding-right: 0 !important;">
            <h5 id="titulo_estatus">Registros Timesheet</h5>
            <div class="btn_estatus_caja">
                <button class="btn btn-primary"
                    style="background-color: #5AC3E5; border:none !important; position: relative;" id="btn_todos"
                    wire:click="todos">
                    @if ($todos_contador > 0)
                        <span class="indicador_numero" style="filter: contrast(200%);">{{ $todos_contador }}</span>
                    @endif
                    Todos
                </button>
                <button class="btn btn-primary"
                    style="background-color: #aaa; border:none !important; position: relative;" id="btn_papelera"
                    wire:click="papelera">
                    @if ($borrador_contador > 0)
                        <span class="indicador_numero" style="filter: contrast(200%);">{{ $borrador_contador }}</span>
                    @endif
                    Borrador
                </button>
                <button class="btn btn-primary"
                    style="background-color: #F48C16; border:none !important; position: relative;" id="btn_pendiente"
                    wire:click="pendientes">
                    @if ($pendientes_contador > 0)
                        <span class="indicador_numero" style="filter: contrast(200%);">{{ $pendientes_contador }}</span>
                    @endif
                    Pendientes
                </button>
                <button class="btn btn-primary"
                    style="background-color: #61CB5C; border:none !important; position: relative;" id="btn_aprobado"
                    wire:click="aprobados">
                    @if ($aprobados_contador > 0)
                        <span class="indicador_numero" style="filter: contrast(200%);">{{ $aprobados_contador }}</span>
                    @endif
                    Aprobados
                </button>
                <button class="btn btn-primary"
                    style="background-color: #EA7777; border:none !important; position: relative;" id="btn_rechazado"
                    wire:click="rechazos">
                    @if ($rechazos_contador > 0)
                        <span class="indicador_numero" style="filter: contrast(200%);">{{ $rechazos_contador }}</span>
                    @endif
                    Rechazados
                </button>
            </div>
        </div>
        <div class="row w-100 mt-4" style="align-items: end">
            <div class="col-6">
                <div class="row">
                    <div class="col-4">
                        <div class="row" style="justify-content: center">
                            <div class="col-4 p-0" style="font-size: 11px;align-self: center">
                                <p class="m-0">Mostrando</p>
                            </div>
                            <div class="col-4 p-0">
                                <select name="" id="" class="form-control" wire:model="perPage">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="-1">Todos</option>
                                </select>
                            </div>
                            <div class="col-4 p-0" style="font-size: 11px;align-self: center;text-align: end">
                                <p class="m-0">por página</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="col-12" style="text-align: end">
                            @livewire('timesheet.empleados-timesheet-export', ['tipo' => 'xlsx'])
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 p-0" style="text-align: end">
                <div class="row">
                    <div class="col-6 p-0"></div>
                    <div class="col-6 p-0">
                        <input type="text" class="form-control" placeholder="Buscar..." wire:model="search">
                    </div>
                </div>
            </div>
        </div>
        <div class="datatable-fix w-100 mt-2">
            <table class="table w-100 datatable_timesheet_registros_reportes">
                {{-- id="datatable_timesheet" --}}
                <thead class="w-100">
                    <tr>
                        <th>Semana </th>
                        <th>Empleado</th>
                        <th>Aprobador</th>
                        <th style="min-width:250px;">Área</th>
                        <th>Estatus</th>
                        <th>Horas Totales</th>
                        <th>Opciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($times as $time)
                        <tr class="tr_{{ $time->estatus }}">
                            <td>
                                {!! $time->semana !!}
                            </td>
                            <td>
                                @if ($time->empleado)
                                    {{ $time->empleado->name }}
                                @endif
                            </td>
                            <td>
                                @if ($time->aprobador)
                                    {{ $time->aprobador->name }}
                                @endif
                            </td>
                            <td>
                                @if ($time->empleado)
                                    {{ $time->empleado->area->area }}
                                @endif
                            </td>
                            <td>
                                @if ($time->estatus == 'aprobado')
                                    <span class="aprobado">Aprobada</span>
                                @endif

                                @if ($time->estatus == 'rechazado')
                                    <span class="rechazado">Rechazada</span>
                                @endif

                                @if ($time->estatus == 'pendiente')
                                    <span class="pendiente">Pendiente</span>
                                @endif

                                @if ($time->estatus == 'papelera')
                                    <span class="papelera">Borrador</span>
                                @endif
                            </td>
                            <td>
                                {{ $time->total_horas }} <small>h</small>
                            </td>
                            <td>
                                <a href="{{ asset('admin/timesheet/show') }}/{{ $time->id }}" title="Visualizar"
                                    class="btn"><i class="fa-solid fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-6 p-0">
                    <strong>
                        Mostrando {{ $perPage }} de {{ $totalRegistrosMostrando }} resultados @if ($estatus)
                            <span class="badge badge-primary">(filtrando por {{ $estatus }})</span>
                        @endif
                    </strong>
                </div>
                <div class="col-6 p-0" style="display: flex;justify-content: end">
                    {{ $times->links() }}

                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            Livewire.on('scriptTabla', () => {
                tablaLivewire('datatable_timesheet');
            });
        });
    </script>
</div>
