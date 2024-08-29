@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/global/TbColorsGlobal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global/tbButtons.css') }}">

    <h5 class="col-12 titulo_general_funcion">Usuarios</h5>
    <div class="mt-5 card">
        <div class="d-flex justify-content-between" style="justify-content: flex-end !important;">
            <div class="p-2">
                <a href={{ route('admin.users.eliminados') }} class="btn btn-primario" role="button" aria-pressed="true">
                    <i class="fas fa-user-slash"></i>&nbsp &nbsp Usuarios eliminados</a>
            </div>
        </div>
        <div class="card-body datatable-fix">
            @if (!$existsVinculoEmpleadoAdmin)
                <h5>Por favor da clic en el icono <small class="p-1 border border-primary rounded"><i
                            class="fas fa-user-tag"></i></small> de la fila del usuario Admin</h5>
            @endif
            <table id="dom" class="table table-bordered w-100 datatable-perspectiva" style="width: 100%">
                <thead class="thead-dark">
                    <tr>
                        <th style="vertical-align: top">Nombre</th>
                        <th style="vertical-align: top">Correo Electronico</th>
                        <th style="vertical-align: top">Roles</th>
                        <th style="vertical-align: top">Empleado Vinculado</th>
                        <th style="vertical-align: top">Area</th>
                        <th style="vertical-align: top">Puesto</th>
                        <th style="vertical-align: top">Opciones</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach ($user->roles as $role)
                                    {{ $role->title }}
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>
                                @if (!is_null($user->empleado))
                                    {{ $user->empleado->area->area }}
                                @else
                                    Sin Registro
                                @endif
                            </td>

                            <td>
                                @if (!is_null($user->empleado))
                                    {{ $user->empleado->puesto }}
                                @else
                                    Sin Registro
                                @endif
                            </td>
                            <td>

                                <a href="{{ url('/admin/users/' . $user->id . '/edit') }}"><i class="fas fa-edit"></i></a>

                                <a href="{{ url('/admin/users/' . $user->id . '') }}"><i class="fas fa-eye"></i></a>

                                <a onclick="mostrarAlertaVinculacion('{{ $user->id }}', '{{ $user->name }}');">
                                    <i class="fas fa-user-tag"></i>
                                </a>

                                <a href="{{ url('/admin/users/bloqueo/' . $user->id . '/change') }}"> <i
                                        class="fas fa-lock"></i></a>

                                <a onclick="mostrarAlerta('{{ route('admin.users.destroy', $user->id) }}');">
                                    <i class="fas fa-trash text-danger"></i>
                                </a>

                                <div data-user-id="{{ $user->id }}" class="modal fade"
                                    id="vincularEmpleado{{ $user->id }}" data-backdrop="static" data-keyboard="false"
                                    tabindex="-1" aria-labelledby="vincularEmpleado{{ $user->id }}Label"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="vincularEmpleado{{ $user->id }}Label">
                                                    Vinculación de
                                                    Empleados</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Empleado vinculado actualmente:</strong>
                                                    {{ $user->empleado ? $user->empleado->name : 'Sin Vincular' }}</p>
                                                <select name="id_empleado" id="id_empleado_{{ $user->id }}"
                                                    class="select2">
                                                    <option value="" selected disabled>-- Selecciona el empleado a
                                                        vincular --</option>
                                                    @foreach ($empleados as $key_empleado => $emp)
                                                        <option value="{{ $emp->id }}">
                                                            {{ $emp->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-sm n_empleado_error errores text-danger"></span>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cerrar</button>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="VincularEmpleado('{{ $user->name }}', '{{ $user->id }}');">Vincular</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@section('scripts')
    @parent
    <script src="{{ asset('js/users/userDeleteAlert.js') }}"></script>
    <script src="{{ asset('js/users/tableIndexUsers.js') }}"></script>
@endsection
