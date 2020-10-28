@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.registromejora.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.registromejoras.index') }}">
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
                            <a class="btn btn-default" href="{{ route('frontend.registromejoras.index') }}">
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