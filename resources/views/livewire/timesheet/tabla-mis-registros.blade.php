<div>
    @include('admin.timesheet.complementos.cards')
    @include('admin.timesheet.complementos.admin-aprob')
    @include('admin.timesheet.complementos.blue-card-header')
    <x-loading-indicator />

    <div class="card card-body">
        <div class="row">
            @include('partials.flashMessages')
            <div class="col-12 d-flex justify-content-between">
                <h5 id="titulo_estatus">{{ $estatusText }}</h5>
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
