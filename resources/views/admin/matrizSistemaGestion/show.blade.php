@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} Analisis de riesgo
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.matriz-seguridad',  ['id' => $matrizRiesgo->id_analisis]) }}">
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
                                {{ $matrizRiesgo->empleado->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.amenaza') }}
                            </th>
                            <td>
                                {{ $matrizRiesgo->amenaza->nombre }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.vulnerabilidad') }}
                            </th>
                            <td>
                                {{ $matrizRiesgo->vulnerabilidad->nombre }}
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
                                @if($matrizRiesgo->confidencialidad)
                                    Sí
                                @else
                                    No
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.integridad') }}
                            </th>
                            <td>
                                @if($matrizRiesgo->integridad)
                                    Sí
                                @else
                                    No
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.disponibilidad') }}
                            </th>
                            <td>
                                @if($matrizRiesgo->disponibilidad)
                                    Sí
                                @else
                                    No
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.probabilidad') }}
                            </th>
                            <td>
                                @if($matrizRiesgo->probabilidad)
                                    Sí
                                @else
                                    No
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.impacto') }}
                            </th>
                            <td>
                                @if($matrizRiesgo->impacto)
                                    Sí
                                @else
                                    No
                                @endif
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
                        <tr>
                            <th>
                                Confidencialidad CID
                            </th>
                            <td>
                                @if($matrizRiesgo->confidencialidad_cid)
                                    Sí
                                @else
                                    No
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Integridad CID
                            </th>
                            <td>
                                @if($matrizRiesgo->integridad_cid)
                                    Sí
                                @else
                                    No
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Disponibilidad CID
                            </th>
                            <td>
                                @if($matrizRiesgo->disponibilidad_cid)
                                    Sí
                                @else
                                    No
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Probabilidad Residual
                            </th>
                            <td>
                                @if($matrizRiesgo->probabilidad_residual)
                                    Sí
                                @else
                                    No
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Impacto Residual
                            </th>
                            <td>
                                @if($matrizRiesgo->impacto_residual)
                                    Sí
                                @else
                                    No
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Nivel Riesgo Residual
                            </th>
                            <td>
                                {{ $matrizRiesgo->nivelriesgo_residual }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.matriz-seguridad',  ['id' => $matrizRiesgo->id_analisis]) }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
