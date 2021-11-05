@extends('layouts.frontend')
@section('content')

{{-- {{ Breadcrumbs::render('frontend.objetivosseguridads.create') }}  --}}
 
<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.objetivosseguridad.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('objetivosseguridads.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.objetivosseguridad.fields.id') }}
                        </th>
                        <td>
                            {{ $objetivosseguridad->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.objetivosseguridad.fields.objetivoseguridad') }}
                        </th>
                        <td>
                            {{ $objetivosseguridad->objetivoseguridad }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.objetivosseguridad.fields.indicador') }}
                        </th>
                        <td>
                            {{ $objetivosseguridad->indicador }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.objetivosseguridad.fields.anio') }}
                        </th>
                        <td>
                            {{ $objetivosseguridad->anio }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('objetivosseguridads.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection