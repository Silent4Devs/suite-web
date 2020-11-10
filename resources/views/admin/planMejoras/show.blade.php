@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.planMejora.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.plan-mejoras.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.planMejora.fields.id') }}
                        </th>
                        <td>
                            {{ $planMejora->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planMejora.fields.mejora') }}
                        </th>
                        <td>
                            {{ $planMejora->mejora->nombre ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planMejora.fields.descripcion') }}
                        </th>
                        <td>
                            {{ $planMejora->descripcion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planMejora.fields.responsable') }}
                        </th>
                        <td>
                            {{ $planMejora->responsable->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planMejora.fields.fecha_compromiso') }}
                        </th>
                        <td>
                            {{ $planMejora->fecha_compromiso }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planMejora.fields.estatus') }}
                        </th>
                        <td>
                            {{ App\Models\PlanMejora::ESTATUS_SELECT[$planMejora->estatus] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.plan-mejoras.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection