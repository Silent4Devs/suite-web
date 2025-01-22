@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">

    @livewire('create-roles-livewire')

@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            let tblPermissions = $("#tblPermissions").DataTable({
                buttons: [],
                columnDefs: [{
                    orderable: false,
                    // className: 'select-checkbox',
                    // targets: 0
                }],
                // select: {
                //     style: "multi",
                //     selector: "td:first-child"
                // }
            });
        });
    </script>
@endsection
