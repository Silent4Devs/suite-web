@extends('layouts.frontend')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.glosario.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('glosarios.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.glosario.fields.id') }}
                        </th>
                        <td>
                            {{ $glosario->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.glosario.fields.concepto') }}
                        </th>
                        <td>
                            {{ $glosario->concepto }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.glosario.fields.definicion') }}
                        </th>
                        <td>
                            {{ $glosario->definicion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.glosario.fields.explicacion') }}
                        </th>
                        <td>
                            {{ $glosario->explicacion }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('glosarios.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection