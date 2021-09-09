@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Rol </h3>
        </div>

        <div class="card-body">
            <form id="formRolesCreate" method="POST" action="{{ route('admin.roles.store') }}">
                @csrf
                <div class="form-group">
                    <label class="required" for="title"><i
                            class="fas fa-briefcase iconos-crear"></i>{{ trans('cruds.role.fields.title') }}</label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title"
                        id="title" value="{{ old('title', '') }}" required>
                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.role.fields.title_helper') }}</span>
                </div>
                {{-- <div class="form-group">
                    <label class="required" for="permissions"><i
                            class="fab fa-creative-commons-share iconos-crear"></i>{{ trans('cruds.role.fields.permissions') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="select-all btn btn-info btn-xs"
                            style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all"
                            style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('permissions') ? 'is-invalid' : '' }}"
                        name="permissions[]" id="permissions" multiple required>
                        @foreach ($permissions as $permission)
                            <option value="{{ $permission->id }}"
                                {{ in_array($permission->id, old('permissions', [])) ? 'selected' : '' }}>
                                {{ $permission->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('permissions'))
                        <div class="invalid-feedback">
                            {{ $errors->first('permissions') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.role.fields.permissions_helper') }}</span>
                </div> --}}
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
                <span class="help-block">{{ trans('cruds.role.fields.permissions_helper') }}</span>
            </div>
            <div class="form-group col-12 text-right"  style="margin-left:15px;">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                <button class="btn btn-danger" type="submit" id="btnEnviar">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            let tblPermissions = $("#tblPermissions").DataTable({
                buttons: [],
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }],
                select: {
                    style: "multi",
                    selector: "td:first-child"
                }
            });

            $("#btnEnviar").click(function(e) {
                e.preventDefault();
                let tblPermissions = $("#tblPermissions").DataTable();
                let permissionsArray = tblPermissions.rows({
                    selected: true
                }).data().toArray();
                let permissions = [];
                permissionsArray.forEach(permission => {
                    permissions.push(permission[1]) // Segunda columna
                });
                let nombre_rol = $("#title").val();
                let configuracionRol = {
                    nombre_rol,
                    permissions
                };
                $.ajax({
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    },
                    url: $("#formRolesCreate").attr("action"),
                    data: configuracionRol,
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Bien Hecho',
                                'Rol creado con éxito',
                                'success'
                            )
                        }
                        setTimeout(() => {
                            window.location.href = '/admin/roles';
                        }, 1500);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });

        });
    </script>
@endsection
