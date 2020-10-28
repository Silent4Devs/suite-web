@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.registromejora.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.registromejoras.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.registromejora.fields.id') }}
                        </th>
                        <td>
                            {{ $registromejora->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.registromejora.fields.nombre_reporta') }}
                        </th>
                        <td>
                            {{ $registromejora->nombre_reporta->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.registromejora.fields.nombre') }}
                        </th>
                        <td>
                            {{ $registromejora->nombre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.registromejora.fields.prioridad') }}
                        </th>
                        <td>
                            {{ App\Models\Registromejora::PRIORIDAD_SELECT[$registromejora->prioridad] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.registromejora.fields.clasificacion') }}
                        </th>
                        <td>
                            {{ $registromejora->clasificacion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.registromejora.fields.descripcion') }}
                        </th>
                        <td>
                            {{ $registromejora->descripcion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.registromejora.fields.responsableimplementacion') }}
                        </th>
                        <td>
                            {{ $registromejora->responsableimplementacion->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.registromejora.fields.participantes') }}
                        </th>
                        <td>
                            {{ $registromejora->participantes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.registromejora.fields.recursos') }}
                        </th>
                        <td>
                            {{ $registromejora->recursos }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.registromejora.fields.beneficios') }}
                        </th>
                        <td>
                            {{ $registromejora->beneficios }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.registromejora.fields.valida') }}
                        </th>
                        <td>
                            {{ $registromejora->valida->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.registromejoras.index') }}">
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
            <a class="nav-link" href="#mejora_dmaics" role="tab" data-toggle="tab">
                {{ trans('cruds.dmaic.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#mejora_plan_mejoras" role="tab" data-toggle="tab">
                {{ trans('cruds.planMejora.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="mejora_dmaics">
            @includeIf('admin.registromejoras.relationships.mejoraDmaics', ['dmaics' => $registromejora->mejoraDmaics])
        </div>
        <div class="tab-pane" role="tabpanel" id="mejora_plan_mejoras">
            @includeIf('admin.registromejoras.relationships.mejoraPlanMejoras', ['planMejoras' => $registromejora->mejoraPlanMejoras])
        </div>
    </div>
</div>

@endsection