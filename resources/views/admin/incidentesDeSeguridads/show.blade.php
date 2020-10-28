@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.incidentesDeSeguridad.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.incidentes-de-seguridads.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.incidentesDeSeguridad.fields.id') }}
                        </th>
                        <td>
                            {{ $incidentesDeSeguridad->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.incidentesDeSeguridad.fields.folio') }}
                        </th>
                        <td>
                            {{ $incidentesDeSeguridad->folio }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.incidentesDeSeguridad.fields.resumen') }}
                        </th>
                        <td>
                            {{ $incidentesDeSeguridad->resumen }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.incidentesDeSeguridad.fields.prioridad') }}
                        </th>
                        <td>
                            {{ App\Models\IncidentesDeSeguridad::PRIORIDAD_SELECT[$incidentesDeSeguridad->prioridad] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.incidentesDeSeguridad.fields.fechaocurrencia') }}
                        </th>
                        <td>
                            {{ $incidentesDeSeguridad->fechaocurrencia }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.incidentesDeSeguridad.fields.activo') }}
                        </th>
                        <td>
                            @foreach($incidentesDeSeguridad->activos as $key => $activo)
                                <span class="label label-info">{{ $activo->descripcion }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.incidentesDeSeguridad.fields.clasificacion') }}
                        </th>
                        <td>
                            {{ $incidentesDeSeguridad->clasificacion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.incidentesDeSeguridad.fields.estado') }}
                        </th>
                        <td>
                            {{ $incidentesDeSeguridad->estado->estado ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.incidentes-de-seguridads.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection