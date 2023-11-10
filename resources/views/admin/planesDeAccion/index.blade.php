@extends('layouts.admin')

@section('content')
    <h5 class="col-12 titulo_general_funcion">Planes de acción</h5>

    <div class="mt-3 card">
        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <table class="table table-bordered w-100" id="tblPlanesAccion">
                <thead class="thead-dark">
                    <tr>
                        <th style="min-width:150px;">Nombre</th>
                        <th style="min-width:100px;">Norma</th>
                        <th>Módulo de Origen</th>
                        <th style="min-width:200px;">Objetivo</th>
                        <th>Elaboró</th>
                        <th>% de Avance</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
                        <th>Estatus</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($planImplementacions as $plan)
                        <tr>
                            <td>{{ $plan->parent }}</td>
                            <td>{{ $plan->norma }}</td>
                            <td>{{ $plan->modulo_origen }}</td>
                            <td>{{ $plan->objetivo }}</td>
                            <td>
                                @if ($plan->elaboro_id)
                                    {{ $plan->elaboro->name }}
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
                                            echo '<span class="badge badge-success">' . $progress . '%</span>';
                                        } elseif ($progress >= 60) {
                                            echo '<span class="badge badge-warning">' . $progress . '%</span>';
                                        } else {
                                            echo '<span class="badge badge-danger">' . $progress . '%</span>';
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
                                        if ($zero_task->status == 'STATUS_UNDEFINED') {
                                            echo '<span class="badge badge-primary">Sin iniciar</span>';
                                        } elseif ($zero_task->status == 'STATUS_ACTIVE') {
                                            echo '<span class="badge badge-warning">En proceso</span>';
                                        } elseif ($zero_task->status == 'STATUS_DONE') {
                                            echo '<span class="badge badge-success">Completado</span>';
                                        } elseif ($zero_task->status == 'STATUS_FAILED') {
                                            echo '<span class="badge badge-danger">Retraso</span>';
                                        } elseif ($zero_task->status == 'STATUS_SUSPENDED') {
                                            echo '<span class="badge badge-secondary">Suspendido</span>';
                                        } else {
                                            echo '<p>' . $zero_task->status . '</p>';
                                        }
                                    } else {
                                        echo '<span class="badge badge-primary">No encontrado</span>';
                                    }
                                    ?>
                                @else
                                    <span class="badge badge-primary">No encontrado</span>
                                @endif
                            </td>
                            <td>
                                <?php
                                $urlVerPlanAccion = '';
                                $urlEditarPlanAccion = route('admin.planes-de-accion.edit', $plan->id);
                                
                                if ($plan->norma == 'ISO 27001') {
                                    $urlEditarPlanAccion = route('admin.planes-de-accion.edit', $plan->id);
                                }
                                
                                $urlEliminarPlanAccion = route('admin.planes-de-accion.destroy', $plan->id);
                                $urlVerPlanAccion = $plan->id == 1 ? route('admin.planTrabajoBase.index') : route('admin.planes-de-accion.show', $plan->id);
                                ?>

                                <div class="btn-group">
                                    @can('planes_de_accion_editar')
                                        <a class="btn" href="{{ $urlEditarPlanAccion }}" title="Editar Plan de Acción"><i
                                                class="fas fa-edit"></i></a>
                                    @endcan
                                    @can('planes_de_accion_visualizar_diagrama')
                                        <a class="btn" href="{{ $urlVerPlanAccion }}" title="Visualizar Plan de Acción"><i
                                                class="fas fa-stream"></i></a>
                                    @endcan
                                    @if ($plan->id > 1)
                                        @can('planes_de_accion_eliminar')
                                            <button class="btn"
                                                onclick="eliminar('{{ $urlEliminarPlanAccion }}','{{ $plan->parent }}')"
                                                title="Eliminar Plan de Acción"><i
                                                    class="fas fa-trash-alt text-danger"></i></button>
                                        @endcan
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            let dtButtons = [
                // ... your existing DataTable buttons
            ];

            let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar nuevo',
                url: "{{ route('admin.planes-de-accion.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config) {
                    let {
                        url
                    } = config;
                    window.location.href = url;
                }
            };
            @can('planes_de_accion_agregar')
                dtButtons.push(btnAgregar);
            @endcan

            let url = "{{ route('admin.planes-de-accion.index') }}"
            let tblPlanesAccion = $('#tblPlanesAccion').DataTable({
                buttons: dtButtons,
                ajax: url,
                columns: [
                    // ... your existing DataTable columns
                ]
            });
        });

        window.eliminar = function(url, nombre) {
            Swal.fire({
                title: `¿Estás seguro de eliminar el siguiente plan de acción?`,
                html: `<strong><i class="mr-2 fas fa-exclamation-triangle"></i>${nombre}</strong>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        headers: {
                            'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        beforeSend: function() {
                            Swal.fire(
                                '¡Estamos Eliminando!',
                                `El Plan de Acción: ${nombre} está siendo eliminado`,
                                'info'
                            )
                        },
                        success: function(response) {
                            Swal.fire(
                                'Eliminado!',
                                `El Plan de Acción: ${nombre} ha sido eliminado`,
                                'success'
                            )
                            tblPlanesAccion.ajax.reload();
                        },
                        error: function(error) {
                            Swal.fire(
                                'Ocurrió un error',
                                `Error: ${error.responseJSON.message}`,
                                'error'
                            )
                        }
                    });
                }
            })
        }
    </script>
@endsection
