@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.evidencias-sgsis.create') }}

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.evidenciasSgsi.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.evidencias-sgsis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.evidenciasSgsi.fields.id') }}
                        </th>
                        <td>
                            {{ $evidenciasSgsi->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.evidenciasSgsi.fields.objetivodocumento') }}
                        </th>
                        <td>
                            {{ $evidenciasSgsi->objetivodocumento }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.evidenciasSgsi.fields.responsable') }}
                        </th>
                        <td>
                            {{ $evidenciasSgsi->responsable->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.evidenciasSgsi.fields.arearesponsable') }}
                        </th>
                        <td>
                            {{ $evidenciasSgsi->arearesponsable }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.evidenciasSgsi.fields.fechadocumento') }}
                        </th>
                        <td>
                            {{ $evidenciasSgsi->fechadocumento }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.evidenciasSgsi.fields.archivopdf') }}
                        </th>
                        <td>
                            @if($evidenciasSgsi->archivopdf)
                                <a href="{{ $evidenciasSgsi->archivopdf->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.evidencias-sgsis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
