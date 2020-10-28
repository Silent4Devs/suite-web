@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.controle.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.controles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.controle.fields.id') }}
                        </th>
                        <td>
                            {{ $controle->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.controle.fields.numero') }}
                        </th>
                        <td>
                            {{ $controle->numero }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.controle.fields.control') }}
                        </th>
                        <td>
                            {{ $controle->control }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.controles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection