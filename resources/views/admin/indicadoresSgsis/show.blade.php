@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.indicadores-sgsis.create') }}

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.indicadoresSgsi.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.indicadores-sgsis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.indicadoresSgsi.fields.id') }}
                        </th>
                        <td>
                            {{ $indicadoresSgsi->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.indicadoresSgsi.fields.control') }}
                        </th>
                        <td>
                            {{ $indicadoresSgsi->control }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.indicadoresSgsi.fields.titulo') }}
                        </th>
                        <td>
                            {{ $indicadoresSgsi->titulo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.indicadoresSgsi.fields.responsable') }}
                        </th>
                        <td>
                            {{ $indicadoresSgsi->responsable->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.indicadoresSgsi.fields.formula') }}
                        </th>
                        <td>
                            {{ $indicadoresSgsi->formula }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.indicadoresSgsi.fields.frecuencia') }}
                        </th>
                        <td>
                            {{ App\Models\IndicadoresSgsi::FRECUENCIA_SELECT[$indicadoresSgsi->frecuencia] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.indicadoresSgsi.fields.unidadmedida') }}
                        </th>
                        <td>
                            {{ App\Models\IndicadoresSgsi::UNIDADMEDIDA_SELECT[$indicadoresSgsi->unidadmedida] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.indicadoresSgsi.fields.meta') }}
                        </th>
                        <td>
                            {{ $indicadoresSgsi->meta }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.indicadoresSgsi.fields.semaforo') }}
                        </th>
                        <td>
                            {{ App\Models\IndicadoresSgsi::SEMAFORO_SELECT[$indicadoresSgsi->semaforo] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.indicadoresSgsi.fields.enero') }}
                        </th>
                        <td>
                            {{ $indicadoresSgsi->enero }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.indicadoresSgsi.fields.febrero') }}
                        </th>
                        <td>
                            {{ $indicadoresSgsi->febrero }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.indicadoresSgsi.fields.marzo') }}
                        </th>
                        <td>
                            {{ $indicadoresSgsi->marzo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.indicadoresSgsi.fields.abril') }}
                        </th>
                        <td>
                            {{ $indicadoresSgsi->abril }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.indicadoresSgsi.fields.mayo') }}
                        </th>
                        <td>
                            {{ $indicadoresSgsi->mayo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.indicadoresSgsi.fields.junio') }}
                        </th>
                        <td>
                            {{ $indicadoresSgsi->junio }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.indicadoresSgsi.fields.julio') }}
                        </th>
                        <td>
                            {{ $indicadoresSgsi->julio }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.indicadoresSgsi.fields.agosto') }}
                        </th>
                        <td>
                            {{ $indicadoresSgsi->agosto }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.indicadoresSgsi.fields.septiembre') }}
                        </th>
                        <td>
                            {{ $indicadoresSgsi->septiembre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.indicadoresSgsi.fields.octubre') }}
                        </th>
                        <td>
                            {{ $indicadoresSgsi->octubre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.indicadoresSgsi.fields.noviembre') }}
                        </th>
                        <td>
                            {{ $indicadoresSgsi->noviembre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.indicadoresSgsi.fields.diciembre') }}
                        </th>
                        <td>
                            {{ $indicadoresSgsi->diciembre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.indicadoresSgsi.fields.anio') }}
                        </th>
                        <td>
                            {{ $indicadoresSgsi->anio }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.indicadores-sgsis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection