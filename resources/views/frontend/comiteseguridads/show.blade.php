@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.comiteseguridads.create') }}

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.comiteseguridad.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.comiteseguridads.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.comiteseguridad.fields.id') }}
                        </th>
                        <td>
                            {{ $comiteseguridad->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comiteseguridad.fields.nombrerol') }}
                        </th>
                        <td>
                            {{ $comiteseguridad->nombrerol }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comiteseguridad.fields.personaasignada') }}
                        </th>
                        <td>
                            {{ $comiteseguridad->personaasignada->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comiteseguridad.fields.fechavigor') }}
                        </th>
                        <td>
                            {{ $comiteseguridad->fechavigor }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comiteseguridad.fields.responsabilidades') }}
                        </th>
                        <td>
                            {{ $comiteseguridad->responsabilidades }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.comiteseguridads.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection