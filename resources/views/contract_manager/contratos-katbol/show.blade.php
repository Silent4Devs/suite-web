@extends('layouts.admin')

@section('content')
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/botones.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularios/contratos.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/iconos.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/letra.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/titulos.css') }}"> --}}


    <style>
        .diseño-titulo {

            margin-top: 20px;
            margin-bottom: 30px;
            height: 30px;
            background: #345183;
            border-bottom-right-radius: 100px;
            border-top-right-radius: 100px;
            border-bottom-left-radius: 100px;
            border-top-left-radius: 100px;
        }

        .asterisco {
            color: red;
            margin-left: 5px;

        }

        .select-wrapper input {

            direction: rtl;
            text-align: left;

        }
    </style>

    <div class="row">
        <div class="col s12 m12">
            <div class="" style="margin-top:-20px; margin-left:10px; margin-right:10px;">
                <div class="">
                    <!--  <section class="content-header">
                                                                                                                                                                                                                        <h1>
                                                                                                                                                                                                                            Contrato
                                                                                                                                                                                                                        </h1>
                                                                                                                                                                                                                    </section>-->

                    <div class="col s12">
                        <div class="form-group diseño-titulo">
                            <p class="center-align" style="font-size:13pt; color:#ffffff;">&nbsp;&nbsp;INFORMACIÓN GENERAL DEL
                                CONTRATO
                            </p>
                        </div>
                    </div>



                    <!-- <div class="box box-primary">-->
                    {!! Form::model($contrato, [
                        'route' => ['contract_manager.contratos-katbol.update', $contrato->id],
                        'method' => 'patch',
                        'enctype' => 'multipart/form-data',
                    ]) !!}

                    @include('admin.bitacora.formedit', ['show_contrato' => true])

                    {!! Form::close() !!}
                    <!-- </div>-->
                </div>
            </div>
        </div>
    </div>

    <div class="col s12 m12">
        <div class="card card-body">
            <div class="table-responsive">
                <span class="card-title">Contrato</span>
                <table class="table" id="tblContrato">
                    <thead>
                        <tr>
                            <th>
                                <p class="grey-text" style="font-size:17px;font-weight:bold;">No. contrato</p>
                            </th>
                            <th>
                                <p class="grey-text" style="font-size:17px;font-weight:bold;">Vigencia</p>
                            </th>
                            <th>
                                <p class="grey-text" style="font-size:17px;font-weight:bold;">Fase</p>
                            </th>
                            <th>
                                @if ($contrato->tipo_cambio == 'USD')
                                    <p></p>
                                @else
                                    <p class="grey-text" style="font-size:17px;font-weight:bold;">IVA</p>
                                @endif
                            </th>
                            <th>
                                @if ($contrato->tipo_cambio == 'USD')
                                    <p></p>
                                @else
                                    <p class="grey-text" style="font-size:17px;font-weight:bold;">Subtotal</p>
                                @endif
                            </th>
                            <th>
                                <p class="grey-text" style="font-size:17px;font-weight:bold;">Monto de pago total</p>
                            </th>
                            <th>
                                <p class="grey-text" style="font-size:17px;font-weight:bold;">Estado</p>
                            </th>
                            <th style="text-align: center">
                                <p class="grey-text" style="font-size:17px;font-weight:bold;">Habilitar ampliación</p>
                            </th>
                            <th style="text-align: center">
                                <p class="grey-text" style="font-size:17px;font-weight:bold;">Convenios Modificatorios
                                </p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $contrato_importe_total = $contratos->monto_pago;
                        @endphp
                        @foreach ($contratos->ampliaciones as $ampliacion)
                            @php
                                $contrato_importe_total += $ampliacion->importe;
                            @endphp
                        @endforeach
                        <tr class="black-text">
                            <td>{{ $contratos->no_contrato }}</td>
                            <td>
                                <i class="fas fa-calendar-alt"></i>
                                {{ $contratos->vigencia_contrato }}
                            </td>
                            <td>{{ $contratos->fase }}</td>
                            <td>
                                @if ($contrato->tipo_cambio == 'USD')
                                    <p></p>
                                @else
                                    $ {{ number_format(($contrato_importe_total / 1.16) * 0.16, 2) }}
                                @endif
                            </td>
                            <td>
                                @if ($contrato->tipo_cambio == 'USD')
                                    <p></p>
                                @else
                                    $ {{ number_format($contrato_importe_total / 1.16, 2) }}
                                @endif
                            </td>
                            <td>$ {{ number_format($contrato_importe_total, 2) }}</td>
                            <td>{{ $contratos->estatus }}</td>
                            <td style="text-align: center">
                                <form id="ampliacion_form"
                                    action="{{ route('contract_manager.contratos-katbol.ampliacion', ['id' => $contratos->id]) }}"
                                    method="POST">
                                    @method('PATCH')
                                    <p>
                                        <label>
                                            <input type="checkbox" class="checkbox"
                                                {{ $contratos->contrato_ampliado ? 'checked' : '' }} disabled />
                                            <span></span>
                                        </label>
                                    </p>
                                </form>
                            </td>
                            <td style="text-align: center">
                                <form id="ampliacion_form"
                                    action="{{ route('contract_manager.contratos-katbol.ampliacion', ['id' => $contratos->id]) }}"
                                    method="POST">
                                    @method('PATCH')
                                    <p>
                                        <label>
                                            <input type="checkbox" class="checkbox"
                                                {{ $contratos->contrato_ampliado ? 'checked' : '' }} disabled />
                                            <span></span>
                                        </label>
                                    </p>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <ul class="collapsible popout">
        <li>
            <div class="collapsible-header"><i class="material-icons">insert_drive_file</i>Facturación</div>
            <div class="col s12 m12">
                <div class="card card-body">
                    <table class="table" align="center">
                        <thead>
                            <tr>
                                <th>
                                    <p class="grey-text" style="font-size:17px;font-weight:bold;">
                                        No. pagos</p>
                                </th>
                                <th>
                                    <p class="grey-text" style="font-size:17px;font-weight:bold;">
                                        Tipo</p>
                                </th>
                                <th>
                                    <p class="grey-text" style="font-size:17px;font-weight:bold;">
                                        Nombre servicio</p>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="black-text">
                                <td>{{ $contratos->no_pagos }}</td>
                                <td>{{ $contratos->tipo_contrato }}</td>
                                <td>{{ $contratos->nombre_servicio }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col s12 m12">
                <div class="card card-body">
                    @livewire('factura.factura-component', ['contrato_id' => $contratos->id, 'show_contrato' => true, 'contrato_total' => $contratos->monto_pago])
                </div>
            </div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">multiline_chart</i>Niveles de servicio
            </div>
            <div class="col s12 m12">
                <div class="card card-body">
                    @livewire('niveles-servicio.niveles-component', ['contrato_id' => $contratos->id, 'show_contrato' => true])
                </div>
            </div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">event</i>Entregables mensuales
            </div>
            <div class="col s12 m12">
                <div class="card card-body">
                    @livewire('entregable-mensual.entregablecomponent', ['contrato_id' => $contratos->id, 'show_contrato' => true])
                </div>
            </div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">assignment_turned_in</i>Cierre contrato
            </div>
            <div class="col s12 m12">
                <div class="card card-body">
                    @livewire('cierre-contratos.cierrecomponent', ['contrato_id' => $contratos->id, 'show_contrato' => true])
                </div>
            </div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">add_task</i>Ampliación de contrato
            </div>
            <div class="col s12 m12">
                <div class="card card-body">
                    @livewire('convenios-modificatorios-contratos.convenio-modificatorio-component', ['contrato_id' => $contratos->id, 'show_contrato' => true])
                </div>
            </div>
        </li>
        <li>

            <div class="collapsible-header"><i class="material-icons">done_all</i> Cédula de cumplimiento
            </div>

            <div class="col s12 m12">
                <div class="card card-body">
                    @livewire('cedula-cumplimiento.cedula-cumplimiento-component', ['contrato_id' => $contratos->id, 'show_contrato' => true])

                </div>

            </div>
        </li>
    </ul>

    <div class="form-group col-12 text-right mt-4" style="margin-left: 10px; margin-right: 10px;">
        <div class="col s12 m12 right-align btn-grd distancia">
            <a href="{{ route('contract_manager.contratos-katbol.index') }}" class='btn btn-success'>Salir</a>
        </div>
    </div>

    @if ($contrato->documento)
        <script type="text/javascript">
            $(document).ready(function() {
                $(".td_fianza").fadeIn(0);
            });
        </script>
    @else
        <script type="text/javascript">
            $(document).ready(function() {
                $('.table-fianza').fadeOut(0);
            });
        </script>
    @endif
@endsection
