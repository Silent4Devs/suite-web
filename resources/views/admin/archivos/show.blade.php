@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.archivo.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.archivos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.archivo.fields.id') }}
                        </th>
                        <td>
                            {{ $archivo->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.archivo.fields.carpeta') }}
                        </th>
                        <td>
                            {{ $archivo->carpeta->nombre ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.archivo.fields.nombre') }}
                        </th>
                        <td>
                            @if($archivo->nombre)
                                <a href="{{ $archivo->nombre->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.archivo.fields.estado') }}
                        </th>
                        <td>
                            {{ $archivo->estado->estado ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.archivos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection