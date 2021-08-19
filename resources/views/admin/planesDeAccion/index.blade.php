@extends('layouts.admin')
@section('content')
    {{-- @can('planes_accion_access') --}}
    <div class="mt-5 card">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Planes de Acción </strong></h3>
        </div>
        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <table class="table table-bordered w-100" id="tblPlanesAccion">
                <thead class="thead-dark">
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Nombre
                        </th>
                        <th>
                            Norma
                        </th>
                        <th>
                            Módulo&nbsp;de&nbsp;Origen
                        </th>
                        {{-- <th>
                            Tipo
                        </th> --}}
                        <th>
                            Objetivo
                        </th>
                        <th>
                            Elaboró
                        </th>
                        <th>
                            %&nbsp;de&nbsp;Avance
                        </th>
                        {{-- <th>
                            Participantes
                        </th> --}}
                        <th>
                            Fecha&nbsp;de&nbsp;Inicio
                        </th>
                        <th>
                            Fecha&nbsp;de&nbsp;Fin
                        </th>
                        <th>
                            Estatus
                        </th>
                        <th>
                            Opciones
                        </th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    {{-- @endcan --}}
@endsection
@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Plan de Trabajo Base ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Plan de Trabajo Base ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Plan de Trabajo Base ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [20, 60, 20, 30];
                        doc.styles.tableHeader.fontSize = 8.5;
                        doc.defaultStyle.fontSize = 8.5; //<-- set fontsize to 16 instead of 10 
                    }
                },
                {
                    extend: 'print',
                    title: `Plan de Trabajo Base ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Imprimir',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'colvis',
                    text: '<i class="fas fa-filter" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Seleccionar Columnas',
                },
                {
                    extend: 'colvisGroup',
                    text: '<i class="fas fa-eye" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    show: ':hidden',
                    titleAttr: 'Ver todo',
                },
                {
                    extend: 'colvisRestore',
                    text: '<i class="fas fa-undo" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Restaurar a estado anterior',
                }
            ];

            let url = "{{ route('admin.planes-de-accion.index') }}"
            let tblPlanesAccion = $('#tblPlanesAccion').DataTable({
                buttons: dtButtons,
                ajax: url,
                columns: [{
                    data: 'id',
                }, {
                    data: 'parent',
                }, {
                    data: 'norma',
                }, {
                    data: 'modulo_origen',
                }, {
                    data: 'objetivo',
                }, {
                    data: 'elaborador',
                    render: function(data, type, meta, config) {
                        let elaborador =
                            '<span class="badge badge-primary">Elaborado por el sistema</span>';
                        if (data) {
                            elaborador = `
                            <img src="{{ asset('storage/empleados/imagenes') }}/${data.avatar}" title="${data.name}" class="rounded-circle" style="clip-path: circle(21px at 50% 50%);height: 42px;" />
                            `;
                        }
                        return elaborador;
                    }
                },{
                    data:'id',
                    render:function(data, type, row, meta){
                        if(row.tasks){
                            let tasks =row.tasks;
                            let zero_task = tasks.find(t=>Number(t.level) == 0);
                            if(zero_task != undefined){
                                let progress = Math.ceil(zero_task.progress);
                                let html = "";
                                if(progress >= 90){
                                    html = `<span class="badge badge-success">${progress} %</span>`;
                                }else if(progress < 90 && progress >=60){
                                    html = `<span class="badge badge-warning">${progress} %</span>`;
                                }else{
                                    html = `<span class="badge badge-danger">${progress} %</span>`;
                                }
                                return html;
                            }                    
                        }
                        return "<span class='badge badge-primary'>Sin progreso calculable</span>"
                    }
                },{
                    data:'id',
                    render:function(data, type, row, meta){
                        if(row.tasks){
                            let tasks =row.tasks;
                            let zero_task = tasks.find(t=>Number(t.level) == 0);
                            if(zero_task != undefined){
                                return `
                                    <p>${moment.unix((zero_task.start)/1000).format("DD-MM-YYYY")}</p>
                                `;
                            }
                        }
                        return "<span class='badge badge-primary'>No encontrado</span>";
                    }
                },{
                    data:'id',
                    render:function(data, type, row, meta){
                        if(row.tasks){
                            let tasks =row.tasks;
                            let zero_task = tasks.find(t=>Number(t.level) == 0);
                            if(zero_task != undefined){
                                return `
                                    <p>${moment.unix((zero_task.end)/1000).format("DD-MM-YYYY")}</p>
                                `;
                            }
                        }
                        return "<span class='badge badge-primary'>No encontrado</span>";
                    }
                },{
                    data:'id',
                    render:function(data, type, row, meta){
                        if(row.tasks){
                            let tasks =row.tasks;
                            let zero_task = tasks.find(t=>Number(t.level) == 0);
                            if(zero_task != undefined){
                                return `
                                    <p>${zero_task.status}</p>
                                `;
                            }
                        }
                        return "<span class='badge badge-primary'>No encontrado</span>";
                    }
                },{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        let urlVerPlanAccion = "";
                        let urlEditarPlanAccion = `/admin/planes-de-accion/${data}/edit`;
                        let urlEliminarPlanAccion = `/admin/planes-de-accion/${data}`;
                        if (data == 1) {
                            urlVerPlanAccion = "{{ route('admin.planTrabajoBase.index') }}";
                        } else {
                            urlVerPlanAccion = `/admin/planes-de-accion/${data}`;
                        }
                        let botones = `   
                            <div class="btn-group">
                                <a class="btn" href="${urlEditarPlanAccion}" title="Editar Plan de Acción"><i class="fas fa-edit"></i></a>
                                <a class="btn" href="${urlVerPlanAccion}" title="Visualizar Plan de Acción"><i class="fas fa-stream"></i></a>
                        `;
                        if (data > 1) {
                            botones += `
                             <button class="btn" onclick="eliminar('${urlEliminarPlanAccion}','${row.parent}')" title="Eliminar Plan de Acción"><i class="fas fa-trash-alt text-danger"></i></button>
                             </div>
                             `;
                        } else {
                            botones += `
                             </div>
                             `;
                        }
                        return botones;
                    }
                }]
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
