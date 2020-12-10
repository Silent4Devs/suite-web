@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.gapUno.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.gap-unos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.gapUno.fields.id') }}
                        </th>
                        <td>
                            {{ $gapUno->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gapUno.fields.pregunta') }}
                        </th>
                        <td>
                            {{ $gapUno->pregunta }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gapUno.fields.valoracion') }}
                        </th>
                        <td>
                            {{ App\Models\GapUno::VALORACION_SELECT[$gapUno->valoracion] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gapUno.fields.evidencia') }}
                        </th>
                        <td>
                            {{ $gapUno->evidencia }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gapUno.fields.recomendacion') }}
                        </th>
                        <td>
                            {{ $gapUno->recomendacion }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.gap-unos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection