@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.tratamiento-riesgos.create') }}

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tratamientoRiesgo.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tratamiento-riesgos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tratamientoRiesgo.fields.id') }}
                        </th>
                        <td>
                            {{ $tratamientoRiesgo->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tratamientoRiesgo.fields.nivelriesgo') }}
                        </th>
                        <td>
                            {{ $tratamientoRiesgo->nivelriesgo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tratamientoRiesgo.fields.control') }}
                        </th>
                        <td>
                            {{ $tratamientoRiesgo->control->anexo_indice }} {{ $tratamientoRiesgo->control->anexo_politica }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tratamientoRiesgo.fields.acciones') }}
                        </th>
                        <td>
                            {{ $tratamientoRiesgo->acciones }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tratamientoRiesgo.fields.responsable') }}
                        </th>
                        <td>
                            {{ $tratamientoRiesgo->responsable->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tratamientoRiesgo.fields.fechacompromiso') }}
                        </th>
                        <td>
                            {{ $tratamientoRiesgo->fechacompromiso }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tratamientoRiesgo.fields.prioridad') }}
                        </th>
                        <td>
                            {{ App\Models\TratamientoRiesgo::PRIORIDAD_SELECT[$tratamientoRiesgo->prioridad] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tratamientoRiesgo.fields.estatus') }}
                        </th>
                        <td>
                            {{ $tratamientoRiesgo->estatus }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tratamientoRiesgo.fields.probabilidad') }}
                        </th>
                        <td>
                            {{ $tratamientoRiesgo->probabilidad }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tratamientoRiesgo.fields.impacto') }}
                        </th>
                        <td>
                            {{ $tratamientoRiesgo->impacto }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tratamientoRiesgo.fields.nivelriesgoresidual') }}
                        </th>
                        <td>
                            {{ $tratamientoRiesgo->nivelriesgoresidual }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tratamiento-riesgos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
