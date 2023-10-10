@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.competencia.create') }}

<div class="card">
    @can('competencias_show')
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.competencium.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.competencia.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.competencium.fields.id') }}
                            </th>
                            <td>
                                {{ $competencium->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.competencium.fields.nombrecolaborador') }}
                            </th>
                            <td>
                                {{ $competencium->nombrecolaborador->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.competencium.fields.perfilpuesto') }}
                            </th>
                            <td>
                                {{ $competencium->perfilpuesto }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.competencium.fields.certificados') }}
                            </th>
                            <td>
                                @foreach($competencium->certificados as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.competencia.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    @endcan
</div>



@endsection
