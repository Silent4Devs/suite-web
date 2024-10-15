<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="col s12 m12">
        <div class="card">
            <div class="card-body blue-text" style="overflow-x:auto !important;">
                <h3>Contrato</h3>
                <table class="refresco table" id="tblContrato">
                    <thead>
                        <tr>
                            <th>No. contrato</th>
                            <th>Vigencia</th>
                            <th>Fase</th>
                            @if (!empty($this->contratos->dolares))
                                <th>Valor (USD) del contrato</th>
                                <th>IVA (USD)</th>
                                <th>Subtotal (USD)</th>
                                <th>Monto de pago total (USD)</th>
                            @endif
                            <th>IVA</th>
                            <th>Subtotal</th>
                            <th>Monto de pago total</th>
                            <th>Estado</th>
                            <th style="text-align: center">Habilitar ampliación</th>
                            <th style="text-align: center">Convenios Modificatorios</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $contrato_importe_total = $contratos->monto_pago;
                            $contrato_importe_total_dolares = $contratos->dolares->monto_dolares ?? 0;
                        @endphp
                        @foreach ($contratos->ampliaciones as $ampliacion)
                            @php
                                $contrato_importe_total += $ampliacion->importe;
                                if (!empty($contratos->dolares)) {
                                    # code...
                                    $contrato_importe_total_dolares +=
                                        $ampliacion->importe / $contratos->dolares->valor_dolar;
                                }
                            @endphp
                        @endforeach
                        <tr class="black-text">
                            <td>{{ $contratos->no_contrato }}</td>
                            <td>
                                <i class="fas fa-calendar-alt"></i>
                                {{ $contratos->vigencia_contrato }}
                            </td>
                            <td>{{ $contratos->fase }}</td>
                            @if (!empty($contratos->dolares))
                                <td>$ {{ number_format($contratos->dolares->valor_dolar, 2) }}</td>
                                <td>$
                                    {{ number_format(($contrato_importe_total_dolares / 1.16) * 0.16, 2) }}
                                </td>
                                <td>$
                                    {{ number_format($contrato_importe_total_dolares / 1.16, 2) }}
                                </td>
                                <td>$
                                    {{ number_format($contrato_importe_total_dolares, 2) }}
                                </td>
                            @endif
                            <td>
                                $ {{ number_format(($contrato_importe_total / 1.16) * 0.16, 2) }}
                            </td>
                            <td>
                                $ {{ number_format($contrato_importe_total / 1.16, 2) }}
                            </td>
                            <td>
                                $ {{ number_format($contrato_importe_total, 2) }}
                            </td>
                            <td>
                                @if ($contratos->estatus == 'vigentes')
                                    Vigente
                                @elseif($contratos->estatus == 'renovaciones')
                                    Renovación
                                @else
                                    Cerrado
                                @endif
                            </td>
                            <td style="text-align: center">
                                <p style="width:100%; text-align:center;">
                                    <label style="width:100% !important;">
                                        <input type="checkbox" wire:model="contrato_ampliado"
                                            wire:change="cambioContratoAmpliado" class="checkbox" />
                                        <span></span>
                                    </label>
                                </p>
                            </td>
                            <td style="text-align: center">
                                <p style="width:100%; text-align:center;">
                                    <label style="width:100% !important;">
                                        <input type="checkbox" wire:model="convenio_modificatorio"
                                            wire:change="cambioConvenioModificatorio" class="checkbox_convenios" />
                                        <span></span>
                                    </label>
                                </p>
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

    @if ($contratos->contrato_ampliado)
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
    @endif

    @if ($contratos->convenio_modificatorio)
        <div class="col s12 m12" id="convenio_contrato_lista">
            <div class="card card-body">
                <h5 class="mb-0 d-inline-block">Convenios Modificatorios</h5>
                <hr class="hr-custom-title">
                @livewire('convenios-modificatorios-contratos.convenio-modificatorio-component', ['contrato_id' => $contratos->id, 'show_contrato' => false])
            </div>
        </div>
    @endif

    <div class="col s12 m12">
        <div class="card card-body">
            <h5 class="mb-0 d-inline-block">Cédula de cumplimiento</h5>
            <hr class="hr-custom-title">
            @livewire('cedula-cumplimiento.cedula-cumplimiento-component', ['contrato_id' => $contratos->id, 'show_contrato' => false])
        </div>
    </div>
</div>
