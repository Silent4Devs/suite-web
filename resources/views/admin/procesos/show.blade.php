@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
             Proceso: {{ $proceso->nombre }}
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
                                {{ $proceso->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Codigo
                            </th>
                            <td>
                                {{ $proceso->codigo }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Nombre
                            </th>
                            <td>
                                {{ $proceso->nombre }}
                            </tr>
                        </td>
                        <tr>
                            <th>
                                Macroproceso
                            </th>
                            <td>
                                {{ $proceso->macroproceso->nombre }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Descripción
                            </th>
                            <td>
                                {{ $proceso->descripcion }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.procesos.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
