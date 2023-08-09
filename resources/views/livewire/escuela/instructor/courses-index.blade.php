@extends('layouts.admin')
@section('content')
    <style>
        .table tr td:nth-child(1) {
            min-width: 200px !important;
        }

        .table tr td:nth-child(4) {
            min-width: 200px !important;
        }
    </style>
    @include('flash::message')
    @include('partials.flashMessages')
    <h5 class="col-12 titulo_general_funcion">Cursos Generados</h5>
    <div class="mt-5 card">
        <div class="d-flex justify-content-between" style="justify-content: flex-end !important;">

            <div class="p-2">
                <a href="{{ route('admin.courses.create') }}" class="ml-4 btn btn-primary">Crear Curso Nuevo</a>
            </div>

        </div>
        <div class="card-body datatable-fix">
            <table class="table table-bordered w-100 datatable-User">
                <thead class="thead-dark">
                    <tr>
                        <th style="vertical-align: top">
                            Nombre
                        </th>
                        <th style="vertical-align: top">
                            Matriculados
                        </th>
                        <th style="vertical-align: top">
                            Calificación
                        </th>
                        <th style="vertical-align: top">
                            Estatus
                        </th>
                        <th style="vertical-align: top">
                            Opciones
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
