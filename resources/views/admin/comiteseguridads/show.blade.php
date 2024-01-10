@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.comiteseguridads.create') }}

    <h5 class="col-12 titulo_general_funcion">Conformación del Comité</h5>
    <div class="card card-body" style="background-color: #306BA9; color: #fff;">
        <div class="d-flex" style="gap: 25px;">
            <img src="{{ asset('assets/Imagen 2@2x.png') }}" alt="jpg" style="width:200px;" class="mt-2 mb-2 ml-2 img-fluid">
            <div>
                <br>
                <h4> ¿Qué es? Conformación del Comité</h4>
                <p>
                    Refiere al proceso de establecer un grupo de individuos con roles y responsabilidades definidos para abordar un tema o llevar a cabo una tarea específica en una organización o proyecto.
                </p>
                <p>
                    Los comités se crean para abordar una variedad de asuntos, como la toma de decisiones, la resolución de problemas  la supervisión de proyectos, la formulación de políticas, la revisión de procesos, entre otros.
                </p>
            </div>
        </div>
    </div>

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
