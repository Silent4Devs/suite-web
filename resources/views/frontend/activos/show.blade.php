@extends('layouts.frontend')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.activo.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('activos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.activo.fields.id') }}
                        </th>
                        <td>
                            {{ $activo->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activo.fields.tipoactivo') }}
                        </th>
                        <td>
                            {{ $activo->tipoactivo->tipo ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activo.fields.subtipo') }}
                        </th>
                        <td>
                            {{ $activo->subtipo->subtipo ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activo.fields.descripcion') }}
                        </th>
                        <td>
                            {{ $activo->descripcion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activo.fields.dueno') }}
                        </th>
                        <td>
                            {{ $activo->dueno->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activo.fields.ubicacion') }}
                        </th>
                        <td>
                            {{ $activo->ubicacion->sede ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('activos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#activo_incidentes_de_seguridads" role="tab" data-toggle="tab">
                {{ trans('cruds.incidentesDeSeguridad.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="activo_incidentes_de_seguridads">
            @includeIf('frontend.activos.relationships.activoIncidentesDeSeguridads', ['incidentesDeSeguridads' => $activo->activoIncidentesDeSeguridads])
        </div>
    </div>
</div>

@endsection