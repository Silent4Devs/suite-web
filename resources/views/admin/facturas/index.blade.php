@extends('layouts.admin')

@section('content')
    {{-- {{ Breadcrumbs::render('contratos_create') }} --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/botones.css') }}"> --}}

    <style>
        hr.hr-custom-title {
            width: 100%;
            margin: 8px 0;
            border-top: 3px solid #1E94A8;
        }

        .asterisco {
            color: red;
            margin-left: 5px;

        }
    </style>
    <div class="col s12 m12">
        <div class="card card-body">
            <div class="table-responsive">
                <h4>Contrato</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No. contrato</th>
                            <th>Vigencia</th>
                            <th>Fase</th>
                            <th>IVA</th>
                            <th>Subtotal</th>
                            <th>Monto de pago total</th>
                            <th>Estado</th>
                            <th style="text-align: center">Habilitar ampliación</th>
                            <th style="text-align: center">Convenios Modificatorios</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="black-text">
                            <td>{{ $contratos->no_contrato }}</td>
                            <td>{{ $contratos->vigencia_contrato }}</td>
                            <td>{{ $contratos->fase }}</td>
                            <td>$ {{ number_format(($contratos->monto_pago / 1.16) * 0.16, 2) }}</td>
                            <td>$ {{ number_format($contratos->monto_pago / 1.16, 2) }}</td>
                            <td>$ {{ number_format($contratos->monto_pago, 2) }}</td>
                            <td>{{ $contratos->estatus }}</td>
                            <td style="text-align: center !important">
                                <form id="ampliacion_form"
                                    action="{{ route('contract_manager.contratos-katbol.ampliacion', ['id' => $contratos->id]) }}"
                                    method="POST">
                                    @method('PATCH')
                                    <p>
                                        <label>
                                            <input type="checkbox" class="checkbox"
                                                {{ $contratos->contrato_ampliado ? 'checked' : '' }} />
                                            <span></span>
                                        </label>
                                    </p>
                                </form>
                            </td>
                            <td style="text-align: center !important">
                                <form id="convenio_form"
                                    action="{{ route('contract_manager.contratos-katbol.convenios', ['id' => $contratos->id]) }}"
                                    method="POST">
                                    @method('PATCH')
                                    <p>
                                        <label>
                                            <input type="checkbox" class="checkbox_convenio"
                                                {{ $contratos->convenio_modificatorio ? 'checked' : '' }} />
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


    <div>
        <div class="col s12 m12">
            <div class="card card-body">
                <h5 class="mb-0 d-inline-block">Facturación</h5>
                <hr class="hr-custom-title">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No. pagos</th>
                                <th>Tipo</th>
                                <th>Nombre servicio</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="black-text">
                                <td>
                                    <a href="#" data-type="text" data-pk="{{ $contratos->id }}"
                                        data-url="{{ route('contract_manager.contratos-katbol.contratopago', $contratos->id) }}"
                                        data-title="Número de contrato" data-value="{{ $contratos->no_pagos }}"
                                        class="no_pagos" data-name="no_pagos">
                                    </a>
                                </td>
                                <td>
                                    <a href="#" data-type="text" data-pk="{{ $contratos->id }}"
                                        data-url="{{ route('contract_manager.contratos-katbol.contratopago', $contratos->id) }}"
                                        data-title="Tipo de contrato" data-value="{{ $contratos->tipo_contrato }}"
                                        class="tipo_contrato" data-name="tipo_contrato">
                                    </a>
                                </td>
                                <td>
                                    <a href="#" data-type="text" data-pk="{{ $contratos->id }}"
                                        data-url="{{ route('contract_manager.contratos-katbol.contratopago', $contratos->id) }}"
                                        data-title="Nombre de servicio" data-value="{{ $contratos->nombre_servicio }}"
                                        class="nombre_servicio" data-name="nombre_servicio">
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col s12 m12">
        <div class="card card-body">
            @livewire('factura.factura-component', ['contrato_id' => $contratos->id, 'show_contrato' => false, 'contrato_total' => $contratos->monto_pago])
        </div>
    </div>

    <div class="col s12 m12">
        <div class="card card-body">
            <h5 class="mb-0 d-inline-block">Niveles de servicio</h5>
            <hr class="hr-custom-title">
            @livewire('niveles-servicio.niveles-component', ['contrato_id' => $contratos->id, 'show_contrato' => false])
        </div>
    </div>

    <div class="col s12 m12">
        <div class="card card-body">
            <h5 class="mb-0 d-inline-block">Entregables mensuales</h5>
            <hr class="hr-custom-title">
            @livewire('entregable-mensual.entregablecomponent', ['contrato_id' => $contratos->id, 'show_contrato' => false])
        </div>
    </div>

    <div class="col s12 m12">
        <div class="card card-body">
            <h5 class="mb-0 d-inline-block">Cierre proyecto</h5>
            <hr class="hr-custom-title">
            @livewire('cierre-contratos.cierrecomponent', ['contrato_id' => $contratos->id, 'show_contrato' => false])

        </div>
    </div>

    <div class="col s12 m12" id="ampliacion_contrato_lista"
        style="display: {{ $contratos->contrato_ampliado ? 'block' : 'none' }}">
        <div class="card card-body">
            <h5 class="mb-0 d-inline-block">Ampliación de contrato</h5>
            <hr class="hr-custom-title">
            @livewire('ampliacion-contratos.ampliacion-component', [
                'contrato_id' => $contratos->id,
                'show_contrato' => false,
                'fecha_fin_contrato' => $contratos->fecha_fin,
            ])

        </div>
    </div>

    <div class="col s12 m12" id="convenio_contrato_lista">
        <div class="card card-body">
            <h5 class="mb-0 d-inline-block">Convenios Modificatorios</h5>
            <hr class="hr-custom-title">
            @livewire('convenios-modificatorios-contratos.convenio-modificatorio-component', [
                'contrato_id' => $contratos->id,
                'show_contrato' => false,
            ])

        </div>
    </div>

    <div class="col s12 m12 l12">
        <div class="card card-body">
            <h5 class="mb-0 d-inline-block">Cédula de cumplimiento</h5>
            <hr class="hr-custom-title">
            @livewire('cedula-cumplimiento.cedula-cumplimiento-component', ['contrato_id' => $contratos->id, 'show_contrato' => false])
        </div>
    </div>



    <div class="form-group col-12 text-right mt-4" style="margin-left: 10px; margin-right: 10px;">
        <div class="col s12 m12 right-align btn-grd distancia">
            <a href="{{ route('contract_manager.contratos-katbol.index') }}" class="btn btn-success">Salir sin
                llenar</a>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        @section('x-editable')
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                //categories table
                $(".no_pagos").editable({
                    dataType: 'json',
                    success: function(response, newValue) {
                        console.log('Actualizado, response')
                    }
                });
                $(".tipo_contrato").editable({
                    dataType: 'json',
                    success: function(response, newValue) {
                        console.log('Actualizado, response')
                    }
                });

                $(".nombre_servicio").editable({
                    dataType: 'json',
                    success: function(response, newValue) {
                        console.log('Actualizado, response')
                    }
                });


                $(".checkbox").click(function() {
                    let ampliado = 0;
                    let url = $("#ampliacion_form").attr("action");
                    if ($(".checkbox").is(':checked')) {
                        ampliado = 1;
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {
                                ampliado
                            },
                            success: function(response) {
                                if (response.success == 1) {
                                    $("#ampliacion_contrato_lista").show();
                                }
                            }
                        });
                    } else {
                        ampliado = 0;
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {
                                ampliado
                            },
                            success: function(response) {
                                if (response.success == 0) {
                                    $("#ampliacion_contrato_lista").hide();
                                }
                            }
                        });
                    }
                });

                $(".checkbox_convenio").click(function() {
                    let convenio = 0;
                    let url = $("#convenio_form").attr("action");
                    if ($(".checkbox_convenio").is(':checked')) {
                        convenio = 1;
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {
                                convenio
                            },
                            success: function(response) {
                                if (response.success == 1) {
                                    $("#convenio_contrato_lista").show();
                                }
                            }
                        });
                    } else {
                        convenio = 0;
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {
                                convenio
                            },
                            success: function(response) {
                                if (response.success == 0) {
                                    $("#convenio_contrato_lista").hide();
                                }
                            }
                        });
                    }
                });
            });

            function refreshTable() {
                $('.refresco').fadeOut();
                $('.refresco').load(url, function() {
                    $('.refresco').fadeIn();
                });
            }
        @endsection
    </script>
@endsection
