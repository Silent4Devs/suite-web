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

                    @include('partials.flashMessages')
                    <div class="datatable-fix datatable-rds">
                        <h3 class="title-table-rds">Miembros  del  Comites</h3>
                        @include('admin.comiteseguridads.table_miembros_view')
                    </div>

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
