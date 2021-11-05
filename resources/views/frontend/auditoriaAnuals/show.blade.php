@extends('layouts.admin')
@section('content')
   
    {{ Breadcrumbs::render('admin.auditoria-anuals.create') }}

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.auditoriaAnual.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.auditoria-anuals.index') }}">
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
                <a class="btn btn-default" href="{{ route('admin.auditoria-anuals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#fecha_plan_auditoria" role="tab" data-toggle="tab">
                {{ trans('cruds.planAuditorium.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="fecha_plan_auditoria">
            @includeIf('admin.auditoriaAnuals.relationships.fechaPlanAuditoria', ['planAuditoria' => $auditoriaAnual->fechaPlanAuditoria])
        </div>
    </div>
</div>

@endsection