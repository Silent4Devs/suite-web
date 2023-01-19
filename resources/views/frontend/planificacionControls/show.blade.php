@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.planificacion-controls.create') }}

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.planificacionControl.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.planificacion-controls.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.planificacionControl.fields.id') }}
                        </th>
                        <td>
                            {{ $planificacionControl->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planificacionControl.fields.activo') }}
                        </th>
                        <td>
                            {{ $planificacionControl->activo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planificacionControl.fields.descripcion') }}
                        </th>
                        <td>
                            {{ $planificacionControl->descripcion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planificacionControl.fields.dueno') }}
                        </th>
                        <td>
                            {{ $planificacionControl->dueno->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planificacionControl.fields.vulnerabilidad') }}
                        </th>
                        <td>
                            {{ $planificacionControl->vulnerabilidad }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planificacionControl.fields.amenaza') }}
                        </th>
                        <td>
                            {{ $planificacionControl->amenaza }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planificacionControl.fields.confidencialidad') }}
                        </th>
                        <td>
                            {{ $planificacionControl->confidencialidad }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planificacionControl.fields.integridad') }}
                        </th>
                        <td>
                            {{ $planificacionControl->integridad }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planificacionControl.fields.disponibilidad') }}
                        </th>
                        <td>
                            {{ $planificacionControl->disponibilidad }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planificacionControl.fields.probabilidad') }}
                        </th>
                        <td>
                            {{ $planificacionControl->probabilidad }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planificacionControl.fields.impacto') }}
                        </th>
                        <td>
                            {{ $planificacionControl->impacto }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planificacionControl.fields.nivelriesgo') }}
                        </th>
                        <td>
                            {{ $planificacionControl->nivelriesgo }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.planificacion-controls.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection