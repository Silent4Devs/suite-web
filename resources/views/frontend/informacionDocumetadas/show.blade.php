@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.informacionDocumetada.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.informacion-documetadas.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.informacionDocumetada.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $informacionDocumetada->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.informacionDocumetada.fields.titulodocumento') }}
                                    </th>
                                    <td>
                                        {{ $informacionDocumetada->titulodocumento }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.informacionDocumetada.fields.tipodocumento') }}
                                    </th>
                                    <td>
                                        {{ App\Models\InformacionDocumetada::TIPODOCUMENTO_SELECT[$informacionDocumetada->tipodocumento] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.informacionDocumetada.fields.identificador') }}
                                    </th>
                                    <td>
                                        {{ $informacionDocumetada->identificador }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.informacionDocumetada.fields.version') }}
                                    </th>
                                    <td>
                                        {{ $informacionDocumetada->version }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.informacionDocumetada.fields.politicas') }}
                                    </th>
                                    <td>
                                        @foreach($informacionDocumetada->politicas as $key => $politicas)
                                            <span class="label label-info">{{ $politicas->politicasgsi }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.informacionDocumetada.fields.contenido') }}
                                    </th>
                                    <td>
                                        {{ $informacionDocumetada->contenido }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.informacionDocumetada.fields.elaboro') }}
                                    </th>
                                    <td>
                                        {{ $informacionDocumetada->elaboro->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.informacionDocumetada.fields.reviso') }}
                                    </th>
                                    <td>
                                        {{ $informacionDocumetada->reviso->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.informacionDocumetada.fields.aprobacion') }}
                                    </th>
                                    <td>
                                        {{ $informacionDocumetada->aprobacion->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.informacionDocumetada.fields.logotipo') }}
                                    </th>
                                    <td>
                                        @if($informacionDocumetada->logotipo)
                                            <a href="{{ $informacionDocumetada->logotipo->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $informacionDocumetada->logotipo->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.informacion-documetadas.index') }}">
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