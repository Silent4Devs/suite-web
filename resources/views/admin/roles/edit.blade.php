@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">

    <style>
        .dt-buttons.btn-group {
            display: none;
        }

        .selected {
            background-color: #4671fd; /* Color verde claro para filas seleccionadas */
        }
        .selected {
            transition: background-color 0.3s ease;
        }
    </style>

    @livewire('edit-roles-livewire', ['id_role' => $role->id])

@endsection

@section('scripts')
    @parent
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

    <script>
        $(document).ready(function() {
            const tblPermissions = $("#tblPermissions").DataTable({
                columnDefs: [{
                    orderable: false,
                //     className: 'select-checkbox',
                //     targets: 0
                }],
                // select: {
                //     style: "multi",
                //     selector: "td:first-child"
                // }
            });
        });
    </script>
@endsection
