@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.estadoIncidente.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.estado-incidentes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.estadoIncidente.fields.id') }}
                        </th>
                        <td>
                            {{ $estadoIncidente->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estadoIncidente.fields.estado') }}
                        </th>
                        <td>
                            {{ $estadoIncidente->estado }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.estado-incidentes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection