@extends('layouts.frontend')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.role.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <center>
                    <h4>Vista del Rol de <strong>{{ $role->title }}</strong> <a title="Editar rol: {{ $role->title }}"
                            href="{{ route('roles.edit', $role) }}"><i class="fas fa-edit text-dark"
                                style="font-size: 12px"></i></a></h4>
                </center>
                <p class="text-muted"><i class="fas fa-info-circle"></i> Permisos</p>
                <table class="table w-100" id="tblPermisos">
                    <thead>
                        <th>No.</th>
                        <th>Nombre</th>
                        <th>Slug</th>
                    </thead>
                    <tbody>
                        @foreach ($role->permissions as $idx => $permission)
                            <tr>
                                <td>{{ $idx + 1 }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->title }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('roles.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            $('#tblPermisos').DataTable({
                buttons: [],
                searching: true
            })
        });
    </script>
@endsection
