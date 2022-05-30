@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} Analisis de riesgo
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default"
                        href="{{ route('admin.matriz-seguridad', ['id' => $matrizRiesgo->id_analisis]) }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th colspan="2">
                                        <div class="text-center form-group"
                                            style="background-color:#345183; border-radius: 100px; color: white;">
                                            DATOS GENERALES
                                        </div>
                                    </th>
                                    <td>
                                    </td>
                                </tr>
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
                                        {{ $matrizRiesgo->activo->subcategoria ?? '' }}
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
                                    <th colspan="2">
                                        <div class="text-center form-group"
                                            style="background-color:#345183; border-radius: 100px; color: white;">
                                            EVALUACIÓN DE RIESGO INICIAL
                                        </div>
                                    </th>
                                    <td>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.matrizRiesgo.fields.confidencialidad') }}
                                    </th>
                                    <td style="text-align: left;">
                                        @if ($matrizRiesgo->confidencialidad)
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
                                    <td style="text-align: left;">
                                        @if ($matrizRiesgo->integridad)
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
                                    <td style="text-align: left;">
                                        @if ($matrizRiesgo->disponibilidad)
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
                                    <td style="text-align: left;">
                                        @if ($matrizRiesgo->probabilidad)
                                            {{ $matrizRiesgo->probabilidad }}
                                        @else
                                            No evaluado
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.matrizRiesgo.fields.impacto') }}
                                    </th>
                                    <td style="text-align: left;">
                                        @if ($matrizRiesgo->impacto)
                                            {{ $matrizRiesgo->impacto }}
                                        @else
                                            No evaluado
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.matrizRiesgo.fields.nivelriesgo') }}
                                    </th>
                                    <td style="text-align: left;">
                                        {{ $matrizRiesgo->nivelriesgo }}
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2">
                                        <div class="text-center form-group"
                                            style="background-color:#345183; border-radius: 100px; color: white;">
                                            EVALUACIÓN DE RIESGO RESIDUAL
                                        </div>
                                    </th>
                                    <td>
                                    </td>
                                </tr>
                                    <th>
                                        Confidencialidad
                                    </th>
                                    <td>
                                        @if ($matrizRiesgo->confidencialidad_cid)
                                            Sí
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Integridad
                                    </th>
                                    <td>
                                        @if ($matrizRiesgo->integridad_cid)
                                            Sí
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Disponibilidad
                                    </th>
                                    <td>
                                        @if ($matrizRiesgo->disponibilidad_cid)
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
                                        @if ($matrizRiesgo->probabilidad_residual)
                                          {{$matrizRiesgo->probabilidad_residual}}
                                        @else
                                        No evaluado
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Impacto Residual
                                    </th>
                                    <td>
                                        @if ($matrizRiesgo->impacto_residual)
                                            {{$matrizRiesgo->impacto_residual}}
                                        @else
                                        No evaluado
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
                                {{-- <tr>
                                    <th colspan="2">
                                        <div class="text-center form-group"
                                            style="background-color:#345183; border-radius: 100px; color: white;">
                                            Tratamiento
                                        </div>
                                    </th>
                                    <td>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Controles asociados
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
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
    
                <div class="form-group">
                    <a class="btn btn-default"
                        href="{{ route('admin.matriz-seguridad', ['id' => $matrizRiesgo->id_analisis]) }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
