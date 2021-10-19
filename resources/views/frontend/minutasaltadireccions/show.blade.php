@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.minutasaltadireccions.create') }}

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.minutasaltadireccion.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.minutasaltadireccions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.minutasaltadireccion.fields.id') }}
                        </th>
                        <td>
                            {{ $minutasaltadireccion->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.minutasaltadireccion.fields.objetivoreunion') }}
                        </th>
                        <td>
                            {{ $minutasaltadireccion->objetivoreunion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.minutasaltadireccion.fields.responsablereunion') }}
                        </th>
                        <td>
                            {{ $minutasaltadireccion->responsablereunion->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.minutasaltadireccion.fields.arearesponsable') }}
                        </th>
                        <td>
                            {{ $minutasaltadireccion->arearesponsable }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.minutasaltadireccion.fields.fechareunion') }}
                        </th>
                        <td>
                            {{ $minutasaltadireccion->fechareunion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.minutasaltadireccion.fields.archivo') }}
                        </th>
                        <td>
                            @if($minutasaltadireccion->archivo)
                                <a href="{{ $minutasaltadireccion->archivo->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.minutasaltadireccions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection