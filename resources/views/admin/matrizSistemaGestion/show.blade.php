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
                                {{ $matrizRiesgo->identificador ?: 'No definido' }}
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
                                Activo (subcategoría)
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
                                @if (!empty($matrizRiesgo->empleado->name))
                                    {{ $matrizRiesgo->empleado->name }}
                                @else
                                    No definido
                                @endif


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
                            <td>
                                @if ($matrizRiesgo->calidad_servicio == 11.1)
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
                                @if ($matrizRiesgo->cliente == 11.1)
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
                                @if ($matrizRiesgo->estrategia_negocio == 11.1)
                                    Sí
                                @else
                                    No
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.confidencialidad') }}
                            </th>
                            <td>
                                @if ($matrizRiesgo->disponibilidad_2000 == 11.1)
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
                                @if ($matrizRiesgo->niveles_servicio == 11.1)
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
                                @if ($matrizRiesgo->continuidad_BCP == 11.1)
                                    Sí
                                @else
                                    No
                                @endif
                            </td>
                        </tr>


                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.confidencialidad') }}
                            </th>
                            <td>
                                @if ($matrizRiesgo->confidencialidad_270000 == 11.1)
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
                                @if ($matrizRiesgo->integridad_27000 == 11.1)
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
                                @if ($matrizRiesgo->disponibilidad_27000 == 11.1)
                                    Sí
                                @else
                                    No
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Resultado de la ponderación
                            </th>
                            <td>
                                @if ($matrizRiesgo->resultado_ponderacion)
                                    {{ $matrizRiesgo->resultado_ponderacion }}
                                @else
                                    No evaluado
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.probabilidad') }}
                            </th>
                            <td>
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
                            <td>
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
                            <td>
                                @if ($matrizRiesgo->nivelriesgo)
                                    {{ $matrizRiesgo->nivelriesgo }}
                                @else
                                    No evaluado
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Impacto total
                            </th>
                            <td>
                                @if ($matrizRiesgo->riesgo_total)
                                    {{ $matrizRiesgo->riesgo_total }}
                                @else
                                    No evaluado
                                @endif
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
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.confidencialidad') }}
                            </th>
                            <td>
                                @if ($matrizRiesgo->calidad_servicioRes == 11.1)
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
                                @if ($matrizRiesgo->clienteRes == 11.1)
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
                                @if ($matrizRiesgo->estrategia_negocioRes == 11.1)
                                    Sí
                                @else
                                    No
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.confidencialidad') }}
                            </th>
                            <td>
                                @if ($matrizRiesgo->disponibilidad_2000Res == 11.1)
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
                                @if ($matrizRiesgo->niveles_servicioRes == 11.1)
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
                                @if ($matrizRiesgo->continuidad_BCPRes == 11.1)
                                    Sí
                                @else
                                    No
                                @endif
                            </td>
                        </tr>


                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.confidencialidad') }}
                            </th>
                            <td>
                                @if ($matrizRiesgo->confidencialidad_270000Res == 11.1)
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
                                @if ($matrizRiesgo->integridad_27000Res == 11.1)
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
                                @if ($matrizRiesgo->disponibilidad_27000Res == 11.1)
                                    Sí
                                @else
                                    No
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Resultado de la ponderación
                            </th>
                            <td>
                                @if ($matrizRiesgo->resultado_ponderacionRes)
                                    {{ $matrizRiesgo->resultado_ponderacionRes }}
                                @else
                                    No evaluado
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.probabilidad') }}
                            </th>
                            <td>
                                @if ($matrizRiesgo->probabilidad_residual)
                                    {{ $matrizRiesgo->probabilidad_residual }}
                                @else
                                    No evaluado
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.impacto') }}
                            </th>
                            <td>
                                @if ($matrizRiesgo->impacto_residual)
                                    {{ $matrizRiesgo->impacto_residual }}
                                @else
                                    No evaluado
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.matrizRiesgo.fields.nivelriesgo') }}
                            </th>
                            <td>
                                @if ($matrizRiesgo->nivelriesgo_residual)
                                    {{ $matrizRiesgo->nivelriesgo_residual }}
                                @else
                                    No evaluado
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Impacto total
                            </th>
                            <td>
                                @if ($matrizRiesgo->riesgo_residual)
                                    {{ $matrizRiesgo->riesgo_residual }}
                                @else
                                    No evaluado
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>


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
