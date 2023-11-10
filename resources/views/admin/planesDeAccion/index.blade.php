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
                <tbody id="table-body"></tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
$(document).ready(function () {
    const url = "{{ route('admin.planes-de-accion.index') }";
    const tableBody = document.getElementById("table-body");

    function populateTable(data) {
        tableBody.innerHTML = "";

        data.forEach((row) => {
            const rowHTML = `
                <tr>
                    <td>${row.parent}</td>
                    <td>${row.norma}</td>
                    <td>${row.modulo_origen}</td>
                    <td>${row.objetivo}</td>
                    <td>${row.elaborador ? `<span class="badge badge-primary">${row.elaborador.name}</span>` : '<span class="badge badge-primary">Elaborado por el sistema</span>'}</td>
                    <td>${getProgressBadge(row)}</td>
                    <td>${formatDate(row.tasks)}</td>
                    <td>${formatDate(row.tasks, 'end')}</td>
                    <td>${getStatusBadge(row.tasks)}</td>
                    <td>${getButtons(row)}</td>
                </tr>`;
            tableBody.innerHTML += rowHTML;
        });
    }

    function getProgressBadge(row) {
        if (row.tasks) {
            const zero_task = row.tasks.find((t) => Number(t.level) === 0);
            if (zero_task !== undefined) {
                const progress = Math.ceil(zero_task.progress);
                let badgeClass = "badge-success";
                if (progress < 90 && progress >= 60) {
                    badgeClass = "badge-warning";
                } else if (progress < 60) {
                    badgeClass = "badge-danger";
                }
                return `<span class="badge ${badgeClass}">${progress} %</span>`;
            }
        }
        return '<span class="badge badge-primary">Sin progreso calculable</span>';
    }

    function formatDate(tasks, field = 'start') {
        if (tasks) {
            const zero_task = tasks.find((t) => Number(t.level) === 0);
            if (zero_task !== undefined) {
                return moment.unix(zero_task[field] / 1000).format("DD-MM-YYYY");
            }
        }
        return '<span class="badge badge-primary">No encontrado</span>';
    }

    function getStatusBadge(row) {
        if (row.tasks) {
            const zero_task = row.tasks.find((t) => Number(t.level) === 0);
            if (zero_task !== undefined) {
                const status = zero_task.status;
                const statusBadge = {
                    'STATUS_UNDEFINED': "Sin iniciar",
                    'STATUS_ACTIVE': "En proceso",
                    'STATUS_DONE': "Completado",
                    'STATUS_FAILED': "Retraso",
                    'STATUS_SUSPENDED': "Suspendido",
                }[status] || status;
                return `<span class="badge badge-primary">${statusBadge}</span>`;
            }
        }
        return '<span class="badge badge-primary">No encontrado</span>';
    }

    function getButtons(row) {
        const urlEditarPlanAccion = `/admin/planes-de-accion/${row.id}/edit`;
        let urlVerPlanAccion = "";
        let urlEliminarPlanAccion = `/admin/planes-de-accion/${row.id}`;
        if (row.id === 1) {
            urlVerPlanAccion = "{{ route('admin.planTrabajoBase.index') }}";
        } else {
            urlVerPlanAccion = `/admin/planes-de-accion/${row.id}`;
        }
        let botones = `
            <div class="btn-group">
                @can('planes_de_accion_editar')
                <a class="btn" href="${urlEditarPlanAccion}" title="Editar Plan de Acción"><i class="fas fa-edit"></i></a>
                @endcan
                @can('planes_de_accion_visualizar_diagrama')
                <a class="btn" href="${urlVerPlanAccion}" title="Visualizar Plan de Acción"><i class="fas fa-stream"></i></a>
                @endcan
        `;

        if (row.id > 1) {
            botones += `
            @can('planes_de_accion_eliminar')
             <button class="btn" onclick="eliminar('${urlEliminarPlanAccion}','${row.parent}')" title="Eliminar Plan de Acción"><i class="fas fa-trash-alt text-danger"></i></button>
             </div>
             @endcan
             `;
        } else {
            botones += `
             </div>
             `;
        }

        return botones;
    }

    $.ajax({
        url,
        method: "GET",
        success: function (response) {
            populateTable(response.data);
        },
        error: function (error) {
            console.error("Error fetching data: " + error);
        },
    });
});

@endsection
