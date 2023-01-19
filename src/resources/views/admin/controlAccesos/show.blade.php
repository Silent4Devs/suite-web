@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.control-accesos.create') }}

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.controlAcceso.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.control-accesos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.controlAcceso.fields.id') }}
                        </th>
                        <td>
                            {{ $controlAcceso->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.controlAcceso.fields.descripcion') }}
                        </th>
                        <td>
                            {{ $controlAcceso->descripcion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.controlAcceso.fields.archivo') }}
                        </th>
                        <td>
                            @if($controlAcceso->archivo)
                                <a href="{{ $controlAcceso->archivo->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.control-accesos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection