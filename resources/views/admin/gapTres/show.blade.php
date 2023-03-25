@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.gapTre.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.gap-tres.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.gapTre.fields.id') }}
                        </th>
                        <td>
                            {{ $gapTre->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gapTre.fields.pregunta') }}
                        </th>
                        <td>
                            {{ $gapTre->pregunta }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gapTre.fields.valoracion') }}
                        </th>
                        <td>
                            {{ App\Models\GapTre::VALORACION_SELECT[$gapTre->valoracion] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gapTre.fields.evidencia') }}
                        </th>
                        <td>
                            {{ $gapTre->evidencia }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gapTre.fields.recomendacion') }}
                        </th>
                        <td>
                            {{ $gapTre->recomendacion }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.gap-tres.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection