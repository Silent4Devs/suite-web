@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">

    <style>
        .dt-buttons.btn-group {
            display: none;
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
                    // className: 'select-checkbox',
                    // targets: 0
                }],
                // select: {
                //     style: "multi",
                //     selector: "td:first-child"
                // },
                // order: [
                //     [1, 'asc']
                // ] // Orden por ID
            });

            // // Lista de permisos asignados al rol
            // const assignedPermissions = @json($role->permissions->pluck('id'));

            // // Marcar filas seleccionadas al cargar
            // tblPermissions.rows().every(function() {
            //     const row = this.node();
            //     const permissionId = $(row).find('td:nth-child(2)').text().trim(); // ID en la 2da columna
            //     if (assignedPermissions.includes(Number(permissionId))) {
            //         this.select();
            //     }
            // });

            // // Selección masiva
            // $("#selectAll").on('click', function() {
            //     const isChecked = $(this).is(":checked");
            //     isChecked ? tblPermissions.rows().select() : tblPermissions.rows().deselect();
            // });

            // // Envío de permisos vía AJAX
            // $("#btnEnviarPermisos").click(function(e) {
            //     e.preventDefault();
            //     const permissions = tblPermissions.rows({
            //             selected: true
            //         }).nodes().toArray()
            //         .map(row => $(row).find('td:nth-child(2)').text().trim());
            //     const nombreRol = $("#title").val();

            //     $.ajax({
            //         type: "PATCH",
            //         headers: {
            //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            //         },
            //         url: "{{ route('admin.roles.update', $role->id) }}",
            //         data: {
            //             nombre_rol: nombreRol,
            //             permissions
            //         },
            //         dataType: "JSON",
            //         success: function(response) {
            //             Swal.fire('Bien Hecho', 'Rol actualizado con éxito', 'success');
            //             setTimeout(() => window.location.href = '/admin/roles', 1500);
            //         },
            //         error: function(request) {
            //             $("span.errors").text(''); // Limpia errores previos
            //             $.each(request.responseJSON.errors, function(index, error) {
            //                 $(`span.${index}_error`).text(error[0]);
            //             });
            //         }
            //     });
            // });
        });
    </script>
@endsection
