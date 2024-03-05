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
<div>
    <div style="align-items: end">
        <div class="col-12">
            <div class="planesTrabajoTitle">
                <p class="m-0">Planes de trabajo</p>
            </div>
            {{-- <div class="row">
                <div class="col-4">
                    <div class="rowMostrado">
                        <form class="form-inline">
                            <label class="my-1 mr-2" for="perPageSelect">Mostrando</label>
                            <select class="custom-select my-1 mr-sm-2" id="perPageSelectPer" wire:model.lazy="perPage">
                                <option selected>selecione una opcion</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <div class="card-body datatable-fix">
        <div class="table-responsive">
            <table class="table table-bordered w-100" id="tblPlanesAccion">
                <thead class="thead-dark">
                    <tr>
                        <th style="min-width:150px;">Nombre</th>
                        {{-- <th style="min-width:100px;">Norma</th> --}}
                        <th style="min-width:200px;">Módulo de Origen </th>
                        <th style="min-width:200px;">Objetivo</th>
                        <th style="min-width:20px; text-align: center;">Elaboró</th>
                        <th style="min-width:70px; text-align: center;">%Avance</th>
                        <th style="min-width:100px; text-align: center;">Fecha de Inicio</th>
                        <th style="min-width:80px; text-align: center;">Fecha de Fin</th>
                        <th style="min-width:150px; text-align: center;">Estatus</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($planImplementacions as $plan)
                        <tr class="tablebody">
                            <td>{{ $plan->parent }}</td>
                            {{-- <td>{{ $plan->norma }}</td> --}}
                            <td>{{ $plan->modulo_origen }}</td>
                            <td>{{ $plan->objetivo }}</td>
                            <td>
                                @if ($plan->elaboro_id)
                                    <div class="person">
                                        <img class="person-img" title="{{ $plan->elaborador->name ?? 'No disponible' }}"
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
                                        echo '<span class="badge badge-primary">Sin progreso calculable</span>';
                                    }
                                    ?>
                                @else
                                    <span class="badge badge-primary">Sin progreso calculable</span>
                                @endif
                            </td>
                            <td>
                                @if (isset($plan->tasks) && count($plan->tasks) > 0)
                                    <?php
                                    $zero_task = collect($plan->tasks)->first(function ($task) {
                                        return $task->level == 0;
                                    });
                                    if ($zero_task) {
                                        echo date('d-m-Y', $zero_task->start / 1000);
                                    } else {
                                        echo date('d-m-Y');
                                    }
                                    ?>
                                @else
                                    <span class="badge badge-primary">No encontrado</span>
                                @endif
                            </td>
                            <td>
                                @if (isset($plan->tasks) && count($plan->tasks) > 0)
                                    <?php
                                    $zero_task = collect($plan->tasks)->first(function ($task) {
                                        return $task->level == 0;
                                    });
                                    if ($zero_task) {
                                        echo date('d-m-Y', $zero_task->end / 1000);
                                    } else {
                                        echo '<span class="badge badge-primary">No encontrado</span>';
                                    }
                                    ?>
                                @else
                                    <span class="badge badge-primary">No encontrado</span>
                                @endif
                            </td>
                            <td>
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
                            </td>
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

                                <div class="dropdown">
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
                                                <a class="dropdown-item" href="#" title="Eliminar Plan de Acción"><i
                                                        class="fas fa-trash-alt text-danger"></i>

                                                    <form method="POST" action="{{ $urlEliminarPlanAccion }}"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn" type="submit"
                                                            title="Eliminar Plan de Acción"
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

        var table = $('#tblPlanesAccion').DataTable({
            // Personaliza la paginación
            "language": {
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
        $('#perPageSelectPer').change(function() {
            table.page.len($(this).val()).draw();
        });
    });
</script>
