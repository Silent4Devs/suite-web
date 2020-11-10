@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.materialIsoVeinticiente.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.material-iso-veinticientes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.materialIsoVeinticiente.fields.id') }}
                        </th>
                        <td>
                            {{ $materialIsoVeinticiente->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.materialIsoVeinticiente.fields.objetivo') }}
                        </th>
                        <td>
                            {{ $materialIsoVeinticiente->objetivo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.materialIsoVeinticiente.fields.listaasistencia') }}
                        </th>
                        <td>
                            @if($materialIsoVeinticiente->listaasistencia)
                                <a href="{{ $materialIsoVeinticiente->listaasistencia->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.materialIsoVeinticiente.fields.arearesponsable') }}
                        </th>
                        <td>
                            {{ $materialIsoVeinticiente->arearesponsable->area ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.materialIsoVeinticiente.fields.tipoimparticion') }}
                        </th>
                        <td>
                            {{ App\Models\MaterialIsoVeinticiente::TIPOIMPARTICION_SELECT[$materialIsoVeinticiente->tipoimparticion] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.materialIsoVeinticiente.fields.fechacreacion_actualizacion') }}
                        </th>
                        <td>
                            {{ $materialIsoVeinticiente->fechacreacion_actualizacion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.materialIsoVeinticiente.fields.materialarchivo') }}
                        </th>
                        <td>
                            @if($materialIsoVeinticiente->materialarchivo)
                                <a href="{{ $materialIsoVeinticiente->materialarchivo->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.material-iso-veinticientes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection