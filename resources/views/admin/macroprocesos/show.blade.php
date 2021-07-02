@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
             Macroproceso: {{ $macroproceso->nombre }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.recurso.fields.id') }}
                            </th>
                            <td>
                                {{ $macroproceso->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Codigo
                            </th>
                            <td>
                                {{ $macroproceso->codigo }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Nombre
                            </th>
                            <td>
                                {{ $macroproceso->nombre }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Grupo
                            </th>
                            <td>
                                {{ $macroproceso->grupo->nombre }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Descripción
                            </th>
                            <td>
                                {{ $macroproceso->descripcion }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.macroprocesos.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
