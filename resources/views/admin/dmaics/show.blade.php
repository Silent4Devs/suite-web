@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.dmaic.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.dmaics.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.dmaic.fields.id') }}
                        </th>
                        <td>
                            {{ $dmaic->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dmaic.fields.mejora') }}
                        </th>
                        <td>
                            {{ $dmaic->mejora->nombre ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dmaic.fields.definir') }}
                        </th>
                        <td>
                            {{ $dmaic->definir }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dmaic.fields.medir') }}
                        </th>
                        <td>
                            {{ $dmaic->medir }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dmaic.fields.analizar') }}
                        </th>
                        <td>
                            {{ $dmaic->analizar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dmaic.fields.implementar') }}
                        </th>
                        <td>
                            {{ $dmaic->implementar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dmaic.fields.controlar') }}
                        </th>
                        <td>
                            {{ $dmaic->controlar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dmaic.fields.leccionesaprendidas') }}
                        </th>
                        <td>
                            {{ $dmaic->leccionesaprendidas }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.dmaics.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection