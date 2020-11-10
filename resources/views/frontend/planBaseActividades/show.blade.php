@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.planBaseActividade.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.plan-base-actividades.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.planBaseActividade.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $planBaseActividade->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.planBaseActividade.fields.actividad') }}
                                    </th>
                                    <td>
                                        {{ $planBaseActividade->actividad }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.planBaseActividade.fields.actividad_padre') }}
                                    </th>
                                    <td>
                                        {{ $planBaseActividade->actividad_padre->actividad ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.planBaseActividade.fields.ejecutar') }}
                                    </th>
                                    <td>
                                        {{ $planBaseActividade->ejecutar->ejecutar ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.planBaseActividade.fields.guia') }}
                                    </th>
                                    <td>
                                        @if($planBaseActividade->guia)
                                            <a href="{{ $planBaseActividade->guia->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.planBaseActividade.fields.estatus') }}
                                    </th>
                                    <td>
                                        {{ $planBaseActividade->estatus->estado ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.planBaseActividade.fields.responsable') }}
                                    </th>
                                    <td>
                                        {{ $planBaseActividade->responsable->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.planBaseActividade.fields.colaborador') }}
                                    </th>
                                    <td>
                                        {{ $planBaseActividade->colaborador->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.planBaseActividade.fields.fecha_inicio') }}
                                    </th>
                                    <td>
                                        {{ $planBaseActividade->fecha_inicio }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.planBaseActividade.fields.fecha_fin') }}
                                    </th>
                                    <td>
                                        {{ $planBaseActividade->fecha_fin }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.planBaseActividade.fields.compromiso') }}
                                    </th>
                                    <td>
                                        {{ $planBaseActividade->compromiso }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.planBaseActividade.fields.real') }}
                                    </th>
                                    <td>
                                        {{ $planBaseActividade->real }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.plan-base-actividades.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection