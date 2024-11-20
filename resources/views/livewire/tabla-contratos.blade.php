<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
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
                            @if (!empty($contratos->dolares->monto_dolares))
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
                        <tr class="black-text">
                            <td>{{ $contratos->no_contrato }}</td>
                            <td>{{ $contratos->vigencia_contrato }}</td>
                            <td>{{ $contratos->fase }}</td>
                            @if (!empty($contratos->dolares->monto_dolares))
                                <td>$ {{ number_format($contratos->dolares->valor_dolar, 2) }}</td>
                                <td>$ {{ number_format(($contratos->dolares->monto_dolares / 1.16) * 0.16, 2) }}</td>
                                <td>$ {{ number_format($contratos->dolares->monto_dolares / 1.16, 2) }}</td>
                                <td>$ {{ number_format($contratos->dolares->monto_dolares, 2) }}</td>
                            @endif
                            <td>$ {{ number_format(($contratos->monto_pago / 1.16) * 0.16, 2) }}</td>
                            <td>$ {{ number_format($contratos->monto_pago / 1.16, 2) }}</td>
                            <td>$ {{ number_format($contratos->monto_pago, 2) }}</td>
                            <td>{{ $contratos->estatus }}</td>
                            <td style="text-align: center !important">
                                <p>
                                    <label>
                                        <input type="checkbox" name="contrato_ampliado"
                                            wire:change="cambioContratoAmpliado" wire:model="contrato_ampliado"
                                            class="checkbox" />
                                        <span></span>
                                    </label>
                                </p>
                            </td>
                            <td style="text-align: center !important">
                                <p>
                                    <label>
                                        <input type="checkbox" name="convenio_modificatorio"
                                            wire:model="convenio_modificatorio"
                                            wire:change="cambioConvenioModificatorio" class="checkbox_convenio" />
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
                @livewire('convenios-modificatorios-contratos.convenio-modificatorio-component', [
                    'contrato_id' => $contratos->id,
                    'show_contrato' => false,
                ])
            </div>
        </div>
    @endif

    <div class="col s12 m12 l12">
        <div class="card card-body">
            <h5 class="mb-0 d-inline-block">Cédula de cumplimiento</h5>
            <hr class="hr-custom-title">
            @livewire('cedula-cumplimiento.cedula-cumplimiento-component', ['contrato_id' => $contratos->id, 'show_contrato' => false])
        </div>
    </div>
</div>
