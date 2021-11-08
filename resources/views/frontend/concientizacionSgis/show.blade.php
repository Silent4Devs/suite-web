@extends('layouts.frontend')
@section('content')

    {{ Breadcrumbs::render('frontend.concientizacion-sgis.create') }}

<div class="card">
    <div class="card-header">
    {{--{{ trans('global.show') }} {{ trans('cruds.concientizacionSgi.title') }} --}}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('concientizacion-sgis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.concientizacionSgi.fields.id') }}
                        </th>
                        <td>
                            {{ $concientizacionSgi->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.concientizacionSgi.fields.objetivocomunicado') }}
                        </th>
                        <td>
                            {{ $concientizacionSgi->objetivocomunicado }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.concientizacionSgi.fields.personalobjetivo') }}
                        </th>
                        <td>
                            {{ App\Models\ConcientizacionSgi::PERSONALOBJETIVO_SELECT[$concientizacionSgi->personalobjetivo] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.concientizacionSgi.fields.arearesponsable') }}
                        </th>
                        <td>
                            {{ $concientizacionSgi->arearesponsable->area ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.concientizacionSgi.fields.medio_envio') }}
                        </th>
                        <td>
                            {{ App\Models\ConcientizacionSgi::MEDIO_ENVIO_SELECT[$concientizacionSgi->medio_envio] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.concientizacionSgi.fields.fecha_publicacion') }}
                        </th>
                        <td>
                            {{ $concientizacionSgi->fecha_publicacion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.concientizacionSgi.fields.archivo') }}
                        </th>
                        <td>
                            @if($concientizacionSgi->archivo)
                                <a href="{{ $concientizacionSgi->archivo->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('concientizacion-sgis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection