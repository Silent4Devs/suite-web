@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.auditoriaAnual.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.auditoria-anuals.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.auditoriaAnual.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $auditoriaAnual->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.auditoriaAnual.fields.tipo') }}
                                    </th>
                                    <td>
                                        {{ App\Models\AuditoriaAnual::TIPO_SELECT[$auditoriaAnual->tipo] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.auditoriaAnual.fields.fechainicio') }}
                                    </th>
                                    <td>
                                        {{ $auditoriaAnual->fechainicio }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.auditoriaAnual.fields.dias') }}
                                    </th>
                                    <td>
                                        {{ $auditoriaAnual->dias }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.auditoriaAnual.fields.auditorlider') }}
                                    </th>
                                    <td>
                                        {{ $auditoriaAnual->auditorlider->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.auditoriaAnual.fields.observaciones') }}
                                    </th>
                                    <td>
                                        {{ $auditoriaAnual->observaciones }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.auditoria-anuals.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection