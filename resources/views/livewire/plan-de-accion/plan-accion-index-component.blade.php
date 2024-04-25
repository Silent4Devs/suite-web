<style>
    .datatable-rds table.dataTable thead,
    .dataTables_scroll table.dataTable thead,
    .datatable-fix table.dataTable thead,
    .datatable-rds table.table thead,
    .dataTables_scroll table.table thead,
    .datatable-fix table.table thead {
        background-color: #00000000 !important;
        border: none !important;
        color: #414141 !important;
        border-bottom: 1px solid #CCCCCC !important;
        border-top: 1px solid #CCCCCC !important;
    }

    .datatable-rds td,
    .dataTables_scroll td,
    .datatable-fix td {
        font-size: 14px !important;
        border-bottom: 1px solid #CCCCCC !important;
        padding: 20px 10px !important;
        vertical-align: middle !important;
    }

    .dataTables_length select {
        width: auto !important;
        padding: 4px !important;
        border-radius: 4px !important;
        border: 1px solid var(--unnamed-color-b5b5b5) !important;
        border: 1px solid #B5B5B5 !important;
        border-radius: 5px !important;
        opacity: 1 !important;
    }

    /* Estilos personalizados para el paginado */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0px 1px !important;
        margin: 0px !important;
        background-color: none !important;
        color: #AAAAAA !important;
        border: none !important;
        border-radius: 4px !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #0056b3 !important;
        color: #fff !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #0056b3 !important;
        color: #fff !important;
    }

    .dataTables_wrapper .dataTables_paginate .ellipsis {
        display: none !important;
    }

    .planesTrabajoTitle {
        justify-content: left;
        color: #5A5A5A;
        display: flex;
        flex-wrap: wrap;
        padding: 30px 20px 15px;
        font-size: 20px;
        border-bottom: 1px solid #CCCCCC !important;
    }

    .rowMostrado {
        display: flex;
        flex-wrap: wrap;
        margin-right: 15px;
        margin-left: 15px;
        padding-top: 20px;
    }

    .person {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .person-img {
        border-radius: 50px;
        width: 45px;
        height: 45px;
        object-fit: cover;
        margin-right: 5px;
    }

    .bageDiv {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .danger {
        background-color: #FFECAF;
        color: #ECCE7D;
        border-radius: 10px;
        margin-top: 8px;
        font-weight: 700;
        text-align: center;
        width: 60px;
    }

    .success {
        background-color: #DEFFE6;
        color: #42A500;
        border-radius: 10px;
        margin-top: 8px;
        font-weight: 700;
        text-align: center;
        width: 60px;
    }

    .warning {
        background-color: #FFDFDF;
        color: #FF5C3A;
        border-radius: 10px;
        margin-top: 8px;
        font-weight: 700;
        text-align: center;
        width: 60px;
    }

    .STATUS_UNDEFINED-estatusColor {
        background-color: #FFECAF;
        color: #ECCE7D;
        border-radius: 10px;
        margin-top: 8px;
        font-weight: 700;
        text-align: center;
        width: 100px;
    }

    .STATUS_ACTIVE-estatusColor {
        background-color: #DEEFFF;
        color: #0080FF;
        border-radius: 10px;
        margin-top: 8px;
        font-weight: 700;
        text-align: center;
        width: 100px;
    }

    .STATUS_DONE-estatusColor {
        background-color: #DEFFE6;
        color: #42A500;
        border-radius: 10px;
        margin-top: 8px;
        font-weight: 700;
        text-align: center;
        width: 100px;
    }

    .STATUS_FAILED-estatusColor {
        background-color: #FFDFDF;
        color: #FF5C3A;
        border-radius: 10px;
        margin-top: 8px;
        font-weight: 700;
        text-align: center;
        width: 100px;
    }

    .STATUS_SUSPENDED-estatusColor {
        background-color: #EEEEEE;
        color: #818181;
        border-radius: 10px;
        margin-top: 8px;
        font-weight: 700;
        text-align: center;
        width: 100px;
    }

    .btn.btn-option,
    {
    background-color: #057BE2 !important;
    color: #fff !important;
    }
</style>
<div class="table-plan-acc-index">
    <div class="card-body datatable-fix" style="padding-top: 25px;">
        <div class="table-responsive">
            <table class="table table-bordered w-100" id={{ $message }}>
                <thead class="thead-dark">
                    <tr>
                        <th style="min-width:150px;">Nombre</th>
                        <th style="min-width:145px;">Módulo de Origen </th>
                        <th style="min-width:200px;">Objetivo</th>
                        <th style="min-width:20px; text-align: center;">Elaboró</th>
                        <th style="min-width:70px; text-align: center;">% Avance</th>
                        <th style="min-width:100px; text-align: center;">Fecha de Inicio</th>
                        <th style="min-width:80px; text-align: center;">Fecha de Fin</th>
                        {{-- <th style="min-width:150px; text-align: center;">Estatus</th> --}}
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                        $datosTabla = null;
                    @endphp

                    @if ($message == 'TbTableUsuario')
                        @php
                            $datosTabla = $planImplementacions;
                        @endphp
                    @elseif ($message == 'OtroMensaje')
                        @php
                            $datosTabla = $planImplementacionsAssigs;
                        @endphp
                    @elseif ($message == 'OtroMensajeMas')
                        {{-- Asigna los datos correspondientes si el mensaje es otro --}}
                    @endif
                    @if ($datosTabla)
                        @foreach ($datosTabla as $plan)
                            <tr class="tablebody">
                                <td>{{ $plan->parent }}</td>
                                <td>{{ $plan->modulo_origen }}</td>
                                <td style="text-align: justify;">{{ $plan->objetivo }}</td>
                                <td>
                                    @if ($plan->elaboro_id)
                                        <div class="person">
                                            <img class="person-img"
                                                title="{{ $plan->elaborador->name ?? 'No disponible' }}"
                                                src="{{ asset('storage/empleados/imagenes') }}/{{ $plan->elaborador->foto ?? 'usuario_no_cargado.png' }}" />
                                        </div>
                                    @else
                                        <span class="badge badge-primary">Elaborado por el sistema</span>
                                    @endif
                                </td>
                                <td>
                                    @if (isset($plan->tasks) && count($plan->tasks) > 0)
                                        <?php
                                        $zero_task = collect($plan->tasks)->first(function ($task) {
                                            return $task->level == 0;
                                        });
                                        if ($zero_task) {
                                            $progress = ceil($zero_task->progress);
                                            if ($progress >= 90) {
                                                echo '<div class="bageDiv"><div class="success">' . $progress . '%</div></div>';
                                            } elseif ($progress >= 60) {
                                                echo '<div class="bageDiv"><div class="warning">' . $progress . '%</div></div>';
                                            } else {
                                                echo '<div class="bageDiv"><div class="danger">' . $progress . '%</div></div>';
                                            }
                                        } else {
                                            echo '<div class="bageDiv"><div class="danger">' . 0 . '%</div></div>';
                                        }
                                        ?>
                                    @else
                                        <div class="bageDiv">
                                            <div class="danger">0%</div>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if (isset($plan->tasks) && count($plan->tasks) > 0)
                                        <?php
                                        $zero_task = collect($plan->tasks)->first(function ($task) {
                                            return $task->level == 0;
                                        });
                                        echo '<div id="zero-task-value" style="display: none;">' . json_encode($zero_task) . '</div>';
                                        if ($zero_task) {
                                            echo '<div style="display: flex;justify-content: center;">' . date('d-m-Y', $zero_task->start / 1000) . '</div>';
                                        } else {
                                            echo date('d-m-Y');
                                        }
                                        ?>
                                    @else
                                        <span style="display: flex;justify-content: center;">S/N</span>
                                    @endif
                                </td>
                                <td>
                                    @if (isset($plan->tasks) && count($plan->tasks) > 0)
                                        <?php
                                        $zero_task = collect($plan->tasks)->first(function ($task) {
                                            return $task->level == 0;
                                        });
                                        if ($zero_task) {
                                            echo '<div style="display: flex;justify-content: center;">' . date('d-m-Y', $zero_task->end / 1000) . '</div>';
                                        } else {
                                            echo '<span class="badge badge-primary">No encontrado</span>';
                                        }
                                        ?>
                                    @else
                                        <span style="display: flex;justify-content: center;">S/N</span>
                                    @endif
                                </td>
                                {{-- <td>
                                @if (isset($plan->tasks) && count($plan->tasks) > 0)
                                    <?php
                                    $zero_task = collect($plan->tasks)->first(function ($task) {
                                        return $task->level == 0;
                                    });
                                    if ($zero_task) {
                                        $statusText = '';
                                        if ($zero_task->status === 'STATUS_ACTIVE') {
                                            $statusText = 'En proceso';
                                        } elseif ($zero_task->status === 'STATUS_DONE') {
                                            $statusText = 'Completado';
                                        } elseif ($zero_task->status === 'STATUS_FAILED') {
                                            $statusText = 'Retrasado';
                                        } elseif ($zero_task->status === 'STATUS_SUSPENDED') {
                                            $statusText = 'Suspendido';
                                        } elseif ($zero_task->status === 'STATUS_UNDEFINED') {
                                            $statusText = 'Lista de tareas';
                                        } else {
                                            $statusText = 'Desconocido';
                                        }
                                        echo '<div class="bageDiv"><div class="' . $zero_task->status . '-estatusColor">' . $statusText . '</div></div>';
                                    } else {
                                        echo '<div class="bageDiv"><div class="STATUS_SUSPENDED-estatusColor">Desconocido</div></div>';
                                    }
                                    ?>
                                @else
                                    <div class="bageDiv">
                                        <div class="STATUS_SUSPENDED-estatusColor">Desconocido</div>
                                    </div>
                                @endif
                            </td> --}}
                                <td>
                                    <?php
                                    $urlVerPlanAccion = '';
                                    $urlEditarPlanAccion = route('admin.planes-de-accion.edit', $plan);

                                    if ($plan->norma == 'ISO 27001') {
                                        $urlEditarPlanAccion = route('admin.planes-de-accion.edit', $plan);
                                    }

                                    $urlEliminarPlanAccion = route('admin.planes-de-accion.destroy', $plan->id);
                                    $urlVerPlanAccion = $plan->id == 1 ? route('admin.planTrabajoBase.index') : route('admin.planes-de-accion.show', $plan->id);
                                    ?>

                                    <div class="dropdown"
                                        style="display: flex;justify-content: center;justify-items: center;">
                                        <button class="btn btn-option" type="button" id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            @can('planes_de_accion_editar')
                                                <a class="dropdown-item" href="{{ $urlEditarPlanAccion }}"
                                                    title="Editar Plan"><i class="fas fa-edit"></i> Editar Plan</a>
                                            @endcan
                                            @can('planes_de_accion_visualizar_diagrama')
                                                <a class="dropdown-item" href="{{ $urlVerPlanAccion }}" title="Ver plan"><i
                                                        class="fas fa-stream"></i> Ver plan</a>
                                            @endcan

                                            @if ($plan->id > 1)
                                                @can('planes_de_accion_eliminar')
                                                    <a class="dropdown-item" href="#"
                                                        title="Eliminar Plan de Trabajo"><i
                                                            class="fas fa-trash-alt text-danger"></i>

                                                        <form method="POST" action="{{ $urlEliminarPlanAccion }}"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn" type="submit"
                                                                title="Eliminar Plan de Trabajo"
                                                                style="width: -webkit-fill-available; text-align: left; padding-left: 0px;">Eliminar</button>
                                                        </form>
                                                    </a>
                                                @endcan
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                <tbody>
                    <!-- Aquí se cargarán los datos dinámicamente -->
                </tbody>
                </tbody>
            </table>
            <div class="row">
                <div class="col-6 p-0" style="display: flex;justify-content: end">
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        if (!$.fn.DataTable.isDataTable('#TbTableUsuario')) {
            // Solo inicializa DataTables si no se ha inicializado previamente
            $('#TbTableUsuario').DataTable({
                "language": {
                    "url": "{{ asset('js/Spanish.json') }}"
                }
            });
        }
        if (!$.fn.DataTable.isDataTable('#TbTableAsignado')) {
            // Solo inicializa DataTables si no se ha inicializado previamente
            $('#TbTableAsignado').DataTable({
                "language": {
                    "url": "{{ asset('js/Spanish.json') }}"
                }
            });
        }
        if (!$.fn.DataTable.isDataTable('#TbTableArea')) {
            // Solo inicializa DataTables si no se ha inicializado previamente
            $('#TbTableArea').DataTable({
                "language": {
                    "url": "{{ asset('js/Spanish.json') }}"
                }
            });
        }
    });
</script>
