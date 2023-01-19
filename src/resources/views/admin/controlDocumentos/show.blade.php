@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.controlDocumento.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.control-documentos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.controlDocumento.fields.id') }}
                        </th>
                        <td>
                            {{ $controlDocumento->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.controlDocumento.fields.clave') }}
                        </th>
                        <td>
                            {{ $controlDocumento->clave }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.controlDocumento.fields.nombre') }}
                        </th>
                        <td>
                            {{ $controlDocumento->nombre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.controlDocumento.fields.fecha_creacion') }}
                        </th>
                        <td>
                            {{ $controlDocumento->fecha_creacion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.controlDocumento.fields.version') }}
                        </th>
                        <td>
                            {{ $controlDocumento->version }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.controlDocumento.fields.elaboro') }}
                        </th>
                        <td>
                            {{ $controlDocumento->elaboro->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.controlDocumento.fields.reviso') }}
                        </th>
                        <td>
                            {{ $controlDocumento->reviso->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.controlDocumento.fields.estado') }}
                        </th>
                        <td>
                            {{ $controlDocumento->estado->estado ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.control-documentos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection