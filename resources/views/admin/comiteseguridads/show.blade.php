@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.comiteseguridads.create') }}

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.comiteseguridad.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.comiteseguridads.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th style="min-width: 250px;">
                                {{ trans('cruds.comiteseguridad.fields.id') }}
                            </th>
                            <td>
                                {{ $comiteseguridad->id }}
                            </td>
                        </tr>
                        <tr>
                            <th style="min-width: 250px;">
                                Nombre del Comité
                            </th>
                            <td>
                                {{ $comiteseguridad->nombre_comite }}
                            </td>
                        </tr>
                        <tr>
                            <th style="min-width: 250px;">
                                Descripción
                            </th>
                            <td>
                                {{ $comiteseguridad->descripcion ?? '' }}
                            </td>
                        </tr>
                    </tbody>
                </table>


                @if ($datas->isEmpty())
                    <div class=" bg-warning col-12">
                        <p class="card-text" style="color:black; text-align:center">No se han asociado miembros a este
                            comité.
                        </p>
                    </div><br>
                @else
                    <div class="form-group col-12">
                        <p class="text-center text-light p-1" style="background-color:#345183; border-radius: 100px;">
                            Miembros del Comité</p>
                    </div>

                    <table class=table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col" style="min-width: 150px;">Nombre del Rol</th>
                                <th scope="col" style="min-width: 250px;">Nombre del Colaborador</th>
                                <th scope="col" style="min-width: 150px;">Responsabilidades</th>
                                <th scope="col" style="min-width: 100px;">Alta</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <th scope="row" style="text-align: left;"> {{ $data->nombrerol ?: 'No definido' }}</th>
                                    @if (!empty($data->asignacion->name))
                                        <td> {{ $data->asignacion->name}}</td>
                                    @else
                                        <td style="text-align: left;"> No definido </td>
                                    @endif
                                    @if ($data->responsabilidades)
                                        <td style="text-align: left;">{!! $data->responsabilidades !!}</td>
                                    @else
                                        <td style="text-align: left;">No definido</td>
                                    @endif
                                    <td style="text-align: left;">{{ $data->fechavigor ?: 'No definido' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif



                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.comiteseguridads.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
