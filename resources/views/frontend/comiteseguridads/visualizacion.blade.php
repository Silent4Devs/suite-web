@extends('layouts.frontend')
@section('content')

@section('styles')
    <style type="text/css">
        .caja_titulo {
            position: relative;
            width: 100%;
            height: 150px;
        }

        .logo_organizacion_politica {
            height: 150px;
            position: absolute;
            right: 50px;
            bottom: 0;
        }

        .caja_titulo h1 {
            position: absolute;
            width: 400px;
            font-weight: bold;
            color: #345183;
            bottom: 0;
        }

        .img_empleado {
            height: 40px;
            clip-path: circle(20px at 50% 50%);
        }

        table tr th:nth-child(1) {
            width: 200px !important;
            max-width: 200px !important;
            min-width: 200px !important;
        }

        table tr th:nth-child(2) {
            width: 200px !important;
            max-width: 200px !important;
            min-width: 200px !important;
        }

        table tr th:nth-child(3) {
            width: 140px !important;
            max-width: 140px !important;
            min-width: 140px !important;
        }
    </style>
@endsection
{{-- {{ Breadcrumbs::render('frontend.comiteseguridads.visualizacion') }} --}}
<div class="card card-body" style="margin-top: -50PX;">
    <div class="row" style="border-bottom: 2px solid #ccc;">
        <div class="col-12 caja_titulo">
            <h1>Comité de Seguridad</h1>

            @php
                use App\Models\Organizacion;
                $organizacion = Organizacion::getFirst();
                $logotipo = $organizacion->logotipo;
            @endphp
            <img src="{{ asset($logotipo) }}" class="logo_organizacion_politica">

        </div>
    </div>
    <div class="row" style="">
        <div class="card-body datatable-fix">
            <table class="table table-bordered datatable-Comiteseguridad" style="width: 100%">
                <thead class="thead-dark">
                    <tr>
                        <th>
                            Nombre del rol
                        </th>
                        <th>
                            {{ trans('cruds.comiteseguridad.fields.personaasignada') }}
                        </th>
                        <th>
                            {{ trans('cruds.comiteseguridad.fields.fechavigor') }}
                        </th>
                        <th>
                            {{ trans('cruds.comiteseguridad.fields.responsabilidades') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($comiteseguridads as $comiteseguridad)
                        <tr>
                            <td>{{ $comiteseguridad->nombrerol }}</td>
                            <td>
                                <img src="{{ asset('storage/empleados/imagenes/' . $comiteseguridad->asignacion->foto) }}"
                                    class="img_empleado"> {{ $comiteseguridad->asignacion->name }}
                            </td>
                            <td>{{ $comiteseguridad->fechavigor }}</td>
                            <td>{{ $comiteseguridad->responsabilidades }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center;">No hay registros</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection


@section('scripts')
@parent
<script type="text/javascript"></script>
@endsection
