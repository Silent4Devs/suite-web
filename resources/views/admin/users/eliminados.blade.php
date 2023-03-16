@extends('layouts.admin')
@section('content')

    <div >
    <h5 class="titulo_general_funcion">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }} Eliminados
    </h5>
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Restablecer usuario</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <th scope="row">{{ $usuario->id ? $usuario->id : 'Sin definir' }}</th>
                                <td>{{ $usuario->name ? $usuario->name : 'Sin definir' }}</td>
                                <td>{{ $usuario->email ? $usuario->email : 'Sin definir' }}</td>
                                <td><a class="btn btn-xs btn-outline-primary rounded ml-2 pr-3"
                                    href="{{ url('admin/users/'.$usuario->id.'/restablecer') }}">
                                    <i class="fas fa-user-plus"></i>
                                    _Restaurar Usuario
                                    </a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

