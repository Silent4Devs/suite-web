@extends('layouts.frontend')
@section('content')

{{-- {{ Breadcrumbs::render('frontend.roles-responsabilidades.create') }} --}}

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.rolesResponsabilidade.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('roles-responsabilidades.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.rolesResponsabilidade.fields.id') }}
                        </th>
                        <td>
                            {{ $rolesResponsabilidade->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rolesResponsabilidade.fields.responsabilidad') }}
                        </th>
                        <td>
                            {{ $rolesResponsabilidade->responsabilidad }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rolesResponsabilidade.fields.direccionsgsi') }}
                        </th>
                        <td>
                            {{ $rolesResponsabilidade->direccionsgsi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rolesResponsabilidade.fields.comiteseguridad') }}
                        </th>
                        <td>
                            {{ $rolesResponsabilidade->comiteseguridad }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rolesResponsabilidade.fields.responsablesgsi') }}
                        </th>
                        <td>
                            {{ $rolesResponsabilidade->responsablesgsi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rolesResponsabilidade.fields.coordinadorsgsi') }}
                        </th>
                        <td>
                            {{ $rolesResponsabilidade->coordinadorsgsi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rolesResponsabilidade.fields.rol') }}
                        </th>
                        <td>
                            {{ $rolesResponsabilidade->rol }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('roles-responsabilidades.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection