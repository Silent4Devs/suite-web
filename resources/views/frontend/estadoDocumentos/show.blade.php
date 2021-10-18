@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.estadoDocumento.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.estado-documentos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.estadoDocumento.fields.id') }}
                        </th>
                        <td>
                            {{ $estadoDocumento->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estadoDocumento.fields.estado') }}
                        </th>
                        <td>
                            {{ $estadoDocumento->estado }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estadoDocumento.fields.descripcion') }}
                        </th>
                        <td>
                            {{ $estadoDocumento->descripcion }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.estado-documentos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection