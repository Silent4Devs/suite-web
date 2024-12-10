@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">

    <style>
        .dt-buttons.btn-group {
            display: none;
        }
    </style>

    <h5 class="col-12 titulo_general_funcion">Editar: Rol</h5>
    <div class="card card-body">
        <div class="">
            <form method="POST" action="{{ route('admin.roles.update', [$role->id]) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label class="required" for="title">{{ trans('cruds.role.fields.title') }}</label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text"
                        name="title" id="title" value="{{ old('title', $role->title) }}" required>
                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                    <span class="nombre_rol_error text-danger errors"></span>
                    <span class="help-block">{{ trans('cruds.role.fields.title_helper') }}</span>
                </div>
                <p class="text-muted"><i class="fas fa-info-circle"></i> Asignar Permisos</p>
                <div class="row">
                    <div class="col-12 datatable-fix">
                        <table class="table w-100" id="tblPermissions">
                            <thead>
                                <th>
                                    <input type="checkbox" id="selectAll">
                                </th>
                                <th>No.</th>
                                <th>Nombre</th>
                                <th>Slug</th>
                            </thead>
                            <tbody>
                                <tr style="display:none">
                                    <td></td>
                                    <td>ID del permiso</td>
                                    <td>Descripcion del permiso</td>
                                    <td>Slug o Codigo del permiso</td>
                                </tr>
                                @foreach ($permissions as $idx => $permission)
                                    <tr>
                                        <td></td>
                                        <td>{{ $permission->id }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>{{ $permission->title }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($role->id != null)
                    <input type="hidden" id="role_id" value="{{ $role->id }}">
                @endif
                <span class="help-block">{{ trans('cruds.role.fields.permissions_helper') }}</span>
        </div>
        <div class="form-group">
            <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-outline-primary">Cancelar</a>
            <button class="btn btn-primary" type="submit" id="btnEnviarPermisos">
                {{ trans('global.save') }}
            </button>
        </div>
        </form>
    </div>
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
                    className: 'select-checkbox',
                    targets: 0
                }],
                select: {
                    style: "multi",
                    selector: "td:first-child"
                },
                order: [
                    [1, 'asc']
                ] // Orden por ID
            });

            // Lista de permisos asignados al rol
            const assignedPermissions = @json($role->permissions->pluck('id'));

            // Marcar filas seleccionadas al cargar
            tblPermissions.rows().every(function() {
                const row = this.node();
                const permissionId = $(row).find('td:nth-child(2)').text().trim(); // ID en la 2da columna
                if (assignedPermissions.includes(Number(permissionId))) {
                    this.select();
                }
            });

            // Selección masiva
            $("#selectAll").on('click', function() {
                const isChecked = $(this).is(":checked");
                isChecked ? tblPermissions.rows().select() : tblPermissions.rows().deselect();
            });

            // Envío de permisos vía AJAX
            $("#btnEnviarPermisos").click(function(e) {
                e.preventDefault();
                const permissions = tblPermissions.rows({
                        selected: true
                    }).nodes().toArray()
                    .map(row => $(row).find('td:nth-child(2)').text().trim());
                const nombreRol = $("#title").val();

                $.ajax({
                    type: "PATCH",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.roles.update', $role->id) }}",
                    data: {
                        nombre_rol: nombreRol,
                        permissions
                    },
                    dataType: "JSON",
                    success: function(response) {
                        Swal.fire('Bien Hecho', 'Rol actualizado con éxito', 'success');
                        setTimeout(() => window.location.href = '/admin/roles', 1500);
                    },
                    error: function(request) {
                        $("span.errors").text(''); // Limpia errores previos
                        $.each(request.responseJSON.errors, function(index, error) {
                            $(`span.${index}_error`).text(error[0]);
                        });
                    }
                });
            });
        });
    </script>
@endsection
