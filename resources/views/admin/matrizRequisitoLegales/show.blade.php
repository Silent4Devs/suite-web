@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.matrizRequisitoLegale.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.matriz-requisito-legales.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.matrizRequisitoLegale.fields.id') }}
                        </th>
                        <td>
                            {{ $matrizRequisitoLegale->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matrizRequisitoLegale.fields.nombrerequisito') }}
                        </th>
                        <td>
                            {{ $matrizRequisitoLegale->nombrerequisito }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matrizRequisitoLegale.fields.fechaexpedicion') }}
                        </th>
                        <td>
                            {{ $matrizRequisitoLegale->fechaexpedicion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matrizRequisitoLegale.fields.fechavigor') }}
                        </th>
                        <td>
                            {{ $matrizRequisitoLegale->fechavigor }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matrizRequisitoLegale.fields.requisitoacumplir') }}
                        </th>
                        <td>
                            {{ $matrizRequisitoLegale->requisitoacumplir }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matrizRequisitoLegale.fields.cumplerequisito') }}
                        </th>
                        <td>
                            {{ App\Models\MatrizRequisitoLegale::CUMPLEREQUISITO_SELECT[$matrizRequisitoLegale->cumplerequisito] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matrizRequisitoLegale.fields.formacumple') }}
                        </th>
                        <td>
                            {{ $matrizRequisitoLegale->formacumple }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matrizRequisitoLegale.fields.periodicidad_cumplimiento') }}
                        </th>
                        <td>
                            {{ $matrizRequisitoLegale->periodicidad_cumplimiento }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matrizRequisitoLegale.fields.fechaverificacion') }}
                        </th>
                        <td>
                            {{ $matrizRequisitoLegale->fechaverificacion }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.matriz-requisito-legales.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection