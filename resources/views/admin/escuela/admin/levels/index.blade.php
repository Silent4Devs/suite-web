@extends('layouts.admin')

@section('content')
<h5 class="col-12 titulo_general_funcion">Niveles</h5>
<div class="text-right">
    <div class="d-flex justify-content-end">
        <a href="{{ route('admin.levels.create') }}" type="button" class="btn btn-primary">Registrar Nivel</a>
    </div>
</div>
@include('partials.flashMessages')
<div class="datatable-fix datatable-rds">
    <h3 class="title-table-rds"> Niveles</h3>
    <table class="datatable tblLevel" id="tblLevel">
        <thead>

            <tr >

                <th style="min-width: 50%">ID</th>

                <th style="min-width: 50%">Nombre</th>

                <th style="min-width: 50%" >Opciones</th>

            </tr>

        </thead>
    </table>
</div>

@endsection

@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Comite Seguridad ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible'],
                        orthogonal: "empleadoText"

                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Comite Seguridad ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible'],
                        orthogonal: "empleadoText"

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

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.levels.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id',
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
                    }
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ],
            };

            let table = $('.tblLevel').DataTable(dtOverrideGlobals);
        });
    </script>
@endsection

