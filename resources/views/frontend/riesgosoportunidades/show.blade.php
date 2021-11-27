@extends('layouts.frontend')
@section('content')

    {{-- {{ Breadcrumbs::render('frontend.riesgosoportunidades.create') }} --}}

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.riesgosoportunidade.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('riesgosoportunidades.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.riesgosoportunidade.fields.id') }}
                        </th>
                        <td>
                            {{ $riesgosoportunidade->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.riesgosoportunidade.fields.control') }}
                        </th>
                        <td>
                            {{ $riesgosoportunidade->control->control ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.riesgosoportunidade.fields.aplicaorganizacion') }}
                        </th>
                        <td>
                            {{ App\Models\Riesgosoportunidade::APLICAORGANIZACION_SELECT[$riesgosoportunidade->aplicaorganizacion] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.riesgosoportunidade.fields.justificacion') }}
                        </th>
                        <td>
                            {{ $riesgosoportunidade->justificacion }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('riesgosoportunidades.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
