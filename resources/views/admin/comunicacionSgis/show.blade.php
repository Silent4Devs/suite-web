@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.comunicacion-sgis.create') }}

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.comunicacionSgi.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.comunicacion-sgis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.comunicacionSgi.fields.id') }}
                        </th>
                        <td>
                            {{ $comunicacionSgi->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comunicacionSgi.fields.descripcion') }}
                        </th>
                        <td>
                            {{ $comunicacionSgi->descripcion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comunicacionSgi.fields.archivo') }}
                        </th>
                        <td>
                            @if($comunicacionSgi->archivo)
                                <a href="{{ $comunicacionSgi->archivo->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.comunicacion-sgis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection