@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} Categoría: {{ $categoriaCapacitacion->nombre }}
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
                                {{ $categoriaCapacitacion->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Nombre
                            </th>
                            <td>
                                {{ $categoriaCapacitacion->nombre }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.categoria-capacitacion.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
