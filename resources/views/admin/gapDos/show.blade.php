@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.gapDo.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.gap-dos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.gapDo.fields.id') }}
                        </th>
                        <td>
                            {{ $gapDo->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gapDo.fields.anexo_indice') }}
                        </th>
                        <td>
                            {{ $gapDo->anexo_indice }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gapDo.fields.control') }}
                        </th>
                        <td>
                            {{ $gapDo->control }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gapDo.fields.descripcion_control') }}
                        </th>
                        <td>
                            {{ $gapDo->descripcion_control }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gapDo.fields.valoracion') }}
                        </th>
                        <td>
                            {{ App\Models\GapDo::VALORACION_SELECT[$gapDo->valoracion] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gapDo.fields.evidencia') }}
                        </th>
                        <td>
                            {{ $gapDo->evidencia }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gapDo.fields.recomendacion') }}
                        </th>
                        <td>
                            {{ $gapDo->recomendacion }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.gap-dos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection