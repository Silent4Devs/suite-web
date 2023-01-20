<div>
    <x-loading-indicator />
    <div class="row">
        @include('partials.flashMessages')
        <div class="col-12 d-flex justify-content-between">
            <h5 id="titulo_estatus">Todos los Registros</h5>
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
                        <span class="indicador_numero"
                            style="filter: contrast(200%);">{{ $pendientes_contador }}</span>
                    @endif
                    Pendientes
                </button>
                <button class="btn btn-primary"
                    style="background-color: #61CB5C; border:none !important; position: relative;" id="btn_aprobado"
                    wire:click="aprobados">
                    @if ($aprobados_contador > 0)
                        <span class="indicador_numero"
                            style="filter: contrast(200%);">{{ $aprobados_contador }}</span>
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

        <div class="datatable-fix w-100 mt-4">
            <table id="datatable_timesheet" class="table w-100 datatable_timesheet_registros_reportes">
                <thead class="w-100">
                    <tr>
                        <th>Semana </th>
                        <th>Estatus</th>
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
                                <a href="{{ asset('admin/timesheet/show') }}/{{ $time->id }}" title="Visualizar"
                                    class="btn"><i class="fa-solid fa-eye"></i></a>
                                @if ($time->estatus == 'papelera' || $time->estatus == 'rechazado')
                                    <a href="{{ asset('admin/timesheet/edit') }}/{{ $time->id }}" title="Editar"
                                        class="btn"><i class="fa-solid fa-pen-to-square"></i></a>
                                @endif
                                {{-- @if ($time->estatus == 'papelera' || $time->estatus == 'rechazado')
                                    <button title="Eliminar" class="btn" style="color:red;" data-toggle="modal" data-target="#alert_time_delet_{{ $time->id }}"><i class="fa-solid fa-trash-can"></i></button>
                                @endif --}}
                                <a href="{{ route('admin.timesheet-create-copia', $time->id) }}" class="btn"
                                    title="Copiar Timesheet">
                                    <i class="fa-solid fa-copy"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            Livewire.on('scriptTabla', () => {
                setTimeout(() => {
                    console.log('liwe');
                    tablaLivewire('datatable_timesheet');
                }, 100);
            });
        });
    </script>
</div>
