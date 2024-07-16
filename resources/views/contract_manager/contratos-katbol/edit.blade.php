@extends('layouts.admin')


@section('content')
    {{ Breadcrumbs::render('contratos-katbol_formulario') }}
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        hr.hr-custom-title {
            width: 100%;
            margin: 8px 0;
            border-top: 3px solid #1E94A8;
        }
    </style>

    @if (session('mensajeError'))
        <div class="alert alert-danger">
            {{ session('mensajeError') }}
        </div>
    @endif
    {{-- {{ Breadcrumbs::render('contratos_edit', $contrato) }} --}}
    @include('admin.bitacora.formedit', ['show_contrato' => false])

    <div class="row" style="margin-left: 10px; margin-right: 10px; margin-top: 30px;">
        <div class="col s12 m12">
            <div class="card">
                <div class="card-body blue-text" style="overflow-x:auto !important;">
                    <h3>Contrato</h3>
                    <table class="refresco table" id="tblContrato">
                        <thead style="overflow-x:auto !important;">
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
                                        <p class="grey-text" style="font-size:17px;font-weight:bold;">IVA&nbsp;@for ($i = 0; $i < 20; $i++)
                                                &nbsp;
                                            @endfor
                                        </p>
                                    @endif

                                </th>
                                <th>
                                    @if ($contrato->tipo_cambio == 'USD')
                                        <p></p>
                                    @else
                                        <p class="grey-text" style="font-size:17px;font-weight:bold;">Subtotal&nbsp;
                                            @for ($i = 0; $i < 20; $i++)
                                                &nbsp;
                                            @endfor
                                        </p>
                                    @endif
                                </th>
                                <th>
                                    <p class="grey-text" style="font-size:17px;font-weight:bold;">Monto&nbsp;total&nbsp;
                                        @for ($i = 0; $i < 15; $i++)
                                            &nbsp;
                                        @endfor
                                    </p>
                                </th>
                                <th>
                                    <p class="grey-text" style="font-size:17px;font-weight:bold;">Estado</p>
                                </th>
                                <th style="text-align: center">
                                    <p class="grey-text" style="font-size:17px;font-weight:bold;">Habilitar ampliación</p>
                                </th>
                                <th style="text-align: center">
                                    <p class="grey-text" style="font-size:17px;font-weight:bold;">Convenio Modificatorio</p>
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
                                <td>
                                    $ {{ number_format($contrato_importe_total, 2) }}
                                </td>
                                <td>
                                    @if ($contrato->estatus == 'vigentes')
                                        Vigente
                                    @elseif($contrato->estatus == 'renovaciones')
                                        Renovación
                                    @else
                                        Cerrado
                                    @endif
                                </td>
                                <td style="text-align: center">
                                    <form style="width:100%;" id="ampliacion_form"
                                        action="{{ route('contract_manager.contratos-katbol.ampliacion', ['id' => $contratos->id]) }}"
                                        method="POST">
                                        @method('PATCH')
                                        <p style="width:100%; text-align:center;">
                                            <label style="width:100% !important;">
                                                <input type="checkbox" class="checkbox"
                                                    {{ $contratos->contrato_ampliado ? 'checked' : '' }} />
                                                <span></span>
                                            </label>
                                        </p>
                                    </form>
                                </td>
                                <td style="text-align: center">
                                    <form style="width:100%;" id="convenio_form"
                                        action="{{ route('contract_manager.contratos-katbol.convenios', ['id' => $contratos->id]) }}"
                                        method="POST">
                                        @method('PATCH')
                                        <p style="width:100%; text-align:center;">
                                            <label style="width:100% !important;">
                                                <input type="checkbox" class="checkbox_convenios"
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
                                <th>
                                    <p class="grey-text tablaparra">No. pagos</p>
                                </th>
                                <th>
                                    <p class="grey-text tablaparra">Tipo</p>
                                </th>
                                <th>
                                    <p class="grey-text tablaparra">Nombre servicio</p>
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

    <div class="col s12 m12" id="ampliacion_contrato_lista">
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
            @livewire('convenios-modificatorios-contratos.convenio-modificatorio-component', ['contrato_id' => $contratos->id, 'show_contrato' => false])
        </div>
    </div>

    <div class="col s12 m12">
        <div class="card card-body">
            <h5 class="mb-0 d-inline-block">Cédula de cumplimiento</h5>
            <hr class="hr-custom-title">
            @livewire('cedula-cumplimiento.cedula-cumplimiento-component', ['contrato_id' => $contratos->id, 'show_contrato' => false])
        </div>
    </div>


    <div class="form-group col-12 text-right mt-4" style="margin-left: 10px; margin-right: 10px;">
        <div class="col s12 m12 right-align btn-grd distancia">
            <a href="{{ route('contract_manager.contratos-katbol.index') }}" class="btn btn-success">Salir
                sin llenar</a>
        </div>
    </div>

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

                $(".checkbox_convenios").click(function() {
                    let convenio = 0;
                    let url = $("#convenio_form").attr("action");
                    if ($(".checkbox_convenios").is(':checked')) {
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
            });

            function refreshTable() {
                $('.refresco').fadeOut();
                $('.refresco').load(url, function() {
                    $('.refresco').fadeIn();
                });
            }

            $("#dolares_filtro").select2('destroy');
        @endsection
    </script>
@endsection
