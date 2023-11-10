@extends('layouts.admin')
@section('content')
    {{-- @can('planes_accion_access') --}}

    <h5 class="col-12 titulo_general_funcion">Planes de acción </h5>
    <div class="mt-3 card">
        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <table class="table table-bordered w-100" id="tblPlanesAccion">
                <thead class="thead-dark">
                    <tr>
                        {{-- <th>
                            ID
                        </th> --}}
                        <th style="min-width:150px;">
                            Nombre
                        </th>
                        <th style="min-width:100px;">
                            Norma
                        </th>
                        <th>
                            Módulo&nbsp;de&nbsp;Origen
                        </th>
                        {{-- <th>
                            Tipo
                        </th> --}}
                        <th style="min-width:200px;">
                            Objetivo
                        </th>
                        <th>
                            Elaboró
                        </th>
                        <th>
                            %&nbsp;de&nbsp;Avance
                        </th>
                        {{-- <th>
                            Participantes
                        </th> --}}
                        <th>
                            Fecha&nbsp;de&nbsp;Inicio
                        </th>
                        <th>
                            Fecha&nbsp;de&nbsp;Fin
                        </th>
                        <th>
                            Estatus
                        </th>
                        <th>
                            Opciones
                        </th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    {{-- @endcan --}}
@endsection
@section('scripts')
@endsection
