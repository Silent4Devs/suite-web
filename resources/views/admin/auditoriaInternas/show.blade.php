@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.auditoria-internas.create') }}

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.auditoriaInterna.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.auditoria-internas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.auditoriaInterna.fields.id') }}
                        </th>
                        <td>
                            {{ $auditoriaInterna->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.auditoriaInterna.fields.alcance') }}
                        </th>
                        <td>
                            {{ $auditoriaInterna->alcance }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.auditoriaInterna.fields.clausulas') }}
                        </th>
                        <td>
                            @foreach($auditoriaInterna->clausulas as $clausula)
                            {{ $clausula->nombre ?? '' }}
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.auditoriaInterna.fields.fechaauditoria') }}
                        </th>
                        <td>
                            {{ $auditoriaInterna->fechaauditoria }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.auditoriaInterna.fields.auditorlider') }}
                        </th>
                        <td>
                            {{ $auditoriaInterna->auditorlider->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.auditoriaInterna.fields.equipoauditoria') }}
                        </th>
                        <td>
                            {{ $auditoriaInterna->equipoauditoria->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.auditoriaInterna.fields.hallazgos') }}
                        </th>
                        <td>
                            {{ $auditoriaInterna->hallazgos }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.auditoriaInterna.fields.cheknoconformidadmenor') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $auditoriaInterna->cheknoconformidadmenor ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.auditoriaInterna.fields.totalnoconformidadmenor') }}
                        </th>
                        <td>
                            {{ $auditoriaInterna->totalnoconformidadmenor }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.auditoriaInterna.fields.checknoconformidadmayor') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $auditoriaInterna->checknoconformidadmayor ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.auditoriaInterna.fields.totalnoconformidadmayor') }}
                        </th>
                        <td>
                            {{ $auditoriaInterna->totalnoconformidadmayor }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.auditoriaInterna.fields.checkobservacion') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $auditoriaInterna->checkobservacion ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.auditoriaInterna.fields.totalobservacion') }}
                        </th>
                        <td>
                            {{ $auditoriaInterna->totalobservacion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.auditoriaInterna.fields.checkmejora') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $auditoriaInterna->checkmejora ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.auditoriaInterna.fields.totalmejora') }}
                        </th>
                        <td>
                            {{ $auditoriaInterna->totalmejora }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.auditoriaInterna.fields.logotipo') }}
                        </th>
                        <td>
                            @if($auditoriaInterna->logotipo)
                                <a href="{{ $auditoriaInterna->logotipo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $auditoriaInterna->logotipo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.auditoria-internas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
