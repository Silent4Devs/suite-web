@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} Analisis de riesgo
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.matriz-seguridad',  ['id' => $matrizRiesgo->id]) }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.id') }}
                            </th>
                            <td>
                                {{ $matrizRiesgo->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.proceso') }}
                            </th>
                            <td>
                                {{ $matrizRiesgo->proceso->codigo }} / {{ $matrizRiesgo->proceso->nombre }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.activo') }}
                            </th>
                            <td>
                                {{ $matrizRiesgo->activo->descripcion ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.responsableproceso') }}
                            </th>
                            <td>
                                {{ $matrizRiesgo->responsableproceso }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.amenaza') }}
                            </th>
                            <td>
                                {{ $matrizRiesgo->amenaza }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.vulnerabilidad') }}
                            </th>
                            <td>
                                {{ $matrizRiesgo->vulnerabilidad }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.descripcionriesgo') }}
                            </th>
                            <td>
                                {{ $matrizRiesgo->descripcionriesgo }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.tipo_riesgo') }}
                            </th>
                            <td>
                                {{ App\Models\MatrizRiesgo::TIPO_RIESGO_SELECT[$matrizRiesgo->tipo_riesgo] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.confidencialidad') }}
                            </th>
                            <td>
                                {{ $matrizRiesgo->confidencialidad }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.integridad') }}
                            </th>
                            <td>
                                {{ $matrizRiesgo->integridad }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.disponibilidad') }}
                            </th>
                            <td>
                                {{ $matrizRiesgo->disponibilidad }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.probabilidad') }}
                            </th>
                            <td>
                                {{ App\Models\MatrizRiesgo::PROBABILIDAD_SELECT[$matrizRiesgo->probabilidad] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.impacto') }}
                            </th>
                            <td>
                                {{ App\Models\MatrizRiesgo::IMPACTO_SELECT[$matrizRiesgo->impacto] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.nivelriesgo') }}
                            </th>
                            <td>
                                {{ $matrizRiesgo->nivelriesgo }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.riesgototal') }}
                            </th>
                            <td>
                                {{ $matrizRiesgo->riesgototal }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.resultadoponderacion') }}
                            </th>
                            <td>
                                {{ $matrizRiesgo->resultadoponderacion }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.riesgoresidual') }}
                            </th>
                            <td>
                                {{ $matrizRiesgo->riesgoresidual }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.controles') }}
                            </th>
                            <td>
                                {{ $matrizRiesgo->controles->numero ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.justificacion') }}
                            </th>
                            <td>
                                {{ $matrizRiesgo->justificacion }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.matriz-riesgos.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
